<?php 
	App::uses('CakeEmail', 'Network/Email');
	App::import('Vendor', 'Classes/PHPExcel');
	class DirectoresController extends AppController {
		public $name = 'Directores';
		public $layout = 'app-director';
		public $components = array('Mpdf','Integracion');

		public function procesarDatosFiltroMultiple($datos_filtro=array())
		{
			#$this->autoRender = false;
			$director = $this->Session->read('DirectorLogueado');
			$sede_id = $director['Sede']['COD_SEDE'];
			$fecha_desde = $fecha_hasta = '';
			if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
				$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
			}
			if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
				$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
			}
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."')";
				$fecha_hasta = "TO_DATE('".$fecha_hasta."')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
				);
			}elseif (empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_hasta = "TO_DATE('".$fecha_hasta."')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE <= \''.$fecha_hasta.'\'',
				);
			}elseif (!empty($fecha_desde) && empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE >= \''.$fecha_desde.'\'',
				);
			}
			if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
				$conditions['Asignatura.NOMBRE'] = $datos_filtro['Filtro']['nombre_asignatura'];
			}
			if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
				$conditions['ProgramacionClase.SIGLA_SECCION'] = $datos_filtro['Filtro']['sigla_seccion'];
			}
			if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
				$conditions['ProgramacionClase.SIGLA_SECCION'] = $datos_filtro['Filtro']['sigla_seccion'];
			}
			$conditions['ProgramacionClase.COD_SEDE'] = $sede_id;
			if ((!empty($datos_filtro['Filtro']['rut'])) || (!empty($datos_filtro['Filtro']['nombre_docente'])) || (!empty($datos_filtro['Filtro']['id_docente'])) ) {
				if (isset($datos_filtro['Filtro']['value_docente']) && !empty($datos_filtro['Filtro']['value_docente'])) {
					$conditions['Docente.COD_DOCENTE'] = $datos_filtro['Filtro']['value_docente'];
				}
			}else{
				if (isset($conditions['Docente.COD_DOCENTE'])) {
					unset($conditions['Docente.COD_DOCENTE']);
				}
			}
			if (isset($datos_filtro['Filtro']['hora_inicio']) && !empty($datos_filtro['Filtro']['hora_inicio'])) {
				$conditions["TO_CHAR (ProgramacionClase.hora_inicio, 'HH24:MI')"] = $datos_filtro['Filtro']['hora_inicio'];
			}
			if (isset($datos_filtro['Filtro']['hora_fin']) && !empty($datos_filtro['Filtro']['hora_fin'])) {
				$conditions["TO_CHAR (ProgramacionClase.hora_fin, 'HH24:MI')"] = $datos_filtro['Filtro']['hora_fin'];
			}
			if (isset($datos_filtro['Filtro']['jornada']) && !empty($datos_filtro['Filtro']['jornada'])) {
				$conditions["ProgramacionClase.COD_JORNADA"] = $datos_filtro['Filtro']['jornada'];
			}
			if (isset($datos_filtro['Filtro']['detalle']) && !empty($datos_filtro['Filtro']['detalle'])) {
				$conditions["ProgramacionClase.DETALLE_ID"] = $datos_filtro['Filtro']['detalle'];
			}
			if (isset($datos_filtro['Filtro']['sub_estado']) && !empty($datos_filtro['Filtro']['sub_estado'])) {
				$conditions["ProgramacionClase.SUB_ESTADO_PROGRAMACION_ID"] = $datos_filtro['Filtro']['sub_estado'];
			}
			if (isset($datos_filtro['Filtro']['estado']) && !empty($datos_filtro['Filtro']['estado'])) {
				$conditions["ProgramacionClase.ESTADO_PROGRAMACION_ID"] = $datos_filtro['Filtro']['estado'];
			}
			if (isset($datos_filtro['Filtro']['tipo_evento']) && !empty($datos_filtro['Filtro']['tipo_evento'])) {
				$conditions["ProgramacionClase.TIPO_EVENTO"] = $datos_filtro['Filtro']['tipo_evento'];
			}
			if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
				$this->loadModel('Periodo');
				$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
				if (!empty($periodo)) {
					$conditions["ProgramacionClase.SEMESTRE"] = $periodo['Periodo']['SEMESTRE'];
					$conditions["ProgramacionClase.ANHO"] = $periodo['Periodo']['ANHO'];
				}
			}
			return $conditions;
		}

		public function index($filtro_multiple=null) 
		{

			//$coordinador = $this->Session->read('CoordinadorLogueado');

			$director = $this->Session->read('DirectorLogueado');

			if (empty($director)) {
				$this->redirect(array('controller'=>'login','action'=>'logoutDirector'));
			}
			$sede_id = $director['Sede']['COD_SEDE'];
			$datos_tabla = $datos_filtro = array();
			$session_data = $this->Session->read('Message');
			$filtros_session['Filtro'] = isset($session_data['flash']['params'])? $session_data['flash']['params']:null;
			$docente_filtro=array();
			$ordenar = '';
			if (!empty($this->data) || !empty($filtros_session['Filtro'])) {
				#debug($this->data);#exit();
				$datos_filtro = !empty($this->data)? $this->data:$filtros_session;
				$this->loadModel('ProgramacionClase');
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				if ($filtro_multiple == 1) {
					$conditions = $this->procesarDatosFiltroMultiple($datos_filtro);
					$datos_tabla = $this->ProgramacionClase->getDatosTablaAutorizacionClaseNewMultiple($conditions);
				}else{
					$fecha_desde = $fecha_hasta = '';
					if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
						$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
					}
					if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
						$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
					}
					$datos_tabla = $this->ProgramacionClase->getDatosTablaAutorizacionClaseNew(
						$fecha_desde,
						$fecha_hasta,
						$sede_id,
						$datos_filtro['Filtro']['filtro'],
						$datos_filtro['Filtro']['value'],
						$ordenar
					);
				}
			}
			if (!empty($datos_tabla)) {
				foreach ($datos_tabla as $key => $dato) {
					$programacion_tmp = $this->ProgramacionClase->getProgramacionByDirectorSede($sede_id, $dato['ProgramacionClase']['HORA_INICIO'], $dato['ProgramacionClase']['HORA_FIN']);
					if (!empty($programacion_tmp)) {
						$datos_tabla[$key]['ProgramacionClase']['TOPE_HORARIO'] = $programacion_tmp;
					}
				}
			}
			#FILTRO MULTIPLE
				$this->loadModel('Periodo');
				$periodos = $this->Periodo->getPeriodos();
				$this->loadModel('Detalle');
				#NEGOCIO EXCLUSIVO DE LA PANTALLA;
				$detalles = $this->Detalle->find('all', array(
					'conditions'=>array(
						'Detalle.ID'=>array('1','2','3','4','5','6')
					),
					'order'=>'Detalle.DETALLE'
				));
				#debug($this->Detalle->getLastQuery());
				$this->loadModel('SubEstado');
				#NEGOCIO EXCLUSIVO DE LA PANTALLA;
				$sub_estados = $this->SubEstado->find('all', array('conditions'=>array('ID <= 3'),'order'=>'SubEstado.NOMBRE'));
				$this->loadModel('Estado');
				$estados = $this->Estado->getEstados();
				$this->loadModel('HorarioModulo');
				$horarios = $this->HorarioModulo->getSimpleHorarioBySede($sede_id);
				$this->set(array(
					'detalles'=>$detalles,
					'horarios'=>$horarios,
					'periodos'=>$periodos,
					'estados'=>$estados,
					'sub_estados'=>$sub_estados,
					'filtro_multiple'=>$filtro_multiple,
				));
			#FIN FILTRO MULTIPLE
			$this->set(array(
				'datos_filtro'=>$datos_filtro,
				'datos_tabla'=>$datos_tabla,
				'ordenar'=>$ordenar,
				'docente_filtro'=>$docente_filtro,
			));
}

		public function autocompletarDatos($tipo_filtro = null) 
		{
			if ($this->Session->check('DirectorLogueado')) {
				$coordinador = $this->Session->read('DirectorLogueado');
			//debug($a);exit();
			}
			if($this->Session->check('CoordinadorLogueado')){
				$coordinador = $this->Session->read('CoordinadorLogueado');
			#debug($cordinador);exit();	
			}
			$this->autoRender = false;
			#debug($tipo_filtro);
			switch ($tipo_filtro) {
				case 'Alumno.RUT':
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('Alumno');
						$rut_alumno = $this->Alumno->autocompletarByRut($term);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($rut_alumno)) {
							foreach ($rut_alumno as $rut):
								$label = '('.$rut['Alumno']['RUT'].'-'.$rut['Alumno']['DV_RUT'].') / '.$rut['Alumno']['NOMBRES'].' '.$rut['Alumno']['APELLIDO_PAT'].' '.$rut['Alumno']['APELLIDO_MAT'];
								$dato_a_mostrar[]=array(
									'label'=>$label,
									'uuid'=>$rut['Alumno']['COD_ALUMNO']
								);
							endforeach;	
						}
						if (isset($rut)) {
							unset($dato_a_mostrar[0]);
						}
					}
					break;
				case 'Alumno.NOMBRE':
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('Alumno');
						$rut_alumno = $this->Alumno->autocompletarByNombre($term);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($rut_alumno)) {
							foreach ($rut_alumno as $rut):
								$label = '('.$rut['Alumno']['RUT'].'-'.$rut['Alumno']['DV_RUT'].') / '.$rut['Alumno']['NOMBRES'].' '.$rut['Alumno']['APELLIDO_PAT'].' '.$rut['Alumno']['APELLIDO_MAT'];
								$dato_a_mostrar[]=array(
									'label'=>$label,
									'uuid'=>$rut['Alumno']['COD_ALUMNO']
								);
							endforeach;	
						}
						if (isset($rut)) {
							unset($dato_a_mostrar[0]);
						}
					}
					break;
				case 'Docente.RUT':
					$term = isset($_GET['term'])? $_GET['term']:null;
					$sede = $coordinador['Sede']['COD_SEDE'];
					if (!empty($term)) {
						$this->loadModel('Docente');
						$rut_docente = $this->Docente->autocompletarByRutDocente($term,$sede);
						
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($rut_docente)) {
							foreach ($rut_docente as $rut):
								$label = ('('.$rut['Docente']['RUT'].'-'.$rut['Docente']['DV'].') / '.$rut['Docente']['NOMBRE'].' '.$rut['Docente']['APELLIDO_PAT'].' '.$rut['Docente']['APELLIDO_MAT']);
								$dato_a_mostrar[]=array(
									'label'=>$label,
									'uuid'=>$rut['Docente']['COD_DOCENTE']
								);
							endforeach;	
						}
						if (isset($rut)) {
							unset($dato_a_mostrar[0]);
						}
					}
					break;
				case 'Docente.NOMBRE':
					$term = isset($_GET['term'])? $_GET['term']:null;
					$sede = $coordinador['Sede']['COD_SEDE'];

					if (!empty($term)) {
						$this->loadModel('Docente');
						$nombre_docente = $this->Docente->autocompletarByNombreDocente($term,$sede);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($nombre_docente)) {
							foreach ($nombre_docente as $docente):
								$dato_a_mostrar[]=array(
									'label'=>("(".$docente['Docente']['RUT']."-".$docente['Docente']['DV'].") ".$docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT']),
									'uuid'=>$docente['Docente']['COD_DOCENTE']
								);
							endforeach;	
						}
						if (isset($docente)) {
							unset($dato_a_mostrar[0]);
						}	
					}
					break;
				case 'Docente.COD_FUNCIONARIO':
					$term = isset($_GET['term'])? $_GET['term']:null;
					#$sede = $coordinador['Sede']['COD_SEDE'];

					if (!empty($term)) {
						$this->loadModel('Docente');
						$id_docente = $this->Docente->autocompletarByIdDocente($term);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($id_docente)) {
							foreach ($id_docente as $id):
								$label = ('('.$id['Docente']['COD_DOCENTE'].') - '.$id['Docente']['NOMBRE'].' '.$id['Docente']['APELLIDO_PAT'].' '.$id['Docente']['APELLIDO_MAT']);
								$dato_a_mostrar[]=array(
									'label'=>$label,
									'uuid'=>$id['Docente']['COD_DOCENTE']
								);
							endforeach;	
						}
						if (isset($id)) {
							unset($dato_a_mostrar[0]);
						}
					}
					break;
				case 'Asignatura.NOMBRE':
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('Asignatura');
						$asignaturas = $this->Asignatura->autocompletarByNombreAsignatura($term);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($asignaturas)) {
							foreach ($asignaturas as $asignatura):
								$label = ($asignatura['Asignatura']['NOMBRE'].' ( '.$asignatura['Asignatura']['SIGLA'].' )');
								$dato_a_mostrar[]=array(
									'label'=>$label,
									'uuid'=>$asignatura['Asignatura']['SIGLA']
								);
							endforeach;	
						}
						if (isset($asignatura)) {
							unset($dato_a_mostrar[0]);
						}
					}
					break;
				case 'ProgramacionClase.SIGLA_SECCION':
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('AsignaturaHorario');
						$sigla_seccion = $this->AsignaturaHorario->autocompletarBySiglaSeccion($term);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($sigla_seccion)) {
							foreach ($sigla_seccion as $sigla):
								$label = ($sigla['AsignaturaHorario']['SIGLA_SECCION'].' ('.$sigla['AsignaturaHorario']['TEO_PRA'].' )');
								$dato_a_mostrar[]=array(
									'label'=>$label,
									'uuid'=>$sigla['AsignaturaHorario']['SIGLA_SECCION']
								);
							endforeach;	
						}
						if (isset($sigla)) {
							unset($dato_a_mostrar[0]);
						}	
					}
					break;
				case 'ProgramacionClase.PERIODO':
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('Periodo');
						#debug($term);
						$periodos = $this->Periodo->autocompletarByPeriodo($term);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($periodos)) {
							foreach ($periodos as $periodo):
								$dato_a_mostrar[]=array(
									'label'=>$periodo['Periodo']['ANHO']."-".$periodo['Periodo']['SEMESTRE'],
									'uuid'=>$periodo['Periodo']['COD_PERIODO']
								);
							endforeach;	
						}
						if (isset($periodo)) {
							unset($dato_a_mostrar[0]);
						}
					}
					break;
				case 'ProgramacionClase.COD_JORNADA':
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('ProgramacionClase');
						$term = strtoupper(substr($term, 0,1));
						#debug($term);
						$jornadas = $this->ProgramacionClase->autocompletarByJornada($term);
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
						if (!empty($jornadas)) {
							foreach ($jornadas as $jornada):
								if ($jornada['COD_JORNADA']=='D') {
									$label = 'DIURNO';
								}elseif ($jornada['COD_JORNADA']=='V') {
									$label = 'VESPERTINO';
								}
								$dato_a_mostrar[]=array(
									'label'=>$label,
									'uuid'=>$jornada['COD_JORNADA'],
								);
							endforeach;	
						}
						if (isset($jornada)) {
							unset($dato_a_mostrar[0]);
						}	
					}
					break;
				case 'ProgramacionClase.horario':
					$horarios = array();
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$term = strtoupper($term);
						$this->loadModel('HorarioModulo');
						$horarios = $this->HorarioModulo->find(
							'all',
							array(
								'conditions'=>array(
									'OR'=>array(
										"HORA_INICIO like '%".$term."%'",
										"HORA_FIN like '%".$term."%'",
										"CONCAT(HORA_INICIO,CONCAT(' - ',HORA_FIN)) like '%".$term."%'",
										"CONCAT(HORA_INICIO,CONCAT('-',HORA_FIN)) like '%".$term."%'",
										"CONCAT(HORA_INICIO,CONCAT(' ',HORA_FIN)) like '%".$term."%'",
									)
								),
								'order'=>'HorarioModulo.HORA_INICIO'
							)
						);
					}
					if (!empty($horarios)) {
						foreach ($horarios  as $horario):
							$dato_a_mostrar[]=array(
								'label'=>$horario['HorarioModulo']['HORA_INICIO'].' - '.$horario['HorarioModulo']['HORA_FIN'],
								'uuid'=>$horario['HorarioModulo']['HORA_INICIO'].'|'.$horario['HorarioModulo']['HORA_FIN']
							);
						endforeach;	
					}else{
						$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
					}
					break;
				case 'ProgramacionClase.detalle':
					$detalles = array();
					$term = isset($_GET['term'])? $_GET['term']:null;
					// debug($term);exit();
					if (!empty($term)) {
						$term = strtoupper($term);
						$this->loadModel('Detalle');
						$detalles = $this->Detalle->getDetalles($term);
					}
					$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
					if (!empty($detalles)) {
						foreach ($detalles as $detalle):
							$dato_a_mostrar[]=array(
								'label'=>$detalle['Detalle']['DETALLE'],
								'uuid'=>$detalle['Detalle']['ID']
							);
						endforeach;	
					}
					if (isset($detalle)) {
						unset($dato_a_mostrar[0]);
					}
					break;
				case 'ProgramacionClase.ESTADO_PROGRAMACION_ID':
				#case 'ProgramacionClase.estado':
					$estados = array();
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('Estado');
						$estados = $this->Estado->autocompletarEstado($term);
					}
					$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'');
					if (!empty($estados)) {
						foreach ($estados as $nombre):
							$dato_a_mostrar[]=array(
								'label'=>$nombre['Estado']['NOMBRE'],
								'uuid'=>$nombre['Estado']['ID']
							);
						endforeach;	
					}
					if (isset($nombre)) {
						unset($dato_a_mostrar[0]);
					}
					break;
				case 'ProgramacionClase.sub_estado':
					$sub_estados = array();
					$term = isset($_GET['term'])? $_GET['term']:null;
					if (!empty($term)) {
						$this->loadModel('SubEstado');
						$sub_estados = $this->SubEstado->autocompletarSubEstadoNew($term);
					}
					$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','data'=>'','nombre_usuario'=>'');
					if (!empty($sub_estados)) {
						foreach ($sub_estados as $nombre):
							$dato_a_mostrar[]=array(
								'label'=>$nombre['SubEstado']['NOMBRE'],
								'uuid'=>$nombre['SubEstado']['ID']
							);
						endforeach;	
					}
					if (isset($nombre)) {
						unset($dato_a_mostrar[0]);
					}
					break;
				default:
					$dato_a_mostrar[0]=array('label'=>'NO HAY RESULTADOS','uuid'=>'','data'=>'','nombre_usuario'=>'');
					break;
			}
			echo json_encode($dato_a_mostrar);
		}
		public function autorizacionFichaDetalle($cod_programacion=null)
		{
			$this->loadModel('MotivoRechazoClase');
			$motivos = $this->MotivoRechazoClase->find('all');
			if (!empty($cod_programacion)) {
				$this->loadModel('ProgramacionClase');
				$info_editar_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			} else {
				$this->Session->setFlash('No ha sido posible encontrar la clase a editar', 'mensaje-error');
				$this->redirect(array('action'=>'index'));
			}
			// debug($info_editar_clase);
			$this->set(array(
				'info_editar_clase'=>$info_editar_clase,
				'motivos'=>$motivos,
			));
		}
		public function autorizacionClaseExcel()
		{
			$this->layout = 'excel';
			if (!empty($this->data)) {
				$autorizaciones_clase = $this->data;
				// debug($autorizaciones_clase); exit();
			}
			$this->set('autorizaciones_clase',$autorizaciones_clase);
		}
		public function recuperarClases($filtro_multiple=FALSE) 
		{
			$datos_filtro = array();
			$session_data = $this->Session->read('DirectorLogueado');
			$ordenar = 'ProgramacionClase.FECHA_CLASE';
			$fecha_inicio = $fecha_fin = $tipo_filtro = $valor_filtro = null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);exit();
				if (!empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_inicio = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}else{
					$fecha_inicio = date('Y-m-d');
				}
				if (!empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_fin = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}else{
					$fecha_fin = date('Y-m-d');
				}
				if (isset($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$valor_filtro = $datos_filtro['Filtro']['value'];
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
				}
				$tipo_filtro = in_array($tipo_filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO')) ? 'Docente.COD_DOCENTE': $tipo_filtro;
				$tipo_filtro = ($tipo_filtro == 'Asignatura.NOMBRE') ? 'Asignatura.SIGLA' : $tipo_filtro;
				$tipo_filtro = ($tipo_filtro == 'ProgramacionClase.detalle') ? 'ProgramacionClase.detalle_id' : $tipo_filtro;

			}
			$sede_id = $session_data['Sede']['COD_SEDE'];
			$this->loadModel('ProgramacionClase');	
			if ($filtro_multiple) {
				if (!empty($this->data)) {
					$datos_filtro = $this->data;
					$conditions = $this->procesarDatosFiltroMultiple($datos_filtro);
					$datos_tabla = $this->ProgramacionClase->getDatosTablaRecuperarClaseNewMultiple($conditions,$ordenar);
				}
			}else{
				$datos_tabla = $this->ProgramacionClase->getDatosTablaRecuperarClaseNew($fecha_inicio,$fecha_fin,$sede_id,$tipo_filtro,$valor_filtro,$ordenar);
			}
			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro,
				'ordenar'=>$ordenar,
			));
			#FILTRO MULTIPLE
				$this->loadModel('Periodo');
				$periodos = $this->Periodo->getPeriodos();
				$this->loadModel('Detalle');
				##NEGOCIO EXCLUSIVO DE LA PANTALLA
				$detalles = $this->Detalle->find('all', array(
					'conditions'=>array(
						'ID'=>array('3','4','5'),
					),
					'order'=>'Detalle.DETALLE'
				));
				$this->loadModel('SubEstado');
				##NEGOCIO EXCLUSIVO DE LA PANTALLA
				$sub_estados = $this->SubEstado->find('all', array('conditions'=>array('ID <= 3'),'order'=>'SubEstado.NOMBRE'));
				$this->loadModel('Estado');
				$estados = $this->Estado->getEstados();
				$this->loadModel('HorarioModulo');
				$horarios = $this->HorarioModulo->getSimpleHorarioBySede($sede_id);
				$this->set(array(
					'detalles'=>$detalles,
					'horarios'=>$horarios,
					'periodos'=>$periodos,
					'estados'=>$estados,
					'sub_estados'=>$sub_estados,
					'filtro_multiple'=>$filtro_multiple,
				));
			#FIN FILTRO MULTIPLE
		}
		public function recuperarClasesExcel() 
		{
			$this->layout='excel';
			$datos_excel = $this->data;
			if (!empty($datos_excel)) {
				$this->set(array(
					'datos_excel'=>$datos_excel
				));
			}
		}
		public function cambioEstadoRecuperacionClase($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($clase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente más tarde.', 'mensaje-error');
				$this->redirect(array('action'=>'recuperarClases'));
			}
			if ($clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'] == 5) {
				$this->Session->setFlash('Esta clase no esta disponible para cambio de estado.', 'mensaje-info');
				$this->redirect(array('action'=>'editarRecuperacionClase',$cod_programacion));
			}
			#cambiar sub estado de 7 a por recuperar 5
			$up_clase['SUB_ESTADO_PROGRAMACION_ID'] = 5;
			$up_clase['ID'] = $clase['ProgramacionClase']['ID'];
			$this->ProgramacionClase->create(FALSE);
			if($this->ProgramacionClase->save($up_clase)){	
				// CORREO AL COORDINADOR DOCENTE
				$this->loadModel('CoordinadorDocente');
				$coordinador = $this->CoordinadorDocente->getCoordinadorDocente($clase['ProgramacionClase']['COORDINADOR_CREATED_ID']);
				if (!empty($coordinador)) {
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->to($coordinador['CoordinadorDocente']['CORREO']);
					$Email->helpers(array('Html'));
					$Email->subject('Ajuste de Estado de una clase / '.$clase['ProgramacionClase']['SIGLA_SECCION']);
					$Email->from('lvc@duoc.cl');
					$Email->viewVars(array('clase' => $clase, 'coordinador'=>$coordinador));
					$Email->template('recuperacion_clase_coordinador_docente');
					if(!$Email->send()){
						$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
					};
				}else{
					$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].": NO SE ENCUENTRA FUNCIONARIO : ".$cod_funcionario, 'debug');
				}
				$this->Session->setFlash('Autorización realizada con éxito.', 'mensaje-exito');
				$this->redirect(array('action'=>'recuperarClases'));
			};
			$this->Session->setFlash('Ha ocurrido un problema. Intente nuevamente', 'mensaje-info');
			$this->redirect(array('action'=>'editarRecuperacionClase', $cod_programacion));
		}
		public function recuperarClasesPdf($value=FALSE) 
		{
			$this->layout='';
			$datos_pdf = $this->data;
			// debug($datos_pdf); exit();
			if (!empty($datos_pdf)) {
				$this->set(array(
					'datos_pdf'=>$datos_pdf
				));
			}
			$this->Mpdf->init(array('margin_top' => 20,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('Clases por recuperar.pdf');
			$this->Mpdf->addPage('L');
			// $this->Mpdf->setOutput('D');
			if ($value) {
				$this->Mpdf->setOutput('A');
			} else {
				$this->Mpdf->setOutput('D');
			}
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);	
		}
		public function editarRecuperacionClase($cod_programacion=null)
		{
			if (!empty($cod_programacion)) {
				$this->loadModel('ProgramacionClase');
				$info_editar_recuperacion = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			} else {
				$this->Session->setFlash('No ha sido posible encontrar la clase a editar', 'mensaje-error');
				$this->redirect(array('action'=>'index'));
			}
			$this->set('info_editar_recuperacion', $info_editar_recuperacion);
		}	
		public function reforzamientos($filtro_multiple = null)
		{
			$datos_filtro=array();
			$director = $this->Session->read('DirectorLogueado');
			$ordenar = 'ProgramacionClase.FECHA_CLASE';
			$fecha_desde = $fecha_hasta = $tipo_filtro = $valor_filtro = null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = $datos_filtro['Filtro']['fecha_inicio'];
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = $datos_filtro['Filtro']['fecha_fin'];
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value'];
				}
				if (isset($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$tipo_filtro = in_array($tipo_filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO')) ? 'Docente.COD_DOCENTE': $tipo_filtro;
				$tipo_filtro = ($tipo_filtro == 'Asignatura.NOMBRE') ? 'Asignatura.SIGLA' : $tipo_filtro;
				$tipo_filtro = ($tipo_filtro == 'ProgramacionClase.detalle') ? 'ProgramacionClase.detalle_id' : $tipo_filtro;
			}
			$this->loadModel('ProgramacionClase');
			$sede_id = $director['Sede']['COD_SEDE'];
			if ($filtro_multiple == 1) {
				$conditions = $this->procesarDatosFiltroMultiple($datos_filtro);
				$datos_tabla = $this->ProgramacionClase->getDatosTablaReforzamientosNewMultiple($conditions,$ordenar);
			}else{
				#debug($fecha_desde);debug($fecha_hasta);
				$datos_tabla = $this->ProgramacionClase->getDatosTablaReforzamientosNew($fecha_desde,$fecha_hasta,$sede_id,$tipo_filtro,$valor_filtro,$ordenar);
			}
			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro
			));
			#FILTRO MULTIPLE
				$this->loadModel('Periodo');
				$periodos = $this->Periodo->getPeriodos();
				$this->loadModel('Detalle');
				$detalles = $this->Detalle->getAllDetalles();
				$this->loadModel('SubEstado');
				#NEGOCIO EXCLUSIVO DE LA PANTALLA;
				$sub_estados = $this->SubEstado->find('all', array('conditions'=>array('ID <= 3'),'order'=>'SubEstado.NOMBRE'));
				$this->loadModel('Estado');
				$estados = $this->Estado->getEstados();
				$this->loadModel('HorarioModulo');
				$horarios = $this->HorarioModulo->getSimpleHorarioBySede($sede_id);
				$this->set(array(
					'detalles'=>$detalles,
					'horarios'=>$horarios,
					'periodos'=>$periodos,
					'estados'=>$estados,
					'sub_estados'=>$sub_estados,
					'filtro_multiple'=>$filtro_multiple,
				));
			#FIN FILTRO MULTIPLE
		}
		public function reforzamientosExcel()
		{
			$this->layout = 'excel';
			$datos_filtro=array();
			$director = $this->Session->read('DirectorLogueado');
			$fecha_inicio = $fecha_fin = $tipo_filtro = $valor_filtro = null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = $datos_filtro['Filtro']['fecha_inicio'];
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = $datos_filtro['Filtro']['fecha_fin'];
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$sede_id = $director['Sede']['COD_SEDE'];
			$datos_tabla = $this->ProgramacionClase->getDatosTablaReforzamientosNew($fecha_inicio,$fecha_fin,$sede_id,$tipo_filtro,$valor_filtro);

			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro
			));
		}
		public function reforzamientosPdf()
		{
			$this->layout = null;
			$datos_filtro=array();
			$director = $this->Session->read('DirectorLogueado');
			$fecha_inicio = $fecha_fin = $tipo_filtro = $valor_filtro = null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = $datos_filtro['Filtro']['fecha_inicio'];
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = $datos_filtro['Filtro']['fecha_fin'];
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$sede_id = $director['Sede']['COD_SEDE'];
			$datos_tabla = $this->ProgramacionClase->getDatosTablaReforzamientosNew($fecha_inicio,$fecha_fin,$sede_id,$tipo_filtro,$valor_filtro);
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('Clases por recuperar.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('A');
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);	
			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro
			));
		}
		public function reforzamientosImprimir()
		{
			$this->layout = 'imprimir';
			$datos_filtro=array();
			$director = $this->Session->read('DirectorLogueado');
			$fecha_inicio = $fecha_fin = $tipo_filtro = $valor_filtro = null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = $datos_filtro['Filtro']['fecha_inicio'];
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = $datos_filtro['Filtro']['fecha_fin'];
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$sede_id = $director['Sede']['COD_SEDE'];
			$datos_tabla = $this->ProgramacionClase->getDatosTablaReforzamientosNew($fecha_inicio,$fecha_fin,$sede_id,$tipo_filtro,$valor_filtro);

			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro
			));
		}
		public function reforzamientoFichaDetalle($cod_programacion=null)
		{
			if (!empty($cod_programacion)) {
				$this->loadModel('ProgramacionClase');
				$info_editar_recuperacion = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			} else {
				$this->Session->setFlash('No ha sido posible encontrar la clase a editar', 'mensaje-error');
				$this->redirect(array('action'=>'index'));
			}
			$this->loadModel('MotivosRechazoReforzamiento');
			$motivos = $this->MotivosRechazoReforzamiento->getMotivosRechazo();
			$this->set(array(
				'info_editar_recuperacion'=>$info_editar_recuperacion,
				'motivos'=>$motivos,
			));
		}
		public function reprobados($filtro_multiple = false)
		{
			
			$datos_filtro=array();
			#$fecha_inicio = $fecha_fin = date('Y-m-d');
			$tipo_filtro = $valor_filtro = null;
			$ordenar = 'ProgramacionClase.FECHA_CLASE';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value']; 
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('DirectorLogueado');

			if ($filtro_multiple) {

				$conditions = $this->procesarDatosFiltroMultiple($datos_filtro);

				$datos_tabla = $this->ProgramacionClase->getDatosTablaReprobadosNewMultiple($conditions,$ordenar);

			}else{
				#debug($ordenar);exit();
				$datos_tabla = $this->ProgramacionClase->getDatosTablaReprobadosNew($session_data['Sede']['COD_SEDE'],$tipo_filtro,$valor_filtro,$ordenar);
			}

			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro,
				'ordenar'=>$ordenar,
			));
			#FILTRO MULTIPLE
				$this->loadModel('Periodo');
				$periodos = $this->Periodo->getPeriodos();
				$this->set(array(
					'periodos'=>$periodos,
					'filtro_multiple'=>$filtro_multiple,
				));
			#FIN FILTRO MULTIPLE
			#exit;
		}
		public function reprobadosExcel()
		{
			$this->layout = 'excel';
			$datos_filtro=array();
			$fecha_inicio = $fecha_fin = $tipo_filtro = $valor_filtro = $ordenar=null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_inicio = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_fin = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value']; 
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('DirectorLogueado');
			$datos_tabla = $this->ProgramacionClase->getDatosTablaReprobadosNew($fecha_inicio,$fecha_fin,$session_data['Sede']['COD_SEDE'],$tipo_filtro,$valor_filtro,$ordenar);
			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro,
			));
			#exit;
		}
		public function reprobadosPdf()
		{
			$this->layout = null;
			$datos_filtro=array();
			$fecha_inicio = $fecha_fin = $tipo_filtro = $valor_filtro = $ordenar = null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_inicio = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_fin = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value']; 
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('DirectorLogueado');
			$datos_tabla = $this->ProgramacionClase->getDatosTablaReprobadosNew($fecha_inicio,$fecha_fin,$session_data['Sede']['COD_SEDE'],$tipo_filtro,$valor_filtro,$ordenar);
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reprobados.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('A');
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro,
			));
			#exit;
		}
		public function reprobadosImprimir()
		{
			$this->layout = 'imprimir';
			$datos_filtro=array();
			$fecha_inicio = $fecha_fin = $tipo_filtro = $valor_filtro = $ordenar = null;
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_inicio = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_fin = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (!empty($datos_filtro['Filtro']['filtro']) && !empty($datos_filtro['Filtro']['value'])) {
					$tipo_filtro = $datos_filtro['Filtro']['filtro'];
					$valor_filtro = $datos_filtro['Filtro']['value']; 
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('DirectorLogueado');
			$datos_tabla = $this->ProgramacionClase->getDatosTablaReprobadosNew($fecha_inicio,$fecha_fin,$session_data['Sede']['COD_SEDE'],$tipo_filtro,$valor_filtro,$ordenar);
			$this->set(array(
				'datos_tabla'=>$datos_tabla,
				'datos_filtro'=>$datos_filtro
			));
		}
		public function reprobadoFichaDetalle($cod_asignatura_horario=null) 
		{
			if (empty($cod_asignatura_horario)) {
				$this->Session->setFlash('El parametro de entrada esta vacío. Intente nuevamente.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);


			if (empty($asignatura_horario)) {
				$this->Session->setFlash('No se ha encontrado el registro a editar.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			if ($asignatura_horario['AsignaturaHorario']['RI_ENABLE']==1) {
				$this->Session->setFlash('Esta sección aun no esta dispoble para gestionar RI.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			$this->loadModel('ProgramacionClase');
			$clases_regulares = $this->ProgramacionClase->countClasesRegulares($cod_asignatura_horario);
			$clases_suspendidas = $this->ProgramacionClase->countClasesSuspendidas($cod_asignatura_horario);
			$this->loadModel('AlumnoAsignatura');
			$this->loadModel('RI_IM');
			#debug($asignatura_horario);exit();
			if ($asignatura_horario['AsignaturaHorario']['RI_IMPORT'] == 1) {
				$alumnos = $this->RI_IM->getAlumnoByRi($cod_asignatura_horario);
			}else{
				$alumnos = $this->AlumnoAsignatura->getListadoAlumnosSeccionForRI($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']);

			}
			#DEBUG($alumnos);exit();
			$indicadores_alumnos = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']);

			
			

			$this->set(array(
				'alumnos'=>$alumnos,
				'asignatura_horario'=>$asignatura_horario,
				'clases_regulares'=>$clases_regulares,
				'clases_suspendidas'=>$clases_suspendidas,
				'indicadores_alumnos'=>$indicadores_alumnos,
			));
		}
		public function reprobadoExcelDetalle($cod_asignatura_horario=null) 
		{
			$this->layout = null;
			if (empty($cod_asignatura_horario)) {
				$this->Session->setFlash('El parametro de entrada esta vacío. Intente nuevamente.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('No se ha encontrado el registro a editar.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			if ($asignatura_horario['AsignaturaHorario']['RI_ENABLE']==1) {
				$this->Session->setFlash('Esta sección aun no esta dispoble para gestionar RI.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			$this->loadModel('ProgramacionClase');
			$clases_regulares = $this->ProgramacionClase->countClasesRegulares($cod_asignatura_horario);
			$clases_suspendidas = $this->ProgramacionClase->countClasesSuspendidas($cod_asignatura_horario);
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAlumnosSeccionForRI($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']);
			$indicadores_alumnos = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']);
			$this->set(array(
				'alumnos'=>$alumnos,
				'asignatura_horario'=>$asignatura_horario,
				'clases_regulares'=>$clases_regulares,
				'clases_suspendidas'=>$clases_suspendidas,
				'indicadores_alumnos'=>$indicadores_alumnos,
			));
		}
		public function reprobadoPdfDetalle($cod_asignatura_horario=null) 
		{
			$this->layout = null;
			if (empty($cod_asignatura_horario)) {
				$this->Session->setFlash('El parametro de entrada esta vacío. Intente nuevamente.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('No se ha encontrado el registro a editar.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			if ($asignatura_horario['AsignaturaHorario']['RI_ENABLE']==1) {
				$this->Session->setFlash('Esta sección aun no esta dispoble para gestionar RI.', 'mensaje-error');
				$this->redirect(array('action'=>'reprobados'));
			}
			$this->loadModel('ProgramacionClase');
			$clases_regulares = $this->ProgramacionClase->countClasesRegulares($cod_asignatura_horario);
			$clases_suspendidas = $this->ProgramacionClase->countClasesSuspendidas($cod_asignatura_horario);
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAlumnosSeccionForRI($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']);
			$indicadores_alumnos = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']);
			$this->set(array(
				'alumnos'=>$alumnos,
				'asignatura_horario'=>$asignatura_horario,
				'clases_regulares'=>$clases_regulares,
				'clases_suspendidas'=>$clases_suspendidas,
				'indicadores_alumnos'=>$indicadores_alumnos,
			));
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reprobados.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('A');
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
		}
		public function sendRiSap($cod_asignatura_horario=null)
		{
			if (!empty($this->data)) {
				if (empty($cod_asignatura_horario)) {
					$this->Session->setFlash('El parametro de entrada esta vacío. Intente nuevamente.', 'mensaje-error');
					$this->redirect(array('action'=>'reprobados'));
				}
				$this->loadModel('AsignaturaHorario');
				$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
				if (empty($asignatura_horario)) {
					$this->Session->setFlash('No se ha encontrado el registro a editar.', 'mensaje-error');
					$this->redirect(array('action'=>'reprobados'));
				}
				if ($asignatura_horario['AsignaturaHorario']['RI_ENVIADO_A_SAP']==1) {
					$this->Session->setFlash('Esta sección ya fue enviada a SAP.', 'mensaje-error');
					$this->redirect(array('action'=>'reprobadoFichaDetalle',$cod_asignatura_horario));
				}
				##debug($asignatura_horario);
				$error = 0;
				if (isset($this->data['Alumno'])) {
					$this->loadModel('RI');
					$this->loadModel('Alumno');
					foreach ($this->data['Alumno'] as $key => $value) {
						$alumno = $this->Alumno->getAlumnoByCod($value['ID_ALUMNO']);
						if (!empty($alumno)) {
							$ri_director = 0;
							$fecha_envio_sap = null;
							if (isset($value['RI']) && (int)$value['RI']===1) {
								$ri_director = 1;
								if ($this->data['borrador']!=1) {
									$fecha_envio_sap = date('Y-m-d H:i:s');
									$response_sap = $this->Integracion->sendRi(
										$asignatura_horario['AsignaturaHorario']['SM_OBJID'],
										$asignatura_horario['Periodo']['SEMESTRE'],
										$asignatura_horario['Periodo']['ANHO'],
										$alumno['Alumno']['RUT'].''.$alumno['Alumno']['DV_RUT']);
								}
							}
							$ri = $this->RI->getReprobadoInasistencia($value['ID_ALUMNO'],$cod_asignatura_horario);
							if (!empty($ri)) {
								$ri['RI']['RI_DIRECTOR'] = $ri_director;
								$ri['RI']['FECHA_ENVIO_RI_SAP'] = $fecha_envio_sap;
								$ri['RI']['BORRADOR'] = isset($this->data['borrador'])?1:0;
								$this->RI->save($ri);
							}
						}
					}
					if ($this->data['borrador']!=1) {
						$asignatura_horario['AsignaturaHorario']['RI_ENVIADO_A_SAP'] = 1;
						$asignatura_horario['AsignaturaHorario']['FECHA_ENVIO_SAP'] = date('Y-m-d H:i:s');
						$session_data = $this->Session->read('DirectorLogueado');
						$asignatura_horario['AsignaturaHorario']['DIRECTOR_SEND_SAP_ID'] = $session_data['Director']['COD'];
						if ($error == 0) {
							if ($this->AsignaturaHorario->save($asignatura_horario)) {
								$this->Session->setFlash('Ri enviado con éxito.', 'mensaje-exito');
								$this->redirect(array('action'=>'reprobadoFichaDetalle',$cod_asignatura_horario));
							}
						}
					}else{
						if ($error == 0) {
							$this->Session->setFlash('Guardado con éxito.', 'mensaje-exito');
							$this->redirect(array('action'=>'reprobadoFichaDetalle',$cod_asignatura_horario));
							
						}
					}
				}
			}
			$this->Session->setFlash('El parametro de entrada esta vacío. Intente nuevamente.', 'mensaje-error');
			$this->redirect(array('action'=>'reprobadoFichaDetalle',$cod_asignatura_horario));
		}
		public function reportes() 
		{
		}
		public function loginDirectores()
		{
			$this->layout = 'login-directores';

			#		
		}
		public function autorizacionClase($cod_programacion=null, $rechazada=null)
		{
			$director = $this->Session->read('DirectorLogueado');
			if (empty($director)) {
				$this->redirect(array('controller'=>'login','action'=>'logoutDirector'));
			}
			$this->autoRender = false;
			#AUTORIZACION MASIVO
			if (empty($cod_programacion)) {
				if (!empty($this->data['Autorizacion'])) {
					$this->loadModel('ProgramacionClase');
					$this->loadModel('Docente');
					$this->loadModel('CoordinadorDocente');
					$clase_autorizada_anteriormente=0;
					foreach ($this->data['Autorizacion'] as $key => $clase) {
						$clase_a_autorizar = $this->ProgramacionClase->getProgramacionClaseFull($clase['cod_asigntura_seleccionada']);
						if (empty($clase_a_autorizar)) continue;
						if ($clase_a_autorizar['ProgramacionClase']['ESTADO_PROGRAMACION_ID']==3 && $clase_a_autorizar['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID']==2) {
							$clase_autorizada_anteriormente++;
							#continue;
						}
						$up_clase['ID'] = $clase_a_autorizar['ProgramacionClase']['ID'];
						$up_clase['ESTADO_PROGRAMACION_ID']=3;
						$up_clase['SUB_ESTADO_PROGRAMACION_ID']=2; 
						$this->ProgramacionClase->create(FALSE);
						if(!$this->ProgramacionClase->save($up_clase)) continue;
						if ($clase_a_autorizar['ProgramacionClase']['ADELANTAR_CLASE']==1 && !empty($clase_a_autorizar['ProgramacionClase']['COD_PROGRAMACION_PADRE'])) {
							$clase_padre = $this->ProgramacionClase->getProgramacionClase($clase_a_autorizar['ProgramacionClase']['COD_PROGRAMACION_PADRE']);
							if (!empty($clase_padre)) {
								$update_clase_padre = array(
									'ID'=>$clase_padre['ProgramacionClase']['ID'],
									'ESTADO_PROGRAMACION_ID'=>2,
									'SUB_ESTADO_PROGRAMACION_ID'=>8,
									'DETALLE_ID'=>6,
								);
								$this->ProgramacionClase->create(FALSE);
								$this->ProgramacionClase->save($update_clase_padre);
							}
						}
						$docente = $this->Docente->getDocente($clase_a_autorizar['ProgramacionClase']['COD_DOCENTE']);
						// CORREO AL DOCENTE
						$Email = new CakeEmail();
						$Email->emailFormat('html');
						$Email->to($docente['Docente']['CORREO']);
						$Email->helpers(array('Html'));
						$Email->subject('Solicitud de Adelantar Clase Rechazada / '.$clase_a_autorizar['ProgramacionClase']['SIGLA_SECCION']);
						$Email->from('lvc@duoc.cl');
						$Email->viewVars(array('clase' => $clase_a_autorizar, 'docente'=>$docente));
						$Email->template('autorizar_clases_docente');
						$Email->send();
						
						// CORREO AL DIRECTOR
						$Email = new CakeEmail();
						$Email->emailFormat('html');
						$Email->to($director['Director']['CORREO']);
						$Email->helpers(array('Html'));
						$Email->subject('Solicitud de Adelantar Clase Rechazada / '.$clase_a_autorizar['ProgramacionClase']['SIGLA_SECCION']);
						$Email->from('lvc@duoc.cl');
						$Email->viewVars(array('clase' => $clase_a_autorizar, 'director'=>$director,));
						$Email->template('autorizar_clases_director');
						$Email->send();

						// CORREO AL COORDINADOR DOCENTE
						$coordinador = $this->CoordinadorDocente->getCoordinadorDocente($clase_a_autorizar['ProgramacionClase']['COORDINADOR_CREATED_ID']);
						if (!empty($coordinador) &&  !empty($coordinador['CoordinadorDocente']['CORREO'])) {
							$Email = new CakeEmail();
							$Email->emailFormat('html');
							$Email->to($coordinador['CoordinadorDocente']['CORREO']);
							$Email->helpers(array('Html'));
							$Email->subject('Solicitud de Clase Autorizada  / '.$clase_a_autorizar['ProgramacionClase']['SIGLA_SECCION']);
							$Email->from('lvc@duoc.cl');
							$Email->viewVars(array('clase' => $clase_a_autorizar, 'administrador'=>$coordinador));
							$Email->template('autorizar_clases_coordinador_docente');
							$Email->send();
						}else{
							$this->log("No se pudo enviar el mail al coordinador en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($coordinador)."</serialize>", 'debug');
						}
					}
					if ($clase_autorizada_anteriormente > 0) {
						$this->Session->setFlash('Algunas clases ya estaban autorizadas. Operación realizada con éxito.', 'mensaje-exito',$this->data['Filtro']);
					}else{
						$this->Session->setFlash('Autorización realizada con éxito.', 'mensaje-exito',$this->data['Filtro']);
					}
					$this->redirect(array('action'=>'index',));	
				}else{
					$this->Session->setFlash('Debe seleccionar por lo menos una clase para autorizar', 'mensaje-info');
					$this->redirect(array('action'=>'index'));
				}
			}else{
				#AUTORIZACION O RECHAZO POR CLASE
				$this->loadModel('ProgramacionClase');
				$clase_a_autorizar = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
				if ($clase_a_autorizar['ProgramacionClase']['ESTADO_PROGRAMACION_ID']==3 && $clase_a_autorizar['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID']==2 && $rechazada==false) {
					$this->Session->setFlash('Clase ya esta autorizada.', 'mensaje-info');
					$this->redirect(array('action'=>'autorizacionFichaDetalle', $cod_programacion));
				}
				#debug($clase_a_autorizar);#exit();
				$up_clase['ID'] = $clase_a_autorizar['ProgramacionClase']['ID'];
				if ($rechazada){
					$up_clase['ESTADO_PROGRAMACION_ID']=2;
					$up_clase['SUB_ESTADO_PROGRAMACION_ID']=3;
				}else{
					$up_clase['ESTADO_PROGRAMACION_ID']=3;
					$up_clase['SUB_ESTADO_PROGRAMACION_ID']=2; 
				}
				$this->ProgramacionClase->create(FALSE);
				if(!$this->ProgramacionClase->save($up_clase)){
					$this->Session->setFlash('No se pudo modificar la información. Intente nuevamente.', 'mensaje-info');
					$this->redirect(array('action'=>'autorizacionFichaDetalle', $cod_programacion));
				}else{
					#ACTUALIZAR CLASE PADRE CUANDO SEA AUTORIZADO EL ADELANTAMIENTO DE CLASES.
					if (empty($rechazada)) {
						#debug($clase_a_autorizar);
						#debug($rechazada);exit;
						if ($clase_a_autorizar['ProgramacionClase']['ADELANTAR_CLASE']==1 && !empty($clase_a_autorizar['ProgramacionClase']['COD_PROGRAMACION_PADRE'])) {
							$clase_padre = $this->ProgramacionClase->getProgramacionClase($clase_a_autorizar['ProgramacionClase']['COD_PROGRAMACION_PADRE']);
							if (!empty($clase_padre)) {
								$update_clase_padre = array(
									'ID'=>$clase_padre['ProgramacionClase']['ID'],
									'ESTADO_PROGRAMACION_ID'=>2,
									'SUB_ESTADO_PROGRAMACION_ID'=>8,
									'DETALLE_ID'=>6
								);
								$this->ProgramacionClase->create(FALSE);
								$this->ProgramacionClase->save($update_clase_padre);
								#debug($this->ProgramacionClase->getLastQuery());
								#debug($update_clase_padre);exit;
							}
						}
					}

				}
				
				// CORREO AL COORDINADOR DOCENTE
				$this->loadModel('CoordinadorDocente');
				$coordinador = $this->CoordinadorDocente->getCoordinadorDocente($clase_a_autorizar['ProgramacionClase']['COORDINADOR_CREATED_ID']);
				if (!empty($coordinador) &&  !empty($coordinador['CoordinadorDocente']['CORREO'])) {
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->to($coordinador['CoordinadorDocente']['CORREO']);
					$Email->helpers(array('Html'));
					$Email->subject('Solicitud de Clase Autorizada  / '.$clase_a_autorizar['ProgramacionClase']['SIGLA_SECCION']);
					$Email->from('lvc@duoc.cl');
					$Email->viewVars(array('clase' => $clase_a_autorizar, 'administrador'=>$coordinador));
					$Email->template('autorizar_clases_coordinador_docente');
					$Email->send();
				}else{
					$this->log("No se pudo enviar el mail al coordinador en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($coordinador)."</serialize>", 'debug');
				}
				
				// CORREO AL DOCENTE
				$this->loadModel('Docente');
				$docente = $this->Docente->getDocente($clase_a_autorizar['ProgramacionClase']['COD_DOCENTE']);
				if (!empty($docente)) {
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->to($docente['Docente']['CORREO']);
					$Email->helpers(array('Html'));
					$Email->subject('Solicitud de Clase Autorizada  / '.$clase_a_autorizar['ProgramacionClase']['SIGLA_SECCION']);
					$Email->from('lvc@duoc.cl');
					$Email->viewVars(array('clase' => $clase_a_autorizar, 'docente'=>$docente));
					$Email->template('autorizar_clases_docente');
					$Email->send();
				}else{
					$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($docente)."</serialize>", 'debug');
				}
				// CORREO A LOS ALUMNOS
				$this->loadModel('Periodo');
				$periodo = $this->Periodo->getPeriodoByAnhoSemestre($clase_a_autorizar['ProgramacionClase']['ANHO'],$clase_a_autorizar['ProgramacionClase']['SEMESTRE']);
				if (!empty($periodo)) {
					$this->loadModel('AlumnoAsignatura');
					$alumnos = $this->AlumnoAsignatura->getListadoAsistencia($clase_a_autorizar['ProgramacionClase']['SIGLA_SECCION'],$periodo['Periodo']['COD_PERIODO'],$clase_a_autorizar['ProgramacionClase']['COD_SEDE']);
					#debug($alumnos);exit();
					foreach ($alumnos as $key => $value) {
						$Email = new CakeEmail();
						$Email->emailFormat('html');
						$Email->to($value['Alumno']['CORREO_PERSONAL']);
						$Email->helpers(array('Html'));
						$Email->subject('Nueva Clase / '.$clase_a_autorizar['ProgramacionClase']['SIGLA_SECCION']);
						$Email->from('lvc@duoc.cl');
						$Email->viewVars(array('clase' => $clase_a_autorizar, 'alumno'=>$value));
						$Email->template('autorizar_clases_alumnos');
						$Email->send();

					}
				}

				if ($rechazada) {
					$this->Session->setFlash('La clase ha sido rechazada con éxito.', 'mensaje-exito');
					$this->redirect(array('action'=>'autorizacionFichaDetalle', $cod_programacion));
				}else{
					$this->Session->setFlash('Autorización realizada con éxito.', 'mensaje-exito');
					$this->redirect(array('action'=>'autorizacionFichaDetalle', $cod_programacion));
				}
			}
		}
		public function alumnosTope($sigla_seccion=null,$cod_programacion=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClase($cod_programacion);
			$alumnos = Array();
			$count_topes=0;
			if (!empty($programacion_clase)) {
				$this->loadModel('Periodo');
				$periodo = $this->Periodo->getPeriodoByAnhoSemestre($programacion_clase['ProgramacionClase']['ANHO'],$programacion_clase['ProgramacionClase']['SEMESTRE']);
				if (!empty($periodo)) {
					$this->loadModel('AlumnoAsignatura');
					$alumnos = $this->AlumnoAsignatura->getListadoAsistencia($sigla_seccion,$periodo['Periodo']['COD_PERIODO'],$programacion_clase['ProgramacionClase']['COD_SEDE']);
					foreach ($alumnos as $key => $value) {
						#debug($value);
						$tope = $this->ProgramacionClase->getIdTopeHorario(
							$sigla_seccion,
							$periodo['Periodo']['COD_PERIODO'],
							$programacion_clase['ProgramacionClase']['ANHO'],
							$programacion_clase['ProgramacionClase']['SEMESTRE'],
							$value['Alumno']['COD_ALUMNO'],
							$programacion_clase['ProgramacionClase']['HORA_INICIO'],
							$programacion_clase['ProgramacionClase']['HORA_FIN'],
							$programacion_clase['ProgramacionClase']['ID']
						);
						if (!empty($tope)){
							$alumnos[$key]['Alumno']['TIENE_TOPE'] = true;
							$count_topes++;
						}else
							$alumnos[$key]['Alumno']['TIENE_TOPE'] = false;
					}
				}
			}
			$this->set(array(
				'alumnos'=>$alumnos,
				'count_topes'=>$count_topes,
			));
		}
		public function autorizarReforzamiento($cod_programacion=null)
		{
			$this->autoRender = false;
			if (empty($cod_programacion)) {
				$this->Session->setFlash('Ha ocurrido un en su navegación. Vuelva a intentar.','mensaje-error');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Error de navegación. Vuelva a intentar.','mensaje-error');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			if ($programacion_clase['ProgramacionClase']['ESTADO_PROGRAMACION_ID']==3 && $programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID']==2) {
				$this->Session->setFlash('Esta clase ya fue autorizada.','mensaje-info');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			#AUTORIZAR CLASE;
			$rollback_clase = array(
				'ID'=>$programacion_clase['ProgramacionClase']['ID'],
				'ESTADO_PROGRAMACION_ID'=>$programacion_clase['ProgramacionClase']['ESTADO_PROGRAMACION_ID'],
				'SUB_ESTADO_PROGRAMACION_ID'=>$programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'],
			);
			$up_programacion_clase = array(
				'ID'=>$programacion_clase['ProgramacionClase']['ID'],
				'ESTADO_PROGRAMACION_ID'=>3,
				'SUB_ESTADO_PROGRAMACION_ID'=>2,
			);

			if ($this->ProgramacionClase->save($up_programacion_clase)) {
				# SEND MAIL TO ALUMNOS ;
				$this->loadModel('AlumnoAsignatura');
				$this->loadModel('Periodo');
				$periodo = $this->Periodo->getPeriodoByAnhoSemestre($programacion_clase['ProgramacionClase']['ANHO'],$programacion_clase['ProgramacionClase']['SEMESTRE']);
				if (!empty($periodo)) {
					$alumnos = $this->AlumnoAsignatura->getListadoAsistencia(
						$programacion_clase['ProgramacionClase']['SIGLA_SECCION'],
						$periodo['Periodo']['COD_PERIODO'],
						$programacion_clase['ProgramacionClase']['COD_SEDE']
					);	
					foreach ($alumnos as $key => $alumno) {
						$Email = new CakeEmail();
						$Email->emailFormat('html');
						$Email->to(array($alumno['Alumno']['CORREO_PERSONAL']));
						$Email->helpers(array('Html'));
						$Email->subject('Nueva Clase de Reforzamiento / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
						$Email->from('lvc@duoc.cl');
						$Email->viewVars(array('clase' => $programacion_clase,'alumno'=>$alumno));
						$Email->template('autorizar_reforzamiento_alumno');
						if(!$Email->send()){
							$this->log("No se pudo enviar el mail al alumno en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
						};
					}
				}
				# SEND MAIL TO DOCENTES;
				$Email = new CakeEmail();
				$Email->emailFormat('html');
				$Email->to(array($programacion_clase['Docente']['CORREO']));
				$Email->helpers(array('Html'));
				$Email->subject('Nueva Clase de Reforzamiento Autorizada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
				$Email->from('lvc@duoc.cl');
				$Email->viewVars(array('clase' => $programacion_clase));
				$Email->template('autorizar_reforzamiento_docente');
				if(!$Email->send()){
					$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
				};
				# SEND MAIL TO COORDINADOR DOCENTE;
				$this->loadModel('CoordinadorDocente');
				$administrador = $this->CoordinadorDocente->getCoordinadorDocente($programacion_clase['ProgramacionClase']['COORDINADOR_CREATED_ID']);
				if (!empty($administrador)) {
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->to(array($administrador['CoordinadorDocente']['CORREO']));
					$Email->helpers(array('Html'));
					$Email->subject('Nueva Clase de Reforzamiento Autorizada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
					$Email->from('lvc@duoc.cl');
					$Email->viewVars(array('clase' => $programacion_clase,'administrador'=>$administrador));
					$Email->template('autorizar_reforzamiento_coordinador_docente');
					if(!$Email->send()){
						$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
					};
				}else{
					$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].": NO SE ENCONTRO EL CODIGO FUNCIONARIO " .$programacion_clase['ProgramacionClase']['COORDINADOR_CREATED_ID'], 'debug');
				}
				$this->Session->setFlash('Reforzamiento autorizado con éxito.','mensaje-exito');
				$this->redirect(array('action'=>'reforzamientos',$cod_programacion));
			}else{
				$this->ProgramacionClase->save($rollback_clase);
			}
			$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.','mensaje-error');
			$this->redirect(array('action'=>'reforzamientoFichaDetalle',$cod_programacion));
		}
		public function rechazarReforzamiento($cod_programacion=null)
		{
			$this->autoRender = false;
			if (empty($cod_programacion)) {
				$this->Session->setFlash('Ha ocurrido un en su navegación. Vuelva a intentar.','mensaje-error');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Error de navegación. Vuelva a intentar.','mensaje-error');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			if ($programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID']==3) {
				$this->Session->setFlash('Esta clase ya fue rechazada.','mensaje-info');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			#RECHAZAR CLASE;
			$rollback_clase = array(
				'ID'=>$programacion_clase['ProgramacionClase']['ID'],
				'SUB_ESTADO_PROGRAMACION_ID'=>$programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'],
			);
			$up_programacion_clase = array(
				'ID'=>$programacion_clase['ProgramacionClase']['ID'],
				'SUB_ESTADO_PROGRAMACION_ID'=>3,
			);

			if ($this->ProgramacionClase->save($up_programacion_clase)) {
				# SEND MAIL TO DOCENTES;
				$Email = new CakeEmail();
				$Email->emailFormat('html');
				$Email->to(array($programacion_clase['Docente']['CORREO']));
				$Email->helpers(array('Html'));
				$Email->subject('Clase de Reforzamiento rechazada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
				$Email->from('lvc@duoc.cl');
				$Email->viewVars(array('clase' => $programacion_clase));
				$Email->template('rechazo_reforzamiento_docente');
				if(!$Email->send()){
					$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
				};
				# SEND MAIL TO COORDINADOR DOCENTE;
				$this->loadModel('CoordinadorDocente');
				$administrador = $this->CoordinadorDocente->getCoordinadorDocente($programacion_clase['ProgramacionClase']['COORDINADOR_CREATED_ID']);
				if (!empty($administrador)) {
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->to(array($administrador['CoordinadorDocente']['CORREO']));
					$Email->helpers(array('Html'));
					$Email->subject('Clase de Reforzamiento rechazada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
					$Email->from('lvc@duoc.cl');
					$Email->viewVars(array('clase' => $programacion_clase,'administrador'=>$administrador));
					$Email->template('rechazo_reforzamiento_coordinador_docente');
					if(!$Email->send()){
						$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
					};
				}else{
					$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].": NO SE ENCONTRO EL CODIGO FUNCIONARIO " .$programacion_clase['ProgramacionClase']['COORDINADOR_CREATED_ID'], 'debug');
				}
				$this->Session->setFlash('Reforzamiento rechazo con éxito.','mensaje-exito');
				$this->redirect(array('action'=>'reforzamientos',$cod_programacion));
			}else{
				$this->ProgramacionClase->save($rollback_clase);
			}
			$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.','mensaje-error');
			$this->redirect(array('action'=>'reforzamientoFichaDetalle',$cod_programacion));
		}
		public function rechazarAutorizacion($cod_programacion=null)
		{
			$this->autoRender = false;
			if (empty($cod_programacion)) {
				$this->Session->setFlash('Ha ocurrido un en su navegación. Vuelva a intentar.','mensaje-error');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Error de navegación. Vuelva a intentar.','mensaje-error');
				$this->redirect(array('action'=>'reforzamientos'));
			}
			if ($programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID']==3) {
				$this->Session->setFlash('Esta clase ya fue rechazada.','mensaje-info');
				$this->redirect(array('action'=>'autorizacionFichaDetalle',$cod_programacion));
			}
			#RECHAZAR CLASE;
			$rollback_clase = array(
				'ID'=>$programacion_clase['ProgramacionClase']['ID'],
				'SUB_ESTADO_PROGRAMACION_ID'=>$programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'],
			);
			$up_programacion_clase = array(
				'ID'=>$programacion_clase['ProgramacionClase']['ID'],
				'SUB_ESTADO_PROGRAMACION_ID'=>3,
			);
			$motivo = $observaciones = null;
			#debug($this->data);exit();
			if (isset($this->data['ProgramacionClase']['MOTIVO_RECHAZO_CLASE_ID']) && !empty($this->data['ProgramacionClase']['MOTIVO_RECHAZO_CLASE_ID'])) {
				$this->loadModel('MotivoRechazoClase');
				$motivo_tmp = $this->MotivoRechazoClase->findById($this->data['ProgramacionClase']['MOTIVO_RECHAZO_CLASE_ID']);
				if (!empty($motivo_tmp)) {
					$motivo = $motivo_tmp['MotivoRechazoClase']['MOTIVO'];
				}
			}
			if (isset($this->data['ProgramacionClase']['OBSERVACIONES_RECHAZO_REFORZAMIENTO']) && !empty($this->data['ProgramacionClase']['OBSERVACIONES_RECHAZO_REFORZAMIENTO'])) {
				$observaciones = $this->data['ProgramacionClase']['OBSERVACIONES_RECHAZO_REFORZAMIENTO'];
			}
			if ($this->ProgramacionClase->save($up_programacion_clase)) {
				# SEND MAIL TO DOCENTES;
				$Email = new CakeEmail();
				$Email->emailFormat('html');
				$Email->to($programacion_clase['Docente']['CORREO']);
				#debug($programacion_clase['Docente']);
				#$Email->to('jose.oyarzun@nbit.cl');
				$Email->helpers(array('Html'));
				$Email->subject('Clase de Reforzamiento rechazada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
				$Email->from('lvc@duoc.cl');
				$Email->viewVars(array(
					'clase' => $programacion_clase,
					'motivo'=>$motivo,
					'observaciones'=>$observaciones,
				));
				$Email->template('rechazo_reforzamiento_docente');
				if(!$Email->send()){
					$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
				};
				# SEND MAIL TO COORDINADOR DOCENTE;
				$this->loadModel('CoordinadorDocente');
				$administrador = $this->CoordinadorDocente->getCoordinadorDocente($programacion_clase['ProgramacionClase']['COORDINADOR_CREATED_ID']);
				if (!empty($administrador)) {
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->to($administrador['CoordinadorDocente']['CORREO']);
					#$Email->to('jose.oyarzun@nbit.cl');
					#debug($administrador['CoordinadorDocente']);
					$Email->helpers(array('Html'));
					$Email->subject('Clase de Reforzamiento rechazada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
					$Email->from('lvc@duoc.cl');
					$Email->viewVars(array(
						'clase' => $programacion_clase,
						'administrador'=>$administrador,
						'motivo'=>$motivo,
						'observaciones'=>$observaciones,
					));
					$Email->template('rechazo_reforzamiento_coordinador_docente');
					if(!$Email->send()){
						$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
					};
					#exit('dos correos enviados');
				}else{
					$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].": NO SE ENCONTRO EL CODIGO FUNCIONARIO " .$programacion_clase['ProgramacionClase']['COORDINADOR_CREATED_ID'], 'debug');
				}
				$this->Session->setFlash('La clase se ha rechazado con éxito.','mensaje-exito');
				$this->redirect(array('action'=>'autorizacionFichaDetalle',$cod_programacion));
			}else{
				$this->ProgramacionClase->save($rollback_clase);
			}
			$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.','mensaje-error');
			$this->redirect(array('action'=>'reforzamientoFichaDetalle',$cod_programacion));
		}
		
	}