<?php 
	class Parametro extends AppModel {
	
		public  $name = 'Parametro';
		public  $useTable = 'PARAMETROS';

		public function getValorParametro($parametro=null)
		{
			if (empty($parametro)) {
				return null;
			}
			$parametro = $this->find('first',array('conditions'=>array('PARAMETRO'=>strtoupper($parametro))));
			if (empty($parametro)) {
				return null;
			}
			return $parametro['Parametro']['VALOR'];
		}
		
	}