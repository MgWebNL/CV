<?php
/**
 * Untitled 1
 * 
 * @package 	Hodi_VM_portal
 * @author 		Ruud van der Woude
 * @copyright 	Hodi Studio 2012
 * @version 	$Id$
 * @access 		public
 * @started		14-12-2012
 * @lastUpdate	14-12-2012
 */

require("fpdf/fpdf.php");

class PDF extends FPDF{
    // Load data
    function LoadData($file){
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',trim($line));
        return $data;
    }

    // Better table
    function ImprovedTable($header, $data){
        // Column widths
        $w = array(25, 95, 15, 5, 15, 15, 5, 15);
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C');
            
        $this->Ln();
   /**/     // Data
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR');
           // $this->MultiCell($w[1],6,$row[1],1,'L',false);
            $this->Cell($w[1],6,$row[1],'LR','L', false);
            $this->Cell($w[2],6,$row[2],'LR','','R');
            $this->Cell($w[3],6,$row[3],'LR');
            $this->Cell($w[4],6,$row[4],'LR','','R');
            $this->Cell($w[5],6,$row[5],'LR');
            $this->Cell($w[6],6,$row[6],'LR');
            $this->Cell($w[7],6,$row[7],'LR','','R');
            $this->Ln();
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }  
    
    public function LineItems($p_aHeader, $p_aData) {

		$header = $p_aHeader;
//var_dump($header);
		// Data
		
		$textWrap = str_repeat("this is a word wrap test ", 3);
		$textNoWrap = "there will be no wrapping here thank you";
		
		$data = $p_aData;
		
		$w = array(35, 75, 15, 5, 15, 15, 5, 25);
        $this->SetFont('Arial','B',10);
    //    foreach($header as $head){
            $this->Cell($w[0], 7, $header[0], 0, 0, 'L');  
            $this->Cell($w[1], 7, $header[1], 0, 0, 'L');
            $this->Cell($w[2], 7, $header[2], 0, 0, 'R');
            $this->Cell($w[3], 7, $header[3], 0, 0, 'C');
            $this->Cell($w[4], 7, $header[4], 0, 0, 'R');
            $this->Cell($w[5], 7, $header[5], 0, 0, 'L');
            $this->Cell($w[6], 7, $header[6], 0, 0, 'C');
            $this->Cell($w[7], 7, $header[7], 0, 0, 'R');
  //     }
/*
		for($i = 0; $i < count($header); $i++) {
			$this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');            
		}*/

		$this->Ln();

		// Mark start coords

		$x = $this->GetX();
		$y = $this->GetY();
		$i = 0;
		$this->SetFont('Arial','',8);
        $iH = 0;
        $ii = 1;
		foreach($data as $row)
		{
            $this->Cell($w[0],4,$row[0],'0');
            
            $y1 = $this->GetY();
			$this->MultiCell($w[1], 4, $row[1],'0','L', false);	
			$y2 = $this->GetY();
			$yH = $y2 - $y1;
						
	//		$this->SetXY($w[0] + $w[1], $this->GetY() - $yH);
            $this->SetXY(120, $this->GetY() - $yH);
      //      $this->Cell($w[1],6,$row[1],'LR','L', false);
            $this->Cell($w[2],4,$row[2],'0','','R');
            $this->Cell($w[3],4,$row[3],'0');
            $this->Cell($w[4],4,$row[4],'0','','R');
            $this->Cell($w[5],4,$row[5],'0');
            $this->Cell($w[6],4,$row[6],'0');
            $this->Cell($w[7],4,$row[7],'0','','R');
            		
			$this->Ln($yH);

            // Maak een nieuwe pagina aan.
            $iH += $yH;

            if($iH > 120){

                $this->text(10,75, 'Blad:');
                $this->text(45,75,$ii);

                $this->addPage();
                $ii++;
                $this->SetXY(10, 85);
                $this->SetFont('Arial','',10);

                $this->text(10,75, 'Blad:');
                $this->text(45,75,$ii);

                $w = array(35, 75, 15, 5, 15, 15, 5, 25);
                $this->Rect(8, 86, 194, 5);
                $this->SetFont('Arial','B',10);
                //    foreach($header as $head){
                $this->Cell($w[0], 7, $header[0], 0, 0, 'L');
                $this->Cell($w[1], 7, $header[1], 0, 0, 'L');
                $this->Cell($w[2], 7, $header[2], 0, 0, 'R');
                $this->Cell($w[3], 7, $header[3], 0, 0, 'C');
                $this->Cell($w[4], 7, $header[4], 0, 0, 'R');
                $this->Cell($w[5], 7, $header[5], 0, 0, 'L');
                $this->Cell($w[6], 7, $header[6], 0, 0, 'C');
                $this->Cell($w[7], 7, $header[7], 0, 0, 'R');


                $this->Ln();

                // Mark start coords

                $x = $this->GetX();
                $y = $this->GetY();
                $i = 0;
                $this->SetFont('Arial','',10);
                $iH = 0;
            }

			$i++;
		}

		$this->Ln(10);
	}

    public function LineItemsDS($p_aHeader, $p_aData, $p_aWidth = '') {

        $header = $p_aHeader;

        $textWrap = str_repeat("this is a word wrap test ", 3);
        $textNoWrap = "there will be no wrapping here thank you";


        //$w = array(35, 75, 15, 5, 15, 15, 5, 25);
        $w = $p_aWidth;
        $this->SetFont('Arial','B',10);
        //    foreach($header as $head){
        $this->Cell($w[0], 7, $header[0], 0, 0, 'L');
        $this->Cell($w[1], 7, $header[1], 0, 0, 'L');
        $this->Cell($w[2], 7, $header[2], 0, 0, 'L');
        $this->Cell($w[3], 7, $header[3], 0, 0, 'L');

        //     }
        /*
                for($i = 0; $i < count($header); $i++) {
                    $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
                }*/

        $this->Ln();

        // Mark start coords

        $x = $this->GetX();
        $y = $this->GetY();
        $i = 0;
        $this->SetFont('Arial','',8);
        $iH = 0;
        $ii = 1;
        foreach($p_aData as $row)
        {
            $this->Cell($w[0],4,$row[0],'0','','L');
            $this->Cell($w[1],4,$row[1],'0','','L');
            $this->Cell($w[2],4,$row[2],'0','','L');
            $y1 = $this->GetY();
            $this->MultiCell($w[3], 4, $row[3],'0','L', false);
            $y2 = $this->GetY();
            $yH = $y2 - $y1;

            //		$this->SetXY($w[0] + $w[1], $this->GetY() - $yH);
            $this->SetXY(120, $this->GetY() - $yH);
            //      $this->Cell($w[1],6,$row[1],'LR','L', false);


            $this->Ln($yH);

            // Maak een nieuwe pagina aan.
            $iH += $yH;

            if($iH > 210){

                $this->text(10,275, 'Blad:');
                $this->text(45,275,$ii);

                $this->addPage();
                $ii++;
                $this->SetXY(10, 39);
                $this->SetFont('Arial','',10);

                $this->text(10,275, 'Blad:');
                $this->text(45,275,$ii);

                //$w = array(35, 75, 15, 5, 15, 15, 5, 25);
                $w = $p_aWidth;
                $this->Rect(8, 40, 194, 5);
                $this->SetFont('Arial','B',10);
                //    foreach($header as $head){
                $this->Cell($w[0], 7, $header[0], 0, 0, 'L');
                $this->Cell($w[1], 7, $header[1], 0, 0, 'L');
                $this->Cell($w[2], 7, $header[2], 0, 0, 'L');
                $this->Cell($w[3], 7, $header[3], 0, 0, 'L');

                $this->Ln();

                // Mark start coords

                $x = $this->GetX();
                $y = $this->GetY();
                $i = 0;
                $this->SetFont('Arial','',10);
                $iH = 0;
            }

            $i++;
        }

        $this->Ln(10);
    }
}


?> 