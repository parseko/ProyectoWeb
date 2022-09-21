<?php
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		if ( isset ( $_POST['Aceptar'] ) )
		{
			$sql_req = "SELECT * FROM requisicion WHERE idrequisicion='{$_GET['idrequisicion']}'";
			$res_req = mysql_db_query ( $bdd, $sql_req );
			if ( $row_req = mysql_fetch_assoc ( $res_req ) )
			{
				$sql_req1 = "SELECT * FROM bienservicio WHERE idrequisicion='{$_GET['idrequisicion']}' ";
				$res_req1 = mysql_db_query ( $bdd, $sql_req1 );
				while ( $row_req1 = mysql_fetch_assoc ( $res_req1 ) )
				{
					$total = $total+ ($row_req1['cantidad'] * $row_req1['costo']);
				}

				$sql = "INSERT INTO gastos_dpto (oficio, iddpto, documento, justificacion, fecha, iddpto_solicitante, idproceso, idclave, idmeta, idaccion, monto, idpartida, donde, idrequisicion) VALUES ('{$_POST['Oficio']}', '{$row_req['iddpto']}', 'Req.', '{$_POST['Justificacion']}', '{$_POST['Fecha']}', '{$_POST['dpto_id']}', {$row_req['idproceso']}, {$row_req['idclave']}, '{$row_req['idmeta']}', '{$row_req['idaccion']}', '{$total}', '{$row_req['idpartida']}', '{$_POST['Donde']}', '{$row_req['idrequisicion']}' )";
				if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
				{
					$sql = "UPDATE requisicion SET planea = '1' WHERE idrequisicion = {$_GET['idrequisicion']}";
					if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
					{
						$mensaje = 2;
						$_GET['dep'] = 0;				
					}
				}
			}
		}
		if ( isset ( $_POST['Rechazar'] ) )
		{
			$sql = "UPDATE requisicion SET planea = '2', comentario = '{$_POST['Nota']}' WHERE idrequisicion = {$_GET['idrequisicion']}";
			if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
			{
				$mensaje = 1;
				$_GET['dep'] = 0;				
			}
		}
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
			
			if ( $_POST or $_GET['dep'] != 2)
			{
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='8'><strong> - Para Autorización de Requisiciones - </strong></td>";
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
				$sql_requi = "SELECT * FROM requisicion, partida, accion WHERE requisicion.planea = 0 AND requisicion.idpartida=partida.id AND requisicion.idmeta=accion.id";
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
						echo "<td class='PoaDatos'><a href='index.php?sec=8&dep=2&idrequisicion={$row_requi['idrequisicion']}&iddpto={$row_requi['iddpto']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="requisicion";
						$tabla1="bienservicio";						
						echo "<td class='PoaDatos'><a href='index.php?sec=10&table={$tabla}&table1={$tabla1}&id={$row_requi['idrequisicion']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_1.php?oficio={$row_requi['idrequisicion']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
			}
			if ($_GET['dep'] == 2)
			{
			$_SESSION['DPTO']=$_GET['iddpto'];
?>
			
			<form action="" method="post">
			<table width="100%" align="center">
				<tr>
					<td align="center" width="100%"> 
						<fieldset  style="border-bottom-color:#0066CC" >
							<legend class="MedianoAzulOscuro"><img src="imagenes/basket_put.png"/>  - Autorizacion de Requisiciones -  </legend> 
							<br>
							<table width="100%" align="center"  class="MedianoAzul">
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
									<td align="right" class="MedianoAzulOscuro"><strong> Oficio: </strong></td>
<?php
									$busca="SELECT MAX(oficio) AS max_oficio FROM gastos_dpto";
									$resultado=mysql_db_query($bdd, $busca) or die(mysql_error());
									if($registro=mysql_fetch_assoc($resultado))
									{}
?>									
									<td align="left" class="MedianoAzulOscuro"><input size="15" name="Oficio" value=" <?php echo $registro['max_oficio']+1; ?> " type="text" /></td>
								</tr>
<?php
									$sql_req = "SELECT * FROM requisicion, partida WHERE requisicion.idrequisicion='{$_GET['idrequisicion']}' AND requisicion.idpartida=partida.id";
									$res_req = mysql_db_query ( $bdd, $sql_req );
									if ( $row_req = mysql_fetch_assoc ( $res_req ) )
									{}
?>

								<tr>
								  <td align="right" class="MedianoAzulOscuro"><strong>Partida:</strong></td>
								  <td align="left" class="MedianoAzulOscuro"><?php echo $row_req['clavepartida']; ?></td>
							  </tr>
<?php
									$sql_req1 = "SELECT * FROM bienservicio WHERE idrequisicion='{$_GET['idrequisicion']}' ";
									$res_req1 = mysql_db_query ( $bdd, $sql_req1 );
									while ( $row_req1 = mysql_fetch_assoc ( $res_req1 ) )
									{
										$total = $total+ ($row_req1['cantidad'] * $row_req1['costo']);
									}
?>

								<tr>
								  <td align="right" class="MedianoAzulOscuro"><strong>Monto:</strong></td>
								  <td align="left" class="MedianoAzulOscuro"><?php echo $total; ?></td>
							  </tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Justificacion:</strong></td>
									<td align="left" class="MedianoAzulOscuro">
										<input size="70" name="Justificacion" value=" <?php echo $row_req['nota'];?> " type="text" />									</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Fecha:</strong></td>
<?php
									$_SESSION['Fecha'] = date("Y-m-d");
?>
									
									<td align="left" class="MedianoAzulOscuro"><input name="Fecha" type="text" value="<?php echo $_SESSION['Fecha'];?>" /></td>
								</tr>
								<tr>
							  		<td align="right" class="MedianoAzulOscuro"><strong>Depto. Solicitante:</strong></td>
							  		<td colspan="2" align="left" class="MedianoAzulOscuro"><select name="dpto_id">
                                      <?php
									$sql = "SELECT * FROM dpto WHERE id = '{$_SESSION['DPTO']}'";
									$res = mysql_db_query ( $bdd, $sql );
									while ( $row = mysql_fetch_assoc ( $res ) )
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
								  <td colspan="2" align="left" class="MedianoAzulOscuro"><select name="Donde" id="Donde">
                                    <option>Normal</option>
                                    <option>Remanente</option>
                                  </select></td>
							  </tr>
								<tr>
								  <td colspan="3" align="center" class="MedianoAzulOscuro"><span class="PequenioAzul">
								    <input type="submit" name="Aceptar"  value="Aceptar"/>
								  </span></td>
							  </tr>
								<tr>
								  <td align="right" class="MedianoAzulOscuro"><strong>Comentario:</strong></td>
								  <td colspan="2" align="left" class="MedianoAzulOscuro"><input size="70" name="Nota" type="text" /></td>
							  </tr>
								<tr>
								  <td colspan="3" align="center" class="MedianoAzulOscuro"><span class="PequenioAzul">
								    <input type="submit" name="Rechazar"  value="Rechazar"/>
								  </span></td>
							  </tr>
								<tr>
									<td colspan="3" align="center"height="41" bgcolor="#006699" class="MedianoAzulOscuro">
										<fieldset >
										<table>
											<tr>
												<td>
<?php
								if ( isset ( $mensaje ) )
								{
									switch ( $mensaje )
									{
										case 1:		echo "<tr><td colspan='100%'><div align = \"center\" class = \"MedianoAlerta\">SE HA EFECTUADO LA DEVOLUCIÓN</div></td></tr>";
										break;
										
									}
								}
?>												</td>
											</tr>
										</table>
										</fieldset>									</td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
			</table>
			</form>
<?php
			}
		}
	}
	$_SESSION['Candado']=1;
?>