<?php

	if ( isset ( $_POST['ingresar'] ) )
	{
		if ( $_POST['tipounidad'] == "" )
		{
			$error = 3;
		}
		else
		{
			$sql = "INSERT INTO unidadmedida (accion_id, tipounidad) VALUES ( {$_POST['accion_id']}, '{$_POST['tipounidad']}' )";
			if ( $res = mysql_db_query($bdd,$sql) )
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
			case 1:
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">La unidad se ha almacenado exitosamente!</div>";
						break;
			case 2:
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">La unidad se ha modificado exitosamente!</div>";
						break;
		}
	}
	else
	{
	
?>

<form action="" method="post">
<table width="100%" height="209" align="center">
	<tr>
    	<td align="center" width="100%">
<?php
			switch ( $error )
			{
				case 3: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar datos en todos los campos! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 10: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">Error en base de datos! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
			}
?>
        </td>
    </tr>
	<tr>
		<td width="100%"> 
        	<fieldset    style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/weight_128.gif" width="50" height="50"/>Unidad de Medida</legend>
				<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
          			<tr>
				    	<td align="right" class="MedianoAzulOscuro"><strong>Acción:</strong></td>
            			<td align="left" class="MedianoAzulOscuro">
                           	<select name="accion_id">
<?php
								$sql = "SELECT * FROM accion ORDER BY claveaccion";
								$res = mysql_db_query ( $bdd, $sql );
								while ( $row = mysql_fetch_assoc($res) )
								{
?>
									<option value="<?php echo $row['id']; ?>" <?php if ( $_POST['accion_id'] == $row['id'] or $get['accion_id']== $row['id'] ) { ?> selected="selected" <?php } ?> >
                                    
                                    	<?php 
												if ( strlen($row['nombreAccion']) > 30 )
												{
													echo substr($row['nombreAccion'], 0, 29)."..."; 
												}
												else
												{
													echo $row['nombreAccion'];
												}	
										?>
                                    </option>
<?php
								}
?>
							</select>
						</td>
					</tr>
		  			<tr>
            			<td align="right" class="MedianoAzulOscuro"><strong>Nombre de la Unidad:</strong></td>
            			<td align="left" class="MedianoAzulOscuro">
                           	<input size="35" name="tipounidad" type="text" />
         				</td>
         			</tr>
       				<tr>
            			<td colspan="3" align="center" class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','../Imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0"  name="dpto"  onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingreso Unidad de Medida')" /></a> <input type="submit" name="ingresar" value="Ingresar"/>
						</td>
					</tr>
          			<tr>
           				<td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
          			</tr>
          			<tr>
						<td  colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">
							<fieldset  style="background-color:#006699">
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