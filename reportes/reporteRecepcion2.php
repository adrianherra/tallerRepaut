<?php
         
require_once "../controladores/entradas.controlador.php";
require_once "../modelos/entradas.modelo.php";
require_once "../controladores/galerias.controlador.php";
require_once "../modelos/galerias.modelo.php";

require_once "../fpdf/fpdf.php"; 
     
          
/*=============================================
             CLASE PDF
=============================================*/
$tipoHeader = 1;

class PDF extends FPDF{
   
    

  function Header(){ 
    $fechaHoy =(string) date('d/m/Y');
      $this->Image('../vistas/img/plantilla/logo1.jpg',5,8,35,12,'JPG');
      $this->Cell(30);
      $this->SetFont('Arial','B',16);
      $this->SetTextColor(123, 125, 125);     
      $this->Cell(140,5,utf8_decode('Reporte de Imagenes Vehículo'),0,1,'C');
      $this->SetTextColor(0, 0, 0);
      $this->SetFont('Arial','B',14);
      $this->Cell(202,7,utf8_decode('Carroceria y Pintura Repaut, S.A.'),0,1,'C');
      $this->SetFont('Arial','',10);
      $this->SetTextColor(123, 0, 232);
      $this->Cell(202,5,utf8_decode('Céd Jurid: 3-101-538188'),0,1,'C');
      $this->Cell(202,5,utf8_decode('Téls: (506)2591-7532 - (506)2591-4242 - (506)2591-4243 - (506)8396-0988'),0,1,'C');
      $this->Cell(202,5,utf8_decode('Email:presidencia@repaut.com www.repaut.com'),0,1,'C');
      $this->Cell(202,5,utf8_decode('Costado Este Plaza de San Blas, Cartago, Costa Rica'),0,1,'C');
    
  } // fin Header() 
 
  function footer(){
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0,0,232);
   // $this->Cell(10,10,'Pagina: -'. $this->PageNo().'-',0,0,'C');
  }// fin footer 
   
} // fin clas pdf

/*=============================================
      CLASE REPORTE VEHICULO
=============================================*/     
class ReportesVehiculo{
 
  public function reporte1(){
    
    $item = "id";
    $valor = $_POST["idReporte1"];

    $respuesta = ModeloEntradas::mdlMostrarEntradasC($item, $valor);
           
    $placa = utf8_decode($respuesta["placa"]);
    
    $marca = ucwords(utf8_decode($respuesta["marca"]));

    $nombreArchivo = '../vistas/img/recepcion/Recepcion'.trim($marca).'-'.trim($placa).'.pdf';
    
    $fpdf = new PDF();
    $fpdf->AddPage('Portrait','letter'); 
    $fpdf->SetFont('Arial','B',12);
    $fpdf->SetTextColor(123, 125, 125);
    $fpdf->Cell(202,20,"Fecha: ".$respuesta["fecha"],0,1,'R');
    $fpdf->SetFont('Arial','B',14);
    $fpdf->SetTextColor(0, 0, 0);
    $fpdf->Line(10,57,212,57); 
    $fpdf->Cell(55,0,"Placa: ".$placa,0,0,'L');
       
    $fpdf->SetFont('Arial','',8);
    $fpdf->Cell(85,0,'Cliente: '.utf8_decode($respuesta["nombre"]),0,0,'L'); 
    $fpdf->Cell(80,0,'Email: '.utf8_decode($respuesta["email"]),0,0,'L');
    $fpdf->SetFont('Arial','',12); 
    $fpdf->Cell(45,0,utf8_decode('Teléfono: ').utf8_decode($respuesta["telefono"]),0,1,'L'); 
    $fpdf->Line(10,67,212,67);
    
    $linea = 80;
    
    $item = "idCaso";
    $valor = $_POST["idReporte1"];
    $valor2 = "";  
    $galeria = ControladorGalerias::ctrMostrarGalerias($item, $valor, $valor2);

    foreach ($galeria as $key => $reporte) {  
      if ($linea > 180) {
        $linea = 60;
        $fpdf->AddPage('P'); 
      } // fin if
      $ruta = '../'. $reporte["ruta"];
      $fpdf->Image($ruta,60,$linea,90,90,'JPG');  
      $linea = $linea + 100;       
    } // fin for   
    $fpdf->Output();   
  } // fin funcion reporteXfecha
  
}// fin class ReportesInventario

/*=============================================
Reporte Vehiculo
=============================================*/
  $aReporte = new ReportesVehiculo();
  $aReporte -> reporte1();
   
 