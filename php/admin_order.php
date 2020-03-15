<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
 $stmt = $db->prepare("SELECT f_id FROM orders where status='pending' group by f_id"); 
       $stmt->execute();
    


?>


<html>
<head>
    <link rel="stylesheet" href="../css/admin.css">
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
     <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css'>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="../css/animate.css">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
    <title>e-Xerox - Admin</title>
     <style type="text/css">
         .list-item
         {
            display:block;
         }

         .container
         {
          margin-left: 50px;
         }
     </style>
</head>
<body>
<div class="logo-container">
 <a href="admin.php" class=" animated slideInLeft">   <img src="../images/logo.png" class="imagestyle  animated fadeIn""></a>

</div>

<div class="sidenav">
    <div class="list-grp">
  <a class="list-it animated slideInLeft" style="animation-delay: 1s" href="../php/students.php"><i class='fas fa-user-graduate' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Students</a>
 <a class="list-it animated slideInLeft" style="animation-delay: 1.2s" href="../php/teachers.php"><i class='fas fa-chalkboard-teacher' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;Teachers</a>
 <a class="list-it animated slideInLeft  active" style="animation-delay: 1.4s" href="../php/admin_order.php"> <i class='fas fa-shopping-cart' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orders</a>
 <a class="list-it animated slideInLeft" style="animation-delay: 1.6s" href="../php/order_history.php"> <i class=' fas fa-history' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;History </a>
<a  class="list-it animated slideInLeft" style="animation-delay: 1.8s"href="../php/notes.php"> <i class=' far fa-file-alt' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notes</a>
<a  class="list-it animated slideInLeft" style="animation-delay: 2.0s" href="../index.html"> <i class="fas fa-sign-out-alt" style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign Out</a>
 </div> 
</div>
<div class="main">
  <div class="container animated fadeIn" style="margin-top :33px;animation-delay: 2s">
    
   <div class="table-responsive">
    <table id="mytable" class="table table-bordered   table-hover animated fadeIn" style="margin-top: 40px;width:90%;animation-delay: 2s">
      <thead class="thead-dark">
        <tr>
          
        
          <th>File Name</th>
          <th>Order ID</th> 
          <th>Quantity</th>
          <th>Price</th>
          <th>Action</th>  
          <th>Status</th>       
        </tr>
      </thead>
      <tbody>
    <?php
       while($row=$stmt->fetch())
         {
           $fid=$row['f_id'];
            $stmt2 = $db->prepare("SELECT f_name FROM uploads where sl_no= '".$fid."'"); 
       $stmt2->execute();
      $fn=$stmt2->fetch(PDO::FETCH_ASSOC);
      $fname=$fn['f_name'];
        

        
    ?>
    <tr>
      <td><?php echo $fname; ?></td>
         <td><?php
         $qty=0;
         $total=0;
         $str="";
         $stre="";
               $stmt3 = $db->prepare("SELECT o_id,qty,price FROM orders where f_id= '".$fid."' and status='pending'"); 
       $stmt3->execute();
         while($rs=$stmt3->fetch())
         {
          $oid=$rs['o_id'];
          $str=$str.$oid.'|';
          
            $qty=$rs['qty']+$qty;   
            $total=$rs['price']+$total;   

          echo $oid." | "; } 
          ?></td>
        <td><?php echo $qty; ?></td>
        <td><?php echo $total; ?></td>
        <td><a href="viewpdf.php?id=<?php echo $fid; ?>"  class="btn btn-primary" target="_blank"><i class="fas fa-print"></i></a></td>
        <td><a href="update_orders.php?orlist=<?php echo $str; ?>" class="btn btn-primary"><i class="fas fa-check"></i></a></td>
        
      </tr>
       <?php } ?>
      </tbody>
        </table>
      </div>
      
      </div>
    </div>
      
</div>



</body>
</html>
