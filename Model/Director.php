<?php 
	class Director extends AppModel {
	
		public  $name = 'Director';
		public  $useTable = 'DIRECTORES';

		public function getDirector($cod_director=null)
		{
			return $this->find('first',array('conditions'=>array('COD'=>$cod_director)));
		}
		public function getDirectorConSedeForLogin($username=null)
		{
			$director = $this->find('first',array(
				'fields'=>array(
					'Director.NOMBRES',
					'Director.APELLIDO_PAT',
					'Director.APELLIDO_MAT',
					'Director.CORREO',
					'Director.USERNAME',
					'Director.COD',
					'Sede.NOMBRE',
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
							'Sede.COD_SEDE = Director.COD_SEDE',
						)
					),
					#JLMORANDE AGREGUE JOINS PARA SACAR VISTA_ID
					array(
						'type'=>'INNER',
						'table'=>'PERMISOS',
						'alias'=>'Permiso',
						'conditions'=>array(
							'Permiso.ID = Director.PERMISO_ID',
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
					'Director.USERNAME'=>$username,
				)
			));
			#debug($this->getLastQuery());
			return $director;
		}
		public function getDirectoresBySede($cod_sede=null)
		{
			$directores = $this->find('all',array(
				'fields'=>array(
					'Director.NOMBRES',
					'Director.APELLIDO_PAT',
					'Director.APELLIDO_MAT',
					'Director.CORREO',
					'Director.USERNAME',
					'Director.COD',
					'Sede.NOMBRE',
					'Sede.COD_SEDE',
				),
				'joins'=>array(
					array(
						'type'=>'INNER',
						'table'=>'LVC_VIEW_SEDES',
						'alias'=>'Sede',
						'conditions'=>array(
							'Sede.COD_SEDE = Director.COD_SEDE',
						)
					),
				),
				'conditions'=>array(
					'Sede.COD_SEDE'=>$cod_sede,
				)
			));
			return $directores;
		}
		public function getDirectorAsignatura($sigla_seccion=null)
		{
			return $this->find('first',array('conditions'=>array()));
		}
		public function borrarPorPermisoId($cod_permiso=null)
		{
			$sql = "DELETE FROM DIRECTORES WHERE PERMISO_ID = '".$cod_permiso."'";
			return is_array($this->query($sql));
		}
		
	}