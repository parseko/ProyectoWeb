<?php									
	
	if ( isset ( $_POST['ingresar'] ) )		//Esto es para cuando se va a guardar un registro nuevo
	{
		if ( $_POST['nombreAccion'] == "" or $_POST['claveAccion'] == "" )
		{
			$error = 3;
		}
		else if ( !preg_match("^[0-9]+$",$_POST['claveAccion']) )
		{
			$error = 1;
		}
		else
		{
			$sql_poa = "SELECT * FROM poa WHERE actual = 1";
			$res_poa = mysqli_query ( $conexion, $sql_poa );
			if ( $row_poa = mysqli_fetch_assoc ( $res_poa ) )
			{}
			$sql = "INSERT INTO accion (actividad_id, nombreAccion, claveAccion, unidad, cantidad, idpoa) VALUES ( {$_POST['actividad_id']}, '{$_POST['nombreAccion']}', {$_POST['claveAccion']}, '{$_POST['unidad']}', '{$_POST['cantidad']}', '{$row_poa['id']}' )";
			if ( $res = mysqli_query($conexion,$sql) or die(mysqli_error($conexion)) )
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
					echo "<div align = \"center\" class = \"MedianoExitoAzul\">La acci�n se ha almacenado exitosamente!</div>";
					break;
			case 2:
					echo "<div align = \"center\" class = \"MedianoExitoAzul\">La acci�n se ha modificado exitosamente!</div>";
					break;
		}
	}
	else
	{
?>		

<form action="" method="post">
<table width="100%" height="250" align="center">
	<tr>
    	<td align="center" width="100%">
<?php
			switch ( !empty($error) )
			{
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar n�meros unicamente en la clave de la acci�n! <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
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
			<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Metas</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		<tr>
					<td width="35%" align="right" class="MedianoAzulOscuro"><strong>Clave:</strong></td>
		            <td class="MedianoAzulOscuro">
        		    	<select name="actividad_id">
<?php
									$sql = "SELECT * FROM actividad ORDER BY claveActiv";
									$res = mysqli_query ( $conexion, $sql );
									while ( $row = mysqli_fetch_assoc($res) )
									{
?>
										<option value="<?php echo $row['id']; ?>" <?php if ( isset($_POST['actividad_id']) == $row['id'] or !empty($get['actividad_id'])== $row['id'] ) { ?> selected="selected" <?php } ?> > 
										
										<?php if ( strlen($row['nombreactiv']) > 30 )	//Este if es para comprobar con strlen la 
										{												//longitud de $row['nombreactiv']
										echo substr($row['nombreactiv'],0,29)."...";	//Esto es para hacer que un nombre largo
										}												//quede de un tama�o menor
										else											
										{
										echo $row['nombreactiv'];
										}
										 ?></option>
<?php
									}
?>
						</select>					</td>
				</tr>
				<tr>
            		<td align="right"class="MedianoAzulOscuro" width="35%"><strong>Nombre de la Meta:</strong></td>
            		<td class="MedianoAzulOscuro"><input size="35" name="nombreAccion" type="text" /></td>
				</tr>
				<tr>
				  <td align="right"class="MedianoAzulOscuro"><strong>Unidad de Medida:</strong></td>
				  <td class="MedianoAzulOscuro"><input name="unidad" type="text" id="unidad" size="20" /></td>
			  </tr>
				<tr>
				  <td align="right"class="MedianoAzulOscuro"><strong>Cantidad:</strong></td>
				  <td class="MedianoAzulOscuro"><input name="cantidad" type="text" id="cantidad" size="8" /></td>
			  </tr>
				<tr>
					<td width="40%" align="right" class="MedianoAzulOscuro"><strong>Clave Meta: </strong> </td>
					<td width="60%" align="left"><input size="8" name="claveAccion" type="text" />			</td>
				</tr>
				<tr>
          			<td colspan="3" align="center"  class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','../Imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0"  name="dpto"  onmouseover="this.T_WIDTH=100; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Registro de una acci�n')" /></a> <input type="submit" name="ingresar"  value="Ingresar"/>					</td>
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
	          			</fieldset>					</td>
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
