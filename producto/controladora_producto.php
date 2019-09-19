<?php
include('modelo_producto.php');
  
if(isset($_POST['insertar']))// Pregunta por boton insertar trabajo
{
	$id_product = $_POST['codproducto'];
    $descriccion = $_POST['descriccion'];
	$unidadmedida = $_POST['unidadmedida'];
    $preciomn = $_POST['preciomn'];
	$preciocuc = $_POST['preciocuc'];
	$producto = new Producto();
	$existe = $producto->buscar_producto($id_product);
	$inserto = true;
	$entre = false;
	if($existe == false)
	{  
	  $inserto = $producto->insertar_producto($id_product,$descriccion,$unidadmedida,$preciomn,$preciocuc);
	}
	else
	{
	    $entre = true;
	     header ("location: vista_insertar_producto.php?var=errorProdCod");
	}
	if($inserto == false)
	   {
	     
		 header ("location: vista_insertar_producto.php?var=errorProdBD");
	   }
	   else
	   {
		 if($entre == false)
		  {
		    header ("location: vista_insertar_producto.php?var=adicionProd");
		  }
	   }
	
	 
}

?>
