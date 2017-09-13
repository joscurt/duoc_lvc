<?php 
	class Funcionalidad extends AppModel {
	
		public  $name = 'Funcionalidad';
		public  $useTable = 'FUNCIONALIDADES';
		public  $primaryKey = 'ID';
		public  $displayField = 'NOMBRE';

		public function getActivos()
		{
			return $this->find('all',array('conditions'=>array('Funcionalidad.ACTIVO'=>1),'order'=>'NOMBRE'));
		}
		#JLMORANDE consulta para generar el menu
		public function getActivosMenu()
		{
			return $this->find('all',array('conditions'=>array('Funcionalidad.ACTIVO'=>1),'order'=>'ID'));
		}
		public function getActivosList()
		{
			return $this->find('list',array('conditions'=>array('Funcionalidad.ACTIVO'=>1),'order'=>'NOMBRE'));
		}
		public function getNombreFuncionalidadbyId($funcionalidad_id=null){

				//$result = array();


			//debug($funcionalidad_id);exit();
			if (!empty($funcionalidad_id)) {
				
				$result = $this->find('all',array(
					'fields'=>array(
						'Funcionalidad.ID',
						'Funcionalidad.NOMBRE',
						'Funcionalidad.ACTIVO',
						/*'Funcionalidad.VISTA_ID',
						'PermisoFuncionalidad.ROL_ID'*/
						

	
					),
					/*'joins'=>array(
					array(
						'type'=>'left',
						'table'=>'PERMISOS_FUNCIONALIDADES',
						'alias'=>'permiso',
						'conditions'=>array(
							'permiso.FUNCIONALIDAD_ID = 8'
						),
					)
					),*/
					
					'conditions'=>array(
						'Funcionalidad.ID' => $funcionalidad_id
					)
				));
				//debug($result);exit();
			}
			
			return $result;
		}
	}

	