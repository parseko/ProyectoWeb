<?php
$bdd="sicopre";
/*$_SESSION['DPTO'] = $_GET['dpto'];
$_SESSION['Metas']=$_GET['Acciones'];*/
if ( !isset ( $_POST['Modificar'] ) and $_SESSION['candado'] == 0)
{
	$sql_sol = "SELECT * FROM solicitud_servicio WHERE idsolicitud = '{$_GET['solicitud']}' ";
	$res_sol = mysql_db_query ( $bdd, $sql_sol );
	if ( $row_sol = mysql_fetch_assoc ( $res_sol ) )
	{
		$_POST['Fecha']=$row_sol['fecha'];
		$_POST['Descripcion']=$row_sol['descripcion'];
		$_POST['Vigencia']=$row_sol['vigencia'];
		$_POST['Nombre']=$row_sol['nombre'];
		$_POST['rfc']=$row_sol['rfc'];
		$_POST['Domicilio']=$row_sol['domicilio'];
		$_POST['Pago']=$row_sol['forma_pago'];
		$_POST['Importe']=$row_sol['importe'];
		$_POST['Cantidad']=$row_sol['cantidad'];
		$_POST['Unidad']=$row_sol['unidad'];
		$_SESSION['Metas']=$row_sol['idmeta'];
		$_SESSION['DPTO']=$row_sol['iddpto'];
		if($_SESSION['candado'] == 0)
		{
			$_POST['Partida1']=$row_sol['idpartida'];
		}
		else
		{
		}
	}
	$_SESSION['mod']=1;
			$_SESSION['candado']=1;
}

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
//SOLICITUDES DE REQUISICIONES***********************************************************
if ( isset ( $_POST['Modificar'] ) and ($_POST['Partida1'] != 0))
{
	if(isset (  $_POST['Modificar'] ))
	{
		if($_POST['Descripcion'] == "" or  $_POST['Vigencia'] == "" or $_POST['Nombre'] == "" or $_POST['rfc'] == "" or $_POST['Domicilio'] == "" or $_POST['Pago'] == "" or $_POST['Importe'] == "")
		{
			$mensaje_error=10;
		}
		else
		{
			if( ((totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas'] ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas'] ))) - $_POST['Importe'] ) < 0)
			{
				$mensaje_error=20;
			}
			else
			{	
				if($_POST['Importe'] >= 1500 and $_POST['Cantidad'] == "" and $_POST['Unidad'] == "")
				{
					$mensaje_error=50;
				}
				else
				{
					$sql = "UPDATE solicitud_servicio SET fecha='{$_POST['Fecha']}', descripcion='{$_POST['Descripcion']}', vigencia='{$_POST['Vigencia']}', nombre='{$_POST['Nombre']}', rfc='{$_POST['rfc']}', domicilio='{$_POST['Domicilio']}', idpartida='{$_POST['Partida1']}', forma_pago='{$_POST['Pago']}', importe='{$_POST['Importe']}', cantidad='{$_POST['Cantidad']}', unidad='{$_POST['Unidad']}', planea=0 WHERE idsolicitud = '{$_GET['solicitud']}' "; 
					if ( $res = mysql_db_query ( $bdd, $sql ) or die(mysql_error()) )
					{
						if($_POST['Importe'] >= 1500)
						{
							$_SESSION['entrada']=1;
						}
						$_POST['Descripcion'] = ""; $_POST['Vigencia'] = ""; $_POST['Nombre'] = ""; $_POST['rfc'] = ""; $_POST['Domicilio'] = ""; $_POST['Pago'] = ""; $_POST['Importe'] = ""; $_POST['Partida1'] = ""; 
						$mensaje_error=30;
					}
					else
					{
						$mensaje_error=40;
					}
				}
			}
		}
	}				
}
//FIN DE SOLICITUDES DE REQUISICIONES*******************************************************
?>
<table width="100%" height="250" align="center">
	<tr>
		<td align="center" width="100%"> 
	 	<form  method="POST" action="">
       <fieldset style="border-bottom-color:#0066CC" >
		<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Solicitud de Servicio</legend>
       	
		<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
<?php
/*					$sql_sol = "SELECT * FROM solicitud_servicio WHERE idsolicitud = '{$_GET['solicitud']}' ";
					$res_sol = mysql_db_query ( $bdd, $sql_sol );
					if ( $row_sol = mysql_fetch_assoc ( $res_sol ) )
					{
						$_SESSION['Metas']=$row_sol['idmeta'];
						$_SESSION['DPTO']=$row_sol['iddpto'];

						if($_SESSION['candado'] == 0)
						{
							$_SESSION['candado']=1;
							$_POST['Partida1']=$row_sol['idpartida'];
						}
						else
						{
							echo "error";
						}
					}
*/
					if($_GET['solicitud'] != 0)
					{
?>
						<tr>
						<td>
							<table class="Poa" align="center">
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>Solicitud de Servicio</strong></td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Fecha: </strong>								</td>
								<td>
									<?php $_SESSION['Fecha'] = date("Y-m-d"); ?>
									<input size="15" name="Fecha" type="text" value="<?php echo $_POST['Fecha']; ?>"/>								</td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>SERVICIO SOLICITADO</strong></td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Descripción: </strong>								</td>
								<td>
									<input size="50" name="Descripcion" type="text" value="<?php echo $_POST['Descripcion']; ?>"/>								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Vigencia: </strong>								</td>
								<td>
									<input size="15" name="Vigencia" type="text" value="<?php echo $_POST['Vigencia']; ?>"/>								</td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>PRESTADOR DE SERVICIOS</strong></td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Nombre: </strong>								</td>
								<td>
									<input size="50" name="Nombre" type="text" value="<?php echo $_POST['Nombre']; ?>"/>								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> RFC: </strong>								</td>
								<td>
									<input size="15" name="rfc" type="text" value="<?php echo $_POST['rfc']; ?>"/>								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Domicilio: </strong>								</td>
								<td>
									<input size="50" name="Domicilio" type="text" value="<?php echo $_POST['Domicilio']; ?>"/>								</td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>GASTO</strong></td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong> Partida: </strong> </td>
							  <td><?php	comboDinamico( "Partida1", "clavepartida", "SELECT * FROM partida WHERE estado = 1 ORDER BY clavepartida", $bdd ); ?>
                                  <input type="hidden" name="partida_hidden" value="<?php echo $_POST['Partida1']; ?>" />                              </td>
							  </tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Forma de Pago: </strong>								</td>
								<td>
									<input size="15" name="Pago" type="text" value="<?php echo $_POST['Pago']; ?>"/>								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Importe Total: </strong>								</td>
								<td>
									<input size="15" name="Importe" type="text" value="<?php echo $_POST['Importe']; ?>"/>								</td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Total de Capitulo </strong></td>
							  <td><strong>
							    <?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) ), 2, '.', ',' );

?>
							  </strong></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Restante del Capitulo:</strong></td>
							  <td><strong>
<?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ))), 2, '.', ',' );
?>
							  </strong></td>
							</tr>
<?php	
							if($_POST['Importe']>=1500)
							{
?>						  
							<tr>
							  <td colspan="2" align="center" class="MedianoAzulOscuro" style="font-weight: bold">Servicio acompa&ntilde;ada de una Requisicion </td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Cantidad:</strong></td>
							  <td><input size="15" name="Cantidad" type="text" value="<?php echo $row_sol['cantidad']; ?>"/></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Unidad:</strong></td>
							  <td><input size="15" name="Unidad" type="text" value="<?php echo $row_sol['unidad']; ?>"/></td>
							  </tr>
<?php	
							}
?>						  
							<tr>
							  <td colspan="2">
<?php
								if($mensaje_error == 10)
								{
									echo "FALTAN CAMPOS POR LLENAR";	
								}
								if($mensaje_error == 20)
								{
									echo "NO CUANTA CON SUFICIENTE PRESUPUESTO";	
								}
								if($mensaje_error == 30)
								{
									echo "SE GUARDO EL REGISTRO CON EXITO";
									echo "</br>";
									echo "<a href='reportes/ReporteSolicitud.php?Servicio={$_GET['solicitud']}' target='_blank'>";
									echo "<img src='imagenes/icono_pdf.jpg' border='0' alt='Solicitud de Adquisicion o Servicio' />";
									if($_SESSION['entrada'] == 1)
									{
										echo "</br>";	
										echo "<a href='reportes/ReporteRequi_2.php?Oficio={$_GET['solicitud']}' target='_blank'>";
										echo "<img src='imagenes/icono_pdf.jpg' border='0' alt='Requisicion' />";
										$_SESSION['entrada']=0;
									}
								}
								if($mensaje_error == 40)
								{
									echo "ERROR AL INENTAR GUARDAR EL REGISTRO";	
								}
								if($mensaje_error == 50)
								{
									echo "NECESITA LLENAR LOS NUEVOS CAMPOS PARA GENERAR LA REQUISICION CORRESPONDIENTE";	
								}
?>							  </td>
							  </tr>
							<tr>
								<td>								</td>
								<td align="center">
									<input type="submit" name="Modificar"  value="Modificar"/>								</td>
							</tr>
							</table>						</td>
						</tr>
<?php
					}
?>
          	<tr>
            	<td  colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">
					<fieldset style="background-color:#006699">
			       	<table width="100%" height="30">
				    	<tr>
					    	<td align="center" height="35">&nbsp;</td>
						</tr>
					</table>
	          		</fieldset>				</td>
          	</tr>
        </table>
        </fieldset>
	</form>

		</td>
	</tr>
</table>