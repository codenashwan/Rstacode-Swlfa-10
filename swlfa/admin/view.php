<?php include 'includes/nav.php' ; 
if(isset($_GET['id'])){
$userid = mysqli_real_escape_string($db , $_GET['id']);
?>
<div class="container mt-5 ">
<h2 class="btn btn-warning p-2 radius-10 shadow-lg">قەرزەکان</h2>
<table class="table table-white shadow-sm">
  <thead>
    <tr>
    <th scope="col"  class="text-center">پارە دان</th>
    <th scope="col"  class="text-center">بڕی پارە</th>
    <th scope="col"  class="text-center">کاتی پارەدان</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = mysqli_query($db ,"SELECT * FROM pay WHERE `userid`  = '$userid' AND `verfied_money` = 0 ");
    while($row = mysqli_fetch_assoc($query)){ $currency = $row['currency_day']; ?>
        <tr>
        <td class="text-center"><a href="accept_proccess.php?accept=<?php echo $row['id'];?>&userid=<?php echo $userid?>&currency=<?php echo $currency?>" class="btn btn-success">Ok</a></td>
        <td class="text-center"><?php echo $currency; ?> IQD</td>
        <td class="text-center"><?php echo $row['date_verfied'];?></td>
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