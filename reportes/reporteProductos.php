<?php
      
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../fpdf/fpdf.php"; 
     
      
/*=============================================
             CLASE PDF
=============================================*/
class PDF extends FPDF{

  function Header(){ 
    
    $fechaHoy =(string) date('d/m/Y');
    $this->SetFont('Arial','B',14);
    $this->Image('../vistas/img/plantilla/logo.jpg',10,8,45,15,'JPG');
    $this->Cell(30);
    $this->SetTextColor(0, 0, 0);     
    $this->Cell(200,10,'Inventario a la Fecha : '.$fechaHoy,0,0,'C');
       
    $this->Ln(20);
    $this->SetFillColor(232,232,232);
    $this->SetFont('Arial','B',8);
    $this->Cell(20,6,'#Parte',1,0,'C',1);
    $this->Cell(70,6,utf8_decode('Descripción'),1,0,'C',1);
    $this->Cell(20,6,'Marca',1,0,'C',1);
    $this->Cell(20,6,'Modelo',1,0,'C',1);
    $this->Cell(20,6,'Ano',1,0,'C',1);
    $this->Cell(10,6,'Stock',1,0,'C',1);
    $this->Cell(20,6,'Colones',1,0,'C',1);
    $this->Cell(20,6,'Dolares',1,0,'C',1);
    $this->Cell(15,6,'Tipo',1,0,'C',1);
    $this->Cell(28,6,utf8_decode('Ubicación'),1,1,'C',1);
  } // fin Header() 
 
  function footer(){
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0,0,232);
    $this->Cell(10,10,'Pagina: -'. $this->PageNo().'-',0,0,'C');
  }// fin footer 
   
} // fin clas pdf

/*=============================================
      CLASE REPORTE PRODUCTOS
=============================================*/     
class ReportesInventario{
 
  public function reporte1(){
    
    $tabla = "inventario";
    $item = null;
    $valor = null;
    $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);
           
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
      
    $fpdf->SetFont('Arial','',7);
    $totalCol = 0;
    $totalDol =0;    
         
    foreach ($respuesta as $key => $reporte) {
      $costoCol = number_format($reporte["costoCol"], 2, '.', ',');
      $costoDol = number_format($reporte["costoDol"], 2, '.', ',');
      $fpdf->Cell(20,6,$reporte["parte"],1,0,'C');
      $fpdf->Cell(70,6,utf8_decode($reporte["descripcion"]),1,0,'');
      $fpdf->Cell(20,6,$reporte["marca"],1,0,'');
      $fpdf->Cell(20,6,$reporte["modelo"],1,0,'');
      $fpdf->Cell(20,6,$reporte["ano"],1,0,'C');
      $fpdf->Cell(10,6,$reporte["stock"],1,0,'C');
      $fpdf->Cell(20,6,$costoCol,1,0,'R');
      $fpdf->Cell(20,6,$costoDol,1,0,'R'); 
      $fpdf->Cell(15,6,$reporte["tipo"],1,0,'C');
      $fpdf->Cell(28,6,$reporte["ubicacion"],1,1,'C');
      $totalCol = $totalCol + $reporte["costoCol"];
      $totalDol = $totalDol + $reporte["costoDol"];
    }// fin foreach  
    $totalCol = number_format($totalCol, 2, '.', ',');
    $totalDol = number_format($totalDol, 2, '.', ',');
    
    $fpdf->SetFillColor(232,232,232); 
    $fpdf->SetFont('Arial','',8);
    $fpdf->Cell(160,6,'Total General =',1,0,'C',1);
         
    $fpdf->Cell(20,6,utf8_decode("¢ "). $totalCol,1,0,'R',1);
    $fpdf->Cell(20,6,utf8_decode("$ ").$totalDol,1,0,'R',1);
    $fpdf->Cell(43,6,'',1,1,'C',1);  
    $fpdf->Ln(10);

    $fpdf->Output();
     
  } // fin funcion reporteXfecha
  
}// fin class ReportesInventario

/*=============================================
Reportes Productos
=============================================*/
  $aReporte = new ReportesInventario();
  $aReporte -> reporte1();
   
 