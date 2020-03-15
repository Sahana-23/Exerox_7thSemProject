<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();

$email=$_SESSION['email'];
$type=$_SESSION['type'];

$stmt = $db->prepare("SELECT * FROM users where email_id='".$email."'"); 
$stmt->execute();
$cnt= $stmt->rowCount();
if($cnt==1)
{
	echo "<script type='text/javascript'>alert('The account with this email ID already exists');";
	echo "window.location.href = 'login.php';</script>;";
}
if($cnt==0)
{
	if($type=='student')
	{ header('location: signupstudent.php');
    }
    if($type=='teacher')
	{
      header('location: signupteacher.php');
	}
}