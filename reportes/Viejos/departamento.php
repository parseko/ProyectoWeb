<?php
	include_once ( "../conexion/conexion.php" );
?>
<link href="../CSS/sicopre.css" rel="stylesheet" type="text/css">


<form action="7.php" method="post">
	<div align="center">
        <table class="Poa">
            <tr>
                <td class="PoaTitulo">Seleccione un Departamento</td>
            </tr>
            <tr>
                <td class="PoaDatos">Departamento:&nbsp;
                    <select name="dpto_id" class="ControlesTexto" onChange="submit()">
                        <option value='0' selected>[Seleccione un departamento]</option>
        <?php
                        $sql = "SELECT * FROM dpto";
                        $res = mysql_db_query ( $bdd, $sql );
                        while ( $row = mysql_fetch_assoc ( $res ) )
                        {
                            echo "<option value='{$row['id']}'>{$row['nombredpto']}</option>";
                        }
        ?>
                    </select>
                </td>
            </tr>
        </table>
    </div>
</form>