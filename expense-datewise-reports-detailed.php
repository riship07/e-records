<?php
  session_start();
  error_reporting(0);
  include('includes/dbconnection.php');
  include_once('fpdf/fpdf.php');
  if (strlen($_SESSION['detsuid'])==0) {
	header('location:logout.php');
	}else{
		if(isset($_POST['gett'])){
							
			 
			class PDF extends FPDF
			{
			
			function Header()
			{
				$this->SetFont('Arial','B',13);
				$this->Cell(80);
			    $this->Cell(80,10,'Report',1,0,'C');
			    $this->Ln(20);
			}
			 
		   function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
			    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}
			}
			$fdate=$_POST['fromdate'];
			$tdate=$_POST['todate'];
			$rtype=$_POST['requesttype']; 
			
			$display_heading = array('ID'=>'ID', 'ExpenseDate'=> 'Date','ExpenseCost'=> 'Cost',);
			$userid=$_SESSION['detsuid'];
			$result=mysqli_query($con,"SELECT ExpenseDate,SUM(ExpenseCost) as totaldaily FROM `tblexpense`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') group by ExpenseDate");
			$header = mysqli_query($con, "SHOW columns FROM tblexpense");
			 
			$pdf = new PDF();
		
			$pdf->AddPage();
		
			$pdf->AliasNbPages();
			$pdf->SetFont('Arial','B',12);
			foreach($header as $heading) {
			 $pdf->Cell(40,12,$display_heading[$heading['Field']],0);
			}
			$rr=1;
			while ($row=mysqli_fetch_assoc($result)) {
				$pdf->Cell(40,12,$rr,1);
				$pdf->Cell(40,12,$row['ExpenseDate'],1);
			    $pdf->Cell(40,12,$row['totaldaily'],1);
				$rr=$rr+1;
			}
			$pdf->Output();
		}
	?>
	

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Datewise Expense Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	
</head>
<body>
	<?php include_once('includes/header.php');?>
	<?php include_once('includes/sidebar.php');?>
	
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Datewise Expense Report</li>
			</ol>
			<form method="POST"	action="" >
				<div class="form-group has-success">
					<button type="submit" class="btn btn-primary" name="gett">Generate Pdf</button>
				</div>
								
	      </form>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Datewise Expense Report</div>
					<div class="panel-body">

						<div class="col-md-12">
					
<?php
$fdate=$_POST['fromdate'];
 $tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<h5 align="center" style="color:blue">Datewise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <tr>
              <th>S.NO</th>
              <th>Date</th>
              <th>Expense Amount</th>
			  <th>View All</th>
                </tr>
                                        </tr>
                                        </thead>
 <?php
$userid=$_SESSION['detsuid'];
$ret=mysqli_query($con,"SELECT ExpenseDate,SUM(ExpenseCost) as totaldaily FROM `tblexpense`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') group by ExpenseDate");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
              
                <tr>
                  <td><?php echo $cnt;?></td>
            
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><?php  echo $ttlsl=$row['totaldaily'];?></td>
                  <td><a href="view_all.php?date=<?php echo $row['ExpenseDate']; ?>">View</a></td>
           
                </tr>
                <?php
                $totalsexp+=$ttlsl; 
$cnt=$cnt+1;
}?>

 <tr>
  <th colspan="2" style="text-align:center">Grand Total</th>     
  <td><?php echo $totalsexp;?></td>
 </tr>     

                                    </table>




						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
			<?php include_once('includes/footer.php');?>
		</div><!-- /.row -->
	</div><!--/.main-->
	
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
<?php } ?>