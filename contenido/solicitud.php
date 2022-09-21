<?php
$bdd="sicopre";
$_SESSION['DPTO'] = $_GET['dpto'];
$_SESSION['Metas']=$_GET['Acciones'];
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
//SOLICITUDES DE SERVICIOS***************************************************************
if ( isset ( $_POST['Ingresar'] ) or ($_POST['Partida1'] != 0))
{
	$_POST['TipoDocto'] = 1;
	if(isset (  $_POST['Ingresar'] ))
	{
		if($_POST['Descripcion'] == "" or  $_POST['Vigencia'] == "" or $_POST['Nombre'] == "" or $_POST['rfc'] == "" or $_POST['Domicilio'] == "" or $_POST['Pago'] == "" or $_POST['Importe'] == "")
		{
			$mensaje_error=10;
		}
		else
		{
			if( ((totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas'] ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas'] ) + totalViaticos ( $_SESSION['DPTO'], $bdd, $_POST['Partida1'], $_SESSION['Metas'] ))) - $_POST['Importe'] ) < 0)
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
					$sql = "INSERT INTO solicitud_servicio (fecha, descripcion, vigencia, nombre, rfc, domicilio, idpartida, forma_pago, importe, iddpto, idmeta, idaccion, cantidad, unidad) VALUES ( '{$_POST['Fecha']}', '{$_POST['Descripcion']}', '{$_POST['Vigencia']}', '{$_POST['Nombre']}', '{$_POST['rfc']}', '{$_POST['Domicilio']}', '{$_POST['Partida1']}', '{$_POST['Pago']}', '{$_POST['Importe']}', '{$_SESSION['DPTO']}', '{$_GET['Acciones']}', '{$_GET['Accion']}', '{$_POST['Cantidad']}', '{$_POST['Unidad']}')";
					if ( $res = mysql_db_query($bdd,$sql) )
					{
						$sql_par10 = "SELECT * FROM solicitud_servicio WHERE descripcion = '{$_POST['Descripcion']}' ";
						$res_par10 = mysql_db_query ( $bdd, $sql_par10 );
						if ( $row_par10 = mysql_fetch_assoc ( $res_par10 ) )
						{
							$_SESSION['idsolicitud']=$row_par10['idsolicitud'];
						}
						if($_POST['Importe'] >= 1500 )
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
//FIN DE SOLICITUDES DE SERVICIOS********************************************************
//REQUISICIONES**************************************************************************
if ( isset ( $_POST['Borrar'] ) )
{
		$_SESSION['tam']=0;
		$_SESSION['aux']=0;
		$_SESSION['Requi1'][$_SESSION['tam']]='';
		$_SESSION['Requi2'][$_SESSION['tam']]='';
}

if ( (isset ( $_POST['siguiente2'] ) or isset ( $_POST['Ingresar2'] ) or isset ( $_POST['Eliminar2'] )) or ($_POST['Partida2'] != 0))
{
	$_POST['TipoDocto'] = 3;
	if(isset (  $_POST['Ingresar2'] ))
	{
		$aux=0;
		while($aux <= $_SESSION['tam']-1)
		{
			$subtotal = $_SESSION['Requi3'][$aux] * $_SESSION['Requi6'][$aux];
			$total = $total + $subtotal;
			$aux++;
		}
		if( ((totalPartida ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas'] ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas'] ) + totalViaticos ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas'] ) )) - $total ) < 0)
		{
			$mensaje_error=100;
		}
		else
		{
			$cont=0;
			$suma=0;
			while($cont <= $_SESSION['tam']-1)
			{
				$suma=$suma + $_SESSION['Requi6'][$cont];
				$cont++;
			}
			//if()
			$busca="SELECT MAX(numero) AS max_numero FROM requisicion";
			$resultado=mysql_db_query($bdd, $busca) or die(mysql_error());
			if($registro=mysql_fetch_assoc($resultado))
			{}
			$numero=$registro['max_numero']+1;
			$sql = "INSERT INTO requisicion (numero, fecha, idpartida, nota, idproceso, idclave, idmeta, idaccion, iddpto) VALUES ( '{$numero}', '{$_SESSION['Requi1'][0]}', '{$_SESSION['Requi2'][0]}', '{$_SESSION['Requi7'][0]}', '{$_GET['Proceso']}', '{$_GET['Clave']}', '{$_GET['Acciones']}', '{$_GET['Accion']}', '{$_SESSION['DPTO']}')";
			if ( $res = mysql_db_query($bdd,$sql) )
			{
				$sql_requi = "SELECT * FROM requisicion WHERE numero = '{$numero}'";
				$res_requi = mysql_db_query ( $bdd, $sql_requi );
				if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
				{
					$_SESSION['Requi']=$row_requi['idrequisicion'];
				}
				$aux=0;
				while($aux <= $_SESSION['tam']-1)
				{
					$sql = "INSERT INTO bienservicio (cantidad, unidad, descripcion, costo, idrequisicion) VALUES ( '{$_SESSION['Requi3'][$aux]}', '{$_SESSION['Requi4'][$aux]}', '{$_SESSION['Requi5'][$aux]}', '{$_SESSION['Requi6'][$aux]}', '{$row_requi['idrequisicion']}')";
					if ( $res = mysql_db_query($bdd,$sql) )
					{
						$exito=1;	
					}
					$aux++;
				}
				$mensaje = 1;
			}
			$_SESSION['tam']=0;
			$_SESSION['aux']=0;
			$_SESSION['Requi1'][$_SESSION['tam']]='';
			$_SESSION['Requi2'][$_SESSION['tam']]='';
		}
	}
	if(isset (  $_POST['Eliminar2'] ))
	{
		$elimiar=$_POST['Delete'];
		$elimiar--;
		if($elimiar < 0 or $elimiar > $_SESSION['tam'])
		{
			$error=1;
		}
		else
		{
			if($_SESSION['tam']==$elimiar)
			{
				$_SESSION['tam']--;
			}
			else
			{
				$x=$_SESSION['tam'];
				$y=$elimiar;
				while($y < $x)
				{
					$_SESSION['Requi3'][$y]=$_SESSION['Requi3'][$y+1];
					$_SESSION['Requi4'][$y]=$_SESSION['Requi3'][$y+1];
					$_SESSION['Requi5'][$y]=$_SESSION['Requi3'][$y+1];
					$_SESSION['Requi6'][$y]=$_SESSION['Requi3'][$y+1];
					$y++;
				}
				$_SESSION['tam']--;
			}
		}
	}
	if(isset ( $_POST['siguiente2'] ))
	{
		if($_POST['Fecha2']=="" and $_POST['Partida2']=="" and $_POST['Cantidad2']=="" and $_POST['Unidad2']=="" and $_POST['Descripcion2']=="" and $_POST['Costo2']=="" and $_POST['Comentario2']=="")
		{
			$error=1;
		}
		else
		{
			if($_SESSION['aux']==0)
			{
				$_SESSION['tam']=0;
				$_SESSION['aux']=1;
			}
			echo $_POST['Fecha2'];
			$_SESSION['Requi1'][$_SESSION['tam']]=$_POST['Fecha2'];
			$_SESSION['Requi2'][$_SESSION['tam']]=$_POST['Partida2'];
			$_SESSION['Requi3'][$_SESSION['tam']]=$_POST['Cantidad2'];
			$_SESSION['Requi4'][$_SESSION['tam']]=$_POST['Unidad2'];
			$_SESSION['Requi5'][$_SESSION['tam']]=$_POST['Descripcion2'];
			$_SESSION['Requi6'][$_SESSION['tam']]=$_POST['Costo2'];
			$_SESSION['Requi7'][$_SESSION['tam']]=$_POST['Comentario2'];			
			$_SESSION['tam']++;
		}
	}				
}
//FIN REQUISICIONES ***********************************************************************
//INICIO DE VIATICOS
if ( isset ( $_POST['Ingresar5'] ) )
{
	if($_POST['Fecha5']=="" and $_POST['Nombre5']=="" and $_POST['rfc5']=="" and $_POST['Domicilio5']=="" and $_POST['Puesto5']=="" and $_POST['Clave5']=="" and $_POST['Lugar5']=="" and $_POST['Periodo5']=="" and $_POST['Couta5']=="" and $_POST['Dias5']=="" and $_POST['Motivo5']==""and $_POST['Observciones5']=="")
	{
		$mensaje_error=10;
	}
	else
	{
		$busca="SELECT * FROM partida WHERE clavepartida='3817'";
		$resultado=mysql_db_query($bdd, $busca) or die(mysql_error());
		if($registro=mysql_fetch_assoc($resultado))
		{}
		$total = $_POST['Couta5'] * $_POST['Dias5']; 
		if( ((totalPartida ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas'] ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas'] ) + totalViaticos ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas'] ))) - $total ) < 0)
		{
			$mensaje_error=20;
		}
		else
		{
			$sql = "INSERT INTO viaticos (fecha, comisionado, rfc, domicilio, categoria, clave, lugar, periodo, cuota, dias, motivo, observaciones, pago, jerarquico, zona, iddpto, idpartida, idmeta) VALUES ( '{$_POST['Fecha5']}', '{$_POST['Nombre5']}', '{$_POST['rfc5']}', '{$_POST['Domicilio5']}', '{$_POST['Puesto5']}', '{$_POST['Clave5']}', '{$_POST['Lugar5']}', '{$_POST['Periodo5']}', '{$_POST['Cuota5']}', '{$_POST['Dias5']}', '{$_POST['Motivo5']}', '{$_POST['Observaciones5']}', '{$_POST['Pago5']}', '{$_POST['Jerarquico5']}', '{$_POST['Zona5']}', '{$_SESSION['DPTO']}', '{$registro['id']}', '{$_SESSION['Metas']}')";
			if ( $res = mysql_db_query($bdd,$sql) )
			{
				$mensaje_error=30;	
			}
			else
			{
				$mensaje_error=40;
			}
		}
	}

	$_POST['TipoDocto']=5;
}
//FIN DE VIATICOS
?>
<table width="100%" height="250" align="center">
	<tr>
		<td align="center" width="100%"> 
	 	<form  method="POST" action="">
       <fieldset style="border-bottom-color:#0066CC" >
		<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Solicitudes</legend>
       	
		<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
       		<tr>
               	<td align="center">
                   	<table class="Poa" align="center">
                       	<tr>
                           	<td class="PoaTitulo" colspan="3"><strong>Tipo de Documento</strong></td>
               			</tr>
					</table>
				</td>
       		</tr>		
			<tr>
            	<td align="center" class="MedianoAzulOscuro">
					<select name="TipoDocto" onchange="submit()">
						<option value="0"> - SELECCIONA TIPO DE DOCTO - </option>
						<option value="1">Solicitud de Servicio</option>
						<!-- <option value="2">Oficio</option> -->
						<option value="3">Requisicion</option>
						<option value="5">Viaticos</option>
						<!-- <option value="4">Combustible</option>
						<option value="6">Pasaje Aereo</option>
						<option value="7">Pasaje Urbano</option> -->
					</select>
				</td>
			</tr>
<?php
					if($_POST['TipoDocto'] == 1)
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
									<input size="15" name="Fecha" type="text" value="<?php echo $_SESSION['Fecha']; ?>"/>								</td>
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
							if($mensaje_error==50)
							{
?>						  
							<tr>
							  <td colspan="2" align="center" class="MedianoAzulOscuro" style="font-weight: bold">Servicio acompa&ntilde;ada de una Requisicion </td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Cantidad:</strong></td>
							  <td><input size="15" name="Cantidad" type="text" value="<?php echo $_POST['Cantidad']; ?>"/></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Unidad:</strong></td>
							  <td><input size="15" name="Unidad" type="text" value="<?php echo $_POST['Unidad']; ?>"/></td>
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
									echo "<a href='reportes/ReporteSolicitud.php?Servicio={$_SESSION['idsolicitud']}' target='_blank'>";
									echo "<img src='imagenes/icono_pdf.jpg' border='0' alt='Solicitud de Adquisicion o Servicio' />";
									if($_SESSION['entrada'] == 1)
									{
										echo "</br>";	
										echo "<a href='reportes/ReporteRequi_2.php?Oficio={$_SESSION['idsolicitud']}' target='_blank'>";
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
									<input type="submit" name="Ingresar"  value="Ingresar"/>								</td>
							</tr>
							</table>
						</td>
						</tr>
<?php
					}
					if($_POST['TipoDocto'] == 2)
					{
?>
						<tr>
						<td>
							<table class="Poa" align="center">
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>Oficio</strong></td>
							</tr>
							</table>
						</td>
						</tr>
<?php
					}
					if($_POST['TipoDocto'] == 3)
					{
?>
						<tr>
						<td>
							<table class="Poa" align="center">
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>Requisicion</strong></td>
							</tr>
<?php
							if($_SESSION['aux']==0)
							{
?>							
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Partida: </strong>								</td>
								<td>
									<?php	comboDinamico( "Partida2", "clavepartida", "SELECT * FROM partida WHERE estado = 1 ORDER BY clavepartida", $bdd ); ?>
									<input type="hidden" name="partida_hidden" value="<?php echo $_POST['Partida2']; ?>" />								</td>
									<?php $_SESSION['Requi2'][0]=$_POST['Partida2']; ?>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Fecha: </strong>								</td>
								<td>
									<?php $_SESSION['fecha'] = date("Y-m-d"); ?>
									<input size="8" name="Fecha2" type="text" value="<?php echo $_SESSION['fecha'];?>"/>								</td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Comentario:</strong></td>
							  <td><input size="60" name="Comentario2" type="text" /></td>
							  </tr>
<?php
							}
?>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Cantidad: </strong>								</td>
								<td>
									<input size="15" name="Cantidad2" type="text" />								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Unidad: </strong>								</td>
								<td>
									<input size="15" name="Unidad2" type="text" />								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Descripcion: </strong>								</td>
								<td>
									<input size="120" name="Descripcion2" type="text" />								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Costo: </strong>								</td>
								<td>
									<input size="15" name="Costo2" type="text" />								</td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Total de Capitulo </strong></td>
							  <td><strong>
							    <?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas']  ) ), 2, '.', ',' );

?>
							  </strong></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Restante del Capitulo:</strong></td>
							  <td><strong>
<?php
									$bdd="sicopre";
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas']  ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $_SESSION['Requi2'][0], $_SESSION['Metas']  ))), 2, '.', ',' );
?>
							  </strong></td>
							  </tr>
							<tr>
								<td colspan="2" align="center">
<?php
									/*if( (totalPartida ( $_SESSION['DPTO'], $bdd, $_POST['Partida2'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $_POST['Partida2'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $_POST['Partida2'], $_SESSION['Metas']  ))) == 0)
									{
										echo "NO HAY RECURSOS EN ESTA META";
									}
									else*/ if($mensaje_error==100)
									{
										echo "SE PASO DEL PRESUPUESTO";
										?> <input type="submit" name="Borrar"  value="Borrar"/> <?php										
									}
									else
									{
?>								
										<input type="submit" name="siguiente2"  value="Siguiente"/>
<?php
									}
?>
								</td>
							</tr>
							</table>
							
							<table align="center">
								<tr>
									<td align="right" class="MedianoAzulOscuro">
										<strong> Fecha: <?php echo $_SESSION['Requi1'][0]; ?></strong>									</td>
									<td align="right" class="MedianoAzulOscuro">
<?php
										$sql_partida = "SELECT * FROM partida WHERE id = '{$_SESSION['Requi2'][0]}'";
										$res_partida = mysql_db_query ( $bdd, $sql_partida );
										if ($row_partida = mysql_fetch_assoc ( $res_partida ))
										{}
?>
										<strong> Partida: <?php echo $row_partida['clavepartida']; ?></strong>									</td>
								</tr>
<?php
								
								$x=0;
								while($x<$_SESSION['tam'])
								{
?>
								<tr>
									<td align="right" class="MedianoAzulOscuro">
										<strong> Cantidad: </strong>									</td>
									<td>
										<?php echo $_SESSION['Requi3'][$x]; ?>									</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro">
										<strong> Unidad: </strong>									</td>
									<td>
										<?php echo $_SESSION['Requi4'][$x]; ?>									</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro">
										<strong> Descripcion: </strong>									</td>
									<td>
										<?php echo $_SESSION['Requi5'][$x]; ?>									</td>
								</tr>
								<tr>
									<td align="right" class="MedianoAzulOscuro">
										<strong> Costo: </strong>									</td>
									<td>
										<?php echo $_SESSION['Requi6'][$x]; ?>									</td>
								</tr>
								<tr>
									<td align="left">
										<?php echo "Registro: "; echo $x+1;?>									</td>
								</tr>
								
<?php
								$x++;
								}
								if($x>0)
								{
?>
								<tr>
									<td>
										<?php echo "Eliminar Registro: "?>									</td>
									<td align="left">
										 <input size="5" name="Delete" type="text" /> <input type="submit" name="Eliminar2"  value="Eliminar"/>									</td>
								</tr>
								<tr>
								  <td colspan="2" align="center">
									<input type="submit" name="Ingresar2"  value="Ingresar"/>
								  </td>
							  </tr>
<?php
								}
?>							</table>
							<table>
								<tr>
									<td>
<?php
										if($exito==1)
										{	
											echo "<a href='reportes/ReporteRequi_1.php?oficio={$_SESSION['Requi']}' target='_blank'>";
											echo "<img src='imagenes/icono_pdf.jpg' border='0' alt='Centro' />";
										}										
?>										
									</td>
								</tr>
							</table>
						</td>
						</tr>
<?php
					}
					if($_POST['TipoDocto'] == 4)
					{
?>
						<tr>
						<td>
							<table class="Poa" align="center">
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>Combustible</strong></td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>DATOS DEL SERVIDOR PUBLICO</strong></td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Nombre: </strong>
								</td>
								<td>
									<input size="50" name="Nombre3" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> RFC: </strong>
								</td>
								<td>
									<input size="20" name="rfc3" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Puesto: </strong>
								</td>
								<td>
									<input size="50" name="Puesto3" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Clave: </strong>
								</td>
								<td>
									<input size="15" name="Clave3" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Departamento: </strong>
								</td>
								<td>
									<input size="50" name="Departamento3" type="text" />
								</td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>COMISION O TRABAJO A DESARROLLAR</strong></td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Comision: </strong>
								</td>
								<td>
									<input size="50" name="Comision3" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Fecha: </strong>
								</td>
								<td>
									<input size="15" name="Fecha33" type="text" />
								</td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>ITINERARIO</strong></td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Fecha: </strong>
								</td>
								<td>
									<input size="15" name="Fecha333" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> De: </strong>
								</td>
								<td>
									<input size="50" name="De3" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> A: </strong>
								</td>
								<td>
									<input size="50" name="A3" type="text" />
								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Kilometraje: </strong>
								</td>
								<td>
									<input size="15" name="Kilometraje3" type="text" />
								</td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>GASTO</strong></td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> Precio Gasolina: </strong>
								</td>
								<td>
									<input size="15" name="Precio3" type="text" />
								</td>
							</tr>
							</table>
						</td>
						</tr>
<?php
					}
					if($_POST['TipoDocto'] == 5)
					{
?>
						<tr>
						<td>
							<table class="Poa" align="center">
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>Viaticos</strong></td>
							</tr>
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>DATOS DEL COMISIONADO</strong></td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong> FECHA: </strong> </td>
							  <td><?php $_SESSION['Fecha'] = date("Y-m-d"); ?>
                                  <input size="15" name="Fecha5" type="text" value="<?php echo $_SESSION['Fecha']; ?>"/>
                              </td>
							  </tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro">
									<strong> NOMBRE: </strong>								</td>
								<td>
									<input size="50" name="Nombre5" type="text" />								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong>RFC: </strong></td>
								<td>
									<input size="18" name="rfc5" type="text" />								</td>
							</tr>
							<tr>
								<td align="right" class="MedianoAzulOscuro"><strong>DOMICILIO:</strong></td>
								<td><input size="50" name="Domicilio5" type="text" /></td>
							</tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>PUESTO:</strong></td>
							  <td><input size="50" name="Puesto5" type="text" /></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>CLAVE:</strong></td>
							  <td><input size="18" name="Clave5" type="text" /></td>
							  </tr>
							<tr>
							  <td class="PoaTitulo" colspan="3"><strong>DATOS DE LA COMISION </strong></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>LUGAR: </strong></td>
							  <td><input size="50" name="Lugar5" type="text" /></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>PERIODO: </strong></td>
							  <td><input size="50" name="Periodo5" type="text" /></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>CUOTA: </strong></td>
							  <td><input size="10
							  " name="Cuota5" type="text" /></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>DIAS: </strong></td>
							  <td><input size="3" name="Dias5" type="text" /></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>MOTIVO: </strong></td>
							  <td><input size="50" name="Motivo5" type="text" /></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>OBSERVACIONES: </strong></td>
							  <td><input size="50" name="Observaciones5" type="text" /></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>PAGO: </strong></td>
							  <td align="center">
							 		<select name="Pago5">
 										<option value="1">ANTICIPOS</option>
                            			<option value="2">DEVENGADOS</option>
									</select>							  </td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>JERARQUICO: </strong></td>
							  <td align="center">
							 		<select name="Jerarquico5">
 										<option value="1">K hasta G</option>
                            			<option value="2">P hasta L</option>
                            			<option value="3">PERSONAL OPERATIVO</option>
									</select>							  </td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>ZONA: </strong></td>
							  <td align="center">
							 		<select name="Zona5">
 										<option value="1">MAS ECONOMICA</option>
                            			<option value="2">MENOS ECONOMICA</option>
									</select>							  </td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Total de Capitulo </strong></td>
							  <td><strong>
                                <?php
									$bdd="sicopre";
									$busca="SELECT * FROM partida WHERE clavepartida='3817'";
									$resultado=mysql_db_query($bdd, $busca) or die(mysql_error());
									if($registro=mysql_fetch_assoc($resultado))
									{}
									echo "$".number_format ( ( totalPartida ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas']  ) ), 2, '.', ',' );

?>
                              </strong></td>
							  </tr>
							<tr>
							  <td align="right" class="MedianoAzulOscuro"><strong>Restante del Capitulo:</strong></td>
							  <td><strong>
                                <?php
									$bdd="sicopre";
									echo "$".number_format ( (totalPartida ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas']  ) - (totalPartidaPoa ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas']  ) + totalRequis ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas'] ) + totalSolicitudes ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas'] ) + totalViaticos ( $_SESSION['DPTO'], $bdd, $registro['id'], $_SESSION['Metas'] )) ), 2, '.', ',' );
?>
                              </strong></td>
							  </tr>
							<tr>
							  <td colspan="2"><?php
								if($mensaje_error == 10)
								{
									echo "FALTAN CAMPOS POR LLENAR";	
								}
								if($mensaje_error == 20)
								{
									echo "NO CUENTA CON SUFICIENTE PRESUPUESTO";	
								}
								if($mensaje_error == 30)
								{
									$busca="SELECT MAX(idviaticos) AS max_viatico FROM viaticos WHERE iddpto = '{$_SESSION['DPTO']}'";
									$resultado=mysql_db_query($bdd, $busca) or die(mysql_error());
									if($registro=mysql_fetch_assoc($resultado))
									{}
									echo "SE GUARDO EL REGISTRO CON EXITO";
									echo "</br>";
									echo "<a href='reportes/MinistracionViaticos.php?Viaticos={$registro['max_viatico']}' target='_blank'>";
									echo "<img src='imagenes/icono_pdf.jpg' border='0' alt='Solicitud de Adquisicion o Servicio' />";
								}
								if($mensaje_error == 40)
								{
									echo "ERROR AL INENTAR GUARDAR EL REGISTRO";	
								}
?>                              </td>
							  </tr>
							<tr>
							  <td></td>
							  <td align="center"><input type="submit" name="Ingresar5"  value="Ingresar"/>                              </td>
							  </tr>
							</table>
						</td>
						</tr>
<?php
					}
					if($_POST['TipoDocto'] == 6)
					{
?>
						<tr>
						<td>
							<table class="Poa" align="center">
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>Pasaje Aereo - Terrestre</strong></td>
							</tr>
							</table>
						</td>
						</tr>
<?php
					}
					if($_POST['TipoDocto'] == 7)
					{
?>
						<tr>
						<td>
							<table class="Poa" align="center">
							<tr>
								<td class="PoaTitulo" colspan="3"><strong>Pasaje Urbano</strong></td>
							</tr>
							</table>
						</td>
						</tr>
<?php
					}
?>
            <tr>
            	<td align="center" class="MedianoAzulOscuro">&nbsp;</td>
          	</tr>
          	<tr>
            	<td  colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">
					<fieldset style="background-color:#006699">
			       	<table width="100%" height="30">
				    	<tr>
					    	<td align="center" height="35">&nbsp;</td>
						</tr>
					</table>
	          		</fieldset>
				</td>
          	</tr>
        </table>
        </fieldset>
	</form>

		</td>
	</tr>
</table>