<?php
//FUNCIONES*********************************************************************
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
function totalRequis($dpto_id,$bdd,$clavepartida,$meta)
{
	$totalUnidad = 0;
	$totalgastos = 0;
	$gastoDpto = 0;
					
	$sql_par1 = "SELECT * FROM partida WHERE id = '{$clavepartida}' ";
	$res_par1 = mysql_db_query ( $bdd, $sql_par1 );
	if ( $row_par1 = mysql_fetch_assoc ( $res_par1 ) )
	{
		$tamano1=$row_par1['clavepartida'][0];
	}
	$tamano1=$tamano1*1000;
	$tamano2=$tamano1+1000;
					
	$sql_gastos_dpto = "SELECT * FROM requisicion, partida WHERE requisicion.iddpto = '{$dpto_id}' AND requisicion.idmeta = '{$meta}' AND requisicion.planea = 0 AND requisicion.idpartida=partida.id AND partida.clavepartida >= '$tamano1' AND partida.clavepartida < '$tamano2'";
	$res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ); 
	while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
	{
		$sql_par3 = "SELECT * FROM bienservicio WHERE idrequisicion = '{$row_gastos_dpto['idrequisicion']}'";
		$res_par3 = mysql_db_query ( $bdd, $sql_par3 );
		while ( $row_par3 = mysql_fetch_assoc ( $res_par3 ) )
		{
			$subtotal = $row_par3['cantidad'] * $row_par3['costo'];
			$total += $subtotal;
		}
	}
	return $total;
}
function totalSolicitudes($dpto_id,$bdd,$clavepartida,$meta)
{
	$totalUnidad = 0;
	$totalgastos = 0;
	$gastoDpto = 0;
					
	$sql_par1 = "SELECT * FROM partida WHERE id = '{$clavepartida}' ";
	$res_par1 = mysql_db_query ( $bdd, $sql_par1 );
	if ( $row_par1 = mysql_fetch_assoc ( $res_par1 ) )
	{
		$tamano1=$row_par1['clavepartida'][0];
	}
	$tamano1=$tamano1*1000;
	$tamano2=$tamano1+1000;
					
	$sql_gastos_dpto = "SELECT * FROM solicitud_servicio, partida WHERE solicitud_servicio.iddpto = '{$dpto_id}' AND solicitud_servicio.idmeta = '{$meta}' AND solicitud_servicio.planea = 0 AND solicitud_servicio.idpartida=partida.id AND partida.clavepartida >= '$tamano1' AND partida.clavepartida < '$tamano2'";
	$res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ); 
	while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
	{
		$total=$total+$row_gastos_dpto['importe'];
	}
	return $total;
}

function totalViaticos($dpto_id,$bdd,$clavepartida,$meta)
{
	$totalUnidad = 0;
	$totalgastos = 0;
	$gastoDpto = 0;
					
	$sql_par1 = "SELECT * FROM partida WHERE id = '{$clavepartida}' ";
	$res_par1 = mysql_db_query ( $bdd, $sql_par1 );
	if ( $row_par1 = mysql_fetch_assoc ( $res_par1 ) )
	{
		$tamano1=$row_par1['clavepartida'][0];
	}
	$tamano1=$tamano1*1000;
	$tamano2=$tamano1+1000;
					
	$sql_gastos_dpto = "SELECT * FROM viaticos, partida WHERE viaticos.iddpto = '{$dpto_id}' AND viaticos.idmeta = '{$meta}' AND viaticos.planea = 0 AND viaticos.idpartida=partida.id AND partida.clavepartida >= '$tamano1' AND partida.clavepartida < '$tamano2'";
	$res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ); 
	while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
	{
		$total=$total+($row_gastos_dpto['cuota']*$row_gastos_dpto['dias']);
	}
	return $total;
}
function totalPartidaPoa($dpto_id,$bdd,$clavepartida,$meta)
{
	$totalUnidad = 0;
	$totalgastos = 0;
	$gastoDpto = 0;
					
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

	$sql_par = "SELECT * FROM partida WHERE id = '{$clavepartida}' ";
	$res_par = mysql_db_query ( $bdd, $sql_par );
	if ( $row_par = mysql_fetch_assoc ( $res_par ) )
	{
		$tamano1=$row_par['clavepartida'][0];
	}
	$tamano1=$tamano1*1000;
	$tamano2=$tamano1+1000;

	$sql_gastos_dpto = "SELECT * FROM poa_dpto_gastos, insumo WHERE poa_dpto_gastos.dpto_id = '{$dpto_id}' AND poa_dpto_gastos.idacciones='{$meta}' AND poa_dpto_gastos.insumo_id = insumo.id";
	if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
	{
		while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
		{
			$sql_par1 = "SELECT * FROM partida WHERE id = '{$row_gastos_dpto['partida_id']}' ";
			$res_par1 = mysql_db_query ( $bdd, $sql_par1 );
			if ( $row_par1 = mysql_fetch_assoc ( $res_par1 ) )
			{
				if($row_par1['clavepartida'] >= $tamano1 and $row_par1['clavepartida'] < $tamano2)
				{
					$gastoDpto += $row_gastos_dpto['costuni']*$row_gastos_dpto['cantidad'];
				}
			}
		}
		return $gastoDpto;
	}
	else
	{
		return 0;
	}
}
//FIN DE FUNCIONES***********************************************************************
//INICIO DE REQUIS
if ( isset ( $_POST['Guardar'] ) )
{
	$total=0;
	$sql_gastos_dpto = "SELECT * FROM requisicion WHERE idrequisicion='{$_GET['id']}'";
	$res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ); 
	if ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
	{
		$sql_par3 = "SELECT * FROM bienservicio WHERE idrequisicion = '{$row_gastos_dpto['idrequisicion']}' ";
		if($res_par3 = mysql_db_query ( $bdd, $sql_par3 ))
		{
			while ( $row_par3 = mysql_fetch_assoc ( $res_par3 ) )
			{
				$subtotal = $row_par3['cantidad'] * $row_par3['costo'];
				$total += $subtotal;
			}
		}
		else
		{
			echo "no existe1";
		}
	}
	else
	{
		echo "no existe2";
	}
	if( ((totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $row_gastos_dpto['idmeta']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $row_gastos_dpto['idmeta']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $row_gastos_dpto['idmeta'] ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $row_gastos_dpto['idmeta'] ))) - $total ) < 0)	
	{
		$_SESSION['mensaje_error']=1;
	}
	else
	{
		$sql = "UPDATE requisicion SET fecha='{$_POST['Fecha']}', idpartida='{$_POST['Partida']}', nota='{$_POST['Comentario']}', planea=0 WHERE idrequisicion='{$_GET['id']}'";
		if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
		{
			$_SESSION['mensaje_error']=2;
		}
	}
}
//FIN DE REQUIS
//INICIO DE BIENES
if ( isset ( $_POST['Guardar1'] ) )
{
	$total=0;
	$sql_gastos_dpto = "SELECT * FROM requisicion WHERE idrequisicion='{$_GET['requi']}'";
	$res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ); 
	if ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
	{
		$sql_par3 = "SELECT * FROM bienservicio WHERE idrequisicion = '{$row_gastos_dpto['idrequisicion']}' and idbienservicio != '{$_GET['id']}'";
		if($res_par3 = mysql_db_query ( $bdd, $sql_par3 ))
		{
			while ( $row_par3 = mysql_fetch_assoc ( $res_par3 ) )
			{
				$subtotal = $row_par3['cantidad'] * $row_par3['costo'];
				$total += $subtotal;
			}
		}
		else
		{
			echo "no existe1";
		}
		$total += ($_POST['Cantidad']* $_POST['Costo']);
	}
	else
	{
		echo "no existe2";
	}
	if( ((totalPartida ( $_SESSION['DPTO'], $bdd, $row_gastos_dpto['idpartida'], $row_gastos_dpto['idmeta']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $row_gastos_dpto['idpartida'], $row_gastos_dpto['idmeta']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $row_gastos_dpto['idpartida'], $row_gastos_dpto['idmeta'] ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $row_gastos_dpto['idpartida'], $row_gastos_dpto['idmeta'] ))) - $total ) < 0)	
	{
		$_SESSION['mensaje_error']=1;
	}
	else
	{
		$sql = "UPDATE bienservicio SET cantidad='{$_POST['Cantidad']}', unidad='{$_POST['Unidad']}', descripcion='{$_POST['Descripcion']}', costo='{$_POST['Costo']}' WHERE idbienservicio='{$_GET['id']}'";
		if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
		{
			$_SESSION['mensaje_error']=2;
		}
	}
}
//FIN DE BIENES
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
			
			if ( $_GET['par'] == 1)
			{
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='8'><strong> - Modificacion de Requisiones - </strong></td>";
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
				$sql_requi = "SELECT * FROM requisicion, partida, accion WHERE idrequisicion='{$_GET[id]}' AND requisicion.iddpto='{$_SESSION['dpto_id']}' AND requisicion.idpartida=partida.id AND requisicion.idmeta=accion.id";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
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
						echo "<td class='PoaDatos'><a href='index.php?sec=17&par=2&id={$row_requi['idrequisicion']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="requisicion";
						$tabla1="bienservicio";						
						echo "<td class='PoaDatos'><a href='index.php?sec=15&table={$tabla}&table1={$tabla1}&id={$row_requi['idrequisicion']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "<td class='PoaDatos'><a href='reportes/ReporteRequi_1.php?oficio={$row_requi['idrequisicion']}' target='_blank'><img src='imagenes/printer.png' border='0' alt='Centro' /></a></td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "</form>";
				//BIENES SERVICIOS
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa'>";
				echo "<tr>";
					echo "<td class='PoaUnidad' colspan='9'><strong> - BIENES - </strong></td>";
				echo "</tr>";
				echo "<tr>";
					echo "<td class='PoaTitulo'>Cantidad</td>";
					echo "<td class='PoaTitulo'>Unidad</td>";
					echo "<td class='PoaTitulo'>Descripcion</td>";
					echo "<td class='PoaTitulo'>Costo</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
					echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				$sql_requi = "SELECT * FROM bienservicio WHERE idrequisicion='{$_GET['id']}'";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					
					echo "<tr>";
						echo "<td class='PoaDatos'>{$row_requi['cantidad']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['unidad']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['descripcion']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_requi['costo']}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=17&par=3&id={$row_requi['idbienservicio']}&requi={$_GET['id']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						$tabla="requisicion";
						$tabla1="bienservicio";						
						echo "<td class='PoaDatos'><a href='index.php?sec=18&table={$tabla1}&id={$row_requi['idbienservicio']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
				}
				echo "</table>";
				echo "</form>";
				
				$sql_1 = "SELECT * FROM requisicion WHERE idrequisicion='{$_GET[id]}' AND planea='2'";
				$res_1 = mysql_db_query ( $bdd, $sql_1 );
				if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
				{
?>
					<table width="100%" align="center">
						<tr>
							<td align="center" width="100%">
					<?php
								echo "<form action='' method='post'>";
								echo "<div align = \"center\" class = \"MedianoAzul\">¿Está seguro que desea reenviar la Requisicion?</div>";
								echo "<div align = \"center\"><input type='submit' name='yes' value='Si' /> <input type='submit' name='no' value='No' /></div>";
								echo "</form>";
								
					?>
							</td>
						</tr>
					</table>
	
	<?php
					if ( isset ( $_POST['yes'] ) )
					{
						$sql = "UPDATE requisicion SET planea=0 WHERE idrequisicion='{$_GET['id']}'";
						if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
						{
							echo "<div align = \"center\" class = \"MedianoExitoAzul\">El registro ha sido Modificado satisfactoriamente.</div>";
						}
						else
						{
							echo "<div align = \"center\" class = \"MedianoAlerta\">Error en base de datos. Intente de nuevo más tarde. </div>";
						}
					}
				}
							
			}
			else if ( $_GET['par'] == 2)
			{
				if($_POST['Canda'] == 0)
				{
					$sql_requi_1 = "SELECT * FROM requisicion WHERE idrequisicion='{$_GET[id]}' ";
					$res_requi_1 = mysql_db_query ( $bdd, $sql_requi_1 );
					if ( $row_requi_1 = mysql_fetch_assoc ( $res_requi_1 ) )
					{
						$_POST['Partida']=$row_requi_1['idpartida'];
						$_POST['Fecha']=$row_requi_1['fecha'];
						$_POST['Comentario']=$row_requi_1['nota'];
						$_SESSION['Metas']=$row_requi_1['idmeta'];
						$_SESSION['DPTO']=$row_requi_1['iddpto'];
						//echo $_SESSION['DPTO'];
					}
					$_POST['Canda'] = 1;
				}
?>
				<form action='' method='post'>
				<table class="Poa" align="center">
					<tr>
						<td class="PoaTitulo" colspan="3"><strong>Requisicion</strong></td>
					</tr>
					<tr>
						<td align="right" class="MedianoAzulOscuro"><strong> Partida: </strong></td>
						<td>
							<?php	comboDinamico( "Partida", "clavepartida", "SELECT * FROM partida WHERE estado = 1 ORDER BY clavepartida", $bdd ); ?>
							<input type="hidden" name="partida_hidden" value="<?php echo $_POST['Partida']; ?>" />						</td>
					</tr>
					<tr>
						<td align="right" class="MedianoAzulOscuro"><strong> Fecha: </strong></td>
						<td>
							<input size="8" name="Fecha" type="text" value="<?php echo $_POST['Fecha'];?>"/>						</td>
					</tr>
					<tr>
						<td align="right" class="MedianoAzulOscuro"><strong>Comentario:</strong></td>
						<td><input size="60" name="Comentario" type="text" value="<?php echo $_POST['Comentario'];?>"/></td>
					</tr>
					<tr>
					  <td align="right" class="MedianoAzulOscuro"><strong>Total de Capitulo </strong></td>
					  <td><strong>
                        <?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $_SESSION['Metas']  ) ), 2, '.', ',' );

?>
                      </strong></td>
				  </tr>
					<tr>
					  <td align="right" class="MedianoAzulOscuro"><strong>Restante del Capitulo:</strong></td>
					  <td><strong>
                        <?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $_SESSION['Metas']  ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $_SESSION['Metas']  ))), 2, '.', ',' );
?>
                      </strong></td>
				  </tr>
					<tr>
					  <td colspan="2" align="center" class="MedianoAzulOscuro"><?php
						if($_SESSION['mensaje_error']==1)
						{
							echo "No cuenta con sufienciete Presupuesto";
							$_SESSION['mensaje_error']=0;
						}
						else if($_SESSION['mensaje_error']==2)
						{
							echo "Se guardaron los Cambios";
							$_SESSION['mensaje_error']=0;
						}
						
?></td>
				  </tr>
					<tr>
					  <td align="center" class="MedianoAzulOscuro">&nbsp;</td>
					  <td align="center"><input type="submit" name="Guardar"  value="Guardar"/></td>
				  </tr>
				</table>
				</form>
<?php
			}
			else if ( $_GET['par'] == 3)
			{
				$sql_requi_2 = "SELECT * FROM bienservicio WHERE idbienservicio='{$_GET[id]}' ";
				$res_requi_2 = mysql_db_query ( $bdd, $sql_requi_2 );
				if ( $row_requi_2 = mysql_fetch_assoc ( $res_requi_2 ) )
				{
					$sql_requi_1 = "SELECT * FROM requisicion WHERE idrequisicion='{$row_requi_2[idrequisicion]}' ";
					$res_requi_1 = mysql_db_query ( $bdd, $sql_requi_1 );
					if ( $row_requi_1 = mysql_fetch_assoc ( $res_requi_1 ) )
					{
						$_SESSION['Partida']=$row_requi_1['idpartida'];
						$_SESSION['Metas']=$row_requi_1['idmeta'];
						$_SESSION['DPTO']=$row_requi_1['iddpto'];
					}
				}
				else
				{
					echo "no se encontro";
				}

?>
				<form action='' method='post'>
				<table class="Poa" align="center">
					<tr>
						<td class="PoaTitulo" colspan="3"><strong>Bienes o Servicios</strong></td>
					</tr>
					<tr>
					  <td align="right" class="MedianoAzulOscuro"><strong>Cantidad:</strong></td>
					  <td><input size="20" name="Cantidad" type="text" value="<?php echo $row_requi_2['cantidad'];?>"/></td>
				  </tr>
					<tr>
						<td align="right" class="MedianoAzulOscuro"><strong> Unidad: </strong></td>
						<td><input size="20" name="Unidad" type="text" value="<?php echo $row_requi_2['unidad'];?>"/></td>
					</tr>
					<tr>
						<td align="right" class="MedianoAzulOscuro"><strong> Descripcion: </strong></td>
						<td><input size="50" name="Descripcion" type="text" value="<?php echo $row_requi_2['descripcion'];?>"/></td>
					</tr>
					<tr>
						<td align="right" class="MedianoAzulOscuro"><strong>Costos:</strong></td>
						<td><input size="20" name="Costo" type="text" value="<?php echo $row_requi_2['costo'];?>"/></td>
					</tr>
					<tr>
					  <td align="right" class="MedianoAzulOscuro"><strong>Total de Capitulo </strong></td>
					  <td><strong>
                        <?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']  ) ), 2, '.', ',' );

?>
                      </strong></td>
				  </tr>
					<tr>
					  <td align="right" class="MedianoAzulOscuro"><strong>Restante del Capitulo:</strong></td>
					  <td><strong>
                        <?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_POST['Partida'], $_SESSION['Metas']  ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_SESSION['Partida'], $_SESSION['Metas']  ))), 2, '.', ',' );
?>
                      </strong></td>
				  </tr>
					<tr>
					  <td colspan="2" align="center" class="MedianoAzulOscuro">
<?php
						if($_SESSION['mensaje_error']==1)
						{
							echo "No cuenta con sufienciete Presupuesto";
							$_SESSION['mensaje_error']=0;
						}
						else if($_SESSION['mensaje_error']==2)
						{
							echo "Se guardaron los Cambios";
							$_SESSION['mensaje_error']=0;
						}
						
?>					  
					  &nbsp;</td>
				  </tr>
					<tr>
					  <td align="center" class="MedianoAzulOscuro">&nbsp;</td>
					  <td align="center"><input type="submit" name="Guardar1"  value="Guardar"/></td>
				  </tr>
				</table>
				</form>
<?php
			}
		}
	}
	$_SESSION['Candado']=1;
?>
