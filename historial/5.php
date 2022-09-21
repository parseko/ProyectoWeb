<?php
	require('../fpdf/fpdf.php');
	include_once ( "../conexion/conexion.php" );

	class poa1_anexo2 extends FPDF
	{
		private $baseDeDatos = "sicopre";
		
		function Header()
		{	
			$bdd = "sicopre";
			
			$this->SetFont('Arial','',12);
			//Título
			$this->Cell(0,10,'	INSTITUTO TECNOLOGICO DE TUXTLA GUTIERREZ',0,0,'C');
			//Salto de línea
			$this->Ln(15);
			$this->SetFont('Arial','',10);
			
			$sql = "SELECT * FROM poa WHERE id = {$_GET['ID']}";
			$res = mysql_db_query ( $bdd, $sql );
			$row = mysql_fetch_assoc ( $res );
			switch ( $row['tipo'] )
			{
				case 2:		$ejercicio = "REPROGRAMACIÓN DEL PRESUPUESTO ".$row['anio'];
								break;
			}
			$this->Cell(0,10,"{$ejercicio}",0,0,'C');
			$this->Ln(7);
			$this->Cell(0,10,"ANALÍTICO POR PROCESO",0,0,'C');
			$this->Image ( "../imagenes/reportes/snest.jpeg", 50, 10, 50.3, 24.9);
			$this->Image ( "../imagenes/reportes/tec.jpeg", 260, 10, 25.4, 24.8);
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',8);
			$this->SetXY(10,20);
			$this->Cell(80,0,"        UR 45",0,0,'L');
			$this->SetXY(260,20);
			$this->Cell(80,0,"RP-1",0,0,'R');
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
			$this->SetY(-10);
			$this->SetFont('Arial','',10);
			$this->Cell(50,0,$row_revision['cinco'],0,0);
			$this->Cell(0,0,"Rev. {$row_revision['revision']}      ",0,0,'R');
		}
	}

	$pdf=new poa1_anexo2('L', 'mm', 'Legal');
	
	$sql_ejercicio = "SELECT * FROM poa WHERE id = {$_GET['ID']}";
	$res_ejercicio = mysql_db_query ( $bdd, $sql_ejercicio );
	$row_ejercicio = mysql_fetch_assoc ( $res_ejercicio );
	
	$sql_proyecto = "SELECT * FROM proceso ORDER BY claveproceso";
	$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
	while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
	{
				
		$pdf->AddPage();
		
		$pdf->SetFont('Arial','B',10);
		$pdf->Ln(10);
		$pdf->Cell ( 0,10,"Proceso: {$row_proyecto['proyecto']}{$row_proyecto['claveproceso']}", 0,0,'C');
		
		$pdf->Ln(10);
		$X = $pdf->GetX();
		$Y = $pdf->GetY();
		$pdf->Cell (30, 20, "ACTIVIDAD", 1, 0, 'C');
		$pdf->Cell (30, 20, "ACCION", 1, 0, 'C');
		$pdf->Cell (90, 20, "CONCEPTO", 1, 0, 'C');
		$pdf->Cell (40, 20, "UNIDAD DE MEDIDA", 1, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell (38.5, 6.7, "META\nREPROGRAMADA\nANUAL", 1, 'C');
		$pdf->SetXY($x+38.5,$y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell (38.5, 5, "PRESUPUESTO REPROGRAMADO ANUAL VIA INGRESOS PROPIOS", 1, 'C');
		$pdf->SetXY($x+38.5,$y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell (38.5, 5, "PRESUPUESTO REPROGRAMADO ANUAL VIA GASTO DE OPERACIÓN", 1, 'C');
		$pdf->SetXY($x+38.5,$y);
		$pdf->Cell (30, 20, "TOTAL", 1, 0, 'C');
		$totalHeight = 0;
		$pdf->Ln(20);
		
		
		$sql_unidadmedida = "SELECT proceso.claveproceso, actividad.claveActiv, accion.claveAccion, accion.nombreAccion, unidadmedida.tipounidad, unidadmedida.id AS unidadmedida_id FROM proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND proceso.id = {$row_proyecto['id']} ORDER BY claveActiv, claveAccion, tipounidad";
		$res_unidadmedida = mysql_db_query ( $bdd, $sql_unidadmedida );
		while ( $row_unidadmedida = mysql_fetch_assoc ( $res_unidadmedida ) )
		{
			$ingreso = 0;
			$operacional = 0;
			$metas = 0;
			
			$sql_ingreso = 	"SELECT * FROM historial WHERE claveproceso = '{$row_unidadmedida['claveproceso']}' AND claveActiv = {$row_unidadmedida['claveActiv']} AND claveAccion = {$row_unidadmedida['claveAccion']} AND tipounidad = '{$row_unidadmedida['tipounidad']}' AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']}";
			$res_ingreso = mysql_db_query ( $bdd, $sql_ingreso );
			while ( $row_proceso = mysql_fetch_assoc ( $res_ingreso ) )
			{
				$ingreso += ( $row_proceso['costuni']*$row_proceso['cantidad'] );
			}
			$sql_operacional = 	"SELECT * FROM historial_federal WHERE claveproceso = '{$row_unidadmedida['claveproceso']}' AND claveActiv = {$row_unidadmedida['claveActiv']} AND claveAccion = {$row_unidadmedida['claveAccion']} AND tipounidad = '{$row_unidadmedida['tipounidad']}' AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']}";
			$res_operacional = mysql_db_query ( $bdd, $sql_operacional );
			while ( $row_operacional = mysql_fetch_assoc ( $res_operacional ) )
			{
				$operacional += $row_operacional['presupuesto'];
			}
			
			$sql_metas = "SELECT * FROM historial_metas WHERE claveproceso = '{$row_unidadmedida['claveproceso']}' AND claveActiv = {$row_unidadmedida['claveActiv']} AND claveAccion = {$row_unidadmedida['claveAccion']} AND tipounidad = '{$row_unidadmedida['tipounidad']}' AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']}";
			$res_metas = mysql_db_query ( $bdd, $sql_metas );
			while ( $row_metas = mysql_fetch_assoc ( $res_metas ) )
			{
				$metas += $row_metas['meta'];
			}
			
			$total = $operacional + $ingreso;
			
			$totalIngreso +=$ingreso;
			$totalOperacional += $operacional;
			
			$TOTAL += $total;
			
			if ( strlen( $row_unidadmedida['nombreAccion'] ) % 47 == 0 )
			{
				$height1 = ( strlen( $row_unidadmedida['nombreAccion'] ) / 47 ) * 5;
			}
			else
			{
				$height1 = ( intval ( strlen( $row_unidadmedida['nombreAccion'] ) / 47 ) +1 ) * 5;
			}
			
			if ( strlen( $row_unidadmedida['tipounidad'] ) % 20 == 0 )
			{
				$height2 = ( strlen( $row_unidadmedida['tipounidad'] ) / 20 ) * 5;
			}
			else
			{
				$height2 = ( intval ( strlen( $row_unidadmedida['tipounidad'] ) / 20 ) +1 ) * 5;
			}
			
			if ( $height1 > $height2 )		{	$height = $height1; }
			else									{	$height = $height2;	}
			
			$pdf->SetFont('Arial','',8);
			$pdf->Cell (30, $height, "{$row_unidadmedida['claveActiv']}", 1, 0, 'C');
			$pdf->Cell (30, $height, "{$row_unidadmedida['claveAccion']}", 1, 0, 'C');
			$x = $pdf->GetX();
			$y = $pdf->GetY();
			$pdf->MultiCell (90, 5, "{$row_unidadmedida['nombreAccion']}", 'TLR', 'J');
			$pdf->SetXY($x+90,$y);
			$x = $pdf->GetX();
			$y = $pdf->GetY();
			$pdf->MultiCell (40, 5, "{$row_unidadmedida['tipounidad']}", 'TLR', 'J');
			$pdf->SetXY($x+40,$y);
			$pdf->Cell (38.5, $height, number_format ( $metas, 0, '.',','), 1, 0, 'C');
			$pdf->Cell (38.5, $height, '$'.number_format ( $ingreso, 2,'.',','), 1, 0, 'C');
			$pdf->Cell (38.5, $height, '$'.number_format ( $operacional, 2,'.',','), 1, 0, 'C');
			$pdf->Cell (30, $height, '$'.number_format ( $total, 2,'.',','), 1, 0, 'C');
			
			$pdf->Ln($height);
			$totalHeight += $height;
		}
		
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(228.5,5,"TOTAL DEL PROCESO", 0,0,'R');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(38.5, 5,'$'.number_format ( $totalIngreso, 2,'.',','),1,0, 'C');
		$pdf->Cell(38.5, 5,'$'.number_format ( $totalOperacional, 2,'.',','),1,0, 'C');
		$pdf->Cell(30, 5,'$'.number_format ( $TOTAL, 2,'.',','),1,0, 'C');
		
		$totalIngreso = 0;
		$totalOperacional = 0;
		$TOTAL = 0;
		
		$pdf->SetXY($X,$Y);
		$pdf->Cell(30, $totalHeight+20,"",1,0);
		$pdf->Cell(30, $totalHeight+20,"",1,0);
		$pdf->Cell(90, $totalHeight+20,"",1,0);
		$pdf->Cell(40, $totalHeight+20,"",1,0);
		$pdf->Cell(38.5, $totalHeight+20,"",1,0);
		$pdf->Cell(38.5, $totalHeight+20,"",1,0);
		$pdf->Cell(38.5, $totalHeight+20,"",1,0);
		$pdf->Cell(30, $totalHeight+20,"",1,0);
	}
	
		
	$pdf->Output();
	
	
?>