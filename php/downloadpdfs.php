<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
   

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body>
  <div class="container">

    <table id="mytable" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
            <th>filename</th>
            <th>subcode</th>
            <th>module num</th>
            <th>Chapter num</th>
            <th>name</th>
            <th>sem</th>
            <th>action</th>
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
                      <td class="text-center"><a href="downloadpdf.php?sl_no=<?php echo $row['sl_no']?>" class="btn btn-primary" role="button">Download</a></td>
                    </tr>
                    <?php
                   }

          ?>
         </tbody>
</table>
</div>
<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.table').DataTable();
  })
</script>

</body>