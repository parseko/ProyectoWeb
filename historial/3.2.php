<?php

	require('../fpdf/fpdf.php');
	include_once ( "../conexion/conexion.php" );
	
	$sql_directivos = "SELECT * FROM firmas_reportes";
	$res_directivos = mysql_db_query ( $bdd, $sql_directivos );
	if (!$row_directivos = mysql_fetch_assoc ( $res_directivos ) )
	{
		echo "No se han asignado nombres de directivos";
	}
	
	$sql_revision = "SELECT * FROM revision_reportes";
	$res_revision = mysql_db_query ( $bdd, $sql_revision );
	if (!$row_revision = mysql_fetch_assoc ( $res_revision ))
	{
		echo "No se han asignado claves de reportes";
	}
	
	class poa1_anexo2 extends FPDF
	{
		private $baseDeDatos = "sicopre";
		
		function Header()
		{	
			$bdd = "sicopre";
			
			$this->SetFont('Arial','',12);
			//Título
			$sql = "SELECT * FROM poa WHERE id = {$_GET['ID']}";
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
			$this->Cell(0,10,$ejercicio,0,0,'C');
			//Salto de línea
			$this->Ln(7);
			$this->SetFont('Arial','',9);
			$this->Cell(0,10,'INSTITUTO TECNOLOGICO DE TUXTLA GUTIERREZ',0,0,'C');		
			$this->Ln(10);
			$this->MultiCell(0,5,$titulo,0,'C');
			$this->Image ( "../imagenes/reportes/snest.jpeg", 15, 8, 35, 18);
			$this->Image ( "../imagenes/reportes/tec.jpeg", 163, 8, 25.4, 24.8);
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',6);
			$this->SetXY(10,35);
			$this->Cell(80,0,"UR 45",0,0,'L');
			$this->SetXY(120,35);
			$this->Cell(80,0,$leyenda,0,0,'R');
			$this->SetXY($xHeader,$yHeader);
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
			
			$sql_revision = "SELECT * FROM revision_reportes";
			$res_revision = mysql_db_query ( $bdd, $sql_revision );
			if (!$row_revision = mysql_fetch_assoc ( $res_revision ))
			{
				echo "No se han asignado claves de reportes";
			}
			$this->Line (10,275, 60, 275);
			$this->Line (150,275, 200, 275);
			$this->SetFont('Arial','',7);
			$this->SetXY(10,-20);
			$this->Cell(50,0,$row_directivos['nombre_director'],0,0,'C');	//Nombre del director
			$this->SetXY(10,-17);
			$this->Cell(50,0,"DIRECTOR",0,0,'C');							//Titulo del director
			$this->SetXY(150,-20);
			$this->Cell(50,0,$row_directivos['nombre_general'],0,0,'C');											//Nombre del director general
			$this->SetXY(150,-17);
			$this->Cell(50,0,"DIRECTOR GENERAL",0,0,'C');				//Titulo del director general
			$this->SetY(-10);
			$this->SetFont('Arial','',10);
			$this->Cell(50,0,$row_revision['dos'],0,0);
			$this->Cell(0,0,"Rev. {$row_revision['revision']}                ",0,0,'R');
		}
	}
	
	$pdf=new poa1_anexo2();
	
	$sql_ejercicio = "SELECT * FROM poa WHERE id = {$_GET['ID']}";
	$res_ejercicio = mysql_db_query ( $bdd, $sql_ejercicio );
	$row_ejercicio = mysql_fetch_assoc ( $res_ejercicio );
	
	$pdf->AddPage();
	
	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(0,5,"CAPITULO 5000", 0,0,'C');
	$pdf->Ln(5);
	
	$StandarX = $pdf->GetX();
	$StandarY = $pdf->GetY();
	
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
	
	$totalHeight = 0;
	$totalGastos = 0;
	
	$subtotal = 0;
	$repetida = 0;
	
	$sql_capitulo5000 = "SELECT clavepartida, descinsu, cantidad, costuni, justificacion, nombredpto FROM historial WHERE clavepartida >5000 AND clavepartida <6000 AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']} ORDER BY clavepartida, descinsu";
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
		
		$descinsu = strtoupper ( $row_capitulo5000['descinsu'] );
		$justificacion = strtoupper ( $row_capitulo5000['justificacion'] );
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
		$pdf->MultiCell(55,5,$justificacion."\n (".$dpto.")",0,'L');
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
	$pdf->Cell(40,5,"TOTAL ACUMULADO",0,0,'C');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(20,5,number_format( $totalGastos, 2, '.', ',' ),1,0,'C');
		
	$pdf->Output();
?>