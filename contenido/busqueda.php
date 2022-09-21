<?php

	if ( isset ( $_POST['buscar'] ) )
	{
?>
		<form action="" method="post">
		<table width="100%" height="250" align="center" border="1" cellpadding="2" cellspacing="0">
        	<tr>
<?php
			$res = mysql_db_query($bdd,"SHOW COLUMNS FROM {$_POST['catalogo']}");
			while ( $row = mysql_fetch_array($res) )
			{
				$nombreCampo = $row[0];
				switch ( $row[0] )
				{
					//Acción
					case "nombreAccion": 		$nombreCampo = "Descripcion de la Meta";
														break;
					case "claveAccion":			$nombreCampo = "Clave de la Meta";
														break;
					//PreAcciones
					case "claveaccion": 		$nombreCampo = "Clave";
														break;
					case "accion":			$nombreCampo = "Accion";
														break;
					case "enero":			$nombreCampo = "Enero - Junio";
														break;
					case "julio":			$nombreCampo = "Julio - Diciembre";
														break;
					case "idmeta":			$nombreCampo = "Meta";
														break;
					
					//Actividad
					case "nombreactiv":		$nombreCampo = "Nombre de la Clave";
														break;
					case "claveActiv":			$nombreCampo = "Clave de la CLAVE";
														break;
					//Departamento
					case "nombretitular":		$nombreCampo = "Nombre del Titular";
														break;
					case "puesto":				$nombreCampo = "Puesto";
														break;
					case "nombredpto":		$nombreCampo = "Nombre del Departamento";
														break;
					case "fecnombramiento":	$nombreCampo = "Fecha del Nombramiento";
														break;
					case "profesion":			$nombreCampo = "Profesion";
														break;
					case "estado":				$nombreCampo = "Estado";
														break;
					case "clavedpto":			$nombreCampo = "Clave del Departamento";
														break;
					//Insumos
					case "partida_id":			$nombreCampo = "Partida";
														break;
					case "costuni":				$nombreCampo = "Costo Unitario";
														break;
					//Metas									
					case "unidadmedida_id": $nombreCampo = "Tipo de Unidad";
														break;													
					//Partida
					case "clavepartida":			$nombreCampo = "Clave de la Partida";
														break;
					case "descpartida":			$nombreCampo = "Descripción de la Partida";
														break;
					case "restringidas":			$nombreCampo = "Restringidas";
														break;
					case "estado":				$nombreCampo = "Estado";
														break;
					//Proceso
					case "nombreproceso":	$nombreCampo = "Nombre del Proceso";
														break;
					case "claveproceso":		$nombreCampo = "Clave del Proceso";
														break;
					case "proyecto":				$nombreCampo = "Proyecto";
														break;
					//Subprograma
					case "tipoGasto":			$nombreCampo = "Tipo de Gasto";
														break;
					case "tipoSubpro":			$nombreCampo = "Tipo de Subprograma";
														break;
					case "progdepend":			$nombreCampo = "Programa del que depende";
														break;
					case "clavesub":				$nombreCampo = "Clave del Subprograma";
														break;
					case "montototal":			$nombreCampo = "Monto Total";
														break;
					//Tipo de Solicitud
					case "nombresolicitud":	$nombreCampo = "Nombre de la Solicitud";
														break;
					case "descripcion":			$nombreCampo = "Descripcion";
														break;
					case "estado":				$nombreCampo = "Estado";
														break;
					//Unidad de Medida
					case "tipounidad":			$nombreCampo = "Tipo de Unidad";
														break;
					//Usuario
					case "nombreusuario":	$nombreCampo = "Nombre de Usuario";
														break;
					case "tipousuario":			$nombreCampo = "Tipo de Usuario";
														break;
					case 'dpto_id':				$nombreCampo = "Departamento";
														break;
					case 'clave':					$nombreCampo = "Clave";
														break;
					case "estado":				$nombreCampo = "Estado";
														break;
					case "usuario":				$nombreCampo = "Usuario";
														break;
				}	//Este switch renombra los campos por que los nombres están muy feos :)
				$nombreCampo = strtoupper ($nombreCampo);
				
				if ( !strcmp ( $row[0], "partida_id" ) )
				{
					echo "<td align='center' class='PequenioBlanco' bgcolor='#3E7E97'>{$nombreCampo}</td>";
				}
				else if ( !strcmp ( $row[0], "dpto_id" ) )
				{
					echo "<td align='center' class='PequenioBlanco' bgcolor='#3E7E97'>{$nombreCampo}</td>";
				}
				else if ( !strcmp ( $row[0], "unidadmedida_id" ) and !strcmp ( $_POST['catalogo'], "metas" )  )
				{
					echo "<td align='center' class='PequenioBlanco' bgcolor='#3E7E97'>{$nombreCampo}</td>";
				}
				else if ( !strstr ( $row[0], "id" ) )
				{
					echo "<td align='center' class='PequenioBlanco' bgcolor='#3E7E97'>{$nombreCampo}</td>";
				}
				else if ( !strstr ( $row[0], "_id" ) and ( strlen ( $row[0] ) > 2 ) )
				{
					echo "<td align='center' class='PequenioBlanco' bgcolor='#3E7E97'>{$nombreCampo}</td>";
				}
			}
			
			echo "<td align='center' class='PequenioBlanco' bgcolor='#3E7E97'>MOO</td>";
			echo "<td align='center' class='PequenioBlanco' bgcolor='#3E7E97'>DEL</td>";
			echo "</tr>";
			
			
			if ( $_POST['busqueda'] == 1 )	
			{	
				switch ( $_POST['catalogo'] )
				{
					case 'accion': 		$orden = "claveAccion";
											break;
					case 'actividad':	$orden = "claveActiv";
											break;
					case 'dpto':		$orden = "clavedpto";
											break;
					case 'metas':		$orden = "dpto_id";
											break;
					case 'partida':		$orden = "clavepartida";
											break;
					case 'proceso':		$orden = "claveproceso";
											break;
					case 'usuario':		$orden = "tipousuario";
											break;			
					case 'preacciones':	$orden = "id";
											break;			
				}
				
				$sql = "SELECT * FROM {$_POST['catalogo']} ORDER BY {$orden}";
				if ( !strcmp ( $_POST['catalogo'], "gob_federal" ) )
				{
					$sql = "SELECT {$_POST['catalogo']}.* FROM {$_POST['catalogo']}, dpto, partida WHERE {$_POST['catalogo']}.dpto_id = dpto.id AND {$_POST['catalogo']}.partida_id = partida.id ORDER BY nombredpto, clavepartida";
				}
				else if ( !strcmp ( $_POST['catalogo'], "insumo" ) )
				{
					$sql = "SELECT {$_POST['catalogo']}.* FROM {$_POST['catalogo']}, partida WHERE {$_POST['catalogo']}.partida_id = partida.id ORDER BY clavepartida";
				}
				else if ( !strcmp ( $_POST['catalogo'], "presupuesto" ) )
				{
					$sql = "SELECT {$_POST['catalogo']}.* FROM {$_POST['catalogo']}, dpto WHERE {$_POST['catalogo']}.dpto_id = dpto.id ORDER BY clavedpto";
				}
				else if ( !strcmp ( $_POST['catalogo'], "unidadmedida" ) )
				{
					$sql = "SELECT {$_POST['catalogo']}.* FROM {$_POST['catalogo']}, accion WHERE {$_POST['catalogo']}.accion_id = accion.id ORDER BY claveaccion";
				}
			}
			else
			{
				$res = mysql_db_query($bdd,"SHOW COLUMNS FROM {$_POST['catalogo']}");
				while ( $row = mysql_fetch_array($res) )
				{
					
					if ( !strcmp ( $row[0], "partida_id" ) )
					{
						$sql = "SELECT {$_POST['catalogo']}.* FROM {$_POST['catalogo']},partida WHERE clavepartida LIKE '%{$_POST['pedido']}%' AND {$_POST['catalogo']}.partida_id = partida.id";
						if ( $res_especifico = mysql_db_query ( $bdd, $sql ) )
						{
							if ( $row_especifico = mysql_fetch_array ( $res_especifico ) )
							{
								break;
							}
						}
					}
					else if ( !strcmp ( $row[0], "dpto_id" ) )
					{
						$sql = "SELECT {$_POST['catalogo']}.* FROM {$_POST['catalogo']},dpto WHERE nombredpto LIKE '%{$_POST['pedido']}%' AND {$_POST['catalogo']}.dpto_id = dpto.id";
						if ( $res_especifico = mysql_db_query ( $bdd, $sql ) )
						{
							if ( $row_especifico = mysql_fetch_array ( $res_especifico ) )
							{
								break;
							}
						}
					}
					else if ( !strcmp ( $row[0], "unidadmedida_id" ) and !strcmp ( $_POST['catalogo'], "metas" )  )
					{
						$sql = "SELECT * FROM {$_POST['catalogo']}, unidadmedida WHERE unidadmedida.tipounidad LIKE '%{$_POST['pedido']}%' AND unidadmedida.id = {$_POST['catalogo']}.unidadmedida_id";
						if ( $res_especifico = mysql_db_query ( $bdd, $sql ) )
						{
							if ( $row_especifico = mysql_fetch_array ( $res_especifico ) )
							{
								break;
							}
						}
					}
					else if ( !strstr ( $row[0], "id" ) )
					{
						$sql = "SELECT * FROM {$_POST['catalogo']} WHERE {$row[0]} LIKE '%{$_POST['pedido']}%'";
						if ( $res_especifico = mysql_db_query ( $bdd, $sql ) )
						{
							if ( $row_especifico = mysql_fetch_array ( $res_especifico ) )
							{
								break;
							}
						}

					}
					else if ( !strstr ( $row[0], "_id" ) and ( strlen ( $row[0] ) > 2 ) )
					{
						$sql = "SELECT * FROM {$_POST['catalogo']} WHERE {$row[0]} LIKE '%{$_POST['pedido']}%'";
						if ( $res_especifico = mysql_db_query ( $bdd, $sql ) )
						{
							if ( $row_especifico = mysql_fetch_array ( $res_especifico ) )
							{
								break;
							}
						}

					}
				}
			}
			
			if ( $res = mysql_db_query ( $bdd, $sql ) )
			{
				while ( $row = mysql_fetch_assoc ( $res ) )
				{
					echo "<tr>";
					$res_campos = mysql_db_query($bdd,"SHOW COLUMNS FROM {$_POST['catalogo']}");
					while ( $row_campos = mysql_fetch_array($res_campos) )
					{
						if ( !strcmp ( $row_campos[0], "presupuesto" ) )
						{
							echo "<td align='center' class='PequenioNegro'>\$ ".number_format ( $row[$row_campos[0]],2,'.',',')."</td>";
						}
						else if ( !strcmp ( $row_campos[0], "partida_id" ) )
						{
							$sql_clavepartida = "SELECT clavepartida FROM partida WHERE id = {$row[$row_campos[0]]}";
							$res_clavepartida = mysql_db_query ( $bdd, $sql_clavepartida );
							$row_clavepartida = mysql_fetch_assoc ( $res_clavepartida );
							echo "<td align='center' class='PequenioNegro'>{$row_clavepartida['clavepartida']}</td>";
						}
						else if ( !strcmp ( $row_campos[0], "dpto_id" ) )
						{
							$sql_nombredpto = "SELECT nombredpto FROM dpto WHERE id = {$row[$row_campos[0]]}";
							$res_nombredpto = mysql_db_query ( $bdd, $sql_nombredpto );
							$row_nombredpto = mysql_fetch_assoc ( $res_nombredpto );
							echo "<td align='center' class='PequenioNegro'>{$row_nombredpto['nombredpto']}</td>";
						}
						else if ( !strcmp ( $row_campos[0], "unidadmedida_id" ) and !strcmp ( $_POST['catalogo'], "metas" ) )
						{
							$sql_unidadmedida = "SELECT proceso.claveproceso, actividad.claveActiv, accion.claveAccion, unidadmedida.tipounidad FROM proceso, actividad, accion, unidadmedida WHERE unidadmedida.id = {$row[$row_campos[0]]} AND unidadmedida.accion_id = accion.id AND accion.actividad_id = actividad.id AND actividad.proceso_id = proceso.id";
							$res_unidadmedida = mysql_db_query ( $bdd, $sql_unidadmedida );
							$row_unidadmedida = mysql_fetch_assoc ( $res_unidadmedida ) or die ( mysql_error () );
							echo "<td align='center' class='PequenioNegro'>{$row_unidadmedida['claveproceso']}.{$row_unidadmedida['claveActiv']}.{$row_unidadmedida['claveAccion']} - {$row_unidadmedida['tipounidad']}</td>";
						}
						else if ( !strstr ( $row_campos[0], "id" ) )
						{
							echo "<td align='center' class='PequenioNegro'>{$row[$row_campos[0]]}</td>";
						}
						else if ( !strstr($row_campos[0],"_id") and (strlen($row_campos[0]) > 2) )
						{
							echo "<td align='center' class='PequenioNegro'>{$row[$row_campos[0]]}</td>";
						}
					}
					
					$sql_poa = "SELECT * FROM poa WHERE actual = 1";
					$res_poa = mysql_db_query ( $bdd, $sql_poa );
					$row_poa = mysql_fetch_assoc ( $res_poa );
					
					/*if (  !strcmp ( $_POST['catalogo'], "insumo" ) and ( $row_poa['iniciado'] == 1  or $row_poa['tipo'] == 2 ) )		//Restricción de Insumos
					{
						echo "<td align='center'>&nbsp;</td>";							//Esto evita borrado o modificación al iniciar el ejercicio
						echo "<td align='center'>&nbsp;</td>";
					}
					else if (  !strcmp ( $_POST['catalogo'], "presupuesto")  and ( $row_poa['iniciado'] == 1 or $row_poa['tipo'] == 2 ) )
					{
						echo "<td align='center'><a href='index.php?sec=m&table={$_POST['catalogo']}&id={$row['id']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						echo "<td align='center'>&nbsp;</td>";
					}
					else
					{*/
						echo "<td align='center'><a href='index.php?sec=m&table={$_POST['catalogo']}&id={$row['id']}'><img src='imagenes/pencil.png' border='0'></a></td>";
						echo "<td align='center'><a href='index.php?sec=d&table={$_POST['catalogo']}&id={$row['id']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
					/*}*/
					echo "</tr>";
					
					if ( !strcmp ( $_POST['catalogo'], "metas" ) )
					{
						$sql_consultaMetas = "SELECT * FROM metas WHERE id = {$row['id']}";
						$res_consultaMetas = mysql_db_query ( $bdd, $sql_consultaMetas );
						$row_consultaMetas = mysql_fetch_assoc ( $res_consultaMetas );
						$totalMetas = $row_consultaMetas['enero']+$row_consultaMetas['febrero']+$row_consultaMetas['marzo']+$row_consultaMetas['abril']+$row_consultaMetas['mayo']+$row_consultaMetas['junio']+$row_consultaMetas['julio']+$row_consultaMetas['agosto']+$row_consultaMetas['septiembre']+$row_consultaMetas['octubre']+$row_consultaMetas['noviembre']+$row_consultaMetas['diciembre'];
						echo "<tr>";
						echo "<td align='center' colspan='100%' class='PequenioNegro'>Total: &nbsp;{$totalMetas}</td>";
						echo "</tr>";
					}
				}
			}
				
?>
        </table>
        </form>
<?php
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
				case 1:		echo "<div align = \"center\" class = \"MedianoAlerta\">Debe ingresar la búsqueda específica!<img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
							break;
			}
?>
        </td>
    </tr>
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro">Busquedas</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		<tr>
					<td width="50%" align="right" class="MedianoAzulOscuro"><strong>Cat&aacute;logo:</strong></td>
		            <td width="50%" align="left" class="MedianoAzulOscuro">
        		    	<select name="catalogo">
							<option value="accion">Metas</option>								<!-- claveAccion 		-->
                            <option value="actividad">Claves</option>							<!-- claveActiv 		-->
                            <option value="dpto">Departamentos</option>							<!-- clavedpto 		-->
                            <option value="insumo">Insumos</option>								<!-- clavepartida :S -->
                            <option value="preacciones">Accion</option>									<!-- dpto --> 
                            <option value="partida">Partidas</option>								<!-- clavepartida 	-->
                            <option value="presupuesto">Presupuestos</option>					<!-- clavedpto 	:S -->
                            <option value="proceso">Procesos</option>								<!-- claveproceso	-->
                            <!--<option value="gob_federal">Subsidios</option> -->
                            <!-- <option value="unidadmedida">Unidades de Medida</option> -->	<!-- claveAccion	:S	-->
                            <option value="usuario">Usuarios</option>								<!-- tipousuario		-->
						</select>
					</td>
				</tr>
                <tr>
                	<td width="50%" align="center"><input type="radio" name="busqueda" value="1" checked="checked" /><strong>Completa</strong></td>
                    <td width="50%" align="center"><input type="radio" name="busqueda" value="2" /><strong>Espec&iacute;fica:</strong></td>
                </tr>
                <tr>
                	<td width="50%" align="center">&nbsp;</td>
                    <td width="50%" align="center"><input type="text" name="pedido" /></td>
                </tr>
				<tr>
                	<td width="100%" align="center" colspan="100%"><input type="submit" name="buscar" value="Buscar" /></td>
                </tr>
          		<tr>
            		<td colspan="4"bgcolor="#FFFFFF" class="MedianoAzulOscuro">&nbsp;</td>
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