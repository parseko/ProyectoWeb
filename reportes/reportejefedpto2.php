<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();
$_SESSION['Docente']=$_GET['docente'];
class ReporteHorario extends FPDF
{
	private $bdd = "sicopre";
	function Header()
	{	
		
		$this->SetXY(12,3);
		$this->Cell(36,20,'',0,2,'C');
		$this->Image ( "../imagenes/reportes/sep.jpg", 20, 5, 25, 33);
		$this->SetFont('Arial','',12);
		$this->SetXY(25,6);
		$this->Cell(0,10,"DIRECCIÓN GENERAL DE EDUCACIÓN SUPERIOR TECNOLÓGICA",0,2,'C');
		$this->SetFont('Arial','',10);
		$this->SetXY(25,10);
		$this->Cell(0,10,'COORDINACIÓN SECTORIAL DE ADMINISTRACIÓN Y FINANZAS',0,0,'C');
		$this->SetXY(25,14);
		$this->Cell(0,10,"DIRECCIÓN DE RECURSOS FINANCIEROS",0,0,'C');
		$this->SetXY(25,18);
		$this->Cell(0,10,"SUBPRESUPUESTO DE INVERSIÓN CON CARGO A INGRESOS PROPIOS",0,0,'C');
		$this->SetXY(25,22);
		$this->Cell(0,10,"(CAPITULO 5000)",0,0,'C');
		$this->line(10,70,10,165);
		$this->line(30,70,30,165);
		$this->line(135,70,135,165);
		$this->line(155,70,155,165);		
		$this->line(185,70,185,165);
		$this->line(215,70,215,165);
		$this->line(345,70,345,165);
		$this->line(10,165,345,165);
						
	}

	function parteI()
	{
				
		$x=70;
		$this->SetFont('Arial','',10);
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		$this->SetXY(11,38);
		$this->Cell(150,5,"INSTITUTO TECNOLÓGICO DE: ".$row_revision['tec'],0,0,'L');
		$bdd = "sicopre";
		$TOTAL=0;
		$sql_capitulo5000 = "SELECT poa_dpto.partida_id FROM poa_dpto, partida WHERE poa_dpto.partida_id=partida.id AND partida.clavepartida > 5000 AND partida.clavepartida <6000 and poa_dpto.dpto_id = '{$_SESSION['dpto_id']}' GROUP BY poa_dpto.partida_id";
		$res_capitulo5000 = mysql_db_query ( $bdd, $sql_capitulo5000) or die(mysql_error());
		while ( $row_capitulo5000 = mysql_fetch_assoc ( $res_capitulo5000 ) )
		{
			$sql_capitulo50002 = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = dpto.id AND poa_dpto.partida_id='{$row_capitulo5000['partida_id']}' AND poa_dpto.dpto_id = '{$_SESSION['dpto_id']}' ORDER BY clavepartida, descinsu";
			$res_capitulo50002 = mysql_db_query ( $bdd, $sql_capitulo50002) or die(mysql_error());
			while ( $row_capitulo50002 = mysql_fetch_assoc ( $res_capitulo50002 ) )
			{
				$costo_total1 = $row_capitulo50002['costuni']*$row_capitulo50002['cantidad'];
				$TOTAL += $costo_total1;
				$_SESSION['Total1']=$TOTAL;
			}
			$sql_capitulo50001 = "SELECT partida.clavepartida, insumo.descinsu, poa_dpto.cantidad, insumo.costuni, poa_dpto.justificacion, dpto.nombredpto, dpto.abreviatura FROM partida, insumo, poa_dpto, dpto WHERE partida.id = poa_dpto.partida_id AND poa_dpto.insumo_id = insumo.id AND poa_dpto.dpto_id = dpto.id AND poa_dpto.partida_id='{$row_capitulo5000['partida_id']}' AND dpto.id = '{$_SESSION['dpto_id']}' ORDER BY clavepartida, descinsu";
			$res_capitulo50001 = mysql_db_query ( $bdd, $sql_capitulo50001) or die(mysql_error());
			while ( $row_capitulo50001 = mysql_fetch_assoc ( $res_capitulo50001 ) )
			{
				$descinsu = strtoupper ( $row_capitulo50001['descinsu'] );
				$justificacion = strtoupper ( $row_capitulo50001['justificacion']." (".$row_capitulo50001['abreviatura'].")");
				$this->SetXY(11,45);
				$this->SetFont('Arial','B',10);
				$this->Cell(80,5,"No. DE OFICIO DE SOLICITUD:",1,0,'L');
				$this->SetXY(91,45);
				$this->Cell(80,5,"{$_POST['oficio']}",1,0,'L');
				$this->SetXY(11,50);
				$this->Cell(80,5,"FECHA DE SOLICITUD:",1,0,'L');
				$this->SetXY(91,50);
				$this->Cell(80,5,"{$_POST['fecha_sol']}",1,0,'L');
				$this->SetXY(11,55);
				$this->Cell(80,5,"FECHA O PERIODO DE REALIZACION:",1,0,'L');
				$this->SetXY(91,55);
				$this->Cell(80,5,"{$_POST['fecha_real']}",1,0,'L');
						
				$this->SetFont('Arial','B',10);
				$this->SetXY(235,35);
				$this->Cell(110,5,"AUTORIZACIÓN DE LA DGEST",1,0,'L');
				$this->SetXY(235,40);
				$this->Cell(110,5,"OFICIO No.                                   FECHA",1,0,'L');
				$this->SetXY(235,45);
				$this->Cell(110,5,"IMPORTE",1,0,'L');
				$this->SetFont('Arial','',8);
				$this->SetXY(235,50);
				$this->Cell(110,5,"PRESUPUESTADO                                        AUTORIZADO",'LTR',0,'L');
				$this->SetFont('Arial','B',10);
				$this->SetXY(235,55);
				$this->Cell(110,5,"$".number_format(  $TOTAL  ,2,'.',','),'LBR',0,'L');
				$_SESSION[totalpre]=$total;
				$this->SetFont('Arial','',8);
				$this->SetXY(10,65);
				$this->Cell(20,5,"No. PARTIDA",1,0,'C');
				$this->Cell(105,5,"DENOMINACIÓN DEL BIEN",1,0,'C');
				$this->Cell(20,5,"CANTIDAD",1,0,'C');
				$this->Cell(30,5,"COSTO UNITARIO",1,0,'C');
				$this->Cell(30,5,"COSTO TOTAL",1,0,'C');
				$this->Cell(130,5,"JUSTIFICACIÓN",1,0,'C');
				
				$costo_total = $row_capitulo50001['costuni']*$row_capitulo50001['cantidad'];
				//$TOTAL += $costo_total;
				$this->SetXY(10,$x);
				$this->Cell(20,5,"{$row_capitulo50001['clavepartida']}",0,0,'C');
				//$this->Cell(105,5,"{$descinsu}",0,0,'C');
				$this->SetXY(30,$x);
				$this->MultiCell(105,4,"{$descinsu}",0,'C');
				$this->SetXY(135,$x);
				$this->Cell(20,5,"{$row_capitulo50001['cantidad']}",0,0,'C');
				$this->Cell(30,5, "$".number_format($row_capitulo50001['costuni'], 2, '.',','),0,0,'C');
				$this->Cell(30,5,"$".number_format($costo_total, 2, '.',','),0,0,'C');
				$this->MultiCell(130,5,"{$justificacion}",0,'C');
				
				if ( strlen( $justificacion ) > 70)
				{
					$y = ( intval ( strlen( $justificacion ) / 70 ) +1 ) * 5;
					$x=$x+$y;
					//echo $y; echo "  ";
				}
				else
				{
					$x=$x+5;
				}
				if($x >= 150)
				{
					$x=70;
					$this->AddPage();
				}
				else
				{
					$x=$x+4;
				}
			}
			$x=70;
			$this->AddPage();
			$TOTAL=0;
		}
	}
	function Footer(  )
	{
		$this->SetXY(155,165);
		$this->Cell(30,5,"TOTAL:",1,0,'C');
		$this->SetXY(185,165);
		$this->Cell(30,5,"$".number_format(  $_SESSION['Total1']  ,2,'.',','),1,0,'C');

		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if (!$row_revision = mysql_fetch_assoc ( $res_revision ))
		{
			echo "No se han asignado claves de reportes";
		}
		
		$sql_firmas = "SELECT * FROM firmas_reportes";
		$res_firmas = mysql_db_query ( $bdd, $sql_firmas );
		$row_firmas = mysql_fetch_assoc ( $res_firmas );
		
		$this->SetFont('Arial','',9);
		
		$this->SetY(-35);
		$this->SetFont('Arial','',9);
		$this->Cell(60,5,'',0,0);
		$X = $this->GetX();
		$Y = $this->GetY();
		$this->MultiCell(50,5,"SOLICITA AUTORIZACIÓN DIRECTOR DEL PLANTEL",0,'C');
		$this->Line($X-10, $Y+15, $X+60, $Y+15);
		$this->SetXY($X, $Y+16);
		$this->MultiCell(50,5,$row_firmas['nombre_director']."\n".$row_firmas['rfc_director'],0,'C');
		
		$this->SetXY($X+70, $Y);
		$X = $this->GetX();
		$Y = $this->GetY();
		$this->MultiCell(30,5,"SELLO OFICIAL (PLANTEL)",0,'C');
		
		$this->SetXY($X+60, $Y);
		$X = $this->GetX();
		$Y = $this->GetY();
		$this->MultiCell(60,5,"AUTORIZACION DIRECTOR GENERAL",0,'C');
		$this->Line($X-10, $Y+15, $X+70, $Y+15);
		$this->SetXY($X, $Y+16);
		$this->MultiCell(60,5,$row_firmas['nombre_general']."\n".$row_firmas['rfc_general'],0,'C');
		
		$this->SetXY($X+80, $Y);
		$X = $this->GetX();
		$Y = $this->GetY();
		$this->MultiCell(30,5,"SELLO OFICIAL (D.G.E.S.T.)",0,'C');
	}
}
	//$pdf = new ReporteHorario(L);
	$pdf=new ReporteHorario('L', 'mm', 'Legal');
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteI();
	$pdf->Output();
?> 