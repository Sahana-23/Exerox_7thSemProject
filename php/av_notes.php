<?php 
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$email=$_SESSION['email'];
$branch=$_SESSION['branch'];



$sql = $db->prepare("SELECT sem FROM student where email_id='".$email."'"); 
$sql->execute();
$rs = $sql->fetchALL(PDO::FETCH_ASSOC);
foreach($rs as $rss)
			 {   $sem=$rss['sem'];
			     $_SESSION['sem']=$sem;
			 }

$sql2 = $db->prepare("SELECT sub_code FROM uploads where sem='".$sem."' and branch='".$branch."' group by sub_code"); 
$sql2->execute();
$data = $sql2->fetch( PDO::FETCH_ASSOC );
$defaultsub=$data['sub_code'];



if(isset($_GET['sc'])) 
{$dispsub=$_GET['sc'];
}
else
{
	$dispsub=$defaultsub;
}

$sql3 = $db->prepare("SELECT sub_name FROM class where sub_code='".$dispsub."'"); 
$sql3->execute();
$rs3= $sql3->fetch( PDO::FETCH_ASSOC );
$subname=$rs3['sub_name'];
$no=0;
$stmt = $db->prepare("SELECT * FROM cart where email_id='".$email."'"); 
     $stmt->execute();
     $no= $stmt->rowCount();
$query="select n.ord_id as id ,n.message as msg from orders o,notifications n where o.o_id=n.ord_id and o.email_id='".$email."' and o.status = 'completed' and n.status='unread' ";
$stmt2 =$db->prepare($query);
$stmt2->execute();

$stmt2c=$stmt2->rowCount();



$stmt = $db->prepare("SELECT * FROM cart where email_id='".$email."'"); 
     $stmt->execute();
     $no= $stmt->rowCount();
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
  if(isset($_POST['submit'])) 
{    $fid=$_POST['id'];
     $price=$_POST['price'];
   $qty=$_POST['qty'];
     $sql5= "INSERT INTO cart VALUES ('".$email."',".$fid.", $qty,($qty*$price))";
     $db->exec($sql5); 
  header("location: av_notes.php"); 
   
}
}


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
</head>
<body >

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
        <a class="nav-link" href="orders.php">My Orders</a>
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
                echo "<a class='dropdown-item' href='viewmsg.php?id=".$oid."'>Order id:".$oid.$msg."</a>"; 
            
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
           echo "<a class ='dropdown-item' href='av_notes.php?sc=$sub'>".$sub."</a>";
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

<?php
$sql4 = $db->prepare("SELECT sl_no,mod_no,chap_no,chap_name,price FROM uploads where sub_code='".$dispsub."' and branch='".$branch."' order by sl_no desc"); 
             $sql4->execute();

			 $cnt= $sql4->rowCount();
?>	
	
<div class="grid-container">
<div class="grid-item first"><?php echo $subname; ?></div>
<?php $i=0; 
while($rs4 = $sql4->fetch(PDO::FETCH_ASSOC))
{   
	if($i%4==0 && $i>0) {echo "<div class='grid-item first'></div>"; } ?>
 <div class="grid-item">
<div class="card">
<form action="av_notes.php" method="post">
    <h1><?php echo $rs4['chap_name'];?></h1>
  <p class="price"><?php echo "&#8377; ".$rs4['price']; ?></p>
  <p><?php echo "Module ".$rs4['mod_no']; ?></p>
  <p><?php echo "Chapter ".$rs4['chap_no']; ?></p>
  <input type="number" name="qty" min="1" max="20" value="1" style="width:40%;border-radius: 2px"/>
  <input type="hidden" name="id" value="<?php echo $rs4['sl_no']; ?>" />
  <input type="hidden" name="price" value="<?php echo $rs4['price']; ?>" />
  <p><button type="submit" name="submit" style="margin-top: 25px;"><i class="fas fa-cart-plus" style="font-size: 40px;"></i></button></p></form>
</div>
</div>
<?php $i++; } ?>
</div>





   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>