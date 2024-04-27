<?php
      
require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";
require_once "../fpdf/fpdf.php"; 
     
      
/*=============================================
             CLASE PDF
=============================================*/
class PDF extends FPDF{

  function Header(){ 
    
    $fechaHoy =(string) date('d/m/Y');
    $this->SetFont('Arial','',14);
    $this->Image('../vistas/img/plantilla/logo.jpg',10,8,45,15,'JPG');
    $this->Cell(30);
    $this->SetTextColor(0, 0, 0);     
    $this->Cell(200,10,'Reporte de Gastos x Fecha',0,0,'C');
    $this->Ln(5);
    $fechaIni= $_POST["fechaInicial"];
    $fechaFin= $_POST["fechaFinal"];
    $this->SetFont('Arial','',10);
    $this->Cell(262,10,'Del: '. $fechaIni .' Hasta: '. $fechaFin ,0,0,'C');    
    
    $this->Ln(20);
    $this->SetFillColor(232,232,232);
    $this->SetFont('Arial','B',8);
    $this->Cell(28,6,'Tipo',1,0,'C',1);
    $this->Cell(42,6,'Factura',1,0,'C',1); 
    $this->Cell(28,6,'Fecha',1,0,'C',1);
    $this->Cell(120,6,'Descripcion',1,0,'C',1);
    $this->Cell(28,6,'Monto',1,1,'C',1);
    
    
  } // fin Header() 
 
  function footer(){
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0,0,232);
    $this->Cell(10,10,'Pagina: -'. $this->PageNo().'-',0,0,'C');
  }// fin footer 
   
} // fin clas pdf

/*=============================================
      CLASE REPORTE GASTOS
=============================================*/     
class ReportesGastos{
 
  public function reporte1(){
    
    $fechaIni= $_POST["fechaInicial"];
    $fechaFin= $_POST["fechaFinal"];
    $respuesta = ModeloPagos::mdlMostrarPagosF($fechaIni, $fechaFin);
            
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
      
    $fpdf->SetFont('Arial','',8);
    $total =0;    
    
    foreach ($respuesta as $key => $reporte) {
      $monto = number_format($reporte["monto"], 2, '.', ',');
      
      $fpdf->Cell(28,6,$reporte["tipo"],1,0,'');
      $fpdf->Cell(42,6,$reporte["numero"],1,0,'');
      $fpdf->Cell(28,6,$reporte["fecha"],1,0,'C');
      $fpdf->Cell(120,6,$reporte["observacion"],1,0,'');
      $fpdf->Cell(28,6,$monto,1,1,'R');
      $total = $total + $reporte["monto"];
      
    }// fin foreach  
    $total = number_format($total, 2, '.', ',');
    
    $fpdf->SetFillColor(232,232,232); 
    $fpdf->SetFont('Arial','B',8);
    $fpdf->Cell(218,6,'Total General =',1,0,'C',1);
         
    $fpdf->Cell(28,6,$total,1,1,'R',1);
   
    
    $fpdf->Ln(10);
   
    $fpdf->Output();
     
  } // fin funcion reporteXfecha
  
}// fin class ReportesGastos

/*=============================================
Reportes Productos
=============================================*/
  $aReporte = new ReportesGastos();
  $aReporte -> reporte1();
   
 