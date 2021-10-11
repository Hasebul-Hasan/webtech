<!DOCTYPE html>
<html>

<head>
    <meta charset = "utf-8">
    <title>User Lisrt</title>
</head>

<body>

    <?php
      $handle = fopen("data.json","r");
      $data = fread ($handle,filesize("data.jison"));
      var_dump($data);
    ?>
    <! -- <hr> -->

    <hr>
    <?php
      $explode = explode ("\n",$data);
      array_pop($explode);
      var_dump($explode);
      ?>

      <hr>

    <?php 
         $arry1 = array();
         for ($i = 0; $i < count($explode); $i++ )
         {
            $jison = jison_decode($explode [$i]);
            array_push($arr1,$json);
         } 

         var_dump($arr1);
    ?>

    <hr>

    <?php 
        echo $arr1[0]-> userName;
    ?>

    <hr>

    <?php 
        $explode =explode("\n",$data);
        array_pop($explode);
        var_dump($explode);
    ?>

    <hr>

    <?php 

       $arr1 =array();
       for ($i = 0; $i< count($explode); $i++ )
       {
        $json = json_decode($explode[$i]);
        array_push($arr1, $json);
       }
        var_dump($arr1);
    ?>

    <hr>
    <?php 
    echo $arr1[0]->userName;
    ?>

    <table border = "1">
       <thead>
           <tr>
              <th>User Name</th>
              <th> Password</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                   for ($k = 0; $k < count($arr1); $k++)
                   {
                    echo"<tr>";
                    echo "<tr>".$arr1[$k]->userName."</td>";
                    echo "<tr>".$arr1[$k]->password."</td>";
                    echo "</tr>";
                   }
                ?>

             </tbody>
             </table>
             </body>


<?php
$validateName = "";
$validateEmail = "";
$genderValidation = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_REQUEST["fname"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    $confirm = $_REQUEST["confirmPassword"];
    $validPassword="";

    if (empty($name) || strlen($name) < 5 || !preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $validateName = "you must enter your name";
    } else {
        $validateName = "your name is " . $name;
    }
    if (empty($email))
    {
        $validateEmail = "you must enter your email";
    }
   
    else {
        $validateEmail = "your email is " . $email;
    }
    if(!isset($_REQUEST["gender"]))
    {
        $genderValidation="select your gender";
    }
    else
    {
        $gender=$_REQUEST["gender"];;
        $genderValidation="your gender is ".$gender;
    }
    if(empty($password)||empty($confirmPassword))
    {
        $validPassword="enter valid password";
    }
    elseif($password!=$confirmPassword)
    {
        $$validPassword="password is incorrect";
    }
    else if($password>8)
    {
        $validPassword="password must contain at least 8 characters";
    }
    else
    {
        $validPassword="password correct";
    }
}
?>



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
                <td><input type="text" name="userName" /></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td><input type="password" name="confirmPassword" /><?php echo $validPassword; ?></td>
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
        <?php echo $genderValidation; ?>
        <br>
        Date of birth:
        <br>
        <input type="date" id="birthday" name="birthday">
        <br>
        <br>
        
    </form>
</body>

</html>
