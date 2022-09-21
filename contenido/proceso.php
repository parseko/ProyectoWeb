<?php	
    if ( isset ( $_POST['ingresar'] ) )
	{
		if ( $_POST['nombreproceso'] == "" or $_POST['claveproceso'] == "" or $_POST['proyecto'] == "" )
		{
			$error = 3;
		}
		else if ( ( strlen ( $_POST['claveproceso'] ) < 2 ) or ( strlen ( $_POST['proyecto'] ) < 12 ) )
		{
			$error = 1;
		}
		/*else if ( !ereg("^[0-9]+$",$_POST['claveproceso']) or !ereg("^[0-9]+$",$_POST['proyecto']) )
		{
			$error = 2;
		}*/
		else
		{
			$sql = "INSERT INTO proceso (nombreproceso, claveproceso, proyecto) VALUES ( '{$_POST['nombreproceso']}', '{$_POST['claveproceso']}', '{$_POST['proyecto']}' )";
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
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">El proceso se ha almacenado exitosamente!</div>";
						break;
			case 2:
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">El proceso se ha modificado exitosamente!</div>";
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
				case 1:
							echo "<div align = \"center\" class = \"MedianoAlerta\">La clave de proceso y el proyecto deben estar completos!<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
				case 2:
							echo "<div align = \"center\" class = \"MedianoAlerta\">La clave de proceso y el proyecto deben ser numéricos!<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
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
        <fieldset    style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/Options.gif" width="40" height="40"  />Proceso</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
            	<tr>
            		<td align="right" class="MedianoAzulOscuro"><strong>Nombre:</strong></td>
            		<td align="left" class="MedianoAzulOscuro"><input size="35" name="nombreproceso" type="text" /></td>
         		</tr>
		  		<tr>
            		<td align="right" class="MedianoAzulOscuro"><strong>Proyecto:</strong></td>
            		<td align="left" class="MedianoAzulOscuro"><input size="35" name="proyecto" type="text" maxlength="12" /></td>
         		</tr>
       			<tr>
					<td width="40%" align="right" class="MedianoAzulOscuro"><strong><strong>Clave: </strong> </strong> </td>
					<td width="60%" align="left"> <input size="8" name="claveproceso" type="text" maxlength="2" /></td>
          		</tr>
         		<tr>
            		<td colspan="3" align="center" class="PequenioAzul"><a target="mainFrame" class="MedianoAzulOscuro" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('dpto','','../Imagenes/Floppyblue_dis.gif',1);"><img src="imagenes/Floppyblue.gif" border="0"  name="dpto"  onmouseover="this.T_WIDTH=120; this.T_OPACITY=75; this.T_FONTFACE='verdana'; return escape('Ingresar Proceso')" /></a> <input type="submit" name="ingresar"  value="Ingresar"/>
					</td>
		  		</tr>
          		<tr>
            		<td colspan="4"  class="MedianoAzulOscuro">&nbsp;</td>
          		</tr>
          		<tr>
            		<td  colspan="4" bgcolor="#006699" class="MedianoAzulOscuro">
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