<?php
	if ( isset ( $_POST['generar'] ) )
	{
		switch ( $_POST['reporte'] )
		{
			case 1:		header ( "Location: Reporte1depto.php");
								break;
			case 2:		header ( "Location: Reporte2depto.php");
								break;
			case 3:		header ( "Location: Reporte3depto.php");
								break;
			case 4:		header ( "Location: Reporte4depto.php");
								break;
			case 5:		header ( "Location: ReporteGastos.php?dpto={$_SESSION['DPTO']}");
								break;
			case 6:		header ( "Location: ReporteGastos1.php");
								break;
			case 7:		header ( "Location: ReporteGastos3.php");
								break;
			default:			echo "<div align='center'>El reporte solicitado no existe.</div>";
		}
	}
?>