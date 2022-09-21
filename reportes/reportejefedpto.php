<?php
	require('../fpdf/fpdf.php');
	include_once ( "../conexion/conexion.php" );
	session_start();

	class poa1_anexo2 extends FPDF
	{
		private $baseDeDatos = "sicopre";
		
		function Header()
		{	
			$bdd = "sicopre";
			$this->line(30,87,30,172);
			$this->line(135,87,135,172);
			$this->line(155,87,155,172);		
			$this->line(185,87,185,172);
			$this->line(215,87,215,172);
			$this->SetFont('Arial','',12);
			//Título
			$this->Cell(0,10,'DIRECCIÓN GENERAL DE EDUCACIÓN SUPERIOR TECNOLÓGICA',0,0,'C');
			//Salto de línea
			$this->Ln(5);
			$this->SetFont('Arial','',10);
			$this->Cell(0,10,'COORDINACIÓN SECTORIAL DE ADMINISTRACIÓN Y FINANZAS',0,0,'C');
			$this->Ln(5);
			$this->Cell(0,10,"DIRECCIÓN DE RECURSOS FINANCIEROS",0,0,'C');
			$this->Ln(5);
			$this->Cell(0,10,"SUBPRESUPUESTO DE INVERSIÓN CON CARGO A INGRESOS PROPIOS",0,0,'C');
			$this->Ln(5);
			$this->Cell(0,10,"(CAPITULO 5000)",0,0,'C');
			
			$this->Ln(7);
			
			$this->Image ( "../imagenes/reportes/sep.jpeg", 50, 10, 50.3, 24.9);
			//$this->Image ( "../imagenes/reportes/tec.jpeg", 260, 10, 25.4, 24.8);
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',8);
			$this->SetXY(10,20);
			$this->Cell(80,0,"",0,0,'L');
			$this->SetXY(260,20);
			$this->Cell(80,0,"",0,0,'R');
			$this->SetXY($xHeader,$yHeader);
		}
		
		function Footer(  )
		{
			$bdd = "sicopre";
			$sql_revision = "SELECT * FROM revision_reportes";
			$res_revision = mysql_db_query ( $bdd, $sql_revision );
			if (!$row_revision = mysql_fetch_assoc ( $res_revision ))
			{
				echo "No se han asignado claves de reportes";
			}
			
			$sql_firmas = "SELECT * FROM firmas_reportes";
			$res_firmas = mysql_db_query ( $bdd, $sql_firmas );
			$row_firmas = mysql_fetch_assoc ( $res_firmas );
			
			$this->SetFont('Arial','',9);
			
			$this->SetY(-35);
			$this->SetFont('Arial','',9);
			$this->Cell(60,5,'',0,0);
			$X = $this->GetX();
			$Y = $this->GetY();
			$this->MultiCell(50,5,"SOLICITA AUTORIZACIÓN DIRECTOR DEL PLANTEL",0,'C');
			$this->Line($X-10, $Y+15, $X+60, $Y+15);
			$this->SetXY($X, $Y+16);
			$this->MultiCell(50,5,$row_firmas['nombre_director']."\n".$row_firmas['rfc_director'],0,'C');
			
			$this->SetXY($X+70, $Y);
			$X = $this->GetX();
			$Y = $this->GetY();
			$this->MultiCell(30,5,"SELLO OFICIAL (PLANTEL)",0,'C');
			
			$this->SetXY($X+60, $Y);
			$X = $this->GetX();
			$Y = $this->GetY();
			$this->MultiCell(60,5,"AUTORIZACION DIRECTOR GENERAL",0,'C');
			$this->Line($X-10, $Y+15, $X+70, $Y+15);
			$this->SetXY($X, $Y+16);
			$this->MultiCell(60,5,$row_firmas['nombre_general']."\n".$row_firmas['rfc_general'],0,'C');
			
			$this->SetXY($X+80, $Y);
			$X = $this->GetX();
			$Y = $this->GetY();
			$this->MultiCell(30,5,"SELLO OFICIAL (D.G.E.S.T.)",0,'C');
			
			//$this->SetY(-10);
			//$this->SetFont('Arial','',10);
			//$this->Cell(50,0,$row_revision['seis'],0,0);
			//$this->Cell(0,0,"Rev. {$row_revision['revision']}      ",0,0,'R');
		}
	}


	$sql_capitulo5000 = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = dpto.id AND clavepartida >5000 AND clavepartida <6000 and dpto.id = '{$_SESSION['dpto_id']}' ORDER BY clavepartida, descinsu";
	$res_capitulo5000 = mysql_db_query ( $bdd, $sql_capitulo5000) or die(mysql_error());
	while ( $row_capitulo5000 = mysql_fetch_assoc ( $res_capitulo5000 ) )
	{
		$totalpresupuestado += $row_capitulo5000['costuni']*$row_capitulo5000['cantidad'];
	}

	$pdf=new poa1_anexo2('L', 'mm', 'Legal');
	
	$pdf->AddPage();
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Ln(15);
	$pdf->Cell(150,5,"INSTITUTO TECNOLÓGICO DE: TUXTLA GUTIÉRREZ",0,0,'L');
	
	
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	
	$pdf->Rect(225,50,120,6);
	$pdf->SetXY(230,54);
	$pdf->Cell(30,0,"AUTORIZACIÓN DE LA DGEST",0,0,'L');
	$pdf->Rect(225,56,120,6);
	$pdf->SetXY(230,60);
	$pdf->Cell(30,0,"OFICIO No.                                   FECHA",0,0,'L');
	$pdf->Rect(225,62,120,6);
	$pdf->SetXY(230,66);
	$pdf->Cell(30,0,"IMPORTE",0,0,'L');
	$pdf->Rect(225,68,120,10);
	$pdf->SetFont('Arial','',8);
	$pdf->SetXY(230,70);
	$pdf->Cell(30,0,"PRESUPUESTADO                                        AUTORIZADO",0,0,'L');
	$pdf->SetFont('Arial','B',10);
	$pdf->SetXY(230,76);
	$pdf->Cell(30,0,"$".number_format(  $totalpresupuestado  ,2,'.',','),0,0,'L');
	
	$pdf->SetXY($x,$y);
	
	$pdf->SetFont('Arial','',10);
	$pdf->Ln(15);
	$pdf->Cell(80,5,"No. DE OFICIO DE SOLICITUD:",1,0,'L');
	$pdf->Cell(100,5,"{$_POST['oficio']}",1,0,'L');
	$pdf->Ln(5);
	$pdf->Cell(80,5,"FECHA DE SOLICITUD:",1,0,'L');
	$pdf->Cell(100,5,"{$_POST['fecha_sol']}",1,0,'L');
	$pdf->Ln(5);
	$pdf->Cell(80,5,"FECHA O PERIODO DE REALIZACION:",1,0,'L');
	$pdf->Cell(100,5,"{$_POST['fecha_real']}",1,0,'L');
	
	
	//Pendiente el lado izquierdo superior. Explicación
	
	//ALTO MÁXIMO DE 90 PX
	
	$pdf->SetFont('Arial','',8);
	$pdf->Ln(10);
	
	$StandarX = $pdf->GetX();
	$StandarY = $pdf->GetY();
	
	$pdf->Cell(20,5,"No. PARTIDA",1,0,'C');
	$pdf->Cell(105,5,"DENOMINACIÓN DEL BIEN",1,0,'C');
	$pdf->Cell(20,5,"CANTIDAD",1,0,'C');
	$pdf->Cell(30,5,"COSTO UNITARIO",1,0,'C');
	$pdf->Cell(30,5,"COSTO TOTAL",1,0,'C');
	$pdf->Cell(130,5,"JUSTIFICACIÓN",1,0,'C');
	
	
	$totalHeight = 0;
	$TOTAL = 0;
	
	$pdf->Ln(5);
	
	$sql_capitulo5000 = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = dpto.id AND clavepartida >5000 AND clavepartida <6000 and dpto.id = '{$_SESSION['dpto_id']}' GROUP BY clavepartida";
	$res_capitulo5000 = mysql_db_query ( $bdd, $sql_capitulo5000) or die(mysql_error());
	while ( $row_capitulo5000 = mysql_fetch_assoc ( $res_capitulo5000 ) )
	{
	$sql_capitulo5000 = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = dpto.id AND clavepartida >5000 AND clavepartida <6000 and dpto.id = {$_SESSION['dpto_id']} ORDER BY clavepartida, descinsu";
	$res_capitulo5000 = mysql_db_query ( $bdd, $sql_capitulo5000) or die(mysql_error());
	while ( $row_capitulo5000 = mysql_fetch_assoc ( $res_capitulo5000 ) )
	{
		$descinsu = strtoupper ( $row_capitulo5000['descinsu'] );
		$justificacion = strtoupper ( $row_capitulo5000['justificacion'] );
		
		if ( strlen( $justificacion ) > 70)
		{
			$height = ( intval ( strlen( $justificacion ) / 70 ) +1 ) * 5;
		}
		else
		{
			$height = 5;
		}
		
		if ( $totalHeight > 90 or ( $totalHeight+$height ) > 90 )
		{	
			//$pdf->Line($StandarX+335, $StandarY, $StandarX+335, $StandarY+$totalHeight+5);
			//$pdf->Line($StandarX+205, $StandarY+$totalHeight+5, $StandarX+335, $StandarY+$totalHeight+5);
			$pdf->Rect($StandarX, $StandarY, 335, 90 );
			
			
			
			
			$pdf->AddPage();
	
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(15);
			$pdf->Cell(150,5,"INSTITUTO TECNOLÓGICO DE: TUXTLA GUTIÉRREZ",0,0,'L');
			
			
			$x = $pdf->GetX();
			$y = $pdf->GetY();
			
			
			$pdf->Rect(225,50,120,6);
			$pdf->SetXY(230,54);
			$pdf->Cell(30,0,"AUTORIZACIÓN DE LA DGEST",0,0,'L');
			$pdf->Rect(225,56,120,6);
			$pdf->SetXY(230,60);
			$pdf->Cell(30,0,"OFICIO No.                                   FECHA",0,0,'L');
			$pdf->Rect(225,62,120,6);
			$pdf->SetXY(230,66);
			$pdf->Cell(30,0,"IMPORTE",0,0,'L');
			$pdf->Rect(225,68,120,10);
			$pdf->SetFont('Arial','',8);
			$pdf->SetXY(230,70);
			$pdf->Cell(30,0,"PRESUPUESTADO                                        AUTORIZADO",0,0,'L');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetXY(230,76);
			$TOTAL=1;
			$pdf->Cell(30,0,"$".number_format(  $TOTAL  ,2,'.',','),0,0,'L');
			
			$pdf->SetXY($x,$y);
			
			$pdf->SetFont('Arial','',10);
			$pdf->Ln(15);
			$pdf->Cell(80,5,"No. DE OFICIO DE SOLICITUD:",1,0,'L');
			$pdf->Cell(100,5,"{$_POST['oficio']}",1,0,'L');
			$pdf->Ln(5);
			$pdf->Cell(80,5,"FECHA DE SOLICITUD:",1,0,'L');
			$pdf->Cell(100,5,"{$_POST['fecha_sol']}",1,0,'L');
			$pdf->Ln(5);
			$pdf->Cell(80,5,"FECHA O PERIODO DE REALIZACION:",1,0,'L');
			$pdf->Cell(100,5,"{$_POST['fecha_real']}",1,0,'L');
			
			
			//Pendiente el lado izquierdo superior. Explicación
			
			//ALTO MÁXIMO DE 90 PX
			
			$pdf->SetFont('Arial','',8);
			$pdf->Ln(10);
			$pdf->Cell(20,5,"No. PARTIDA",1,0,'C');
			$pdf->Cell(105,5,"DENOMINACIÓN DEL BIEN",1,0,'C');
			$pdf->Cell(20,5,"CANTIDAD",1,0,'C');
			$pdf->Cell(30,5,"COSTO UNITARIO",1,0,'C');
			$pdf->Cell(30,5,"COSTO TOTAL",1,0,'C');
			$pdf->Cell(130,5,"JUSTIFICACIÓN",1,0,'C');
			
			
			$totalHeight = 0;
			$pdf->Ln(5);
		}
		
		$costo_total = $row_capitulo5000['costuni']*$row_capitulo5000['cantidad'];
		$TOTAL += $costo_total;
		$pdf->Cell(20,$height,"{$row_capitulo5000['clavepartida']}",0,0,'C');
		$pdf->Cell(105,$height,"{$descinsu}",0,0,'C');
		$pdf->Cell(20,$height,"{$row_capitulo5000['cantidad']}",0,0,'C');
		$pdf->Cell(30,$height, "$".number_format($row_capitulo5000['costuni'], 2, '.',','),0,0,'C');
		$pdf->Cell(30,$height,"$".number_format($costo_total, 2, '.',','),0,0,'C');
		$xM = $pdf->GetX();
		$yM = $pdf->GetY();
		$pdf->MultiCell(130,5,"{$justificacion}",0,'C');
		$pdf->SetXY($xM+130, $yM);
		$pdf->Ln($height);
		$totalHeight += $height;
		
	}
	}
	
	//$pdf->Line($StandarX+335, $StandarY, $StandarX+335, $StandarY+$totalHeight+5);
	//$pdf->Line($StandarX+205, $StandarY+$totalHeight+5, $StandarX+335, $StandarY+$totalHeight+5);		
	$pdf->Rect($StandarX, $StandarY, 335, 90 );
	
	$pdf->SetXY($StandarX, $StandarY+90);
	$pdf->Cell(175,5,"TOTAL",0,0,'R');
	$pdf->Cell(30,5,"$".number_format($totalpresupuestado,2,'.',','),1,0,'C');
	$pdf->Output();
	
	
?>