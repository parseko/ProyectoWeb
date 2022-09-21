<table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#479BB5">
<?php
	if (isset( $_SESSION['tipo']) == 1 )
	{
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoAmarillo'>Captura:</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoBlanco'>&nbsp;</td>";
		echo "</tr>";
		echo "<tr >";
		echo "<td width='100%' align='center' class='Menu' ><a href='index.php?sec=1' class='LinkMenu'>Metas</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=2' class='LinkMenu'>Clave</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=3' class='LinkMenu'>Departamento</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=4' class='LinkMenu'>Insumo</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=5' class='LinkMenu'>Partida</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=6' class='LinkMenu'>Presupuesto</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=7' class='LinkMenu'>Proceso</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=8' class='LinkMenu'>Accion</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=9' class='LinkMenu'>Usuario</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoBlanco'>&nbsp;</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoAmarillo'>Control Administrativo:</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoBlanco'>&nbsp;</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=p' class='LinkMenu'>Ejercicio</a></td>";
		echo "</tr>";
		/*echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=11' class='LinkMenu'>Historial</a></td>";
		echo "</tr>";*/
		if ( isset($_SESSION['poa_tipo']) < 3 )
		{
			echo "<tr>";
			echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=c' class='LinkMenu'>Consulta {$ejercicio_actual}</a></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=r' class='LinkMenu'>Reportes</a></td>";
			echo "</tr>";
		}
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=10' class='LinkMenu'>Datos de Reportes</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center'>&nbsp;</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center'><a href='index.php?sec=b' class='LinkMenu'><img src='imagenes/buscar2.gif' onmouseover=\"Tip('Sistema de B�squeda')\" border='0' /></a></td>";
		echo "</tr>";
		
	}
	else if ( isset($_SESSION['tipo']) == 2 )
	{
		echo "<tr>";
		echo "<td width='100%' align='center'><a href='index.php?sec=r' class='LinkMenu'>Reportes</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center'><a href='index.php?sec=11' class='LinkMenu'>Historial</a></td>";
		echo "</tr>";
	}
	else if ( isset($_SESSION['tipo']) == 3 )
	{
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=1' class='LinkMenu'>Principal</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=2' class='LinkMenu'>Captura de POA</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=4' class='LinkMenu'>Consulta de POA</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=5' class='LinkMenu'>Carga de Acciones</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=6' class='LinkMenu'>Consulta de Acciones</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=z' class='LinkMenu'>Subpresupuestos</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=r' class='LinkMenu'>Reportes</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'></br></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoAmarillo'>Movimientos</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=10' class='LinkMenu'>Solicitudes</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=12' class='LinkMenu'>Requisicion</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=13' class='LinkMenu'>Servicios</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=19' class='LinkMenu'>Viaticos</a></td>";
		echo "</tr>";

	}
	if ( isset($_SESSION['tipo']) == 4 )
	{
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoAmarillo'>Cargar:</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoBlanco'>&nbsp;</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=1' class='LinkMenu'>Principal</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=2' class='LinkMenu'>Estado de Cuentas</a></td>";
		echo "</tr>";
		/*echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=6' class='LinkMenu'>Estado de Cuentas Remanente</a></td>";
		echo "</tr>";*/
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=3' class='LinkMenu'>Cargar Gastos</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=i' class='LinkMenu'>Inicio de Gastos</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=r' class='LinkMenu'>Reportes</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'></br></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='MedianoAmarillo'>Admin - Movimientos</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=8' class='LinkMenu'>Requisiciones</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=9' class='LinkMenu'>Servicios</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td width='100%' align='center' class='Menu'><a href='index.php?sec=13' class='LinkMenu'>Viaticos</a></td>";
		echo "</tr>";

		echo "<tr>";
				
	}
	else
	{
	}
?>
</table>
