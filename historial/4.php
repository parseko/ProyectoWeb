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
			
			$this->SetFont('Arial','',13);
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
				case 1:		$ejercicio = "PROGRAMA OPERATIVO ANUAL ".$row['anio'];
								$leyenda = "POA-3";
								break;
				case 2:		$ejercicio = "REPROGRAMACIÓN DEL PRESUPUESTO ".$row['anio'];
								$leyenda = "RP-2";
								break;
			}
			$this->Cell(0,10,"{$ejercicio}",0,0,'C');
			$this->Ln(7);
			$this->Cell(0,10,"CONCENTRADO PARTIDA PRESUPUESTAL",0,0,'C');
			$this->Image ( "../imagenes/reportes/snest.jpeg", 50, 10, 50.3, 24.9);
			$this->Image ( "../imagenes/reportes/tec.jpeg", 260, 10, 25.4, 24.8);
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',8);
			$this->SetXY(10,20);
			$this->Cell(80,0,"        UR 45",0,0,'L');
			$this->SetXY(260,20);
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
			$this->Cell(50,0,$row_revision['cuatro'],0,0);
			$this->Cell(0,0,"Rev. {$row_revision['revision']}      ",0,0,'R');
		}
	}

	$pdf=new poa1_anexo2('L', 'mm', 'Legal');
	
	$sql_ejercicio = "SELECT * FROM poa WHERE id = {$_GET['ID']}";
	$res_ejercicio = mysql_db_query ( $bdd, $sql_ejercicio );
	$row_ejercicio = mysql_fetch_assoc ( $res_ejercicio );
	
	/*PAGINA1*/
		
	$pdf->AddPage();
		
	$pdf->SetFont('Arial','B',10);
	$pdf->Ln(10);
	
	/*TITULOS*/
	$pdf->Cell(95,10,'PARTIDA',1,0,'C');
	$pdf->Cell(240,5,'PROCESOS',1,0,'C');
	
	$pdf->Ln(5);
	$pdf->Cell(95,10,'',0,0,'C');
	$pdf->Cell(40,5,'P 01',1,0,'C');
	$pdf->Cell(40,5,'P 02',1,0,'C');
	$pdf->Cell(40,5,'P 03',1,0,'C');
	$pdf->Cell(40,5,'P 04',1,0,'C');
	$pdf->Cell(40,5,'P 05',1,0,'C');
	$pdf->Cell(40,5,'P 06',1,0,'C');
	
	$pdf->Ln(5);
	$pdf->Cell(15,5,'CLAVE',1,0,'C');
	$pdf->Cell(80,5,'NOMBRE',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Ln(5);
	/*FIN DE TITULOS*/
	$totalHeight = 0;
	
	
	$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
	$res_partida = mysql_db_query ( $bdd, $sql_partida );
	while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
	{
		if ( strlen( $row_partida['descpartida'] ) % 40 == 0 )
		{
			$height = ( strlen( $row_partida['descpartida'] ) / 40 ) * 5;
		}
		else
		{
			$height = ( intval ( strlen( $row_partida['descpartida'] ) / 40 ) +1 ) * 5;
		}
		
		if ( ( $totalHeight+$height ) > 125 )
		{
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(95,5,'TOTAL POR PROCESO',1,0,'C');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['01'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['01'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['02'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['02'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['03'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['03'] , 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['04'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['04'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['05'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['05'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['06'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['06'], 2, '.',','),1,0,'C');
			
			/*
			$totalProceso_ingreso['01'] = 0;
			$totalProceso_ingreso['02'] = 0;
			$totalProceso_ingreso['03'] = 0;
			$totalProceso_ingreso['04'] = 0;
			$totalProceso_ingreso['05'] = 0;
			$totalProceso_ingreso['06'] = 0;
			
			$totalProceso_operativo['01'] = 0;
			$totalProceso_operativo['02'] = 0;
			$totalProceso_operativo['03'] = 0;
			$totalProceso_operativo['04'] = 0;
			$totalProceso_operativo['05'] = 0;
			$totalProceso_operativo['06'] = 0;
			*/
			
			$pdf->AddPage();
		
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(10);
			
			/*TITULOS*/
			$pdf->Cell(95,10,'PARTIDA',1,0,'C');
			$pdf->Cell(240,5,'PROCESOS',1,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(95,10,'',0,0,'C');
			$pdf->Cell(40,5,'P 01',1,0,'C');
			$pdf->Cell(40,5,'P 02',1,0,'C');
			$pdf->Cell(40,5,'P 03',1,0,'C');
			$pdf->Cell(40,5,'P 04',1,0,'C');
			$pdf->Cell(40,5,'P 05',1,0,'C');
			$pdf->Cell(40,5,'P 06',1,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(15,5,'CLAVE',1,0,'C');
			$pdf->Cell(80,5,'NOMBRE',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Ln(5);
			/*FIN DE TITULOS*/
			$totalHeight = 0;
		}
		
		/*CONTENIDO*/
		$pdf->SetFont('Arial','',8);
		//Partida
		$pdf->Cell(15,$height,$row_partida['clavepartida'],1,0,'C');
		//Descripción de la partida
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell(80,5,$row_partida['descpartida'],'T','J');
		$pdf->SetXY($x+80,$y);
		
		//Procesos 01 a 06
		
		$sql_proceso = "SELECT claveproceso FROM proceso ORDER BY claveproceso LIMIT 0,6";
		$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
		while ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
		{
		
			$sql_ingreso =	"SELECT * FROM historial WHERE claveproceso = {$row_proceso['claveproceso']} AND clavepartida = {$row_partida['clavepartida']} AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']} ORDER BY claveproceso, clavepartida";
			$res_ingreso = mysql_db_query ( $bdd, $sql_ingreso );
			while ( $row_ingreso = mysql_fetch_assoc ( $res_ingreso ) )
			{
				$ingreso_propio[$row_proceso['claveproceso']] += ( $row_ingreso['costuni']*$row_ingreso['cantidad'] );
			}
			
			$sql_operativo = 	"SELECT * FROM historial_federal WHERE claveproceso = {$row_proceso['claveproceso']} AND clavepartida = {$row_partida['clavepartida']} AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']} ORDER BY claveproceso, clavepartida";
			$res_operativo = mysql_db_query ( $bdd, $sql_operativo );
			while ( $row_operativo = mysql_fetch_assoc ( $res_operativo ) )
			{
				$gasto_operativo[$row_proceso['claveproceso']] += $row_operativo['presupuesto'];
			}
			
			$totalProceso_ingreso[$row_proceso['claveproceso']] += $ingreso_propio[$row_proceso['claveproceso']];
			$totalProceso_operativo[$row_proceso['claveproceso']] += $gasto_operativo[$row_proceso['claveproceso']];
			
			$totalPartida_ingreso[$row_partida['clavepartida']] += $ingreso_propio[$row_proceso['claveproceso']];
			$totalPartida_operativo[$row_partida['clavepartida']] += $gasto_operativo[$row_proceso['claveproceso']];
			
			$pdf->Cell(20,$height,'$'.number_format ( $ingreso_propio[$row_proceso['claveproceso']], 2, '.',','),1,0,'C');
			$pdf->Cell(20,$height,'$'.number_format ( $gasto_operativo[$row_proceso['claveproceso']], 2, '.',','),1,0,'C');
			
			$ingreso_propio[$row_proceso['claveproceso']] = 0;
			$gasto_operativo[$row_proceso['claveproceso']] = 0;
			/*FIN DE CONTENIDO*/
		}
		$pdf->Ln($height);
		
		$totalHeight += $height;
	}
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(95,5,'TOTAL POR PROCESO',1,0,'C');
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['01'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['01'], 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['02'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['02'], 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['03'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['03'] , 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['04'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['04'], 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['05'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['05'], 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['06'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['06'], 2, '.',','),1,0,'C');
	
	/*FIN PAGINA 1*/
	
	
	
	
	
	
	
	/*PAGINA2*/
		
	$pdf->AddPage();
		
	$pdf->SetFont('Arial','B',10);
	$pdf->Ln(10);
	
	/*TITULOS*/
	$pdf->Cell(95,10,'PARTIDA',1,0,'C');
	$pdf->Cell(160,5,'PROCESOS',1,0,'C');
	$x = $pdf->GetX();
	$y = $pdf->GetY();
	$pdf->MultiCell(40,5,'PPTO. A CUBRIR A TRAVES DE',1,'C');
	$pdf->SetXY($x+40,$y);
	$pdf->Cell(40,15,'TOTAL',1,0,'C');
	
	$pdf->Ln(5);
	$pdf->Cell(95,10,'',0,0,'C');
	$pdf->Cell(40,5,'P 07',1,0,'C');
	$pdf->Cell(40,5,'P 08',1,0,'C');
	$pdf->Cell(40,5,'P 09',1,0,'C');
	$pdf->Cell(40,5,'P 10',1,0,'C');
	
	$pdf->Ln(5);
	$pdf->Cell(15,5,'CLAVE',1,0,'C');
	$pdf->Cell(80,5,'NOMBRE',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Cell(20,5,'I.P.',1,0,'C');
	$pdf->Cell(20,5,'G.O.',1,0,'C');
	$pdf->Ln(5);
	/*FIN DE TITULOS*/
	$totalHeight = 0;
	
	
	$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
	$res_partida = mysql_db_query ( $bdd, $sql_partida );
	while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
	{
		if ( strlen( $row_partida['descpartida'] ) % 40 == 0 )
		{
			$height = ( strlen( $row_partida['descpartida'] ) / 40 ) * 5;
		}
		else
		{
			$height = ( intval ( strlen( $row_partida['descpartida'] ) / 40 ) +1 ) * 5;
		}
		
		if ( ( $totalHeight+$height ) > 125 )
		{
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(95,5,'TOTAL POR PROCESO',1,0,'C');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['07'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['07'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['08'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['08'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['09'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['09'] , 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['10'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['10'], 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalIngreso, 2, '.',','),1,0,'C');
			
			$pdf->Cell(20,5,'$'.number_format ( $totalOperativo, 2, '.',','),1,0,'C');
			
			$pdf->Cell(40,5,'$'.number_format ( $TOTAL, 2, '.',','),1,0,'C');
			
			/*
			$totalProceso_ingreso['07'] = 0;
			$totalProceso_ingreso['08'] = 0;
			$totalProceso_ingreso['09'] = 0;
			$totalProceso_ingreso['10'] = 0;
			
			$totalProceso_operativo['07'] = 0;
			$totalProceso_operativo['08'] = 0;
			$totalProceso_operativo['09'] = 0;
			$totalProceso_operativo['10'] = 0;
			*/
			
			$pdf->AddPage();
		
			$pdf->SetFont('Arial','B',10);
			$pdf->Ln(10);
			
			/*TITULOS*/
			$pdf->Cell(95,10,'PARTIDA',1,0,'C');
			$pdf->Cell(160,5,'PROCESOS',1,0,'C');
			$x = $pdf->GetX();
			$y = $pdf->GetY();
			$pdf->MultiCell(40,5,'PPTO. A CUBRIR A TRAVES DE',1,'C');
			$pdf->SetXY($x+40,$y);
			$pdf->Cell(40,15,'TOTAL',1,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(95,10,'',0,0,'C');
			$pdf->Cell(40,5,'P 07',1,0,'C');
			$pdf->Cell(40,5,'P 08',1,0,'C');
			$pdf->Cell(40,5,'P 09',1,0,'C');
			$pdf->Cell(40,5,'P 10',1,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(15,5,'CLAVE',1,0,'C');
			$pdf->Cell(80,5,'NOMBRE',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Cell(20,5,'I.P.',1,0,'C');
			$pdf->Cell(20,5,'G.O.',1,0,'C');
			$pdf->Ln(5);
			/*FIN DE TITULOS*/
			$totalHeight = 0;
		}
		
		/*CONTENIDO*/
		$pdf->SetFont('Arial','',8);
		//Partida
		$pdf->Cell(15,$height,$row_partida['clavepartida'],1,0,'C');
		//Descripción de la partida
		$x = $pdf->GetX();
		$y = $pdf->GetY();
		$pdf->MultiCell(80,5,$row_partida['descpartida'],'T','J');
		$pdf->SetXY($x+80,$y);
		
		//Procesos 07 a 10
		
		$sql_proceso = "SELECT claveproceso FROM proceso ORDER BY claveproceso LIMIT 6,4";
		$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
		while ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
		{
		
			$sql_ingreso =	"SELECT * FROM historial WHERE claveproceso = {$row_proceso['claveproceso']} AND clavepartida = {$row_partida['clavepartida']} AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']}	ORDER BY claveproceso, clavepartida";
			$res_ingreso = mysql_db_query ( $bdd, $sql_ingreso );
			while ( $row_ingreso = mysql_fetch_assoc ( $res_ingreso ) )
			{
				$ingreso_propio[$row_proceso['claveproceso']] += $row_ingreso['gasto'];
			}
			
			$sql_operativo = 	"SELECT * FROM historial_federal WHERE claveproceso = {$row_proceso['claveproceso']} AND clavepartida = {$row_partida['clavepartida']} AND anio = {$row_ejercicio['anio']} AND ejercicio = {$row_ejercicio['tipo']} ORDER BY claveproceso, clavepartida";
			$res_operativo = mysql_db_query ( $bdd, $sql_operativo );
			while ( $row_operativo = mysql_fetch_assoc ( $res_operativo ) )
			{
				$gasto_operativo[$row_proceso['claveproceso']] += $row_operativo['presupuesto'];
			}
			
			$totalProceso_ingreso[$row_proceso['claveproceso']] += $ingreso_propio[$row_proceso['claveproceso']];
			$totalProceso_operativo[$row_proceso['claveproceso']] += $gasto_operativo[$row_proceso['claveproceso']];
			
			$totalPartida_ingreso[$row_partida['clavepartida']] += $ingreso_propio[$row_proceso['claveproceso']];
			$totalPartida_operativo[$row_partida['clavepartida']] += $gasto_operativo[$row_proceso['claveproceso']];
			
			$pdf->Cell(20,$height,'$'.number_format ( $ingreso_propio[$row_proceso['claveproceso']], 2, '.',','),1,0,'C');
			$pdf->Cell(20,$height,'$'.number_format ( $gasto_operativo[$row_proceso['claveproceso']], 2, '.',','),1,0,'C');
			
			$ingreso_propio[$row_proceso['claveproceso']] = 0;
			$gasto_operativo[$row_proceso['claveproceso']] = 0;
			/*FIN DE CONTENIDO*/
		}
		$pdf->Cell(20,$height,'$'.number_format ( $totalPartida_ingreso[$row_partida['clavepartida']], 2, '.',','),1,0,'C');
		$pdf->Cell(20,$height,'$'.number_format ( $totalPartida_operativo[$row_partida['clavepartida']], 2, '.',','),1,0,'C');
		
		$totalIngreso += $totalPartida_ingreso[$row_partida['clavepartida']];																		//Total de ingreso propio por partida
		$totalOperativo += $totalPartida_operativo[$row_partida['clavepartida']];																	//Total de gasto operativo por partida
		
		$Total =  $totalPartida_ingreso[$row_partida['clavepartida']]+$totalPartida_operativo[$row_partida['clavepartida']];		//Total por partida
		
		$pdf->Cell(40,$height,'$'.number_format ( $Total, 2, '.',','),1,0,'C');
		
		$TOTAL += $Total;																																				//Total Absoluto
			
		$pdf->Ln($height);
		
		$totalHeight += $height;
	}
	
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(95,5,'TOTAL POR PROCESO',1,0,'C');
	$pdf->SetFont('Arial','B',8);
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['07'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['07'], 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['08'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['08'], 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['09'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['09'] , 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_ingreso['10'], 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalProceso_operativo['10'], 2, '.',','),1,0,'C');
	
	$pdf->Cell(20,5,'$'.number_format ( $totalIngreso, 2, '.',','),1,0,'C');
	$pdf->Cell(20,5,'$'.number_format ( $totalOperativo, 2, '.',','),1,0,'C');
	
	$pdf->Cell(40,5,'$'.number_format ( $TOTAL, 2, '.',','),1,0,'C');
	
	/*FIN PAGINA 2*/
		
	

	$pdf->Output();
?>