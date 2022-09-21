<?php
		if ( isset ( $_POST['yes'] ) )
		{
			$sql_bor = "SELECT * FROM gastos_dpto WHERE idgastos = '{$_GET['id']}'";
			$res_bor = mysql_db_query ( $bdd, $sql_bor );
			if ( $row_bor = mysql_fetch_assoc ( $res_bor ) )
			{
				$_SESSION['requi']=$row_bor['idrequisicion'];
				$_SESSION['solicitud']=$row_bor['idsolicitud'];
				$_SESSION['viaticos']=$row_bor['idviaticos'];
			}

			$sql = "DELETE FROM gastos_dpto WHERE idgastos = {$_GET['id']}";
			if ( $res = mysql_db_query ( $bdd, $sql ) )
			{
				if($_SESSION['requi'] != 0)
				{
					$sql_1 = "DELETE FROM requisicion WHERE idrequisicion = '{$row_bor['idrequisicion']}'";
					if ( $res_1 = mysql_db_query ( $bdd, $sql_1 ) )
					{
						$sql_1 = "DELETE FROM bienservicio WHERE idrequisicion = '{$row_bor['idrequisicion']}'";
						if ( $res_1 = mysql_db_query ( $bdd, $sql_1 ) )
						{
							echo "<div align = \"center\" class = \"MedianoExitoAzul\">El registro ha sido borrado satisfactoriamente.</div>";
						}
					}
				}
				else if($_SESSION['solicitud'] != 0)
				{
					$sql_1 = "DELETE FROM solicitud_servicio WHERE idsolicitud = '{$row_bor['idsolicitud']}'";
					if ( $res_1 = mysql_db_query ( $bdd, $sql_1 ) )
					{
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">El registro ha sido borrado satisfactoriamente.</div>";
					}
				}
				else if($_SESSION['viaticos'] != 0)
				{
					$sql_1 = "DELETE FROM viticos WHERE idviaticos = '{$row_bor['idviaticos']}'";
					if ( $res_1 = mysql_db_query ( $bdd, $sql_1 ) )
					{
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">El registro ha sido borrado satisfactoriamente.</div>";
					}
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
		else if(isset ( $_POST['yes1'] ) )
		{
			$sql_bor = "SELECT * FROM gastos_dpto WHERE idgastos = '{$_GET['id']}'";
			$res_bor = mysql_db_query ( $bdd, $sql_bor );
			if ( $row_bor = mysql_fetch_assoc ( $res_bor ) )
			{
				$_SESSION['requi']=$row_bor['idrequisicion'];
				$_SESSION['solicitud']=$row_bor['idsolicitud'];
				$_SESSION['viaticos']=$row_bor['idviaticos'];
			}

			$sql = "DELETE FROM gastos_dpto WHERE idgastos = {$_GET['id']}";
			if ( $res = mysql_db_query ( $bdd, $sql ) )
			{
				if($_SESSION['requi'] != 0)
				{
					$sql = "UPDATE requisicion SET planea='0' WHERE idrequisicion = {$row_bor['idrequisicion']}";
					if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
					{
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">La REQUISICION ha sido devuelta para modificaciones.</div>";
					}
				}
				else if($_SESSION['solicitud'] != 0)
				{
					$sql = "UPDATE solicitud_servicio SET planea='0' WHERE idsolicitud = {$row_bor['idsolicitud']}";
					if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
					{
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">La SOLICITUD DE SERVICIO ha sido devuelta para modificaciones.</div>";
					}
				}
				else if($_SESSION['viaticos'] != 0)
				{
					$sql = "UPDATE viaticos SET planea='0' WHERE idviaticos = {$row_bor['idviaticos']}";
					if ( $res = mysql_db_query($bdd,$sql) or die(mysql_error()) )
					{
						echo "<div align = \"center\" class = \"MedianoExitoAzul\">Los VIATICOS han sido devueltos para modificaciones.</div>";
					}
				}

			}
			else
			{
				echo "<div align = \"center\" class = \"MedianoAlerta\">Error en base de datos. Intente de nuevo más tarde. <img src=\"imagenes/cancel.gif\" align=\"absmiddle\" /></div>";				
			}
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
	<tr>
    	<td align="center" width="100%">
<?php
			echo "<form action='' method='post'>";
			echo "<div align = \"center\" class = \"MedianoAzul\">¿Devolver el tramite para modificaciones?</div>";
			echo "<div align = \"center\"><input type='submit' name='yes1' value='Si' /> <input type='submit' name='no' value='No' /></div>";
			echo "</form>";
			
?>
		</td>
    </tr>
</table>

<?php
		}
?>