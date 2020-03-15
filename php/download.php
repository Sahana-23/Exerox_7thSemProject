<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>download</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">

	</head>
	<body>
		<div class="container" style="margin-top: 35px">
			<table class="table table-dark">
				 <thead>
				 	<tr>
				 		<th scope="col">ID</th>
				 		<th scope="col">Filename</th>
				 		<th scope="col">Subject Code</th>
				 		<th scope="col">Module</th>
				 		<th scope="col">Chapter num</th>
				 		<th scope="col">Chapter Name</th>
				 		<th scope="col">Semester</th>
				 		<th scope="col">Action</th>
				 	</tr> 
				 </thead>
				 <tbody>
				 	<?php
                    session_start();
                     include_once '../config/dbconn.php';
                     $database = new Database();
                    $db = $database->getConnection();
                     $stmt=$db->prepare("select * from uploads order by sl_no desc");
                     $stmt->execute();
                     while($row=$stmt->fetch())
                   {
                   	?>
                   	<tr>
                   		<td><?php echo $row['sl_no']?></td>
                   		<td><?php echo $row['f_name']?></td>
                   		<td><?php echo $row['sub_code']?></td>
                   		<td><?php echo $row['mod_no']?></td>
                   		<td><?php echo $row['chap_no']?></td>
                   		<td><?php echo $row['chap_name']?></td>
                   		<td><?php echo $row['sem']?></td>
                   		<td class="text-center"><a href="downloadpdf.php?sl_no=<?php echo $row['sl_no']?>" class="btn btn-primary">Download</a></td>/ 
                   	</tr>
                   	<?php
                   }

				 	?>
				 </tbody>
			</table>
		</div>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</body>
</html>