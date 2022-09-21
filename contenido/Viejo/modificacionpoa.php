<?php 
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		if ( $row_poa['iniciado'] == 1 )
		{
			function comboDinamico($nombreCombo, $display, $sql, $baseDeDatos)
			{
				echo "<select name='{$nombreCombo}' onchange='submit()'>";
				echo 	"<option value='0'>[Seleccione una opción]</option>";
			
				$res = mysql_db_query ( $baseDeDatos, $sqls );
				while ( $row = mysql_fetch_assoc ( $res ) )
				{
					echo "<option value='{$row['id']}'"; if ( $_POST[$nombreCombo] == $row['id'] ) { echo "selected='selected'"; } echo ">";
					if ( strlen ( $row[$display] ) > 20 )	{	echo substr($row[$display], 0, 34)."...";	}
					else									{	echo $row[$display];						}
					echo "</option>";
				}
				echo "</select>";
			}
			
			function totalGastado($dpto_id,$bdd)
			{
				$gastoDpto = 0;
				$sql_gastado = "SELECT * FROM poa_dpto, insumo WHERE poa_dpto.dpto_id = {$dpto_id} AND poa_dpto.insumo_id = insumo.id";
				if ( $res_gastado = mysql_db_query ( $bdd, $sql_gastado ) )
				{
					while ( $row_gastado = mysql_fetch_assoc ( $res_gastado ) )
					{
						$gastoDpto += $row_gastado['costuni']*$row_gastado['cantidad'];
					}
						return $gastoDpto;
				}
				else
				{
					return 0;
				}
			}
		
		
			if ( isset ( $_POST['modificar'] ) )
			{
				$sql_dpto = "SELECT * FROM presupuesto WHERE dpto_id = {$_SESSION['dpto_id']}";
				$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
				$row_dpto = mysql_fetch_assoc ( $res_dpto );
				
				$sql_insumo = "SELECT * FROM insumo WHERE id = {$_POST['insumo']}";
				$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
				$row_insumo = mysql_fetch_assoc ( $res_insumo );
						
				$sql_capitulo = "SELECT * FROM partida WHERE id = {$_POST['partida']}";
				$res_capitulo = mysql_db_query ( $bdd, $sql_capitulo );
				$row_capitulo = mysql_fetch_assoc ( $res_capitulo );
				
				$capitulo = intval($row_capitulo['clavepartida']/1000);
				$justificacion = strlen($_POST['justificacion']);

				$gastado = totalGastado( $_SESSION['dpto_id'], $bdd );
				
				$anterior = $row_poa['costuni']*$row_poa['cantidad'];
				$nueva = $_POST['cantidad']*$row_insumo['costuni'];
				
				$acumulado = $gastado-$anterior+$nueva;
					
				if ( $_POST['partida'] == 0 or $_POST['insumo'] == 0 or $_POST['cantidad'] == "" )
				{
					$errorCapturaPoa = 1;
				}
				else if ( $capitulo == 5 and $justificacion < 2 )
				{
					$errorCapturaPoa = 2;
				}
				else if ( !ereg("^[0-9]+$",$_POST['cantidad']) )
				{
					$errorCapturaPoa = 3;
				}
				else if ( $acumulado > $row_dpto['presupuesto'] )
				{
					$errorCapturaPoa = 4;
				}
				else
				{
					if($_POST['Periodo']=='Enero - Junio')
					{
						$perio=1;
					}
					else
					{
						$perio=2;
					}
					if($_POST['TipoGasto']=='Ingreso Propio')
					{
						$tipo=1;
					}
					else
					{
						$tipo=2;
					}
					
					$sql = "UPDATE poa_dpto SET partida_id = {$_POST['partida']}, insumo_id = {$_POST['insumo']}, cantidad = {$_POST['cantidad']}, justificacion = '{$_POST['justificacion']}', tipogasto = '{$tipo}', periodo = '{$perio}' WHERE id = {$_POST['poa_dpto']}";
					if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
					{
						$mensajeCapturaPoa = 1;
					}
				}
			}
			
			
			if ( $_POST or $_GET['mod'] == 1)
			{
				$sql_dpto = "SELECT * FROM presupuesto WHERE dpto_id = {$_SESSION['dpto_id']}";
				$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
				$row_dpto = mysql_fetch_assoc ( $res_dpto );
			
				if ( isset ( $_GET['poa_dpto'] ) and !isset ( $_POST['poa_dpto'] ) )
				{
					
					$_POST['poa_dpto'] = $_GET['poa_dpto'];
					$sql_poa = "SELECT * FROM poa_dpto WHERE id = {$_POST['poa_dpto']}";
					$res_poa = mysql_db_query ( $bdd, $sql_poa );
					$row_poa = mysql_fetch_assoc ( $res_poa );
					
					$_POST['partida'] = $row_poa['partida_id'];
					$_POST['insumo'] = $row_poa['insumo_id'];
					$_POST['cantidad'] = $row_poa['cantidad'];
					$_POST['justificacion'] = $row_poa['justificacion'];
					$_POST['TipoGasto'] = $row_poa['tipogasto'];
					$_POST['Periodos'] = $row_poa['periodo'];
					$_POST['Procesos'] = $row_poa['idproceso'];
				}
			?>
			<form action='' method='post'>
			<table width="100%" align="center">
				<tr>
					<td align="center" class="MedianoAzulOscuro"><?php echo $row_unidad['tipounidad']; ?></td>
				</tr>
				<tr>
					<td align="center" width="100%"> 
						<fieldset  style="border-bottom-color:#0066CC" >
							<legend class="MedianoAzulOscuro"><img src="imagenes/basket_put.png"/> Programa operativo anual </legend> <br>
							<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
			<?php
								if ( isset ( $errorCapturaPoa ) )
								{
									switch ( $errorCapturaPoa )
									{
										case 1:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">Debe ingresar datos en todos los campos.</div></td></tr>";
														break;
										case 2:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">Debe ingresar una justificación si elige una partida del capitulo 5000.</div></td></tr>";
														break;
										case 3:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">Debe ingresar únicamente números en la cantidad de insumos.</div></td></tr>";
														break;
										case 4:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">El total de los insumos pedido sobrepasa la cantidad de dinero restante en su departamento.</div></td></tr>";
														break;
									}
								}
								
								if ( isset ( $mensajeCapturaPoa ) )
								{
									switch ( $mensajeCapturaPoa )
									{
										case 1:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoExitoAzul\">El Gasto ha sido modificado!</div></td></tr>";
														break;
									}
								}
								else
								{
			?>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong> Partida: </strong></td>
									<td align="left" class="MedianoAzulOscuro">
									<?php	comboDinamico( "partida", "clavepartida", "SELECT * FROM partida WHERE estado = 1 ORDER BY clavepartida", $bdd ); ?>
										<input type="hidden" name="partida_hidden" value="<?php echo $_POST['partida']; ?>" />									</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Insumo</strong></td>
									<td align="left" class="MedianoAzulOscuro" colspan="3">
			<?php
									if ( $_POST['partida']  != 0)
									{            			
										comboDinamico( "insumo", "descinsu", "SELECT * FROM insumo WHERE estado = 1 AND partida_id = {$_POST['partida']} ORDER BY descinsu", $bdd );
										$sql_insumo = "SELECT * FROM insumo WHERE id = {$_POST['insumo']}";
										$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
										$row_insumo = mysql_fetch_assoc ( $res_insumo );
									}
									else
									{
										echo "<select name='insumo'>";
										echo "<option value=0>Seleccione una partida</option>";
										echo "</select>";
									}
			?>									</td>
								</tr>
								<tr>
			<?php
									if ( $_POST['partida'] )
									{
										$sql = "SELECT * FROM partida WHERE id = {$_POST['partida']}";
										$res = mysql_db_query ( $bdd, $sql );
										$row = mysql_fetch_assoc ( $res );
										$capitulo = intval($row['clavepartida']/1000);
										if ( $capitulo == 5 )
										{
											echo "<td align='right' class='MedianoAzulOscuro'><strong>Justificación</strong></td>";
											echo "<td align='left'><textarea name='justificacion'>{$_POST['justificacion']}</textarea></td>";
										}
									}
			?>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Cantidad:</strong></td>
									<td align="left" class="MedianoAzulOscuro"><input size="15" name="cantidad" type="text" value="<?php echo $_POST['cantidad']; ?>" /></td>
									<td align="right" class="MedianoAzulOscuro"><strong>Medida:</strong></td>
									<td align="left">
			<?php
									echo $row_insumo['medida'];
			?>									</td>
								</tr>
								<tr>
									<td align="right" bgcolor="#FFFFFF" class="MedianoAzulOscuro"><strong>Costo unitario:</strong></td>
									<td align="left" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
			<?php
									echo number_format( $row_insumo['costuni'] ,2,'.',',');
			?>									</td>
								</tr>
								<tr>
								  <td align="right" bgcolor="#FFFFFF" class="MedianoAzulOscuro"><strong>Tipo de Gasto :</strong></td>
								  <td align="left" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
						<?php
								if ( $_POST['partida'] != 0)
								{  
								echo $_POST['TipoGasto'];      			
						?>
							  
									  <select name="TipoGasto" >
											<option >
						<?php
											if($_POST['TipoGasto'] == 1)
											{
												echo $tg='Ingreso Propio';
											}
											else
											{
												echo $tg='Gasto Directo';
											}
						?>
											</option>
											<option >Ingreso Propio</option>
											<option >Gasto Directo</option>
										</select>
						<?php
								}           			
						?>								  </td>
							  </tr>
								<tr>
								  <td align="right" bgcolor="#FFFFFF" class="MedianoAzulOscuro"><strong>Periodo:</strong></td>
								  <td align="left" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
						<?php
								if ( $_POST['partida'] != 0)
								{            			
						?>
	
									  <select name="Periodo" >
									  	<option >
						<?php
											if($_POST['Periodos'] == 1)
											{
												echo $tg='Enero - Junio';
											}
											else
											{
												echo $tg='Julio - Diciembre';
											}
						?>
											</option>
										<option >Enero - Junio</option>
										<option >Julio - Diciembre</option>
									  </select>
						<?php
								}
						?>								  </td>
							  </tr>
								
								<tr>
									<td colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Total Ejercido: </strong></td>
									<td class="MedianoAzulOscuro">
			<?php
									echo number_format ( totalGastado ( $_SESSION['dpto_id'], $bdd ), 2, '.', ',' );
			?>									</td>
									<td class="PequenioAzul" colspan="3" align="center"><img src="imagenes/Floppyblue.gif" name="dpto" border="0" onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar un registro al POA')" />
									<input type="submit" name="modificar"  value="Modificar"/><input type="hidden" name="poa_dpto" value="<?php echo $_POST['poa_dpto']; ?>" />									</td>
								</tr>
								<tr>
									<td colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
								</tr>
								<tr>
									<td class="MedianoAzulOscuro">&nbsp;</td>
									<td class="MedianoAzulOscuro">&nbsp;</td>
									<td align="center" class="MedianoAzulOscuro"><strong>Restante:</strong>
			<?php
									echo "$".number_format ( ( $row_dpto['presupuesto']-totalGastado ( $_SESSION['dpto_id'], $bdd )), 2, '.', ',' );
			?>									</td>
									<td align="center" class="MedianoAzulOscuro"><strong>Presupuestado:</strong>
			<?php
									echo "$".number_format ( $row_dpto['presupuesto'], 2, '.', ',' );
			?>									</td>
								</tr>
			<?php
								}
			?>
							</table>
						</fieldset>
					</td>
				</tr>
			</table>
			<input type="hidden" name="unidadmedida_id" value="<?php echo $_POST['unidadmedida_id']; ?>" />
			</form>
			
			<?php
			}
			else
			{
		
				$sql_programa = "SELECT * FROM poa_dpto WHERE dpto_id = {$_SESSION['dpto_id']}  GROUP BY idaccion";
				if ( $res_programa = mysql_db_query ( $bdd, $sql_programa ) )
				{
					while ( $row_programa = mysql_fetch_assoc ( $res_programa ) )
					{
						$sql_unidad = "SELECT * FROM proceso WHERE id = '{$row_programa['idproceso']}'";
						$res_unidad = mysql_db_query ( $bdd, $sql_unidad );
						if ($row_unidad = mysql_fetch_assoc ( $res_unidad ))
						{
						}
						$sql_unidad1 = "SELECT * FROM actividad WHERE id = '{$row_programa['idactividad']}' ";
						$res_unidad1 = mysql_db_query ( $bdd, $sql_unidad1 );
						if ($row_unidad1 = mysql_fetch_assoc ( $res_unidad1 ))
						{
						}
						$sql_unidad2 = "SELECT * FROM accion WHERE id = '{$row_programa['idacciones']}' ";
						$res_unidad2 = mysql_db_query ( $bdd, $sql_unidad2 );
						if ($row_unidad2 = mysql_fetch_assoc ( $res_unidad2 ))
						{
						}
						$sql_unidad3 = "SELECT * FROM metas WHERE idaccion = '{$row_programa['idaccion']}' ";
						$res_unidad3 = mysql_db_query ( $bdd, $sql_unidad3 );
						if ($row_unidad3 = mysql_fetch_assoc ( $res_unidad3 ))
						{
							$sql_unidad4 = "SELECT * FROM preacciones WHERE id = '{$row_unidad3['idpreacciones']}' ";
							$res_unidad4 = mysql_db_query ( $bdd, $sql_unidad4 );
							if ($row_unidad4 = mysql_fetch_assoc ( $res_unidad4 ))
							{
							}
						}
						echo "<form action='' method='post'>";
						echo "<table align='center' class='Poa'>";
						echo "<tr>";
						echo "<td class='PoaUnidad' colspan='10'><strong>{$row_unidad['claveproceso']}.{$row_unidad1['claveActiv']}.{$row_unidad2['claveAccion']} </br> {$row_unidad4['accion']}</strong></td>";
						echo "</tr>";
						echo "<tr>";
						echo "<td class='PoaTitulo'>Cantidad</td>";
						echo "<td class='PoaTitulo'>Medida</td>";
						echo "<td class='PoaTitulo'>Partida</td>";
						echo "<td class='PoaTitulo'>Insumo</td>";
						echo "<td class='PoaTitulo'>Costo unitario</td>";
						echo "<td class='PoaTitulo'>Total</td>";
						echo "<td class='PoaTitulo'>Periodo</td>";
						echo "<td class='PoaTitulo'>Justificacion</td>";
						echo "<td class='PoaTitulo'>&nbsp;</td>";
						echo "<td class='PoaTitulo'>&nbsp;</td>";
						echo "</tr>";
						
						$sql_poa_dpto = "SELECT poa_dpto.id AS poa_id, poa_dpto.*, insumo.*, partida.* FROM poa_dpto, insumo, partida WHERE poa_dpto.dpto_id = {$_SESSION['dpto_id']}  AND poa_dpto.insumo_id = insumo.id AND poa_dpto.partida_id = partida.id AND poa_dpto.idaccion = {$row_programa['idaccion']} ORDER BY   poa_dpto.idaccion";
						if ( $res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto ) )
						{
							$totalUnidad = 0;
							while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
							{
								$total = $row_poa_dpto['costuni']*$row_poa_dpto['cantidad'];
								echo "<tr>";
								echo "<td class='PoaDatos'>{$row_poa_dpto['cantidad']}&nbsp;</td>";
								echo "<td class='PoaDatos'>{$row_poa_dpto['medida']}&nbsp;</td>";
								echo "<td class='PoaDatos'>{$row_poa_dpto['clavepartida']}&nbsp;</td>";
								echo "<td class='PoaDatos'>{$row_poa_dpto['descinsu']}&nbsp;</td>";
								echo "<td class='PoaDatos'>{$row_poa_dpto['costuni']}&nbsp;</td>";
								echo "<td class='PoaDatos'>\$".number_format ( $total, 2, '.', ',' )."</td>";
								if($row_poa_dpto['periodo']==1){$per='Ene-Jun';} else {$per='Jul-Dic';}
								echo "<td class='PoaDatos'>{$per} &nbsp;</td>";
								echo "<td class='PoaDatos'>{$row_poa_dpto['justificacion']}&nbsp;</td>";
								if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
								{
									echo "<td class='PoaDatos'><a href='index.php?sec=4&mod=1&poa_dpto={$row_poa_dpto['poa_id']}'><img src='imagenes/pencil.png' border='0'></td>";
									echo "<td class='PoaDatos'><a href='index.php?sec=d&table=poa_dpto&id={$row_poa_dpto['poa_id']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
								}
								else
								{
									echo "<td class='PoaDatos'>&nbsp;</td>";
									echo "<td class='PoaDatos'>&nbsp;</td>";
								}
								echo "</tr>";
								$totalUnidad += $total;
							}
							echo "<tr>";
							echo "<td class='PoaDatos' colspan='4'>&nbsp;</td>";
							echo "<td class='PoaDatos'>TOTAL</td>";
							echo "<td class='PoaDatos'>\$".number_format ( $totalUnidad, 2, '.', ',' )."</td>";
							echo "<td class='PoaDatos' colspan='4'>&nbsp;</td>";
							echo "</tr>";
						}
						echo "</table></form><br /><br />";
					}
				}
			}
		
		}
		else
		{
			echo "<div align='center' class='MedianoAlerta'>No se ha iniciado o ha terminado la captura del Ejercicio.</div>";
		}
	}
	else
	{
		echo "<div align='center' class='MedianoAlerta'>No se ha iniciado la captura del Ejercicio.</div>";
	}
?>