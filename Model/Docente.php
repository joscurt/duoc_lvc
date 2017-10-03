<?php 
	class Docente extends AppModel {
	
		public  $name = 'Docente';
		public  $useTable = 'DOCENTES';

		public function afterFind($results, $primary = false) {
			
		    foreach ($results as $key => $val) {
		        if (isset($val['Docente']['NOMBRE'])) {
		            $results[$key]['Docente']['NOMBRE'] = utf8_encode($val['Docente']['NOMBRE']);
		        }
		        if (isset($val['Docente']['APELLIDO_PAT'])) {
		            $results[$key]['Docente']['APELLIDO_PAT'] = utf8_encode($val['Docente']['APELLIDO_PAT']);
		        }
		        if (isset($val['Docente']['APELLIDO_MAT'])) {
		            $results[$key]['Docente']['APELLIDO_MAT'] = utf8_encode($val['Docente']['APELLIDO_MAT']);
		        }
		    }
		    return $results;
		}

public function getDocHorario($cod_sede=null,$fecha=null,$hora_inicio=null,$hora_fin=null)
	{

			$db = $this->getDataSource();
			$sql = $db->fetchAll("SELECT DISTINCT Docente.RUT, Docente.COD_DOCENTE, Docente.USERNAME, Docente.COD_SEDE, Docente.NOMBRE, Docente.APELLIDO_PAT, Docente.APELLIDO_MAT
			FROM VW_DOCENTES Docente
			WHERE Docente.COD_SEDE = '".$cod_sede."'
			AND Docente.COD_DOCENTE NOT IN
			(SELECT Horario.COD_DOCENTE FROM vw_salas_programacion Horario
			WHERE Horario.TIPO_EVENTO = 'REGULAR' AND
			Horario.FECHA_CLASE = '".$fecha."'
			AND Horario.COD_SEDE = '".$cod_sede."'
			AND ('".$hora_inicio."' BETWEEN Horario.SOLO_HORA_INICIO and Horario.SOLO_HORA_FIN OR
			'".$hora_fin."' BETWEEN Horario.SOLO_HORA_INICIO and Horario.SOLO_HORA_FIN)
			GROUP BY Horario.COD_DOCENTE)");

#debug($this->getLastQuery());

			return $sql;
  			}
		public function getDocenteConSedesForLogin($username=null)
		{
			if (empty($username)) {
				return array();
			}
			$docentes_sedes = $this->find('all',array(
				'fields'=>array(
					'Docente.COD_DOCENTE',
					'Docente.UUID',
					'Docente.NOMBRE',
					'Docente.CORREO',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.USERNAME',
					'Sede.NOMBRE',
					'Sede.COD_SEDE',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES_SEDES',
						'alias'=>'DocenteSede',
						'conditions'=>array(
							'Docente.COD_DOCENTE = DocenteSede.RUT_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = DocenteSede.COD_SEDE'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'PERMISOS',
						'alias'=>'Permiso',
						'conditions'=>array(
							'Permiso.ID = Docente.PERMISO_ID',
							'Permiso.ACTIVO = 1'
						)
					)
				),
				'conditions'=>array(
					'UPPER(Docente.USERNAME)'=>strtoupper($username),
				),
				'order'=>'Sede.NOMBRE',
			));
			#($docentes_sedes);
			$docente = array();
			foreach ($docentes_sedes as $key => $value) {
				$docente['Docente'] = $value['Docente'];
				if (!empty($value['Sede']['COD_SEDE'])) {
					$docente['Sede'][$value['Sede']['COD_SEDE']] = $value['Sede'];
				}else{
					$docente['Sede'] = array();
				}
			}
			#pr($docente);exit();
			return $docente;
		}
		public function getDocentesBySede($cod_sede=null)
		{
			if (empty($cod_sede)) {
				return array();
			}
			$docentes = $this->find('all',array(
				'fields'=>array(
					'Docente.COD_DOCENTE',
					'Docente.UUID',
					'Docente.NOMBRE',
					'Docente.CORREO',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.USERNAME',
					'Sede.NOMBRE',
					'Sede.COD_SEDE',
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'DOCENTES_SEDES',
						'alias'=>'DocenteSede',
						'conditions'=>array(
							'Docente.COD_DOCENTE = DocenteSede.RUT_DOCENTE'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = DocenteSede.COD_SEDE'
						)
					),
				),
				'conditions'=>array(
					'DocenteSede.COD_SEDE'=>$cod_sede,
				),
				'order'=>'Docente.NOMBRE',
			));
			return $docentes;
		}
		public function getDocentes($cod_docente=null){
			#debug($cod_docente);
			$docentes = $this->find('all',array(
				'fields'=>array(
					'DISTINCT Docente.COD_DOCENTE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.USERNAME',
				),
			 	'conditions'=>array('Docente.COD_DOCENTE'=>$cod_docente)));
			return $docentes;
		}
		public function getDocente($cod_docente = null, $mas_docentes=false)
		{
			if ($mas_docentes) {
				return $this->find('all',array('conditions'=>array('COD_DOCENTE'=>$cod_docente)));
			}else{
				return $this->find('first',array('conditions'=>array('COD_DOCENTE'=>$cod_docente)));
			}
		}
		public function getDocentesDisponibles($cod_sede=null,$hora_inicio=null,$hora_fin=null,$cod_programacion=null)
		{
			if (empty($cod_sede)) {
				return array();
			}
			if (!empty($hora_inicio) && !empty($hora_fin)) {
				$hora_fin = date('Y-m-d H:i',strtotime($hora_fin));
				$hora_inicio = date('Y-m-d H:i',strtotime($hora_inicio));
				$sql = "
					SELECT ProgramacionClase.COD_DOCENTE
					FROM programacion_clases ProgramacionClase
					WHERE
						ProgramacionClase.HORA_INICIO BETWEEN TO_DATE ('".$hora_inicio."','YYYY-MM-DD HH24:MI')
						    AND TO_DATE ('".$hora_fin."','YYYY-MM-DD HH24:MI')
						AND ProgramacionClase.HORA_FIN BETWEEN TO_DATE ('".$hora_inicio."','YYYY-MM-DD HH24:MI') 
							AND TO_DATE ('".$hora_fin."','YYYY-MM-DD HH24:MI')
						AND ProgramacionClase.COD_SEDE = '".$cod_sede."'
						 AND ProgramacionClase.COD_PROGRAMACION != '".$cod_programacion."'";
				$result = $this->query($sql);
				#debug($sql);
				#debug($result);
				$cod_docentes = array();
				foreach ($result as $key => $value) {
					$cod_docentes[$value['ProgramacionClase']['COD_DOCENTE']] = $value['ProgramacionClase']['COD_DOCENTE'];
				}
				if (!empty($cod_docentes)) {
					$conditions = array(
						'Docente.COD_DOCENTE NOT IN(\''.implode($cod_docentes,'\',\'').'\')'
					);
				}
				$conditions['DocenteSede.COD_SEDE'] = $cod_sede;
			#	debug($conditions);
			}else{
				$conditions = array(
					'DocenteSede.COD_SEDE'=>$cod_sede,
				);
			}
			#debug($conditions);
			$docentes = $this->find('all',array(
				'fields'=>array(
					'Docente.COD_DOCENTE',
					'Docente.UUID',
					'Docente.NOMBRE',
					'Docente.CORREO',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.USERNAME',
					'Sede.NOMBRE',
					'Sede.COD_SEDE',
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'DOCENTES_SEDES',
						'alias'=>'DocenteSede',
						'conditions'=>array(
							'Docente.COD_DOCENTE = DocenteSede.RUT_DOCENTE'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = DocenteSede.COD_SEDE'
						)
					),
				),
				'conditions'=>$conditions,
				'order'=>'Docente.NOMBRE',
			));
			#debug($docentes);
			#debug($this->getLastQuery());
			return $docentes;
		}
		public function autocompletarByRutDocente($term=null,$sede=null) 
		{
			$rut_docente = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$rut_docente = $this->find('all',array(
					'fields'=>array(
						'DISTINCT Docente.rut',
						'Docente.dv',
						'Docente.cod_docente',
						'Docente.NOMBRE',
						'Docente.APELLIDO_MAT',
						'Docente.APELLIDO_PAT',
					),
					'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'VW_DOCENTES',
						'alias'=>'Docentevw',
						'conditions'=>array(
							'Docente.COD_DOCENTE = Docentevw.COD_DOCENTE'
						)
					)),
					'conditions'=>array(
						"Docente.rut ||'-'||Docente.dv LIKE '%".$term."%' ",
						'Docentevw.COD_SEDE'=>$sede
					),
					'order'=>'Docente.rut'
				));
				
			}
			
			return $rut_docente;
		}
		public function autocompletarByNombreDocente($term=null,$sede=null)
		{
			$nombre_docente = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$nombre_docente = $this->find('all',array(
					'fields'=>array(
						'DISTINCT Docente.NOMBRE',
						'Docente.rut',
						'Docente.dv',
						'Docente.APELLIDO_PAT',
						'Docente.APELLIDO_MAT',
						'Docente.cod_docente',
						'Docentevw.COD_SEDE'
					),
					'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'VW_DOCENTES',
						'alias'=>'Docentevw',
						'conditions'=>array(
							'Docente.COD_DOCENTE = Docentevw.COD_DOCENTE'
						)
					)),
					'conditions'=>array(
						"Docente.NOMBRE ||' '||Docente.APELLIDO_PAT||' '||Docente.APELLIDO_MAT LIKE '%".$term."%' ",
						'Docentevw.COD_SEDE'=>$sede
					),
					'order'=>'Docente.nombre'
				));
			}
			return $nombre_docente;
		}
		public function autocompletarByIdDocente($term=null) 
		{
			$id_docente = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$id_docente = $this->find('all',array(
					'fields'=>array(
						#'Docente.uuid',
						'DISTINCT Docente.cod_docente',
						'Docente.NOMBRE',
						'Docente.APELLIDO_MAT',
						'Docente.APELLIDO_PAT',
					),
					'conditions'=>array(
						"Docente.cod_docente LIKE '%".$term."%' "
					),
					'order'=>'Docente.cod_docente'
				));
			}
			return $id_docente;
		}
	}