<?php
	if ( isset ( $_POST['modificar'] ) )
	{
		switch ( $_POST['table'] )
		{
			case 'accion':			if ( $_POST['nombreAccion'] == "" or $_POST['claveAccion'] == "" )
										{
											$error = 1;
										}
										else if ( !ereg("^[0-9]+$",$_POST['claveAccion']) )
										{
											$campo_error3 = "la Clave de la Acción.";
											$error = 3;
										}
										else
										{
											$sql = "UPDATE accion SET actividad_id='{$_POST['actividad_id']}', nombreAccion = '{$_POST['nombreAccion']}', claveAccion = {$_POST['claveAccion']}, unidad = '{$_POST['unidad']}', cantidad = '{$_POST['cantidad']}' WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
											{
												$sql_acti = "SELECT * FROM actividad WHERE id='{$_POST['actividad_id']}'";
												$res_acti = mysql_db_query ( $bdd, $sql_acti );
												if ( $row_acti = mysql_fetch_assoc ( $res_acti ) )
												{}
												$sql_poa_dpto = "SELECT * FROM poa_dpto WHERE idacciones='{$_POST['ID']}'";
												$res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto );
												while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
												{
													$sql = "UPDATE poa_dpto SET idproceso='{$row_acti['proceso_id']}', idactividad = '{$_POST['actividad_id']}' WHERE id = {$row_poa_dpto['id']}";
													if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
													{}
													
													$mensaje = 1;
												}
											}
											else
											{
												$error = 2;
											}
										}
										break;
										
			case 'preacciones':			if ( $_POST['Acci'] == "" )
										{
											$error = 1;
										}
										else
										{
											$sql = "UPDATE preacciones SET claveaccion = '{$_POST['Clave']}', accion = '{$_POST['Acci']}' , enero = '{$_POST['enero']}', julio = '{$_POST['julio']}' WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
			case 'actividad':		if ( $_POST['nombreactiv'] == "" or $_POST['claveActiv'] == "" )
										{
											$error = 1;
										}
										else if ( !ereg("^[0-9]+$",$_POST['claveActiv']) )
										{
											$campo_error3 = "la Clave de la Actividad.";
											$error = 3;
										}
										else
										{
											$sql = "UPDATE actividad SET nombreactiv = '{$_POST['nombreactiv']}', claveActiv = {$_POST['claveActiv']} WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
										
			case 'dpto':			if ( $_POST['clavedpto'] == "" or $_POST['nombredpto'] == "" or $_POST['nombretitular'] == "" or $_POST['puesto'] == "" )
										{
											$error = 1;
										}
										else if ( !ereg("^[0-9]+$",$_POST['clavedpto']) )
										{
											$campo_error3 = "la Clave del Departamento.";
											$error = 3;
										}
										else
										{
											$sql = "UPDATE dpto SET nombretitular = '{$_POST['nombretitular']}', puesto = '{$_POST['puesto']}', nombredpto = '{$_POST['nombredpto']}', estado = {$_POST['estado']}, clavedpto = {$_POST['clavedpto']} WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
										
			case 'insumo':		if ( $_POST['descinsu'] == "" or $_POST['medida'] == "" or $_POST['costuni'] == ""  )
										{
											$error = 1;
										}
										else
										{
											$sql = "UPDATE insumo SET descinsu = '{$_POST['descinsu']}', medida = '{$_POST['medida']}', costuni = '{$_POST['costuni']}', partida_id = {$_POST['partida_id']}, estado = {$_POST['estado']} WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
											{
												echo $_POST['partida_id']; echo " "; echo $_POST['ID'];
												$sql = "UPDATE poa_dpto SET partida_id = {$_POST['partida_id']} WHERE insumo_id = {$_POST['ID']}";
												if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
												{
													$mensaje = 1;
													
												}
												$mensaje = 1;
												
											}
											else
											{
												$error = 2;
											}
										}
										break;
										
			case 'metas':			
										if ( $_POST['unidadmedida'] == 0 or $_POST['enero'] == "" or $_POST['febrero'] == "" or $_POST['marzo'] == "" or $_POST['abril'] == "" or $_POST['mayo'] == "" or $_POST['junio'] == "" or $_POST['julio'] == "" or $_POST['agosto'] == "" or $_POST['septiembre'] == "" or $_POST['octubre'] == "" or $_POST['noviembre'] == "" or $_POST['diciembre'] == "" )
										{
											$error = 1;
										}
										else if ( !ereg("^[0-9]+$",$_POST['enero'] ) or !ereg("^[0-9]+$",$_POST['febrero'] ) or !ereg("^[0-9]+$",$_POST['marzo'] ) or !ereg("^[0-9]+$",$_POST['abril'] ) or !ereg("^[0-9]+$",$_POST['mayo'] ) or !ereg("^[0-9]+$",$_POST['junio'] ) or !ereg("^[0-9]+$",$_POST['julio'] ) or !ereg("^[0-9]+$",$_POST['agosto'] ) or !ereg("^[0-9]+$",$_POST['septiembre'] ) or !ereg("^[0-9]+$",$_POST['octubre'] ) or !ereg("^[0-9]+$",$_POST['noviembre'] ) or !ereg("^[0-9]+$",$_POST['diciembre'] ) )
										{
											$campo_error3 = "todas las metas mensuales.";
											$error = 3;
										}
										else
										{	
											$sql = "UPDATE metas SET unidadmedida_id = {$_POST['unidadmedida']} , enero = {$_POST['enero']}, febrero = {$_POST['febrero']}, marzo = {$_POST['marzo']}, abril = {$_POST['abril']}, mayo = {$_POST['mayo']}, junio = {$_POST['junio']}, julio = {$_POST['julio']}, agosto = {$_POST['agosto']}, septiembre = {$_POST['septiembre']}, octubre = {$_POST['octubre']}, noviembre = {$_POST['noviembre']}, diciembre = {$_POST['diciembre']} WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
										
										
			case 'partida':			if ( $_POST['clavepartida'] == "" or $_POST['descpartida'] == "" )
										{
											$error = 1;
										}
										else if ( !ereg("^[0-9]+$",$_POST['clavepartida']) )
										{
											$campo_error3 = "la Clave de la Partida.";
											$error = 3;
										}
										else
										{
											$sql = "UPDATE partida SET clavepartida = {$_POST['clavepartida']}, descpartida = '{$_POST['descpartida']}', restringidas = {$_POST['restringidas']}, estado = {$_POST['estado']} WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
			
			case 'presupuesto':
										
										$sql_ejercicio = "SELECT * FROM poa WHERE actual = 1";
										$res_ejercicio = mysql_db_query ( $bdd, $sql_ejercicio );
										$row_ejercicio = mysql_fetch_assoc ( $res_ejercicio );
										
										if ( $_POST['presupuesto'] == ""  )
										{
											$error = 1;
										}
										/*else if ( $_POST['presupuesto'] < $_POST['presupuestoAnterior'] and ( $row_ejercicio['iniciado'] == 1 and $row_ejercicio['tipo'] == 1  )  )
										{
											$error = 5; //Error específico
										}*/
										else if ( !ereg("^[0-9]+\.[0-9]{2}$",$_POST['presupuesto']) )
										{
											$campo_error3 = "el Presupuesto. (Con dos decimales)";
											$error = 3;
										}
										else
										{
											$sql = "UPDATE presupuesto SET dpto_id = {$_POST['dpto_id']}, presupuesto = {$_POST['presupuesto']} WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
			
										
			case 'proceso':		if ( $_POST['nombreproceso'] == "" or $_POST['claveproceso'] == "" or $_POST['proyecto'] == "" )
										{
											$error = 1;
										}
										else if ( ( strlen ( $_POST['claveproceso'] ) < 2 ) or ( strlen ( $_POST['proyecto'] ) < 12 ) )
										{
											$error = 4;		//Error específico
										}
										else if ( !ereg("^[0-9]+$",$_POST['claveproceso']) or !ereg("^[0-9]+$",$_POST['proyecto']) )
										{
											$campo_error3 = "la Clave del Proceso y el número de Proyecto.";
											$error = 3;
										}
										else
										{
											$sql = "UPDATE proceso SET nombreproceso = '{$_POST['nombreproceso']}', claveproceso = '{$_POST['claveproceso']}', proyecto = '{$_POST['proyecto']}' WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
										
			case 'gob_federal':
										if ( isset ( $_POST['modificar'] ) )	
										{
											$sql = "SELECT * FROM gob_federal WHERE dpto_id = {$_POST['dpto_id']} AND unidadmedida_id = {$_POST['unidadmedida']} AND partida_id = {$_POST['partida_id']}";
											$res = mysql_db_query ( $bdd, $sql );
											if ( !$row = mysql_fetch_assoc ( $res ) )
											{
												$row['id'] = $_POST['ID'];
											}
											
											if ( $_POST['dpto_id'] == 0 or $_POST['unidadmedida'] == 0 or $_POST['partida_id'] == 0 or $_POST['presupuesto'] == "" )
											{
												$error = 1;
											}
											else if ( !ereg("^[0-9]+\.[0-9]{2}$",$_POST['presupuesto']) )
											{
												$campo_error3 = "el Subsidio. (Con dos decimales)";
												$error = 3;
											}
											else if ( $_POST['ID'] != $row['id'] )
											{											
												$error = 6;				//Error específico
											}
											else
											{
												$sql = "UPDATE gob_federal SET dpto_id = {$_POST['dpto_id']}, unidadmedida_id = {$_POST['unidadmedida']}, partida_id = {$_POST['partida_id']}, presupuesto = {$_POST['presupuesto']} WHERE id = {$_POST['ID']}";
												if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
												{
													$mensaje = 1;
												}
												else
												{
													$error = 2;
												}
											}
										}
										break;
										
			case 'unidadmedida':
			
										if ( $_POST['tipounidad'] == "" )
										{
											$error = 1;
										}
										else
										{
											$sql = "UPDATE unidadmedida SET tipounidad = '{$_POST['tipounidad']}' WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
				
			case 'usuario':
										$sql_user = "SELECT * FROM usuario WHERE usuario = '{$_POST['usuario']}' ";
										$res_user = mysql_db_query ( $bdd, $sql_user );
										if ( $row_user = mysql_fetch_assoc ( $res_user ) )
										{
											$existe = 1;
										}
										if ( $_POST['nombre'] == "" or $_POST['usuario'] == "" or $_POST['pass'] == "" )
										{
											$error = 1;
										}
										else if ( $existe == 1 and $row_user['id'] != $_POST['ID'] )
										{
											$error = 7;
										}
										else
										{
											$sql = "UPDATE usuario SET nombreusuario = '{$_POST['nombre']}', tipousuario = {$_POST['tipo']}, dpto_id = {$_POST['dpto_id']}, clave = '{$_POST['pass']}', estado = {$_POST['estado']}, usuario = '{$_POST['usuario']}' WHERE id = {$_POST['ID']}";
											if ( $res = mysql_db_query($bdd,$sql) )
											{
												$mensaje = 1;
											}
											else
											{
												$error = 2;
											}
										}
										break;
			
		}
	}
?>

<form action="" method="post">
<table width="100%" height="250" align="center">
	<tr>
    	<td align="center" width="100%">
<?php
			switch ( $error )
			{
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar datos en todos los campos.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
								break;
				case 2:		echo "<div align = \"center\" class = \"MedianoAlerta\">Error en la base de datos, intente de nuevo más tarde.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
								break;
				case 3:		echo "<div align = \"center\" class = \"MedianoAlerta\">Se deben ingresar unicamente números en {$campo_error3}<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
								break;
				case 4:		echo "<div align = \"center\" class = \"MedianoAlerta\">La clave del Proceso no puede ser mayor a 2 dígitos y el Proyecto no menor a 12.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>"; //Error específico
								break;
				case 5:		echo "<div align = \"center\" class = \"MedianoAlerta\">El monto ingresado es menor al autorizado.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>"; //Error específico
								break;
				case 6:		echo "<div align = \"center\" class = \"MedianoAlerta\">La modificación no es posible, el departamento en el proceso, actividad, accion, unidad de medida y partida seleccionados ya tienen asignados un subsidio.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>"; //Error específico
								break;
				case 7:		echo "<div align = \"center\" class = \"MedianoAlerta\">El usuario seleccionado ya existe.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>"; //Error específico
								break;
			}
			
			if ( isset ( $mensaje ) )
			{
				switch ( $mensaje )
				{
					case 1:		echo "<div align = \"center\" class = \"MedianoExitoAzul\">El registro ha sido modificado!</div></td></tr></table></form>";
									break;
				}
			}
			else
			{
?>
        </td>
    </tr>
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Modificaciones</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		
<?php
			if ( isset ( $_GET['table'] ) )
			{
				$sql_table = "SELECT * FROM {$_GET['table']} WHERE id = {$_GET['id']}";
				if ( $res_table = mysql_db_query ( $bdd, $sql_table ) )
				{
					if ( $row_table = mysql_fetch_assoc ( $res_table ) )
					{
						switch ( $_GET['table'] )
						{
							case 'preacciones':
							?>
														<tr>
															<td align="right" width="35%" class="MedianoAzulOscuro"><strong>Meta:</strong></td>
															<td align="left" width="65%" class="MedianoAzulOscuro">
																<select name="Accion" class="ControlesTexto" onchange="submit()">
																	<option >
																		<?php
																			$sql_preacciones = "SELECT * FROM accion WHERE id='{$row_table[idmeta]}'";
																			$res_preacciones = mysql_db_query ( $bdd, $sql_preacciones );
																			if ( $row_preacciones = mysql_fetch_assoc ( $res_preacciones ) )
																			{
																				echo $row_preacciones['nombreAccion'];
																			}
																		?>
																	</option>
																	<option >[Seleccione una opción]</option>
									<?php
																	$sql_proyecto = "SELECT * FROM accion ";
																	$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
																	while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
																	{
									?>
																	<option value="<?php echo $row_proyecto['id']; ?>" <?php if ( $_POST['Accion'] == $row_proyecto['id'] ) { ?> selected="selected" <?php } ?> > <?php echo $row_proyecto['claveAccion']; ?> .- <?php echo $row_proyecto['nombreAccion']; ?> </option>
									<?php
													}
									?>
																</select>								
															</td>
														</tr>
														<tr>
															<td align="right" class="MedianoAzulOscuro">&nbsp;</td>
														  	<td align="left" class="MedianoAzulOscuro">
									<?php 
															//echo $_POST['Accion'];
															if ( $_POST['Accion'] != 0 )
															{
																$sql_accion = "SELECT * FROM accion WHERE id = '{$_POST['Accion']}'";
																$res_accion = mysql_db_query ( $bdd, $sql_accion );
																if ( $row_accion = mysql_fetch_assoc ( $res_accion ) )
																{
																	//echo $row_clave['nombreactiv'];
																	$sql_clave = "SELECT * FROM actividad WHERE id = '{$row_accion['actividad_id']}'";
																	$res_clave = mysql_db_query ( $bdd, $sql_clave );
																	if ( $row_clave = mysql_fetch_assoc ( $res_clave ) )
																	{
																		echo $row_clave['nombreactiv'];
																	}
																}
																
															}
											?>							  
															</td>
													  	</tr>
														<tr>
															<td align="right" width="35%" class="MedianoAzulOscuro"><strong>Clave:</strong></td>
															<td align="left" width="65%" class="MedianoAzulOscuro">
															<input name="Clave" value="<?php echo $row_table['claveaccion'];?>"class="ControlesTexto2" />
															</td>
														</tr>
														<tr> 
															<td align="right" width="35%" class="MedianoAzulOscuro"><strong>Accion:</strong></td>
															<td align="left" width="65%" class="MedianoAzulOscuro">
															<textarea name="Acci" cols="30" rows="5"> <?php echo $row_table['accion'];?></textarea>
															</td>
														</tr>
														<tr>
															<td align="right" class="MedianoAzulOscuro"><strong>Enero-Junio:</strong></td>
														  	<td align="left" class="MedianoAzulOscuro">
															<input name="enero" value="<?php echo $row_table['enero'];?>" class="ControlesTexto2" id="enero" />
															</td>
													  	</tr>
														<tr>
														  	<td align="right" class="MedianoAzulOscuro"><strong>Julio-Diciembre:</strong></td>
														  	<td align="left" class="MedianoAzulOscuro">
															<input name="julio" value="<?php echo $row_table['julio'];?>"class="ControlesTexto2" id="julio" />
															</td>
													  	</tr>
														<tr>
															<td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
														</tr>
							<?php
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
							case 'accion':		echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Actividad:</strong></td>";
													echo "<td class='MedianoAzulOscuro'>";
													echo "<select name='actividad_id'>";
													$sql = "SELECT * FROM actividad";
													$res = mysql_db_query ( $bdd, $sql );
													while ( $row = mysql_fetch_assoc($res) )
													{
														echo "<option disabled='disabled' value='{$row['id']}'"; 
														if ( $row_table['actividad_id'] == $row['id'] )		{	echo "selected='selected'";		} 
														echo ">";
														if ( strlen($row['nombreactiv']) > 30 )	{	echo substr($row['nombreactiv'],0,29)."...";	}
														else													{	echo $row['nombreactiv'];							}
														echo "</option>";
													}
													echo "</select>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro' width='35%'><strong>Nombre de la Meta:</strong></td>";
													echo "<td class='MedianoAzulOscuro'><input size='35' name='nombreAccion' type='text' value='{$row_table['nombreAccion']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong>Unidad de Medida: </strong> </td>";
													echo "<td width='60%' align='left'><input size='40' name='unidad' type='text' value='{$row_table['unidad']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong>Cantidad: </strong> </td>";
													echo "<td width='60%' align='left'><input size='8' name='cantidad' type='text' value='{$row_table['cantidad']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong>Clave Meta: </strong> </td>";
													echo "<td width='60%' align='left'><input size='8' name='claveAccion' type='text' value='{$row_table['claveAccion']}' /></td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
													
							case 'actividad':	echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Proceso:</strong></td>";
													echo "<td class='MedianoAzulOscuro'>";
													echo "<select name='proceso_id'>";
													$sql = "SELECT * FROM proceso";
													$res = mysql_db_query ( $bdd, $sql );
													while ( $row = mysql_fetch_assoc($res) )
													{
														echo "<option disabled='disabled' value='{$row['id']}'"; 
														if ( $row_table['proceso_id'] == $row['id'] )		{	echo "selected='selected'";		} 
														echo ">";
														if ( strlen($row['nombreproceso']) > 30 )	{	echo substr($row['nombreproceso'],0,29)."...";	}
														else													{	echo $row['nombreproceso'];							}
														echo "</option>";
													}
													echo "</select>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro' width='35%'><strong>Nombre de la Actividad:</strong></td>";
													echo "<td class='MedianoAzulOscuro'><input size='35' name='nombreactiv' type='text' value='{$row_table['nombreactiv']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong>Clave de la Actividad: </strong> </td>";
													echo "<td width='60%' align='left'><input size='8' name='claveActiv' type='text' value='{$row_table['claveActiv']}' /></td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
							
							case 'dpto':		echo "<tr>";
													echo "<td width='47%' height='31' class='MedianoAzulOscuro'><div align='right'><strong> Clave: </strong></div></td>";
													echo "<td width='53%' class='MedianoAzulOscuro'><input size='15' name='clavedpto' value='{$row_table['clavedpto']}'  type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td class='MedianoAzulOscuro'><div align='right'><strong> <strong><strong>Nombre del Departamento:</strong></strong></strong></div></td>";
													echo "<td class='MedianoAzulOscuro'><input size='35' name='nombredpto' value='{$row_table['nombredpto']}'  type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td class='MedianoAzulOscuro'><div align='right'><strong><strong>Nombre del Titular </strong></strong>:</div></td>";
													echo "<td class='MedianoAzulOscuro'><input size='35' name='nombretitular' value='{$row_table['nombretitular']}'  type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td class='MedianoAzulOscuro'><div align='right'><strong><strong>Puesto </strong></strong>:</div></td>";
													echo "<td class='MedianoAzulOscuro'><input size='35' name='puesto' value='{$row_table['puesto']}'  type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='47%' align='right' class='MedianoAzulOscuro'><strong><strong>Estado: </strong> </strong> </td>";
													echo "<td width='53%' align='left'>";
													echo "<select name='estado'>";
													echo "<option value='1'>Activo</option>";
													echo "<option value='0'>Inactivo</option>";
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
							
							case 'insumo':	echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong> Descripción: </strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input size='40' name='descinsu' value='{$row_table['descinsu']}' type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Medida:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='15' name='medida' value='{$row_table['medida']}' type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Costo Unitario:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='15' name='costuni' value='{$row_table['costuni']}' type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Partida correspondiente: </strong></td>";
													echo "<td width='60%' align='left'>";
													echo "<select name='partida_id'>";
						
													$sql = "SELECT * FROM partida";
													$res = mysql_db_query ( $bdd, $sql );
													while ( $row = mysql_fetch_assoc($res) )
													{
						
														echo "<option value='{$row['id']}'";
														if ( $row_table['partida_id'] == $row['id'] )		{ 	echo "selected='selected'";	}
														echo ">";
														if ( strlen($row['clavepartida']) > 30 )		{	echo substr($row['clavepartida'],0,29)."...";	}												
														else														{	echo $row['clavepartida'];								}
														echo "</option>";
													}
						
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Estado: </strong></td>";
													echo "<td width='60%' align='left'>";
													echo "<select name='estado'>";
													echo "<option value='1'>Activo</option>";
													echo "<option value='0'>Inactivo</option>";
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
							
							case 'metas':		$sql_dpto = "SELECT * FROM dpto WHERE id = {$row_table['dpto_id']}";
													$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
													$row_dpto = mysql_fetch_assoc ( $res_dpto );
													
													echo "<tr>";
            										echo "<td align='center' class='MedianoAzulOscuro' colspan='2'><strong>{$row_dpto['nombredpto']}</strong></td>";
          											echo "</tr>";
													echo "<tr>";
            										echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Proyecto:</strong></td>";
            										echo "<td align='left' width='65%' class='MedianoAzulOscuro'>";
													
                        							echo "<select name='unidadmedida' class='ControlesTexto' onchange='submit()'>";
                   									echo "<option value='0'>[Seleccione una opción]</option>";
													$sql_proyecto = "SELECT proceso.proyecto, proceso.claveproceso, actividad.claveActiv, accion.claveaccion, unidadmedida.id AS unidad_id, unidadmedida.tipounidad FROM proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id";
													$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
													while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
													{
														echo "<option value='{$row_table['unidadmedida_id']}'";
														if ( $row_table['unidadmedida_id'] == $row_proyecto['unidad_id'] ) { echo "selected='selected'"; }
														echo ">{$row_proyecto['claveproceso']}.{$row_proyecto['claveActiv']}.{$row_proyecto['claveaccion']} - {$row_proyecto['tipounidad']}</option>";
													}
													echo "</select>";
													echo "</td>";
          											echo "</tr>";
                    								echo "<tr>";
            										echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Enero:</strong></td>";
            										echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='enero' type='text' class='ControlesTexto2' value='{$row_table['enero']}' /></td>";
          											echo "</tr>";
                    								echo "<tr>";
            										echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Febrero:</strong></td>";
            										echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='febrero' type='text' class='ControlesTexto2' value='{$row_table['febrero']}' /></td>";
          											echo "</tr>";
                    								echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Marzo:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='marzo' type='text' class='ControlesTexto2' value='{$row_table['marzo']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Abril:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='abril' type='text' class='ControlesTexto2' value='{$row_table['abril']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Mayo:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='mayo' type='text' class='ControlesTexto2' value='{$row_table['mayo']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Junio:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='junio' type='text' class='ControlesTexto2' value='{$row_table['junio']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Julio:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='julio' type='text' class='ControlesTexto2' value='{$row_table['julio']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Agosto:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='agosto' type='text' class='ControlesTexto2' value='{$row_table['agosto']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Septiembre:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='septiembre' type='text' class='ControlesTexto2' value='{$row_table['septiembre']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Octubre:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='octubre' type='text' class='ControlesTexto2' value='{$row_table['octubre']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Noviembre:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='noviembre' type='text' class='ControlesTexto2' value='{$row_table['noviembre']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong>Diciembre:</strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input name='diciembre' type='text' class='ControlesTexto2' value='{$row_table['diciembre']}' /></td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
													
													
							case 'partida':		echo "<tr>";
													echo "<td align='right' width='35%' class='MedianoAzulOscuro'><strong> Clave: </strong></td>";
													echo "<td align='left' width='65%' class='MedianoAzulOscuro'><input size='15' name='clavepartida' value='{$row_table['clavepartida']}' type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align= right' class='MedianoAzulOscuro'><strong>Descripción:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='35' name='descpartida' value='{$row_table['descpartida']}' type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='center' class='MedianoAzulOscuro' colspan='2'><strong>";
													if ( $row_table['restringidas'] == 1 )
													{
														echo "Restringida: <input type='radio' name='restringidas' checked='checked' value='1' > ";
														echo "No restringida:</strong> <input type='radio' name='restringidas' value='0' />";
													}
													else
													{
														echo "Restringida: <input type='radio' name='restringidas' value='1' > ";
														echo "No restringida:</strong> <input type='radio' name='restringidas' checked='checked' value='0' />";
													}
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Estado: </strong></td>";
													echo "<td width='60%' align='left'>";
													echo "<select name='estado'>";
													echo "<option value='1'>Activo</option>";
													echo "<option value='0'>Inactivo</option>";
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
							
							case 'presupuesto':
													echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Departamento:</strong></td>";
													echo "<td class='MedianoAzulOscuro'>";
													echo "<select name='dpto_id' onchange='submit()'>";
													
													echo "<option value='0'>[Seleccione un Departamento]</option>";
													$sql = "SELECT * FROM dpto";
													$res = mysql_db_query ( $bdd, $sql );
													while ( $row = mysql_fetch_assoc($res) )
													{
														echo "<option value='{$row['id']}'";
														if ( $row_table['dpto_id'] == $row['id'] ) { echo "selected='selected'";	}
														echo ">";
														echo $row['nombredpto'];
														echo "</option>";
													}
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro' width='35%'><strong>Presupuesto:</strong></td>";
													echo "<td class='MedianoAzulOscuro'><input size='25' name='presupuesto' type='text' value='{$row_table['presupuesto']}' /></td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													echo "<input type='hidden' name='presupuestoAnterior' value='{$row_table['presupuesto']}' />";
													break;
													
							
							case 'proceso':	echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Nombre:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='35' name='nombreproceso' value='{$row_table['nombreproceso']}' type='text' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Proyecto:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='35' name='proyecto' type='text' value='{$row_table['proyecto']}' maxlength='12' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong><strong>Clave: </strong> </strong> </td>";
													echo "<td width='60%' align='left'> <input size='8' name='claveproceso' type='text' value='{$row_table['claveproceso']}' maxlength='2' /></td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
													
							case 'gob_federal':
													echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Departamento:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'>";
													
													echo "<select name='dpto_id'>";
													echo "<option value='0'>[Seleccione un Departamento]</option>";
													$sql = "SELECT * FROM dpto ORDER BY clavedpto";
													$res = mysql_db_query ( $bdd, $sql );
													while ( $row = mysql_fetch_assoc($res) )
													{
														echo "<option value='{$row['id']}'";
														if ( $row_table['dpto_id'] == $row['id'] ) { echo "selected='selected'";	}
														echo ">{$row['nombredpto']}</option>";
													}
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='35%' align='right' class='MedianoAzulOscuro'><strong>Proyecto:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'>";
													
													echo "<select name='unidadmedida'>";
													echo "option value='0'>[Seleccione una opción]</option>";
													$sql_proyecto = "SELECT proceso.proyecto, proceso.claveproceso, actividad.claveActiv, accion.claveaccion, unidadmedida.id AS unidad_id, unidadmedida.tipounidad FROM proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id";
													$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
													while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
													{
														echo "<option value='{$row_proyecto['unidad_id']}'";
														if ( $row_table['unidadmedida_id'] == $row_proyecto['unidad_id'] ) { echo "selected='selected'";	}
														echo ">".$row_proyecto['proyecto'].$row_proyecto['claveproceso'].".".$row_proyecto['claveActiv'].".".$row_proyecto['claveaccion']." - ".$row_proyecto['tipounidad']."</option>";
													}
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro' width='35%'><strong>Partida:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'>";
													
													echo "<select name='partida_id'>";
													echo "<option value='0'>[Seleccione una Partida]</option>";
													$sql = "SELECT * FROM partida ORDER BY clavepartida";
													$res = mysql_db_query ( $bdd, $sql );
													while ( $row = mysql_fetch_assoc($res) )
													{
														echo "<option value='{$row['id']}'";
														if ( $row_table['partida_id'] == $row['id'] ) { echo "selected='selected'"; } 
														echo ">{$row['clavepartida']}</option>";
													}
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro' width='35%'><strong>Presupuesto:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='25' name='presupuesto' type='text' value='{$row_table['presupuesto']}' /></td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
													
							case 'unidadmedida':
												
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Acción:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'>";
													echo "<select name='accion_id'>";
													$sql = "SELECT * FROM accion";
													$res = mysql_db_query ( $bdd, $sql );
													while ( $row = mysql_fetch_assoc($res) )
													{
														echo "<option disabled='disabled' value='{$row['id']}'"; 
														if ( $row_table['accion_id'] == $row['id'] )		{	echo "selected='selected'";		}
														echo ">";
														if ( strlen($row['nombreAccion']) > 30 )	{	echo substr($row['nombreAccion'],0,29)."...";	}
														else													{	echo $row['nombreAccion'];							}
														echo "</option>";
													}
													echo "</select>";
													
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Nombre de la Unidad:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'>";
													echo "<input size='35' name='tipounidad' value='{$row_table['tipounidad']}' type='text' />";
													echo "</td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
													
							case 'usuario':	
													if ( !isset ( $_POST['tipo'] ) )
													{
														echo "Si entró ahorita";
														$_POST['tipo'] = $row_table['tipousuario'];
													}	
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong>Tipo de Usuario:</strong></td>";
													echo "<td width='60%' align='left'>";
													
													echo "<select name='tipo' onchange='submit()'>";
													echo "<option value='1' ";
													if ( $_POST['tipo'] == 1 )	{	echo "selected='selected'";	} 
													echo ">Administrador</option>";
													echo "<option value='2'";
													if ( $_POST['tipo'] == 2 ) {	echo "selected='selected'";	} 
													echo ">Analista</option>";
													echo "<option value='3'";
													if ( $_POST['tipo'] == 3 ) { 	echo "selected='selected'"; 	} 
													echo ">Jefe de Departamento</option>";
													echo "</select>";
													
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong>Departamento: </strong></td>";
													echo "<td width='60%' align='left'>";
													echo "<select name='dpto_id'>";
													if ( $_POST['tipo'] == 3 )
													{
														echo "<option value='0'>Seleccione una opción</option>";
														$sql = "SELECT * FROM dpto WHERE estado = 1";
														$res = mysql_db_query ( $bdd, $sql );
														while ( $row = mysql_fetch_assoc ( $res ) )
														{
															echo "<option value='{$row['id']}'";
															if ( $row_table['dpto_id'] == $row['id'] )	{	echo "selected='selected'";	}
															echo ">{$row['nombredpto']}</option>";
														}
													}
													else
													{
														echo "<option value='0'>No aplica</option>";
													}
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Nombre del Usuario:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='35' name='nombre' type='text' value='{$row_table['nombreusuario']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Usuario:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='35' name='usuario' type='text' value='{$row_table['usuario']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td align='right' class='MedianoAzulOscuro'><strong>Contraseña:</strong></td>";
													echo "<td align='left' class='MedianoAzulOscuro'><input size='30' name='pass' type='text' value='{$row_table['clave']}' /></td>";
													echo "</tr>";
													echo "<tr>";
													echo "<td width='40%' align='right' class='MedianoAzulOscuro'><strong>Estado:</strong></td>";
													echo "<td width='60%' align='left'>";
													echo "<select name='estado'>";
													echo "<option value='1'>Activo</option>";
													echo "<option value='0'>Inactivo</option>";
													echo "</select>";
													echo "</td>";
													echo "</tr>";
													echo "<input type='hidden' name='ID' value='{$row_table['id']}' />";
													echo "<input type='hidden' name='table' value='{$_GET['table']}' />";
													break;
						}
					}
					else
					{
						$error = 2; //El registro no existe o la base de datos no funciona correctamente!
					}
				}
				else
				{
					$error = 1;		//Error en la base de datos!
				}	
			}
?>     
				<tr>
            		<td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
          		</tr>
           		<tr>
          			<td colspan="3" align="center"  class="PequenioAzul"><input type="submit" name="modificar"  value="Modificar"/></td>
		  		</tr>
                <tr>
            		<td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
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
		</td>
	</tr>
</table>
</form>

<?php
			}
?>