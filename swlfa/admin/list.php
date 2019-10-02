<?php include 'includes/nav.php' ; 
if(isset($admin)){
?>
<div class="container mt-5">
<form action="list.php " class="d-flex" method="post">
<input type="tel" class="form-control m-2 border-0 shadow-sm" name="numshop" placeholder="ژمارەی دووکان">
<button class="btn btn-dark m-2" name="submit">گەڕان</button>
</form>
<div class="row d-flex justify-content-center ">
<?php
if(isset($_POST['submit'])){
  $numshop = mysqli_real_escape_string($db , $_POST['numshop']);
  $numshop = htmlspecialchars($numshop);
  if(empty($numshop)){
    header("Location:list.php");
  }else{
  $query = mysqli_query($db , "SELECT * FROM users WHERE numshop = $numshop");
  while($row = mysqli_fetch_assoc($query)){ $userid = $row['id']?>
  <div class="card shadow-sm border-0 radius-10 m-2 bg-gradient-purple"  style="width: 20rem;">
  <div class="card-body text-right">
  <h5 class="card-text text-white">ناو:   <?php echo $row['username'];?></h5>
    <h5 class="card-text text-white">ناوی سیانی :   <?php echo $row['fullname'];?></h5>
    <h5 class="card-text text-white"> ژمارەی دوکان :   <?php echo $row['numshop'];?></h5>
    <h5 class="card-text  text-white">Email : <?php echo $row['email'];?></h5>
    <h5 class="card-text text-white">Password:<?php echo $row['viewpassword'];?></h5>
    <h5 class="card-text text-white">بانک : <?php echo $row['bank'];?></h5>
    <h5 class="card-text text-white"> ژمارەی دوکان :<?php echo $row['numshop'];?></h5>
   <div class="mt-5 d-flex justify-content-center">
    <?php
    $checkqarz = mysqli_query($db , "SELECT * FROM pay WHERE `userid`  = '$userid' AND `verfied_money` = 0");
    if(mysqli_num_rows($checkqarz) > 0){?>
          <a class="element" href="view.php?id=<?php echo $userid?>" class="ml-5 mr-5"><img src="../assets/img/debt_deny.svg" title="قەرزی هەیە" width="40"></a>
<?php
      }else{
          ?>
          <a href="view.php?id=<?php echo $userid?>" class="ml-5 mr-5"><img src="../assets/img/debt.svg" width="40"></a>
<?php
      }
    ?>
          <a href="delete_users.php?id=<?php echo $userid?>" class="mr-5"><img src="../assets/img/delete.svg" title="سڕینەوە" width="40"></a>
    </div>
  </div>
</div>
    <?php
    }
    exit();
}
}
?>
<?php
$query = mysqli_query($db , "SELECT * FROM `users`");
while($row = mysqli_fetch_assoc($query)){ $userid = $row['id']?>
<div class="card shadow-sm border-0  radius-10 m-2"  style="width: 20rem;">
  <div class="card-body text-right">
  <h5 class="card-text">ناو:   <?php echo $row['username'];?></h5>
    <h5 class="card-text">ناوی سیانی :   <?php echo $row['fullname'];?></h5>
    <h5 class="card-text"> ژمارەی دوکان :   <?php echo $row['numshop'];?></h5>
    <h5 class="card-text">Email : <?php echo $row['email'];?></h5>
    <h5 class="card-text">Password:<?php echo $row['viewpassword'];?></h5>
    <h5 class="card-text">بانک : <?php echo $row['bank'];?></h5>
    <h5 class="card-text"> ژمارەی دوکان :<?php echo $row['numshop'];?></h5>
    <div class="mt-5 d-flex justify-content-center">
    <?php
    $checkqarz = mysqli_query($db , "SELECT * FROM pay WHERE `userid`  = '$userid' AND `verfied_money` = 0");
    if(mysqli_num_rows($checkqarz) > 0){?>
          <a class="element" href="view.php?id=<?php echo $userid?>" class="ml-5 mr-5"><img src="../assets/img/debt_deny.svg" title="قەرزی هەیە" width="40"></a>
<?php
      }else{
          ?>
          <a href="view.php?id=<?php echo $userid?>" class="ml-5 mr-5"><img src="../assets/img/debt.svg" width="40"></a>
<?php
      }
    ?>
          <a href="delete_users.php?id=<?php echo $userid?>" class="mr-5"><img src="../assets/img/delete.svg" title="سڕینەوە" width="40"></a>
    </div>
  </div>
</div>
<?php
}
?>

</div> <!-- End Row-->
  </div><!-- End Container-->
  <?php
}else{
    header("Location:index.php");
}
?>
