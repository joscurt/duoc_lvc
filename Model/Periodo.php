<?php 
	App::uses('Parametro', 'Model');
	class Periodo extends AppModel {
	
		public  $name = 'Periodo';
		public  $useTable = 'PERIODOS';

		public function deleteAll($anho=null)
		{
			$sql = "DELETE FROM PERIODOS WHERE ANHO = '".$anho."'";
			return is_array($this->query($sql));
		}
	    /*
	    |-------------------------------------------------------------------------------------------
	    | @Metodo: getPeriodos.
	    | @return: array
	    | @Descipción: Retorna un arreglo con los periodos filtrados por el año actual.
	    */
		public function getPeriodos()
		{
			$result = $this->find('all', array(
				'conditions'=>array('ANHO'=> date('Y') ),
				'order'=>'Periodo.COD_PERIODO'
			));
			#debug($this->getLastQuery());
			return $result;
		}
		public function getPeriodosByAnho($anho=null)
		{
			$result = $this->find('all',array('conditions'=>array('ANHO'=>$anho),'order'=>'Periodo.COD_PERIODO'));
			return $result;
		}
		public function getPeriodo($cod_periodo=null)
		{
			$result = $this->find('first',array('conditions'=>array('Periodo.COD_PERIODO'=>$cod_periodo)));
			#debug($this->getLastQuery());
			return $result;
		}
		public function getPeriodoByAnhoSemestre($anho=null,$semestre=null)
		{
			return $this->find('first',
				array('conditions'=>array(
					'Periodo.ANHO'=>$anho,
					'Periodo.SEMESTRE'=>$semestre
				)
			));
		}

		public function getPeriodoActual(){
			$obj_parametro = new Parametro();
			$anho = $obj_parametro->getValorParametro('ANHO_ACTUAL');
			$semestre = $obj_parametro->getValorParametro('SEMESTRE_ACTUAL');
			$periodo = $this->getPeriodoByAnhoSemestre($anho,$semestre);
			return $periodo;
		}

		public function autocompletarByPeriodo($term=null) {
			$periodos = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$periodos = $this->find('all',array(
					'fields'=>array(
						'Periodo.semestre',
						'Periodo.anho',
						'Periodo.cod_periodo'
					),
					'conditions'=>array(
						"CONCAT(Periodo.anho,Periodo.semestre) LIKE '%".$term."%' "
					),
					'order'=>array('Periodo.anho','Periodo.semestre')
				));
				#debug($this->getLastQuery());
			}
			return $periodos;
		}
	}