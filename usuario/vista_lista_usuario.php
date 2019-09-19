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
include('modelo_usuario.php');
$clasUsuario = new Usuario();
$todosUsuarios = $clasUsuario->listar_usuario();
$pintar = "#3CBFFF";
$cont = 1;
?>

<h2><font color="#178F99">Lista de usuarios</font></h2>
<table height="30"></table>
<form name="frm_eliUser" id="form" method="post" action="controladora_usuario.php" onsubmit="return prueba()" >

<?php
while($user = $todosUsuarios->fetch_object())
{
   ?>
   
  <table width="700" bgcolor="<?php echo  $pintar;?>">
  <tr>
   <td width="660"><table>
         <tr>
            <td width="20"><img src="../visual/images/user.jpg" width="20" height="20" border="0"></td>
            <td><input name="<?php echo  $cont;?>" type="checkbox" value="<?php echo  $user->idusuario;?>" /><strong><font color="#F20000"><em><?php echo  $user->nombre;?></em></font></strong></td>
         </tr>
   </table></td>
   <td><table width="40">
         <tr>
		    <td width="20"><a href="vista_modificar_usuario.php?modificarUser=<?php echo $user->idusuario; ?>|nada">
		  <img src="../visual/images/modificar.jpg" width="20" height="20" border="0" title="Modificar"></a></td>
            <td width="20"><a href="controladora_usuario.php?eliminarUser=<?php echo $user->idusuario; ?>" onclick=" if(confirm('Realmente desea eliminar el usuario <?php echo $user->nombre; ?>'))  return true; else  return false;"><img src="../visual/images/eliminar.jpg" width="20" height="20" border="0" title="Eliminar"></a></td>
         </tr>
   </table></td>
  </tr>
  
  <tr>
  <td width="700"><table width="700">
         <tr>
            <td width="350"><strong><font color="#000000">Usuario: </font><font color="#F20000"><em><?php echo  $user->user;?></em></font></strong></td>
			<td width="20"> </td>
            <td width="200"><strong><font color="#000000">Rol: </font><font color="#F20000"><em><?php echo  $user->rol;?></em></font></strong></td>
			<td width="20"> </td>
			<td><strong><font color="#000000">Activo: </font><font color="#F20000"><em><?php echo  $user->activo;?></em></font></strong></td>
         </tr>
   </table></td> 
  <tr>
</table>

<table height="5"></table>


 <?php
 $cont++;
 if($pintar == "#3CBFFF")
 {
   $pintar = "#B0B0B0";
 }
 else
 {
   $pintar = "#3CBFFF";
 }	  
}
?>
<table height="20"></table>
<table width="700" border="0">
        <tr>
		    <td width="300"><input name="numUser" type="hidden" value="<?php echo  $cont-1;?>" /></td>
			<td><input type="submit" name="eliminarUsuarios" value="Eliminar Usuarios" onclick=" if(confirm('Realmente desea eliminar a todos los usuarios selecionados'))  return true; else  return false;"/></td>
	    </tr>
</table>

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