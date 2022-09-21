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
//$_SESSION['DPTO']=1;
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
		$this->Cell(45,4,"FORMATO DE DESGLOSE DE GASTOS",0,2,'L');

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
		$this->Cell(14,4,"META",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(24,$x);
		$this->Cell(20,4,"PARTIDA",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(44,$x);
		$this->Cell(25,4,"NO. CONTROL",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(69,$x);
		$this->Cell(20,4,"MONTO",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(89,$x);
		$this->Cell(55,4,"JUSTIFICACION",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(144,$x);
		$this->Cell(15,4,"FECHA",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(159,$x);
		$this->Cell(12,4,"DOCTO",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(171,$x);
		$this->Cell(23,4,"DPTO SOLIC.",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(194,$x);
		$this->Cell(6,4,"",1,2,'C',1);
	}
	function parteII()
	{
		$x=37;
		$bdd = "sicopre";
		$sql_gastos = "SELECT  * FROM gastos_dpto, partida WHERE gastos_dpto.iddpto = '{$_SESSION['DPTO']}' AND gastos_dpto.idpartida=partida.id ORDER BY gastos_dpto.oficio";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
			
			if ( strlen ($row_gastos['justificacion']) > 80)
			{
				$temp=$x;
				$y= (( strlen( $row_gastos['justificacion'] ) / 80 ) * 4);
				$temp=$temp+($y+5);
				if($temp >= 270)
				{
					$this->AddPage();
					$x=37;
				}
			}
			$sql_meta = "SELECT * FROM accion WHERE id = '{$row_gastos['idmeta']}'";
			$res_meta = mysql_db_query ( $bdd, $sql_meta );
			if ( $row_meta = mysql_fetch_assoc ( $res_meta ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(10,$x);
			$this->Cell(14,4,$row_meta[claveAccion],0,2,'C',1);	

			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(24,$x);
			$this->Cell(20,4,$row_gastos['clavepartida'],0,2,'C',1);	

			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(44,$x);
			$this->Cell(25,4,$row_gastos['oficio'],0,2,'C',1);	

			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(69,$x);
			$this->Cell(20,4,number_format ($row_gastos['monto'], 2, '.', ',' ),0,2,'C',1);	

			$this->SetFont('Arial','B',6);
			$this->SetXY(89,$x);
			$this->MultiCell(55,2.5,$row_gastos['justificacion'],0,'J');
			

			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(144,$x);
			$this->Cell(15,4,$row_gastos['fecha'],0,2,'C',1);	

			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(159,$x);
			$this->Cell(12,4,$row_gastos['documento'],0,2,'C',1);	
			
			$sql_dpto = "SELECT * FROM dpto WHERE id = '{$row_gastos['iddpto_solicitante']}'";
			$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
			if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(171,$x);
			$this->Cell(23,4,$row_dpto['abreviatura'],0,2,'C',1);	
			
			if($row_gastos['donde']=="Normal")
			{
				$_SESSION['donde']="N";
			}
			else if($row_gastos['donde']=="Remanente")
			{
				$_SESSION['donde']="R";
			}
			else
			{
				$_SESSION['donde']="C";
			}
			$this->SetFont('Arial','B',7.2);
			$this->SetXY(194,$x);
			$this->Cell(6,4,$_SESSION['donde'],0,2,'C',1);


			$x = $x + 4;
			if ( strlen ($row_gastos['justificacion']) > 55)
			{
				$y= (( strlen( $row_gastos['justificacion'] ) / 55 ) * 4);
				$temp=$temp+($y+5);
				if($temp >= 270)
				{}
				else
				{
					$x=$x+$y;
					$this->line(11,$x,200,$x);
				}
			}
			if($x>265)
			{
			
				$this->AddPage();
				$x=37;
			}

		}
	}
	function Footer()
	{
		$this->line(10,37,200,37);
		$this->line(10,37,10,270);
		$this->line(24,37,24,270);
		$this->line(44,37,44,270);
		$this->line(69,37,69,270);
		$this->line(89,37,89,270);		
		$this->line(144,37,144,270);
		$this->line(159,37,159,270);
		$this->line(171,37,171,270);
		$this->line(194,37,194,270);
		$this->line(200,37,200,270);
		$x=270;
		/*$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(44,270);
		$this->Cell(25,4,"SUBTOTAL:",0,2,'R',1);
			
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(44,270+4);
		$this->Cell(25,4,"TOTAL:",0,2,'R',1);

		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(69,270);
		$this->Cell(20,4,"",1,2,'R',1);
			
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(69,270+4);
		$this->Cell(20,4,"",1,2,'R',1);*/
		$this->line(11,270,200,270);

		$this->line(11,270,200,270);
		
	}

}
	$pdf = new ReporteHorario();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?>