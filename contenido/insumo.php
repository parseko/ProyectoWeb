<?php

	if ( isset ( $_POST['ingresar'] ) )
	{
		if ( $_POST['descinsu'] == "" or $_POST['medida'] == "" or $_POST['costuni'] == ""  )
		{
			$error = 3;
		}
		/*else if ( !ereg("^[0-9]+$",$_POST['clavepartida']) )
		{
			$error = 1;
		}*/
		else
		{
			$sql = "INSERT INTO insumo (descinsu, medida, costuni, partida_id, estado) VALUES ( '{$_POST['descinsu']}', '{$_POST['medida']}','{$_POST['costuni']}', {$_POST['partida_id']}, {$_POST['estado']})";
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
			case 1:		echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los datos del insumo se han almacenado exitosamente!</div>";
						break;
			case 2:		echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los datos del insumo se han modificado exitosamente!</div>";
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
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar números unicamente en la clave de la partida! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
	
							
				case 3: 	echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar datos en todos los campos! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
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
				<legend class="MedianoAzulOscuro"><img src="imagenes/plugin_go.gif"  /> Insumo </legend>
			
        		<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
          			<tr>
            			<td align="right" width="35%" class="MedianoAzulOscuro"><strong> Descripción: </strong></td>
            			<td align="left" width="65%" class="MedianoAzulOscuro"><input size="40" name="descinsu" type="text" /></td>
          			</tr>
          			<tr>
            			<td align="right"class="MedianoAzulOscuro"><strong>Medida:</strong></td>
            			<td align="left" class="MedianoAzulOscuro"><input size="15" name="medida" type="text" /></td>
         			</tr>
					<tr>
            			<td align="right"class="MedianoAzulOscuro"><strong>Costo Unitario:</strong></td>
            			<td align="left" class="MedianoAzulOscuro"><input size="15" name="costuni" type="text" /></td>
         			</tr>
		 			<tr>
                        <td width="35%" align="right" class="MedianoAzulOscuro"><strong>Partida correspondiente: </strong></td>
                        <td width="60%" align="left">
                            <select name="partida_id">
<?php
									$sql = "SELECT * FROM partida ORDER BY clavepartida";
									$res = mysql_db_query ( $bdd, $sql );
									while ( $row = mysql_fetch_assoc($res) )
									{
?>
										<option value="<?php echo $row['id']; ?>" <?php if ( $_POST['partida_id'] == $row['id'] ) { ?> selected="selected" <?php } ?> > 
										
										<?php if ( strlen($row['clavepartida']) > 30 )	//Este if es para comprobar con strlen la 
										{												//longitud de $row['nombreactiv']
										echo substr($row['clavepartida'],0,29)."...";	//Esto es para hacer que un nombre largo
										}												//quede de un tamaño menor
										else											
										{
										echo $row['clavepartida'];
										}
										 ?></option>
<?php
									}
?>
						</select>
						</td>
          			</tr>
          			<tr>
                        <td width="35%" align="right" class="MedianoAzulOscuro"><strong>Estado: </strong></td>
                        <td width="60%" align="left">
                            <select name="estado">
                            	<option value="1">Activo</option>
                            	<option value="0">Inactivo</option>
                          	</select>
						</td>
          			</tr>
           			<tr>
            			<td colspan="3" align="center" class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','../Imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0"  name="dpto"  onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar una Partida')" /></a> <input type="submit" name="ingresar"  value="Ingresar"/>
						</td>
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