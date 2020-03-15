<?php
include_once 'config/dbconn.php';
    $database = new Database();
    $db = $database->getConnection();
$stmt=$db->prepare('select * from uploads where sl_no=3');
 $stmt->execute();
 $row=$stmt->fetch();
 $content=$row['content'];
 $c=hex2bin($content);
 echo "<a href=\"view.php?id=23\" target=\"_blank\">";
 echo $c;
 
 
?>