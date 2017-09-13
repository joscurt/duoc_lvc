<?php 
	App::uses('HttpSocket', 'Network/Http');
	class SemanasController extends AppController {

		public $name = 'Semanas';


		public function getSemanasPorPeriodo($periodo_seleccionado_id=null)
		{
			$this->layout= 'ajax';
	        if(empty($periodo_seleccionado_id)){
	        	exit("<error>Error al intentar acceder a los datos, valor vacio.</error>");	
	        }
	        $this->loadModel('Periodo');
	        $periodo = $this->Periodo->findById($periodo_seleccionado_id);
	        if(empty($periodo)){
	        	exit("<error>Error al intentar acceder a los datos, periodo inexistente</error>");
	        }
	        $anho = $periodo['Periodo']['ANHO'];
	        $semestre = $periodo['Periodo']['SEMESTRE'];
	        $semanas = $this->Semana->getSemanasListByPeriodo($anho, $semestre);
	        $this->set('semanas', $semanas);
	    }
	}
