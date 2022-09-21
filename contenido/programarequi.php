<table width="100%" height="250" align="center">
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Programa Operativo Anual - Solicitudes</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		<tr>
                	<td align="center">
                    	<table class="Poa" align="center">
                        	<tr>
                            	<td class="PoaTitulo" colspan="3"><strong>Programa</strong></td>
    							<td width="300" class="PoaTitulo" rowspan="2"><strong>Acciones</strong></td>
                  			</tr>
              				<tr>
                				<td class="PoaTitulo"><strong>Proceso</strong></td>
          						<td class="PoaTitulo"><strong>Clave</strong></td>
            					<td class="PoaTitulo"><strong>Meta</strong></td>
                			</tr>
								<?php
								$sql_poa = "SELECT * FROM poa WHERE actual = 1";
								$res_poa = mysql_db_query ( $bdd, $sql_poa );
								if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
								{}
								$sql_metas = "SELECT * FROM metas WHERE iddpto = {$_SESSION['dpto_id']} and idpoa = {$row_poa['id']}";
								$res_metas = mysql_db_query ( $bdd, $sql_metas ); 
								while ( $row_metas = mysql_fetch_assoc ( $res_metas ) )
								{
									//echo $row_metas['idmeta'];
									$sql_meta = "SELECT * FROM accion WHERE id = {$row_metas['idmeta']}";
									$res_meta = mysql_db_query ( $bdd, $sql_meta );
									if ( $row_meta = mysql_fetch_assoc ( $res_meta ) )
									{
										//echo $row_meta['claveAccion'];
									}
									$sql_clave = "SELECT * FROM actividad WHERE id = '{$row_meta['actividad_id']}'";
									$res_clave = mysql_db_query ( $bdd, $sql_clave );
									if ( $row_clave = mysql_fetch_assoc ( $res_clave ) )
									{
										//echo $row_clave['claveActiv'];
									}
									$sql_proceso = "SELECT * FROM proceso WHERE id = '{$row_clave['proceso_id']}'";
									$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
									if ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
									{}
									$sql_meta1 = "SELECT * FROM preacciones WHERE id='{$row_metas['idpreacciones']}'";
									$res_meta1= mysql_db_query ( $bdd, $sql_meta1 );
									if ( $row_meta1 = mysql_fetch_assoc ( $res_meta1 ) )
									{}

									//echo $row_metas['idaccion'];
									echo "<tr>";
									echo "<td class='PoaDatos'>{$row_proceso['claveproceso']}</td>";
									echo "<td class='PoaDatos'>{$row_clave['claveActiv']}</td>";
									echo "<td class='PoaDatos'>{$row_meta['claveAccion']}</td>";
                                   	echo "<td align='center' bgcolor='#FFFFFF' class='Menu2'><a class='PequenioAzulOscuro' href='index.php?sec=11&dpto={$_SESSION['dpto_id']}&Acciones={$row_meta['id']}&Accion={$row_metas['idaccion']}&Proceso={$row_proceso['id']}&Clave={$row_clave['id']}'>{$row_meta1['accion']}</a></td>";
                                	echo "</tr>";
								}
								?>
						</table>
                    </td>
                </tr>		
				<tr>
            		<td align="center" class="MedianoAzulOscuro">&nbsp;</td>
          		</tr>
                <tr>
            		<td align="center" class="MedianoAzulOscuro">&nbsp;</td>
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