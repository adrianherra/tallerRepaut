<?php
  
require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/proveedores.controlador.php";
require_once "controladores/ordenes.controlador.php";
require_once "controladores/ordenesDima.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/lineas.controlador.php";
require_once "controladores/lineasDima.controlador.php";
require_once "controladores/pagos.controlador.php";
require_once "controladores/casos.controlador.php";
require_once "controladores/galerias.controlador.php";
require_once "controladores/entradas.controlador.php";
require_once "controladores/facturas.controlador.php";
require_once "controladores/aseguradoras.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/proveedores.modelo.php";
require_once "modelos/ordenes.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/lineas.modelo.php";
require_once "modelos/pagos.modelo.php";
require_once "modelos/casos.modelo.php";
require_once "modelos/galerias.modelo.php";
require_once "modelos/entradas.modelo.php";
require_once "modelos/facturas.modelo.php";
require_once "modelos/aseguradoras.modelo.php";
require_once "fpdf/fpdf.php";
require_once "reportes/reporteRecepcion1.php";
require_once 'PHPMailer/Exception.php';
require_once 'PHPMailer/PHPMailer.php';
require_once 'PHPMailer/SMTP.php';


     
$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();