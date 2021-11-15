<?php
require 'formvalidation.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>registration page</title>
</head>

<body>
    <h1>my registration page</h1>
    <form form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <table>
            <tr>
                <td>First Name:</td>
                <td><input type="text" name="fname" /><?php echo $validateName; ?></td>
                <td></td>
            </tr>

            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" /><?php echo $validateEmail; ?></td>
            </tr>
            <tr>
                <td>User Name:</td>
                <td><input type="text" name="userName" /><?php echo $validUserName; ?></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" /><?php echo $validPassword; ?></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="confirmPassword" /></td>
            </tr>
        </table>
        Gender:
        <br>
        <input type="radio" name="gender" id="male" value="male" />
        Male
        <input type="radio" name="gender" id="female" value="female" />
        Female
        <input type="radio" name="gender" id="other" value="other" />
        other
        <br>
        <?php echo  $genderValidation; ?>
        <br>
        <br>
        Date of birth:
        <br>
        <input type="date" id="birthday" name="birthday"><?php echo $valiDate; ?>
        <br>
        <br>
        <input type="submit" value="submit">
        <input type="reset" value="reset">
    </form>
</body>

</html>