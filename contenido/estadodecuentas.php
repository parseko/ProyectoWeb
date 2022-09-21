<?php
	
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
				$sql_poa_dpto_gastos = "SELECT poa_dpto_gastos.id AS poa_id, poa_dpto_gastos.*, insumo.*, partida.* FROM poa_dpto_gastos, insumo, partida WHERE poa_dpto_gastos.dpto_id = '{$dpto_id}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.partida_id = partida.id AND poa_dpto_gastos.idacciones='$medida' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' AND poa_dpto_gastos.tipogasto=1";
				if ( $res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos ) )
				{
					$totalUnidad = 0;
					$totalgastos = 0;
					while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
					{
						$total = $row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
						$totalUnidad += $total;
					}
				}
					return $totalUnidad;
			}
			
			if ( $_GET['dep'] != 1 and $_GET['dep'] != 2)
			{
				//SELECCIONAR EL DEPARTAMENTO
				$sql_dpto = "SELECT * FROM dpto ORDER BY id";
				if ( $res_dpto = mysql_db_query ( $bdd, $sql_dpto ) )
				{	
					echo "<form action='' method='post'>";
					echo "<table align='center' class='Poa'>";
					echo "<tr>";
					echo "<td class='PoaTitulo' colspan='2'><strong>ESTADOS DE CUENTAS POR DEPARTAMENTOS</strong></td>";
					echo "</tr>";
					while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
					{
						echo "<tr>";
						echo "<td class='PoaDatos'>{$row_dpto['nombredpto']}</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=2&dep=1&id={$row_dpto['id']}'><img src='imagenes/book_open.gif' border='0'></a></td>";
						//$_SESSION['DPTO'] = $row_poa_dpto_gastos['poa_id'];
						echo "</tr>";
					}
					echo "</table></form><br /><br />";
				}
			}
			if ( $_POST or $_GET['dep'] == 1)
			{
				$_SESSION['DPTO'] = $_GET['id'];
				//MODIFIQUE EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
				$sql_programa = "SELECT * FROM poa_dpto_gastos WHERE dpto_id='{$_SESSION['DPTO']}' AND tipogasto=1 GROUP BY idacciones";
				if ( $res_programa = mysql_db_query ( $bdd, $sql_programa ) )
				{
					while ( $row_programa = mysql_fetch_assoc ( $res_programa ) )
					{
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
						if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
						{
							$partida1000=0;
							$partida2000=0;
							$partida3000=0;
							$partida5000=0;
							$partida7000=0;
							while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
							{
								$sql_partida = "SELECT * FROM partida WHERE id = $row_gastos_dpto[idpartida]";
								if ( $res_partida = mysql_db_query ( $bdd, $sql_partida ) )
								{
									while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
									{
										if(($row_partida['clavepartida'] >= 1000) and ($row_partida['clavepartida'] <= 1999))
										{
											$partida1000=1;
										}
										if(($row_partida['clavepartida'] >= 2000) and ($row_partida['clavepartida'] <= 2999))
										{
											$partida2000=1;
										}
										if(($row_partida['clavepartida'] >= 3000) and ($row_partida['clavepartida'] <= 3999))
										{
											$partida3000=1;
										}
										if(($row_partida['clavepartida'] >= 5000) and ($row_partida['clavepartida'] <= 5999))
										{
											$partida5000=1;
										}
										if(($row_partida['clavepartida'] >= 7000) and ($row_partida['clavepartida'] <= 7999))
										{
											$partida7000=1;
										}
									}
								}
							}
						}
						$partida1000=1;
						$partida2000=1;
						$partida3000=1;
						$partida5000=1;
						$partida7000=1;
						echo "<form action='' method='post'>";
						echo "<table align='center' class='Poa'>";
						echo "<tr>";
						$sql_2 = "SELECT * FROM accion WHERE id='{$row_programa['idacciones']}'";
						$res_2 = mysql_db_query ( $bdd, $sql_2 );
						if ( $row_2 = mysql_fetch_assoc ( $res_2 ) )
						{
							
						}
						echo "<td class='PoaUnidad' colspan='10'><strong>{$row_2['claveAccion']} - {$row_2['nombreAccion']}</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td class='PoaTitulo'>Meta</td>";
						echo "<td class='PoaTitulo'>Partida</td>";
						echo "<td class='PoaTitulo'>Control</td>";
						echo "<td class='PoaTitulo'>Monto</td>";
						echo "<td class='PoaTitulo'>Justificacion</td>";
						echo "<td class='PoaTitulo'>Fecha</td>";
						echo "<td class='PoaTitulo'>Docto.</td>";
						echo "<td class='PoaTitulo'>Depto. Solic.</td>";
						echo "<td class='PoaTitulo'>&nbsp;</td>";
						echo "<td class='PoaTitulo'>&nbsp;</td>";
						echo "</tr>";
						if($partida1000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 1000 </strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 1000) and ($row_partida_busqueda['clavepartida'] <= 1999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
											}
										}
									}
									echo "</tr>";
								}
								$tam=1000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								echo "<tr>";
								echo "<td class='PoaDatos' align='right' colspan='7'>PRESUPUESTO</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>RESTANTE</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo-$totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "</tr>";
							}
						}
						if($partida2000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 2000 </strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 2000) and ($row_partida_busqueda['clavepartida'] <= 2999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}

													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_partida_busqueda['id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
											}
										}
									}
									echo "</tr>";
								}
								$tam=2000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								echo "<tr>";
								echo "<td class='PoaDatos' align='right' colspan='7'>PRESUPUESTO</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>RESTANTE</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo-$totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "</tr>";
							}
						}
						if($partida3000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 3000 </strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 3000) and ($row_partida_busqueda['clavepartida'] <= 3999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
											}
										}
									}
									echo "</tr>";
								}
								$tam=3000;
								$hola = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								echo "<tr>";
								echo "<td class='PoaDatos' align='right' colspan='7'>PRESUPUESTO</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $hola, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>RESTANTE</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $hola-$totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "</tr>";
							}
						}
						if($partida5000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 5000 </strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 5000) and ($row_partida_busqueda['clavepartida'] <= 5999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
											}
										}
									}
									echo "</tr>";
								}
								$tam=5000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								echo "<tr>";
								echo "<td class='PoaDatos' align='right' colspan='7'>PRESUPUESTO</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>RESTANTE</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo-$totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "</tr>";
							}
						}
						if($partida7000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 7000 </strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 7000) and ($row_partida_busqueda['clavepartida'] <= 7999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
											}
										}
									}
									echo "</tr>";
								}
								$tam=7000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								echo "<tr>";
								echo "<td class='PoaDatos' align='right' colspan='7'>PRESUPUESTO</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>RESTANTE</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $Capitulo-$totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								echo "</tr>";
							}
						}
						echo "</table></form><br /><br />";
					}
				}
				//****REMANENTE***********
			
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND donde = 'Remanente' ";
						if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
						{
							$partida1000=0;
							$partida2000=0;
							$partida3000=0;
							$partida5000=0;
							$partida7000=0;
							while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
							{
								$sql_partida = "SELECT * FROM partida WHERE id = $row_gastos_dpto[idpartida]";
								if ( $res_partida = mysql_db_query ( $bdd, $sql_partida ) )
								{
									while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
									{
										if(($row_partida['clavepartida'] >= 1000) and ($row_partida['clavepartida'] <= 1999))
										{
											$partida1000=1;
										}
										if(($row_partida['clavepartida'] >= 2000) and ($row_partida['clavepartida'] <= 2999))
										{
											$partida2000=1;
										}
										if(($row_partida['clavepartida'] >= 3000) and ($row_partida['clavepartida'] <= 3999))
										{
											$partida3000=1;
										}
										if(($row_partida['clavepartida'] >= 5000) and ($row_partida['clavepartida'] <= 5999))
										{
											$partida5000=1;
										}
										if(($row_partida['clavepartida'] >= 7000) and ($row_partida['clavepartida'] <= 7999))
										{
											$partida7000=1;
										}
									}
								}
							}
						}
						$partida1000=1;
						$partida2000=1;
						$partida3000=1;
						$partida5000=1;
						$partida7000=1;
						echo "<form action='' method='post'>";
						echo "<table align='center' class='Poa'>";
						echo "<tr>";
						$sql_2 = "SELECT * FROM accion WHERE id='{$row_programa['idacciones']}'";
						$res_2 = mysql_db_query ( $bdd, $sql_2 );
						if ( $row_2 = mysql_fetch_assoc ( $res_2 ) )
						{
							
						}
						echo "<td class='PoaUnidad' colspan='10'><strong> -- REMANENTE --</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td class='PoaTitulo'>Meta</td>";
						echo "<td class='PoaTitulo'>Partida</td>";
						echo "<td class='PoaTitulo'>Control</td>";
						echo "<td class='PoaTitulo'>Monto</td>";
						echo "<td class='PoaTitulo'>Justificacion</td>";
						echo "<td class='PoaTitulo'>Fecha</td>";
						echo "<td class='PoaTitulo'>Docto.</td>";
						echo "<td class='PoaTitulo'>Depto. Solic.</td>";
						echo "<td class='PoaTitulo'>&nbsp;</td>";
						echo "<td class='PoaTitulo'>&nbsp;</td>";
						echo "</tr>";
						if($partida1000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 1000 - REMANENTE</strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND donde = 'Remanente'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 1000) and ($row_partida_busqueda['clavepartida'] <= 1999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
												if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
												{
													
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
												}
												else
												{
													echo "<td class='PoaDatos'>&nbsp;</td>";
													echo "<td class='PoaDatos'>&nbsp;</td>";
												}
											}
										}
									}
									echo "</tr>";
								}
								$tam=1000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								
								echo "</tr>";
							}
						}
						if($partida2000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 2000 - REMANENTE</strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND donde = 'Remanente'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 2000) and ($row_partida_busqueda['clavepartida'] <= 2999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}

												if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
												{
													
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_partida_busqueda['id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
												}
												else
												{
													echo "<td class='PoaDatos'>&nbsp;</td>";
													echo "<td class='PoaDatos'>&nbsp;</td>";
												}
											}
										}
									}
									echo "</tr>";
								}
								$tam=2000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								
								echo "</tr>";
							}
						}
						if($partida3000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 3000 - REMANENTE</strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND donde = 'Remanente'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 3000) and ($row_partida_busqueda['clavepartida'] <= 3999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
												if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
												{
													
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
												}
												else
												{
													echo "<td class='PoaDatos'>&nbsp;</td>";
													echo "<td class='PoaDatos'>&nbsp;</td>";
												}
											}
										}
									}
									echo "</tr>";
								}
								$tam=3000;
								$hola = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								
								echo "</tr>";
							}
						}
						if($partida5000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 5000 - REMANENTE</strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND donde = 'Remanente'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 5000) and ($row_partida_busqueda['clavepartida'] <= 5999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
												if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
												{
													
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
												}
												else
												{
													echo "<td class='PoaDatos'>&nbsp;</td>";
													echo "<td class='PoaDatos'>&nbsp;</td>";
												}
											}
										}
									}
									echo "</tr>";
								}
								$tam=5000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								
								echo "</tr>";
							}
						}
						if($partida7000==1)
						{
							$totalgastos=0;
							echo "<tr>";
							echo "<td class='PoaUnidad' colspan='10'><strong>Capitulo 7000 - REMANENTE</strong></td>";
							echo "</tr>";
	
							//MODIFIQUE EL EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
							$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND donde = 'Remanente'";
							if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
							{
								while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
								{
									echo "<tr>";
									$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
									if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
									{
										if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
										{
											if(($row_partida_busqueda['clavepartida'] >= 7000) and ($row_partida_busqueda['clavepartida'] <= 7999))
											{
												$totalgastos += $row_gastos_dpto['monto'];
												$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												while ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['claveAccion']}&nbsp;</td>";
												}
												echo "<td class='PoaDatos'>{$row_partida_busqueda['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['monto']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['justificacion']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['fecha']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_gastos_dpto['documento']}&nbsp;</td>";
												$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
												$res_1 = mysql_db_query ( $bdd, $sql_1 );
												if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
												{
													echo "<td class='PoaDatos'>{$row_1['nombredpto']}&nbsp;</td>";
												}
												if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
												{
													
													echo "<td class='PoaDatos'><a href='index.php?sec=5&dep=2&partida={$row_gastos_dpto['partida_id']}&can=1&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/pencil.png' border='0'></a></td>";
													echo "<td class='PoaDatos'><a href='index.php?sec=d&table=gastos_dpto&id={$row_gastos_dpto['idgastos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
													$_SESSION['Candado']=1;
												}
												else
												{
													echo "<td class='PoaDatos'>&nbsp;</td>";
													echo "<td class='PoaDatos'>&nbsp;</td>";
												}
											}
										}
									}
									echo "</tr>";
								}
								$tam=7000;
								$Capitulo = PresupuestoCapitulo ( $_SESSION['DPTO'], $row_programa['idacciones'], $bdd, $tam);
								
								echo "<tr>";
								echo "<td class='PoaDatos' colspan='7'>GASTOS</td>";
								echo "<td class='PoaDatos' colspan='3'>\$".number_format ( $totalgastos, 2, '.', ',' )."</td>";
								echo "</tr>";
								
								echo "</tr>";
							}
						}
						echo "</table></form><br /><br />";
				//****FIN DE REMANENTE****
			}
		}
	}
	$_SESSION['Candado']=1;
?>