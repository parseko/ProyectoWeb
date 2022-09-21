<?php
		if ( isset ( $_POST['yes'] ) )
		{
			$sql = "DELETE FROM {$_GET['table']} WHERE idrequisicion = {$_GET['id']}";
			if ( $res = mysql_db_query ( $bdd, $sql ) )
			{
				$sql = "DELETE FROM {$_GET['table1']} WHERE idrequisicion = {$_GET['id']}";
				if ( $res = mysql_db_query ( $bdd, $sql ) )
				{
					echo "<div align = \"center\" class = \"MedianoExitoAzul\">El registro ha sido borrado satisfactoriamente.</div>";
				}
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
			echo "<div align = \"center\" class = \"MedianoAzul\">¿Está seguro que desea eliminar el registro?</div>";
			echo "<div align = \"center\"><input type='submit' name='yes' value='Si' /> <input type='submit' name='no' value='No' /></div>";
			echo "</form>";
			
?>
		</td>
    </tr>
</table>

<?php
		}
?>