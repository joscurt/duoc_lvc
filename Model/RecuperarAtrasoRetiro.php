<?php 
	class RecuperarAtrasoRetiro extends AppModel {
	
		public  $name = 'RecuperarAtrasoRetiro';
		public  $useTable = 'RECUPERAR_ATRASOS_RETIROS';
		public  $primaryKey = 'ID';
		public  $displayField = 'MOTIVO';

		public function getAllMotivos()
		{
			return $this->find('all',array('order'=>'MOTIVO'));
		}

		public function getMotivosList()
		{
			return $this->find('list',array('conditions'=>array('ACTIVO'=>1),'order'=>'MOTIVO'));
		}

	}