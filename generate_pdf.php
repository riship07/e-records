<?php
session_start();
  
  include('includes/dbconnection.php');
  include_once('fpdf181/fpdf.php');
  if (strlen($_SESSION['detsuid'])==0) {
	header('location:logout.php');
	}else{
        $fadate=$_GET['fdate'];
        $tadate=$_GET['tdate'];
    class PDF extends FPDF
			{
			
			function Header()
			{
				$this->SetFont('Arial','B',13);
				// $this->Cell(80);
			    $this->Cell(40,10,'Expense Report',1,0,'C');
			    $this->Ln(20);
			}
			 
		   function Footer()
			{
				$this->SetY(-15);
				$this->SetFont('Arial','I',8);
			    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			}
			}
			


			
			$userid=$_SESSION['detsuid'];
			$header =$con->query("SHOW columns FROM tblexpense");
			 $ret=$con->query("SELECT * FROM `tblexpense` WHERE ExpenseDate BETWEEN '$fadate' AND '$tadate' && UserId='$userid'");
			$total=$ret->num_rows;
             $pdf = new PDF();
		
			$pdf->AddPage();
		
			$pdf->SetFont('Arial','B',12);	
            $pdf->Cell(25,12,'SR NO.',1);	
			while($row=$header->fetch_array()){
                if($row[0]=='ID' || $row[0]=='UserId' || $row[0]=='NoteDate' || $row[0]=='Categories')
                   continue;
                else
				   $pdf->Cell(40,12,$row[0],1);
				
			}
			$pdf->SetFont('Arial','',12);
            $n=1;
			while($row=$ret->fetch_assoc()){
                if($n%10==0){
                    $pdf->AddPage();
                }
					$pdf->Ln();
				$pdf->Cell(25,12,$n,1);
			    $pdf->Cell(40,12,$row['ExpenseDate'],1);
				$pdf->Cell(40,12,$row['ExpenseItem'],1);
                $pdf->Cell(40,12,$row['ExpenseCost'],1);
                $n=$n+1;			
				}
			
			$pdf->Output();
		}
	?>