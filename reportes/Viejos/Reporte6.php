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
	    $this->Image("../imagenes/reportes/dgest.jpg",13,5,42,19);
		
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
		$this->SetXY(120,26);
		$this->Cell(45,4,"LISTADO DE EQUIPOS Y APARATOS DE COMUNICACIONES Y TELECOMUNICACIONES 5204",0,2,'L');
		
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(60,30);
		$this->Cell(55,4,"INSTITUTO TECNOLÓGICO DE : ".$row_revision['tec'],0,2,'L');
						
		
		
		$x=35;
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
		$x=43;		
		$bdd = "sicopre";
		$_SESSION['conta']=0;
		$_SESSION['temp']=0;
		$_SESSION['otro']=0;
		$_SESSION['conta1']=0;
		$_SESSION['temp1']=0;
		$_SESSION['otro1']=0;
		$_SESSION['Suma']=0;
		$_SESSION['Candado']=1;
		$_SESSION['Temporal']=0;
		$_SESSION['Temporal2']=0;
		$_SESSION['SUBTOTAL']=0;
		
			$sql_capitulo5000a = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, poa_dpto.idacciones, poa_dpto.idproceso, poa_dpto.idactividad, insumo.costuni, poa_dpto.justificacion, poa_dpto.dpto_id, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = dpto.id AND clavepartida = 5204  ORDER BY partida.clavepartida";
			$res_capitulo5000a = mysql_db_query ( $bdd, $sql_capitulo5000a );
			while ( $row_capitulo5000a = mysql_fetch_assoc ( $res_capitulo5000a ) )
			{
				$sql_dpto = "SELECT * FROM dpto WHERE id='{$row_capitulo5000a['dpto_id']}'";
				$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
				if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
				{}
				$_SESSION['SUBTOTAL'] = $_SESSION['SUBTOTAL'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);

				if(($_SESSION['Temporal'] == $row_capitulo5000a['clavepartida']) or ($_SESSION['Candado'] == 1))
				{
					$_SESSION['Suma'] = $_SESSION['Suma'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
				}
				else
				{
					if($x<48)
					{
							$_SESSION['Suma'] = $_SESSION['Suma'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
					$x=43;
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
				if ( strlen ( ($row_capitulo5000a['justificacion']+". "+$row_dpto['abreviatura'])  < 80) or ($row_capitulo5000a['descinsu'] < 60))
				{
					$temp=$x;
					$y= (( strlen( $row_capitulo5000a['justificacion'] ) / 80 ) * 4);
					$z= (( strlen( $row_capitulo5000a['descinsu'] ) / 60 ) * 4);
					if($y>$z)
					{
						$temp=$temp+($y+5);
						if($temp >= 180)
						{
							$_SESSION['SUBTOTAL']=0;
							$_SESSION['SUBTOTAL'] = $_SESSION['SUBTOTAL'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
							$this->AddPage();
							$x=43;
						}
					}
					else
					{
						$temp=$temp+($z+5);
						if($temp >= 180)
						{
							$_SESSION['SUBTOTAL']=0;
							$_SESSION['SUBTOTAL'] = $_SESSION['SUBTOTAL'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
							$this->AddPage();
							$x=43;
						}
					}
				}
				else
				{
					$temp= $temp + 6;
					if($temp >= 180)
					{
						$_SESSION['SUBTOTAL']=0;
						$_SESSION['SUBTOTAL'] = $_SESSION['SUBTOTAL'] + ($row_capitulo5000a['cantidad'] * $row_capitulo5000a['costuni']);
						$this->AddPage();
						$x=43;
					}
				}
				$this->SetFont('Arial','B',7.5);
				$this->SetFillColor(255,255,255);
				$this->SetXY(11,$x);
				$sql_meta = "SELECT * FROM accion WHERE id='{$row_capitulo5000a['idacciones']}'";
				$res_meta = mysql_db_query ( $bdd, $sql_meta );
				if ( $row_meta = mysql_fetch_assoc ( $res_meta ) )
				{}
				//$this->Cell(20,4,$row_meta['claveAccion'],0,2,'C',1);
				//$this->Cell(20,4,$row_meta['claveAccion'],0,2,'C',1);
				$this->Cell(20,4,$row_meta['claveAccion'],0,2,'C',1);
				
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
		
			
				$this->SetFont('Arial','B',6);
				$this->SetXY(201,$x);
				$this->MultiCell(80,3,$row_capitulo5000a['justificacion'].". (".$row_dpto['abreviatura'].")",0,'J');
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
				
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(151,180);
				$this->Cell(25,4,"SUBTOTAL : ",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(176,180);
				$this->Cell(25,4,number_format (($_SESSION['SUBTOTAL']), 2, '.',','),1,2,'C',1);

			}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(151,184);
			$this->Cell(25,4,"TOTAL : ",1,2,'C',1);
					
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(176,184);
			$this->Cell(25,4,number_format (($_SESSION['Suma']), 2, '.',','),1,2,'C',1);
			$x=43;
	}
	function Footer()
	{
		$this->line(11,43,285,43);
		$this->line(11,43,11,180);
		$this->line(31,43,31,180);
		$this->line(61,43,61,180);
		$this->line(131,43,131,180);
		$this->line(151,43,151,180);		
		$this->line(176,43,176,180);
		$this->line(201,43,201,180);
		$this->line(285,43,285,180);
		$x=180;

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
		$this->SetFillColor(255,255,255);
		$this->SetXY(40,$x+15);
		$this->Cell(100,4,$row_firmas['nombre_director'],0,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(170,$x+15);
		$this->Cell(80,4,$row_firmas['nombre_general'],0,2,'C',1);
		
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
		
	}

}
	$pdf = new ReporteHorario(L);
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?> 