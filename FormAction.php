<?php 
$firstname= $_REQUEST["firstname"];
$lastname= $_REQUEST["lastname"];
$gender= $_REQUEST["gender"];
$country= $_REQUEST["country"];

 ?>
 <!DOCTYPE html>
 <html lang="en">

 <style>
table, th, td {
  border:1px solid black;
}
</style>

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
 </head>
 <body>
 <table>
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Gender</th>
    <th>Division</th>
  </tr>
  
  <tr>
    <td> <?php echo($firstname) ?></td>
    <td> <?php echo($lastname) ?></td>
    <td> <?php echo($gender)?></td>
    <td> <?php echo($country)?> </td>

  </tr>
</table>
 </body>
 </html>