<?php									
	
	if ( isset ( $_POST['ingresar'] ) )		//Esto es para cuando se va a guardar un registro nuevo
	{
		if ( $_POST['presupuesto'] == ""  )
		{
			$error = 3;
		}
		else if ( !ereg("^[0-9]+\.[0-9]{2}$",$_POST['presupuesto']) )
		{
			$error = 1;
		}
		else
		{
			$sql = "INSERT INTO presupuesto (dpto_id, presupuesto) VALUES ( {$_POST['dpto_id']}, {$_POST['presupuesto']})";
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
			case 1:
					echo "<div align = \"center\" class = \"MedianoExitoAzul\">El presupuesto se ha almacenado exitosamente!</div>";
					break;
			case 2:
					echo "<div align = \"center\" class = \"MedianoExitoAzul\">El presupuesto se ha modificado exitosamente!</div>";
					break;
		}
	}
	//else
	//{
?>		

<form action="" method="post">
<table width="100%" height="250" align="center">
	<tr>
    	<td align="center" width="100%">
<?php
			switch ( $error )
			{
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar el presupuesto con dos decimales.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
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
			<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Presupuesto</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		<tr>
					<td width="35%" align="right" class="MedianoAzulOscuro"><strong>Departamento:</strong></td>
		            <td class="MedianoAzulOscuro">
        		    	<select name="dpto_id" onchange="submit()">
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
            		<td align="right"class="MedianoAzulOscuro" width="35%"><strong>Presupuesto:</strong></td>
            		<td class="MedianoAzulOscuro"><input size="25" name="presupuesto" type="text" /></td>
				</tr>
				
				<tr>
          			<td colspan="3" align="center"  class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','Imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0"  name="dpto"  onmouseover="this.T_WIDTH=100; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Registro de una acción')" /></a> 
                    
<?php
					if ( isset ( $_POST['dpto_id'] ) )
					{
						$sql_dpto = "SELECT * FROM presupuesto WHERE dpto_id = {$_POST['dpto_id']}";
						if ( $res_dpto = mysql_db_query ( $bdd, $sql_dpto ) )
						{
							if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
							{
								if ( !isset ( $_POST['ingresar'] ) )
								{
									echo "<div align = \"center\" class = \"MedianoAlerta\">El departamento seleccionado<br />ya tiene un presupuesto asignado.</div>";
								}
							}
							else if ( $_POST['dpto_id'] == 0 )
							{
								echo "<div align = \"center\" class = \"MedianoAlerta\">Debe seleccionar un Departamento<br />para ingresar un presupuesto.</div>";
							}
							else
							{
								echo "<input type='submit' name='ingresar'  value='Ingresar' />";
							}
						}
						else
						{
							echo "<input type='submit' name='ingresar'  value='Ingresar' />";
						}
					}
					
?>                   
					</td>
		  		</tr>
          		<tr>
            		<td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
          		</tr>
                <tr>
                	<td align="center" colspan="4">
                    
                    	<table  align="center"  border="1" cellspacing="0" cellpadding="2">
                                <tr>
                                    <td bgcolor="#006699" class="MedianoBlanco"><strong>Departamento</strong></td>
                                    <td bgcolor="#006699" class="MedianoBlanco"><strong>Presupuesto</strong></td>
                                </tr>
                                
<?php
								$total = 0;
								$sql_dptos = "SELECT * FROM dpto ORDER BY  clavedpto";
								$res_dptos = mysql_db_query ( $bdd, $sql_dptos );
								while ( $row_dptos = mysql_fetch_assoc ( $res_dptos ) )
								{
									$sql_pre = "SELECT * FROM presupuesto WHERE dpto_id = {$row_dptos['id']}";
									$res_pre = mysql_db_query ( $bdd, $sql_pre );
									if ( $row_pre = mysql_fetch_assoc ( $res_pre ) )
									{
										$total += $row_pre['presupuesto'];
										echo "<tr>";
                                    	echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_dptos['nombredpto']}</td>";
                                    	echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>\$ ".number_format ($row_pre['presupuesto'],2,'.',',')."</td>";
                                		echo "</tr>";
									}
									else
									{
										echo "<tr>";
                                    	echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>{$row_dptos['nombredpto']}</td>";
                                    	echo "<td bgcolor='#FFFFFF' class='PequenioAlerta'>No asignado</td>";
                                		echo "</tr>";
									}
								}
								echo "<tr>";
                                echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'><strong>Total</strong></td>";
                                echo "<td bgcolor='#FFFFFF' class='PequenioAzulOscuro'>\$ ".number_format ($total,2,'.',',')."</td>";
                                echo "</tr>";
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

	//}
?>
