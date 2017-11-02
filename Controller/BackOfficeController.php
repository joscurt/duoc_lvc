<?php 
	class BackOfficeController extends AppController {

		public $name = 'BackOffice';
		public $layout = 'app-backoffice';

		public function index()
		{
			//$a = $this->Session->read('BackOfficeLogueado');
			//debug($a);exit();
		}
		//MANTENEDOR RI
		public function reprobadoInasistencia()
		{
			$this->layout = 'ajax';
			$session_data = $this->Session->read('CoordinadorLogueado');
			$sede = $escuela = $carrera = null;
			if (!empty($this->data)) {
				#debug($this->data);exit();
				if (isset($this->data['sede']) && !empty($this->data['sede'])) {
					$sede = $this->data['sede'];
				}
				if (isset($this->data['escuela']) && !empty($this->data['escuela'])) {
					$escuela = $this->data['escuela'];
				}
				if (isset($this->data['carrera']) && !empty($this->data['carrera'])) {
					$carrera = $this->data['carrera'];
				}
			}
			$this->loadModel('Sede');
			$this->loadModel('Escuela');
			$this->loadModel('Carrera');
			$this->loadModel('BoRi');
			$sedes = $this->Sede->getSedesList();
			$this->set(array(
				'sedes'=>$sedes,
				'escuelas'=>$this->Escuela->getEscuelasList(),
				'carreras'=>$this->Carrera->getCarrerasByEscuela(),
				'reprobados'=>$this->BoRi->getListadoRi($sede,$escuela,$carrera),
			));
			#debug($this->BoRi->getLastQuery());exit();
		}

		public function getCarrerasByEscuela($cod_escuela=null)
		{
			$this->autoRender = false;
			$this->loadModel('Carrera');
			$carreras = $this->Carrera->getCarrerasByEscuela($cod_escuela);
			echo "<option></option>";
			foreach ($carreras as $key => $value) {
				echo '<option value="'.$value['Carrera']['COD_PLAN'].'">'.$value['Carrera']['COD_PLAN'].' - '.$value['Carrera']['NOMBRE'].'</option>';
			}
		}

		public function agregarRi()
		{
			$this->layout = 'ajax';
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			if (!empty($this->data)) {
				$this->autoRender = false;
				$mensaje='No se ha podido almacenar su informaci&oacute;n';
				$estado='danger';
				#debug($this->data);exit();
				$new_ri = array(
					'COD'=>uniqid(),
					'COD_SEDE'=>$this->data['sede'],
					'COD_ESCUELA'=>$this->data['escuela'],
					'COD_CARRERA'=>$this->data['carrera'],
					'PORCENTAJE'=>$this->data['porcentaje'],
					'ACTIVO'=>1,
					'CREATED'=>date('Y-m-d H:i:s'),
					'MODIFIED'=>date('Y-m-d H:i:s'),
				);
				$this->loadModel('BoRi');
				if($this->BoRi->save($new_ri)){
					$mensaje='Su informaci&oacute;n se ha almacenado con &eacute;xito.';
					$estado='success';
				}
				echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
			}
			$this->loadModel('Sede');
			$this->loadModel('Escuela');
			$this->loadModel('Carrera');
			$this->set(array(
				'sedes'=>$this->Sede->getSedesList(),
				'escuelas'=>$this->Escuela->getEscuelasList(),
				'carreras'=>$this->Carrera->getCarrerasByEscuela(),
			));
		}
		public function editarRi($cod_bo_ri=null)
		{
			$this->layout = 'ajax';
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			$this->loadModel('BoRi');
			$bo_ri = $this->BoRi->getBoRi($cod_bo_ri);
			if (empty($bo_ri)) {
				exit();
			}
			if (!empty($this->data)) {
				$this->autoRender = false;
				$mensaje='No se ha podido almacenar su informaci&oacute;n';
				$estado='danger';
				#debug($this->data);exit();
				$new_ri = array(
					'ID'=>$bo_ri['BoRi']['ID'],
					'COD_SEDE'=>$this->data['sede'],
					'COD_ESCUELA'=>$this->data['escuela'],
					'COD_CARRERA'=>$this->data['carrera'],
					'PORCENTAJE'=>$this->data['porcentaje'],
					'MODIFIED'=>date('Y-m-d H:i:s'),
				);
				if($this->BoRi->save($new_ri)){
					$mensaje='Su informaci&oacute;n se ha almacenado con &eacute;xito.';
					$estado='success';
				}
				echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
			}
			$this->loadModel('Sede');
			$this->loadModel('Escuela');
			$this->loadModel('Carrera');
			$this->set(array(
				'sedes'=>$this->Sede->getSedesList(),
				'escuelas'=>$this->Escuela->getEscuelasList(),
				'carreras'=>$this->Carrera->getCarrerasByEscuela($bo_ri['BoRi']['COD_ESCUELA']),
				'bo_ri'=>$bo_ri
			));
		}
		public function desactivarBoRi($cod_bo_ri=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_bo_ri)) {
				$this->loadModel('BoRi');
				$bo_ri = $this->BoRi->getBoRi($cod_bo_ri);
				$this->set('bo_ri', $bo_ri);
				$this->set('active', $active);
			}
		}
		public function desactivarBoRiSave()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='Ha ocurrido un error inesperado. Intente m&aacute;s tarde.';
			$active='';
			$estado_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('BoRi');
				$bo_ri = $this->BoRi->getBoRi($this->data['BoRi']['COD']);
				if (!empty($bo_ri)) {
					$activo = 0;
					if ($this->data['BoRi']['ACTIVO'] == 'active') {
						$activo = 1;
					}
					$desactivar_bo_ri = array(
						'ID'=>$bo_ri['BoRi']['ID'],
						'ACTIVO'=>$activo
					);
					$this->BoRi->create(FALSE);
					if ($this->BoRi->save($desactivar_bo_ri)) {
						if ($activo == 1) {
							$mensaje = 'Su informaci&oacute;n se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su informaci&oacute;n se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el registro que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el registro que se quiere modificar.';
			}
			$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}


		// MANTENEDOR SUB-ESTADOS
		public function getMantenedorSubEstado()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('SubEstado');
				$sub_estados = $this->SubEstado->getSubEstados();
				$this->set('sub_estados', $sub_estados);
			}
		}
		public function agregarSubEstado()
		{
			if (!empty($this->data)) {
				#exit('hola');
				$mensaje='';
				$estado='danger';
				$this->autoRender=false; 
				$sub_estado_form = isset($this->data['SubEstado']['NOMBRE'])?$this->data['SubEstado']['NOMBRE']:null;
				if (!empty($sub_estado_form)) {
					$nuevo_sub_estado = array(
						'NOMBRE'=>strtoupper($sub_estado_form),
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					#debug($nuevo_sub_estado);
					$this->loadModel('SubEstado');
					$this->SubEstado->create();
					if ($this->SubEstado->save($nuevo_sub_estado)) {
						$mensaje='Su informaci&oacute;n se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo sub estado.';
					}
				}else{
					$mensaje='Su informaci&oacute;n no se ha almacenado. Intente m&aacute;s tarde.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje, 
				));
			}
			$this->layout = 'ajax';
		}
		public function editarMantenedorSubEstado($cod_sub_estado=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_sub_estado)) {
				$this->loadModel('SubEstado');
				$sub_estado_bd = $this->SubEstado->getSubEstadoByCod($cod_sub_estado);
				$this->set('sub_estado_bd', $sub_estado_bd);
			}else{
				exit();
			}
		}
		public function editarSubEstado()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$sub_estado_editado=array();
			if (!empty($this->data)) {
				$sub_estado_id = $this->data['SubEstado']['ID'];
				if (!empty($sub_estado_id)) {
					$update_sub_estado = array(
						'ID'=>$sub_estado_id,
						'NOMBRE'=>$this->data['SubEstado']['NOMBRE'],
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('SubEstado');
					$this->SubEstado->create(FALSE);
					if ($this->SubEstado->save($update_sub_estado)) {
						$mensaje='El sub-estado se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el sub-estado que se quiere editar.';
			}
			echo json_encode(array(
				'status'=>$estado,
				'mensaje'=>$mensaje
			));
		}
		public function desactivarMantenedorSubEstado($cod_sub_estado=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_sub_estado)) {
				$this->loadModel('SubEstado');
				$sub_estado_bd = $this->SubEstado->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_sub_estado
					)
				));
				$this->set('sub_estado_bd', $sub_estado_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarSubEstado()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$sub_estado_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('SubEstado');
				$sub_estado_a_desactivar = $this->SubEstado->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['SubEstado']['COD']
					)
				));
				if (!empty($sub_estado_a_desactivar)) {
					$activo = array();
					if ($this->data['SubEstado']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_sub_estado = array(
						'ID'=>$sub_estado_a_desactivar['SubEstado']['ID'],
						'NOMBRE'=>$sub_estado_a_desactivar['SubEstado']['NOMBRE'],
						'COD'=>$sub_estado_a_desactivar['SubEstado']['COD'],
						'ACTIVO'=>$activo
					);
					$this->SubEstado->create(FALSE);
					if ($this->SubEstado->save($desactivar_sub_estado)) {
						$sub_estado_bd_desactivado = $this->SubEstado->find('first',array('conditions'=>array('COD'=>$sub_estado_a_desactivar['SubEstado']['COD'])));
						if (!empty($sub_estado_bd_desactivado)) {
							$tmp_sub_estado=$sub_estado_bd_desactivado['SubEstado'];
						}
						if ($tmp_sub_estado['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_sub_estado'=>$tmp_sub_estado,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// RECUPERAR ATRASOS Y RETIROS
		public function getRecuperarAtrasoRetiro()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('RecuperarAtrasoRetiro');
				$motivos_bd = $this->RecuperarAtrasoRetiro->getAllMotivos();
				$this->set('motivos_bd', $motivos_bd);
			}
		}
		public function agregarMotivoRecuperarAtrasoRetiro()
		{
			if (!empty($this->data)) {
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$motivo_form = $this->data['RecuperarAtrasoRetiro']['MOTIVO'];
				if (!empty($motivo_form)) {
					$nuevo_motivo = array(
						'MOTIVO'=>$motivo_form,
						'COD'=>uniqid(),
						'ACTIVO'=>1,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('RecuperarAtrasoRetiro');
					$this->RecuperarAtrasoRetiro->create();
					if ($this->RecuperarAtrasoRetiro->save($nuevo_motivo)) {
						$motivo_bd = $this->RecuperarAtrasoRetiro->find('first',array('conditions'=>array('COD'=>$nuevo_motivo['COD'])));
						$cantidad_de_motivos = $this->RecuperarAtrasoRetiro->find('count');
						if (!empty($motivo_bd)) {
							$tmp_motivo=$motivo_bd['RecuperarAtrasoRetiro'];
						}
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje, 
				));
			}
			$this->layout = 'ajax';
		}
		public function editarMotivoRecuperarAtrasoRetiro($cod_motivo=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_motivo)) {
				$this->loadModel('RecuperarAtrasoRetiro');
				$motivo_bd = $this->RecuperarAtrasoRetiro->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_motivo
					)
				));
				$this->set('motivo_bd', $motivo_bd);
			}else{
				exit();
			}
		}
		public function editarRecuperarAtrasoRetiro()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$motivo_editado=array();
			if (!empty($this->data)) {
				$motivo_id = $this->data['RecuperarAtrasoRetiro']['ID'];
				if (!empty($motivo_id)) {
					$update_motivo = array(
						'ID'=>$motivo_id,
						'MOTIVO'=>$this->data['RecuperarAtrasoRetiro']['MOTIVO']
					);
					$this->loadModel('RecuperarAtrasoRetiro');
					$this->RecuperarAtrasoRetiro->create(FALSE);
					if ($this->RecuperarAtrasoRetiro->save($update_motivo)) {
						$motivo_editado=$this->RecuperarAtrasoRetiro->find('first',array('conditions'=>array('ID'=>$update_motivo['ID'])));
						$mensaje='El estado se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere editar.';
			}
			$_json=json_encode(array('motivo_editado'=>$motivo_editado,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;
		}
		public function desactivarMotivoRecuperarAtrasoRetiro($cod_motivo=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_motivo)) {
				$this->loadModel('RecuperarAtrasoRetiro');
				$motivo_bd = $this->RecuperarAtrasoRetiro->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_motivo
					)
				));
				$this->set('motivo_bd', $motivo_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarRecuperarAtrasoRetiro()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$motivo_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('RecuperarAtrasoRetiro');
				$motivo_a_desactivar = $this->RecuperarAtrasoRetiro->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['RecuperarAtrasoRetiro']['COD']
					)
				));
				if (!empty($motivo_a_desactivar)) {
					$activo = array();
					if ($this->data['RecuperarAtrasoRetiro']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_motivo = array(
						'ID'=>$motivo_a_desactivar['RecuperarAtrasoRetiro']['ID'],
						'MOTIVO'=>$motivo_a_desactivar['RecuperarAtrasoRetiro']['MOTIVO'],
						'COD'=>$motivo_a_desactivar['RecuperarAtrasoRetiro']['COD'],
						'ACTIVO'=>$activo
					);
					$this->RecuperarAtrasoRetiro->create(FALSE);
					if ($this->RecuperarAtrasoRetiro->save($desactivar_motivo)) {
						$motivo_bd_desactivado = $this->RecuperarAtrasoRetiro->find('first',array('conditions'=>array('COD'=>$motivo_a_desactivar['RecuperarAtrasoRetiro']['COD'])));
						if (!empty($motivo_bd_desactivado)) {
							$tmp_motivo=$motivo_bd_desactivado['RecuperarAtrasoRetiro'];
						}
						if ($tmp_motivo['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_motivo'=>$tmp_motivo,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// MANTENEDOR ESTADOS
		public function getMantenedorEstado()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('Estado');
				$estados = $this->Estado->getEstadosMantenedor();
				$this->set('estados', $estados);
			}
		}
		public function agregarEstado()
		{
			$tmp_estado = $cantidad_de_motivos = array();
			$mensaje='';
			$estado='danger';
			$this->layout = 'ajax';
			if (!empty($this->data)) {
				$this->autoRender=false;
				$estado_form = $this->data['Estado']['NOMBRE'];
				if (!empty($estado_form)) {
					$nuevo_estado = array(
						'NOMBRE'=>strtoupper($estado_form),
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('Estado');
					$this->Estado->create();
					if ($this->Estado->save($nuevo_estado)) {
						$mensaje='Su informaci&oacute;n se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo estado.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje,
				));
			}
		}
		public function editarMantenedorEstado($cod_estado=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_estado)) {
				$this->loadModel('Estado');
				$this->set('estado_bd', $this->Estado->getEstadoByCod($cod_estado));
			}else{
				exit();
			}
		}
		public function editarEstado()
		{
			$this->autoRender=false;
			$estado=false;
			$mensaje='danger';
			$estado_editado=array();
			if (!empty($this->data)) {
				$estado_id = $this->data['Estado']['ID'];
				if (!empty($estado_id)) {
					$update_estado = array(
						'ID'=>$estado_id,
						'NOMBRE'=>$this->data['Estado']['NOMBRE'],
						'MODIFIED'=>date('Y-m-d H:i:s')
					);
					$this->loadModel('Estado');
					$this->Estado->create(FALSE);
					if ($this->Estado->save($update_estado)) {
						$mensaje='El estado se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el estado que se quiere editar.';
			}
			echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
		}
		public function desactivarMantenedorEstado($cod_estado=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_estado)) {
				$this->loadModel('Estado');
				$estado_bd = $this->Estado->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_estado
					)
				));
				$this->set('estado_bd', $estado_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarEstado()
		{
			$this->autoRender=false;
			$estado=false;
			$mensaje='';
			$active='';
			$estado_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('Estado');
				$estado_a_desactivar = $this->Estado->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['Estado']['COD']
					)
				));
				if (!empty($estado_a_desactivar)) {
					$activo = array();
					if ($this->data['Estado']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_estado = array(
						'ID'=>$estado_a_desactivar['Estado']['ID'],
						'NOMBRE'=>$estado_a_desactivar['Estado']['NOMBRE'],
						'COD'=>$estado_a_desactivar['Estado']['COD'],
						'ACTIVO'=>$activo
					);
					$this->Estado->create(FALSE);
					if ($this->Estado->save($desactivar_estado)) {
						$estado_bd_desactivado = $this->Estado->find('first',array('conditions'=>array('COD'=>$estado_a_desactivar['Estado']['COD'])));
						if (!empty($estado_bd_desactivado)) {
							$tmp_estado=$estado_bd_desactivado['Estado'];
						}
						if ($tmp_estado['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado=true;
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_estado'=>$tmp_estado,'estado'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// MOTIVO ADELANTAR CLASE
		public function getMotivoAdelantarClase()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('MotivoAdelantarClase');
				$motivos_adelantar_clases = $this->MotivoAdelantarClase->getMotivosAdelantarClase();
				// debug($this->MotivoAdelantarClase->getLastQuery());
				// debug($motivos_adelantar_clases); exit();
				$this->set('motivos_adelantar_clases', $motivos_adelantar_clases);
			}
		}
		public function agregarMotivoAdelantarClase()
		{
			if (!empty($this->data)) {
				$tmp_motivo = $cantidad_de_motivos = array();
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$motivo = isset($this->data['Adelantar']['MOTIVO'])?$this->data['Adelantar']['MOTIVO']:null;
				if (!empty($motivo)) {
					$nuevo_motivo = array(
						'MOTIVO'=>$motivo,
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoAdelantarClase');
					$this->MotivoAdelantarClase->create();
					if ($this->MotivoAdelantarClase->save($nuevo_motivo)) {
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje, 
				));
			}
			$this->layout='ajax';
		}
		public function editarMotivoAdelantarClase($cod_motivo=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_motivo)) {
				$this->loadModel('MotivoAdelantarClase');
				$motivo_bd = $this->MotivoAdelantarClase->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_motivo
					)
				));
				$this->set('motivo_bd', $motivo_bd);
			}else{
				$this->Session->setFlash('No ha sido posible encontrar el motivo a editar, intentelo mas tarde', 'mensaje-error');
				$this->redirect(array('action'=>'index'));
			}
		}
		public function editarAdelantarClase()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$motivo_editado=array();
			if (!empty($this->data)) {
				$motivo_id = $this->data['Adelantar']['ID'];
				if (!empty($motivo_id)) {
					$update_motivo = array(
						'ID'=>$motivo_id,
						'MOTIVO'=>$this->data['Adelantar']['MOTIVO']
					);
					$this->loadModel('MotivoAdelantarClase');
					$this->MotivoAdelantarClase->create(FALSE);
					if ($this->MotivoAdelantarClase->save($update_motivo)) {$motivo_editado=$this->MotivoAdelantarClase->find('first',array('conditions'=>array('ID'=>$update_motivo['ID'])));
						$mensaje='El motivo se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere editar.';
			}
			$_json=json_encode(array('motivo_editado'=>$motivo_editado,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;
		}
		public function desactivarMotivoAdelantarClase($cod_motivo=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_motivo)) {
				$this->loadModel('MotivoAdelantarClase');
				$motivo_bd = $this->MotivoAdelantarClase->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_motivo
					)
				));
				$this->set('motivo_bd', $motivo_bd);
				$this->set('active', $active);
			}else{
				exit();
			}
		}
		public function desactivarAdelantarClase()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$motivo_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('MotivoAdelantarClase');
				$motivo_a_desactivar = $this->MotivoAdelantarClase->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['Adelantar']['COD']
					)
				));
				if (!empty($motivo_a_desactivar)) {
					$activo = array();
					if ($this->data['Adelantar']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_motivo = array(
						'ID'=>$motivo_a_desactivar['MotivoAdelantarClase']['ID'],
						'MOTIVO'=>$motivo_a_desactivar['MotivoAdelantarClase']['MOTIVO'],
						'COD'=>$motivo_a_desactivar['MotivoAdelantarClase']['COD'],
						'ACTIVO'=>$activo
					);
					$this->MotivoAdelantarClase->create(FALSE);
					if ($this->MotivoAdelantarClase->save($desactivar_motivo)) {
						$motivo_bd_desactivado = $this->MotivoAdelantarClase->find('first',array('conditions'=>array('COD'=>$motivo_a_desactivar['MotivoAdelantarClase']['COD'])));
						if (!empty($motivo_bd_desactivado)) {
							$tmp_motivo=$motivo_bd_desactivado['MotivoAdelantarClase'];
						}
						if ($tmp_motivo['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_motivo'=>$tmp_motivo,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// MANTENEDOR DETALLE
		public function getMantenedorDetalle()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('Detalle');
				$detalles = $this->Detalle->getAllDetallesBO();
				$this->set('detalles', $detalles);
			}
		}
		public function agregarDetalle()
		{
			if (!empty($this->data)) {
				$tmp_detalle = $cantidad_de_motivos = array();
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$detalle = isset($this->data['Detalle']['DETALLE'])?$this->data['Detalle']['DETALLE']:null;
				if (!empty($detalle)) {
					$nuevo_detalle = array(
						'DETALLE'=>strtoupper($detalle),
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('Detalle');
					$this->Detalle->create(TRUE);
					if (!$this->Detalle->save($nuevo_detalle)) {
						$mensaje='No se ha podido agregar el nuevo detalle.';					
					}else{
						$mensaje='Su informaci&oacute;n se ha almacenado con &eacute;xito.';
						$estado='success';
					}
					#debug($this->Detalle->getLastQuery());
				}else{
					$mensaje='Su informaci&oacute;n se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje,
				));
			}
			$this->layout = 'ajax';
		}
		public function editarMantenedorDetalle($cod_detalle=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_detalle)) {
				$this->loadModel('Detalle');
				$detalle_bd = $this->Detalle->getDetalleByCod($cod_detalle);
				$this->set('detalle_bd', $detalle_bd);
			}else{
				exit();
			}
		}
		public function editarDetalle()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$detalle_editado=array();
			if (!empty($this->data)) {
				$detalle_id = $this->data['Detalle']['ID'];
				if (!empty($detalle_id)) {
					$update_detalle = array(
						'ID'=>$detalle_id,
						'DETALLE'=>$this->data['Detalle']['DETALLE'],
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('Detalle');
					$this->Detalle->create(FALSE);
					if ($this->Detalle->save($update_detalle)) {
						$mensaje='El detalle se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el detalle que se quiere editar.';
			}
			echo json_encode(array(
				'status'=>$estado,
				'mensaje'=>$mensaje
			));
		}
		public function desactivarMantenedorDetalle($cod_detalle=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_detalle)) {
				$this->loadModel('Detalle');
				$detalle_bd = $this->Detalle->getDetalleByCod($cod_detalle);
				$this->set('detalle_bd', $detalle_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarDetalle()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$detalle_bd_desactivado = array();
			if (!empty($this->data)) {
				$this->loadModel('Detalle');
				$detalle_a_desactivar = $this->Detalle->getDetalleByCod($this->data['Detalle']['COD']);
				if (!empty($detalle_a_desactivar)) {
					$activo = 0;
					if ($this->data['Detalle']['ACTIVO'] == 'active') {
						$activo = 1;
					}
					$desactivar_detalle = array(
						'ID'=>$detalle_a_desactivar['Detalle']['ID'],
						'DETALLE'=>$detalle_a_desactivar['Detalle']['DETALLE'],
						'COD'=>$detalle_a_desactivar['Detalle']['COD'],
						'ACTIVO'=>$activo
					);
					$this->Detalle->create(FALSE);
					if ($this->Detalle->save($desactivar_detalle)) {
						$detalle_bd_desactivado = $this->Detalle->find('first',array('conditions'=>array('COD'=>$detalle_a_desactivar['Detalle']['COD'])));
						if (!empty($detalle_bd_desactivado)) {
							$tmp_detalle=$detalle_bd_desactivado['Detalle'];
						}
						$mensaje = 'Su informaci&oacute;n se ha actualizado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente m&aacute;s tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el detalle que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el detalle que se quiere modificar.';
			}
			$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// TIPO JUSTIFICACION LEGAL 
		public function getTipoJustificacionLegal()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('TipoJustificacionLegal');
				$tipos_justificacion_legal = $this->TipoJustificacionLegal->getMotivosTiposJustificacionLegal();
				$this->set('tipos_justificacion_legal', $tipos_justificacion_legal);
			}
		}
		public function agregarJustificacionLegal()
		{
			if (!empty($this->data)) {
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$justificacion_legal = $this->data['Justificacion']['TIPO_JUSTIFICACION'];
				if (!empty($justificacion_legal)) {
					$nuevo_justificacion_legal = array(
						'TIPO_JUSTIFICACION'=>$justificacion_legal,
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('TipoJustificacionLegal');
					$this->TipoJustificacionLegal->create();
					if ($this->TipoJustificacionLegal->save($nuevo_justificacion_legal)) {
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;
			}
			$this->layout='ajax';
		}
		public function editarTipoJustificacionLegal($cod_justifiacion_legal=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_justifiacion_legal)) {
				$this->loadModel('TipoJustificacionLegal');
				$justificacion_legal_bd = $this->TipoJustificacionLegal->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_justifiacion_legal
					)
				));
				$this->set('justificacion_legal_bd', $justificacion_legal_bd);
			}else{
				$this->Session->setFlash('No ha sido posible encontrar el motivo a editar, intentelo mas tarde', 'mensaje-error');
				$this->redirect(array('action'=>'index'));
			}
		}
		public function editarJustificacionLegal()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$tipo_justifiacion_editado=array();
			if (!empty($this->data)) {
				$justificacion_id = $this->data['Justificacion']['ID'];
				if (!empty($justificacion_id)) {
					$update_justificacion = array(
						'ID'=>$justificacion_id,
						'TIPO_JUSTIFICACION'=>$this->data['Justificacion']['TIPO_JUSTIFICACION']
					);
					$this->loadModel('TipoJustificacionLegal');
					$this->TipoJustificacionLegal->create(FALSE);
					if ($this->TipoJustificacionLegal->save($update_justificacion)) {$tipo_justifiacion_editado=$this->TipoJustificacionLegal->find('first',array('conditions'=>array('ID'=>$update_justificacion['ID'])));
						$mensaje='Su justificacion legal se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado la  justificacion legal que se quiere editar.';
			}
			$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;
		}
		public function desactivarTipoJustificacionLegal($cod_justificacion=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_justificacion)) {
				$this->loadModel('TipoJustificacionLegal');
				$justificacion_bd = $this->TipoJustificacionLegal->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_justificacion
					)
				));
				$this->set('justificacion_bd', $justificacion_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarJustificacionLegal()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('TipoJustificacionLegal');
				$justificacion_a_desactivar = $this->TipoJustificacionLegal->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['Justificacion']['COD']
					)
				));
				if (!empty($justificacion_a_desactivar)) {
					$activo = array();
					if ($this->data['Justificacion']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_justificacion = array(
						'ID'=>$justificacion_a_desactivar['TipoJustificacionLegal']['ID'],
						'TIPO_JUSTIFICACION'=>$justificacion_a_desactivar['TipoJustificacionLegal']['TIPO_JUSTIFICACION'],
						'COD'=>$justificacion_a_desactivar['TipoJustificacionLegal']['COD'],
						'ACTIVO'=>$activo
					);
					$this->TipoJustificacionLegal->create(FALSE);
					if ($this->TipoJustificacionLegal->save($desactivar_justificacion)) {
						if ($desactivar_justificacion['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// INASISTENCIA DOCENTE
		public function getMotivoInasistenciaDocente()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('MotivoInasistenciaDocente');
				$inasistecias_docentes = $this->MotivoInasistenciaDocente->getAllMotivosInasistenciaDocente();
				$this->set('inasistecias_docentes', $inasistecias_docentes);
			}
		}
		public function agregarInasistenciaDocente()
		{
			if (!empty($this->data)) {
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$inasistencia_docente = isset($this->data['Inasistencia']['MOTIVO'])?$this->data['Inasistencia']['MOTIVO']:null;
				if (!empty($inasistencia_docente)) {
					$nuevo_inasistencia_docente = array(
						'MOTIVO'=>$inasistencia_docente,
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoInasistenciaDocente');
					$this->MotivoInasistenciaDocente->create();
					if ($this->MotivoInasistenciaDocente->save($nuevo_inasistencia_docente)) {
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje, 
				));
			}
			$this->layout='ajax';
		}
		public function editarInasistenciaDocente($cod_inasistencia=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_inasistencia)) {
				$this->loadModel('MotivoInasistenciaDocente');
				$inasistencia_bd = $this->MotivoInasistenciaDocente->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_inasistencia
					)
				));
				$this->set('inasistencia_bd', $inasistencia_bd);
			}else{
				exit();
			}
		}
		public function editarMotivoInasistenciaDocente()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$inasistecia_editado=array();
			if (!empty($this->data)) {
				$inasistencia_id = $this->data['Inasistencia']['ID'];
				if (!empty($inasistencia_id)) {
					$update_inasistencia = array(
						'ID'=>$inasistencia_id,
						'MOTIVO'=>$this->data['Inasistencia']['MOTIVO'],
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoInasistenciaDocente');
					$this->MotivoInasistenciaDocente->create(FALSE);
					if ($this->MotivoInasistenciaDocente->save($update_inasistencia)) {
						$mensaje='Su motivo de Inasistencia se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el motivo de inasistecia que se quiere editar.';
			}
			echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
		}
		public function desactivarInasistencia($cod_inasistencia=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_inasistencia)) {
				$this->loadModel('MotivoInasistenciaDocente');
				$inasistencia_bd = $this->MotivoInasistenciaDocente->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_inasistencia
					)
				));
				$this->set('inasistencia_bd', $inasistencia_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarInasistenciaDocente()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('MotivoInasistenciaDocente');
				$inasistencia_a_desactivar = $this->MotivoInasistenciaDocente->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['Inasistencia']['COD']
					)
				));
				if (!empty($inasistencia_a_desactivar)) {
					$activo = array();
					if ($this->data['Inasistencia']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_inasistencia = array(
						'ID'=>$inasistencia_a_desactivar['MotivoInasistenciaDocente']['ID'],
						'MOTIVO'=>$inasistencia_a_desactivar['MotivoInasistenciaDocente']['MOTIVO'],
						'COD'=>$inasistencia_a_desactivar['MotivoInasistenciaDocente']['COD'],
						'ACTIVO'=>$activo
					);
					$this->MotivoInasistenciaDocente->create(FALSE);
					if ($this->MotivoInasistenciaDocente->save($desactivar_inasistencia)) {
						$inasistencia_bd_desactivado = $this->MotivoInasistenciaDocente->find('first',array('conditions'=>array('COD'=>$inasistencia_a_desactivar['MotivoInasistenciaDocente']['COD'])));
						if (!empty($inasistencia_bd_desactivado)) {
							$tmp_inasistencia_docente=$inasistencia_bd_desactivado['MotivoInasistenciaDocente'];
						}
						if ($tmp_inasistencia_docente['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// RECHAZO CLASE
		public function getMotivoRechazoClase()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('MotivoRechazoClase');
				$rechazos_clases = $this->MotivoRechazoClase->getMotivosRechazoClase();
				$this->set('rechazos_clases', $rechazos_clases);
			}
		}
		public function agregarRechazoClase()
		{
			$this->layout='ajax';
			if (!empty($this->data)) {
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$rechazo_clase = isset($this->data['Rechazo']['MOTIVO'])?$this->data['Rechazo']['MOTIVO']:null;
				if (!empty($rechazo_clase)) {
					$nuevo_rechazo_clase = array(
						'MOTIVO'=>$rechazo_clase,
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoRechazoClase');
					$this->MotivoRechazoClase->create();
					if ($this->MotivoRechazoClase->save($nuevo_rechazo_clase)) {
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				$_json=json_encode(array('tmp_rechazo_clase'=>$tmp_rechazo_clase,'status'=>$estado,'mensaje'=>$mensaje, 'cantidad_de_motivos'=>$cantidad_de_motivos));echo $_json;
			}
		}
		public function editarRechazoClase($cod_rechazo=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_rechazo)) {
				$this->loadModel('MotivoRechazoClase');
				$rechazo_clase_bd = $this->MotivoRechazoClase->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_rechazo
					)
				));
				$this->set('rechazo_clase_bd', $rechazo_clase_bd);
			}else{
				exit();
			}
		}
		public function editarMotivoRechazoClase()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			if (!empty($this->data)) {
				$rechazo_clase_id = $this->data['Rechazo']['ID'];
				if (!empty($rechazo_clase_id)) {
					$update_rechazo = array(
						'ID'=>$rechazo_clase_id,
						'MOTIVO'=>$this->data['Rechazo']['MOTIVO'],
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoRechazoClase');
					$this->MotivoRechazoClase->create(FALSE);
					if ($this->MotivoRechazoClase->save($update_rechazo)) {
						$mensaje='Su motivo de rechazo de clase se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el motivo de rechazo de clase que se quiere editar.';
			}
			$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;
		}
		public function desactivarRechazoClase($cod_rechazo=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_rechazo)) {
				$this->loadModel('MotivoRechazoClase');
				$rechazo_clase_bd = $this->MotivoRechazoClase->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_rechazo
					)
				));
				$this->set('rechazo_clase_bd', $rechazo_clase_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarMotivoRechazoClase()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$rechazo_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('MotivoRechazoClase');
				$rechazo_a_desactivar = $this->MotivoRechazoClase->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['Rechazo']['COD']
					)
				));
				if (!empty($rechazo_a_desactivar)) {
					$activo = array();
					if ($this->data['Rechazo']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_rechazo_clase = array(
						'ID'=>$rechazo_a_desactivar['MotivoRechazoClase']['ID'],
						'MOTIVO'=>$rechazo_a_desactivar['MotivoRechazoClase']['MOTIVO'],
						'COD'=>$rechazo_a_desactivar['MotivoRechazoClase']['COD'],
						'ACTIVO'=>$activo
					);
					$this->MotivoRechazoClase->create(FALSE);
					if ($this->MotivoRechazoClase->save($desactivar_rechazo_clase)) {
						$rechazo_bd_desactivado = $this->MotivoRechazoClase->find('first',array('conditions'=>array('COD'=>$rechazo_a_desactivar['MotivoRechazoClase']['COD'])));
						if (!empty($rechazo_bd_desactivado)) {
							$tmp_rechazo_clase=$rechazo_bd_desactivado['MotivoRechazoClase'];
						}
						if ($tmp_rechazo_clase['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_rechazo_clase'=>$tmp_rechazo_clase,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// SUSPENSION CLASE
		public function getMotivoSuspensionClase()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('MotivoSuspensionClase');
				$suspension_clases = $this->MotivoSuspensionClase->getMotivosSuspensionClase();
				$this->set('suspension_clases', $suspension_clases);
			}
		}
		public function agregarSuspensionClase()
		{
			if (!empty($this->data)) {
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$motivo_suspension = $this->data['Suspension']['MOTIVO'];
				if (!empty($motivo_suspension)) {
					$nuevo_motivo_suspension = array(
						'MOTIVO'=>$motivo_suspension,
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoSuspensionClase');
					$this->MotivoSuspensionClase->create();
					if ($this->MotivoSuspensionClase->save($nuevo_motivo_suspension)) {
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje, 
				));
			}
			$this->layout = 'ajax';
		}
		public function editarSuspension($cod_suspension=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_suspension)) {
				$this->loadModel('MotivoSuspensionClase');
				$suspension_clase_bd = $this->MotivoSuspensionClase->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_suspension
					)
				));
				$this->set('suspension_clase_bd', $suspension_clase_bd);
			}else{
				$this->Session->setFlash('No ha sido posible encontrar el motivo a editar, intentelo mas tarde', 'mensaje-error');
				$this->redirect(array('action'=>'index'));
			}
		}
		public function editarSuspensionClase()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$suspension_editada=array();
			if (!empty($this->data)) {
				$suspension_id = $this->data['Suspension']['ID'];
				if (!empty($suspension_id)) {
					$update_suspension = array(
						'ID'=>$suspension_id,
						'MOTIVO'=>$this->data['Suspension']['MOTIVO'],
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoSuspensionClase');
					$this->MotivoSuspensionClase->create(FALSE);
					if ($this->MotivoSuspensionClase->save($update_suspension)) {
						$mensaje='Su motivo de suspensi&oacute;n se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n.';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n.';
				}	
			}else{
				$mensaje = 'No se ha encontrado el motivo de suspensi&oacute;n que se quiere editar.';
			}
			$_json=json_encode(array('status'=>$estado,'mensaje'=>$mensaje));echo $_json;
		}
		public function desactivarSuspension($cod_suspension=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_suspension)) {
				$this->loadModel('MotivoSuspensionClase');
				$suspension_clase_bd = $this->MotivoSuspensionClase->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_suspension
					)
				));
				$this->set('suspension_clase_bd', $suspension_clase_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarSuspensionClase()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$suspension_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('MotivoSuspensionClase');
				$suspension_a_desactivar = $this->MotivoSuspensionClase->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['Suspension']['COD']
					)
				));
				if (!empty($suspension_a_desactivar)) {
					$activo = array();
					if ($this->data['Suspension']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_suspension = array(
						'ID'=>$suspension_a_desactivar['MotivoSuspensionClase']['ID'],
						'MOTIVO'=>$suspension_a_desactivar['MotivoSuspensionClase']['MOTIVO'],
						'COD'=>$suspension_a_desactivar['MotivoSuspensionClase']['COD'],
						'ACTIVO'=>$activo
					);
					$this->MotivoSuspensionClase->create(FALSE);
					if ($this->MotivoSuspensionClase->save($desactivar_suspension)) {
						$suspension_bd_desactivado = $this->MotivoSuspensionClase->find('first',array('conditions'=>array('COD'=>$suspension_a_desactivar['MotivoSuspensionClase']['COD'])));
						if (!empty($suspension_bd_desactivado)) {
							$tmp_suspension=$suspension_bd_desactivado['MotivoSuspensionClase'];
						}
						if ($tmp_suspension['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_suspension'=>$tmp_suspension,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// RECHAZO REFORZAMIENTO
		public function getRechazoReforzamiento()
		{
			if (empty($this->data)) {
				$this->layout = 'ajax';
				$session_data = $this->Session->read('CoordinadorLogueado');
				$cod_sede =  $session_data['Sede']['COD_SEDE'];
				$this->loadModel('MotivosRechazoReforzamiento');
				$rechazos_reforzamientos = $this->MotivosRechazoReforzamiento->getMotivosRechazo();
				$this->set('rechazos_reforzamientos', $rechazos_reforzamientos);
			}
		}
		public function agregarRechazo()
		{
			if (!empty($this->data)) {
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$motivo_rechazo = $this->data['Rechazo']['MOTIVO'];
				if (!empty($motivo_rechazo)) {
					$nuevo_motivo_rechazo = array(
						'MOTIVO'=>$motivo_rechazo,
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivosRechazoReforzamiento');
					$this->MotivosRechazoReforzamiento->create();
					if ($this->MotivosRechazoReforzamiento->save($nuevo_motivo_rechazo)) {
						$reforzamiento_bd=$this->MotivosRechazoReforzamiento->find('first',array('conditions'=>array('COD'=>$nuevo_motivo_rechazo['COD'])));
						$cantidad_de_motivos = $this->MotivosRechazoReforzamiento->find('count');
						if (!empty($reforzamiento_bd)) {
							$tmp_rechazo=$reforzamiento_bd['MotivosRechazoReforzamiento'];
						}
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
			}
			$this->layout='ajax';
		}
		public function editarRechazo($cod_rechazo=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_rechazo)) {
				$this->loadModel('MotivosRechazoReforzamiento');
				$rechazo_bd = $this->MotivosRechazoReforzamiento->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_rechazo
					)
				));
				$this->set('rechazo_bd', $rechazo_bd);
			}else{
				$this->Session->setFlash('No ha sido posible encontrar el motivo a editar, intentelo mas tarde', 'mensaje-error');
				$this->redirect(array('action'=>'index'));
			}	
		}
		public function editarRechazoReforzamiento()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$rechazo_editado=array();
			if (!empty($this->data)) {
				$rechazo_id = $this->data['Rechazo']['ID'];
				if (!empty($rechazo_id)) {
					$update_rechazo = array(
						'ID'=>$rechazo_id,
						'MOTIVO'=>$this->data['Rechazo']['MOTIVO']
					);
					$this->loadModel('MotivosRechazoReforzamiento');
					$this->MotivosRechazoReforzamiento->create(FALSE);
					if ($this->MotivosRechazoReforzamiento->save($update_rechazo)) {
						$rechazo_editado=$this->MotivosRechazoReforzamiento->find('first',array('conditions'=>array('ID'=>$update_rechazo['ID'])));
						$mensaje='Su rechazo se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n';
				}	
			}else{
				$mensaje = 'No se ha encoontrado el rechazo que se quiere editar.';
			}
			$_json=json_encode(array('rechazo_editado'=>$rechazo_editado,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;
		}
		public function desactivarRechazo($cod_rechazo=null, $active = null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_rechazo)) {
				$this->loadModel('MotivosRechazoReforzamiento');
				$rechazo_bd = $this->MotivosRechazoReforzamiento->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_rechazo
					)
				));
				$this->set('rechazo_bd', $rechazo_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarRechazoReforzamiento()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$rechazo_bd_desactivado = array();
			// debug($this->data);
			if (!empty($this->data)) {
				$this->loadModel('MotivosRechazoReforzamiento');
				$rechazo_a_desactivar = $this->MotivosRechazoReforzamiento->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['Rechazo']['COD']
					)
				));
				if (!empty($rechazo_a_desactivar)) {
					$activo = array();
					if ($this->data['Rechazo']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_reforzamiento = array(
						'ID'=>$rechazo_a_desactivar['MotivosRechazoReforzamiento']['ID'],
						'MOTIVO'=>$rechazo_a_desactivar['MotivosRechazoReforzamiento']['MOTIVO'],
						'COD'=>$rechazo_a_desactivar['MotivosRechazoReforzamiento']['COD'],
						'ACTIVO'=>$activo
					);
					$this->MotivosRechazoReforzamiento->create(FALSE);
					if ($this->MotivosRechazoReforzamiento->save($desactivar_reforzamiento)) {
						$rechazo_bd_desactivado = $this->MotivosRechazoReforzamiento->find('first',array('conditions'=>array('COD'=>$rechazo_a_desactivar['MotivosRechazoReforzamiento']['COD'])));
						if (!empty($rechazo_bd_desactivado)) {
							$tmp_rechazo=$rechazo_bd_desactivado['MotivosRechazoReforzamiento'];

						}
						if ($tmp_rechazo['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_rechazo'=>$tmp_rechazo,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// MOTIVO REFORZAMIENTO
		public function getMantenedorMotivoReforzamiento()
		{
			$this->layout = 'ajax';
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			$this->loadModel('MotivoReforzamiento');
			$motivos_reforzamientos = $this->MotivoReforzamiento->getMotivos();
			$this->set('motivos_reforzamientos', $motivos_reforzamientos);
		}
		public function agregarReforzamiento()
		{
			if (!empty($this->data)) {
				$mensaje='';
				$estado='danger';
				$this->autoRender=false;
				$motivo_reforzamiento = $this->data['Reforzamiento']['MOTIVO'];
				if (!empty($motivo_reforzamiento)) {
					$nuevo_motivo_reforzamiento = array(
						'MOTIVO'=>$motivo_reforzamiento,
						'COD'=>uniqid(),
						'ACTIVO'=>0,
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
					);
					$this->loadModel('MotivoReforzamiento');
					$this->MotivoReforzamiento->create();
					if ($this->MotivoReforzamiento->save($nuevo_motivo_reforzamiento)) {
						$mensaje='Su motivo se ha almacenado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje='No se ha podido agregar el nuevo motivo.';
					}
				}else{
					$mensaje='Su motivo se ha almacenado con &eacute;xito.';
				}
				echo json_encode(array(
					'status'=>$estado,
					'mensaje'=>$mensaje,
				));
			}
			$this->layout = 'ajax';
		}
		public function editarReforzamiento($cod_reforzamiento=null)
		{
			// debug($cod_reforzamiento); 
			$this->layout = 'ajax';
			if (!empty($cod_reforzamiento)) {
				$this->loadModel('MotivoReforzamiento');
				$reforzamiento_bd = $this->MotivoReforzamiento->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_reforzamiento
					)
				));
				$this->set('reforzamiento_bd', $reforzamiento_bd);
			}else{
				exit();
			}
		}
		public function editarMotivoReforzamiento()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			if (!empty($this->data)) {
				$rechazo_id = $this->data['Reforzamiento']['ID'];
				if (!empty($rechazo_id)) {
					$update_rechazo = array(
						'ID'=>$rechazo_id,
						'MOTIVO'=>$this->data['Reforzamiento']['MOTIVO']
					);
					$this->loadModel('MotivoReforzamiento');
					$this->MotivoReforzamiento->create(FALSE);
					if ($this->MotivoReforzamiento->save($update_rechazo)) {
						$mensaje='Su informaci&oacute;n se ha editado con &eacute;xito.';
						$estado='success';
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n';
				}	
			}else{
				$mensaje = 'No se ha encoontrado el motivo que se quiere editar.';
			}
			echo json_encode(array('status'=>$estado,'mensaje'=>$mensaje));
		}
		public function desactivarMotivoReforzamiento($cod_reforzamiento=null, $active=null)
		{
			$this->layout = 'ajax';
			if (!empty($cod_reforzamiento)) {
				$this->loadModel('MotivoReforzamiento');
				$reforzamiento_bd = $this->MotivoReforzamiento->find('first', array(
					'conditions'=>array(
						'COD'=>$cod_reforzamiento
					)
				));
				$this->set('reforzamiento_bd', $reforzamiento_bd);
				$this->set('active', $active);
			}
		}
		public function desactivarReforzamiento()
		{
			$this->autoRender=false;
			$estado='danger';
			$mensaje='';
			$active='';
			$reforzamiento_bd_desactivado = array();
			if (!empty($this->data)) {
				$this->loadModel('MotivoReforzamiento');
				$motivo_a_desactivar = $this->MotivoReforzamiento->find('first', array(
					'conditions'=>array(
						'COD'=>$this->data['MotivoReforzamiento']['COD']
					)
				));
				if (!empty($motivo_a_desactivar)) {
					$activo = array();
					if ($this->data['MotivoReforzamiento']['ACTIVO'] == 'active') {
						$activo = 1;
					}else{
						$activo = 0;
					}
					$desactivar_reforzamiento = array(
						'ID'=>$motivo_a_desactivar['MotivoReforzamiento']['ID'],
						'MOTIVO'=>$motivo_a_desactivar['MotivoReforzamiento']['MOTIVO'],
						'COD'=>$motivo_a_desactivar['MotivoReforzamiento']['COD'],
						'ACTIVO'=>$activo
					);
					$this->MotivoReforzamiento->create(FALSE);
					if ($this->MotivoReforzamiento->save($desactivar_reforzamiento)) {
						$reforzamiento_bd_desactivado = $this->MotivoReforzamiento->find('first',array('conditions'=>array('COD'=>$motivo_a_desactivar['MotivoReforzamiento']['COD'])));
						if (!empty($reforzamiento_bd_desactivado)) {
							$tmp_reforzamiento=$reforzamiento_bd_desactivado['MotivoReforzamiento'];
						}
						if ($tmp_reforzamiento['ACTIVO'] == 1) {
							$mensaje = 'Su motivo se ha activado con &eacute;xito.';
						}else{
							$mensaje='Su motivo se ha desactivado con &eacute;xito.';
						}
						$estado='success';
					}else{
						$mensaje='No se ha podido guardar el cambio, intente mas tarde.';
					}	
				}else{
					$mensaje = 'No se ha encontrado el motivo que desea modificar. Intente mas tarde.';
				}
			}else{
				$mensaje = 'No se ha encontrado el motivo que se quiere modificar.';
			}
			$_json=json_encode(array('tmp_reforzamiento'=>$tmp_reforzamiento,'status'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}


		function editar()
		{
			$this->autoRender=false;
			$estado=false;
			$mensaje='';
			$reforzamiento_editado=array();
			if (!empty($this->data)) {
				$reforzamiento_id = $this->data['Reforzamiento']['ID'];
				if (!empty($reforzamiento_id)) {
					$update_reforzamiento = array(
						'ID'=>$reforzamiento_id,
						'MOTIVO'=>$this->data['Reforzamiento']['MOTIVO'],
						'COD'=>uniqid()
					);
					$this->loadModel('MotivoReforzamiento');
					$this->MotivoReforzamiento->create(FALSE);
					$motivo="'".$this->data['Reforzamiento']['MOTIVO']."'";
					if ($this->MotivoReforzamiento->updateAll(array('MotivoReforzamiento.MOTIVO'=>$motivo),array('MotivoReforzamiento.ID'=>$reforzamiento_id))) {
						$reforzamiento_editado=$this->MotivoReforzamiento->find('first',array('conditions'=>array('ID'=>$update_reforzamiento['ID'])));
						$mensaje='Su motivo se ha editado con &eacute;xito.';
						$estado=true;
					}else{
						$mensaje = 'No se ha podido guardar la edici&oacute;n';
					}
				}else{
					$mensaje = 'No se ha podido guardar la edici&oacute;n(11)';
				}	
			}else{
				$mensaje = 'No se ha encoontrado el reforzamiento que se quiere editar.(11)';
			}
			$_json=json_encode(array('reforzamiento_tmp'=>$reforzamiento_editado,'estado'=>$estado,'mensaje'=>$mensaje));echo $_json;	
		}
		// ROLES Y PERFILES
		public function rolesPerfiles()
		{
			
		}
	}