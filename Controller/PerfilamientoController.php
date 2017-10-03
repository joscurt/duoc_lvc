<?php 
	class PerfilamientoController extends AppController {

		public $name = 'Perfilamiento';
		public $layout = 'app-backoffice';
		public $plurales = array(
			'Rol'=>'Roles',
			'Vista'=>'Vistas',
			'Funcionalidad'=>'Funcionalidades',
			'Perfil'=>'Perfiles',
		);

		public function index()
		{
		}
		// MANTENEDOR ROLES - VISTAS - FUNCIONALIDADES - PERFILES
		public function getIndex()
		{
			$this->layout = 'ajax';
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			$model = '';
			if (isset($this->data['model'])) {
				$model = $this->data['model'];
			}else{
				exit('error');
			}
			$this->loadModel($model);
			$vistas = array();
			if ($model=='Funcionalidad') {
				$this->loadModel('Vista');
				$vistas = $this->Vista->find('list');
			}
			$this->set(array(
				'objetos'=>$this->{$model}->find('all',array('order'=>array('NOMBRE'))),
				'model'=>$model,
				'vistas'=>$vistas,
				'plurales'=>$this->plurales,
			));
		}
		public function agregarObjeto($model=null)
		{
			if (!empty($this->data)) {
				$mensaje='No ha sido posible almacenar su informaci&oacute;n.';
				$estado='danger';
				$this->autoRender=false; 
				if (!empty($model)) {
					if (in_array($model, array_keys($this->plurales))) {
						$this->loadModel($model);
						$nombre = isset($this->data[$model]['NOMBRE'])?$this->data[$model]['NOMBRE']:null;
						if (!empty($nombre)) {
							$new_obj = array(
								'NOMBRE'=>$nombre,
								'COD'=>uniqid(),
								'ACTIVO'=>0,
								'CREATED'=>date('Y-m-d H:i:s'),
								'MODIFIED'=>date('Y-m-d H:i:s'),
							);
							if ($model=='Funcionalidad') {
								$new_obj['VISTA_ID'] = $this->data[$model]['VISTA_ID'];
							}
							$this->{$model}->create();
							if ($this->{$model}->save($new_obj)) {
								$mensaje='Su informaci&oacute;n se ha almacenado con &eacute;xito.';
								$estado='success';
							}else{
								$mensaje='No se ha podido agregar el nuevo registro.';
							}
						}else{
							$mensaje='Su informaci&oacute;n no se ha almacenado. Intente m&aacute;s tarde.';
						}
					}
				}
				#debug($this->data);
				#debug($model);exit();
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje, 
				));
			}
			$vistas = array();
			if ($model=='Funcionalidad') {
				$this->loadModel('Vista');
				$vistas = $this->Vista->find('list');
			}
			$this->layout = 'ajax';
			$this->set('model',$model);
			$this->set('vistas',$vistas);
		}
		public function editarObjeto($model=null,$cod_obj=null)
		{
			$this->layout = 'ajax';
			if (empty($cod_obj) || empty($model) || (!in_array($model, array_keys($this->plurales)))) {
				exit();
			}
			$this->loadModel($model);
			$objeto = $this->{$model}->findByCod($cod_obj);
			#debug($objeto);
			if (!empty($this->data)) {
				$this->autoRender=false;
				$estado='danger';
				$mensaje='';
				$update = array(
					'ID'=>$objeto[$model]['ID'],
					'NOMBRE'=>$this->data[$model]['NOMBRE'],
					'MODIFIED'=>date('Y-m-d H:i:s'),
				);
				if ($model=='Funcionalidad') {
					$update['VISTA_ID'] = $this->data[$model]['VISTA_ID'];
				}
				if ($this->{$model}->save($update)) {
					$mensaje='Su informaci&oacute;n se ha editado con &eacute;xito.';
					$estado='success';
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}
				echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
			}
			$vistas = array();
			if ($model=='Funcionalidad') {
				$this->loadModel('Vista');
				$vistas = $this->Vista->find('list');
			}
			$this->set(array(
				'model'=>$model,
				'objeto'=>$objeto,
				'vistas'=>$vistas,
			));
		}
		public function desactivarObjeto($model=null,$cod_obj=null,$active=null)
		{
			$this->layout = 'ajax';
			if (empty($cod_obj) || empty($model) || (!in_array($model, array_keys($this->plurales)))) {
				exit();
			}
			$this->loadModel($model);
			$objeto = $this->{$model}->findByCod($cod_obj);
			if (!empty($this->data)) {
				$this->autoRender=false;
				$estado='danger';
				$mensaje='';
				$update = array(
					'ID'=>$objeto[$model]['ID'],
					'ACTIVO'=>$this->data[$model]['ACTIVO'],
					'MODIFIED'=>date('Y-m-d H:i:s'),
				);
				if ($this->{$model}->save($update)) {
					$mensaje='Su informaci&oacute;n se ha editado con &eacute;xito.';
					$estado='success';
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}
				echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
			}
			$this->set(array(
				'model'=>$model,
				'objeto'=>$objeto,
				'active'=>$active,
			));
		}

		public function autocompleteFuncionario($field = null)
		{
			$this->autoRender=false;
			$this->loadModel('Funcionario');
			$funcionarios = $this->Funcionario->getFuncionariosLikeTerm($field,strtoupper($_GET['term']));
			$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','uuid'=>'','data'=>'');
			if (!empty($funcionarios)) {
				$dato_a_mostrar=array();
				foreach ($funcionarios as $key => $value) {
					if($field == 'NOMBRE1'){
						$label = $value['Funcionario']['NOMBRE1'].' '.$value['Funcionario']['APELLIDO_PAT'].' '.$value['Funcionario']['APELLIDO_MAT'];
					}elseif($field == 'RUT'){
						$label = '('.$value['Funcionario']['RUT'].') - '.$value['Funcionario']['NOMBRE1'].' '.$value['Funcionario']['APELLIDO_PAT'].' '.$value['Funcionario']['APELLIDO_MAT'];
					}elseif($field == 'USERNAME'){
						$label = '('.$value['Funcionario']['USERNAME'].') - '.$value['Funcionario']['NOMBRE1'].' '.$value['Funcionario']['APELLIDO_PAT'].' '.$value['Funcionario']['APELLIDO_MAT'];
					}else{
						$label = $value['Funcionario'][$field];
					}
					$dato_a_mostrar[] = array(
						'label'=>$label,
						'uuid'=>$value['Funcionario']['COD_FUNCIONARIO'],
						'obj'=>$value,
					);
				}
			}
			echo json_encode($dato_a_mostrar);
			#exit();
		}

		public function getDataForDataTable($cod_funcionario=null,$activo=null,$rol_id=null) {
			$conversiones_order = array(
                'username' => 'Permiso.USERNAME',
            );
            $conditions = array();
            $cod_funcionario = trim($cod_funcionario);
            $activo = trim($activo);
            $rol_id = trim($rol_id);
            if (!empty($cod_funcionario)) {
            	$conditions['Permiso.COD_FUNCIONARIO'] = $cod_funcionario;
            }
            if (in_array($activo,array('1','0'))) {
            	$conditions['Permiso.ACTIVO'] = $activo;
            }
            if (!empty($rol_id)) {
            	$conditions['Permiso.ROL_ID'] = $rol_id;
            }
            $busqueda = null;
            if(isset($_POST['searchPhrase']) && !empty($_POST['searchPhrase'])){
                $busqueda = trim($_POST['searchPhrase']);
                $busqueda = empty($busqueda) ? null: $busqueda;
            }
            $busqueda = strtoupper($busqueda);
            $this->loadModel('Parametro');
			$numero_rows_por_pagina = $this->Parametro->getValorParametro('NUMERO_ROWS_POR_PAGINA');
			$rowCount = empty($numero_rows_por_pagina)? 100:$numero_rows_por_pagina;
			$current = 1;
			$order = "USERNAME ASC";
			if(isset($_POST['current']) && !empty($_POST['current'])){
				$current = $_POST['current'];
			}
			if(isset($_POST['sort']) && !empty($_POST['sort'])){
				$order_post = $_POST['sort'];
				$campo = array_keys($order_post);
				if(isset($conversiones_order[$campo[0]])){
					$order = $conversiones_order[$campo[0]]. " ".strtoupper($order_post[$campo[0]]);
				}
			}
			$this->autoRender=false;
			$this->loadModel('Permiso');
			$permisos = $this->Permiso->getAll($conditions,$busqueda,$order,$rowCount,$current);
			#debug($this->Permiso->getLastQuery());
			$retorno = array(
			  "current"=> $current,
			  "rowCount"=> $rowCount,
			  "rows"=>array(),
			  "total"=> $this->Permiso->getNroPermisos($conditions,$current,$order)
			);
			$key =0;
			foreach ($permisos as $key => $permiso):				
				$retorno['rows'][] = array(
					"username"=>$permiso[0]['USERNAME'],
					"nombre1"=>utf8_encode($permiso['0']['NOMBRE1'].' '.$permiso['0']['APELLIDO_PAT'].' '.$permiso['0']['APELLIDO_MAT']),
					"rol"=> $permiso['0']['NOMBRE'],
					"estado" => $permiso[0]['ACTIVO']==1?'ACTIVO':'DESACTIVADO',
					"editar"=> $permiso[0]['COD'],
					"activar"=> $permiso[0]['COD'],
				);
			endforeach;
			exit(json_encode($retorno));
		}

		public function asignarPermisos()
		{
			$this->layout = 'ajax';
			$this->loadModel('Permiso');
			$this->loadModel('Rol');
			$this->loadModel('Sede');
			$this->loadModel('Escuela');
			$escuelas=$this->Escuela->getEscuelas();
			$conditions['Permiso.COD_FUNCIONARIO'] = $conditions['Permiso.ACTIVO'] = $conditions['Permiso.ROL_ID'] = " ";
			if (!empty($this->data)) {
				if (isset($this->data['COD_FUNCIONARIO']) && !empty($this->data['COD_FUNCIONARIO'])) {
					$conditions['Permiso.COD_FUNCIONARIO'] = $this->data['COD_FUNCIONARIO'];
				}
				if (isset($this->data['ESTADO']) && !empty($this->data['ESTADO'])) {
					$conditions['Permiso.ACTIVO'] = $this->data['ESTADO']=='activo'?1:0;
				}
				if (isset($this->data['ROL']) && !empty($this->data['ROL'])) {
					$conditions['Permiso.ROL_ID'] = $this->data['ROL'];
				}
			}
			$this->loadModel('Parametro');
			$numero_rows_por_pagina = $this->Parametro->getValorParametro('NUMERO_ROWS_POR_PAGINA');
			$this->set(array(
				'roles'=>$this->Rol->getActivosList(),
				'sedes'=>$this->Sede->getSedesList(),
				'escuelas'=>$escuelas,
				'numero_rows_por_pagina'=>$numero_rows_por_pagina,
				'conditions'=>$conditions,
				#'permisos'=>$this->Permiso->getAll($conditions),
			));
		}

		public function editarPermiso($cod_permiso=null)
		{
			$this->layout = 'ajax';
			if (empty($cod_permiso)) {
				exit();
			}
			$this->loadModel('Permiso');
			$permiso = $this->Permiso->getPermisoByCod($cod_permiso);
			#debug($this->Permiso->getLastQuery());
			#debug($permiso);exit();
			if (empty($permiso)) {
				exit();
			}
			$this->loadModel('Rol');
			$this->loadModel('Sede');
			$this->loadModel('Escuela');
			$escuelas = $this->Escuela->getEscuelas();
			$this->loadModel('Carrera');
			$carreras = $this->Carrera->getCarrerasByEscuela($permiso['Permiso']['COD_ESCUELA']);
			$this->set(array(
				'roles'=>$this->Rol->getActivosList(),
				'sedes'=>$this->Sede->getSedesList(),
				'escuelas'=>$escuelas,
				'permiso'=>$permiso,
				'carreras'=>$carreras
			));
		}

		public function eliminarPermiso($cod_permiso=null)
		{
			$this->layout = 'ajax';
			if (empty($cod_permiso)) {
				exit();
			}
			$this->loadModel('Permiso');
			$permiso = $this->Permiso->getPermisoByCod($cod_permiso);
			#debug($permiso);
			if (empty($permiso)) {
				exit();
			}
			if (!empty($this->data)) {
				$this->autoRender=false;
				$permiso['Permiso']['ACTIVO'] = $permiso['Permiso']['ACTIVO']==1? 0:1;
				$permiso['Permiso']['MODIFIED'] = date('Y-m-d H:i:s');
				if (!$this->Permiso->save($permiso['Permiso'])) {
					$msj = 'Su informaci&oacute;n no se pudo actualizar. Intente m&aacute;s tarde.';
					$status = 'danger';
				}else{
					$msj = 'informaci&oacute;n actualizada con &eacute;xito.';
					$status = 'success';
				}
				echo json_encode(array('status'=>$status,'mensaje'=>$msj));
			}
			$this->set(array(
				'permiso'=>$permiso
			));
		}

		public function savePermiso($cod_permiso = null)
		{
			$this->autoRender = false;
			$status = 'danger';
			$msj = 'Su informaci&oacute;n no se pudo almacenar. Intente m&aacute;s tarde';
			if (!empty($this->data)) {
				#debug($cod_permiso);
				#debug($this->data);#exit();
				if (!empty($this->data['Permiso']['COD_FUNCIONARIO'])) {
					$this->loadModel('Funcionario');
					$funcionario = $this->Funcionario->getFuncionario($this->data['Permiso']['COD_FUNCIONARIO']);
					#debug($funcionario);#exit();
					if (!empty($funcionario)) {
						$this->loadModel('Permiso');
						$permiso_validate = $this->Permiso->getPermisoByCodFuncionarioRol($this->data['Permiso']['COD_FUNCIONARIO'],$this->data['Permiso']['ROL_ID']);
						#debug($permiso_validate);exit();
						if (empty($permiso_validate) || !empty($cod_permiso)) {
							$permiso = $this->data['Permiso'];
							$permiso['COD'] = $uuid = uniqid();
							$permiso['CREATED'] = date('Y-m-d H:i:s');
							$permiso['MODIFIED'] = date('Y-m-d H:i:s');
							$permiso['USERNAME'] = $funcionario['Funcionario']['USERNAME'];
							$permiso['COD_CARRERA'] = $this->data['Carrera']['COD_CARRERA'];
							$permiso['COD_ESCUELA'] = $this->data['Escuela']['COD_ESCUELA'];
							$permiso['COD_FUNCIONARIO'] = $this->data['Permiso']['COD_FUNCIONARIO'];
							if (!empty($cod_permiso)) {
								$permiso_edit = $this->Permiso->getPermisoByCod($cod_permiso);
								if (!empty($permiso_edit)) {
									if ($permiso_edit['Permiso']['ROL_ID'] != $permiso['ROL_ID']) {
										if($this->Permiso->deleteAccessForPermisoID($permiso_edit['Permiso']['ID'])){
											
										};
									}
									$uuid = $permiso_edit['Permiso']['COD'];
									$permiso['ID'] = $permiso_edit['Permiso']['ID'];
									unset($permiso['COD']);
									unset($permiso['CREATED']);
									unset($permiso['USERNAME']);
									unset($permiso['COD_FUNCIONARIO']);
								}
							}
							#debug($permiso);exit();
							if ($this->Permiso->save($permiso)) {
			 					$this->loadModel('Rol');
			 					$permiso_bd = $this->Permiso->findByCod($uuid);
								$rol = $this->Rol->getRolById($permiso['ROL_ID']);
								if (!empty($rol) && !empty($funcionario)) {
									#ACCESO PARA DIRECTOR
									$this->loadModel('Director');
									$director_bd = $this->Director->getDirector($funcionario['Funcionario']['COD_FUNCIONARIO']);
									if ($rol['Rol']['ACCESS_DIRECTOR']  == 1) {
										if (empty($director_bd)) {
											$new_director = array(
												'PERMISO_ID'=>$permiso_bd['Permiso']['ID'],
												'COD'=>$funcionario['Funcionario']['COD_FUNCIONARIO'],
												'NOMBRES'=>$funcionario['Funcionario']['NOMBRE1'],
												'APELLIDO_PAT'=>$funcionario['Funcionario']['APELLIDO_PAT'],
												'APELLIDO_MAT'=>$funcionario['Funcionario']['APELLIDO_MAT'],
												'RUT'=>$funcionario['Funcionario']['RUT'].'-'.$funcionario['Funcionario']['DV_RUT'],
												'CORREO'=>strtolower($funcionario['Funcionario']['USERNAME'].'@duoc.cl'),
												'USERNAME'=>$funcionario['Funcionario']['USERNAME'],
												'COD_SEDE'=>$this->data['Sede']['COD_SEDE'],
											);
											$this->Director->create();
											if($this->Director->save($new_director)){
											};	
										}
									}
									if ($rol['Rol']['ACCESS_COORDINADOR_DOCENTE']  == 1) {
										#REPLICAR ACCESO PARA COORDINADOR_DOCENTE
										$this->loadModel('CoordinadorDocente');
										$coordinador = $this->CoordinadorDocente->getCoordinadorDocente($funcionario['Funcionario']['COD_FUNCIONARIO']);
										if (empty($coordinador)) {
											$new_coordinador_docente = array(
												'PERMISO_ID'=>$permiso_bd['Permiso']['ID'],
												'COD_FUNCIONARIO'=>$funcionario['Funcionario']['COD_FUNCIONARIO'],
												'NOMBRES'=>$funcionario['Funcionario']['NOMBRE1'],
												'APELLIDO_PAT'=>$funcionario['Funcionario']['APELLIDO_PAT'],
												'APELLIDO_MAT'=>$funcionario['Funcionario']['APELLIDO_MAT'],
												'RUT'=>$funcionario['Funcionario']['RUT'].'-'.$funcionario['Funcionario']['DV_RUT'],
												'CORREO'=>strtolower($funcionario['Funcionario']['USERNAME'].'@duoc.cl'),
												'USERNAME'=>$funcionario['Funcionario']['USERNAME'],
												'COD_SEDE'=>$this->data['Sede']['COD_SEDE'],
											);
											$this->CoordinadorDocente->create();
											if($this->CoordinadorDocente->save($new_coordinador_docente)){
											};
										}else{
											$new_coordinador_docente = array(
												'COD_SEDE'=>$this->data['Sede']['COD_SEDE'],
												'ID'=>$coordinador['CoordinadorDocente']['ID'],
											);
											if($this->CoordinadorDocente->save($new_coordinador_docente)){
											};
										}
									}
									if ($rol['Rol']['ACCESS_DOCENTE']  == 1) {
										#REPLICAR ACCESO PARA DOCENTE
										$this->loadModel('Docente');
										$docente = $this->Docente->getDocente($funcionario['Funcionario']['COD_FUNCIONARIO']);
										if (empty($docente)) {
											$new_docente = array(
												'PERMISO_ID'=>$permiso_bd['Permiso']['ID'],
												'COD_DOCENTE'=>$funcionario['Funcionario']['COD_FUNCIONARIO'],
												'NOMBRE'=>$funcionario['Funcionario']['NOMBRE1'],
												'APELLIDO_PAT'=>$funcionario['Funcionario']['APELLIDO_PAT'],
												'APELLIDO_MAT'=>$funcionario['Funcionario']['APELLIDO_MAT'],
												'RUT'=>$funcionario['Funcionario']['RUT'],
												'DV'=>$funcionario['Funcionario']['DV_RUT'],
												'UUID'=>uniqid(),
												'CORREO'=>strtolower($funcionario['Funcionario']['USERNAME'].'@profesor.duoc.cl'),
												'USERNAME'=>$funcionario['Funcionario']['USERNAME'],
												'CREATED'=>date('Y-m-d H:i:s'),
												'MODIFIED'=>date('Y-m-d H:i:s'),
											);
											$this->Docente->create();
											if($this->Docente->save($new_docente)){
											};
										}
									}
									if ($rol['Rol']['ACCESS_BACKOFFICE']  == 1) {
										#REPLICAR ACCESO PARA BACKOFFICE
										$this->loadModel('AccesoBackOffice');
										$acceso_bo = $this->AccesoBackOffice->getFuncionario($funcionario['Funcionario']['COD_FUNCIONARIO']);
										if (empty($acceso_bo)) {
											$new_acceso_backoffice = array(
												'PERMISO_ID'=>$permiso_bd['Permiso']['ID'],
												'COD_FUNCIONARIO'=>$funcionario['Funcionario']['COD_FUNCIONARIO'],
												'NOMBRES'=>$funcionario['Funcionario']['NOMBRE1'],
												'APELLIDOS'=>$funcionario['Funcionario']['APELLIDO_PAT'].' '.$funcionario['Funcionario']['APELLIDO_MAT'],
												'CORREO'=>strtolower($funcionario['Funcionario']['USERNAME'].'@duoc.cl'),
												'USERNAME'=>$funcionario['Funcionario']['USERNAME'],
												'CREATED'=>date('Y-m-d H:i:s'),
												'MODIFIED'=>date('Y-m-d H:i:s'),
												'COD_SEDE'=>$this->data['Sede']['COD_SEDE'],
												'COD_CARRERA'=>$this->data['Carrera']['COD_CARRERA'],
												'COD_ESCUELA'=>$this->data['Escuela']['COD_ESCUELA'],
											);
											$this->AccesoBackOffice->create();
											if($this->AccesoBackOffice->save($new_acceso_backoffice)){
											};	
										}else{
											$update_acceso_backoffice = array(
												'ID'=>$acceso_bo['AccesoBackOffice']['ID'],
												'MODIFIED'=>date('Y-m-d H:i:s'),
												'COD_SEDE'=>$this->data['Sede']['COD_SEDE'],
												'COD_CARRERA'=>$this->data['Carrera']['COD_CARRERA'],
												'COD_ESCUELA'=>$this->data['Escuela']['COD_ESCUELA'],
											);
											if($this->AccesoBackOffice->save($new_acceso_backoffice)){
											};
										}
									}
								}
								$msj = 'Su informaci&oacute;n se ha almacenado con &eacute;xito';
								$status = 'success';
							}
						}else{
							$msj = 'El usuario '.strtoupper($funcionario['Funcionario']['USERNAME']).' ya esta registrado con el rol seleccionado';
						}
					}
				}
			}
			echo json_encode(array('status'=>$status,'mensaje'=>$msj));
		}

		public function getCarrerasByEscuela($cod_escuela=null)
		{
			$this->autoRender = false;
			$this->loadModel('Carrera');
			$carreras = $this->Carrera->getCarrerasByEscuela($cod_escuela);
			echo "<option></option>";
			echo "<option value='ALL'>TODAS</option>";
			foreach ($carreras as $key => $value) {
				echo '<option value="'.$value['Carrera']['COD_PLAN'].'">'.$value['Carrera']['COD_PLAN'].' - '.$value['Carrera']['NOMBRE'].'</option>';
			}
		}

		public function administracion()
		{
			$this->layout = 'ajax';
			$this->loadModel('Vista');
			$this->loadModel('Funcionalidad');
			$this->loadModel('Rol');
			$this->loadModel('Perfil');
			$this->loadModel('PermisoFuncionalidad');
			$this->set(array(
				'vistas' => $this->Vista->getActivosList(),
				'roles' => $this->Rol->getActivosList(),
				'funcionalidades'=>$this->Funcionalidad->getActivos(),
				'perfiles' => $this->Perfil->getActivosAll(),
				'permisos_funcionalidades' => $this->PermisoFuncionalidad->getAllForAdministracion(),
			));
		}
		public function savePerfilPermiso($permiso = null) 
		{
			$this->autoRender = false;
			$status = 'danger';
			$msj = 'No se pudo almacenar su informaci&oacute;n.';
			if (!empty($this->data)) {
				$permiso_funcionalidad = $this->data;
				if (empty($permiso_funcionalidad['ID'])) {
					$permiso_funcionalidad['COD']=uniqid();
					$permiso_funcionalidad['CREATED']=date('Y-m-d H:i:s');
				}

				$permiso_funcionalidad['MODIFIED']=date('Y-m-d H:i:s');
				if (!empty($permiso) && isset($permiso_funcionalidad[$permiso]) && isset($this->data[$permiso])) {
					$permiso_funcionalidad[$permiso] = $this->data[$permiso];
				}
				$this->loadModel('PermisoFuncionalidad');
				#debug($permiso_funcionalidad);
				if ($this->PermisoFuncionalidad->save($permiso_funcionalidad)) {
					$status = 'success';
					$msj = 'Su informaci&oacute;n se ha actualizado con &eacute;xito.';
				}
			}
			echo json_encode(array('status'=>$status,'mensaje'=>$msj));
		}
	}

