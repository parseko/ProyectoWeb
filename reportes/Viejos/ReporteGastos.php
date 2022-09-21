<?php
	require('../fpdf/fpdf.php');
	include_once ( "../conexion/conexion.php" );

class ReporteMaterias extends FPDF
{
	
	//Cabecera de página
	function Header()
	{
		$_SESSION['temporal']=0;
		$this->SetFont('Arial','B',8);
		
		//Título
		$this->SetY(5);
		$this->Cell(0,0,'CONTROL DE GASTOS 2007',0,0,'C');
		$this->Ln(3);
		$this->Cell(0,0,'REPORTE DE GASTOS A LA FECHA:',0,2,'C');
		$this->Ln(3);
		//Fin Titulo
		
		$this->SetXY(17,15);
		$this->SetFont('Arial','B',6);
		$this->Cell(22,2,'',LTR,2,'C');
		$this->Cell(22,2,"DEPARTAMENTO:",LR,2,'C');
		$this->Cell(22,2,'',LBR,3,'C');
		
		$this->SetXY(39,15);
		$this->SetFont('Arial','B',6);
		$this->Cell(240,2,'',LTR,2,'C');
		$this->Cell(240,2,"",LR,2,'C');
		$this->Cell(240,2,'',LBR,3,'C');
		
		$this->SetXY(17,21);
		$this->SetFont('Arial','B',6);
		$this->Cell(22,2,'',LTR,2,'C');
		$this->Cell(22,2,"PROCESO:",LR,2,'C');
		$this->Cell(22,2,'',LBR,3,'C');
		
		$this->SetXY(39,21);
		$this->SetFont('Arial','B',6);
		$this->Cell(240,2,'',LTR,2,'C');
		$this->Cell(240,2,"",LR,2,'C');
		$this->Cell(240,2,'',LBR,3,'C');
		
		$this->SetXY(17,27);
		$this->SetFont('Arial','B',6);
		$this->Cell(22,2,'',LTR,2,'C');
		$this->Cell(22,2,"ACTIVIDAD:",LR,2,'C');
		$this->Cell(22,2,'',LBR,3,'C');
		
		$this->SetXY(39,27);
		$this->SetFont('Arial','B',6);
		$this->Cell(240,2,'',LTR,2,'C');
		$this->Cell(240,2,"",LR,2,'C');
		$this->Cell(240,2,'',LBR,3,'C');
		
		$this->SetXY(17,33);
		$this->SetFont('Arial','B',6);
		$this->Cell(22,2,'',LTR,2,'C');
		$this->Cell(22,2,"ACCION:",LR,2,'C');
		$this->Cell(22,2,'',LBR,3,'C');
		
		$this->SetXY(39,33);
		$this->SetFont('Arial','B',6);
		$this->Cell(240,2,'',LTR,2,'C');
		$this->Cell(240,2,"",LR,2,'C');
		$this->Cell(240,2,'',LBR,3,'C');
	}
	
	function Candidatos()
	{
		$conta=0;
		$query100="SELECT candidatos.idcandidato,candidatos.nombre,candidatos.clave_plaza, candidatos.escolaridad, candidatos.situacion, COUNT(*) AS total FROM `candidatos`, `materiascandidatos` WHERE candidatos.idperiodo='{$_SESSION['PeriodoPDF']}' and candidatos.idcandidato=materiascandidatos.idcandidato GROUP BY candidatos.idcandidato";
		$result100=mysql_db_query("dppi",$query100);
		while($fila100=mysql_fetch_assoc($result100))
		{
			$conta++;
		}
		
		$x=64;
		$i=0;
		$a=0;
		
		$separacion='/';
		$this->SetFont('Arial','',5.5);
		$query="SELECT candidatos.idcandidato,candidatos.nombre,candidatos.clave_plaza, candidatos.escolaridad, candidatos.situacion, COUNT(*) AS total FROM `candidatos`, `materiascandidatos` WHERE candidatos.idperiodo='{$_SESSION['PeriodoPDF']}' and candidatos.idcandidato=materiascandidatos.idcandidato GROUP BY candidatos.idcandidato";
		$result=mysql_db_query("dppi",$query);
		
		while($fila=mysql_fetch_assoc($result))
		{
			if($a<=$conta)
			{
				$i++;
				$this->SetXY(17,$x);
				$this->Cell(8,5,'',LR,2,'C');
				$this->Cell(8,5,$i,LR,2,'C');
				$this->Cell(8,6.2,'',LBR,2,'C');
				
				$this->SetXY(25,$x);
				$this->Cell(54,5,'',LR,2,'C');
				$this->Cell(54,5,"{$fila['nombre']}",LR,2,'L');
				$this->Cell(54,6.2,'',LBR,2,'C');
				
				$this->SetFont('Arial','',5.3);
				$this->SetXY(79,$x);
				$this->Cell(19,5,'',LR,2,'C');
				$this->Cell(19,5,"{$fila['clave_plaza']}",LR,2,'L');
				$this->Cell(19,6.2,'',LBR,2,'C');
				
				$y=$x;
				$query1="SELECT * FROM materiascandidatos WHERE idcandidato='{$fila['idcandidato']}'";
				$result1=mysql_db_query("dppi",$query1);
				while($fila1=mysql_fetch_assoc($result1))
				{
						$this->SetXY(98,$y);
						$this->Cell(39,2.7,"{$fila1['materia']}",0,2,'C');
						
						$this->SetXY(137,$y);
						$this->Cell(19,2.7,"{$fila1['horas']}",0,2,'C');
						
						$y=$y+2.7;
					
				}
				$this->SetXY(98,$x+16.2);
				$this->Cell(39,0,'',1,2,'C');
				$this->SetXY(137,$x);
				$this->Cell(0,16.2,'',L,2,'C');
				
				$this->SetXY(137,$x+16.2);
				$this->Cell(19,0,'',1,2,'C');
				
				$this->SetXY(156,$x);
				$this->Cell(40,5,'',LR,2,'C');
				$this->Cell(40,5,"{$fila['escolaridad']}",LR,2,'C');
				$this->Cell(40,6.2,'',LBR,2,'C');
				
				$this->SetXY(196,$x);
				$this->Cell(10,5,'',LR,2,'C');
				$this->Cell(10,5,"{$fila['situacion']}",LR,2,'C');
				$this->Cell(10,6.2,'',LBR,2,'C');
				
				$y=$x;
				$query1="SELECT * FROM materiascandidatos WHERE idcandidato='{$fila['idcandidato']}'";
				$result1=mysql_db_query("dppi",$query1);
				while($fila1=mysql_fetch_assoc($result1))
				{
						$this->SetXY(206,$y);
						$this->Cell(17,2.7,"{$fila1['carrera']}",0,2,'C');

						$this->SetXY(223,$y);
						$this->Cell(17,2.7,"{$fila1['alumnos']}",0,2,'C');						
						$y=$y+2.7;
					
				}
				$this->SetXY(206,$x+16.2);
				$this->Cell(17,0,'',1,2,'C');
				$this->SetXY(223,$x);
				$this->Cell(0,16.2,'',L,2,'C');
				
				$this->SetXY(223,$x+16.2);
				$this->Cell(17,0,'',1,2,'C');
				$this->SetXY(240,$x);
				$this->Cell(0,16.2,'',L,2,'C');
				
				$this->SetXY(243,$x);
				$this->Cell(11,16.2,'',1,2,'C');
				
				$this->SetXY(254,$x);
				$this->Cell(11,16.2,'',1,2,'C');
				
				$this->SetXY(265,$x);
				$this->Cell(17,16.2,'',1,2,'C');
				
				
			}
			
			$a++;
			$x=$x+16.2;
			
			if($a==7 and $a<$conta)
			{
				$this->AddPage();
				$x=64;
				$a=0;
				
			}
			
		}
		while($a<7)
		{
			$this->SetXY(17,$x);
			$this->Cell(8,16.2,'',LBR,2,'C');
			
				
			$this->SetXY(25,$x);
			$this->Cell(54,16.2,'',LBR,2,'C');
			
			$this->SetXY(79,$x);
			$this->Cell(19,16.2,'',LBR,2,'C');
			
			$this->SetXY(98,$x);
			$this->Cell(39,16.2,'',LBR,2,'C');
						
			$this->SetXY(137,$x);
			$this->Cell(19,16.2,'',LBR,2,'C');
						
			$this->SetXY(156,$x);
			$this->Cell(40,16.2,'',LBR,2,'C');
				
				
			$this->SetXY(196,$x);
			$this->Cell(10,16.2,'',LBR,2,'C');
				
				
				
			$this->SetXY(206,$x);
			$this->Cell(17,16.2,'',LBR,2,'C');

			$this->SetXY(223,$x);
			$this->Cell(17,16.2,'',LBR,2,'C');						
					
					
			$this->SetXY(243,$x);
			$this->Cell(11,16.2,'',1,2,'C');
				
			$this->SetXY(254,$x);
			$this->Cell(11,16.2,'',1,2,'C');
				
			$this->SetXY(265,$x);
			$this->Cell(17,16.2,'',1,2,'C');
			
			$a++;
			$x=$x+16.2;
		}
	}
		
		
	

}
	$pdf = new ReporteMaterias(L);
	//Creación del objeto de la clase heredada
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->Candidatos();
	$pdf->Output();
?> 