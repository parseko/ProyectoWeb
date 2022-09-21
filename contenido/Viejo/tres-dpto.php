<?php
	mysql_connect("localhost","root");
	$bdd = "sicopre";
?>
<?php
// departamen
// depto_sol
	$bdd = "sicopre";
		$sql_gastos = "SELECT  * FROM gastos1 WHERE 1 ORDER BY row_id";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
			$sql_gastos1 = "SELECT  * FROM partida WHERE clavepartida='{$row_gastos['partida']}'";
			$res_gastos1 = mysql_db_query ( $bdd, $sql_gastos1 );
			while ( $row_gastos1 = mysql_fetch_assoc ( $res_gastos1 ) )
			{	
				$sql = "UPDATE gastos1 SET partida = '{$row_gastos1[id]}' WHERE row_id = {$row_gastos['row_id']}";
				if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
				{
					echo "se pudo, ";
				}
			}			
		}
?>