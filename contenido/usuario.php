<?php	
	
	function comboDinamico($nombreCombo, $display, $sql, $baseDeDatos)
	{
		echo "<select name='{$nombreCombo}' onchange='submit()'>";
		echo 	"<option value='0'>[Seleccione una opción]</option>";
	
		$res = mysql_db_query ( $baseDeDatos, $sql );
		while ( $row = mysql_fetch_assoc ( $res ) )
		{
	
			echo "<option value='{$row['id']}'"; if ( $_POST[$nombreCombo] == $row['id'] ) { echo "selected='selected'"; } echo ">";
			if ( strlen ( $row[$display] ) > 20 )	{	echo substr($row[$display], 0, 34)."...";	}
			else									{	echo $row[$display];						}
			echo "</option>";
		}
		echo "</select>";
	}
	
	
	if ( isset ( $_POST['ingresar'] ) )
	{
		$sql_user = "SELECT * FROM usuario WHERE usuario = '{$_POST['usuario']}' ";
		$res_user = mysql_db_query ( $bdd, $sql_user );
		if ( $_POST['nombre'] == "" or $_POST['usuario'] == "" or $_POST['pass'] == "" )
		{
			$error = 3;
		}
		else if ( $row_user = mysql_fetch_assoc ( $res_user ) )
		{
			$error = 1;
		}
		else
		{
			$sql = "INSERT INTO usuario (nombreusuario, tipousuario, dpto_id, clave, estado, usuario) VALUES ( '{$_POST['nombre']}', {$_POST['tipo']}, {$_POST['dpto_id']}, '{$_POST['pass']}', {$_POST['estado']}, '{$_POST['usuario']}' )";
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
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">El usuario se ha almacenado exitosamente!</div>";
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
				case 1: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">El usuario que se ha ingresado ya existe.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 3: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar datos en todos los campos.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 10: 
							echo "<div align = \"center\" class = \"MedianoAlerta\">Error en base de datos.<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
			}
?>
		</td>
    </tr>
	<tr>
		<td width="100%"> 
        	<fieldset    style="border-bottom-color:#0066CC" >
				<legend class="MedianoAzulOscuro"><img src="imagenes/group.gif"  />Usuario</legend>

        		<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
          			<tr>
						<td width="40%" align="right" class="MedianoAzulOscuro"><strong>Tipo de Usuario:</strong></td>
						<td width="60%" align="left">
							<select name="tipo" onchange="submit()">
								<option value="1" <?php if ( $_POST['tipo'] == 1 ) { echo "selected='selected'"; } ?>>Administrador</option>
								<!--<option value="2" <?php if ( $_POST['tipo'] == 2 ) { echo "selected='selected'"; } ?>>Analista</option> -->
								<option value="3" <?php if ( $_POST['tipo'] == 3 ) { echo "selected='selected'"; } ?>>Jefe de Departamento</option>
								<option value="4" <?php if ( $_POST['tipo'] == 4 ) { echo "selected='selected'"; } ?>>Administrador de Gastos</option>

							</select>
						</td>
					</tr>
                    <tr>
						<td width="40%" align="right" class="MedianoAzulOscuro"><strong>Departamento: </strong></td>
						<td width="60%" align="left">
							<select name="dpto_id">
<?php
								if ( $_POST['tipo'] == 3 )
								{
                            		echo "<option value='0'>Seleccione una opción</option>";
									$sql = "SELECT * FROM dpto WHERE estado = 1 ORDER BY clavedpto";
									$res = mysql_db_query ( $bdd, $sql );
									while ( $row = mysql_fetch_assoc ( $res ) )
									{
										echo "<option value='{$row['id']}'>{$row['nombredpto']}</option>";
									}
								}
								else
								{
									echo "<option value='0'>No aplica</option>";
								}
?>
							</select>
						</td>
					</tr>
          			<tr>
            			<td align="right" class="MedianoAzulOscuro"><strong>Nombre del Usuario:</strong></td>
            			<td align="left" class="MedianoAzulOscuro"><input size="35" name="nombre" type="text" /></td>
         			</tr>
		  			<tr>
                        <td align="right" class="MedianoAzulOscuro"><strong>Usuario:</strong></td>
                    	<td align="left" class="MedianoAzulOscuro"><input size="35" name="usuario" type="text" /></td>
					</tr>
                   	<tr>
            			<td align="right" class="MedianoAzulOscuro"><strong>Contraseña:</strong></td>
            			<td align="left" class="MedianoAzulOscuro"><input size="30" name="pass" type="text" /></td>
         			</tr>
          			<tr>
                        <td width="40%" align="right" class="MedianoAzulOscuro"><strong>Estado:</strong></td>
                        <td width="60%" align="left">
							<select name="estado">
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
				  			</select>
						</td>
          			</tr>
         			<tr>
            			<td colspan="3" align="center"  class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','../Imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0"  name="dpto"  onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar un Usuario')" /></a> <input type="submit" name="ingresar"  value="Ingresar"/>
						</td>
		  			</tr>
          			<tr>
            			<td colspan="4"  class="MedianoAzulOscuro">&nbsp;</td>
          			</tr>
          			<tr>
            			<td colspan="4" bgcolor="#FFFFFF" class="MedianoAzulOscuro">
							<fieldset style="background-color:#006699">
				            <table width="100%" height="30">
						    	<tr>
							    	<td align="center">&nbsp;</td>
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