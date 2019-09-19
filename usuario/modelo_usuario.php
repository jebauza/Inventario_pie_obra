<?php
class Usuario
{
    private $servidor;
    private $usuarioBD;
    private $contrasennaBD;
    private $nombreBD;
    private $puertoBD;

    public function __construct()
    {

        $conexion = "";
        include '../BD/conexion.php';
        $this->servidor = $conexion['servidor'];
        $this->usuarioBD = $conexion['usuarioBD'];
        $this->contrasennaBD = $conexion['contrasennaBD'];
        $this->nombreBD = $conexion['nombreBD'];
        $this->puertoBD = $conexion['puertoBD'];

    }

    public function conexionBD()
    {

        $conexLocalHost=@mysql_connect($this->servidor, $this->usuarioBD, $this->contrasennaBD);
        if($conexLocalHost != false)
        {

            $conexLocalHost= new mysqli($this->servidor, $this->usuarioBD, $this->contrasennaBD,$this->nombreBD,$this->puertoBD);
        }
        else
        {
            echo mysql_error();die;
        }
        return $conexLocalHost;
    }
		
//Inserta el usuario y devuelve el # del id y false si no lo inserta lo puede hacer el Administrador y el mismo usario al subir un trabajo		
  public function insertar_usuario($nombre,$user,$pass,$rol,$activo)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
	     $sql = "INSERT INTO usuario (nombre,user,pass,rol,activo)
	     VALUES ('".$nombre."','".$user."','".$pass."','".$rol."','".$activo."')";
      $conexLocalHost->query($sql);
	     if($conexLocalHost->affected_rows > 0)
	       {
	          $resp = true;
	       }
      $conexLocalHost->close();
	     return $resp; 
  }
  
  //Busca un usuario dado el nombre y el correo 
  
  	
  public function buscar_usuario($user)
  {

      $conexLocalHost= $this->conexionBD();

	  $sql = "SELECT * FROM `usuario` WHERE user = '".$user."'";
	  $resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	 $obj=$resp->fetch_object();
	if(empty($obj->idusuario))
	{
	  return "vacio";
	}

	return $obj;  
  }
  
  // este buscar lo busca por id 
  
  
   public function buscar_usuario_id($idu)
  {
      $conexLocalHost= $this->conexionBD();
	  $sql = "SELECT * FROM `usuario` WHERE idusuario = '".$idu."'";
	  $resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	 $obj=$resp->fetch_object();
	if(empty($obj->idusuario))
	{
	  return "vacio";
	}
	return $obj;  
  }
  
  //Modifica a un usario y returna true o false si lo modifico	
  
  
  public function modificar_usuario($id_user,$user,$nombre,$pass,$rol,$activo)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
      $sql = "Update usuario Set nombre = '".$nombre."',user = '".$user."',pass = '".$pass."',rol = '".$rol."',activo = '".$activo."' Where idusuario = '".$id_user."'";
      $conexLocalHost->query($sql);
	  if($conexLocalHost->affected_rows > 0)
	  {
	    $resp = true;
	  }
      $conexLocalHost->close();
	  return $resp;
  }
  
  public function eliminar_usuario($id_user)
 {
     $conexLocalHost= $this->conexionBD();
     $resp = false;
	$sql = "DELETE FROM usuario WHERE usuario.idusuario =".$id_user."";
     $conexLocalHost->query($sql);
	if($conexLocalHost->affected_rows > 0)
	{
	  $resp = true;
	}
     $conexLocalHost->close();
	return $resp;
 }
 
 public function listar_usuario()
 {
     $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `usuario`";
	$resp = $conexLocalHost->query($sql);
     $conexLocalHost->close();
	return $resp;  
 } 
 
 
}
?>
