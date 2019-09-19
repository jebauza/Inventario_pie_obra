<?php
class Producto
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
  public function buscar_producto($id_product)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `producto` WHERE id_producto = '".$id_product."'";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	$obj=$resp->fetch_object();
	if(empty($obj->idmov))
	{
	  return false;
	}
	return $obj;  
  }
  
  public function insertar_producto($id_product,$descriccion,$unidadmedida,$preciomn,$preciocuc)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
	$sql = "INSERT INTO producto (id_producto,descricion_prod,unidad_medida,precio_mn,precio_cuc)
	VALUES ('".$id_product."','".$descriccion."','".$unidadmedida."','".$preciomn."','".$preciocuc."')";
      $conexLocalHost->query($sql);
	if($conexLocalHost->affected_rows > 0)
	{
	  $resp = true;
	}
      $conexLocalHost->close();
	return $resp;
  }
  
   public function todos_los_productos()
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `producto`";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return $resp;
  }
 
 
}
?>
