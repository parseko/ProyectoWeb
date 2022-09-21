<?php
	if ( isset ( $_POST['generar'] ) )
	{
		switch ( $_POST['reporte'] )
		{
			case 1:			header ( "Location: 1.php?ID={$_POST['ID']}");
								break;
			case 3.2:		header ( "Location: 3.2.php?ID={$_POST['ID']}");
								break;
			case 4.7:		header ( "Location: 4.7.php?ID={$_POST['ID']}");
								break;
			case 4:			header ( "Location: 4.php?ID={$_POST['ID']}");
								break;
			case 5:			header ( "Location: 5.php?ID={$_POST['ID']}");
								break;
			case 6:			header ( "Location: 6.php?ID={$_POST['ID']}");
								break;
			case 7:			header ( "Location: departamento.php?ID={$_POST['ID']}");
								break;
			default:			echo "<div align='center'>El reporte solicitado no existe.</div>";
		}
	}
?>