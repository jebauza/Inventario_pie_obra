<?php session_start();
if(isset($_SESSION['user']) && ($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "jefe"))
{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>
    <!--
    Created by Artisteer v3.0.0.33215
    Base template (without user's data) checked by http://validator.w3.org : "This page is valid XHTML 1.0 Transitional"
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Eseo</title>

    <link rel="stylesheet" href="../visual/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="../visual/style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="../visual/style.ie7.css" type="text/css" media="screen" /><![endif]-->
    <link rel="shortcut icon" href="../visual/eseologo.jpg" type="image/x-icon" />
    <script type="text/javascript" src="../visual/jquery.js"></script>
    <script type="text/javascript" src="../visual/script.js"></script>
	<script type="text/javascript" src="../funciones.js"></script>
</head>
<body>
<div id="art-page-background-glare">
        <div id="art-page-background-glare-image">
    <div id="art-main">
        <div class="art-sheet">
            <div class="art-sheet-tl"></div>
            <div class="art-sheet-tr"></div>
            <div class="art-sheet-bl"></div>
            <div class="art-sheet-br"></div>
            <div class="art-sheet-tc"></div>
            <div class="art-sheet-bc"></div>
            <div class="art-sheet-cl"></div>
            <div class="art-sheet-cr"></div>
            <div class="art-sheet-cc"></div>
            <div class="art-sheet-body">
                <div class="art-nav">
                	<div class="l"></div>
                	<div class="r"></div>
                	<ul class="art-menu">
					
					<?php
					if(isset($_SESSION['user']))
					{
					?> 
					    
						<li>
                			<a href=""><span class="l"></span><span class="r"></span><span class="t"><font color="#0000FF" size="3"><strong><em><?php echo $_SESSION['user'];?></em></strong>                            </font></span></a>
                			<ul>
                				<li><a href="#"><strong>Cambiar Contraseña</strong></a></li>
                	            <li><a href="../Principal/controladora_session.php?cerrar=1"><strong>Salir</strong></a></li>
                			</ul>
                		</li>
					
                		<li>
                			<a href=""><span class="l"></span><span class="r"></span><span class="t"><font color="#F24F00" size="3"><strong>Operaciones</strong></font></span></a>
                			<ul>
							    <li><a href=""><strong>Movimiento</strong></a>
                					<ul>
										<li><a href="../movimiento/vista_insertar_movimiento.php"><strong>Nuevo Movimiento</strong></a></li>
                					</ul>
                				</li>
								<li><a href=""><strong>Transferencia</strong></a>
                					<ul>
									    <li><a href="../transferencia/vista_insertar_transferencia.php"><strong>Nueva Transferencia</strong></a></li>
                					</ul>
                				</li>
                				<li><a href=""><strong>Obra</strong></a>
                					<ul>
                						<li><a href="../obra/vista_insertar_obra.php"><strong>Insertar Obra</strong></a></li>
                					</ul>
                				</li>
                				<li><a href=""><strong>Producto</strong></a>
                					<ul>
									    <li><a href="../producto/vista_insertar_producto.php"><strong>Insertar Producto</strong></a></li>
                					</ul>
                				</li>
								<li><a href=""><strong>Funciones</strong></a>
                					<ul>
                						<li><a href="../Funcionalidades/resumen_de_materiales_por_obra.php"><strong>Resumen de materiales</strong></a></li>
                					</ul>
                				</li>
                			</ul>
                		</li>
						
						<?php
					   if($_SESSION['rol'] == "administrador")
                       {
                       ?>
                		 <li>
                			<a href=""><span class="l"></span><span class="r"></span><span class="t"><font color="#FF0000" size="3"><strong>Administrador</strong></font></span></a>
                			<ul>
                				<li><a href=""><strong>Usuarios</strong></a>
                					<ul>
                						<li><a href="../usuario/vista_insertar_usuario.php"><strong>Insertar Usuario</strong></a></li>
                						<li><a href="../usuario/vista_lista_usuario.php"><strong>Buscar</strong></a></li>
                					</ul>
                				</li>
                			</ul>
                		</li>
				        <?php
                        }
                        ?>
						
				    <?php
                    }
                    ?>
						
								
                	</ul>
                </div>
                <div class="art-header"><a href="../Principal/principal.php">
                        <div class="art-header-jpeg"></div>
                    <div class="art-logo">
                     <h1 id="name-text" class="art-logo-name">Gestión de materiales</h1>
                     <h2 id="slogan-text" class="art-logo-text">Eseo</h2>
                    </div>
                </a></div>
                </div>
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-content">
                          <div class="art-post">
                              <div class="art-post-tl"></div>
                              <div class="art-post-tr"></div>
                              <div class="art-post-bl"></div>
                              <div class="art-post-br"></div>
                              <div class="art-post-tc"></div>
                              <div class="art-post-bc"></div>
                              <div class="art-post-cl"></div>
                              <div class="art-post-cr"></div>
                              <div class="art-post-cc"></div>
                              <div class="art-post-body">



		
<?php
include('../obra/modelo_obra.php');// estaba puesto include
include('../movimiento/modelo_movimiento.php');
$Clasobra = new Obra();
$Clasmovimiento = new Movimiento();
$TodasObras = $Clasobra->todas_las_obras();
$TodosTotalObrProd = $Clasmovimiento->todas_tablaObraProdM();
$fechaIni = "";
$fechaFin = "";
$obr = "";
$arrayObras = array();
$i = 0; 
while($obra=$TodasObras->fetch_object())
{
  $arrayObras[$i] = $obra;
  $i++;
}
$arrayTotalObrProd = array();
$i = 0;
while($obraProd=$TodosTotalObrProd->fetch_object())
{
  $arrayTotalObrProd[$i] =$obraProd;
  $i++;
}

if(isset($_POST['resumenMatObra']))
{
  if(isset($_POST['cod_obr']))
  {
     $obr = $_POST['cod_obr'] ;
  }
  $fechaIni = $_POST['annoIni']."-".$_POST['mesIni']."-".$_POST['diaIni'];
  $fechaFin = $_POST['annoFin']."-".$_POST['mesFin']."-".$_POST['diaFin'];
}

if(0 == count($arrayTotalObrProd))
  {
         ?>
	     <script type="text/javascript" >
		 alert("Error de operacion, tiene que existir al menos una obra con al menos un producto")
		 </script>
		 <?php
  }
  else
  {
     ?>
     <h2><font color="#178F99">Resumen de materiales por obra</font></h2>
	 <table height="30"></table>
	<form name="frm_resumen_de_materiales_por_obra" id="form" method="post" action="resumen_de_materiales_por_obra.php"  >
		<table width="700">
		  <tr><td><fieldset><legend><strong><font color="#0000FF" size="3">Introdusca el criterio de busquedad</font></strong></legend><table>
			<caption align="bottom"></caption>
             
			 <tr height="20"></tr>
			 
			<tr>
			<td height="24"><strong>Codigo de Obra </strong><select name="cod_obr" id="codO">
				<?php
				if($obr != "")
				{
				?>
                   <option value="" selected="selected"></option>
				 <option value="<?php echo $obr?>"><?php echo $obr?></option>
				<?php 
				}
				else
				{
				 ?>
				  <option value="" selected="selected"></option>
				  <?php 
				}
				for($j = 0; $j<count($arrayObras); $j++)
		        {
				  if($obr != $arrayObras[$j]->id_obra)
				  { 
				?>
                    <option value="<?php echo $arrayObras[$j]->id_obra?>"><?php echo $arrayObras[$j]->id_obra." -> ".$arrayObras[$j]->descricion?></option>
				<?php
				  }
				  else
				  {
				    $o = $arrayObras[$j];
				  }
				}
				?>
              </select></td>
			</tr>
			
			<tr height="20"></tr>
			
			<tr><td><table width="700"><tr>
			<td><table><tr>
			<td><strong>Fecha inicial </strong><select name="diaIni" id="diaIni">
			    <?php 
				if(isset($_POST['diaIni']))
				{
				  ?>
			       <option value="<?php echo $_POST['diaIni']?>"><?php echo $_POST['diaIni']?></option>
				  <?php
				}
				else
				{
				?>
			    <option value=""> </option>
				<?php 
				}
				for($h=1;$h < 32; $h++)
				{
				    ?>
				    <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
					<?php
				}
				?>
                </select></td>
				<td><select name="mesIni" id="mesIni">
				<?php 
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" );
				if(isset($_POST['mesIni']) && $_POST['mesIni'] != "")
				{
				  ?>
			       <option value="<?php echo $_POST['mesIni']?>"><?php echo $meses[$_POST['mesIni']-1]?></option>
				  <?php
				}
				else
				{
				?>
			    <option value=""> </option>
				<?php 
				} 
				for($h=0;$h < 12; $h++)
				{
				    ?>
				    <option value="<?php echo $h+1; ?>"><?php echo $meses[$h]; ?></option>
					<?php
				}
				?>
                </select></td>
				<td><select name="annoIni" id="annoIni">
				<?php 
				if(isset($_POST['annoIni']))
				{
				  ?>
			       <option value="<?php echo $_POST['annoIni']?>"><?php echo $_POST['annoIni']?></option>
				  <?php
				}
				else
				{
				?>
			    <option value=""> </option>
				<?php 
				} 
				for($h= date("Y")-2;$h < date("Y")+6; $h++)
				{
				    ?>
				    <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
					<?php
				}
				?>
                </select></td>
			</tr></table></td>
						
			<td><table><tr>
			<td><strong>Fecha final </strong><select name="diaFin" id="diaFin">
			    <?php 
				if(isset($_POST['diaFin']))
				{
				  ?>
			       <option value="<?php echo $_POST['diaFin']?>"><?php echo $_POST['diaFin']?></option>
				  <?php
				}
				else
				{
				?>
			    <option value=""> </option>
				<?php 
				} 
				for($h=1;$h < 32; $h++)
				{
				    ?>
				    <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
					<?php
				}
				?>
                </select></td>
				<td><select name="mesFin" id="mesFin">
				<?php 
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" );
				if(isset($_POST['mesFin']) && $_POST['mesFin'] != "")
				{
				  ?>
			       <option value="<?php echo $_POST['mesFin']?>"><?php echo $meses[$_POST['mesFin']-1]?></option>
				  <?php
				}
				else
				{
				?>
			    <option value=""> </option>
				<?php 
				}  
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" );
				for($h=0;$h < 12; $h++)
				{
				    ?>
				    <option value="<?php echo $h+1; ?>"><?php echo $meses[$h]; ?></option>
					<?php
				}
				?>
                </select></td>
				<td><select name="annoFin" id="annoFin">
				<?php 
				if(isset($_POST['annoFin']))
				{
				  ?>
			       <option value="<?php echo $_POST['annoFin']?>"><?php echo $_POST['annoFin']?></option>
				  <?php
				}
				else
				{
				?>
			    <option value=""> </option>
				<?php 
				} 
				for($h= date("Y")-2;$h < date("Y")+6; $h++)
				{
				    ?>
				    <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
					<?php
				}
				?>
                </select></td>
			</tr></table></td>
			</tr></table></td></tr>
			
			<tr height="10"></tr>
			
			<tr>
			  <td><table><tr>
			      <td width="300"></td>  
			      <td colspan="2"><input type="submit" name="resumenMatObra" value="Generar" /></td>
			  </tr></table></td> 
			</tr>			
	  </table></fieldset></td></tr></table>
	  <table height="30"></table>

</form>	
<?php ?>  
<?php
  if($fechaIni != "" && $fechaFin != "")
  {
      include('modelo_funciones.php');
      $Clasfunciones = new Funciones();
	  $todosMovimientosOrd = $Clasfunciones->todos_movimientoFecIniFechaFin($fechaIni,$fechaFin);
	  $todasTranferenciasOrd= $Clasfunciones->todas_transferenciaFecIniFecFin($fechaIni,$fechaFin);
	  $ido = "";
	  $arrImpesion = array();
	  $Materieles = array();
	  $datosMaterial = array();
	  $idmaterial = "";
	  while($mov=$todosMovimientosOrd->fetch_object())
	  {
	    
	    if($ido != $mov->id_obra)
		{  
		  if(count($datosMaterial) > 0)
		  { 
		   $Materieles[count($Materieles)] = $datosMaterial;
		   $arrImpesion[count($arrImpesion)-1][2] = $Materieles;
		  }
		  $ido = $mov->id_obra;
		  $idmaterial = $mov->idproducto;
		  if($mov->operacion == "entrada")
		  {
		    $datosMaterial = array($mov->id_producto, $mov->descricion_prod, $mov->unidad_medida, 0, $mov->precio_mn, " ", $mov->precio_cuc, " ");
		  }
		  else
		  {
		    $datosMaterial = array($mov->id_producto, $mov->descricion_prod, $mov->unidad_medida, 0, $mov->precio_mn, " ", $mov->precio_cuc, " ");
		  }
		  $Materieles = array();
		  $arrImpesion[count($arrImpesion)] = array($mov->id_obra,$mov->descricion);
		}
		
		if($idmaterial == $mov->idproducto)
		{
		  if($mov->operacion == "entrada")
		  {
		    $datosMaterial[3] =  $datosMaterial[3] + $mov->cantidad;
		  }
		}
		else
		{
		  $idmaterial = $mov->idproducto;
		  $Materieles[count($Materieles)] = $datosMaterial;
		  if($mov->operacion == "entrada")
		  {
		    $datosMaterial = array($mov->id_producto, $mov->descricion_prod, $mov->unidad_medida, $mov->cantidad, $mov->precio_mn, " ", $mov->precio_cuc, " ");
		  }
		  else
		  {
		    $datosMaterial = array($mov->id_producto, $mov->descricion_prod, $mov->unidad_medida, 0, $mov->precio_mn, " ", $mov->precio_cuc, " ");
		  }
		}
		
	  }
	  if(count($arrImpesion) > 0)
		{
		   $Materieles[count($Materieles)] = $datosMaterial;
		   $arrImpesion[count($arrImpesion)-1][2] = $Materieles;
		}
	  $transSuma = 0;
	  $transResta = 0;
	  $encontroPro = false;
	  $encontroObra = false;
	  while($tran=$todasTranferenciasOrd->fetch_object())
	  {
		$encontroObra = false;
		$encontroPro = false;
	    for($j=0;$j<count($arrImpesion) && $encontroPro == false && $encontroObra == false;$j++)
		{
		  if($tran->id_obra == $arrImpesion[$j][0])
		  {
		    $encontroPro = false;
		    $encontroObra = true;
		    for($g=0;$g<count($arrImpesion[$j][2]) && $encontroPro == false;$g++)
			{
			  if($tran->id_producto == $arrImpesion[$j][2][$g][0])
			  {
			    $encontroPro = true;
			    if($tran->id_obra == $tran->idobraEntrada)
				{
				  
				  if(count(explode(" + trans(",$arrImpesion[$j][2][$g][3])) == 1)
				  {
				    $transSuma = $tran->cantidad;
				    $transResta = 0;
				    $arrImpesion[$j][2][$g][3] = $arrImpesion[$j][2][$g][3]." + trans(".$transSuma." - ".$transResta.")";
				  }
				  else
				  {
				    $transSuma = explode(" + trans(",$arrImpesion[$j][2][$g][3])[1];
					$transResta = explode(" - ",$arrImpesion[$j][2][$g][3])[1];
					$transSuma = explode(" - ",$transSuma)[0] + $tran->cantidad;
				    $arrImpesion[$j][2][$g][3] = explode(" + trans(",$arrImpesion[$j][2][$g][3])[0]." + trans(".$transSuma." - ".$transResta;
					
				  }
				}
				else
				{
				  if(count(explode(" + trans(",$arrImpesion[$j][2][$g][3])) == 1)
				  {
				    $transSuma = 0;
					$transResta = $tran->cantidad;
				    $arrImpesion[$j][2][$g][3] = $arrImpesion[$j][2][$g][3]." + trans(".$transSuma." - ".$transResta.")";
				  }
				  else
				  {
				    $transSuma = explode(" + trans(",$arrImpesion[$j][2][$g][3])[1];
					$transResta = explode(" - ",$arrImpesion[$j][2][$g][3])[1];
					$transResta = explode(")",$transResta)[0] + $tran->cantidad;
					$transSuma = explode(" - ",$transSuma)[0];
				    $arrImpesion[$j][2][$g][3] = explode(" + trans(",$arrImpesion[$j][2][$g][3])[0]." + trans(".$transSuma." - ".$transResta.")";
				  }
				}
			  }
			}
			if($encontroPro == false)
		    {
			  if($tran->id_obra == $tran->idobraEntrada)
			  {
			    $arrImpesion[$j][2][count($arrImpesion[$j][2])] = array($tran->id_producto, $tran->descricion_prod, $tran->unidad_medida, "0 + trans(".$tran->cantidad." - 0)",$tran->precio_mn, " ", $tran->precio_cuc, " ");
			  }
			  else
			  {
			    $arrImpesion[$j][2][count($arrImpesion[$j][2])] = array($tran->id_producto, $tran->descricion_prod, $tran->unidad_medida, "0 + trans(0 - ".$tran->cantidad.")",$tran->precio_mn, " ", $tran->precio_cuc, " ");
			  }
			  
		    }
		  }
		}
	    if($encontroObra == false)
		{
		   $arr = "";
		   if($tran->id_obra == $tran->idobraEntrada)
			  {
			    $arr = array($tran->id_producto, $tran->descricion_prod, $tran->unidad_medida, "0 + trans(".$tran->cantidad." - 0)", $tran->precio_mn, " ", $tran->precio_cuc, " ");
			  }
			  else
			  {
			    $arr = array($tran->id_producto, $tran->descricion_prod, $tran->unidad_medida, "0 + trans(0 - ".$tran->cantidad.")", $tran->precio_mn, " ", $tran->precio_cuc, " ");
			  }
		   $arrImpesion[count($arrImpesion)] = array($tran->id_obra, $tran->descricion, array($arr));
		}
	  }
          $pintar = "#3CBFFF";
	  if($obr == "")
          {
              for($i=0;$i<count($arrImpesion);$i++)
	      {
	       ?>
	       <table width="700" bgcolor="<?php echo  $pintar;?>">
		  <tr><td><fieldset><legend><strong><font color="#FF0000" size="4"><input name="" type="checkbox" value="" /><?php  echo $arrImpesion[$i][1] ?>-><?php  echo $arrImpesion[$i][0] ?></font></strong></legend>
		  
		      <table width="700" border="1" bgcolor="#FFFFFF">
		        <tr>
			    <td><strong>Codigo</strong></td>
				<td><strong>Descripcion</strong></td>
		        <td><strong>u/m</strong></td>
				<td><strong>Cantidad</strong></td>
				<td><strong>Precio MN</strong></td>
				<td><strong>Importe MN</strong></td>
				<td><strong>Precio CUC</strong></td>
				<td><strong>Importe CUC</strong></td>
		        </tr> 
			<?php
                        $variable = $fechaIni."*".$fechaFin."*".$arrImpesion[$i][0].".".$arrImpesion[$i][1]."]->";
			for($j=0;$j<count($arrImpesion[$i][2]);$j++)
			{
			$cantidad = explode(" + ",$arrImpesion[$i][2][$j][3])[0];
			if(count(explode(" + ",$arrImpesion[$i][2][$j][3])) == 1)
			{
			 $arrImpesion[$i][2][$j][5] = $arrImpesion[$i][2][$j][4]*$cantidad." + trans(0 - 0)";
                         $arrImpesion[$i][2][$j][7] = $arrImpesion[$i][2][$j][6]*$cantidad." + trans(0 - 0)"; 
			}
			else
			{
			  $transSuma = explode(" + trans(",$arrImpesion[$i][2][$j][3])[1];
			  $transResta = explode(" - ",$arrImpesion[$i][2][$j][3])[1];
			  $transResta = explode(")",$transResta)[0];
			  $transSuma = explode(" - ",$transSuma)[0];
			  $arrImpesion[$i][2][$j][5] = $arrImpesion[$i][2][$j][4]*$cantidad." + trans(".$transSuma*$arrImpesion[$i][2][$j][4]." - ".$transResta*$arrImpesion[$i][2][$j][4].")";
                          $arrImpesion[$i][2][$j][7] = $arrImpesion[$i][2][$j][6]*$cantidad." + trans(".$transSuma*$arrImpesion[$i][2][$j][6]." - ".$transResta*$arrImpesion[$i][2][$j][6].")";
			}
                        $mat = $arrImpesion[$i][2][$j][0].",".$arrImpesion[$i][2][$j][1].",".$arrImpesion[$i][2][$j][2].",".$arrImpesion[$i][2][$j][3].",".$arrImpesion[$i][2][$j][4].",".
                                $arrImpesion[$i][2][$j][5].",".$arrImpesion[$i][2][$j][6].",".$arrImpesion[$i][2][$j][7]."|";
			$variable = $variable.$mat;
			?>
			  <tr>
			        <td><?php  echo $arrImpesion[$i][2][$j][0] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][1] ?></td>
		                <td><?php  echo $arrImpesion[$i][2][$j][2] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][3] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][4] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][5] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][6] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][7] ?></td>
		         </tr>
			<?php
			}
                        if($pintar == "#3CBFFF")
                        {
                              $pintar = "#B0B0B0";
                        }
                        else
                        {
                           $pintar = "#3CBFFF";
                        }
			?>
			</table>
                              <table><tr><td><a href="controladora_funciones.php?imprimir1=<?php echo $variable; ?>">
		  <img src="../visual/images/excel.jpg" width="40" height="25" border="0" title="Exportar a excel"></a></td></tr></table>
                              
		 </fieldset></td></tr></table> 
                <table><tr><td height="10"></td></tr></table>
	  <?php 
           }
         }
         else
         {
             $termine = false;
             for($i=0;$i<count($arrImpesion) && $termine == false;$i++)
	      {
                 if($obr == $arrImpesion[$i][0])
                 {
                     $termine = true;
                     ?>
	             <table width="700" bgcolor="<?php echo  $pintar;?>">
		       <tr><td><fieldset><legend><strong><font color="#FF0000" size="4"><input name="" type="checkbox" value="" /><?php  echo $arrImpesion[$i][1] ?>-><?php  echo $arrImpesion[$i][0] ?></font></strong></legend>
		  
		           <table width="700" border="1">
		             <tr>
			        <td><strong>Codigo</strong></td>
				<td><strong>Descripcion</strong></td>
		                <td><strong>u/m</strong></td>
				<td><strong>Cantidad</strong></td>
				<td><strong>Precio MN</strong></td>
				<td><strong>Importe MN</strong></td>
				<td><strong>Precio CUC</strong></td>
				<td><strong>Importe CUC</strong></td>
		            </tr> 
			<?php
                        $variable = $fechaIni."*".$fechaFin."*".$arrImpesion[$i][0].".".$arrImpesion[$i][1]."]->";
			for($j=0;$j<count($arrImpesion[$i][2]);$j++)
			{
			   $cantidad = explode(" + ",$arrImpesion[$i][2][$j][3])[0];
			   if(count(explode(" + ",$arrImpesion[$i][2][$j][3])) == 1)
			   {
			     $arrImpesion[$i][2][$j][5] = $arrImpesion[$i][2][$j][4]*$cantidad." + trans(0 - 0)";
                             $arrImpesion[$i][2][$j][7] = $arrImpesion[$i][2][$j][6]*$cantidad." + trans(0 - 0)";
			   }
			   else
			   {
			      $transSuma = explode(" + trans(",$arrImpesion[$i][2][$j][3])[1];
			      $transResta = explode(" - ",$arrImpesion[$i][2][$j][3])[1];
			      $transResta = explode(")",$transResta)[0];
			      $transSuma = explode(" - ",$transSuma)[0];
			      $arrImpesion[$i][2][$j][5] = $arrImpesion[$i][2][$j][4]*$cantidad." trans(".$transSuma*$arrImpesion[$i][2][$j][4]." - ".$transResta*$arrImpesion[$i][2][$j][4].")";
                              $arrImpesion[$i][2][$j][7] = $arrImpesion[$i][2][$j][6]*$cantidad." + trans(".$transSuma*$arrImpesion[$i][2][$j][6]." - ".$transResta*$arrImpesion[$i][2][$j][6].")";
			   }
			   $mat = $arrImpesion[$i][2][$j][0].",".$arrImpesion[$i][2][$j][1].",".$arrImpesion[$i][2][$j][2].",".$arrImpesion[$i][2][$j][3].",".$arrImpesion[$i][2][$j][4].",".
                                $arrImpesion[$i][2][$j][5].",".$arrImpesion[$i][2][$j][6].",".$arrImpesion[$i][2][$j][7]."|";
			   $variable = $variable.$mat;
			   ?>
			  <tr>
			    <td><?php  echo $arrImpesion[$i][2][$j][0] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][1] ?></td>
		        <td><?php  echo $arrImpesion[$i][2][$j][2] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][3] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][4] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][5] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][6] ?></td>
				<td><?php  echo $arrImpesion[$i][2][$j][7] ?></td>
		      </tr>
			<?php
			}
			?>
			
		  </table>
                                   
                          <table><tr><td><a href="controladora_funciones.php?imprimir1=<?php echo $variable; ?>">
		  <img src="../visual/images/excel.jpg" width="40" height="25" border="0" title="Exportar a excel"></a></td></tr></table>         
		 </fieldset></td></tr></table> 
	        <?php
              }
	        
           }
        }
	 
    
  }
   

   


}
?>


<div class="cleared"></div>
                            </div>
                          </div>
                          <div class="art-post">
                              <div class="art-post-tl"></div>
                              <div class="art-post-tr"></div>
                              <div class="art-post-bl"></div>
                              <div class="art-post-br"></div>
                              <div class="art-post-tc"></div>
                              <div class="art-post-bc"></div>
                              <div class="art-post-cl"></div>
                              <div class="art-post-cr"></div>
                              <div class="art-post-cc"></div>
                          </div>
                          <div class="cleared"></div>
                        </div>
                    </div>
                </div>
                <div class="cleared"></div>
                <div class="art-footer">
                    <div class="art-footer-t"></div>
                    <div class="art-footer-l"></div>
                    <div class="art-footer-b"></div>
                    <div class="art-footer-r"></div>
                    <div class="art-footer-body">
					     <table width="770">
						    <tr>
							   <td width="80"><img src="../visual/images/logo.jpg" width="80" height="60" border="0" title="Empresa de Servicios y Ejecución de Obras"></td>
							   <td><p><?php 
							if(isset($_SESSION['user']))
							{
							?>
							 <font color="#FFFFFF" face="Pristina" size="5"><strong><?php echo $_SESSION['nombre'];?></strong></font>
							</p>
							<?php
							}
							?></td>
							<td width="80"><img src="../visual/images/logo.jpg" width="80" height="60" border="0" title="Empresa de Servicios y Ejecución de Obras"></td>
						    </tr> 
						 </table>
					     
                        <div class="art-footer-text">   
                        </div>
                		<div class="cleared"></div>
                    </div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
        <p class="art-page-footer">Est. Alina</p>
    </div>
        </div>
    </div>
	
	
	
	
	
	
	
</body>
</html>

<?php
}
else
{
  header ("location: ../Principal/principal.php");
}
?>
