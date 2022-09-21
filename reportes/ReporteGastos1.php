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
		$this->Cell(20,4,"PARTIDA",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(30,$x);
		$this->Cell(35,4,"PRESUPUESTADO",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(65,$x);
		$this->Cell(45,4,"EJERCIDO",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(110,$x);
		$this->Cell(45,4,"POR EJERCER",1,2,'C',1);
	}
	function parteII()
	{
		$x=37;
		$_SESSION['Candado']=0;
		$_SESSION['superuno'] = 0;	
		$_SESSION['uno1'] = 0;	
		$_SESSION['TOTAL1000']=0;
		$_SESSION['TOTAL2000']=0;
		$_SESSION['TOTAL3000']=0;
		$_SESSION['TOTAL5000']=0;
		$_SESSION['TOTAL7000']=0;
		$_SESSION['TOTAL100']=0;
		$_SESSION['TOTAL200']=0;
		$_SESSION['TOTAL300']=0;
		$_SESSION['TOTAL500']=0;
		$_SESSION['TOTAL700']=0;
		$_SESSION['Cand1']=0;
		$_SESSION['Cand2']=0;
		$_SESSION['Cand3']=0;
		$_SESSION['Cand5']=0;
		$_SESSION['Cand7']=0;
		$bdd = "sicopre";
		
		$sql_gastos = "SELECT * FROM partida GROUP BY clavepartida ORDER BY clavepartida";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
			$sql_gastos1 = "SELECT  * FROM poa_dpto_gastos WHERE partida_id = '{$row_gastos['id']}' AND dpto_id='{$_SESSION['DPTO']}' and  tipogasto=1";
			$res_gastos1 = mysql_db_query ( $bdd, $sql_gastos1 );
			while ( $row_gastos1 = mysql_fetch_assoc ( $res_gastos1 ) )
			{
				$sql_gastos2 = "SELECT  * FROM insumo WHERE id = '{$row_gastos1['insumo_id']}'";
				$res_gastos2 = mysql_db_query ( $bdd, $sql_gastos2 );
				if ( $row_gastos2 = mysql_fetch_assoc ( $res_gastos2 ) )
				{}
				if($row_gastos['clavepartida']>=1000 and $row_gastos['clavepartida']<2000)
				{
					$uno= $row_gastos1['cantidad']*$row_gastos2['costuni'];
					$superuno = $superuno + $uno;
					$_SESSION['TOTAL1000'] = $_SESSION['TOTAL1000'] + $uno;
					//$_SESSION['Candado']=1;
				}
				if($row_gastos['clavepartida']>=2000 and $row_gastos['clavepartida']<3000)
				{
					$uno= $row_gastos1['cantidad']*$row_gastos2['costuni'];
					$superuno = $superuno + $uno;
					$_SESSION['TOTAL2000'] = $_SESSION['TOTAL2000'] + $uno;
					//$_SESSION['Candado']=2;
				}
				if($row_gastos['clavepartida']>=3000 and $row_gastos['clavepartida']<4000)
				{
					$uno= $row_gastos1['cantidad']*$row_gastos2['costuni'];
					$superuno = $superuno + $uno;
					$_SESSION['TOTAL3000'] = $_SESSION['TOTAL3000'] + $uno;
					//$_SESSION['Candado']=3;
				}
				if($row_gastos['clavepartida']>=5000 and $row_gastos['clavepartida']<6000)
				{
					$uno= $row_gastos1['cantidad']*$row_gastos2['costuni'];
					$superuno = $superuno + $uno;
					$_SESSION['TOTAL5000'] = $_SESSION['TOTAL5000'] + $uno;
					//$_SESSION['Candado']=5;
				}
				if($row_gastos['clavepartida']>=7000 and $row_gastos['clavepartida']<8000)
				{
					$uno= $row_gastos1['cantidad']*$row_gastos2['costuni'];
					$superuno = $superuno + $uno;
					$_SESSION['TOTAL7000'] = $_SESSION['TOTAL7000'] + $uno;
					//$_SESSION['Candado']=7;
				}
			}
			
			$sql_gastos11 = "SELECT  * FROM gastos_dpto WHERE idpartida = '{$row_gastos['id']}' AND iddpto='{$_SESSION['DPTO']}' AND donde != 'Cancelado' AND donde != 'Remanente'";
			$res_gastos11 = mysql_db_query ( $bdd, $sql_gastos11 );
			while ( $row_gastos11 = mysql_fetch_assoc ( $res_gastos11 ) )
			{
				if($row_gastos['clavepartida']>=1000 and $row_gastos['clavepartida']<2000)
				{
					$uno1= $uno1+$row_gastos11['monto'];
					$uno2= $uno2+$row_gastos11['monto'];
					$_SESSION['TOTAL100'] = $_SESSION['TOTAL100'] + $uno2;
					$uno2=0;
				}
				if($row_gastos['clavepartida']>=2000 and $row_gastos['clavepartida']<3000)
				{
					$uno1= $uno1+$row_gastos11['monto'];
					$uno2= $uno2+$row_gastos11['monto'];
					$_SESSION['TOTAL200'] = $_SESSION['TOTAL200'] + $uno2;
					$uno2=0;
				}
				if($row_gastos['clavepartida']>=3000 and $row_gastos['clavepartida']<4000)
				{
					$uno1= $uno1+$row_gastos11['monto'];
					$uno2= $uno2+$row_gastos11['monto'];
					$_SESSION['TOTAL300'] = $_SESSION['TOTAL300'] + $uno2;
					$uno2=0;
				}
				if($row_gastos['clavepartida']>=5000 and $row_gastos['clavepartida']<6000)
				{
					$uno1= $uno1+$row_gastos11['monto'];
					$uno2= $uno2+$row_gastos11['monto'];
					$_SESSION['TOTAL500'] = $_SESSION['TOTAL500'] + $uno2;
					$uno2=0;
				}
				if($row_gastos['clavepartida']>=7000 and $row_gastos['clavepartida']<8000)
				{
					$uno1= $uno1+$row_gastos11['monto'];
					$uno2= $uno2+$row_gastos11['monto'];
					$_SESSION['TOTAL700'] = $_SESSION['TOTAL700'] + $uno2;
					$uno2=0;
				}
			}

			if($row_gastos['clavepartida'] > 2000 and $_SESSION['Cand1']==0)
			{
				$this->SetFont('Arial','B',6);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(20,4,"TOTAL 1000",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(30,$x);
				$this->Cell(35,4,number_format ($_SESSION['TOTAL1000'], 2, '.', ',' ),1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(65,$x);
				$this->Cell(45,4,number_format ($_SESSION['TOTAL100'], 2, '.', ',' ),1,2,'C',1);
		
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(110,$x);
				$this->Cell(45,4,number_format (($_SESSION['TOTAL1000']-$_SESSION['TOTAL100']), 2, '.', ',' ),1,2,'C',1);
	
				$x = $x + 4;
				$_SESSION['Cand1']=1;
			}

			if($row_gastos['clavepartida'] > 3000 and $_SESSION['Cand2']==0)
			{
				$this->SetFont('Arial','B',6);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(20,4,"TOTAL 2000",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(30,$x);
				$this->Cell(35,4,number_format ($_SESSION['TOTAL2000'], 2, '.', ',' ),1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(65,$x);
				$this->Cell(45,4,number_format ($_SESSION['TOTAL200'], 2, '.', ',' ),1,2,'C',1);
		
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(110,$x);
				$this->Cell(45,4,number_format (($_SESSION['TOTAL2000']-$_SESSION['TOTAL200']), 2, '.', ',' ),1,2,'C',1);
	
				$x = $x + 4;
				$_SESSION['Cand2']=1;
			}
			if($row_gastos['clavepartida'] > 5000 and $_SESSION['Cand3']==0)
			{
				$this->SetFont('Arial','B',6);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(20,4,"TOTAL 3000",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(30,$x);
				$this->Cell(35,4,number_format ($_SESSION['TOTAL3000'], 2, '.', ',' ),1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(65,$x);
				$this->Cell(45,4,number_format ($_SESSION['TOTAL300'], 2, '.', ',' ),1,2,'C',1);
		
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(110,$x);
				$this->Cell(45,4,number_format (($_SESSION['TOTAL3000']-$_SESSION['TOTAL300']), 2, '.', ',' ),1,2,'C',1);
	
				$x = $x + 4;
				$_SESSION['Cand3']=1;
			}
			if($row_gastos['clavepartida'] > 7000 and $_SESSION['Cand5']==0)
			{
				$this->SetFont('Arial','B',6);
				$this->SetFillColor(225,225,225);
				$this->SetXY(10,$x);
				$this->Cell(20,4,"TOTAL 5000",1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(30,$x);
				$this->Cell(35,4,number_format ($_SESSION['TOTAL5000'], 2, '.', ',' ),1,2,'C',1);
				
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(65,$x);
				$this->Cell(45,4,number_format ($_SESSION['TOTAL500'], 2, '.', ',' ),1,2,'C',1);
		
				$this->SetFont('Arial','B',7.2);
				$this->SetFillColor(225,225,225);
				$this->SetXY(110,$x);
				$this->Cell(45,4,number_format (($_SESSION['TOTAL5000']-$_SESSION['TOTAL500']), 2, '.', ',' ),1,2,'C',1);
	
				$x = $x + 4;
				$_SESSION['Cand5']=1;
			}
			//AQUI VAN LAS IMPRESIONES DE LO PRESUPUESTADO
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(10,$x);
			$this->Cell(20,4,$row_gastos['clavepartida'],1,2,'C',1);
			
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(30,$x);
			$this->Cell(35,4,number_format ($superuno, 2, '.', ',' ),1,2,'C',1);
			//SE IMPRIME LO GASTADO		
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(65,$x);
			$this->Cell(45,4,number_format ($uno1, 2, '.', ',' ),1,2,'C',1);

			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(110,$x);
			$this->Cell(45,4,number_format (($superuno-$uno1), 2, '.', ',' ),1,2,'C',1);
						
			$_SESSION['superuno'] = $_SESSION['superuno'] + $superuno;	
			$_SESSION['uno1'] = $_SESSION['uno1'] + $uno1;	
			if(($superuno != 0 or $uno1!=0) )
			{
				$x = $x + 4;
			}
				

			$superuno=0;
			$uno1=0;
			
		}
		$x = $x + 4;
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(225,225,225);
		$this->SetXY(10,$x);
		$this->Cell(20,4,"TOTAL 7000",1,2,'C',1);
			
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(30,$x);
		$this->Cell(35,4,number_format ($_SESSION['TOTAL7000'], 2, '.', ',' ),1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(65,$x);
		$this->Cell(45,4,number_format ($_SESSION['TOTAL700'], 2, '.', ',' ),1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(110,$x);
		$this->Cell(45,4,number_format (($_SESSION['TOTAL7000']-$_SESSION['TOTAL700']), 2, '.', ',' ),1,2,'C',1);
	}
	function Footer()
	{
		$this->line(10,37,110,37);
		$this->line(10,37,10,270);
		$this->line(30,37,30,270);
		$this->line(65,37,65,270);
		$this->line(110,37,110,270);
		$this->line(155,37,155,270);
		
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

		$this->line(10,270,155,270);
		
	}

}
	$pdf = new ReporteHorario();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?>