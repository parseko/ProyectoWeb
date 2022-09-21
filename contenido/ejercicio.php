<?php
	if ( $_SESSION['tipo'] == 1 )
	{
		if ( $_POST['boton'] == 1 )
		{
		
			//Se inicia el primer ejercicio
			if ( isset ( $_POST['inicioSistema'] ) )
			{
				$fecha = date("Y");
				$fecha++;
				$sql = "INSERT INTO poa (anio, tipo, actual, iniciado, terminado, periodo ) VALUES ( {$fecha}, 1, 1, 0, 0, 1 )";
				if ( mysql_db_query ( $bdd, $sql ) )
				{
					echo "<div align='center' class='MedianoAzulOscuro'>Se ha iniciado el APOA satisfactoriamente.</div>";
					$_SESSION['tipo_poa'] = 1;
					$_SESSION['anio'] = $fecha;
				}
				else
				{
					echo "<div align='center' class='MedianoAlerta'>Error en la base de datos.</div>";
				}
			}
			else if ( isset ( $_POST['permitir'] ) )
			{
				$sql_validar = "SELECT COUNT(*) AS Dptos FROM dpto";
				$res_validar = mysql_db_query ( $bdd, $sql_validar );
				$row_validar = mysql_fetch_assoc ( $res_validar );
				
				$sql_validar2 = "SELECT COUNT(*) AS Pres FROM presupuesto";
				$res_validar2 = mysql_db_query ( $bdd, $sql_validar2 );
				$row_validar2 = mysql_fetch_assoc ( $res_validar2 );
				
				if ( $row_validar['Dptos'] == $row_validar2['Pres'] )
				{
				
					$sql = "UPDATE poa SET iniciado = 1 WHERE actual = 1";
					if ( $res = mysql_db_query ( $bdd, $sql ) )
					{
						echo "<div align='center' class='MedianoAzulOscuro'>Se ha iniciado la captura del Ejercicio.</div>";
					}
					else
					{
						echo "<div align='center' class='MedianoAlerta'>Error en la base de datos.</div>";
					}
				}
				else
				{
					echo "<div align='center' class='MedianoAlerta'>Todos los departamentos deben tener un presupuesto asignado.</div>";
				}
				
			}
			else if ( isset ( $_POST['terminar'] ) )
			{
					
					$sql_poa1 = "SELECT * FROM poa WHERE actual = 1";
					$res_poa1 = mysql_db_query ( $bdd, $sql_poa1 );
					if ( $row_poa1 = mysql_fetch_assoc ( $res_poa1 ) )
					{
						if($row_poa1['tipo'] == 2)
						{
							$sql = "UPDATE poa SET terminado = 1, actual = 0 WHERE actual = 1";
							if ( $res = mysql_db_query ( $bdd, $sql ) )
							{
								echo "<div align='center' class='MedianoAzulOscuro'>Ha finalizado la captura del Ejercicio POA.</div>";
								//Aca va todo el respaldo del POA
								//RESPALDO ACCIONES
								$sql_metas = "SELECT * FROM accion";
								$res_metas = mysql_db_query ( $bdd, $sql_metas );
								while ( $row_metas = mysql_fetch_assoc ( $res_metas ) )
								{
									$sql_historial_metas = "INSERT INTO accion_poa ( id, actividad_id, nombreAccion, claveAccion, unidad, cantidad, idpoa) VALUES ( {$row_metas['id']}, {$row_metas['actividad_id']}, '{$row_metas['nombreAccion']}', {$row_metas['claveAccion']}, '{$row_metas['unidad']}', '{$row_metas['cantidad']}', '{$row_poa1['idpoa']}' )";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_metas) or die ( mysql_error());
								}
								//RESPALDO INSUMOS
								$sql_insumo = "SELECT * FROM insumo";
								$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
								while ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
								{
									$sql_historial_insumo = "INSERT INTO insumo_poa ( id, descinsu, medida, costuni, estado, partida_id, idpoa) VALUES ( '{$row_insumo['id']}', '{$row_insumo['descinsu']}', '{$row_insumo['medida']}', '{$row_insumo['costuni']}', '{$row_insumo['estado']}', '{$row_insumo['partida_id']}', '{$row_poa1['idpoa']}' )";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_insumo) or die ( mysql_error());
								}
								//RESPALDO METAS
								$sql_accion = "SELECT * FROM metas";
								$res_accion = mysql_db_query ( $bdd, $sql_accion );
								while ( $row_accion = mysql_fetch_assoc ( $res_accion ) )
								{
									$sql_historial_accion = "INSERT INTO metas_poa ( idaccion, iddpto, idmeta, idpoa, idpreacciones) VALUES ('{$row_accion['idaccion']}', '{$row_accion['iddpto']}', '{$row_accion['idmeta']}', '{$row_poa1['idpoa']}', '{$row_accion['idpreacciones']}' )";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_accion) or die ( mysql_error());
								}
								//RESPALDO POA-DEPARTAMENTO
								$sql_dpto = "SELECT * FROM poa_dpto ORDER BY id";
								$res_dpto = mysql_db_query ( $bdd, $sql_dpto);
								while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
								{
									$sql_historial = "INSERT INTO poa_dpto_poa ( id, dpto_id, partida_id, insumo_id, cantidad, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa) VALUES ( '{$row_dpto['id']}', '{$row_dpto['dpto_id']}', '{$row_dpto['partida_id']}', '{$row_dpto['insumo_id']}', '{$row_dpto['cantidad']}', '{$row_dpto['justificacion']}', '{$row_dpto['idaccion']}', '{$row_dpto['tipogasto']}', '{$row_dpto['periodo']}', '{$row_dpto['idproceso']}', '{$row_dpto['idactividad']}', '{$row_dpto['idacciones']}', '{$row_dpto['idpoa']}' )";
									$res_historia = mysql_db_query ( $bdd, $sql_historial) or die ( mysql_error());
								}	
								//RESPALDO PREACCIONES
								$sql_preacciones = "SELECT * FROM preacciones";
								$res_preacciones = mysql_db_query ( $bdd, $sql_preacciones );
								while ( $row_preacciones = mysql_fetch_assoc ( $res_preacciones ) )
								{
									$sql_historial_preaccion = "INSERT INTO preacciones_poa ( id, claveaccion, accion, enero, julio, idmeta, idpoa) VALUES ('{$row_preacciones['id']}', '{$row_preacciones['claveaccion']}', '{$row_preacciones['accion']}', '{$row_preacciones['enero']}', '{$row_preacciones['julio']}', '{$row_preacciones['idmeta']}', '{$row_poa1['idpoa']}')";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_preaccion) or die ( mysql_error());
								}
								
								//TRUNCAR TABLAS
								mysql_db_query ( $bdd, "TRUNCATE TABLE accion");
								//mysql_db_query ( $bdd, "TRUNCATE TABLE insumo");
								mysql_db_query ( $bdd, "TRUNCATE TABLE metas");
								mysql_db_query ( $bdd, "TRUNCATE TABLE poa_dpto");
								mysql_db_query ( $bdd, "TRUNCATE TABLE preacciones");
								mysql_db_query ( $bdd, "TRUNCATE TABLE presupuesto");
								
							}
							else
							{
								echo "<div align='center' class='MedianoAlerta'>Error en la base de datos.</div>";
							}
						}
						else
						{
							$sql = "UPDATE poa SET terminado = 1 WHERE actual = 1";
							if ( $res = mysql_db_query ( $bdd, $sql ) )
							{
								echo "<div align='center' class='MedianoAzulOscuro'>Ha finalizado la captura del Ejercicio 1.</div>";
							}
							else
							{
								echo "<div align='center' class='MedianoAlerta'>Error en la base de datos.</div>";
							}
						}
					}
					
			}
			else if ( isset ( $_POST['inicioPOA'] ) )
			{
				/*$sql_dpto = "SELECT * FROM poa_dpto ORDER BY id";
				if ($res_dpto = mysql_db_query ( $bdd, $sql_dpto))
				{
					while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
					{
						$sql_historial = "INSERT INTO poa_dpto_apoa ( id, dpto_id, partida_id, insumo_id, cantidad, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa) VALUES ( '{$row_dpto['id']}', '{$row_dpto['dpto_id']}', '{$row_dpto['partida_id']}', '{$row_dpto['insumo_id']}', '{$row_dpto['cantidad']}', '{$row_dpto['justificacion']}', '{$row_dpto['idaccion']}', '{$row_dpto['tipogasto']}', '{$row_dpto['periodo']}', '{$row_dpto['idproceso']}', '{$row_dpto['idactividad']}', '{$row_dpto['idacciones']}', '{$row_dpto['idpoa']}' )";
						$res_historia = mysql_db_query ( $bdd, $sql_historial) or die ( mysql_error());
					}	
				}*/
				//Respaldo del APOA
								//Aca va todo el respaldo del POA
								//RESPALDO ACCIONES
								$sql_metas = "SELECT * FROM accion";
								$res_metas = mysql_db_query ( $bdd, $sql_metas );
								while ( $row_metas = mysql_fetch_assoc ( $res_metas ) )
								{
									$sql_historial_metas = "INSERT INTO accion_apoa ( id, actividad_id, nombreAccion, claveAccion, unidad, cantidad, idpoa) VALUES ( {$row_metas['id']}, {$row_metas['actividad_id']}, '{$row_metas['nombreAccion']}', {$row_metas['claveAccion']}, '{$row_metas['unidad']}', '{$row_metas['cantidad']}', '{$row_poa1['idpoa']}' )";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_metas) or die ( mysql_error());
								}
								//RESPALDO INSUMOS
								$sql_insumo = "SELECT * FROM insumo";
								$res_insumo = mysql_db_query ( $bdd, $sql_insumo );
								while ( $row_insumo = mysql_fetch_assoc ( $res_insumo ) )
								{
									$sql_historial_insumo = "INSERT INTO insumo_apoa ( id, descinsu, medida, costuni, estado, partida_id, idpoa) VALUES ( '{$row_insumo['id']}', '{$row_insumo['descinsu']}', '{$row_insumo['medida']}', '{$row_insumo['costuni']}', '{$row_insumo['estado']}', '{$row_insumo['partida_id']}', '{$row_poa1['idpoa']}' )";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_insumo) or die ( mysql_error());
								}
								//RESPALDO METAS
								$sql_accion = "SELECT * FROM metas";
								$res_accion = mysql_db_query ( $bdd, $sql_accion );
								while ( $row_accion = mysql_fetch_assoc ( $res_accion ) )
								{
									$sql_historial_accion = "INSERT INTO metas_apoa ( idaccion, iddpto, idmeta, idpoa, idpreacciones) VALUES ('{$row_accion['idaccion']}', '{$row_accion['iddpto']}', '{$row_accion['idmeta']}', '{$row_poa1['idpoa']}', '{$row_accion['idpreacciones']}' )";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_accion) or die ( mysql_error());
								}
								//RESPALDO POA-DEPARTAMENTO
								$sql_dpto = "SELECT * FROM poa_dpto ORDER BY id";
								$res_dpto = mysql_db_query ( $bdd, $sql_dpto);
								while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
								{
									$sql_historial = "INSERT INTO poa_dpto_apoa ( id, dpto_id, partida_id, insumo_id, cantidad, justificacion, idaccion, tipogasto, periodo, idproceso, idactividad, idacciones, idpoa) VALUES ( '{$row_dpto['id']}', '{$row_dpto['dpto_id']}', '{$row_dpto['partida_id']}', '{$row_dpto['insumo_id']}', '{$row_dpto['cantidad']}', '{$row_dpto['justificacion']}', '{$row_dpto['idaccion']}', '{$row_dpto['tipogasto']}', '{$row_dpto['periodo']}', '{$row_dpto['idproceso']}', '{$row_dpto['idactividad']}', '{$row_dpto['idacciones']}', '{$row_dpto['idpoa']}' )";
									$res_historia = mysql_db_query ( $bdd, $sql_historial) or die ( mysql_error());
								}	
								//RESPALDO PREACCIONES
								$sql_preacciones = "SELECT * FROM preacciones";
								$res_preacciones = mysql_db_query ( $bdd, $sql_preacciones );
								while ( $row_preacciones = mysql_fetch_assoc ( $res_preacciones ) )
								{
									$sql_historial_preaccion = "INSERT INTO preacciones_apoa ( id, claveaccion, accion, enero, julio, idmeta, idpoa) VALUES ('{$row_preacciones['id']}', '{$row_preacciones['claveaccion']}', '{$row_preacciones['accion']}', '{$row_preacciones['enero']}', '{$row_preacciones['julio']}', '{$row_preacciones['idmeta']}', '{$row_poa1['idpoa']}')";
									$res_historia = mysql_db_query ( $bdd,$sql_historial_preaccion) or die ( mysql_error());
								}

				//Fin del Respaldo
					
				//aca tiene que ir todo el respaldo del APOA			
				$sql = "SELECT * FROM poa WHERE actual = 1";
				$res = mysql_db_query ( $bdd, $sql );
				$row = mysql_fetch_assoc ( $res );
				mysql_db_query ( $bdd, "UPDATE poa SET tipo = 2, terminado = 0, periodo = 0  WHERE id = {$row['id']}");
				
				echo "<div align='center' class='MedianoAzulOscuro'>Se ha iniciado el POA.</div>";
			}
			/*else if ( isset ( $_POST['inicioPOA'] ) )
			{
				$sql_dpto = "SELECT * FROM dpto";
				$res_dpto = mysql_db_query ( $bdd, $sql_dpto);
				while ( $row_dpto = mysql_fetch_assoc ( $res_dpto ) )
				{
					$sql = "SELECT poa.anio, dpto.nombretitular, dpto.nombredpto, presupuesto.presupuesto, proceso.proyecto, proceso.claveproceso, actividad.claveActiv, accion.claveaccion, unidadmedida.tipounidad, partida.clavepartida, insumo.descinsu, insumo.medida, insumo.costuni, poa_dpto.cantidad, poa_dpto.justificacion FROM accion, actividad, dpto, insumo, partida, presupuesto, proceso, unidadmedida, poa_dpto, poa WHERE poa.actual = 1 AND dpto.id = {$row_dpto['id']} AND dpto.id = poa_dpto.dpto_id AND dpto.id = presupuesto.dpto_id AND poa_dpto.unidadmedida_id = unidadmedida.id AND unidadmedida.accion_id = accion.id AND accion.actividad_id = actividad.id AND actividad.proceso_id = proceso.id AND poa_dpto.partida_id = partida.id AND poa_dpto.insumo_id = insumo.id";
					$res = mysql_db_query ( $bdd, $sql );
					
					while ( $row = mysql_fetch_assoc ( $res ) )
					{
						$sql_historial = "INSERT INTO historial ( anio, ejercicio, dpto_id, nombretitular, nombredpto, presupuesto, proyecto, claveproceso, claveActiv, claveAccion, tipounidad, clavepartida, descinsu, medida, costuni, cantidad, justificacion) VALUES ( {$row['anio']}, 2, {$row_dpto['id']} , '{$row['nombretitular']}', '{$row['nombredpto']}', {$row['presupuesto']}, '{$row['proyecto']}', '{$row['claveproceso']}', {$row['claveActiv']}, {$row['claveaccion']}, '{$row['tipounidad']}', {$row['clavepartida']}, '{$row['descinsu']}', '{$row['medida']}', {$row['costuni']}, {$row['cantidad']}, '{$row['justificacion']}')";
						$res_historia = mysql_db_query ( $bdd, $sql_historial) or die ( mysql_error());
					}
					
					
					$sql = "SELECT dpto.id  AS dpto_id, proceso.claveproceso, actividad.claveActiv, accion.claveAccion, unidadmedida.tipounidad, partida.clavepartida, gob_federal.presupuesto FROM gob_federal, dpto, partida, proceso, actividad, accion, unidadmedida WHERE gob_federal.dpto_id = dpto.id AND gob_federal.partida_id = partida.id AND gob_federal.unidadmedida_id = unidadmedida.id AND unidadmedida.accion_id = accion.id AND accion.actividad_id = actividad.id AND actividad.proceso_id = proceso.id AND gob_federal.dpto_id = {$row_dpto['id']}";
					$res = mysql_db_query ( $bdd, $sql );
					while ( $row = mysql_fetch_assoc ( $res ) )
					{
						$sql_historial = "INSERT INTO historial_federal ( anio, ejercicio, dpto_id, claveproceso, claveActiv, claveAccion, tipounidad, clavepartida, presupuesto) VALUES ( {$_SESSION['anio']}, 2, {$row['dpto_id']}, '{$row['claveproceso']}' , {$row['claveActiv']}, {$row['claveAccion']}, '{$row['tipounidad']}', {$row['clavepartida']}, {$row['presupuesto']} )";
						$res_historia = mysql_db_query ( $bdd, $sql_historial) or die ( mysql_error());
					}
					
					$sql = "SELECT dpto.id AS dpto_id, dpto.*, metas.*, proceso.*, actividad.*, accion.*, unidadmedida.* FROM dpto, metas, proceso, actividad, accion, unidadmedida WHERE proceso.id = actividad.proceso_id AND actividad.id = accion.actividad_id AND accion.id = unidadmedida.accion_id AND unidadmedida.id = metas.unidadmedida_id AND metas.dpto_id = dpto.id AND metas.dpto_id = {$row_dpto['id']}";
					$res = mysql_db_query ( $bdd, $sql );
					while ( $row = mysql_fetch_assoc ( $res ) )
					{
						$meta = $row['enero']+$row['febrero']+$row['marzo']+$row['abril']+$row['mayo']+$row['junio']+$row['julio']+$row['agosto']+$row['septiembre']+$row['octubre']+$row['noviembre']+$row['diciembre'];
						$sql_historial = "INSERT INTO historial_metas ( anio, ejercicio, dpto_id, claveproceso, claveActiv, claveAccion, tipounidad, meta ) VALUES ( {$_SESSION['anio']}, 2, {$row['dpto_id']}, '{$row['claveproceso']}', {$row['claveActiv']}, {$row['claveAccion']}, '{$row['tipounidad']}', {$meta} )";
						$res_historial = mysql_db_query ( $bdd, $sql_historial ) or die ( mysql_error());
					}
					
				}
				
				mysql_db_query ( $bdd, "TRUNCATE TABLE metas");
				mysql_db_query ( $bdd, "TRUNCATE TABLE poa_dpto");
				mysql_db_query ( $bdd, "TRUNCATE TABLE gob_federal");
				mysql_db_query ( $bdd, "TRUNCATE TABLE presupuesto");
				
				$sql = "SELECT * FROM poa WHERE actual = 1";
				$res = mysql_db_query ( $bdd, $sql );
				$row = mysql_fetch_assoc ( $res );
				$anio = $row['anio']+1;
				mysql_db_query ( $bdd, "INSERT INTO poa (anio, tipo, actual, iniciado) VALUES ({$anio}, 1, 1, 0)");
				mysql_db_query ( $bdd, "UPDATE poa SET actual = 0 WHERE id = {$row['id']}");
				$_SESSION['tipo_poa'] = 1;
				$_SESSION['anio'] = $anio;
				
				echo "<div align='center' class='MedianoAzulOscuro'>Se ha iniciado el POA.</div>";
			}*/
		}
		else
		{
			$sql_poa = "SELECT * FROM poa WHERE actual = 1";
			if ( $res_poa = mysql_db_query ( $bdd, $sql_poa ) )
			{
				if ( $row_poa = mysql_fetch_assoc ( $res_poa ) )
				{
					if ( $row_poa['tipo'] == 1)	
					{	
						$actual = "APOA ".$row_poa['anio'];		
						$siguiente = "POA ".$row_poa['anio'];	
						$next = "POA";		
					}
					else
					{	
						$actual = "POA ".$row_poa['anio'];	
						$siguiente = "APOA ".(date("Y")+1);			
						$next = "APOA";			
					}
					if ( $row_poa['iniciado'] == 1 and $row_poa['terminado'] == 0 )
					{
						$iniciado = "Iniciada";		
						$boton = "<input type='submit' name='terminar' value='Terminar Captura' />";
					}
					else if ( $row_poa['terminado'] == 1 )	
					{	
						$iniciado = "Terminada";		
						$boton = "<input type='submit' name='inicio{$next}' value='Iniciar {$siguiente}' />";
					}
					else	
					{	
						$iniciado = "En Espera";
						$boton = "<input type='submit' name='permitir' value='Permitir Captura' />";	
					}
				}
				else
				{
					//CUANDO NO HAY NINGUN EJERCICIO INICIADO Y SE INICIA EL SISTEMA
					$actual = "No hay ningun Ejercicio Iniciado";
					$iniciado = "Es necesario iniciar un Ejercicio";
					$boton = "<input type='submit' name='inicioSistema' value='Iniciar Primer APOA' />";
				}
			}
			else
			{
				echo "<div class='MedianoAlerta'>Error en la base de datos.</div>";
			}
?>
            <form action="" method="post">
            <table width="100%" align="center">
                <tr>
                    <td align="center" width="100%"> 
                        <fieldset style="border-bottom-color:#0066CC" >
                            <legend class="MedianoAzulOscuro"><img src="imagenes/book.png" /> Ejercicio Presupuestal</legend>
                            <table width="100%" align="center" cellpadding="3" cellspacing="3" class="MedianoAzul">
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Ejercicio Presupuestal Actual: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $actual; ?></td>
                                </tr>
                                <tr>
                                    <td width="55%" align="right" class="MedianoAzulOscuro">Captura de Gastos: </td>
                                    <td width="45%" align="left" class="MedianoAzulOscuro"><?php echo $iniciado; ?></td>
                                </tr>
                                <tr>
                                    <td width="100%" align="center" class="MedianoAzulOscuro" colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="100%" align="center" class="MedianoAzulOscuro" colspan="2"><?php echo $boton; ?></td>
                                </tr>
                            </table>
                        </fieldset>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="boton" value="1" />
            </form>
        
<?php
		}
	}
?>