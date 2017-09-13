<?php 
	class Estado extends AppModel {
	
		public  $name = 'Estado';
		public  $useTable = 'ESTADOS';
		public  $primaryKey = 'ID';

		public function getEstados()
		{
			return $this->find('all',array('conditions'=>array('ACTIVO'=>1),'order'=>'Estado.NOMBRE'));
		}
		public function getEstadosMantenedor()
		{
			return $this->find('all',array('order'=>'Estado.NOMBRE'));
		}
		public function getEstado($cod_estado=null)
		{
			return $this->findById($cod_estado);
		}
		public function getEstadoByCod($cod_estado=null)
		{
			return $this->find('first',array('conditions'=>array('COD'=>$cod_estado)));
		}
		public function autocompletarEstado($term=null) {
			if (!empty($term)) {
				$term = strtoupper($term);
				$estados = $this->find('all',array(
					'fields'=>array(
						'Estado.nombre',
						'Estado.id'
					),
					'conditions'=>array(
						"Estado.nombre LIKE '%".$term."%' ",
					),
					'order'=>'Estado.nombre'
				));
			}
			return $estados;
		}

	}