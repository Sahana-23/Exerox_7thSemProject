<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();

$email=$_SESSION['email'];
$password=$_SESSION['pass'];
$stmt = $db->prepare("SELECT role FROM users where email_id='".$email."' and password='".$password."' "); 
$stmt->execute();
$cnt= $stmt->rowCount();
if($cnt==1)
{	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	if($row['role']=='admin')
         header("location: ../php/admin.php");
	 if($row['role']=='teacher'){
		 $stmt1 = $db->prepare("SELECT fname,lname,branch FROM teacher where email_id='".$email."' "); 
         $stmt1->execute();
		 $res = $stmt1->fetch(PDO::FETCH_ASSOC);
		 $_SESSION['fname']=$res['fname'];
		 $_SESSION['lname']=$res['lname'];
		 $_SESSION['branch']=$res['branch'];
		 header('location: teacher_classes.php');	
	 
	 }
	if($row['role']=='student'){
		 $stmt1 = $db->prepare("SELECT fname,lname,branch FROM student where email_id='".$email."' "); 
         $stmt1->execute();
		 $res = $stmt1->fetch(PDO::FETCH_ASSOC);
		 $_SESSION['fname']=$res['fname'];
		 $_SESSION['lname']=$res['lname'];
		 $_SESSION['branch']=$res['branch'];
		 header('location: av_notes.php');	
	 
	 }
	
}
else
	{
		echo "<script type='text/javascript'>alert('Username and/or Password incorrect.\\nTry again.');";
		echo "window.location.href = '../php/login.php';</script>;";
      
	}

?>