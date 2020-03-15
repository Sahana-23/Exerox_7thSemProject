<?php
session_start();
include_once '../config/dbconn.php';
$database = new Database();
$db = $database->getConnection();
$email=$_SESSION['email'];
$branch=$_SESSION['branch'];
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
	   $fee='uploads/'.$_FILES['fe']['name'];
	   
	   $ext='C:/wamp64/www/exerox/php/'.$fee;
	   $path=move_uploaded_file($tmp,$fee);
	   $data=file_get_contents($ext); 
	   
	  if($path){
	
try{
	$sql= "INSERT INTO uploads VALUES (NULL,'".$name."','".bin2hex($data)."','".$email."','".$sc."',' ".$modno." ','".$chno."','".$chname."',$sem,'".$branch."',10,5)";
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


<link rel="stylesheet" href="../css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
   
    <link rel="stylesheet" href="../css/navigation.css">
    <link rel="stylesheet" href="../css/view_upload.css">
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
      <li class="nav-item ">
        <a class="nav-link" href="teacher_classes.php">Home<span class="sr-only">(current)</span></a>
      </li>


      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          View Classes
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



<div class="container" style="margin-top:50px;">
    <div class="row" style="margin-top: 40px;">
    	<?php $sql = $db->prepare("SELECT mod_no,chap_no,chap_name FROM uploads where sub_code='".$sc."' order by sl_no desc"); 
             $sql->execute();
			 $rs = $sql->fetchALL(PDO::FETCH_ASSOC);
			     foreach($rs as $rss) { ?>
        <div class="col-md-4" style="margin-top: 40px;">
        <!--Card-->
            <div class="card text-white bg-dark">
                <!--Card image-->
                <img class="img-fluid" src="../images/nb.png" alt="Card image cap">
            
                <!--Card content-->
                <div class="card-body">
                    <!--Title-->
                    <h4 class="card-title"><?php echo $rss['chap_name'] ?></h4>
                    <!--Text-->
                    <p class="card-text">Module : <?php echo $rss['mod_no'] ?></p>
                    <p class="card-text">Chapter : <?php echo $rss['chap_no'] ?></p>
                </div>
            </div>
        <!--/.Card-->
        </div>
    <?php } ?>
    </div>
</div>




<div class="fix" id="myBtn"><a href="#">+</a></div>

<div id="myModal" class="mod">

  <!-- Modal content -->
  <div class="modalcontent">
    <div class="modalheader">
      <span class="close">&times;</span>
      <h2>Upload Notes</h2>
    </div>
    <div class="modalbody">
    <form  action="view_upload.php?sem=<?php echo $sem; ?>&sc=<?php echo $sc; ?>" method="post" enctype="multipart/form-data">
  
      <input type="number" min="1" max="5" name="mno" placeholder="Module No" autocomplete="off" required>

      
      <input type="number" min="1" max="20" name="chapno" placeholder="Chapter No" autocomplete="off" required>
	  
	  
      <input type="text"  name="chapname" placeholder="Chapter Name..." autocomplete="off" required>
	  
 
      <input type="file"  name="fe"  accept="application/pdf"  autocomplete="off" required> 
      
   

    
      <input type="submit" >
 </form>
    </div>
    
  </div>

</div>




<script>
// duration of scroll animation
var scrollDuration = 600;
// paddles
var leftPaddle = document.getElementsByClassName('left-paddle');
var rightPaddle = document.getElementsByClassName('right-paddle');
// get items dimensions
var itemsLength = $('.item').length;
var itemSize = $('.item').outerWidth(true);
// get some relevant size for the paddle triggering point
var paddleMargin = 20;

// get wrapper width
var getMenuWrapperSize = function() {
	return $('.menu-wrapper').outerWidth();
}
var menuWrapperSize = getMenuWrapperSize();
// the wrapper is responsive
$(window).on('resize', function() {
	menuWrapperSize = getMenuWrapperSize();
});
// size of the visible part of the menu is equal as the wrapper size 
var menuVisibleSize = menuWrapperSize;

// get total width of all menu items
var getMenuSize = function() {
	return itemsLength * itemSize;
};
var menuSize = getMenuSize();
// get how much of menu is invisible
var menuInvisibleSize = menuSize - menuWrapperSize;

// get how much have we scrolled to the left
var getMenuPosition = function() {
	return $('.menu').scrollLeft();
};

// finally, what happens when we are actually scrolling the menu
$('.menu').on('scroll', function() {

	// get how much of menu is invisible
	menuInvisibleSize = menuSize - menuWrapperSize;
	// get how much have we scrolled so far
	var menuPosition = getMenuPosition();

	var menuEndOffset = menuInvisibleSize - paddleMargin;

	// show & hide the paddles 
	// depending on scroll position
	if (menuPosition <= paddleMargin) {
		$(leftPaddle).addClass('hidden');
		$(rightPaddle).removeClass('hidden');
	} else if (menuPosition < menuEndOffset) {
		// show both paddles in the middle
		$(leftPaddle).removeClass('hidden');
		$(rightPaddle).removeClass('hidden');
	} else if (menuPosition >= menuEndOffset) {
		$(leftPaddle).removeClass('hidden');
		$(rightPaddle).addClass('hidden');
}

	// print important values
	$('#print-wrapper-size span').text(menuWrapperSize);
	$('#print-menu-size span').text(menuSize);
	$('#print-menu-invisible-size span').text(menuInvisibleSize);
	$('#print-menu-position span').text(menuPosition);

});

// scroll to left
$(rightPaddle).on('click', function() {
	$('.menu').animate( { scrollLeft: menuInvisibleSize}, scrollDuration);
});

// scroll to right
$(leftPaddle).on('click', function() {
	$('.menu').animate( { scrollLeft: '0' }, scrollDuration);
});
</script>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</script>
</body>
</html>