<?php  include 'includes/config.php' ; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="../time.js"></script>
</head>
<body>
<div class="container mt-5">
<a class="font-weight-bolder h3" href="index.php">Administration</a>
</div>
<?php if(isset($admin)){?>
<div class="container mt-3">
<ul class="nav nav-pills nav-pills-circle" id="tabs_2" role="tablist">
<li class="nav-item">
    <a class="nav-link bg-white rounded-circle" href="home.php">
      <img src="../assets/img/money.svg" class="mb-1" width="40"><img>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link bg-white rounded-circle" href="add.php">
      <img src="../assets/img/add.svg" class="mb-1" width="40"><img>
    </a>
  </li>
  <li class="nav-item">
  <a class="nav-link bg-white rounded-circle active" href="list.php">
      <img  src="../assets/img/list.svg"  class="mb-1" width="40"><img>
    </a>
  </li>
  <li class="nav-item">
  <a class="nav-link bg-white rounded-circle active" href="bank.php">
      <img src="../assets/img/bank.svg"   class="mb-1" width="40"><img>
    </a>
  </li>
  <li class="nav-item">
  <a class="nav-link bg-white rounded-circle active" href="change.php">
      <img src="../assets/img/settings.svg"   class="mb-1" width="40"><img>
    </a>
  </li>
  <?php
if(isset($_GET['logout'])){
  session_unset();
  unset($admin);
  session_destroy();
  header('Location:index.php');
  }
?>
  <li class="nav-item">
  <a class="nav-link bg-white rounded-circle active" href="?logout">
      <img src="../assets/img/logout.svg" class="mb-1" width="40"><img>
    </a>
  </li>
</ul>
</div>  
<?php
}
?>