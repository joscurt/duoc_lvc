<?php 
	class HorarioModulo extends AppModel {
	
		public  $name = 'HorarioModulo';
		public  $useTable = 'HORARIOS_MODULOS';
		public  $primaryKey = 'ID';

		public function getHorarios($cod_sede=null)
		{
			return $this->find('all',array(
				'fields'=>array(
					'HorarioModulo.ID',
					'HorarioModulo.HORA_INICIO',
					'HorarioModulo.HORA_FIN',
					'HorarioModulo.COD_SEDE',
				),
				'conditions'=>array(
					'COD_SEDE'=>$cod_sede
				),
				'order'=>'HorarioModulo.HORA_INICIO'));
		}

		public function getSimpleHorarioBySede($cod_sede=null)
		{
			$horarios =  $this->find('all',array('conditions'=>array('COD_SEDE'=>$cod_sede),'order'=>'HorarioModulo.HORA_INICIO'));
			$response = array();
			foreach ($horarios as $key => $value) {
				$response[$key] = array(
					'hora_inicio'=>$value['HorarioModulo']['HORA_INICIO'],
					'hora_fin'=>$value['HorarioModulo']['HORA_FIN'],
				);
			}
			return $response;
		}
		public function truncateTable()
		{
			$sql = "TRUNCATE TABLE HORARIOS_MODULOS";
			$this->query($sql);
		}

	}