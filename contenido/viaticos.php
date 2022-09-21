	<?php
	$_SESSION['Canda']=0;
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		if ( $row_poa['iniciado'] == 1 )
		{
				
			function PresupuestoCapitulo($dpto_id,$medida,$bdd,$tamano)
			{
				$total=0;
				$totalUnidad=0;
				$gastoDpto = 0;
				$tamano1=$tamano+1000;	
				$sql_poa_dpto = "SELECT poa_dpto.id AS poa_id, poa_dpto.*, insumo.*, partida.* FROM poa_dpto, insumo, partida WHERE poa_dpto.dpto_id = '{$dpto_id}' AND poa_dpto.insumo_id = insumo.id AND poa_dpto.partida_id = partida.id AND poa_dpto.idacciones='$medida' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' ";
				if ( $res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto ) )
				{
					$totalUnidad = 0;
					$totalgastos = 0;
					while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
					{
						$total = $row_poa_dpto['costuni']*$row_poa_dpto['cantidad'];
						$totalUnidad += $total;
					}
				}
					return $totalUnidad;
			}
			
			if ( $_POST or $_GET['dep'] != 1)
			{
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='8'><strong> - Para Autorización - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Nombre</td>";
					echo "<td class='PoaTitulo'>Motivo</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_viaticos = "SELECT * FROM viaticos, partida, accion WHERE viaticos.iddpto='{$_SESSION['dpto_id']}'  AND viaticos.planea = 0 AND viaticos.idpartida=partida.id AND viaticos.idmeta=accion.id";
				$res_viaticos = mysql_db_query ( $bdd, $sql_viaticos );
				while ( $row_viaticos = mysql_fetch_assoc ( $res_viaticos ) )
				{
					echo "<tr>";
						$total=$row_viaticos['cuota']*$row_viaticos['dias'];
						echo "<td class='PoaDatos'>{$row_viaticos['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['comisionado']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['motivo']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						//echo "<td class='PoaDatos'><a href='index.php?sec=20&par=1&viaticos={$row_viaticos['idviaticos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="viaticos";
						echo "<td class='PoaDatos'><a href='index.php?sec=21&table={$tabla}&viaticos={$row_viaticos['idviaticos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/MinistracionViaticos.php?Viaticos={$row_viaticos['idviaticos']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//DEVOLUCIONES
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='9'><strong> - Devolución - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Nombre</td>";
					echo "<td class='PoaTitulo'>Motivo</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>Nota</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_viaticos = "SELECT * FROM viaticos, partida, accion WHERE viaticos.iddpto='{$_SESSION['dpto_id']}'  AND viaticos.planea = 2 AND viaticos.idpartida=partida.id AND viaticos.idmeta=accion.id";
				$res_viaticos = mysql_db_query ( $bdd, $sql_viaticos );
				while ( $row_viaticos = mysql_fetch_assoc ( $res_viaticos ) )
				{
					
					echo "<tr>";
						$total=$row_viaticos['cuota']*$row_viaticos['dias'];
						echo "<td class='PoaDatos'>{$row_viaticos['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['comisionado']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['motivo']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['nota']}&nbsp;</td>";
						//echo "<td class='PoaDatos'><a href='index.php?sec=22&par=1&viaticos={$row_viaticos['idviaticos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="viaticos";
						echo "<td class='PoaDatos'><a href='index.php?sec=21&table={$tabla}&viaticos={$row_viaticos['idviaticos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/MinistracionViaticos.php?Viaticos={$row_viaticos['idviaticos']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//AUTORIZADOS
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='6'><strong> - AUTORIZADOS - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Nombre</td>";
					echo "<td class='PoaTitulo'>Motivo</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_viaticos = "SELECT * FROM viaticos, partida, accion WHERE viaticos.iddpto='{$_SESSION['dpto_id']}'  AND viaticos.planea = 1 AND viaticos.idpartida=partida.id AND viaticos.idmeta=accion.id";
				$res_viaticos = mysql_db_query ( $bdd, $sql_viaticos );
				while ( $row_viaticos = mysql_fetch_assoc ( $res_viaticos ) )
				{
					echo "<tr>";
						$total=$row_viaticos['cuota']*$row_viaticos['dias'];
						echo "<td class='PoaDatos'>{$row_viaticos['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['comisionado']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['motivo']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='reportes/MinistracionViaticos.php?Viaticos={$row_viaticos['idviaticos']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//CANCELADAS
								echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='6'><strong> - Canceladas - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Nombre</td>";
					echo "<td class='PoaTitulo'>Motivo</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_viaticos = "SELECT * FROM viaticos, partida, accion WHERE viaticos.iddpto='{$_SESSION['dpto_id']}'  AND viaticos.planea = 4 AND viaticos.idpartida=partida.id AND viaticos.idmeta=accion.id";
				$res_viaticos = mysql_db_query ( $bdd, $sql_viaticos );
				while ( $row_viaticos = mysql_fetch_assoc ( $res_viaticos ) )
				{
					echo "<tr>";
						$total=$row_viaticos['cuota']*$row_viaticos['dias'];
						echo "<td class='PoaDatos'>{$row_viaticos['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['comisionado']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['motivo']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='reportes/MinistracionViaticos.php?Viaticos={$row_viaticos['idviaticos']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
			}
		}
	}
	$_SESSION['Candado']=1;
?>