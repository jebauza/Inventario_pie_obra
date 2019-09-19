<?php
session_start();
include('modelo_obra.php');
  
if(isset($_POST['insertarO']))// Pregunta por boton insertar Obra
{
    
	$id_obra = $_POST['codObra'];
    $descriccion = $_POST['descriccion'];
	$tecnico = $_POST['tecnico'];
    $direccion = $_POST['direccion'];
	$ejecutor = $_POST['ejecutor'];
	$fdiaIni = $_POST['diaIni'];
	$fmesIni = $_POST['mesIni'];
	$fannoIni = $_POST['annoIni'];
	$fechaIni = $fannoIni."-".$fmesIni."-".$fdiaIni;
	$fdiaFin = $_POST['diaFin'];
	$fmesFin = $_POST['mesFin'];
	$fannoFin = $_POST['annoFin'];
	$fechaFin = $fannoFin."-".$fmesFin."-".$fdiaFin;
	$obra = new Obra();
	$existe = $obra->buscar_obra($id_obra);
	$inserto = true;
	$entre = false;
	if($existe == false)
	{  
	  $inserto = $obra->insertar_obra($id_obra,$descriccion,$tecnico,$ejecutor,$direccion,$fechaIni,$fechaFin);
	  
	}
	else
	{
	     $entre = true;
	     header ("location: vista_insertar_obra.php?var=errorObraCod");
	}
	if($inserto == false)
	   {
		  header ("location: vista_insertar_obra.php?var=errorObraBD");
	   }
	   else
	   {
	      if($entre == false)
		  {
		    header ("location: vista_insertar_obra.php?var=adicionObra");
		  } 
	   }
}
else
{
  header ("location: ../Principal/principal.php");
}

if(isset($_SESSION['user']))
{

}

?>
