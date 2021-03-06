<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$branch=$_SESSION['branch'];
$email=$_SESSION['email'];
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

 <link href='https://fonts.googleapis.com/css?family=Croissant One' rel='stylesheet'>
 <link href='https://fonts.googleapis.com/css?family=Old Standard TT' rel='stylesheet'>
 <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
 <link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/navigation.css">
        <link rel="stylesheet" href="../css/temp.css">
        <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
    <title>e-Xerox - <?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?></title>
</head>
<body>


    <nav class="navbar navbar-expand-sm ">
  <a class="navbar-brand" href="#">e-Xerox</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home<span class="sr-only">(current)</span></a>
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



<?php
$stmt1 = $db->prepare("SELECT sem FROM class where email_id='".$email."' group by sem order by sem asc"); 
         $stmt1->execute();
		 $res1 = $stmt1->fetchALL(PDO::FETCH_ASSOC);
		 echo "<div class='grid-container'>";
		 foreach($res1 as $row)
		 {   
		     echo "<div class='grid-item'>";
			 echo "<div class='round'>";
			 $s=$row['sem'];
			 echo $s.' Sem';
			echo "</div>";
			 $stmt2 = $db->prepare("SELECT sub_code,sub_name FROM class where email_id='".$email."' and sem='".$s."'  order by sem asc"); 
             $stmt2->execute();
			 $res2 = $stmt2->fetchALL(PDO::FETCH_ASSOC);
		     foreach($res2 as $rows)
			 {  echo "<div class='square'>";
				 echo " &#9726; <a href='view_upload.php?sem=$s&sc=".$rows['sub_code']."' >".$rows['sub_name']." (".$rows['sub_code'].")</a><br>";
				 echo "</div>";
			 }
			 echo "</div>"; 
		 }
		 echo "</div>";  
?>
<div class="fix"><a href="add_class.php">+</a></div>



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>