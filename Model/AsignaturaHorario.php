<?php 
	class AsignaturaHorario extends AppModel {
	
		public  $name = 'AsignaturaHorario';
		public  $useTable = 'ASIGNATURAS_HORARIOS';
		public  $primaryKey = 'ID';

		public function getSiglaSeccion($sigla_seccion=null)
		{
			$response = array(
				'message'=>'No se ha entrado el dato solicitado',
				'status'=>'danger',
				'data'=>'null'
			);
			if (!empty($sigla_seccion)) {
				$objeto = $this->find('first',array(
					'conditions'=>array(
						'AsignaturaHorario.SIGLA_SECCION'=>$sigla_seccion
					)
				));
				if (!empty($objeto)) {
					$response['data'] = $objeto;
					$response['status']='success';
					$response['message']=null;
				}
			}
			return $response;
		}

		public function getDocenteTitularBySiglaSeccion($sigla_seccion=null,$cod_sede=null)
		{
			$response = array(
				'message'=>'No se ha entrado el docente titular',
				'status'=>'danger',
				'data'=>'null'
			);
			if (!empty($sigla_seccion)) {
				$objeto = $this->find('first',array(
					'fields'=>array(
						'Docente.NOMBRE',
						'Docente.APELLIDO_PAT',
						'Docente.APELLIDO_MAT',	
						'Docente.COD_DOCENTE',
					),
					'joins'=>array(
						array(
							'type'=>'inner',
							'table'=>'DOCENTES',
							'alias'=>'Docente',
							'conditions'=>array(
								'Docente.COD_DOCENTE = AsignaturaHorario.COD_DOCENTE',
							)
						),
					),
					'conditions'=>array(
						'AsignaturaHorario.SIGLA_SECCION'=>$sigla_seccion,
						'AsignaturaHorario.COD_SEDE'=>$cod_sede
					)
				));
				#debug($this->getLastQuery());
				if (!empty($objeto)) {
					$response['data'] = $objeto;
					$response['status']='success';
					$response['message']=null;
				}
			}
			return $response;
		}

		public function getCargaHorario($cod_docente=null, $periodo=null)
		{			
			$conditions = array('OR'=>array('ProgramacionClase.COD_DOCENTE'=>$cod_docente,
				'ProgramacionClase.DOCENTE_REEMPLAZO_ID'=>$cod_docente
				));
			if (!empty($periodo)) {
				$conditions['AsignaturaHorario.COD_PERIODO'] = $periodo;
				$conditions['AsignaturaHorario.ESTADO_SAP'] = 1;
			}
			$horarios = $this->find('all',array(
				'fields'=>array(
					'AsignaturaHorario.SIGLA_SECCION',
					'AsignaturaHorario.COD_JORNADA',
					'AsignaturaHorario.ULTIMO_REGISTRO',
					'AsignaturaHorario.ASIST_PROMEDIO',
					'AsignaturaHorario.CLASES_REGISTRADAS',
					'AsignaturaHorario.COD_ASIGNATURA_HORARIO',
					'AsignaturaHorario.RI_ENABLE',
					'AsignaturaHorario.TEO_PRA',
					'Sede.NOMBRE',
					'Sede.ID_TIPO_SEDE',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = AsignaturaHorario.COD_SEDE',
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'PROGRAMACION_CLASES',
						'alias'=>'ProgramacionClase',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = AsignaturaHorario.SIGLA',
						)
					),
				),
				'conditions'=> array(
					"OR"=>array(
						array("ProgramacionClase.DOCENTE_REEMPLAZO_ID='".$cod_docente."'"),
						array("ProgramacionClase.COD_DOCENTE"=>$cod_docente),
						
				)),
				'order' => array(
					'Sede.NOMBRE' => 'ASC',
					'Asignatura.NOMBRE' => 'ASC',
					'AsignaturaHorario.SIGLA_SECCION' => 'ASC'
				)
			));
			#debug($this->getLastQuery());
			$response = array();
			foreach ($horarios as $key => $value) {
				$clave=(int)$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'];
				$response[$clave]=$value;
			}
			#debug($response);exit();
			return $response;
		}

		public function getAsignaturaHorarioFirst($asignatura_horario_uuid=null)
		{
			$asignatura_horario = $this->find('first',array(
				'fields'=>array(
					'AsignaturaHorario.ID',
					'AsignaturaHorario.SIGLA_SECCION',
					'AsignaturaHorario.COD_JORNADA',
					'AsignaturaHorario.ULTIMO_REGISTRO',
					'AsignaturaHorario.RI_ENVIADO_A_SAP',
					'AsignaturaHorario.ASIST_PROMEDIO',
					'AsignaturaHorario.CLASES_REGISTRADAS',
					'AsignaturaHorario.COD_PERIODO',
					'AsignaturaHorario.FECHA_ENVIO_SAP',
					'AsignaturaHorario.COD_ASIGNATURA_HORARIO',
					'AsignaturaHorario.COD_SEDE',
					'AsignaturaHorario.RI_ENABLE',
					'AsignaturaHorario.TEO_PRA',
					'AsignaturaHorario.RI_IMPORT',
					'AsignaturaHorario.SM_OBJID',
					'Sede.NOMBRE',
					'Sede.COD_SEDE',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.RUT',
					'Docente.DV',
					'Docente.COD_DOCENTE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.CORREO',
					'Periodo.SEMESTRE',
					'Periodo.ANHO',
					'Periodo.COD_PERIODO',
					'Periodo.FECHA_INICIO',
					'Periodo.FECHA_FIN',
					'Periodo.FECHA_INICIO_RI',
					'Periodo.FECHA_FIN_RI',
					'DirectorEnvioSap.NOMBRES',
					'DirectorEnvioSap.APELLIDO_PAT',
					'DirectorEnvioSap.APELLIDO_MAT',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = AsignaturaHorario.SIGLA',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = AsignaturaHorario.COD_SEDE',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DIRECTORES',
						'alias'=>'DirectorEnvioSap',
						'conditions'=>array(
							'DirectorEnvioSap.COD = AsignaturaHorario.DIRECTOR_SEND_SAP_ID',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'PERIODOS',
						'alias'=>'Periodo',
						'conditions'=>array(
							'Periodo.COD_PERIODO = AsignaturaHorario.COD_PERIODO',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = AsignaturaHorario.COD_DOCENTE',
						)
					),
				),
				'conditions'=>array(
					'AsignaturaHorario.COD_ASIGNATURA_HORARIO'=>$asignatura_horario_uuid,
					'AsignaturaHorario.SIGLA_SECCION IS NOT NULL',
					'AsignaturaHorario.COD_SEDE IS NOT NULL',
				),
			));
			#debug($this->getLastQuery());die;
			return $asignatura_horario;
		}
		public function actualizarAsignaturaHorario($cod_asignatura_horario=null)
		{
			$sql = "
				UPDATE ASIGNATURAS_HORARIOS
				SET ASIST_PROMEDIO = (
					SELECT ( ROUND((COUNT (CASE WHEN ASISTENCIA = 1 THEN 1 END) * 100 / COUNT (*)),2) )
					FROM PROGRAMACION_CLASES
					INNER JOIN ASISTENCIAS ON ( PROGRAMACION_CLASES.COD_PROGRAMACION = ASISTENCIAS.COD_PROGRAMACION )
					WHERE PROGRAMACION_CLASES.COD_ASIGNATURA_HORARIO = '".$cod_asignatura_horario."'
				), CLASES_REGISTRADAS = (
					SELECT ( COUNT(*) )
					FROM PROGRAMACION_CLASES
					WHERE PROGRAMACION_CLASES.COD_ASIGNATURA_HORARIO = '".$cod_asignatura_horario."'
					AND PROGRAMACION_CLASES.WF_ESTADO_ID IS NOT NULL
				) WHERE COD_ASIGNATURA_HORARIO = '".$cod_asignatura_horario."'
			";
			return $this->query($sql);
		}

		public function getAsignaturasByNombre($sigla_asignatura=null) 
		{
			//....			
		}

		public function autocompletarBySiglaSeccion($term=null)	
		{
			$sigla_seccion = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$sigla_seccion = $this->find('all',array(
					'fields'=>array(
						'AsignaturaHorario.sigla_seccion',
						'AsignaturaHorario.TEO_PRA',

					),
					'conditions'=>array(
						"AsignaturaHorario.sigla_seccion LIKE '%".$term."%' ",
					),
					'order'=>'AsignaturaHorario.sigla_seccion',
				));
			}
			return $sigla_seccion;
		}
		
		public function getClasesByPeriodo($cod_periodo=null, $fecha_desde=null, $fecha_hasta=null, $sede=null) 
		{
			#debug($cod_periodo);
			if (!empty($fecha_desde) && !empty($fecha_hasta) && !empty($cod_periodo)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'AsignaturaHorario.COD_PERIODO'=>$cod_periodo,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}else{
				if (!empty($cod_periodo)) {
					$conditions = array(
						'AsignaturaHorario.COD_PERIODO'=>$cod_periodo,
						'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
						'ProgramacionClase.COD_SEDE'=>$sede
					);
				}
			}
			 #debug($conditions); exit();
			$clases_periodo = $this->find('all', array(
				'conditions'=>$conditions,
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA',
						)
					),
					array(
						'type'=>'inner',
						'table'=>'PROGRAMACION_CLASES',
						'alias'=>'ProgramacionClase',
						'conditions'=>array(
							'AsignaturaHorario.COD_ASIGNATURA_HORARIO = ProgramacionClase.COD_ASIGNATURA_HORARIO',
							'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
				),
				'fields'=>array(
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'SubEstado.NOMBRE'
				)
			));
			#debug($this->getLastQuery());
			return $clases_periodo;
		}

		public function getCumplimientoAsistencia($cod_periodo=null,$cod_docente=null,$sigla_seccion=null,$ordenar=null)
		{
			$conditions = array('AsignaturaHorario.COD_PERIODO'=>$cod_periodo);
			if (!empty($cod_docente)) {
				$conditions['Docente.COD_DOCENTE'] = $cod_docente;
			}
			if (!empty($sigla_seccion)) {
				$conditions['AsignaturaHorario.SIGLA_SECCION'] = $sigla_seccion;
			}
			#debug($ordenar);
			$result = $this->find('all',array(
				'fields'=>array(
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'AsignaturaHorario.ASIST_PROMEDIO',
					'AsignaturaHorario.COD_ASIGNATURA_HORARIO',
					'AsignaturaHorario.CLASES_REGISTRADAS',
					'AsignaturaHorario.SIGLA_SECCION',
					'Docente.RUT',
					'Docente.DV',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA',
						)
					),
					array(
						'type'=>'inner',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = AsignaturaHorario.COD_DOCENTE',
						)
					),
				),
				'conditions'=>$conditions,
				'order'=>$ordenar,
			));
			#debug($this->getLastQuery());
			return $result;
		}
	}