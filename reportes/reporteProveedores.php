<?php
      
require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";
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
    $this->Cell(200,10,'Listado de Proveedores',0,0,'C');
       
    $this->Ln(20);
    $this->SetFillColor(232,232,232);
    $this->SetFont('Arial','B',8);
    $this->Cell(50,6,utf8_decode('Nombre'),1,0,'C',1);
    $this->Cell(18,6,utf8_decode('Teléfono'),1,0,'C',1);
    $this->Cell(50,6,utf8_decode('Email'),1,0,'C',1);
    $this->Cell(50,6,utf8_decode('Contacto'),1,0,'C',1);
    $this->Cell(50,6,utf8_decode('Dirección'),1,0,'C',1);
    $this->Cell(40,6,utf8_decode('Observación'),1,1,'C',1);
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
    
    $tabla = "proveedores";
    $item = null;
    $valor = null;
    $respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);
               
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
      
    $fpdf->SetFont('Arial','',7);
       
    foreach ($respuesta as $key => $reporte) {
      $fpdf->Cell(50,6,utf8_decode($reporte["nombre"]),1,0,'');
      $fpdf->Cell(18,6,$reporte["telefono"],1,0,'C');
      $fpdf->Cell(50,6,utf8_decode($reporte["email"]),1,0,'');
      $fpdf->Cell(50,6,utf8_decode($reporte["contacto"]),1,0,'');
      $fpdf->Cell(50,6,utf8_decode($reporte["direccion"]),1,0,'');
      $fpdf->Cell(40,6,utf8_decode($reporte["observacion"]),1,1,'');
     }// fin foreach  
    
    $fpdf->Output();
     
  } // fin funcion reporteXfecha
  
}// fin class ReportesInventario

/*=============================================
Reportes Productos
=============================================*/
  $aReporte = new ReportesInventario();
  $aReporte -> reporte1();
   
 