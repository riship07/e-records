<?php
session_start();

include('includes/dbconnection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker - Data</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="css/bootstrap-chart.css" rel="stylesheet">
	
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
  
      
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<i class="fas fa-"></i>
				</a></li>
				<li class="active">Records</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Records</h1>
			</div>
		</div><!--/.row-->
    
	    
		<div class="row">
			<div class="col-lg-12">
			        <?php
					 if(isset($_GET['date'])){
					    $dat=$_GET['date'];
                        echo "<div class='panel-heading'>Expenses of  => $dat</div>";
					 }
					 elseif(isset($_GET['month'],$_GET['year'])){
						 $mont=$_GET['month'];
						 $yar=$_GET['year'];

						 echo "<div class='panel-heading'>Expenses of   => $mont - $yar</div>";
					 }
					   ?>
					
				
				
					
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							
			<div class="table-responsive">
            <table class="table table-bordered mg-b-0">
              <thead>
                <tr>
                  <th>S.NO</th>
                  <th>Expense Item</th>
                  <th>Expense Cost</th>
                  <th>Expense Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <?php
              $userid=$_SESSION['detsuid'];
			if(isset($_GET['date'])){
              $datee=$_GET['date'];
				$ret=mysqli_query($con,"select * from tblexpense where UserId='$userid' && ExpenseDate='$datee'");
				$cnt=1;
			}
			elseif(isset($_GET['month'],$_GET['year'])){
				$month=$_GET['month'];
				$year=$_GET['year'];
				$ret=mysqli_query($con,"select * from tblexpense where UserId='$userid' && month(ExpenseDate)='$month' && year(ExpenseDate)='$year'");
				$cnt=1;
			}
            while ($row=mysqli_fetch_array($ret)) {

?>
              <tbody>
                <tr>
                  <td><?php echo $cnt;?></td>
              
                  <td><?php  echo $row['ExpenseItem'];?></td>
                  <td><?php  echo $row['ExpenseCost'];?></td>
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><a href="manage-expense.php?delid=<?php echo $row['ID'];?>">Delete</a>
                </tr>
                <?php 
$cnt=$cnt+1;
}?>
               
              </tbody>
            </table>
          </div>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->



  	
		
	<?php include_once('includes/footer.php');?>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
		
</body>
</html>
