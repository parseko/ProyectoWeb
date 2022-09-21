<table width="100%" height="250" align="center">
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/book_open.png" /> Historial</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		<tr>
					<td width="30%" align="right" class="MedianoAzulOscuro"><strong>Reporte:</strong></td>
		            <td align="left" class="MedianoAzulOscuro">
                    	<form action="" method="post">
                            <select name="poa" onChange="submit()">
                                <option>[Seleccione un ejercicio presupuestal]</option>
    <?php
                                $sql_ejercicio = "SELECT * FROM poa WHERE actual = 0 ORDER BY anio, tipo";
                                $res_ejercicio = mysql_db_query ( $bdd, $sql_ejercicio );
                                while ( $row_ejercicio = mysql_fetch_assoc ( $res_ejercicio ) )
                                {
                                    switch ( $row_ejercicio['tipo'] )
                                    {
                                        case 1:	$ejercicio = "POA ".$row_ejercicio['anio'];
                                                    break;
                                        case 2:	$ejercicio = "REPOA ".$row_ejercicio['anio'];
                                                    break;
                                    }
                                    echo "<option value='{$row_ejercicio['id']}'>{$ejercicio}</option>";
                                }
    ?>
                            </select>
						</form>
					</td>
				</tr>
                <tr>
          			<td colspan="3">&nbsp;</td>
		  		</tr>
<?php
				if ( isset ( $_POST['poa'] ) )
				{
					$sql_reportes = "SELECT * FROM poa WHERE id = {$_POST['poa']}";
					$res_reportes = mysql_db_query ( $bdd, $sql_reportes );
					$row_reportes = mysql_fetch_assoc ( $res_reportes );
					switch ( $row_reportes['tipo'] )
					{
						case 1:	$ejercicio2 = "POA ".$row_reportes['anio'];
									break;
						case 2:	$ejercicio2 = "REPOA ".$row_reportes['anio'];
									break;
					}
?>
				<form action="historial/seleccion.php" method="post" target="_blank">
				<tr>
          			<td colspan="3" align="center"  class="PequenioAzul"><?php echo $ejercicio2; ?><br />
                    	<select name="reporte">
 				<?php		if ( $row_reportes['tipo']  == 1 )
							{
								echo "<option value='1'>DESGLOCE DEL PRESUPUESTO</option>";
							}
				?>
							<option value="3.2">DESGLOCE DE PRESUPUESTO DE INVERSION</option>
                            <option value="4.7">CONCENTRADO DEL ANTEPROYECTO</option>
                            <option value="4">CONCENTRADO DE PARTIDA PRESUPUESTAL</option>
                <?php		if ( $row_reportes['tipo']  == 1 )
							{
								echo "<option value='6'>PRESUPUESTO CONCENTRADO POR PROCESO</option>";
								echo "<option value='7'>POA POR DEPARTAMENTO</option>";
							}
							else
							{
								echo "<option value='5'>PRESUPUESTO ANALÍTICO POR PROCESO</option>";
								echo "<option value='7'>REPOA POR DEPARTAMENTO</option>";
							}
				?>            
						</select>
                    </td>
		  		</tr>
				<tr>
          			<td colspan="3" align="center" class="PequenioAzul"><input type="submit" name="generar" value="Generar Reporte"/></td>
		  		</tr>
                <input type="hidden" name="ID" value="<?php echo $_POST['poa']; ?>" />
<?php
				}
?>
				</form>
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
	          			</fieldset>
					</td>
          		</tr>
        	</table>
        </fieldset>
		</td>
	</tr>
</table>
