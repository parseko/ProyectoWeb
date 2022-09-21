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
				$sql_gastos3 = "SELECT  * FROM partida WHERE id = '{$row_gastos1['partida']}'";
				$res_gastos3 = mysql_db_query ( $bdd, $sql_gastos3 );
				if ( $row_gastos3 = mysql_fetch_assoc ( $res_gastos3 ) )
				{
					if($row_gastos3['clavepartida']>=2000 and $row_gastos3['clavepartida']<3000)
					{
						$uno= $uno+$row_gastos1['monto'];
					}
					if($row_gastos3['clavepartida']>=1000 and $row_gastos3['clavepartida']<2000)
					{
						$uno= $uno+$row_gastos1['monto'];
					}
					if($row_gastos3['clavepartida']>=3000 and $row_gastos3['clavepartida']<4000)
					{
						$uno= $uno+$row_gastos1['monto'];
					}
					if($row_gastos3['clavepartida']>=5000 and $row_gastos3['clavepartida']<6000)
					{
						$uno= $uno+$row_gastos1['monto'];
					}
					if($row_gastos3['clavepartida']>=7000 and $row_gastos3['clavepartida']<8000)
					{
						$uno= $uno+$row_gastos1['monto'];
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