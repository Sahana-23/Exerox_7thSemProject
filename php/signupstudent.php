<!DOCTYPE html>
<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();

$email=$_SESSION['email'];

if($_SERVER['REQUEST_METHOD']=='POST')
{ 
	if(isset($_POST['submit'])) 
	{ $email_id=$email;
      $pass=$_POST['pass1'];
	  $cpass=$_POST['pass2'];
	  $usn=$_POST['usn'];
	  $fname=$_POST['fname'];
	  $lname=$_POST['lname'];
	  $gender=$_POST['gender'];
	  $branch=$_POST['branch'];
	  $sem=$_POST['sem'];
	  $sec=$_POST['sec'];
	  $mob=$_POST['mob'];
	 
	  
	 
	 
	 $sql= "INSERT INTO users VALUES ('".$email_id."','".$pass."', 'student')";
     $db->exec($sql);
	 
	 $sql2 = "INSERT INTO student VALUES ('".$email_id."','".$usn."','".$fname."','".$lname."','".$gender."','".$branch."','".$sem."','".$sec."','".$mob."')";
     $db->exec($sql2);
     
	 $_SESSION['fname']=$fname;
     $_SESSION['lname']=$lname;	  
	 $_SESSION['branch']=$branch;
echo "<script type='text/javascript'>alert('Registered Succesfully');";
	echo "window.location.href = '../php/av_notes.php';</script>;";	

	}
}
?>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up - Student</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="../css/signup.css">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

  </head>
<body >
<form method="post" action="signupstudent.php">
 <div class="container">
  <div class="sub-cont">
    <div class="first"><label>First Name</label>
      <input type="text" name="fname" autocomplete="off" required>
	  </div>
    <div class="second"><label>Last Name</label>
      <input type="text" name="lname" autocomplete="off" required>
	  </div>
  </div>
  <div class="sub-cont">
    <div style='padding-top:10px;'><label>Email</label>
      <input type="email" name="email2" value="<?php echo $email; ?>" autocomplete="off" disabled>
	</div>
   </div>
  <div class="sub-cont" >
    <div class="first"><label>USN</label>
      <input type="text" name="usn" autocomplete="off" required>
	</div>
	<div class="second"><label>Gender</label>
	  <select name="gender">
		<option value="M">Male</option>
		<option value="F">Female</option>
	</select>
    </div>
  </div>
  <div class="sub-cont" >
  <div class="first"><label>Branch</label>
	<select name="branch">
		<option value="cse">CSE</option>
		<option value="ise">ISE</option>
		<option value="ec">EC</option>
		<option value="eee">EEE</option>
		<option value="bt">BT</option>
		<option value="mech">MECH</option>
	</select></div>
	<div class="second"><label>Semester</label>
	<select name="sem" required>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
	</select><label style="padding-left:15px;" >Section</label>
	<select name="sec">
	<option value="A">A</option>
	<option value="B">B</option>
	</select></div>
  </div>
  <div class="sub-cont">
    <div class="first"><label>Mobile No</label>
      <input type="text" name="mob" autocomplete="off" required>
	</div>
   </div>
   <div class="sub-cont">
    <div class="first"><label>Password</label>
      <input type="password" name="pass1" autocomplete="off" id="txtNewPassword" required>
	  </div>
    <div class="second"><label>Confirm Password</label>
      <input type="password" name="pass2" autocomplete="off" id="txtConfirmPassword" onchange="isPasswordMatch();" required>
<div id="divCheckPassword" ></div>

	  </div>
	  </div>
<div style="padding-top:40px;"><button type="submit" class="submit" name="submit" id="submit" >Register</button></div>
</div>
</form>
<script>
function isPasswordMatch() {
	var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword)
    {$('#divCheckPassword').html("Password do not match!");
    document.getElementById("submit").disabled=true;
	}
    else
		$('#divCheckPassword').html("Password match!");
		document.getElementById("submit").disabled=false;

	}
	$(document).ready(function () {
    $("#txtConfirmPassword").keyup(isPasswordMatch);
});
</script>

</body>

</html>