<?php
include_once 'includes/config.php';
if(isset($admin)){
  if(isset($_GET['accept'])){
    $userid = mysqli_real_escape_string($db , $_GET['userid']);
    $post_id = mysqli_real_escape_string($db , $_GET['accept']);
    $currency = mysqli_real_escape_string($db , $_GET['currency']);

    $query = mysqli_query($db,"UPDATE pay SET `verfied_money`=1 WHERE `id`='$post_id' ");
    $query .= mysqli_query($db,"UPDATE users SET `bank`=`bank`+`currency_day` WHERE `id`='$userid'");
    $query .= mysqli_query($db,"UPDATE bank SET `sum_money`=`sum_money` + '$currency' ");
    if($query){
        header("Location:list.php");
    }else{
        echo mysqli_error($db);
    }
  }
    else{
        header("Location:list.php");
      }
    }else{
        header("Location:index.php");
    }
      ?>