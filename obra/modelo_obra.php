<?php
class Obra
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
  public function buscar_obra($id_obra)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `obra` WHERE id_obra = '".$id_obra."'";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	$obj=$resp->fetch_object();
	if(empty($obj->id_obra))
	{
	  return false;
	}
	return $obj;  
  }
  
  public function insertar_obra($id_obra,$descriccion,$tecnico,$ejecutor,$direccion,$fechaIni,$fechaFin)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
	$sql = "INSERT INTO obra (id_obra,descricion,tecnico_obra,ejecutor_obra,dirrecion_obra,fecha_ini,fecha_fin)
	VALUES ('".$id_obra."','".$descriccion."','".$tecnico."','".$ejecutor."','".$direccion."','".$fechaIni."','".$fechaFin."')";
      $conexLocalHost->query($sql);
	if($conexLocalHost->affected_rows > 0)
	{
	  $resp = true;
	}
      $conexLocalHost->close();
	return $resp;
  }
  
  public function todas_las_obras()
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `obra`";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return $resp;
  }
  
  public function todas_las_obrasProducto($id_prod)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM obra inner join movimiento on obra.id_obra = movimiento.idobra WHERE movimiento.idproducto = ".$id_prod." ORDER BY obra.id_obra";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return $resp;
  }
  
  public function todas_movimientosObrProd($id_prod)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM producto inner join( movimiento inner join obra on movimiento.idobra = obra.id_obra) on movimiento.idproducto = producto.id_producto WHERE idproducto = '".$id_prod."' ORDER BY obra.id_obra";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return $resp;
  }
  
 
 
}
?>
