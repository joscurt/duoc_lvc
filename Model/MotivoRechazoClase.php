<?php 
	class MotivoRechazoClase extends AppModel {
	
		public  $name = 'MotivoRechazoClase';
		public  $useTable = 'MOTIVOS_RECHAZO_CLASE';
		public  $primaryKey = 'ID';
		public  $displayField = 'MOTIVO';

		public function getMotivosRechazoClase()
		{
			return $this->find('all', array('order'=>'MOTIVO'));
		}
	}	