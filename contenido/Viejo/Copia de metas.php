<?php
	$sql_poa = "SELECT * FROM poa WHERE actual = 1";
	$res_poa = mysql_db_query ( $bdd, $sql_poa );
	if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
	{
		if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
		{
			if ( isset ( $_POST['ingresar'] ) )
			{
				if ( $_POST['Accion'] == "" or $_POST['Clave'] == "" or $_POST['Acci'] == "" )
				{
					$error = 3;
				}
				else
				{	
					$sql = "INSERT INTO metas ( claveaccion, accion , iddpto, idmeta, idpoa ) VALUES ( {$_POST['Clave']}, '{$_POST['Acci']}', {$_SESSION['dpto_id']},  {$_POST['Accion']}, {$row_poa['id']} )";
					if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
					{
						$mensaje = 1;
					}
					else
					{
						$error = 10;
					}
				}
			}
			
		
			if ( isset ( $mensaje ) )
			{
				switch ( $mensaje )
				{
					case 1:		echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los datos se han almacenado exitosamente!</div>";
									break;
				}
			}
			else
			{
		?>		
		
		<form action="" method="post">
		<table width="100%" height="250" align="center">
			<tr>
				<td width="100%" align="center">
		<?php
					switch ( $error )
					{
						case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar números con dos decimales unicamente en los campos de meta. <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
									break;
			
									
						case 3: 	echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar datos en todos los campos.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
									break;
						case 10: 	echo "<div align = \"center\" class = \"MedianoAlerta\">Error en base de datos! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
									break;
					}
		?>
				</td>
			</tr>
			<tr>
				<td width="100%"> 
					<fieldset style="border-bottom-color:#0066CC" >
						<legend class="MedianoAzulOscuro"><img src="imagenes/plugin_go.gif"  /> Acciones </legend>
					
						<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
							<tr>
								<td align="right" width="35%" class="MedianoAzulOscuro"><strong>Meta:</strong></td>
								<td align="left" width="65%" class="MedianoAzulOscuro">
									<select name="Accion" class="ControlesTexto" onchange="submit()">
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
								<td align="left" width="65%" class="MedianoAzulOscuro"><input name="Clave" type="text" class="ControlesTexto2" /></td>
							</tr>
							<tr>
								<td align="right" width="35%" class="MedianoAzulOscuro"><strong>Accion:</strong></td>
								<td align="left" width="65%" class="MedianoAzulOscuro"><input name="Acci" type="text" class="ControlesTexto2" /></td>
							</tr>
							
							<tr>
							<?php
								if ( $_POST['Accion'] != 0 )
								{
							?>
										<td colspan="3" align="center" class="PequenioAzul">
											<input type="submit" name="ingresar"  value="Ingresar"/>										</td>
							<?php
								}
							?>
							</tr>
							<tr>
								<td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
									<fieldset  style="background-color:#006699">
										<table width="100%" height="30">
											<tr>
												<td bgcolor="#006699" align="center" height="35">&nbsp;</td>
											</tr>
										</table>
									</fieldset>								</td>
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
		else
		{
			echo "<div align='center' class='MedianoAlerta'>No está permitida la captura de metas en este momento.</div>";
		}
	}
	else
	{
		echo "<div align='center' class='MedianoAlerta'>No se ha iniciado ningun ejercicio presupuestal.</div>";
	}
?>