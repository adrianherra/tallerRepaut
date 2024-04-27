<?php
      
require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";
require_once "../fpdf/fpdf.php"; 
     
      
/*=============================================
             CLASE PDF
=============================================*/
class PDF extends FPDF{

  function Header(){ 
    
    $idReporte = $_POST["vIdReporte"]; 
    
    $vFecha = (string) $_POST["vFecha"];
    
    //$tracking = $_POST["vTracking"];
    
    //$fecha =(string) date('Y-m-d');
      
    //$this->Image('../vistas/img/plantilla/logoFactura.jpg',10,8,60,30,'JPG');
    
    $item = "idFactura";
    $valor = $idReporte;
    $lineas = ControladorFacturas::ctrMostrarLineas($item, $valor);
    //if(!empty($respuesta)){
      $tracking = $lineas[0]["tracking"];
      $sold1 = $lineas[0]["sold1"];
      $sold2 = $lineas[0]["sold2"];
      $sold3 = $lineas[0]["sold3"];
      $sold4 = $lineas[0]["sold4"];
      $ship = $lineas[0]["ship"];
      $ship1 = $lineas[0]["ship1"];
      $condicion = $lineas[0]["condicion"];
      if ($sold1 == "") $sold1 = "Inversiones Alvarado y Gómez DIMA";
      if ($sold2 == "") $sold2 = "San José Costa Rica";
      if ($sold3 == "") $sold3 = "206 Segedfield cir. Winter Park Fl 32792";
      if ($sold4 == "") $sold4 = "PHONE NUMBER 4074592099";
      if ($ship == "")  $ship = "Aeropost 9950 NW 17TH ST DORAL,FLORIDA 33172";
      if ($ship1 == "") $ship1 = "-";
      if ($condicion == "") $condicion = "ANTICIPADO";
    /*} else {
      $sold1 = "Inversiones Alvarado y Gómez DIMA";
      $sold2 = "San José Costa Rica";
      $sold3 = "206 Segedfield cir. Winter Park Fl 32792";
      $sold4 = "PHONE NUMBER 4074592099";
      $ship = "Aeropost 9950 NW 17TH ST DORAL,FLORIDA 33172";
      $track = "";
      $condicion = "ANTICIPADO";
    } // fin if */ 
    $this->SetFont('Times','B',32);
    $this->SetTextColor(0, 0, 0);     
    $this->Cell(200,0,'OrlandoParts',0,1,'C');
    $this->SetFont('Times','B',10);
    $this->Cell(200,15,'Orlando Parts Logistic Company',0,1,'C');
    $this->Cell(200,10,'436 Street Orlando Florida',0,1,'C');
    $this->Cell(200,0,'Zip 3272',0,1,'C');
    $this->SetFont('Arial','',10);
    //$this->Cell(200,10,'TOLL FREE 1-800-322-3389',0,0,'C');
    $this->Ln(5);
    $this->Cell(200,0,'WHOLESALE DIRECT: (407) 459-2099',0,0,'C');
    //$this->Cell(200,0,'PARTS DEPT MAIN: (305) 446-7000 FAX: (305) 442-6663',0,0,'C');
    $this->Ln(5);
    $this->Cell(200,0,'EMAIL: orlandopartslogistics@gmail.com',0,0,'C');
    $this->Ln(10);
    $this->SetFont('Arial','',9);
    $this->Cell(200,0,'Return/Refund Policy:',0,0,'C');
    $this->Ln(4);
    $this->Cell(200,0,'All returns must be accompanied by this invoice and are subject to a 25% restocking charge.',0,0,'C');
    $this->Ln(4);
    $this->Cell(200,0,'Please note Dealer will not accept returns or make refunds after 10 days.',0,0,'C');
    $this->Ln(4);
    $this->Cell(200,0,'No refunds or returns are provided for special order parts or electrical parts.',0,0,'C');
    $this->Ln(15);
    $this->SetFont('Arial','',6.5);
    $this->Cell(200,0,'AS IS: The only warranties applying to the Part(s) described herein are those which may be offered by the manufacturer or supplier. The selling dealer hereby expressly disclaims all warranties,',0,0,'L');
    $this->Ln(3);
    $this->Cell(200,0,'either express or implied, including any implied warranties of merchantability or fitness for a particular purpose, and neither assumes nor authorizes any other person to assume for it any liability',0,0,'L');
    $this->Ln(3);
    $this->Cell(200,0,'in connection with the sale of these part(s). Buyer shall not be entitled to recover from the selling dealer any consequential damages, damages to property, damages for loss of use, loss of time,',0,0,'L');
    $this->Ln(3);
    $this->Cell(200,0,'loss of profits or income, or any other incidental damages. This disclaimer in no way affects the provisions of the manufacturers or suppliers warranties.',0,0,'L');
    $this->Ln(3);
    $this->SetFillColor(232,232,232);
    $this->SetFont('Arial','',9);
    $this->Cell(35,6,'DATE ENTERED',1,0,'C');
    $this->Cell(35,6,'YOUR ORDER NO',1,0,'C');
    $this->Cell(35,6,'DATE SHIPPED',1,0,'C');
    $this->Cell(35,6,'INVOICE DATE',1,0,'C');
    $this->Cell(57,6,'INVOICE NUMBER',1,1,'C');

    $this->Cell(35,6,$vFecha,1,0,'C');
    $this->Cell(35,6,'',1,0,'C');
    $this->Cell(35,6,$vFecha,1,0,'C');
    $this->Cell(35,6,$vFecha,1,0,'C');
    $this->Cell(57,6,$idReporte,1,1,'C');


    $this->Ln(5);
    $this->SetFont('Arial','B',10);
    $this->Cell(105,5,'Sold To',0,0,'L');
    $this->Cell(45,5,'Ship To',0,1,'L');
 
    $this->SetFont('Arial','',10);
    $this->Cell(105,5,utf8_decode($sold1),0,0,'L');
    $this->SetFont('Arial','',9);
    $this->Cell(45,5,utf8_decode($ship),0,1,'L');

    $this->Cell(105,5,utf8_decode($sold2),0,0,'L');
    $this->Cell(45,5,utf8_decode($sold4),0,1,'L');
    $this->Cell(105,5,utf8_decode($sold3),0,0,'L');
    $this->Cell(45,5,'Tracking Number: '.$tracking,0,1,'L');
    

    $this->Ln(6);
    $this->SetFillColor(232,232,232);
    $this->SetFont('Arial','',10);
    $this->Cell(50,6,'Sales Person',1,0,'C');
    $this->Cell(50,6,'P.O NUMBER',1,0,'C');
    $this->Cell(45,6,'SHIPPED VIA',1,0,'C');
    $this->Cell(50,6,'PAYMENT CONDITION',1,1,'C');

    $this->Cell(50,6,'LUIS CAMPOS',1,0,'L');
    $this->Cell(50,6,'4200',1,0,'L');
    $this->Cell(45,6,'DELIVERY',1,0,'L');
    $this->Cell(50,6,'CASH',1,1,'L');

    $this->Ln(5);
    $this->SetFont('Arial','B',10);
    $this->Cell(15,6,'Quant',1,0,'C');
    $this->Cell(35,6,'Part No',1,0,'C'); 
    $this->Cell(95,6,'Description',1,0,'C');
    $this->Cell(23,6,'Net',1,0,'C');
    $this->Cell(27,6,'Amount',1,1,'C');
           
    
  } // fin Header() 
 
  function footer(){
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0,0,232);
    //$this->Cell(10,10,'Pagina: -'. $this->PageNo().'-',0,0,'C');
  }// fin footer 
  
  
  protected $extgstates = array();

	// alpha: real value from 0 (transparent) to 1 (opaque)
	// bm:    blend mode, one of the following:
	//          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
	//          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
	function SetAlpha($alpha, $bm='Normal')
	{
		// set alpha for stroking (CA) and non-stroking (ca) operations
		$gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
		$this->SetExtGState($gs);
	}

	function AddExtGState($parms)
	{
		$n = count($this->extgstates)+1;
		$this->extgstates[$n]['parms'] = $parms;
		return $n;
	}

	function SetExtGState($gs)
	{
		$this->_out(sprintf('/GS%d gs', $gs));
	}

	function _enddoc()
	{
		if(!empty($this->extgstates) && $this->PDFVersion<'1.4')
			$this->PDFVersion='1.4';
		parent::_enddoc();
	}

	function _putextgstates()
	{
		for ($i = 1; $i <= count($this->extgstates); $i++)
		{
			$this->_newobj();
			$this->extgstates[$i]['n'] = $this->n;
			$this->_put('<</Type /ExtGState');
			$parms = $this->extgstates[$i]['parms'];
			$this->_put(sprintf('/ca %.3F', $parms['ca']));
			$this->_put(sprintf('/CA %.3F', $parms['CA']));
			$this->_put('/BM '.$parms['BM']);
			$this->_put('>>');
			$this->_put('endobj');
		}
	}

	function _putresourcedict()
	{
		parent::_putresourcedict();
		$this->_put('/ExtGState <<');
		foreach($this->extgstates as $k=>$extgstate)
			$this->_put('/GS'.$k.' '.$extgstate['n'].' 0 R');
		$this->_put('>>');
	}

	function _putresources()
	{
		$this->_putextgstates();
		parent::_putresources();
	}

} // fin clas pdf

/*=============================================
      CLASE REPORTE FACTURA
=============================================*/     
class ReporteFactura{
 
  public function reporte1(){
    
    $item = "idFactura";
    
    $valor = $_POST["vIdReporte"];
    $lineas = ControladorFacturas::ctrMostrarLineas($item, $valor);
    

    $fpdf = new PDF();
    $fpdf->AddPage('Portrait','letter'); 
      
    $fpdf->SetFont('Courier','',10);
    $totalGen =0;    
    $i = 0;
    $cantidad = "";
    $parte    = "";
    $descripcion = "";
    $monto = "";
    $total = "";
    $salto = "";   
    foreach ($lineas as $key => $reporte) {
      $cantidad = $cantidad . $reporte["cantidad"]. "\r\n"; 
      $parte    = $parte    . utf8_decode(strtoupper($reporte["parte"])) . "\r\n";
      $descripcion = $descripcion . utf8_decode($reporte["descripcion"]) . "\r\n";
      $monto = $monto ."$ " .number_format($reporte["monto"], 2, '.', ','). "\r\n";
      $total = $total ."$ ". number_format($reporte["total"], 2, '.', ','). "\r\n";
      $totalGen = $totalGen + $reporte["total"];
      $i++;
    }// fin foreach
    for (;$i<=9;$i++){
       $salto = $salto ." \r\n"; 
    }
    
    $fpdf->MultiCell(15, 6,$cantidad . $salto, 1,'C');
    $fpdf->SetXY(25, 160);
    $fpdf->MultiCell(35, 6,$parte. $salto, 1,'L');
    $fpdf->SetXY(60, 160);
    $fpdf->SetFont('courier','',8);
    $fpdf->MultiCell(95, 6,$descripcion. $salto, 1,'L');
    $fpdf->SetFont('Courier','',10);
    $fpdf->SetXY(155, 160);
    $fpdf->MultiCell(23, 6,$monto. $salto, 1,'R');  
    $fpdf->SetXY(178, 160);
    $fpdf->MultiCell(27, 6,$total. $salto, 1,'R');
   
     $totalGen = '$ '. number_format($totalGen, 2, '.', ',');
     $totalDes = '$ 0.00';
    
    $fpdf->SetFillColor(232,232,232); 
    $fpdf->SetFont('Arial','B',10);
      
    $fpdf->Cell(123,6,'',0,0,'L');
    $fpdf->Cell(45,6,'Sub-Total',1,0,'R');
    $fpdf->Cell(27,6,$totalGen,1,1,'R');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(123,6,'TERMS & CONDITIONS',0,0,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(45,6,'Discount',1,0,'R');
    $fpdf->Cell(27,6,$totalDes,1,1,'R');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(123,6,'All our sales are guaranteed',0,0,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(45,6,'Shipping and handling',1,0,'R');
    $fpdf->Cell(27,6,$totalDes,1,1,'R');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(123,6,'against supplier conditions and manufacturing defects.',0,0,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(45,6,'Sales Tax',1,0,'R');
    $fpdf->Cell(27,6,$totalDes,1,1,'R');
    
    $fpdf->Cell(123,6,'THANKS YOU FOR YOUR  ORDER !',0,0,'L');
    $fpdf->Cell(45,6,'Total',1,0,'R');
    $fpdf->Cell(27,6,$totalGen,1,1,'R');
    $fpdf->SetFont('Courier','B',12);
    $fpdf->ln(5);
    $fpdf->Cell(200,0,'Original',0,1,'C');
    
    //$fpdf->Image('../vistas/img/plantilla/Marca1.png',14,162,185,55,'PNG');
    //$fpdf->SetAlpha(0.5);

    
    $fpdf->Output();
     
  } // fin funcion reporteXfecha
  
}// fin class ReporteFactura

/*=============================================
Reporte Factura
=============================================*/
  $aReporte = new ReporteFactura();
  $aReporte -> reporte1();
   
 