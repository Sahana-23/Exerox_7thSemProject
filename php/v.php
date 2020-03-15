<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$email=$_SESSION['email'];
if(isset($_GET['sem']))
{$sem=$_GET['sem'];
$sc=$_GET['sc'];
}

if(isset($_FILES['fe'])){
	$modno=$_POST['mno'];
	   $chno=$_POST['chapno'];
	   $chname=$_POST['chapname'];
   $name=$_FILES['fe']['name'];
	   $size=$_FILES['fe']['size'];
	   $type=$_FILES['fe']['type'];
	   $tmp=$_FILES['fe']['tmp_name'];
	   $fee='upload/'.$_FILES['fe']['name'];
	   
	   $ext='C:/wamp64/www/Exerox/'.$fee;
	   $path=move_uploaded_file($tmp,$fee);
	   $data=file_get_contents($ext); 
	   
	  if($path){
	
try{
	$sql= "INSERT INTO uploads VALUES (NULL,'".$name."','".bin2hex($data)."','".$email."','".$sc."',' ".$modno." ','".$chno."','".$chname."',$sem)";
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


	 
	 $res=$db->exec($sql);
		if($res){
		?>			<?php
		}
		else
		{ 
		?>  
        <?php
}}
		catch(PDOException $e){echo "Connection failed: " . $e->getMessage();}
	}
	else
	{
		?>  
        <?php
	}
  }
?>

<html>
<head>

<link rel="stylesheet" href="../css/temp.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


<style>
#outer {
   float: left;
   width: 250px;
   overflow: hidden;
   white-space: nowrap;
   display: inline-block;
 }
 
 #left-button {
   float: left;
   width: 30px;
   text-align: center;
 }
 
 #right-button {
   float: left;
   width: 30px;
   text-align: center;
 }
 
 a {
   text-decoration: none;
   font-weight: bolder;
   color: red;
 }
 
 #inner:first-child {
   margin-left: 0;
 }
 
 label {
   margin-left: 10px;
 }
 
 .hide {
   display: none;
 }
</style>

</head>
<body>
<div class="navbar">
  <div class="dropdown">
    <button class="dropbtn"><?php echo $_SESSION['fname']; ?> <?php echo $_SESSION['lname']; ?>&#x25BE;
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="myprof.php">My Profile</a>
      <a href="../index.php">Log Out</a>
      </div>
  </div>
  <div class="dropdown">
    <button class="dropbtn"> View Students &#x25BE;
      
    </button>
    <div class="dropdown-content">
      <?php $sql = $db->prepare("SELECT sem FROM class where email_id='".$email."' group by sem order by sem asc"); 
             $sql->execute();
			 $rs = $sql->fetchALL(PDO::FETCH_ASSOC);
			     foreach($rs as $rss)
			 {   $x=$rss['sem'];
			     echo "<a href='view_students.php?sem=".$x."'>".$x."</a>";
			 }
	  
	  ?>
	        </div>
  </div>
  <a href="teacher_classes.php" class="active">Classes</a>
  <div class="vl">e-Xerox</div>  
</div>


<div id="elem">
	<ul class="menu">
	<?php $sql = $db->prepare("SELECT mod_no,chap_no,chap_name FROM uploads where sub_code='".$sc."' order by sl_no desc"); 
             $sql->execute();
			 $rs = $sql->fetchALL(PDO::FETCH_ASSOC);
			     foreach($rs as $rss)
		echo "<li class='item'><div class='itemcont'><b>Module </b>".$rss['mod_no']."<br><b>Chapter </b>".$rss['chap_no']."<br>".$rss['chap_name']."</div></li>";
		?>
	</ul>

	
<div class="fixed" onclick="document.getElementById('id01').style.display='block'"><a href="#">+</a></div>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="view_upload.php?sem=<?php echo $sem; ?>&sc=<?php echo $sc; ?>" method="post" enctype="multipart/form-data">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
</div>
    <div class="container">
      
      <input type="number" min="1" max="5" name="mno" placeholder="Module No" autocomplete="off" required>

      
      <input type="number" min="1" max="20" name="chapno" placeholder="Chapter No" autocomplete="off" required>
	  
	  
      <input type="text"  name="chapname" placeholder="Chapter Name..." autocomplete="off" required>
	  
      
      <input type="file"  name="fe" placeholder="Chapter Name..." autocomplete="off" required> 
      
   

    
      <button type="submit"  class="cancelbtn">Submit</button>
      
    </div>
  </form>
</div>


<script>
   $(function() {
       var print = function(msg) {
         alert(msg);
       };

       var setInvisible = function(elem) {
         elem.css('visibility', 'hidden');
       };
       var setVisible = function(elem) {
         elem.css('visibility', 'visible');
       };

       var elem = $("#elem");
       var items = elem.children();

       // Inserting Buttons
       elem.prepend('<div id="right-button" style="visibility: hidden;"><a href="#"><</a></div>');
       elem.append('  <div id="left-button"><a href="#">></a></div>');

       // Inserting Inner
       items.wrapAll('<div id="inner" />');

       // Inserting Outer
       debugger;
       elem.find('#inner').wrap('<div id="outer"/>');

       var outer = $('#outer');

       var updateUI = function() {
         var maxWidth = outer.outerWidth(true);
         var actualWidth = 0;
         $.each($('#inner >'), function(i, item) {
           actualWidth += $(item).outerWidth(true);
         });

         if (actualWidth <= maxWidth) {
           setVisible($('#left-button'));
         }
       };
       updateUI();



       $('#right-button').click(function() {
         var leftPos = outer.scrollLeft();
         outer.animate({
           scrollLeft: leftPos - 200
         }, 800, function() {
           debugger;
           if ($('#outer').scrollLeft() <= 0) {
             setInvisible($('#right-button'));
           }
         });
       });

       $('#left-button').click(function() {
         setVisible($('#right-button'));
         var leftPos = outer.scrollLeft();
         outer.animate({
           scrollLeft: leftPos + 200
         }, 800);
       });

       $(window).resize(function() {
         updateUI();
       });
     });
<</script>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>