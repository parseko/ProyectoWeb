<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
//session_start();
$_SESSION['Docente']=$_GET['docente'];
class ReporteHorario extends FPDF
{
	function Header()
	{	
		
		$this->SetXY(12,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/dgest.jpg",13,5,25,25);
		
		$this->SetXY(100,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/tec.jpeg",255,3,25,25);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(98,5);
		$this->Cell(65,4,"COORDINACION SECTORIAL DE PLANEACION Y DESARROLLO DEL SISTEMA",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(120,11);
		$this->Cell(45,4,"DIRECCION DE TELECOMUNICACIONES",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(90,17);
		$this->Cell(45,4,"COORDINACION DE MANTENIMIENTO, SOPORTE Y ASISTENCIA TECNICA EN COMPUTO",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(102,21);
		$this->Cell(45,4,"DESCRIPCION DE LAS METAS DEL PTA USADAS EN LOS FORMATOS",0,2,'L');
		
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
		$this->SetFillColor(225,225,225);
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(11,$x);
		$this->Cell(30,8,"NUMERO DE META","LTR",2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetXY(41,$x);
		$this->Cell(244,8,"DESCRIPCION DE LA META",1,2,'C',1);
		
		
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
		

			$sql_metas = "SELECT * FROM accion WHERE 1 ORDER BY claveAccion";
			$res_metas = mysql_db_query ( $bdd, $sql_metas );
			while ( $row_metas = mysql_fetch_assoc ( $res_metas ) )
			{
				if ( strlen ($row_metas['nombreAccion'] < 184) )
				{
					$temp=$x;
					$y= (( strlen( $row_metas['nombreAccion'] ) / 184 ) * 4);
					if($y>$z)
					{
						$temp=$temp+($y+5);
						if($temp >= 180)
						{
							$this->AddPage();
							$x=43;
						}
					}
					else
					{
						$temp=$temp+($z+5);
						if($temp >= 180)
						{
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
						$this->AddPage();
						$x=43;
					}
				}
				$this->SetFont('Arial','B',6);
				$this->SetFillColor(255,255,255);
				$this->SetXY(11,$x);
				$this->Cell(30,4,$row_metas['claveAccion'],0,2,'C',1);				
			
				$this->SetFont('Arial','B',6);
				$this->SetXY(41,$x);
				$this->MultiCell(242,3,$row_metas['nombreAccion'],0,'L');
				if ( strlen ( ($row_metas['nombreAccion'])  < 184) )
				{
					$y= (( strlen( $row_metas['nombreAccion'] ) / 184 ) * 4);
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

			}
	}
	function Footer()
	{
		$this->line(11,43,285,43);
		$this->line(11,43,11,180);
		$this->line(41,43,41,180);
		$this->line(285,43,285,180);
		$x=180;

		$this->line(11,180,285,180);
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}

		
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