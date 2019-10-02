<?php
session_start();
ob_start();

if(isset($_SESSION['userid'])){
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$fullname = $_SESSION['fullname'];

}
$db = mysqli_connect('localhost' , 'root' , '' , 'swlfa');

$db->query("SET NAMES 'utf8'");
$db->query("SET CHARACTER SET utf8");
ini_set('default_charset','UTF-8'); 

if(!$db){
    exit("Error Connect To Database");
    echo mysqli_error_connet();
}


?>