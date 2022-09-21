<?php

include_once("conexion/conexion.php");

class Login
{
	function Login()
	{
	}
	
	function IniciarSesion($conexion, $user, $password, $dataBase)
	{
		
		$conexion->select_db($dataBase);
		$sql = "SELECT * FROM usuario WHERE usuario = '{$user}'";
		if ( $res = mysqli_query ($conexion, $sql ) )
		{
			$row = mysqli_fetch_assoc ( $res );
			if ( !strcmp ( $row['clave'], $password ) )
			{
				$_SESSION['tipo'] 		= $row['tipousuario'];
				$_SESSION['id'] 			= $row['id'];
				$_SESSION['dpto_id'] 	= $row['dpto_id'];
				$sql = "SELECT * FROM poa WHERE actual = 1";
				$res = mysqli_query ($conexion, $sql );
				if ( $row = mysqli_fetch_assoc ($res) )
				{
					$_SESSION['tipo_poa'] = $row['tipo'];
					$_SESSION['anio']		=	$row['anio'];
				}
				else
				{
					$_SESSION['tipo_poa'] = 3;
				}
				return true;
			}
		}
		return false;
	}
}

?>