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
			$this->Cell(80,0,"UR 45",0,0,'L');
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
	
	$totalImporte = 0;
	$totalPropio = 0;
	$totalOperacional = 0;
	
	$paginas = 0;
	
	$sql_proyecto = "SELECT proceso.proyecto, proceso.claveproceso, proceso.nombreproceso, actividad.claveActiv, actividad.nombreactiv, accion.claveAccion, accion. nombreAccion FROM proceso, actividad, accion WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id ORDER BY claveproceso, claveActiv, claveAccion";
	$res_proyecto = mysql_db_query ( $bdd, $sql_proyecto );
	while ( $row_proyecto = mysql_fetch_assoc ( $res_proyecto ) )
	{	
		$sql_propios = "SELECT proceso.claveproceso, proceso.nombreproceso, actividad.claveActiv, actividad.nombreActiv, accion.claveAccion, accion.nombreAccion, unidadmedida.tipounidad, partida.clavepartida FROM proceso, actividad, accion, unidadmedida, partida, poa_dpto WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND unidadmedida.id = poa_dpto.unidadmedida_id AND poa_dpto.partida_id = partida.id AND proceso.claveproceso = '{$row_proyecto['claveproceso']}' AND actividad.claveActiv = {$row_proyecto['claveActiv']} AND accion.claveAccion = {$row_proyecto['claveAccion']} ORDER BY claveproceso, claveActiv, claveAccion, clavepartida";
		$res_propiosP = mysql_db_query ( $bdd, $sql_propios );
			
		$sql_operacional = "SELECT proceso.claveproceso, actividad.claveActiv, accion.claveAccion, unidadmedida.tipounidad, partida.clavepartida, gob_federal.presupuesto FROM proceso, actividad, accion, unidadmedida, gob_federal, partida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND unidadmedida.id = gob_federal.unidadmedida_id AND gob_federal.partida_id = partida.id AND proceso.claveproceso = '{$row_proyecto['claveproceso']}' AND actividad.claveActiv = {$row_proyecto['claveActiv']} AND accion.claveAccion = {$row_proyecto['claveAccion']} ORDER BY claveproceso, claveActiv, claveAccion, clavepartida";
		$res_operacionalP = mysql_db_query ( $bdd, $sql_operacional );
		
		if ( $row_propiosP = mysql_fetch_assoc ( $res_propiosP ) or $row_operacionalP = mysql_fetch_assoc ( $res_operacionalP ) )
		{
			$paginas++;
		
			$pdf->AddPage();
			$pdf->Ln(15);
			
			//Proceso, Actividad y Acción
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(25,5,"PROCESO: ",0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,"{$row_proyecto['proyecto']}{$row_proyecto['claveproceso']}",0,0,'C');
			$pdf->MultiCell(120,5,"{$row_proyecto['nombreproceso']}",0,'L');
			$pdf->Ln(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(25,5,"ACTIVIDAD: ",0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,"{$row_proyecto['claveActiv']}",0,0,'C');
			$pdf->MultiCell(120,5,"{$row_proyecto['nombreactiv']}",0,'L');
			$pdf->Ln(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(25,5,"ACCIÓN: ",0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(40,5,"{$row_proyecto['claveAccion']}",0,0,'C');
			$pdf->MultiCell(120,5,"{$row_proyecto['nombreAccion']}",0,'L');
			
			//Comienza la Tabla
			
			$pdf->Ln(5);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(100,5,"PARTIDA PRESUPUESTAL",1,0,'C');
			$pdf->Cell(30,13,"IMPORTE ANUAL",1,0,'C');
			$pdf->Cell(60,5,"PRESUPUESTO A CUBRIR A TRAVES DE",1,0,'C');
			
			$pdf->Ln(5);
			$pdf->Cell(20,8,"CLAVE",1,0,'C');
			$X=$pdf->GetX();
			$Y=$pdf->GetY();
			$pdf->Cell(80,8,"NOMBRE",1,0,'C');
			$pdf->Cell(30,8,"",0,0,'C');
			$pdf->Cell(30,8,"INGRESOS PROPIOS",1,0,'C');
			$x = $pdf->GetX();
			$y = $pdf->GetY();
			$pdf->MultiCell(30,4,"GASTO DE OPERACIÓN",1,'C');
			$pdf->SetXY($x+30,$y);
			$pdf->Ln(8);
			
			$totalHeight = 0;
			
			$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
			$res_partida = mysql_db_query ( $bdd, $sql_partida );
			while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
			{
				$propios = 0;
				$operacional = 0;
				
				$sql_propios = "SELECT proceso.claveproceso, proceso.nombreproceso, actividad.claveActiv, actividad.nombreActiv, accion.claveAccion, accion.nombreAccion, unidadmedida.tipounidad, partida.clavepartida, (poa_dpto.cantidad*insumo.costuni) AS gasto FROM proceso, actividad, accion, unidadmedida, partida, poa_dpto, insumo WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND unidadmedida.id = poa_dpto.unidadmedida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.partida_id = partida.id AND proceso.claveproceso = '{$row_proyecto['claveproceso']}' AND actividad.claveActiv = {$row_proyecto['claveActiv']} AND accion.claveAccion = {$row_proyecto['claveAccion']} AND partida.clavepartida = {$row_partida['clavepartida']} ORDER BY claveproceso, claveActiv, claveAccion, clavepartida";
				$res_propios = mysql_db_query ( $bdd, $sql_propios );
				while ( $row_propios = mysql_fetch_assoc ( $res_propios ) )
				{
					$propios += $row_propios['gasto'];
				}
				
				$sql_operacional = "SELECT proceso.claveproceso, actividad.claveActiv, accion.claveAccion, unidadmedida.tipounidad, partida.clavepartida, gob_federal.presupuesto FROM proceso, actividad, accion, unidadmedida, gob_federal, partida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND unidadmedida.id = gob_federal.unidadmedida_id AND gob_federal.partida_id = partida.id AND proceso.claveproceso = '{$row_proyecto['claveproceso']}' AND actividad.claveActiv = {$row_proyecto['claveActiv']} AND accion.claveAccion = {$row_proyecto['claveAccion']} AND partida.clavepartida = {$row_partida['clavepartida']} ORDER BY claveproceso, claveActiv, claveAccion, clavepartida";
				$res_operacional = mysql_db_query ( $bdd, $sql_operacional );
				while ( $row_operacional = mysql_fetch_assoc ( $res_operacional ) )
				{
					$operacional += $row_operacional['presupuesto'];
				}
				
				if ( $propios > 0 or $operacional > 0 )
				{
					if ( strlen( $row_partida['descpartida'] ) % 40 == 0 )
					{
						$height = ( strlen( $row_partida['descpartida'] ) / 40 ) * 5;
					}
					else
					{
						$height = ( intval ( strlen( $row_partida['descpartida'] ) / 40 ) +1 ) * 5;
					}
					
					if ( $totalHeight >= 190 or ( $totalHeight+$height ) > 190 )
					{	
						$pdf->SetXY($X,$Y);
						$pdf->Cell(80,$totalHeight+8,"",1,0,'C');
						
						
						$pdf->AddPage();
						$pdf->Ln(15);
						
						//Proceso, Actividad y Acción
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"PROCESO: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_proyecto['proyecto']}{$row_proyecto['claveproceso']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_proyecto['nombreproceso']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACTIVIDAD: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_proyecto['claveActiv']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_proyecto['nombreactiv']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACCIÓN: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_proyecto['claveAccion']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_proyecto['nombreAccion']}",0,'L');
						
						//Comienza la Tabla
						
						$pdf->Ln(5);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(100,5,"PARTIDA PRESUPUESTAL",1,0,'C');
						$pdf->Cell(30,13,"IMPORTE ANUAL",1,0,'C');
						$pdf->Cell(60,5,"PRESUPUESTO A CUBRIR A TRAVES DE",1,0,'C');
						
						$pdf->Ln(5);
						$pdf->Cell(20,8,"CLAVE",1,0,'C');
						$X=$pdf->GetX();
						$Y=$pdf->GetY();
						$pdf->Cell(80,8,"NOMBRE",1,0,'C');
						$pdf->Cell(30,8,"",0,0,'C');
						$pdf->Cell(30,8,"INGRESOS PROPIOS",1,0,'C');
						$x = $pdf->GetX();
						$y = $pdf->GetY();
						$pdf->MultiCell(30,4,"GASTO DE OPERACIÓN",1,'C');
						$pdf->SetXY($x+30,$y);
						$pdf->Ln(8);
						
						$totalHeight = 0;
					}
					$importe = $propios+$operacional;
					$pdf->SetFont('Arial','',8);
					/* Comienza impresión de los registros*/
					$pdf->Cell(20,$height,$row_partida['clavepartida'],1,0,'C');
					$x=$pdf->GetX();
					$y=$pdf->GetY();
					$pdf->MultiCell(80,5,$row_partida['descpartida'],'T','J');
					$pdf->SetXY($x+80,$y);
					$pdf->Cell(30,$height,'$'.number_format($importe,2,'.',','),1,0,'C');
					$pdf->Cell(30,$height,'$'.number_format($propios,2,'.',','),1,0,'C');
					$pdf->Cell(30,$height,'$'.number_format($operacional,2,'.',','),1,0,'C');
					$pdf->Ln($height);
					$totalHeight += $height;
					
					$totalImporte += $importe;
					$totalPropio += $propios;
					$totalOperacional += $operacional;
				}
			}	
			$pdf->Cell(100,5,'TOTAL',0,0,'R');
			$pdf->Cell(30,5,'$'.number_format($totalImporte,2,'.',','),1,0,'C');
			$pdf->Cell(30,5,'$'.number_format($totalPropio,2,'.',','),1,0,'C');
			$pdf->Cell(30,5,'$'.number_format($totalOperacional,2,'.',','),1,0,'C');
				
			$totalImporte = 0;
			$totalPropio = 0;
			$totalOperacional = 0;
				
			$pdf->SetXY($X,$Y);
			$pdf->Cell(80,$totalHeight+8,"",1,0,'C');
		}
		$pdf->SetXY($X,$Y);
		$pdf->Cell(80,$totalHeight+8,"",1,0,'C');
	}
	
	$pdf->Output();

?>