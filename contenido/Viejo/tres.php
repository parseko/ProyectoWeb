<?php
	mysql_connect("localhost","root");
	$bdd = "sicopre";
?>
<?php
$bdd = "sicopre";
		$sql_gastos = "SELECT  * FROM accion WHERE claveAccion != 4 ORDER BY claveaccion";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
			echo "uno, ";
			$sql_gastos1 = "SELECT  * FROM gastos WHERE idmeta = '{$row_gastos['claveAccion']}'";
			$res_gastos1 = mysql_db_query ( $bdd, $sql_gastos1 );
			while ( $row_gastos1 = mysql_fetch_assoc ( $res_gastos1 ) )
			{
				echo "dos, ";
				$sql = "UPDATE gastos SET idmeta = '{$row_gastos['id']}' WHERE idgastos = {$row_gastos1['idgastos']}";
				if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
				{
					echo "se pudo, ";
				}			
			}
		}
?>