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

$query="select n.ord_id as id ,n.message as msg from orders o,notifications n where o.o_id=n.ord_id and o.email_id='".$email."' and o.status = 'completed' and n.status='unread' ";
$stmt2 =$db->prepare($query);
$stmt2->execute();

$stmt2c=$stmt2->rowCount();

?>
<html>
<head>

	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../css/navigation.css">
<link rel="stylesheet" href="../css/st_notes.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
     <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css'>
<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
<title>e-Xerox - <?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?></title>
</head>
<style type="text/css">
  


  .badge1 {
    
    position: absolute;
     top:0.7rem;
    right:15.4rem;
  text-align: center;
}

 .badge2 {
    
    position: absolute;
     top:0.3rem;
    right:0.3rem;
  text-align: center;
}
</style>
<body >

<nav class="navbar navbar-expand-sm ">
  <a class="navbar-brand" href="#">e-Xerox</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item ">
        <a class="nav-link" href="av_notes.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active ">
        <a class="nav-link" href="#">My Orders</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="dispcart.php"><i class="fas fa-shopping-cart" style="font-size: 30px;"></i> <?php if($no > 0) { ?><span class="badge badge1 badge-danger" ><?php echo "  ".$no; ?></span> <?php } ?> </a> 
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link " href="#" id="navbarDropdown"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-bell" style="font-size: 30px;"></i> <?php if($stmt2c>0)
            { ?><span class="badge badge2 badge-danger"> <?php echo $stmt2c; ?></span><?php } ?>
        </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
            if($stmt2c>0){
            while($rs=$stmt2->fetch() )
            {
                 $oid=$rs['id'];
                 $msg=$rs['msg'];
                echo "<a class='dropdown-item' href='viewmsg.php?id=".$oid."'>".$msg."</a>"; 
            
            }
          
           ?>
           <div class="dropdown-divider"></div>
           <?php } else { echo "<a class='dropdown-item' href='#'>No New Notifications</a>"; } ?>
         </div>
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
          
          <a class="dropdown-item" href="../index.html">Log Out</a>
       </div>
      </li>
      
    </ul>
    
  </div>
</nav> 

<h1 style="margin-left: 40px;margin-top: 40px;">Orders in Process</h1>
<div class="container" style="margin-left: 40px;margin-top: 40px;">
  <table class="table  table-hover">
   <thead class="thead-dark">
  <tr><th>Sl.no</th><th>Item</th><th>Quantity</th><th>Price</th></tr></thead>
  <?php
$sum=0; $i=0;
  $sql3 = $db->prepare("SELECT *from orders where email_id='".$email."' and status='pending'"); 
        $sql3->execute();
		while($rs=$sql3->fetch(PDO::FETCH_ASSOC))
		{   $qty=$rs['qty'];
	        $cost=$rs['price'];
			$fid=$rs['f_id'];
			
			$i++;
			 $sql4 = $db->prepare("SELECT * FROM uploads where sl_no='".$fid."'"); 
        $sql4->execute();
		$notes=$sql4->fetch(PDO::FETCH_ASSOC);
			echo "<tbody><tr><td>$i</td><td>Module:". $notes['mod_no']." Chapter ".$notes['chap_no']." : ".$notes['chap_name']."
	</td><td>$qty</td><td>$cost</td></tr></tbody>";
		}
 ?>
 </table>
 </div>

 <h1 style="margin-left: 40px;margin-top: 60px;">Orders Completed</h1>
  <div class="container" style="margin-left: 40px;margin-top: 40px">
  <table class="table table-hover">
  
   <thead class="thead-dark">
  <tr><th>Sl.no</th><th>Item</th><th>Qty</th><th>Price</th></tr></thead>
  <?php
$sum=0; $i=0;
  $sql3 = $db->prepare("SELECT *from orders where email_id='".$email."' and status='completed'"); 
        $sql3->execute();
		while($rs=$sql3->fetch(PDO::FETCH_ASSOC))
		{   $qty=$rs['qty'];
	        $cost=$rs['price'];
			$fid=$rs['f_id'];
			
			$i++;
			 $sql4 = $db->prepare("SELECT * FROM uploads where sl_no='".$fid."'"); 
        $sql4->execute();
		$notes=$sql4->fetch(PDO::FETCH_ASSOC);
			echo "<tbody><tr><td>$i</td><td>Module:". $notes['mod_no']." Chapter ".$notes['chap_no']." : ".$notes['chap_name']."
	</td><td>$qty</td><td>$cost</td></tr></tbody>";
		}
 ?>
</table>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>