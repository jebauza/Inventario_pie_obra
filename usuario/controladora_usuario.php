<?php
include('modelo_usuario.php');
session_start();  
$var = false;
if(isset($_POST['insertarUser']))// Pregunta por boton insertar trabajo
{
    $var = true;
    $activo = "no";
    if(isset($_POST['activo']))
	{
	  $activo = "si";
	}
	$nombre = $_POST['nombre'];
	$usuario = $_POST['usuario'];
	$pass = $_POST['pass'];
	$rol = $_POST['rol'];
	$clasUsuario = new Usuario();
	$existe = $clasUsuario->buscar_usuario($usuario);
	$inserto = true;
	$entre = false;
	if($existe == "vacio")
	{  
	  $inserto = $clasUsuario->insertar_usuario($nombre,$usuario,$pass,$rol,$activo);  
	}
	else
	{
	     $entre = true;
	     header ("location: vista_insertar_usuario.php?var=errorUserYaExis");
	}
	if($inserto == false)
	   {
		  header ("location: vista_insertar_usuario.php?var=errorUserBD");
	   }
	   else
	   {
	      if($entre == false)
		  {
		    header ("location: vista_insertar_usuario.php?var=adicionUser");
		  } 
	   }
}
if(isset($_POST['eliminarUsuarios']))
{
  $var = true;
  $numUser = $_POST['numUser'];
  $userEliminar = array();
  $clasUsuario = new Usuario();
  $existe = "";
  for($i = 1;$i < $numUser+1; $i++)
  {
     if(isset($_POST[$i]))
	 {
	   $userEliminar[count($userEliminar)] = $_POST[$i];
	 }
  }
  for($j = 0;$j < count($userEliminar); $j++)
  {
      if($clasUsuario->buscar_usuario_id($userEliminar[$j]) != "vacio")
	  {
	     $clasUsuario->eliminar_usuario($userEliminar[$j]);
	  }
  }
  header ("location: ../usuario/vista_lista_usuario.php?var=eliVariUser");
  
}
if(isset($_REQUEST['eliminarUser']))
{
   $var = true;
   $iduser = $_REQUEST['eliminarUser'];
   $clasUsuario = new Usuario();
   if($clasUsuario->buscar_usuario_id($iduser) != "vacio")
   {
	   $clasUsuario->eliminar_usuario($iduser);
   }
   header ("location: ../usuario/vista_lista_usuario.php?var=eliUser");
}
if(isset($_POST['modificarUser']))
{
    $var = true;
    $activo = "no";
    if(isset($_POST['activo']))
	{
	  $activo = "si";
	}
	$nombre = $_POST['nombre'];
	$usuario = $_POST['usuario'];
	$pass = $_POST['pass'];
	$rol = $_POST['rol'];
	$idu = $_POST['idU'];
	$clasUsuario = new Usuario();
	$existe = $clasUsuario->buscar_usuario($usuario);
	$modificar = false;
	$entre = false;
	if($existe == "vacio" || $existe->idusuario == $idu)
	{  
	  $modificar = $clasUsuario->modificar_usuario($idu,$usuario,$nombre,$pass,$rol,$activo);  
	}
	else
	{
	     $entre = true;
	     header ("location: vista_modificar_usuario.php?modificarUser=".$idu."|errorUserYaExis");
	}
	if($modificar == false && $entre == false)
	   {
		  header ("location: vista_modificar_usuario.php?modificarUser=".$idu."|errorUserBD");
	   }
	   else
	   {
	      if($entre == false)
		  {
		    header ("location: vista_lista_usuario.php?modificarUser=".$idu."|modificarUser");
		  } 
	   }
  
}





if($var == false)
{
  header ("location: ../Principal/principal.php");
}


?>
