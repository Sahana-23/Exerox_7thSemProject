<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$email=$_SESSION['email'];
if(isset($_GET['all']))
{
   	$clearcart="delete from cart where email_id='".$email."'";
	$db->exec($clearcart);
}
if(isset($_GET['fid'])&&isset($_GET['qty'])&&isset($_GET['price']))
{  $fid=$_GET['fid'];
   $qty=$_GET['qty'];
   $price=$_GET['price'];
   echo $fid.$qty.$price;
   $removeitem="delete from cart where email_id='".$email."' and f_id=$fid and qty=$qty and price=$price ";
	$db->exec($removeitem);
	
}
header("location:dispcart.php");
?>