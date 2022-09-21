	<table width="200" border="1">
  	<tr>
    	<td>Departamento</td>
    	<td>Monto Enero - Junio</td>
  	</tr>
<?php
$total=0;
include_once("conexion/conexion.php");		//Archivo de interconexion a la base de datos
$sql_dpto = "SELECT * FROM dpto ORDER BY id";
$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
{
?>

  	<tr>
    	<td>
<?php
			echo $row_dpto['nombredpto'];
?>
		</td>
    	<td>
<?php
			$sql_poa = "SELECT * FROM poa_dpto WHERE dpto_id='{$row_dpto['id']}' and periodo=2 AND tipogasto=1";
			$res_poa = mysql_db_query ( $bdd, $sql_poa );
			while ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
			{
				$sql_insumo = "SELECT * FROM insumo WHERE id='{$row_poa['insumo_id']}'";
				$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
				if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
				{
					$sub=$row_insumo['costuni']*$row_poa['cantidad'];
				}
				$total=$total+$sub;
			}
			$super=$super+$total;
			echo $total;
			$total=0;
?>
		</td>
  	</tr>
<?php
}
?>	</table>
<?php
echo $super;
?>