<?php 
	class SubEstado extends AppModel {
	
		public  $name = 'SubEstado';
		public  $useTable = 'SUB_ESTADOS';
		public  $primaryKey = 'ID';

		public function getSubEstadosActivos()
		{
			return $this->find('all',array('conditions'=>array('ACTIVO'=>1),'order'=>'SubEstado.NOMBRE'));
		}
		public function getSubEstados()
		{
			return $this->find('all',array('order'=>'SubEstado.NOMBRE'));
		}
		public function getSubEstadoByCod($cod_sub_estado=null)
		{
			return $this->find('first',array('conditions'=>array('SubEstado.COD'=>$cod_sub_estado)));
		}
		public function getSubEstado($cod_sub_estado=null)
		{
			return $this->findById($cod_sub_estado);
		}
		public function autocompletarSubEstado($term=null) {
			if (!empty($term)) {
				$term = strtoupper($term);
				$sub_estados = $this->find('all',array(
					'fields'=>array(
						'SubEstado.nombre',
						'SubEstado.id'
					),
					'conditions'=>array(
						"SubEstado.nombre LIKE '%".$term."%' ",
						'SubEstado.id<=3'
					),
					'order'=>'SubEstado.nombre'
				));
			}
			return $sub_estados;
		}

		public function autocompletarSubEstadoNew($term=null) {
			if (!empty($term)) {
				$term = strtoupper($term);
				$sub_estados = $this->find('all',array(
					'fields'=>array(
						'SubEstado.nombre',
						'SubEstado.id'
					),
					'conditions'=>array(
						"SubEstado.nombre LIKE '%".$term."%' ",
					),
					'order'=>'SubEstado.nombre'
				));
			}
			return $sub_estados;
		}

	}