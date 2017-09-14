<?php 
	class SalaHorario extends AppModel {
	
		public  $name = 'Sala';
		public  $useTable = 'SALAS';
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


		public function getSalasHorario($cod_sede=null,$fecha=null,$hora_inicio=null,$hora_fin=null)
		{
			
			#$cod_sede = 6;
			$sql = "

					SELECT
					C.ID,
					C.COD,
					C.SALA,
					C.COD_SEDE
					FROM
					SALAS C
					WHERE
					C.COD_SEDE = '".$cod_sede."'
					AND
					C.COD NOT IN
					(SELECT A.sala FROM vw_salas_programacion A
					WHERE
					A.TIPO_EVENTO = 'REGULAR' AND
					A.FECHA_CLASE = '".$fecha."'
					AND A.COD_SEDE = '".$cod_sede."'
					AND
					('".$hora_inicio."' BETWEEN A.SOLO_HORA_INICIO and A.SOLO_HORA_FIN OR
					'".$hora_fin."' BETWEEN A.SOLO_HORA_INICIO and A.SOLO_HORA_FIN)
					GROUP BY A.SALA)

					";

			$response = $this->query($sql);
			$response_final = array();
			/*foreach ($response as $key => $value)
			{
				$response_final[$value['C']['ID']]['COD'] = $value['COD'];
				$response_final[$value['C']['ID']]['SALA'] = $value['SALA'];
			} */


			#debug($sql);
			#debug($response);exit();
			return $response;
     
  			}
  			
		public function getSalasBySede($cod_sede=null)
		{
			return $this->find('all',array('conditions'=>array('COD_SEDE'=>$cod_sede),'order'=>'TIPO_SALA'));
		}

		public function getSalasDisponible($cod_sede = null,$horario_inicio=null,$horario_fin=null)
		{

			$data = $this->find('all',array('conditions'=>array('COD_SEDE'=>$cod_sede),'order'=>'TIPO_SALA'));
			//debug($x);exit();
			return $data;
		}

		public function getSala($cod_sala=null)
		{
			return $this->find('first',array('conditions'=>array('COD_SALA'=>$cod_sala)));
		}
	}

	