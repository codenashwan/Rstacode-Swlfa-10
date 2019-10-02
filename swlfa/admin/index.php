<?php include 'includes/nav.php';?>
<?php
if(isset($admin)){
  header("Location:home.php");
}else{
$errors = ['result' => ''];
if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($db , $_POST['username']);
  $username = htmlspecialchars($username);
  $password = mysqli_real_escape_string($db , $_POST['password']);
  $password = htmlspecialchars($password);
  if(empty($password) && empty($username)){
    $errors['result'] = "خانەکان بەتاڵن";
  } else
  if(empty($username)){
    $errors['result'] = "یوسەرنەیم بەتاڵە";
  }else
  if(empty($password)){
    $errors['result'] = "پاسۆرد بەتاڵە";
  }
  if(!array_filter($errors)){
    $password = hash('gost', $password); 
  $query = mysqli_query($db , "SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'");
    if(mysqli_num_rows($query) > 0){
      while($row = mysqli_fetch_assoc($query)){
        $_SESSION['adminid'] = $row['id'];
      }
      header("Location:home.php");
    }else{
      $errors['result'] = "هەڵەیەک هەیە";
    }
  }
}
}
?>



<div class="container text-center" style="margin-top:100px"> 
<form class="col-lg-6 col-sm  p-4 text-center bg-white " method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>"style="margin:0 auto ">
  <div class="form-group">
    <input type="text" name="username" class="form-control border-0 p-4 w-100 shadow mb-3" placeholder="username">
  </div>
  <div class="form-group">
    <input type="password" name="password" class="form-control border-0 p-4 w-100 shadow mb-3" placeholder="Password">
  </div>
  <div class="mb-3">
  <span class="text-danger text-center font-weight-bolder"><?php echo $errors['result'];?></span>
  </div>
  <button type="submit" name="submit"class="btn btn-dark border-0 w-100 p-2 shadow">LOGIN</button>
</form>
</div>

<?php include '../includes/footer.php' ; ?>
