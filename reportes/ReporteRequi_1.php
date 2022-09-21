<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();
$_SESSION['Total']=0;
$_SESSION['Oficio']=$_GET['oficio'];
class ReporteHorario extends FPDF
{
	function Header()
	{	
		$this->SetXY(12,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/tec.jpeg",13,5,25,25);
	    //$this->Image("../imagenes/reportes/dgest.jpg",13,5,25,25);
		
		$this->SetXY(100,3);
//		$this->Cell(36,20,'',0,2,'C');
//	    $this->Image("../imagenes/reportes/tec.jpeg",255,3,25,25);
		$bdd="sicopre";
		$sql_revision = "SELECT * FROM revision_reportes";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}

		$this->SetFont('Arial','B',12);
		$this->SetXY(99,5);
		$this->Cell(45,4,"INSTITUTO TECNOLÓGICO DE ".$row_revision['tec'],0,2,'L');
		
		$this->SetFont('Arial','B',12);
		$this->SetXY(86,15);
		$this->Cell(45,4,"DIRECCIÓN GENERAL DE EDUCACIÓN SUPERIOR TECNOLOGICA",0,2,'L');
		
		$this->SetFont('Arial','B',12);
		$this->SetXY(110,21);
		$this->Cell(45,4,"REQUISICIÓN DE BIENES Y SERVICIOS",0,2,'L');
		
		$bdd="sicopre";
		$sql_requi = "SELECT * FROM requisicion WHERE idrequisicion = '{$_SESSION['Oficio']}'";
		$res_requi = mysql_db_query ( $bdd, $sql_requi );
		if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
		{}
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(10,35);
		$this->Cell(15,4,"FECHA : ".$row_requi['fecha'],0,2,'L');
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(240,35);
		$this->Cell(15,4,"FOLIO : _______________",0,2,'L');
		
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(13,40);
		$this->Cell(270,0,"",1,2,'C',1);
		//$this->line(11,55,285,55);
		
		$sql_dpto = "SELECT * FROM dpto WHERE id = '{$row_requi['iddpto']}'";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{}
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(11,42);
		$this->Cell(274,4,"NOMBRE Y FIRMA DEL JEFE DEL AREA SOLICITANTE: ".$row_dpto['nombretitular'],1,2,'L',1);
		
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(11,46);
		$this->Cell(274,4,"FECHA Y AREA SOLICITANTE: ".$row_requi['fecha']." - ".$row_dpto['nombredpto'],1,2,'L',1);

		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',10);
		$this->SetXY(11,51);
		$this->Cell(274,4,"¿Los Bienes y Servicios estan contemplados en el Anteproyecto del Programa Operativo Anual o en el Programa Operativo Anual?",0,2,'L',1);

		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',10);
		$this->SetXY(250,51);
		$this->Cell(5,4,"SI",0,2,'L',1);
		
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',10);
		$this->SetXY(256,51);
		$this->Cell(5,4,"X",1,2,'L',1);
		
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',10);
		$this->SetXY(265,51);
		$this->Cell(5,4,"NO",0,2,'L',1);
		
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',10);
		$this->SetXY(272,51);
		$this->Cell(5,4,"",1,2,'L',1);

		$x=60;
		//segunda linea
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(11,$x);
		$this->Cell(35,4,"CLAVE",LTR,2,'C',1);
		$this->SetXY(11,$x+4);
		$this->Cell(35,4,"PRESUPUESTAL",LBR,2,'C',1);
				
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(46,$x);
		$this->Cell(20,8,"PARTIDA",1,2,'C',1);
			
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(66,$x);
		$this->Cell(20,8,"CANTIDAD",1,2,'C',1);

		$this->SetFont('Arial','B',7.5);
		$this->SetXY(86,$x);
		$this->Cell(30,8,"UNIDAD",1,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(116,$x);
		$this->Cell(134,8,"DESCRIPCION DE LOS BIENES Y SERVICIOS",1,2,'C',1);

		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(250,$x);
		$this->Cell(35,4,"COSTO ESTIMADO",LTR,2,'C',1);
		$this->SetXY(250,$x+4);
		$this->Cell(35,4,"TOTAL + IVA",LBR,2,'C',1);
	}
	function parteII()
	{
		$x=68;
		$bdd="sicopre";
		$sql_bien = "SELECT * FROM bienservicio WHERE idrequisicion = '{$_SESSION['Oficio']}'";
		$res_bien = mysql_db_query ( $bdd, $sql_bien );
		while ( $row_bien = mysql_fetch_assoc ( $res_bien ) )
		{
			$sql_requi = "SELECT * FROM requisicion WHERE idrequisicion = '{$_SESSION['Oficio']}'";
			$res_requi = mysql_db_query ( $bdd, $sql_requi );
			if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
			{
				$sql_proceso = "SELECT * FROM proceso WHERE id = '{$row_requi['idproceso']}'";
				$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
				if ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
				{}
				$sql_clave = "SELECT * FROM actividad WHERE id = '{$row_requi['idclave']}'";
				$res_clave = mysql_db_query ( $bdd, $sql_clave );
				if ( $row_clave = mysql_fetch_assoc ( $res_clave ) )
				{}
				$sql_meta = "SELECT * FROM accion WHERE id = '{$row_requi['idmeta']}'";
				$res_meta = mysql_db_query ( $bdd, $sql_meta );
				if ( $row_meta = mysql_fetch_assoc ( $res_meta ) )
				{}
				$sql_partida = "SELECT * FROM partida WHERE id = '{$row_requi['idpartida']}'";
				$res_partida = mysql_db_query ( $bdd, $sql_partida );
				if ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
				{}
			}
			
			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(11,$x);
			$this->Cell(35,4,$row_proceso['claveproceso'].".".$row_clave['claveActiv'].".".$row_meta['claveAccion'],0,2,'C',1);
					
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(46,$x);
			$this->Cell(20,4,$row_partida['clavepartida'],0,2,'C',1);
				
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(66,$x);
			$this->Cell(20,4,$row_bien['cantidad'],0,2,'C',1);
	
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(86,$x);
			$this->Cell(30,4,$row_bien['unidad'],0,2,'C',1);
			
			$this->SetFont('Arial','B',7.5);

	$ls=$row_bien['descripcion'];
	$largo = strlen($ls);
	$largoo = strlen($ls);

	if($largo>=100){
		$l1= substr($ls,0,99);
		$largo -=100;
	}else{
		$l1= substr($ls,0);
	}
	if($largo>=100){
		$l2= substr($ls,101,199);
		$largo -=100;
	}else{
		$l2= substr($ls,101);
	}

			$this->SetXY(116,$x);
/*
			$this->Cell(134,4,$l1,0,2,'C',1);
			$this->SetXY(116,$x+5);
			$this->Cell(134,4,$l2,0,2,'C',1);
	*/	
			$this->MultiCell(133,3,$row_bien['descripcion'],0,'J');	

			$this->SetFont('Arial','B',7.5);
			$this->SetFillColor(255,255,255);
			$this->SetXY(250,$x);

			$this->Cell(35,4,"$".number_format (($row_bien['cantidad']*$row_bien['costo']), 2, '.', ',' ),0,2,'C',1);
			$_SESSION['Total']=$_SESSION['Total']+($row_bien['cantidad']*$row_bien['costo']);
						
			if ( strlen ($row_bien['descripcion']) > 80)
			{
				$tamaño=strlen ($row_bien['descripcion']);
				$y = $tamaño/133;
				$y = $y * 4;
				$x = $x + $y;
			}
			
			if($x >= 140)
			{
				$x=68;
				$this->AddPage();
			}
			else
			{
				$this->line(11,$x+3,285,$x+3);
				$x=$x+5;
			}
		}
	}
	function Footer()
	{
		$aux=0;
		$y=68;
		/*while($aux < 20)
		{
			$this->line(11,$y,285,$y);
			$y=$y+4;
			$aux++;
		}*/
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(240,148);
		$this->Cell(10,4,"TOTAL: ",0,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetFillColor(255,255,255);
		$this->SetXY(250,148);
		$this->Cell(35,4,"$".number_format ($_SESSION['Total'], 2, '.', ',' ),1,2,'C',1);

		$this->line(11,68,285,68);
		$this->line(11,148,285,148);
		$this->line(11,68,11,148);
		$this->line(46,68,46,148);
		$this->line(66,68,66,148);		
		$this->line(86,68,86,148);
		$this->line(116,68,116,148);
		$this->line(250,68,250,148);
		$this->line(285,68,285,148);
				
		$bdd="sicopre";
		$sql_requi = "SELECT * FROM requisicion WHERE idrequisicion = '{$_SESSION['Oficio']}'";
		$res_requi = mysql_db_query ( $bdd, $sql_requi );
		if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
		{
			$sql_accion = "SELECT * FROM metas WHERE idaccion = '{$row_requi['idaccion']}'";
			$res_accion = mysql_db_query ( $bdd, $sql_accion );
			if ( $row_accion = mysql_fetch_assoc ( $res_accion ) )
			{
				$sql_preaccion = "SELECT * FROM preacciones WHERE id = '{$row_accion['idpreacciones']}'";
				$res_preaccion = mysql_db_query ( $bdd, $sql_preaccion );
				if ( $row_preaccion = mysql_fetch_assoc ( $res_preaccion ) )
				{}
			}
		}
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',8);
		$this->SetXY(11,154);
		$this->Cell(275,12,"LO ANTERIOR PARA SER UTILIZADO EN LA ACCION: ",'1',2,'L',1);
		
		$this->SetFillColor(255,255,255);
		$this->SetFont('Arial','B',8);
		$this->SetXY(85,154);
		$this->Multicell(200,4,$row_preaccion['accion'],0,'J');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(11,171);
		$this->Cell(80,4,"NOMBRE Y FIRMA DEL SUBDIRECTOR",0,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(107,171);
		$this->Cell(80,4,"NOMBRE Y FIRMA DEL JEFE DEPTO DE",0,2,'C',1);

		$this->SetFont('Arial','B',7.5);
		$this->SetXY(205,171);
		$this->Cell(80,4,"Vo. Bo.",0,2,'C',1);

		$this->SetFont('Arial','B',7.5);
		$this->SetXY(11,175);
		$this->Cell(80,4,"DEL AREA SOLICITANTE",0,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(107,175);
		$this->Cell(80,4,"PLANEACIÓN, PROGRAMACION Y PRESUPUESTACION",0,2,'C',1);

		$this->SetFont('Arial','B',7.5);
		$this->SetXY(205,175);
		$this->Cell(80,4,"NOMBRE Y FIRMA DEL DIRECTOR",0,2,'C',1);

		$x=186;
				
		$sql_requi = "SELECT * FROM requisicion WHERE idrequisicion = '{$_SESSION['Oficio']}'";
		$res_requi = mysql_db_query ( $bdd, $sql_requi );
		if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
		{
			$sql_dpto = "SELECT * FROM dpto WHERE id = '{$row_requi['iddpto']}'";
			$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
			if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
			{
				$sql_dire = "SELECT * FROM firmas_reportes ";
				$res_dire = mysql_db_query ( $bdd, $sql_dire );
				if ( $row_dire = mysql_fetch_assoc ( $res_dire ) )
				{}
				if($row_dpto[tiposub] == 1)
				{
					$this->SetFont('Arial','B',7.5);
					$this->SetXY(11,$x);
					$this->Cell(80,4,$row_dire['nombre_subplanea'],'B',2,'C',1);
				}
				if($row_dpto[tiposub] == 2)
				{
					$this->SetFont('Arial','B',7.5);
					$this->SetXY(11,$x);
					$this->Cell(80,4,$row_dire['nombre_subaca'],'B',2,'C',1);
				}
				if($row_dpto[tiposub] == 3)
				{
					$this->SetFont('Arial','B',7.5);
					$this->SetXY(11,$x);
					$this->Cell(80,4,$row_dire['nombre_subadmon'],'B',2,'C',1);
				}
				if($row_dpto[tiposub] == 4)
				{
					$this->SetFont('Arial','B',7.5);
					$this->SetXY(11,$x);
					$this->Cell(80,4,$row_dire['nombre_director'],'B',2,'C',1);
				}
			}
		}
		$bdd="sicopre";
		$sql_dpto = "SELECT * FROM dpto WHERE nombredpto like '%presupuesta%'";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{}
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(107,$x);
		$this->Cell(80,4,$row_dpto['nombretitular'],'B',2,'C',1);
		
		$sql_requi = "SELECT * FROM requisicion WHERE idrequisicion = '{$_SESSION['Oficio']}' and planea = 1 ";
		$res_requi = mysql_db_query ( $bdd, $sql_requi );
		while ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
		{
			$this->SetFillColor(255,255,255);		
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(102,$x+5);
			$this->Cell(92,12,"",1,2,'C',1);
	
			$sql_pro = "SELECT * FROM proceso WHERE id = '{$row_requi['idproceso']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(103,$x+5.5);
			$this->Cell(17,3.5,"Proc. Clav.: ".$row_pro['claveproceso'],0,2,'L',1);
			
			$sql_pro = "SELECT * FROM actividad WHERE id = '{$row_requi['idclave']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(103,$x+9);
			$this->Cell(15,4,"Proc. Est.: ".$row_pro['claveActiv'],0,2,'L',1);
	
			$sql_pro = "SELECT * FROM accion WHERE id = '{$row_requi['idmeta']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(103,$x+12.5);
			$this->Cell(10,3.5,"Meta: ".$row_pro['claveAccion'],0,2,'L',1);
	
			$sql_pro = "SELECT * FROM dpto WHERE id = '{$row_requi['iddpto']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(163,$x+5.5);
			$this->Cell(17,3.5,"Depto: ".$row_pro['abreviatura'],0,2,'L',1);
			
			$sql_pro = "SELECT * FROM partida WHERE id = '{$row_requi['idpartida']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(163,$x+9);
			$this->Cell(15,4,"Partida: ".$row_pro['clavepartida'],0,2,'L',1);
	
			$sql_pro = "SELECT * FROM gastos_dpto WHERE idrequisicion = '{$_SESSION['Oficio']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(163,$x+12.5);
			$this->Cell(10,3.5,"No. Control: ".$row_pro['oficio'],0,2,'L',1);
			
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(135,$x+9);
			$this->Cell(15,4,"Vo. Bo.",0,2,'C',1);
	
			$_SESSION['fecha'] = date("d-m-Y");
			$this->SetFont('Arial','B',8);
			$this->SetFillColor(255,255,255);
			$this->SetXY(130,$x+17);			
			$this->Cell(28,5,"{$_SESSION['fecha']}",0,2,'C',1);
			
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(135,$x+12);
			$this->Cell(15,4,"",'B',2,'C',1);
			

		}
				
		$bdd="sicopre";
		$sql_dire = "SELECT * FROM firmas_reportes ";
		$res_dire = mysql_db_query ( $bdd, $sql_dire );
		if ( $row_dire = mysql_fetch_assoc ( $res_dire ) )
		{}
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(205,$x);
		$this->Cell(80,4,$row_dire['nombre_director'],'B',2,'C',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(10,$x+12);
		$this->Cell(10,4,"SNEST-AD-FO-03",0,2,'C',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(280,$x+12);
		$this->Cell(10,4,"Rev. O	",0,2,'C',1);
	}
}
	$pdf = new ReporteHorario(L);
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?> 
