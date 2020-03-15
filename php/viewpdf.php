<?php
header("Content-type:application/pdf");
$id=$_GET['id'];
include_once '../config/dbconn.php';
    $database = new Database();
    $db = $database->getConnection();
$stmt=$db->prepare("select * from uploads where sl_no='".$id."'");
 $stmt->execute();
 $row=$stmt->fetch();
 $content=hex2bin($row['content']);
echo $content;
?>