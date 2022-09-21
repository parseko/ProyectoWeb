<?php
	$_SESSION['candado'] = 0;
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
					echo "<td class='PoaUnidad' colspan='9'><strong> - Para Autorización - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Partida</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>S&nbsp;</td>";
					echo "<td class='PoaTitulo'>R&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM solicitud_servicio, partida, accion WHERE solicitud_servicio.iddpto='{$_SESSION['dpto_id']}'  AND solicitud_servicio.planea = 0 AND solicitud_servicio.idpartida=partida.id AND solicitud_servicio.idmeta=accion.id";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					echo "<tr>";
						echo "<td class='PoaDatos'>{$row_requi['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['clavepartida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['descripcion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['importe']}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=16&solicitud={$row_requi['idsolicitud']}&mod=1'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="solicitud_servicio";
						echo "<td class='PoaDatos'><a href='index.php?sec=14&table={$tabla}&id={$row_requi['idsolicitud']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteSolicitud.php?Servicio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
						if($row_requi['importe'] >= 1500 )
						{
							echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_2.php?Oficio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Requisicion' /></a></td>";
						}
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//DEVOLUCIONES
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='10'><strong> - Devolución - </strong></td>";
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
					echo "<td class='PoaTitulo'>S&nbsp;</td>";
					echo "<td class='PoaTitulo'>R&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM solicitud_servicio, partida, accion WHERE solicitud_servicio.iddpto='{$_SESSION['dpto_id']}'  AND solicitud_servicio.planea = 2 AND solicitud_servicio.idpartida=partida.id AND solicitud_servicio.idmeta=accion.id";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					
					echo "<tr>";
						echo "<td class='PoaDatos'>{$row_requi['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['clavepartida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['descripcion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['importe']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['nota']}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=16&solicitud={$row_requi['idsolicitud']}&mod=1'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="solicitud_servicio";
						echo "<td class='PoaDatos'><a href='index.php?sec=14&table={$tabla}&id={$row_requi['idsolicitud']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteSolicitud.php?Servicio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
						if($row_requi['importe'] >= 1500 )
						{
							echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_2.php?Oficio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Requisicion' /></a></td>";
						}
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//ACEPTADOS
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='7'><strong> - Autorizadas - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Partida</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>S&nbsp;</td>";
					echo "<td class='PoaTitulo'>R&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM solicitud_servicio, partida, accion WHERE solicitud_servicio.iddpto='{$_SESSION['dpto_id']}'  AND solicitud_servicio.planea = 1 AND solicitud_servicio.idpartida=partida.id AND solicitud_servicio.idmeta=accion.id";
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
						echo "<td class='PoaDatos'>{$row_requi['descripcion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['importe']}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteSolicitud.php?Servicio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
						if($row_requi['importe'] >= 1500 )
						{
							echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_2.php?Oficio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Requisicion' /></a></td>";
						}
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//Canceladas
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='7'><strong> - Canceladas - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Partida</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>S&nbsp;</td>";
					echo "<td class='PoaTitulo'>R&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM solicitud_servicio, partida, accion WHERE solicitud_servicio.iddpto='{$_SESSION['dpto_id']}'  AND solicitud_servicio.planea = 4 AND solicitud_servicio.idpartida=partida.id AND solicitud_servicio.idmeta=accion.id";
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
						echo "<td class='PoaDatos'>{$row_requi['descripcion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['importe']}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteSolicitud.php?Servicio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
						if($row_requi['importe'] >= 1500 )
						{
							echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_2.php?Oficio={$row_requi['idsolicitud']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Requisicion' /></a></td>";
						}
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";

			}
		}
	}
	$_SESSION['Candado']=1;
?>