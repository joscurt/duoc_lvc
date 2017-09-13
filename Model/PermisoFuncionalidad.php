<?php 
	class PermisoFuncionalidad extends AppModel {
	
		public  $name = 'PermisoFuncionalidad';
		public  $useTable = 'PERMISOS_FUNCIONALIDADES';
		public  $primaryKey = 'ID';

		public function getAllForAdministracion()
		{
			$response = $this->find('all');
			$return_final = Array();
			foreach ($response as $value) {
				$return_final[$value['PermisoFuncionalidad']['ROL_ID']][$value['PermisoFuncionalidad']['FUNCIONALIDAD_ID']] = $value;
			}
			return $return_final;
		}
		public function getPermisoByRol($rol_id=null){

			$result = array();
			if (!empty($rol_id)) {
				
				$result= $this->find('all' , array(
					//'contain'=> array(
					'fields' => array(
						'FUNCIONALIDAD_ID',
						'ROL_ID',
						'CREAR',
						'LECTURA',
						'EDITAR',
						'Funcionalidad.ACTIVO',
						'Funcionalidad.NOMBRE'

						),

			'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'FUNCIONALIDADES',
						'alias'=>'Funcionalidad',
						'conditions'=>array(
							'Funcionalidad.ID = PermisoFuncionalidad.FUNCIONALIDAD_ID'
						),
					)
					),


					'conditions'=>array("ROL_ID LIKE" => $rol_id)
				));
				
			}
						return $result;
		}
		public function getPermisoByRol2($rol_id=null){

			$rut_docente = array();
			if (!empty($rol_id)) {
				
				$rut_docente = $this->find('all' , array(
					//'contain'=> array(
					
					'conditions'=>array("ROL_ID LIKE" => $rol_id)
				));
				
			}
			
			return $rut_docente;
		}
		public function getPermisoByRolCount($rol_id=null){

			$rut_docente = array();
			if (!empty($rol_id)) {
				
				$rut_docente = $this->find('count' ,array(

					
					
					'conditions'=>array(
						"PermisoFuncionalidad.ROL_ID LIKE '%".$rol_id."%' "
					)
					,
					'order'=>'PermisoFuncionalidad.ID'
				));
				
			}
			
			return $rut_docente;
		}

	}