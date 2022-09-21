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
	    $this->Image("../imagenes/reportes/dgest.jpg",13,5,25,25);
		
		$this->SetXY(100,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/tec.jpeg",255,3,25,25);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(95,10);
		$this->Cell(45,4,"FORMATO PARA EL CONCENTRADO POR PROCESO CLAVE Y ESTRATEGICO",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(113,16);
		$this->Cell(45,4,"REFERENCIA A LA NORMA ISO 9001-2000: 6.1",0,2,'L');
		
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{}
		if($row_apoa['periodo']==0)
		{
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(118,22);
			$this->Cell(55,4,"PROGRAMA OPERATIVO ANUAL ".$row_apoa['anio'],0,2,'L');
		}
		else
		{
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(102,22);
			$this->Cell(55,4,"ANTEPROYECTO DEL PROGRAMA OPERATIVO ANUAL ".$row_apoa['anio'],0,2,'L');
		}
		
		//INSTITUTO TECNOLÓGICO DE TUXTLA GUTIÉRREZ
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(105,28);
		$this->Cell(55,4,"CONCENTRADO POR PROCESO CLAVE Y ESTRATEGICO",0,2,'L');
		
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(60,34);
		$this->Cell(55,4,"INSTITUTO TECNOLÓGICO DE : ".$row_revision['tec'],0,2,'L');
		
		/*$this->SetXY(210,34);
		$this->SetFont('Arial','B',7);
		$this->Cell(15,4,"HOJA:",1,2,'L:');
		
		$this->SetXY(225,34);
		$this->SetFont('Arial','B',7);
		$this->Cell(10,4,"DE:",1,2,'L:');*/
						
	}

	
	function parteI()
	{
				
		$x=40;
		//segunda linea
		$this->SetFont('Arial','B',7.2);
		$this->SetFillColor(225,225,225);
		$this->SetXY(11,$x);
		$this->Cell(50,6,"PRESUPUESTO A CUBRIR",LTR,2,'C',1);
		$this->SetXY(11,$x+6);
		$this->Cell(50,6,"A TRAVÉS DE",LBR,2,'C',1);
			
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(61,$x);
		$this->Cell(120,12,"PROCESOS ESTRATEGICOS",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(180,$x);
		$this->Cell(35,12,"PRESUPUESTO TOTAL",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(215,$x);
		$this->Cell(69,6,"PRESUPUESTO A CUBRIR A TRAVÉS DE",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(215,$x+6);
		$this->Cell(35,6,"INGRESOS PROPIOS",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(250,$x+6);
		$this->Cell(34,6,"GASTO DIRECTO",1,2,'C',1);
		
	}
	function parteII()
	{
		$x=52;
		$bdd = "sicopre";
		
		$sql_proceso = "SELECT * FROM proceso ORDER BY claveproceso";
		$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
		while ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
		{
			$sql_actividad = "SELECT * FROM actividad WHERE proceso_id='{$row_proceso['id']}'";
			$res_actividad = mysql_db_query ( $bdd, $sql_actividad );
			while ( $row_actividad = mysql_fetch_assoc ( $res_actividad ) )
			{
				$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
				$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
				if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
				{}
				$this->SetFont('Arial','B',7.5);
				$this->SetFillColor(255,255,255);
				$this->SetXY(11,$x);
				$this->Cell(50,4,($row_proceso['proyecto']),1,2,'C',1);

				$this->SetFont('Arial','B',7.5);
				$this->SetXY(61,$x);
				$this->Cell(120,4,$row_actividad['nombreactiv'],1,2,'C',1);
					
				$sql_apoa = "SELECT * FROM poa_dpto WHERE idpoa = '{$row_apoa['id']}' AND idactividad = '{$row_actividad['id']}' AND dpto_id = '{$_SESSION['dpto_id']}'";
				$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
				while ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
				{
					$sql_insumo = "SELECT * FROM insumo WHERE id={$row_apoa['insumo_id']}";
					$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
					if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
					{}
					if($row_apoa['tipogasto'] == 1)
					{
						$uno=$row_insumo['costuni']*$row_apoa['cantidad'];
						$Ingreso=$Ingreso+$uno;
						//$SumaIngreso=$SumaIngreso+$Ingreso;
					}
					else if($row_apoa['tipogasto'] == 2)
					{
						$dos=$row_insumo['costuni']*$row_apoa['cantidad'];
						$Directo=$Directo+$dos;
						//$SumaDirecto=$SumaDirecto+$Directo;
					}
				}
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(180,$x);
				$this->Cell(35,4,number_format (($Ingreso+$Directo), 2, '.', ',' ),1,2,'R',1);
				
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(215,$x);
				$this->Cell(35,4,number_format ($Ingreso, 2, '.', ',' ),1,2,'R',1);
				
				$this->SetFont('Arial','B',7.5);
				$this->SetXY(250,$x);
				$this->Cell(34,4,number_format ($Directo, 2, '.', ',' ),1,2,'R',1);
				$Ingreso=0;
				$Directo=0;
				$x=$x+4;
			}
			$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
			$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
			if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
			{}
			$sql_apoa_pro = "SELECT * FROM poa_dpto WHERE idpoa = '{$row_apoa['id']}' AND idproceso = '{$row_proceso['id']}' AND dpto_id = '{$_SESSION['dpto_id']}'";
			$res_apoa_pro = mysql_db_query ( $bdd, $sql_apoa_pro );
			while ( $row_apoa_pro = mysql_fetch_assoc ( $res_apoa_pro ) )
			{
				$sql_insumo = "SELECT * FROM insumo WHERE id={$row_apoa_pro['insumo_id']}";
				$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
				if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
				{}
				if($row_apoa_pro['tipogasto'] == 1)
				{
					$uno=$row_insumo['costuni']*$row_apoa_pro['cantidad'];
					$Ingreso1=$Ingreso1+$uno;	
					
				}
				else if($row_apoa_pro['tipogasto'] == 2)
				{
					$dos=$row_insumo['costuni']*$row_apoa_pro['cantidad'];
					$Directo1=$Directo1+$dos;
					
				}
				
				
			}
			$TotalIngre=$TotalIngre+$Ingreso1;
			$TotalDire=$TotalDire+$Directo1;
			//AQUI SE SUMAN LOS TOTALES POR PROCESO CLAVE
			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(11,$x);
			$this->Cell(50,4,$row_proceso['claveproceso'],1,2,'C',1);
					
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(61,$x);
			$this->Cell(120,4,"SUMA PROCESO {$row_proceso['nombreproceso']}",1,2,'L',1);
				
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(180,$x);
			$this->Cell(35,4,number_format (($Ingreso1+$Directo1), 2, '.', ',' ),1,2,'R',1);
					
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(215,$x);
			$this->Cell(35,4,number_format ($Ingreso1, 2, '.', ',' ),1,2,'R',1);
					
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(250,$x);
			$this->Cell(34,4,number_format ($Directo1, 2, '.', ',' ),1,2,'R',1);
			
			$Ingreso1=0;
			$Directo1=0;
			$SumaIngreso=0;
			$SumaDirecto=0;
			$x=$x+4;
		}
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(11,$x);
		$this->Cell(50,4,"",1,2,'C',1);
					
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(61,$x);
		$this->Cell(120,4,"TOTAL",1,2,'C',1);
			
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(180,$x);
		$this->Cell(35,4,number_format (($TotalIngre+$TotalDire), 2, '.', ',' ),1,2,'R',1);
					
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(215,$x);
		$this->Cell(35,4,number_format ($TotalIngre, 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(250,$x);
		$this->Cell(34,4,number_format ($TotalDire, 2, '.', ',' ),1,2,'R',1);
		

	}
	function Footer()
	{
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(10,$x+200);
		$this->Cell(10,4,$row_revision['snest3'],0,2,'C',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(280,$x+200);
		$this->Cell(10,4,$row_revision['revision'],0,2,'C',1);

		$sql_dpto = "SELECT * FROM dpto WHERE id='{$_SESSION['dpto_id']}'";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{}
		$this->SetFont('Arial','B',4);
		$this->SetXY(250,$x+204);
		$this->Cell(10,4,$row_dpto['nombredpto'],0,2,'C',1);
	
	}

}
	$pdf = new ReporteHorario(L);
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteI();
	$pdf->parteII();
	$pdf->Output();
?> 