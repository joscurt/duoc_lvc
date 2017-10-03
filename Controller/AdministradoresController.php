<?php 
	App::uses('CakeEmail', 'Network/Email');
	App::import('Vendor', 'Classes/PHPExcel');
	App::uses('Folder', 'Utility');
	App::uses('File', 'Utility');
//include '../Vendor/phpexcel/Classes/PHPExcel.php';
include '../Vendor/phpexcel/Classes/PHPExcel/IOFactory.php';

	class AdministradoresController extends AppController {

		public  $name= 'Administradores';
		public  $layout = 'app-director';
		public  $components = array('Mpdf','Integracion');

		public function index()
		{

			$session_data = $this->Session->read('CoordinadorLogueado');
			$sede_id = $session_data['Sede']['COD_SEDE'];


			$cod_funcionario = $session_data['CoordinadorDocente']['COD_FUNCIONARIO'];
			$username = $session_data['CoordinadorDocente']['USERNAME'];

			$this->loadModel('CoordinadorDocente');

			$a = $this->CoordinadorDocente->getCoordinadorConSedeForLogin($username);

			$rol_id = 	$a['Permiso']['ROL_ID'];

			$this->loadModel('Funcionalidad');
			$this->loadModel('Permiso');
			$this->loadModel('PermisoFuncionalidad');
			$this->loadModel('Periodo');
			$this->loadModel('Detalle');
			$this->loadModel('SubEstado');
			$this->loadModel('Estado');
			$this->loadModel('HorarioModulo');
			$this->set(array(
				'periodos'		=> $this->Periodo->getPeriodos(),
				'detalles'		=> $this->Detalle->getAllDetalles(),
				'sub_estados'	=> $this->SubEstado->find('all', array('order'=>'SubEstado.NOMBRE')),
				'estados'		=> $this->Estado->getEstados(),
				'horarios'		=> $this->HorarioModulo->getSimpleHorarioBySede($sede_id),
				'periodoActual' => $this->Periodo->getPeriodoActual(),
				'permisos' => $this->PermisoFuncionalidad->getPermisoByRol($rol_id),
			));

		}
		public function hola(){
				phpinfo();
		}


		public function getDeltas()
		{
			$this->autoRender = false;
			$deltaA=0;
			$deltaB=0;

			$inicio_real = strtotime( substr($this->data['inicio_programado'], 0, 10).' '.$this->data['inicio_real'].':00' );
			$fin_real = strtotime( substr($this->data['fin_programado'], 0, 10).' '.$this->data['fin_real'].':00' );
			if ($inicio_real>=$fin_real) {
				$msjError = 'No se puede realizar el cambio por que la fecha inicial: ('.$this->data['inicio_real'].') es mayor &oacute; igual a la final ('.$this->data['fin_real'].').';
			}
			$inicio_programado = strtotime( $this->data['inicio_programado'] );
			$fin_programado = strtotime( $this->data['fin_programado'] );

			$deltaA = $inicio_real-$inicio_programado;
			if ($deltaA < 0) $deltaA = 0;
			
			$deltaB = $fin_programado-$fin_real;
			if ($deltaB < 0) $deltaB = 0;
			
			$minutos = ($deltaA+$deltaB)/60;
			$modulos = $minutos/45;

 			$data['mensaje']=isset($msjError) ? $msjError : '';
			$data['minutos']=number_format($minutos,0,',','.');
			$data['modulos']=number_format($modulos,0,',','.');
			echo json_encode( $data );
		}


		# -------------------------------------------------------
		public function solicitudRecuperacion()
		{
			$session_data = $this->Session->read('CoordinadorLogueado');
			$sede_id = $session_data['Sede']['COD_SEDE'];
			$retorno_filtros= $this->Session->read('retorno_filtros');
			$this->Session->delete('retorno_filtros');	
			$this->loadModel('Periodo');
			$this->loadModel('Detalle');	
			$this->loadModel('SubEstado');		
			$this->loadModel('Estado');
			$this->loadModel('HorarioModulo');
			$this->set(array(
				'periodos'			=> $this->Periodo->getPeriodos(),
				'detalles'			=> $this->Detalle->getAllDetalles(),
				'sub_estados' 		=> $this->SubEstado->find('all', array('order'=>'SubEstado.NOMBRE')),
				'estados'			=> $this->Estado->getEstados(),
				'horarios'			=> $this->HorarioModulo->getSimpleHorarioBySede($sede_id),
				'periodoActual' 	=> $this->Periodo->getPeriodoActual(),
				'retorno_filtros'	=> $retorno_filtros
			));
		}

		public function getTableGestionClases()
		{
			$this->layout = 'ajax';
			$session_data = $this->Session->read('CoordinadorLogueado');
			$datos=$clases=$multiple_filtro=$salas_reemplazo_list=array();
			$salas_list=$fecha_desde=$fecha_hasta=$filtro=$valor_filtros=$ordenar=$filtro=$valor_filtros=null;
			# Cargar los modelos involucrados.
			$this->loadModel('Sala');
			$this->loadModel('ProgramacionClase');
			$this->loadModel('MotivoSuspensionClase');

			#debug($this->data);exit();
			# Filtrar los datos.
			if( isset($this->data) and !empty($this->data['Filtro']['tipo_fitrar']) ){
				# Limpiar los datos filtrados.
				foreach ($this->data['Filtro'] as $key => $valor) {
					$datos[$key]=trim($valor);
				}
				if( $datos['tipo_fitrar']=='simple' ) {
					# Optimizar variables.
					$fecha_desde = !empty($datos['fecha_inicio']) ? date('Y-m-d',strtotime($datos['fecha_inicio'])) : date('Y-m-d');
					$fecha_hasta = !empty($datos['fecha_fin']) ? date('Y-m-d',strtotime($datos['fecha_fin'])) : date('Y-m-d');
					if ( !empty($datos['filtro']) and !empty($datos['value']) ) {
						$filtro = in_array($datos['filtro'], array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO')) ? 'Docente.COD_DOCENTE': $datos['filtro'];
						$filtro = ($filtro == 'Asignatura.NOMBRE') ? 'Asignatura.SIGLA' : $filtro;
						$filtro = ($filtro == 'ProgramacionClase.detalle') ? 'ProgramacionClase.detalle_id' : $filtro;
						$valor_filtros = $datos['value'];
						
						#debug($$filtro);exit();
					}
				}elseif( $datos['tipo_fitrar']=='multiple'){
					$multiple_filtro = $this->procesarDatosFiltroMultiple($this->data);
				}
				$ordenar = isset($datos['ordenar']) ? $datos['ordenar'] : 'ProgramacionClase.FECHA_CLASE';
				$clases = $this->ProgramacionClase->getProgramacionByCoordinadorSede(
					$session_data['Sede']['COD_SEDE'],
					$fecha_desde,
					$fecha_hasta,
					$filtro,
					$valor_filtros,
					$ordenar,
					$multiple_filtro
				);
				$salas_list = $this->Sala->getSalasBySedeList($session_data['Sede']['CODIGO_SAP']);
				$salas_reemplazo_list = $this->Sala->getSalasReemplazoBySedeList($session_data['Sede']['CODIGO_SAP']);

			}
			$this->set(array(
				'clases'				=> $clases,
				'salas_list'			=> $salas_list,
				'salas_reemplazo_list'	=> $salas_reemplazo_list,
				'motivos'				=> $this->MotivoSuspensionClase->getMotivosActivos(),
				'fecha_hasta' 			=> $fecha_hasta,
				'fecha_desde' 			=> $fecha_desde,
				'filtro' 				=> $filtro,
				'valor_filtros' 		=> $valor_filtros,
				'ordenar' 				=> $ordenar,
				'tipo_fitrar'			=> $datos['tipo_fitrar']
			));
		}
		public function excelGestionClases($filtro=null,$tipo_fitrar=null,$fecha_inicio=null,$fecha_fin=null,$valor_filtros)
		{

			$this->layout = 'excel';
			$data = array('Filtro' => array('tipo_fitrar' => $tipo_fitrar,
			'fecha_inicio' => $fecha_inicio,
			'fecha_fin' => $fecha_fin,
			'filtro' => $filtro,
			#'autocomplete' => $autocomplete,
			'value' => $valor_filtros
			));
			#debug($data);exit();

			$session_data = $this->Session->read('CoordinadorLogueado');
			$datos=$clases=$multiple_filtro=$salas_reemplazo_list=array();
			$salas_list=$fecha_desde=$fecha_hasta=$filtro=$valor_filtros=$ordenar=$filtro=$valor_filtros=null;
			# Cargar los modelos involucrados.
			$this->loadModel('Sala');
			$this->loadModel('ProgramacionClase');
			$this->loadModel('MotivoSuspensionClase'); 


			# Filtrar los datos.
			if( isset($data) and !empty($data['Filtro']['tipo_fitrar']) ){
				# Limpiar los datos filtrados.
				foreach ($data['Filtro'] as $key => $valor) {
					$datos[$key]=trim($valor);
				}
				if( $datos['tipo_fitrar']=='simple' ) {
					# Optimizar variables.
					$fecha_desde = !empty($datos['fecha_inicio']) ? date('Y-m-d',strtotime($datos['fecha_inicio'])) : date('Y-m-d');
					$fecha_hasta = !empty($datos['fecha_fin']) ? date('Y-m-d',strtotime($datos['fecha_fin'])) : date('Y-m-d');
					if ( !empty($datos['filtro']) and !empty($datos['value']) ) {
						$filtro = in_array($datos['filtro'], array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO')) ? 'Docente.COD_DOCENTE': $datos['filtro'];
						$filtro = ($filtro == 'Asignatura.NOMBRE') ? 'Asignatura.SIGLA' : $filtro;
						$filtro = ($filtro == 'ProgramacionClase.detalle') ? 'ProgramacionClase.detalle_id' : $filtro;
						$valor_filtros = $datos['value'];

						#debug($$filtro);exit();
					}
				}elseif( $datos['tipo_fitrar']=='multiple'){
					$multiple_filtro = $this->procesarDatosFiltroMultiple($data);
				}
				$ordenar = isset($datos['ordenar']) ? $datos['ordenar'] : 'ProgramacionClase.FECHA_CLASE';
				$clases = $this->ProgramacionClase->getProgramacionByCoordinadorSede(
					$session_data['Sede']['COD_SEDE'],
					$fecha_desde,
					$fecha_hasta,
					$filtro,
					$valor_filtros,
					$ordenar,
					$multiple_filtro
				);
				#debug($clases);exit();
				$salas_list = $this->Sala->getSalasBySedeList($session_data['Sede']['CODIGO_SAP']);
				$salas_reemplazo_list = $this->Sala->getSalasReemplazoBySedeList($session_data['Sede']['CODIGO_SAP']);

			}
			$this->set(array(
				'clases'				=> $clases,
				'salas_list'			=> $salas_list,
				'salas_reemplazo_list'	=> $salas_reemplazo_list,
				'motivos'				=> $this->MotivoSuspensionClase->getMotivosActivos(),
				'fecha_hasta' 			=> $fecha_hasta,
				'fecha_desde' 			=> $fecha_desde,
				'filtro' 				=> $filtro,
				'valor_filtros' 		=> $valor_filtros,
				'ordenar' 				=> $ordenar
			));
		}
		public function getTableSolicitudRecuperacion()
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$this->Session->write('retorno_filtros', $this->data['Filtro']);
			$ordenar = $fecha_desde = $fecha_hasta = $valor_filtros = $filtro = null;
			$multiple_filtro = array();
			$session_data = $this->Session->read('CoordinadorLogueado');
			
			#debug($this->data);
			if (!empty($this->data) && isset($this->data['Filtro'])) {
				$filtros = $this->data['Filtro'];
				
				$fecha_desde = date('Y-m-d');
				if (!empty($filtros['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($filtros['fecha_inicio']));
				}

				$fecha_hasta = date('Y-m-d');
				if (!empty($filtros['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($filtros['fecha_fin']));
				}

				if (!empty($filtros['filtro']) && !empty($filtros['value'])) {
					$filtro = $filtros['filtro'];
					$valor_filtros = $filtros['value'];
				}

				if(isset($filtros['ordenar'])){
					$ordenar = $filtros['ordenar'];
				}

				$filtro = in_array($filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO')) ? 'Docente.COD_DOCENTE' : $filtro;
				$filtro = ($filtro == 'Asignatura.NOMBRE') ? 'Asignatura.SIGLA' : $filtro;
				$filtro = ($filtro == 'ProgramacionClase.detalle') ? 'ProgramacionClase.detalle_id' : $filtro;
			}
			if(isset($filtros['filtro_multiple']) && $filtros['filtro_multiple'] == 1){
				$multiple_filtro = $this->procesarDatosFiltroMultiple($this->data);
			}
			$programacion_clases = $this->ProgramacionClase->getSolicitudRecuperacion(
				$session_data['Sede']['COD_SEDE'],
				$fecha_desde,
				$fecha_hasta,
				$filtro,
				$valor_filtros,
				$ordenar,
				$multiple_filtro
			);
			#debug($valor_filtros);exit();
			$this->set(array(
				'programacion_clases'	=> $programacion_clases,
				'datos_filtro'			=> $this->data,
				'ordenar' 				=> $ordenar,
				'fecha_desde' 			=> $fecha_desde,
				'fecha_hasta' 			=> $fecha_hasta,
				'filtro'				=> $filtro,
				'valor_filtros'			=> $valor_filtros,
			));
		}

		public function procesarDatosFiltroMultiple( $datos_filtro=array() )
		{
			#$this->autoRender = false;
			$session_data = $this->Session->read('CoordinadorLogueado');

			$conditions=array();
			$fecha_desde=$fecha_hasta='';
			if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
				$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
			}
			if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
				$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
			}
			if (!empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
				$fecha_hasta = "TO_DATE('".$fecha_hasta."','YYYY-MM-DD')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE BETWEEN '.$fecha_desde.' AND '.$fecha_hasta,
				);
			}elseif (empty($fecha_desde) && !empty($fecha_hasta)) {
				$fecha_hasta = "TO_DATE('".$fecha_hasta."','YYYY-MM-DD')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE <= \''.$fecha_hasta.'\'',
				);
			}elseif (!empty($fecha_desde) && empty($fecha_hasta)) {
				$fecha_desde = "TO_DATE('".$fecha_desde."','YYYY-MM-DD')";
				$conditions = array(
					'ProgramacionClase.FECHA_CLASE >= \''.$fecha_desde.'\'',
				);
			}
			if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
				$conditions['Asignatura.NOMBRE'] = trim($datos_filtro['Filtro']['nombre_asignatura']);
			}
			if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
				$conditions['ProgramacionClase.SIGLA_SECCION'] = $datos_filtro['Filtro']['sigla_seccion'];
			}
			//$conditions['ProgramacionClase.TIPO_EVENTO'] = 'NO REGULAR';
			$conditions['ProgramacionClase.COD_SEDE'] = $session_data['Sede']['COD_SEDE'];


			// if ((!empty($datos_filtro['Filtro']['rut'])) || (!empty($datos_filtro['Filtro']['nombre_docente'])) || (!empty($datos_filtro['Filtro']['id_docente'])) ) {
			// 	if (isset($datos_filtro['Filtro']['value_docente']) && !empty($datos_filtro['Filtro']['value_docente'])) {
			// 		$conditions['Docente.COD_DOCENTE'] = $datos_filtro['Filtro']['value_docente'];
			// 	}
			// }else{
			// 	if (isset($conditions['Docente.COD_DOCENTE'])) {
			// 		unset($conditions['Docente.COD_DOCENTE']);
			// 	}
			//}

			$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
			if ( !empty($fecha_desde) and !empty($fecha_hasta) ) {
				$a=date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']))." ".$datos_filtro['Filtro']['hora_inicio'];
				$b=date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']))." ".$datos_filtro['Filtro']['hora_fin'];
				$f_ini = "TO_DATE('".$a."','YYYY-MM-DD HH24:MI')";
				$f_fin = "TO_DATE('".$b."','YYYY-MM-DD HH24:MI')";

				$conditions[] = "ProgramacionClase.FECHA_CLASE BETWEEN ".$f_ini." AND ".$f_fin
				;
				/*if (isset($datos_filtro['Filtro']['hora_inicio']) && !empty($datos_filtro['Filtro']['hora_inicio'])) {
					$conditions["TO_CHAR (ProgramacionClase.hora_inicio, 'HH24:MI')"] = $datos_filtro['Filtro']['hora_inicio'];
				}
				if (isset($datos_filtro['Filtro']['hora_fin']) && !empty($datos_filtro['Filtro']['hora_fin'])) {
					$conditions["TO_CHAR (ProgramacionClase.hora_fin, 'HH24:MI')"] = $datos_filtro['Filtro']['hora_fin'];
				}*/
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

		public function getHorariosDisponiblesByFecha()
		{
			$this->autoRender = false;
			$fecha = isset($this->data['fecha'])?$this->data['fecha']:null;
			$this->loadModel('HorarioModulo');
			$session_data = $this->Session->read('CoordinadorLogueado');
			echo json_encode(array('data'=>$this->HorarioModulo->getSimpleHorarioBySede($session_data['Sede']['COD_SEDE']),'status'=>'success'));
		}

		public function listaAlumnosConTope($cod_programacion=null)
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
					$alumnos = $this->AlumnoAsignatura->getListadoAsistencia($periodo['Periodo']['COD_PERIODO'],$programacion_clase['ProgramacionClase']['COD_SEDE'],$programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
					#debug($alumnos);exit();
					foreach ($alumnos as $key => $value) {
						#debug($value);
						$tope = $this->ProgramacionClase->getIdTopeHorario(
							$programacion_clase['ProgramacionClase']['SIGLA_SECCION'],
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
		public function listaDocentesConTope($cod_programacion=null){

			#$this->autoRender = false;
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClase($cod_programacion);
			/*if (isset($this->data['hora_inicio'])) {
				$a = $this->data['hora_inicio'];
				$b = $this->data['hora_fin'];
				$c = $this->data['fecha'];
				$hora_ini = date('Y-m-d',strtotime($c))." ".date('h:i:s',strtotime($a));
				$hora_fin = date('Y-m-d',strtotime($c))." ".date('h:i:s',strtotime($b));
				#var_dump($hora_fin);
			}*/
			#var_dump($programacion_clase['ProgramacionClase']['HORA_INICIO']);exit();

			$docentes = Array();

			if (!empty($programacion_clase)) {
				$this->loadModel('Periodo');
				$this->loadModel('Docente');
				$session_data = $this->Session->read('CoordinadorLogueado');
				$periodo = $this->Periodo->getPeriodoByAnhoSemestre($programacion_clase['ProgramacionClase']['ANHO'],$programacion_clase['ProgramacionClase']['SEMESTRE']);
				#debug($periodo);exit();
				if (!empty($periodo)) {
					$docentes = $this->ProgramacionClase->getIdTopeHorarioDocente(
						$session_data['Sede']['COD_SEDE'],
						$programacion_clase['ProgramacionClase']['SIGLA_SECCION'],
							$periodo['Periodo']['COD_PERIODO'],
							$programacion_clase['ProgramacionClase']['ANHO'],
							$programacion_clase['ProgramacionClase']['SEMESTRE'],
							//$hora_ini,
							//$hora_fin,
							$programacion_clase['ProgramacionClase']['HORA_INICIO'],
							$programacion_clase['ProgramacionClase']['HORA_FIN'],
							$programacion_clase['ProgramacionClase']['ID']
						);
					
				}
				#echo json_encode(array('data'=>$docentes,'status'=>'success'));

			}
			$this->set(array(
				'docentes'=>$docentes
		//		'count_topes'=>$count_topes,
			));
		}

		public function minutos_transcurridos($fecha_i,$fecha_f)
		{
			$this->autoRender=false;
			$minutos = (strtotime($fecha_i)-strtotime($fecha_f))/60;
			$minutos = abs($minutos); 
			$minutos = floor($minutos);
			return $minutos;
		}

		public function crearSolicitudRecuperacion($cod_programacion=null) {


			$this->autoRender=false;
			if (!empty($this->data) && !empty($cod_programacion)) {
				if(!isset($this->data['ProgramacionClase'])){
					$this->Session->setFlash('Est&aacute; intentando acceder de una manera erronea. Intente nuevamente.','mensaje-error');
					$this->redirect(array('action'=>'crearSolicitudRecuperacion',$cod_programacion));
				}
				#debug($this->data);#Exit();
				$data_solicitud = $this->data['ProgramacionClase'];
				$session_data = $this->Session->read('CoordinadorLogueado');

			#	debug($session_data);exit();
				$modulos = null;
				if ($this->data['ProgramacionClase']['TIPO'] == 'presencial' && (!empty($this->data['ProgramacionClase']['HORA_INICIO'])) && !empty($this->data['ProgramacionClase']['HORA_FIN'])) {
					$hora_inicio = date('Y-m-d H:i:s',strtotime($this->data['ProgramacionClase']['HORA_INICIO']));
					$hora_fin = date('Y-m-d H:i:s',strtotime($this->data['ProgramacionClase']['HORA_FIN']));
					$minutos = $this->minutos_transcurridos($hora_inicio,$hora_fin);
					$modulos = (int) $minutos / 45;	
				}
				$this->loadModel('ProgramacionClase');
				$this->loadModel('Parametro');
				$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
				if(empty($programacion_clase)){
					$this->Session->setFlash('Ha ocurrido un error al intentar recuperar la clase padre. Intente nuevamente.','mensaje-error');
					$this->redirect(array('action'=>'solicitudRecuperacion'));
				}
				if (empty($this->data['ProgramacionClase']['FECHA_CLASE'])) {
					$this->Session->setFlash('La fecha2 de la clase no puede quedar vac&iacute;a. Intente nuevamente.','mensaje-error');
					$this->redirect(array('action'=>'solicitudRecuperacionTopeHorario',$cod_programacion));
				}
				/* CD005 JLMorand&eacute; */			
				$new_cod_programacion = uniqid();
				$new_programacion_clase = array(
					#'ID'=> $programacion_clase['ProgramacionClase']['ID'],
					'COD_PROGRAMACION'=>$new_cod_programacion,
					'CANTIDAD_MODULOS'=>round($modulos),
					'COD_DOCENTE'=>isset($this->data['ProgramacionClase']['DOCENTE_TITULAR'])? $programacion_clase['ProgramacionClase']['COD_DOCENTE']:$this->data['ProgramacionClase']['COD_DOCENTE_ALTERNATIVO'],
					'FECHA_CLASE'=>date('Y-m-d',strtotime($this->data['ProgramacionClase']['FECHA_CLASE'])),
					'SALA'=>isset($this->data['ProgramacionClase']['SALA']) ? $this->data['ProgramacionClase']['SALA'] : null ,
					'PRESENCIAL'=>$this->data['ProgramacionClase']['TIPO']=='presencial'? 1:0,
					'MOTIVO_SOLICITUD_RECUPERA_ID'=>$this->data['ProgramacionClase']['MOTIVO_ID'],
					'OBS_SOLICITUD_RECUPERACION'=>$this->data['ProgramacionClase']['OBS_SOLICITUD_RECUPERACION'],
					'TIPO_EVENTO'=>'NO REGULAR',
					'SIGLA_SECCION'=>$programacion_clase['ProgramacionClase']['SIGLA_SECCION'],
					'SUB_ESTADO_PROGRAMACION_ID'=>1,
					'COORDINADOR_CREATED_ID'=>$session_data['CoordinadorDocente']['COD_FUNCIONARIO'],
					'COD_SEDE'=>$programacion_clase['ProgramacionClase']['COD_SEDE'],
					'COD_ASIGNATURA_HORARIO'=>$programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO'],
					'SIGLA'=>$programacion_clase['ProgramacionClase']['SIGLA'],
					'CREATED'=>date('Y-m-d H:i:s'),
					'ANHO' => $programacion_clase['ProgramacionClase']['ANHO'],
					'SEMESTRE' => $programacion_clase['ProgramacionClase']['SEMESTRE'],
					'COD_PROGRAMACION_PADRE' => $cod_programacion
				);
					#
				if ($this->data['ProgramacionClase']['TIPO'] == 'presencial') {
					$new_programacion_clase['HORA_INICIO'] = $new_programacion_clase['FECHA_CLASE'].' '.$this->data['ProgramacionClase']['HORA_INICIO'];
					$new_programacion_clase['HORA_FIN'] = $new_programacion_clase['FECHA_CLASE'].' '.$this->data['ProgramacionClase']['HORA_FIN'];
				}
				
				if ($this->ProgramacionClase->save($new_programacion_clase)) {
					#debug($new_cod_programacion);exit();
					$programacion_clase  = $this->ProgramacionClase->getProgramacionClaseFull($new_cod_programacion);
					#debug($programacion_clase);exit();
					#SEND DOCENTE;
					$cod_docente = $programacion_clase['ProgramacionClase']['COD_DOCENTE'];
					#$docente = $this->Docente->findByCod();
					if (!empty($programacion_clase['Docente'])) {
						if (!empty($programacion_clase['Docente']['CORREO'])) {
							$Email = new CakeEmail();
							$Email->emailFormat('html');
							$Email->to(array($programacion_clase['Docente']['CORREO']));
							$Email->helpers(array('Html'));
							$Email->subject('Solicitud de Recuperaci&oacute;n de una clase Autorizada / Sigla-Secci&oacute;n '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
							$Email->from('lvc@duoc.cl');
							$Email->viewVars(array('clase' => $programacion_clase,'sede'=>$session_data['Sede']));
							$Email->template('solicitud_recuperacion_docente');
							if(!$Email->send()){
								$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
							};	
						}else{
							$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].": NO TIENE DOCENTE LA CLASE ".$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'].": <serialize>" . serialize($programacion_clase)."</serialize>", 'debug');
						}
					}else{
						$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].": NO TIENE DOCENTE LA CLASE ".$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'].": <serialize>" . serialize($programacion_clase)."</serialize>", 'debug');
					}
					#SEND COORDINADOR;
					$Email = new CakeEmail();
					$Email->emailFormat('html');
					$Email->to(array($session_data['CoordinadorDocente']['CORREO']));
					$Email->helpers(array('Html'));
					$Email->subject('Solicitud de Recuperaci&oacute;n de una clase Autorizada / Sigla-Secci&oacute;n '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
					$Email->from('lvc@duoc.cl');
					$Email->viewVars(array('clase' => $programacion_clase,'coordinador' => $session_data['CoordinadorDocente'],'sede'=>$session_data['Sede']));
					$Email->template('solicitud_recuperacion_coordinador_docente');
					if(!$Email->send()){
						$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
					};	
					#SEND DIRECTOR;
					$this->loadModel('Director');
					$directores = $this->Director->find('all',array('conditions'=>array('Director.COD_SEDE'=>$session_data['Sede']['COD_SEDE'])));
					foreach ($directores as $key => $director) {
						if (!empty($director['Director']['CORREO'])) {
							$Email = new CakeEmail();
							$Email->emailFormat('html');
							$Email->to(array($director['Director']['CORREO']));
							$Email->helpers(array('Html'));
							$Email->subject('Solicitud de Recuperaci&oacute;n de una clase Autorizada / Sigla-Secci&oacute;n '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
							$Email->from('lvc@duoc.cl');
							$Email->viewVars(array('clase' => $programacion_clase,'director'=>$director['Director'],'sede'=>$session_data['Sede']));
							$Email->template('solicitud_recuperacion_director');
							if(!$Email->send()){
								$this->log("No se pudo enviar el mail al director en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
							};
						}else{
							$this->log("No se pudo enviar el mail al director en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($director)."</serialize>", 'debug');
						}
					}
				}
				$this->Session->setFlash('Se ha creado la solicitud con &eacute;xito y se ha notificado conforme al proceso.','mensaje-exito');
				$this->redirect(array('action'=>'solicitudRecuperacion'));
			}
			$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-error');
			$this->redirect(array('action'=>'solicitudRecuperacion'));
		}

		public function getSalasDisponiblesByHorario()
		{
				/* Metodo que llama salas disponibles por RFC */

			$this->autoRender = false;
			$fecha2 = new DateTime('2011-01-01');
			$fecha = isset($this->data['fecha'])?$this->data['fecha']:null;
			$hora_inicio = isset($this->data['hora_inicio'])?$this->data['hora_inicio']:null;
			$hora_fin = isset($this->data['hora_fin'])?$this->data['hora_fin']:null;
			$this->loadModel('Sala');
			$session_data = $this->Session->read('CoordinadorLogueado');
			//debug($this->data['hola']);exit();
			$fecha = str_replace('-', '.',$fecha);
			#var_dump($fecha);exit();
			$salas = $this->Integracion->getSalasDisponiblesSede($session_data['Sede']['CODIGO_SAP'],$fecha,$hora_inicio,$hora_fin);

			#debug($salas);exit();
			echo json_encode(array('data'=>$salas,'status'=>'success'));
		}
		public function getSalasDisponiblesByHorarioProg()
		{
			$this->autoRender = false;
			#debug($this->data);exit();
			#$fecha = new DateTime('2017-08-17');
			$fecha = isset($this->data['fecha'])?$this->data['fecha']:null;
			$hora_inicio = isset($this->data['hora_inicio'])?$this->data['hora_inicio']:null;
			#$hora_inicio  = date('h:i:s', $hora_inicio);
			$hora_fin = isset($this->data['hora_fin'])?$this->data['hora_fin']:null;
			$this->loadModel('Sala');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			#$fecha = '2017-08-07';
			#$hora_inicio = '08:01';
			#$hora_fin = '10:15';
			$fecha = date("Y-m-d", strtotime($fecha));
			$hora_inicio = date("h:i:s", strtotime($hora_inicio));
			$hora_fin = date("h:i:s", strtotime($hora_fin));

			#$fecha = date_format($fecha, 'Y-m-d');
			#debug($hora_inicio);exit();
			//$fecha = str_replace('-', '/',$fecha);
			#var_dump($fecha);exit();
			$this->loadModel('SalaHorario');
			$salas = $this->SalaHorario->getSalasHorario($cod_sede,$fecha,$hora_inicio,$hora_fin);
			//$salas = $this->Integracion->getSalasDisponiblesSede($session_data['Sede']['CODIGO_SAP'],$fecha,$hora_inicio,$hora_fin);

			#var_dump($salas);exit();
			echo json_encode(array('data'=>$salas,'status'=>'success'));
		}
		public function getDocDisponiblesByHorarioProg()
		{
			$this->autoRender = false;
			#debug($this->data);exit();
			#$fecha = new DateTime('2017-08-17');
			$fecha = isset($this->data['fecha'])?$this->data['fecha']:null;
			$hora_inicio = isset($this->data['hora_inicio'])?$this->data['hora_inicio']:null;
			#$hora_inicio  = date('h:i:s', $hora_inicio);
			$hora_fin = isset($this->data['hora_fin'])?$this->data['hora_fin']:null;
			$this->loadModel('Sala');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			#$fecha = '2017-08-07';
			#$hora_inicio = '08:01';
			#$hora_fin = '10:15';
			$fecha = date("Y-m-d", strtotime($fecha));
			$hora_inicio = date("h:i:s", strtotime($hora_inicio));
			$hora_fin = date("h:i:s", strtotime($hora_fin));

			#$fecha = date_format($fecha, 'Y-m-d');
			#debug($hora_inicio);exit();
			//$fecha = str_replace('-', '/',$fecha);
			#var_dump($fecha);exit();
			$this->loadModel('Docente');
			$docentes = $this->Docente->getDocHorario($cod_sede,$fecha,$hora_inicio,$hora_fin);
			#var_dump($docentes);exit();
			//$salas = $this->Integracion->getSalasDisponiblesSede($session_data['Sede']['CODIGO_SAP'],$fecha,$hora_inicio,$hora_fin);

			#var_dump($salas);exit();
			echo json_encode(array('data'=>$docentes,'status'=>'success'));
		}

		public function getDocenteTitular($sigla_seccion=null)
		{
			$this->autoRender = false;
			$response = array(
				'message'=>'Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.',
				'status'=>'danger',
			);
			if (!empty($sigla_seccion)) {
				$this->loadModel('AsignaturaHorario');
				$dato_session = $this->Session->read('CoordinadorLogueado');
				$docente_titular = $this->AsignaturaHorario->getDocenteTitularBySiglaSeccion($sigla_seccion,$dato_session['Sede']['COD_SEDE']);
				if (!empty($docente_titular)) {
					$response['message'] = $docente_titular['message'];
					$response['status'] = $docente_titular['status'];
					if (isset($docente_titular['data']['Docente']['NOMBRE'])) {
						$docente_titular['data']['Docente']['NOMBRE'] = utf8_encode($docente_titular['data']['Docente']['NOMBRE']);
						$docente_titular['data']['Docente']['APELLIDO_PAT'] = utf8_encode($docente_titular['data']['Docente']['APELLIDO_PAT']);
						$docente_titular['data']['Docente']['APELLIDO_MAT'] = utf8_encode($docente_titular['data']['Docente']['APELLIDO_MAT']);
					}
					$response['data'] = $docente_titular['data'];
				}
			}	
			echo json_encode($response);
		}

		public function saveAsistenciaFromFicha($cod_programacion=null)
		{
			$this->autoRender = false;
			$response = array(
				'message'=>'Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.',
				'status'=>'danger',
			);
			if (!empty($cod_programacion)) {
				$this->loadModel('ProgramacionClase');
				$programacion_clase = $this->ProgramacionClase->getProgramacionClase($cod_programacion);
				if (!empty($programacion_clase)) {
					if (!empty($this->data) && isset($this->data['Asistencia'])) {
						if (!empty($this->data['Asistencia'])) {
							$this->loadModel('Asistencia');
							foreach ($this->data['Asistencia'] as $key => $value) {
								$asistencia = $this->Asistencia->getAsistenciaAlumnoEvento($value['ID_ALUMNO'],$cod_programacion);
								#debug($asistencia);
								if (!empty($asistencia)) {
									$up_asistencia = array(
										'ID'=>$asistencia['Asistencia']['ID'],
										'ASISTENCIA'=>isset($value['ASISTENCIA']) && $value['ASISTENCIA'] == 1? 1:0,
									);
									#debug($up_asistencia);
									$this->Asistencia->create(false);
									$this->Asistencia->save($up_asistencia);
								}else{
									#NUEVO_REGISTRO;
									$new_asistencia = array(
										'COD_PROGRAMACION'=>$cod_programacion,
										'ID_ALUMNO'=>$value['ID_ALUMNO'],
										'UUID'=>uniqid(),
										'SIGLA'=>$programacion_clase['ProgramacionClase']['SIGLA'],
										'COD_DOCENTE'=>$programacion_clase['ProgramacionClase']['COD_DOCENTE'],
										'SIGLA_SECCION'=>$programacion_clase['ProgramacionClase']['SIGLA_SECCION'],
										'ASISTENCIA'=>isset($value['ASISTENCIA']) && $value['ASISTENCIA'] == 1? 1:0,
										'OBSERVACION'=>null,
										'CREATED'=>date('Y-m-d H:i:s'),
										'MODIFIED'=>date('Y-m-d H:i:s'),
									);
									$this->Asistencia->create(true);
									$this->Asistencia->save($new_asistencia);
								}
							}
							#debug($this->data);Exit();
							#FALTA ACTUALIZAR DATOS DE LA CLASE;
							$this->loadModel('AsignaturaHorario');
							$retorno = $this->AsignaturaHorario->actualizarAsignaturaHorario($programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
							$response['message'] = 'Su informaci&oacute;n se ha almacenado con &eacute;xito.';
							$response['status'] = 'success';
						}
					}
				}
			}	
			echo json_encode($response);
		}

		public function suspenderMasivo()
		{
			if (!empty($this->data)) {
				#debug($this->data);exit();
				$form_data = $this->data['ProgramacionClase'];
				if (isset($form_data['IDS']) && is_array($form_data['IDS'])) {
					if (isset($form_data['MOTIVO_ID']) && !empty($form_data['MOTIVO_ID'])) {
						if (isset($form_data['OBSERVACIONES']) && isset($form_data['OBSERVACIONES'])) {
							$session_data = $this->Session->read('CoordinadorLogueado');
							$suspender_update = array(
								'MOTIVO_ID'=>$form_data['MOTIVO_ID'],
								'OBSERVACIONES_ADELANTAR_CLASE'=>$form_data['OBSERVACIONES'],
								#DETALLE ID 4 SUSPENDIDA PARA TODOS LOS CASOS SEGUN DEFINICION,
								'DETALLE_ID'=>4,
								'WF_ESTADO_ID'=>5, //SUSPENDIDA
								'FECHA_SUSPENSION'=>date('Y-m-d H:i'),
								'COORDINADOR_CREATED_ID'=>$session_data['CoordinadorDocente']['COD_FUNCIONARIO'],
							);
							$error = 0;
							$this->loadModel('ProgramacionClase');
							foreach ($form_data['IDS'] as $key => $value) {
								$programacion_clase = $this->ProgramacionClase->getProgramacionClase($value);
								if (!empty($programacion_clase)) {
									$suspender_update['ID'] = $programacion_clase['ProgramacionClase']['ID'];
									if(!$this->ProgramacionClase->save($suspender_update)){
										$error++;
									};
								}
							}
							if ($error == count($form_data['IDS'])) {
								$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-error');
								$this->redirect(array('action'=>'index'));
							}else if($error > 0){
								$this->Session->setFlash('Algunas clases no fueron suspendidas. Verifique la informaci&oacute;n.','mensaje-info');
								$this->redirect(array('action'=>'index'));
							}else if($error == 0){
								$this->Session->setFlash('La informaci&oacute;n se ha guardado con &eacute;xito.','mensaje-exito');
								$this->redirect(array('action'=>'index'));
							}
						}
					}
				}
			}
			$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-error');
			$this->redirect(array('action'=>'index'));
		}

		public function crearReforzamiento()
		{
			$session_data = $this->Session->read('CoordinadorLogueado');

			$cod_funcionario = $session_data['CoordinadorDocente']['COD_FUNCIONARIO'];	
			$username = $session_data['CoordinadorDocente']['USERNAME'];

			$this->loadModel('CoordinadorDocente');

			$a = $this->CoordinadorDocente->getCoordinadorConSedeForLogin($username);
			
			$rol_id = 	$a['Permiso']['ROL_ID'];
		
			$this->loadModel('Funcionalidad');
			$this->loadModel('Permiso');
			$this->loadModel('PermisoFuncionalidad');


		if (!empty($this->data)) {
				$form_data = $this->data['ProgramacionClase'];
				if (isset($form_data['SIGLA_SECCION']) && !empty($form_data['SIGLA_SECCION'])) {
					$this->loadModel('AsignaturaHorario');
					$asignatura_horario = $this->AsignaturaHorario->getSiglaSeccion($form_data['SIGLA_SECCION']);
					if (!empty($asignatura_horario)) {
						$es_docente_titular = true;
						$error_docente = false;
						$this->loadModel('Docente');
						if (isset($form_data['DOCENTE_TITULAR']) && !empty($form_data['DOCENTE_TITULAR'])) {
							$docente = $this->Docente->getDocente($form_data['COD_DOCENTE']);
						}else{
							$docente = $this->Docente->getDocente($form_data['COD_DOCENTE_ALTERNATIVO']);
						}
						if (!empty($docente)) {
							$form_data['COD_DOCENTE'] = $docente['Docente']['COD_DOCENTE'];
							$form_data['FECHA_CLASE'] = date('Y-m-d',strtotime($form_data['FECHA_CLASE']));
							$form_data['HORA_INICIO'] = $form_data['FECHA_CLASE'].' '.$form_data['HORA_INICIO'];
							$form_data['HORA_FIN'] = $form_data['FECHA_CLASE'].' '.$form_data['HORA_FIN'];
							$form_data['REFORZAMIENTO'] = 1;
							#LOS REFORZAMIENTOS DEBEN QUEDAR CON : (POR DEFINICI&oacute;N DEL DOCUMENTO FUNCIONAL)
								#TIPO_EVENTO = 'NO REGULAR';
								#SUB_ESTADO_PROGRAMACION_ID = 1 AUTORIZACION PENDIENTE;
								#DETALLE_ID 7 = REFORZAMIENTO;
							$form_data['DETALLE_ID'] = 7;
							$form_data['TIPO_EVENTO'] = 'NO REGULAR';
							$form_data['SUB_ESTADO_PROGRAMACION_ID'] = 1;
							$form_data['COD_PROGRAMACION'] = uniqid();
							$form_data['CREATED'] = $form_data['MODIFIED'] = date('Y-m-d H:i:s');
							$form_data['COD_SEDE'] = $session_data['Sede']['COD_SEDE'];
							$form_data['COORDINADOR_CREATED_ID'] = $session_data['CoordinadorDocente']['COD_FUNCIONARIO'];
							$this->loadModel('Parametro');
							$form_data['ANHO'] = $this->Parametro->getValorParametro('ANHO_ACTUAL');
							$form_data['SEMESTRE'] = $this->Parametro->getValorParametro('SEMESTRE_ACTUAL');
							$form_data['COD_JORNADA'] = $asignatura_horario['data']['AsignaturaHorario']['COD_JORNADA'];
							$form_data['COD_ASIGNATURA_HORARIO'] = $asignatura_horario['data']['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'];
							$form_data['SIGLA'] = $asignatura_horario['data']['AsignaturaHorario']['SIGLA'];
							$form_data['COD_PROGRAMACION_PADRE'] = '';
							$this->loadModel('ProgramacionClase');
							$this->ProgramacionClase->create();
							if ($this->ProgramacionClase->save($form_data)) {
								#SEND MAIL DOCENTE
								$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($form_data['COD_PROGRAMACION']);
								$Email = new CakeEmail();
								$Email->emailFormat('html');
								$Email->to($docente['Docente']['CORREO']);
								$Email->helpers(array('Html'));
								$Email->subject('Solicitud de Reforzamiento creada / '.$form_data['SIGLA_SECCION']);
								$Email->from('lvc@duoc.cl');
								$Email->viewVars(array('docente' => $docente,'clase'=>$programacion_clase));
								$Email->template('crear_reforzamiento_docente');
								if ($Email->send()) {
									#SEND MAIL C. DOCENTE
									$Email = new CakeEmail();
									$Email->emailFormat('html');
									$Email->to($session_data['CoordinadorDocente']['CORREO']);
									$Email->helpers(array('Html'));
									$Email->subject('Solicitud de Reforzamiento creada / '.$form_data['SIGLA_SECCION']);
									$Email->from('lvc@duoc.cl');
									$Email->viewVars(array('coordinador' => $session_data,'clase'=>$programacion_clase));
									$Email->template('crear_reforzamiento_coordinador_docente');
									if ($Email->send()) {
										#SEND MAIL DIRECTOR
										$this->loadModel('Director');
										$directores = $this->Director->getDirectoresBySede($session_data['Sede']['COD_SEDE']);
										foreach ($directores as $key => $value) {
											$Email = new CakeEmail();
											$Email->emailFormat('html');
											$Email->to($value['Director']['CORREO']);
											$Email->helpers(array('Html'));
											$Email->subject('Solicitud de Reforzamiento creada / '.$form_data['SIGLA_SECCION']);
											$Email->from('lvc@duoc.cl');
											$Email->viewVars(array('director' => $value,'clase'=>$programacion_clase));
											$Email->template('crear_reforzamiento_director');
											if (!$Email->send()) {
												$this->log("No se pudo enviar el mail al director en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
											}
										}
									}else{
										$this->log("No se pudo enviar el mail al coordinador docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
									}
								}else{
									$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].":<serialize>" . serialize($Email)."</serialize>", 'debug');
								}
								$this->Session->setFlash('Reforzamiento creado con &eacute;xito.','mensaje-exito');
								$this->redirect(array('action'=>'crearReforzamiento'));
							}else{
								$this->Session->setFlash('No ha seleccionado un docente valido.','mensaje-info');
							}
						}else{
							$this->Session->setFlash('No ha seleccionado un docente valido.','mensaje-info');
						}
						#debug($form_data);exit();
					}else{
						$this->Session->setFlash($asignatura_horario['message'],'mensaje-error');
					}
				}else{
					$this->Session->setFlash('El campo sigla secci&oacute;n no puede quedar vac&iacute;o','mensaje-info');
				}
			}
			$this->loadModel('Docente');
			$docentes = $this->Docente->getDocentesBySede($session_data['Sede']['COD_SEDE']);
			$this->loadModel('MotivoReforzamiento');
			$motivos = $this->MotivoReforzamiento->getMotivosActivos();
			$this->set(array(
				'docentes'=>$docentes,
				'motivos'=>$motivos,
				'permisos' => $this->PermisoFuncionalidad->getPermisoByRol($rol_id),
			));	
		}

		public function getAgendaDocente($cod_docente=null,$filtro=null,$id_semana = null,$cod_periodo = null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$programacion_clases = $semana = array();
			if (!empty($cod_docente) && !empty($filtro) && !empty($cod_periodo)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$this->loadModel('Docente');
				$docente = $this->Docente->find('first',array('conditions'=>array('COD_DOCENTE'=>$cod_docente)));

				$this->loadModel('Periodo');
	        	$periodo = $this->Periodo->findById($cod_periodo);
				$anho = $periodo['Periodo']['ANHO'];
	        	$semestre = $periodo['Periodo']['SEMESTRE'];
	        	$semanas = $this->Semana->getSemanasListByPeriodo($anho,$semestre);
	        	#debug($semanas);exit();
	        	$this->set('semanas',$semanas);
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				if (!empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosDocenteByFecha(
						$session_data['Sede']['COD_SEDE'],
						$cod_docente,
						$semana['Semana']['FECHA_INICIO'],
						$semana['Semana']['FECHA_FIN'],
						$filtro
					);
				}
			}else{
				exit('<label>*Debe seleccionar los filtros necesarios.</label>');
			}
			$this->loadModel('HorarioModulo');
			$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
			$this->set(array(
				'programacion_clases'=>$programacion_clases,
				'horarios_modulos'=>$horarios_modulos,
				'semana'=>$semana,
				'docente'=>$docente,
				'cod_docente'=>$cod_docente,
				'filtro'=>$filtro,
				'cod_periodo' => $cod_periodo
			));
		}

		public function imprimirHorarioCargaDocente($cod_docente=null,$filtro=null,$id_semana = null)
		{
			$this->layout = 'imprimir';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($cod_docente) && !empty($filtro)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				$this->loadModel('HorarioModulo');
				$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
				if (!empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosDocenteByFecha(
						$session_data['Sede']['COD_SEDE'],
						$cod_docente,
						$semana['Semana']['FECHA_INICIO'],
						$semana['Semana']['FECHA_FIN'],
						$filtro
					);
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'horarios_modulos'=>$horarios_modulos,
					'semana'=>$semana,
					'cod_docente'=>$cod_docente,
					'filtro'=>$filtro,
				));
			}
		}

		public function excelHorarioCargaDocente($cod_docente=null,$filtro=null,$id_semana = null)
		{
			$this->layout = 'excel';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($cod_docente) && !empty($filtro)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				$this->loadModel('HorarioModulo');
				$this->loadModel('Docente');
				$docente = $this->Docente->getDocente($cod_docente);
				$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
				if (!empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosDocenteByFecha(
						$session_data['Sede']['COD_SEDE'],
						$cod_docente,
						$semana['Semana']['FECHA_INICIO'],
						$semana['Semana']['FECHA_FIN'],
						$filtro
					);
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'horarios_modulos'=>$horarios_modulos,
					'semana'=>$semana,
					'docente'=>$docente,
					'cod_docente'=>$cod_docente,
					'filtro'=>$filtro,
				));
			}
		}

		public function pdfHorarioCargaDocente($cod_docente=null,$filtro=null,$id_semana = null)
		{
			$this->layout = null;
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($cod_docente) && !empty($filtro)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				$this->loadModel('HorarioModulo');
				$this->loadModel('Docente');
				$docente = $this->Docente->getDocente($cod_docente);
				$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
				if (!empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosDocenteByFecha(
						$session_data['Sede']['COD_SEDE'],
						$cod_docente,
						$semana['Semana']['FECHA_INICIO'],
						$semana['Semana']['FECHA_FIN'],
						$filtro
					);
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'horarios_modulos'=>$horarios_modulos,
					'semana'=>$semana,
					'docente'=>$docente,
					'cod_docente'=>$cod_docente,
					'filtro'=>$filtro,
				));
			}
			$this->Mpdf->init(array('margin_top' => 5,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('planilla_'.date('d-m-Y').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('a');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
		}

		public function getAgendaSalasDisponibles($cod_sala=null,$id_semana=null,$hora_inicio=null,$hora_fin=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($cod_sala) && !empty($id_semana)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$sala = $this->Sala->getSala($cod_sala);
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				$this->loadModel('HorarioModulo');
				$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
				if (!empty($sala) && !empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosSalasByFecha($cod_sala,$semana['Semana']['FECHA_INICIO'],$semana['Semana']['FECHA_FIN'],$hora_inicio,$hora_fin);
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'horarios_modulos'=>$horarios_modulos,
					'sala'=>$sala,
					'hora_inicio'=>$hora_inicio,
					'hora_fin'=>$hora_fin,
					'semana'=>$semana,
				));
			}
		}

		public function imprimirDisponibilidadSala($cod_sala=null,$id_semana=null,$hora_inicio=null,$hora_fin=null)
		{
			$this->layout = 'imprimir';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($cod_sala) && !empty($id_semana)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$sala = $this->Sala->getSala($cod_sala);
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				$this->loadModel('HorarioModulo');
				$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
				if (!empty($sala) && !empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosSalasByFecha($cod_sala,$semana['Semana']['FECHA_INICIO'],$semana['Semana']['FECHA_FIN'],$hora_inicio,$hora_fin);
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'horarios_modulos'=>$horarios_modulos,
					'sala'=>$sala,
					'semana'=>$semana,
				));
			}
		}

		public function excelDisponibilidadSala($cod_sala=null,$id_semana=null,$hora_inicio=null,$hora_fin=null)
		{
			$this->layout = 'excel';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($cod_sala) && !empty($id_semana)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$sala = $this->Sala->getSala($cod_sala);
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				$this->loadModel('HorarioModulo');
				$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
				if (!empty($sala) && !empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosSalasByFecha($cod_sala,$semana['Semana']['FECHA_INICIO'],$semana['Semana']['FECHA_FIN'],$hora_inicio,$hora_fin);
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'horarios_modulos'=>$horarios_modulos,
					'sala'=>$sala,
					'semana'=>$semana,
				));
			}
		}

		public function pdfDisponibilidadSala($cod_sala=null,$id_semana=null,$hora_inicio=null,$hora_fin=null)
		{
			$this->layout = null;
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($cod_sala) && !empty($id_semana)) {
				$this->loadModel('Sala');
				$this->loadModel('Semana');
				$sala = $this->Sala->getSala($cod_sala);
				$semana = $this->Semana->findById($id_semana);
				$programacion_clases = array();
				$this->loadModel('HorarioModulo');
				$horarios_modulos = $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']);
				if (!empty($sala) && !empty($semana)) {
					$programacion_clases = $this->ProgramacionClase->getHorariosSalasByFecha($cod_sala,$semana['Semana']['FECHA_INICIO'],$semana['Semana']['FECHA_FIN'],$hora_inicio,$hora_fin);
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'horarios_modulos'=>$horarios_modulos,
					'sala'=>$sala,
					'semana'=>$semana,
				));
			}
			$this->Mpdf->init(array('margin_top' => 5,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('planilla_'.date('d-m-Y').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('a');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
		}

		public function disponibilidadSala()
		{
			$this->loadModel('Sala');
			$this->loadModel('Semana');
			$this->loadModel('Periodo');
			$this->loadModel('HorarioModulo');
			$this->loadModel('Periodo');

			$periodo_seleccionado = null;
			$session_data = $this->Session->read('CoordinadorLogueado');
			$salas=$semanas=$capacidades=array();
			$fecha_filtro = $semana_selected = $sala_selected = $tipo_sala_filtro = $capacidad_sala_filtro = null;
			
			if (!empty($this->data)) {
				#debug($this->data);#exit();
				if (isset($this->data['Filter']['PERIODO']) && !empty($this->data['Filter']['PERIODO'])) {
					
					$periodo = $this->Periodo->findById($this->data['Filter']['PERIODO']);
				}else{
					$periodo = $this->Periodo->getPeriodoActual();
				}
				if(!empty($periodo)){
		        	$anho = $periodo['Periodo']['ANHO'];
		        	$semestre = $periodo['Periodo']['SEMESTRE'];
					$semanas = $this->Semana->getSemanasListByPeriodo($anho,$semestre);
		        }
		        $periodo_seleccionado = $periodo['Periodo']['ID'];
				if (isset($this->data['Filter']['SEMANA']) && !empty($this->data['Filter']['SEMANA'])) {
					$semana_selected = $this->Semana->getSemana($this->data['Filter']['SEMANA']);
					$semana_selected = $semana_selected['Semana']['ID'];
				}
				if (isset($this->data['Filter']['SALA']) && !empty($this->data['Filter']['SALA'])) {
					$sala_selected = $this->Sala->getSala($this->data['Filter']['SALA']);
					$sala_selected = $sala_selected['Sala']['COD_SALA'];
				}
				if (isset($this->data['Filter']['TIPO_SALA']) && !empty($this->data['Filter']['TIPO_SALA'])) {
					$tipo_sala_filtro = $this->data['Filter']['TIPO_SALA'];
				}
				if (isset($this->data['Filter']['CAPACIDAD']) && !empty($this->data['Filter']['CAPACIDAD'])) {
					$capacidad_sala_filtro = $this->data['Filter']['CAPACIDAD'];
				}
				$salas = $this->Sala->getSalasBySedeCapacidadTipo($session_data['Sede']['CODIGO_SAP'],$capacidad_sala_filtro,$tipo_sala_filtro,$sala_selected);
				#exit();
			}
			$listado_salas=$this->Sala->getSalasBySedeAll($session_data['Sede']['CODIGO_SAP']);
			foreach ($listado_salas  as $key => $val){
				if ($val['Sala']['CAPACIDAD']>0) {
					$capacidades[$val['Sala']['CAPACIDAD']]=$val['Sala']['CAPACIDAD'];
				}
			}
			$this->set(array(
				'salas_listado'			=> $listado_salas,
				'salas'					=> $salas,
				'filtros'				=> $this->data,
				'semanas'				=> $semanas,
				'semanas_listado'		=> $semanas,
				'periodos'				=> $this->Periodo->getPeriodos(),
				'horarios_modulos' 		=> $this->HorarioModulo->getHorarios($session_data['Sede']['COD_SEDE']),
				'semana_selected'		=> $semana_selected,
				'periodo_seleccionado'	=> $periodo_seleccionado,
				'capacidades' 			=> $capacidades
			));
		}
		


		public function optenerSalasPorCapacidad(){
			$this->layout = 'ajax';
			$this->loadModel('Sala');
			$arreglo=array();
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cap=$this->data['capacidad'];
			$salas=$this->Sala->getSalasBySedeByCapacidadAll($session_data['Sede']['CODIGO_SAP'], $cap);
			foreach ($salas as $key => $val) {
				$partes=explode('(', $val['Sala']['TIPO_SALA']);
				if (count($partes>1)) {
					$arreglo[] = array(
						'id' => $val['Sala']['COD_SALA'], 
						'sala' => trim($partes[0]).' ('.$val['Sala']['CAPACIDAD'].')',
					);
				}else{
					$arreglo[] = array(
						'id' => $val['Sala']['COD_SALA'], 
						'sala' => trim($val['Sala']['TIPO_SALA']).' ('.$val['Sala']['CAPACIDAD'].')',
					);
				}
			}
			$this->set('dataSalas', $arreglo);
		}



		public function horarioCargaDocente()
		{
			$this->loadModel('Sala');
			$this->loadModel('Semana');
			$session_data = $this->Session->read('CoordinadorLogueado');
			//$semanas_listado = $this->Semana->getSemanasList();
			//$semanas = $this->Semana->getSemanasList();
			$this->loadModel('Periodo');
			$periodos = $this->Periodo->getPeriodos();
			$this->set(array(
				'filtros'=>$this->data,
				//'semanas'=>$semanas,
				//'semanas_listado'=>$semanas_listado,
				'periodos' => $periodos
			));
			$alumnos = array();
			$this->set('alumnos',$alumnos);
		}

		# =======================================================
		# Metodo que permite cargar los filtros en la vista.
		public function asistenciaDocente()
		{
			$this->loadModel('Periodo');
			$this->loadModel('Detalle');
			$this->loadModel('SubEstado');
			$this->loadModel('Estado');
			$this->loadModel('HorarioModulo');
			$session_data 	= $this->Session->read('CoordinadorLogueado');
			$sede_id 		= $session_data['Sede']['COD_SEDE'];
			$periodos 		= $this->Periodo->getPeriodos();
			$detalles 		= $this->Detalle->getAllDetalles();
			$sub_estados 	= $this->SubEstado->find('all', array('order'=>'SubEstado.NOMBRE'));
			$estados 		= $this->Estado->getEstados();
			$horarios 		= $this->HorarioModulo->getSimpleHorarioBySede($sede_id);
			$retorno_filtros= $this->Session->read('retorno_filtros');
			$this->Session->delete('retorno_filtros');	
			$this->set(array(
				'detalles'			=> $detalles,
				'horarios'			=> $horarios,
				'periodos'			=> $periodos,
				'estados'			=> $estados,
				'sub_estados'		=> $sub_estados,
				'periodoActual' 	=> $this->Periodo->getPeriodoActual(),
				'retorno_filtros'	=> $retorno_filtros
			));
		}
		public function getGrillaAsistenciaDocente()
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$this->Session->write('retorno_filtros', $this->data['Filtro']);
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			$programacion_clases = array();
			if (!empty($this->data) && isset($this->data['Filtro'])) {
				$filtros = $this->data['Filtro'];
				if (empty($filtros['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d');
				}else{
					$fecha_desde = date('Y-m-d',strtotime($filtros['fecha_inicio']));
				}
				if (empty($filtros['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d');
				}else{
					$fecha_hasta = date('Y-m-d',strtotime($filtros['fecha_fin']));
				}
				if (!empty($filtros['filtro']) && !empty($filtros['value'])) {
					$filtro = $filtros['filtro'];
					$valor_filtros = $filtros['value'];
				}
				if(isset($filtros['ordenar']))
					$ordenar = $filtros['ordenar'];

				$cod_docente = null;
				$sigla_seccion = null;
				if( isset($filtro) and in_array($filtro, array('Docente.RUT','Docente.NOMBRE','Docente.COD_FUNCIONARIO')) ){
					$cod_docente=$valor_filtros;
				}else{
					$sigla_seccion = isset( $valor_filtros ) ? $valor_filtros : '';
				}
				$programacion_clases = $this->ProgramacionClase->getProgramacionByAsistenciaDocente(
					$cod_docente,
					$cod_sede,
					$sigla_seccion,
					$fecha_desde,
					$fecha_hasta
				);
			}
			$this->set(array(
				'programacion_clases'=>$programacion_clases,
				'cod_docente'=>$cod_docente,
				'sigla_seccion'=>$sigla_seccion,
				'fecha_desde'=>$fecha_desde,
				'fecha_hasta'=>$fecha_hasta
			));
		}

		public function imprimirAsistenciaDocente($cod_docente = null,$sigla_seccion=null,$fecha_desde=null,$fecha_hasta=null)
		{
			$this->layout = 'imprimir';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			$sigla_seccion = $sigla_seccion == 0 ? null: $sigla_seccion;
			$cod_docente = $cod_docente == 0 ? null: $cod_docente;
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAsistenciaDocente(
				$cod_docente,
				$cod_sede,
				$sigla_seccion,
				$fecha_desde,
				$fecha_hasta
			);
			$this->set(array(
				'programacion_clases'=>$programacion_clases,
			));
		}

		public function excelAsistenciaDocente($cod_docente = null,$sigla_seccion=null,$fecha_desde=null,$fecha_hasta=null)
		{
			$this->layout = 'excel';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			$sigla_seccion = $sigla_seccion == 0 ? null: $sigla_seccion;
			$cod_docente = $cod_docente == 0 ? null: $cod_docente;
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAsistenciaDocente(
				$cod_docente,
				$cod_sede,
				$sigla_seccion,
				$fecha_desde,
				$fecha_hasta
			);
			$this->loadModel('Docente');
			$docente = $this->Docente->getDocente($cod_docente);
			$this->set(array(
				'programacion_clases'=>$programacion_clases,
				'docente'=>$docente,
				'sigla_seccion'=>$sigla_seccion,
				'fecha_desde'=>$fecha_desde,
				'fecha_hasta'=>$fecha_hasta
			));
		}

		public function pdfAsistenciaDocente($cod_docente = null,$sigla_seccion=null,$fecha_desde=null,$fecha_hasta=null)
		{
			$this->layout = null;
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$cod_sede =  $session_data['Sede']['COD_SEDE'];
			$sigla_seccion = $sigla_seccion == 0 ? null: $sigla_seccion;
			$cod_docente = $cod_docente == 0 ? null: $cod_docente;
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAsistenciaDocente(
				$cod_docente,
				$cod_sede,
				$sigla_seccion,
				$fecha_desde,
				$fecha_hasta
			);
			$this->loadModel('Docente');
			$docente = $this->Docente->getDocente($cod_docente);
			$this->set(array(
				'programacion_clases'=>$programacion_clases,
				'docente'=>$docente,
				'sigla_seccion'=>$sigla_seccion,
				'fecha_desde'=>$fecha_desde,
				'fecha_hasta'=>$fecha_hasta
			));
			$this->Mpdf->init(array('margin_top' => 5,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('planilla_'.date('d-m-Y').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('a');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
		}

		public function imprimirSolicitudRecuperacion()
		{
			$this->layout = 'imprimir';
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$programacion_clases = $this->ProgramacionClase->getSolicitudRecuperacion($session_data['Sede']['COD_SEDE']);
			$this->set(array(
				'programacion_clases'=>$programacion_clases,
				'datos_filtro'=>$this->data,
			));
		}

		public function excelSolicitudRecuperacion()
		{
			$this->layout = null;
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$programacion_clases = $this->ProgramacionClase->getSolicitudRecuperacion($session_data['Sede']['COD_SEDE']);
			$this->set(array(
				'programacion_clases'=>$programacion_clases,
				'datos_filtro'=>$this->data,
			));
		}

		# --------------------------------------------------------------------------------------
		# Guardar un nuevo cambio de horario en la programaci&oacute;n de la clase.
		public function saveCambioHorario($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			# --------------------------------------------------------------------
			# Validar la informaci&oacute;n inicial de la programaci&oacute;n.
			$prClase = $this->ProgramacionClase->getProgramacionClase($cod_programacion);
			if (empty($prClase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'asistenciaDocente'));
			}

			# --------------------------------------------------------------------
			# Si la informaci&oacute;n inicial de la programaci&oacute;n y la informaci&oacute;n del formulario entonces:
			if (!empty($this->data['Horario']['FECHA_INICIO_PROGRAMACION']) && !empty($this->data['Horario']['FECHA_FINALIZADA_PROGRAMACION'])) {
				$ini=substr($prClase['ProgramacionClase']['HORA_INICIO'], 0, 10).' '.$this->data['Horario']['FECHA_INICIO_PROGRAMACION'].':00';
				$fin=substr($prClase['ProgramacionClase']['HORA_FIN'], 0, 10).' '.$this->data['Horario']['FECHA_FINALIZADA_PROGRAMACION'].':00';
				$ini=strtotime($ini);
				$fin=strtotime($fin);
				if ($ini>=$fin) {
					$this->Session->setFlash('No se puede realizar el cambio por que la fecha inicial: ('.$this->data['Horario']['FECHA_INICIO_PROGRAMACION'].') es mayor &oacute; igual a la final ('.$this->data['Horario']['FECHA_FINALIZADA_PROGRAMACION'].').','mensaje-info');
					$this->redirect(array('action'=>'asistenciaDocente'));
				}else{
					# --------------------------------------------------------------------
					# Pone la fecha original y cambia a la que el usuario envia en el form.
					$fechaIniProg = strtotime($prClase['ProgramacionClase']['HORA_INICIO']);
					if (!empty($prClase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])) {
						$fechaIniProg = strtotime($prClase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']);
					}
					$fechaIniProg = date('Y-m-d',$fechaIniProg).' '.$this->data['Horario']['FECHA_INICIO_PROGRAMACION'];
					
					# --------------------------------------------------------------------
					# Pone la fecha original y cambia a la que el usuario envia en el form.
					$fechaFinProg = strtotime($prClase['ProgramacionClase']['HORA_FIN']);
					if (!empty($prClase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])) {
						$fechaFinProg = strtotime($prClase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION']);
					}
					$fechaFinProg = date('Y-m-d',$fechaFinProg).' '.$this->data['Horario']['FECHA_FINALIZADA_PROGRAMACION'];
					# --------------------------------------------------------------------
					# Setea la variable para el cambio.
					$update = array(
						'ID'=>$prClase['ProgramacionClase']['ID'],
						'FECHA_INICIO_PROGRAMACION'=>$fechaIniProg,
						'FECHA_FINALIZADA_PROGRAMACION'=>$fechaFinProg,
					);
					# --------------------------------------------------------------------
					# Mensajes de cambios.
					$text_horario_inicio = $text_horario_fin = null;
					if ($this->data['Horario']['FECHA_INICIO_PROGRAMACION'] != date('H:i',strtotime($prClase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']))) {
						if (empty($prClase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])) {
							$text_horario_inicio = 'Cambio horario inicio a '.$this->data['Horario']['FECHA_INICIO_PROGRAMACION'];
						}else{
							$text_horario_inicio = 'Cambio horario inicio de '.date('H:i',strtotime($prClase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])).' a '.$this->data['Horario']['FECHA_INICIO_PROGRAMACION'];
						}
					}
					if ($this->data['Horario']['FECHA_FINALIZADA_PROGRAMACION'] != date('H:i',strtotime($prClase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION']))) {
						if (empty($prClase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])) {
							$text_horario_fin = 'Cambio horario fin a '.$this->data['Horario']['FECHA_FINALIZADA_PROGRAMACION'];
						}else{
							$text_horario_fin = 'Cambio horario fin de '.date('H:i',strtotime($prClase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])).' a '.$this->data['Horario']['FECHA_FINALIZADA_PROGRAMACION'];
						}
					}
					# --------------------------------------------------------------------
					# Actualizar la programaci&oacute;n de la clase.
					if ($this->ProgramacionClase->save($update)) {
						$new_log_evento = array(
							'COD_PROGRAMACION'=>$prClase['ProgramacionClase']['COD_PROGRAMACION'],
							'DETALLE'=>'EDITAR REGISTRO DE INICIO Y FIN',
							'USUARIO_CREADOR'=>$session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT'],
							'CREATED'=>date('Y-m-d H:i:s'),
							'MODIFIED'=>date('Y-m-d H:i:s'),
							'COD'=>uniqid(),
							'ASISTENCIA_DOCENTE'=>1,
							'CAMBIO_HORARIO_INICIO'=> !empty($text_horario_inicio) ? $text_horario_inicio : 'Hora de inicio queda igual.',
							'CAMBIO_HORARIO_FIN'=>  !empty($text_horario_fin) ? $text_horario_fin : 'Hora final queda igual.',
						);
						$this->loadModel('LogEvento');
						$this->LogEvento->create();
						if ($this->LogEvento->save($new_log_evento)) {
							$this->Session->setFlash('Su informaci&oacute;n se ha almacenado con &eacute;xito.','mensaje-exito');
							$this->redirect(array('action'=>'fichaAsistenciaDocenteDetalle',$cod_programacion));
						}
					}
				}
			}else{
				$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'fichaAsistenciaDocenteDetalle',$cod_programacion));	
			}
		}

		public function saveRecuperarAtrasoRetiro($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'asistenciaDocente'));
			}
			if (!empty($this->data)) {
				$update = array(
					'ID'=>$programacion_clase['ProgramacionClase']['ID'],
					'SUB_ESTADO_PROGRAMACION_ID'=>5,//Por Recuperar
					'ESTADO_PROGRAMACION_ID'=>2,//NO REALIZADA
					'MOTIVO_ID'=>$this->data['ProgramacionClase']['MOTIVO'],
					'OBS_SOLICITUD_RECUPERACION'=>strip_tags($this->data['ProgramacionClase']['OBSERVACIONES']),
				);
				#debug($this->data);exit();
				if ($this->ProgramacionClase->save($update)) {
					$this->loadModel('RecuperarAtrasoRetiro');
					$recuper_aratraso_retiro = $this->RecuperarAtrasoRetiro->findById($this->data['ProgramacionClase']['MOTIVO']);
					$recuper_aratraso_retiro_text = '';
					if (!empty($recuper_aratraso_retiro)) {
						$recuper_aratraso_retiro_text = $recuper_aratraso_retiro['RecuperarAtrasoRetiro']['MOTIVO'];
					}
					$new_log_evento = array(
						'COD_PROGRAMACION'=>$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'],
						'DETALLE'=>'RECUPERAR ATRASOS Y RETIROS',
						'USUARIO_CREADOR'=>$session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT'],
						'CREATED'=>date('Y-m-d H:i:s'),
						'MODIFIED'=>date('Y-m-d H:i:s'),
						'COD'=>uniqid(),
						'ASISTENCIA_DOCENTE'=>1,
						'MOTIVO'=>$recuper_aratraso_retiro_text,
						'CAMBIO_HORARIO_FIN'=>'Observaciones: '.strip_tags($this->data['ProgramacionClase']['OBSERVACIONES']),
						'CAMBIO_HORARIO_INICIO'=>'Modulos a recuperar: '.$this->data['ProgramacionClase']['MODULOS']
					);
					$this->loadModel('LogEvento');
					$this->LogEvento->create();
					if ($this->LogEvento->save($new_log_evento)) {
						#EMAIL DOCENTE
						$this->loadModel('Docente');
						$cod_docente = !empty($programacion_clase['ProgramacionClase']['COD_DOCENTE_ALTERNATIVO'])?$programacion_clase['ProgramacionClase']['COD_DOCENTE_ALTERNATIVO']:$programacion_clase['ProgramacionClase']['COD_DOCENTE'];
						$docente = $this->Docente->getDocente($cod_docente);
						if(!empty($docente)){
							if (!empty($docente['Docente']['CORREO'])) {
								$Email = new CakeEmail();
								$Email->emailFormat('html');
								$Email->to($docente['Docente']['CORREO']);
								$Email->helpers(array('Html'));
								$Email->subject('[LVC] - Recuperar Atraso y Reforzamiento '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
								$Email->from('lvc@duoc.cl');
								$Email->viewVars(array(
									'docente' => $docente,
									'clase'=>$programacion_clase,
									'modulos_recuperar'=>$this->data['ProgramacionClase']['MODULOS'],
									'motivo'=>$recuper_aratraso_retiro_text,
									'observaciones'=>strip_tags($this->data['ProgramacionClase']['OBSERVACIONES']),
								));
								$Email->template('recuperar_atraso_reforzamiento_docente');
								if (!$Email->send()) {
									$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].": CLASE EMAIL SEND  ".serialize($Email)."", 'debug');
								}
							}else{
								$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].": EL DOCENTE ".serialize($docente)." RETORNO EMAIL VACIO.", 'debug');
							}
						}else{
							$this->log("No se pudo enviar el mail al docente en ".$this->params['controller']."/".$this->params['action'].": EL DOCENTE ".$cod_docente." RETORNO VACIO.", 'debug');
						}
						
						#EMAIL COORDINADOR DOCENTE	
						if(!empty($session_data)){
							if (!empty($session_data['CoordinadorDocente']['CORREO'])) {
								$Email = new CakeEmail();
								$Email->emailFormat('html');
								$Email->to($session_data['CoordinadorDocente']['CORREO']);
								$Email->helpers(array('Html'));
								$Email->subject('[LVC] - Recuperar Atraso y Reforzamiento '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
								$Email->from('lvc@duoc.cl');
								$Email->template('recuperar_atraso_reforzamiento_coordinador_docente');
								$Email->viewVars(array(
									'coordinador' => $session_data,
									'clase'=>$programacion_clase,
									'motivo'=>$recuper_aratraso_retiro_text,
									'observaciones'=>strip_tags($this->data['ProgramacionClase']['OBSERVACIONES']),
									'modulos_recuperar'=>$this->data['ProgramacionClase']['MODULOS'],
								));
								#debug($Email);exit();
								if (!$Email->send()) {
									$this->log("No se pudo enviar el mail al C. docente en ".$this->params['controller']."/".$this->params['action'].": CLASE EMAIL SEND  ".serialize($Email)."", 'debug');
								}
							}else{
								$this->log("No se pudo enviar el mail al C. docente en ".$this->params['controller']."/".$this->params['action'].": EL C DOCENTE ".serialize($session_data)." RETORNO EMAIL VACIO.", 'debug');
							}
						}else{
							$this->log("No se pudo enviar el mail al C. docente en ".$this->params['controller']."/".$this->params['action'].": EL C DOCENTE ".$session_data." RETORNO VACIO.", 'debug');
						}

						#EMAIL DIRECTOR
						$this->loadModel('Director');
						$directores = $this->Director->getDirectoresBySede($session_data['Sede']['COD_SEDE']);
						if(!empty($directores)){
							foreach ($directores as $key => $value) {
								if (!empty($value['Director']['CORREO'])) {
									$Email = new CakeEmail();
									$Email->emailFormat('html');
									$Email->to($value['Director']['CORREO']);
									$Email->helpers(array('Html'));
									$Email->subject('[LVC] - Recuperar Atraso y Reforzamiento '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
									$Email->from('lvc@duoc.cl');
									$Email->template('recuperar_atraso_reforzamiento_director');
									$Email->viewVars(array(
										'director' => $value,
										'clase'=>$programacion_clase,
										'motivo'=>$recuper_aratraso_retiro_text,
										'observaciones'=>strip_tags($this->data['ProgramacionClase']['OBSERVACIONES']),
										'modulos_recuperar'=>$this->data['ProgramacionClase']['MODULOS'],
									));
									if (!$Email->send()) {
										$this->log("No se pudo enviar el mail al director en ".$this->params['controller']."/".$this->params['action'].": CLASE EMAIL SEND  ".serialize($Email)."", 'debug');
									}
								}else{
									$this->log("No se pudo enviar el mail al director en ".$this->params['controller']."/".$this->params['action'].": EL director ".serialize($value)." RETORNO EMAIL VACIO.", 'debug');
								}
							}
						}else{
							$this->log("No se pudo enviar el mail a el/los director(es) en ".$this->params['controller']."/".$this->params['action'].": LA QUERY ".serialize($this->Director->getLastQuery())." RETORNO VACIO.", 'debug');
						}
						$this->Session->setFlash('Su informaci&oacute;n se ha almacenado con &eacute;xito.','mensaje-exito');
						$this->redirect(array('action'=>'fichaAsistenciaDocenteDetalle',$cod_programacion));
					}
				}
			}
			$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-info');
			$this->redirect(array('action'=>'fichaAsistenciaDocenteDetalle',$cod_programacion));
		}
		
		public function cambiarSala($cod_programacion=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClase($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.','mensaje-info');
				exit('<script>location.reload(); </script>');
			}
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($this->data)) {
				$form_data = $this->data;
				if (isset($form_data['ProgramacionClase']['SALA_REEMPLAZO']) && !empty($form_data['ProgramacionClase']['SALA_REEMPLAZO'])) {
					$up_programacion_clase = array(
						'ID'=>$programacion_clase['ProgramacionClase']['ID'],
						'SALA_REEMPLAZO'=>$form_data['ProgramacionClase']['SALA_REEMPLAZO'],
					);
					$this->loadModel('Sala');
					$sala = $this->Sala->findById($form_data['ProgramacionClase']['SALA_REEMPLAZO']);
					if (!empty($sala)) {
						if ($this->ProgramacionClase->save($up_programacion_clase)) {
							$new_log_evento = array(
								'COD_PROGRAMACION'=>$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'],
								'DETALLE'=>'CAMBIO DE SALA',
								'USUARIO_CREADOR'=>$session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT'],
								'CREATED'=>date('Y-m-d H:i:s'),
								'MODIFIED'=>date('Y-m-d H:i:s'),
								'SALA_REEMPLAZO'=>$sala['Sala']['TIPO_SALA'],
								'COD'=>uniqid(),
							);
							$this->loadModel('LogEvento');
							$this->LogEvento->create();
							if ($this->LogEvento->save($new_log_evento)) {
								$this->loadModel('AsignaturaHorario');
								$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
								$this->loadModel('AlumnoAsignatura');
								$listado_alumnos = $this->AlumnoAsignatura->getListadoAsistencia($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'],$asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_SEDE']);
								foreach ($listado_alumnos as $key => $value) {
									$Email = new CakeEmail();
									$Email->emailFormat('html');
									$Email->to($value['Alumno']['CORREO_PERSONAL']);
									$Email->helpers(array('Html'));
									$Email->subject('[LVC] - Cambio Sala');
									$Email->from('lvc@duoc.cl');
									$Email->viewVars(array('alumno' => $value));
									$Email->template('cambiar_sala_alumno');
									if ($Email->send()) {
										
									}
								}
								$Email = new CakeEmail();
								$Email->emailFormat('html');
								$Email->to($asignatura_horario['Docente']['CORREO']);
								$Email->helpers(array('Html'));
								$Email->subject('[LVC] - Cambio Sala');
								$Email->from('lvc@duoc.cl');
								$Email->viewVars(array('docente' => $asignatura_horario));
								$Email->template('cambiar_sala_docente');
								if ($Email->send()) {
									
								}
								$this->Session->setFlash('Informaci&oacute;n grabada con &eacute;xito.','mensaje-exito');
								$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
							}
						}
					}else{
						$this->Session->setFlash('La sala seleccionada no se encuentra en el registro local de salas. Intente nuevamente.','mensaje-info');
						$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
					}
				}else{
					$this->Session->setFlash('Debe seleccionar una sala de la lista. Intente nuevamente.','mensaje-info');
					$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
				}
			}
			$this->loadModel('Sala');
			$salas = $this->Sala->getSalasDisponible($session_data['Sede']['COD_SEDE'],$programacion_clase['ProgramacionClase']['HORA_INICIO'],$programacion_clase['ProgramacionClase']['HORA_FIN']);
			$this->set(array(
				'programacion_clase'=>$programacion_clase,
				'salas'=>$salas,
			));
		}

		public function inasistenciaDocente($cod_programacion=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamente.','mensaje-info');
				exit('<script>location.reload(); </script>');
			}
			$session_data = $this->Session->read('CoordinadorLogueado');
			$this->loadModel('Docente');
			if (!empty($this->data)) {
				$error='';
				if (empty($this->data['LogEvento']['MOTIVO_INASISTENCIA_DOCENTE_ID'])) {
					$error.='Se requiere seleccionar un motivo.<br>';
				}
				if (empty($this->data['LogEvento']['OBSERVACIONES'])) {
					$error.='Se requieren las observaciones. Intente nuevamanete.<br>';
				}
				if (!empty($this->data['LogEvento']['REEMPLAZO_DOCENTE'])) {
					if (empty($this->data['LogEvento']['DOCENTE_REEMPLAZO'])) {
						$error.='Se requieren selecci&oacute;n del docente.<br>';
					}
				}
				if ( empty($error) ) {
					$this->ProgramacionClase->begin();
					try {
						#debug($this->data);Exit();
						$form_data = $this->data['LogEvento'];
						#EL DETALLE DEBE SER INASISTENCIA DOCENTE
						$up_programacion_clase = array(
							'DETALLE_ID'=>1,
							'ID'=>$programacion_clase['ProgramacionClase']['ID'],
							'MOTIVO_ID'=>$form_data['MOTIVO_INASISTENCIA_DOCENTE_ID'],
							'OBS_SOLICITUD_RECUPERACION'=>$form_data['OBSERVACIONES'],
						);
						#EN AMBOS CASOS SE DEBE NOTIFICAR AL PROFESOR.
						#SI HAY REEMPLAZO 
						$docente_reemplazo = array();
						if (isset($form_data['REEMPLAZO_DOCENTE']) && $form_data['REEMPLAZO_DOCENTE']==1 && !empty($form_data['DOCENTE_REEMPLAZO'])) {
							$hay_reemplazo_docente = true;
							$docente_reemplazo = $this->Docente->getDocente($form_data['DOCENTE_REEMPLAZO']);
							if (empty($docente_reemplazo)) {
								$this->Session->setFlash('El docente que ha seleccionado no esta disponible. Intente nuevamente.','mensaje-info');
								$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
							}
							$up_programacion_clase['DOCENTE_REEMPLAZO_ID'] = $docente_reemplazo['Docente']['COD_DOCENTE'];
							#ESTADO PROGRAMADA
							$up_programacion_clase['ESTADO_PROGRAMACION_ID'] = 3;
							#SUB ESTADO A REEMPLAZO DOCENTE
							$up_programacion_clase['SUB_ESTADO_PROGRAMACION_ID'] = 4;
						#NO HAY REEMPLAZO DOCENTE
						}else{
							#NOTIFICAR A TODOS LOS ALUMNOS SI NO HAY REEMPLAZO DOCENTE.
							$hay_reemplazo_docente = false;
							#CAMBIO ESTADO A NO REALIZADA Y SUB_ESTADO POR RECUPERAR
							$up_programacion_clase['ESTADO_PROGRAMACION_ID'] = 2;
							$up_programacion_clase['SUB_ESTADO_PROGRAMACION_ID'] = 5;
						}
						if ($this->ProgramacionClase->save($up_programacion_clase)) {
							$new_log_evento = array(
								'DETALLE'=>'INASISTENCIA DOCENTE',
								'COD_PROGRAMACION'=>$cod_programacion,
								'USUARIO_CREADOR'=>$session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT'],
								'CREATED'=>date('Y-m-d H:i:s'),
								'MODIFIED'=>date('Y-m-d H:i:s'),
								'COD'=>uniqid(),
							);
							if (!empty($docente_reemplazo)) {
								$new_log_evento['RUT_DOCENTE'] = $docente_reemplazo['Docente']['RUT'];
								$new_log_evento['NOMBRES_DOCENTE'] = $docente_reemplazo['Docente']['NOMBRE'];
								$new_log_evento['APELLIDO_PAT_DOCENTE'] = $docente_reemplazo['Docente']['APELLIDO_PAT'];
								$new_log_evento['APELLIDO_MAT_DOCENTE'] = $docente_reemplazo['Docente']['APELLIDO_MAT'];
							}
							$this->loadModel('LogEvento');
							if($this->LogEvento->save($new_log_evento)){
								$docente_titular = $this->Docente->getDocente($programacion_clase['ProgramacionClase']['COD_DOCENTE']);
								#CORREO A LOS ALUMNOS SOLO EN CASO DE QUE NO EXISTA UN REEMPLAZO DOCENTE.
								if (!$hay_reemplazo_docente) {
									$this->loadModel('AsignaturaHorario');
									$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
									$this->loadModel('AlumnoAsignatura');
									if (!empty($asignatura_horario)) {
										$listado_alumnos = $this->AlumnoAsignatura->getListadoAsistencia($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'],$asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_SEDE']);
										if (!empty($listado_alumnos)) {
											foreach ($listado_alumnos as $key => $value) {
												if(!empty($value['Alumno']['CORREO_PERSONAL'])){
													$Email = new CakeEmail();
													$Email->emailFormat('html');
													$Email->to($value['Alumno']['CORREO_PERSONAL']);
													$Email->helpers(array('Html'));
													$Email->subject('Suspensi&oacute;n de Clase / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
													$Email->from('lvc@duoc.cl');
													$Email->viewVars(array(
														'alumno' => $value,
														'clase'=>$programacion_clase,
													));
													$Email->template('inasistencia_docente_alumno');
													if (!$Email->send()) {
														$this->log("No se pudo enviar el mail al alumno en ".$this->params['controller']."/".$this->params['action'].": CLASE EMAIL SEND <serialize>" . serialize($Email)."</serialize>", 'debug');
													}
												}else{
													$this->log("No se pudo enviar el mail al alumno en ".$this->params['controller']."/".$this->params['action'].": EL ALUMNO ".serialize($value)." RETORNO EMAIL VACIO.", 'debug');
												}
											}
										}else{
											$this->log("No se pudo enviar el mail a los alumnos en ".$this->params['controller']."/".$this->params['action'].": LA QUERY ".serialize($this->AlumnoAsignatura->getLastQuery())." RETORNO VACIO.", 'debug');
										}
									}else{
										$this->log("No se pudo enviar el mail a los alumnos en ".$this->params['controller']."/".$this->params['action'].": LA QUERY ".serialize($this->AsignaturaHorario->getLastQuery())." RETORNO VACIO.", 'debug');
									}
								}else{
									#CORREO AL DOCENTE REEMPLAZO
									if (!empty($docente_reemplazo)) {
										if (!empty($docente_reemplazo['Docente']['CORREO'])) {
											$Email = new CakeEmail();
											$Email->emailFormat('html');
											$Email->to($docente_reemplazo['Docente']['CORREO']);
											$Email->helpers(array('Html'));
											$Email->subject('Reemplazo Docente / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
											$Email->from('lvc@duoc.cl');
											$Email->viewVars(array(
												'docente_reemplazo' => $docente_reemplazo,
												'docente_titular'=>$docente_titular,
												'clase'=>$programacion_clase,
											));
											$Email->template('inasistencia_docente_reemplazo_docente');
											if (!$Email->send()) {
												$this->log("No se pudo enviar el mail al docente reemplazo en ".$this->params['controller']."/".$this->params['action'].": CLASE EMAIL SEND <serialize>" . serialize($Email)."</serialize>", 'debug');
											}
										}else{
											$this->log("No se pudo enviar el mail a al docente reemplazo en ".$this->params['controller']."/".$this->params['action'].": EL DATO CORREO ESTA VACIO ".serialize($docente_reemplazo), 'debug');
										}
									}else{
										$this->log("No se pudo enviar el mail a al docente reemplazo en ".$this->params['controller']."/".$this->params['action']." EL DATO DEL DOCENTE REEMPLAZO ESTA VACIO PARA EL COD_DOCENTE ". $form_data['DOCENTE_REEMPLAZO'],'debug');
									}
									
								}
								#CORREO AL DOCENTE TITULAR
								if (!empty($docente_titular)) {
									if (!empty($docente_titular['Docente']['CORREO'])) {
										$Email = new CakeEmail();
										$Email->emailFormat('html');
										$Email->to($docente_titular['Docente']['CORREO']);
										$Email->helpers(array('Html'));
										if ($hay_reemplazo_docente) {
											$subject_mail = 'Inasistencia Docente / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION'];
										}else{
											$subject_mail = 'Suspensi&oacute;n de Clase por Inasistencia Docente / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION'];
										}
										$Email->subject($subject_mail);
										$Email->from('lvc@duoc.cl');
										$Email->viewVars(array(
											'docente' => $docente_titular,
											'clase'=>$programacion_clase,
											'hay_reemplazo_docente'=>$hay_reemplazo_docente,
										));
										$Email->template('inasistencia_docente_docente_titular');
										if (!$Email->send()) {
											$this->log("No se pudo enviar el mail al docente titular en ".$this->params['controller']."/".$this->params['action'].": CLASE EMAIL SEND <serialize>" . serialize($Email)."</serialize>", 'debug');
										}
									}else{
										$this->log("No se pudo enviar el mail a al docente titular en ".$this->params['controller']."/".$this->params['action'].": EL DATO CORREO ESTA VACIO ".serialize($docente_reemplazo), 'debug');
									}
								}else{
									$this->log("No se pudo enviar el mail a al docente titular en ".$this->params['controller']."/".$this->params['action']." EL DATO DEL DOCENTE REEMPLAZO ESTA VACIO PARA EL COD_DOCENTE ". $form_data['DOCENTE_REEMPLAZO'],'debug');
								}
							};
							$this->ProgramacionClase->commit();
							$this->Session->setFlash('Su informaci&oacute;n se ha guardado con &eacute;xito.','mensaje-exito');
						}else{
							$this->Session->setFlash('Ha ocurrido un problema la intentar guardar la informaci&oacute;n. Intente nuevamente.','mensaje-info');
						}
						$this->redirect(array('action'=>'fichaDetalleClase', $cod_programacion));
					}catch(Exception $e) {
					    $this->ProgramacionClase->rollback();
						$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamanete.','mensaje-info');
						$this->redirect(array('action'=>'fichaDetalleClase', $cod_programacion));
					}
				}
			}
			$this->loadModel('MotivoInasistenciaDocente');
			$docentes = $this->Docente->getDocentesDisponibles($session_data['Sede']['COD_SEDE'],$programacion_clase['ProgramacionClase']['HORA_INICIO'],$programacion_clase['ProgramacionClase']['HORA_FIN'],$cod_programacion);
			$this->set(array(
				'programacion_clase'=>$programacion_clase,
				'docentes'=>$docentes,
				'motivos' => $this->MotivoInasistenciaDocente->getMotivosList(),
			));
		}

		public function justificacionLegal($cod_programacion=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClase($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamanet.','mensaje-info');
				exit('<script>location.reload(); </script>');
			}
			$session_data = $this->Session->read('CoordinadorLogueado');
			$this->loadModel('Docente');
			if (!empty($this->data)) {
				$error='';
				if (empty($this->data['LogEvento']['TIPO_JUSTIFICACION_ID'])) {
					$error.='Se requiere seleccionar un tipo de justificaci&oacute;n.<br>';
				}
				if (empty($this->data['LogEvento']['OBSERVACIONES'])) {
					$error.='Se requieren las observaciones. Intente nuevamanete.<br>';
				}
				if (!empty($this->data['LogEvento']['REEMPLAZO_DOCENTE'])) {
					if (empty($this->data['LogEvento']['DOCENTE_REEMPLAZO'])) {
						$error.='Se requieren selecci&oacute;n del docente.<br>';
					}
				}
				if ( empty($error) ) {
					$this->ProgramacionClase->begin();
					try {
						$form_data = $this->data['LogEvento'];
						#EL DETALLE DEBE SER JUSTIFICACION LEGAL
						$up_programacion_clase = array(
							'DETALLE_ID'=>5,
							'MOTIVO_ID'=>$this->data['LogEvento']['TIPO_JUSTIFICACION_ID'],
							'OBSERVACIONES_ADELANTAR_CLASE'=>$this->data['LogEvento']['OBSERVACIONES'],
							'ID'=>$programacion_clase['ProgramacionClase']['ID'],
							'COORDINADOR_CREATED_ID'=>$session_data['CoordinadorDocente']['COD_FUNCIONARIO'],
						);
						#SI HAY REEMPLAZO
						$docente_reemplazo = array();
						if (isset($form_data['REEMPLAZO_DOCENTE']) && $form_data['REEMPLAZO_DOCENTE']==1 && !empty($form_data['DOCENTE_REEMPLAZO'])) {
							$docente_reemplazo = $this->Docente->getDocente($form_data['DOCENTE_REEMPLAZO']);
							if (empty($docente_reemplazo)) {
								$this->Session->setFlash('El docente que ha seleccionado no esta disponible. Intente nuevamente.','mensaje-info');
								$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
							}
							$up_programacion_clase['DOCENTE_REEMPLAZO_ID'] = $docente_reemplazo['Docente']['COD_DOCENTE'];
							#ESTADO PROGRAMADA
							$up_programacion_clase['ESTADO_PROGRAMACION_ID'] = 3;
							#SUB ESTADO A REEMPLAZO DOCENTE
							$up_programacion_clase['SUB_ESTADO_PROGRAMACION_ID'] = 4;
						#ELSE
						}else{
							if (strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])))) {
								#SI LA FECHA DE LA CLASE YA PASO, SE DEBE CAMBIAR ESTADO A NO REALIZADA Y SUB-ESTADO NO RECUPERA.
								#ESTADO NO REALIZADA
								$up_programacion_clase['ESTADO_PROGRAMACION_ID'] = 2;
								#SUB ESTADO A NO RECUPERADA
								$up_programacion_clase['SUB_ESTADO_PROGRAMACION_ID'] = 7;
							}else{
								#SINO CAMBIO ESTADO A NO REALIZADA Y SUB_ESTADO POR RECUPERAR
								#ESTADO NO REALIZADA
								$up_programacion_clase['ESTADO_PROGRAMACION_ID'] = 2;
								#SUB ESTADO A POR RECUPERAR
								$up_programacion_clase['SUB_ESTADO_PROGRAMACION_ID'] = 5;
							}
						}
						if ($this->ProgramacionClase->save($up_programacion_clase)) {
							$new_log_evento = array(
								'DETALLE'=>'JUSTIFICACION LEGAL',
								'COD_PROGRAMACION'=>$cod_programacion,
								'USUARIO_CREADOR'=>$session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT'],
								'CREATED'=>date('Y-m-d H:i:s'),
								'MODIFIED'=>date('Y-m-d H:i:s'),
								'COD'=>uniqid(),
							);
							if (!empty($docente_reemplazo)) {
								$new_log_evento['RUT_DOCENTE'] = $docente_reemplazo['Docente']['RUT'];
								$new_log_evento['NOMBRES_DOCENTE'] = $docente_reemplazo['Docente']['NOMBRE'];
								$new_log_evento['APELLIDO_PAT_DOCENTE'] = $docente_reemplazo['Docente']['APELLIDO_PAT'];
								$new_log_evento['APELLIDO_MAT_DOCENTE'] = $docente_reemplazo['Docente']['APELLIDO_MAT'];
							}
							$this->loadModel('LogEvento');
							if($this->LogEvento->save($new_log_evento));
							$this->Session->setFlash('Su informaci&oacute;n se ha guardado con &eacute;xito.','mensaje-exito');
						}else{
							$this->Session->setFlash('Ha ocurrido un problema la intentar guardar la informaci&oacute;n. Intente nuevamente.','mensaje-info');
						}
						$this->ProgramacionClase->commit();
						$this->redirect(array('action'=>'fichaDetalleClase', $cod_programacion));
					}catch(Exception $e) {
						$this->ProgramacionClase->rollback();
						$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamanete.','mensaje-info');
						$this->redirect(array('action'=>'fichaDetalleClase', $cod_programacion));
					}
				}
			}
			$this->loadModel('SalaHorario');
			$fecha = date("d-m-Y", strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE']));
			$hora_inicio = date("h:i", strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']));
			$hora_fin = date("h:i", strtotime($programacion_clase['ProgramacionClase']['HORA_FIN']));


			$docentes = $this->Docente->getDocHorario($session_data['Sede']['COD_SEDE'],$fecha,$hora_inicio,$hora_fin);
			#$docentes2 = $this->Docente->getDocentesDisponibles($session_data['Sede']['COD_SEDE'],$programacion_clase['ProgramacionClase']['HORA_INICIO'],$programacion_clase['ProgramacionClase']['HORA_FIN'],$cod_programacion);
			#debug($docentes2);exit();
			/*foreach ($docentes as $key => $value) {
				$nombre = $this->Docente->getDocentes($value['Docente']['COD_DOCENTE']);
				$this->set(array(
					'nombre'=>$nombre,
					));

			}*/
			#var_dump($docentes);exit();
			$this->loadModel('TipoJustificacionLegal');
			$this->set(array(
				'programacion_clase'=>$programacion_clase,
				'docentes'=>$docentes,
				'tipo_justificacion_legal' => $this->TipoJustificacionLegal->getTiposJustificacionList(),
			));
		}

		public function fichaDetalleClase($cod_programacion = null){
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);

			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos de la programaci&oacute;n. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'index'));
			}

			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos de la asignatura. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'index'));
			}
			$this->loadModel('AlumnoAsignatura');
			$this->loadModel('Bitacora');
			$this->loadModel('LogEvento');
			$docente_reemplazo = array();
			if (!empty($programacion_clase['ProgramacionClase']['DOCENTE_REEMPLAZO_ID'])) {
				$this->loadModel('Docente');
				$docente_reemplazo  = $this->Docente->getDocente($programacion_clase['ProgramacionClase']['DOCENTE_REEMPLAZO_ID']);
			}
			$listado_alumnos=$this->AlumnoAsignatura->getListadoAsistencia($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'],$asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_SEDE']);
			if (!empty($listado_alumnos)) {
				$this->loadModel('Asistencia');
				foreach ($listado_alumnos as $key => $alumno) {
					$asistencia = $this->Asistencia->getAsistenciaAlumnoEvento($alumno['Alumno']['ID'],$cod_programacion);
					$listado_alumnos[$key]['Asistencia']['ID'] = isset($asistencia['Asistencia']['ID'])?$asistencia['Asistencia']['ID']:null;
					$listado_alumnos[$key]['Asistencia']['ASISTENCIA'] = isset($asistencia['Asistencia']['ASISTENCIA'])?$asistencia['Asistencia']['ASISTENCIA']:null;
					$listado_alumnos[$key]['Asistencia']['OBSERVACION'] = isset($asistencia['Asistencia']['OBSERVACION'])?$asistencia['Asistencia']['OBSERVACION']:null;
				}
			}



				$prog_ade = $this->ProgramacionClase->getProgramacionAdelantar($programacion_clase['ProgramacionClase']['COD_PROGRAMACION_PADRE']);
		


			#debug($prog_ade);exit();
			#debug($programacion_clase);exit();
			$this->set(array(
				'prog_ade'=> $prog_ade,
				'asignatura_horario'=>$asignatura_horario,
				'docente_reemplazo'=>$docente_reemplazo,
				'listado_alumnos'=>$listado_alumnos,
				'bitacora'=>$this->Bitacora->getBitacoraClase($cod_programacion),
				'programacion_clase'=>$programacion_clase,
				'logs_evento'=>$this->LogEvento->getLogs($cod_programacion),
			));
		}

		public function adelantarClase($cod_programacion=null)
		{
			$this->layout = 'ajax';
			#debug($cod_programacion);#exit();

			# ------------------------------------------------------------------------------
			# Verificar que existe la programaci&oacute;n de una clase.
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamanete.','mensaje-info');
				$this->redirect(array('action'=>'fichaDetalleClase', $cod_programacion));
			}
			# ------------------------------------------------------------------------------
			if ($programacion_clase['ProgramacionClase']['DETALLE_ID'] == 4) {
				$this->ProgramacionClase->actualizarEstados($programacion_clase['ProgramacionClase']['ID'], 2, 9);
			}
			# ------------------------------------------------------------------------------
			$this->loadModel('Docente');
			$session_data = $this->Session->read('CoordinadorLogueado');
			if (!empty($this->data)) {
				$error='';
				if (empty($this->data['LogEvento']['MOTIVO_ADELANTAR_CLASE_ID'])) {
					$error.='Ha ocurrido un error inesperado. Intente nuevamanete.<br>';
				}
				if (empty($this->data['LogEvento']['OBSERVACIONES'])) {
					$error.='Se requieren las observaciones. Intente nuevamanete.<br>';
				}
				if (empty($this->data['LogEvento']['TIPO_CLASE'])) {
					$error.='Se requiere el tipo de clase. Intente nuevamanete.<br>';
				}
				if (empty($this->data['LogEvento']['FECHA_CLASE']) || empty($this->data['LogEvento']['HORA_FIN'])) {
					$error.='Se requieren fecha inicio y fecha fin.<br>';
				}
				if ( !empty($this->data['DOCENTE_TITULAR']) || !empty($this->data['COD_DOCENTE_ALTERNATIVO']) ) {
					$error.='Se requiere docente programado.<br>';
				}
				if ( empty($error) ) {
					$this->ProgramacionClase->begin();
					try {
						$form_data = $this->data;
						$es_docente_titular = true;
						$error_docente = false;
						$this->loadModel('Docente');
						if (isset($form_data['ProgramacionClase']['DOCENTE_TITULAR']) && !empty($form_data['ProgramacionClase']['DOCENTE_TITULAR'])) {
							$docente = $this->Docente->getDocente($programacion_clase['ProgramacionClase']['COD_DOCENTE']);
						}else{
							$docente = $this->Docente->getDocente($form_data['ProgramacionClase']['COD_DOCENTE_ALTERNATIVO']);
							if (!empty($docente)) {
								$new_log_evento['RUT_DOCENTE'] = $docente['Docente']['RUT'];
								$new_log_evento['NOMBRES_DOCENTE'] = $docente['Docente']['NOMBRE'];
								$new_log_evento['APELLIDO_PAT_DOCENTE'] = $docente['Docente']['APELLIDO_PAT'];
								$new_log_evento['APELLIDO_MAT_DOCENTE'] = $docente['Docente']['APELLIDO_MAT'];	
							}
						}
						$fecha_clase = !empty($form_data['LogEvento']['FECHA_CLASE'])? date('Y-m-d',strtotime($form_data['LogEvento']['FECHA_CLASE'])):date('Y-m-d');
						$new_programacion_clase = array(
							'COD_PROGRAMACION'=>uniqid(),
							'FECHA_CLASE'=>$fecha_clase,
							'SIGLA'=>$programacion_clase['ProgramacionClase']['SIGLA'],
							'SIGLA_SECCION'=>$programacion_clase['ProgramacionClase']['SIGLA_SECCION'],
							'SEMESTRE'=>$programacion_clase['ProgramacionClase']['SEMESTRE'],
							'ANHO'=>$programacion_clase['ProgramacionClase']['ANHO'],
							'COD_ASIGNATURA_HORARIO'=>$programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO'],
							'COD_DOCENTE'=>$docente['Docente']['COD_DOCENTE'],
							'HORA_INICIO'=>isset($form_data['LogEvento']['HORA_INICIO']) && !empty($form_data['LogEvento']['HORA_INICIO'])? date('Y-m-d H:i',strtotime($fecha_clase.' '.$form_data['LogEvento']['HORA_INICIO'])):null,
							'HORA_FIN'=>isset($form_data['LogEvento']['HORA_FIN']) && !empty($form_data['LogEvento']['HORA_FIN'])? date('Y-m-d H:i',strtotime($fecha_clase.' '.$form_data['LogEvento']['HORA_FIN'])):null,
							'SALA'=>isset($form_data['LogEvento']['SALA']) && !empty($form_data['LogEvento']['SALA'])? $form_data['LogEvento']['SALA']:null,
							'SALA_REEMPLAZO'=>isset($form_data['LogEvento']['SALA']) && !empty($form_data['LogEvento']['SALA'])? $form_data['LogEvento']['SALA']:null,
							'DETALLE_ID'=>8, // AUTORIZACION PENDIENTE POR DEFINICION
							'TIPO_EVENTO'=>'NO REGULAR', // POR DEFINICION
							'ADELANTAR_CLASE'=>1,
							'CREATED'=>date('Y-m-d H:i:s'),
							'MODIFIED'=>date('Y-m-d H:i:s'),
							'PRESENCIAL'=>strtoupper($form_data['LogEvento']['TIPO_CLASE'])=='PRESENCIAL'?1:0,
							'COORDINADOR_CREATED_ID'=>$session_data['CoordinadorDocente']['COD_FUNCIONARIO'],
							'COD_SEDE'=>$session_data['Sede']['COD_SEDE'],
							'MOTIVO_ADELANTAR_CLASE_ID'=>$form_data['LogEvento']['MOTIVO_ADELANTAR_CLASE_ID'],
							'OBSERVACIONES_ADELANTAR_CLASE'=>$form_data['LogEvento']['OBSERVACIONES'],
							'COD_PROGRAMACION_PADRE'=>$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'],
						);
						#debug($new_programacion_clase);exit();
						if ($this->ProgramacionClase->save($new_programacion_clase)) {
							$new_log_evento['COD_PROGRAMACION'] = $programacion_clase['ProgramacionClase']['COD_PROGRAMACION'];
							$new_log_evento['DETALLE'] = 'ADELANTAR CLASE';
							$new_log_evento['USUARIO_CREADOR'] = $session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT'];
							$new_log_evento['CREATED'] = date('Y-m-d H:i:s');
							$new_log_evento['MODIFIED'] = date('Y-m-d H:i:s');
							$new_log_evento['SALA_REEMPLAZO'] = isset($form_data['LogEvento']['SALA']) && !empty($form_data['LogEvento']['SALA'])? $form_data['LogEvento']['SALA']:null;
							$new_log_evento['COD'] = uniqid();
							$this->loadModel('LogEvento');
							$this->LogEvento->create();
							$programacion_clase_new = $this->ProgramacionClase->getProgramacionClaseFull($new_programacion_clase['COD_PROGRAMACION']);
							if ($this->LogEvento->save($new_log_evento)) {
								# ------------------------------------------------------------------------------
								# CORREO DIRECTOR
								$this->loadModel('Director');
								$directores = $this->Director->getDirectoresBySede($session_data['Sede']['COD_SEDE']);
								foreach ($directores as $key => $value) {
									$Email = new CakeEmail();
									$Email->emailFormat('html');
									$Email->to($value['Director']['CORREO']);//DIRECTOR;
									$Email->helpers(array('Html'));
									$Email->subject('Solicitud de Adelantar Clase creada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
									$Email->from('lvc@duoc.cl');
									$Email->viewVars(array('director' => $value,'clase'=>$programacion_clase_new));
									$Email->template('adelantar_clases_director');
									if ($Email->send()) {}
								}
								# ------------------------------------------------------------------------------
								#CORREO DOCENTE
								$Email = new CakeEmail();
								$Email->emailFormat('html');
								$Email->to($docente['Docente']['CORREO']);
								$Email->helpers(array('Html'));
								$Email->subject('Solicitud de Adelantar Clase creada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
								$Email->from('lvc@duoc.cl');
								$Email->viewVars(array('docente' => $docente,'clase'=>$programacion_clase_new));
								$Email->template('adelantar_clases_docente');
								if ($Email->send()) {}
								# ------------------------------------------------------------------------------
								#CORREO COORDINADOR
								$Email = new CakeEmail();
								$Email->emailFormat('html');
								$Email->to($session_data['CoordinadorDocente']['CORREO']);
								$Email->helpers(array('Html'));
								$Email->subject('Solicitud de Adelantar Clase creada / '.$programacion_clase['ProgramacionClase']['SIGLA_SECCION']);
								$Email->from('lvc@duoc.cl');
								$Email->viewVars(array('admin' => $session_data,'clase'=>$programacion_clase_new));
								$Email->template('adelantar_clases_coordinador_docente');
								if ($Email->send()) {}
								# ------------------------------------------------------------------------------
								# Todo sal&iacute;o muy bi&eacute;n.
								#debug($cod_programacion);exit();
								$this->ProgramacionClase->commit();
								$this->Session->setFlash('Su informaci&oacute;n ha sido almacenada con &eacute;xito.','mensaje-exito');
								$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
							}
						}
					}catch(Exception $e) {
					    $this->ProgramacionClase->rollback();
						$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamanete.','mensaje-info');
						$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
					}
				}else{
					$this->Session->setFlash($error,'mensaje-info');
					$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
				}
			}
			$docentes = $this->Docente->getDocentesDisponibles(
				$session_data['Sede']['COD_SEDE'], 
				$programacion_clase['ProgramacionClase']['HORA_INICIO'], 
				$programacion_clase['ProgramacionClase']['HORA_FIN'], 
				$cod_programacion
			);
			$this->loadModel('MotivoAdelantarClase');
			$this->loadModel('Periodo');

			$programacion_clase['ProgramacionClase']['PROGRAMACION_ACTIVA']='SI';
			$ini = new DateTime( date('Y-m-d') ); // Fecha actual.
			$fin = new DateTime( date('Y-m-d', strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE'])) ); // Fecha programada.
			$dif = $ini->diff($fin);
			if ( $dif->invert>0) {
				$programacion_clase['ProgramacionClase']['PROGRAMACION_ACTIVA']='NO';
			}
			$this->set(array(
				'programacion_clase'	=> $programacion_clase,
				'docentes'				=> $docentes,
				'motivos' 				=> $this->MotivoAdelantarClase->getMotivosList(),
				'periodoActual' 		=> $this->Periodo->getPeriodoActual(),
			));
		}

		public function ajusteEliminacionEstado($cod_programacion=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error inesperado. Intente nuevamanet.','mensaje-info');
				exit('<script>location.reload(); </script>');
			}
			$session_data = $this->Session->read('CoordinadorLogueado');
			$this->loadModel('Estado');
			$this->loadModel('SubEstado');
			$this->loadModel('Detalle');
			if (!empty($this->data)) {
				if (isset($this->data['LogEvento'])) {
					$form_data = $this->data['LogEvento'];
					if (isset($form_data['ESTADO_ID']) && isset($form_data['SUB_ESTADO_ID']) && isset($form_data['DETALLE_ID'])) {
						$new_log_evento = array(
							'COD_PROGRAMACION'=>$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'],
							'DETALLE'=>'AJUSTE O ELIMINACI&oacute;N DE ESTADO',
							'USUARIO_CREADOR'=>$session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT'],
							'CREATED'=>date('Y-m-d H:i:s'),
							'MODIFIED'=>date('Y-m-d H:i:s'),
							'COD'=>uniqid(),
						);
						if (!empty($form_data['ESTADO_ID']) && $programacion_clase['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] != $form_data['ESTADO_ID']) {
							#CAMBIO ESTADO
							$estado_old = empty($programacion_clase['EstadoProgramacion']['NOMBRE'])? '':$programacion_clase['EstadoProgramacion']['NOMBRE'];
							$estado_new = !empty($form_data['ESTADO_ID'])? $this->Estado->getEstado($form_data['ESTADO_ID']) :'';
							$text = 'Cambio de estado ';
							if (!empty($estado_old)) {
								$text .= 'de '.$estado_old.' ';
							}
							if (!empty($estado_new)) {
								$text .= 'a '.$estado_new['Estado']['NOMBRE'].' ';
							}
							$new_log_evento['CAMBIO_ESTADO'] = $text;
							$programacion_clase['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] = $form_data['ESTADO_ID'];
						}
						if (!empty($form_data['SUB_ESTADO_ID']) && $programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'] != $form_data['SUB_ESTADO_ID']) {
							#CAMBIO SUB ESTADO
							$sub_estado_old = empty($programacion_clase['SubEstadoProgramacion']['NOMBRE'])? '':$programacion_clase['SubEstadoProgramacion']['NOMBRE'];
							$sub_estado_new = !empty($form_data['SUB_ESTADO_ID'])? $this->SubEstado->getSubEstado($form_data['SUB_ESTADO_ID']) :'';
							$text = 'Cambio de sub estado ';
							if (!empty($sub_estado_old)) {
								$text .= 'de '.$sub_estado_old.' ';
							}
							if (!empty($sub_estado_new)) {
								$text .= 'a '.$sub_estado_new['SubEstado']['NOMBRE'].' ';
							}
							$new_log_evento['CAMBIO_SUB_ESTADO'] = $text;
							$programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'] = $form_data['SUB_ESTADO_ID'];
						}
						if (!empty($form_data['DETALLE_ID']) &&  $programacion_clase['ProgramacionClase']['DETALLE_ID'] != $form_data['DETALLE_ID']) {
							#CAMBIO DETALLE
							$detalle_old = empty($programacion_clase['Detalle']['DETALLE'])? '':$programacion_clase['Detalle']['DETALLE'];
							$detalle_new = !empty($form_data['DETALLE_ID'])? $this->Detalle->getDetalle($form_data['DETALLE_ID']) :'';
							$text = 'Cambio de detalle ';
							if (!empty($detalle_old)) {
								$text .= 'de '.$detalle_old.' ';
							}
							if (!empty($detalle_new)) {
								$text .= 'a '.$detalle_new['Detalle']['DETALLE'].' ';
							}
							$new_log_evento['CAMBIO_DETALLE'] = $text;
							$programacion_clase['ProgramacionClase']['DETALLE_ID'] = $form_data['DETALLE_ID'];
						}
						$programacion_clase['ProgramacionClase']['COORDINADOR_CREATED_ID'] = $session_data['CoordinadorDocente']['COD_FUNCIONARIO'];
						$this->loadModel('LogEvento');
						if ($this->LogEvento->save($new_log_evento) && $this->ProgramacionClase->save($programacion_clase)) {
							$this->Session->setFlash('Su informaci&oacute;n se ha almacenado con &eacute;xito.','mensaje-exito');
							$this->redirect(array('action'=>'fichaDetalleClase',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION']));
						}

					}
				}
				$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'fichaDetalleClase',$cod_programacion));
			}
			$this->set(array(
				'programacion_clase'=>$programacion_clase,
				'estados'=>$this->Estado->getEstados(),
				'detalles'=>$this->Detalle->getDetalles(null),
				'sub_estados'=>$this->SubEstado->getSubEstadosActivos(),
			));
		}

		public function fichaAsistenciaDocenteDetalle($cod_programacion=null) {
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'index'));
			}
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'index'));
			}
			$this->loadModel('AlumnoAsignatura');
			$this->loadModel('Bitacora');
			$this->loadModel('LogEvento');
			$docente_reemplazo = array();
			if (!empty($programacion_clase['ProgramacionClase']['DOCENTE_REEMPLAZO_ID'])) {
				$this->loadModel('Docente');
				$docente_reemplazo  = $this->Docente->getDocente($programacion_clase['ProgramacionClase']['DOCENTE_REEMPLAZO_ID']);
			}
			$listado_alumnos=$this->AlumnoAsignatura->getListadoAsistencia($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'],$asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_SEDE']);
			if (!empty($listado_alumnos)) {
				$this->loadModel('Asistencia');
				foreach ($listado_alumnos as $key => $alumno) {
					$asistencia = $this->Asistencia->getAsistenciaAlumnoEvento($alumno['Alumno']['ID'],$cod_programacion);
					$listado_alumnos[$key]['Asistencia']['ID'] = isset($asistencia['Asistencia']['ID'])?$asistencia['Asistencia']['ID']:null;
					$listado_alumnos[$key]['Asistencia']['ASISTENCIA'] = isset($asistencia['Asistencia']['ASISTENCIA'])?$asistencia['Asistencia']['ASISTENCIA']:null;
					$listado_alumnos[$key]['Asistencia']['OBSERVACION'] = isset($asistencia['Asistencia']['OBSERVACION'])?$asistencia['Asistencia']['OBSERVACION']:null;
				}
			}
			$this->loadModel('RecuperarAtrasoRetiro');
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'docente_reemplazo'=>$docente_reemplazo,
				'listado_alumnos'=>$listado_alumnos,
				'bitacora'=>$this->Bitacora->getBitacoraClase($cod_programacion),
				'motivos'=>$this->RecuperarAtrasoRetiro->getMotivosList(),
				'programacion_clase'=>$programacion_clase,
				'logs_evento'=>$this->LogEvento->getLogsAsistenciaDocente($cod_programacion),
			));
		}

		public function solicitudRecuperacionTopeHorario($cod_programacion=null) {
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Ha ocurrido un error con el env&iacute;o de los datos. Intente nuevamente.','mensaje-info');
				$this->redirect(array('action'=>'index'));
			}
			$session_data = $this->Session->read('CoordinadorLogueado');
			$this->loadModel('Docente');
			$docentes = $this->Docente->getDocentesBySede($session_data['Sede']['COD_SEDE']);
			$this->loadModel('MotivoSolicitudRecuperacion');
			$this->loadModel('HorarioModulo');
			if (isset($programacion_clase['Docente']['NOMBRE'])) {
				$programacion_clase['Docente']['NOMBRE'] = utf8_encode($programacion_clase['Docente']['NOMBRE']);
				$programacion_clase['Docente']['APELLIDO_PAT'] = utf8_encode($programacion_clase['Docente']['APELLIDO_PAT']);
				$programacion_clase['Docente']['APELLIDO_MAT'] = utf8_encode($programacion_clase['Docente']['APELLIDO_MAT']);
			}
			$horarios = $this->HorarioModulo->getSimpleHorarioBySede($session_data['Sede']['COD_SEDE']);
			$this->set(array(
				'programacion_clase'=>$programacion_clase,
				'docentes'=>$docentes,
				'horarios'=>$horarios,
				'motivos'=>$this->MotivoSolicitudRecuperacion->getMotivosAll(),
			));
		}

		public function suspension() {}

		public function reportes(){}

		public function login(){
			$this->layout = 'login-admin';
		}
	}