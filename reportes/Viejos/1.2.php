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
			
			$this->SetFont('Arial','',10);
			//Título
			$sql = "SELECT * FROM poa WHERE actual = 1";
			$res = mysql_db_query ( $bdd, $sql );
			$row = mysql_fetch_assoc ( $res );
			
			switch ( $row['tipo'] )
			{
				case 1:		$ejercicio = "PROGRAMA OPERATIVO ANUAL ".$row['anio'];
								break;
				case 2:		$ejercicio = "REPROGRAMACIÓN OPERATIVA ANUAL ".$row['anio'];
								break;
			}
			$this->Cell(0,10,"{$ejercicio}",0,0,'C');
			//Salto de línea
			$this->Ln(7);
			$this->SetFont('Arial','',9);
			$this->Cell(0,10,'INSTITUTO TECNOLOGICO DE TUXTLA GUTIERREZ',0,0,'C');		
			$this->Ln(7);
			$this->Cell(0,10,"DESGLOCE DEL PRESUPUESTO",0,0,'C');
			$this->Image ( "../imagenes/reportes/snest.jpeg", 15, 10, 35, 18);
			$this->Image ( "../imagenes/reportes/tec.jpeg", 163, 10, 25.4, 24.8);
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',8);
			$this->SetXY(10,35);
			$this->Cell(80,0,"????",0,0,'L');
			$this->SetXY(120,35);
			$this->Cell(80,0,"POA-1",0,0,'R');
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
			$this->Cell(50,0,$row_revision['uno'],0,0);
			$this->Cell(0,0,"Rev. {$row_revision['revision']}                ",0,0,'R');
		}
	}

	$pdf=new poa1_anexo2();
	
	$sql_proyectos = "SELECT DISTINCT proceso.id AS proceso_id, proceso.proyecto, proceso.claveproceso, proceso.nombreproceso, actividad.id AS actividad_id, actividad.claveActiv, actividad.nombreactiv, accion.id AS accion_id, accion.claveAccion, accion.nombreAccion FROM proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id ORDER BY claveproceso, claveActiv, claveAccion";
	$res_proyectos = mysql_db_query ( $bdd, $sql_proyectos );
	while ( $row_proyectos = mysql_fetch_assoc ( $res_proyectos ) )
	{
	
		//Datos de ingreso propio
		$sql_propios = "SELECT partida.clavepartida, unidadmedida.id AS unidadmedida_id, poa_dpto.cantidad, insumo.costuni FROM partida, unidadmedida, poa_dpto, insumo WHERE poa_dpto.partida_id = partida.id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.unidadmedida_id = unidadmedida.id AND unidadmedida.accion_id = {$row_proyectos['accion_id']}";
		$res_propios_validacion = mysql_db_query ( $bdd, $sql_propios );
		
		//Datos de subsidio
		$sql_subsidio = "SELECT DISTINCT partida.clavepartida, partida.descpartida, proceso.id AS proceso_id, proceso.claveproceso, actividad.id AS actividad_id, actividad.claveActiv, accion.id AS accion_id, accion.claveAccion, unidadmedida.id AS unidadmedida_id, unidadmedida.tipounidad, gob_federal.presupuesto	FROM partida, gob_federal, proceso, actividad, accion, unidadmedida WHERE partida.id = gob_federal.partida_id AND gob_federal.unidadmedida_id = unidadmedida.id AND unidadmedida.accion_id = accion.id AND accion.actividad_id = actividad.id AND actividad.proceso_id = proceso.id AND proceso.id = {$row_proyectos['proceso_id']} AND actividad.id = {$row_proyectos['actividad_id']} AND accion.id = {$row_proyectos['accion_id']} ORDER BY proceso.claveproceso, actividad.claveActiv, accion.claveAccion, partida.clavepartida";
		$res_subsidio_validacion = mysql_db_query ( $bdd, $sql_subsidio );
		
		if ( $row_subsidio_validacion = mysql_fetch_assoc ( $res_subsidio_validacion ) or $row_propios_validacion = mysql_fetch_assoc ( $res_propios_validacion ) )
		{
			$pdf->Ln(5);
			$pdf->Cell(100,5,"TOTAL",0,0,'R');
			$pdf->Cell(30,5,'$'.number_format ($TOTAL, 2, '.',','),1,0,'C');
			$pdf->Cell(30,5,'$'.number_format ($TOTAL2, 2, '.',','),1,0,'C');
			$pdf->Cell(30,5,'$'.number_format ($TOTAL3, 2, '.',','),1,0,'C');
			$TOTAL = 0;
			$TOTAL2 = 0;
			$TOTAL3 = 0;
			
			$pdf->AddPage();
			$pdf->Ln(15);
			
			//Proceso, Actividad y Acción
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(25,5,"PROCESO: ",0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,"{$row_proyectos['proyecto']}{$row_proyectos['claveproceso']}",0,0,'C');
			$pdf->MultiCell(120,5,"{$row_proyectos['nombreproceso']}",0,'L');
			$pdf->Ln(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(25,5,"ACTIVIDAD: ",0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,"{$row_proyectos['claveActiv']}",0,0,'C');
			$pdf->MultiCell(120,5,"{$row_proyectos['nombreactiv']}",0,'L');
			$pdf->Ln(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(25,5,"ACCIÓN: ",0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,"{$row_proyectos['claveAccion']}",0,0,'C');
			$pdf->MultiCell(120,5,"{$row_proyectos['nombreAccion']}",0,'L');
			
			//Comienza la Tabla
			
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(100,5,"PARTIDA PRESUPUESTAL",1,0,'C');
			$pdf->Cell(30,10,"IMPORTE ANUAL",1,0,'C');
			$pdf->Cell(60,5,"PRESUPUESTO A CUBRIR A TRAVES DE",1,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(20,5,"CLAVE",1,0,'C');
			$pdf->Cell(80,5,"DESCRIPCIÓN",1,0,'C');
			$pdf->Cell(30,5,"",0,0,'C');
			$pdf->Cell(30,5,"INGRESOS PROPIOS",1,0,'C');
			$pdf->Cell(30,5,"SUBSIDIO",1,0,'C');
			
			$renglones = 0;
			
			
			$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
			$res_partida = mysql_db_query ( $bdd, $sql_partida );
			while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
			{
				//Datos de ingreso propio
				$sql_propios = "SELECT partida.clavepartida, unidadmedida.id AS unidadmedida_id, poa_dpto.cantidad, insumo.costuni FROM partida, unidadmedida, poa_dpto, insumo WHERE poa_dpto.partida_id = partida.id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.unidadmedida_id = unidadmedida.id AND unidadmedida.accion_id = {$row_proyectos['accion_id']} AND partida.clavepartida = {$row_partida['clavepartida']}";
						
				//Datos de subsidio
				$sql_subsidio = "SELECT DISTINCT partida.clavepartida, partida.descpartida, proceso.id AS proceso_id, proceso.claveproceso, actividad.id AS actividad_id, actividad.claveActiv, accion.id AS accion_id, accion.claveAccion, unidadmedida.id AS unidadmedida_id, unidadmedida.tipounidad, gob_federal.presupuesto	FROM partida, gob_federal, proceso, actividad, accion, unidadmedida WHERE partida.id = gob_federal.partida_id AND gob_federal.unidadmedida_id = unidadmedida.id AND unidadmedida.accion_id = accion.id AND accion.actividad_id = actividad.id AND actividad.proceso_id = proceso.id AND proceso.id = {$row_proyectos['proceso_id']} AND actividad.id = {$row_proyectos['actividad_id']} AND accion.id = {$row_proyectos['accion_id']} AND clavepartida = {$row_partida['clavepartida']} ORDER BY proceso.claveproceso, actividad.claveActiv, accion.claveAccion, partida.clavepartida";
				
				$res_propios = mysql_db_query ( $bdd, $sql_propios );
				$res_subsidio = mysql_db_query ( $bdd, $sql_subsidio );	
				
				$ingresos_propios = 0;
				$presupuesto = 0;
				while ( $row_propios = mysql_fetch_assoc ( $res_propios ) )
				{
					$ingresos_propios += $row_propios['cantidad']*$row_propios['costuni'];
				}
				while ( $row_subsidio = mysql_fetch_assoc ( $res_subsidio ) )
				{
					$presupuesto += $row_subsidio['presupuesto'];
				}
				
				if ( $ingresos_propios > 0 or $presupuesto > 0 )
				{
					if ( $renglones > 37 )
					{
						$renglones = 0;
						$pdf->AddPage();
						$pdf->Ln(15);
			
						//Proceso, Actividad y Acción
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"PROCESO: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_proyectos['proyecto']}{$row_proyectos['claveproceso']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_proyectos['nombreproceso']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACTIVIDAD: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_proyectos['claveActiv']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_proyectos['nombreactiv']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACCIÓN: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_proyectos['claveAccion']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_proyectos['nombreAccion']}",0,'L');
				
						//Comienza la Tabla
				
						$pdf->Ln(5);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(100,5,"PARTIDA PRESUPUESTAL",1,0,'C');
						$pdf->Cell(30,10,"IMPORTE ANUAL",1,0,'C');
						$pdf->Cell(60,5,"PRESUPUESTO A CUBRIR A TRAVES DE",1,0,'C');
				
						$pdf->Ln(5);
						$pdf->Cell(20,5,"CLAVE",1,0,'C');
						$pdf->Cell(80,5,"DESCRIPCIÓN",1,0,'C');
						$pdf->Cell(30,5,"",0,0,'C');
						$pdf->Cell(30,5,"INGRESOS PROPIOS",1,0,'C');
						$pdf->Cell(30,5,"SUBSIDIO",1,0,'C');
					}
					$importe_anual = $ingresos_propios+$presupuesto;
					$pdf->Ln(5);
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(20,5,"{$row_partida['clavepartida']}",1,0,'C');
					$pdf->SetFont('Arial','',6);
					if ( strlen($row_partida['descpartida']) > 60 )
					{
						$descpartida = substr($row_partida['descpartida'], 0, 59)."..."; 
					}
					else
					{
						$descpartida = $row_partida['descpartida'];
					}
					$pdf->Cell(80,5,"{$descpartida}",1,0,'J');
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(30,5,"$ ".number_format ( $importe_anual,2,'.',','),1,0,'C');
					$pdf->Cell(30,5,"$ ".number_format ( $ingresos_propios,2,'.',','),1,0,'C');
					$pdf->Cell(30,5,"$ ".number_format ( $presupuesto,2,'.',','),1,0,'C');
					$TOTAL += $importe_anual;
					$TOTAL2 += $ingresos_propios;
					$TOTAL3 += $presupuesto;
					$renglones++;
				}
			}
		}
	}	
	
	$pdf->Ln(5);
	$pdf->Cell(100,5,"TOTAL",0,0,'R');
	$pdf->Cell(30,5,'$'.number_format ($TOTAL, 2, '.',','),1,0,'C');
	$pdf->Cell(30,5,'$'.number_format ($TOTAL2, 2, '.',','),1,0,'C');
	$pdf->Cell(30,5,'$'.number_format ($TOTAL3, 2, '.',','),1,0,'C');
	
	$pdf->Output();
?>