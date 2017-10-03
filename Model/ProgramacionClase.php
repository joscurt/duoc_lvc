<?php 

	App::uses('Semana','Model');
	App::uses('Docente','Model');
	App::uses('HorarioModulo','Model');

	# Versi&oacute;n: 2017-06-16
	class ProgramacionClase extends AppModel {
	
		public  $name = 'ProgramacionClase';
		public  $useTable = 'PROGRAMACION_CLASES';
		public  $primaryKey = 'ID';

		# ------------------------------------------------------------------------------------------
		public function getDatosConFiltroMultile($datos_filtro_multiple=null, $cod_sede=null)
		{
			$fecha_desde = 'TO_DATE(\''.$datos_filtro_multiple['Filtro']['fecha_inicio'].'\')';
			$fecha_hasta = 'TO_DATE(\''.$datos_filtro_multiple['Filtro']['fecha_fin'].'\')';
			if (!empty($datos_filtro_multiple['Filtro']['fecha_inicio']) && !empty($datos_filtro_multiple['Filtro']['fecha_fin'])) {
				$conditions = array(
					'ProgramacionClase.HORA_INICIO BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.COD_SEDE'=>$cod_sede,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR'
				);
			}else{
				$conditions=array(
					'ProgramacionClase.COD_SEDE'=>$cod_sede,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR'
				);
			}
			$clases = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Estado.NOMBRE',
					'Estado.BLO_CLASE',
					'SubEstado.NOMBRE'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					)
				
				),
				'conditions'=>$conditions,
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
		}

		# ------------------------------------------------------------------------------------------
		public function getSolicitudRecuperacion($cod_sede=null,$fecha_desde=null,$fecha_hasta=null,$filtro=null,$valor_filtros=null,$order = null,$multiple_filtro = array())
		{
			$where_and = "";
			$ordenar = "";
			if(!empty($order)){
				$ordenar = "ORDER BY ".$order." ASC";
				if ($order == 'ProgramacionClase.HORA_INICIO') {
					$ordenar = "ORDER BY TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI')";
				}
			}
			if(!empty($multiple_filtro)){
				$condiciones = $multiple_filtro;
				#debug($condiciones);
				foreach ($condiciones as $key => $value) {
					if(is_int($key))
						$where_and.=" AND ".$value;
					else
						$where_and.=" AND ".$key." = '".$value."' ";
				}
			}else{
				if(!empty($fecha_desde) && !empty($fecha_hasta)){
					$where_and.= " AND ProgramacionClase.FECHA_CLASE BETWEEN TO_DATE('".date('Y-m-d',strtotime($fecha_desde))."','YYYY-MM-DD') AND TO_DATE('".date('Y-m-d',strtotime($fecha_hasta))."','YYYY-MM-DD')";
				}
				if(!empty($filtro) && !empty($valor_filtros)){
					$where_and.= " AND ".$filtro." = '".$valor_filtros."'";
				}
			}
			$sql = "
				SELECT ProgramacionClase.HORA_INICIO,
					ProgramacionClase.HORA_FIN,
					ProgramacionClase.FECHA_CLASE,
					ProgramacionClase.CANTIDAD_MODULOS,
					ProgramacionClase.COD_JORNADA,
					ProgramacionClase.COD_PROGRAMACION,
					ProgramacionClase.SIGLA_SECCION,
					ProgramacionClase.ID,
					ProgramacionClase.SALA,
					ProgramacionClase.TIPO_EVENTO,
					Asignatura.SIGLA,
					Asignatura.NOMBRE,
					Sede.NOMBRE,
					Docente.RUT,
					Docente.DV,
					Docente.COD_DOCENTE,
					Docente.NOMBRE,
					Docente.APELLIDO_PAT,
					Docente.APELLIDO_MAT,
					Detalle.DETALLE,
					Detalle.ID,
					EstadoProgramacion.ID,
					EstadoProgramacion.NOMBRE,
					Sala.TIPO_SALA
				FROM PROGRAMACION_CLASES ProgramacionClase
				LEFT JOIN ASIGNATURAS Asignatura ON (ProgramacionClase.SIGLA = Asignatura.SIGLA)
				LEFT JOIN LVC_VIEW_SEDES Sede ON (ProgramacionClase.COD_SEDE = Sede.COD_SEDE)
				LEFT JOIN DETALLES Detalle ON (ProgramacionClase.DETALLE_ID = Detalle.ID)
				LEFT JOIN DOCENTES Docente ON (ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE)
				LEFT JOIN ESTADOS EstadoProgramacion ON (ProgramacionClase.ESTADO_PROGRAMACION_ID = EstadoProgramacion.ID)
				LEFT JOIN LVC_VIEW_SALAS Sala ON (ProgramacionClase.SALA = Sala.COD_SALA)
				WHERE ProgramacionClase.COD_SEDE = '".$cod_sede."'
				".$where_and." 
				".$ordenar;
			$response = $this->query($sql);
			#debug($response);exit();
			return $response;
		}

		# ------------------------------------------------------------------------------------------
		public function getHorariosSalasByFecha($cod_sala=null,$fecha_inicio=null,$fecha_fin=null,$hora_inicio=null,$hora_fin=null)
		{
			$where_horario_inicio = $where_horario_fin = null;
			$HorarioModulo = new HorarioModulo();
			if (!empty($hora_inicio)) {
				$obj = $HorarioModulo->find('first',array('conditions'=>array('ID'=>$hora_inicio)));
				if (!empty($obj)) {
					$where_horario_inicio = " AND TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI') >= '".$obj['HorarioModulo']['HORA_INICIO']."'";
				}
			}
			if (!empty($hora_fin)) {
				$obj = $HorarioModulo->find('first',array('conditions'=>array('ID'=>$hora_fin)));
				if (!empty($obj)) {
					$where_horario_fin = " AND TO_CHAR(ProgramacionClase.HORA_FIN,'HH24:MI') <= '".$obj['HorarioModulo']['HORA_FIN']."'";
				}
			}
			$sql = "
				SELECT
					ProgramacionClase.HORA_INICIO,
					ProgramacionClase.HORA_FIN,
					ProgramacionClase.FECHA_CLASE,
					ProgramacionClase.CANTIDAD_MODULOS,
					ProgramacionClase.SIGLA_SECCION,
					ProgramacionClase.ID,
					Asignatura.SIGLA,
					Asignatura.NOMBRE,
					Sede.NOMBRE
				FROM
					PROGRAMACION_CLASES ProgramacionClase
					LEFT JOIN ASIGNATURAS Asignatura ON (ProgramacionClase.SIGLA = Asignatura.SIGLA)
					LEFT JOIN LVC_VIEW_SEDES Sede ON (ProgramacionClase.COD_SEDE = Sede.COD_SEDE)
				WHERE ProgramacionClase.SALA='".$cod_sala."' 
				AND ProgramacionClase.FECHA_CLASE BETWEEN TO_DATE('".date('Y-m-d',strtotime($fecha_inicio))."','YYYY-MM-DD') AND TO_DATE('".date('Y-m-d',strtotime($fecha_fin))."','YYYY-MM-DD') 
				".$where_horario_inicio.$where_horario_fin." ";
			$response = $this->query($sql);
			$response_final = array();
			foreach ($response as $key => $value) {
				$hora_inicio = date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO']));
				$hora_fin = date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN']));
				$nro_dia = date('N',strtotime($value['ProgramacionClase']['FECHA_CLASE']));
				$response_final[$hora_inicio][$nro_dia] = $value;
				if ($value['ProgramacionClase']['CANTIDAD_MODULOS']>1) {
					for ($i=$value['ProgramacionClase']['CANTIDAD_MODULOS']-1; $i > 0 ; $i--) { 
						$minutos = 45*$i;
						$fecha_hora_inicio = strtotime('+'.$minutos.' minute',strtotime($value['ProgramacionClase']['HORA_INICIO']));
						$response_final[date('H:i',$fecha_hora_inicio)][$nro_dia] = $value;
					}
				}
			}
			return $response_final;
		}

		# ------------------------------------------------------------------------------------------
		public function getHorariosDocenteByFecha($cod_sede = null, $cod_docente=null,$fecha_inicio=null,$fecha_fin=null,$filtro=null)
		{
			$conditions_sede = '';
			if ($filtro =='sede') {
				$conditions_sede = " AND ProgramacionClase.COD_SEDE = '".$cod_sede."'";
			}
			$sql = "
				SELECT
					ProgramacionClase.HORA_INICIO,
					ProgramacionClase.HORA_FIN,
					ProgramacionClase.FECHA_CLASE,
					ProgramacionClase.CANTIDAD_MODULOS,
					ProgramacionClase.SIGLA_SECCION,
					ProgramacionClase.ID,
					Asignatura.SIGLA,
					Asignatura.NOMBRE,
					Sede.NOMBRE
				FROM
					PROGRAMACION_CLASES ProgramacionClase
					LEFT JOIN ASIGNATURAS Asignatura ON (ProgramacionClase.SIGLA = Asignatura.SIGLA)
					LEFT JOIN LVC_VIEW_SEDES Sede ON (ProgramacionClase.COD_SEDE = Sede.COD_SEDE)
				WHERE
					ProgramacionClase.COD_DOCENTE = '".$cod_docente."'
					AND ProgramacionClase.FECHA_CLASE BETWEEN TO_DATE('".date('Y-m-d',strtotime($fecha_inicio))."','YYYY-MM-DD') AND TO_DATE('".date('Y-m-d',strtotime($fecha_fin))."','YYYY-MM-DD')
					".$conditions_sede." ";
			$response = $this->query($sql);
			$response_final = array();
			foreach ($response as $key => $value) {
				$hora_inicio = date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO']));
				$hora_fin = date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN']));
				$nro_dia = date('N',strtotime($value['ProgramacionClase']['FECHA_CLASE']));
				$response_final[$hora_inicio][$nro_dia] = $value;
				if ($value['ProgramacionClase']['CANTIDAD_MODULOS']>1) {
					for ($i=$value['ProgramacionClase']['CANTIDAD_MODULOS']-1; $i > 0 ; $i--) { 
						$minutos = 45*$i;
						$fecha_hora_inicio = strtotime('+'.$minutos.' minute',strtotime($value['ProgramacionClase']['HORA_INICIO']));
						$response_final[date('H:i',$fecha_hora_inicio)][$nro_dia] = $value;
					}
				}
			}
			return $response_final;
		}

		# ------------------------------------------------------------------------------------------
		public function getCargaHorarioDocentePorSemanas($sedes=array(),$cod_docente=null,$anho=null,$semestre=null,$semanas=array())
		{
			$Semana = new Semana();
			$conditions = array();
			if (!empty($semanas)) {
				$conditions = array(
					'Semana.ID IN'=>$semanas,
				);
			}
			$conditions['Semana.ANHO'] = $anho;
			$conditions['Semana.SEMESTRE'] = $semestre;
			$semanas = $Semana->find('all',array('conditions'=>$conditions));
			$resultado_final = array();
			foreach ($semanas as $key => $value) {
				$resultado_final[$value['Semana']['ID']]['Horarios'] =  $this->getCargaHorarioDocente($sedes,$cod_docente,$value['Semana']['FECHA_INICIO'],$value['Semana']['FECHA_FIN']);
				$resultado_final[$value['Semana']['ID']]['Semana'] = $value['Semana'];
			}
			return $resultado_final;
		}

		# ------------------------------------------------------------------------------------------
		public function getCargaHorarioDocente($sedes=array(),$cod_docente=null,$fecha_inicio=null,$fecha_fin=null)
		{
			$sedes_string = '';
			if (!empty($sedes)) {
				$sedes_string = " AND COD_SEDE = '".$sedes."'";
			}
			$sql = "
				SELECT
					ProgramacionClase.HORA_INICIO,
					ProgramacionClase.HORA_FIN,
					ProgramacionClase.CANTIDAD_MODULOS,
					ProgramacionClase.SIGLA_SECCION,
					ProgramacionClase.FECHA_CLASE, 
					ProgramacionClase.ID,
					ProgramacionClase.MODALIDAD,
					Asignatura.SIGLA,
					Asignatura.NOMBRE,
					AsignaturaHorario.TEO_PRA,
					Sede.NOMBRE
				FROM
					PROGRAMACION_CLASES ProgramacionClase
					LEFT JOIN ASIGNATURAS_HORARIOS AsignaturaHorario ON (ProgramacionClase.SIGLA = AsignaturaHorario.SIGLA)
					LEFT JOIN ASIGNATURAS Asignatura ON (ProgramacionClase.SIGLA = Asignatura.SIGLA)
					LEFT JOIN LVC_VIEW_SEDES Sede ON (ProgramacionClase.COD_SEDE = Sede.COD_SEDE)
				WHERE
					(ProgramacionClase.COD_DOCENTE = '".$cod_docente."' OR ProgramacionClase.DOCENTE_REEMPLAZO_ID = '".$cod_docente."')
					AND FECHA_CLASE BETWEEN TO_DATE('".date('Y-m-d',strtotime($fecha_inicio))."','YYYY-MM-DD') AND TO_DATE('".date('Y-m-d',strtotime($fecha_fin))."','YYYY-MM-DD')
					".$sedes_string."
				ORDER BY TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI') ";
			$response = $this->query($sql);
			$response_final = array();
			foreach ($response as $key => $value) {
				$hora_inicio = date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO']));
				$hora_fin = date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN']));
				$nro_dia = date('N',strtotime($value['ProgramacionClase']['FECHA_CLASE']));
				$response_final[$hora_inicio][$nro_dia] = $value;
				if ($value['ProgramacionClase']['CANTIDAD_MODULOS']>1) {
					for ($i=$value['ProgramacionClase']['CANTIDAD_MODULOS']-1; $i > 0 ; $i--) { 
						$minutos = 45*$i;
						$fecha_hora_inicio = strtotime('+'.$minutos.' minute',strtotime($value['ProgramacionClase']['HORA_INICIO']));
						$response_final[date('H:i',$fecha_hora_inicio)][$nro_dia] = $value;
					}
				}
			}
			return $response_final;
		}

		# ------------------------------------------------------------------------------------------
		public function countClasesSuspendidas($cod_asignatura_horario=null)
		{
			return $this->find('count',array(
				'conditions'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'ProgramacionClase.DETALLE_ID'=>4,//SUSPENDIDA
				)
			));
		}

		# ------------------------------------------------------------------------------------------
		public function countClasesRegulares($cod_asignatura_horario=null)
		{
			return $this->find('count',array(
				'conditions'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'ProgramacionClase.TIPO_EVENTO'=>'REGULAR',
				)
			));
		}

		# ------------------------------------------------------------------------------------------
		public function countClasesNoRegulares($cod_asignatura_horario=null)
		{
			return $this->find('count',array(
				'conditions'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
				)
			));
		}

		# ------------------------------------------------------------------------------------------
		public function countClasesRegistradas($cod_asignatura_horario=null)
		{
			return $this->find('count',array(
				'conditions'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'ProgramacionClase.WF_ESTADO_ID'=>4, //FINALIZADA
					'ProgramacionClase.TIPO_EVENTO'=>'REGULAR',
				)
			));
		}

		# ------------------------------------------------------------------------------------------
		public function countClasesRegistradasNoRegular($cod_asignatura_horario=null)
		{
			return $this->find('count',array(
				'conditions'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'ProgramacionClase.WF_ESTADO_ID'=>4, //FINALIZADA
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
				)
			));
		}

		# ------------------------------------------------------------------------------------------
		public function getHorarios($term='')
		{
			$sql = "
				SELECT 
					TO_CHAR(ProgramacionClase.hora_inicio,'HH24:MI') hora_inicio,
					TO_CHAR(ProgramacionClase.hora_fin,'HH24:MI') hora_fin,
					ProgramacionClase.cod_programacion
				FROM
					PROGRAMACION_CLASES ProgramacionClase 
				WHERE 
					TO_CHAR(ProgramacionClase.hora_inicio,'HH24:MI') || '-' || TO_CHAR(ProgramacionClase.hora_fin,'HH24:MI') like '%".$term."%'
				GROUP BY
					TO_CHAR(ProgramacionClase.hora_inicio,'HH24:MI'),
					ProgramacionClase.hora_fin,
					ProgramacionClase.COD_PROGRAMACION
				ORDER BY
					TO_CHAR(ProgramacionClase.hora_inicio,'HH24:MI')
			";
			$response = $this->query($sql);
			$response_final = array();
			if (is_array($response)) {
				foreach ($response as $key => $value) {
					$response_final[$value[0]['hora_inicio']] = $value[0]['hora_fin'];
				}
			}
			return $response_final;
		}

		# ------------------------------------------------------------------------------------------ SUM (A .asistencia) clases_presente,
		public function getIndicadoresAlumno($cod_asignatura_horario=null)
		{
			$sql = "

				SELECT
			    clases_impartidas,
			     total_clases_all clases_presente,
			    clases_ausente,		   
			    A.ID_ALUMNO
			FROM
			    vw_asistencia_final A
			    WHERE
			    A.COD_HORARIO_ASIGNATURA = '".$cod_asignatura_horario."'

			";

			$response = $this->query($sql);
			$response_final = array();
			foreach ($response as $key => $value) {
				$response_final[$value['A']['ID_ALUMNO']]['CLASES_AUSENTE'] = $value['0']['clases_ausente'];
				$response_final[$value['A']['ID_ALUMNO']]['CLASES_PRESENTE'] = $value['0']['clases_presente'];
				$response_final[$value['A']['ID_ALUMNO']]['CLASES_IMPARTIDAS'] = $value['0']['clases_impartidas'];
				$response_final[$value['A']['ID_ALUMNO']]['COD_ALUMNO'] = $value['A']['ID_ALUMNO'];
			}
			#debug($response);exit();
			return $response_final;

		}

		#MODELO CALCULO SECCION ==============================================000

			public function getIndicadoresAlumno_calulo($cod_asignatura_horario=null){

			$sql = "
		
			SELECT PRORRA_CLASES CLASES_ANTERIOR_SECCION, A.ID_ALUMNO FROM VW_CALC_ASISTENCIA_SECCION A WHERE ASIGNATURA_NUEVA = '".$cod_asignatura_horario."' ";

			$response = $this->query($sql);
			$response_final = array();
			foreach ($response as $key => $value) {
				$response_final[$value['A']['ID_ALUMNO']]['CLASES_ANTERIOR_SECCION'] = $value['0']['CLASES_ANTERIOR_SECCION'];
				$response_final[$value['A']['ID_ALUMNO']]['COD_ALUMNO'] = $value['A']['ID_ALUMNO'];
			}
			#debug($cod_asignatura_horario);exit();
			#debug($response_final);exit();

			return $response_final;
		}

		#========================================================================

		# ------------------------------------------------------------------------------------------
		public function getProgramacionByAsignaturaHorario($cod_docente=null,$cod_sede=null,$cod_asignatura_horario=null,$fecha_desde=null,$fecha_hasta=null)
		{
			$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
			$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
			$result = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Estado.NOMBRE',
					'Estado.BLO_CLASE',
					'SubEstado.NOMBRE',
					'SubEstado.ID',
					'Sala.TIPO_SALA',
					'SalaReemplazo.TIPO_SALA'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
				),
				'conditions'=>array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.COD_SEDE'=>$cod_sede,
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'OR'=>array(
						'ProgramacionClase.COD_DOCENTE'=>$cod_docente,
						'ProgramacionClase.DOCENTE_REEMPLAZO_ID'=>$cod_docente,
					)
				),
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
			#debug($this->getLastQuery());
			return $result;
		}

		# ------------------------------------------------------------------------------------------
		# Historico Asistencia Todo
		public function getProgramacionByAsignaturaHorarioFull($cod_asignatura_horario=null)
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'VW_DOCENTES', # TABLA ANTERIOR = DOCENTES --MP--
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					)
				),
				'conditions'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
				),
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
			#debug($this->getLastQuery());
			return $result;
		}


		public function getProgramacionByAlumnoAsignatura($cod_asignatura_horario=null,$cod_alumno = null)
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'Asistencia.ASISTENCIA',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASISTENCIAS',
						'alias'=>'Asistencia',
						'conditions'=>array(
							'Asistencia.COD_PROGRAMACION = ProgramacionClase.COD_PROGRAMACION',
							'Asistencia.ID_ALUMNO = '.$cod_alumno,
						)
					)
				),
				'conditions'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario
				),
				'order'=>'ProgramacionClase.FECHA_CLASE, ProgramacionClase.HORA_INICIO',
			));
			#debug($this->getLastQuery());
			return $result;	
		}

		# ------------------------------------------------------------------------------------------
		public function getProgramacionByCoordinadorSede($cod_sede=null, $fecha_desde=null, $fecha_hasta=null, $filtro=null, $valor_filtro=null, $order=null, $multiple_filtro=array() )
		{
			$condiciones='';

			if(!empty($multiple_filtro)){
				$condiciones = $multiple_filtro;
			}else{
				$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
				$fecha_hasta = "TO_DATE('".$fecha_hasta."','YYYY-MM-DD')";
				$condiciones = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.COD_SEDE'=>$cod_sede
				);
				if(!empty($filtro) && !empty($valor_filtro)){
					$condiciones[$filtro] = $valor_filtro;
					#debug($filtro);
					#debug($valor_filtro);exit();
				}
			}
			if(empty($order)){
				$order = 'ProgramacionClase.FECHA_CLASE';
			}
			$clases = $this->find('all',array(
				'fields'=>array(
					'DISTINCT ProgramacionClase.ID',
					'ProgramacionClase.WF_ESTADO_ID',
					'AsignaturaHorario.TEO_PRA',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.SALA_REEMPLAZO',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
						'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					)
				),
				'conditions'=>$condiciones,
				'order'=>$order,
			));
			#debug($filtro);
			#debug($this->getLastQuery());exit();
			return $clases;
		}

		# ------------------------------------------------------------------------------------------
		public function getProgramacionByDirectorSede($cod_sede=null,$fecha_desde=null,$fecha_hasta=null)
		{
			$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\', \'YYYY-MM-DD HH24:MI:SS\')';
			$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\', \'YYYY-MM-DD HH24:MI:SS\')';
			$clases = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Estado.NOMBRE',
					'Estado.ID',
					'SubEstado.NOMBRE',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					)
				),
				'conditions'=>array(
					'ProgramacionClase.HORA_INICIO BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.COD_SEDE'=>$cod_sede,
					'ProgramacionClase.TIPO_EVENTO'=>'REGULAR',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID'=>3,
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'=>2,
				),
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
			// debug($this->getLastQuery());
			return $clases;
		}

		# ------------------------------------------------------------------------------------------
		public function getProgramacionClase($cod_programacion=null)
		{
			return $this->find('first',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.CANTIDAD_MODULOS',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.SALA_REEMPLAZO',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					)
				),
				'conditions'=>array(
					'ProgramacionClase.COD_PROGRAMACION'=>$cod_programacion
				)
			));
		}
		public function getProgramacionRecuperar($cod_programacion=null){

			#debug($cod_programacion);exit();
			$result = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.ID',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.FECHA_CLASE'
					),
				'conditions'=> array(
					'ProgramacionClase.COD_PROGRAMACION'=>$cod_programacion
					),
				));
			#debug($result);exit();
			return $result;

		}
		public function getProgramacionAdelantar($cod_programacion=null){

			$result = $this->find('first', array(
				'fields'=>array(
					'ProgramacionClase.ID',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.COD_PROGRAMACION_PADRE'
					),
				'conditions'=>array(
							'ProgramacionClase.COD_PROGRAMACION_PADRE'=>$cod_programacion
						),
				'order'=>'ProgramacionClase.ID DESC',
				));

			#debug($result);exit();
			return $result;
		}
		# ------------------------------------------------------------------------------------------
		public function getProgramacionClaseFull($cod_programacion=null)
		{
			#debug($cod_programacion);exit();
			$result = $this->find('first',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.DOCENTE_REEMPLAZO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.CANTIDAD_MODULOS',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.COD_PROGRAMACION_PADRE',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.SALA_REEMPLAZO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.ADELANTAR_CLASE',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.OBS_SOLICITUD_RECUPERACION',
					'ProgramacionClase.PRESENCIAL',
					'ProgramacionClase.COORDINADOR_CREATED_ID',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.OBSERVACIONES_REFORZAMIENTO',
					'ProgramacionClase.OBSERVACIONES_ADELANTAR_CLASE',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Detalle.ID',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.CORREO',
					'Docente.DV',
					'DocenteReemplazo.NOMBRE',
					'DocenteReemplazo.APELLIDO_PAT',
					'DocenteReemplazo.APELLIDO_MAT',
					'DocenteReemplazo.RUT',
					'DocenteReemplazo.CORREO',
					'DocenteReemplazo.DV',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'EstadoProgramacion.NOMBRE',
					'EstadoProgramacion.ID',
					'SubEstadoProgramacion.NOMBRE',
					'Sede.NOMBRE',
					'MotivoReforzamiento.MOTIVO',
					'MotivoSolicitudRecuperacion.MOTIVO',
					'MotivoAdelantarClase.MOTIVO',
					'MotivoInasistenciaDocente.MOTIVO',
					'RecuperarAtrasoRetiro.MOTIVO',
					'MotivoSuspensionClase.MOTIVO',
					'TipoJustificacionLegal.TIPO_JUSTIFICACION',
					'Sala.TIPO_SALA',
					'SalaReemplazo.TIPO_SALA',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'MOTIVOS_REFORZAMIENTO',
						'alias'=>'MotivoReforzamiento',
						'conditions'=>array(
							'MotivoReforzamiento.ID = ProgramacionClase.MOTIVO_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'MOTIVOS_SUSPENSION_CLASE',
						'alias'=>'MotivoSuspensionClase',
						'conditions'=>array(
							'MotivoSuspensionClase.ID = ProgramacionClase.MOTIVO_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'MOTIVOS_INASISTENCIA_DOCENTE',
						'alias'=>'MotivoInasistenciaDocente',
						'conditions'=>array(
							'MotivoInasistenciaDocente.ID = ProgramacionClase.MOTIVO_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'TIPOS_JUSTIFICACION_LEGAL',
						'alias'=>'TipoJustificacionLegal',
						'conditions'=>array(
							'TipoJustificacionLegal.ID = ProgramacionClase.MOTIVO_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'RECUPERAR_ATRASOS_RETIROS',
						'alias'=>'RecuperarAtrasoRetiro',
						'conditions'=>array(
							'RecuperarAtrasoRetiro.ID = ProgramacionClase.MOTIVO_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'MOTIVOS_ADELANTAR_CLASE',
						'alias'=>'MotivoSolicitudRecuperacion',
						'conditions'=>array(
							'MotivoSolicitudRecuperacion.ID = ProgramacionClase.MOTIVO_SOLICITUD_RECUPERA_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'MOTIVOS_ADELANTAR_CLASE',
						'alias'=>'MotivoAdelantarClase',
						'conditions'=>array(
							'MotivoAdelantarClase.ID = ProgramacionClase.MOTIVO_ADELANTAR_CLASE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = ProgramacionClase.COD_SEDE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'DocenteReemplazo',
						'conditions'=>array(
							'DocenteReemplazo.COD_DOCENTE = ProgramacionClase.DOCENTE_REEMPLAZO_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'EstadoProgramacion',
						'conditions'=>array(
							'EstadoProgramacion.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstadoProgramacion',
						'conditions'=>array(
							'SubEstadoProgramacion.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
				),
				'conditions'=>array(
					'ProgramacionClase.COD_PROGRAMACION'=>$cod_programacion
				)
			));
		#debug($result);exit();
			#debug($this->getLastQuery()); exit();
			return $result;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaAutorizacionClaseByRutNombreId($cod_docente=null, $fecha_desde=null, $fecha_hasta=null, $sede=null) 
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.COD_DOCENTE'=>$cod_docente,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}else{
				$conditions = array(
					'ProgramacionClase.COD_DOCENTE'=>$cod_docente,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}
			// debug($conditions);
			$response = $this->find('all', array(
				'conditions'=>$conditions,
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE'=>$cod_docente
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
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
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
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.SALA',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'Asignatura.NOMBRE',
					'SubEstado.NOMBRE'
				),
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
			 debug($this->getLastQuery()); exit();
			return $response;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaAutorizacionClaseByNombreAsignatura($cod_asignatura_horario=null, $silga_asignatura=null, $fecha_desde=null, $fecha_hasta=null, $sede=null) 
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}else{
				$conditions = array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}
			$clases_asignatura = $this->find('all', array(
				'conditions'=>$conditions,
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA'=>$silga_asignatura
						)
					),
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA'=>$silga_asignatura
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
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
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
					'Detalle.DETALLE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'SubEstado.NOMBRE'
				),
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
			// debug($this->getLastQuery()); exit();
			return $clases_asignatura;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaAutorizacionClaseBySiglaSeccion($sigla_seccion=null, $fecha_desde=null, $fecha_hasta=null, $sede=null) 
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.SIGLA_SECCION'=>$sigla_seccion,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}else{
				$conditions = array(
					'ProgramacionClase.SIGLA_SECCION'=>$sigla_seccion,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}
			$clases_seccion = $this->find('all', array(
				'conditions'=>$conditions,
				'joins'=>array(
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
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
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
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.SALA',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.COD_PROGRAMACION',
					'Detalle.DETALLE',
					'Asignatura.NOMBRE',
					'SubEstado.NOMBRE'
				),
				'order'=>'ProgramacionClase.FECHA_CLASE'
			));
			return $clases_seccion;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaAutorizacionClaseBySubEstado($cod_sub_estado=null, $fecha_desde=null, $fecha_hasta=null, $sede=null)
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta) && !empty($cod_sub_estado)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'=>$cod_sub_estado,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}else{
				if (!empty($cod_sub_estado)) {
					$conditions = array(
						'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'=>$cod_sub_estado,
						'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
						'ProgramacionClase.COD_SEDE'=>$sede
					);
				}
			}
			$clases_sub_estado = $this->find('all', array(
				'conditions'=>$conditions,
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'inner',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
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
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
				),
				'fields'=>array(
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.SALA',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.COD_JORNADA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'Asignatura.NOMBRE',
					'SubEstado.NOMBRE'
				),
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
			return $clases_sub_estado;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaAutorizacionClaseByJornada($cod_jornada=null, $fecha_desde=null, $fecha_hasta=null, $sede=null) 
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.COD_JORNADA'=>$cod_jornada,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}else{
				$conditions = array(
					'ProgramacionClase.COD_JORNADA'=>$cod_jornada,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede
				);
			}
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'SubEstado.NOMBRE'
				),
				'joins'=>array(
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
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
				),
				'order'=>'ProgramacionClase.FECHA_CLASE'
			));
			#debug($this->getLastQuery());			
			return $clases_jornada;
		}

		# -esta es la grilla de autorizar clase-----------------------------------------------------------------------------------------
		public function getDatosTablaAutorizacionClaseNew($fecha_desde=null, $fecha_hasta=null, $sede_id=null,$filtro=null,$filtro_value = null,$ordenar=null) 
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."')";
				$fecha_hasta = "TO_DATE('".$fecha_hasta."')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					$filtro=>$filtro_value,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede_id
				);
			}else{
				$conditions = array(
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede_id
				);
			}
			if (in_array($filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.COD_DOCENTE'] = $filtro_value;
			}elseif (in_array($filtro, array('ProgramacionClase.detalle'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.DETALLE_ID'] = $filtro_value;
			}elseif (in_array($filtro, array('ProgramacionClase.sub_estado'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'] = $filtro_value;
			}elseif (in_array($filtro, array('ProgramacionClase.horario'))) {
				unset($conditions[$filtro]);
				$horas = explode(' - ', $filtro_value);
				$conditions[] = "TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI') = '".$horas[0]."'";
				$conditions[] = "TO_CHAR(ProgramacionClase.HORA_FIN,'HH24:MI') = '".$horas[1]."'";
			}
			if (empty($ordenar)) {
				$ordenar = 'ProgramacionClase.FECHA_CLASE';
			}
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'AsignaturaHorario.TEO_PRA',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'Sala.TIPO_SALA',
					'SalaReemplazo.TIPO_SALA',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'ProgramacionClase.ESTADO_PROGRAMACION_ID = Estado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					)
				),
				'order'=>$ordenar
			));
			#debug($this->getLastQuery());
			return $clases_jornada;
		}

		# ------------------------------------------------------------------------------------------




		# -esta es la grilla de autorizar JUSTIFICADOS-----------------------------------------------------------------------------------------
		public function getDatosTablaAutorizacionJustificados($fecha_desde=null, $fecha_hasta=null, $sede_id=null,$filtro=null,$filtro_value = null,$ordenar=null) 
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."')";
				$fecha_hasta = "TO_DATE('".$fecha_hasta."')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					$filtro=>$filtro_value,
					'ProgramacionClase.TIPO_EVENTO'=>'REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede_id
				);
			}else{
				$conditions = array(
					'ProgramacionClase.TIPO_EVENTO'=>'REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede_id
				);
			}
			if (in_array($filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.COD_DOCENTE'] = $filtro_value;
			}elseif (in_array($filtro, array('ProgramacionClase.detalle'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.DETALLE_ID'] = $filtro_value;
			}elseif (in_array($filtro, array('ProgramacionClase.sub_estado'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'] = $filtro_value;
			}elseif (in_array($filtro, array('ProgramacionClase.horario'))) {
				unset($conditions[$filtro]);
				$horas = explode(' - ', $filtro_value);
				$conditions[] = "TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI') = '".$horas[0]."'";
				$conditions[] = "TO_CHAR(ProgramacionClase.HORA_FIN,'HH24:MI') = '".$horas[1]."'";
			}
			if (empty($ordenar)) {
				$ordenar = 'ProgramacionClase.FECHA_CLASE';
			}
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'AsignaturaHorario.TEO_PRA',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'Sala.TIPO_SALA',
					'SalaReemplazo.TIPO_SALA',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'ProgramacionClase.ESTADO_PROGRAMACION_ID = Estado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'VW_CLASES_JUSTIFICADO',
						'alias'=>'Justificados',
						'conditions'=>array(
							'Justificados.COD_PROGRAMACION = ProgramacionClase.COD_PROGRAMACION'
						)
					)
				),
				'order'=>$ordenar
			));
			#debug($this->getLastQuery());
			#debug($clases_jornada);exit();
			return $clases_jornada;
		}

		# ------------------------------------------------------------------------------------------

		public function getDatosTablaAutorizacionClaseNewMultiple($conditions=array()) 
		{
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'SubEstado.NOMBRE'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
				),
				'order'=>'ProgramacionClase.FECHA_CLASE'
			));
			#debug($this->getLastQuery());
			return $clases_jornada;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaRecuperarClaseNew($fecha_desde=null, $fecha_hasta=null, $sede_id=null,$filtro=null,$filtro_value = null,$ordenar=null) 
		{
			#debug($filtro_value);exit();
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."')";
				$fecha_hasta = "TO_DATE('".$fecha_hasta."')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'Detalle.ID'=>array(3,4,5),
					'ProgramacionClase.COD_SEDE'=>$sede_id
				);
				$conditions['OR']=array('ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'=>'7','ProgramacionClase.WF_ESTADO_ID'=>'5');
			}else{
				$conditions = array(
					'Detalle.ID'=>array(3,4,5),
					'ProgramacionClase.COD_SEDE'=>$sede_id,
				);
				$conditions['OR']=array('ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'=>'7','ProgramacionClase.WF_ESTADO_ID'=>'5');
			}
			if (in_array($filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.COD_DOCENTE'] = $filtro_value;
			}elseif(in_array($filtro, array('Asignatura.NOMBRE',))){
				unset($conditions[$filtro]);
				$conditions['Asignatura.SIGLA'] = $filtro_value;
			}elseif(in_array($filtro, array('ProgramacionClase.detalle',))){
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.DETALLE_ID'] = $filtro_value;
			}elseif(!empty($filtro)){
				$conditions[$filtro] = $filtro_value;
			}
			$clases_jornadas = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'DISTINCT ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.TIPO_EVENTO',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'SubEstado.NOMBRE',
					'Sala.TIPO_SALA',
					'SalaReemplazo.TIPO_SALA',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					)
				),
				'order'=>$ordenar
			));
			#debug($this->getLastQuery());exit();
			return $clases_jornadas;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaRecuperarClaseNewMultiple($conditions=array(),$ordenar=null) 
		{

			#debug($conditions);exit();
			$c = $conditions['ProgramacionClase.SIGLA_SECCION'];
			$pattern = '/\- \([0-9]+\.[0-9]+\)$/m';
			$vehiculo=preg_replace('/( [\s\S]+)/', '', $c);
			#$vehiculo=trim($vehiculo);

			#debug($vehiculo);exit();
			if(isset($conditions['ProgramacionClase.SIGLA_SECCION'])){
				$conditions['ProgramacionClase.SIGLA_SECCION']=$vehiculo;
			}/*else{
				$conditions['ProgramacionClase.SIGLA_SECCION']=null;
			}*/
			$conditions['Detalle.ID']=array(3,4,5);
			$conditions['ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID']=7;
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'DISTINCT ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.TIPO_EVENTO',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'Sala.TIPO_SALA',
					'SubEstado.NOMBRE',
					'SalaReemplazo.TIPO_SALA'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					),
				),
				'order'=>$ordenar,
			));
			#debug($this->getLastQuery());exit();
			return $clases_jornada;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaReforzamientosNew($fecha_desde=null, $fecha_hasta=null, $sede_id=null,$filtro=null,$filtro_value = null,$ordenar=null) 
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."','DD-MM-YYYY')";
				$fecha_hasta = "TO_DATE('".$fecha_hasta."','DD-MM-YYYY')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.DETALLE_ID'=>7,#REFORZAMIENTO
					'ProgramacionClase.COD_SEDE'=>$sede_id
				);
			}else{
				$conditions = array(
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.DETALLE_ID'=>7,#REFORZAMIENTO
					'ProgramacionClase.COD_SEDE'=>$sede_id,
				);
			}
			if (in_array($filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.COD_DOCENTE'] = $filtro_value;
			}elseif(in_array($filtro, array('Asignatura.NOMBRE'))){
				unset($conditions[$filtro]);
				$conditions['Asignatura.SIGLA'] = $filtro_value;
			}elseif(!empty($filtro)){
				$conditions[$filtro] = $filtro_value;
			}
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.TIPO_EVENTO',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'SubEstado.NOMBRE'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
				),
				'order'=>$ordenar
			));
			//debug($this->getLastQuery());exit();
			return $clases_jornada;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaReforzamientosNewMultiple($conditions=array(),$ordenar=null) 
		{
			$conditions['ProgramacionClase.TIPO_EVENTO']='NO REGULAR';
			$conditions['ProgramacionClase.DETALLE_ID']=7;#REFORZAMIENTO
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.TIPO_EVENTO',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Detalle.DETALLE',
					'SubEstado.NOMBRE'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
				),
				'order'=>$ordenar
			));
			return $clases_jornada;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaReprobadosNewMultiple($conditions=array(),$ordenar=null) 
		{
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'AsignaturaHorario.SIGLA',
					'AsignaturaHorario.SIGLA_SECCION',
					'AsignaturaHorario.CLASES_REGISTRADAS',
					'AsignaturaHorario.ASIST_PROMEDIO',
					'AsignaturaHorario.ULTIMO_REGISTRO',
					'AsignaturaHorario.COD_JORNADA',
					'AsignaturaHorario.RI_ENVIADO_A_SAP',
					'Asignatura.NOMBRE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO',
							'AsignaturaHorario.RI_ENABLE = 0',
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'AsignaturaHorario.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
				),
				'order'=>$ordenar
			));	
			#debug($this->getLastQuery());		
			$response = array();
			foreach ($clases_jornada as $key => $value) {
				$response[$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO']]['AsignaturaHorario'] = $value['AsignaturaHorario'];
				$response[$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO']]['Asignatura'] = $value['Asignatura'];
				$response[$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO']]['Docente'] = $value['Docente'];
			}
			return $response;
		}

		# ------------------------------------------------------------------------------------------
		public function getDatosTablaReprobadosNew($sede_id=null,$filtro=null,$filtro_value = null,$ordenar=null) 
		{
			$conditions = array(
				'ProgramacionClase.COD_SEDE'=>$sede_id,
				);
			if (in_array($filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO'))) {
				unset($conditions[$filtro]);
				$conditions['ProgramacionClase.COD_DOCENTE'] = $filtro_value;
			}elseif($filtro == 'Asignatura.NOMBRE'){
				unset($conditions[$filtro]);
				$conditions['Asignatura.SIGLA'] = $filtro_value;
			}elseif($filtro == 'ProgramacionClase.PERIODO'){
				unset($conditions[$filtro]);
				$conditions['AsignaturaHorario.COD_PERIODO'] = $filtro_value;
			}elseif(!empty($filtro)){
				$conditions[$filtro] = $filtro_value;
			}
			#debug($conditions);exit();
			$clases_jornada = $this->find('all', array(
				'conditions'=>$conditions,
				'fields'=>array(
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'AsignaturaHorario.SIGLA',
					'AsignaturaHorario.SIGLA_SECCION',
					'AsignaturaHorario.CLASES_REGISTRADAS',
					'AsignaturaHorario.ASIST_PROMEDIO',
					'AsignaturaHorario.ULTIMO_REGISTRO',
					'AsignaturaHorario.RI_ENVIADO_A_SAP',
					'AsignaturaHorario.COD_JORNADA',
					'AsignaturaHorario.TEO_PRA',
					'Asignatura.NOMBRE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'ProgramacionClase.COD_ASIGNATURA_HORARIO = AsignaturaHorario.COD_ASIGNATURA_HORARIO',
							'AsignaturaHorario.RI_ENABLE = 0',
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'AsignaturaHorario.SIGLA = Asignatura.SIGLA'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'AsignaturaHorario.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
				),
				'order'=>$ordenar
			));	
			#debug($this->getLastQuery());exit();
			$response = array();
			foreach ($clases_jornada as $key => $value) {
				$response[$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO']]['AsignaturaHorario'] = $value['AsignaturaHorario'];
				$response[$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO']]['Asignatura'] = $value['Asignatura'];
				$response[$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO']]['Docente'] = $value['Docente'];
			}
			return $response;
		}

		# ------------------------------------------------------------------------------------------
		public function getInfoFichaDetalle($cod_programacion=null)
		{
			$response=$this->find('first',array(
				'conditions'=>array(
					'ProgramacionClase.COD_PROGRAMACION'=>$cod_programacion
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'ProgramacionClase.COD_DOCENTE = Docente.COD_DOCENTE'
						)
					),
					array(
						'type'=>'left',
						'table'=>'DOCENTES',
						'alias'=>'DocenteReemplazo',
						'conditions'=>array(
							'ProgramacionClase.DOCENTE_REEMPLAZO_ID = DocenteReemplazo.COD_DOCENTE'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'ProgramacionClase.SIGLA = Asignatura.SIGLA'
						)	
					),
					array(
						'type'=>'LEFT',
						'table'=>'MOTIVOS',
						'alias'=>'Motivo',
						'conditions'=>array(
							'ProgramacionClase.MOTIVO_ID = Motivo.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'ProgramacionClase.DETALLE_ID = Detalle.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID = SubEstado.ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'ProgramacionClase.ESTADO_PROGRAMACION_ID = Estado.ID'
						)
					)
				),
				'fields'=>array(
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'Detalle.DETALLE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.CORREO',
					'Docente.DV',
					'Docente.NOMBRE',
					'Docente.COD_DOCENTE',
					'Docente.RUT',
					'DocenteReemplazo.APELLIDO_MAT',
					'DocenteReemplazo.APELLIDO_PAT',
					'DocenteReemplazo.CORREO',
					'DocenteReemplazo.COD_DOCENTE',
					'DocenteReemplazo.DV',
					'DocenteReemplazo.NOMBRE',
					'DocenteReemplazo.RUT',
					'Estado.ID',
					'Estado.NOMBRE',
					'Motivo.MOTIVO',
					'ProgramacionClase.CANTIDAD_MODULOS',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.OBSERVACIONES_REFORZAMIENTO',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.DOCENTE_REEMPLAZO_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.PRESENCIAL',
					'ProgramacionClase.SALA',
					'ProgramacionClase.SALA_REEMPLAZO',
					'ProgramacionClase.SIGLA_SECCION',
					'SubEstado.ID',
					'SubEstado.NOMBRE',
				)	
			));
			#debug($this->getLastQuery()); exit();
			if (!empty($response)) {
				if (!empty($response['ProgramacionClase']['DOCENTE_REEMPLAZO_ID'])) {
					$Docente=new Docente();
					$docente_remplazo=$Docente->find('first',array(
						'conditions'=>array(
							'Docente.COD_DOCENTE'=>$response['ProgramacionClase']['DOCENTE_REEMPLAZO_ID']
						)
					));
					if (!empty($docente_remplazo)) {
						$response['DocenteReemplazo']=$docente_remplazo['Docente'];
					}
				}
			}
			return $response;
		}

		# ------------------------------------------------------------------------------------------
		public function autocompletarByJornada($term=null) 
		{
			$jornadas = array(
				'0'=>array(
					'COD_JORNADA' =>'D'
				),
				'1'=>array(
					'COD_JORNADA' =>'V'
				)
			);
			return empty($term) ? $jornadas : ($term == 'D' ? $jornadas[0] : ($term=='V' ? $jornadas[1] : $jornadas) );
		}

		# ------------------------------------------------------------------------------------------
		public function getAlumnosConTope($cod_programacion=null)
		{
			$alumnos_tope = $this->find('all', array(
				'conditions'=>array(
					'ProgramacionClase.COD_PROGRAMACION'=>$cod_programacion
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ALUMNOS_ASIGNATURAS',
						'alias'=>'AlumnoAsignatura',
						'conditions'=>array(
							'ProgramacionClase.COD_PROGRAMACION = AlumnoAsignatura.COD_PROGRAMACION'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
							'AlumnoAsignatura.ID_ALUMNO = Alumno.ID'
						)
					),
					array(
						'type'=>'inner',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'AlumnoAsignatura.COD_HORARIO_ASIGNATURA = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)
					)		
				),
				'fields'=>array(
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.APELLIDO_MAT',
					'Alumno.CORREO_PERSONAL'
				)
			));
			// debug($this->getLastQuery()); exit();
			return $alumnos_tope;
		}

		# ------------------------------------------------------------------------------------------
		public function getProgramacionByAsistenciaDocente($cod_docente=null,$cod_sede=null,$sigla_seccion=null,$fecha_desde=null,$fecha_hasta=null)
		{
			$conditions['ProgramacionClase.COD_SEDE']=$cod_sede;
			if (!empty($cod_docente)) {
				$conditions['ProgramacionClase.COD_DOCENTE']=$cod_docente;
			}
			if (!empty($sigla_seccion)) {
				$conditions['ProgramacionClase.SIGLA_SECCION']=$sigla_seccion;
			}
			if (!empty($fecha_desde) && empty($fecha_hasta)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$conditions['ProgramacionClase.FECHA_CLASE >=']=$fecha_desde;
			}else if(empty($fecha_desde) && !empty($fecha_hasta)){
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions['ProgramacionClase.FECHA_CLASE <=']=$fecha_hasta;
			}elseif (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions[] = 'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta;
			}
			$result = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Docente.RUT',
					'Docente.DV',
					'Docente.COD_DOCENTE',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
				),
				'conditions'=>$conditions,
				'order'=>'ProgramacionClase.FECHA_CLASE',
			));
			#debug($this->getLastQuery());
			return $result;
		}

		# ------------------------------------------------------------------------------------------
		public function getIdTopeHorario($sigla_seccion=null,$cod_periodo=null,$anho=null,$semestre=null,$cod_alumno=null,$hora_inicio=null,$hora_fin=null,$programacion_id=null)
		{

			$sql = "
				SELECT
					ProgramacionClase. ID
				FROM
					PROGRAMACION_CLASES ProgramacionClase
				WHERE
					SIGLA_SECCION IN(
						SELECT
							SIGLA_SECCION
						FROM
							ALUMNOS_ASIGNATURAS
						WHERE
							ID_ALUMNO = '".$cod_alumno."'
						AND COD_PERIODO = '".$cod_periodo."'
					)
				AND ProgramacionClase.SEMESTRE = '".$semestre."'
				AND ProgramacionClase.ANHO = '".$anho."'
				AND ProgramacionClase.ID != '".$programacion_id."'
				AND (
					ProgramacionClase.HORA_INICIO BETWEEN TO_DATE(
						'".$hora_inicio."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					AND TO_DATE(
						'".$hora_fin."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					OR
					ProgramacionClase.HORA_FIN BETWEEN TO_DATE(
						'".$hora_inicio."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					AND TO_DATE(
						'".$hora_fin."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					
				)
			";

			$result = $this->query($sql);
			return $result;
		}



		public function getIdTopeHorarioDocente($cod_sede=null,$sigla_seccion=null,$cod_periodo=null,$anho=null,$semestre=null,$hora_inicio=null,$hora_fin=null,$programacion_id=null,$fecha=null)
		{

			$sql = "
				SELECT DISTINCT RUT, A.ID, A.RUT, A.USERNAME, A.PERMISO_ID, A.DV, A.CORREO, A.COD_DOCENTE, A.UUID, A.CREATED, A.MODIFIED, A.NOMBRE, A.APELLIDO_PAT, A.APELLIDO_MAT
				FROM
					PROGRAMACION_CLASES ProgramacionClase
				LEFT JOIN DOCENTES A ON ProgramacionClase.COD_DOCENTE = A.COD_DOCENTE
				WHERE 
				    ProgramacionClase.SEMESTRE = '".$semestre."'
				AND ProgramacionClase.ANHO = '".$anho."'
				AND ProgramacionClase.ID != '".$programacion_id."'
				AND ProgramacionClase.COD_SEDE = '".$cod_sede."'
				AND (
					ProgramacionClase.HORA_INICIO BETWEEN TO_DATE(
						'".$hora_inicio."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					AND TO_DATE(
						'".$hora_fin."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					OR
					ProgramacionClase.HORA_FIN BETWEEN TO_DATE(
						'".$hora_inicio."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					AND TO_DATE(
						'".$hora_fin."',
						'YYYY-MM-DD HH24:MI:SS'
					)					
				)
			";
			$sql2 = "
				SELECT 
					ID, RUT, USERNAME, DV, CORREO, NOMBRE, COD_DOCENTE
					FROM
					DOCENTE A
					LEFT JOIN PROGRAMACION_CLASES ProgramacionClase ON A.COD_DOCENTE = ProgramacionClase.COD_DOCENTE
					WHERE 
				    ProgramacionClase.SEMESTRE = '".$semestre."'
				AND ProgramacionClase.ANHO = '".$anho."'
				AND ProgramacionClase.ID != '".$programacion_id."'
				AND ProgramacionClase.COD_SEDE = '".$cod_sede."'
				AND (
					ProgramacionClase.HORA_INICIO BETWEEN TO_DATE(
						'".$hora_inicio."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					AND TO_DATE(
						'".$hora_fin."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					OR
					ProgramacionClase.HORA_FIN BETWEEN TO_DATE(
						'".$hora_inicio."',
						'YYYY-MM-DD HH24:MI:SS'
					)
					AND TO_DATE(
						'".$hora_fin."',
						'YYYY-MM-DD HH24:MI:SS'
					)					
				)
			";
	
			$result = $this->query($sql);
			#debug($this->getLastQuery());
			return $result;
		}
		# ------------------------------------------------------------------------------------------
		public function actualizarEstados($id=null,$estado_id=null,$sub_estado_id=null)
		{
			$sql = "UPDATE PROGRAMACION_CLASES SET ESTADO_PROGRAMACION_ID = '".$estado_id."' , SUB_ESTADO_PROGRAMACION_ID = '".$sub_estado_id."' WHERE ID = '".$id."' ";
			$this->query($sql);
			return true;
		}

		# ------------------------------------------------------------------------------------------
		#REPORTES
		#REPORTE 1 C.D.
		public function getNominaClasesRecuperarAdelantar($fecha_desde=null,$fecha_hasta=null,$cod_docente=null,$nombre_asignatura=null,$order=null)
		{
			$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
			$fecha_hasta = "TO_DATE('".$fecha_hasta."','YYYY-MM-DD')";

			$condiciones = array(
				'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
				'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'=>array('5','8')
				#'ProgramacionClase.COD_SEDE' => $cod_sede
			);
			if(!empty($cod_docente))
				$condiciones['ProgramacionClase.COD_DOCENTE'] = $cod_docente;
			if(!empty($nombre_asignatura))
				$condiciones['Asignatura.NOMBRE'] = $nombre_asignatura;
			if(empty($order))
				$order = 'ProgramacionClase.FECHA_CLASE';
			if ($order == 'ProgramacionClase.HORA_INICIO') {
				$order = "TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI')";
			}
			$clases = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'Sala.TIPO_SALA',
					'SalaReemplazo.TIPO_SALA',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					)
				),
				'conditions'=>$condiciones,
				'order'=>$order,
			));
			#debug($this->getLastQuery());
			return $clases;
		}

		# ------------------------------------------------------------------------------------------
		#REPORTE 2 C.D.
		public function getNominaClasesProgramadas($fecha_desde=null,$cod_docente=null,$nombre_asignatura=null,$order=null)
		{
			$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
			$condiciones = array(
				'ProgramacionClase.FECHA_CLASE = '.$fecha_desde,
			);
			if(!empty($cod_docente))
				$condiciones['ProgramacionClase.COD_DOCENTE'] = $cod_docente;
			if(!empty($nombre_asignatura))
				$condiciones['Asignatura.NOMBRE'] = $nombre_asignatura;
			if(empty($order))
				$order = 'ProgramacionClase.FECHA_CLASE';
			if ($order == 'ProgramacionClase.HORA_INICIO') {
				$order = "TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI')";
			}
			$clases = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'SalaReemplazo.TIPO_SALA',
					'Sala.TIPO_SALA'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					)
				),
				'conditions'=>$condiciones,
				'order'=>$order,
			));
			#debug($this->getLastQuery());
			return $clases;
		}

		# ------------------------------------------------------------------------------------------
		#REPORTE 3 C.D.
		public function getPeriodicoClasesProgramadas($fecha_desde=null,$fecha_hasta=null,$cod_docente=null,$nombre_asignatura=null,$order=null)
		{
			$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
			$fecha_hasta = "TO_DATE('".$fecha_hasta."','YYYY-MM-DD')";
			$condiciones = array(
				'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
				"ProgramacionClase.ESTADO_PROGRAMACION_ID IN ('1','2')",
			);
			if(!empty($cod_docente))
				$condiciones['ProgramacionClase.COD_DOCENTE'] = $cod_docente;
			if(!empty($nombre_asignatura))
				$condiciones['Asignatura.NOMBRE'] = $nombre_asignatura;
			if(empty($order))
				$order = 'ProgramacionClase.FECHA_CLASE';
			if ($order == 'ProgramacionClase.HORA_INICIO') {
				$order = "TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI')";
			}
			$clases = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'SalaReemplazo.TIPO_SALA',
					'Sala.TIPO_SALA'
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO',
						)
					)
				),
				'conditions'=>$condiciones,
				'order'=>$order,
			));
			#debug($this->getLastQuery());exit();
			return $clases;
		}

		# ------------------------------------------------------------------------------------------
		#REPORTE 4 C.D.
		public function getPeriodicoClasesAdelantadasRecuperadas($fecha_desde=null,$fecha_hasta=null,$cod_docente=null,$nombre_asignatura=null,$order=null)
		{
			$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
			$fecha_hasta = "TO_DATE('".$fecha_hasta."','YYYY-MM-DD')";
			$condiciones = array(
				'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
				"ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID IN ('6','9')",
			);
			if(!empty($cod_docente))
				$condiciones['ProgramacionClase.COD_DOCENTE'] = $cod_docente;
			if(!empty($nombre_asignatura))
				$condiciones['Asignatura.NOMBRE'] = $nombre_asignatura;
			if(empty($order))
				$order = 'ProgramacionClase.FECHA_CLASE';
			if ($order == 'ProgramacionClase.HORA_INICIO') {
				$order = "TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI')";
			}
			$clases = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'SalaReemplazo.TIPO_SALA',
					'Sala.TIPO_SALA',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO',
						)
					)
				),
				'conditions'=>$condiciones,
				'order'=>$order,
			));
			#debug($this->getLastQuery());
			return $clases;
		}

		# ------------------------------------------------------------------------------------------
		#REPORTE 5 C.D.
		public function getPresenciaDocente($fecha_desde=null,$fecha_hasta=null,$hora_inicio=null,$hora_fin=null,$cod_docente=null,$order=null)
		{
			$hora_inicio = $fecha_desde.' '.$hora_inicio;
			$hora_fin = $fecha_hasta.' '.$hora_fin;
			$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
			$fecha_hasta = "TO_DATE('".$fecha_hasta."','YYYY-MM-DD')";
			$condiciones = array(
				'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
				"ProgramacionClase.HORA_INICIO >= TO_DATE('".$hora_inicio."','YYYY-MM-DD HH24:MI')",
				"ProgramacionClase.HORA_FIN <= TO_DATE('".$hora_fin."','YYYY-MM-DD HH24:MI')",

			);
			if(!empty($cod_docente))
				$condiciones['ProgramacionClase.COD_DOCENTE'] = $cod_docente;
			if(!empty($nombre_asignatura))
				$condiciones['Asignatura.NOMBRE'] = $nombre_asignatura;
			if(empty($order))
				$order = 'ProgramacionClase.FECHA_CLASE';
			if ($order == 'ProgramacionClase.HORA_INICIO') {
				$order = "TO_CHAR(ProgramacionClase.HORA_INICIO,'HH24:MI') , ProgramacionClase.FECHA_CLASE";
			}
			$clases = $this->find('all',array(
				'fields'=>array(
					'ProgramacionClase.WF_ESTADO_ID',
					'ProgramacionClase.MODALIDAD',
					'ProgramacionClase.TIPO_EVENTO',
					'ProgramacionClase.ID',
					'ProgramacionClase.COD_PROGRAMACION',
					'ProgramacionClase.SIGLA',
					'ProgramacionClase.COD_DOCENTE',
					'ProgramacionClase.HORA_INICIO',
					'ProgramacionClase.HORA_FIN',
					'ProgramacionClase.SALA',
					'ProgramacionClase.DETALLE_ID',
					'ProgramacionClase.ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID',
					'ProgramacionClase.FECHA_CLASE',
					'ProgramacionClase.FECHA_REGISTRO',
					'ProgramacionClase.COD_ASIGNATURA_HORARIO',
					'ProgramacionClase.COD_PLAN',
					'ProgramacionClase.SEMANA_ID',
					'ProgramacionClase.CREATED',
					'ProgramacionClase.MODIFIED',
					'ProgramacionClase.COD_SEDE',
					'ProgramacionClase.SIGLA_SECCION',
					'ProgramacionClase.FECHA_REGISTRAR_ASISTENCIA',
					'ProgramacionClase.FECHA_INICIO_PROGRAMACION',
					'ProgramacionClase.SEMESTRE',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.COD_JORNADA',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Detalle.DETALLE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_MAT',
					'Docente.APELLIDO_PAT',
					'Docente.RUT',
					'Docente.DV',
					'Asignatura.NOMBRE',
					'Sede.NOMBRE',
					'Estado.NOMBRE',
					'SubEstado.NOMBRE',
					'Sala.TIPO_SALA',
					'SalaReemplazo.TIPO_SALA',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'Sala',
						'conditions'=>array(
							'Sala.COD_SALA = ProgramacionClase.SALA'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SALAS',
						'alias'=>'SalaReemplazo',
						'conditions'=>array(
							'SalaReemplazo.ID = ProgramacionClase.SALA_REEMPLAZO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DETALLES',
						'alias'=>'Detalle',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESTADOS',
						'alias'=>'Estado',
						'conditions'=>array(
							'Estado.ID = ProgramacionClase.ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'SUB_ESTADOS',
						'alias'=>'SubEstado',
						'conditions'=>array(
							'SubEstado.ID = ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = ProgramacionClase.SIGLA'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = ProgramacionClase.COD_SEDE'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = ProgramacionClase.COD_DOCENTE'
						)
					)
				),
				'conditions'=>$condiciones,
				'order'=>$order,
			));
			#debug($this->getLastQuery());exit();
			return $clases;
		}


		# ------------------------------------------------------------------------------------------
	}

