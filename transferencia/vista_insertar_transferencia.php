<?php session_start();
if(isset($_SESSION['user']))
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
include('modelo_transferencia.php');
$ClasTransferencia = new Transferencia();
$TodasTabObraProd = $ClasTransferencia->buscar_todasTablaObraProd();
$arrayObrasProd = array();
$i = 0;
$cambio = "";
$prod = "";
$mostProDesc = "";
$obr = "";
while($tablaOP=$TodasTabObraProd->fetch_object())
{
  if($tablaOP->canttotal > 0 && $tablaOP->idp != $cambio)
  {
    $cambio = $tablaOP->idp;
    $arrayObrasProd[$i] = $tablaOP;
	$i++;
  } 
}
if(isset($_POST['transf']))
{
  $mostProDesc = $_POST['cod_prod'];
  $prod = explode(" -> ",$_POST['cod_prod'])[0];
}
if(0 == count($arrayObrasProd))
  {
         ?>
	     <script type="text/javascript" >
		 alert("Error, no puede hacer ninguna transferencia pues no hay productos en ninguna obra")
		 </script>
		 <?php
  }
  else
  {
 ?>

  <h2><font color="#178F99">Nueva transferencia</font></h2>
<form name="frm_transferencia" id="form" method="post" action="vista_insertar_transferencia.php" onsubmit="return transferencia()" >
<table height="30"></table>

  <table width="400">
		  <tr><td><fieldset><legend><font color="#FF0000" size="3"><strong>Introdusca el producto que se va a transferir</strong></font></legend><table border="0">
			<caption align="bottom"></caption>

             <tr height="20"></tr>
			 
			<tr>
			<td width="200"><label for="txt_correo"><strong>Codigo de producto</strong></label></td>
			</tr>
			<tr>
			<td><select name="cod_prod" id="codP">
				<?php
				if($mostProDesc != "")
				{
				?>
				 <option value="<?php echo $mostProDesc?>"><?php echo $mostProDesc?></option>
				<?php 
				}
				else
				{
				 ?>
				  <option value="" selected="selected"></option>
				  <?php 
				}
				for($j = 0; $j<count($arrayObrasProd); $j++)
		        {
				  if($prod !=  $arrayObrasProd[$j]->id_producto)
				  { 
				?>
                    <option value="<?php echo $arrayObrasProd[$j]->id_producto." -> ".$arrayObrasProd[$j]->descricion_prod?>"><?php echo $arrayObrasProd[$j]->id_producto." -> ".$arrayObrasProd[$j]->descricion_prod?></option>
				<?php
				  }
				  else
				  {
				     $p = $arrayObrasProd[$j];
				  }
				}
				?>
                 </select></td>
				 <td colspan="2"><input type="submit" name="transf" value="Buscar" /></td>
			</tr>			
	  </table></fieldset></td></tr></table>
	  <table height="30"></table>
	  </form>	
	  
  <?php
  }
  ?>
  
  
  
<?php
if($prod != "" ) 
{
    
	include('../obra/modelo_obra.php');
	$Clasobra = new Obra;
	$TodasObras = $Clasobra->todas_las_obras();
    $Todo = $ClasTransferencia->buscar_todasTablaObraProd2($prod);
	$arrayTodoOPT = array();
	$i = 0;
	while($t=$Todo->fetch_object())
	{
	   $arreglo =  array($t->ido,$t->descricion,$t->canttotal,$t->idp,$t->descricion_prod,$t->unidad_medida);
	   $arrayTodoOPT[$i] = $arreglo;
	   $i++;
	}
	$encontro = false;
	while($o=$TodasObras->fetch_object())
	{
	   $encontro = false;
	   for($j = 0;$j < count($arrayTodoOPT) && $encontro == false; $j++)
	   {
	     if($arrayTodoOPT[$j][0] == $o->id_obra)
		 {
		    $encontro = true;	
		 }
	   }
	   if($encontro == false)
	   {
	     $arreglo =  array($o->id_obra,$o->descricion,0,$prod,"","");
	     $arrayTodoOPT[count($arrayTodoOPT)] =  $arreglo;
	   }
	}
	
	
	?>
	
	<form name="frm_InserTransferencia" id="form" method="post" action="controladora_transferencia.php" onsubmit="return insert_transferencia()" >
	<table  width="770" border="0">
			<caption align="bottom"></caption><tr><td><fieldset><legend><font color="#FF0000" size="3"><strong>Introdusca las obras de Salida/Entrada para Transferir el producto <?php echo  $arrayTodoOPT[0][3] ?> (<?php echo  $arrayTodoOPT[0][4] ?>)</strong></font></legend>
	
	  <table height="30"></table>
	
	  <table  width="700" border="0">
	   <tr>
			<td><label for="numD"><strong>Num Documento</strong></label></td>
			<td><label for="fecha"><strong>Fecha</strong></label></td>
	   </tr>
	   <tr>
			<td><input type="text" name="nummDocT" id="nummDocT" size="6" maxlength="6"/></td>
			<td><table>
				<tr>
				<td><select name="dia" id="dia">
				<option value="<?php echo date("j"); ?>"><?php echo date("j"); ?></option>
				<?php 
				for($h=1;$h < 32; $h++)
				{
				  if($h != date("j"))
				  {
				    ?>
				    <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
					<?php
				  }
				}
				?>
                </select></td>
				<td><select name="mes" id="mes">
				<?php $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); ?>
				<option value="<?php echo date("n"); ?>"><?php echo $meses[date("n")-1]; ?></option>
				<?php
				for($h=0;$h < 12; $h++)
				{
				  if($h != date("n")-1)
				  {
				    ?>
				    <option value="<?php echo $h+1; ?>"><?php echo $meses[$h]; ?></option>
					<?php
				  }
				}
				?>
                </select></td>
				<td><select name="anno" id="anno">
				<option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
				<?php
				for($h= date("Y")-2;$h < date("Y")+6; $h++)
				{
				  if($h != date("Y"))
				  {
				    ?>
				    <option value="<?php echo $h; ?>"><?php echo $h; ?></option>
					<?php
				  }
				}
				?>
                </select></td>
				</tr></table></td>
		</tr>
	  </table>
	  
	  <table height="20"></table>
	  
	  <table  width="700" border="0">
	        <tr>
			    <td><label for="osacar"><strong>Obra a sacar producto</strong></label></td>
				
			    <td><label for="cant"><strong>Cantidad a sacar</strong></label></td>
				
			    <td><label for="oentregar"><strong>Obra a entregar producto</strong></label></td>
			</tr>
			<tr>
			<td><select name="cod_obraSalida" id="codOSalida">
				  <option value="" selected="selected"></option>
				  <?php 
				for($j = 0; $j<count($arrayTodoOPT); $j++)
		        {
				  if($arrayTodoOPT[$j][2]> 0)
				  { 
				?>
                    <option value="<?php echo $arrayTodoOPT[$j][0]."|".$arrayTodoOPT[$j][2]."|".$prod?>"><?php echo $arrayTodoOPT[$j][1]." (".$arrayTodoOPT[$j][0].") -> ".$arrayTodoOPT[$j][2]?></option>
				<?php
				  }
				}
				?>
              </select></td>
			 
				 <td><input type="text" name="cantTrans" id="cantT" size="10" maxlength="20"/></td>
		
				 <td><select name="cod_obraEntrada" id="codOEntrada">
				  <option value="" selected="selected"></option>
				  <?php 
				for($j = 0; $j<count($arrayTodoOPT); $j++)
		        {
				?>
                    <option value="<?php echo $arrayTodoOPT[$j][0]."|".$arrayTodoOPT[$j][2]."|".$prod?>"><?php echo $arrayTodoOPT[$j][1]." (".$arrayTodoOPT[$j][0].") -> ".$arrayTodoOPT[$j][2]?></option>
				<?php
				}
				?>
                 </select></td>
		    </tr>
	  </table>
	  
	  <table height="20"></table>
	  
	  <table  width="700" border="0">
	        <tr>
			  <td width="200"></td>
			  <td><input type="submit" name="inserTransf" value="Insertar transferencia" /></td>
			</tr>
	  </table>
	  
	</fieldset></td></tr></table>

</form>
   

<?php	 
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
        <p class="art-page-footer">Ing. Jorge Ernesto Bauzá Becerra</p>
    </div>
        </div>
    </div>
	
	
	
	
<?php

if(isset($_GET['var']))
{
  if($_GET['var']=='errorTransYaExis')
  {
          ?>
	     <script type="text/javascript" >
		 alert("Ya existe una transferencia con esos datos")
		 </script>
		 <?php
  }
  if($_GET['var']=='errorTransBD')
  {
        ?>
	     <script type="text/javascript" >
		 alert("Error al insertar la transferencia en la Base Dato")
		 </script>
		 <?php
  } 
  if($_GET['var']=='adicionTrans')
  {
         ?>
	     <script type="text/javascript" >
		 alert("Transferencia adicionado en la Base Dato")
		 </script>
		 <?php
  }
}                                            
?>	
	
	
       
</body>
</html>

<?php
}
else
{
  header ("location: ../Principal/principal.php");
}
?>
