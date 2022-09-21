<?php
	require('../fpdf/fpdf.php');
	include_once ( "../conexion/conexion.php" );
	
	$sql_directivos = "SELECT * FROM firmas_reportes";
	$res_directivos = mysql_db_query ( $bdd, $sql_directivos );
	if (!$row_directivos = mysql_fetch_assoc ( $res_directivos ) )
	{
		echo "No se han asignado nombres de directivos";
	}
	
	/*$sql_revision = "SELECT * FROM revision_reportes";
	$res_revision = mysql_db_query ( $bdd, $sql_revision );
	if (!$row_revision = mysql_fetch_assoc ( $res_revision ))
	{
		echo "No se han asignado claves de reportes";
	}*/
	
	class poa1_anexo2 extends FPDF
	{
		private $baseDeDatos = "sicopre";
		
		function Header()
		{	
			$bdd = "sicopre";
			
			$this->SetFont('Arial','',12);
			//Título
			$sql = "SELECT * FROM poa WHERE actual = 1";
			$res = mysql_db_query ( $bdd, $sql );
			$row = mysql_fetch_assoc ( $res );
			switch ( $row['tipo'] )
			{
				case 1:		$ejercicio = "PROGRAMA OPERATIVO ANUAL ".$row['anio'];
								$titulo = "DESGLOCE DEL PRESUPUESTO DE INVERSIÓN\nCON CARGO A INGRESOS PROPIOS";
								$leyenda = "ANEXO 2 DE POA 3";
								break;
				case 2:		$ejercicio = "REPROGRAMACIÓN DEL PRESUPUESTO ".$row['anio'];
								$titulo = "REPROGRAMACIÓN DEL PRESUPUESTO DE INVERSIÓN\nCON CARGO A INGRESOS PROPIOS";
								$leyenda = "RP-3";
								break;
			}
			
		}
		
		function Footer()
		{
			$bdd = "sicopre";
			$sql_directivos = "SELECT * FROM firmas_reportes";
			$res_directivos = mysql_db_query ( $bdd, $sql_directivos );
			if ( !$row_directivos = mysql_fetch_assoc ( $res_directivos ) )
			{
				echo "No se han asignado nombres de directivos";
			}
			
			
		}
	}
	
	$pdf=new poa1_anexo2(L);
	
	$pdf->AddPage();
	
	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',8);
	$pdf->Ln(5);
	
	$StandarX = $pdf->GetX();
	$StandarY = $pdf->GetY();
	
	
	$pdf->Ln(5);
	$pdf->Ln(5);
	
	$totalHeight = 0;
	$totalGastos = 0;
	
	$subtotal = 0;
	$repetida = 0;
	
	$sql_capitulo5000 = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = dpto.id AND clavepartida >5000 AND clavepartida <6000 ORDER BY clavepartida, descinsu";
	$res_capitulo5000 = mysql_db_query ( $bdd, $sql_capitulo5000 );
	while ( $row_capitulo5000 = mysql_fetch_assoc ( $res_capitulo5000 ) )
	{
		
		$total = ( $row_capitulo5000['cantidad']*$row_capitulo5000['costuni'] );
		$totalGastos += $total;
		
		if ( $repetida == 1 )
		{
			if ( $row_capitulo5000['clavepartida'] == $partida )
			{
				$subtotal += $total;
			}
			else
			{
				$repetida = 0;
				$pdf->Cell(115,5,"SUBTOTAL",1,0,'R');
				$pdf->Cell(20,5,number_format ($subtotal, 2, '.',','),1,0,'C');
				$pdf->Cell(55,5,"",1,0,'C');
				$pdf->Ln(5);
				$totalHeight += 5;
				$subtotal = 0;
			}
		}
		else
		{
			if ( $row_capitulo5000['clavepartida'] == $partida )
			{
				$repetida = 1;
				$subtotal += $total;
			}
		}
		$prueba="COMO ESTAS, ESPERO TE ENCUENTRES BIEN EN ESTE MOMENTO, YO ME ENCUENTRO EN MI TRABAJO INTENTANDO ENTENDER A ESTE CODIGO QUE PUSIERON AQUI PARA PODER HACER MUCHAS COSAS QUE ME FALTAN HACER EN EL PDF QUE ME HACE FALTA PARA PODER TERMINAR EL SISTEMA DE APOA";
		$descinsu = strtoupper ( $row_capitulo5000['descinsu'] );
		$justificacion = strtoupper ( $prueba );
		$dpto = strtoupper ( $row_capitulo5000['nombredpto'] );
		
		if ( strlen ( $row_capitulo5000['nombredpto'] )  > 26 )
		{
			$dptoLong = ( intval ( strlen( $row_capitulo5000['nombredpto'] ) / 28 ) + 1 ) * 5;
		}
		else
		{
			$dptoLong = 5;
		}
		
		$justificacionDpto = strlen ( $justificacion );
		
		if ( strlen ( $descinsu ) > 28 and strlen ( $descinsu ) > $justificacionDpto  )
		{
			if ( strlen( $descinsu ) % 28 == 0 )
			{
				$height = ( strlen( $descinsu ) / 28 ) * 5;
			}
			else
			{
				$height = ( intval ( strlen( $descinsu ) / 28 ) + 1 ) * 5;
			}
		}
		else if ( $justificacionDpto > 28 )
		{
			if ( strlen( $justificacion ) % 28 == 0 )
			{
				$height = ( ( strlen( $justificacion ) / 28 ) + 1 ) * 5;
			}
			else
			{
				$height = ( intval ( strlen( $justificacion ) / 28 ) + 1 ) * 5;
			}
		}
		else
		{
			$height = 5;
		}
		
		$height = $height+$dptoLong;
		
		
		if ( $totalHeight > 205 or ( $totalHeight+$height ) > 205 )
		{
			$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+75, $StandarY, $StandarX+75, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+95, $StandarY, $StandarX+95, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+115, $StandarY, $StandarX+115, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+135, $StandarY, $StandarX+135, $StandarY+$totalHeight+10);
			
		
			$totalHeight = 0;
			
			$pdf->AddPage();
	
			$pdf->Ln(8);
			$pdf->Cell(0,5,"CAPITULO 5000", 0,0,'C');
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(20,10,"PARTIDA",1,0,'C');
			$pdf->Cell(55,10,"DENOMINACIÓN DEL BIEN",1,0,'C');
			$pdf->Cell(20,10,"CANTIDAD",1,0,'C');
			$pdf->Cell(20,10,"COSTO/U",1,0,'C');
			$pdf->Cell(20,5,"COSTO",'T',0,'C');
			$pdf->Cell(55,10,"JUSTIFICACIÓN",1,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(115,5,"",0,0,'C');
			$pdf->Cell(20,5,"TOTAL",'B',0,'C');
			$pdf->Ln(5);
		}
		
		$pdf->SetFont('Arial','',8);
		$xC = $pdf->GetX();
		$yC = $pdf->GetY();
		$pdf->Cell(20,5,$row_capitulo5000['clavepartida'],0,0,'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell(55,5,$descinsu,0,'L');
		$pdf->SetXY($x+55,$y);
		$pdf->Cell(20,5,$row_capitulo5000['cantidad'],0,0,'C');
		$pdf->Cell(20,5,number_format( $row_capitulo5000['costuni'], 2, '.', ',' ),0,0,'C');
		$pdf->Cell(20,5,number_format( $total, 2, '.', ',' ),0,0,'C');
		$pdf->MultiCell(55,5,$prueba."\n (".$dpto.")",0,'L');
		$pdf->SetXY($xC,$yC);
		$pdf->Cell(0,$height,"",1,0);
		$pdf->Ln($height);
		
		$totalHeight += $height;
		if ( $repetida == 0 )
		{
			$partida = $row_capitulo5000['clavepartida'];
			$subtotal = $total;
		}
	}
	
	if ( $repetida == 1 )
	{
		$repetida = 0;
		$pdf->Cell(115,5,"SUBTOTAL",1,0,'R');
		$pdf->Cell(20,5,number_format ($subtotal, 2, '.',','),1,0,'C');
		$pdf->Cell(55,5,"",1,0,'C');
		$pdf->Ln(5);
		$totalHeight += 5;
		$subtotal = 0;
		
	}
	
	if ( $totalHeight >= 205 )
	{
		$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+75, $StandarY, $StandarX+75, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+95, $StandarY, $StandarX+95, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+115, $StandarY, $StandarX+115, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+135, $StandarY, $StandarX+135, $StandarY+$totalHeight+10);
		
		$totalHeight = 0;
		
		$pdf->AddPage();
	
		$pdf->Ln(8);
		$pdf->Cell(0,5,"CAPITULO 5000", 0,0,'C');
		$pdf->Ln(5);
			
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(20,10,"PARTIDA",1,0,'C');
		$pdf->Cell(55,10,"DENOMINACIÓN DEL BIEN",1,0,'C');
		$pdf->Cell(20,10,"CANTIDAD",1,0,'C');
		$pdf->Cell(20,10,"COSTO/U",1,0,'C');
		$pdf->Cell(20,5,"COSTO",'T',0,'C');
		$pdf->Cell(55,10,"JUSTIFICACIÓN",1,0,'C');
			
		$pdf->Ln(5);
		$pdf->Cell(115,5,"",0,0,'C');
		$pdf->Cell(20,5,"TOTAL",'B',0,'C');
		$pdf->Ln(5);
	}
	
	$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+75, $StandarY, $StandarX+75, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+95, $StandarY, $StandarX+95, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+115, $StandarY, $StandarX+115, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+135, $StandarY, $StandarX+135, $StandarY+$totalHeight+10);
	
	$pdf->Cell(75,5,"",0,0,'C');
	$pdf->SetFont('Arial','B',8);
		
	$pdf->Output();
?>