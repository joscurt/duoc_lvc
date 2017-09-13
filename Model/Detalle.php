<?php 
	class Detalle extends AppModel {
	
		public $name = 'Detalle';
		public $useTable = 'DETALLES';
		public $primaryKey = 'ID';

		public function getDetalle($cod_detalle=null)
		{
			return $this->findById($cod_detalle);
		}
		public function getDetalleByCod($cod_detalle=null)
		{
			return $this->find('first',array('conditions'=>array('Detalle.COD'=>$cod_detalle)));
		}
		public function getAllDetalles()
		{
			return $this->find('all',array('conditions'=>array('Detalle.activo'=>1),'order'=>'Detalle.DETALLE'));
		}
		public function getAllDetallesBO()
		{
			return $this->find('all',array('order'=>'Detalle.DETALLE'));
		}
		public function getDetalles($term='')
		{
			$detalles = $this->find('all', array(
				'conditions'=>array(
					"Detalle.detalle LIKE '%".$term."%'",
					'Detalle.ACTIVO'=>1,
				),
				'order'=>array('Detalle.DETALLE')
			));
			return $detalles;
		}

		public function getDatosTablaAutorizacionClaseByDetalle($detalle_id=null, $fecha_desde=null, $fecha_hasta=null, $sede=null)
		{
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = 'TO_DATE(\''.$fecha_desde.'\')';
				$fecha_hasta = 'TO_DATE(\''.$fecha_hasta.'\')';
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede,
					'Detalle.ID'=>$detalle_id
				);
			}else{
				$conditions = array(
					'ProgramacionClase.TIPO_EVENTO'=>'NO REGULAR',
					'ProgramacionClase.COD_SEDE'=>$sede,
					'Detalle.ID'=>$detalle_id
				);
			}
			$clases_periodo = $this->find('all', array(
				'conditions'=>$conditions,
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'PROGRAMACION_CLASES',
						'alias'=>'ProgramacionClase',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID'		
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
		public function getDatosTablaReforzamiento()
		{
			$reforzamientos_clase = $this->find('all', array(
				'conditions'=>array(
					'Detalle.ID'=>7
				),
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
						'type'=>'inner',
						'table'=>'PROGRAMACION_CLASES',
						'alias'=>'ProgramacionClase',
						'conditions'=>array(
							'Detalle.ID = ProgramacionClase.DETALLE_ID',
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
			return $reforzamientos_clase;
		}
	}

	