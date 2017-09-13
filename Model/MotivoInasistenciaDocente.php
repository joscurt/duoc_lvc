<?php 
	class MotivoInasistenciaDocente extends AppModel {
	
		public  $name = 'MotivoInasistenciaDocente';
		public  $useTable = 'MOTIVOS_INASISTENCIA_DOCENTE';
		public  $primaryKey = 'ID';
		public  $displayField = 'MOTIVO';

		public function getMotivosList()
		{
			return $this->find('list', array('conditions'=>array('activo'=>1),'order'=>'MOTIVO'));
		}
		public function getAllMotivosInasistenciaDocente()
		{
			return $this->find('all', array('order'=>'MOTIVO'));
		}
	}