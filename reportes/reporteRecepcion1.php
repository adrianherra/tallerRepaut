<?php
      
          
/*=============================================
             CLASE PDF
=============================================*/
class PDF extends FPDF{

  function Header(){ 
    
    $fechaHoy =(string) date('d/m/Y');
    $this->Image('vistas/img/plantilla/logo1.jpg',10,8,45,15,'JPG');
    $this->Cell(30);
    $this->SetFont('Arial','B',16);
    $this->SetTextColor(123, 125, 125);     
    $this->Cell(208,5,utf8_decode('Reporte de Ingreso de Vehículo'),0,1,'C');
    $this->SetTextColor(0, 0, 0);
    $this->SetFont('Arial','B',14);
    $this->Cell(270,7,utf8_decode('Carroceria y Pintura Repaut, S.A.'),0,1,'C');
    $this->SetFont('Arial','',10);
    $this->SetTextColor(123, 0, 232);
    $this->Cell(270,5,utf8_decode('Céd Jurid: 3-101-538188'),0,1,'C');
    $this->Cell(270,5,utf8_decode('Téls: (506)2591-7532 - (506)2591-4242 - (506)2591-4243 - (506)8396-0988'),0,1,'C');
    $this->Cell(270,5,utf8_decode('Email:presidencia@repaut.com www.repaut.com'),0,1,'C');
    $this->Cell(270,5,utf8_decode('Costado Este Plaza de San Blas, Cartago, Costa Rica'),0,1,'C');
    
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
class ReporteRecepcion{
       
  public function generaReporte($idReporte){
    
    $item = "id";
    $valor = $idReporte;
       
    $respuesta = ModeloEntradas::mdlMostrarEntradasC($item, $valor);
    
    $placa = utf8_decode($respuesta["placa"]);
    
    $marca = ucwords(utf8_decode($respuesta["marca"]));

    $nombreArchivo = 'vistas/img/recepcion/Recepcion'.trim($marca).'-'.trim($placa).'.pdf';
    
    $fpdf = new PDF();
    $fpdf->AddPage('LANDSCAPE','letter'); 
    $fpdf->SetFont('Arial','B',14);
    $fpdf->SetTextColor(123, 125, 125);
    $fpdf->Cell(260,20,"Fecha: ".$respuesta["fecha"],0,1,'R');
    $fpdf->SetFont('Arial','B',18);
    $fpdf->SetTextColor(0, 0, 0);
    $fpdf->Line(10,57,270,57); 
    $fpdf->Cell(55,0,"Placa: ".$placa,0,0,'L');
    
    $fpdf->SetFont('Arial','',12);
    $fpdf->Cell(85,0,'Cliente: '.utf8_decode($respuesta["nombre"]),0,0,'L'); 
    $fpdf->Cell(80,0,'Email: '.utf8_decode($respuesta["email"]),0,0,'L'); 
    $fpdf->Cell(45,0,utf8_decode('Teléfono: ').utf8_decode($respuesta["telefono"]),0,1,'L'); 
    $fpdf->Cell(55,15,utf8_decode('Aseguradora: ').utf8_decode($respuesta["aseguradora"]),0,0,'L');
    $fpdf->SetFont('Arial','',12);
    $fpdf->Cell(210,15,utf8_decode('Dirección: ').utf8_decode($respuesta["direccion"]),0,1,'L');
    $fpdf->Line(10,75,270,75);
    $fpdf->Cell(45,5,utf8_decode('Marca: ').$marca,0,0,'L');
    $fpdf->Cell(45,5,utf8_decode('Modelo: ').utf8_decode($respuesta["modelo"]),0,0,'L');
    $fpdf->Cell(25,5,utf8_decode('Año: ').utf8_decode($respuesta["ano"]),0,0,'L');
    $fpdf->Cell(45,5,utf8_decode('Kilometraje: ').utf8_decode($respuesta["kms"]),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(50,5,utf8_decode('#Vin: ').utf8_decode($respuesta["vin"]),0,0,'L');
    $fpdf->Cell(50,5,utf8_decode('#Motor: ').utf8_decode($respuesta["motor"]),0,1,'L');
    $fpdf->SetFont('Arial','',12);
    $fpdf->Cell(60,10,utf8_decode('Tanque: ').utf8_decode($respuesta["tanque"]).' - '.utf8_decode($respuesta["tipoComb"]),0,0,'L');
    $fpdf->Cell(30,10,utf8_decode('#Cono: ').utf8_decode($respuesta["cono"]),0,0,'L');
    $fpdf->Cell(120,10,utf8_decode('Observación: ').utf8_decode($respuesta["observacion"]),0,1,'L');
    $fpdf->Line(10,92,270,92);
    $fpdf->SetFont('Arial','B',14);
    $fpdf->Cell(130,10,utf8_decode('Imagen de Inspección'),0,0,'C');
    $fpdf->Cell(120,10,utf8_decode('Objetos Vehículo'),0,1,'C');
    $fpdf->SetFillColor(232,232,232);
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(125,10,'',0,0,'C');
    $fpdf->Cell(22,8,'Radio',1,0,'C',1);
    $fpdf->Cell(22,8,'Antena',1,0,'C',1);
    $fpdf->Cell(22,8,'Triangulos',1,0,'C',1);
    $fpdf->Cell(22,8,'Repuesto',1,0,'C',1);
    $fpdf->Cell(22,8,'Libros',1,0,'C',1);
    $fpdf->Cell(22,8,'Llavero',1,1,'C',1);
    $fpdf->Cell(125,10,'',0,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["radio"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["antena"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["triangulos"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["repuesto"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["libros"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["llavero"]),1,1,'C');
    $fpdf->Cell(125,10,'',0,0,'C');
    $fpdf->Cell(22,8,'Copas',1,0,'C',1);
    $fpdf->Cell(22,8,'Alfombras',1,0,'C',1);
    $fpdf->Cell(22,8,'Extintor',1,0,'C',1);
    $fpdf->Cell(22,8,'Gata',1,0,'C',1);
    $fpdf->Cell(22,8,'Document.',1,0,'C',1);
    $fpdf->Cell(22,8,'Encendedor',1,1,'C',1);
    $fpdf->Cell(125,10,'',0,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["copas"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["alfombras"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["extintor"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["gata"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["documentos"]),1,0,'C');
    $fpdf->Cell(22,8,utf8_decode($respuesta["encendedor"]),1,1,'C');
    $fpdf->Cell(125,10,'',0,0,'C');
    $fpdf->Cell(66,8,utf8_decode('Radio Marca..: '.$respuesta["radioMarca"]),1,0,'L');
    $fpdf->Cell(66,8,utf8_decode('Bateria Marca: '.$respuesta["bateriaMarca"]),1,1,'L');
    $fpdf->Cell(130,10,'',0,0,'C');
    $fpdf->SetFont('Arial','B',14);
    $fpdf->Cell(120,10,utf8_decode("Descripción de Piezas"),0,1,'C');
    $fpdf->Cell(125,10,'',0,0,'C');
    $fpdf->SetFont('Arial','',12);
    $fpdf->MultiCell(133,5,utf8_decode($respuesta["piezas"]),1,'J',false);
    $fpdf->Ln(10);
    $fpdf->SetLineWidth(0.6);
    $fpdf->SetDrawColor(123, 125, 125);
    $fpdf->Line(20,102.5,124,102.5);
    $fpdf->Line(19.7,182,19.7,102.5);
    $fpdf->Image(''.$respuesta["imagen"],20,103,100,80);
    $fpdf->Line(124,182,124,102.5);
    $fpdf->Line(20,182,124,182);
    $fpdf->SetFont('Arial','B',14);
    $fpdf->Ln(40);
    $fpdf->Cell(270,10,utf8_decode("Contrato Por Presentación De Servicios"),0,1,'C');
    $fpdf->Cell(270,5,utf8_decode("Garantía Por Reparación Del Vehículo Por Trabajos Realizados"),0,1,'C');
    $fpdf->Cell(270,10,utf8_decode("Entre El Taller Y El Clíente"),0,1,'C');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(15,10,utf8_decode("Primera:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(45,10,utf8_decode("El dueño del  vehículo o la persona autorizada por aquel de hecho o  derecho,  que  solicita la  ejecución o  firma  consta  en  el presente  documento,"),0,1,'L');
    $fpdf->Cell(45,0,utf8_decode("reconoce y acepta que las siguietes forman parte del contrato que ahora se celebra con CARROCERIA Y PINTURA REPAUT S.A., en lo sucesivo denominado"),0,1,'L');
    $fpdf->Cell(45,10,utf8_decode('"La Empresa".'),0,1,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(17,5,utf8_decode("Segunda:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(45,5,utf8_decode("El pago de los trabajos enderezado y pintura, mecanica y otros servicios prestados por La Empresa deberá realizarlos El Cliente  en  la  condiciones"),0,1,'L');
    $fpdf->Cell(15,5,utf8_decode("que determinen la partes en cada caso de conformidad con el diagnóstico previo por  las personas  encargadas  sobre el particular en  La Empresa  el  cual  no"),0,1,'L');
    $fpdf->Cell(15,5,utf8_decode("incluye el impuesto de valor agregado correspondiente que será cargado al moemento de la facturación respectiva El Cliente asume el compromiso de pago del"),0,1,'L');
    $fpdf->Cell(15,5,utf8_decode("precio de los repuestos, materiales, gastos, mano obra y/o subcontrataciones de servicos  de  terceros  que  se  requieren  contra  facturación  que  le  presente"),0,1,'L');
    $fpdf->Cell(15,5,utf8_decode("La Empresa reconoce que la obligación anterior no se encuentra sujeta en forma alguna a su firma de esas facturas."),0,1,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(15,10,utf8_decode("Tercera:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(15,10,utf8_decode("Transcurridas cuarenta y ocho horas a partir del aviso que los trabajadores han finalizado El Cliente exime a La Empresa de toda responsabilidad que"),0,1,'L');
    $fpdf->Cell(15,0,utf8_decode("pudiera derivarse por deterioro del vehículo. Así  mismo  transcurrido  ese  plazo  El Cliente  deberá  cubrir  adicionalmente  la  suma  de  TRES MIL COLONES"),0,1,'L');
    $fpdf->Cell(15,10,utf8_decode("EXACTOS (3.000) por estacionamiento en nuestras instalaciones."),0,1,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(13,5,utf8_decode("Cuarta:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(45,5,utf8_decode("La Empresa no será responsable en los siguientes casos: "),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(15,5,utf8_decode("a) En caso de sisniestro o incendio de los vehículos depositados en su establecimiento  que cuenten con pólizas  de  seguro  propia  para  esas"),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(45,5,utf8_decode("coberturas, independientemente del monto del seguro existente."),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(15,5,utf8_decode("b) En caso demora en la entrega por faltas de piezas o repuestos  o  cualquier  otra  razón  no  imputable  directamente  a  La Empresa,  de  los"),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(15,5,utf8_decode("daños o perjuicios sufridos por el cliente dueño o terceras personas como resultado de la demora."),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(15,5,utf8_decode("c) En caso de daño o pérdidas de objetos dejados en el vehículo que no se encuentren  enunciados  en el inventario preparado por La Empresa"),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(15,5,utf8_decode("al recibir el vehículo. Las restituciones ó indemnizadiones por objetos  perdidos  ó dañados  cuya marca o calidad  no se  especiquen  se  háran"),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(15,5,utf8_decode("por cuenta de La Empresa, al tenor de lo establecido en el artículo 770 del Código  Civil en relación con el  artículo 38  de la Ley  de  Promoción"),0,1,'L');
    $fpdf->Cell(25,5,utf8_decode(""),0,0,'L');
    $fpdf->Cell(15,5,utf8_decode("de la Competencia y Defensa al Consumidor."),0,1,'L');
    $fpdf->Ln(30);
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(13,10,utf8_decode("Quinta:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,10,utf8_decode("En caso de no ser cancelada la factura devengará un interés anual del (establecer el interés) que empieza a computarse a partir de la fecha de emisión"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode("de la factura El Cliente, acepta expresamente la condición. La factura constituye el título  ejecutivo  contra El Cliente  quien  para  efectos de  un eventual  cobro"),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode("judicial renuncia a su domicilio, requerimientos y demás trámites de jucio ejecutivo, asi mismo autoriza a las personas  que en nombre realicen   gestiones  ante"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode("La Empresa, para firmar facturas sin que por  ello pierdan  el cáracter del título  ejecutivo. En  eventualidad  de remate  del  vehículo  por  falta  de  pago  de  las"),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode("facturas respectivas, la base de remate será el monto adeudado  a la reparación, más lo que corresponde a bodegaje, parqueo, gastos de conservación  y otros"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode("cargos a la fecha del remate."),0,1,'L');
    $fpdf->Ln(3);
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(11,10,utf8_decode("Sexta:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,10,utf8_decode("Desde el momento de la entrega del vehículo en nuestras instalaciones, el mismo queda cubierto por  la póliza de  responsabilidad civil subcripta entre el "),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode("Instituto Nacional de Seguros y La Empresa. El valor de esa póliza corre por cuenta de La Empresa."),0,1,'L');
    $fpdf->Ln(3);
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(13,10,utf8_decode("Setima:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,10,utf8_decode("El Cliente acepta que el vehículo sea conducido  fuera  de  las instalaciones  del  taller,  por  el  personal  que  La  Empresa  designe,  con  el  objeto  de"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode("comprobar el desperfecto indicado por el cliente,  dueño o persona autorizada en el presente contrato, así mismo, para determinar  que  la reparación  del  auto-"),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode("móvil sea satisfactoria."),0,1,'L');
    $fpdf->Ln(3);
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(14,0,utf8_decode("Octava:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,0,utf8_decode("A  la entrega  del  vehículo  El Cliente  indicará a  La Empresa si desea retirar también las posibles piezas sustuidas  como  resultado  de  la  reparación"),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode("realizada. En caso afirmativo, deverá retirarlas en el mismo momento en que retire el vehículo pues de lo contrario las  piezas serán desechadas, como  chatarra"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode("sin responsabilidad para La Empresa."),0,1,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Ln(3);
    $fpdf->Cell(15,10,utf8_decode("Novena:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,10,utf8_decode("El Cliente se compromete a revisar el vehículo al serle entregado, para verificar la reparación ordenada así como el inventario correspondiente."),0,1,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Ln(3);
    $fpdf->Cell(15,0,utf8_decode("Decima:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,0,utf8_decode("La Empresa, no se hacer responsable por daños visibles al vehículo, parabrisas, tapiceria, llantas de repuestos y covertor. El Cliente  se  obliga  dentro"),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode("de lo posible a presentar el vehículo en La Empresa lavado sin polvo o barro y en buen estado de limpieza."),0,1,'L');
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Ln(3);
    $fpdf->Cell(29,0,utf8_decode("Decima Primera:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,0,utf8_decode("El cargo por revisión (diagnóstico) es de  10%  del  presupuesto  sobre el monto de la mano de  obra  para  la  reparación  establecida  por  La"),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode("Empresa, aún cuando El Cliente no ordene la reparación del equipo."),0,1,'L');
    $fpdf->Ln(60);
    $fpdf->SetFont('Arial','B',10);
    $fpdf->Cell(31,20,utf8_decode("Decima Segunda:"),0,0,'L');
    $fpdf->SetFont('Arial','',10);
    $fpdf->Cell(25,20,utf8_decode("La garantía que se dará se aplica  únicamente  a los casos de reaparación del vehículo, toda vez que en los casos de reclamo de garantía se"),0,1,'L');
    $fpdf->Ln(-9);
    $fpdf->Cell(25,10,utf8_decode("aplicará esta así. La Empresa en los casos de reparación garantiza su trabajo y repuestos por un período de dos años después de cinco piezas  reparadas y seis"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode("meses menor a lo antes indicado a partir de la facturación, con las siguientes excepciones:"),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode(""),0,0,'L');
    $fpdf->Cell(25,10,utf8_decode("a) El vehículo en todo momento durante el plazo de garantía debe ser analizado,  diagnosticado y reparado única  y exclusivamente  por  el  taller"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode(""),0,0,'L');
    $fpdf->Cell(25,0,utf8_decode("La Empresa, caso contrario El Cliente pierde automaticamente el derecho a la garantía."),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode(""),0,0,'L');
    $fpdf->Cell(25,10,utf8_decode("b) La garantía no cubre las reparaciones, ajustes requeridos por el mal uso, negligencia, modificación, alterarición del  estado  original,  manipula-"),0,1,'L');
    $fpdf->Cell(25,0,utf8_decode(""),0,0,'L');
    $fpdf->Cell(25,0,utf8_decode("ción indebida, utilización de liquidos o combustibles distintos a los utilizados por el taller."),0,1,'L');
    $fpdf->Cell(25,10,utf8_decode(""),0,0,'L');
    $fpdf->Cell(25,10,utf8_decode("c) Cuando el daño causado sea producto de mala oparación del vehículo por parte de El Cliente o tercero."),0,1,'L');
    $fpdf->Ln(10);
    $fpdf->SetFont('Arial','B',14);
    $fpdf->Cell(120,16,utf8_decode("Contacto"),0,0,'C');
    $fpdf->Cell(140,16,utf8_decode("Cliente"),0,1,'C');
    $fpdf->Line(35,150,104,150);
    $fpdf->Line(165,150,234,150);
      
    $fpdf->Output($nombreArchivo,'F');
    
  } // fin funcion reporteXfecha
  
}// fin class ReporteRecepcion

 