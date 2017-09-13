<?php 
	class Motivo extends AppModel {
	
		public  $name = 'Motivo';
		public  $useTable = 'MOTIVOS';

		public function getMotivos()
		{
			return $this->find('all',array('order'=>'MOTIVO'));
		}

		public function getMotivosActivos()
		{
			return $this->find('all',array('conditions'=>array('ACTIVO'=>1),'order'=>'MOTIVO'));
		}

	}