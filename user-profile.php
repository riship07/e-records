<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid'])==0) {
  header('location:logout.php');
  } else{
	  
    if(isset($_POST['update']))
  {
	
    $userid=$_SESSION['detsuid'];
    $fullname=$_POST['fullname'];
    $mobno=$_POST['contactnumber'];

	if(isset($_FILES['image'])){
		
		$img_name = $_FILES['image']['name'];
		
		$tmp_name = $_FILES['image']['tmp_name'];

		$img_explode = explode('.',$img_name);
		$img_ext = end($img_explode);

		$extensions = ["gif","jpeg", "png", "jpg"];
		if(in_array($img_ext, $extensions) === true){
		   
			$time = time();
			$new_img_name = $time.$img_name;
			$query=$con->query("SELECT Images FROM `tbluser` WHERE ID='$userid'");
			$row=$query->fetch_assoc();
			unlink("images/".$row['Images']);
		if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
		
		} 
		 

		}
		
	}
	

     $query=$con->query("update tbluser set FullName ='$fullname', MobileNumber='$mobno', Images='$new_img_name' where ID='$userid'");
    if ($query) {
	 $code=7;
     $msg="User profile has been updated.";
  }
  else
    {
      $msg="Something Went Wrong. Please try again.";
    }
  }
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || User Profile</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
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
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Profile</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default">
					<div class="panel-heading">Profile</div>
					<div class="panel-body">
						<p style="font-size:16px; color:<?php if($code==7) echo 'green'; else echo 'red';?> " align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
						<div class="col-md-12">
							 <?php
$userid=$_SESSION['detsuid'];
$ret=$con->query("select * from tbluser where ID='$userid'");
$cnt=1;
while ($row=$ret->fetch_assoc()) {

?>
							<form role="form" method="post" action="" enctype="multipart/form-data">
								<div class="form-group">
									<label>Full Name</label>
									<input class="form-control" type="text" value="<?php  echo $row['FullName'];?>" name="fullname" required="true">
								</div>
								
								<div class="form-group">
									<label>Update Your Image</label>
									<input type="file" class="form-control" name="image" id="image" placeholder="Upload Image">
								</div>
								<div class="form-group">
									<label>Email</label>
                                    <input type="email" class="form-control" name="email" value="<?php  echo $row['Email'];?>" required="true" readonly="true">
								</div>
								
								<div class="form-group">
								<label>Mobile Number</label>
								<input type="text" class="form-control" id="mobilenumber" value="<?php echo $row['MobileNumber']; ?>" name="contactnumber" placeholder="Mobile Number" maxlength="10" pattern="[0-9]{10}" required="true">
							</div>
								<div class="form-group">
									<label>Registration Date</label>
									<input class="form-control" name="regdate" type="text" value="<?php  echo $row['RegDate'];?>" readonly="true">
								</div>
								
								<div class="form-group has-success">
									<button type="submit" class="btn btn-primary" name="update">Update</button>
								</div>
								
								
								</div>
								<?php } ?>
							</form>
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