<?php 

  require_once "controladores/ordenes.controlador.php";
  require_once "modelos/ordenes.modelo.php";
  require_once "fpdf/fpdf.php"; 
 
  class PDF extends FPDF{

      function Header(){
        $this->SetFont('Arial','B',14);
        $this->Image('vistas/img/plantilla/logo.jpg',10,8,45,15,'JPG');
        $this->Cell(30);
        $this->Cell(200,10,'Reporte de Ordenes de Compra x Fecha',0,0,'C');
        $this->Ln(20);

        $this->SetFillColor(232,232,232);
        $this->SetFont('Arial','B',8);
        $this->Cell(20,6,'# Orden',1,0,'C',1);
        $this->Cell(20,6,'Aseguradora',1,0,'C',1); 
        $this->Cell(70,6,'Taller',1,0,'C',1);
        $this->Cell(22,6,'F.Orden',1,0,'C',1);
        $this->Cell(15,6,'Plazo',1,0,'C',1);
        $this->Cell(28,6,'Monto',1,0,'C',1);
        $this->Cell(28,6,'Costo',1,0,'C',1);
        $this->Cell(28,6,'Utilidad',1,0,'C',1);
        $this->Cell(20,6,'% Util',1,1,'C',1);
      } // fin Header() 

      function footer(){
        $this->SetFont('Arial','B',8);
        $this->SetTextColor(0,0,232);
        $this->Cell(10,10,'Pagina: -'. $this->PageNo().'-',0,0,'C');
      
      }// fin footer    

  } // fin clas pdf
 
  $fpdf = new PDF();
  $fpdf->AddPage('LANDSCAPE','letter');
  
  $fila = null;
  $item = null;
  $valor = null;

  $ordenes = ControladorOrdenes::ctrMostrarOrdenes($item, $valor);
 
  $fpdf->SetFont('Arial','',10);
  $totalMonto = 0;
  $totalCosto =0;
  foreach ($ordenes as $key => $reporte) {
     $monto = number_format($reporte["montoOrden"], 2, '.', ',');
     $costo = number_format($reporte["costoOrden"], 2, '.', ',');
     $utilidad = $reporte["montoOrden"] - $reporte["costoOrden"];
     $porUtl = 0;
     if (($reporte["costoOrden"] != 0) && ($utilidad != 0)) { 
         $porUtl = ($utilidad / $reporte["costoOrden"]) * 100;
     }// fin if
     $porUtl =  number_format($porUtl, 2, '.', '') . " %";
     $utilidad = number_format($utilidad, 2, '.', ',');
     $taller = substr($reporte["taller"], 0, 30);
     $taller = ucwords($taller);  
     $fpdf->Cell(20,6,$reporte["orden"],1,0,'C');
     $fpdf->Cell(20,6,$reporte["aseguradora"],1,0,'');
     $fpdf->Cell(70,6,$taller,1,0,'');
     $fpdf->Cell(22,6,$reporte["fechaOrden"],1,0,'C');
     $fpdf->Cell(15,6,$reporte["plazo"],1,0,'C');
     $fpdf->Cell(28,6,$monto,1,0,'R');
     $fpdf->Cell(28,6,$costo,1,0,'R');
     $fpdf->Cell(28,6,$utilidad,1,0,'R');
     $fpdf->Cell(20,6,$porUtl,1,1,'R'); 
     $totalMonto = $totalMonto + $reporte["montoOrden"];
     $totalCosto = $totalCosto + $reporte["costoOrden"];
  }// fin foreach
  $totalUtilidad = $totalMonto - $totalCosto;
  $totalUtl = 0;
  if (($totalCosto != 0) && ($totalUtilidad != 0)) { 
         $totalUtl = ($totalUtilidad / $totalCosto) * 100;
  }// fin if
  $totalUtl =  number_format($totalUtl, 2, '.', '') . " %";

  $totalMonto = number_format($totalMonto, 2, '.', ',');
  $totalCosto = number_format($totalCosto, 2, '.', ',');
  $totalUtilidad = number_format($totalUtilidad, 2, '.', ',');
   
  $fpdf->SetFillColor(232,232,232); 
  $fpdf->SetFont('Arial','B',10);
  $fpdf->Cell(147,6,'Total General =',1,0,'C',1);
  $fpdf->Cell(28,6,$totalMonto,1,0,'C',1);
  $fpdf->Cell(28,6,$totalCosto,1,0,'C',1);
  $fpdf->Cell(28,6,$totalUtilidad,1,0,'C',1);
  $fpdf->Cell(20,6,$totalUtl,1,1,'C',1);
  $fpdf->Output();
   
 ?>

