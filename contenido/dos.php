<?php
	mysql_connect("localhost","root");
	$bdd = "sicopre";
?>
<?php
$bdd = "sicopre";
		$sql_gastos = "SELECT  * FROM gastos_dpto WHERE (iddpto='25') and (idpartida = '53') GROUP BY idpartida ";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
			$sql_gastos1 = "SELECT  * FROM gastos_dpto WHERE (iddpto='25') and  (idpartida = '{$row_gastos['idpartida']}')";
			$res_gastos1 = mysql_db_query ( $bdd, $sql_gastos1 );
			while ( $row_gastos1 = mysql_fetch_assoc ( $res_gastos1 ) )
			{
				$sql_gastos2 = "SELECT  * FROM insumo WHERE id = '{$row_gastos1['insumo_id']}'";
				$res_gastos2 = mysql_db_query ( $bdd, $sql_gastos2 );
				if ( $row_gastos2 = mysql_fetch_assoc ( $res_gastos2 ) )
				{}
				$sql_gastos3 = "SELECT  * FROM partida WHERE id = '{$row_gastos1['idpartida']}'";
				$res_gastos3 = mysql_db_query ( $bdd, $sql_gastos3 );
				if ( $row_gastos3 = mysql_fetch_assoc ( $res_gastos3 ) )
				{
					if($row_gastos3['clavepartida']>=2000 and $row_gastos3['clavepartida']<3000)
					{
						$uno= $row_gastos1['monto'];
						$superuno = $superuno + $uno;
					}
					if($row_gastos3['clavepartida']>=1000 and $row_gastos3['clavepartida']<2000)
					{
						$uno= $row_gastos1['monto'];
						$superuno = $superuno + $uno;
					}
					if($row_gastos3['clavepartida']>=3000 and $row_gastos3['clavepartida']<4000)
					{
						$uno= $row_gastos1['monto'];
						$superuno = $superuno + $uno;
					}
					if($row_gastos3['clavepartida']>=5000 and $row_gastos3['clavepartida']<6000)
					{
						$uno= $row_gastos1['monto'];
						$superuno = $superuno + $uno;
					}
					if($row_gastos3['clavepartida']>=7000 and $row_gastos3['clavepartida']<8000)
					{
						$uno= $row_gastos1['monto'];
						$superuno = $superuno + $uno;
					}

				}
			}
				?>
				<table width="200" border="1">
				  <tr>
					<td><?php echo $row_gastos3['clavepartida']; ?></td>
					<td><?php  echo $superuno;?></td>
				  </tr>
				</table>
<?php
		$superuno=0;
		}
?>