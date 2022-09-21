<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
session_start();

$_SESSION['Viaticos']=$_GET['Viaticos'];
class ReporteHorario extends FPDF
{
	function Header()
	{	
		$bdd="sicopre";
		$sql_sol = "SELECT * FROM viaticos WHERE idviaticos = '{$_SESSION['Viaticos']}' ";
		$res_sol = mysql_db_query ( $bdd, $sql_sol );
		if ( $row_sol = mysql_fetch_assoc ( $res_sol ) )
		{}

		$this->SetXY(5,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/sep2007.jpg",6,5,32,19);
				
		$this->SetFont('Arial','B',12);
		$this->SetXY(75,12);
		$this->Cell(55,4,"OFICIO DE COMISION/ORDEN DE",0,2,'C');
		$this->SetFont('Arial','B',12);
		$this->SetXY(75,16);
		$this->Cell(55,4,"MINISTRACION DE VIATICOS",0,2,'C');

		
		$this->SetFont('Arial','B',5);
		$this->SetXY(6,23);
		$this->Cell(45,4,"OFICIALIA MAYOR",0,2,'L');
		
		$this->SetFont('Arial','B',5);
		$this->SetXY(6,25);
		$this->Cell(45,4,"DIRECCION GRAL. DE ADMON. PRESUPUESTAL Y RECS.",0,2,'L');

		$this->SetFont('Arial','B',5);
		$this->SetXY(6,27);
		$this->Cell(45,4,"FINANCIEROS",0,2,'L');
		
		$x=8;
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(179,$x+10);
		$this->Cell(25,4,"FORMATO",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(179,$x+14);
		$this->Cell(8,4,"No.",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(187,$x+14);
		$this->Cell(17,4,"CLAVE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(179,$x+18);
		$this->Cell(8,4,"XVI",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(187,$x+18);
		$this->Cell(17,4,"SOLADSERV",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(164,$x+26);
		$this->Cell(40,4,"SOLADSERV",1,2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(164,$x+30);
		$this->Cell(20,4,"NUMERO",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(184,$x+30);
		$this->Cell(20,4,"FECHA",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(164,$x+34);
		$this->Cell(20,8,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(184,$x+34);
		$this->Cell(6,8,$row_sol['fecha'][8].$row_sol['fecha'][9],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(190,$x+34);
		$this->Cell(6,8,$row_sol['fecha'][5].$row_sol['fecha'][6],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(196,$x+34);
		$this->Cell(8,8,$row_sol['fecha'][0].$row_sol['fecha'][1].$row_sol['fecha'][2].$row_sol['fecha'][3],1,2,'C',1);

	}
	function parteII()
	{
		$x=-8;
		$bdd="sicopre";
		$sql_viaticos = "SELECT * FROM viaticos, dpto WHERE viaticos.idviaticos = '{$_SESSION['Viaticos']}' and viaticos.iddpto=dpto.id";
		$res_viaticos = mysql_db_query ( $bdd, $sql_viaticos );
		if ( $row_viaticos = mysql_fetch_assoc ( $res_viaticos ) )
		{}
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+42);
		$this->Cell(150,4,"UNIDAD RESPONSABLE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+46);
		$this->Cell(30,4,"CLAVE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(36,$x+46);
		$this->Cell(120,4,"DENOMINACION",1,2,'C',1);
		$sql_rev = "SELECT * FROM revision_reportes";
		$res_rev = mysql_db_query ( $bdd, $sql_rev );
		if ( $row_rev = mysql_fetch_assoc ( $res_rev ) )
		{}

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+50);
		$this->Cell(30,8,$row_rev['clavetec'],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(36,$x+50);
		$this->Cell(120,8,"INSTITUTO TECNOLOGICO DE ".$row_rev['tec'],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+62);
		$this->Cell(198,4,"DATOS DEL COMISIONADO",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+66);
		$this->Cell(148,8,"C. ".$row_viaticos['comisionado'],'LT',2,'L',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(153,$x+66);
		$this->Cell(51,8,"R.F.C.: ".$row_viaticos['rfc'],'TR',2,'L',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+74);	
		$this->Cell(198,8,"AREA DE ADSCRIPCION: ".$row_viaticos['nombredpto'],'LR',2,'L',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+82);
		$this->Cell(198,8,"DOMICILIO: ".$row_viaticos['domicilio'],'LR',2,'L',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+90);
		$this->Cell(148,8,"PUESTO O CATEGORIA: ".$row_viaticos['categoria'],'LB',2,'L',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(153,$x+90);
		$this->Cell(51,8,"CLAVE: ".$row_viaticos['clave'],'BR',2,'L',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+102);
		$this->Cell(95,4,"LUGAR(ES) Y PERIODO(S) DE LA COMISION",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(101,$x+102);
		$this->Cell(40,4,"CUOTA DIARIA",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(141,$x+102);
		$this->Cell(30,4,"DIAS",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(171,$x+102);
		$this->Cell(33,4,"IMPORTE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+106);
		$this->Cell(95,16,$row_viaticos['lugar'],"LTR",2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+122);
		$this->Cell(95,16,$row_viaticos['periodo'],"LBR",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(101,$x+106);
		$this->Cell(40,32,number_format ($row_viaticos['cuota'], 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(141,$x+106);
		$this->Cell(30,32,$row_viaticos['dias'],1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(171,$x+106);
		$this->Cell(33,32,number_format (($row_viaticos['cuota']*$row_viaticos['dias']), 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(141,$x+138);
		$this->Cell(30,4,"TOTAL","T",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(171,$x+138);
		$this->Cell(33,4,number_format (($row_viaticos['cuota']*$row_viaticos['dias']), 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+146);
		$this->Cell(95,4,"MOTIVO DE LA COMISION:",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(109,$x+146);
		$this->Cell(95,4,"OBSERVACIONES:",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+150);
		$this->MultiCell(95,4,$row_viaticos['motivo'],0,'J');

		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(109,$x+150);
		$this->MultiCell(95,4,$row_viaticos['observaciones'],0,'J');
		$this->line(6,$x+150,6,$x+170);
		$this->line(101,$x+150,101,$x+170);
		$this->line(6,$x+170,101,$x+170);
		$this->line(109,$x+150,109,$x+170);
		$this->line(204,$x+150,204,$x+170);
		$this->line(109,$x+170,204,$x+170);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+175);
		$this->Cell(95,5,"CARACTERISTICAS DE LOS VIATICOS",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+180);
		$this->Cell(50,5,"ZONA MARGINADA","LT",2,'C',1);
		
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(57,$x+180);
		$this->Cell(44 ,5,"(     )","TR",2,'L',1);

		if($row_viaticos['pago']==1)
			$pago='X';
		else 
			$pago=' ';
		if($row_viaticos['pago']==2)
			$pago1='X';
		else 
			$pago1='   ';
			
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+185);
		$this->Cell(50 ,5,"ANTICIPOS  ( ".$pago." )","L",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(57,$x+185);
		$this->Cell(44 ,5,"DEVENGADOS  ( ".$pago1." )","R",2,'C',1);

		$this->SetFont('Arial','B',4);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+190);
		$this->Cell(54 ,5,"	K hasta G","L",2,'R',1);

		$this->SetFont('Arial','B',4);
		$this->SetFillColor(255,255,255);
		$this->SetXY(61,$x+190);
		$this->Cell(20 ,5,"P hasta L",0,2,'C',1);

		$this->SetFont('Arial','B',4);
		$this->SetFillColor(255,255,255);
		$this->SetXY(81	,$x+190);
		$this->Cell(20 ,5,"PERSONAL OPERATIVO","R",2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+195);
		$this->Cell(34 ,5,"GRUPOS JERARQUICOS","L",2,'R',1);

		if($row_viaticos['jerarquico']==1)
			$jera='X';
		else 
			$jera=' ';
		if($row_viaticos['jerarquico']==2)
			$jera1='X';
		else 
			$jera1='   ';
		if($row_viaticos['jerarquico']==3)
			$jera2='X';
		else 
			$jera2='   ';

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(40,$x+195);
		$this->Cell(20 ,5,"( ".$jera." )",0,2,'R',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(61,$x+195);
		$this->Cell(20 ,5,"( ".$jera1." )",0,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(81	,$x+195);
		$this->Cell(20 ,5,"( ".$jera2." )","R",2,'C',1);
		
		if($row_viaticos['zona']==1)
			$zona='X';
		else 
			$zona=' ';
		if($row_viaticos['zona']==2)
			$zona1='X';
		else 
			$zona1='   ';

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+200);
		$this->Cell(50 ,5,"ZONA MAS ECONOMICA   ( ".$zona." )","LB",2,'L',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(56,$x+200);
		$this->Cell(45 ,5,"ZONA MENOS ECONOMICA   ( ".$zona1." )","BR",2,'L',1);
		
		//***************************
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(109,$x+175);
		$this->Cell(95,5,"DOCUMENTO CONTABILIZADOR:",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(109,$x+180);
		$this->Cell(15,4,"RA",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(124,$x+180);
		$this->Cell(16,4,"UR",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(140,$x+180);
		$this->Cell(16,4,"GF",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(156,$x+180);
		$this->Cell(16,4,"FN",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(172,$x+180);
		$this->Cell(16,4,"SF",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(188,$x+180);
		$this->Cell(16,4,"PG",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(109,$x+184);
		$this->Cell(15,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(124,$x+184);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(140,$x+184);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(156,$x+184);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(172,$x+184);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(188,$x+184);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(109,$x+188);
		$this->Cell(15,4,"AI",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(124,$x+188);
		$this->Cell(16,4,"AP",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(140,$x+188);
		$this->Cell(16,4,"PTDA",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(156,$x+188);
		$this->Cell(16,4,"TG",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(172,$x+188);
		$this->Cell(16,4,"FF",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(188,$x+188);
		$this->Cell(16,4,"SBP",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(109,$x+192);
		$this->Cell(15,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(124,$x+192);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(140,$x+192);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(156,$x+192);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(172,$x+192);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(188,$x+192);
		$this->Cell(16,4,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(109,$x+196);
		$this->Cell(95,4,"IMPORTE",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(109,$x+200);
		$this->Cell(95,4,number_format (($row_viaticos['cuota']*$row_viaticos['dias']), 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(6,$x+208);
		$this->Cell(95,4,"TITULAR DE LA UNIDAD RESPONSABLE",1,2,'C',1);
		$sql_rev = "SELECT * FROM firmas_reportes";
		$res_rev = mysql_db_query ( $bdd, $sql_rev );
		if ( $row_rev = mysql_fetch_assoc ( $res_rev ) )
		{}
		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(6,$x+212);
		$this->Cell(95,20,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(11,$x+224);
		$this->Cell(85,4,$row_rev['nombre_director'],"B",2,'C',1);

		$this->SetFont('Arial','B',4);
		$this->SetFillColor(255,255,255);
		$this->SetXY(11,$x+228.5);
		$this->Cell(85,3,"NOMBRE Y FIRMA",0,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(225,225,225);
		$this->SetXY(109,$x+208);
		$this->Cell(95,4,"COMISIONADO",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(109,$x+212);
		$this->Cell(95,20,"",1,2,'C',1);

		$this->SetFont('Arial','B',7);
		$this->SetFillColor(255,255,255);
		$this->SetXY(115,$x+224);
		$this->Cell(85,4,$row_viaticos['comisionado'],"B",2,'C',1);

		$this->SetFont('Arial','B',4);
		$this->SetFillColor(255,255,255);
		$this->SetXY(115,$x+228.5);
		$this->Cell(85,3,"NOMBRE Y FIRMA",0,2,'C',1);

	}
	function Footer()
	{		
		$bdd="sicopre";
		$sql_requi = "SELECT * FROM viaticos WHERE idviaticos = '{$_SESSION['Viaticos']}' AND planea = 1 ";
		$res_requi = mysql_db_query ( $bdd, $sql_requi );
		if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
		{
			$sql_gas = "SELECT * FROM gastos_dpto WHERE idviaticos = '{$row_requi['idviaticos']}'";
			$res_gas = mysql_db_query ( $bdd, $sql_gas );
			if ( $row_gas = mysql_fetch_assoc ( $res_gas ) )
			{$hi="hi";}
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
	
			$sql_pro = "SELECT * FROM gastos_dpto WHERE idviaticos = '{$_SESSION['Viaticos']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(121,237.5);
			$this->Cell(10,3.5,"No. Control: ".$row_pro['oficio'],0,2,'L',1);
			
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(93,234);
			$this->Cell(15,4,"Vo. Bo.",0,2,'C',1);
	
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(93,237.5);
			$this->Cell(15,4,"",'B',2,'C',1);

			$_SESSION['fecha'] = date("d-m-Y H:i:s");
			$this->SetFont('Arial','B',8);
			$this->SetFillColor(255,255,255);
			$this->SetXY(90,244);
			$this->Cell(28,5,"{$_SESSION['fecha']}",0,2,'C',1);
		}
	}
	
	/*function Footer()
	{		
		$bdd="sicopre";
		$sql_requi = "SELECT * FROM viaticos WHERE idviaticos = '{$_SESSION['Viaticos']}' AND planea = 1 ";
		$res_requi = mysql_db_query ( $bdd, $sql_requi );
		if ( $row_requi = mysql_fetch_assoc ( $res_requi ) )
		{
			$sql_gas = "SELECT * FROM gastos_dpto WHERE idviaticos = '{$row_requi['idviaticos']}'";
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
	
			$sql_pro = "SELECT * FROM gastos_dpto WHERE idviaticos = '{$_SESSION['Viaticos']}' ";
			$res_pro = mysql_db_query ( $bdd, $sql_pro );
			if ( $row_pro = mysql_fetch_assoc ( $res_pro ) )
			{}
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(121,237.5);
			$this->Cell(10,3.5,"No. Control: ".$row_pro['oficio'],0,2,'L',1);
			
			/*$this->SetFont('Arial','B',7.5);
			$this->SetXY(93,234);
			$this->Cell(15,4,"Vo. Bo.",0,2,'C',1);
	
			$this->SetFont('Arial','B',7.5);
			$this->SetXY(93,237.5);
			$this->Cell(15,4,"",'B',2,'C',1);

			$_SESSION['fecha'] = date("d-m-Y");
			$this->SetFont('Arial','B',8);
			$this->SetFillColor(255,255,255);
			$this->SetXY(90,244);
			$this->Cell(28,5,"{$_SESSION['fecha']}",0,2,'C',1);
		}
	}*/

}
	$pdf = new ReporteHorario();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?> 