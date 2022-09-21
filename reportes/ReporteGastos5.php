<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
//session_start();
//$_SESSION['DPTO']=$_GET['dpto'];
$_SESSION['DPTO']=5;
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
		$this->SetXY(86,5);
		$this->Cell(45,4,"ESTADO DE CUENTA ENERO-JUNIO",0,2,'L');
		
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
						
		
		
		$x=33;
		//segunda linea
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(10,$x);
		$this->Cell(40,4,"DEPARTAMENTO",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(50,$x);
		$this->Cell(30,4,"PRESUPUESTADO",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(80,$x);
		$this->Cell(30,4,"EJERCIDO DEL 31/12",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(110,$x);
		$this->Cell(30,4,"POR EJERCER",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(140,$x);
		$this->Cell(30,4,"ACT. FIJO PRESUP.",1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(170,$x);
		$this->Cell(30,4,"DIFERENCIA",1,2,'C',1);
	}
	function parteII()
	{
		$total2=0;
		$x=37;
		$bdd = "sicopre";		
		$sql_dpto = "SELECT * FROM dpto ORDER BY id";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{
			$this->SetFont('Arial','B',6);
			$this->SetFillColor(225,225,225);
			$this->SetXY(10,$x);
			$this->Cell(40,4,"{$row_dpto['nombredpto']}",1,2,'L',1);
			
			//INICIO PRESUPUESTO ENERO - JUNIO
			$sql_poa_dpto_gastos = "SELECT * FROM poa_dpto_gastos, insumo WHERE poa_dpto_gastos.dpto_id='{$row_dpto['id']}' AND poa_dpto_gastos.tipogasto=1 AND poa_dpto_gastos.periodo=2 AND insumo.id=poa_dpto_gastos.insumo_id";
			$res_poa_dpto_gastos = mysql_db_query ( $bdd, $sql_poa_dpto_gastos );
			while ( $row_poa_dpto_gastos = mysql_fetch_assoc ( $res_poa_dpto_gastos ) )
			{
				$sub=$row_poa_dpto_gastos['costuni']*$row_poa_dpto_gastos['cantidad'];
				$total=$total+$sub;
			}
			
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(50,$x);
			$this->Cell(30,4,number_format ($total, 2, '.', ',' ),1,2,'C',1);
			
			//FIN DE PRESUPUESTO JULIO - DICIEMBRE
			
			//INICIO GASTOS ENERO - JUNIO
			$_SESSION['fecha'] = date("Y-m-d");
			
			$sql_gastos = "SELECT * FROM gastos_dpto WHERE iddpto = '{$row_dpto['id']}' AND donde != 'Cancelado' AND donde != 'Remanente'";
			$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
			while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
			{
				$fecha=$row_gastos['fecha'];
				$fecha1=$fecha[5];
				$fecha2=$fecha[6];
				$fecha3=($fecha1*10)+$fecha2;
				if($fecha3>6 and $fecha3<=12)
				{
					$subtotal=$subtotal+$row_gastos['monto'];
				}
			}
						
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(80,$x);
			$this->Cell(30,4,number_format ($subtotal, 2, '.', ',' ),1,2,'C',1);

			//FIN DE GASTOS JULIO - DICIEMBRE

			//INICIO DE POR EJERCER
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(110,$x);
			$this->Cell(30,4,number_format (($total-$subtotal), 2, '.', ',' ),1,2,'C',1);
			//FIN DE POR EJERCER
			
			$sql_poa_dpto_gastos1 = "SELECT * FROM poa_dpto_gastos, insumo WHERE poa_dpto_gastos.dpto_id='{$row_dpto['id']}' AND poa_dpto_gastos.tipogasto=1 AND poa_dpto_gastos.periodo=1 AND insumo.id=poa_dpto_gastos.insumo_id";
			$res_poa_dpto_gastos1 = mysql_db_query ( $bdd, $sql_poa_dpto_gastos1 );
			while ( $row_poa_dpto_gastos1 = mysql_fetch_assoc ( $res_poa_dpto_gastos1 ) )
			{
				$sql_partida = "SELECT * FROM partida WHERE id='{$row_poa_dpto_gastos1['partida_id']}' AND clavepartida>=5000 AND clavepartida<6000";
				$res_partida = mysql_db_query ( $bdd, $sql_partida );
				while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
				{
					$sub1=$row_poa_dpto_gastos1['costuni']*$row_poa_dpto_gastos1['cantidad'];
					$total5=$total5+$sub1;
				}
			}
			
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(140,$x);
			$this->Cell(30,4,number_format ($total5, 2, '.', ',' ),1,2,'C',1);
			
			$this->SetFont('Arial','B',7.2);
			$this->SetFillColor(255,255,255);
			$this->SetXY(170,$x);
			$this->Cell(30,4,number_format ((($total-$subtotal)-$total5), 2, '.', ',' ),1,2,'C',1);
			
			$Total3=$total-$subtotal;
			$Total4=$Total4+$Total3;
			$Total6=$Total6+$total5;
			$Total7=(($total-$subtotal)-$total5);
			$Total8=$Total8+$Total7;
			$Total1=$Total1+$total;
			$total=0;
			$total2=$total2+$subtotal;
			$subtotal=0;
			$total5=0;
			$x=$x+4;
		}
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(50,$x);
		$this->Cell(30,4,number_format ($Total1, 2, '.', ',' ),1,2,'C',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(80,$x);
		$this->Cell(30,4,number_format ($total2, 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(110,$x);
		$this->Cell(30,4,number_format ($Total4, 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(140,$x);
		$this->Cell(30,4,number_format ($Total6, 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(170,$x);
		$this->Cell(30,4,number_format ($Total8, 2, '.', ',' ),1,2,'C',1);
		$Total4=0;

	}
	function Footer()
	{}

}
	$pdf = new ReporteHorario();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?>