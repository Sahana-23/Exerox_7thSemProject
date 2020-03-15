<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
   
    <link rel="stylesheet" href="../css/animate.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" >
   <link rel="stylesheet" href="../css/admin.css"> 
   <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
    <title>e-Xerox - Admin</title>
    
    <style type="text/css">
       .card-text
    {
      font-size: 20px;
    }
    .card-header
    {
      font-size: 30px;
    }
    body
    {
      overflow-x: hidden;
    }
    </style>
   
  </head>
  <body >
    <div class="logo-container">
 <a href="admin.php" class=" animated slideInLeft">   <img src="../images/logo.png" class="imagestyle  animated fadeInLeft"></a>

</div>

<div class="sidenav">
    <div class="list-grp">
  <a class="list-it animated slideInLeft" style="animation-delay: 1s" href="../php/students.php"><i class='fas fa-user-graduate' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Students</a>
 <a class="list-it animated slideInLeft" style="animation-delay: 1.2s" href="./php/teachers.php"><i class='fas fa-chalkboard-teacher' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;Teachers</a>
 <a class="list-it animated slideInLeft  active" style="animation-delay: 1.4s" href="../php/admin_order.php"> <i class='fas fa-shopping-cart' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orders</a>
 <a class="list-it animated slideInLeft" style="animation-delay: 1.6s" href="../php/order_history.php"> <i class=' fas fa-history' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;History </a>
<a  class="list-it animated slideInLeft" style="animation-delay: 1.8s"href="../php/notes.php"> <i class=' far fa-file-alt' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notes</a>
<a  class="list-it animated slideInLeft" style="animation-delay: 2.0s" href="../index.html"> <i class="fas fa-sign-out-alt" style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign Out</a>
 </div> 
</div>
<div class="main">
  <div class="container" style="margin-left: 45px;">
    <div class="row">

      <?php
      include_once '../config/dbconn.php';
      $database = new Database();
      $db = $database->getConnection(); 
     $sql = $db->prepare("SELECT * FROM teacher"); 
    $sql->execute();
       $rs = $sql->fetchALL(PDO::FETCH_ASSOC);
      foreach($rs as $rss) { ?>
      <div class="col col-md-4">
      <div class="card border border-info animated fadeIn" style="width:19rem;margin-top: 50px;animation-delay: 2s">
      <div class="card-header">
   <?php echo $rss['fname'].' '.$rss['lname'] ?>
  </div>
  <div class="card-body">
  <p class="card-text "><i class="fas fa-user-check"></i>&nbsp;<?php echo $rss['empid'] ?></p>
    <p class="card-text"><i class="fas fa-envelope">&nbsp;</i><?php echo $rss['email_id'] ?></p>
   <p class="card-text"> <i class="fas fa-phone">&nbsp;</i><?php echo $rss['Mob_no'] ?></p>
  </div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</body>
</html>