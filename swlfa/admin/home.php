<?php include 'includes/nav.php' ; 
if(isset($admin)){
?>
<div class="container mt-5">
<div class="shadow-sm col-lg-4 text-center radius-10 m-auto bg-white"><?php $date = new DateTime("now", new DateTimeZone("Asia/Baghdad"));echo $date->format("Y-M-D");?><p class="digital-clock">00:00:00</p></div>
<?php
    $checkqarz = mysqli_query($db , "SELECT * FROM pay WHERE `verfied_money` = 0");
    $rowcount=mysqli_num_rows($checkqarz);
    if($rowcount > 0 ){
      echo " <a href='list.php' class='d-flex justify-content-center'><span class='btn btn-warning' style='direction:rtl'>$rowcount قەرز هەیە</span></a>";
    }
?>

<div class="container shadow-sm mt-4 table-white ">
<table class="table ">
  <thead>
 
    <tr>
    <th scope="col"  class="text-center">پارە دان</th>
    <th scope="col"  class="text-center">بڕی پارە</th>
    <th scope="col"  class="text-center"> ژ.دووکان</th>
    <th scope="col"  class="text-center">دوکاندار</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  if(isset($_GET['ok'])){
    $userid = mysqli_real_escape_string($db , $_GET['ok']);
    $userid = htmlspecialchars($userid);
    $date = date("M-d");
    $get_currency = mysqli_query($db ,"SELECT * FROM users WHERE id = $userid");
    while($row  = mysqli_fetch_assoc($get_currency)){
      $currency = $row['currency_day'];
    }
    $query = mysqli_query($db , "INSERT INTO pay(`userid` , `currency_day`,`verfied_money` ,`date_verfied`) VALUES('$userid' , '$currency' , 1 , '$date')");
    $query .= mysqli_query($db,"UPDATE users SET `date_verfied_by_admin`='$date',  `bank`=`bank`+`currency_day` WHERE id=$userid");
    $query .= mysqli_query($db,"UPDATE bank SET `sum_money`=`sum_money` + '$currency' ");
    if($query == true){
      header("Location:home.php");
    }else{
      echo mysqli_error($db);
    }
  }
  if(isset($_GET['deny'])){
    $userid = mysqli_real_escape_string($db , $_GET['deny']);
    $userid = htmlspecialchars($userid);
    $date = date("M-d");
    $get_currency = mysqli_query($db ,"SELECT * FROM users WHERE id = $userid");
    while($row  = mysqli_fetch_assoc($get_currency)){
      $currency = $row['currency_day'];
    }
    $query = mysqli_query($db , "INSERT INTO pay(`userid` , `currency_day`,`verfied_money` ,`date_verfied`) VALUES('$userid' ,  '$currency' , 0 , '$date')");
    $query .= mysqli_query($db,"UPDATE users SET `date_verfied_by_admin`='$date' WHERE id=$userid");

    if($query == true){
      header("Location:home.php?success");
    }
  }
  $query = mysqli_query($db , "SELECT * FROM users");
  $date = date("M-d");
  while($row = mysqli_fetch_assoc($query)){
    if($row['date_verfied_by_admin'] === $date){
          }else{
    ?>
   <tr>
      <td class="text-center d-flex"><a class="btn btn-success text-white" href="home.php?ok=<?php echo $row['id'];?>">Ok</a><a   href="home.php?deny=<?php echo $row['id'];?>" class="btn btn-danger text-white">Deny</a></td>
      <td  class="text-center"><?php echo $row['currency_day']; ?> IQD</td>
      <td  class="text-center"><?php echo $row['numshop'];?></td>
      <td  class="text-center"><?php echo $row['username'];?></td>
    </tr>
  <?php
  }
}
  ?>
  </tbody>
</table>
</div>
  </div>
  <?php
}else{
    header("Location:index.php");
}
?>
