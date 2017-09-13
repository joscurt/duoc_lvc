<?php 
	class MotivoSuspensionClase extends AppModel {
	
		public  $name = 'MotivoSuspensionClase';
		public  $useTable = 'MOTIVOS_SUSPENSION_CLASE';
		public  $primaryKey = 'ID';
		public  $displayField = 'MOTIVO';

		public function getMotivosSuspensionClase()
		{
			return $this->find('all', array('order'=>'MOTIVO'));
		}
		public function getMotivosActivos()
		{
			return $this->find('all',array('conditions'=>array('ACTIVO'=>1),'order'=>'MOTIVO'));
		}
		public function getCountSuspClases()
		{
			$sql = "
					SELECT
						(
							COUNT(*)
						)
					FROM
						MOTIVOS_SUSPENSION_CLASE
			";
			return $this->query($sql);
		}
	}	