<?php	

	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		$_SESSION['DPTO'] = $_GET['dpto'];
		$_SESSION['ACCION'] = $_GET['Accion'];
		$_SESSION['Metas'] = $_GET['Acciones'];
		$_SESSION['Clave'] = $_GET['Clave'];
		$_SESSION['Proceso'] = $_GET['Proceso'];
		if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0)
		{
	
			if ( isset ( $_GET['unidadMedida'] ) )
			{
				$sql_unidad = "SELECT * FROM unidadmedida WHERE id = '{$_GET['unidadMedida']}'";
				$res_unidad = mysql_db_query ( $bdd, $sql_unidad );
				$row_unidad = mysql_fetch_assoc ( $res_unidad );
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
					
					$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto = '{$dpto_id}' ";
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

				/*function Presupuesto($dpto_id,$bdd)
				{
					//$_SESSION['UnidadMedida'] = $_GET['unidadMedida'];
					$gastoDpto = 0;
					$sql_poa_dpto = "SELECT poa_dpto.id AS poa_id, poa_dpto.*, insumo.*, partida.* FROM poa_dpto, insumo, partida WHERE poa_dpto.dpto_id = '{$_SESSION['DPTO']}' AND poa_dpto.insumo_id = insumo.id AND poa_dpto.partida_id = partida.id ORDER BY partida.clavepartida, insumo.descinsu";
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
				}*/
				function totalPartidaPoa($dpto_id,$bdd,$clavepartida,$meta)
				{
					$totalUnidad = 0;
					$totalgastos = 0;
					$gastoDpto = 0;
					$_SESSION['Actividad'] = $_GET['actividad'];
					$_SESSION['Accion'] = $_GET['accion'];
					
					$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto = '{$dpto_id}' AND idpartida = '{$clavepartida}' AND idmeta = '{$meta}'";
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
					$gastado = totalGastado( $_SESSION['DPTO'], $bdd );
					$presu = Presupuesto( $_SESSION['DPTO'], $bdd );					
					
					if ( $_POST['oficio'] == "" and $_POST['partida'] == 0 and $_POST['monto'] == "" and $_POST['justificacion'] == "" )
					{
						$errorCapturaPoa = 1;
					}
					else if ( $_POST['cantidad'] > ($presu-$gastado) )
					{
						$errorCapturaPoa = 2;
					}
					else
					{
						$sql = "SELECT * FROM gastos_dpto WHERE oficio = '{$_POST['oficio']}' ";
						$res = mysql_db_query ( $bdd, $sql );
						if ( $row = mysql_fetch_assoc ( $res ) )
						{
							$errorCapturaPoa = 5;
						}
						else
						{	
							$sql = "SELECT * FROM partida WHERE clavepartida='{$_POST['partida']}' ";
							$res = mysql_db_query ( $bdd, $sql );
							if ( $row = mysql_fetch_assoc ( $res ) )
							{}
							$sql = "INSERT INTO gastos_dpto (oficio, iddpto, documento, justificacion, fecha, iddpto_solicitante, idproceso, idclave, idmeta, monto, idpartida, donde) VALUES ('{$_POST['oficio']}', '{$_SESSION['DPTO']}', '{$_POST['documento']}', '{$_POST['justificacion']}', '{$_POST['fecha']}', '{$_POST['dpto_id']}', {$_SESSION['Proceso']}, {$_SESSION['Clave']}, '{$_SESSION['Metas']}', '{$_POST['monto']}', '{$_POST['partida']}', '{$_POST['donde']}')";
							if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
							{
								$_SESSION['oficio']=$_POST['oficio'];
								$_SESSION['Documento']=$_POST['documento'];
								$_POST['partida']=0;
								$_POST['oficio']="";
								$_POST['monto']="";
								$_POST['justificacion']="";
								$_POST['fecha']="";
								$_POST['documento']="";
								$mensajeCapturaPoa = 1;
							}
						}
					}
				}
			
		?>
		
		<form action="" method="post">
		<table width="100%" align="center">
			<tr>
				<td align="center" class="MedianoAzulOscuro">
				<?php 
					//$_SESSION['ACCION'];
					$sql_poa = "SELECT * FROM accion WHERE id = '{$_SESSION['Metas']}'";
					$res_poa = mysql_db_query ( $bdd, $sql_poa );
					if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
					{
						echo $row_poa['nombreAccion'];
					}
				?>
				</td>
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
									case 5:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">No de Oficio Repetido</div></td></tr>";
													break;

								}
							}
							
							if ( isset ( $mensajeCapturaPoa ) )
							{
								switch ( $mensajeCapturaPoa )
								{
									case 1:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoExitoAzul\">¡Gasto ingresado!</div></td></tr>";
													break;
								}
							}
		?>
							<tr>
								<td width="26%" align="right" class="MedianoAzulOscuro"><strong> Partida: </strong></td>
								<td width="31%" align="left" class="MedianoAzulOscuro">	
								<?php	comboDinamico( "partida", "clavepartida", "SELECT * FROM gastos_poa_dpto, partida WHERE dpto_id='{$_SESSION['DPTO']}' AND idacciones = '{$_SESSION['Metas']}' AND gastos_poa_dpto.partida_id=partida.id GROUP BY partida.clavepartida", $bdd ); ?>
									<input type="hidden" name="partida_hidden" value="<?php echo $_POST['partida']; ?>" />								</td>
								<td width="18%" align="right" class="MedianoAzulOscuro"><strong>No. Control : </strong></td>
								<td colspan="3" align="left" class="MedianoAzulOscuro"><input size="10" name="oficio" type="text" value="<?php echo $_POST['oficio']; ?>"/></td>
							</tr>
							
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong>Gasto:</strong></td>
								<td align="left" class="MedianoAzulOscuro"><input size="15" name="monto" type="text" value="<?php echo $_POST['monto']; ?>"/></td>
								<td align="right" class="MedianoAzulOscuro"><strong>Justificacion:</strong></td>
								<td colspan="3" align="left" class="MedianoAzulOscuro"><input size="15" name="justificacion" type="text" value="<?php echo $_POST['justificacion']; ?>"/></td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Fecha:</strong></td>
							  <td align="left" class="MedianoAzulOscuro"><input size="8" name="fecha" type="text" value="dd/mm/aa"/></td>
							  <td align="right" class="MedianoAzulOscuro"><strong>Documento:</strong></td>
							  <td colspan="3" align="left" class="MedianoAzulOscuro"><select name="documento">
							  <option>- Selecciona -</option>
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
							  <td colspan="5" align="left" class="MedianoAzulOscuro"><select name="dpto_id">
                                <?php
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
                                <option>Normal</option>
                                <option>Remanente</option>
                              </select></td>
							  <td width="8%" align="left" class="MedianoAzulOscuro"><div align="center">
                                <?php
								if($_SESSION['Documento'] == "Req.")
								{
									if($mensajeCapturaPoa==1)
									{
										echo "<a href='reportes/sello3.php?oficio={$_SESSION['oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Sello Abajo' width='16' height='16' />";
									}
								}
								else
								{
									if($mensajeCapturaPoa==1)
									{
										echo "<a href='reportes/sello.php?oficio={$_SESSION['oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Sello Abajo' width='16' height='16' />";
									}
								}
								
?>
                              </div></td>
							  <td width="8%" align="left" class="MedianoAzulOscuro"><div align="center">
                                <?php
								if($_SESSION['Documento'] != "Req.")
								{
									if($mensajeCapturaPoa==1)
									{
										echo "<a href='reportes/sello1.php?oficio={$_SESSION['oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Sello Enmedio Derecho' width='16' height='16' />";
									}
								}
?>
                              </div></td>
							  <td width="9%" align="left" class="MedianoAzulOscuro"><div align="center">
                                <?php
								if($_SESSION['Documento'] != "Req.")
								{
									if($mensajeCapturaPoa==1)
									{
										echo "<a href='reportes/sello2.php?oficio={$_SESSION['oficio']}' target='_blank'>";
										echo "<img src='imagenes/printer.png' border='0' alt='Centro' width='16' height='16' />";
									}
								}
?>
                              </div></td>
						  </tr>
							
							<tr>
								<td colspan="6" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong>Total de Gastos: </strong></td>
								<td class="MedianoAzulOscuro">
		<?php
								echo number_format ( totalGastado ( $_SESSION['DPTO'], $bdd ), 2, '.', ',' );
		?>								</td>
								<td class="PequenioAzul" colspan="5" align="center"><img src="imagenes/Floppyblue.gif" name="dpto" border="0" onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar un registro al POA')" /><strong>
							  <input name="guardar" type="submit" id="guardar"  value="Ingresar"/>
								</strong></td>
						  </tr>
							<tr>
								<td colspan="6" bgcolor="#006699" class="MedianoAzulOscuro">&nbsp;</td>
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
		?>                                </td>
								<td colspan="3" align="center" class="MedianoAzulOscuro"><strong>Presupuestado:</strong>
		<?php
								echo "$".number_format ( Presupuesto ( $_SESSION['DPTO'], $bdd ), 2, '.', ',' );
		?>								</td>
							</tr>
							<tr>
								<td colspan="6" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
									<table align="center" cellspacing="1" class="Poa">
										<tr>
											<td class='PoaTitulo'><strong>Partida</strong></td>
											<td class='PoaTitulo'><strong>Oficio</strong></td>
											<td class='PoaTitulo'><strong>Monto</strong></td>
                                            <td class='PoaTitulo'><strong>Justificacion</strong></td>
										</tr>
		<?php
										$sql_poa_dpto = "SELECT * FROM gastos_dpto WHERE iddpto = {$_SESSION['DPTO']} AND idacciones = '{$_SESSION['Metas']}'";
										if( $res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto ) )
										{
											while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
											{
												$sql_clavepartida = "SELECT * FROM partida WHERE id = '{$row_poa_dpto['idpartida']}'";
												$res_clavepartida = mysql_db_query ( $bdd, $sql_clavepartida );
												$row_clavepartida = mysql_fetch_assoc ( $res_clavepartida );
												echo "<tr>";
												echo "<td class='PoaDatos'>{$row_clavepartida['clavepartida']}&nbsp;</td>";
												echo "<td class='PoaDatos'>{$row_poa_dpto['oficio']}&nbsp;</td>";
												echo "<td class='PoaDatos'>\$".number_format ( $row_poa_dpto['monto'], 2, '.', ',')."</td>";
												echo "<td class='PoaDatos'>{$row_poa_dpto['justificacion']}&nbsp;</td>";
												echo "</tr>";
											}
										}
										
		?>
									</table>								</td>
							</tr>
							<tr>
								<td colspan="6" align="center"height="41" bgcolor="#006699" class="MedianoAzulOscuro">
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