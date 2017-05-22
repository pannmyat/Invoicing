
<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
	<?php

		use App\Menu;

		ob_start();
		require('fpdf.php');

		$fpdf = new Fpdf();		
	    $fpdf->AddPage("P","A4");
	    $fpdf->SetFont('Arial','B',20);
	     
	    $fpdf->SetFillColor(255,0,0);
	    $fpdf->SetTextColor(255);
	    $fpdf->SetDrawColor(128,0,0);
	    $fpdf->SetLineWidth(.3);
	    $fpdf->SetFont('','B');
	    // Header
	    $w = array(70, 35, 40, 45);
	    // for($i=0;$i<count($header);$i++)
	    //     $fpdf->Cell($w[$i],7,$header[$i],1,0,'C',true);
	    // $fpdf->Ln();
	    // Color and font restoration
	    $fpdf->SetFillColor(224,235,255);
	    $fpdf->SetTextColor(0);
	    $fpdf->SetFont('');	   
	    // Data

	    $fpdf->Cell(0,6,"Invoice",0,0,'C');
	    $fpdf->Ln();
	  	$fpdf->Ln();
	  	$fpdf->Ln();

	  	$fpdf->SetFont('Arial','B',10);
	  	$fpdf->Cell(145,6,"Invoice Name :",0,0,'R');
	  	$fpdf->SetFont('Arial','',10);
    	$fpdf->Cell(45,6,$Invoice[0]->invoicename,0,0,'L');
    	$fpdf->Ln();

	  	$fpdf->SetFont('Arial','B',10);
	  	$fpdf->Cell($w[0],6,"Item",1,0,'C');
	    $fpdf->Cell($w[1],6,'Price',1,0,'C');
        $fpdf->Cell($w[2],6,'Quantity',1,0,'C');
        $fpdf->Cell($w[3],6,'Amount',1,0,'C');       
        $fpdf->Ln();

        $fpdf->SetFont('Arial','',10);
        foreach($items as $item)
		{			
			$fpdf->Cell($w[0],6,$item->Item,1,0,'L');			
	        $fpdf->Cell($w[1],6,$item->price,1,0,'R');
	        $fpdf->Cell($w[2],6,$item->quantity,1,0,'R');
	        $fpdf->Cell($w[3],6,$item->amount,1,0,'R');	        
	        $fpdf->Ln();    	
	    }

    	$fpdf->Cell(145,6,"Subtotal :",0,0,'R');
    	$fpdf->Cell(45,6,$Invoice[0]->subtotal,1,0,'R');
    	$fpdf->Ln();
    	$fpdf->Cell(145,6,"Tax :",0,0,'R');
    	$fpdf->Cell(45,6,$Invoice[0]->tax,1,0,'R');
    	$fpdf->Ln();
    	$fpdf->Cell(145,6,"Total :",0,0,'R');
    	$fpdf->Cell(45,6,$Invoice[0]->total,1,0,'R');

    	$fpdf->SetY(0);      
        $fpdf->SetFont('Arial','I',8);   

        $fpdf->SetY(266);      
        $fpdf->SetFont('Arial','I',8);        
        $fpdf->Cell(0,10,'Page '.$fpdf->PageNo(),0,0,'R');

        $fpdf->Output();
        exit;
		ob_end_flush(); 
	?>
</body>
</html>