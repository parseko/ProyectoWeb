<?php	
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0)
		{
			function comboDinamico($nombreCombo, $display, $sql, $baseDeDatos)
			{
				echo "<select name='{$nombreCombo}' onchange='submit()'>";
				echo 	"<option value='0'>[Seleccione una opción]</option>";
			
				$res = mysql_db_query ( $baseDeDatos, $sql );
				while ( $row = mysql_fetch_assoc ( $res ) )
				{
					echo "<option value='{$row['id']}'"; if ( $_POST[$nombreCombo] == $row['id'] ) { echo "selected='selected'"; } echo ">";
					if ( strlen ( $row[$display] ) > 20 )	{	echo substr($row[$display], 0, 34)."...";	}
					else									{	echo $row[$display];						}
					echo "</option>";
				}
				echo "</select>";
			}
			if($_SESSION['Candado']!=2)
			{			
				$sql_gastos = "SELECT * FROM gastos_dpto WHERE idgastos = '{$_GET['id']}'";
				$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
				if ($row_gastos = mysql_fetch_assoc ( $res_gastos ))
				{
					$_SESSION['Partida'] = $row_gastos['idpartida'];
					$_SESSION['Oficio'] = $row_gastos['oficio'];
					$_SESSION['Monto'] = $row_gastos['monto'];
					$_SESSION['Justificacion'] = $row_gastos['justificacion'];
					$_SESSION['Fecha'] = $row_gastos['fecha'];
					$_SESSION['Documento'] = $row_gastos['documento'];
					$_SESSION['Depto_soli'] = $row_gastos['iddpto_solicitante'];
					$_SESSION['donde'] = $row_gastos['donde'];
				}
				//CAMBIO MANUAL DE DEPARTAMENTO
				$sql_dpto = "SELECT * FROM presupuesto WHERE dpto_id = {$_SESSION['DPTO']}";
				$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
				if ( !$row_dpto = mysql_fetch_assoc ( $res_dpto ) )
				{
					echo "<div align = \"center\" class = \"MedianoAlerta\">No tiene un presupuesto asignado.</div>";
				}
				else
				{	
					function Presupuesto($dpto_id,$bdd)
					{
						//$_SESSION['UnidadMedida'] = $_GET['unidadMedida'];
						$gastoDpto = 0;
						$sql_poa_dpto = "SELECT gastos_poa_dpto.id AS poa_id, gastos_poa_dpto.*, insumo.*, partida.* FROM gastos_poa_dpto, insumo, partida WHERE gastos_poa_dpto.dpto_id = '{$_SESSION['DPTO']}' AND gastos_poa_dpto.insumo_id = insumo.id AND gastos_poa_dpto.partida_id = partida.id ORDER BY partida.clavepartida, insumo.descinsu";
						if ( $res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto ) )
						{
							$totalUnidad = 0;
							$totalgastos = 0;
							while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
							{
								$total = $row_poa_dpto['costuni']*$row_poa_dpto['cantidad'];
								$totalUnidad += $total;
							}
							return $totalUnidad;
						}
						else
						{
							return 0;
						}
					}
					function totalGastado($dpto_id,$bdd)
					{
						$totalUnidad = 0;
						$totalgastos = 0;
						$gastoDpto = 0;
						$_SESSION['Actividad'] = $_GET['actividad'];
						$_SESSION['Accion'] = $_GET['accion'];
						
						$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto = '{$dpto_id}' AND donde != 'Remanente' AND donde != 'Cancelado'";
						if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
						{
							while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
							{
								$total += $row_gastos_dpto['monto'];
								$totalUnidad += $total;
							}
							return $total;
						}
						else
						{
							return 0;
						}
					}
					function totalPartidaPoa($dpto_id,$bdd,$clavepartida,$meta)
					{
						$totalUnidad = 0;
						$totalgastos = 0;
						$gastoDpto = 0;
						$_SESSION['Actividad'] = $_GET['actividad'];
						$_SESSION['Accion'] = $_GET['accion'];
						
						$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto = '{$dpto_id}' AND idpartida = '{$clavepartida}' AND idmeta = '{$meta}' AND donde != 'Remanente' AND donde != 'Cancelado'";
						if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
						{
							while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
							{
								$total += $row_gastos_dpto['monto'];
								$totalUnidad += $total;
							}
							return $total;
						}
						else
						{
							return 0;
						}
					}
					function totalPartida($dpto_id,$bdd,$clavepartida,$meta)
					{
						$totalUnidad = 0;
						$totalgastos = 0;
						$gastoDpto = 0;
						$_SESSION['Actividad'] = $_GET['actividad'];
						$_SESSION['Accion'] = $_GET['accion'];
						
						$sql_gastos_dpto = "SELECT * FROM gastos_poa_dpto, insumo WHERE gastos_poa_dpto.dpto_id = '{$dpto_id}' AND gastos_poa_dpto.partida_id = '{$clavepartida}' AND gastos_poa_dpto.idacciones='{$meta}' AND gastos_poa_dpto.insumo_id = insumo.id";
						if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
						{
							while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
							{
								$gastoDpto += $row_gastos_dpto['costuni']*$row_gastos_dpto['cantidad'];
							}
							return $gastoDpto;
						}
						else
						{
							return 0;
						}
					}
					if ( isset ( $_POST['guardar'] ) )
					{				
						$_SESSION['Candado']=2;
						$gastado = totalGastado( $_SESSION['DPTO'], $bdd );
						$presu = Presupuesto( $_SESSION['DPTO'], $bdd );					
						if ( $_POST['partida'] == 0 or $_POST['cantidad'] == "" )
						{
							$errorCapturaPoa = 1;
						}
						else if ( $_POST['cantidad'] > ($presu-$gastado) )
						{
							$errorCapturaPoa = 2;
						}
						else
						{
							$sql = "UPDATE gastos_dpto SET idpartida='{$_POST['partida']}', oficio='{$_POST['oficio']}', monto='{$_POST['cantidad']}', justificacion='{$_POST['justificacion']}', donde='{$_POST['donde']}', fecha='{$_POST['fecha']}', documento='{$_POST['documento']}' WHERE idgastos='{$_GET['id']}'";
							if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
							{
								$errorCapturaPoa = 3;
								$_SESSION['Candado']=2;
								$sql_gastos = "SELECT * FROM gastos_dpto WHERE idgastos = '{$_GET['id']}'";
								$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
								if ($row_gastos = mysql_fetch_assoc ( $res_gastos ))
								{
									$_SESSION['Partida'] = $row_gastos['idpartida'];
									$_SESSION['Oficio'] = $row_gastos['oficio'];
									$_SESSION['Monto'] = $row_gastos['monto'];
									$_SESSION['Justificacion'] = $row_gastos['justificacion'];
									$_SESSION['Fecha'] = $row_gastos['fecha'];
									$_SESSION['Documento'] = $row_gastos['documento'];
									$_SESSION['Depto_soli'] = $row_gastos['iddpto_solicitante'];
									$_SESSION['donde'] = $row_gastos['donde'];
									
								}

							}
						}
					}
				if ( isset ( $_GET['partida'] ) and !isset ( $_POST['partida'] ) )
				{
					$_POST['partida']=$_GET['partida'];
				}
				
			?>
			
			<form action="" method="post">
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
										case 2:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">Esta exediendo los gastos.</div></td></tr>";
														break;
										case 3:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">Gastos Modificados.</div></td></tr>";
														break;
									}
								}
								
								
			?>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong> Partida: </strong></td>
									<td align="left" class="MedianoAzulOscuro">
									<?php	comboDinamico( "partida", "clavepartida", "SELECT * FROM partida WHERE estado = 1 ORDER BY clavepartida", $bdd ); ?>
									<input type="hidden" name="partida_hidden" value="<?php echo $_POST['partida']; ?>" />								</td>
										<td align="right" class="MedianoAzulOscuro"><strong> Oficio: </strong></td>
								<td width="8%" align="left" class="MedianoAzulOscuro"><input size="15" name="oficio" value=" <?php echo $_SESSION['Oficio'];?> " type="text" /></td>
								</tr>
								
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Gasto:</strong></td>
									<td align="left" class="MedianoAzulOscuro"><input size="15" name="cantidad" value=" <?php echo $_SESSION['Monto'];?> " type="text" /></td>
									<td align="left" class="MedianoAzulOscuro"><strong>Justificacion:</strong></td>
									<td align="left" class="MedianoAzulOscuro"><input size="15" name="justificacion" value=" <?php echo $_SESSION['Justificacion'];?> " type="text" /></td>
								</tr>
								<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Fecha:</strong></td>
							  <td align="left" class="MedianoAzulOscuro"><input name="fecha" type="text" value="<?php echo $_SESSION['Fecha'];?>" /></td>
							  <td align="right" class="MedianoAzulOscuro"><strong>Documento:</strong></td>
							  <td align="left" class="MedianoAzulOscuro"><select name="documento">
							  <option><?php echo $_SESSION['Documento'];?></option>
							  <option>SS</option>
							  <option>Ofic.</option>
							  <option>Req.</option>
							  <option>Comb.</option>
							  <option>Via</option>
							  <option>Pas/Aero</option>
							  <option>Pas/Urba</option>
                              </select></td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Depto. Solicitante:</strong></td>
							  <td colspan="3" align="left" class="MedianoAzulOscuro"><select name="dpto_id">
                                <?php
									$sql = "SELECT * FROM dpto WHERE id = '{$_SESSION['Depto_soli']}'";
									$res = mysql_db_query ( $bdd, $sql );
									if ( $row = mysql_fetch_assoc ( $res ) )
									{
										echo "<option value='{$row['id']}'>{$row['nombredpto']}</option>";
									}
									
									echo "<option value='0'>Seleccione una opci&oacute;n</option>";
									$sql = "SELECT * FROM dpto WHERE estado = 1 ORDER BY clavedpto";
									$res = mysql_db_query ( $bdd, $sql );
									while ( $row = mysql_fetch_assoc ( $res ) )
									{
										echo "<option value='{$row['id']}'>{$row['nombredpto']}</option>";
									}
?>
                              </select></td>
						      </tr>
						  		<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Tipo:</strong></td>
							  <td colspan="2" align="left" class="MedianoAzulOscuro"><select name="donde" id="donde">
                                <option><?php echo $_SESSION['donde'];?></option>
								<option>Normal</option>
                                <option>Remanente</option>
                                <option>Cancelado</option>
                              </select></td>
							  <td width="8%" align="left" class="MedianoAzulOscuro">
                                <div align="center">
                                  <?php
								if($_SESSION['Documento'] != "Req." and $_SESSION['Documento'] != "REQ.")
								{
										echo "<a href='reportes/sello.php?oficio={$_SESSION['Oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Sello Abajo' width='16' height='16' />";
								}
								else
								{
										echo "<a href='reportes/sello3.php?oficio={$_SESSION['Oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Sello Abajo' width='16' height='16' />";
								}
								
?>
                                  <?php
								if($_SESSION['Documento'] != "Req." and $_SESSION['Documento'] != "REQ.")
								{
										echo "<a href='reportes/sello1.php?oficio={$_SESSION['Oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Sello Enmedio Derecho' width='16' height='16' />";
								}
								else
								{
										echo "<a href='reportes/sello4.php?oficio={$_SESSION['Oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Sello Arriba' width='16' height='16' />";
								}
?>
                                  <?php
								if($_SESSION['Documento'] != "Req." and $_SESSION['Documento'] != "REQ.")
								{
										echo "<a href='reportes/sello2.php?oficio={$_SESSION['Oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Centro' width='16' height='16' />";
								}
?>
                                  <div align="center">
                                    <?php
								if($_SESSION['Documento'] != "Req." and $_SESSION['Documento'] != "REQ.")
								{
										echo "<a href='reportes/sello3.php?oficio={$_SESSION['Oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Centro' width='16' height='16' />";
								}?>
                                  </div>
                                </div></td>
							  </tr>
								<tr>
									<td colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Total de Gastos: </strong></td>
									<td class="MedianoAzulOscuro"><?php
								echo number_format ( totalGastado ( $_SESSION['DPTO'], $bdd ), 2, '.', ',' );
		?></td>
									<td class="PequenioAzul" colspan="2" align="center"><img src="imagenes/Floppyblue.gif" name="dpto" border="0" onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar un registro al POA')" /><strong>
								  <input name="guardar" type="submit" id="guardar"  value="Guardar"/>
									</strong></td>
							  </tr>
								<tr>
									<td colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
								</tr>
								<tr>
								  <td class="MedianoAzulOscuro"><strong>Total de Partida :
								    <?php
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['partida'], $_SESSION['Metas']  )), 2, '.', ',' );

?>
                                  </strong></td>
								  <td class="MedianoAzulOscuro"><strong>Restante de Partida:
								    <?php
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['partida'], $_SESSION['Metas']  ) - totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['partida'], $_SESSION['Metas']  )), 2, '.', ',' );

?>
                                  </strong></td>
									<td align="center" class="MedianoAzulOscuro"><strong>Restante:</strong>
								    <?php
								echo "$".number_format ( ( Presupuesto ( $_SESSION['DPTO'], $bdd )-totalGastado ( $_SESSION['DPTO'], $bdd )), 2, '.', ',' );
		?></td>
									<td align="center" class="MedianoAzulOscuro"><strong>Presupuestado:</strong>
								    <?php
								echo "$".number_format ( Presupuesto ( $_SESSION['DPTO'], $bdd ), 2, '.', ',' );
		?></td>
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
				?><table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
					<tr>
					  <td colspan='100%' align="center"><div align = \"center\" class = \"MedianoExitoAzul\">¡Gasto modificado!</div></td>
					</tr>
					</table>
				<?php
				//$_SESSION['Candado']=0;
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