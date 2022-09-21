<?php
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		if ( isset ( $_POST['Aceptar'] ) )
		{
			$sql_req = "SELECT * FROM viaticos WHERE idviaticos='{$_GET['viaticos']}'";
			$res_req = mysql_db_query ( $bdd, $sql_req );
			if ( $row_req = mysql_fetch_assoc ( $res_req ) )
			{
				$sql_meta = "SELECT * FROM accion WHERE id='{$row_req['idmeta']}'";
				$res_meta = mysql_db_query ( $bdd, $sql_meta );
				if ( $row_meta = mysql_fetch_assoc ( $res_meta ) )
				{}
				$sql_clave = "SELECT * FROM actividad WHERE id='{$row_meta['actividad_id']}'";
				$res_clave = mysql_db_query ( $bdd, $sql_clave );
				if ( $row_clave = mysql_fetch_assoc ( $res_clave ) )
				{}
				$sql_proceso = "SELECT * FROM proceso WHERE id='{$row_clave['proceso_id']}'";
				$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
				if ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
				{}
				$total=$row_req['cuota']*$row_req['dias'];
				$sql = "INSERT INTO gastos_dpto (oficio, iddpto, documento, justificacion, fecha, iddpto_solicitante, idproceso, idclave, idmeta, idaccion, monto, idpartida, donde, idviaticos) VALUES ('{$_POST['Oficio']}', '{$row_req['iddpto']}', 'Via', '{$_POST['Justificacion']}', '{$_POST['Fecha']}', '{$_POST['dpto_id']}', {$row_proceso['id']}, {$row_clave['id']}, '{$row_req['idmeta']}', '{$row_req['idaccion']}', '{$total}', '{$row_req['idpartida']}', '{$_POST['Donde']}', '{$row_req['idviaticos']}' )";
				if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
				{
					$sql = "UPDATE viaticos SET planea = '1' WHERE idviaticos = {$_GET['viaticos']}";
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
			$sql = "UPDATE viaticos SET planea = '2', nota = '{$_POST['Nota']}' WHERE idviaticos = {$_GET['viaticos']}";
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
					echo "<td class='PoaUnidad' colspan='8'><strong> - Para Autorización de Solicitudes de Servicios - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Meta</td>";
					echo "<td class='PoaTitulo'>Fecha</td>";
					echo "<td class='PoaTitulo'>Comisionado</td>";
					echo "<td class='PoaTitulo'>Motivo</td>";
					echo "<td class='PoaTitulo'>Monto</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_viaticos = "SELECT * FROM viaticos, partida, accion WHERE viaticos.planea = 0 AND viaticos.idpartida=partida.id AND viaticos.idmeta=accion.id";
				$res_viaticos = mysql_db_query ( $bdd, $sql_viaticos );
				while ( $row_viaticos = mysql_fetch_assoc ( $res_viaticos ) )
				{
					echo "<tr>";
						$tabla="viaticos";
						$total=($row_viaticos['cuota']*$row_viaticos['dias']);
						echo "<td class='PoaDatos'>{$row_viaticos['claveAccion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['fecha']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['comisionado']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_viaticos['motivo']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$total}</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=13&viaticos={$row_viaticos['idviaticos']}&dep=2'><img src='imagenes/pencil.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=14&table={$tabla}&viaticos={$row_viaticos['idviaticos']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/MinistracionViaticos.php?Viaticos={$row_viaticos['idviaticos']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Viaticos' /></a></td>";
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
							<legend class="MedianoAzulOscuro"><img src="imagenes/basket_put.png"/>  - Autorizacion de Solicitudes de Servicio -  </legend> <br>
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
									$sql_via = "SELECT * FROM viaticos, partida WHERE viaticos.idviaticos='{$_GET['viaticos']}' AND viaticos.idpartida=partida.id";
									$res_via = mysql_db_query ( $bdd, $sql_via );
									if ( $row_via = mysql_fetch_assoc ( $res_via ) )
									{
										
									}
?>

								<tr>
								  <td align="right" class="MedianoAzulOscuro"><strong>Partida:</strong></td>
								  <td align="left" class="MedianoAzulOscuro"><?php echo $row_via['clavepartida']; ?> </td>
							  </tr>
								<tr>
								  <td align="right" class="MedianoAzulOscuro"><strong>Monto:</strong></td>
								  <td align="left" class="MedianoAzulOscuro"><?php echo ($row_via['cuota']*$row_via['dias']); ?></td>
							  </tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Justificacion:</strong></td>
									<td align="left" class="MedianoAzulOscuro">
										<input size="70" name="Justificacion" value=" <?php echo $row_via['motivo'];?> " type="text" />									</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro"><strong>Fecha:</strong></td>
<?php
									$_SESSION['Fecha'] = date("Y-m-d");
?>
									
									<td align="left" class="MedianoAzulOscuro"><input name="Fecha" type="text" value="<?php echo $row_via['fecha'];?>" /></td>
								</tr>
								<tr>
							  		<td align="right" class="MedianoAzulOscuro"><strong>Depto. Solicitante:</strong></td>
							  		<td colspan="2" align="left" class="MedianoAzulOscuro"><select name="dpto_id">
                                      <?php
									$sql = "SELECT * FROM dpto WHERE id = '{$row_via['iddpto']}'";
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