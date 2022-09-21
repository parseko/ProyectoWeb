<?php
	mysql_connect("localhost","root");
	$bdd = "sicopre";
?>
<?php
// departamen
// depto_sol
	$bdd = "sicopre";
		$sql_gastos = "SELECT  * FROM gastos1 WHERE 1 ORDER BY no";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
				$sql = "UPDATE gastos_dpto SET idpartida = '{$row_gastos[partida]}', monto='{$row_gastos[monto]}' WHERE oficio = {$row_gastos['no']}";
				if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
				{
					echo "se pudo, ";
				}
		}
?>