<?php
		if ( isset ( $_POST['yes'] ) )
		{
			mysql_db_query ( $bdd, "TRUNCATE TABLE poa_dpto_gastos");
			$sql_dpto = "SELECT * FROM poa_dpto ORDER BY id";
			if ($res_dpto = mysql_db_query ( $bdd, $sql_dpto))
			{
				while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
				{
					$sql_historial = "INSERT INTO poa_dpto_gastos ( dpto_id, partida_id, insumo_id, cantidad, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa) VALUES ( '{$row_dpto['dpto_id']}', '{$row_dpto['partida_id']}', '{$row_dpto['insumo_id']}', '{$row_dpto['cantidad']}', '{$row_dpto['justificacion']}', '{$row_dpto['idaccion']}', '{$row_dpto['tipogasto']}', '{$row_dpto['periodo']}', '{$row_dpto['idproceso']}', '{$row_dpto['idactividad']}', '{$row_dpto['idacciones']}', '{$row_dpto['idpoa']}' )";
					$res_historia = mysql_db_query ( $bdd, $sql_historial) or die ( mysql_error());
				}	
				echo "<div align = \"center\" class = \"MedianoExitoAzul\">Se a cargado satisfactoriamente el ejercicio.</div>";
			}
			else
			{
				echo "<div align = \"center\" class = \"MedianoAlerta\">Error en base de datos. Intente de nuevo más tarde. <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";
			}
		}
		else if ( isset ( $_POST['no'] ) )
		{
			echo "<div align = \"center\"><a href='index.php' class='LinkCatalogo'><img src='imagenes/salir.gif' border='0' /></a></div>";
		}
		else
		{

?>
<table width="100%" align="center">
	<tr>
    	<td align="center" width="100%">
<?php
			echo "<form action='' method='post'>";
			echo "<div align = \"center\" class = \"MedianoAzul\">¿Está seguro que desea cargar el ejercicio?</div>";
			echo "<div align = \"center\"><input type='submit' name='yes' value='Si' /> <input type='submit' name='no' value='No' /></div>";
			echo "</form>";
			
?>
		</td>
    </tr>
</table>

<?php
		}
?>