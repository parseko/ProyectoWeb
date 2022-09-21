<table width="100%" height="250" align="center">
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/Engrane.gif" />Acciones</legend>

        	<table width="100%" align="center" cellpadding="2" cellspacing="2" class="MedianoAzul">
        		<tr>
                	<td align="center">
                    	<table align="center" class="Poa" >
                        	<tr>
                            	<td class="PoaUnidad" colspan="9"><strong>Programa</strong></td>
                  			</tr>
              				<tr>
                				<td class="PoaTitulo"><strong>Clave</strong></td>
          						<td class="PoaTitulo"><strong>Accion</strong></td>
								
								<td class="PoaTitulo">&nbsp;</td>
                			</tr>
<?php
								$sql_acciones = "SELECT * FROM metas WHERE iddpto = {$_SESSION['dpto_id']} ";
								if ( $res_acciones = mysql_db_query ( $bdd, $sql_acciones ) )
								{
									while ( $row_acciones = mysql_fetch_assoc ( $res_acciones ) )
									{
										$sql_preacciones = "SELECT * FROM preacciones WHERE id='{$row_acciones['idpreacciones']}' ";
										$res_preacciones = mysql_db_query ( $bdd, $sql_preacciones );
										if ( $row_preacciones = mysql_fetch_assoc ( $res_preacciones ) )
										{}
										echo "<tr>";
                                    	echo "<td class='PoaDatos'>{$row_preacciones['claveaccion']}</td>";
										echo "<td class='PoaDatos'>{$row_preacciones['accion']}</td>";
										
										echo "<td class='PoaDatos'>
											<a href='index.php?sec=b&table=metas&id={$row_acciones['idaccion']}'>
											<img src='imagenes/bin_closed.png' border='0'></a></td>";
									}
								}
?>
						</table>                    
					</td>
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
	          			</fieldset>					</td>
          		</tr>
        	</table>
        </fieldset>
		</td>
	</tr>
</table>
