<?php session_start();?>
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
if(!isset($_SESSION['user']))
{
?> 

<form name="frm_logeo" id="form" method="post" action="controladora_session.php" onsubmit="return logeo()" >
		<table><tr>
		<td width="240" ></td>
		<td bgcolor="#CCCCCC"><fieldset><legend><font size="+2"><strong>Identifiquese</strong></font></legend><table  border="0" >
		
		    <tr height="20"></tr>
		
			<tr>
			    <td><label for="usuario"><strong>Usuario:</strong></label></td> 
				<td><input type="text" name="usuario" id="usser" size="10" maxlength="20" /></td> 	
			</tr>
			
			<tr height="10"></tr>
			
			<tr>
			    <td><label for="pass"><strong>Contraseña:</strong></label></td>
				<td><input name="pass" type="password" size="10" maxlength="20" /></td>
			</tr>
			
			<tr height="20"></tr>
			
			<tr>
			  <td><input type="submit" name="logeo" value="Entrar" /></td>
			</tr>
	  </table></fieldset></td>
	  </tr></table>
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
        <p class="art-page-footer">Est. Alina</p>
    </div>
        </div>
    </div>
    
<?php 
if(isset($_GET['var']))
{
    if($_GET['var']=='errorLogeo')
    {
         ?>
	     <script type="text/javascript" >
		 alert("Usuario o contraseña incorecta")
		 </script>
		 <?php
    } 
}
?>    
    
    
    
</body>
</html>
