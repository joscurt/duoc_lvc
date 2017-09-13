<?php 
	class Asignatura extends AppModel {
	
		public  $name = 'Asignatura';
		public  $useTable = 'ASIGNATURAS';

		public function autocompletarByNombreAsignatura($term=null) {
			$asignaturas = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$asignaturas = $this->find('all',array(
					'fields'=>array(
						'Asignatura.nombre',
						'Asignatura.sigla',
					),
					'conditions'=>array(
						"Asignatura.nombre LIKE '%".$term."%' "
					),
					'order'=>'Asignatura.nombre'
				));
			}
			return $asignaturas;
		}
	}