<?php  include 'includes/config.php' ; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="time.js"></script>
</head>
<body>
<div class=" w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0" id="rightMenu">
  <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
  <?php if(isset($userid)){
    ?>
  <div class="d-flex justify-content-center m-3">
  <a href="home.php"><span class="font-weight-bolder text-success">بەخێربێیت،  <?php echo $username; ?></span> </a>
  </div>
  <?php } else{?>
  <a href="index.php" class="text-decoration-none"><div class="p-2 text-center mt-3 shadow-sm bg-gradient-success text-white">LOGIN</div></a>
<?php } ?>
  <a href="index.php" class="w3-bar-item btn btn-outline-dark m-1">HOME</a>
  <a href="contact.php" class="w3-bar-item btn btn-outline-dark m-1">CONTACT</a>
  <a href="about.php" class="w3-bar-item btn btn-outline-dark m-1">ABOUT</a>
  <?php if(isset($userid)){  ?>
  <a href="?logout" class="w3-bar-item btn btn-outline-danger m-1">LOGOUT</a>
  <?php } ?>
  <?php include 'includes/footer.php' ; ?>
</div>
<div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">
  <button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large">Close &times;</button>
</div>
  <button class="w3-button w3-xlarge w3-right  m-3" onclick="openRightMenu()">&#9776;</button>
  <div class="container w3-container">
  <a href="index.php" class="m-1 h1 font-weight-bolder text-success">Swlfa Save <img src="assets/img/money.svg" width="40" alt=""></a>
  </div>
<script>
function openRightMenu() {
  document.getElementById("rightMenu").style.display = "block";
}
function closeRightMenu() {
  document.getElementById("rightMenu").style.display = "none";
}
</script>    
<?php
if(isset($_GET['logout'])){
  session_unset();
  unset($userid);
  session_destroy();
  header('Location:index.php');
  }
?>


