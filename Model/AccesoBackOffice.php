<?php 
	class AccesoBackOffice extends AppModel {
	
		public  $name = 'AccesoBackOffice';
		public  $useTable = 'ACCESOS_BACKOFFICE';
		public  $primaryKey = 'ID';

		public function getFuncionariosLikeTerm($field=null,$term=null)
		{
			if (empty($field) || empty($term)) {
				return array();
			}
			return $this->find('all',array(
				'conditions'=>array(
					"Funcionario.".$field." LIKE '%".$term."%' ",
				),
				'order'=>'Funcionario.'.$field,
			));
		}

		public function getFuncionario($cod_funcionario=null)
		{
			return $this->find('first',array('conditions'=>array('Funcionario.COD_FUNCIONARIO'=>$cod_funcionario)));
		}
		/*public function getAccessFull($username=null)
		{
			$accesos = $this->find('first',
				array(
					'conditions'=>array(
						'AccesoBackOffice.USERNAME'=>$username
					),
					'joins'=>array(
						array(
							'type'=>'INNER',
							'table'=>'PERMISOS',
							'alias'=>'Permiso',
							'conditions'=>array(
								'Permiso.ID = AccesoBackOffice.PERMISO_ID',
								'Permiso.ACTIVO = 1'
							)
						)
					)
				)
			);
			return $accesos;
		}*/
		public function getAccessFull($username=null)
		{
			$accesos = $this->find('first',array(
				'fields'=>array(
					'AccesoBackOffice.NOMBRES',
					'AccesoBackOffice.APELLIDOS',
					'AccesoBackOffice.CORREO',
					'AccesoBackOffice.USERNAME',
					'AccesoBackOffice.COD_FUNCIONARIO',
					'Permiso.ROL_ID',
					'Vista.ID',
				),
				'joins'=>array(
					#JLMORANDE AGREGUE JOINS PARA SACAR VISTA_ID
					array(
						'type'=>'INNER',
						'table'=>'PERMISOS',
						'alias'=>'Permiso',
						'conditions'=>array(
							'Permiso.ID = AccesoBackOffice.PERMISO_ID',
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
					'AccesoBackOffice.USERNAME'=>$username,
				)
			));
			#debug($this->getLastQuery());
			return $accesos;
		}



	}

	