<?php
class Funciones
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
  public function buscar_movimiento($id_prod,$id_obr,$fechaInc,$fechaFin)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = [];
      if($conexLocalHost != false)
      {
          $sql = "SELECT * FROM `movimiento` WHERE idobra = '".$id_obr."' and idproducto = '".$id_prod."' and fecha >= '".$fechaInc."' and fecha <= '".$fechaFin."' order by idobra, idproducto";
          $resp = $conexLocalHost->query($sql);
      }
      $conexLocalHost->close();
      return $resp;
  }
  
  public function todos_movimientoFecIniFechaFin($fechaInc,$fechaFin)
  {
      $conexLocalHost= $this->conexionBD();
      $resp = [];
      if($conexLocalHost != false)
      {
          $sql = "SELECT * FROM obra inner join( producto inner join movimiento on producto.id_producto = movimiento.idproducto) on obra.id_obra = movimiento.idobra WHERE fecha >= '".$fechaInc."' and fecha <= '".$fechaFin."' order by id_obra, id_producto";
          $resp = $conexLocalHost->query($sql);
      }
      $conexLocalHost->close();
      return $resp;
  }
  
  public function todas_transferenciaFecIniFecFin($fechaIni,$fechaFin)
  {

      $conexLocalHost= $this->conexionBD();
      $resp = [];
      if($conexLocalHost != false)
      {
          $sql = "SELECT * FROM obra inner join( transferencia inner join producto on transferencia.idproducto = producto.id_producto) on transferencia.idobraEntrada = obra.id_obra or transferencia.idobraRetiro = obra.id_obra WHERE fecha >= '".$fechaIni."' and fecha <= '".$fechaFin."' ORDER BY id_obra";
          $resp =  $conexLocalHost->query($sql);
      }
      $conexLocalHost->close();
      return $resp;
  }
  
}
?>

