<?php include 'includes/nav.php' ; 
if(isset($userid)){
?>
<div class="container mt-5">
<div class="shadow-sm col-lg-4 text-center radius-10 m-auto bg-white"><?php $date = new DateTime("now", new DateTimeZone("Asia/Baghdad"));echo $date->format("Y-M-D");?><p class="digital-clock">00:00:00</p></div>
<div class="shadow-sm radius-10 p-g bg-gradient-danger">
<?php
$query = mysqli_query($db , "SELECT * FROM users WHERE `id` = '$userid'");
while($row = mysqli_fetch_assoc($query)){ $bank = $row['bank'];?>
<h5 class="font-weight-bolder text-white  p-2 text-right"> بەژداربوو : <?php echo $fullname;?></h5>
<h5 class="font-weight-bolder text-white p-2 text-right">  <?php echo $row['currency_day'];?>  IQD : بڕی بەژداربووی پارەدان </h5>
<h5 class="font-weight-bolder text-white p-2 text-right">ژمارەی دوکان : <?php echo $row['numshop'];?></h5>
<?php
}
?>
</div>
<div class="shadow-sm  radius-10 mb-3 mt-3 text-center p-3 bg-gradient-primary">
    <p class="h5 text-white">پارەکانت</p>
<p  class="h5 text-white"><?php echo $bank?> IQD</p>
</div>
<?php
$query = mysqli_query($db , "SELECT * FROM users WHERE `id` = '$userid' AND `verified_date_of_pay` = 1");
while($row = mysqli_fetch_assoc($query)){?>
<div class="text-center p-2 radius-10 bg-gradient-teal">
<p class="h5 text-white">سەرەی وەرگرتنی پارەکەت لە مانگی</p>
<p class="h5 text-white"><?php echo $row['date_of_pay'];?></p>
</div>
<?php
}
?>
<div class="text-center mt-2">
<a href="winner.php" class="btn btn-white h5">لیستی وەرگرتنی پارە بەپیی تیروپشک</a>
</div>
<?php
$query = mysqli_query($db , "SELECT * FROM pay WHERE `userid` = '$userid' AND `verfied_money` = 0 ");
if(mysqli_num_rows($query) > 0 ){?>
<div class="radius-10 text-center text-white">
<table class="table table-danger shadow-lg bg-gradient-warning radius-10">
<thead>
    <tr >
      <th scope="col"  class="text-center h5 text-white border-0">قەرزت هەیە لە بەرواوری</th>
    </tr>
  </thead>
  <tbody>
  <?php while($row =  mysqli_fetch_assoc($query)){?>
    <tr>
  <td class="text-white"><?php  echo $row['date_verfied'];?></td>
  </tr>
    <?php
  }
  ?>
  </tbody>
</table>
</div>
<?php
}
?>

<div class="mt-5">
<form action="home.php" method="post" class="col-lg-5 d-flex m-auto">
<select name="date_verfied" class="form-control  shadow-sm m-2">
<option value="">گەڕان بەپێی مانگ</option>
<option value="Jan">January</option>
<option value="Feb">February</option>
<option value="Mar">March</option>
<option value="Apr">April</option>
<option value="May">May</option>
<option value="Jun">June</option>
<option value="Jul">July</option>
<option value="Aug">August</option>
<option value="Sep">September</option>
<option value="Oct">October</option>
<option value="Nov">November</option>
<option value="Dec">December</option>
</select>
<button name="getmonth" class="btn btn-dark  shadow-sm m-2">گەڕان</button>
</form>
</div>
<?php
if(isset($_POST['getmonth'])){
  $query = mysqli_query($db ,"SELECT * FROM pay WHERE `userid` = '$userid'  AND `date_verfied` LIKE '%{$_POST['date_verfied']}%' " );
  ?>
<div class="container shadow-sm mt-4 table-white ">
<a class="bg-success text-white p-2 radius-10 shadow-lg" href="index.php">Renew</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col"  class="text-center">وەرگیراوە</th>
      <th scope="col"  class="text-center">بڕی پارە</th>
      <th scope="col"  class="text-center">کاتی پارەدان</th>
    </tr>
  </thead>
  <tbody>
<?php
  while($row =mysqli_fetch_assoc($query)){?>
<tr>
<?php
if($row['verfied_money'] == 1){
  echo '      <td class="text-center"><img src="assets/img/accept.svg" width="25"></td>  ';
}
if($row['verfied_money'] == 0){
  echo '      <td class="text-center"><img src="assets/img/deny.svg" width="25"></td>  ';
}
?>
      <td  class="text-center"><?php echo $row['currency_day'];?> IQD</td>
      <td  class="text-center"><?php echo $row['date_verfied'];?></td>
    </tr>
<?php
  }
  ?>
</tbody>
</table>
</div>
</div>
<?php
exit();
}
  ?>
<div class="container shadow-sm mt-4 table-white">
<a class="bg-success text-white p-2 radius-10 shadow-lg" href="index.php">Renew</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col"  class="text-center">وەرگیراوە</th>
      <th scope="col"  class="text-center">بڕی پارە</th>
      <th scope="col"  class="text-center">کاتی پارەدان</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $datenow= date("M");
  $query = mysqli_query($db,"SELECT * FROM pay WHERE `userid` = '$userid' AND `date_verfied`  LIKE '%{$datenow}%'  ");
  while($row = mysqli_fetch_assoc($query)){?>
<tr>
<?php
if($row['verfied_money'] == 1){
  echo '      <td class="text-center"><img src="assets/img/accept.svg" width="25"></td>  ';
}
if($row['verfied_money'] == 0){
  echo '      <td class="text-center"><img src="assets/img/deny.svg" width="25"></td>  ';
}
?>
      <td  class="text-center"><?php echo $row['currency_day'];?> IQD</td>
      <td  class="text-center"><?php echo $row['date_verfied'];?></td>
    </tr>
    <?php
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
