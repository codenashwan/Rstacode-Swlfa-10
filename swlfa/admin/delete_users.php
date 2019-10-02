<?php
include 'includes/config.php';
if(isset($admin)){
if(isset($_GET['id'])){
$id = mysqli_real_escape_string($db , $_GET['id']);
$chekcurrency =mysqli_query($db,"SELECT * FROM users WHERE `id` = '$id'");
while($row = mysqli_fetch_assoc($chekcurrency)){
    $bank = $row['bank'];
}
if(empty($id)){
    header("Location:bank.php");
}else 
    $query = mysqli_query($db,$sql = "DELETE FROM pay WHERE `userid` = '$id'");
    $query .= mysqli_query($db,$sql = "DELETE FROM users WHERE `id` = '$id'");
    $query .= mysqli_query($db,"UPDATE bank SET `sum_money`=`sum_money` - '$bank'");
    header("Location:list.php");
 }else{
     header("Location:index.php");
 }
 }else{
     header("Location:index.php");
 }
?>