<?php 
	class BoRi extends AppModel {
	
		public  $name = 'BoRi';
		public  $useTable = 'BO_RI';
		public  $primaryKey = 'ID';

		public function getBoRi($cod_bo_ri=null)
		{
			return $this->find('first',array('conditions'=>array('COD'=>$cod_bo_ri)));
		}

		public function getListadoRi($sede = null,$escuela=null,$carrera=null)
		{
			$conditions = array();
			if (!empty($sede)) {
				$conditions['BoRi.COD_SEDE'] = $sede;
			}
			if (!empty($escuela)) {
				$conditions['BoRi.COD_ESCUELA'] = $escuela;
			}
			if (!empty($carrera)) {
				$conditions['BoRi.COD_CARRERA'] = $carrera;
			}
			return $this->find('all',array(
				'fields'=>array(
					'BoRi.PORCENTAJE',
					'BoRi.ACTIVO',
					'BoRi.COD',
					'BoRi.COD_SEDE',
					'BoRi.COD_ESCUELA',
					'BoRi.COD_CARRERA',
					'Sede.NOMBRE',
					'Escuela.NOMBRE_ESCUELA',
					'Carrera.NOMBRE',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = BoRi.COD_SEDE',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'ESCUELAS',
						'alias'=>'Escuela',
						'conditions'=>array(
							'Escuela.COD_ESCUELA = BoRi.COD_ESCUELA',
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_PLANES',
						'alias'=>'Carrera',
						'conditions'=>array(
							'Carrera.COD_PLAN = BoRi.COD_CARRERA',
						)
					)
				),
				'conditions'=>$conditions,
			));
		}
	}