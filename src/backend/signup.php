<?php

include('../../config/database.php');

$fname      = $_POST['f_name'];
$lname      = $_POST['l_name'];
$email      = $_POST['e_mail'];
$passwd     = $_POST['passw'];

//$enc_pass = md5($passwd);
$enc_pass = sha1($passwd);

$sql_email_exist = "
SELECT COUNT(email) as total FROM users WHERE email = '$email' Limit 1";

$res = pg_query($conn, $sql_email_exist);

if($res){

    $row = pg_fetch_assoc($res);

    if($row['total'] > 0){

        echo "Email already exists";
        
    }else{

      $sql = "INSERT INTO users (firstname, lastname, email, password)

         VALUES('$fname','$lname','$email','$enc_pass')

";

 $res = pg_query($conn, $sql);

 if ($res){
     //echo "USER HAS BEEN CREATED SUCCESFULLY";
     echo"<script>alert('USER HAS BEEN CREATED. GO tO lOGIN!')</script>";
     header('Refresh:0; url=http://localhost/schoolar2/src/login.html');
 }else{
    
    echo "Error";  
    }
    }
 }
?>