<?php
class value_insert{
function OpenCon()
{ 
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
}

function value($conn,$user,$email,$username,$password,$gender,$birthday)
{
    $sql = "INSERT INTO user (user,email,username,password,gender,birthday)
VALUES ('$user','$email','$username','$password','$gender','$birthday')";
$res = $conn->query($sql);//execute query
if($res)
{ echo "new record inserted"; }
else
{ echo "error occurred". $conn->error; }

}



function insertUserdata($conn,$email,$username,$password,$gender,$birthday)
{
    
    $qry = "INSERT INTO user (fname, email, uname, password, gender, dob) VALUES ('$fname','$email', '$uname', '$password1', '$gender', '$dob')";
    $res = $conn->query($sql);
    if(res) {
        return 1;
    }
    else {
        return 0;
    }

}




function CloseCon($conn)
 {
 $conn -> close();
 }

};

?>