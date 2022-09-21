<form action="reportes/selecciondepto.php" method="post" target="_blank">
<table width="100%" height="250" align="center">
	<tr>
		<td align="center" width="100%"> 
        <fieldset style="border-bottom-color:#0066CC" >
			<legend class="MedianoAzulOscuro"><img src="imagenes/book_open.png" /> Reportes</legend>

        	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
        		<tr>
					<td width="20%" align="right" class="MedianoAzulOscuro"><strong>Reporte:</strong></td>
		            <td align="left" class="MedianoAzulOscuro">
        		    	<select name="reporte">
 							<option value="1">CONCENTRADO POR PARTIDA PRESUPUESTAL Y PROCESO ESTRATEGICO</option>
                            <option value="2">CONCENTRADO POR PROCESO CLAVE Y ESTRATEGICO</option>
                            <option value="3">DESGLOSE DE METAS POR  PROCESO CLAVE</option>
                            <option value="4">DESGLOSE DEL PRESUPUESTO DE INVERSION CON CARGO A INGRESOS PROPIOS</option>
						</select>
					</td>
				</tr>
                <tr>
          			<td colspan="3">&nbsp;</td>
		  		</tr>
				<tr>
          			<td colspan="3" align="center"  class="PequenioAzul"><input type="submit" name="generar"  value="Generar Reporte"/>
					</td>
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
	          			</fieldset>
					</td>
          		</tr>
        	</table>
        </fieldset>
		</td>
	</tr>
</table>
</form>
