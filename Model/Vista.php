<?php 
	class Vista extends AppModel {
	
		public  $name = 'Vista';
		public  $useTable = 'VISTAS';
		public  $primaryKey = 'ID';
		public  $displayField = 'NOMBRE';

		public function getActivosList()
		{
			return $this->find('list',array('conditions'=>array('Vista.ACTIVO'=>1),'order'=>'NOMBRE'));
		}
	}

	