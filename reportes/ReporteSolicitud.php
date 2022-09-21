<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();

$_SESSION['Servicio']=$_GET['Servicio'];
class ReporteHorario extends FPDF
{
	function Header()
	{	
		$bdd="sicopre";
		$sql_sol = "SELECT * FROM solicitud_servicio WHERE idsolicitud = '{$_SESSION['Servicio']}' ";
		$res_sol = mysql_db_query ( $bdd, $sql_sol );
		if ( $row_sol = mysql_fetch_assoc ( $res_sol ) )
		{}

		$this->SetXY(5,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/sep2007.jpg",6,5,32,19);
				
		$this->SetFont('Arial','B',12);
		$this->SetXY(60,5);
		$this->Cell(45,4,"SOLICITUD DE ADQUISICIONES O SERVICIOS",0,2,'L');
		
		$this->SetFont('Arial','B',5);
		$this->SetXY(6,23);
		$this->Cell(45,4,"OFICIALIA MAYOR",0,2,'L');
		
		$this->SetFont('Arial','B',5);
		$this->SetXY(6,25);
		$this->Cell(45,4,"DIRECCION GRAL. DE ADMON. PRESUPUESTAL Y RECS.",0,2,'L');

		$this->SetFont('Arial','B',5);
		$this->SetXY(6,27);
		$this->Cell(45,4,"FINANCIEROS",0,2,'L');

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(179,10);
		$this->Cell(25,4,"FORMATO",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(179,14);
		$this->Cell(8,4,"No.",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(187,14);
		$this->Cell(17,4,"CLAVE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(179,18);
		$this->Cell(8,4,"XVI",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(187,18);
		$this->Cell(17,4,"SOLADSERV",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(164,26);
		$this->Cell(40,4,"SOLADSERV",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(164,30);
		$this->Cell(20,4,"NUMERO",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(184,30);
		$this->Cell(20,4,"FECHA",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(164,34);
		$this->Cell(20,4,"",1,2,'C',1);

		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(184,34);
		$this->Cell(6,4,$row_sol['fecha'][8].$row_sol['fecha'][9],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(190,34);
		$this->Cell(6,4,$row_sol['fecha'][5].$row_sol['fecha'][6],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(196,34);
		$this->Cell(8,4,$row_sol['fecha'][0].$row_sol['fecha'][1].$row_sol['fecha'][2].$row_sol['fecha'][3],1,2,'C',1);

	}
	function parteII()
	{
		$bdd="sicopre";
		$sql_sol = "SELECT * FROM solicitud_servicio WHERE idsolicitud = '{$_SESSION['Servicio']}' ";
		$res_sol = mysql_db_query ( $bdd, $sql_sol );
		if ( $row_sol = mysql_fetch_assoc ( $res_sol ) )
		{}
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,42);
		$this->Cell(198,4,"UNIDAD RESPONSABLE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,46);
		$this->Cell(50,4,"CLAVE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(56,46);
		$this->Cell(148,4,"DENOMINACION",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,50);
		$this->Cell(50,8,"27",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(56,50);
		$sql_rev = "SELECT * FROM revision_reportes";
		$res_rev = mysql_db_query ( $bdd, $sql_rev );
		if ( $row_rev = mysql_fetch_assoc ( $res_rev ) )
		{}
		$this->Cell(148,8,"INSTITUTO TECNOLOGICO DE ".$row_rev['tec'],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,62);
		$this->Cell(198,4,"AREA SOLICITANTE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,66);
		$sql_dpto = "SELECT * FROM dpto WHERE id = '{$row_sol['iddpto']}'";
		$res_dpto = mysql_db_query ( $bdd, $sql_dpto );
		if ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
		{}
		$this->Cell(198,8,$row_dpto['nombredpto'],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,78);
		$this->Cell(198,4,"ADQUISICION O SERVICIO REQUERIDO",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,82);
		$this->Cell(40,18,"DESCRIPCION:","LT",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,100);
		$this->Cell(40,6,"VIGENCIA:","LB",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(46,82);
		$this->Multicell(158,4,$row_sol['descripcion'],"RT",2,'C',1);
		$this->line(204,80,204,100);	

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(46,100);
		$this->Cell(158,6,$row_sol['vigencia'],"RB",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,110);
		$this->Cell(198,4,"PROVEEDOR",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,114);
		$this->Cell(40,6,"NOMBRE:","LT",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,120);
		$this->Cell(40,6,"RFC:","L",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,126);
		$this->Cell(40,6,"DOMICILIO:","LB",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(46,114);
		$this->Cell(158,6,$row_sol['nombre'],"RT",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(46,120);
		$this->Cell(158,6,$row_sol['rfc'],"R",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(46,126);
		$this->Cell(158,6,$row_sol['domicilio'],"RB",2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,136);
		$this->Cell(30,4,"PARTIDA:",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,140);
		$sql_par = "SELECT * FROM partida WHERE id = '{$row_sol['idpartida']}'";
		$res_par = mysql_db_query ( $bdd, $sql_par );
		if ( $row_par = mysql_fetch_assoc ( $res_par ) )
		{}
		$this->Cell(30,12,$row_par['clavepartida'],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(40,136);
		$this->Cell(50,4,"FORMA DE PAGO:",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(40,140);
		$this->Cell(50,12,$row_sol['forma_pago'],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(94,136);
		$this->Cell(30,8,"COSTO",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(94,144);
		$this->Cell(30,8,number_format (($row_sol['importe']/1.15), 2, '.', ',' ),1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(124,136);
		$this->Cell(40,4,"I.V.A",1,2,'C',1);
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(124,140);
		$this->Cell(10,4,"%",1,2,'C',1);
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(134,140);
		$this->Cell(30,4,"IMPORTE",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(124,144);
		$this->Cell(10,8,"15%",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(134,144);
		$subtotal=$row_sol['importe']/1.15;
		$total1=$row_sol['importe']-$subtotal;
		$this->Cell(30,8,number_format (($total1), 2, '.', ',' ),1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(164,136);
		$this->Cell(40,4,"IMPORTE","LTR",2,'C',1);
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(164,140);
		$this->Cell(40,4,"TOTAL","LBR",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(164,144);
		$this->Cell(40,8,number_format (($row_sol['importe']), 2, '.', ',' ),1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,156);
		$this->Cell(198,8,"LA ADQUISICION O SERVICIOS SE SEJETARAN A LAS ESTIPULACIONES CONTENIDAS EN EL REVERSO DE ESTA SOLICITUD",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,168);
		$this->Cell(60,8,"PROVEEDOR",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,176);
		$this->Cell(60,36,"",1,2,'C',1);
		
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(255,255,255);
		$this->SetXY(11,204);
		$this->Cell(50,4,$row_sol['nombre'],"B",2,'C',1);
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(255,255,255);
		$this->SetXY(11,208.5);
		$this->Cell(50,3,"NOMBRE Y FIRMA",0,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(68,168);
		$this->Cell(136,4,"",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(68,172);
		$this->Cell(68,4,"SOLICITA","LTR",2,'C',1);
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(68,176);
		$this->Cell(68,4,"JEFE DEL DEPARTAMENTO","LBR",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(68,180);
		$this->Cell(68,32,"",1,2,'C',1);
		
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(255,255,255);
		$this->SetXY(72,204);
		$this->Cell(60,4,$row_dpto['nombretitular'],"B",2,'C',1);
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(255,255,255);
		$this->SetXY(72,208.5);
		$this->Cell(60,3,"NOMBRE Y FIRMA",0,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(136,172);
		$this->Cell(68,4,"AUTORIZA EL TITULAR DE LA ","LTR",2,'C',1);
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(136,176);
		$this->Cell(68,4,"UNIDAD RESPONSABLE","LBR",2,'C',1);


		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(136,180);
		$this->Cell(68,32,"",1,2,'C',1);
		
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(255,255,255);
		$this->SetXY(140,204);
		$sql_fir = "SELECT * FROM firmas_reportes";
		$res_fir = mysql_db_query ( $bdd, $sql_fir );
		if ( $row_fir = mysql_fetch_assoc ( $res_fir ) )
		{}
		$this->Cell(60,4,$row_fir['nombre_director'],"B",2,'C',1);
		$this->SetFont('Arial','B',6);
		$this->SetFillColor(255,255,255);
		$this->SetXY(140,208.5);
		$this->Cell(60,3,"NOMBRE Y FIRMA",0,2,'C',1);

	}
	function Footer()
	{		
		$bdd="sicopre";
		$sql_requi = "SELECT * FROM solicitud_servicio WHERE idsolicitud = '{$_SESSION['Servicio']}' AND planea = 1 ";
		$res_requi = mysql_db_query ( $bdd, $sql_requi );
		if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
		{
			$sql_gas = "SELECT * FROM gastos_dpto WHERE idsolicitud = '{$row_requi['idsolicitud']}'";
			$res_gas = mysql_db_query ( $bdd, $sql_gas );
			if ( $row_gas = mysql_fetch_assoc ( $res_gas ) )
			{
				$hi="hi";
			}
			else
			{$hola="hola";}
			$this->SetFillColor(255,255,255);		
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(60,230);
			$this->Cell(92,12,"",1,2,'C',1);
	
			$sql_pro = "SELECT * FROM proceso WHERE id = '{$row_gas['idproceso']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(61,230.5);
			$this->Cell(17,3.5,"Proc. Clav.: ".$row_pro['claveproceso'],0,2,'L',1);
			
			$sql_pro = "SELECT * FROM actividad WHERE id = '{$row_gas['idclave']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(61,234);
			$this->Cell(15,4,"Proc. Est.: ".$row_pro['claveActiv'],0,2,'L',1);
	
			$sql_pro = "SELECT * FROM accion WHERE id = '{$row_gas['idmeta']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(61,237.5);
			$this->Cell(10,3.5,"Meta: ".$row_pro['claveAccion'],0,2,'L',1);
	
			$sql_pro = "SELECT * FROM dpto WHERE id = '{$row_gas['iddpto']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(121,230.5);
			$this->Cell(17,3.5,"Depto: ".$row_pro['abreviatura'],0,2,'L',1);
			
			$sql_pro = "SELECT * FROM partida WHERE id = '{$row_gas['idpartida']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(121,234);
			$this->Cell(15,4,"Partida: ".$row_pro['clavepartida'],0,2,'L',1);
	
			$sql_pro = "SELECT * FROM gastos_dpto WHERE idsolicitud = '{$_SESSION['Servicio']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(121,237.5);
			$this->Cell(10,3.5,"No. Control: ".$row_pro['oficio'],0,2,'L',1);
			
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(93,234);
			$this->Cell(15,4,"Vo. Bo.",0,2,'C',1);
	
			$_SESSION['fecha'] = date("d-m-Y");
			$this->SetFont('Arial','B',8);
			$this->SetFillColor(255,255,255);
			$this->SetXY(88,243);
			$this->Cell(28,5,"{$_SESSION['fecha']}",0,2,'C',1);

			$this->SetFont('Arial','B',7.5);
			$this->SetXY(93,237.5);
			$this->Cell(15,4,"",'B',2,'C',1);
		}
	}

}
	$pdf = new ReporteHorario();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?> 