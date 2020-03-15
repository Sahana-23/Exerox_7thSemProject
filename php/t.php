<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();

$email=$_SESSION['email'];
$email=$_SESSION['email'];
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/temp.css">
 <link href='https://fonts.googleapis.com/css?family=Croissant One' rel='stylesheet'>
</head>
<body>

<div class="navbar">
  <div class="dropdown">
    <button class="dropbtn"><?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?>&#x25BE;
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">View Profile</a>
      <a href="#">Log Out</a>
      </div>
  </div>
  <a href="#home">View Members</a>
  <a href="#news" class="active">Classes</a>
  <div class="vl">e-Xerox</div>  
</div>
<?php
$stmt1 = $db->prepare("SELECT sem FROM class where email_id='".$email."' group by sem order by sem asc"); 
         $stmt1->execute();
		 $res1 = $stmt1->fetchALL(PDO::FETCH_ASSOC);
		 
		 foreach($res1 as $row)
		 {   $s=$row['sem'];
			 $stmt2 = $db->prepare("SELECT sub_code,sub_name FROM class where email_id='".$email."' and sem='".$s."'  order by sem asc"); 
             $stmt2->execute();
			 $res2 = $stmt2->fetchALL(PDO::FETCH_ASSOC);
			
		     foreach($res2 as $rows)
			 { 
				 echo $rows['sub_code']." ".$rows['sub_name']."<br>";
				
			 }
			 
		 }
		 
?>
<div class="fixed"><a href="add_class.php">+</a></div>
</body>
</html>