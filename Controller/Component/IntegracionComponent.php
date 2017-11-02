<?php 
	
	App::uses('HttpSocket', 'Network/Http');
	App::uses('Parametro', 'Model');
	App::uses('Anho', 'Model');
	App::uses('Semana', 'Model');
	App::uses('Periodo', 'Model');
	App::uses('ProgramacionClase', 'Model');
	App::uses('AsignaturaHorario', 'Model');
	App::uses('AlumnoAsignatura', 'Model');

	class IntegracionComponent extends Component {

		public $name = 'Integracion';
		public $components = array('Security', 'RequestHandler','Session');
		public $url_mdw = null;

		#RI
		public function sendRi($sm_objid=null,$semestre =null,$anho=null,$rut_alumno=null)
		{
			$docente = $this->Session->read('DocenteLogueado');
			$Parametro = new Parametro();
			$this->url_mdw = $Parametro->getValorParametro('URL_MDW');
	        $content_request_http = array(
				'COD_ASIGNATURA_HORARIO'=>$sm_objid,
				'SEMESTRE'=>$semestre,
				'ANHO'=>$anho,
				'RUT_ALUMNO'=>$rut_alumno,
				'LOGIN_MDW'=>$Parametro->getValorParametro('LOGIN_MDW'),
				'PASS_MDW'=>$Parametro->getValorParametro('PASS_MDW'),
			);
	        $url = $this->url_mdw . 'rest_insert_ri.json';
	        $httpSocket = new HttpSocket();
	        $response = $httpSocket->get($url, $content_request_http);
	        $response_body = json_decode($response->body, true);
	        $response_final = array();
	        if (isset($response_body['response']) && is_array($response_body['response'])) {
		        $response = json_decode($response_body['response']['data']);
		        foreach ($response as $key => $value) {
		        	$response_final[] = (array)$value;
		        }
	        }
	        return $response_final;
		}

		#DISPONIBILIDAD SALAS
		public function getSalasDisponiblesSede($cod_sede=null,$fecha =null,$hora_inicio=null,$hora_fin=null)
		{
			$docente = $this->Session->read('DocenteLogueado');
			$Parametro = new Parametro();
			$this->url_mdw = $Parametro->getValorParametro('URL_MDW');

			#debug($docente);exit();	
	        $content_request_http = array(
				'COD_SEDE'=>$cod_sede,
				'FECHA'=>$fecha,
				'HORA_INICIO'=>$hora_inicio,
				'HORA_FIN'=>$hora_fin,
				'LOGIN_MDW'=>$Parametro->getValorParametro('LOGIN_MDW'),
				'PASS_MDW'=>$Parametro->getValorParametro('PASS_MDW'),
			);
	        $url = $this->url_mdw . 'rest_disponibilidad_salas.json';
	        $httpSocket = new HttpSocket();
	        $response = $httpSocket->get($url, $content_request_http);
	        $response_body = json_decode($response->body, true);
	        #debug($response_body);exit();
	        $response_final = array();
	        if (isset($response_body['salas']) && is_array($response_body['salas'])) {
		        $salas = json_decode($response_body['salas']['data']);
		        foreach ($salas as $key => $value) {
		        	$response_final[] = (array)$value;
		        }
	        }
	        return $response_final;
		}

		#PERIODOS
		public function getPeriodosSap($anho=null,$calendario =null)
		{
			$docente = $this->Session->read('DocenteLogueado');
			$Parametro = new Parametro();
			$this->url_mdw = $Parametro->getValorParametro('URL_MDW');
	        $content_request_http = array(
				'ANHO'=>$anho,
				'CALENDARIO'=>$calendario,
				'LOGIN_MDW'=>$Parametro->getValorParametro('LOGIN_MDW'),
				'PASS_MDW'=>$Parametro->getValorParametro('PASS_MDW'),
			);

	        $url = $this->url_mdw . 'rest_periodos.json';
	        $httpSocket = new HttpSocket();
	        $response = $httpSocket->get($url, $content_request_http);
	        #pr($response);exit();
	        $response_body = json_decode($response->body, true);
	        #debug($response_body);exit();
	        $response_final = array();
	        if (isset($response_body['periodos']) && is_array($response_body['periodos'])) {
		        $periodos = json_decode($response_body['periodos']['data']);
		        foreach ($periodos as $key => $value) {
		        	$response_final[] = (array)$value;
		        }
	        }
	        return $response_final;
		}

		public function refreshPeriodos($anho=null,$calendario=null)
		{
			$periodos_sap = $this->getPeriodosSap($anho,$calendario);
			$Periodo = new Periodo();
			$Semana = new Semana();
			if (!empty($periodos_sap) && is_array($periodos_sap)) {
				if($Periodo->deleteAll($anho) ==! false){
					foreach ($periodos_sap as $key => $value) {
						$new_periodo = Array(
							'ANHO'=>$anho,
							'SEMESTRE'=>$value['COD_PERIODO'],
							'COD_PERIODO'=>$value['COD_PERIODO'].$anho,
							'FECHA_INICIO'=>date('Y-m-d',strtotime($value['FECHA_INICIO'])),
							'FECHA_FIN'=>date('Y-m-d',strtotime($value['FECHA_FIN'])),
							'DESCRIPCION'=>$value['DESCRIPCION'],
						);
						$Periodo->save($new_periodo);
						#JOYACARRR
						#ALGORITMO PARA GENERAR LAS SEMANAS DE UN INTERVALO DE FECHAS.
							$fecha_inicio_tmp = $new_periodo['FECHA_INICIO'];
							$i =0;
							if ($Semana->deleteAll($new_periodo['ANHO'],$new_periodo['SEMESTRE']) ==! false) {
								while (strtotime($fecha_inicio_tmp)<=strtotime($new_periodo['FECHA_FIN'])) { 
									$i++;
									$anho_tmp = date('Y',strtotime($fecha_inicio_tmp));
									$mes = date('m',strtotime($fecha_inicio_tmp));
									$dia = date('d',strtotime($fecha_inicio_tmp));
									#OBTENEMOS EL NUMERO DE LA SEMANA
									$semana=date("W",mktime(0,0,0,$mes,$dia,$anho_tmp));
									#OBTENEMOS EL DÍA DE LA SEMANA DE LA FECHA DADA
									$dia_semana=date("w",mktime(0,0,0,$mes,$dia,$anho_tmp));
									#EL 0 EQUIVALE AL DOMINGO...
									if($dia_semana==0)
									    $dia_semana=7;
									#A LA FECHA RECIBIDA, LE RESTAMOS EL DIA DE LA SEMANA Y OBTENDREMOS EL LUNES
									$primer_dia=date("Y-m-d",mktime(0,0,0,$mes,$dia-$dia_semana+1,$anho_tmp));
									#A LA FECHA RECIBIDA, LE SUMAMOS EL DIA DE LA SEMANA MENOS SIETE Y OBTENDREMOS EL DOMINGO
									$ultimo_dia=date("Y-m-d",mktime(0,0,0,$mes,$dia+(6-$dia_semana),$anho_tmp));
									#debug('semana '.$i.' desde '. $primer_dia.' al '.$ultimo_dia);
									#A LA FECHA DOMINGO LE SUMO 1 DIA PARA QUE PARTA LA PROXIMA SEMANA
									$fecha_inicio_tmp = strtotime('+2 day',strtotime($ultimo_dia));
									#FORMATO DE FECHAS PARA EL PROXIMO CICLO DEL BUCLE
									$fecha_inicio_tmp = date('Y-m-d',$fecha_inicio_tmp);
									$new_semana = array(
										'NUMERO_SEMANA'=>$i,
										'SEMESTRE'=>$new_periodo['SEMESTRE'],
										'ANHO'=>$new_periodo['ANHO'],
										'FECHA_INICIO'=>$primer_dia,
										'FECHA_FIN'=>$ultimo_dia,
									);
									$Semana->create(true);
									if ($Semana->save($new_semana)) {
										
									}
								}
							}
						#FIN
					}
				}
			}
			return true;
		}

		/** -------------------------------------------------------------
		 * Método para procesar los eventos de SAP.
		 * @param: $anho
		 * @param: $periodo
		 * @param: $cod_docente
		 * Obtiene los datos de SAP y crea o actualiza en Oracle.
		 */
		public function refreshEventos($anho=null, $periodo=null, $cod_docente=null)
		{
			# -------------------------------------------------------------------
			# Aquí se obtienen los eventos desde SAP.
			$eventos_sap = $this->getEventosSap($anho, $periodo, $cod_docente);
			$ProgramacionClase = new ProgramacionClase();
			$AsignaturaHorario = new AsignaturaHorario();
			$save_programaciones = array();

			# Buscar los registros de ASIGNATURAS_HORARIOS donde el docente y el periodo-año
			$registro = $AsignaturaHorario->find('all', array('conditions'=>array( 
				'COD_PERIODO' => ($periodo.$anho),
				'COD_DOCENTE' => $cod_docente
			)));
			if (!empty($registro)) {
				foreach ($registro as $key => $value) {
					$AsignaturaHorario->query("
						UPDATE ASIGNATURAS_HORARIOS SET ESTADO_SAP=0 WHERE COD_ASIGNATURA_HORARIO='".$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']."'"
					);
					#debug($AsignaturaHorario->getLastQuery());exit();
				}
			}

			# -------------------------------------------------------------------
			# Si vienen registros desde SAP entrar al condicional.
			if(!empty($eventos_sap) && is_array($eventos_sap)) {
				
				# -------------------------------------------------------------------
				# recorrer los datos de SAP.
				$iteracion=0;
				foreach ($eventos_sap as $key => $asignatura_horario) {
					
					# -------------------------------------------------------------------
					# Consultar en Oracle tabla "ASIGNATURAS_HORARIOS" con el dato "COD_ASIGNATURA_HORARIO" que biene de SAP.
					$asignatura_horario_tmp = $AsignaturaHorario->find('first', array('conditions'=>array('COD_ASIGNATURA_HORARIO'=>$asignatura_horario['ASIGNATURA']->COD_ASIGNATURA_HORARIO)));
					foreach ( $asignatura_horario['ASIGNATURA'] as $key => $value) { $value=($value); }

					# -------------------------------------------------------------------
					# Si los datos consultados a Oracle respecto a datos de SAP no trae registros, se debe:
					# "CREAR NUEVO REGISTRO" en Oracle.
					if ( empty($asignatura_horario_tmp) ) {
						$AsignaturaHorario->create(TRUE);
						$asignatura_horario_insert = (array)$asignatura_horario['ASIGNATURA'];
						$asignatura_horario_insert['CREATED']=date('Y-m-d H:i:s');
						$asignatura_horario_insert['MODIFIED']=date('Y-m-d H:i:s');
						if ( $AsignaturaHorario->save($asignatura_horario_insert) ) {
							foreach ( $asignatura_horario['EVENTOS'] as $key => $value) {
								foreach ($value as $k => $v) { $v=($v); }
								$programacion_clase = $ProgramacionClase->getProgramacionClase($value->COD_PROGRAMACION);
								if (empty($programacion_clase)) {
									#CREAR REGISTRO EVENTO;
									$save_programaciones[] = (array)$value;
								}
							}
						}else{
							continue; // Pasa a la siguiente iteración.
						}
					}else{
						$AsignaturaHorario->query("
							UPDATE ASIGNATURAS_HORARIOS SET ESTADO_SAP=1 WHERE COD_ASIGNATURA_HORARIO='".$asignatura_horario_tmp['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']."'"
						);
						#debug($AsignaturaHorario->getLastQuery());exit();
						# -------------------------------------------------------------------
						# Recorrer los datos de Eventos reportados por SAP.
						foreach ( $asignatura_horario['EVENTOS'] as $key => $value) {
							foreach ($value as $k => $v) { $v=($v); }

							# -------------------------------------------------------------------
							# Consultar a Oracle por la programación de clase segun reportados por SAP.
							$programacion_clase = $ProgramacionClase->getProgramacionClase( $value->COD_PROGRAMACION );
							
							# -------------------------------------------------------------------
							# Si Oracle no tiene info, entonces crear nuevo reportado desde SAP. 
							if( empty($programacion_clase) ) {
								$save_programaciones[] = (array)$value;
							}else{
								# -------------------------------------------------------------------
								# Si Oracle reporta datos, entonces actualizar.
								if ($programacion_clase['ProgramacionClase']['WF_ESTADO_ID']>0) {
									continue;
								}
							}
						}
					}
					$iteracion++;
				}
				if( !empty($save_programaciones) ) {
					#debug($save_programaciones);
					$ProgramacionClase->saveAll($save_programaciones);
					#debug($ProgramacionClase->getLastQuery());exit();
				}
			}
			return true;
		}

		/** -------------------------------------------------------------
		 * Método para obtener los eventos de SAP.
		 * @param: $anho
		 * @param: $periodo
		 * @param: $cod_docente
		 * Obtiene los datos del docente logueado, obtiene los parametros de conexión
		 * con el service, solicita la conexión, obtiene la respuesta de SAP.
		 * Extrae lo que necesita de la respuesta y retorna el resultado que sería:
		 * Un arreglo con datos o un arreglo vacio.
		 */
		public function getEventosSap($anho=null, $periodo=null, $cod_docente=null)
		{
			# Obtener los datos del docente.
			$docente = $this->Session->read('DocenteLogueado');

			# Obtener los parametros de conexión.
			$Parametro = new Parametro();
			$this->url_mdw = $Parametro->getValorParametro('URL_MDW');
	        $content_request_http = array(
				'ANHO'			=>$anho,
				'PERIODO'		=>$periodo,
				'COD_DOCENTE'	=>$cod_docente,
				'LOGIN_MDW'		=>$Parametro->getValorParametro('LOGIN_MDW'),
				'PASS_MDW'		=>$Parametro->getValorParametro('PASS_MDW'),
			);

	        #debug($content_request_http);exit();

			$url = $this->url_mdw.'rest_eventos.json';

			# Conexión al service.
	        $httpSocket = new HttpSocket();
	        $response = $httpSocket->get($url, $content_request_http);
	       	#pr($response);exit();

	        # Armar la respuesta.
			$response_final = array();

			
			$response_body = json_decode($response->body, true);

			if (isset($response_body['eventos']) && is_array($response_body['eventos'])) {
			    $eventos = json_decode($response_body['eventos']['data']);
			    foreach ($eventos as $key => $value) {
			    	#debug((array)$value);exit();
			    	$response_final[] = (array)$value;
			    }
			}
			#debug($response_final);exit();	
	        return $response_final;
		} 

		#LISTADO ALUMNOS
		public function refreshListadoAsistenciaAlumnosSap($anho=null, $periodo =null, $cod_asignatura_horario=null)
		{
			
			$Periodo = new Periodo();
			$AlumnoAsignatura = new AlumnoAsignatura();
			$AsignaturaHorario = new AsignaturaHorario();		
				
			# -------------------------------------------------------------------
			# Aquí se obtienen los eventos desde SAP.
			$lista_alumnos_sap = $this->getListadoAsistenciaAlumnosSap($anho, $periodo, $cod_asignatura_horario);


			$codigoperiodo=($periodo.$anho);
			$alumnos = $AlumnoAsignatura->find('all', array('conditions'=>array( 
				'COD_HORARIO_ASIGNATURA' => $cod_asignatura_horario,
				'COD_PERIODO' => $codigoperiodo
			)));
			if (!empty($alumnos)) {
				foreach ($alumnos as $key => $value) {
					$AlumnoAsignatura->query("
						UPDATE ALUMNOS_ASIGNATURAS 
						SET ESTADO_SAP=0 
						WHERE COD_HORARIO_ASIGNATURA='".$cod_asignatura_horario."' 
						AND COD_PERIODO='".$periodo.$anho."' 
						AND ID_ALUMNO='".$value['AlumnoAsignatura']['ID_ALUMNO']."'
					");
					#debug($AsignaturaHorario->getLastQuery());exit();
				}
			}


			$asignatura_horario = $AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);		
			$periodo = $Periodo->getPeriodoByAnhoSemestre($anho,$periodo);
			if (!empty($asignatura_horario)) {
				foreach ($lista_alumnos_sap as $key => $value) {
					$alumno_asignatura = $AlumnoAsignatura->getFirst($value['COD_ALUMNO'],$cod_asignatura_horario);
					if (empty($alumno_asignatura)) {
						$alumno_asignatura = Array(
							'ID_ALUMNO'=>$value['COD_ALUMNO'],
							'CREATED'=>date('Y-m-d H:i:s'),
							'MODIFIED'=>date('Y-m-d H:i:s'),
							'SIGLA_SECCION'=>$asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'],
							'COD_HORARIO_ASIGNATURA'=>$cod_asignatura_horario,
							'COD_PLAN'=>$value['COD_PLAN'],
							'COD_SEDE'=>$asignatura_horario['AsignaturaHorario']['COD_SEDE'],
							'COD_PERIODO'=>$periodo['Periodo']['COD_PERIODO'],
						);
						$AlumnoAsignatura->save($alumno_asignatura);
					}else{
						$AlumnoAsignatura->query("
							UPDATE ALUMNOS_ASIGNATURAS 
							SET ESTADO_SAP=1 
							WHERE COD_HORARIO_ASIGNATURA='".$cod_asignatura_horario."' 
							AND COD_PERIODO='".$codigoperiodo."' 
							AND ID_ALUMNO='".$alumno_asignatura['AlumnoAsignatura']['ID_ALUMNO']."'
						");
						#debug($AsignaturaHorario->getLastQuery());exit();
					}
				}
			}
			#debug($AlumnoAsignatura->getLastQuery());exit();
			return true;
		}

		public function getListadoAsistenciaAlumnosSap($anho=null,$periodo =null,$cod_asignatura_horario=null)
		{
			$Parametro = new Parametro();
			$this->url_mdw = $Parametro->getValorParametro('URL_MDW');
	        $content_request_http = array(
				'ANHO'=>$anho,
				'PERIODO'=>$periodo,
				'COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario,
				'LOGIN_MDW'=>$Parametro->getValorParametro('LOGIN_MDW'),
				'PASS_MDW'=>$Parametro->getValorParametro('PASS_MDW'),
			);

	        $url = $this->url_mdw . 'rest_listado_asistencia.json';
	        $httpSocket = new HttpSocket();
	        $response = $httpSocket->get($url, $content_request_http);
	        #pr($response);exit();
	        $response_body = json_decode($response->body, true);
	       	$response_final = array();
	        if (isset($response_body['alumnos']) && is_array($response_body['alumnos'])) {
		        $alumnos = json_decode($response_body['alumnos']['data']);
		        foreach ($alumnos as $key => $value) {
		        	$response_final[] = (array)$value;
		        }
	        }
	        return $response_final;
		}

		#AÑOS
		public function refreshAnhosSap()
		{
			$anhos_sap = $this->getAnhosSap();
			$Anho = new Anho();
			if (!empty($anhos_sap) && is_array($anhos_sap)) {
				if($Anho->deleteAll() ==! false){
					foreach ($anhos_sap as $key => $value) {
						$new_anho = Array(
							'ANHO'=>$value,
							'CREATED'=>date('Y-m-d H:i:s'),
							'MODIFIED'=>date('Y-m-d H:i:s'),
						);
						$Anho->save($new_anho);
					}
				}
			}
			return true;
		}

		public function getAnhosSap()
		{
			$docente = $this->Session->read('DocenteLogueado');
			$Parametro = new Parametro();
			$this->url_mdw = $Parametro->getValorParametro('URL_MDW');
	        $content_request_http = array(
				'LOGIN_MDW'=>$Parametro->getValorParametro('LOGIN_MDW'),
				'PASS_MDW'=>$Parametro->getValorParametro('PASS_MDW'),
			);

	        $url = $this->url_mdw . 'rest_anhos.json';
	        $httpSocket = new HttpSocket();
	        $response = $httpSocket->get($url, $content_request_http);
	        #pr($response);exit();
	        $response_body = json_decode($response->body, true);
	       	#debug($response_body);
	       	$data = array();
	        if (isset($response_body['anhos']) && is_array($response_body['anhos'])) {
		        $data = json_decode($response_body['anhos']['data']);
	        }
	        return $data;
		}
	}