<?php 
	class Funcionario extends AppModel {
	
		public  $name = 'Funcionario';
		public  $useTable = 'LVC_VIEW_FUNCIONARIOS';
		public  $primaryKey = 'COD_FUNCIONARIO';
		public  $displayField = 'NOMBRE1';

		public function getFuncionariosLikeTerm($field=null,$term=null)
		{
			if (empty($field) || empty($term)) {
				return array();
			}
			return $this->find('all',array(
				'conditions'=>array(
					"Funcionario.".$field." LIKE '%".$term."%' ",
				),
				'order'=>'Funcionario.'.$field,
			));
		}
		
		public function getFuncionario($cod_funcionario=null)
		{
			return $this->find('first',array('conditions'=>array('Funcionario.COD_FUNCIONARIO'=>$cod_funcionario)));
		}
	}

	