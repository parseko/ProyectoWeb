<?php
	session_start();
	include_once("conexion/conexion.php");
	$bdd = "sicopre";		//Archivo de interconexion a la base de datos
	$res_revision = mysqli_query($conexion,"SELECT * FROM revision_reportes");
	if ( $row_revision = mysqli_fetch_assoc ( $res_revision ) )
	{}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Link Tigra Hints script file to your HTML document-->
<script language="JavaScript" src="JS/hints.js"></script>
<!-- Link Tigra Hints configuration file to your HTML document-->
<script language="JavaScript" src="JS/hints_cfg.js"></script>

<script language="Javascript" src="JS/funciones.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>SIA - <?php echo $row_revision['tec'];?></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="CSS/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div>
	<table align="center" width="900" height="122">
		<tr align="center">
			<td align="center">
				<img src="imagenes/reportes/sep2007.jpg" height="122" width="170"/>
			</td>
			<td>
				<img src="imagenes/reportes/titulo.jpg" height="122" width="500" />
			</td>
			<td>
				<img src="imagenes/reportes/logo.jpeg" height="122" width="122" />
			</td>
		</tr>
	</table>
</div>
<div id="header">
	<h1><a >Sistema Integral de Administraci�n</a></h1>
	<h2><a >Instituto Tenol�gico de tl�huac </a></h2>
</div>
<div id="content">
	<div id="colOne">
	</div>
	<div id="colTwo">
<?php
		include_once("contenido.php");
?>	
	</div>
</div>
<div id="footer">
	<p>Copyright &copy; 2008 SIA. Dise�ado por <a href="http://www.ittg.edu.mx"><strong>INSTITUTO TECNOLOGICO DE TUXTLA GUTIERREZ.</strong></a></p>
</div>
</body>
</html>
