<?php

	require('../fpdf/fpdf.php');
	include_once ( "../conexion/conexion.php" );


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
			$sql = "SELECT * FROM poa WHERE actual = 1";
			$res = mysql_db_query ( $bdd, $sql );
			$row = mysql_fetch_assoc ( $res );
			
			switch ( $row['tipo'] )
			{
				case 1:		$ejercicio = "PROGRAMA OPERATIVO ANUAL ".$row['anio'];
								$titulo = "CONCENTRADO DEL ANTEPROYECTO";
								$leyenda = "POA-4";
								break;
				case 2:		$ejercicio = "REPROGRAMACIÓN DEL PRESUPUESTO ".$row['anio'];
								$titulo = "CONCENTRADO DEL ANTEPROYECTO";
								$leyenda = "RP-1";
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
			$this->Cell(50,0,$row_revision['tres'],0,0);
			$this->Cell(0,0,"Rev. {$row_revision['revision']}                ",0,0,'R');
		}
	}

	$pdf=new poa1_anexo2();
	
	$pdf->AddPage();
	$pdf->Ln(20);
	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(40,13,"PROCESO",1,0,'C');
	$pdf->Cell(60,13,"DESCRIPCIÓN",1,0,'C');
	$pdf->Cell(30,5,"PRESUPUESTO",'T',0,'C');
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(60,5,"PRESUPUESTO A CUBRIR A TRAVES DE",1,0,'C');
	
	$pdf->Ln(5);
	$pdf->Cell(100,5,"",0,0,'C');
	$pdf->Cell(30,8,"TOTAL",'B',0,'C');
	$pdf->Cell(30,8,"INGRESOS PROPIOS",1,0,'C');
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$pdf->MultiCell(30,4,"GASTO DE OPERACIÓN",1,'C');
	$pdf->SetXY($x+30,$y);
	$pdf->Ln(8);
	
	
	
	$sql_ciclo = "SELECT * FROM proceso ORDER BY claveproceso";
	$res_ciclo = mysql_db_query ( $bdd, $sql_ciclo );
	while ( $row_ciclo = mysql_fetch_assoc ( $res_ciclo ) )
	{
		$propio = 0;
		$subsidio = 0;
		
		$sql_proyecto = "SELECT proceso.id AS proceso_id, proceso.proyecto, proceso.claveproceso, actividad.claveActiv, accion.claveAccion, unidadmedida.id AS unidadMedida, unidadmedida.tipounidad FROM proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND proceso.id = {$row_ciclo['id']}";
		$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
		while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
		{
			
			$sql_propio = "SELECT * FROM poa_dpto, insumo WHERE poa_dpto.insumo_id = insumo.id AND unidadmedida_id = {$row_proyecto['unidadMedida']}";
			$res_propio = mysql_db_query ( $bdd, $sql_propio );
			while ( $row_propio = mysql_fetch_assoc ( $res_propio ) )
			{
				$propio += ( $row_propio['costuni']*$row_propio['cantidad'] );
			}
			
			$sql_subsidio = "SELECT * FROM gob_federal WHERE unidadmedida_id = {$row_proyecto['unidadMedida']}";
			$res_subsidio = mysql_db_query ( $bdd, $sql_subsidio );
			while ( $row_subsidio = mysql_fetch_assoc ( $res_subsidio ) )
			{
				$subsidio += $row_subsidio['presupuesto'];
			}
		}
		
		if ( strlen ( $row_ciclo['nombreproceso'] ) > 32 )
		{
			$height = 10;
		}
		else
		{
			$height = 5;
		}
		
		$total = $propio+$subsidio;
		
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(40,$height,"{$row_ciclo['proyecto']}{$row_ciclo['claveproceso']}",1,0,'C');
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell(60,5,"{$row_ciclo['nombreproceso']}",1,'L');
		$pdf->SetXY($x+60,$y);
		$pdf->Cell(30,$height, "$ ".number_format ( $total,2,'.',',') ,'1',0,'C');
		$pdf->Cell(30,$height,"$ ".number_format ( $propio,2,'.',','),'1',0,'C');
		$pdf->Cell(30,$height,"$ ".number_format ( $subsidio,2,'.',','),'1',0,'C');
		$TOTAL += $total;
		$TOTAL2 += $propio;
		$TOTAL3+= $subsidio;
		$pdf->Ln($height);		
	}	
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(40,5,"",0,0,'C');
	$pdf->Cell(60,5,"TOTAL",0,0,'R');
	$pdf->Cell(30,5, "$ ".number_format ( $TOTAL,2,'.',',') ,'1',0,'C');
	$pdf->Cell(30,5, "$ ".number_format ( $TOTAL2,2,'.',',') ,'1',0,'C');
	$pdf->Cell(30,5, "$ ".number_format ( $TOTAL3,2,'.',',') ,'1',0,'C');
	
	$pdf->Output();

?>