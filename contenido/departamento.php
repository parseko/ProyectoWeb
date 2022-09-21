<?php
	
	if ( isset ( $_POST['ingresar'] ) )
	{
		if ( $_POST['clavedpto'] == "" or $_POST['nombredpto'] == "" or $_POST['nombretitular'] == "" or $_POST['puesto'] == "" )
		{
			$error = 3;
		}
		else if ( !ereg("^[0-9]+$",$_POST['clavedpto']) )
		{
			$error = 1;
		}
		else
		{
			$sql = "INSERT INTO dpto (nombretitular, puesto, nombredpto, estado, clavedpto) VALUES ( '{$_POST['nombretitular']}', '{$_POST['puesto']}','{$_POST['nombredpto']}', {$_POST['estado']}, {$_POST['clavedpto']} )";
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
			case 1:		echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los datos del departamento se han almacenado exitosamente!</div>";
						break;
			case 2:		echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los datos del departamento se han modificado exitosamente!</div>";
						break;
		}
	}
	else
	{
?>		


<table width="100%" height="250" align="center">
	<tr>
    	<td width="100%" align="center">
<?php
			switch ( $error )
			{
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar números unicamente en la clave del departamento! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 2:		echo "<div align = \"center\" class = \"MedianoAlerta\">La fecha no debe ser futura! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
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
		<td width="100%" align="center"> 
			<fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/application_home.gif"  /> Departamento</legend>

			<form action="" method="post">
                <table width="100%" height="248" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                	<tr>
                    	<td width="47%" height="31" class="MedianoAzulOscuro"><div align="right"><strong> Clave: </strong></div></td>
                    	<td width="53%" class="MedianoAzulOscuro"><input size="15" name="clavedpto" type="text" /></td>
                  	</tr>
                  	<tr>
                    	<td class="MedianoAzulOscuro"><div align="right"><strong> <strong><strong>Nombre del Departamento:</strong></strong></strong></div></td>
                    	<td class="MedianoAzulOscuro"><input size="35" name="nombredpto" type="text" /></td>
                  	</tr>
                  	<tr>
                    	<td class="MedianoAzulOscuro"><div align="right"><strong><strong>Nombre del Titular </strong></strong>:</div></td>
                    	<td class="MedianoAzulOscuro"><input size="35" name="nombretitular" type="text" /></td>
                  	</tr>
                    <tr>
                  		<td class="MedianoAzulOscuro"><div align="right"><strong><strong>Puesto </strong></strong>:</div></td>
                    	<td class="MedianoAzulOscuro"><input size="35" name="puesto" type="text" /></td>
                  	</tr>
                  	<tr>
                        <td width="47%" align="right" class="MedianoAzulOscuro"><strong><strong>Estado: </strong> </strong> </td>
                        <td width="53%" align="left">
							<select name="estado">
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
                    	</td>
                  	</tr>
                 	<tr>
                    	<td colspan="3" align="center"  class="PequenioAzul"><img src="imagenes/Floppyblue.gif" border="0" name="dpto"  onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar un Departamento')" /> <input type="submit" name="ingresar"  value="Ingresar"/>
        				</td>
                  	</tr>
                  	<tr bgcolor="#006699">
                    	<td colspan="4" class="MedianoAzulOscuro">
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
			</form>
        	</fieldset>
		</td>
	</tr>
</table>

<?php

	}
	
?>
