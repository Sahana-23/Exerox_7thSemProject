<?php

include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();


$orstr=$_GET['orlist'];
$orlist=array();
$orlist=explode("|",$orstr);
for($i=0;$i<count($orlist)-1;$i++)
{
	$stmt=$db->prepare("update orders set status='completed' where o_id=$orlist[$i]");
	$stmt->execute();
	$message="Your Order ".$orlist[$i]." is ready...";
	$stmt1=$db->prepare("insert into notifications values ('".$orlist[$i]."','".$message."','unread')");
	$stmt1->execute();
	header("location: admin_order.php");
}
?>