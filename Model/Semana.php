<?php 
	class Semana extends AppModel {
	
		public  $name = 'Semana';
		public  $useTable = 'SEMANAS';

		public function getSemanasList()
		{
			$result = $this->find('all',array('order'=>'Semana.NUMERO_SEMANA'));
			return $result;
		}
		public function getSemanasAll($anho=null,$semestre=null)
		{
			$result = $this->find('all',array(
				'conditions'=>array('ANHO'=>$anho,'SEMESTRE'=>$semestre),
				'order'=>'Semana.NUMERO_SEMANA'
			));
			return $result;
		}
		public function getSemanasListByPeriodo($anho = null,$semestre = null)
		{
			$result = $this->find('all',array(
				'conditions'=>array(
					'Semana.ANHO'=>$anho,
					'Semana.SEMESTRE'=>$semestre,
				),
				'order'=>'Semana.FECHA_INICIO'
			));
			#debug($this->getLastQuery());
			return $result;
		}
		public function getPrimeraSemanaSemestreActual()
		{
			$sql = "
				SELECT
					Semana.ID,
					Semana.NUMERO_SEMANA,
					Semana.SEMESTRE,
					Semana.ANHO,
					Semana.FECHA_INICIO,
					Semana.FECHA_FIN
				FROM
					SEMANAS Semana
				WHERE
					Semana.ANHO = (
						SELECT
							VALOR
						FROM
							PARAMETROS
						WHERE
							parametro = 'ANHO_ACTUAL'
					)
				AND Semana.SEMESTRE = (
					SELECT
						VALOR
					FROM
						PARAMETROS
					WHERE
						parametro = 'SEMESTRE_ACTUAL'
				) AND ROWNUM = 1 ORDER BY NUMERO_SEMANA 
			";
			$result = $this->query($sql);
			return isset($result[0])? $result[0]:$result;
		}
		public function getSemanaSemestreActualByNumero($numero_semana=null)
		{
			$sql = "
				SELECT
					Semana.ID,
					Semana.NUMERO_SEMANA,
					Semana.SEMESTRE,
					Semana.ANHO,
					Semana.FECHA_INICIO,
					Semana.FECHA_FIN
				FROM
					SEMANAS Semana
				WHERE
					Semana.ANHO = (
						SELECT
							VALOR
						FROM
							PARAMETROS
						WHERE
							parametro = 'ANHO_ACTUAL'
					)
				AND Semana.SEMESTRE = (
					SELECT
						VALOR
					FROM
						PARAMETROS
					WHERE
						parametro = 'SEMESTRE_ACTUAL'
				) AND ROWNUM = 1 AND NUMERO_SEMANA = '".$numero_semana."' 
			";
			$result = $this->query($sql);
			return isset($result[0])? $result[0]:$result;
		}
		public function getSemanaByNumero($anho=null,$semestre=null,$numero_semana=null)
		{
			$sql = "
				SELECT
					Semana.ID,
					Semana.NUMERO_SEMANA,
					Semana.SEMESTRE,
					Semana.ANHO,
					Semana.FECHA_INICIO,
					Semana.FECHA_FIN
				FROM
					SEMANAS Semana
				WHERE
					Semana.ANHO = '".$anho."'
					AND Semana.SEMESTRE = '".$semestre."'
					AND Semana.NUMERO_SEMANA = '".$numero_semana."' 
			";
			$result = $this->query($sql);
			return isset($result[0])? $result[0]:$result;
		}
		public function getSemana($cod_semana=null)
		{
			return $this->find('first',array('conditions'=>array('ID'=>$cod_semana)));
		}
		public function getPrimeraSemanaPeriodo($anho=null,$semestre=null)
		{
			$result = $this->find('first',array(
				'conditions'=>array(
					'Semana.ANHO'=>$anho,
					'Semana.SEMESTRE'=>$semestre,
					'Semana.NUMERO_SEMANA'=>1
				),
			));
			#debug($this->getLastQuery());
			return $result;
		}
		public function deleteAll($anho=null,$semestre=null)
		{
			$sql = "DELETE FROM SEMANAS WHERE ANHO = '".$anho."' AND SEMESTRE = '".$semestre."'";
			return is_array($this->query($sql));
		}

	}