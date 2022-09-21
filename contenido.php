<?php
	//session_start();
	include_once("conexion/conexion.php");		//Archivo de interconexion a la base de datos
	

	if (isset( $_POST['enviar']))
	{
		include_once ( "clases/login.php" );
		$Login = new Login();
		if ( $_POST['usuario'] == "" or $_POST['password'] == "" )
		{
			$errorLogin = 1;
		}
		else if ( !$usuario = $Login->IniciarSesion($conexion, $_POST['usuario'], $_POST['password'], $bdd ) )
		{
			$errorLogin = 2;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Link Tigra Hints script file to your HTML document-->
<script language="JavaScript" src="JS/hints.js"></script>
<!-- Link Tigra Hints configuration file to your HTML document-->
<script language="JavaScript" src="JS/hints_cfg.js"></script>

<script language="Javascript" src="JS/funciones.js"></script>

<title>SIA</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="CSS/sicopre.css" rel="stylesheet" type="text/css">
</head>

<body>

<script type="text/javascript" src="JS/wz_tooltip.js"></script>

<table width="726" height="373" border="0" cellpadding="0" cellspacing="0" >
	<tr> 
  		<td width="542" height="373" align="left" valign="top" bgcolor="#FFFFFF"> 
    	<p align="left"><font color="#FFFFFF"><img src="imagenes/estructura/linea.jpg" width="560" height="19"></font></p>
      		<table width="560" height="317">
        		<tr> 
         	 		<td align="left" valign="top" background="imagenes/estructura/fondo1.jpg" class="PHP5">
			 		<?php //Espacio para el contenido de los includes 
						
						if (isset($_SESSION['tipo']) == 1 )		//SUSTITUIR LOS IFs CON CASE
						{
							switch(isset($_GET['sec']))
							{
								case 1:			include_once("contenido/accion.php");
													break;
								case 2:			include_once("contenido/actividad.php");
													break;
								case 3:			include_once("contenido/departamento.php");
													break;
								case 4:			include_once("contenido/insumo.php");
													break;
								case 5:			include_once("contenido/partida.php");
													break;
								case 6:			include_once("contenido/presupuesto.php");
													break;
								case 7:			include_once("contenido/proceso.php");
													break;
								case 8:			include_once("contenido/metas.php");
													break;
								case 9:			include_once("contenido/usuario.php");
													break;
								case 10:		include_once("contenido/datosReportes.php");
													break;
								case 11:		include_once("historial/principal.php");
													break;
								case 'b':			include_once("contenido/busqueda.php");
													break;
								case 'm':		include_once("contenido/modificaciones.php");
													break;
								case 'd':		include_once("contenido/borrado.php");
													break;
								case 'p':		include_once("contenido/ejercicio.php");
													break;
								case 'c':		include_once("contenido/consultapoa.php");
													break;
								case 'g':		include_once("contenido/gob_federal.php");
													break;
								case 'r':		include_once("contenido/reportes.php");
													break;
								case 'X':		include_once("contenido/modpoaadmin.php");
													break;
								default: 		include_once("contenido/presentacion.php");
													break;
							}
						}
						else if (isset($_SESSION['tipo']) == 2 )
						{
							switch($_GET['sec'])
							{
								case 11:		include_once("historial/principal.php");
													break;
								case 'r':			include_once("contenido/reportes.php");
													break;
								default:			include_once("contenido/presentacion.php");
													break;
							}
						}
						else if (isset( $_SESSION['tipo']) == 3 )
						{
							switch($_GET['sec'])
							{
								case 1:			include_once("contenido/presentacion.php");
													break;
								case 2:			include_once("contenido/programa.php");
													break;
								case 3:			include_once("contenido/capturapoa.php");
													break;
								case 4:			include_once("contenido/modificacionpoa.php");
													break;
								case 5:			include_once("contenido/Cargar_Acciones.php");
													break;
								case 6:			include_once("contenido/consultaMetas.php");
													break;
								case 10:		include_once("contenido/programarequi.php");
													break;	
								case 11:		include_once("contenido/solicitud.php");
													break;
								case 12:		include_once("contenido/requisicion.php");
													break;									
								case 13:		include_once("contenido/servicios.php");
													break;	
								case 14:		include_once("contenido/borrarservicio.php");
													break;									
								case 15:		include_once("contenido/borrarrequi.php");
													break;									
								case 16:		include_once("contenido/modificarservicio.php");
													break;									
								case 17:		include_once("contenido/modificarrequis.php");
													break;									
								case 18:		include_once("contenido/borrarbienservicio.php");
													break;									
								case 19:		include_once("contenido/viaticos.php");
													break;									
								case 20:		include_once("contenido/modificarviatico.php");
													break;									
								case 21:		include_once("contenido/borrarviatico.php");
													break;									
								case 'd':		include_once("contenido/borrado.php");
													break;	
								case 'b':		include_once("contenido/borradometas.php");
													break;
								case 'm':		include_once("contenido/modificacionesacciones.php");
													break;						
								case 'r':		include_once("contenido/reportesdepto.php");
													break;					
								case 'z':		include_once("contenido/reportejefes.php");
													break;	
								default:		include_once("contenido/presentacion.php");
													break;
							}
						}
						else if (isset( $_SESSION['tipo']) == 4 )
						{
							
							switch($_GET['sec'])
							{
								case 1:			include_once("contenido/presentacion.php");
													break;
								case 2:			include_once("contenido/estadodecuentas.php");
													break;
								case 3:			include_once("contenido/programagastos.php");
													break;
								case 4:			include_once("contenido/capturagastos.php");
													break;
								case 5:			include_once("contenido/modificacionesgastos.php");
													break;
								case 6:			include_once("contenido/estadodecuentasremanente.php");
													break;
								case 7:			include_once("contenido/programagastosremanente.php");
													break;
								case 8:			include_once("contenido/adminrequisicion.php");
													break;
								case 9:			include_once("contenido/adminservicio.php");
													break;
								case 'i':		include_once("contenido/ejerciciogastos.php");
													break;
								case 'd':		include_once("contenido/borradogastos.php");
													break;	
								case 'r':		include_once("contenido/reportesdpto.php");
													break;	
								case '10':		include_once("contenido/borrarrequi.php");
													break;				
								case '11':		include_once("contenido/borrarservicio.php");
													break;				
								case '12':		include_once("contenido/modificarservicio.php");
													break;				
								case '13':		include_once("contenido/adminviaticos.php");
													break;
								case '14':		include_once("contenido/borrarviatico.php");
													break;
								default:		include_once("contenido/presentacion.php");
													break;
							}
						}
						else
						{
							switch(isset($_GET['sec']))
							{
								default:			include_once("contenido/presentacion.php");
													break;
							}
						}
			 		?>
					</td>
        		</tr>
      		</table>
      		<p align="center"><img src="imagenes/estructura/linea.jpg" width="560" height="19"></p>
    	</td>
		<th width="200" align="left" valign="top" bgcolor="#FFFFFF" > 
      		<div align="center" >
			<table width="182" border="0" cellpadding="0" cellspacing="0">
          		<tr> 
            		<td width="15" ><img src="imagenes/estructura/B-sup-izq1.png" ></td>
            		<td width="152" background="imagenes/estructura/B-sup1.png" ></td>
            		<td width="15" ><img src="imagenes/estructura/B-sup-der1.png"></td>
          		</tr>
         		<tr> 
            		<th nowrap bgcolor="#479BB5" background="imagenes/estructura/B-izq1.png">&nbsp;</th>
           			<td bgcolor="#479BB5" align="center">
		   
<?php 
						switch (isset( $_SESSION['tipo_poa']) )
						{
							case 1:	$ejercicio_actual = "APOA ".$_SESSION['anio'];
										break;
							case 2:	$ejercicio_actual = "POA ".$_SESSION['anio'];
										break;
							case 3:	$ejercicio_actual = "NO SE HA INCIADO UN EJERCICIO";
										break;
						}
						
						include_once("includes/menu.php"); 	//Aqui se encuentran los links de cada usuario
?>
		   
		   				<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#479BB5">
							<tr>
								<td width="100%" class="PHP5" align="center" bgcolor="#479BB5">								</td>
							</tr>
							<tr>
								<td width="100%" bgcolor="#479BB5" align="center">
									<?php
										
										if (isset( $_SESSION['tipo']) == 1 )
										{
											echo "<br />{$ejercicio_actual}<br /><br /><span class='aviso'>ADMINISTRADOR</span><br />";
											echo "<a href='includes/salir.php' class='PHPlink6'>Salir</a>";
										}
										else if (isset($_SESSION['tipo']) == 2 )
										{
											echo "<br />{$ejercicio_actual}<br /><br /><span class='aviso'>ANALISTA</span><br />";
											echo "<a href='includes/salir.php' class='PHPlink6'>Salir</a>";
										}
										else if (isset( $_SESSION['tipo']) == 3 )
										{
											$sql_login = "SELECT nombredpto FROM dpto WHERE id = {$_SESSION['dpto_id']}";
											$res_login = mysqli_query ( $conexion, $sql_login );
											$row_login = mysqli_fetch_assoc ( $res_login );
											echo "<br />{$ejercicio_actual}<br /><br /><span class='aviso'>JEFE DEL DEPTO. DE<br />{$row_login['nombredpto']}</span><br />";
											echo "<a href='includes/salir.php' class='PHPlink6'>Salir</a>";
										}
										else if ( isset($_SESSION['tipo']) == 4 )
										{
											echo "<br />{$ejercicio_actual}<br /><br /><span class='aviso'>ADMINISTRADOR DE GASTOS</span><br />";
											echo "<a href='includes/salir.php' class='PHPlink6'>Salir</a>";
										}
										else
										{
									?>
									<form method="post" action="">
										<table width='120' border='0' align='center' cellpadding='0' cellspacing='0'>
											<tr>
												<td width='108' height='24' class='MedianoBlanco' align="center"><strong>USUARIO</strong></td>
											</tr>
											<tr>
												<td align="center" width='108' height='24'><input type="text" name="usuario" maxlength="20" size="15"></td>
											</tr>
											<tr>
												<td align="center" width='108' height='24'  class='MedianoBlanco'><strong>CONTRASE�A</strong></td>
											</tr>
											<tr>
												<td align="center" width='108' height='24'><input type="password" name="password" maxlength="30" size="15"></td>
											</tr>
											<tr>
												<td align="center"><input type="submit" name="enviar" class="PHP5" value="Ingresar"></td>
											</tr>
										</table>
										
										
										
									<?php
										}
									?>
									
									
									<?php
										if ( isset ( $errorLogin ) )
										{
											switch($errorLogin)
											{
											
												case 1:	echo "<br><strong><span class=\"MedianoAlerta\">Debe ingresar datos en ambos campos.</span></strong>";				
														break;
												case 2:	echo "<br><strong><span class=\"MedianoAlerta\">Nombre de usuario y/o contrase�a incorrectos!</span></strong>";
														break;
											}
										} 
									?>
									</form>
									<br><?php //<img src="../Visual/Imagenes/help2.png" onMouseOver="myHint.show(17)" onMouseOut="myHint.hide()">?>
								</td>
							</tr>
						</table>
		   
            		</td>
           			<th nowrap  background="imagenes/estructura/B-der1.png">&nbsp;</th>
          		</tr>
          		<tr> 
            		<td ><img src="imagenes/estructura/B-inf-izq1.png" ></td>
            		<td  background="imagenes/estructura/B-inf1.png">&nbsp;</td>
            		<td v><img src="imagenes/estructura/B-inf-der1.png"></td>
          		</tr>
        	</table>
       		</div></th>
	</tr>
</table>
</body>
</html>
