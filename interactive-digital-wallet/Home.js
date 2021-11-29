const mongoose = require('mongoose');
const mongooseBD = require('../../config/mongoose');
const httpStatus = require('http-status');
const { omitBy, isNil } = require('lodash');
const bcrypt = require('bcryptjs');
const moment = require('moment-timezone');
const jwt = require('jwt-simple');
const APIError = require('../utils/APIError');
const autoIncrement = require('../services/mongooseAutoIncrement');
const { env, jwtSecret, jwtExpirationInterval, masterAccount, masterAccountPassword } = require('../../config/vars');
const uuidv4 = require('uuid/v4');

autoIncrement.initialize(mongooseBD.connect());


const roles = ['customer', 'admin'];


const customerSchema = new mongoose.Schema({
  email: {
    type: String,
    
    required: true,
    unique: true,
    trim: true,
    lowercase: true,
  },
  password: {
    type: String,
    required: true,
    minlength: 6,
    maxlength: 128,
  },
  name: {
    type: String,
    maxlength: 128,
    index: true,
    trim: true,
  },
  role: {
    type: String,
    enum: roles,
    default: 'customer',
  },
  balance: {
    type: Number,
    min: 0,
    default: 0
  },

}, {
  timestamps: true,
});




customerSchema.pre('save', async function save(next) {
  try {
    if (!this.isModified('password')) return next();

    const rounds = env === 'test' ? 1 : 10;

    const hash = await bcrypt.hash(this.password, rounds);
    this.password = hash;

    return next();
  } catch (error) {
    return next(error);
  }
});


customerSchema.method({
  transformBalance() {
    const transformed = {};
    const fields = ['id', 'accountNumber', 'name', 'email', 'role', 'balance', 'createdAt'];

    fields.forEach((field) => {
      transformed[field] = this[field];
    });

    return transformed;
  },
  transform() {
    const transformed = {};
    const fields = ['id', 'accountNumber', 'name', 'email', 'role', 'createdAt'];

    fields.forEach((field) => {
      transformed[field] = this[field];
    });

    return transformed;
  },

  token() {
    const playload = {
      exp: moment().add(jwtExpirationInterval, 'minutes').unix(),
      iat: moment().unix(),
      sub: this._id,
    };
    return jwt.encode(playload, jwtSecret);
  },

  async passwordMatches(password) {
    return bcrypt.compare(password, this.password);
  },
});


customerSchema.statics = {

  roles,

  async get(id) {
    try {
      let customer;

      if (mongoose.Types.ObjectId.isValid(id)) {
        customer = await this.findById(id).exec();
      }
      if (customer) {
        return customer;
      }

      throw new APIError({
        message: 'Customer does not exist',
        status: httpStatus.NOT_FOUND,
      });
    } catch (error) {
      throw error;
    }
  },

  
  async getMasterAccount() {
    const masterAccountData = {
      accountNumber: masterAccount,
      role: 'admin',
      name: 'Master Account',
      email: 'master_account@bank.com',
      password: masterAccountPassword,
    };
    try {
      let customer = await this.findOne({ 'accountNumber': masterAccountData.accountNumber }).exec();
      
      if (customer) {
        return customer;
      }else{
        return await this.create(masterAccountData);
      }      
    } catch (error) {
      throw error;
    }
  },

 
  async findAndGenerateToken(options) {
    const { email, password, refreshObject } = options;
    if (!email) throw new APIError({ message: 'An email is required to generate a token' });

    const customer = await this.findOne({ email }).exec();
    const err = {
      status: httpStatus.UNAUTHORIZED,
      isPublic: true,
    };
    if (password) {
      if (customer && await customer.passwordMatches(password)) {
        return { customer, accessToken: customer.token() };
      
    throw new APIError(err);
  },


  list({
    page = 1, perPage = 30, name, email, role,
  }) {
    const options = omitBy({ name, email, role }, isNil);

    return this.find(options)
      
  },


 
};

customerSchema.plugin(autoIncrement.plugin, {
  model: 'Customer',
  field: 'accountNumber',
  startAt: 1001,
  incrementBy: 1
});


module.exports = mongoose.model('Customer', customerSchema);