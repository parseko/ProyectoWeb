<?php
	function totalGastado($dpto_id,$bdd)
	{
		$gastoDpto = 0;
		$sql_gastado = "SELECT * FROM poa_dpto, insumo WHERE poa_dpto.dpto_id = {$dpto_id} AND poa_dpto.insumo_id = insumo.id";
		if ( $res_gastado = mysql_db_query ( $bdd, $sql_gastado ) )
		{
			while ( $row_gastado = mysql_fetch_assoc ( $res_gastado ) )
			{
				$gastoDpto += $row_gastado['costuni']*$row_gastado['cantidad'];
			}
			return $gastoDpto;
		}
		else
		{
			return 0;
		}
	}
	
	
	
	if ( !isset ( $_GET['ver'] ) )
	{
?>

        <form action="" method="post">
        <table width="100%" height="250" align="center">
            <tr>
                <td align="center" width="100%"> 
                <fieldset style="border-bottom-color:#0066CC" >
        <?php
                    switch ( $_SESSION['tipo_poa'] )
                    {
                        case 1:	$ejercicio = "Consulta de POA ".$_SESSION['anio'];
                                    break;
                        case 2:	$ejercicio = "Consulta de REPOA ".$_SESSION['anio'];
                                    break;
                        case 3:	$ejercicio = "NO SE HA INCIADO UN EJERCICIO";
                                    break;
                    }
        ?>
                    <legend class="MedianoAzulOscuro"><img src="imagenes/layout_content.png" /><?php echo $ejercicio; ?></legend>
        
                    <table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                        <tr>
                            <td width="100%" align="right" class="MedianoAzulOscuro">
                            
                                                                
                                    <table class="Poa" align="center" cellspacing="1">
                                        <tr>
                                            <td class='PoaTitulo'>Departamento</td>
                                            <td class='PoaTitulo'>Presupuesto</td>
                                            <td class='PoaTitulo'>Gasto</td>
                                            <td class='PoaTitulo'>Ver</td>
                                        </tr>
        <?php
                                        $total = 0;
                                        $totalGastado = 0;
                                        $sql_dptos = "SELECT * FROM dpto ORDER BY clavedpto";
                                        $res_dptos = mysql_db_query ( $bdd, $sql_dptos );
                                        while ( $row_dptos = mysql_fetch_assoc ( $res_dptos ) )
                                        {
                                            $sql_pre = "SELECT * FROM presupuesto WHERE dpto_id = {$row_dptos['id']}";
                                            $res_pre = mysql_db_query ( $bdd, $sql_pre );
                                            if ( $row_pre = mysql_fetch_assoc ( $res_pre ) )
                                            {
                                                $total += $row_pre['presupuesto'];
                                                $totalGastado += totalGastado ( $row_dptos['id'], $bdd );
                                                echo "<tr>";
                                                echo "<td class='PoaDatos'>{$row_dptos['nombredpto']}</td>";
                                                echo "<td class='PoaDatos'>\$ ".number_format ($row_pre['presupuesto'],2,'.',',')."</td>";
                                                echo "<td class='PoaDatos'>\$ ".number_format (totalGastado ( $row_dptos['id'], $bdd ),2,'.',',')."</td>";
                                                echo "<td class='PoaDatos'><a href='index.php?sec=c&ver=1&dpto={$row_dptos['id']}'><img src='imagenes/eye.png' border='0'></a></td>";
                                                echo "</tr>";
                                            }
                                            else
                                            {
                                                echo "<tr>";
                                                echo "<td class='PoaDatos'>{$row_dptos['nombredpto']}</td>";
                                                echo "<td class='PoaAlerta'>No asignado</td>";
                                                echo "<td class='PoaAlerta'>N/A</td>";
                                                echo "<td class='PoaAlerta'>N/A</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        echo "<tr>";
                                        echo "<td class='PoaDatos'><strong>Total</strong></td>";
                                        echo "<td class='PoaDatos'>\$ ".number_format ($total,2,'.',',')."</td>";
                                        echo "<td class='PoaDatos'>\$ ".number_format ($totalGastado,2,'.',',')."</td>";
                                         echo "<td class='PoaDatos'>&nbsp;</td>";
                                        echo "</tr>";
        ?>
                                </table>
                            
                            </td>        		    	
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



<?php

	}
	else
	{
		$sql_dpto_datos = "SELECT * FROM dpto WHERE id = {$_GET['dpto']}";
		$res_dpto_datos = mysql_db_query ( $bdd, $sql_dpto_datos );
		$row_dpto_datos = mysql_fetch_assoc ( $res_dpto_datos );
		
		echo "<div align='center' class='MedianoAzulOscuro'>{$row_dpto_datos['nombredpto']}</div><br />";
		
		$sql_programa = "SELECT * FROM poa_dpto WHERE dpto_id = {$_GET['dpto']}  GROUP BY idaccion";
		if ( $res_programa = mysql_db_query ( $bdd, $sql_programa ) )
		{
			while ( $row_programa = mysql_fetch_assoc ( $res_programa ) )
			{
				echo "<form action='' method='post'>";
				echo "<table align='center' class='Poa' cellspacing='1'>";
				echo "<tr>";
				echo "<td class='PoaUnidad' colspan='9'><strong>{$row_programa['claveproceso']}.{$row_programa['claveActiv']}.{$row_programa['claveAccion']} - {$row_programa['tipounidad']}</strong></td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td class='PoaTitulo'>Cantidad</td>";
				echo "<td class='PoaTitulo'>Medida</td>";
				echo "<td class='PoaTitulo'>Partida</td>";
				echo "<td class='PoaTitulo'>Insumo</td>";
				echo "<td class='PoaTitulo'>Costo unitario</td>";
				echo "<td class='PoaTitulo'>Total</td>";
				echo "<td class='PoaTitulo'>Justificacion</td>";
				echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "<td class='PoaTitulo'>&nbsp;</td>";
				echo "</tr>";
				
				$sql_poa_dpto = "SELECT poa_dpto.id AS poa_id, poa_dpto.*, insumo.*, partida.* FROM poa_dpto, insumo, partida WHERE poa_dpto.dpto_id = {$_GET['dpto']}  AND poa_dpto.insumo_id = insumo.id AND poa_dpto.partida_id = partida.id AND poa_dpto.idaccion = {$row_programa['idaccion']} ORDER BY   poa_dpto.idacciones";
				if ( $res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto ) )
				{
					$totalUnidad = 0;
					while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
					{
						$total = $row_poa_dpto['costuni']*$row_poa_dpto['cantidad'];
						echo "<tr>";
						echo "<td class='PoaDatos'>{$row_poa_dpto['cantidad']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_poa_dpto['medida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_poa_dpto['clavepartida']}&nbsp;</td>";
						echo "<td class='PoaDatos'>{$row_poa_dpto['descinsu']}&nbsp;</td>";
						echo "<td class='PoaDatos'>\$".number_format ( $row_poa_dpto['costuni'], 2, '.', ',' )."</td>";
						echo "<td class='PoaDatos'>\$".number_format ( $total, 2, '.', ',' )."</td>";
						echo "<td class='PoaDatos'>{$row_poa_dpto['justificacion']}&nbsp;</td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=X&mod=1&poa_dpto={$row_poa_dpto['poa_id']}&dpto_id={$row_poa_dpto['dpto_id']}'><img src='imagenes/pencil.png' border='0'></td>";
						echo "<td class='PoaDatos'><a href='index.php?sec=d&table=poa_dpto&id={$row_poa_dpto['poa_id']}'><img src='imagenes/bin_closed.png' border='0'></a></td>";
						echo "</tr>";
						$totalUnidad += $total;
					}
					echo "<tr>";
					echo "<td class='PoaDatos' colspan='4'>&nbsp;</td>";
					echo "<td class='PoaDatos'>TOTAL</td>";
					echo "<td class='PoaDatos'>\$".number_format ( $totalUnidad, 2, '.', ',' )."</td>";
					echo "<td class='PoaDatos' colspan='3'>&nbsp;</td>";
					echo "</tr>";
				}
				echo "</table></form><br /><br />";
			}
		}
	}
?>