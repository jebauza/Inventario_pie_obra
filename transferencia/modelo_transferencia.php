<?php
class Transferencia
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
  public function buscar_transferenciaId($id_trans)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `transferencia` WHERE idtrans = '".$id_trans."'";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	$obj=$resp->fetch_object();
	if(empty($obj->id_obra))
	{
	  return false;
	}
	return $obj;  
  }
  
  public function buscar_transferenciaTodo($numDoc,$fecha,$id_prod,$idObraSalida,$idObraEntrada)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM `transferencia` WHERE numdocumento = '".$numDoc."' and fecha = '".$fecha."' and idproducto = '".$id_prod."' and idobraRetiro = '".$idObraSalida."' and idobraEntrada = '".$idObraEntrada."'";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	$obj=$resp->fetch_object();
	if(empty($obj->idtrans))
	{
	  return false;
	}
	return $obj;  
  }
  
  public function todas_transferenciaProObra($id_prod,$idObra)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM transferencia WHERE idproducto = '".$id_prod."' and (idobraRetiro = '".$idObra."' or idobraEntrada = '".$idObra."') ORDER BY idobraEntrada";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return $resp;
  }
  
  public function todas_transferenciaPro($id_prod)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM obra inner join( transferencia inner join producto on transferencia.idproducto = producto.id_producto) on transferencia.idobraEntrada = obra.id_obra or transferencia.idobraRetiro = obra.id_obra WHERE idproducto = '".$id_prod."' ORDER BY obra.id_obra";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return $resp;
  }
  
  public function todas_transferenciaProObr($id_prod,$id_obra)
  {
      $conexLocalHost= $this->conexionBD();
	$sql = "SELECT * FROM transferencia WHERE idproducto = '".$id_prod."' and  (transferencia.idobraEntrada = '".$id_obra."' or transferencia.idobraRetiro = '".$id_obra."') ORDER BY idtrans";
	$resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	return $resp;
  }
  
  
  public function insertar_transferencia($numDoc,$fecha,$id_prod,$idObraSalida,$idObraEntrada,$cant,$idu)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = false;
	$sql = "INSERT INTO transferencia (numdocumento,fecha,idproducto,idobraRetiro,idobraEntrada,cantidad,iduser)
	VALUES ('".$numDoc."','".$fecha."','".$id_prod."','".$idObraSalida."','".$idObraEntrada."','".$cant."','".$idu."')";
      $conexLocalHost->query($sql);
	if($conexLocalHost->affected_rows > 0)
	{
	  $resp = true;
	}
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
  
  public function buscar_todasTablaObraProd()
  {
      $conexLocalHost= $this->conexionBD();
	 $sql = "SELECT * FROM totalprodobra inner join producto on totalprodobra.idp = producto.id_producto ORDER BY totalprodobra.idp";
	 $resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	 return $resp;
  }
  
  public function buscar_todasTablaObraProd2($idp)
  {
      $conexLocalHost= $this->conexionBD();
	 $sql = "SELECT * FROM obra inner join (totalprodobra inner join producto on totalprodobra.idp = producto.id_producto) on totalprodobra.ido = obra.id_obra WHERE producto.id_producto = '".$idp."' ORDER BY totalprodobra.ido";
	 $resp = $conexLocalHost->query($sql);
      $conexLocalHost->close();
	 return $resp;
  }
  

}


?>
