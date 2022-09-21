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
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(255,255,255);
		$this->SetXY(90,254);
		$this->Cell(70,20,"",0,2,'C',1);

		
		
			
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
		$this->SetXY(70,148);
		$this->Cell(70,28,"",1,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(62,154);
		$this->Cell(28,5,"DEPTO: ",0,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(82,154);
		$this->Cell(20,5,"{$row_2['abreviatura']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(105,154);
		$this->Cell(28,5,"PROC. EST.:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(127,154);
		$this->Cell(10,5,"{$row_3['claveproceso']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(66,158);
		$this->Cell(28,5,"PROC. CLAVE:",0,2,'C',1);

		$uno = $row_4['claveActiv']%10;		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(90,158);
		$this->Cell(10,5,"{$uno}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(102,158);
		$this->Cell(28,5,"META:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(120,158);
		$this->Cell(10,5,"{$row_5['claveAccion']} - {$row_5['meta']}",0,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(63,162);
		$this->Cell(28,5,"PARTIDA:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(85,162);
		$this->Cell(10,5,"{$row_6['clavepartida']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(107,162);
		$this->Cell(28,5,"No. CONTROL:",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(131,162);
		$this->Cell(5,5,"{$_SESSION['Oficio']}",0,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(255,255,255);
		$this->SetXY(90,149);
		$this->Cell(28,5,"SELLO DE CONTROL",1,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(86,166);
		$this->Cell(28,5,"Vo. Bo.",0,2,'C',1);

		$_SESSION['fecha'] = date("d-m-Y H:i:s");
		$this->SetFillColor(255,255,255);
		$this->SetXY(86,177);
		$this->Cell(28,5,"{$_SESSION['fecha']}",0,2,'C',1);

		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(93,170);
		$this->Cell(15,5,"",B,2,'C',1);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(255,255,255);
		$this->SetXY(0,148);
		$this->Cell(70,28,"",R,2,'C',1);

	}

}
	$pdf = new ReporteHorario();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteI();
	$pdf->Output();
?> 