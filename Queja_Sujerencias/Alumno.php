<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>.::Quejas ::.</title>
</head>
<body>

<?php
if($_GET['insertado']==1) {
	echo "<body onLoad=\"javascript:Aviso();\">";
} else {
	echo "<body>";

}
?>

<style>
body{
	background:#D0FFFF;
	}

</style>
<?php
include("validacion.php");
?>
<?php
date_default_timezone_set('Mexico');
print "<p><p>Fecha : ".date("d/m/y H:i:s")."</p></p>";
?>

 <form name="altausuarios" method="post" action="connexion.php" >
Alumno:
  <FIELDSET>
  <LEGEND>Tus datos</LEGEND>
  <LABEL>

 Tu nombre:
  <input type="text" name="nombre" maxlength="30">
   <br> <br/>
 Tu telefono:
  <input type="text" name="telefono" maxlength="30">
 <br> <br/>
 Tu E-Mail:
 <input type="text" name="email" maxlength="50">
 <br> <br/>
 No de Control:
 <input type="text" name="nControl" id="nControl" maxlength="50">
 <br> <br/>
<p>Carrera: 
<select size="1" name="carrera"> 

<option selected value="Ingenieria en SIstemas Computacionales">Ingenieria en Sistemas Computacionales</option> 
<option value="Ingenieria en Mecatronica">Ingenieria en Mecatronica</option>
<option value="Ingenieria en Electronica">Ingenieria en Electronica</option> 

</select></p> 
 
  <br> <br/>
 Semestre:
 <input type="text" name="semestre" maxlength="30">	
 Grupo:
<input type="text" name="grupo" maxlength="30">
Turno:
<select size="1" name="turno">

<option selected value="Matutino">matutino</option> 
<option value="Despertino">despertino</option>

</select>
 Aula:
 <input type="text" name="aula" maxlength="30">
 <br> <br/>
 
<input name="r1" type="radio" value="quejas" onclick="tex('quejas')">Quejas
<input name="r1" type="radio" value="sujerencias" onclick="tex('sujerencias')">Sujerencias
<input name="r1" type="radio" value="reconocimiento" onclick="tex('reconocimiento')">Reconocimiento
<input type="hidden" maxlength="15" name="tipo" >

<br>
<p><textarea rows="7" name="notas" cols="50" maxlength="30"></textarea></p><br> </br>	
<INPUT type="Submit" value="Enviar" class="boton1" onClick="return texto();">
<input name="Reset" type="reset" id="Reset" value="Borrar" >
</LABEL>
</FIELDSET>

</p>
</form>
</body>
</html>