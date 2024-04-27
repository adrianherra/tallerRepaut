<?php
      
require_once "../controladores/ordenes.controlador.php";
require_once "../modelos/ordenes.modelo.php";
require_once "../controladores/lineas.controlador.php";
require_once "../modelos/lineas.modelo.php";
require_once "../fpdf/fpdf.php"; 
  
      
/*=============================================
             CLASE PDF
=============================================*/
class PDF extends FPDF{

  function Header(){ 
    $tipoReporte = $_POST["sTipo"];
    $desReporte = $_POST["sReporte"];
    
    $fechaHoy =(string) date('d/m/Y');
    $this->SetFont('Arial','B',14);
    $this->Image('../vistas/img/plantilla/logo.jpg',10,8,45,15,'JPG');
    $this->Cell(30);
    $this->SetTextColor(0, 0, 0);     

    if ($desReporte == "xFecha") {
      if ($tipoReporte == "resumido")    
         $this->Cell(200,10,'Reporte de Ordenes de Compra x Fecha',0,0,'C');
      if ($tipoReporte == "detallado")    
         $this->Cell(200,10,'Reporte Detallado de Ordenes x Fecha',0,0,'C');
    }else if ($desReporte == "xSaldos") {
      $this->Cell(200,10,'Reporte de Ordenes x Saldos',0,0,'C');
      $this->Ln(5);
      $this->Cell(260,10,'A la fecha: '. $fechaHoy ,0,0,'C');      
    }else if ($desReporte == "xFactura"){
      if ($tipoReporte == "resumido")    
         $this->Cell(200,10,'Reporte de Facturas x Fecha',0,0,'C');
      if ($tipoReporte == "detallado")    
         $this->Cell(200,10,'Reporte Detallado de Facturas x Fecha',0,0,'C');
    } // fin if

    if ($desReporte == "xFecha") {
      $this->Ln(5);
      $fechaIni= $_POST["fechaInicial"];
      $fechaFin= $_POST["fechaFinal"];
      $this->Cell(262,10,'Del: '. $fechaIni .' Hasta: '. $fechaFin ,0,0,'C');
        
      if ($tipoReporte == "resumido") {
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
      }// fin resumido

      if ($tipoReporte == "detallado") {
        $this->Ln(20);
        $this->SetFillColor(232,232,232);
      }// fin resumido 
    } else if ($desReporte == "xSaldos") {
        $this->Ln(20);
        $this->SetFillColor(232,232,232);
        $this->SetFont('Arial','B',8);
        $this->Cell(15,6,'# Orden',1,0,'C',1);
        $this->Cell(40,6,'Aseguradora',1,0,'C',1);
        $this->Cell(21,6,'# Factura',1,0,'C',1);
        $this->Cell(20,6,'F.Factura',1,0,'C',1);
        $this->Cell(20,6,'F.Present',1,0,'C',1);
        $this->Cell(28,6,'Monto',1,0,'C',1);
        $this->Cell(28,6,'De 0 a 30',1,0,'C',1);
        $this->Cell(28,6,'De 31 a 45',1,0,'C',1);
        $this->Cell(28,6,'De 46 a 60',1,0,'C',1);
        $this->Cell(28,6,'Mas 60',1,1,'C',1);
    } else if ($desReporte == "xFactura") {
        $this->Ln(5);
        $this->SetFont('Arial','',10);
        $fechaIni= $_POST["fechaInicial"];
        $fechaFin= $_POST["fechaFinal"];
        $this->Cell(262,10,'Del: '. $fechaIni .' Hasta: '. $fechaFin ,0,0,'C');
        if ($tipoReporte == "resumido") { 
          $this->Ln(15);
          $this->SetFillColor(232,232,232);
          $this->SetFont('Arial','B',8);
          $this->Cell(15,6,'Factura',1,0,'C',1);
          $this->Cell(28,6,'Orden',1,0,'C',1); 
          $this->Cell(15,6,'Placa',1,0,'C',1);
          $this->Cell(35,6,'Aseguradora',1,0,'C',1);
          $this->Cell(70,6,'Taller',1,0,'C',1);
          $this->Cell(25,6,'Monto',1,0,'C',1);
          $this->Cell(25,6,'Costo',1,0,'C',1);
          $this->Cell(25,6,'Utilidad',1,0,'C',1);
          $this->Cell(20,6,'% Utl',1,1,'C',1);
        } // fin if
        if ($tipoReporte == "detallado") {
          $this->Ln(20);
          $this->SetFillColor(232,232,232);
        }// fin resumido       
    }// fin if  
  } // fin Header() 
 
  function footer(){
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0,0,232);
    $this->Cell(10,10,'Pagina: -'. $this->PageNo().'-',0,0,'C');
  }// fin footer 
   
} // fin clas pdf

/*=============================================
      CLASE REPORTE ORDENES
=============================================*/     
class ReportesOrdenes{
  
  public $sReporte;
  public $fechaInicial;
  public $fechaFinal;
  
  public function reporteXfecha(){

    $tabla = "ordenes";
    $valor1 = $this->fechaInicial;
    $valor2 = $this->fechaFinal;
    $aseguradora =  $_POST["sAseguradora"];
    if ($aseguradora == "Todas") { 
      $ordenes = ModeloOrdenes::mdlReporteFecha($tabla, $valor1, $valor2);
    }else {
      $ordenes = ModeloOrdenes::mdlReporteFechaAs($tabla, $valor1, $valor2,$aseguradora);
    }
    //var_dump($ordenes);
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
      
    $fpdf->SetFont('Arial','',10);
    $totalMonto = 0;
    $totalCosto =0;    
    //var_dump($ordenes);   
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
      $fpdf->Cell(70,6,utf8_decode($taller),1,0,'');
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
     
  } // fin funcion reporteXfecha
  
  public function reporteXdetalle(){

    $tabla = "ordenes";
    $valor1 = $this->fechaInicial;
    $valor2 = $this->fechaFinal;
    $aseguradora =  $_POST["sAseguradora"];
    if ($aseguradora == "Todas") { 
      $ordenes = ModeloOrdenes::mdlReporteFecha($tabla, $valor1, $valor2);
    } else {
      $ordenes = ModeloOrdenes::mdlReporteFechaAs($tabla, $valor1, $valor2,$aseguradora);
    } 
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
    
    $linea = 0;
    foreach ($ordenes as $key => $reporte) {
      $linea = $linea + 60;
      $taller = substr($reporte["taller"], 0, 22);       
      $fpdf->SetFont('Arial','B',20);
      $fpdf->SetTextColor(123, 125, 125);  
      $fpdf->Cell(65,0,$reporte["aseguradora"],0,0,'L');
      $fpdf->SetTextColor(0, 0, 0);  
      $fpdf->SetFont('Arial','B',12);
      $fpdf->Cell(45,0,'# Orden: '.$reporte["orden"],0,0,'L');
      $fpdf->Cell(70,0,'Siniestro: '.$reporte["siniestro"],0,0,'L');
      $fpdf->Cell(50,0,'Fecha: '.$reporte["fechaOrden"],0,0,'L');
      $fpdf->Cell(40,0,'Plazo: '.$reporte["plazo"].' dias',0,1,'L');
      $fpdf->Cell(65,15,utf8_decode($taller),0,0,'L');
      $fpdf->Cell(45,15,'Placa: '.$reporte["placa"],0,0,'L');
      $fpdf->Cell(70,15,'Marca: '.$reporte["marca"],0,0,'L');
      $fpdf->Cell(50,15,'Modelo: '.$reporte["modelo"],0,0,'L');
      $fpdf->Cell(40,15,'Ano: '.$reporte["ano"],0,1,'L');
      $fpdf->Ln(10); 

      $fpdf->SetFillColor(232,232,232);
      $fpdf->SetFont('Arial','B',8);     
      $fpdf->Cell(28,6,'# Parte',1,0,'C',1);
      $fpdf->Cell(28,6,'Mia',1,0,'C',1); 
      $fpdf->Cell(20,6,'Compra',1,0,'C',1);
      $fpdf->Cell(65,6,'Descripcion',1,0,'C',1);
      $fpdf->Cell(25,6,'Monto',1,0,'C',1);
      $fpdf->Cell(25,6,'Costo',1,0,'C',1);
      $fpdf->Cell(25,6,'Utilidad',1,0,'C',1);
      $fpdf->Cell(20,6,'% Util',1,0,'C',1);
      $fpdf->Cell(20,6,'Estado',1,1,'C',1);

      $item = "idOrden";
      $valor = $reporte["id"];
     
      $lineas = ControladorLineas::ctrMostrarLineas($item, $valor);
      
      $totalMonto = 0;
      $totalCosto = 0;
      $totalUtilidad = 0;
      
      foreach ($lineas as $key => $value) {
        $totalMonto = $totalMonto + $value["totalVenta"];
        $monto = number_format($value["totalVenta"], 2, '.', ',');
        $costo = $value["TCompra"] + $value["totalCol"];
        $totalCosto = $totalCosto + $costo;
        $utilidad = $value["totalVenta"] - $costo;
        $totalUtilidad = $totalUtilidad + $utilidad;
        $porUtl = 0;
        if (($costo != 0) && ($utilidad != 0)) { 
           $porUtl = ($utilidad / $costo) * 100;
        }// fin if
        $porUtl =  number_format($porUtl, 2, '.', '') . " %";
        $utilidad = number_format($utilidad, 2, '.', ',');
        $costo = number_format($costo, 2, '.', ',');  
        $fpdf->Cell(28,6,$value["numParte"],1,0,'C');
        $fpdf->Cell(28,6,$value["numMia"],1,0,'C');
        $fpdf->Cell(20,6,$value["compra"],1,0,'C');
        $fpdf->Cell(65,6,utf8_decode($value["descripcion"]),1,0,'L');
        $fpdf->Cell(25,6,$monto,1,0,'R');
        $fpdf->Cell(25,6,$costo,1,0,'R');
        $fpdf->Cell(25,6,$utilidad,1,0,'R');
        $fpdf->Cell(20,6,$porUtl,1,0,'R');
        $fpdf->Cell(20,6,$value["estado"],1,1,'C');
        $linea = $linea + 6;
        //$fpdf->Line(10,$linea,265,$linea);
      }// fin foreach
      $totalUtl = 0;
      if (($totalCosto != 0) && ($totalUtilidad != 0)) { 
         $totalUtl = ($totalUtilidad / $totalCosto) * 100;
      }// fin if
      
      $totalMonto = number_format($totalMonto, 2, '.', ',');
      $totalCosto = number_format($totalCosto, 2, '.', ',');
      $totalUtilidad = number_format($totalUtilidad, 2, '.', ',');
      $totalUtl =  number_format($totalUtl, 2, '.', '') . " %";

      $fpdf->SetFillColor(232,232,232); 
      $fpdf->SetFont('Arial','B',8);
      $fpdf->Cell(141,6,'Total General =',1,0,'C',1);
         
      $fpdf->Cell(25,6,$totalMonto,1,0,'R',1);
      $fpdf->Cell(25,6,$totalCosto,1,0,'R',1);
      $fpdf->Cell(25,6,$totalUtilidad,1,0,'R',1);
      $fpdf->Cell(20,6,$totalUtl,1,0,'R',1);
      $fpdf->Cell(20,6,$reporte["estado"],1,1,'C',1);
      $fpdf->Ln(10);
      
    }// fin foreach  
    
    $fpdf->Output();
     
  } // fin funcion reporteXdetalle

  public function reporteVencimientos(){

    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
      
    $fpdf->SetFont('Arial','',10);
    
    $fechaHoy = new DateTime("now");

    $ordenes = ModeloOrdenes::mdlReporteSaldos();
    $cliente = null;

    $subTotal = 0;
    $sub0a30  = 0;
    $sub31a45 = 0;
    $sub46a60 = 0;
    $subMas60 = 0;

    $total    = 0;
    $tot0a30  = 0;
    $tot31a45 = 0;
    $tot46a60 = 0;
    $totMas60 = 0;
    foreach ($ordenes as $key => $reporte) {
      $monto        = $reporte["monto"];
      $total        += $monto;
      $De0a30       = 0;
      $De31a45      = 0;
      $De46a60      = 0;
      $Mas60        = 0;
      $aseguradora  = $reporte["aseguradora"];
      $presentacion = new DateTime($reporte["presentacion"]);   
      $diff = $fechaHoy->diff($presentacion);
      $dias =  $diff->days;
      if($cliente == null || $cliente == $aseguradora)
          $subTotal += $monto;

      if ($dias <= 30) {
        $De0a30   = $monto;
        $tot0a30 += $monto;
        if($cliente == null || $cliente == $aseguradora)
            $sub0a30 += $monto;
      } else if ($dias <= 45) {
          $De31a45 = $monto;
          $tot31a45 += $monto;
          if($cliente == null || $cliente == $aseguradora)
              $sub31a45 += $monto;
      } else if ($dias <= 60) {
          $De46a60 = $monto;
          $tot46a60 += $monto;
          if($cliente == null || $cliente == $aseguradora)
              $sub46a60 += $monto;
      } else if ($dias > 60) {
          $Mas60 = $monto;
          $totMas60 += $monto;
          if($cliente == null || $cliente == $aseguradora)
              $subMas60 += $monto;
      }// fin if
      if($cliente != $aseguradora){
        $fpdf->SetFont('Arial','B',12);
        if($cliente != null) {
          $fpdf->Cell(116,10,'Total '.$cliente.' =',1,0,'L');
          $fpdf->SetFont('Arial','B',10);
          $fpdf->Cell(28,10,number_format($subTotal, 2, '.', ','),1,0,'R');
          $fpdf->Cell(28,10,number_format($sub0a30, 2, '.', ','),1,0,'R');
          $fpdf->Cell(28,10,number_format($sub31a45, 2, '.', ','),1,0,'R');
          $fpdf->Cell(28,10,number_format($sub46a60, 2, '.', ','),1,0,'R');
          $fpdf->Cell(28,10,number_format($subMas60, 2, '.', ','),1,1,'R');
          $subTotal = $reporte["monto"];
          $sub0a30  = $De0a30;
          $sub31a45 = $De31a45;
          $sub46a60 = $De46a60;
          $subMas60 = $Mas60;
        }// fin
        $fpdf->Cell(256,10,strtoupper($reporte["aseguradora"]),1,1,'L');
        $cliente = $reporte["aseguradora"];
      }// fin

      $fpdf->SetFont('Arial','',7);
      $fpdf->Cell(15,6,$reporte["orden"],1,0,'C');
      $fpdf->Cell(40,6,$reporte["aseguradora"],1,0,'L');
      $fpdf->Cell(21,6,$reporte["factura"],1,0,'C');
      $fpdf->Cell(20,6,$reporte["fechaFactura"],1,0,'C');
      $fpdf->Cell(20,6,$reporte["presentacion"],1,0,'C');
      $fpdf->SetFont('Arial','',10);
      $fpdf->Cell(28,6,number_format($monto,2,'.',','),1,0,'R');
      $fpdf->Cell(28,6,number_format($De0a30,2,'.',','),1,0,'R');
      $fpdf->Cell(28,6,number_format($De31a45,2,'.',','),1,0,'R');
      $fpdf->Cell(28,6,number_format($De46a60,2,'.',','),1,0,'R');
      $fpdf->Cell(28,6,number_format($Mas60,2,'.',','),1,1,'R');
    }// fin for

    $total    = number_format($total, 2, '.', ',');
    $tot0a30  = number_format($tot0a30, 2, '.', ',');
    $tot31a45 = number_format($tot31a45, 2, '.', ',');
    $tot46a60 = number_format($tot46a60, 2, '.', ',');
    $totMas60 = number_format($totMas60, 2, '.', ',');

    $fpdf->SetFont('Arial','B',12);
    $fpdf->Cell(116,10,'Total '.$aseguradora.' =',1,0,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(28,10,number_format($subTotal, 2, '.', ','),1,0,'R');
    $fpdf->Cell(28,10,number_format($sub0a30, 2, '.', ','),1,0,'R');
    $fpdf->Cell(28,10,number_format($sub31a45, 2, '.', ','),1,0,'R');
    $fpdf->Cell(28,10,number_format($sub46a60, 2, '.', ','),1,0,'R');
    $fpdf->Cell(28,10,number_format($subMas60, 2, '.', ','),1,1,'R');

    $fpdf->SetFillColor(232,232,232); 
    $fpdf->SetFont('Arial','B',12);
    $fpdf->Cell(116,10,'Total General =',1,0,'C',1);
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(28,10,$total,1,0,'R',1);
    $fpdf->Cell(28,10,$tot0a30,1,0,'R',1);
    $fpdf->Cell(28,10,$tot31a45,1,0,'R',1);
    $fpdf->Cell(28,10,$tot46a60,1,0,'R',1);
    $fpdf->Cell(28,10,$totMas60,1,1,'R',1);
    
    $fpdf->Output();
    
  } // fin funcion Vencimientos
  
  public function reporteXfactura(){
    
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
      
    $fpdf->SetFont('Arial','',8);
    
    $tabla = "ordenes";
    $fechaIni = $this->fechaInicial;
    $fechaFin = $this->fechaFinal;
    $aseguradora =  $_POST["sAseguradora"];
    if ($aseguradora == "Todas") { 
       $ordenes = ModeloOrdenes::mdlReporteXfactura($fechaIni, $fechaFin);
    }else{ 
       $ordenes = ModeloOrdenes::mdlReporteXfacturaAs($fechaIni, $fechaFin, $aseguradora); 
    }
    $totalVenta = 0;
    $totalCosto = 0;
    $totalUtilidad = 0;
    $totalUtl = 0;
    //echo $aseguradora;
    //var_dump($ordenes);    
    foreach ($ordenes as $key => $reporte) {
      $venta = $reporte["venta"];
      $costo = $reporte["costo"];
      $utilidad = $reporte["venta"]-$reporte["costo"];
      $totalVenta = $totalVenta + $venta;
      $totalCosto = $totalCosto + $costo;
      $totalUtilidad = $totalUtilidad + $utilidad;
      $porUtl = 0;

      if (($costo != 0) && ($utilidad != 0)) { 
        $porUtl = ($costo / $utilidad) * 100 ;
      }// fin if
      $porUtl =  number_format($porUtl, 2, '.', '') . " %";
      $venta = number_format($venta, 2, '.', ',');
      $costo = number_format($costo, 2, '.', ',');
      $utilidad = number_format($utilidad, 2, '.', ',');
     
      $fpdf->Cell(15,6,$reporte["factura"],1,0,'C');
      $fpdf->Cell(28,6,$reporte["orden"],1,0,'C');
      $fpdf->Cell(15,6,$reporte["placa"],1,0,'L');
      $fpdf->Cell(35,6,$reporte["aseguradora"],1,0,'L');
      $fpdf->Cell(70,6, utf8_decode($reporte["taller"]),1,0,'L');
      $fpdf->Cell(25,6,$venta,1,0,'R');
      $fpdf->Cell(25,6,$costo,1,0,'R');
      $fpdf->Cell(25,6,$utilidad,1,0,'R');
      $fpdf->Cell(20,6,$porUtl,1,1,'R');         
    }// fin for 
    if (($totalCosto != 0) && ($totalUtilidad != 0)) { 
      $totalUtl = ($totalCosto / $totalUtilidad) * 100 ;
    }// fin if
    $totalUtl =  number_format($totalUtl, 2, '.', '') . " %";
    $totalVenta = number_format($totalVenta, 2, '.', ',');
    $totalCosto = number_format($totalCosto, 2, '.', ',');
    $totalUtilidad = number_format($totalUtilidad, 2, '.', ',');
          



    $fpdf->SetFillColor(232,232,232); 
    $fpdf->SetFont('Arial','B',9);
    $fpdf->Cell(163,6,'Total General =',1,0,'C',1);
    $fpdf->Cell(25,6,$totalVenta,1,0,'R',1);
    $fpdf->Cell(25,6,$totalCosto,1,0,'R',1);
    $fpdf->Cell(25,6,$totalUtilidad,1,0,'R',1);
    $fpdf->Cell(20,6,$totalUtl,1,1,'R',1);
    
    $fpdf->Output();
     
  } // fin funcion Facturas
  
  public function reporteXfacturaD(){
       
    $tabla = "articulos";
    $fechaIni = $this->fechaInicial;
    $fechaFin = $this->fechaFinal;
    $aseguradora =  $_POST["sAseguradora"];
    if ($aseguradora == "Todas") {   
      $resultado = ModeloLineas::mdlReporteFactD($fechaIni, $fechaFin);
    } else { 
      $resultado = ModeloLineas::mdlReporteFactDAs($fechaIni, $fechaFin,$aseguradora);
    } 
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
    
    $linea = 0;
    foreach ($resultado as $key => $reporte) {
      $linea = $linea + 60;
      $taller = substr($reporte["taller"], 0, 22);       
      $fpdf->SetFont('Arial','B',20);
      $fpdf->SetTextColor(123, 125, 125);  
      $fpdf->Cell(65,0,$reporte["aseguradora"],0,0,'L');
      $fpdf->SetTextColor(0, 0, 0);  
      $fpdf->SetFont('Arial','B',12);
      $fpdf->Cell(45,0,'# Factura: '.$reporte["factura"],0,0,'L');
      $fpdf->Cell(70,0,'Siniestro: '.$reporte["siniestro"],0,0,'L');
      $fpdf->Cell(50,0,'Fecha: '.$reporte["fechaFactura"],0,0,'L');
      $fpdf->SetFont('Arial','B',10);
      $fpdf->Cell(40,0,'# Orden '.$reporte["orden"],0,1,'L');
      $fpdf->SetFont('Arial','B',12);
      $fpdf->Cell(65,15,utf8_decode($taller),0,0,'L');
      $fpdf->Cell(45,15,'Placa: '.$reporte["placa"],0,0,'L');
      $fpdf->Cell(70,15,'Marca: '.$reporte["marca"],0,0,'L');
      $fpdf->SetFont('Arial','B',10);
      $fpdf->Cell(50,15,'Modelo: '.$reporte["modelo"],0,0,'L');
      $fpdf->SetFont('Arial','B',12);
      $fpdf->Cell(40,15,'Ano: '.$reporte["ano"],0,1,'L');
      $fpdf->Ln(10); 

      $fpdf->SetFillColor(232,232,232);
      $fpdf->SetFont('Arial','B',8);     
      $fpdf->Cell(28,6,'# Parte',1,0,'C',1);
      $fpdf->Cell(28,6,'Mia',1,0,'C',1); 
      $fpdf->Cell(20,6,'Compra',1,0,'C',1);
      $fpdf->Cell(65,6,'Descripcion',1,0,'C',1);
      $fpdf->Cell(25,6,'Monto',1,0,'C',1);
      $fpdf->Cell(25,6,'Costo',1,0,'C',1);
      $fpdf->Cell(25,6,'Utilidad',1,0,'C',1);
      $fpdf->Cell(20,6,'% Util',1,0,'C',1);
      $fpdf->Cell(20,6,'Estado',1,1,'C',1);

      $item = "numFactura";
      $valor = $reporte["factura"];
     
      $lineas = ControladorLineas::ctrMostrarLineas($item, $valor);
      
      $totalMonto = 0;
      $totalCosto = 0;
      $totalUtilidad = 0;
      
      foreach ($lineas as $key => $value) {
        $totalMonto = $totalMonto + $value["totalVenta"];
        $monto = number_format($value["totalVenta"], 2, '.', ',');
        $costo = $value["TCompra"] + $value["totalCol"];
        $totalCosto = $totalCosto + $costo;
        $utilidad = $value["totalVenta"] - $costo;
        $totalUtilidad = $totalUtilidad + $utilidad;
        $porUtl = 0;
        if (($costo != 0) && ($utilidad != 0)) { 
           $porUtl = ($utilidad / $costo) * 100;
        }// fin if
        $porUtl =  number_format($porUtl, 2, '.', '') . " %";
        $utilidad = number_format($utilidad, 2, '.', ',');
        $costo = number_format($costo, 2, '.', ',');  
        $fpdf->Cell(28,6,$value["numParte"],1,0,'C');
        $fpdf->Cell(28,6,$value["numMia"],1,0,'C');
        $fpdf->Cell(20,6,$value["compra"],1,0,'C');
        $fpdf->Cell(65,6,utf8_decode($value["descripcion"]),1,0,'L');
        $fpdf->Cell(25,6,$monto,1,0,'R');
        $fpdf->Cell(25,6,$costo,1,0,'R');
        $fpdf->Cell(25,6,$utilidad,1,0,'R');
        $fpdf->Cell(20,6,$porUtl,1,0,'R');
        $fpdf->Cell(20,6,$value["estado"],1,1,'C');
        $linea = $linea + 6;
        //$fpdf->Line(10,$linea,265,$linea);
      }// fin foreach
      $totalUtl = 0;
      if (($totalCosto != 0) && ($totalUtilidad != 0)) { 
         $totalUtl = ($totalUtilidad / $totalCosto) * 100;
      }// fin if
      
      $totalMonto = number_format($totalMonto, 2, '.', ',');
      $totalCosto = number_format($totalCosto, 2, '.', ',');
      $totalUtilidad = number_format($totalUtilidad, 2, '.', ',');
      $totalUtl =  number_format($totalUtl, 2, '.', '') . " %";

      $fpdf->SetFillColor(232,232,232); 
      $fpdf->SetFont('Arial','B',8);
      $fpdf->Cell(141,6,'Total Factura =',1,0,'C',1);
         
      $fpdf->Cell(25,6,$totalMonto,1,0,'R',1);
      $fpdf->Cell(25,6,$totalCosto,1,0,'R',1);
      $fpdf->Cell(25,6,$totalUtilidad,1,0,'R',1);
      $fpdf->Cell(20,6,$totalUtl,1,0,'R',1);
      $fpdf->Cell(20,6,'',1,1,'C',1);
      $fpdf->Ln(10);
      
    }// fin foreach  
    
    $fpdf->Output();
     
  } // fin funcion reporteXfacturaD

}// fin class ReportesOrdenes

/*=============================================
Reportes Ordenes
=============================================*/
if(isset($_POST["sReporte"])){
       
  $aReporte = new ReportesOrdenes();
  $aReporte -> sReporte = $_POST["sReporte"];
  $aReporte -> fechaInicial = $_POST["fechaInicial"];
  $aReporte -> fechaFinal = $_POST["fechaFinal"];
  $tipoReporte = $_POST["sTipo"];
  $desReporte = $_POST["sReporte"];
   
  if ($desReporte == "xFecha"){ 
    if ($tipoReporte == "resumido")
       $aReporte -> reporteXfecha();
    if ($tipoReporte == "detallado")
       $aReporte -> reporteXdetalle();
  } else if ($desReporte == "xSaldos"){
     $aReporte -> reporteVencimientos(); 
  } else if ($desReporte == "xFactura"){
      if ($tipoReporte == "resumido")
        $aReporte -> reporteXfactura();
      if ($tipoReporte == "detallado")
        $aReporte -> reporteXfacturaD();  
  }// fin if

} // fin if  

