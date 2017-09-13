<?php 
	class LogEvento extends AppModel {
	
		public  $name = 'LogEvento';
		public  $useTable = 'LOG_EVENTOS';

		public function getLogs($cod_programacion=null)
		{
			$result = $this->find('all',array('conditions'=>array(
				'COD_PROGRAMACION'=>$cod_programacion,
				'ASISTENCIA_DOCENTE !='=>1
			), 'order'=>'CREATED DESC'));
			#debug($this->getLastQuery()); exit(0);
			return $result;
		}
		public function getLogsAsistenciaDocente($cod_programacion=null)
		{
			$result =$this->find('all',array('conditions'=>array(
				'COD_PROGRAMACION'=>$cod_programacion,
				'ASISTENCIA_DOCENTE'=>1
			), 'order'=>'CREATED DESC'));
			#debug($this->getLastQuery()); exit(0);
			return $result;
		}
	}

	