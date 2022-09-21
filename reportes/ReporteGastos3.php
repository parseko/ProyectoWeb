<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();
if($_GET['dpto']==0)
{
	$_SESSION['DPTO'] = $_SESSION['dpto_id'];
}
else
{
$_SESSION['DPTO']=$_GET['dpto'];
}
//$_SESSION['DPTO']=23;
class ReporteHorario extends FPDF
{

	function Header()
	{	
		
		$this->SetXY(12,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/dgest.jpg",10,6.5,25,25);
		
		$this->SetXY(100,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/tec.jpeg",175,3,25,25);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(85,5);
		$this->Cell(45,4,"FORMATO DE ESTADO DE CUENTAS",0,2,'L');
		
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{}
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(85,12);
		$this->Cell(45,4,"PROGRAMA OPERATIVO ANUAL ".$row_apoa['anio'],0,2,'L');
		
		
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(70,20);
		$this->Cell(55,4,"INSTITUTO TECNOLÓGICO DE : ".$row_revision['tec'],0,2,'L');
						
		$sql_dpto = "SELECT * FROM dpto WHERE id ='{$_SESSION['DPTO']}'";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{}
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(86.5,24);
		$this->Cell(55,4,"DEPARTAMENTO : ".$row_dpto['nombredpto'] ,0,2,'L');
		
		
		$x=33;
		//segunda linea
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(10,$x);
		$this->Cell(10,4,"No.",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(20,$x);
		$this->Cell(15,4,"PARTIDA",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(35,$x);
		$this->Cell(20,4,"MONTO",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(55,$x);
		$this->Cell(45,4,"JUSTIFICACION",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(100,$x);
		$this->Cell(10,4,"META",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(110,$x);
		$this->Cell(15,4,"FECHA",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(125,$x);
		$this->Cell(15,4,"DOCTO",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(140,$x);
		$this->Cell(60,4,"DEPTO. SOLIC.",1,2,'C',1);
	}
	function parteII()
	{
		function PresupuestoCapitulo($dpto_id,$medida,$bdd,$tamano)
		{
			$total=0;
			$totalUnidad=0;
			$gastoDpto = 0;
			$tamano1=$tamano+1000;	
			$sql_poa_dpto_gastos = "SELECT poa_dpto_gastos.id AS poa_id, poa_dpto_gastos.*, insumo.*, partida.* FROM poa_dpto_gastos, insumo, partida WHERE poa_dpto_gastos.dpto_id = '{$dpto_id}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.partida_id = partida.id AND poa_dpto_gastos.idacciones='$medida' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' AND poa_dpto_gastos.tipogasto=1";
			if ( $res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos ) )
			{
				$totalUnidad = 0;
				$totalgastos = 0;
				while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
				{
					$total = $row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
					$totalUnidad += $total;
				}
			}
			return $totalUnidad;
		}

		$x=37;
		$totalUnidad=0;
		$GASTOS1000=0;
		$GASTOS2000=0;
		$GASTOS3000=0;
		$GASTOS5000=0;
		$GASTOS7000=0;
		$bdd = "sicopre";
		//MODIFIQUE EL VALOR DE DEPARTAMENTO SE PUSO DE MANERA MANUAL
		$sql_programa = "SELECT * FROM poa_dpto_gastos WHERE dpto_id='{$_SESSION['DPTO']}' and tipogasto=1 GROUP BY idacciones ";
		if ( $res_programa = mysql_db_query ( $bdd, $sql_programa ) )
		{
			while ( $row_programa = mysql_fetch_assoc ( $res_programa ) )
			{
		$GASTOS1000=0;
		$GASTOS2000=0;
		$GASTOS3000=0;
		$GASTOS5000=0;
		$GASTOS7000=0;

				$partida1000=1;
				$partida2000=1;
				$partida3000=1;
				$partida5000=1;
				$partida7000=1;
				$sql_2 = "SELECT * FROM accion WHERE id='{$row_programa['idacciones']}'";
				$res_2 = mysql_db_query ( $bdd, $sql_2 );
				if ( $row_2 = mysql_fetch_assoc ( $res_2 ) )
				{}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->MultiCell(190,4,$row_2['nombreAccion'],1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(190,4,"CAPITULO 1000",1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				if($partida1000==1)
				{
					$totalgastos=0;
					$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
					{
						while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
						{
							$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
							if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
							{
								if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
								{
									if(($row_partida_busqueda['clavepartida'] >= 1000) and ($row_partida_busqueda['clavepartida'] <= 1999))
									{
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(10,$x);
										$this->Cell(10,4,"{$row_gastos_dpto['oficio']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(20,$x);
										$this->Cell(15,4,"{$row_partida_busqueda['clavepartida']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',6);
										$this->SetFillColor(255,255,255);
										$this->SetXY(35,$x);
										$this->Cell(20,4,number_format ( $row_gastos_dpto['monto'], 2, '.', ',' ),1,2,'C',1);
										$GASTOS1000=$GASTOS1000+$row_gastos_dpto['monto'];
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(55,$x);
										$this->Cell(45,4,"{$row_gastos_dpto['justificacion']}",1,2,'C',1);
								
										$totalgastos += $row_gastos_dpto['monto'];
										$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(100,$x);
											$this->Cell(10,4,"{$row_1['claveAccion']}",1,2,'C',1);
										}
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(110,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['fecha']}",1,2,'C',1);
								
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(125,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['documento']}",1,2,'C',1);

										$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(140,$x);
											$this->Cell(60,4,"{$row_1['nombredpto']}",1,2,'C',1);
										}
										if($x>260)
										{
											$x=37;
											$this->AddPage();
										}
										else
										{
											$x=$x+4;
										}
									}

								}
							}
						}
					}

				}
				$total=0;
				$totalUnidad=0;
				$gastoDpto = 0;
				$tamano=1000;
				$tamano1=2000;	
				$sql_poa_dpto_gastos = "SELECT poa_dpto_gastos.id AS poa_id, poa_dpto_gastos.*, insumo.*, partida.* FROM poa_dpto_gastos, insumo, partida WHERE poa_dpto_gastos.dpto_id = '{$_SESSION['DPTO']}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.partida_id = partida.id AND poa_dpto_gastos.idacciones='{$row_programa['idacciones']}' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' AND poa_dpto_gastos.tipogasto=1";
				if ( $res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos ) )
				{
					while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
					{
						$total = $row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
						$totalUnidad += $total;
						$uno++;
					}
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"PRESUPUESTO",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $totalUnidad, 2, '.', ',' ),1,2,'C',1);

				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				//GASTOS 
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"GASTOS",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $GASTOS1000, 2, '.', ',' ),1,2,'C',1);

				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"RESTANTE",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( ($totalUnidad-$GASTOS1000), 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(190,4,"CAPITULO 2000",1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				if($partida2000==1)
				{
					$totalgastos=0;
					$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
					{
						while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
						{
							$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
							if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
							{
								if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
								{
									if(($row_partida_busqueda['clavepartida'] >= 2000) and ($row_partida_busqueda['clavepartida'] <= 2999))
									{
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(10,$x);
										$this->Cell(10,4,"{$row_gastos_dpto['oficio']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(20,$x);
										$this->Cell(15,4,"{$row_partida_busqueda['clavepartida']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(35,$x);
										$this->Cell(20,4,number_format ( $row_gastos_dpto['monto'], 2, '.', ',' ),1,2,'C',1);
										$GASTOS2000=$GASTOS2000+$row_gastos_dpto['monto'];

										$this->SetFont('Arial','B',6);
										$this->SetFillColor(255,255,255);
										$this->SetXY(55,$x);
										$this->Cell(45,4,"{$row_gastos_dpto['justificacion']}",1,2,'L',1);
								
										$totalgastos += $row_gastos_dpto['monto'];
										$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(100,$x);
											$this->Cell(10,4,"{$row_1['claveAccion']}",1,2,'C',1);
										}
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(110,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['fecha']}",1,2,'C',1);
								
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(125,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['documento']}",1,2,'C',1);

										$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(140,$x);
											$this->Cell(60,4,"{$row_1['nombredpto']}",1,2,'C',1);
										}
										if($x>260)
										{
											$x=37;
											$this->AddPage();
										}
										else
										{
											$x=$x+4;
										}
									}

								}
							}
						}
					}

				}
				$total=0;
				$totalUnidad=0;
				$tamano=2000;
				$tamano1=3000;	
				$sql_poa_dpto_gastos = "SELECT poa_dpto_gastos.id AS poa_id, poa_dpto_gastos.*, insumo.*, partida.* FROM poa_dpto_gastos, insumo, partida WHERE poa_dpto_gastos.dpto_id = '{$_SESSION['DPTO']}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.partida_id = partida.id AND poa_dpto_gastos.idacciones='{$row_programa['idacciones']}' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' AND poa_dpto_gastos.tipogasto=1";
				if ( $res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos ) )
				{
					while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
					{
						$total = $row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
						$totalUnidad += $total;
						$uno++;
					}
				}

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"PRESUPUESTO",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $totalUnidad, 2, '.', ',' ),1,2,'C',1);

				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"GASTOS",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $GASTOS2000, 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"RESTANTE",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( ($totalUnidad-$GASTOS2000), 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(190,4,"CAPITULO 3000",1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				if($partida3000==1)
				{
					$totalgastos=0;
					$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
					{
						while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
						{
							$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
							if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
							{
								if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
								{
									if(($row_partida_busqueda['clavepartida'] >= 3000) and ($row_partida_busqueda['clavepartida'] <= 3999))
									{
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(10,$x);
										$this->Cell(10,4,"{$row_gastos_dpto['oficio']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(20,$x);
										$this->Cell(15,4,"{$row_partida_busqueda['clavepartida']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(35,$x);
										$this->Cell(20,4,number_format ( $row_gastos_dpto['monto'], 2, '.', ',' ),1,2,'C',1);
										$GASTOS3000=$GASTOS3000+$row_gastos_dpto['monto'];
								
										$this->SetFont('Arial','B',6);
										$this->SetFillColor(255,255,255);
										$this->SetXY(55,$x);
										$this->Cell(45,4,"{$row_gastos_dpto['justificacion']}",1,2,'L',1);
								
										$totalgastos += $row_gastos_dpto['monto'];
										$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(100,$x);
											$this->Cell(10,4,"{$row_1['claveAccion']}",1,2,'C',1);
										}
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(110,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['fecha']}",1,2,'C',1);
								
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(125,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['documento']}",1,2,'C',1);

										$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(140,$x);
											$this->Cell(60,4,"{$row_1['nombredpto']}",1,2,'C',1);
										}
										if($x>260)
										{
											$x=37;
											$this->AddPage();
										}
										else
										{
											$x=$x+4;
										}
									}

								}
							}
						}
					}

				}
				$total=0;
				$totalUnidad=0;
				$tamano=3000;
				$tamano1=4000;	
				$sql_poa_dpto_gastos = "SELECT poa_dpto_gastos.id AS poa_id, poa_dpto_gastos.*, insumo.*, partida.* FROM poa_dpto_gastos, insumo, partida WHERE poa_dpto_gastos.dpto_id = '{$_SESSION['DPTO']}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.partida_id = partida.id AND poa_dpto_gastos.idacciones='{$row_programa['idacciones']}' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' AND poa_dpto_gastos.tipogasto=1";
				if ( $res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos ) )
				{
					while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
					{
						$total = $row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
						$totalUnidad += $total;
						$uno++;
					}
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"PRESUPUESTO",1,2,'C',1);
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $totalUnidad, 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"GASTOS",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $GASTOS3000, 2, '.', ',' ),1,2,'C',1);

				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"RESTANTE",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( ($totalUnidad-$GASTOS3000), 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(190,4,"CAPITULO 5000",1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				if($partida5000==1)
				{
					$totalgastos=0;
					$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
					{
						while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
						{
							$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
							if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
							{
								if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
								{
									if(($row_partida_busqueda['clavepartida'] >= 5000) and ($row_partida_busqueda['clavepartida'] <= 5999))
									{
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(10,$x);
										$this->Cell(10,4,"{$row_gastos_dpto['oficio']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(20,$x);
										$this->Cell(15,4,"{$row_partida_busqueda['clavepartida']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(35,$x);
										$this->Cell(20,4,number_format ( $row_gastos_dpto['monto'], 2, '.', ',' ),1,2,'C',1);
										$GASTOS5000=$GASTOS5000+$row_gastos_dpto['monto'];
								
										$this->SetFont('Arial','B',6);
										$this->SetFillColor(255,255,255);
										$this->SetXY(55,$x);
										$this->Cell(45,4,"{$row_gastos_dpto['justificacion']}",1,2,'L',1);
								
										$totalgastos += $row_gastos_dpto['monto'];
										$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(100,$x);
											$this->Cell(10,4,"{$row_1['claveAccion']}",1,2,'C',1);
										}
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(110,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['fecha']}",1,2,'C',1);
								
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(125,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['documento']}",1,2,'C',1);

										$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(140,$x);
											$this->Cell(60,4,"{$row_1['nombredpto']}",1,2,'C',1);
										}
										if($x>260)
										{
											$x=37;
											$this->AddPage();
										}
										else
										{
											$x=$x+4;
										}
									}

								}
							}
						}
					}

				}
				$total=0;
				$totalUnidad=0;
				$tamano=5000;
				$tamano1=6000;	
				$sql_poa_dpto_gastos = "SELECT poa_dpto_gastos.id AS poa_id, poa_dpto_gastos.*, insumo.*, partida.* FROM poa_dpto_gastos, insumo, partida WHERE poa_dpto_gastos.dpto_id = '{$_SESSION['DPTO']}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.partida_id = partida.id AND poa_dpto_gastos.idacciones='{$row_programa['idacciones']}' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' AND poa_dpto_gastos.tipogasto=1";
				if ( $res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos ) )
				{
					while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
					{
						$total = $row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
						$totalUnidad += $total;
						$uno++;
					}
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"PRESUPUESTO",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $totalUnidad, 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"GASTOS",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $GASTOS5000, 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"RESTANTE",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( ($totalUnidad-$GASTOS5000), 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(190,4,"CAPITULO 7000",1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				if($partida7000==1)
				{
					$totalgastos=0;
					$sql_gastos_dpto = "SELECT * FROM gastos_dpto WHERE iddpto='{$_SESSION['DPTO']}' AND idmeta = '{$row_programa['idacciones']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					if ( $res_gastos_dpto = mysql_db_query ( $bdd, $sql_gastos_dpto ) )
					{
						while ( $row_gastos_dpto = mysql_fetch_assoc ( $res_gastos_dpto ) )
						{
							$sql_partida_busqueda = "SELECT * FROM partida WHERE id={$row_gastos_dpto['idpartida']} ";
							if ( $res_partida_busqueda = mysql_db_query ( $bdd, $sql_partida_busqueda ) )
							{
								if ( $row_partida_busqueda = mysql_fetch_assoc ( $res_partida_busqueda ) )
								{
									if(($row_partida_busqueda['clavepartida'] >= 7000) and ($row_partida_busqueda['clavepartida'] <= 7999))
									{
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(10,$x);
										$this->Cell(10,4,"{$row_gastos_dpto['oficio']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(20,$x);
										$this->Cell(15,4,"{$row_partida_busqueda['clavepartida']}",1,2,'C',1);
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(35,$x);
										$this->Cell(20,4,number_format ( $row_gastos_dpto['monto'], 2, '.', ',' ),1,2,'C',1);
										$GASTOS7000=$GASTOS7000+$row_gastos_dpto['monto'];
								
										$this->SetFont('Arial','B',6);
										$this->SetFillColor(255,255,255);
										$this->SetXY(55,$x);
										$this->Cell(45,4,"{$row_gastos_dpto['justificacion']}",1,2,'L',1);
								
										$totalgastos += $row_gastos_dpto['monto'];
										$sql_1 = "SELECT * FROM accion WHERE id='{$row_gastos_dpto['idmeta']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(100,$x);
											$this->Cell(10,4,"{$row_1['claveAccion']}",1,2,'C',1);
										}
										
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(110,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['fecha']}",1,2,'C',1);
								
										$this->SetFont('Arial','B',7.2);
										$this->SetFillColor(255,255,255);
										$this->SetXY(125,$x);
										$this->Cell(15,4,"{$row_gastos_dpto['documento']}",1,2,'C',1);

										$sql_1 = "SELECT * FROM dpto WHERE id='{$row_gastos_dpto['iddpto_solicitante']}' ";
										$res_1 = mysql_db_query ( $bdd, $sql_1 );
										if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
										{
											$this->SetFont('Arial','B',7.2);
											$this->SetFillColor(255,255,255);
											$this->SetXY(140,$x);
											$this->Cell(60,4,"{$row_1['nombredpto']}",1,2,'C',1);
										}
										if($x>260)
										{
											$x=37;
											$this->AddPage();
										}
										else
										{
											$x=$x+4;
										}
									}

								}
							}
						}
					}

				}
				$total=0;
				$totalUnidad=0;
				$tamano=7000;
				$tamano1=8000;	
				$sql_poa_dpto_gastos = "SELECT poa_dpto_gastos.id AS poa_id, poa_dpto_gastos.*, insumo.*, partida.* FROM poa_dpto_gastos, insumo, partida WHERE poa_dpto_gastos.dpto_id = '{$_SESSION['DPTO']}' AND poa_dpto_gastos.insumo_id = insumo.id AND poa_dpto_gastos.partida_id = partida.id AND poa_dpto_gastos.idacciones='{$row_programa['idacciones']}' AND partida.clavepartida>='{$tamano}' AND partida.clavepartida<'{$tamano1}' AND poa_dpto_gastos.tipogasto=1";
				if ( $res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos ) )
				{
					while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
					{
						$total = $row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
						$totalUnidad += $total;
						$uno++;
					}
				}

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"PRESUPUESTO",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $totalUnidad, 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"GASTOS",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( $GASTOS7000, 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(150,4,"RESTANTE",1,2,'C',1);

				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(160,$x);
				$this->Cell(40,4,number_format ( ($totalUnidad-$GASTOS7000), 2, '.', ',' ),1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(190,4,"CAPITULO 7000",1,2,'C',1);
				if($x>260)
				{
					$x=37;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
			}
		}
	}
	function Footer()
	{
		/*$this->line(10,37,110,37);
		$this->line(10,37,10,270);
		$this->line(200,37,200,270);
		
		$x=270;
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(10,$x);
		$this->Cell(20,4,"TOTAL",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(30,$x);
		$this->Cell(35,4,number_format ($_SESSION['superuno'], 2, '.', ',' ),1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(65,$x);
		$this->Cell(45,4,number_format ($_SESSION['uno1'], 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(110,$x);
		$this->Cell(45,4,number_format (($_SESSION['superuno']-$_SESSION['uno1']), 2, '.', ',' ),1,2,'C',1);

		$this->line(10,270,155,270);*/
		
	}

}
	$pdf = new ReporteHorario();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?>