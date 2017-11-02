<?php 
	class AlumnoAsignatura extends AppModel {
	
		public  $name = 'AlumnoAsignatura';
		public  $useTable = 'ALUMNOS_ASIGNATURAS';

		public function getRut($cod_asignatura_horario=null,$cod_secc_alumn=null)
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT Alumno.ID',
					'Alumno.RUT',
					'Alumno.DV_RUT',
					'Alumno.COD_ALUMNO',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.APELLIDO_MAT',

				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
							'Alumno.COD_ALUMNO = AlumnoAsignatura.ID_ALUMNO'
						)
					),
					array(
						'type'=>'left',
						'table'=>'REPROBADO_RI_IMPORT',
						'alias'=>'Reprobado',
						'conditions'=>array(
							'Reprobado.RUT = Alumno.RUT'
						)
					),
				),
				'conditions'=>array(
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA'=>$cod_asignatura_horario,
					'AlumnoAsignatura.ID_ALUMNO'=>$cod_secc_alumn,
				),
				'order'=>'Alumno.APELLIDO_PAT'
			));
			return $result;
		}



		public function getListadoAlumnosSeccion($cod_asignatura_horario=null,$cod_sede=null)
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT Alumno.ID',
					'Alumno.RUT',
					'Alumno.DV_RUT',
					'Alumno.COD_ALUMNO',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.APELLIDO_MAT',
					'Carrera.COD_PLAN',
					'Carrera.NOMBRE',
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
							'Alumno.COD_ALUMNO = AlumnoAsignatura.ID_ALUMNO'
						)
					),
					array(
						'type'=>'left',
						'table'=>'LVC_VIEW_PLANES',
						'alias'=>'Carrera',
						'conditions'=>array(
							'AlumnoAsignatura.COD_PLAN = Carrera.COD_PLAN'
						)
					),
				),
				'conditions'=>array(
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA'=>$cod_asignatura_horario,
					'AlumnoAsignatura.ESTADO_ALUMNO' =>1,
					'AlumnoAsignatura.COD_SEDE'=>$cod_sede,

				),
				'order'=>'Alumno.APELLIDO_PAT'
			));
			#debug($this->getLastQuery());die;
			return $result;
		}

		public function getListadoAlumnosSeccionForRI($cod_asignatura_horario=null)
		{
			#debug($cod_asignatura_horario);exit();
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT Alumno.ID',
					'Alumno.RUT',
					'Alumno.DV_RUT',
					'Alumno.COD_ALUMNO',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.APELLIDO_MAT',
					'AlumnoAsignatura.ESTADO_ALUMNO',
					'Carrera.COD_PLAN',
					'Carrera.NOMBRE',
					'RI.ID',
					'RI.R_I',
					'RI.OBSERVACIONES',
					'RI.RI_DIRECTOR',
					'RI.BORRADOR',
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
							'Alumno.COD_ALUMNO = AlumnoAsignatura.ID_ALUMNO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_PLANES',
						'alias'=>'Carrera',
						'conditions'=>array(
							'AlumnoAsignatura.COD_PLAN = Carrera.COD_PLAN'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'REPROBADO_INASISTENCIA',
						'alias'=>'RI',
						'conditions'=>array(
							'Alumno.ID = RI.ID_ALUMNO',
							'AlumnoAsignatura.COD_HORARIO_ASIGNATURA = RI.COD_ASIGNATURA_HORARIO',
						)
					),
				),
				'conditions'=>array(
					#'AlumnoAsignatura.SIGLA_SECCION'=>$cod_asignatura_horario,
					'AlumnoAsignatura.ESTADO_ALUMNO' =>1,
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA'=>$cod_asignatura_horario,

				),
				'order'=>'Alumno.APELLIDO_PAT'
			));
			#debug($this->getLastQuery());exit();
			return $result;
		}
		public function getListadoAsistencia($cod_periodo=null,$cod_sede=null,$cod_asignatura_horario=null)
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT Alumno.RUT',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.COD_ALUMNO',
					'Alumno.APELLIDO_MAT',
					'Alumno.DV_RUT',
					'Alumno.CORREO_PERSONAL',
					'Alumno.ID',
					'Carrera.COD_PLAN',
					'Carrera.NOMBRE',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
						'Alumno.COD_ALUMNO = AlumnoAsignatura.ID_ALUMNO'
						)
					),
					array(
						'type'=>'left',
						'table'=>'LVC_VIEW_PLANES',
						'alias'=>'Carrera',
						'conditions'=>array(
						'AlumnoAsignatura.COD_PLAN = Carrera.COD_PLAN'
						)
					),
				),
				'conditions'=>array(
					#'AlumnoAsignatura.SIGLA_SECCION'=>$sigla_seccion,
					'AlumnoAsignatura.COD_PERIODO'=>$cod_periodo,
					'AlumnoAsignatura.COD_SEDE'=>$cod_sede,
					'AlumnoAsignatura.ESTADO_SAP'=>1,
					'AlumnoAsignatura.ESTADO_ALUMNO' =>1,
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA'=>$cod_asignatura_horario,
				),
				'order'=>'Alumno.APELLIDO_PAT',
			));
			#debug($result);exit();
			#debug($this->getLastQuery());exit();
			return $result;
		}
	public function getListadoAsistenciaReg($cod_periodo=null,$cod_asignatura_horario=null)
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'Alumno.RUT',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.COD_ALUMNO',
					'Alumno.APELLIDO_MAT',
					'Alumno.DV_RUT',
					'Alumno.CORREO_PERSONAL',
					'Alumno.ID',
					'Carrera.COD_PLAN',
					'Carrera.NOMBRE',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
						'Alumno.COD_ALUMNO = AlumnoAsignatura.ID_ALUMNO'
						)
					),
					array(
						'type'=>'left',
						'table'=>'LVC_VIEW_PLANES',
						'alias'=>'Carrera',
						'conditions'=>array(
						'AlumnoAsignatura.COD_PLAN = Carrera.COD_PLAN'
						)
					),
				),
				'conditions'=>array(
					#'AlumnoAsignatura.SIGLA_SECCION'=>$sigla_seccion,
					'AlumnoAsignatura.COD_PERIODO'=>$cod_periodo,
					// 'AlumnoAsignatura.COD_SEDE'=>$cod_sede,
					'AlumnoAsignatura.ESTADO_SAP'=>1,
					'AlumnoAsignatura.ESTADO_ALUMNO' =>1,
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA'=>$cod_asignatura_horario,
				),
				'order'=>'Alumno.APELLIDO_PAT',
			));
			#debug($result);exit();
			#debug($this->getLastQuery());exit();
			return $result;
		}

		public function getListadoAsistenciaJustificado($cod_periodo=null,$cod_sede=null,$cod_asignatura_horario=null,$cod_programacion=null) #Justificados listado
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT Alumno.RUT',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.COD_ALUMNO',
					'Alumno.APELLIDO_MAT',
					'Alumno.DV_RUT',
					'Alumno.CORREO_PERSONAL',
					'Alumno.ID',
					'Carrera.COD_PLAN',
					'Carrera.NOMBRE',
					'Asistencias.ASISTENCIA',
					
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
						'Alumno.COD_ALUMNO = AlumnoAsignatura.ID_ALUMNO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASISTENCIAS',
						'alias'=>'Asistencias',
						'conditions'=>array(
						'AlumnoAsignatura.ID_ALUMNO = Asistencias.ID_ALUMNO'
						)
					),
					array(
						'type'=>'left',
						'table'=>'LVC_VIEW_PLANES',
						'alias'=>'Carrera',
						'conditions'=>array(
						'AlumnoAsignatura.COD_PLAN = Carrera.COD_PLAN'
						)
					),
				),
				'conditions'=>array(
					'AlumnoAsignatura.COD_PERIODO'=>$cod_periodo,
					'AlumnoAsignatura.COD_SEDE'=>$cod_sede,
				
					'AlumnoAsignatura.ESTADO_ALUMNO' =>1,
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA'=>$cod_asignatura_horario,
					'Asistencias.ASISTENCIA' => 2,
					'Asistencias.COD_PROGRAMACION' => $cod_programacion,
					'Asistencias.AUTORIZA_J'=>1,
					
					
				),
				'order'=>'Alumno.APELLIDO_PAT',
			));
			#debug($result);exit();
			#debug($this->getLastQuery());exit();
			return $result;
		}

		public function getFirst($cod_alumno=null,$asignatura_horario=null)
		{
			return $this->find('first',array(
				'conditions'=>array(
					'AlumnoAsignatura.ID_ALUMNO'=>$cod_alumno,
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA'=>$asignatura_horario,
				)
			));
		}

		public function getTasaAsistencia($cod_periodo=null,$cod_alumno =null,$sigla_seccion=null,$ordenar=null)
		{

			$regex = "/([a-zA-Z0-9_]*)/";
    		preg_match_all($regex, $sigla_seccion, $matches);


			$sigla_seccion=preg_replace('/( [\s\S]+)/', '', $sigla_seccion);

			if (empty($ordenar)) {
				$ordenar = 'Alumno.RUT';
			}
			$conditions['AlumnoAsignatura.COD_PERIODO']=$cod_periodo;
			if (!empty($cod_alumno)) {
				$conditions['Alumno.COD_ALUMNO']=$cod_alumno;
			}
			if (!empty($sigla_seccion)) {
				$conditions['AlumnoAsignatura.SIGLA_SECCION']=$sigla_seccion;
			}
				if (!empty($sigla_seccion)) {
				$conditions['AsignaturaHorario.TEO_PRA']=$matches[1][5];
			}
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT Alumno.ID',
					'Alumno.RUT',
					'Alumno.DV_RUT',
					'Alumno.COD_ALUMNO',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.APELLIDO_MAT',
					'Carrera.COD_PLAN',
					'Carrera.NOMBRE',
					'RI.ID',
					'RI.R_I',
					'RI.RI_DIRECTOR',
					'RI.BORRADOR',
					'RI.OBSERVACIONES',
					'RI.RI_DIRECTOR',
					'RI.BORRADOR',
					'Asignatura.NOMBRE',
					'Asignatura.SIGLA',
					'AlumnoAsignatura.SIGLA_SECCION',
					'AlumnoAsignatura.COD_HORARIO_ASIGNATURA',
					'AsignaturaHorario.CLASES_REGISTRADAS',
					'AsignaturaHorario.TEO_PRA',
				),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
							'Alumno.COD_ALUMNO = AlumnoAsignatura.ID_ALUMNO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_PLANES',
						'alias'=>'Carrera',
						'conditions'=>array(
							'AlumnoAsignatura.COD_PLAN = Carrera.COD_PLAN'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS_HORARIOS',
						'alias'=>'AsignaturaHorario',
						'conditions'=>array(
							'AlumnoAsignatura.COD_HORARIO_ASIGNATURA = AsignaturaHorario.COD_ASIGNATURA_HORARIO'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ASIGNATURAS',
						'alias'=>'Asignatura',
						'conditions'=>array(
							'Asignatura.SIGLA = AsignaturaHorario.SIGLA'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'REPROBADO_INASISTENCIA',
						'alias'=>'RI',
						'conditions'=>array(
							'Alumno.ID = RI.ID_ALUMNO',
							'AlumnoAsignatura.COD_HORARIO_ASIGNATURA = RI.COD_ASIGNATURA_HORARIO',
						)
					),
				),
				'conditions'=>$conditions,
				'order'=>$ordenar
			));
			#debug($this->getLastQuery());exit();
			return $result;
		}
	}