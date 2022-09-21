<?php
$sql_poa = "SELECT * FROM poa WHERE actual = 1";
$res_poa = mysql_db_query ( $bdd, $sql_poa );
if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
{
	if($row_poa['tipo']==1)//APOA
	{
		if($row_poa['iniciado']==0)//Iniciar APOA
		{
			//Iniciar la Captura del APOA
?>
			<form action="" method="post">
            <table width="100%" align="center">
                <tr>
                    <td align="center" width="100%"> 
                        <fieldset style="border-bottom-color:#0066CC">
                            <legend class="MedianoAzulOscuro"><img src="imagenes/book.png" /> Ejercicio Presupuestal</legend>
                            <table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Ejercicio Presupuestal Actual: APOA INICIADO</td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $actual; ?></td>
                                </tr>
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Captura de Gastos: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"></td>
                                </tr>
                                <tr>
                                    <td width="100%" align="center" class="MedianoAzulOscuro" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                    				<td width="100%" align="center" class="MedianoAzulOscuro" colspan="2"><input type="submit" name="uno"  value="Iniciar APOA"/></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
            </form>
<?php
			//Poner 1 en Iniciado
		}
		else if($row_poa['iniciado']==1) 
		{
			//Terminar la Captura del APOA
?>
			<form action="" method="post">
            <table width="100%" align="center">
                <tr>
                    <td align="center" width="100%"> 
                        <fieldset style="border-bottom-color:#0066CC" >
                            <legend class="MedianoAzulOscuro"><img src="imagenes/book.png" /> Ejercicio Presupuestal</legend>
                            <table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Ejercicio Presupuestal Actual: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $actual; ?></td>
                                </tr>
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Captura de Gastos: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $iniciado; ?></td>
                                </tr>
                                <tr>
                                    <td width="100%" align="center" class="MedianoAzulOscuro" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                    				<td width="100%" align="center" class="MedianoAzulOscuro" colspan="2"><input type="submit" name="uno"  value="Iniciar APOA"/></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
            </form>
<?php
		}
	}
	else if($row_poa['tipo']==2)//POA
	{
		if($row_poa['iniciado']==0)//Iniciar POA
		{
			//Iniciar la Captura del APOA
?>
			<form action="" method="post">
            <table width="100%" align="center">
                <tr>
                    <td align="center" width="100%"> 
                        <fieldset style="border-bottom-color:#0066CC" >
                            <legend class="MedianoAzulOscuro"><img src="imagenes/book.png" /> Ejercicio Presupuestal</legend>
                            <table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Ejercicio Presupuestal Actual: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $actual; ?></td>
                                </tr>
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Captura de Gastos: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $iniciado; ?></td>
                                </tr>
                                <tr>
                                    <td width="100%" align="center" class="MedianoAzulOscuro" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                    				<td width="100%" align="center" class="MedianoAzulOscuro" colspan="2"><input type="submit" name="uno"  value="Iniciar APOA"/></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
            </form>
<?php
			//Poner 1 en Iniciado
		}
		else if($row_poa['iniciado']==1) 
		{
			//Terminar la Captura del POA
?>
			<form action="" method="post">
            <table width="100%" align="center">
                <tr>
                    <td align="center" width="100%"> 
                        <fieldset style="border-bottom-color:#0066CC" >
                            <legend class="MedianoAzulOscuro"><img src="imagenes/book.png" /> Ejercicio Presupuestal</legend>
                            <table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Ejercicio Presupuestal Actual: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $actual; ?></td>
                                </tr>
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Captura de Gastos: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $iniciado; ?></td>
                                </tr>
                                <tr>
                                    <td width="100%" align="center" class="MedianoAzulOscuro" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                    				<td width="100%" align="center" class="MedianoAzulOscuro" colspan="2"><input type="submit" name="uno"  value="Iniciar APOA"/></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
            </form>
<?php
			//Poner 1 en Terminado
		}
	}
}
else
{
?>
	<form action="" method="post">
    <table width="100%" align="center">
		<tr>
        	<td align="center" width="100%"> 
            <fieldset style="border-bottom-color:#0066CC" >
            <legend class="MedianoAzulOscuro"><img src="imagenes/book.png" /> Ejercicio Presupuestal</legend>
            	<table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                	<tr>
                    	<td width="55%" align="right" class="MedianoAzulOscuro">Ejercicio Presupuestal Actual: No hay ningun Ejercicio Iniciado </td>
                        <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $actual; ?></td>
                   	</tr>
                    <tr>
                    	<td width="55%" align="right" class="MedianoAzulOscuro">Captura de Gastos: Es necesario iniciar un Ejercicio</td>
                        <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $iniciado; ?></td>
                  	</tr>
                    <tr>
                    	<td width="100%" align="center" class="MedianoAzulOscuro" colspan="2">&nbsp;</td>
                   	</tr>
                    <tr>
                    	<td width="100%" align="center" class="MedianoAzulOscuro" colspan="2"><input type="submit" name="uno"  value="Iniciar APOA"/></td>
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