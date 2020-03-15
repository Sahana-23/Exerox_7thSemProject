<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();

$email=$_SESSION['email'];
$stmt=$db->prepare("select * from teacher where email_id='".$email."'");
$stmt->execute();
$r = $stmt->fetchALL(PDO::FETCH_ASSOC);
foreach($r as $rs)
{
	$eno=$rs['empid'];
		$fname=$rs['fname'];
	$lname=$rs['lname'];
	$gn=$rs['gender'];
	$mob=$rs['Mob_no'];
}
if($_SERVER['REQUEST_METHOD']=='POST'){
 if(isset($_POST['submit'])){
	 
	 $fname=$_POST['fname'];
	 $lname=$_POST['lname'];
	 $gender=$_POST['gender'];
	 $mob=$_POST['mob'];
  	$stmt1=$db->prepare("update teacher set fname='".$fname."',lname='".$lname."',gender='".$gender."',Mob_no='".$mob."' where email_id='".$email."'");
$stmt1->execute();
$_SESSION['fname']=$fname;
$_SESSION['lname']=$lname;
 }
}
?>

<html>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/navigation.css">
<link rel="stylesheet" href="../css/temp.css">

<link rel="stylesheet" href="../css/profile.css">
<link href='https://fonts.googleapis.com/css?family=Croissant One' rel='stylesheet'>
 <link href='https://fonts.googleapis.com/css?family=Old Standard TT' rel='stylesheet'>
 <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link href='https://fonts.googleapis.com/css?family=PT Serif' rel='stylesheet'>
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
<title>e-Xerox - <?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?></title>

<body>
<nav class="navbar navbar-expand-sm ">
  <a class="navbar-brand" href="#">e-Xerox</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="teacher_classes.php">Home<span class="sr-only">(current)</span></a>
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          View Students
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php $sql = $db->prepare("SELECT sem FROM class where email_id='".$email."' group by sem order by sem asc"); 
             $sql->execute();
             $rs = $sql->fetchALL(PDO::FETCH_ASSOC);
                 foreach($rs as $rss)
             {   $x=$rss['sem'];
                 echo "<a class='dropdown-item' href='view_students.php?sem=".$x."'>".$x."</a>";
             }
      
      ?>
       </div>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="myprof.php">My Profile</a>
          <a class="dropdown-item" href="../index.html">Log Out</a>
       </div>
      </li>
      
    </ul>
    
  </div>
</nav>
<div class="left img">
a
</div>
<div class="right">
<div class="box">
<h2><i>Hi,<?php echo " ".$fname." ".$lname; ?> </i> </h2>
<form method="post">
<div>
<label>Email ID</label>
<input type="text" name="email" autocomplete="off" value="<?php echo $email; ?>" disabled>
</div>

<div>
<label>Employee Number</label>
<input type="text" name="empno" autocomplete="off" value="<?php echo $eno; ?>" disabled required>
</div>

<div>
<label>First Name</label>
<input type="text" name="fname" autocomplete="off" value="<?php echo $fname; ?>" required>
</div>

<div>
<label>Last Name</label>
<input type="text" name="lname" autocomplete="off" value="<?php echo $lname; ?>" required>
</div>

<div>
<label>Gender</label>
<select name="gender" required>
<option value="F" <?php if($gn=='F') echo "selected"; ?> >Female</option>
<option value="M" <?php if($gn=='M') echo "selected"; ?> >Male</option>
</select>
</div>

<div>
<label>Mobile No</label>
<input type="text" name="mob" autocomplete="off" value="<?php echo $mob; ?>" required>
</div>

<div>
<button type="submit" name="submit" >Submit </button>
</div>
</form>
</div>
</div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
