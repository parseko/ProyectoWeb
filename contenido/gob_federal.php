<?php									
		
	if ( isset ( $_POST['ingresar'] ) )		//Esto es para cuando se va a guardar un registro nuevo
	{
		$sql = "SELECT * FROM gob_federal WHERE dpto_id ={$_POST['dpto_id']} AND unidadmedida_id ={$_POST['unidadmedida']} AND partida_id = {$_POST['partida_id']}";
		$res = mysql_db_query ( $bdd, $sql );
		if ( $_POST['dpto_id'] == 0 or $_POST['unidadmedida'] == 0 or $_POST['partida_id'] == 0 or $_POST['presupuesto'] == "" )
		{
			$error = 1;
		}
		else if ( !ereg("^[0-9]+\.[0-9]{2}$",$_POST['presupuesto']) )
		{
			$error = 2;
		}
		else if ( $row = mysql_fetch_assoc ( $res ) )
		{
			$error = 4;
		}
		else
		{
			$sql = "INSERT INTO gob_federal (dpto_id, unidadmedida_id, partida_id, presupuesto ) VALUES ( {$_POST['dpto_id']}, {$_POST['unidadmedida']}, {$_POST['partida_id']}, {$_POST['presupuesto']} )";
			if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
			{
				$mensaje = 1;
			}
			else
			{
				$error = 3;
			}
		}
	}
			
	if ( isset ( $mensaje ) )
	{
		switch ( $mensaje )
		{
			case 1:
					echo "<div align = \"center\" class = \"MedianoExitoAzul\">El subsidio se ha almacenado exitosamente!</div>";
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
			switch ( $error )
			{
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar datos en todos los campos.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 2: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar unicamente números con dos decimales en el presupuesto.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 3: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">Error en base de datos, intente de nuevo más tarde.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 4: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">El departamento seleccionado ya tiene subsidio asignado en ese proyecto.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
			}
?>
        </td>
    </tr>
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Gobierno Federal</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		<tr>
					<td width="35%" align="right" class="MedianoAzulOscuro"><strong>Departamento:</strong></td>
		            <td align="left" class="MedianoAzulOscuro">
        		    	<select name="dpto_id">
                        			<option value="0">[Seleccione un Departamento]</option>
<?php
									$sql = "SELECT * FROM dpto ORDER BY clavedpto";
									$res = mysql_db_query ( $bdd, $sql );
									while ( $row = mysql_fetch_assoc($res) )
									{
?>
										<option value="<?php echo $row['id']; ?>" <?php if ( $_POST['dpto_id'] == $row['id'] or $get['dpto_id']== $row['id'] ) { ?> selected="selected" <?php } ?> > <?php echo $row['nombredpto']; ?></option>
<?php
										
									
									}
?>
						</select>
					</td>
				</tr>
                <tr>
                	<td width="35%" align="right" class="MedianoAzulOscuro"><strong>Proyecto:</strong></td>
                	<td align="left" class="MedianoAzulOscuro">
                    	<select name="unidadmedida">
                   			<option value="0">[Seleccione una opción]</option>
<?php
				$sql_proyecto = "SELECT proceso.proyecto, proceso.claveproceso, actividad.claveActiv, accion.claveaccion, unidadmedida.id AS unidad_id, unidadmedida.tipounidad FROM proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id";
				$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
				while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
				{
?>
										<option value="<?php echo $row_proyecto['unidad_id']; ?>" <?php if ( $_POST['unidadmedida'] == $row_proyecto['unidad_id'] ) { ?> selected="selected" <?php } ?> > <?php echo $row_proyecto['proyecto'].$row_proyecto['claveproceso'].".".$row_proyecto['claveActiv'].".".$row_proyecto['claveaccion']." - ".$row_proyecto['tipounidad']; ?></option>
<?php
				}
?>
						</select>
					</td>
				</tr>
				<tr>
            		<td align="right"class="MedianoAzulOscuro" width="35%"><strong>Partida:</strong></td>
            		<td align="left" class="MedianoAzulOscuro">
                    	<select name="partida_id">
                        	<option value="0">[Seleccione una Partida]</option>
<?php
									$sql = "SELECT * FROM partida ORDER BY clavepartida";
									$res = mysql_db_query ( $bdd, $sql );
									while ( $row = mysql_fetch_assoc($res) )
									{
?>
										<option value="<?php echo $row['id']; ?>" <?php if ( $_POST['partida_id'] == $row['id'] or $get['partida_id']== $row['id'] ) { ?> selected="selected" <?php } ?> > <?php echo $row['clavepartida']; ?></option>
<?php
										
									
									}
?>
						</select>
						</td>
				</tr>
				
				<tr>
            		<td align="right"class="MedianoAzulOscuro" width="35%"><strong>Presupuesto:</strong></td>
            		<td align="left" class="MedianoAzulOscuro"><input size="25" name="presupuesto" type="text" /></td>
				</tr>
				
				<tr>
          			<td colspan="3" align="center"  class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','../Imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0"  name="dpto"  onmouseover="this.T_WIDTH=100; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Registro de una acción')" /></a> <input type='submit' name='ingresar'  value='Ingresar' />    
					</td>
		  		</tr>
          		<tr>
            		<td colspan="4">&nbsp;</td>
          		</tr>
                <tr>
                	<td colspan="4">
                    	<table  align="center"  border="1" cellspacing="0" cellpadding="2">
                       		<tr>
                            	<td bgcolor="#006699" class="PequenioBlanco"><strong>Proyecto</strong></td>
                                <td bgcolor="#006699" class="PequenioBlanco"><strong>Actividad</strong></td>
                                <td bgcolor="#006699" class="PequenioBlanco"><strong>Accion</strong></td>
                                <td bgcolor="#006699" class="PequenioBlanco"><strong>Unidad de Medida</strong></td>
                                <td bgcolor="#006699" class="PequenioBlanco"><strong>Departamento</strong></td>
                                <td bgcolor="#006699" class="PequenioBlanco"><strong>Partida</strong></td>
                                <td bgcolor="#006699" class="PequenioBlanco"><strong>Subsidio</strong></td>
                  			</tr>
                                
<?php
								$sql_proyecto = "SELECT proceso.proyecto, proceso.claveproceso, actividad.claveActiv, accion.claveAccion, unidadmedida.id AS unidadmedida_id, unidadmedida.tipounidad FROM proceso, actividad, accion, unidadmedida WHERE unidadmedida.accion_id = accion.id AND accion.actividad_id = actividad.id AND actividad.proceso_id = proceso.id";
								$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
								while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
								{
									$sql_subsidio = "SELECT gob_federal.* FROM gob_federal, dpto, partida WHERE gob_federal.dpto_id = dpto.id AND gob_federal.partida_id = partida.id AND gob_federal.unidadmedida_id = {$row_proyecto['unidadmedida_id']} ORDER BY nombredpto, clavepartida";
									$res_subsidio = mysql_db_query ( $bdd, $sql_subsidio );
									while ( $row_subsidio = mysql_fetch_assoc ( $res_subsidio ) )
									{
										$sql = "SELECT * FROM dpto WHERE id = {$row_subsidio['dpto_id']}";
										$res = mysql_db_query ( $bdd, $sql );
										$row_dpto = mysql_fetch_assoc ( $res );
									
										$sql = "SELECT * FROM partida WHERE id = {$row_subsidio['partida_id']}";
										$res = mysql_db_query ( $bdd, $sql );
										$row_partida = mysql_fetch_assoc ( $res );
										
										echo "<tr>";
										echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_proyecto['proyecto']}{$row_proyecto['claveproceso']}</td>";
										echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_proyecto['claveActiv']}</td>";
										echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_proyecto['claveAccion']}</td>";
										echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_proyecto['tipounidad']}</td>";
										echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_dpto['nombredpto']}</td>";
										echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_partida['clavepartida']}</td>";
										echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>\$".number_format ( $row_subsidio['presupuesto'], 2,'.',',' )."</td>";
                                		echo "</tr>";
									}
								}
?>
						</table>
                    </td>
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
