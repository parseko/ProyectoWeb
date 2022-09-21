<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();
$_SESSION['NoHojas']=0;
class ReporteHorario extends FPDF
{
	function Header()
	{	
		
		$this->SetXY(12,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/dgest.JPG",13,5,42,19);
		
		$this->SetXY(100,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/tec.jpeg",320,3,25,25);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(153,5);
		$this->Cell(45,4,"FORMATO PARA EL DESGLOSE DE METAS POR PROCESO CLAVE",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(165,12);
		$this->Cell(45,4,"REFERENCIA A LA NORMA ISO 9001-2000: 6.1",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(156,21);
		$this->Cell(45,4,"ANTEPROYECTO DEL PROGRAMA OPERATIVO ANUAL 2008",0,2,'L');

		$this->SetFont('Arial','B',7.5);
		$this->SetXY(164,25);
		$this->Cell(45,4,"DESGLOSE DE METAS POR  PROCESO CLAVE",0,2,'L');
		
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(120,30);
		$this->Cell(55,4,"INSTITUTO TECNOLÓGICO DE : ".$row_revision['tec'],0,2,'L');		

		$x=45;
		//segunda linea
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x);
		$this->Cell(70,4,"META",1,2,'C',1);
		
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+4);
		$this->Cell(30,5.33,"NÚMERO",LTR,2,'C',1);
		$this->SetXY(6,$x+9.33);
		$this->Cell(30,5.33,"Y",LBR,2,'C',1);
		$this->SetXY(6,$x+14.66);
		$this->Cell(30,5.34,"DESCRIPCIÓN",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(225,225,225);
		$this->SetXY(36,$x+4);
		$this->Cell(20,5.33,"UNIDAD",LTR,2,'C',1);
		$this->SetXY(36,$x+9.33);
		$this->Cell(20,5.33,"DE",LBR,2,'C',1);
		$this->SetXY(36,$x+14.66);
		$this->Cell(20,5.34,"MEDIDA",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(225,225,225);
		$this->SetXY(56,$x+4);
		$this->Cell(20,16,"CANTIDAD",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(76,$x);
		$this->Cell(50,20,"ACCIONES",1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(126,$x);
		$this->Cell(33,4,"CALENDARIO PROGRAMATICO",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(126,$x+4);
		$this->Cell(11,8,"ENERO",LTR,2,'C',1);
		$this->SetXY(126,$x+12);
		$this->Cell(11,8,"JUNIO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(137,$x+4);
		$this->Cell(11,8,"JULIO",LTR,2,'C',1);
		$this->SetXY(137,$x+12);
		$this->Cell(11,8,"DICIEMBRE",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(148,$x+4);
		$this->Cell(11,16,"TOTAL",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(159,$x);
		$this->Cell(88,4,"MONTO DE RECURSOS POR CAPITULO DE GASTO",1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(159,$x+4);
		$this->Cell(11,6,"1000",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(159,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(159,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(170,$x+4);
		$this->Cell(22,6,"2000",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(170,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(170,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(181,$x+10);
		$this->Cell(11,5,"GASTO",LTR,2,'C',1);
		$this->SetXY(181,$x+15);
		$this->Cell(11,5,"DIRECTO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x+4);
		$this->Cell(22,6,"3000",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(192,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(192,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(203,$x+10);
		$this->Cell(11,5,"GASTO",LTR,2,'C',1);
		$this->SetXY(203,$x+15);
		$this->Cell(11,5,"DIRECTO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(214,$x+4);
		$this->Cell(11,6,"5000",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(214,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(214,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(225,$x+4);
		$this->Cell(22,6,"7000",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(225,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(225,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(236,$x+10);
		$this->Cell(11,5,"GASTO",LTR,2,'C',1);
		$this->SetXY(236,$x+15);
		$this->Cell(11,5,"DIRECTO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(225,225,225);
		$this->SetXY(247,$x);
		$this->Cell(22,3.33,"PRESUPUESTO",LTR,2,'C',1);
		$this->SetXY(247,$x+3.33);
		$this->Cell(22,3.33,"A CUBRIR A",LBR,2,'C',1);
		$this->SetXY(247,$x+6.66);
		$this->Cell(22,3.34,"TRAVÉS DE",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(247,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(247,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(258,$x+10);
		$this->Cell(11,5,"GASTO",LTR,2,'C',1);
		$this->SetXY(258,$x+15);
		$this->Cell(11,5,"DIRECTO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(269,$x);
		$this->Cell(15,10,"TOTAL",LTR,2,'C',1);
		$this->SetXY(269,$x+10);
		$this->Cell(15,10,"PRESUPUESTO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(284,$x);
		$this->Cell(66,4,"PRESUPUESTACION CALENDARIZADA",1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(284,$x+4);
		$this->Cell(33,6,"ENERO-JUNIO",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(284,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(284,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(295,$x+10);
		$this->Cell(11,5,"GASTO",LTR,2,'C',1);
		$this->SetXY(295,$x+15);
		$this->Cell(11,5,"DIRECTO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(306,$x+10);
		$this->Cell(11,10,"TOTAL",1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(317,$x+4);
		$this->Cell(33,6,"JULIO-DICIEMBRE",1,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(317,$x+10);
		$this->Cell(11,5,"INGRESOS",LTR,2,'C',1);
		$this->SetXY(317,$x+15);
		$this->Cell(11,5,"PROPIOS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(328,$x+10);
		$this->Cell(11,5,"GASTO",LTR,2,'C',1);
		$this->SetXY(328,$x+15);
		$this->Cell(11,5,"DIRECTO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(339,$x+10);
		$this->Cell(11,10,"TOTAL",1,2,'C',1);
				
	}
	function parteII()
	{
		$_SESSION['TotalProceso100'] = 0;
		$_SESSION['TotalProceso200'] = 0;
		$_SESSION['TotalProceso300'] = 0;
		$_SESSION['TotalProceso400'] = 0;
		$_SESSION['TotalProceso500'] = 0;
		$_SESSION['TotalProceso600'] = 0;
		$_SESSION['TotalProceso700'] = 0;
		$_SESSION['TotalProceso800'] = 0;
		$_SESSION['TotalProceso900'] = 0;
		$_SESSION['TotalProceso1000'] = 0;
		$_SESSION['TotalProceso1100'] = 0;
		$_SESSION['TotalProceso1200'] = 0;
		$_SESSION['TotalProceso1300'] = 0;
		$_SESSION['TotalProceso1400'] = 0;

		
		$_SESSION['TotalProceso1'] = 0;
		$_SESSION['TotalProceso2'] = 0;
		$_SESSION['TotalProceso3'] = 0;
		$_SESSION['TotalProceso4'] = 0;
		$_SESSION['TotalProceso5'] = 0;
		$_SESSION['TotalProceso6'] = 0;
		$_SESSION['TotalProceso7'] = 0;
		$_SESSION['TotalProceso8'] = 0;
		$_SESSION['TotalProceso9'] = 0;
		$_SESSION['TotalProceso10'] = 0;
		$_SESSION['TotalProceso11'] = 0;
		$_SESSION['TotalProceso12'] = 0;
		$_SESSION['TotalProceso13'] = 0;
		$_SESSION['TotalProceso14'] = 0;

		$_SESSION['$Total1'] = 0;
		$_SESSION['$Total2'] = 0;
		$_SESSION['$Total3'] = 0;
		$_SESSION['$Total4'] = 0;
		$_SESSION['$Total5'] = 0;
		$_SESSION['$Total6'] = 0;
		$_SESSION['$Total7'] = 0;
		$_SESSION['$Total8'] = 0;
		$_SESSION['Ingresos'] = 0;
		$_SESSION['Directo'] = 0;
		$_SESSION['Periodo1'] = 0;
		$_SESSION['Periodo2'] = 0;
		$_SESSION['Periodo3'] = 0;
		$_SESSION['Periodo4'] = 0;
		$x=65;
		$bdd = "sicopre";
		$sql_proceso = "SELECT * FROM proceso ORDER BY id";
		$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
		while ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
		{
			$sql_actividad = "SELECT * FROM actividad WHERE proceso_id='{$row_proceso['id']}'";
			$res_actividad = mysql_db_query ( $bdd, $sql_actividad );
			while ( $row_actividad = mysql_fetch_assoc ( $res_actividad ) )
			{
				$sql_accion = "SELECT * FROM accion WHERE actividad_id ='{$row_actividad['id']}'";
				$res_accion = mysql_db_query ( $bdd, $sql_accion );
				while ( $row_accion = mysql_fetch_assoc ( $res_accion ) )
				{
					//INICIO METAS
					$sql_poa = "SELECT * FROM poa WHERE actual=1";
					$res_poa = mysql_db_query ( $bdd, $sql_poa );
					if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
					{}
					$sql_apoa1 = "SELECT * FROM poa_dpto WHERE idproceso='{$row_proceso['id']}' AND idactividad='{$row_actividad['id']}' AND idpoa='{$row_poa['id']}' GROUP BY idacciones";
					$res_apoa1 = mysql_db_query ( $bdd, $sql_apoa1 );
					while ( $row_apoa1 = mysql_fetch_assoc ( $res_apoa1 ) )
					{
						//INICIO SELECCION DE REGISTROS SEGUN LA CLAVE Y PROCESO
						$this->SetFont('Arial','B',7.5);
						$this->SetXY(120,36);
						$this->Cell(55,4,"Proceso Estrategico:  ".$row_proceso['nombreproceso'],0,2,'L');
						
						$this->SetFont('Arial','B',7.5);
						$this->SetXY(85,40);
						$this->Cell(55,4,"Clave programática y nombre del Proceso Clave:  ".$row_proceso['proyecto'].$row_actividad['claveActiv']."  ".$row_actividad['nombreactiv'],0,2,'L');

						$sql_accion = "SELECT * FROM accion WHERE id='{$row_apoa1['idacciones']}'";
						$res_accion = mysql_db_query ( $bdd, $sql_accion );
						if ( $row_accion = mysql_fetch_assoc ( $res_accion ) )
						{}
						$this->SetFont('Arial','B',6);
						$this->SetFillColor(255,255,255);
						$this->SetXY(6,$x+.4);
						$this->MultiCell(30,2,$row_accion['claveAccion'].".- ".$row_accion['nombreAccion'],0,'J');
												
						$this->SetFont('Arial','B',6);
						$this->SetXY(36,$x+.4);
						$this->MultiCell(20,2,$row_accion['unidad'],0,'L');
												
						$this->SetFont('Arial','B',6);
						$this->SetXY(56,$x);
						$this->Cell(20,4,$row_accion['cantidad'],'LR',2,'C',1);	
						$y=0;
						$CANDADO=0;
						$sql_metas = "SELECT * FROM poa_dpto WHERE idacciones='{$row_accion['id']}' AND idpoa='{$row_poa['id']}'  GROUP BY idaccion";
						$res_metas = mysql_db_query ( $bdd, $sql_metas );
						while ( $row_metas = mysql_fetch_assoc ( $res_metas ) )
						{
							if ( strlen ( $row_meta['accion'] )  != 0 )
							{
								$temp=$x;
								$y= (( strlen( $row_meta['accion'] ) / 40 ) * 3);
								$temp=$temp+($y+5);
								if($temp>190)
								{
									$this->line(6,65,350,65);
									$this->line(6,60,6,193);
									$this->line(36,60,36,193);
									$this->line(56,60,56,193);
									$this->line(76,60,76,193);
									$this->line(126,60,126,193);		
									$this->line(137,60,137,193);
									$this->line(148,60,148,193);
									$this->line(159,60,159,193);
									$this->line(170,60,170,193);
									$this->line(181,60,181,193);
									$this->line(192,60,192,193);
									$this->line(203,60,203,193);
									$this->line(214,60,214,193);
									$this->line(225,60,225,193);
									$this->line(236,60,236,193);
									$this->line(247,60,247,193);
									$this->line(258,60,258,193);
									$this->line(269,60,269,193);
									$this->line(284,60,284,193);
									$this->line(295,60,295,193);
									$this->line(306,60,306,193);
									$this->line(317,60,317,193);
									$this->line(328,60,328,193);
									$this->line(339,60,339,193);
									$this->line(350,60,350,193);

									$this->AddPage();	
									$x=65;
								}
							}
							//INICIO ACCIONES
							$sql_meta1 = "SELECT * FROM metas WHERE idaccion='{$row_metas['idaccion']}'";
							$res_meta1 = mysql_db_query ( $bdd, $sql_meta1 );
							if ( $row_meta1 = mysql_fetch_assoc ( $res_meta1 ) )
							{}
							$sql_meta = "SELECT * FROM preacciones WHERE id='{$row_meta1['idpreacciones']}'";
							$res_meta = mysql_db_query ( $bdd, $sql_meta );
							if ( $row_meta = mysql_fetch_assoc ( $res_meta ) )
							{}
			
							//OPERACIONES CON LOS NUMEROS
							$a=0;
							$b=0;
							$sql_metas1 = "SELECT * FROM poa_dpto WHERE idaccion='{$row_metas['idaccion']}' AND idpoa='{$row_poa['id']}' ";
							$res_metas1 = mysql_db_query ( $bdd, $sql_metas1 );
							while ( $row_metas1 = mysql_fetch_assoc ( $res_metas1 ) )
							{
								if($row_metas1['periodo']==1)
								{
									$a++;
								}
								if($row_metas1['periodo']==2)
								{
									$b++; 
								}
							}
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(126,$x);
							$this->Cell(11,4,$row_meta['enero'],'LR',2,'C',1);
			
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(137,$x);
							$this->Cell(11,4,$row_meta['julio'],'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(148,$x);
							$this->Cell(11,4,($row_meta['enero']+$row_meta['julio']),'LR',2,'C',1);
							$partida1000total=0;	
							$partida2000total=0;	
							$partida3000total=0;	
							$partida5000total=0;	
							$partida7000total=0;	
							$partida2000total2=0;	
							$partida3000total2=0;	
							$partida7000total2=0;
							$juliototal=0;	
							$enerototal=0;
							$juliototaltipo1=0;	
							$enerototaltipo1=0;
							$juliototaltipo2=0;	
							$enerototaltipo2=0;
							
							$sql_metas1 = "SELECT * FROM poa_dpto WHERE idaccion='{$row_metas['idaccion']}' AND idpoa='{$row_poa['id']}' ";
							$res_metas1 = mysql_db_query ( $bdd, $sql_metas1 );
							while ( $row_metas1 = mysql_fetch_assoc ( $res_metas1 ) )
							{
								$sql_partida = "SELECT * FROM partida WHERE id='{$row_metas1['partida_id']}'";
								$res_partida = mysql_db_query ( $bdd, $sql_partida );
								while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
								{
									$sql_insumo = "SELECT * FROM insumo WHERE id={$row_metas1['insumo_id']}";
									$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
									if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
									{}
									if($row_partida['clavepartida'] >= 1000 and $row_partida['clavepartida'] <= 1999)
									{
										$partida1000=$row_insumo['costuni']*$row_metas1['cantidad'];
										$partida1000total = $partida1000total + $partida1000;
									}
									if($row_partida['clavepartida'] >= 2000 and $row_partida['clavepartida'] <= 2999)
									{
										if($row_metas1['tipogasto'] == 1)
										{
											$partida2000=$row_insumo['costuni']*$row_metas1['cantidad'];
											$partida2000total = $partida2000total + $partida2000;
										}
										else
										{
											$partida2000=$row_insumo['costuni']*$row_metas1['cantidad'];
											$partida2000total2 = $partida2000total2 + $partida2000;
										}
									}
									if($row_partida['clavepartida'] >= 3000 and $row_partida['clavepartida'] <= 3999)
									{
										if($row_metas1['tipogasto'] == 1)
										{
											$partida3000=$row_insumo['costuni']*$row_metas1['cantidad'];
											$partida3000total = $partida3000total + $partida3000;
										}
										else
										{
											$partida3000=$row_insumo['costuni']*$row_metas1['cantidad'];
											$partida3000total2 = $partida3000total2 + $partida3000;
										}
									}
									if($row_partida['clavepartida'] >= 5000 and $row_partida['clavepartida'] <= 5999)
									{
										$partida5000=$row_insumo['costuni']*$row_metas1['cantidad'];
										$partida5000total = $partida5000total + $partida5000;
									}
									if($row_partida['clavepartida'] >= 7000 and $row_partida['clavepartida'] <= 7999)
									{
										if($row_metas1['tipogasto'] == 1)
										{
											$partida7000=$row_insumo['costuni']*$row_metas1['cantidad'];
											$partida7000total = $partida7000total + $partida7000;
										}
										else
										{
											$partida7000=$row_insumo['costuni']*$row_metas1['cantidad'];
											$partida7000total2 = $partida7000total2 + $partida7000;
										}
									}
								}
								
								
								if($row_metas1['periodo']==1)
								{
									if($row_metas1['tipogasto']==1)
									{
										$enerotipo1=$row_insumo['costuni']*$row_metas1['cantidad'];
										$enerototaltipo1 = $enerototaltipo1 + $enerotipo1;
									}
									else
									{
										$enerotipo2=$row_insumo['costuni']*$row_metas1['cantidad'];
										$enerototaltipo2 = $enerototaltipo2 + $enerotipo2;
									}
									$enero=$row_insumo['costuni']*$row_metas1['cantidad'];
									$enerototal = $enerototal + $enero;
								}
								if($row_metas1['periodo']==2)
								{
									if($row_metas1['tipogasto']==1)
									{
										$juliotipo1=$row_insumo['costuni']*$row_metas1['cantidad'];
										$juliototaltipo1 = $juliototaltipo1 + $juliotipo1;
									}
									else
									{
										$juliotipo2=$row_insumo['costuni']*$row_metas1['cantidad'];
										$juliototaltipo2 = $juliototaltipo2 + $juliotipo2;
									}
									$julio=$row_insumo['costuni']*$row_metas1['cantidad'];
									$juliototal = $juliototal + $julio;
								}
							}	
							$_SESSION['$Total1'] = $_SESSION['$Total1'] + $partida1000total;
							$_SESSION['$Total2'] = $_SESSION['$Total2'] + $partida2000total;
							$_SESSION['$Total3'] = $_SESSION['$Total3'] + $partida2000total2;
							$_SESSION['$Total4'] = $_SESSION['$Total4'] + $partida3000total;
							$_SESSION['$Total5'] = $_SESSION['$Total5'] + $partida3000total2;
							$_SESSION['$Total6'] = $_SESSION['$Total6'] + $partida5000total;
							$_SESSION['$Total7'] = $_SESSION['$Total7'] + $partida7000total;
							$_SESSION['$Total8'] = $_SESSION['$Total8'] + $partida7000total2;
							$_SESSION['Ingresos'] = $_SESSION['Ingresos'] = $_SESSION['$Total1'] + $_SESSION['$Total2'] + $_SESSION['$Total4'] + $_SESSION['$Total6'] + $_SESSION['$Total7'];
							$_SESSION['Directo'] = $_SESSION['Directo'] = $_SESSION['$Total3'] + $_SESSION['$Total5'] + $_SESSION['$Total8'];
							$_SESSION['Periodo1'] = $_SESSION['Periodo1'] + $enerototaltipo1;
							$_SESSION['Periodo2'] = $_SESSION['Periodo2'] + $enerototaltipo2;
							$_SESSION['Periodo3'] = $_SESSION['Periodo3'] + $juliototaltipo1;
							$_SESSION['Periodo4'] = $_SESSION['Periodo4'] + $juliototaltipo2;
																
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(159,$x);
							$this->Cell(11,4,$_SESSION['$Total1'],'LR',2,'C',1);	
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(170,$x);
							$this->Cell(11,4,$_SESSION['$Total2'],'LR',2,'C',1);
												
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(181,$x);
							$this->Cell(11,4,$_SESSION['$Total3'],'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(192,$x);
							$this->Cell(11,4,$_SESSION['$Total4'],'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(203,$x);
							$this->Cell(11,4,$_SESSION['$Total5'],'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(214,$x);
							$this->Cell(11,4,$_SESSION['$Total6'],'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(225,$x);
							$this->Cell(11,4,$_SESSION['$Total7'],'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(236,$x);
							$this->Cell(11,4,$_SESSION['$Total8'],'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(247,$x);
							$this->Cell(11,4,($_SESSION['Ingresos']),'LR',2,'C',1);
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(258,$x);
							$this->Cell(11,4,($_SESSION['Directo']),'LR',2,'C',1);	
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(269,$x);
							$this->Cell(15,4,($_SESSION['Ingresos']+$_SESSION['Directo']),'LR',2,'C',1);	
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(284,$x);
							$this->Cell(11,4,$_SESSION['Periodo1'],'LR',2,'C',1);	
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(295,$x);
							$this->Cell(11,4,$_SESSION['Periodo2'],'LR',2,'C',1);	
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(306,$x);
							$this->Cell(11,4,($_SESSION['Periodo1']+$_SESSION['Periodo2']),'LR',2,'C',1);	
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(317,$x);
							$this->Cell(11,4,$_SESSION['Periodo3'],'LR',2,'C',1);	
														
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(328,$x);
							$this->Cell(11,4,$_SESSION['Periodo4'],'LR',2,'C',1);	
											
							$this->SetFont('Arial','B',5.5);
							$this->SetXY(339,$x);
							$this->Cell(11,4,($_SESSION['Periodo3']+$_SESSION['Periodo4']),'LR',2,'C',1);
							
							
							

							
							//FIN DE OPERACIONES CON LOS NUMEROS
													
							$this->SetFont('Arial','B',6);
							$this->SetXY(76,$x);

							$this->MultiCell(50,3,($row_meta['accion']),0,'L');
							if ( strlen ( $row_meta['accion'] )  > 30 )
							{
								$y= (( strlen( $row_meta['accion'] ) / 40 ) * 3);
								$x=$x+($y+5);
								$this->line(76,$x-1,350,$x-1);
							}
							else
							{
								$x= $x + 6;
								$this->line(76,$x-1,350,$x-1);
							}
						}
						//FIN DE ACCIONES
							
						//LINEAS PARA LAS DIVISIONES
												$this->line(6,65,350,65);
						$this->line(6,60,6,193);
						$this->line(36,60,36,193);
						$this->line(56,60,56,193);
						$this->line(76,60,76,193);
						$this->line(126,60,126,193);		
						$this->line(137,60,137,193);
						$this->line(148,60,148,193);
						$this->line(159,60,159,193);
						$this->line(170,60,170,193);
						$this->line(181,60,181,193);
						$this->line(192,60,192,193);
						$this->line(203,60,203,193);
						$this->line(214,60,214,193);
						$this->line(225,60,225,193);
						$this->line(236,60,236,193);
						$this->line(247,60,247,193);
						$this->line(258,60,258,193);
						$this->line(269,60,269,193);
						$this->line(284,60,284,193);
						$this->line(295,60,295,193);
						$this->line(306,60,306,193);
						$this->line(317,60,317,193);
						$this->line(328,60,328,193);
						$this->line(339,60,339,193);
						$this->line(350,60,350,193);

						$_SESSION['TotalProceso1'] = $_SESSION['TotalProceso1'] + $_SESSION['$Total1'];
						$_SESSION['TotalProceso2'] = $_SESSION['TotalProceso2'] + $_SESSION['$Total2'];
						$_SESSION['TotalProceso3'] = $_SESSION['TotalProceso3'] + $_SESSION['$Total3'];
						$_SESSION['TotalProceso4'] = $_SESSION['TotalProceso4'] + $_SESSION['$Total4'];
						$_SESSION['TotalProceso5'] = $_SESSION['TotalProceso5'] + $_SESSION['$Total5'];
						$_SESSION['TotalProceso6'] = $_SESSION['TotalProceso6'] + $_SESSION['$Total6'];
						$_SESSION['TotalProceso7'] = $_SESSION['TotalProceso7'] + $_SESSION['$Total7'];
						$_SESSION['TotalProceso8'] = $_SESSION['TotalProceso8'] + $_SESSION['$Total8'];
						$_SESSION['TotalProceso9'] = $_SESSION['TotalProceso9'] + $_SESSION['Ingresos'];
						$_SESSION['TotalProceso10'] = $_SESSION['TotalProceso10'] + $_SESSION['Directo'];
						$_SESSION['TotalProceso11'] = $_SESSION['TotalProceso11'] + $_SESSION['Periodo1'];
						$_SESSION['TotalProceso12'] = $_SESSION['TotalProceso12'] + $_SESSION['Periodo2'];
						$_SESSION['TotalProceso13'] = $_SESSION['TotalProceso13'] + $_SESSION['Periodo3'];
						$_SESSION['TotalProceso14'] = $_SESSION['TotalProceso14'] + $_SESSION['Periodo4'];
						
						$_SESSION['TotalProceso100'] = $_SESSION['TotalProceso100'] + $_SESSION['$Total1'];
						$_SESSION['TotalProceso200'] = $_SESSION['TotalProceso200'] + $_SESSION['$Total2'];
						$_SESSION['TotalProceso300'] = $_SESSION['TotalProceso300'] + $_SESSION['$Total3'];
						$_SESSION['TotalProceso400'] = $_SESSION['TotalProceso400'] + $_SESSION['$Total4'];
						$_SESSION['TotalProceso500'] = $_SESSION['TotalProceso500'] + $_SESSION['$Total5'];
						$_SESSION['TotalProceso600'] = $_SESSION['TotalProceso600'] + $_SESSION['$Total6'];
						$_SESSION['TotalProceso700'] = $_SESSION['TotalProceso700'] + $_SESSION['$Total7'];
						$_SESSION['TotalProceso800'] = $_SESSION['TotalProceso800'] + $_SESSION['$Total8'];
						$_SESSION['TotalProceso900'] = $_SESSION['TotalProceso900'] + $_SESSION['Ingresos'];
						$_SESSION['TotalProceso1000'] = $_SESSION['TotalProceso1000'] + $_SESSION['Directo'];
						$_SESSION['TotalProceso1100'] = $_SESSION['TotalProceso1100'] + $_SESSION['Periodo1'];
						$_SESSION['TotalProceso1200'] = $_SESSION['TotalProceso1200'] + $_SESSION['Periodo2'];
						$_SESSION['TotalProceso1300'] = $_SESSION['TotalProceso1300'] + $_SESSION['Periodo3'];
						$_SESSION['TotalProceso1400'] = $_SESSION['TotalProceso1400'] + $_SESSION['Periodo4'];

						$x=65;
						$this->AddPage();						
					}
					//TERMINA LA SELECCION DE REGISTROS SEGUN LA META Y PROCESO								

				}



				$_SESSION['TotalProceso1'] = 0;
				$_SESSION['TotalProceso2'] = 0;
				$_SESSION['TotalProceso3'] = 0;
				$_SESSION['TotalProceso4'] = 0;
				$_SESSION['TotalProceso5'] = 0;
				$_SESSION['TotalProceso6'] = 0;
				$_SESSION['TotalProceso7'] = 0;
				$_SESSION['TotalProceso8'] = 0;
				$_SESSION['TotalProceso9'] = 0;
				$_SESSION['TotalProceso10'] = 0;
				$_SESSION['TotalProceso11'] = 0;
				$_SESSION['TotalProceso12'] = 0;
				$_SESSION['TotalProceso13'] = 0;
				$_SESSION['TotalProceso14'] = 0;				
								
			}
			$_SESSION['TotalProceso100'] = 0;
			$_SESSION['TotalProceso200'] = 0;
			$_SESSION['TotalProceso300'] = 0;
			$_SESSION['TotalProceso400'] = 0;
			$_SESSION['TotalProceso500'] = 0;
			$_SESSION['TotalProceso600'] = 0;
			$_SESSION['TotalProceso700'] = 0;
			$_SESSION['TotalProceso800'] = 0;
			$_SESSION['TotalProceso900'] = 0;
			$_SESSION['TotalProceso1000'] = 0;
			$_SESSION['TotalProceso1100'] = 0;
			$_SESSION['TotalProceso1200'] = 0;
			$_SESSION['TotalProceso1300'] = 0;
			$_SESSION['TotalProceso1400'] = 0;
		}
		//**************		
	}
	function Footer()
	{
		$x=193;
		$this->SetFont('Arial','B',5.5);
		$this->SetFillColor(112,165,252);
		$this->SetXY(6,$x);
		$this->Cell(153,4,"TOTAL POR METAS",1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(159,$x);
		$this->Cell(11,4,$_SESSION['$Total1'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(170,$x);
		$this->Cell(11,4,$_SESSION['$Total2'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(181,$x);
		$this->Cell(11,4,$_SESSION['$Total3'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->Cell(11,4,$_SESSION['$Total4'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(203,$x);
		$this->Cell(11,4,$_SESSION['$Total5'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(214,$x);
		$this->Cell(11,4,$_SESSION['$Total6'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(225,$x);
		$this->Cell(11,4,$_SESSION['$Total7'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(236,$x);
		$this->Cell(11,4,$_SESSION['$Total8'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(247,$x);
		$this->Cell(11,4,$_SESSION['Ingresos'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(258,$x);
		$this->Cell(11,4,$_SESSION['Directo'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(269,$x);
		$this->Cell(15,4,($_SESSION['Ingresos']+$_SESSION['Directo']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(284,$x);
		$this->Cell(11,4,$_SESSION['Periodo1'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(295,$x);
		$this->Cell(11,4,$_SESSION['Periodo2'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(306,$x);
		$this->Cell(11,4,($_SESSION['Periodo1']+$_SESSION['Periodo2']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(317,$x);
		$this->Cell(11,4,$_SESSION['Periodo3'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(328,$x);
		$this->Cell(11,4,$_SESSION['Periodo4'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(339,$x);
		$this->Cell(11,4,($_SESSION['Periodo3']+$_SESSION['Periodo4']),1,2,'C',1);	
		
		$_SESSION['$Total1'] = 0;
		$_SESSION['$Total2'] = 0;
		$_SESSION['$Total3'] = 0;
		$_SESSION['$Total4'] = 0;
		$_SESSION['$Total5'] = 0;
		$_SESSION['$Total6'] = 0;
		$_SESSION['$Total7'] = 0;
		$_SESSION['$Total8'] = 0;
		$_SESSION['Ingresos'] = 0;
		$_SESSION['Directo'] = 0;
		$_SESSION['Periodo1'] = 0;
		$_SESSION['Periodo2'] = 0;
		$_SESSION['Periodo3'] = 0;
		$_SESSION['Periodo4'] = 0;

		$x=197;
		$this->SetFont('Arial','B',5.5);
		$this->SetFillColor(112,165,252);
		$this->SetXY(6,$x);
		$this->Cell(153,4,"TOTAL POR PROCESO CLAVE",1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(159,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso1'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(170,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso2'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(181,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso3'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso4'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(203,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso5'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(214,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso6'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(225,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso7'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(236,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso8'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(247,$x);
		$this->Cell(11,4,($_SESSION['TotalProceso9']),1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(258,$x);
		$this->Cell(11,4,($_SESSION['TotalProceso10']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(269,$x);
		$this->Cell(15,4,($_SESSION['TotalProceso9'] + $_SESSION['TotalProceso10']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(284,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso11'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(295,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso12'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(306,$x);
		$this->Cell(11,4,($_SESSION['TotalProceso11'] + $_SESSION['TotalProceso12']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(317,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso13'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(328,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso14'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(339,$x);
		$this->Cell(11,4,($_SESSION['TotalProceso13'] + $_SESSION['TotalProceso14']),1,2,'C',1);	
		
		$x=201;
		$this->SetFont('Arial','B',5.5);
		$this->SetFillColor(112,165,252);
		$this->SetXY(6,$x);
		$this->Cell(153,4,"TOTAL POR PROCESO ESTRATEGICO",1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(159,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso100'],1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(170,$x);
		$this->Cell(22,4,($_SESSION['TotalProceso200'] + $_SESSION['TotalProceso300']),1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->Cell(22,4,($_SESSION['TotalProceso400'] + $_SESSION['TotalProceso500']),1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(214,$x);
		$this->Cell(11,4,$_SESSION['TotalProceso600'],1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(225,$x);
		$this->Cell(22,4,($_SESSION['TotalProceso700'] + $_SESSION['TotalProceso800']),1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(247,$x);
		$this->Cell(22,4,($_SESSION['TotalProceso900'] + $_SESSION['TotalProceso1000']),1,2,'C',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(269,$x);
		$this->Cell(15,4,($_SESSION['TotalProceso900'] + $_SESSION['TotalProceso1000']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(284,$x);
		$this->Cell(22,4,($_SESSION['TotalProceso1100'] + $_SESSION['TotalProceso1200']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(306,$x);
		$this->Cell(11,4,($_SESSION['TotalProceso1100'] + $_SESSION['TotalProceso1200']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(317,$x);
		$this->Cell(22,4,($_SESSION['TotalProceso1300'] + $_SESSION['TotalProceso1400']),1,2,'C',1);	
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(339,$x);
		$this->Cell(11,4,($_SESSION['TotalProceso1300'] + $_SESSION['TotalProceso1400']),1,2,'C',1);	
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(10,$x+5);
		$this->Cell(10,4,$row_revision['snest'],0,2,'C',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(340,$x+5);
		$this->Cell(10,4,$row_revision['revision'],0,2,'C',1);

		/*$sql_dpto = "SELECT * FROM dpto WHERE id='{$_SESSION['dpto_id']}'";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{}
		$this->SetFont('Arial','B',4);
		$this->SetXY(310,$x+9);
		$this->Cell(10,4,$row_dpto['nombredpto'],0,2,'C',1);*/

	}
}
	$pdf = new ReporteHorario($orientation='L',$unit='mm',$format='Legal');

	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?> 