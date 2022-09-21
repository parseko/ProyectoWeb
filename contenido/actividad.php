<?php
	if ( isset ( $_POST['ingresar'] ) )
	{
		if ( $_POST['nombreactiv'] == "" or $_POST['claveActiv'] == "" )
		{
			$error = 3;
		}
		else if ( !ereg("^[0-9]+$",$_POST['claveActiv']) )
		{
			$error = 1;
		}
		else
		{
			$sql = "INSERT INTO actividad (proceso_id, nombreactiv, claveActiv) VALUES ( {$_POST['proceso_id']}, '{$_POST['nombreactiv']}', {$_POST['claveActiv']} )";
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
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">La actividad se ha almacenado exitosamente!</div>";
						break;
			case 2:
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">La actividad se ha modificado exitosamente!</div>";
						break;
		}
	}
	else
	{
?>

<form action="" method="post">
<table width="100%" align="center">
	<tr>
    	<td align="center" width="100%">
<?php
			switch ( $error )
			{
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar números unicamente en la clave de la actividad! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
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
		<td align="center" width="100%"> 
        	<fieldset style="border-bottom-color:#0066CC" >
				<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Clave</legend>
				<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
          			<tr>
                        <td align="right" class="MedianoAzulOscuro"><strong>Proceso:</strong></td>
                        <td align="left" class="MedianoAzulOscuro">
                        	<select name="proceso_id">
<?php
								$sql = "SELECT * FROM proceso ORDER BY claveproceso";
								$res = mysql_db_query ( $bdd, $sql );
								while ( $row = mysql_fetch_assoc($res) )
								{
?>
									<option value="<?php echo $row['id']; ?>" <?php if ( $_POST['proceso_id'] == $row['id'] or $get['proceso_id']== $row['id'] ) { ?> selected="selected" <?php } ?> >
									
                                    <?php 
												if ( strlen($row['nombreproceso']) > 30 )
												{
													echo substr($row['nombreproceso'], 0, 29)."..."; 
												}
												else
												{
													echo $row['nombreproceso'];
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
            			<td align="right" class="MedianoAzulOscuro"><strong>Nombre de la Clave:</strong></td>
            			<td align="left" class="MedianoAzulOscuro"><input size="35" name="nombreactiv" type="text" /></td>
         			</tr>
					<tr>
						<td width="40%" align="right" class="MedianoAzulOscuro"><strong>Clave de la CLAVE: </strong></td>
						<td width="60%" align="left"> <input size="8" name="claveActiv" type="text" maxlength="2" /></td>
          			</tr>
         			<tr>
            			<td colspan="3" align="center" class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0" name="dpto" onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar Actividad')" /></a> <input type="submit" name="ingresar" value="Ingresar"/>
                        </td>
		  			</tr>
          			<tr>
            			<td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
          			</tr>
          			<tr>
            			<td colspan="4"  bgcolor="#006699" class="MedianoAzulOscuro">
							<fieldset class="style3"  style="background-color:#006699">
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