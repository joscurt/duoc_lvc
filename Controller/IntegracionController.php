<?php 
	App::uses('HttpSocket', 'Network/Http');
	class IntegracionController extends AppController {

		public $name = 'Integracion';
		public $autoRender = false;

		public function horariosModulos()
		{
	        $this->loadModel('Sede');
	        $this->loadModel('HorarioModulo');
	        $sedes = $this->Sede->getSedesList();
	        $start_8 = array(4,6);
	        $this->HorarioModulo->truncateTable();
	        foreach ($sedes as $key => $sede) {
	        	$cargar_horarios_a_sede = true;
	        	if (in_array($sede['Sede']['COD_SEDE'],$start_8)) {
	        		$horario_start = strtotime('01-01-2010 08:00:00');
	        	}else{
					$horario_start = strtotime('01-01-2010 08:30:00');
	        	}
	        	$horario_start = date("H:i",strtotime('+0 minutes',$horario_start));
        		#debug($new_horario_modulo);
        		#debug($new_horario_modulo['HORA_FIN']);
        		#debug($horario_start)
        		for ($i=19; $i > 0 ; $i--) { 
        			$new_horario_modulo = array(
	        			'COD'=>uniqid(),
	        			'COD_SEDE'=>$sede['Sede']['COD_SEDE'],
	        			'HORA_INICIO'=>$horario_start,
	        			'HORA_FIN'=>date("H:i",strtotime('+45 minutes',strtotime($horario_start))),
	        			'CREATED'=>date('Y-m-d H:i:s'),
	        			'MODIFIED'=>date('Y-m-d H:i:s'),
	        		);
	        		if ($i == 19) {
	        			$new_horario_modulo['HORA_INICIO'] = $horario_start;
	        		}else{
	        			$new_horario_modulo['HORA_INICIO'] = date("H:i",strtotime('+1 minutes',strtotime($horario_start)));
	        		}
	        		$this->HorarioModulo->create();
	        		if ($this->HorarioModulo->save($new_horario_modulo)) {
	        			$horario_start = $new_horario_modulo['HORA_FIN'];
	        		}
        			#debug($horario_start);
        			#$horario_start = date("H:i",strtotime('+45 minutes',strtotime($horario_start)));
        			debug($new_horario_modulo);
        		};
	        }
	        exit('termino');
	    }

	    public function cargarDocentes()
	    {
	    	/*
				; -- DOCENTES
	    	*/
			$this->loadModel('Docente');
			$this->loadModel('Permiso');
			$sql = "
				SELECT
					Funcionario.COD_FUNCIONARIO,
					Funcionario.RUT,
					Funcionario.DV_RUT,
					Funcionario.NOMBRE1,
					Funcionario.APELLIDO_PAT,
					Funcionario.APELLIDO_MAT,
					Funcionario.USERNAME
				FROM 
					LVC_VIEW_FUNCIONARIOS Funcionario 
				WHERE 
					Funcionario.codigo_funcion = '2174'";
			$docentes = $this->Docente->query($sql);
			echo "se encontraron: ". count($docentes);
			$count_exitoso = 0;
			foreach ($docentes as $key => $value) {
				$permiso_exist = $this->Permiso->find('first',array(
					'conditions'=>array(
						'COD_FUNCIONARIO'=>$value['Funcionario']['COD_FUNCIONARIO'],
						'ROL_ID'=>7,
					),
				));
				if (empty($permiso_exist)) {
					$new_permiso = array(
						'COD_FUNCIONARIO'=>$value['Funcionario']['COD_FUNCIONARIO'],
						'COD'=>uniqid(),
						'ROL_ID'=>7,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
						'ACTIVO'=>1,
						'USERNAME'=>$value['Funcionario']['USERNAME'],
					);
					$this->Permiso->create();
					if ($this->Permiso->save($new_permiso)) {
						$permiso_bd = $this->Permiso->findByCod($new_permiso['COD']);
						if (!empty($permiso_bd)) {
							$docente_bd = $this->Docente->findByCodDocente($value['Funcionario']['COD_FUNCIONARIO']);
							if (empty($docente_bd)) {
								$new_docente = array(
									'COD_DOCENTE'=>$value['Funcionario']['COD_FUNCIONARIO'],
									'CORREO'=>strtolower(trim($value['Funcionario']['USERNAME'])).'@profesor.duoc.cl',
									'RUT'=>$value['Funcionario']['RUT'],
									'DV'=>$value['Funcionario']['DV_RUT'],
									'PERMISO_ID'=>$permiso_bd['Permiso']['ID'],
									'UUID'=>uniqid(),
									'NOMBRE'=>$value['Funcionario']['NOMBRE1'],
									'APELLIDO_PAT'=>$value['Funcionario']['APELLIDO_PAT'],
									'APELLIDO_MAT'=>$value['Funcionario']['APELLIDO_MAT'],
									'CREATED'=>date('Y-m-d H:i:s'),
									'MODIFIED'=>date('Y-m-d H:i:s'),
									'USERNAME'=>$value['Funcionario']['USERNAME'],
								);
								$this->Docente->create();
								if ($this->Docente->save($new_docente)) {
									$count_exitoso++;
								}
							}
						}
					}
			
				}
			}
			echo "<br>";
			echo "se crearon correctamente: ".$count_exitoso;
	    }

	    public function cargarDirectores()
	    {
	    	/*
				; -- DIRECTORES
	    	*/
			$this->loadModel('Director');
			$this->loadModel('Permiso');
			$sql = "
				SELECT
					Funcionario.COD_FUNCIONARIO,
					Funcionario.RUT,
					Funcionario.DV_RUT,
					Funcionario.NOMBRE1,
					Funcionario.APELLIDO_PAT,
					Funcionario.APELLIDO_MAT,
					Funcionario.COD_SEDE,
					Funcionario.USERNAME
				FROM 
					LVC_VIEW_FUNCIONARIOS Funcionario 
				WHERE 
					Funcionario.codigo_funcion = '2052'";
			$directores = $this->Director->query($sql);
			echo "se encontraron: ". count($directores);
			$count_exitoso = 0;
			foreach ($directores as $key => $value) {
				$permiso_exist = $this->Permiso->find('first',array(
					'conditions'=>array(
						'COD_FUNCIONARIO'=>$value['Funcionario']['COD_FUNCIONARIO'],
						'ROL_ID'=>11,
					),
				));
				if (empty($permiso_exist)) {
					$new_permiso = array(
						'COD_FUNCIONARIO'=>$value['Funcionario']['COD_FUNCIONARIO'],
						'COD'=>uniqid(),
						'ROL_ID'=>11,
						'COD_SEDE'=>$value['Funcionario']['COD_SEDE'],
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
						'ACTIVO'=>1,
						'USERNAME'=>$value['Funcionario']['USERNAME'],
					);
					$this->Permiso->create();
					if ($this->Permiso->save($new_permiso)) {
						$permiso_bd = $this->Permiso->findByCod($new_permiso['COD']);
						if (!empty($permiso_bd)) {
							$director_bd = $this->Director->findByCod($value['Funcionario']['COD_FUNCIONARIO']);
							if (empty($director_bd)) {
								$new_director = array(
									'COD'=>$value['Funcionario']['COD_FUNCIONARIO'],
									'CORREO'=>strtolower(trim($value['Funcionario']['USERNAME'])).'@duoc.cl',
									'RUT'=>$value['Funcionario']['RUT'].'-'.$value['Funcionario']['DV_RUT'],
									'PERMISO_ID'=>$permiso_bd['Permiso']['ID'],
									'NOMBRES'=>$value['Funcionario']['NOMBRE1'],
									'APELLIDO_PAT'=>$value['Funcionario']['APELLIDO_PAT'],
									'APELLIDO_MAT'=>$value['Funcionario']['APELLIDO_MAT'],
									'USERNAME'=>$value['Funcionario']['USERNAME'],
									'COD_SEDE'=>$value['Funcionario']['COD_SEDE'],
								);
								$this->Director->create();
								if ($this->Director->save($new_director)) {
									$count_exitoso++;
								}
							}
						}
					}
			
				}
			}
			echo "<br>";
			echo "se crearon correctamente: ".$count_exitoso;
	    }

	    public function cargarCoordinadores()
	    {
	    	/*
				; -- C. DOCENTES
	    	*/
			$this->loadModel('CoordinadorDocente');
			$this->loadModel('Permiso');
			$sql = "
				SELECT
					Funcionario.COD_FUNCIONARIO,
					Funcionario.RUT,
					Funcionario.DV_RUT,
					Funcionario.NOMBRE1,
					Funcionario.APELLIDO_PAT,
					Funcionario.APELLIDO_MAT,
					Funcionario.COD_SEDE,
					Funcionario.USERNAME
				FROM 
					LVC_VIEW_FUNCIONARIOS Funcionario 
				WHERE 
					Funcionario.codigo_funcion = '2047'";
			$coordinadores = $this->CoordinadorDocente->query($sql);
			echo "se encontraron: ". count($coordinadores);
			$count_exitoso = 0;
			foreach ($coordinadores as $key => $value) {
				$permiso_exist = $this->Permiso->find('first',array(
					'conditions'=>array(
						'COD_FUNCIONARIO'=>$value['Funcionario']['COD_FUNCIONARIO'],
						'ROL_ID'=>8,
					),
				));
				if (empty($permiso_exist)) {
					$new_permiso = array(
						'COD_FUNCIONARIO'=>$value['Funcionario']['COD_FUNCIONARIO'],
						'COD'=>uniqid(),
						'ROL_ID'=>8,
						'COD_SEDE'=>$value['Funcionario']['COD_SEDE'],
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
						'ACTIVO'=>1,
						'USERNAME'=>$value['Funcionario']['USERNAME'],
					);
					$this->Permiso->create();
					if ($this->Permiso->save($new_permiso)) {
						$permiso_bd = $this->Permiso->findByCod($new_permiso['COD']);
						if (!empty($permiso_bd)) {
							$coordinador_bd = $this->CoordinadorDocente->findByCodFuncionario($value['Funcionario']['COD_FUNCIONARIO']);
							if (empty($coordinador_bd)) {
								$new_coordinador = array(
									'COD_FUNCIONARIO'=>$value['Funcionario']['COD_FUNCIONARIO'],
									'CORREO'=>strtolower(trim($value['Funcionario']['USERNAME'])).'@duoc.cl',
									'RUT'=>$value['Funcionario']['RUT'].'-'.$value['Funcionario']['DV_RUT'],
									'PERMISO_ID'=>$permiso_bd['Permiso']['ID'],
									'NOMBRES'=>$value['Funcionario']['NOMBRE1'],
									'APELLIDO_PAT'=>$value['Funcionario']['APELLIDO_PAT'],
									'APELLIDO_MAT'=>$value['Funcionario']['APELLIDO_MAT'],
									'USERNAME'=>$value['Funcionario']['USERNAME'],
									'COD_SEDE'=>$value['Funcionario']['COD_SEDE'],
								);
								$this->CoordinadorDocente->create();
								if ($this->CoordinadorDocente->save($new_coordinador)) {
									$count_exitoso++;
								}
							}
						}
					}
			
				}
			}
			echo "<br>";
			echo "se crearon correctamente: ".$count_exitoso;
	    }
	}
