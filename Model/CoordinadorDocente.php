<?php 
	class CoordinadorDocente extends AppModel {
	
		public  $name = 'CoordinadorDocente';
		public  $useTable = 'COORDINADORES_DOCENTE';
		public  $primaryKey = 'ID';

		public function getCoordinadorConSedeForLogin($username=null)
		{
			$coordinador = $this->find('first',array(
				'fields'=>array(
					'CoordinadorDocente.NOMBRES',
					'CoordinadorDocente.APELLIDO_PAT',
					'CoordinadorDocente.APELLIDO_MAT',
					'CoordinadorDocente.CORREO',
					'CoordinadorDocente.USERNAME',
					'CoordinadorDocente.COD_FUNCIONARIO',
					'CoordinadorDocente.RUT',
					'Sede.NOMBRE',
					'Sede.CODIGO_SAP',
					'Sede.COD_SEDE',
					'Permiso.ROL_ID',
					'Vista.ID',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = CoordinadorDocente.COD_SEDE',
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'PERMISOS',
						'alias'=>'Permiso',
						'conditions'=>array(
							'Permiso.ID = CoordinadorDocente.PERMISO_ID',
							'Permiso.ACTIVO = 1'
						)
					),
					array(
						'type'=>'INNER',
						'table'=>'VISTAS',
						'alias'=>'Vista',
						'conditions'=>array(
							'Vista.ROL_ID = Permiso.ROL_ID',
							
						)
					)
				),
				'conditions'=>array(
					'CoordinadorDocente.USERNAME'=>$username,
				)
			));
			#debug($this->getLastQuery());exit();
			return $coordinador;
		}

		public function getCoordinadorDocente($cod_funcionario=null)
		{
			return $this->find('first',array('conditions'=>array('COD_FUNCIONARIO'=>$cod_funcionario)));
		}
	}