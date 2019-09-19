<?php
session_start();  
$var = false; 
if(isset($_POST['insertar']))// Pregunta por boton insertar trabajo
{
    //$f = $_POST['fecha'];
	//echo $f;die;
	$var = true;
	$fdia = $_POST['dia'];
	$fmes = $_POST['mes'];
	$fanno = $_POST['anno'];
	$fecha = $fanno."-".$fmes."-".$fdia;
    $cod_obr = $_POST['cod_obr'];
	$cod_prod = $_POST['cod_prod'];
    $num_doc = $_POST['num_doc'];
	$cantidad = $_POST['cantidad'];
	$TipoMovimiento = $_POST['TipoMovimiento'];
	$puedeCrear = false;
	include('../transferencia/modelo_transferencia.php');
	include('../Funcionalidades/modelo_funciones.php');
	include('modelo_movimiento.php');
    $Clasfunciones = new Funciones();
    $ClasTransferencia = new Transferencia();
	$ClasMovimiento = new Movimiento();
	$existeMOP = $ClasMovimiento->buscar_tablaObraProd($cod_obr,$cod_prod);
	$envie = false;
	$error = array();
	$puedeCrear = true;
	if($existeMOP == "vacio")
	{
	     //echo "entre";die;
	     if($TipoMovimiento == "existencia")
	     { 
		    $puedeCrear == false;
		    header ("location: vista_insertar_movimiento.php?var=errorCantMov");
	     }
		 else
		 {
		    //echo "entre";die;
		   $error['ItablaObraProd'] = $ClasMovimiento->insertar_tablaObraProd($cod_obr,$cod_prod,0);
		 }
	}
	if($puedeCrear == true)
	{
	     $Total = 0;
		 if($existeMOP != "vacio")
		 {
		   $Total = $existeMOP->canttotal;
		 }
		 if($TipoMovimiento == "entrada")
		 {
		   $error['MtablaObraProd'] = $ClasMovimiento->modificar_tablaObraProd($cod_obr,$cod_prod,$Total + $cantidad);
		 }
		 else
		 {
		   if($Total > $cantidad)
	        { 
		       $error['MtablaObraProd'] = $ClasMovimiento->modificar_tablaObraProd($cod_obr,$cod_prod,$cantidad);   
	           $puedeCrear = true;
			   $cantidad = $Total - $cantidad;
	        }
	        else
	        {   
			    $puedeCrear = false;
			    header ("location: vista_insertar_movimiento.php?var=errorCantMov");
	        }
		 }
	 } 
	 if($TipoMovimiento == "entrada" || $puedeCrear == true)
	 {
	    $existe = $ClasMovimiento->buscar_movimientoT($cod_prod,$cod_obr,$num_doc,$TipoMovimiento,$fecha,$_SESSION['iduser']);
	    $inserto = true;
	    $entre = false;
	    if($existe == false)
	    {  
		   //echo "entre";die;
	       $inserto = $ClasMovimiento->insertar_movimiento($cod_obr,$cod_prod,$num_doc,$TipoMovimiento,$fecha,$cantidad,$_SESSION['iduser']);
	    }
	    else
	    {
		    $entre = true;     
	       header ("location: vista_insertar_movimiento.php?var=errorMovExis");
	    }
	    if($inserto == false)
	    {
	        
		    header ("location: vista_insertar_movimiento.php?var=errorMovBD");
	    }
	    else
	    {
		  if($entre == false)
		  {
		    header ("location:  vista_insertar_movimiento.php?var=adicionMov");
		  } 
	    }
	 }
}

if(isset($_POST['addMat']))
{
  $var = true;
  $fdia = $_POST['dia'];
  $fmes = $_POST['mes'];
  $fanno = $_POST['anno'];
  $fecha = $fanno."-".$fmes."-".$fdia;
  $cod_prod = $_POST['cod_prod'];
  $cantidad = $_POST['cantidad'];
  $GLOBALS['addVale'] = array($_POST['TipoMovimiento'],$_POST['cod_obr'],$fecha,$_POST['num_doc'],array(array($cod_prod,$cantidad)));
  //$GLOBALS['addVale'] = 
}


if($var == false)
{
  header ("location: ../Principal/principal.php");
}
 /*  $movimientosF = $Clasfunciones->buscar_movimiento($cod_prod,$cod_obr);
	   $todasTransferencias = $ClasTransferencia->todas_transferenciaProObra($cod_prod,$cod_obr);
       $i = 0;
       $arreglo = array();
       $cant = 0;
       while($mov=$movimientosF->fetch_object())
       { 
	       if($mov->operacion == "entrada")
	       {
	         $cant = $cant + $mov->cantidad;
	       }
	       else
	       {
	          $cant = $cant - $mov->cantidad;
	       }
	       $i = $i + 1;
       }
	   
	   while($trans=$todasTransferencias->fetch_object())
       { 
	       if($trans->idobraEntrada == $cod_obr)
	       {
	         $cant = $cant + $trans->cantidad;
	       }
	       else
	       {
	          $cant = $cant - $trans->cantidad;
	       }
       }
	  if($cant < $cantidad)
	   { 
		 header ("location: vista_insertar_movimiento.php?var=errorCantMov");
	   }
	   else
	   {   
	       $cantidad = $cant - $cantidad;
	       $puedeCrear = true;
	   }
	}*/

?>
