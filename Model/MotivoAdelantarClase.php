<?php 
	class MotivoAdelantarClase extends AppModel {
	
		public  $name = 'MotivoAdelantarClase';
		public  $useTable = 'MOTIVOS_ADELANTAR_CLASE';
		public  $primaryKey = 'ID';
		public  $displayField = 'MOTIVO';

		public function getMotivosList()
		{
			return $this->find('list',array('conditions'=>array('MotivoAdelantarClase.ACTIVO'=>1),'order'=>'MOTIVO'));
		}
		public function getMotivosAdelantarClase()
		{
			return $this->find('all',array('order'=>'MOTIVO'));
		}

	}