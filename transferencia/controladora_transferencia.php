<?php
session_start();
if(isset($_POST['inserTransf']))// Pregunta por boton insertar trabajo
{
	$nummDocT = $_POST['nummDocT'];
	$datos = explode("|", $_POST['cod_obraSalida']);
	$cod_prod = $datos[2];
    $cod_obraSalida = $datos[0];
	$cantTrans = $_POST['cantTrans'];
    $cod_obraEntrada = explode("|", $_POST['cod_obraEntrada'])[0];
	$fdia = $_POST['dia'];
	$fmes = $_POST['mes'];
	$fanno = $_POST['anno'];
	$fecha = $fanno."-".$fmes."-".$fdia;
	include('modelo_transferencia.php');
	include('../movimiento/modelo_movimiento.php');
	$transferencia = new Transferencia();
	$existe = $transferencia->buscar_transferenciaTodo($nummDocT,$fecha,$cod_prod,$cod_obraSalida,$cod_obraEntrada);
	$ClasMovimiento = new Movimiento();
	$existeTOPentrada = $ClasMovimiento->buscar_tablaObraProd($cod_obraEntrada,$cod_prod);
	$inserto = true;
	$entre = false;
	if($existe == false)
	{  
	  $inserto = $transferencia->insertar_transferencia($nummDocT,$fecha,$cod_prod,$cod_obraSalida,$cod_obraEntrada,$cantTrans,$_SESSION['iduser']);
	  if($existeTOPentrada == "vacio")
	  {
	    $ClasMovimiento->insertar_tablaObraProd($cod_obraEntrada,$cod_prod,0);
	  }
	  $existeTOPentrada = $ClasMovimiento->buscar_tablaObraProd($cod_obraEntrada,$cod_prod);
	  $existeTOPsalidad = $ClasMovimiento->buscar_tablaObraProd($cod_obraSalida,$cod_prod);
	  $ClasMovimiento->modificar_tablaObraProd($cod_obraEntrada,$cod_prod,$existeTOPentrada->canttotal + $cantTrans);
	  $ClasMovimiento->modificar_tablaObraProd($cod_obraSalida,$cod_prod,$existeTOPsalidad->canttotal - $cantTrans);  
	}
	else
	{
	     $entre = true;
	     header ("location: vista_insertar_transferencia.php?var=errorTransYaExis");
	}
	if($inserto == false)
	   {
		  header ("location: vista_insertar_transferencia.php?var=errorTransBD");
	   }
	   else
	   {
	      if($entre == false)
		  {
		    header ("location: vista_insertar_transferencia.php?var=adicionTrans");
		  } 
	   } 
}
else
{
  header ("location: ../Principal/principal.php");
}

?>
