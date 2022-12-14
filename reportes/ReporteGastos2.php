<?php
include_once ( "../conexion/conexion.php" );
require('../fpdf/fpdf.php');
//session_start();
class ReporteHorario extends FPDF
{
	function Header()
	{	
		
		$this->SetXY(12,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/dgest.jpg",13,5,25,25);
		
		$this->SetXY(100,3);
		$this->Cell(36,20,'',0,2,'C');
	    $this->Image("../imagenes/reportes/tec.jpeg",320,3,25,25);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(128,10);
		$this->Cell(45,4,"FORMATO DEL CONCENTRADO POR PARTIDA PRESUPUESTAL Y PROCESO ESTRATEGICO",0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(155,14);
		$this->Cell(45,4,"REFERENCIA A LA NORMA ISO 9001-2000:6.1",0,2,'L');
		
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{}
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(160,22);
		$this->Cell(45,4,"PROGRAMA OPERATIVO ANUAL ".$row_apoa['anio'],0,2,'L');
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(147,26);
		$this->Cell(55,4,"CONCENTRADO POR PROCESO CLAVE Y ESTRATEGICO",0,2,'L');
		
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(80,32);
		$this->Cell(55,4,"INSTITUTO TECNOL?GICO DE : ".$row_revision['tec'],0,2,'L');
		
		
		$x=38;
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(90,4,"PARTIDA",1,2,'R',1);
		
		$this->SetXY(101,$x);
		$this->Cell(195,4,"PROCESOS ESTRATEGICOS",1,2,'R',1);
		
		$this->SetFont('Arial','',6);
		$this->SetXY(296,$x);
		$this->Cell(39,6,"PRESUPUESTO A CUBRIR",LTR,2,'C',1);
		$this->SetXY(296,$x+6);
		$this->Cell(39,6,"A TRAV?S DE",LBR,2,'C',1);
		
		$this->SetFont('Arial','B',7.5);
		$this->SetXY(335,$x);
		$this->Cell(15,24,"TOTAL",1,2,'R',1);
		
		$x=42;
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(15,20,"CLAVE",1,2,'R',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(26,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(75,20,"NOMBRE",1,2,'R',1);

		$this->SetFont('Arial','B',7.2);
		$this->SetXY(101,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(39,8,"1. ACADEMICO",1,2,'R',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(140,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(39,8,"4. VINCULACION",1,2,'R',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(179,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(39,8,"3. PLANEACION",1,2,'R',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(218,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(39,8,"4. CALIDAD",1,2,'R',1);
		
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(257,$x);
		$this->Cell(39,4,"5. ADMINISTRACI?N",LTR,2,'C',1);
		$this->SetXY(257,$x+4);
		$this->Cell(39,4,"DE RECURSOS",LBR,2,'C',1);
		
		$x=50;
		//ACADEMICO
		//AQUI VA EL CONTEO DE METAS Y ACCIONES DE CADA PROCESO CLAVE
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{}
		$sql_proceso = "SELECT * FROM proceso ORDER BY id";
		$res_proceso = mysql_db_query ( $bdd, $sql_proceso );
		while ( $row_proceso = mysql_fetch_assoc ( $res_proceso ) )
		{
			$sql_apoa_dpto_gastos = "SELECT * FROM poa_dpto_gastos  WHERE idpoa = '{$row_apoa['id']}' AND  idproceso = '{$row_proceso['id']}' GROUP BY idactividad";
			$res_apoa_dpto_gastos = mysql_db_query ( $bdd, $sql_apoa_dpto_gastos );
			while ( $row_apoa_dpto_gastos = mysql_fetch_assoc ( $res_apoa_dpto_gastos ) )
			{
				if($row_proceso['id'] == 1)
				{
					$meta1++;
				}
				if($row_proceso['id'] == 2)
				{
					$meta2++;
				}
				if($row_proceso['id'] == 3)
				{
					$meta3++;
				}
				if($row_proceso['id'] == 4)
				{
					$meta4++;
				}
				if($row_proceso['id'] == 5)
				{
					$meta5++;
				}
			}
			$sql_apoa_dpto_gastos = "SELECT * FROM poa_dpto_gastos  WHERE idpoa = '{$row_apoa['id']}' AND idproceso = '{$row_proceso['id']}' GROUP BY idaccion";
			$res_apoa_dpto_gastos = mysql_db_query ( $bdd, $sql_apoa_dpto_gastos );
			while ( $row_apoa_dpto_gastos = mysql_fetch_assoc ( $res_apoa_dpto_gastos ) )
			{
				if($row_proceso['id'] == 1)
				{
					$accion1++;
				}
				if($row_proceso['id'] == 2)
				{
					$accion2++;
				}
				if($row_proceso['id'] == 3)
				{
					$accion3++;
				}
				if($row_proceso['id'] == 4)
				{
					$accion4++;
				}
				if($row_proceso['id'] == 5)
				{
					$accion5++;
				}
			}
		}
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"METAS",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(120.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$meta1,1,2,'R',1);
		
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"METAS",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(159.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$meta2,1,2,'R',1);
		
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"METAS",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(198.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$meta3,1,2,'R',1);
		
		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"METAS",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(237.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$meta4,1,2,'R',1);
		
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"METAS",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(276.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$meta5,1,2,'R',1);
		
		//EXTRA
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"METAS",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(315.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,($meta1+$meta2+$meta3+$meta4+$meta5),1,2,'R',1);
		
		$x=54;
		//ACADEMICO
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"ACCIONES",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(120.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$accion1,1,2,'R',1);
		
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"ACCIONES",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(159.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$accion2,1,2,'R',1);
		
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"ACCIONES",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(198.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$accion3,1,2,'R',1);
		
		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"ACCIONES",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(237.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$accion4,1,2,'R',1);
		
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"ACCIONES",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(276.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,$accion5,1,2,'R',1);
		
		//EXTRA
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,"ACCIONES",1,2,'R',1);
		
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(315.5,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(19.5,4,($accion1+$accion2+$accion3+$accion4+$accion5),1,2,'R',1);
		
		$x=58;
		//ACADEMICO
		$this->SetFont('Arial','B',4);
		$this->SetXY(101,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"PRESIPUESTO",1,2,'R',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(114,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"EJERCIDO",1,2,'R',1);

		$this->SetFont('Arial','B',4);
		$this->SetXY(127,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"POR EJERCER",1,2,'R',1);
		
		//VINCULACION
		$this->SetFont('Arial','B',4);
		$this->SetXY(140,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"PRESIPUESTO",1,2,'R',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(153,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"EJERCIDO",1,2,'R',1);

		$this->SetFont('Arial','B',4);
		$this->SetXY(166,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"POR EJERCER",1,2,'R',1);
		
		//PLANEACION
		$this->SetFont('Arial','B',4);
		$this->SetXY(179,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"PRESIPUESTO",1,2,'R',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(192,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"EJERCIDO",1,2,'R',1);

		$this->SetFont('Arial','B',4);
		$this->SetXY(205,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"POR EJERCER",1,2,'R',1);
		
		//CALIDAD
		$this->SetFont('Arial','B',4);
		$this->SetXY(218,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"PRESIPUESTO",1,2,'R',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(231,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"EJERCIDO",1,2,'R',1);

		$this->SetFont('Arial','B',4);
		$this->SetXY(244,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"POR EJERCER",1,2,'R',1);
		
		//ADMINISTRACION
		$this->SetFont('Arial','B',4);
		$this->SetXY(257,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"PRESIPUESTO",1,2,'R',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(270,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"EJERCIDO",1,2,'R',1);

		$this->SetFont('Arial','B',4);
		$this->SetXY(283,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"POR EJERCER",1,2,'R',1);
		
		//EXTRA
		$this->SetFont('Arial','B',4);
		$this->SetXY(296,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"PRESIPUESTO",1,2,'R',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(309,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"EJERCIDO",1,2,'R',1);

		$this->SetFont('Arial','B',4);
		$this->SetXY(322,$x);
		$this->SetFillColor(225,225,225);
		$this->Cell(13,4,"POR EJERCER",1,2,'R',1);
	}
	
	function parteII()
	{
		$x=62;
		
		//*****INICIO DEL CAPITUL 1000
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{
			$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
			$res_partida = mysql_db_query ( $bdd, $sql_partida );
			while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
			{
				if($row_partida['clavepartida'] >= 1000 and $row_partida['clavepartida'] <= 1999)
				{
					$academico="";
					$academico1="";
					$vinculacion="";
					$vinculacion1="";
					$planeacion="";
					$planeacion1="";
					$calidad="";
					$calidad1="";
					$administracion="";
					$administracion1="";
					//{$_SESSION['dpto_id']}
					$sql_deptoapoa = "SELECT * FROM poa_dpto_gastos  WHERE partida_id='{$row_partida['id']}' AND idpoa='{$row_apoa['id']}' ";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$academico=$academico+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=($row_insumo['costuni'])*($row_deptoapoa['cantidad']);
								$vinculacion=$vinculacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$planeacion=$planeacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$calidad=$calidad+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$administracion=$administracion+$uno;
							}
						}
								

					}
					
					//GASTOS 1000
					$sql_deptoapoa = "SELECT * FROM gastos_dpto  WHERE idpartida='{$row_partida['id']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$academico1=$academico1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$vinculacion1=$vinculacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$planeacion1=$planeacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$calidad1=$calidad1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$administracion1=$administracion1+$row_deptoapoa['monto'];;
						}
								

					}
					//FIN GASTOS 1000
					
					$Totalaca[0]=$Totalaca[0]+$academico;
					$Totalaca[1]=$Totalaca[1]+$academico1;
					$Totalaca[2]=$Totalaca[2]+$vinculacion;
					$Totalaca[3]=$Totalaca[3]+$vinculacion1;
					$Totalaca[4]=$Totalaca[4]+$planeacion;
					$Totalaca[5]=$Totalaca[5]+$planeacion1;
					$Totalaca[6]=$Totalaca[6]+$calidad;
					$Totalaca[7]=$Totalaca[7]+$calidad1;
					$Totalaca[8]=$Totalaca[8]+$administracion;
					$Totalaca[9]=$Totalaca[9]+$administracion1;
					$IngresoPropio=$academico+$vinculacion+$calidad+$planeacion+$administracion;
					$GastoDirecto=$academico1+$vinculacion1+$calidad1+$planeacion1+$administracion1;
					if($_SESSION['Candado']==1)
					{	
						$this->SetFont('Arial','B',7.2);
						$this->SetXY(11,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4, $row_partida['clavepartida'] ,1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(26,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(75,4, $row_partida['descpartida'] ,1,2,'L',1);
							
						//ACADEMICO
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(101,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(114,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(127,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($academico-$academico1), 2, '.', ',' ),1,2,'R',1);
						
						//VINCULACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(140,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(153,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(166,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($vinculacion-$vinculacion1), 2, '.', ',' ),1,2,'R',1);
						
						//PLANEACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(179,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion, 2, '.', ',' ),1,2,'R',1);
	
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(192,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(205,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($planeacion-$planeacion1), 2, '.', ',' ),1,2,'R',1);
						
						//CALIDAD
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(218,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(231,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(244,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($calidad-$calidad1), 2, '.', ',' ),1,2,'R',1);
						
						//ADMINISTRACION DE RECURSOS
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(257,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion, 2, '.', ',' ),1,2,'R',1);
							
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(270,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(283,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($administracion-$administracion1), 2, '.', ',' ),1,2,'R',1);
						
						//TOTALES FILA
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(296,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $IngresoPropio, 2, '.', ',' ),1,2,'R',1);
										
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(309,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $GastoDirecto, 2, '.', ',' ),1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(322,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						//TOTAL				
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(335,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						$x+=4;
						$_SESSION['Candado']=0;
					}	
				}				
			}
		}	

		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(90,4,"TOTAL CAPITULO 1000",1,2,'R',1);			

		//ACADEMICO
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[0], 2, '.', ',' ),1,2,'R',1);
					
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(114,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[1], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(127,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[0]-$Totalaca[1]), 2, '.', ',' ),1,2,'R',1);
					
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[2], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(153,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[3], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(166,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[2]-$Totalaca[3]), 2, '.', ',' ),1,2,'R',1);
						
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[4], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[5], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(205,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[4]-$Totalaca[5]), 2, '.', ',' ),1,2,'R',1);

		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[6], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(231,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[7], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(244,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[6]-$Totalaca[7]), 2, '.', ',' ),1,2,'R',1);
					
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[8], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(270,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[9], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(283,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[8]-$Totalaca[9]), 2, '.', ',' ),1,2,'R',1);

		$Totalaca[10]=	$Totalaca[0] + $Totalaca[2] + $Totalaca[4] + $Totalaca[6] + $Totalaca[8];
		$Totalaca[11]= $Totalaca[1] + $Totalaca[3] + $Totalaca[5] + $Totalaca[7] + $Totalaca[9];
		//EXTRA
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[10], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(309,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[11], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(322,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(335,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(15,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	
		
		$TotalCapitulo[0]=$TotalCapitulo[0]+$Totalaca[0];
		$TotalCapitulo[1]=$TotalCapitulo[1]+$Totalaca[1];
		$TotalCapitulo[2]=$TotalCapitulo[2]+$Totalaca[2];
		$TotalCapitulo[3]=$TotalCapitulo[3]+$Totalaca[3];
		$TotalCapitulo[4]=$TotalCapitulo[4]+$Totalaca[4];
		$TotalCapitulo[5]=$TotalCapitulo[5]+$Totalaca[5];
		$TotalCapitulo[6]=$TotalCapitulo[6]+$Totalaca[6];
		$TotalCapitulo[7]=$TotalCapitulo[7]+$Totalaca[7];
		$TotalCapitulo[8]=$TotalCapitulo[8]+$Totalaca[8];
		$TotalCapitulo[9]=$TotalCapitulo[9]+$Totalaca[9];
		$TotalCapitulo[10]=$TotalCapitulo[10]+$Totalaca[10];
		$TotalCapitulo[11]=$TotalCapitulo[11]+$Totalaca[11];
		//******FIN DEL CAPITULO 1000
		for($y=0; $y<12; $y++)
		{
			$Totalaca[$y]="";
		}
		//******INICIO CAPITULO 2000
		
		$x=$x+4;
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{
			$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
			$res_partida = mysql_db_query ( $bdd, $sql_partida );
			while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
			{
				if($row_partida['clavepartida'] >= 2000 and $row_partida['clavepartida'] <= 2999)
				{
					$academico="";
					$academico1="";
					$vinculacion="";
					$vinculacion1="";
					$planeacion="";
					$planeacion1="";
					$calidad="";
					$calidad1="";
					$administracion="";
					$administracion1="";
					//{$_SESSION['dpto_id']}
					$sql_deptoapoa = "SELECT * FROM poa_dpto_gastos  WHERE partida_id='{$row_partida['id']}' AND idpoa='{$row_apoa['id']}' ";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$academico=$academico+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=($row_insumo['costuni'])*($row_deptoapoa['cantidad']);
								$vinculacion=$vinculacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$planeacion=$planeacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$calidad=$calidad+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$administracion=$administracion+$uno;
							}
						}
								

					}
					
					//GASTOS 1000
					$sql_deptoapoa = "SELECT * FROM gastos_dpto  WHERE idpartida='{$row_partida['id']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$academico1=$academico1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$vinculacion1=$vinculacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$planeacion1=$planeacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$calidad1=$calidad1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$administracion1=$administracion1+$row_deptoapoa['monto'];;
						}
								

					}
					//FIN GASTOS 1000
					
					$Totalaca[0]=$Totalaca[0]+$academico;
					$Totalaca[1]=$Totalaca[1]+$academico1;
					$Totalaca[2]=$Totalaca[2]+$vinculacion;
					$Totalaca[3]=$Totalaca[3]+$vinculacion1;
					$Totalaca[4]=$Totalaca[4]+$planeacion;
					$Totalaca[5]=$Totalaca[5]+$planeacion1;
					$Totalaca[6]=$Totalaca[6]+$calidad;
					$Totalaca[7]=$Totalaca[7]+$calidad1;
					$Totalaca[8]=$Totalaca[8]+$administracion;
					$Totalaca[9]=$Totalaca[9]+$administracion1;
					$IngresoPropio=$academico+$vinculacion+$calidad+$planeacion+$administracion;
					$GastoDirecto=$academico1+$vinculacion1+$calidad1+$planeacion1+$administracion1;
					if($_SESSION['Candado']==1)
					{	
						$this->SetFont('Arial','B',7.2);
						$this->SetXY(11,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4, $row_partida['clavepartida'] ,1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(26,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(75,4, $row_partida['descpartida'] ,1,2,'L',1);
							
						//ACADEMICO
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(101,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(114,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(127,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($academico-$academico1), 2, '.', ',' ),1,2,'R',1);
						
						//VINCULACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(140,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(153,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(166,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($vinculacion-$vinculacion1), 2, '.', ',' ),1,2,'R',1);
						
						//PLANEACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(179,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion, 2, '.', ',' ),1,2,'R',1);
	
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(192,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(205,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($planeacion-$planeacion1), 2, '.', ',' ),1,2,'R',1);
						
						//CALIDAD
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(218,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(231,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(244,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($calidad-$calidad1), 2, '.', ',' ),1,2,'R',1);
						
						//ADMINISTRACION DE RECURSOS
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(257,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion, 2, '.', ',' ),1,2,'R',1);
							
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(270,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(283,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($administracion-$administracion1), 2, '.', ',' ),1,2,'R',1);
						
						//TOTALES FILA
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(296,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $IngresoPropio, 2, '.', ',' ),1,2,'R',1);
										
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(309,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $GastoDirecto, 2, '.', ',' ),1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(322,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						//TOTAL				
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(335,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						$x+=4;
						$_SESSION['Candado']=0;
					}	
				}				
			}
		}	

		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(90,4,"TOTAL CAPITULO 2000",1,2,'R',1);			

		//ACADEMICO
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[0], 2, '.', ',' ),1,2,'R',1);
					
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(114,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[1], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(127,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[0]-$Totalaca[1]), 2, '.', ',' ),1,2,'R',1);
					
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[2], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(153,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[3], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(166,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[2]-$Totalaca[3]), 2, '.', ',' ),1,2,'R',1);
						
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[4], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[5], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(205,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[4]-$Totalaca[5]), 2, '.', ',' ),1,2,'R',1);

		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[6], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(231,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[7], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(244,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[6]-$Totalaca[7]), 2, '.', ',' ),1,2,'R',1);
					
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[8], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(270,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[9], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(283,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[8]-$Totalaca[9]), 2, '.', ',' ),1,2,'R',1);

		$Totalaca[10]=	$Totalaca[0] + $Totalaca[2] + $Totalaca[4] + $Totalaca[6] + $Totalaca[8];
		$Totalaca[11]= $Totalaca[1] + $Totalaca[3] + $Totalaca[5] + $Totalaca[7] + $Totalaca[9];
		//EXTRA
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[10], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(309,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[11], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(322,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(335,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(15,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	
		
		$TotalCapitulo[0]=$TotalCapitulo[0]+$Totalaca[0];
		$TotalCapitulo[1]=$TotalCapitulo[1]+$Totalaca[1];
		$TotalCapitulo[2]=$TotalCapitulo[2]+$Totalaca[2];
		$TotalCapitulo[3]=$TotalCapitulo[3]+$Totalaca[3];
		$TotalCapitulo[4]=$TotalCapitulo[4]+$Totalaca[4];
		$TotalCapitulo[5]=$TotalCapitulo[5]+$Totalaca[5];
		$TotalCapitulo[6]=$TotalCapitulo[6]+$Totalaca[6];
		$TotalCapitulo[7]=$TotalCapitulo[7]+$Totalaca[7];
		$TotalCapitulo[8]=$TotalCapitulo[8]+$Totalaca[8];
		$TotalCapitulo[9]=$TotalCapitulo[9]+$Totalaca[9];
		$TotalCapitulo[10]=$TotalCapitulo[10]+$Totalaca[10];
		$TotalCapitulo[11]=$TotalCapitulo[11]+$Totalaca[11];

		//*****FIN DEL CAPITULO 2000
		for($y=0; $y<12; $y++)
		{
			$Totalaca[$y]="";
		}
		//*****INICIO DEL CAPITULO 3000
		$x=$x+4;
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{
			$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
			$res_partida = mysql_db_query ( $bdd, $sql_partida );
			while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
			{
				if($row_partida['clavepartida'] >= 3000 and $row_partida['clavepartida'] <= 3999)
				{
					$academico="";
					$academico1="";
					$vinculacion="";
					$vinculacion1="";
					$planeacion="";
					$planeacion1="";
					$calidad="";
					$calidad1="";
					$administracion="";
					$administracion1="";
					//{$_SESSION['dpto_id']}
					$sql_deptoapoa = "SELECT * FROM poa_dpto_gastos  WHERE partida_id='{$row_partida['id']}' AND idpoa='{$row_apoa['id']}' ";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$academico=$academico+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=($row_insumo['costuni'])*($row_deptoapoa['cantidad']);
								$vinculacion=$vinculacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$planeacion=$planeacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$calidad=$calidad+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$administracion=$administracion+$uno;
							}
						}
								

					}
					
					//GASTOS 3000
					$sql_deptoapoa = "SELECT * FROM gastos_dpto  WHERE idpartida='{$row_partida['id']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$academico1=$academico1+$row_deptoapoa['monto'];
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$vinculacion1=$vinculacion1+$row_deptoapoa['monto'];
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$planeacion1=$planeacion1+$row_deptoapoa['monto'];
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$calidad1=$calidad1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$administracion1=$administracion1+$row_deptoapoa['monto'];
						}
								

					}
					//FIN GASTOS 3000
					
					$Totalaca[0]=$Totalaca[0]+$academico;
					$Totalaca[1]=$Totalaca[1]+$academico1;
					$Totalaca[2]=$Totalaca[2]+$vinculacion;
					$Totalaca[3]=$Totalaca[3]+$vinculacion1;
					$Totalaca[4]=$Totalaca[4]+$planeacion;
					$Totalaca[5]=$Totalaca[5]+$planeacion1;
					$Totalaca[6]=$Totalaca[6]+$calidad;
					$Totalaca[7]=$Totalaca[7]+$calidad1;
					$Totalaca[8]=$Totalaca[8]+$administracion;
					$Totalaca[9]=$Totalaca[9]+$administracion1;
					$IngresoPropio=$academico+$vinculacion+$calidad+$planeacion+$administracion;
					$GastoDirecto=$academico1+$vinculacion1+$calidad1+$planeacion1+$administracion1;
					if($_SESSION['Candado']==1)
					{	
						$this->SetFont('Arial','B',7.2);
						$this->SetXY(11,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4, $row_partida['clavepartida'] ,1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(26,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(75,4, $row_partida['descpartida'] ,1,2,'L',1);
							
						//ACADEMICO
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(101,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(114,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(127,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($academico-$academico1), 2, '.', ',' ),1,2,'R',1);
						
						//VINCULACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(140,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(153,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(166,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($vinculacion-$vinculacion1), 2, '.', ',' ),1,2,'R',1);
						
						//PLANEACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(179,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion, 2, '.', ',' ),1,2,'R',1);
	
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(192,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(205,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($planeacion-$planeacion1), 2, '.', ',' ),1,2,'R',1);
						
						//CALIDAD
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(218,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(231,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(244,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($calidad-$calidad1), 2, '.', ',' ),1,2,'R',1);
						
						//ADMINISTRACION DE RECURSOS
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(257,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion, 2, '.', ',' ),1,2,'R',1);
							
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(270,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(283,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($administracion-$administracion1), 2, '.', ',' ),1,2,'R',1);
						
						//TOTALES FILA
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(296,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $IngresoPropio, 2, '.', ',' ),1,2,'R',1);
										
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(309,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $GastoDirecto, 2, '.', ',' ),1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(322,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						//TOTAL				
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(335,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						$x+=4;
						if($x>190)
						{
							$x=62;
							$this->AddPage();
						}
						$_SESSION['Candado']=0;
					}	
				}				
			}
		}	

		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(90,4,"TOTAL CAPITULO 3000",1,2,'R',1);			

		//ACADEMICO
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[0], 2, '.', ',' ),1,2,'R',1);
					
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(114,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[1], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(127,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[0]-$Totalaca[1]), 2, '.', ',' ),1,2,'R',1);
					
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[2], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(153,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[3], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(166,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[2]-$Totalaca[3]), 2, '.', ',' ),1,2,'R',1);
						
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[4], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[5], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(205,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[4]-$Totalaca[5]), 2, '.', ',' ),1,2,'R',1);

		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[6], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(231,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[7], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(244,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[6]-$Totalaca[7]), 2, '.', ',' ),1,2,'R',1);
					
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[8], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(270,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[9], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(283,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[8]-$Totalaca[9]), 2, '.', ',' ),1,2,'R',1);

		$Totalaca[10]=	$Totalaca[0] + $Totalaca[2] + $Totalaca[4] + $Totalaca[6] + $Totalaca[8];
		$Totalaca[11]= $Totalaca[1] + $Totalaca[3] + $Totalaca[5] + $Totalaca[7] + $Totalaca[9];
		//EXTRA
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[10], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(309,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[11], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(322,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(335,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(15,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	
		
		$TotalCapitulo[0]=$TotalCapitulo[0]+$Totalaca[0];
		$TotalCapitulo[1]=$TotalCapitulo[1]+$Totalaca[1];
		$TotalCapitulo[2]=$TotalCapitulo[2]+$Totalaca[2];
		$TotalCapitulo[3]=$TotalCapitulo[3]+$Totalaca[3];
		$TotalCapitulo[4]=$TotalCapitulo[4]+$Totalaca[4];
		$TotalCapitulo[5]=$TotalCapitulo[5]+$Totalaca[5];
		$TotalCapitulo[6]=$TotalCapitulo[6]+$Totalaca[6];
		$TotalCapitulo[7]=$TotalCapitulo[7]+$Totalaca[7];
		$TotalCapitulo[8]=$TotalCapitulo[8]+$Totalaca[8];
		$TotalCapitulo[9]=$TotalCapitulo[9]+$Totalaca[9];
		$TotalCapitulo[10]=$TotalCapitulo[10]+$Totalaca[10];
		$TotalCapitulo[11]=$TotalCapitulo[11]+$Totalaca[11];


		//*****FIN DEL CAPITULO 3000
		for($y=0; $y<12; $y++)
		{
			$Totalaca[$y]="";
		}
		//*****INICIO DEL CAPITULO 5000
		$x=$x+4;
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{
			$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
			$res_partida = mysql_db_query ( $bdd, $sql_partida );
			while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
			{
				if($row_partida['clavepartida'] >= 5000 and $row_partida['clavepartida'] <= 5999)
				{
					$academico="";
					$academico1="";
					$vinculacion="";
					$vinculacion1="";
					$planeacion="";
					$planeacion1="";
					$calidad="";
					$calidad1="";
					$administracion="";
					$administracion1="";
					//{$_SESSION['dpto_id']}
					$sql_deptoapoa = "SELECT * FROM poa_dpto_gastos  WHERE partida_id='{$row_partida['id']}' AND idpoa='{$row_apoa['id']}' ";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$academico=$academico+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=($row_insumo['costuni'])*($row_deptoapoa['cantidad']);
								$vinculacion=$vinculacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$planeacion=$planeacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$calidad=$calidad+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$administracion=$administracion+$uno;
							}
						}
								

					}
					
					//GASTOS 1000
					$sql_deptoapoa = "SELECT * FROM gastos_dpto  WHERE idpartida='{$row_partida['id']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$academico1=$academico1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$vinculacion1=$vinculacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$planeacion1=$planeacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$calidad1=$calidad1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$administracion1=$administracion1+$row_deptoapoa['monto'];;
						}
								

					}
					//FIN GASTOS 1000
					
					$Totalaca[0]=$Totalaca[0]+$academico;
					$Totalaca[1]=$Totalaca[1]+$academico1;
					$Totalaca[2]=$Totalaca[2]+$vinculacion;
					$Totalaca[3]=$Totalaca[3]+$vinculacion1;
					$Totalaca[4]=$Totalaca[4]+$planeacion;
					$Totalaca[5]=$Totalaca[5]+$planeacion1;
					$Totalaca[6]=$Totalaca[6]+$calidad;
					$Totalaca[7]=$Totalaca[7]+$calidad1;
					$Totalaca[8]=$Totalaca[8]+$administracion;
					$Totalaca[9]=$Totalaca[9]+$administracion1;
					$IngresoPropio=$academico+$vinculacion+$calidad+$planeacion+$administracion;
					$GastoDirecto=$academico1+$vinculacion1+$calidad1+$planeacion1+$administracion1;
					if($_SESSION['Candado']==1)
					{	
						$this->SetFont('Arial','B',7.2);
						$this->SetXY(11,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4, $row_partida['clavepartida'] ,1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(26,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(75,4, $row_partida['descpartida'] ,1,2,'L',1);
							
						//ACADEMICO
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(101,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(114,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(127,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($academico-$academico1), 2, '.', ',' ),1,2,'R',1);
						
						//VINCULACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(140,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(153,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(166,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($vinculacion-$vinculacion1), 2, '.', ',' ),1,2,'R',1);
						
						//PLANEACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(179,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion, 2, '.', ',' ),1,2,'R',1);
	
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(192,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(205,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($planeacion-$planeacion1), 2, '.', ',' ),1,2,'R',1);
						
						//CALIDAD
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(218,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(231,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(244,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($calidad-$calidad1), 2, '.', ',' ),1,2,'R',1);
						
						//ADMINISTRACION DE RECURSOS
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(257,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion, 2, '.', ',' ),1,2,'R',1);
							
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(270,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(283,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($administracion-$administracion1), 2, '.', ',' ),1,2,'R',1);
						
						//TOTALES FILA
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(296,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $IngresoPropio, 2, '.', ',' ),1,2,'R',1);
										
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(309,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $GastoDirecto, 2, '.', ',' ),1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(322,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						//TOTAL				
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(335,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						$x+=4;
						if($x>190)
						{
							$x=62;
							$this->AddPage();
						}
						$_SESSION['Candado']=0;
					}	
				}				
			}
		}	

		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(90,4,"TOTAL CAPITULO 5000",1,2,'R',1);			

		//ACADEMICO
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[0], 2, '.', ',' ),1,2,'R',1);
					
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(114,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[1], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(127,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[0]-$Totalaca[1]), 2, '.', ',' ),1,2,'R',1);
					
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[2], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(153,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[3], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(166,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[2]-$Totalaca[3]), 2, '.', ',' ),1,2,'R',1);
						
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[4], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[5], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(205,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[4]-$Totalaca[5]), 2, '.', ',' ),1,2,'R',1);

		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[6], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(231,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[7], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(244,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[6]-$Totalaca[7]), 2, '.', ',' ),1,2,'R',1);
					
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[8], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(270,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[9], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(283,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[8]-$Totalaca[9]), 2, '.', ',' ),1,2,'R',1);

		$Totalaca[10]=	$Totalaca[0] + $Totalaca[2] + $Totalaca[4] + $Totalaca[6] + $Totalaca[8];
		$Totalaca[11]= $Totalaca[1] + $Totalaca[3] + $Totalaca[5] + $Totalaca[7] + $Totalaca[9];
		//EXTRA
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[10], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(309,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[11], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(322,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(335,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(15,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	
		
		$TotalCapitulo[0]=$TotalCapitulo[0]+$Totalaca[0];
		$TotalCapitulo[1]=$TotalCapitulo[1]+$Totalaca[1];
		$TotalCapitulo[2]=$TotalCapitulo[2]+$Totalaca[2];
		$TotalCapitulo[3]=$TotalCapitulo[3]+$Totalaca[3];
		$TotalCapitulo[4]=$TotalCapitulo[4]+$Totalaca[4];
		$TotalCapitulo[5]=$TotalCapitulo[5]+$Totalaca[5];
		$TotalCapitulo[6]=$TotalCapitulo[6]+$Totalaca[6];
		$TotalCapitulo[7]=$TotalCapitulo[7]+$Totalaca[7];
		$TotalCapitulo[8]=$TotalCapitulo[8]+$Totalaca[8];
		$TotalCapitulo[9]=$TotalCapitulo[9]+$Totalaca[9];
		$TotalCapitulo[10]=$TotalCapitulo[10]+$Totalaca[10];
		$TotalCapitulo[11]=$TotalCapitulo[11]+$Totalaca[11];

		//*****FIN DEL CAPITULO 5000
		for($y=0; $y<12; $y++)
		{
			$Totalaca[$y]="";
		}
		//*****INICIO DEL CAPITULO 7000
		$x=$x+4;
		$bdd = "sicopre";
		$sql_apoa = "SELECT * FROM poa WHERE actual = 1";
		$res_apoa = mysql_db_query ( $bdd, $sql_apoa );
		if ( $row_apoa = mysql_fetch_assoc ( $res_apoa ) )
		{
			$sql_partida = "SELECT * FROM partida ORDER BY clavepartida";
			$res_partida = mysql_db_query ( $bdd, $sql_partida );
			while ( $row_partida = mysql_fetch_assoc ( $res_partida ) )
			{
				if($row_partida['clavepartida'] >= 7000 and $row_partida['clavepartida'] <= 7999)
				{
					$academico="";
					$academico1="";
					$vinculacion="";
					$vinculacion1="";
					$planeacion="";
					$planeacion1="";
					$calidad="";
					$calidad1="";
					$administracion="";
					$administracion1="";
					//{$_SESSION['dpto_id']}
					$sql_deptoapoa = "SELECT * FROM poa_dpto_gastos  WHERE partida_id='{$row_partida['id']}' AND idpoa='{$row_apoa['id']}' ";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$academico=$academico+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=($row_insumo['costuni'])*($row_deptoapoa['cantidad']);
								$vinculacion=$vinculacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$planeacion=$planeacion+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$calidad=$calidad+$uno;
							}
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$sql_insumo = "SELECT * FROM insumo WHERE id={$row_deptoapoa['insumo_id']}";
							$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
							if ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
							{}
							if($row_deptoapoa['tipogasto'] == 1)
							{
								$uno=$row_insumo['costuni']*$row_deptoapoa['cantidad'];
								$administracion=$administracion+$uno;
							}
						}
								

					}
					
					//GASTOS 1000
					$sql_deptoapoa = "SELECT * FROM gastos_dpto  WHERE idpartida='{$row_partida['id']}' AND donde != 'Remanente' AND donde != 'Cancelado'";
					$res_deptoapoa = mysql_db_query ( $bdd, $sql_deptoapoa );
					while ( $row_deptoapoa = mysql_fetch_assoc ( $res_deptoapoa ) )
					{
						$_SESSION['Candado']=1;
						if($row_deptoapoa['idproceso'] == 1)
						{
							$academico1=$academico1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 2)
						{
							$vinculacion1=$vinculacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 3)
						{
							$planeacion1=$planeacion1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 4)
						{
							$calidad1=$calidad1+$row_deptoapoa['monto'];;
						}
						else if($row_deptoapoa['idproceso'] == 5)
						{
							$administracion1=$administracion1+$row_deptoapoa['monto'];;
						}
								

					}
					//FIN GASTOS 1000
					
					$Totalaca[0]=$Totalaca[0]+$academico;
					$Totalaca[1]=$Totalaca[1]+$academico1;
					$Totalaca[2]=$Totalaca[2]+$vinculacion;
					$Totalaca[3]=$Totalaca[3]+$vinculacion1;
					$Totalaca[4]=$Totalaca[4]+$planeacion;
					$Totalaca[5]=$Totalaca[5]+$planeacion1;
					$Totalaca[6]=$Totalaca[6]+$calidad;
					$Totalaca[7]=$Totalaca[7]+$calidad1;
					$Totalaca[8]=$Totalaca[8]+$administracion;
					$Totalaca[9]=$Totalaca[9]+$administracion1;
					$IngresoPropio=$academico+$vinculacion+$calidad+$planeacion+$administracion;
					$GastoDirecto=$academico1+$vinculacion1+$calidad1+$planeacion1+$administracion1;
					if($_SESSION['Candado']==1)
					{	
						$this->SetFont('Arial','B',7.2);
						$this->SetXY(11,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4, $row_partida['clavepartida'] ,1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(26,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(75,4, $row_partida['descpartida'] ,1,2,'L',1);
							
						//ACADEMICO
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(101,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(114,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $academico1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(127,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($academico-$academico1), 2, '.', ',' ),1,2,'R',1);
						
						//VINCULACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(140,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(153,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $vinculacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(166,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($vinculacion-$vinculacion1), 2, '.', ',' ),1,2,'R',1);
						
						//PLANEACION
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(179,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion, 2, '.', ',' ),1,2,'R',1);
	
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(192,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $planeacion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(205,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($planeacion-$planeacion1), 2, '.', ',' ),1,2,'R',1);
						
						//CALIDAD
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(218,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad, 2, '.', ',' ),1,2,'R',1);
									
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(231,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $calidad1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(244,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($calidad-$calidad1), 2, '.', ',' ),1,2,'R',1);
						
						//ADMINISTRACION DE RECURSOS
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(257,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion, 2, '.', ',' ),1,2,'R',1);
							
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(270,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $administracion1, 2, '.', ',' ),1,2,'R',1);

						$this->SetFont('Arial','B',5.5);
						$this->SetXY(283,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($administracion-$administracion1), 2, '.', ',' ),1,2,'R',1);
						
						//TOTALES FILA
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(296,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $IngresoPropio, 2, '.', ',' ),1,2,'R',1);
										
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(309,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( $GastoDirecto, 2, '.', ',' ),1,2,'R',1);
						
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(322,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(13,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						//TOTAL				
						$this->SetFont('Arial','B',5.5);
						$this->SetXY(335,$x);
						$this->SetFillColor(255,255,255);
						$this->Cell(15,4,number_format ( ($IngresoPropio-$GastoDirecto), 2, '.', ',' ),1,2,'R',1);
						
						$x+=4;
						if($x>190)
						{
							$x=62;
							$this->AddPage();
						}
						$_SESSION['Candado']=0;
					}	
				}				
			}
		}	
		if($x>190)
		{
			$x=62;
			$this->AddPage();
		}
		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(90,4,"TOTAL CAPITULO 7000",1,2,'R',1);			

		//ACADEMICO
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[0], 2, '.', ',' ),1,2,'R',1);
					
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(114,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[1], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(127,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[0]-$Totalaca[1]), 2, '.', ',' ),1,2,'R',1);
					
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[2], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(153,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[3], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(166,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[2]-$Totalaca[3]), 2, '.', ',' ),1,2,'R',1);
						
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $Totalaca[4], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[5], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(205,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[4]-$Totalaca[5]), 2, '.', ',' ),1,2,'R',1);

		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[6], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(231,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[7], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(244,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[6]-$Totalaca[7]), 2, '.', ',' ),1,2,'R',1);
					
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[8], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(270,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( $Totalaca[9], 2, '.', ',' ),1,2,'R',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(283,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(13,4,number_format ( ($Totalaca[8]-$Totalaca[9]), 2, '.', ',' ),1,2,'R',1);

		$Totalaca[10]=	$Totalaca[0] + $Totalaca[2] + $Totalaca[4] + $Totalaca[6] + $Totalaca[8];
		$Totalaca[11]= $Totalaca[1] + $Totalaca[3] + $Totalaca[5] + $Totalaca[7] + $Totalaca[9];
		//EXTRA
				if($x>190)
		{
			$x=62;
			$this->AddPage();
		}

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $Totalaca[10], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(309,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $Totalaca[11], 2, '.', ',' ),1,2,'R',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(322,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(335,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(15,4,number_format ( ($Totalaca[10]-$Totalaca[11]), 2, '.', ',' ),1,2,'R',1);	
		
		$TotalCapitulo[0]=$TotalCapitulo[0]+$Totalaca[0];
		$TotalCapitulo[1]=$TotalCapitulo[1]+$Totalaca[1];
		$TotalCapitulo[2]=$TotalCapitulo[2]+$Totalaca[2];
		$TotalCapitulo[3]=$TotalCapitulo[3]+$Totalaca[3];
		$TotalCapitulo[4]=$TotalCapitulo[4]+$Totalaca[4];
		$TotalCapitulo[5]=$TotalCapitulo[5]+$Totalaca[5];
		$TotalCapitulo[6]=$TotalCapitulo[6]+$Totalaca[6];
		$TotalCapitulo[7]=$TotalCapitulo[7]+$Totalaca[7];
		$TotalCapitulo[8]=$TotalCapitulo[8]+$Totalaca[8];
		$TotalCapitulo[9]=$TotalCapitulo[9]+$Totalaca[9];
		$TotalCapitulo[10]=$TotalCapitulo[10]+$Totalaca[10];
		$TotalCapitulo[11]=$TotalCapitulo[11]+$Totalaca[11];

		//*****FIN DEL CAPITULO 7000
		//TOTAL POR CAPITULO
		$x=$x+4;
				if($x>190)
		{
			$x=62;
			$this->AddPage();
		}

		$this->SetFont('Arial','B',7.2);
		$this->SetXY(11,$x);
		$this->SetFillColor(112,165,252);
		$this->Cell(90,4,"TOTAL DE CAPITULOS",1,2,'R',1);
		//ACADEMICO
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(101,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[0], 2, '.', ',' ),1,2,'C',1);
					
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(114,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[1], 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(127,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[1], 2, '.', ',' ),1,2,'C',1);
					
		//VINCULACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(140,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[2], 2, '.', ',' ),1,2,'C',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(153,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[3], 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(166,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[3], 2, '.', ',' ),1,2,'C',1);
						
		//PLANEACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(179,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[4], 2, '.', ',' ),1,2,'C',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(192,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[5], 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(205,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[5], 2, '.', ',' ),1,2,'C',1);
						
		//CALIDAD
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(218,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[6], 2, '.', ',' ),1,2,'C',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(231,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[7], 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(244,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[7], 2, '.', ',' ),1,2,'C',1);
					
		//ADMINISTRACION
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(257,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[8], 2, '.', ',' ),1,2,'C',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(270,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[9], 2, '.', ',' ),1,2,'C',1);

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(283,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[9], 2, '.', ',' ),1,2,'C',1);
		
		//EXTRA
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(296,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[10], 2, '.', ',' ),1,2,'C',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(309,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( $TotalCapitulo[11], 2, '.', ',' ),1,2,'C',1);
						
		$this->SetFont('Arial','B',5.5);
		$this->SetXY(322,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(13,4,number_format ( ($TotalCapitulo[10]-$TotalCapitulo[11]), 2, '.', ',' ),1,2,'C',1);	

		$this->SetFont('Arial','B',5.5);
		$this->SetXY(335,$x);
		$this->SetFillColor(255,255,255);
		$this->Cell(15,4,number_format ( ($TotalCapitulo[10]-$TotalCapitulo[11]), 2, '.', ',' ),1,2,'C',1);	
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
		$this->Cell(10,4,$row_revision['snest'],0,2,'C',1);
		
		$this->SetFont('Arial','B',4);
		$this->SetXY(340,$x+200);
		$this->Cell(10,4,$row_revision['revision'],0,2,'C',1);
	
	}

}
	$pdf = new ReporteHorario($orientation='L',$unit='mm',$format='Legal');
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$pdf->parteII();
	$pdf->Output();
?> 