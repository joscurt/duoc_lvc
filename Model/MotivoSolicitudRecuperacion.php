<?php 
	class MotivoSolicitudRecuperacion extends AppModel {
	
		public  $name = 'MotivoSolicitudRecuperacion';
		public  $useTable = 'MOTIVOS_ADELANTAR_CLASE';
		public  $primaryKey = 'ID';
		public  $displayField = 'MOTIVO';

		public function getMotivosList()
		{
			return $this->find('list',array('conditions'=>array('ACTIVO'=>1),'order'=>'MOTIVO'));
		}

		public function getMotivosAll()
		{
			return $this->find('all',array('conditions'=>array('ACTIVO'=>1),'order'=>'MOTIVO'));
		}

	}