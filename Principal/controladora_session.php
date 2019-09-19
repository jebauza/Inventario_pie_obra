<?php session_start();?>
<?php
$entre = false;

if (isset($_POST['logeo'])) 
{
    
    $entre = true;
    include('../usuario/modelo_usuario.php');
	$usuario = $_POST['usuario'];
	$pass=$_POST['pass'];

    $user= new Usuario();
	$existe = $user->buscar_usuario($usuario);


    if($existe=="vacio" || $pass!=$existe->pass || $existe->activo == "no")
	{
		 header ("location: principal.php?var=errorLogeo");
	}
	else
	{
	      
		  $_SESSION['user'] = $usuario;
		  $_SESSION['iduser'] = $existe->idusuario;
		  $_SESSION['nombre'] = $existe->nombre;
		  $_SESSION['rol'] = $existe->rol;
		  $_SESSION['activo'] = $existe->activo;
		  //echo $_SESSION['user'];die;
		  header ("location: principal.php");
    } 		 		 
}
	   
if (isset($_GET['cerrar'])) 
{
    $entre = true;
       if($_GET['cerrar']==1)
	   {
	     unset($_SESSION['user']);	
		 unset($_SESSION['rol']);
		 unset($_SESSION['iduser']);
		 unset($_SESSION['nombre']);
	   }
	header ("location: principal.php");	
}

if($entre == false)
{
  header ("location: principal.php?var=12");
}

?>