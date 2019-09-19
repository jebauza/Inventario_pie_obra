<?php
class Movimiento
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
  public function buscar_movimiento($id_movimiento)
  {
      $conexLocalHost= $this->conexionBD();
          $sql = "SELECT * FROM `movimiento` WHERE idmov = '".$id_movimiento."'";
          $resp = $conexLocalHost->query($sql);
          $obj=$resp->fetch_object();
          if(empty($obj->idmov))
          {
              return false;
          }
      $conexLocalHost->close();
      return $obj;
  }
  
  public function buscar_tablaObraProd($ido,$idp)
  {
      $conexLocalHost= $this->conexionBD();
	  $sql = "SELECT * FROM `totalprodobra` WHERE idp = '".$idp."' and ido = '".$ido."'";
	  $resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	 $obj=$resp->fetch_object();
	if(empty($obj->idp))
	{
	  return "vacio";
	}
	return $obj;  
  }
  
  public function insertar_tablaObraProd($ido,$idp,$cant)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
	$sql = "INSERT INTO totalprodobra (idp,ido,canttotal)
	VALUES ('".$idp."','".$ido."','".$cant."')";
      $conexLocalHost->query($sql);
	if($conexLocalHost->affected_rows > 0)
	{
	  $resp = true;
	}
      $conexLocalHost->close();
	return $resp;
  }
  
  public function modificar_tablaObraProd($ido,$idp,$cant)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
	  $sql = "Update totalprodobra Set canttotal = '".$cant."' Where idp = '".$idp."' and ido = '".$ido."'";
      $conexLocalHost->query($sql);
	  if($conexLocalHost->affected_rows > 0)
	  {
	    $resp = true;
	  }
      $conexLocalHost->close();
	  return $resp;
  } 
  
  public function buscar_movimientoT($id_prod,$id_obra,$numdocumento,$operacion,$fecha,$idu)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM  `movimiento` WHERE  `idproducto` = '".$id_prod."' AND  `idobra` =  '".$id_obra."' AND  `numdocumento` =  '".$numdocumento."' AND  `operacion` = '".$operacion."'  AND  `fecha` =  '".$fecha."' AND iduser = '".$idu."'";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	$obj=$resp->fetch_object();
	if(empty($obj))
	{
	  return false;
	}
	return $obj;  
  }
  
  public function insertar_movimiento($cod_obr,$cod_prod,$num_doc,$TipoMovimiento,$fecha,$cantidad,$idu)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
	$sql = "INSERT INTO movimiento (idobra,idproducto,numdocumento,operacion,fecha,cantidad,iduser)
	VALUES ('".$cod_obr."','".$cod_prod."','".$num_doc."','".$TipoMovimiento."','".$fecha."','".$cantidad."','".$idu."')";
      $conexLocalHost->query($sql);
	if($conexLocalHost->affected_rows > 0)
	{
	  $resp = true;
	}
      $conexLocalHost->close();
	return $resp;
  }
  
 public function listar_movimientos()
 {
     $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `movimiento`";
	$resp = $conexLocalHost->query($sql);
     $conexLocalHost->close();
	return $resp;  
 }	
  
 public function todos_movimientos_idu($idu)
 {
     $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM movimiento WHERE iduser = '".$idu."' ORDER BY fecha";
	$resp = $conexLocalHost->query($sql);
     $conexLocalHost->close();
	return $resp;  
 } 
 
 public function todas_tablaObraProdM()
  {
      $conexLocalHost= $this->conexionBD();
	  $sql = "SELECT * FROM obra inner join( totalprodobra inner join producto on totalprodobra.idp = producto.id_producto) on totalprodobra.ido = obra.id_obra ORDER BY obra.id_obra";
	  $resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return  $resp;  
  }
 
  
 
 
}
?>
