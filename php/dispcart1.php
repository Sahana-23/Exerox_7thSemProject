<?php 
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$email=$_SESSION['email'];
$branch=$_SESSION['branch'];
$sem=$_SESSION['sem'];
$no=0;
$stmt = $db->prepare("SELECT * FROM cart where email_id='".$email."'"); 
     $stmt->execute();
     $no= $stmt->rowCount();
	 
	 if($_SERVER['REQUEST_METHOD']=='POST')
     { 
	  if(isset($_POST['submit'])) 
	 { $stmt = $db->prepare("SELECT * FROM cart where email_id='".$email."'"); 
       $stmt->execute();
       while($item=$stmt->fetch(PDO::FETCH_ASSOC))
	   {   $fid=$item['f_id'];
           $qty=$item['qty'];
           $price=$qty*$item['price'];
		   $add= "INSERT INTO orders VALUES (NULL,'".$email."',$fid, $qty,$price,'pending')";
           $db->exec($add);
		   $clearcart="delete from cart where email_id='".$email."'";
		   $db->exec($clearcart);
	   }
	 }
	 }  
?>
<html>
<head>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/navigation.css">
 
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
      <li class="nav-item ">
        <a class="nav-link" href="#">My Orders</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="dispcart.php">My Cart <?php if($no > 0) { ?><span class="badge badge-light" ><?php echo "  ".$no; ?></span> <?php } ?> </a>	
      </li>

      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Subjects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
	    $sql2 = $db->prepare("SELECT sub_code FROM uploads where sem='".$sem."' and branch='".$branch."' group by sub_code"); 
       $sql2->execute();
	
       $rs2 = $sql2->fetchALL(PDO::FETCH_ASSOC);
           foreach($rs2 as $rss2)
			 {   $sub=$rss2['sub_code'];
			     echo "<a class='dropdown-item' href='av_notes.php?sc=$sub'>".$sub."</a>";
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
          <a class="dropdown-item" href="../index.php">Log Out</a>
       </div>
      </li>
      
    </ul>
    
  </div>
</nav>
</body>
</html>