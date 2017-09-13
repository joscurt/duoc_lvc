<?php 
	class Carrera extends AppModel {
	
		public  $name = 'Carrera';
		public  $useTable = 'LVC_VIEW_PLANES';
		public  $primaryKey = 'COD_PLAN';
		public  $displayField = 'NOMBRE';

		public function getCarrerasByEscuela($cod_escuela=null)
		{
			$conditions = array();
			if (!empty($cod_escuela) && $cod_escuela != 'ALL') {
				$conditions['Carrera.COD_ESCUELA']=$cod_escuela;
			}
			return $this->find('all',array(
				'conditions'=>$conditions,
				'order'=>'Carrera.NOMBRE'
			));
		}
	}