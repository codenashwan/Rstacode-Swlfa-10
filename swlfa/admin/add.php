<?php include 'includes/nav.php' ; 
if(isset($admin)){
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
?>
<style>
input{
    text-align:right;
}
</style>
<?php
$result = ['errors' => ''];
if(isset($_POST['submit'])){
    $username=mysqli_real_escape_string($db , $_POST['username']);
    $username = htmlspecialchars($username);

    $fullname=mysqli_real_escape_string($db , $_POST['fullname']);
    $fullname = htmlspecialchars($fullname);

    $numshop=mysqli_real_escape_string($db , $_POST['numshop']);
    $numshop = htmlspecialchars($numshop);

    $email=mysqli_real_escape_string($db , $_POST['email']);
    $email = htmlspecialchars($email);

    $password=mysqli_real_escape_string($db , $_POST['password']);
    $password = htmlspecialchars($password);
    
    $currency_day=mysqli_real_escape_string($db , $_POST['currency_day']);
    $currency_day = htmlspecialchars($currency_day);
    
    if(empty($username) || empty($fullname) || empty($numshop) || empty($email) || empty($password) || empty($currency_day)){
        $result['errors'] = "خانەکان بەتاڵن";
    }else
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "ئیمەیل گونجاو نییە";
    }

    $check = mysqli_query($db , "SELECT * FROM `users` WHERE `email` = '$email'");
    if(mysqli_num_rows($check) > 0){
        $result['errors'] = "ئیمەیلەکە هەیە";
    }
    
  if(!array_filter($result)){ 
      $newpassword = hash('gost', $password);
        $query = mysqli_query($db, "INSERT INTO users(`username`,`fullname`,`numshop`,`email`,`password`,`viewpassword`,`currency_day`,`bank`) VALUES ('$username','$fullname','$numshop','$email','$newpassword','$password','$currency_day'  , '0,00') ");
        if($query == true){
            header("Location:list.php");
        }else{
            header("Location:index.php");
        }
  }
}

?>
<div class="container mt-5">
   <form action="add.php" method="post" class="shadow-sm bg-white radius-10 p-3" style="text-align:right;">
   <p class="text-center font-weight-bolder text-danger"><?php echo $result['errors'];?></p>
   <div class="form-group">
   <label class="font-weight-bolder">ناوی بەشداربوو</label>
   <input type="text" name="username" class="form-control  shadow-sm" placeholder="ناوی بەشداربوو">
   </div>
  <div class="form-group">
  <label class="font-weight-bolder">ناوی تەواو</label>
  <input type="text" name="fullname" class="form-control  shadow-sm" placeholder="ناوی تەواوی بەژداربوو">
  </div>
  <div class="form-group">
   <label class="font-weight-bolder">ژمارەی دوکان</label>
   <input type="tel" name="numshop" class="form-control  shadow-sm" placeholder="ژمارەی دوکان">
   </div>
   <div class="form-group">
   <label class="font-weight-bolder">ئیمەیل</label>
   <input type="text" name="email" class="form-control  shadow-sm" placeholder="Email"  value="<?php echo substr(str_shuffle($permitted_chars), 0, 8).'@swlfa.cf';?>">
   </div>
   <div class="form-group">
   <label class="font-weight-bolder">پاسۆرد</label>
   <input type="text" name="password" class="form-control shadow-sm" placeholder="Password" value="<?php   echo substr(str_shuffle($permitted_chars), 0, 10);?>">
   </div>
   <div class="form-group">
   <label class="font-weight-bolder">بڕی پارە</label>
   <select name="currency_day" class="form-control  shadow-sm">
   <option value="25">25,000</option>
   <option value="50">50,000</option>
   <option value="75">75,000</option>
   </select>
    </div>
    <button name="submit" class="btn w-100 shadow-sm bg-gradient-success text-white">Create</button>
 
   </form>

  </div>

  <?php
  ?>
  <?php
}else{
    header("Location:index.php");
}
?>
