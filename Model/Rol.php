<?php 
	class Rol extends AppModel {
	
		public  $name = 'Rol';
		public  $useTable = 'ROLES';
		public  $primaryKey = 'ID';
		public  $displayField = 'NOMBRE';
		
		public function getActivosList()
		{
			return $this->find('list',array('conditions'=>array('Rol.ACTIVO'=>1),'order'=>'NOMBRE'));
		}
		public function getRolById($rol_id = null)
		{
			return $this->find('first',array('conditions'=>array('Rol.ID'=>$rol_id)));
		}
	}

