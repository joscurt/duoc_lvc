<?php 
	class Sede extends AppModel {
	
		public  $name = 'Sede';
		public  $useTable = 'LVC_VIEW_SEDES';

		public function getSedesList()
		{
			$result = $this->find('all',array('order'=>'Sede.NOMBRE'));
			return $result;
		}

		public function getSedesListFilterByDocente($sedes_ids = array())
		{
			$result = $this->find('all',array(
				'conditions'=>array(
					'Sede.COD_SEDE'=>$sedes_ids,
				),
				'order'=>'Sede.NOMBRE'
			));

			return $result;
		}

	}