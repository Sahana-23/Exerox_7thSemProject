<!DOCTYPE html>
<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$stmt1 = $db->prepare("SELECT * FROM teacher "); 
         $stmt1->execute();
     $res= $stmt1->fetchALL(PDO::FETCH_ASSOC);

?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.flip-card {
  background-color: transparent;
  width: 200px;
  height: 200px;
  perspective: 1000px;

}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color: #bbb;
  color: black;
  z-index: 2;
}

.flip-card-back {
  background-color: #2980b9;
  color: white;
  transform: rotateY(180deg);
  z-index: 1;
}
</style>
</head>
<body>

<?php foreach($res as $rows)
{
  $emp_id=$rows['empid'];
  $fname=$rows['fname'];  
  $lname=$rows['lname'];  
  $dept=$rows['dept'];
?>

<div class="flip-card">
  <div class="flip-card-inner">
    <div class="flip-card-front">
      <i>
      <h1><?php echo $fname." ".$lname; ?></h1>
    </div>
    <div class="flip-card-back">
      <h1><?php echo $emp_id ?></h1> 
      <p><?php echo $dept ?></p> 
      
    </div>
  </div>
</div>
<?php }?>
</body>
</html>
