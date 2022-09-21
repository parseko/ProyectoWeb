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
			
			$sql = "SELECT * FROM poa WHERE actual = 1";
			$res = mysql_db_query ( $bdd, $sql );
			$row = mysql_fetch_assoc ( $res );
			switch ( $row['tipo'] )
			{
				case 1:		$ejercicio = "PROGRAMA OPERATIVO ANUAL ".$row['anio'];
								break;
			}
			$this->Cell(0,10,"{$ejercicio}",0,0,'C');
			$this->Ln(7);
			$this->Cell(0,10,"CONCENTRADO POR PROCESO",0,0,'C');
			$this->Image ( "../imagenes/reportes/snest.jpeg", 50, 10, 50.3, 24.9);
			$this->Image ( "../imagenes/reportes/tec.jpeg", 260, 10, 25.4, 24.8);
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',8);
			$this->SetXY(10,20);
			$this->Cell(80,0,"        UR 45",0,0,'L');
			$this->SetXY(260,20);
			$this->Cell(80,0,"POA-2",0,0,'R');
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
			$this->Cell(50,0,$row_revision['seis'],0,0);
			$this->Cell(0,0,"Rev. {$row_revision['revision']}      ",0,0,'R');
		}
	}

	$pdf=new poa1_anexo2('L', 'mm', 'Legal');
	
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
		//$pdf->Cell (30, 20, "ACTIVIDAD", 1, 0, 'C');
		$pdf->Cell (35, 15, "ACCION", 1, 0, 'C');
		//$pdf->Cell (90, 20, "CONCEPTO", 1, 0, 'C');
		$pdf->Cell (118, 15, "UNIDAD DE MEDIDA", 1, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell (45.5, 7.5, "META\nANUAL", 1, 'C');
		$pdf->SetXY($x+45.5,$y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell (45.5, 7.5, "PRESUPUESTO\nANUAL", 1, 'C');
		$pdf->SetXY($x+45.5,$y);
		$pdf->Cell (91, 5, "PRESUPUESTO A CUBRIR A TRAVES DE", 1, 0, 'C');
		$pdf->Ln(5);
		$pdf->Cell (244, 5, "", 0, 0, 'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell (45.5, 5, "INGRESOS\nPROPIOS", 1, 'C');
		$pdf->SetXY($x+45.5,$y);
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell (45.5, 5, "GASTOS DE\nOPERACIÓN", 1, 'C');
		$pdf->SetXY($x+45.5,$y);
		$totalHeight = 0;
		$pdf->Ln(10);
		
		
		$sql_unidadmedida = "SELECT proceso.claveproceso, actividad.claveActiv, accion.claveAccion, accion.nombreAccion, unidadmedida.tipounidad, unidadmedida.id AS unidadmedida_id FROM proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND proceso.id = {$row_proyecto['id']} ORDER BY claveActiv, claveAccion, tipounidad";
		$res_unidadmedida = mysql_db_query ( $bdd, $sql_unidadmedida );
		while ( $row_unidadmedida = mysql_fetch_assoc ( $res_unidadmedida ) )
		{
			$ingreso = 0;
			$operacional = 0;
			$metas = 0;
			
			$sql_ingreso = 	"SELECT proceso.claveproceso, actividad.claveActiv, accion.claveAccion, accion.nombreAccion, unidadmedida.id AS unidadmedida_id, unidadmedida.tipounidad, ( poa_dpto.cantidad*insumo.costuni ) AS gasto
								FROM proceso, actividad, accion, unidadmedida, poa_dpto, insumo
								WHERE proceso.id = actividad.proceso_id
								AND actividad.id = accion.actividad_id
								AND accion.id = unidadmedida.accion_id
								AND unidadmedida.id = poa_dpto.unidadmedida_id
								AND poa_dpto.insumo_id = insumo.id
								AND unidadmedida.id = {$row_unidadmedida['unidadmedida_id']}
								ORDER BY claveproceso, claveActiv, claveAccion";
			$res_ingreso = mysql_db_query ( $bdd, $sql_ingreso );
			while ( $row_proceso = mysql_fetch_assoc ( $res_ingreso ) )
			{
				$ingreso += $row_proceso['gasto'];
			}
			$sql_operacional = 	"SELECT proceso.claveproceso, actividad.claveActiv, accion.claveAccion, unidadmedida.tipounidad, gob_federal.presupuesto
										FROM proceso, actividad, accion, unidadmedida, gob_federal
										WHERE proceso.id = actividad.proceso_id
										AND actividad.id = accion.actividad_id
										AND accion.id = unidadmedida.accion_id
										AND unidadmedida.id = gob_federal.unidadmedida_id
										AND unidadmedida.id = {$row_unidadmedida['unidadmedida_id']}
										ORDER BY claveproceso, claveActiv, claveAccion";
			$res_operacional = mysql_db_query ( $bdd, $sql_operacional );
			while ( $row_operacional = mysql_fetch_assoc ( $res_operacional ) )
			{
				$operacional += $row_operacional['presupuesto'];
			}
			
			$sql_metas = "SELECT * FROM metas WHERE unidadmedida_id = {$row_unidadmedida['unidadmedida_id']}";
			$res_metas = mysql_db_query ( $bdd, $sql_metas );
			while ( $row_metas = mysql_fetch_assoc ( $res_metas ) )
			{
				$metas += $row_metas['enero']+$row_metas['febrero']+$row_metas['marzo']+$row_metas['abril']+$row_metas['mayo']+$row_metas['junio']+$row_metas['julio']+$row_metas['agosto']+$row_metas['septiembre']+$row_metas['octubre']+$row_metas['noviembre']+$row_metas['diciembre'];
			}
						
			$total = $operacional + $ingreso;
			
			$totalIngreso +=$ingreso;
			$totalOperacional += $operacional;
			
			$TOTAL += $total;
			
			if ( strlen( $row_unidadmedida['tipounidad'] ) % 90 == 0 )
			{
				$height = ( strlen( $row_unidadmedida['tipounidad'] ) / 90 ) * 5;
			}
			else
			{
				$height = ( intval ( strlen( $row_unidadmedida['tipounidad'] ) / 90 ) +1 ) * 5;
			}
			
			$pdf->SetFont('Arial','',8);
			//$pdf->Cell (30, $height, "{$row_unidadmedida['claveActiv']}", 1, 0, 'C');
			$pdf->Cell (35, $height, "{$row_unidadmedida['claveActiv']}.{$row_unidadmedida['claveAccion']}", 1, 0, 'C');
			//$x = $pdf->GetX();
			//$y = $pdf->GetY();
			//$pdf->MultiCell (90, 5, "{$row_unidadmedida['nombreAccion']}", 'TLR', 'J');
			//$pdf->SetXY($x+90,$y);
			$x = $pdf->GetX();
			$y = $pdf->GetY();
			$pdf->MultiCell (118, 5, "{$row_unidadmedida['tipounidad']}", 'TLR', 'J');
			$pdf->SetXY($x+118,$y);
			$pdf->Cell (45.5, $height, number_format ( $metas, 0, '.',','), 1, 0, 'C');
			$pdf->Cell (45.5, $height, '$'.number_format ( $total, 2,'.',','), 1, 0, 'C');
			$pdf->Cell (45.5, $height, '$'.number_format ( $ingreso, 2,'.',','), 1, 0, 'C');
			$pdf->Cell (45.5, $height, '$'.number_format ( $operacional, 2,'.',','), 1, 0, 'C');
			
			$pdf->Ln($height);
			$totalHeight += $height;
		}
		
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(198.5,5,"TOTAL", 0,0,'R');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(45.5, 5,'$'.number_format ( $TOTAL, 2,'.',','),1,0, 'C');
		$pdf->Cell(45.5, 5,'$'.number_format ( $totalIngreso, 2,'.',','),1,0, 'C');
		$pdf->Cell(45.5, 5,'$'.number_format ( $totalOperacional, 2,'.',','),1,0, 'C');
		
		$totalIngreso = 0;
		$totalOperacional = 0;
		$TOTAL = 0;
		
		$pdf->SetXY($X,$Y);
		$pdf->Cell(35, $totalHeight+15,"",1,0);
		$pdf->Cell(118, $totalHeight+15,"",1,0);
		$pdf->Cell(45.5, $totalHeight+15,"",1,0);
		$pdf->Cell(45.5, $totalHeight+15,"",1,0);
		$pdf->SetXY($X+244,$Y+5);
		$pdf->Cell(45.5, $totalHeight+15,"",1,0);
		$pdf->Cell(45.5, $totalHeight+15,"",1,0);
		//$pdf->Cell(38.5, $totalHeight+20,"",1,0);
		//$pdf->Cell(30, $totalHeight+20,"",1,0);
	}
	
	
		
	$pdf->Output();
	
	
?>