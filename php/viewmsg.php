<?php

include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$id=$_GET['id'];
$query=$db->prepare("UPDATE notifications set status='read' where ord_id = '".$id."'");
$query->execute();
header("location: av_notes.php");
?>