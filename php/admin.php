<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();

$stmt1 = $db->prepare("SELECT * FROM orders where status='pending'"); 
$stmt1->execute();
$pending=$stmt1->rowCount();

$stmt2 = $db->prepare("SELECT * FROM orders where status='completed'"); 
$stmt2->execute();
$completed=$stmt2->rowCount();


$stmt3= $db->prepare("SELECT * FROM users "); 
$stmt3->execute();
$users=$stmt3->rowCount();


$stmt4= $db->prepare("SELECT * FROM uploads"); 
$stmt4->execute();
$notes=$stmt4->rowCount();


?>


<html>
<head>
   
     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
     <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css' integrity='sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns' crossorigin='anonymous'>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/animate.css" type="text/css">
     <link rel="stylesheet" href="../css/admin.css">
     <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
    <title>e-Xerox - Admin</title>
     <style type="text/css">
         .list-item
         {
            display:block;
         }


     </style>
</head>
<body >
  <div class="cont" style="width:100%;height: 100vh;">
<div class="logo-container">
 <a href="admin.php" class=" animated slideInLeft">   <img src="../images/logo.png" class="imagestyle  animated fadeIn""></a>

</div>

<div class="sidenav">
    <div class="list-grp">
  <a class="list-it animated slideInLeft " style="animation-delay: 1s" href="../php/students.php"><i class='fas fa-user-graduate' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Students</a>
 <a class="list-it animated slideInLeft" style="animation-delay: 1.2s" href="../php/teachers.php"><i class='fas fa-chalkboard-teacher' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;Teachers</a>
 <a class="list-it animated slideInLeft  active" style="animation-delay: 1.4s" href="../php/admin_order.php"> <i class='fas fa-shopping-cart' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Orders</a>
 <a class="list-it animated slideInLeft" style="animation-delay: 1.6s" href="../php/order_history.php"> <i class=' fas fa-history' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;History </a>
<a  class="list-it animated slideInLeft" style="animation-delay: 1.8s"href="../php/notes.php"> <i class=' far fa-file-alt' style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Notes</a>
<a  class="list-it animated slideInLeft" style="animation-delay: 2.0s" href="../index.html"> <i class="fas fa-sign-out-alt" style='font-size:20px;color:#fff;'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign Out</a>
 </div> 
</div>
<div class="main">
  
  <div class="container animated bounceInDown " style="margin-top: 50px;margin-left:50px;width: 90%;animation-delay: 2s" >
  <div class="card  rounded-0">
  <h5 class="card-header">Welcome Administrator</h5>
  <div class="card-body">
    
    <p class="card-text" style="font-size: 30px">You are currently viewing the <strong>Admin Dashboard.</strong>You can complete orders,view all-time stats and much more here.Start by making a selection from the options on your left.Have a great day.</p>
    
  </div>
</div>
</div>
<div class="stat" id="stats">
        <div class="content-box">
            
            <div class="container animated bounceInUp" id="count" style="animation-delay: 2s">
              <div class="card " style="margin-top: 50px;margin-left:50px;width: 90%;" >
                <h5 class="card-header">All-Time Stats</h5>
                <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3">

                        <div class="card-counter success">
                            <i class="  far fa-check-circle" ></i>
                            <span class="counter count-numbers"><?php echo $completed; ?></span>
                           <span class="count-name">Completed</span>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter danger">
                            <i class="  fas fa-hourglass-half" ></i>
                            <span class="counter count-numbers"><?php echo $pending; ?></span>
                           <span class="count-name">Pending</span>
                            
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card-counter info">
                            <i class=" fas fa-user-friends"></i>
                            <span class="counter count-numbers"><?php echo $users; ?></span>
                            <span class="count-name">Users</span>
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-counter primary">
                            <i class="far fa-file-alt"></i>
                            <span class="counter count-numbers"><?php echo $notes; ?></span>
                            <span class="count-name">Notes</span>
                            
                        </div>
                    </div>
                   </div>
                  </div>
                </div>
            </div>
    </div>
    
</div>

</div>
</div>
<script type="text/javascript">
      $('.counter').each(function() {
        $(this).prop('Counter',0).animate({
          Counter:$(this).text()
        },{
          duration:8000,
          easing:'swing',
          step:function (now){
            $(this).text(Math.ceil(now));
          },
        });
      });
        </script>



</body>
</html>
