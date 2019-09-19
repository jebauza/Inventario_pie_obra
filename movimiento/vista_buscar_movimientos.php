<?php session_start();
if(isset($_SESSION['user']) && $_SESSION['rol'] == "administrador")
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
include('../producto/modelo_producto.php');
include('../movimiento/modelo_movimiento.php');
$Clasobra = new Obra();
$ClasProducto = new Producto();
$ClasMovimiento = new Movimiento();
$TodasObras = $Clasobra->todas_las_obras();
$TodosProductos = $ClasProducto->todos_los_productos();
$todosMovimientos = $ClasMovimiento->todos_movimientos_idu($_SESSION['iduser'])
$prod = "";
$obr = "";
$arrayObras = array();
$i = 0; 
while($obra=$TodasObras->fetch_object())
{
  $arrayObras[$i] = $obra;
  $i++;
}
$arrayProductos = array();
$i = 0;
while($producto=$TodosProductos->fetch_object())
{
  $arrayProductos[$i] = $producto;
  $i++;
}
$arrayMovimientos = array();
$i = 0;
while($mov=$todosMovimientos->fetch_object())
{
  $arrayMovimientos[$i] = $mov;
  $i++;
}
if(isset($_POST['movim']))
{
  $prod = 
  $obr
}






?>

<h2><font color="#178F99">Tus movimientos</font></h2>
<form name="frm_buscarMovimiento" id="form" method="post" action="vista_buscar_movimientos.php" onsubmit="return prueba()" >
<table height="30"></table>

  <table width="700">
		  <tr><td><fieldset><legend><font color="#FF0000" size="3"><strong>Introdusca los datos</strong></font></legend><table border="0">
			<caption align="bottom"></caption>

             <tr height="20"></tr>
			 
			<tr><td>
			  <table>
			     <tr>
				     <td><strong>Num. Movimiento: </strong><input name="idmov" type="text" size="6" maxlength="6"/></td>
					 <td width="10"></td>
					 <td><strong>Iipo: </strong><select name="TipoMovimiento" id="Tip_Mov">
			                                       <option value=""> </option>
			                                       <option value="entrada">Entrada</option>
			                                       <option value="existencia">Existencia</option>
			                                       </select>
		             </td>
					 <td width="10"></td>
					 <td><table>
					           <tr>
							    <td><strong>Fec Ini: </strong><table>
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
				                       </tr>
								</table></td>
					           </tr>
							   
							   
							   
					 </table></td>
					 
					 
					 
				 </tr>
			  </table>
			</td></tr>
			
			
			<tr>
				 <td colspan="2"><input type="submit" name="movim" value="Buscar" /></td>
			</tr>			
	  </table></fieldset></td></tr></table>
	  <table height="30"></table>
	  </form>









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
  if($_GET['var']=='modificarUser')
  {
         ?>
	     <script type="text/javascript" >
		 alert("Se modificarón correctamente los datos del usuario")
		 </script>
		 <?php
  }
  if($_GET['var']=='eliUser')
  {
         ?>
	     <script type="text/javascript" >
		 alert("Se elimino correctamente el usuario de la BD")
		 </script>
		 <?php
  }
  if($_GET['var']=='eliVariUse')
  {
         ?>
	     <script type="text/javascript" >
		 alert("Se elimino correctamente todos los usuarios selecionados")
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