<?php	
	$_SESSION['Total']=0;
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
		{
			$sql_dpto = "SELECT * FROM presupuesto WHERE dpto_id = {$_SESSION['dpto_id']}";
			$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
			if ( !$row_dpto = mysql_fetch_assoc ( $res_dpto ) )
			{
				echo "<div align = \"center\" class = \"MedianoAlerta\">No tiene un presupuesto asignado.</div>";
			}
			else
			{	
				function comboDinamico($nombreCombo, $display, $sql, $baseDeDatos)
				{
					echo "<select name='{$nombreCombo}' onchange='submit()'>";
					echo 	"<option value='0'>[Seleccione una opción]</option>";
			
					$res = mysql_db_query ( $baseDeDatos, $sql );
					while ( $row = mysql_fetch_assoc ( $res ) )
					{
						echo "<option value='{$row['id']}'"; if ( $_POST[$nombreCombo] == $row['id'] ) { echo "selected='selected'"; } echo ">";
						if ( strlen ( $row[$display] ) > 20 )	{	echo substr($row[$display], 0, 50)."...";	}
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
				
				if ( isset ( $_POST['ingresar'] ) )
				{
				
					$sql_insumo = "SELECT * FROM insumo WHERE id = {$_POST['insumo']}";
					$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
					$row_insumo = mysql_fetch_assoc ( $res_insumo );
				
					$gastado = totalGastado( $_SESSION['dpto_id'], $bdd );
					$acumulado = $gastado+($_POST['cantidad']*$row_insumo['costuni']);
					
					$sql_capitulo = "SELECT * FROM partida WHERE id = {$_POST['partida']}";
					$res_capitulo = mysql_db_query ( $bdd, $sql_capitulo );
					$row_capitulo = mysql_fetch_assoc ( $res_capitulo );
					$capitulo = intval($row_capitulo['clavepartida']/1000);
					$justificacion = strlen($_POST['justificacion']);
					
					if ( $_POST['partida'] == 0 or $_POST['insumo'] == 0 )
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
						//++++++++++++++
						$_SESSION['uno']='Gasto Directo';
						if($_POST['TipoGasto'] != $_SESSION['uno'])
						{
							$Tipo1=1;
						}
						else
						{
							$Tipo1=2;
						}
						//++++++++++++++
						$_SESSION['dos']='Enero - Junio';
						if($_POST['TipoGasto'] != $_SESSION['dos'])
						{
							$Tipo1=1;
						}
						else
						{
							$Tipo1=2;
						}
						if($_POST['cantidad'] == 0 and $_POST['cantidad2'] == 0)
						{
							$errorCapturaPoa=1;
						}
						else if($_POST['cantidad'] != 0 and $_POST['cantidad2'] != 0)
						{
							$sql = "INSERT INTO poa_dpto ( dpto_id, partida_id, insumo_id, cantidad, descripcion, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa ) VALUES ( {$_SESSION['dpto_id']}, {$_POST['partida']}, {$_POST['insumo']}, {$_POST['cantidad']}, '{$_POST['Descripcion']}', '{$_POST['justificacion']}', '{$_GET['Accion']}', '{$Tipo1}', '1',  '{$_GET['Proceso']}', '{$_GET['Clave']}', '{$_GET['Acciones']}', '{$row_poa['id']}' )";
							if ( $res = mysql_db_query ( $bdd, $sql ) )
							{
								$mensajeCapturaPoa = 1;
							}
							$sql = "INSERT INTO poa_dpto ( dpto_id, partida_id, insumo_id, cantidad, descripcion, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa ) VALUES ( {$_SESSION['dpto_id']}, {$_POST['partida']}, {$_POST['insumo']}, {$_POST['cantidad2']}, '{$_POST['Descripcion']}', '{$_POST['justificacion']}', '{$_GET['Accion']}', '{$Tipo1}', '2',  '{$_GET['Proceso']}', '{$_GET['Clave']}', '{$_GET['Acciones']}', '{$row_poa['id']}' )";
							if ( $res = mysql_db_query ( $bdd, $sql ) )
							{
								$mensajeCapturaPoa = 1;
							}
						}
						else if($_POST['cantidad'] != 0 and $_POST['cantidad2'] == 0)
						{					
							$sql = "INSERT INTO poa_dpto ( dpto_id, partida_id, insumo_id, cantidad, descripcion, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa ) VALUES ( {$_SESSION['dpto_id']}, {$_POST['partida']}, {$_POST['insumo']}, {$_POST['cantidad']}, '{$_POST['Descripcion']}', '{$_POST['justificacion']}', '{$_GET['Accion']}', '{$Tipo1}', '1',  '{$_GET['Proceso']}', '{$_GET['Clave']}', '{$_GET['Acciones']}', '{$row_poa['id']}' )";
							if ( $res = mysql_db_query ( $bdd, $sql ) )
							{
								$mensajeCapturaPoa = 1;
							}
						}
						else if($_POST['cantidad'] == 0 and $_POST['cantidad2'] != 0)
						{					
							$sql = "INSERT INTO poa_dpto ( dpto_id, partida_id, insumo_id, cantidad, descripcion, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa ) VALUES ( {$_SESSION['dpto_id']}, {$_POST['partida']}, {$_POST['insumo']}, {$_POST['cantidad2']}, '{$_POST['Descripcion']}', '{$_POST['justificacion']}', '{$_GET['Accion']}', '{$Tipo1}', '2',  '{$_GET['Proceso']}', '{$_GET['Clave']}', '{$_GET['Acciones']}', '{$row_poa['id']}' )";
							if ( $res = mysql_db_query ( $bdd, $sql ) )
							{
								$mensajeCapturaPoa = 1;
							}
						}
					}
				}
			
		?>
		
		<form action="" method="post">
		<table width="100%" align="center">
			<tr>
<?php
				$sql_pre = "SELECT * FROM metas WHERE idaccion = '{$_GET['Accion']}'";
				$res_pre = mysql_db_query ( $bdd, $sql_pre );
				$row_pre = mysql_fetch_assoc ( $res_pre );
				{
					$sql_pre1 = "SELECT * FROM preacciones WHERE id = '{$row_pre['idpreacciones']}'";
					$res_pre1 = mysql_db_query ( $bdd, $sql_pre1 );
					$row_pre1 = mysql_fetch_assoc ( $res_pre1 );
					
				}	
?>			
				<td align="center" class="MedianoAzulOscuro"><?php echo $row_pre1['accion']; ?></td>
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
									case 1:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoExitoAzul\">Gasto ingresado!</div></td></tr>";
												$_POST['partida']=0;
									break;
								}
							}
		?>
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong> Partida: </strong></td>
								<td align="left" class="MedianoAzulOscuro">
								<?php	comboDinamico( "partida", "clavepartida", "SELECT * FROM partida WHERE estado = 1 ORDER BY clavepartida", $bdd ); ?>
									<input type="hidden" name="partida_hidden" value="<?php echo $_POST['partida']; ?>" />								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong>Insumo</strong></td>
								<td align="left" class="MedianoAzulOscuro" colspan="3">
		<?php
								if ( $_POST['partida']  != 0)
								{            			
									comboDinamico( "insumo", "descinsu", "SELECT * FROM insumo WHERE estado = 1 AND partida_id = {$_POST['partida']} ORDER BY descinsu", $bdd );
									$sql_insumo = "SELECT * FROM insumo WHERE id = {$_POST['insumo']} ORDER BY descinsu";
									$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
									$row_insumo = mysql_fetch_assoc ( $res_insumo );
								}
								else
								{
									echo "<select name='insumo'>";
									echo "<option value=0>Seleccione una partida</option>";
									echo "</select>";
								}
		?>								</td>
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
										echo "<td align='left'><textarea name='justificacion'></textarea></td>";
										echo "<td align='right' class='MedianoAzulOscuro'><strong>Descripcion</strong></td>";
										echo "<td align='left'><textarea name='Descripcion'></textarea></td>";
									}
								}
								
		?>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong>Cantidad Enero - Junio:</strong></td>
								<td align="left" class="MedianoAzulOscuro"><input size="15" name="cantidad" type="text" /></td>
								<td align="right" class="MedianoAzulOscuro"><strong>Medida:</strong></td>
								<td align="left">
		<?php
								echo $row_insumo['medida'];
		?>								</td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Cantidad Agosto - Diciembre:</strong></td>
							  <td align="left" class="MedianoAzulOscuro"><input size="15" name="cantidad2" type="text" /></td>
							  <td align="right" class="MedianoAzulOscuro">&nbsp;</td>
							  <td align="left">&nbsp;</td>
						  </tr>
							<tr>
								<td align="right" bgcolor="#FFFFFF" class="MedianoAzulOscuro"><strong>Costo unitario:</strong></td>
								<td align="left" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
		<?php
								echo number_format( $row_insumo['costuni'] ,2,'.',',');
		?>								</td>
							</tr>
							<tr>
							  <td align="right" bgcolor="#FFFFFF" class="MedianoAzulOscuro"><strong>Tipo de Gasto :</strong></td>
							  <td align="left" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
						<?php
								if ( $_POST['partida'] != 0)
								{            			
						?>
							  
									  <select name="TipoGasto" >
									  		<option >Ingreso Propio</option>
											<option >Gasto Directo</option>
									  </select>
						<?php
								}           			
						?>								</td>
						  </tr>
							
							
							<tr>
								<td colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong>Total Ejercido: </strong></td>
								<td class="MedianoAzulOscuro">
		<?php
								echo number_format ( totalGastado ( $_SESSION['dpto_id'], $bdd ), 2, '.', ',' );
		?>								</td>
								<td class="PequenioAzul" colspan="3" align="center"><img src="imagenes/Floppyblue.gif" name="dpto" border="0" onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar un registro al POA')" /><strong>
							  <input type="submit" name="ingresar"  value="Ingresar"/></strong></td>
						  </tr>
							<tr>
								<td colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
							</tr>
							<tr>
								<td class="MedianoAzulOscuro">&nbsp;</td>
								<td class="MedianoAzulOscuro">&nbsp;</td>
								<td align="center" class="MedianoAzulOscuro"><strong>Restante:</strong>
		<?php
								echo "$".number_format ( ( $row_dpto['presupuesto'] - totalGastado ( $_SESSION['dpto_id'], $bdd )), 2, '.', ',' );
		?>                                </td>
								<td align="center" class="MedianoAzulOscuro"><strong>Presupuestado:</strong>
		<?php
								echo "$".number_format ( $row_dpto['presupuesto'], 2, '.', ',' );
		?>								</td>
							</tr>
							<tr>
								<td colspan="4" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
									<table align="center" cellspacing="1" class="Poa">
										<tr>
											<td class='PoaTitulo'><strong>Cantidad</strong></td>
											<td class='PoaTitulo'><strong>Medida</strong></td>
                                            <td class='PoaTitulo'><strong>Partida</strong></td>
											<td class='PoaTitulo'><strong>Insumo</strong></td>
											<td class='PoaTitulo'><strong>Costo unitario</strong></td>
											<td class='PoaTitulo'><strong>Total</strong></td>
											<td class='PoaTitulo'><strong>Periodo</strong></td>
											<td class='PoaTitulo'><strong>Justificacion</strong></td>
										</tr>
		<?php
										$sql_poa_dpto = "SELECT * FROM poa_dpto, insumo, partida WHERE poa_dpto.dpto_id = {$_SESSION['dpto_id']} AND poa_dpto.idaccion = {$_GET['Accion']} AND poa_dpto.insumo_id = insumo.id AND poa_dpto.partida_id = partida.id";
										if ( $res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto ) )
										{
											while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
											{
												$total = $row_poa_dpto['costuni']*$row_poa_dpto['cantidad'];
												$_SESSION['Total']=$_SESSION['Total']+$total;
												echo "<tr>";
												echo "<td class='PoaDatos'>{$row_poa_dpto['cantidad']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_poa_dpto['medida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_poa_dpto['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_poa_dpto['descinsu']}&nbsp;</td>";
												echo "<td class='PoaDatos'>\$".number_format ( $row_poa_dpto['costuni'], 2, '.', ',')."</td>";
												echo "<td class='PoaDatos'>\$".number_format ( $total, 2, '.', ',')."</td>";
												if($row_poa_dpto['periodo']==1){$per='Ene-Jun';} else {$per='Jul-Dic';}
												echo "<td class='PoaDatos'>{$per} &nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_poa_dpto['justificacion']}&nbsp;</td>";
												echo "</tr>";
											}
											echo "<tr>";
												echo "<td class='PoaDatos'>&nbsp;</td>";
												echo "<td class='PoaDatos'>&nbsp;</td>";
												echo "<td class='PoaDatos'>&nbsp;</td>";
												echo "<td class='PoaDatos'>&nbsp;</td>";
												echo "<td class='PoaDatos'>TOTAL:</td>";
												echo "<td class='PoaDatos'>\$".number_format ( $_SESSION['Total'], 2, '.', ',')."</td>";
												echo "<td class='PoaDatos'>&nbsp;</td>";
												echo "<td class='PoaDatos'>&nbsp;</td>";
												echo "</tr>";
										}
?>
									</table>								</td>
							</tr>
							<tr>
								<td colspan="4" align="center"height="41" bgcolor="#006699" class="MedianoAzulOscuro">
									<fieldset >
									<table>
										<tr>
											<td>&nbsp;</td>
										</tr>
									</table>
									</fieldset>								</td>
							</tr>
						</table>
					</fieldset>
				</td>
			</tr>
		</table>		
		<input type="hidden" name="unidadMedida" value="<?php echo $_POST['unidadMedida']; ?>" />
		</form>
<?php
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