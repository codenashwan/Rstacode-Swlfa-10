<?php include 'includes/nav.php' ; 
if(isset($admin)){
?>
<!-- Modal Sfrkrdnawa ! -->
<div class="col-md-4">
      <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="ni ni-bell-55 ni-3x"></i>
                    <h4 class="heading mt-4">تکایە پاسۆرد بنوسە بۆ دڵنیابونەوە</h4>
                    <form action="delete.php" method="post">
                    <input name="password" type="password" placeholder="Password" class="form-control border-0 mt-2 shadow">
                    <button name="submit" class="btn btn-dark w-100 mt-3">Delete All Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>


<div class="container mt-5 text-center">
<img src="../assets/img/safebox.svg" width="100" alt="">
<?php
if(isset($_GET['renew'])){
  $id = mysqli_real_escape_string($db , $_GET['renew']);
  $id = htmlspecialchars($id);
  $query = mysqli_query($db,"UPDATE bank SET sum_money=0 WHERE id=$id");
  if($query == true){
    header("Location:bank.php");
  }
}
$query = mysqli_query($db , "SELECT * FROM bank");
while($row=mysqli_fetch_assoc($query)){?>
<h4><?php echo $row['sum_money'];?> IQD</h4>
<span style="cursor:pointer"  class="btn border-0 mt-2 bg-gradient-danger text-white font-weight-bolder" data-toggle="modal" data-target="#modal-notification">سفرکردنەوەی هەموو داتاکان</span>
<?php
}
?>



<?php
if(isset($_POST['submit'])){
  $userid = mysqli_real_escape_string($db , $_POST['userid']);
  $userid = htmlspecialchars($userid);

  $dateofpay = mysqli_real_escape_string($db , $_POST['dateofpay']);
  $dateofpay = htmlspecialchars($dateofpay);

  if(empty($userid) || empty($dateofpay)){
    header("Location:bank.php");
  }else{
    $query = mysqli_query($db,"UPDATE users SET `date_of_pay`='$dateofpay' , `verified_date_of_pay`=1 WHERE `id`='$userid'");
  }
}
?>
<form action="bank.php" method="post" class="bg-white p-3 mt-5">
<label class="mt-3 h4 font-weight-bolder"> ناوی براوە</label>
<select name="userid" class="form-control">
<?php
$query = mysqli_query($db  , "SELECT * FROM users WHERE verified_date_of_pay = 0");
while($row =mysqli_fetch_assoc($query)){?>
<option value="<?php echo $row['id'];?>"><?php echo $row['fullname'];?></option>
<?php
}
?>
</select>
<label class="mt-3 h4 font-weight-bolder">سەرەی وەرگرتن بەپێی مانگ</label>
<select name="dateofpay" class="form-control">
<?php for( $m=1; $m<=12; ++$m ) { 
          $month_label = date('F', mktime(0, 0, 0, $m, 1));
        ?>
          <option value="<?php echo $month_label; ?>"><?php echo $month_label; ?></option>
        <?php } ?>
</select>
<button name="submit" class="btn btn-outline-success mt-5 w-100">Add</button>
</form>


<table class="table mt-5 table-white">
  <thead>
    <tr>
      <th scope="col">Action</th>
      <th scope="col">سەرەی وەرگرتن بەپێی مانگ</th>
      <th scope="col">ناوی براوە</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  if(isset($_GET['delete'])){
    $userid = mysqli_real_escape_string($db , $_GET['delete']);
     $query = mysqli_query($db,"UPDATE users SET `date_of_pay`='' , `verified_date_of_pay`=0 WHERE `id`='$userid'");
     if($query){
       header("Location:bank.php");
     }else{
      header("Location:bank.php");
     }
  }
  ?>
    <?php 
  if(isset($_GET['accept'])){
    $userid = mysqli_real_escape_string($db , $_GET['accept']);
     $query = mysqli_query($db,"UPDATE users SET `date_of_pay`='' , `verified_date_of_pay`=-1 WHERE `id`='$userid'");
     if($query){
       header("Location:bank.php");
     }else{
      header("Location:bank.php");
     }
  }
  ?>
  <?php
  $query = mysqli_query($db , "SELECT * FROM users WHERE verified_date_of_pay=1");
  while($row = mysqli_fetch_assoc($query)){?>
    <tr>
      <td><a href="?delete=<?php echo $row['id'];?>" class="text-danger">سڕینەوە</a> <a href="?accept=<?php echo $row['id'];?>" class="text-success mr-2">وەریگرت</a></td>
      <td><?php echo $row['date_of_pay'];?></td>
      <td><?php echo $row['username'];?></td>
    </tr>
    <?php
  }
  ?>
   
  </tbody>
</table>
  </div>




  <?php
}else{
    header("Location:index.php");
}
?>
