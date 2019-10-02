<?php
include 'includes/config.php';
if(isset($admin)){
if(isset($_POST['submit'])){
$thePassword = mysqli_real_escape_string($db , $_POST['password']);
if(empty($thePassword)){
    header("Location:bank.php");
}else 
$thePassword = hash('gost', $thePassword); 
$checkPassword = mysqli_query($db , "SELECT * FROM `admin`");
while($row = mysqli_fetch_assoc($checkPassword)){
    $mypassword  = $row['password'];
}
if($thePassword === $mypassword){
    $query = mysqli_query($db,"UPDATE bank SET `sum_money`=0");
    $query .= mysqli_query($db,"UPDATE users SET `bank`=0");
    $query .= mysqli_query($db,$sql = "DELETE FROM pay");
    header("Location:bank.php");
}else{
    header("Location:bank.php?fail");
}
}else{
    header("Location:index.php");
}
}else{
    header("Location:index.php");
}
?>