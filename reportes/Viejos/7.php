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
			$this->Cell(0,10,"DESGLOCE DEL PRESUPUESTO POR DEPARTAMENTO",0,0,'C');
			$this->Image ( "../imagenes/reportes/snest.jpeg", 15, 10, 35, 18);
			$this->Image ( "../imagenes/reportes/tec.jpeg", 163, 10, 25.4, 24.8);
			$xHeader = $this->GetX();
			$yHeader = $this->GetY();
			$this->SetFont('Arial','',8);
			$this->SetXY(10,35);
			$this->Cell(80,0,"UR 45",0,0,'L');
			$this->SetXY(120,35);
			$this->Cell(80,0,"",0,0,'R');
			$this->SetXY($xHeader,$yHeader);
			
		}
		/*
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
		}*/
	}

	$pdf=new poa1_anexo2();
	
	$sql_programa = "SELECT unidadmedida.id AS unidadMedida, unidadmedida.tipounidad, proceso.*, actividad.*, accion.*FROM proceso, actividad, accion, unidadmedida WHERE unidadmedida.id  IN (SELECT unidadmedida_id FROM programa WHERE dpto_id = {$_POST['dpto_id']} ) AND accion.id = unidadmedida.accion_id AND actividad.id = accion.actividad_id AND proceso.id = actividad.proceso_id";
	if ( $res_programa = mysql_db_query ( $bdd, $sql_programa ) )
	{
		while ( $row_programa = mysql_fetch_assoc ( $res_programa ) )
		{
			
			$sql_unidad = "SELECT * FROM unidadmedida WHERE id = '{$row_programa['unidadMedida']}'";
			$res_unidad = mysql_db_query ( $bdd, $sql_unidad );
			$row_unidad = mysql_fetch_assoc ( $res_unidad );
			
			$sql_poa_dpto = "SELECT poa_dpto.id AS poa_id, poa_dpto.*, insumo.*, partida.* FROM poa_dpto, insumo, partida WHERE poa_dpto.dpto_id = {$_POST['dpto_id']} AND poa_dpto.unidadmedida_id = {$row_unidad['id']} AND poa_dpto.insumo_id = insumo.id AND poa_dpto.partida_id = partida.id ORDER BY partida.clavepartida, insumo.descinsu";
			if ( $res_poa_dpto = mysql_db_query ( $bdd, $sql_poa_dpto ) )
			{
				$totalUnidad = 0;
				$iniciado = 0;
				while ( $row_poa_dpto = mysql_fetch_assoc ( $res_poa_dpto ) )
				{
					if ( $iniciado == 0 )
					{
						$iniciado = 1;
						$TOTAL = 0;
						
						$pdf->AddPage();
						$pdf->Ln(15);
						
						//Proceso, Actividad, Acción, Unidad de Medida, Departamento
						$sql_dpto = "SELECT * FROM dpto WHERE id = {$_POST['dpto_id']}";
						$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
						$row_dpto = mysql_fetch_assoc ( $res_dpto );
												
						$pdf->SetFont('Arial','B',10);
						$pdf->Cell(0,5,"{$row_dpto['nombredpto']}",0,0,'C');
						
						$pdf->Ln(10);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"PROCESO: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_programa['proyecto']}{$row_programa['claveproceso']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_programa['nombreproceso']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACTIVIDAD: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_programa['claveActiv']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_programa['nombreactiv']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACCIÓN: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_programa['claveAccion']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_programa['nombreAccion']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"UNIDAD DE MEDIDA: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_unidad['tipounidad']}",0,'L');
						
						//Comienza la Tabla
			
						$pdf->Ln(5);
						$pdf->SetFont('Arial','B',7.5);
						$X = $pdf->GetX();
						$Y = $pdf->GetY();
						$pdf->Cell(12,5,"CANT.",1,0,'C');
						$pdf->Cell(30,5,"MEDIDA",1,0,'C');
						$pdf->Cell(13,5,"PARTIDA",1,0,'C');
						$pdf->Cell(47,5,"INSUMO",1,0,'C');
						$pdf->Cell(15,5,"COSTO/U",1,0,'C');
						$pdf->Cell(16,5,"TOTAL",1,0,'C');
						$pdf->Cell(57,5,"JUSTIFICACION",1,0,'C');
						$pdf->Ln(5);
						$totalHeight = 0;
					}
								
					if ( strlen ( $row_poa_dpto['justificacion'] ) > 38 and strlen ( $row_poa_dpto['justificacion'] ) > strlen ( $row_poa_dpto['descinsu'] )  )
					{
						if ( strlen( $row_poa_dpto['justificacion'] ) % 38 == 0 )
						{
							$height = ( strlen( $row_poa_dpto['justificacion'] ) / 38 ) * 5;
						}
						else
						{
							$height = ( intval ( strlen( $row_poa_dpto['justificacion'] ) / 38 ) + 1 ) * 5;
						}
					}
					else if ( strlen ( $row_poa_dpto['descinsu'] ) > 25 )
					{
						if ( strlen( $row_poa_dpto['descinsu'] ) % 25 == 0 )
						{
							$height = ( ( strlen( $row_poa_dpto['descinsu'] ) / 25 ) + 1 ) * 5;
						}
						else
						{
							$height = ( intval ( strlen( $row_poa_dpto['descinsu'] ) / 25 ) + 1 ) * 5;
						}
					}
					else
					{
						$height = 5;
					}
					
					if ( $totalHeight >= 180 or  $totalHeight+$height > 180 )
					{
						$pdf->SetXY($X,$Y);
						$pdf->Cell(12,$totalHeight+5,"",1,0,'C');
						$pdf->Cell(30,$totalHeight+5,"",1,0,'C');
						$pdf->Cell(13,$totalHeight+5,"",1,0,'C');
						$pdf->Cell(47,$totalHeight+5,"",1,0,'C');
						$pdf->Cell(15,$totalHeight+5,"",1,0,'C');
						$pdf->Cell(16,$totalHeight+5,"",1,0,'C');
						$pdf->Cell(57,$totalHeight+5,"",1,0,'C');
						
						$pdf->AddPage();
						$pdf->Ln(15);
						
						//Proceso, Actividad, Acción, Unidad de Medida, Departamento
						$sql_dpto = "SELECT * FROM dpto WHERE id = {$_POST['dpto_id']}";
						$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
						$row_dpto = mysql_fetch_assoc ( $res_dpto );
												
						$pdf->SetFont('Arial','B',10);
						$pdf->Cell(0,5,"{$row_dpto['nombredpto']}",0,0,'C');
						
						$pdf->Ln(10);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"PROCESO: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_programa['proyecto']}{$row_programa['claveproceso']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_programa['nombreproceso']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACTIVIDAD: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_programa['claveActiv']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_programa['nombreactiv']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"ACCIÓN: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"{$row_programa['claveAccion']}",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_programa['nombreAccion']}",0,'L');
						$pdf->Ln(2);
						$pdf->SetFont('Arial','B',8);
						$pdf->Cell(25,5,"UNIDAD DE MEDIDA: ",0,0,'L');
						$pdf->SetFont('Arial','',8);
						$pdf->Cell(40,5,"",0,0,'C');
						$pdf->MultiCell(120,5,"{$row_unidad['tipounidad']}",0,'L');
						
						//Comienza la Tabla
			
						$pdf->Ln(5);
						$pdf->SetFont('Arial','B',7.5);
						$X = $pdf->GetX();
						$Y = $pdf->GetY();
						$pdf->Cell(12,5,"CANT.",1,0,'C');
						$pdf->Cell(30,5,"MEDIDA",1,0,'C');
						$pdf->Cell(13,5,"PARTIDA",1,0,'C');
						$pdf->Cell(47,5,"INSUMO",1,0,'C');
						$pdf->Cell(15,5,"COSTO/U",1,0,'C');
						$pdf->Cell(16,5,"TOTAL",1,0,'C');
						$pdf->Cell(57,5,"JUSTIFICACION",1,0,'C');
						$pdf->Ln(5);
						$totalHeight = 0;
					}
					
					$pdf->SetFont('Arial','',8);
					$pdf->Cell(12,$height,$row_poa_dpto['cantidad'],1,0,'C');
					$pdf->Cell(30,$height,$row_poa_dpto['medida'],1,0,'C');
					$pdf->Cell(13,$height,$row_poa_dpto['clavepartida'],1,0,'C');
					
					$x = $pdf->GetX();
					$y = $pdf->GetY();
					$pdf->MultiCell(47,5,$row_poa_dpto['descinsu'],'T','J');
					$pdf->SetXY( $x+47, $y);
					
					$pdf->Cell(15,$height,'$'. number_format ( $row_poa_dpto['costuni'], 2, '.',','),1,0,'C');
					$total = $row_poa_dpto['costuni']*$row_poa_dpto['cantidad'];
					$TOTAL += $total;
					$pdf->Cell(16,$height,'$'. number_format ( $total, 2, '.',','),1,0,'C');
					
					$x = $pdf->GetX();
					$y = $pdf->GetY();
					$pdf->MultiCell(57,5,$row_poa_dpto['justificacion'],'T','J');
					$pdf->SetXY( $x+57, $y);
					
					$pdf->Ln($height);
					$totalHeight += $height;
				}
				
				$pdf->Cell(102, 5, "", 0,0,'C');
				$pdf->Cell(15, 5, "TOTAL", 0,0,'R');
				$pdf->Cell(16, 5, '$'.number_format ( $TOTAL, 2, '.',','), 1,0,'R');
				
				$pdf->SetXY($X,$Y);
				$pdf->Cell(12,$totalHeight+5,"",1,0,'C');
				$pdf->Cell(30,$totalHeight+5,"",1,0,'C');
				$pdf->Cell(13,$totalHeight+5,"",1,0,'C');
				$pdf->Cell(47,$totalHeight+5,"",1,0,'C');
				$pdf->Cell(15,$totalHeight+5,"",1,0,'C');
				$pdf->Cell(16,$totalHeight+5,"",1,0,'C');
				$pdf->Cell(57,$totalHeight+5,"",1,0,'C');
			}
		}
	}
	
	
	
	$pdf->Output();
?>