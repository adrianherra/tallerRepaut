<?php
      
require_once "../controladores/facturas.controlador.php";
require_once "../modelos/facturas.modelo.php";
require_once "../fpdf/fpdf.php"; 
        
      
/*=============================================
             CLASE PDF
=============================================*/
class PDF extends FPDF{
   

  function Header(){ 
    
    $idReporte = $_POST["idReporte"]; 
    
    $tracking = "0000";
    $fecha =(string) date('Y-m-d');
    
    $item = "idFactura";
    $valor = $_POST["idReporte"];
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
      if ($ship == "")  $ship =  "Aeropost 9950 NW 17TH ST DORAL,FLORIDA 33172";
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
    $this->Image('../vistas/img/plantilla/logoFactura.jpg',10,8,60,30,'JPG');
        
    $this->SetFont('Arial','',44);
    $this->SetTextColor(0, 0, 0);     
    $this->Cell(130,10,'Invoice',0,1,'R');
    $this->SetFont('Arial','',14); 
    $this->Cell(150,6,'',0,0,'L'); 
    $this->Cell(45,6,'Date: '.$fecha,0,1,'L');
    $this->Cell(150,6,'',0,0,'L');   
    $this->Cell(45,6,'Invoice No.: '.$idReporte,0,1,'L');
    $this->Ln(15);
    $this->SetFont('Arial','B',10);
    $this->Cell(105,5,'Sold To',0,1,'L');

    $this->Cell(105,5,utf8_decode($sold1),0,1,'L');
    $this->Cell(105,5,utf8_decode($sold2),0,1,'L');
    $this->Cell(105,5,utf8_decode($sold3),0,0,'L');
    $this->Cell(45,5,'Ship To',0,1,'L');
    $this->Cell(105,5,utf8_decode($sold4),0,0,'L');
    $this->SetFont('Arial','B',8);
    $this->Cell(45,5,utf8_decode($ship),0,1,'L');
    if ($ship1 != "-") {
      $this->Cell(105,5,'',0,0,'L');
      $this->Cell(45,5,utf8_decode($ship1),0,1,'L');
    } // fin if  
    $this->SetFont('Arial','B',10);
    $this->Cell(105,5,'',0,0,'L');
    $this->Cell(45,5,'Tracking Number: '.$tracking,0,1,'L');
          
    $this->Ln(6);
    $this->SetFillColor(232,232,232);
    $this->SetFont('Arial','',10);
    $this->Cell(50,6,'Sales Person',1,0,'C',1);
    $this->Cell(50,6,'P.O NUMBER',1,0,'C',1);
    $this->Cell(45,6,'SHIPPED VIA',1,0,'C',1);
    $this->Cell(50,6,'PAYMENT CONDITION',1,1,'C',1);

    $this->Cell(50,6,'LUIS CAMPOS',1,0,'L');
    $this->Cell(50,6,'4200',1,0,'L');
    $this->Cell(45,6,'AEREO',1,0,'L');
    $this->Cell(50,6,utf8_decode($condicion),1,1,'L');
        
    $this->Ln(5);
    $this->SetFont('Arial','B',10);
    $this->Cell(15,6,'Quant',1,0,'C',1);
    $this->Cell(35,6,'Part No',1,0,'C',1); 
    $this->Cell(95,6,'Description',1,0,'C',1);
    $this->Cell(23,6,'Net',1,0,'C',1);
    $this->Cell(27,6,'Amount',1,1,'C',1);
           
    
  } // fin Header() 
 
  function footer(){
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0,0,232);
    //$this->Cell(10,10,'Pagina: -'. $this->PageNo().'-',0,0,'C');
  }// fin footer 
   
} // fin clas pdf

/*=============================================
      CLASE REPORTE FACTURA
=============================================*/     
class ReporteFactura{
 
  public function reporte1(){
    
    $item = "idFactura";
    
    $valor = $_POST["idReporte"];
    $nombre = strval($_POST["idReporte"]). ".pdf";
    $lineas = ControladorFacturas::ctrMostrarLineas($item, $valor);
                
    $fpdf = new PDF();
    $fpdf->AddPage('Portrait','letter'); 
      
    $fpdf->SetFont('courier','',10);
    $totalGen =0;    
    $tracking = "0000";

    foreach ($lineas as $key => $reporte) {
      $monto = '$ '. number_format($reporte["monto"], 2, '.', ',');
      $total = '$ '. number_format($reporte["total"], 2, '.', ',');

      $fpdf->Cell(15,6,$reporte["cantidad"],1,0,'C');
      $fpdf->SetFont('Courier','',7);
      $fpdf->Cell(35,6,utf8_decode(strtoupper($reporte["parte"])),1,0,'L');
      $fpdf->Cell(95,6,utf8_decode($reporte["descripcion"]),1,0,'L');
      $fpdf->SetFont('Arial','',10);            
      $fpdf->Cell(23,6,$monto,1,0,'R');
      $fpdf->Cell(27,6,$total,1,1,'R');
      $tracking = $reporte["tracking"];
      $totalGen = $totalGen + $reporte["total"];
      
    }// fin foreach  
    $totalDes = '$ 0.00';
         
    $respuesta = ModeloFacturas::mdlFinFactura($valor,$totalGen,$tracking);
    $_SESSION['tracking'] = "";
    $totalGen = '$ '. number_format($totalGen, 2, '.', ',');
        
    $fpdf->SetFillColor(232,232,232); 
    $fpdf->SetFont('Arial','B',10);
    
    $fpdf->Cell(123,6,'',0,0,'L');
    $fpdf->Cell(45,6,'Sub-Total',1,0,'R',1);
    $fpdf->Cell(27,6,$totalGen,1,1,'R',1);
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(123,6,'TERMS & CONDITIONS',0,0,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(45,6,'Discount',1,0,'R',1);
    $fpdf->Cell(27,6,$totalDes,1,1,'R',1);
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(123,6,'All our sales are guaranteed',0,0,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(45,6,'Shipping and handling',1,0,'R',1);
    $fpdf->Cell(27,6,$totalDes,1,1,'R',1);
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(123,6,'against supplier conditions and manufacturing defects.',0,0,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(45,6,'Sales Tax',1,0,'R',1);
    $fpdf->Cell(27,6,$totalDes,1,1,'R',1);
    
    $fpdf->Cell(123,6,'THANKS YOU FOR YOUR ORDER !',0,0,'L');
    $fpdf->Cell(45,6,'Total',1,0,'R',1);
    $fpdf->Cell(27,6,$totalGen,1,1,'R',1);
    
    $fpdf->Output(); 
    
    
  } // fin funcion reporteXfecha
  
}// fin class ReporteFactura

/*=============================================
Reporte Factura
=============================================*/
  $aReporte = new ReporteFactura();
  $aReporte -> reporte1();
   
 