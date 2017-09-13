<?php 
	class Sala extends AppModel {
	
		public  $name = 'Sala';
		public  $useTable = 'LVC_VIEW_SALAS';
		public  $primaryKey = 'ID';
		public  $displayField = 'TIPO_SALA';

		public function getSalasBySedeCapacidadTipo($cod_sede=null,$capacidad=null,$tipo_sala=null,$sala=null)
		{
			$conditions['COD_SEDE']=$cod_sede;
			if (!empty($capacidad)) {
				$conditions[] = 'CAPACIDAD >= '.$capacidad;
			}
			if (!empty($tipo_sala)) {
				$conditions['TIPO_SALA']=$tipo_sala;
			}
			if (!empty($sala)) {
				$conditions['COD_SALA']=$sala;
			}
			//debug($conditions);exit();
			$salas = $this->find('all',array(
				'conditions'=>$conditions,
				'order'=>'TIPO_SALA'
			));	
			return $salas;
		}
		public function getSalasBySedeList($cod_sede=null)
		{
			$salas = $this->find('list',array('fields'=>array('COD_SALA','TIPO_SALA'),'conditions'=>array('COD_SEDE'=>$cod_sede),'order'=>'TIPO_SALA'));
			#debug($this->getLastQuery());d
			#pr($salas);exit();	
			return $salas;
		}
		public function getSalasReemplazoBySedeList($cod_sede=null)
		{
			$salas = $this->find('list',array('fields'=>array('ID','TIPO_SALA'),'conditions'=>array('COD_SEDE'=>$cod_sede),'order'=>'TIPO_SALA'));
			#debug($this->getLastQuery());
			#pr($salas);exit();
			return $salas;
		}
		public function getSalasBySedeAll($cod_sede=null)
		{
			$data = $this->find('all',array(
				'fields'=>array('COD_SALA', 'TIPO_SALA', 'CAPACIDAD'),
				'conditions'=>array('COD_SEDE'=>$cod_sede),
				'order'=>'CAPACIDAD'
			));
			return $data;
		}


		public function getSalasBySedeByCapacidadAll($cod_sede=null, $capacidad=0)
		{
			$data = $this->find('all', array(
				'conditions'=>array('COD_SEDE'=>$cod_sede,'CAPACIDAD'=>$capacidad),
				'order'=>'CAPACIDAD'
			));
			return $data;
		}

		public function getSalasBySede($cod_sede=null)
		{
			return $this->find('all',array('conditions'=>array('COD_SEDE'=>$cod_sede),'order'=>'TIPO_SALA'));
		}

		public function getSalasDisponible($cod_sede = null,$horario_inicio=null,$horario_fin=null)
		{
			return $this->find('all',array('conditions'=>array('COD_SEDE'=>$cod_sede),'order'=>'TIPO_SALA'));
		}

		public function getSala($cod_sala=null)
		{
			return $this->find('first',array('conditions'=>array('COD_SALA'=>$cod_sala)));
		}
	}

	