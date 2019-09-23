<?php
	class Asistencia extends AppModel {

		public  $name = 'Asistencia';
		public  $useTable = 'ASISTENCIAS';
		public $primaryKey = 'ID';
		public $p = 0;

		public function getAsistenciaAlumnoEvento($cod_alumno=null,$cod_programacion = Null)
		{
			return $this->find('first',array('conditions'=>array('ID_ALUMNO'=>$cod_alumno,'COD_PROGRAMACION'=>$cod_programacion)));
		}
	}
