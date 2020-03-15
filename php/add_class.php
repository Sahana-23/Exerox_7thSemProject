<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();

$email=$_SESSION['email'];

if($_SERVER['REQUEST_METHOD']=='POST')
{ 
	if(isset($_POST['submit']));
	{
		$branch=$_POST['branch'];
		$sem=$_POST['sem'];
		$sec=$_POST['sec'];
		$code=$_POST['code'];
		$name=$_POST['name'];
		$sql= "INSERT INTO class VALUES ('".$email."','".$branch."','".$sem."','".$sec."','".$code."','".$name."')";
        $db->exec($sql);
		echo "<script type='text/javascript'>alert('Added Succesfully');";
	echo "window.location.href = 'teacher_classes.php';</script>;";
	}
}	
?>

<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Cutive' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=Fondamento' rel='stylesheet'>
<link href="../css/addclass.css" rel="stylesheet">
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
<title>e-Xerox - <?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?></title>
</head>
<body>
<form method="post">
<div class="container">
<div class="form-title">ADD CLASS</div>
<div class="content">
<label>Branch</label>
<select name="branch" required>
		<option disabled selected>Branch</option>
		<option value="cse">CSE</option>
		<option value="ise">ISE</option>
		<option value="ec">EC</option>
		<option value="eee">EEE</option>
		<option value="bt">BT</option>
		<option value="mech">MECH</option>
</select>
</div>
<div class="content">
<label>Semester & Section</label>
<select name="sem" required>
		<option disabled selected>Select Sem</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
</select>
<select name="sec" required>
	<option disabled selected>Select Sec</option>
	<option value="A">A</option>
	<option value="B">B</option>
	</select></div>
<div></div>
<div class="content">
<label>Subject Code</label>
<input type="text" name="code" autocomplete="off" placeholder="Enter Subject Code Here..." required>  
</div>
<div class="content">
<label>Subject Name</label>
<input type="text" name="name" autocomplete="off" placeholder="Enter Subject Here..." required> 
</div>
<center><input name="submit" type="submit" value="Add"></center>
</div>
</form>
</body>
</html>