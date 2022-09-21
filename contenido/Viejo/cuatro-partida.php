<?php
	mysql_connect("localhost","root");
	$bdd = "sicopre";
?>
<?php
$bdd = "sicopre";
		$sql_gastos = "SELECT  * FROM gastos GROUP BY partida";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
			$sql_gastos1 = "SELECT  * FROM gastos WHERE partida = '{$row_gastos['partida']}'";
			$res_gastos1 = mysql_db_query ( $bdd, $sql_gastos1 );
			while ( $row_gastos1 = mysql_fetch_assoc ( $res_gastos1 ) )
			{
				$sql_gastos3 = "SELECT  * FROM partida WHERE clavepartida = '{$row_gastos1['partida']}'";
				$res_gastos3 = mysql_db_query ( $bdd, $sql_gastos3 );
				if ( $row_gastos3 = mysql_fetch_assoc ( $res_gastos3 ) )
				{
					$sql = "UPDATE gastos SET partida = '{$row_gastos3['id']}' WHERE id = {$row_gastos1['id']}";
					if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
					{
					echo "se pudo, ";
					}			
				}
			}
				?>
				<table width="200" border="1">
				  <tr>
					<td><?php echo $row_gastos3['clavepartida']; ?></td>
					<td><?php  echo $uno;?></td>
				  </tr>
				</table>
<?php
		$uno=0;
		}
?>