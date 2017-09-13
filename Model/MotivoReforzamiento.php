<?php 
	class MotivoReforzamiento extends AppModel {
	
		public  $name = 'MotivoReforzamiento';
		public  $useTable = 'MOTIVOS_REFORZAMIENTO';
		public $primaryKey = 'ID';

		public function getMotivos()
		{
			return $this->find('all',array('order'=>'MOTIVO'));
		}
		public function getCountReforzamientos()
		{
			$sql = "
					SELECT
						(
							COUNT(*)
						)
					FROM
						MOTIVOS_REFORZAMIENTO
			";
			return $this->query($sql);
		}
		public function getMotivosRechazo()
		{
			return $this->find('all', array('order'=>'MOTIVO'));
		}

		public function getMotivosActivos()
		{
			return $this->find('all', array('conditions'=>array('ACTIVO'=>1),'order'=>'MOTIVO'));
		}
	}