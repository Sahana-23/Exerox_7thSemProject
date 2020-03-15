<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">
	<?php
	include_once 'config/dbconn.php';
    $database = new Database();
    $db = $database->getConnection();

    if(isset($_FILES['fe'])){
		
	   $name=$_FILES['fe']['name'];
	   $size=$_FILES['fe']['size'];
	   $type=$_FILES['fe']['type'];
	   $tmp=$_FILES['fe']['tmp_name'];
	   $fee='upload/'.$_FILES['fe']['name'];
	   echo $fee;
	   $ext='C:/wamp64/www/Exerox/php/'.$fee;
	   $path=move_uploaded_file($tmp,$fee);
	   $data=file_get_contents($ext); 
	   
	  if($path){
	
try{
	$sql= "INSERT INTO uploads VALUES (NULL,'".$name."','".bin2hex($data)."','x',' 5 ','1','2','xx')";
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 


	 
	 $res=$db->exec($sql);
		if($res){
		?>	<div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
	        <strong>success</strong> file uploaded
            </button>
            </div> 
		<?php
		}
		else
		{ 
		?> <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
	       <strong>failed</strong> file not uploaded
           </button>
           </div> 
        <?php
}}
		catch(PDOException $e){echo "Connection failed: " . $e->getMessage();}
	}
	else
	{
		?> <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
	      <strong>error</strong> file not uploaded
          </button>
          </div> 
        <?php
	}
  }
?>
	<form method="post" enctype="multipart/form-data">
    
  <div class="form-group">
    <label for="example">upload</label>
    <input type="file" class="form-control-file" id="example" name="fe">
	<p class="help-block">HELP</p>
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div class="row">
<?php
 $stmt=$db->prepare('select * from upload');
 $stmt->execute();
 while($row=$stmt->fetch())
 {
 
 
 
?>
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <embed src="upload/<?php echo $row['foto'] ?>" alt="not found" title="myfile"/>
      <div class="caption">
        <p><a href="#" class="btn btn-primary" role="button">Delete</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
      </div>
    </div>
  </div>
  <?php
 }
  ?>
</div>
	</div> 

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>