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
					echo "<td class='PoaTitulo'>Partida</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM requisicion, partida, accion WHERE requisicion.iddpto='{$_SESSION['dpto_id']}'  AND requisicion.planea = 0 AND requisicion.idpartida=partida.id AND requisicion.idmeta=accion.id";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					echo "<tr>";
						$total=0;
						$sql_bien = "SELECT * FROM bienservicio WHERE idrequisicion='{$row_requi['idrequisicion']}'";
						$res_bien = mysql_db_query ( $bdd, $sql_bien );
						while ( $row_bien = mysql_fetch_assoc ( $res_bien ) )
						{
							$total=$total+($row_bien['cantidad']*$row_bien['costo']);
						}
						echo "<td class='PoaDatos'>{$row_requi['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['clavepartida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['nota']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=17&par=1&id={$row_requi['idrequisicion']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="requisicion";
						$tabla1="bienservicio";						
						echo "<td class='PoaDatos'><a href='index.php?sec=15&table={$tabla}&table1={$tabla1}&id={$row_requi['idrequisicion']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_1.php?oficio={$row_requi['idrequisicion']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
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
					echo "<td class='PoaTitulo'>Partida</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>Nota</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM requisicion, partida, accion WHERE requisicion.iddpto='{$_SESSION['dpto_id']}'  AND requisicion.planea = 2 AND requisicion.idpartida=partida.id AND requisicion.idmeta=accion.id";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					
					echo "<tr>";
						$total=0;
						$sql_bien = "SELECT * FROM bienservicio WHERE idrequisicion='{$row_requi['idrequisicion']}'";
						$res_bien = mysql_db_query ( $bdd, $sql_bien );
						while ( $row_bien = mysql_fetch_assoc ( $res_bien ) )
						{
							$total=$total+($row_bien['cantidad']*$row_bien['costo']);
						}
						echo "<td class='PoaDatos'>{$row_requi['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['clavepartida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['nota']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['comentario']}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=17&par=1&id={$row_requi['idrequisicion']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="requisicion";
						$tabla1="bienservicio";						
						echo "<td class='PoaDatos'><a href='index.php?sec=15&table={$tabla}&table1={$tabla1}&id={$row_requi['idrequisicion']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_1.php?oficio={$row_requi['idrequisicion']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//ACEPTADOS
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='6'><strong> - Aceptadas - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Partida</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM requisicion, partida, accion WHERE requisicion.iddpto='{$_SESSION['dpto_id']}'  AND requisicion.planea = 1 AND requisicion.idpartida=partida.id AND requisicion.idmeta=accion.id";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					echo "<tr>";
						$total=0;
						$sql_bien = "SELECT * FROM bienservicio WHERE idrequisicion='{$row_requi['idrequisicion']}'";
						$res_bien = mysql_db_query ( $bdd, $sql_bien );
						while ( $row_bien = mysql_fetch_assoc ( $res_bien ) )
						{
							$total=$total+($row_bien['cantidad']*$row_bien['costo']);
						}
						echo "<td class='PoaDatos'>{$row_requi['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['clavepartida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['nota']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_1.php?oficio={$row_requi['idrequisicion']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
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
					echo "<td class='PoaTitulo'>Partida</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM requisicion, partida, accion WHERE requisicion.iddpto='{$_SESSION['dpto_id']}'  AND requisicion.planea = 4 AND requisicion.idpartida=partida.id AND requisicion.idmeta=accion.id";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					echo "<tr>";
						$total=0;
						$sql_bien = "SELECT * FROM bienservicio WHERE idrequisicion='{$row_requi['idrequisicion']}'";
						$res_bien = mysql_db_query ( $bdd, $sql_bien );
						while ( $row_bien = mysql_fetch_assoc ( $res_bien ) )
						{
							$total=$total+($row_bien['cantidad']*$row_bien['costo']);
						}
						echo "<td class='PoaDatos'>{$row_requi['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['clavepartida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['nota']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_1.php?oficio={$row_requi['idrequisicion']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
			}
		}
	}
	$_SESSION['Candado']=1;
?>