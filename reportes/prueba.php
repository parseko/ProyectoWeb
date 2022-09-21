<?php
include_once("../conexion/conexion.php");
		$bdd = "sicopre";
		$sql_revision = "SELECT * FROM revision_reportes ";
		$res_revision = mysql_db_query ( $bdd, $sql_revision );
		if ( $row_revision = mysql_fetch_assoc ( $res_revision ) )
		{}
		$bdd = "sicopre";
		
		$sql_gastos = "SELECT * FROM partida GROUP BY clavepartida ORDER BY clavepartida";
		$res_gastos = mysql_db_query ( $bdd, $sql_gastos );
		while ( $row_gastos = mysql_fetch_assoc ( $res_gastos ) )
		{
			$sql_gastos1 = "SELECT  * FROM poa_dpto WHERE partida_id = '{$row_gastos['id']}' AND dpto_id='23' AND tipogasto=1 ";
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
		}
		echo $_SESSION['TOTAL1000'];
		echo $_SESSION['TOTAL2000'];
		echo $_SESSION['TOTAL3000'];
		echo $_SESSION['TOTAL5000'];
		echo $_SESSION['TOTAL7000'];
?>