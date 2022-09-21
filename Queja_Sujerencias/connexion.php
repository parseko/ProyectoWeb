<?php
$db = mysqli_connect("localhost","root","");
	
if (!$db) {
    print "<p>Imposible conectarse con la base de datos.</p>";

	
    exit();
}

 $nombre = $_POST['nombre'];
 $telefono = $_POST['telefono'];
 $email = $_POST['email'];
 $nControl = $_POST['nControl'];
 $carrera = $_POST['carrera'];
 $semestre = $_POST['semestre'];
 $grupo = $_POST['grupo'];
 $turno = $_POST['turno'];
 $aula = $_POST['aula'];          
 $notas = $_POST['notas'];
 $tipo = $_POST['tipo'];

$consulta = "INSERT INTO quejas.alumno values (NULL,'$nombre' ,'$telefono', '$email','$nControl','$carrera','$semestre','$grupo','$turno','$aula','$notas','$tipo')";
if(mysqli_query($db, $consulta)) {
    header("Location: Alum_index.php?insertado=1");
	//header("Location: Alum_index.php?insertado=1");
	} else {
    print "Error:" . mysqli_error($db);
}
?>