<?php
	if ( isset ( $_POST['claves'] ) )
	{
		if ( $_POST['revision'] == "" or $_POST['tec'] == "" or $_POST['snest'] == "")
		{
			$error = 1;
		}
		else
		{
			$sql = "TRUNCATE TABLE revision_reportes";
			$res = mysql_db_query ( $bdd, $sql ) or die ( mysql_error() );
			
			$sql = "INSERT INTO revision_reportes (revision, tec, clavetec, snest, snest1, snest2, snest3) VALUES ( '{$_POST['revision']}', '{$_POST['tec']}', '{$_POST['clavetec']}', '{$_POST['snest']}', '{$_POST['snest2']}', '{$_POST['snest3']}', '{$_POST['snest4']}')";
			$res = mysql_db_query ( $bdd, $sql ) or die( mysql_error () );
			$mensaje = 2;
		}
	}
	
	if ( isset ( $_POST['directivos'] ) )
	{
		if ( $_POST['director'] == "" or $_POST['general'] == "" or $_POST['rfc_director'] == "" or $_POST['rfc_general'] == "" )
		{
			$error = 1;
		}
		else
		{
			$sql = "TRUNCATE TABLE firmas_reportes";
			$res = mysql_db_query ( $bdd, $sql ) or die ( mysql_error());
			
			$sql = "INSERT INTO firmas_reportes ( nombre_director, nombre_general, rfc_director, rfc_general, nombre_subplanea, nombre_subaca, nombre_subadmon ) VALUES ( '{$_POST['director']}', '{$_POST['general']}', '{$_POST['rfc_director']}', '{$_POST['rfc_general']}', '{$_POST['Planeacion']}', '{$_POST['Academico']}', '{$_POST['Administrativa']}' )";
			$res = mysql_db_query ( $bdd, $sql ) or die ( mysql_error());
			$mensaje = 1;
		}
	}
	
	$sql_directivos = "SELECT * FROM firmas_reportes";
	$res_directivos = mysql_db_query ( $bdd, $sql_directivos );
	if (!$row_directivos = mysql_fetch_assoc ( $res_directivos ))
	{
		$error = 2;
	}
	
	$sql_revision = "SELECT * FROM revision_reportes";
	$res_revision = mysql_db_query ( $bdd, $sql_revision );
	if (!$row_revision = mysql_fetch_assoc ( $res_revision ))
	{
		$error = 3;
	}
?>

<table width="100%" height="250" align="center">
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/book_open.png" /> Datos de Reportes</legend>

       	    <table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
              <form action="" method="post">
                <tr>
                  <td align="center" colspan="2"><?php
                if ( isset ( $error) )
				{
					switch ( $error )
					{
						case 1:
									echo "<div align = \"center\" class = \"MedianoAlerta\">No se deben dejar espacios vacios</div>";
									break;
						case 2:
									echo "<div align = \"center\" class = \"MedianoAlerta\">No se han capturado directivos</div>";
									break;
						case 3:
									echo "<div align = \"center\" class = \"MedianoAlerta\">No se han capturado las claves</div>";
									break;
					}
				}
?>                  </td>
                </tr>
                <tr>
                  <td align="center" colspan="2"><?php
                if ( isset ( $mensaje ) )
				{
					switch ( $mensaje )
					{
						case 2:
									echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los datos de revisión y claves se han almacenado exitosamente</div>";
									break;
					}
				}
?>                  </td>
                </tr>
                <tr>
                  <td align="center" class="MedianoAzulOscuro" colspan="2"><strong>Clave de Reportes</strong></td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Tecnol&oacute;gico:</strong></td>
                  <td width="50%" align="left" class="MedianoAzulOscuro"><input name="tec" type="text"  value="<?php echo $row_revision['tec']; ?>" /></td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Clave Tecnol&oacute;gico:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input name="clavetec" type="text"  value="<?php echo $row_revision['clavetec']; ?>" /></td>
                </tr>
                <tr>
                  <td width="50%" align="right" class="MedianoAzulOscuro"><strong> Clave del SNEST 01:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input name="snest" type="text"  value="<?php echo $row_revision['snest']; ?>" /></td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Clave del SNEST 02:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input name="snest2" type="text"  value="<?php echo $row_revision['snest1']; ?>" /></td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Clave del SNEST 03:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input name="snest3" type="text"  value="<?php echo $row_revision['snest2']; ?>" /></td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Clave del SNEST 04:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input name="snest4" type="text"  value="<?php echo $row_revision['snest3']; ?>" /></td>
                </tr>
                <tr>
                  <td width="50%" align="right" class="MedianoAzulOscuro"><strong>Revision:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input name="revision" type="text"  value="<?php echo $row_revision['revision']; ?>" />                  </td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" align="center"  class="PequenioAzul"><input type="submit" name="claves"  value="Guardar Claves"/>                  </td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
              </form>
       	      <form action="" method="post">
                <tr>
                  <td align="center" class="MedianoAzulOscuro" colspan="2"><strong>Directivos</strong></td>
                </tr>
                <tr>
                  <td align="center" colspan="2"><?php
                if ( isset ( $mensaje ) )
				{
					switch ( $mensaje )
					{
						case 1:
									echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los directivos se han actualizado exitosamente</div>";
									break;
					}
				}
?>                  </td>
                </tr>
                <tr>
                  <td width="50%" align="right" class="MedianoAzulOscuro"><strong>Director:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input type="text" name="director" value="<?php echo $row_directivos['nombre_director']; ?>" />                  </td>
                </tr>
                <tr>
                  <td width="50%" align="right" class="MedianoAzulOscuro"><strong>RFC Director:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input type="text" name="rfc_director" value="<?php echo $row_directivos['rfc_director']; ?>" />                  </td>
                </tr>
                <tr>
                  <td width="50%" align="right" class="MedianoAzulOscuro"><strong>Director General:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input type="text" name="general" value="<?php echo $row_directivos['nombre_general']; ?>" />                  </td>
                </tr>
                <tr>
                  <td width="50%" align="right" class="MedianoAzulOscuro"><strong>RFC Director General:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input type="text" name="rfc_general" value="<?php echo $row_directivos['rfc_general']; ?>" />                  </td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Subdirector de Planeacion:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input type="text" name="Planeacion" value="<?php echo $row_directivos['nombre_subplanea']; ?>" /></td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Subdirector Academico:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input type="text" name="Academico" value="<?php echo $row_directivos['nombre_subaca']; ?>" /></td>
                </tr>
                <tr>
                  <td align="right" class="MedianoAzulOscuro"><strong>Subdirector de Servicios Administrativos:</strong></td>
                  <td align="left" class="MedianoAzulOscuro"><input type="text" name="Administrativa" value="<?php echo $row_directivos['nombre_subadmon']; ?>" /></td>
                </tr>
                <tr>
                  <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" align="center"  class="PequenioAzul"><input type="submit" name="directivos"  value="Guardar Directivos"/>                  </td>
                </tr>
              </form>
       	      <tr>
                <td colspan="4" class="MedianoAzulOscuro">&nbsp;</td>
   	          </tr>
              <tr>
                <td  colspan="4" bgcolor="#006699" class="MedianoAzulOscuro"><fieldset style="background-color:#006699">
                  <table width="100%" height="30">
                    <tr>
                      <td align="center" height="35">&nbsp;</td>
                    </tr>
                  </table>
                </fieldset></td>
              </tr>
            </table>
        </fieldset>		</td>
	</tr>
</table>
</form>
