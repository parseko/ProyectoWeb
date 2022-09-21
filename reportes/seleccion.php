<?php
	if ( isset ( $_POST['generar'] ) )
	{
		switch ( $_POST['reporte'] )
		{
			case 1:		header ( "Location: Reporte1.php");
								break;
			case 2:		header ( "Location: Reporte2.php");
								break;
			case 3:		header ( "Location: Reporte3.php");
								break;
			case 4:		header ( "Location: Reporte4.php");
								break;
			case 5:		header ( "Location: Reporte5.php");
								break;
			case 6:		header ( "Location: Reporte6.php");
								break;
			case 7:		header ( "Location: Reporte7.php");
								break;
			default:			echo "<div align='center'>El reporte solicitado no existe.</div>";
		}
	}
?>