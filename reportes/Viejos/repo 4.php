<?php
	require('../fpdf/fpdf.php');
	include_once ( "../conexion/conexion.php" );
	class poa1_anexo2 extends FPDF
	{
		private $baseDeDatos = "sicopre";		
		function Header()
		{	
			$bdd = "sicopre";
			$this->SetFont('Arial','',10);
			//Título
			$sql = "SELECT * FROM poa WHERE actual = 1";
			$res = mysql_db_query ( $bdd, $sql );
			$row = mysql_fetch_assoc ( $res );
			switch ( $row['tipo'] )
			{
				case 1:		$ejercicio = "ANTEPROYECTO DEL PROGRAMA OPERATIVO ANUAL ".$row['anio'];
								break;
				case 2:		$ejercicio = "PROGRAMA OPERATIVO ANUAL ".$row['anio'];
								break;
			}
			$this->SetXY(81,$x+17);
			$this->Cell(130,5,'Referencia a la Norma ISO 9001-2000: 6.1',0,0,'C');		
			$this->SetFont('Arial','',9);
			$this->SetXY(81,$x+12);
			$this->Cell(130,0,'Formato de Desglose del Presupuesto de Inversión con Cargo a Ingresos Propios',0,0,'C');
			$this->SetXY(10,$x+10);
			$this->Cell(0,35,$ejercicio,0,0,'C');
			$this->SetXY(10,$x+5);
			$this->Cell(0,55,'DESGLOSE DEL PRESUPUESTO DE INVERSIÓN CON CARGO A INGRESOS PROPIOS',0,0,'C');
			//$this->Ln(3);
			
			//$this->Ln(10);
			$this->MultiCell(0,5,$titulo,0,'C');
			$this->Image ( "../imagenes/reportes/snest.jpeg", 15, 8, 35, 18);
			$this->Image ( "../imagenes/reportes/tec.jpeg", 263, 8, 25.4, 24.8);
			$this->SetFont('Arial','B',7.5);
			
			//$this->Ln(1);
			$x=35;
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(11,$x+2);
		$this->Cell(70,5,"PROCESOS ESTRATEGICO:",1,2,'L',1);	
		
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(11,$x+7);
		$this->Cell(70,5,"PROCESO CLAVE:",1,2,'L',1);	
		
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(81,$x+2);
		$this->Cell(204,5,"",1,2,'L',1);	
		
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(81,$x+7);
		$this->Cell(204,5,"",1,2,'L',1);	
		
			//Salto de línea
			//$this->Ln(7);
			
			//$this->Ln(10);
				
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',6);
			$this->Cell(80,0,$leyenda,0,0,'R');
			$this->SetXY($xHeader,$yHeader);
		}
		
		function Footer()
		{
			$bdd = "sicopre";
			/*$sql_directivos = "SELECT * FROM firmas_reportes";
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
			}*/
			
		}
	}
	
	$pdf=new poa1_anexo2(L);
	
	$pdf->AddPage();
	
	$pdf->Ln(5);
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(0,5,"CAPITULO 5000", 0,0,'C');
	$pdf->Ln(5);
	
	$StandarX = $pdf->GetX();
	$StandarY = $pdf->GetY();
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(20,5,"NUMERO",'T',0,'C');
	$pdf->Cell(20,10,"PARTIDA",1,0,'C');
	$pdf->Cell(55,10,"DENOMINACIÓN DEL BIEN",1,0,'C');
	$pdf->Cell(20,10,"CANTIDAD",1,0,'C');
	$pdf->Cell(20,10,"COSTO/U",1,0,'C');
	$pdf->Cell(20,5,"COSTO",'T',0,'C');
	$pdf->Cell(122,10,"JUSTIFICACIÓN",'T',0,'C');
	
	$pdf->Ln(5);
	$pdf->Cell(8,5,"",0,0,'C');
	$pdf->Cell(5,5,"DE META",'B',0,'C');
	$pdf->Cell(265,5,"TOTAL",'B',0,'C');
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
		
		$descinsu = strtoupper ( $row_capitulo5000['descinsu'] );
		$justificacion = strtoupper ( $row_capitulo5000['justificacion'] );
		$dpto = strtoupper ( $row_capitulo5000['nombredpto'] );
		
		if ( strlen ( $row_capitulo5000['nombredpto'] )  > 26 )
		{
			$dptoLong = ( strlen( $row_capitulo5000['nombredpto'] ) / 48 ) * 5;
		}
		else
		{
			$dptoLong = 5;
		}
		
		$justificacionDpto = strlen ( $justificacion );
		
		if ( strlen ( $descinsu ) > 48 and strlen ( $descinsu ) > $justificacionDpto  )
		{
			if ( strlen( $descinsu ) % 48 == 0 )
			{
				$height = ( strlen( $descinsu ) / 48 ) * 5;
			}
			else
			{
				$height = ( intval ( strlen( $descinsu ) / 48 ) + 1 ) * 5;
			}
		}
		else if ( $justificacionDpto > 48 )
		{
			if ( strlen( $justificacion ) % 48 == 0 )
			{
				$height = ( ( strlen( $justificacion ) / 48 ) + 1 ) * 5;
			}
			else
			{
				$height = ( intval ( strlen( $justificacion ) / 48 ) + 1 ) * 5;
			}
		}
		else
		{
			$height = 5;
		}
		
		$height = $height+$dptoLong;
		
		
		if ( $totalHeight > 205 or ( $totalHeight+$height ) > 205 )
		{
			$pdf->Line($StandarX+0, $StandarY, $StandarX+0, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+75, $StandarY, $StandarX+75, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+95, $StandarY, $StandarX+95, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+115, $StandarY, $StandarX+115, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+135, $StandarY, $StandarX+135, $StandarY+$totalHeight+10);
			$pdf->Line($StandarX+277, $StandarY, $StandarX+277, $StandarY+$totalHeight+10);
			
		
			$totalHeight = 0;
			
			$pdf->AddPage();
	
			$pdf->Ln(8);
			$pdf->Cell(0,5,"CAPITULO 5000", 0,0,'C');
			$pdf->Ln(5);
			
			$pdf->SetFont('Arial','B',8);

			$pdf->Cell(20,5,"NUMERO",'T',0,'C');
			$pdf->Cell(20,10,"PARTIDA",1,0,'C');
			$pdf->Cell(55,10,"DENOMINACIÓN DEL BIEN",1,0,'C');
			$pdf->Cell(20,10,"CANTIDAD",1,0,'C');
			$pdf->Cell(20,10,"COSTO/U",1,0,'C');
			$pdf->Cell(20,5,"COSTO",'T',0,'C');
			$pdf->Cell(122,10,"JUSTIFICACIÓN",'T',0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(8,5,"",0,0,'C');
			$pdf->Cell(5,5,"DE META",'B',0,'C');
			$pdf->Cell(265,5,"TOTAL",'B',0,'C');
			$pdf->Ln(5);
		}
		
		$pdf->SetFont('Arial','',8);
		$xC = $pdf->GetX();
		$yC = $pdf->GetY();
		$pdf->Cell(20,5,"",0,0,'C');
		$pdf->Cell(20,5,$row_capitulo5000['clavepartida'],0,0,'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell(55,5,$descinsu,0,'L');
		$pdf->SetXY($x+55,$y);
		$pdf->Cell(20,5,$row_capitulo5000['cantidad'],0,0,'C');
		$pdf->Cell(20,5,number_format( $row_capitulo5000['costuni'], 2, '.', ',' ),0,0,'C');
		$pdf->Cell(20,5,number_format( $total, 2, '.', ',' ),0,0,'C');
		$pdf->MultiCell(122,5,$justificacion."\n (".$dpto.")",0,'J');
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
		$pdf->Line($StandarX+0, $StandarY, $StandarX+0, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+75, $StandarY, $StandarX+75, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+95, $StandarY, $StandarX+95, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+115, $StandarY, $StandarX+115, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+135, $StandarY, $StandarX+135, $StandarY+$totalHeight+10);
		$pdf->Line($StandarX+277, $StandarY, $StandarX+277, $StandarY+$totalHeight+10);
		
		$totalHeight = 0;
		
		$pdf->AddPage();
	
		$pdf->Ln(8);
		$pdf->Cell(0,5,"CAPITULO 5000", 0,0,'C');
		$pdf->Ln(5);
			
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(20,5,"NUMERO",'T',0,'C');
		$pdf->Cell(20,10,"PARTIDA",1,0,'C');
		$pdf->Cell(55,10,"DENOMINACIÓN DEL BIEN",1,0,'C');
		$pdf->Cell(20,10,"CANTIDAD",1,0,'C');
		$pdf->Cell(20,10,"COSTO/U",1,0,'C');
		$pdf->Cell(20,5,"COSTO",'T',0,'C');
		$pdf->Cell(122,10,"JUSTIFICACIÓN",'T',0,'C');
			
		$pdf->Ln(5);
		$pdf->Cell(8,5,"",0,0,'C');
		$pdf->Cell(5,5,"DE META",'B',0,'C');
		$pdf->Cell(265,5,"TOTAL",'B',0,'C');
		$pdf->Ln(5);
	}
	
	$pdf->Line($StandarX+0, $StandarY, $StandarX+0, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+20, $StandarY, $StandarX+20, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+40, $StandarY, $StandarX+40, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+95, $StandarY, $StandarX+95, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+115, $StandarY, $StandarX+115, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+135, $StandarY, $StandarX+135, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+155, $StandarY, $StandarX+155, $StandarY+$totalHeight+10);
	$pdf->Line($StandarX+277, $StandarY, $StandarX+277, $StandarY+$totalHeight+10);
	
	$pdf->Cell(75,5,"",0,0,'C');
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(60,5,"TOTAL ACUMULADO",0,0,'C');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(20,5,number_format( $totalGastos, 2, '.', ',' ),1,0,'C');
		
	$pdf->Output();
?>