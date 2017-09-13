<?php 
	class MotivosRechazoReforzamiento extends AppModel {
	
		public  $name = 'MotivosRechazoReforzamiento';
		public  $useTable = 'motivos_rechazo_reforzamiento';
		public $primaryKey = 'ID';

		public function getCountReforzamientos()
		{
			$sql = "
					SELECT
						(
							COUNT(*)
						)
					FROM
						MOTIVOS_RECHAZO_REFORZAMIENTO
			";
			return $this->query($sql);
		}
		public function getMotivosRechazo()
		{
			return $this->find('all', array('order'=>'MOTIVO'));
		}
	}