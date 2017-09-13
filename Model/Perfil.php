<?php 
	class Perfil extends AppModel {
	
		public  $name = 'Perfil';
		public  $useTable = 'PERFILES';
		public  $primaryKey = 'ID';
		public  $displayField = 'NOMBRE';

		public function getActivosList()
		{
			return $this->find('list',array('conditions'=>array('Perfil.ACTIVO'=>1),'order'=>'NOMBRE'));
		}
		public function getActivosAll()
		{
			return $this->find('all',array('conditions'=>array('Perfil.ACTIVO'=>1),'order'=>'NOMBRE'));
		}

		
	}

	