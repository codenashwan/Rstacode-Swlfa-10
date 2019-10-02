<?php include 'includes/nav.php' ; 
if(isset($userid)){
?>
<div class="container">
<h5 class="mt-5 text-dark font-weight-bolder text-center">لیستی وەرگرتنی پارەی تیروپشک بەپێی مانگ</h5>
<table class="table table-white shadow-sm radius-10">
  <thead>
    <tr class="text-center text-primary">
      <th scope="col">سەرەی وەرگرتن بەپێی مانگ</th>
      <th scope="col">ناوی براوە</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $query = mysqli_query($db , "SELECT * FROM users WHERE verified_date_of_pay=1");
  while($row = mysqli_fetch_assoc($query)){?>
    <tr class="text-center">
      <td><?php echo $row['date_of_pay'];?></td>
      <td><?php echo $row['fullname'];?></td>
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