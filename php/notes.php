 <html>
<head>

     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
     <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.2/css/all.css'>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/animate.css" type="text/css">
      <link rel="stylesheet" href="../css/admin.css">
      <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon.png">
    <title>e-Xerox - Admin</title>
     

</head>
<body>
<div class="logo-container">
 <a href="admin.php" class=" animated slideInLeft">   <img src="../images/logo.png" class="imagestyle  animated fadeIn""></a>

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
<div class="main" style="margin-left: 300px;">
	<div class="container animated fadeIn" style="margin-top: 50px;animation-delay: 2s" >
		<form class="form-inline ">
		
    <div class="form-group mb-2">
      <select name="state" id="maxRows" class="form-control" style="width:200px;">
      	<option value="" selected disabled>Number of Rows</option>
        <option value="5000">Show All</option>
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="15">15</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
        <option value="60">60</option>
        <option value="70">70</option>
        <option value="80">80</option>
        <option value="100">100</option>
      </select>
    </div>
    <div class="form-group  mb-2 mx-auto">
      <input type="text" name="search" id="search" class="form-control" placeholder="Search Table" style="width:200px;">
  </div>
</form>
    </div>
	<div class="table-responsive">
	<table id="mytable" class="table animated fadeIn" style="margin-top: 60px;width:90%;animation-delay: 2s">
      <thead class="thead-dark">
        <tr>
         
            <th class="align-middle">Filename</th>
            <th class="align-middle">Subcode</th>
            <th class="align-middle">Module</th>
            <th class="align-middle">Chapter</th>
            <th class="align-middle">Name</th>
            <th class="align-middle">Sem</th>
            <th class="align-middle">Branch</th>
            <th class="align-middle">Action</th>
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
                     
                      <td><?php echo $row['f_name']?></td>
                      <td><?php echo $row['sub_code']?></td>
                      <td><?php echo $row['mod_no']?></td>
                      <td><?php echo $row['chap_no']?></td>
                      <td><?php echo $row['chap_name']?></td>

                      <td><?php echo $row['sem']?></td>
                      <td><?php echo $row['branch']?></td>
                      <td class="text-center"><a href="downloadpdf.php?sl_no=<?php echo $row['sl_no']?>" class=" btn btn-outline-primary " role="button"><i class="fas fa-file-download" style="font-size: 30px;"></i></a></td>
                    </tr>
                    <?php
                   }

          ?>
         </tbody>
</table>
</div>
</div>
<div class="pagination-container " >
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center">
             
    
          </ul>
        </nav>
      </div>
    </div>

</div>

<script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>


<script type="text/javascript">
      var table='#mytable'
      $('#maxRows').on('change',function()
      {
        $('.pagination').html('')
        var trnum = 0
        var maxRows = parseInt($(this).val())
        var totalRows= $(table+' tbody tr').length
        $(table+ ' tr:gt(0) ').each(function(){
          trnum++
          if(trnum > maxRows){
            $(this).hide()
          }
          if(trnum <= maxRows){
            $(this).show()
          }
        })
        if(totalRows > maxRows){
          var pagenum=Math.ceil(totalRows/maxRows)
          
          for(var i=1;i<=pagenum;){
            $('.pagination').append('<li class = "page-item" data-page="'+i+'"><a class="page-link" href="#">'+ i++ +'<span class="sr-only">(current)</span></a></li>').show()
          }
           
        }
        $('.pagination li:first-child').addClass('active')
        $('.pagination li').on('click',function(){
          var pageNum = $(this).attr('data-page')
          var trIndex =0;
          $('.pagination li').removeClass('active')
          $(this).addClass('active')
          $(table+' tr:gt(0)').each(function(){
            trIndex++
            if(trIndex > (maxRows*pageNum)|| trIndex <= ((maxRows* pageNum)-maxRows)){
                 $(this).hide()
            }
            else{
              $(this).show()
            }
          })

        })
      })
      $(function(){
        $('table tr:eq(0)').prepend('<th>ID</th>')
        var id =0;
        $('table tr:gt(0)').each(function(){
          id++
          $(this).prepend('<td>'+id+'</td>')
        })
      })
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#search').keyup(function(){
          search_table($(this).val());

        });
        function search_table(value){
          $('#mytable tbody tr ').each(function(){
            var found='false';
            $(this).each(function(){
              if($(this).text().toLowerCase().indexOf(value.toLowerCase())>=0) 
              {
                 found='true';

              }
            });
            if(found == 'true')
            {
              $(this).show();
            }
            else
            {
              $(this).hide();
            }
          });
        }

      });
    </script>
</body>
</html>