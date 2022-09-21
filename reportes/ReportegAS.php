<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();
$_SESSION['Docente']=$_GET['docente'];
class ReporteHorario extends FPDF
{
	function Header()
	{	
		
		$this->SetXY(12,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/dgest.JPG",13,5,25,25);
		
		$this->SetXY(100,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/tec.jpeg",255,3,25,25);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(85,5);
		$this->Cell(45,4,"FORMATO DE DESGLOSE DEL PRESUPUESTO DE INVERSION CON CARGO A INGRESOS PROPIOS",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(118,11);
		$this->Cell(45,4,"REFERENCIA A LA NORMA ISO 9001-2000: 6.1",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(123,17);
		$this->Cell(45,4,"PROGRAMA OPERATIVO ANUAL 2008",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(94,21);
		$this->Cell(45,4,"DESGLOSE DEL PRESUPUESTO DE INVERSION CON CARGO A INGRESOS PROPIOS",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(132,26);
		$this->Cell(45,4,"(CAPÍTULO 5000)",0,2,'L');
		
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(60,30);
		$this->Cell(55,4,"INSTITUTO TECNOLÓGICO DE : ".$row_revision['tec'],0,2,'L');
						
		$x=35;
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(11,35);
		$this->Cell(70,5,"PROCESOS ESTRATEGICO:",1,2,'L',1);	
		
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(225,225,225);
		$this->SetXY(11,40);
		$this->Cell(70,5,"PROCESO CLAVE:",1,2,'L',1);	
		
		
		$x=47;
		//segunda linea
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(11,$x);
		$this->Cell(20,4,"NÚMERO DE",LTR,2,'C',1);
		$this->SetXY(11,$x+4);
		$this->Cell(20,4,"METAS",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(31,$x);
		$this->Cell(30,4,"NÚMERO DE",LTR,2,'C',1);
		$this->SetXY(31,$x+4);
		$this->Cell(30,4,"LA PARTIDA",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(61,$x);
		$this->Cell(70,8,"DENOMINACIÓN  DEL BIEN",1,2,'C',1);
			
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(131,$x);
		$this->Cell(20,8,"CANTIDAD",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(151,$x);
		$this->Cell(25,4,"COSTO",LTR,2,'C',1);
		$this->SetXY(151,$x+4);
		$this->Cell(25,4,"UNITARIO",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(176,$x);
		$this->Cell(25,8,"COSTO TOTAL",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(201,$x);
		$this->Cell(84,8,"JUSTIFICACIÓN",1,2,'C',1);
		
	}
	function parteII()
	{
		$_SESSION['conta']=0;
		$_SESSION['temp']=0;
		$_SESSION['otro']=0;
		$_SESSION['conta1']=0;
		$_SESSION['temp1']=0;
		$_SESSION['otro1']=0;
		$x=55;
		$conta=0;
		$bdd = "sicopre";
		$sql_capitulo5000 = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, poa_dpto.idacciones, poa_dpto.idactividad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = '{$_SESSION['dpto_id']}' AND clavepartida >5000 AND clavepartida <6000 GROUP BY idactividad ";
		$res_capitulo5000 = mysql_db_query ( $bdd, $sql_capitulo5000 );
		while ( $row_capitulo5000 = mysql_fetch_assoc ( $res_capitulo5000 ) )
		{
			$sql_capitulo5000a = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, poa_dpto.idacciones, poa_dpto.idproceso, poa_dpto.idactividad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND dpto_id = '{$_SESSION['dpto_id']}' AND clavepartida >5000 AND clavepartida <6000 AND poa_dpto.idactividad= '{$row_capitulo5000['idactividad']}' GROUP BY poa_dpto.id ORDER BY partida.clavepartida";
			$res_capitulo5000a = mysql_db_query ( $bdd, $sql_capitulo5000a );
			while ( $row_capitulo5000a = mysql_fetch_assoc ( $res_capitulo5000a ) )
			{
				$sql_proceso = "SELECT * FROM proceso WHERE id='{$row_capitulo5000a['idproceso']}'";
				$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
				if ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
				{}
				$this->SetFont('Arial','B',7.5);
				$this->SetFillColor(255,255,255);
				$this->SetXY(81,35);
				$this->Cell(204,5,$row_proceso['nombreproceso'],1,2,'L',1);	
						
				$sql_actividad = "SELECT * FROM actividad WHERE id='{$row_capitulo5000a['idactividad']}'";
				$res_actividad = mysql_db_query ( $bdd, $sql_actividad );
				if ( $row_actividad = mysql_fetch_assoc ( $res_actividad ) )
				{}
				$this->SetFont('Arial','B',7.5);
				$this->SetFillColor(255,255,255);
				$this->SetXY(81,40);
				$this->Cell(204,5,$row_actividad['nombreactiv'],1,2,'L',1);	

				
				if(($_SESSION['Temporal'] == $row_capitulo5000a['clavepartida']) or ($_SESSION['Candado'] == 1))
				{
					$_SESSION['Suma'] = $_SESSION['Suma'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
					$_SESSION['Temporal2']=$row_capitulo5000a['clavepartida'];
				}
				else
				{
					if($x<60)
					{
							$_SESSION['Suma'] = $_SESSION['Suma'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
					$x=55;
					}
					else
					{
						$this->SetFont('Arial','B',7.5);
						$this->SetXY(61,$x);
						$this->SetFillColor(225,225,225);
						$this->Cell(70,4,"SUBTOTAL DE LA PARTIDA ".$_SESSION['Temporal2'],0,2,'C',1);
						
						$this->SetFont('Arial','B',7.5);
						$this->SetXY(176,$x);
						$this->SetFillColor(225,225,225);
						$this->Cell(25,4,number_format (($_SESSION['Suma']), 2, '.',','),0,2,'C',1);
						$x=$x+6;
						$_SESSION['Suma']=0;
						$_SESSION['Suma'] = $_SESSION['Suma'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
						$this->line(11,$x-1,285,$x-1);
					}

				}
				if ( strlen ( ($row_capitulo5000a['justificacion'])  < 80) or ($row_capitulo5000a['descinsu'] < 60))
				{
					$temp=$x;
					$y= (( strlen( $row_capitulo5000a['justificacion'] ) / 80 ) * 4);
					$z= (( strlen( $row_capitulo5000a['descinsu'] ) / 60 ) * 4);
					if($y>$z)
					{
						$temp=$temp+($y+5);
						if($temp >= 180)
						{
							$this->AddPage();
							$x=55;
						}
					}
					else
					{
						$temp=$temp+($z+5);
						if($temp >= 180)
						{
							$this->AddPage();
							$x=55;
						}
					}
				}
				else
				{
					$temp= $temp + 6;
					if($temp >= 180)
					{
						$this->AddPage();
						$x=55;
					}
				}
				$this->SetFont('Arial','B',7.5);
				$this->SetFillColor(255,255,255);
				$this->SetXY(11,$x);
				$this->Cell(20,4,$row_capitulo5000a['idacciones'],0,2,'C',1);
				
				$this->SetFont('Arial','B',7.5);
				$this->SetFillColor(255,255,255);
				$this->SetXY(31,$x);
				$this->Cell(30,4,$row_capitulo5000a['clavepartida'],0,2,'C',1);
								
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(61,$x);
				$this->MultiCell(70,4,$row_capitulo5000a['descinsu'],0,'J');
							
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(131,$x);
				$this->Cell(20,4,$row_capitulo5000a['cantidad'],0,2,'C',1);
						
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(151,$x);
				$this->Cell(25,4,$row_capitulo5000a['costuni'],0,2,'C',1);
						
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(176,$x);
				$this->Cell(25,4,number_format (($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']), 2, '.',','),0,2,'C',1);
		
				//CLAVE
				if($_SESSION['conta']==0)
				{
					$_SESSION['temp']=$row_capitulo5000['idactividad'];
					$_SESSION['subtotal'] = $_SESSION['subtotal'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
					$_SESSION['conta']++;
				}
				else
				{
					if($_SESSION['temp']==$row_capitulo5000['idactividad'])
					{
						$_SESSION['subtotal'] = $_SESSION['subtotal'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
					}
					else
					{								
						$_SESSION['subtotal']=0;
						$_SESSION['subtotal'] = $_SESSION['subtotal'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
						$_SESSION['temp']=$row_capitulo5000['idactividad'];
					}
				}
						
				//PROCESO
				if($_SESSION['conta1']==0)
				{
					$_SESSION['temp1']=$row_capitulo5000a['idproceso'];
					$_SESSION['subtotal1'] = $_SESSION['subtotal1'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
					$_SESSION['conta1']++;
				}
				else
				{
					if($_SESSION['temp1']==$row_capitulo5000a['idproceso'])
					{
						$_SESSION['subtotal1'] = $_SESSION['subtotal1'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
					}
					else
					{								
						$_SESSION['subtotal1']=0;
						$_SESSION['subtotal1'] = $_SESSION['subtotal1'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
						$_SESSION['temp1']=$row_capitulo5000a['idproceso'];
					}
					
				}
			
				$this->SetFont('Arial','B',6);
				$this->SetXY(201,$x);
				$this->MultiCell(80,3,$row_capitulo5000a['justificacion'],0,'J');
				if ( strlen ( ($row_capitulo5000a['justificacion'])  < 80) or ($row_capitulo5000a['descinsu'] < 60))
				{
					$y= (( strlen( $row_capitulo5000a['justificacion'] ) / 80 ) * 4);
					$z= (( strlen( $row_capitulo5000a['descinsu'] ) / 60 ) * 4);
					if($y>$z)
					{
						$x=$x+($y+5);
					}
					else
					{
						$x=$x+($z+5);
					}
					$this->line(11,$x-1,285,$x-1);
				}
				else
				{
					$x= $x + 6;
					$this->line(76,$x-1,350,$x-1);
				}
				$_SESSION['Temporal2']=$row_capitulo5000a['clavepartida'];
				$_SESSION['Temporal']=$row_capitulo5000a['clavepartida'];
				$_SESSION['Candado']=0;
			}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(61,$x);
			$this->SetFillColor(225,225,225);
			$this->Cell(70,4,"SUBTOTAL DE LA PARTIDA ".$_SESSION['Temporal2'],0,2,'C',1);
					
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(176,$x);
			$this->SetFillColor(225,225,225);
			$this->Cell(25,4,number_format (($_SESSION['Suma']), 2, '.',','),0,2,'C',1);
			$x=55;
			$this->AddPage();
			$_SESSION['subtotal']=0;
			$_SESSION['Suma']=0;
		}
	}
	function Footer()
	{
		$this->line(11,55,285,55);
		$this->line(11,55,11,180);
		$this->line(31,55,31,180);
		$this->line(61,55,61,180);
		$this->line(131,55,131,180);
		$this->line(151,55,151,180);		
		$this->line(176,55,176,180);
		$this->line(201,55,201,180);
		$this->line(285,55,285,180);
		$x=180;
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(80,$x);
		$this->Cell(95,4,"TOTAL POR PROCESO CLAVE:",0,2,'R',1);
			
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(80,$x+4);
		$this->Cell(95,4,"TOTAL POR PROCESO ESTRATÉGICO:",0,2,'R',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(176,$x);
		$this->Cell(25,4,$_SESSION['subtotal'],1,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(176,$x+4);
		$this->Cell(25,4,$_SESSION['subtotal1'],1,2,'C',1);
		$this->line(11,180,285,180);

		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		$sql_firmas = "SELECT * FROM firmas_reportes";
		$res_firmas = mysql_db_query ( $bdd, $sql_firmas );
		if ( $row_firmas = mysql_fetch_assoc ( $res_firmas ) )
		{}
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(40,$x+15);
		$this->Cell(100,4,$row_firmas['nombre_director'],0,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(160,$x+15);
		$this->Cell(100,4,$row_firmas['nombre_general'],0,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(40,$x+20);
		$this->Cell(100,4,"DIRECTOR DEL INSTITUTO TECNOLOGICO DE ".$row_revision[tec],'T',2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(160,$x+20);
		$this->Cell(100,4,"DIRECTOR GRAL. DE EDUC. SUP. TECNOLOGICA",'T',2,'C',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(10,$x+21);
		$this->Cell(10,4,$row_revision['snest'],0,2,'C',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(280,$x+21);
		$this->Cell(10,4,$row_revision['revision'],0,2,'C',1);
		
		$sql_dpto = "SELECT * FROM dpto WHERE id='{$_SESSION['dpto_id']}'";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{}
		$this->SetFont('Arial','B',4);
		$this->SetXY(250,$x+25);
		$this->Cell(10,4,$row_dpto['nombredpto'],0,2,'C',1);
	}

}
	$pdf = new ReporteHorario(L);
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?> 