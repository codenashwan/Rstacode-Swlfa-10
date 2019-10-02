<?php include 'includes/nav.php' ; 
if(isset($admin)){
?>
<div class="container mt-5">
<?php
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
    $query = mysqli_query($db,"UPDATE `admin` SET `username`='$username',`password`='$password' WHERE `id` = '$admin' ");
    if($query){
        session_unset();
        unset($admin);
        session_destroy();
        header('Location:index.php');
    }
  }
}
?>

<h4 class="text-center shadow-sm p-2">Change Account Settings</h4>
<form action="change.php" class="bg-white p-3" method="POSt">
<input type="text" name="username" class="form-control mt-2 border-0 shadow" placeholder="New Username">
<input type="password" name="password" class="form-control mt-2 border-0 shadow" placeholder="New Password">
<div class="mb-2 mt-2 text-center">
  <span class="text-danger text-center font-weight-bolder"><?php echo $errors['result'];?></span>
  </div>
<button name="submit" class="btn btn-primary w-100 shadow mt-2">Change</button>

</form>
</div>
  <?php
}else{
    header("Location:index.php");
}
?>
