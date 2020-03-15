<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
if(isset($_GET['sl_no']))
{
	$id=$_GET['sl_no'];
	$stmt=$db->prepare("select * from uploads where sl_no=?");
	$stmt->bindParam(1,$id);
	$stmt->execute();
	
	$data=$stmt->fetch();

	$file='C:/wamp64/www/exerox/php/uploads/'.$data['f_name'];
	if(file_exists($file))
	{
		header('Content-Description: File Transfer');
		header('Content-Type:application/octet-stream');
		header('Content-Disposition:attachment;filename="'.basename($file).'"');
		header('Cache-Control:must-revalidate');
		header('Expires:0');
		header('Pragma: public');
		header('Content-Length:'.filesize($file));
		readfile($file);
		exit;


	}
}
?>