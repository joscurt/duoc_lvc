<?php 
	class Escuela extends AppModel {
	
		public  $name = 'Escuela';
		public  $useTable = 'LVC_VIEW_ESCUELAS';
		public  $primaryKey = 'COD_ESCUELA';
		public  $displayField = 'NOMBRE_ESCUELA';

		public function getEscuelas()
		{
			return $this->find('all',array('order'=>'Escuela.NOMBRE_ESCUELA'));
		}
		public function getEscuelasList()
		{
			return $this->find('list',array('order'=>'Escuela.NOMBRE_ESCUELA'));
		}
	}