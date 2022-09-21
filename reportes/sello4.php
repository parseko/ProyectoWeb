<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();
$bdd="sicopre";
$_SESSION['Oficio']=$_GET['oficio'];
class ReporteHorario extends FPDF
{
	function Header()
	{							
	}

	
	function parteI()
	{
				
		$x=260;
		//segunda linea
		/*$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(255,255,255);
		$this->SetXY(90,254);
		$this->Cell(70,20,"",0,2,'C',1);*/

		
		
			
	}
	function Footer()
	{
		$sql_1 = "SELECT * FROM gastos_dpto WHERE oficio='{$_SESSION['Oficio']}' ";
		$res_1 = mysql_db_query ( "sicopre", $sql_1 )  or die(mysql_error());
		if ( $row_1 = mysql_fetch_assoc ( $res_1 ) )
		{}
		$sql_2 = "SELECT * FROM dpto WHERE id = '{$row_1['iddpto']}' ";
		$res_2 = mysql_db_query ( "sicopre", $sql_2 )  or die(mysql_error());
		if ( $row_2 = mysql_fetch_assoc ( $res_2 ) )
		{}
		$sql_3 = "SELECT * FROM proceso WHERE id = '{$row_1['idproceso']}' ";
		$res_3 = mysql_db_query ( "sicopre", $sql_3 )  or die(mysql_error());
		if ( $row_3 = mysql_fetch_assoc ( $res_3 ) )
		{}
		$sql_4 = "SELECT * FROM actividad WHERE id = '{$row_1['idclave']}' ";
		$res_4 = mysql_db_query ( "sicopre", $sql_4 )  or die(mysql_error());
		if ( $row_4 = mysql_fetch_assoc ( $res_4 ) )
		{}
		$sql_5 = "SELECT * FROM accion WHERE id = '{$row_1['idmeta']}' ";
		$res_5 = mysql_db_query ( "sicopre", $sql_5 )  or die(mysql_error());
		if ( $row_5 = mysql_fetch_assoc ( $res_5 ) )
		{}
		$sql_6 = "SELECT * FROM partida WHERE id = '{$row_1['idpartida']}' ";
		$res_6 = mysql_db_query ( "sicopre", $sql_6 )  or die(mysql_error());
		if ( $row_6 = mysql_fetch_assoc ( $res_6 ) )
		{}
		$this->SetDrawColor(16,75,120);
		$this->SetTextColor(16,75,120);
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(110,160);
		$this->Cell(70,28,"",1,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(102,166);
		$this->Cell(28,5,"DEPTO: ",0,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(122,166);
		$this->Cell(20,5,"{$row_2['abreviatura']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(145,166);
		$this->Cell(28,5,"PROC. EST.:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(167,166);
		$this->Cell(10,5,"{$row_3['claveproceso']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(106,170);
		$this->Cell(28,5,"PROC. CLAVE:",0,2,'C',1);

		$uno = $row_4['claveActiv']%10;		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(130,170);
		$this->Cell(10,5,"{$uno}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(142,170);
		$this->Cell(28,5,"META:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(160,170);
		$this->Cell(10,5,"{$row_5['claveAccion']} - {$row_5['meta']}",0,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(103,174);
		$this->Cell(28,5,"PARTIDA:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(125,174);
		$this->Cell(10,5,"{$row_6['clavepartida']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(147,174);
		$this->Cell(28,5,"No. CONTROL:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(171,174);
		$this->Cell(5,5,"{$_SESSION['Oficio']}",0,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(255,255,255);
		$this->SetXY(130,161);
		$this->Cell(28,5,"SELLO DE CONTROL",1,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(126,178);
		$this->Cell(28,5,"Vo. Bo.",0,2,'C',1);

		$_SESSION['fecha'] = date("d-m-Y H:i:s");
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(126,189);
		$this->Cell(28,5,"{$_SESSION['fecha']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(133,182);
		$this->Cell(15,5,"",B,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(0,160);
		$this->Cell(110,28,"",R,2,'C',1);

	}

}
	$pdf = new ReporteHorario(L);
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteI();
	$pdf->Output();
?> 