<?php 
	class Bitacora extends AppModel {
	
		public  $name = 'Bitacora';
		public  $useTable = 'BITACORAS';
		public 	$primaryKey = 'ID';

		public function getBitacoraClase($cod_programacion=null)
		{
			return $this->find('all',array('conditions'=>array('COD_PROGRAMACION'=>$cod_programacion),'order'=>'CREATED DESC'));
		}
		public function getBitacoraAllClase($cod_asignatura_horario=null)
		{
			return $this->find('all',array(
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
					'ProgramacionClase.SALA_REEMPLAZO',
					'ProgramacionClase.ANHO',
					'ProgramacionClase.FECHA_FINALIZADA_PROGRAMACION',
					'Bitacora.CREATED',
					'Bitacora.COD',
					'Bitacora.DESCRIPCION',
					'Bitacora.COD_DOCENTE',
					'Docente.NOMBRE',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'PROGRAMACION_CLASES',
						'alias'=>'ProgramacionClase',
						'conditions'=>array(
							'Bitacora.COD_PROGRAMACION = ProgramacionClase.COD_PROGRAMACION'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.COD_DOCENTE = Bitacora.COD_DOCENTE'
						)
					),
				),
				'conditions'=>array(
					'ASIGNATURA_HORARIO_COD'=>$cod_asignatura_horario
				),
				'order'=>'Bitacora.CREATED DESC'
			));
		}
		public function countByProgramacionClase($cod_programacion=null)
		{
			return $this->find('count',array('conditions'=>array('COD_PROGRAMACION'=>$cod_programacion)));
		}
	}


	