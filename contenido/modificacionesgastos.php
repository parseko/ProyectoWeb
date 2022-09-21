<?php	
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
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
					$_SESSION['Metas'] = $row_gastos['idmeta'];
					$_SESSION['Partida'] = $row_gastos['idpartida'];
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
					function Presupuesto($dpto_id,$bdd,$meta)
					{
						//$sql_poa_dpto_gastos = "SELECT * FROM gastos_poa, insumo, partida WHERE gastos_poa.dpto = '{$dpto_id}' AND gastos_poa.idmeta='{$meta}' AND gastos_poa.insumo_id = insumo.id AND gastos_poa.partida_id = partida.id ORDER BY partida.clavepartida, insumo.descinsu";
						$gastoDpto = 0;
						echo "ooh";
						$sql_gastos = "SELECT * FROM gastos_dpto WHERE iddpto='$dpto' AND idmeta='$meta' ";
						if ( $res_gastos = mysql_db_query ( $bdd, $sql_gastos ) )
						{
							echo "Hola";
							$totalUnidad = 0;
							$totalgastos = 0;
							while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
							{
								echo "Hola1";
								$total = $row_gastos['costuni']*$row_gastos['cantidad'];
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
						
						//echo $_SESSION['Monto'];
						$totalUnidad = 0;
						$totalgastos = 0;
						$gastoDpto = 0;
						$_SESSION['Actividad'] = $_GET['actividad'];
						$_SESSION['Accion'] = $_GET['accion'];
						
						$sql_par1 = "SELECT * FROM partida WHERE id = '{$clavepartida}' ";
						$res_par1 = mysql_db_query ( $bdd, $sql_par1 );
						if ( $row_par1 = mysql_fetch_assoc ( $res_par1 ) )
						{
							$tamano1=$row_par1['clavepartida'][0];
						}
						$tamano1=$tamano1*1000;
						$tamano2=$tamano1+1000;
						$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto = '{$dpto_id}' AND idmeta = '{$meta}' AND donde = 'Normal'";
						if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
						{
							while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
							{
								$sql_par2 = "SELECT * FROM partida WHERE id = '{$row_gastos_dpto['idpartida']}' and clavepartida >= '$tamano1' and clavepartida < '$tamano2'";
								$res_par2 = mysql_db_query ( $bdd, $sql_par2 );
								if ( $row_par2 = mysql_fetch_assoc ( $res_par2 ) )
								{
								
									$total += $row_gastos_dpto['monto'];
									$totalUnidad += $total;
								}
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
	
						$sql_par = "SELECT * FROM partida WHERE id = '{$clavepartida}' ";
						$res_par = mysql_db_query ( $bdd, $sql_par );
						if ( $row_par = mysql_fetch_assoc ( $res_par ) )
						{
							$tamano1=$row_par['clavepartida'][0];
						}
						$tamano1=$tamano1*1000;
						$tamano2=$tamano1+1000;
						//echo $tamano1;					
						$sql_gastos_dpto = "SELECT * FROM poa_dpto_gastos, insumo WHERE poa_dpto_gastos.dpto_id = '{$dpto_id}' AND poa_dpto_gastos.idacciones='{$meta}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.tipogasto=1";
						if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
						{
							while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
							{
								$sql_par1 = "SELECT * FROM partida WHERE id = '{$row_gastos_dpto['partida_id']}' and clavepartida>='$tamano1' and clavepartida<'$tamano2'";
								$res_par1 = mysql_db_query ( $bdd, $sql_par1 );
								if ( $row_par1 = mysql_fetch_assoc ( $res_par1 ) )
								{
									//$tamano1=$row_par['clavepartida'][0];
									$gastoDpto += $row_gastos_dpto['costuni']*$row_gastos_dpto['cantidad'];
								}
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
						$gastado = totalPartida ($_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']);
						$presu = totalPartidaPoa ($_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']);
						/*$gastado = totalGastado( $_SESSION['DPTO'], $bdd );
						$presu = Presupuesto( $_SESSION['DPTO'], $bdd, $_SESSION['Meta'] );	*/
						if ( $_POST['partida'] == 0 or $_POST['cantidad'] == "" )
						{
							$errorCapturaPoa = 1;
						}
						else if ( $_POST['cantidad'] > ( (($gastado+$_SESSION['Monto'])-$presu) ) )
						{
							$errorCapturaPoa = 2;
						}
						else
						{
							$sql = "UPDATE gastos_dpto SET idpartida='{$_POST['partida']}', oficio='{$_POST['oficio']}', monto='{$_POST['cantidad']}', justificacion='{$_POST['justificacion']}', donde='{$_POST['donde']}', fecha='{$_POST['fecha']}', documento='{$_POST['documento']}' WHERE idgastos='{$_GET['id']}'";
							if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
							{
								if($_POST['donde']='Cancelado')
								{
									$sql_1 = "SELECT * FROM gastos_dpto WHERE  idgastos = '{$_GET['id']}'";
									$res_1 = mysql_db_query ( $bdd, $sql_1 );
									if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
									{
										if($row_1['idrequisicion'] != 0)
										{
											$sql_2 = "UPDATE requisicion SET planea=4 WHERE idrequisicion='{$row_1['idrequisicion']}'";
											if ( $res_2 = mysql_db_query ( $bdd, $sql_2 ) or die(mysql_error()) )
											{}
										}
										else if	($row_1['idsolicitud'] != 0)
										{
											$sql_2 = "UPDATE solicitud_servicio SET planea=4 WHERE idsolicitud='{$row_1['idsolicitud']}'";
											if ( $res_2 = mysql_db_query ( $bdd, $sql_2 ) or die(mysql_error()) )
											{}
										}							
									}
								}
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
									<td align="right" class="MedianoAzulOscuro">&nbsp;</td>
									<td class="MedianoAzulOscuro">&nbsp;</td>
									<td class="PequenioAzul" colspan="2" align="center"><img src="imagenes/Floppyblue.gif" name="dpto" border="0" onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar un registro al POA')" /><strong>
								  <input name="guardar" type="submit" id="guardar"  value="Guardar"/>
									</strong></td>
							  </tr>
								<tr>
									<td colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
								</tr>
								<tr>
								  <td class="MedianoAzulOscuro"><strong>Total de Capitulo :
                                      <?php
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']  )), 2, '.', ',' );

?>
								  </strong></td>
								  <td class="MedianoAzulOscuro"><strong>Restante del Capitulo:
                                      <?php
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']  ) - totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']  )), 2, '.', ',' );

?>
								  </strong></td>
									<td align="center" class="MedianoAzulOscuro">&nbsp;</td>
									<td align="center" class="MedianoAzulOscuro">&nbsp;</td>
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
			/*else
			{
				?><table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
					<tr>
					  <td colspan='100%' align="center"><div align = \"center\" class = \"MedianoExitoAzul\">¡Gasto modificado!</div></td>
					</tr>
					</table>
				<?php
				//$_SESSION['Candado']=0;
			}*/
	}
	else
	{
		echo "<div align='center' class='MedianoAlerta'>No se ha iniciado la captura del Ejercicio.</div>";
	}
?>