<?php 
	class Permiso extends AppModel {
	
		public  $name = 'Permiso';
		public  $primaryKey = 'ID';
		public  $useTable = 'PERMISOS';

		public function getAll($conditions=array(),$busqueda=null,$order = null,$rowCount=null,$current=null)
		{
			$condiciones = "";
			if(!empty($busqueda)){
				$condiciones = "
					AND (
						Funcionario.NOMBRE1 LIKE '%".$busqueda."%'
						OR Funcionario.APELLIDO_PAT LIKE '%".$busqueda."%'
						OR Funcionario.APELLIDO_MAT LIKE '%".$busqueda."%'
						OR Funcionario.NOMBRE1 || ' ' || Funcionario.APELLIDO_PAT || ' ' || Funcionario.APELLIDO_MAT LIKE '%".$busqueda."%'
					)
				";
			}
			if (isset($conditions['Permiso.COD_FUNCIONARIO'])) {
				$condiciones .= " AND Permiso.COD_FUNCIONARIO = '".$conditions['Permiso.COD_FUNCIONARIO']."' ";
			}
			if (isset($conditions['Permiso.ROL_ID'])) {
				$condiciones .= " AND Permiso.ROL_ID = '".$conditions['Permiso.ROL_ID']."' ";
			}
			if (isset($conditions['Permiso.ACTIVO'])) {
				$condiciones .= " AND Permiso.ACTIVO = '".$conditions['Permiso.ACTIVO']."' ";
			}
			$query_limit = "
				SELECT
					ACTIVO,
					COD,
					USERNAME,
					NOMBRE1,
					APELLIDO_PAT,
					APELLIDO_MAT,
					NOMBRE
				FROM (
				    SELECT 
				    	rownum rnum, 
				    	Permiso.ACTIVO,
						Permiso.COD,
						Permiso.USERNAME,
				    	Funcionario.NOMBRE1,
						Funcionario.APELLIDO_PAT,
						Funcionario.APELLIDO_MAT,
						Rol.NOMBRE
				    FROM 
				    	(
				    		SELECT
								Permiso.ACTIVO,
								Permiso.COD,
								Permiso.USERNAME,
								Permiso.COD_FUNCIONARIO,
								Permiso.ROL_ID
				    		FROM
				    			permisos Permiso
				    	) Permiso
						LEFT JOIN LVC_VIEW_FUNCIONARIOS Funcionario ON (Funcionario.COD_FUNCIONARIO = Permiso.COD_FUNCIONARIO)
				    	LEFT JOIN ROLES Rol ON (Permiso.ROL_ID = Rol.ID)
				    WHERE 
				    	rownum <=".($current*$rowCount)."
				    	".$condiciones."
				    ORDER BY
				    	".$order."
				)
				WHERE rnum >=".($current==1?$current:($current-1)*$rowCount)."
			";
			#debug($query_limit);
			return $this->query($query_limit);
		}

		public function getNroPermisos($conditions,$current,$order){
			$condiciones = array();
			if(!empty($busqueda)){
				$condiciones = array(
					'OR' => array(
						"Funcionario.NOMBRE1 LIKE '%".$busqueda."%'",
						"Funcionario.USERNAME LIKE '%".$busqueda."%'",
						"Funcionario.APELLIDO_PAT LIKE '%".$busqueda."%'",
						"Funcionario.APELLIDO_MAT LIKE '%".$busqueda."%'",
						"Funcionario.NOMBRE1 || ' ' || Funcionario.APELLIDO_PAT || ' ' || Funcionario.APELLIDO_MAT LIKE '%".$busqueda."%'"
					)
				);	
			}
			if (isset($conditions['Permiso.COD_FUNCIONARIO'])) {
				$condiciones['Permiso.COD_FUNCIONARIO'] =  $conditions['Permiso.COD_FUNCIONARIO'];
			}
			if (isset($conditions['Permiso.ROL_ID'])) {
				$condiciones['Permiso.ROL_ID'] = $conditions['Permiso.ROL_ID'];
			}
			if (isset($conditions['Permiso.ACTIVO'])) {
				$condiciones['Permiso.ACTIVO'] = $conditions['Permiso.ACTIVO'];
			}
			return $this->find('count',array(
				'fields'=>array(
					'Rol.NOMBRE',
					'Permiso.ACTIVO',
					'Permiso.COD',
					'Permiso.USERNAME',
					'Funcionario.NOMBRE1',
					'Funcionario.APELLIDO_PAT',
					'Funcionario.APELLIDO_MAT',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'ROLES',
						'alias'=>'Rol',
						'conditions'=>array(
							'Rol.ID = Permiso.ROL_ID'
						),
					),
					array(
						'type'=>'LEFT',
						'table'=>'LVC_VIEW_FUNCIONARIOS',
						'alias'=>'Funcionario',
						'conditions'=>array(
							'Funcionario.COD_FUNCIONARIO = Permiso.COD_FUNCIONARIO'
						),
					),
				),
				'conditions'=>$condiciones,
			));
		}

		public function getPermisoByCod($cod_permiso=null)
		{
			$result =  $this->find('first',array(
				'fields'=>array(
					'Rol.NOMBRE',
					'Permiso.ACTIVO',
					'Permiso.COD_ESCUELA',
					'Permiso.ID',
					'Permiso.COD_CARRERA',
					'Permiso.COD_FUNCIONARIO',
					'Permiso.COD',
					'Permiso.ROL_ID',
					'Docente.NOMBRE',
					'Docente.RUT',
					'Docente.APELLIDO_PAT',
					'Docente.APELLIDO_MAT',
					'Director.APELLIDO_PAT',
					'Director.RUT',
					'Director.COD_SEDE',
					'Director.USERNAME',
					'Director.APELLIDO_MAT',
					'Director.NOMBRES',
					'Docente.USERNAME',
					'Director.APELLIDO_PAT',
					'CoordinadorDocente.APELLIDO_PAT',
					'CoordinadorDocente.COD_SEDE',
					'CoordinadorDocente.RUT',
					'CoordinadorDocente.APELLIDO_MAT',
					'CoordinadorDocente.NOMBRES',
					'CoordinadorDocente.USERNAME',
					'AccesoBackOffice.APELLIDOS',
					'AccesoBackOffice.COD_SEDE',
					'AccesoBackOffice.RUT',
					'AccesoBackOffice.NOMBRES',
					'AccesoBackOffice.USERNAME',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'ROLES',
						'alias'=>'Rol',
						'conditions'=>array(
							'Rol.ID = Permiso.ROL_ID'
						),
					),
					array(
						'type'=>'LEFT',
						'table'=>'DOCENTES',
						'alias'=>'Docente',
						'conditions'=>array(
							'Docente.PERMISO_ID = Permiso.ID'
						),
					),
					array(
						'type'=>'LEFT',
						'table'=>'DIRECTORES',
						'alias'=>'Director',
						'conditions'=>array(
							'Director.PERMISO_ID = Permiso.ID'
						),
					),
					array(
						'type'=>'LEFT',
						'table'=>'COORDINADORES_DOCENTE',
						'alias'=>'CoordinadorDocente',
						'conditions'=>array(
							'CoordinadorDocente.PERMISO_ID = Permiso.ID'
						),
					),
					array(
						'type'=>'LEFT',
						'table'=>'ACCESOS_BACKOFFICE',
						'alias'=>'AccesoBackOffice',
						'conditions'=>array(
							'AccesoBackOffice.PERMISO_ID = Permiso.ID'
						),
					)
				),
				'conditions'=>array(
					'Permiso.COD'=>$cod_permiso,
				)
			));
			#debug($this->getLastQuery());
			return $result;
		}	

		public function getPermisoByCodFuncionarioRol($cod_funcionario=null,$rol_id=null)
		{
			$result =  $this->find('first',array(
				'conditions'=>array(
					'Permiso.COD_FUNCIONARIO'=>$cod_funcionario,
					'Permiso.ROL_ID'=>$rol_id,
				)
			));
			#debug($this->getLastQuery());
			return $result;
		}			

		public function deleteAccessForPermisoID($permiso_id=null)
		{
			$sql_docente = "DELETE FROM DOCENTES WHERE PERMISO_ID = '".$permiso_id."'";
			$this->query($sql_docente);
			$sql_directores = "DELETE FROM DIRECTORES WHERE PERMISO_ID = '".$permiso_id."'";
			$this->query($sql_directores);
			$sql_c_docente = "DELETE FROM COORDINADORES_DOCENTE WHERE PERMISO_ID = '".$permiso_id."'";
			$this->query($sql_c_docente);
			$sql_accesos_bo = "DELETE FROM ACCESOS_BACKOFFICE WHERE PERMISO_ID = '".$permiso_id."'";
			$this->query($sql_accesos_bo);
			return true;

		}
	}