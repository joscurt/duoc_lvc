<?php 
	class RI extends AppModel {
	
		public  $name = 'RI';
		public  $useTable = 'REPROBADO_INASISTENCIA';
		public  $primaryKey = 'ID';
		public function getReprobadoInasistencia($id_alumno=null,$cod_asignatura_horario=null)
		{
			return $this->find('first',array(
				'conditions'=>array(
					'ID_ALUMNO'=>$id_alumno,
					'COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
				)
			));
		}
	}