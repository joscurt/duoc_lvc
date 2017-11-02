<?php 
	# Este es el controlador de docentes.
	App::import('Vendor', 'Classes/PHPExcel');
	App::uses('Folder', 'Utility');
	App::uses('File', 'Utility');

	include '../Vendor/phpexcel/Classes/PHPExcel/IOFactory.php';

	class DocentesController extends AppController {
		
		public $name = 'Docentes';
		public $layout = 'app-docentes';
		public $components = array('Mpdf','Integracion');
		
		public function index(){
			$this->redirect(array('action'=>'getEventos'));
		}

		public function descargarHorario($cod_periodo=null, $sede_id=null)
		{
			$this->layout = null;
			$docente = $this->Session->read('DocenteLogueado');
			$programacion_clases = $semanas = $sedes = array();
			$this->loadModel('Periodo');
			$periodo = $this->Periodo->getPeriodo($cod_periodo);
			if (empty($periodo)) {
				$this->Session->setFlash('El periodo para el cual desea exportar los datos no fue encontrado','mensaje-error');
				$this->redirect(array('action'=>'getEventos',$cod_periodo));
			}
			$sedes = '';
			#debug($this->data);exit();
			if (isset($this->data['Filtro']['SEDE']) && !empty($this->data['Filtro']['SEDE'])) {
				$sedes = $this->data['Filtro']['SEDE'];
			}elseif (!empty($sede_id)) {
				$sedes = $sede_id;
			}
			$this->loadModel('Semana');
			if (isset($this->data['Filtro']['SEMANAS']) && is_array($this->data['Filtro']['SEMANAS'])) {
				if (in_array('ALL',$this->data['Filtro']['SEMANAS'])) {
					$semanas = array();
				}else{
					$semanas = $this->data['Filtro']['SEMANAS'];
				}
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getCargaHorarioDocentePorSemanas(
				$sedes,
				$docente['Docente']['COD_DOCENTE'],
				$periodo['Periodo']['ANHO'],
				$periodo['Periodo']['SEMESTRE'],
				$semanas
			);
			$this->loadModel('Sede');
			$sede = $this->Sede->findByCodSede($sedes);
			$this->loadModel('HorarioModulo');
			#debug($sedes);
			$horarios_modulos = $this->HorarioModulo->getHorarios($sedes);
			#debug($programacion_clases);exit();
			$this->set(array(
				'docente'=>$docente,
				'sede'=>$sede,
				'horarios_modulos'=>$horarios_modulos,
				'programacion_clases'=>$programacion_clases,
			));

			$this->Mpdf->init(array('format' => 'A4-L','margin_top' => 10,'margin_bottom'=>20));
			$this->Mpdf->setFilename('horario_docente.pdf');
			$this->Mpdf->SetHTMLFooter('<div align="right">Página {PAGENO} de {nb}</div>');
			$this->Mpdf->setOutput('A');
		}

		public function reprobadoInacistencia($cod_asignatura_horario=null)
		{
			$this->loadModel('AsignaturaHorario');
			$this->loadModel('Periodo');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
			if (empty($cod_asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('ProgramacionClase');
			$clases_regulares = $this->ProgramacionClase->countClasesRegulares($cod_asignatura_horario);
			$clases_regulares_registradas = $this->ProgramacionClase->countClasesRegistradas($cod_asignatura_horario);
			$clases_suspendidas = $this->ProgramacionClase->countClasesSuspendidas($cod_asignatura_horario);
			$clases_seccion_anterior = $this->ProgramacionClase->getIndicadoresAlumno_calulo($cod_asignatura_horario);
			#debug ($clases_seccion_anterior);exit();
			#$this->AsignaturaHorario->actualizarAsignaturaHorario($cod_asignatura_horario);
			$this->loadModel('AlumnoAsignatura');
			#$alumnos = $this->AlumnoAsignatura->getListadoAlumnosSeccionForRI($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$alumnos = $this->AlumnoAsignatura->getListadoAlumnosSeccionForRI($cod_asignatura_horario);
			$indicadores_alumnos = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);

			$this->set(array(
				'alumnos'=>$alumnos,
				'asignatura_horario'=>$asignatura_horario,
				'clases_regulares'=>$clases_regulares,
				'clases_regulares_registradas'=>$clases_regulares_registradas,
				'clases_suspendidas'=>$clases_suspendidas,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'clases_seccion_anterior'=>$clases_seccion_anterior,
			));
			if ((int)$asignatura_horario['AsignaturaHorario']['RI_ENABLE'] === 0) {
				$this->render('ver_reprobado_inacistencia');
			}
			/* JLMORANDE RFD01  */
			$path = WWW_ROOT.'files' . DS .  $cod_asignatura_horario . '_' . $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'];//$alumnos_im[$i]['RI_IM']['ID'];
					        $folder = new Folder($path , true, 0755);
					   //     $this->layout = 'edit';
				    if (!$this->request->is('post')) return;
				    if(!empty($this->request->data))
				    {

				        if(!empty($this->request->data['Image']['submittedfile']))
				        {
				                $file = $this->request->data['Image']['submittedfile']; 
						        $ext = substr(strtolower(strrchr($file['name'], '.')), 1); 
				                $arr_ext = array('jpg', 'jpeg', 'xlsx','xls'); 

				                if(in_array($ext, $arr_ext))
				                {
				                    $newFilename = $file['name']; 
									move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files/'.$cod_asignatura_horario.  '_' . $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'] . DS . time().$file['name']);
                    				$this->request->data['Post']['filename'] = time().$file['name'];

				                }
				        }
				    }

				$nombreArchivo = WWW_ROOT .'files/'.$cod_asignatura_horario. '_' . $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']. DS . time().$file['name'];//WWW_ROOT. 'files/32443718/1502903906plantilla_para_importar_6.xlsx';//
			    $objPHPExcel = \PHPEXCEL_IOFactory::load($nombreArchivo);
				$objPHPExcel->setActiveSheetIndex(0);
			   	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestDataRow();
			   	$numColumn = $objPHPExcel->setActiveSheetIndex(0)->getHighestDataColumn();
			   	#$maxCell = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
				#$data = $objPHPExcel->rangeToArray('A1:' . $maxCell['column'] . $maxCell['row']);
			   /*	$sheet = $objPHPExcel->getSheet(0); 
			   	  $highestRow = $sheet->getHighestDataRow(); 
			   	  $highestColumn = $sheet->getHighestDataColumn();

         for ($row = 1; $row <= $highestRow; $row++){ 
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);
                if($row==null){
					
                }else{
					debug($rowData);
                }
                      
            }
				exit();*/
		  if ($numRows <= 1) {
					$this->Session->setFlash('No existen datos en el Excel. Intente nuevamente.','mensaje-error');
					$this->redirect(array('controller' => 'Docentes','action' => 'reprobadoInacistencia/'.$cod_asignatura_horario.'' ));
				}else{
			    for($i = 2; $i <= $numRows; $i++){




			    	$this->LoadModel("RI_IM");
		    		$alumno_im = $this->RI_IM->getAlumnoPreRi($cod_asignatura_horario);

			    	$ri_im = new RI_IM();

					$rut = $objPHPExcel->getActiveSheet()->getCell('A' .$i)->getCalculatedValue();
			    	//$cod_asignatura_horario = $objPHPExcel->getActiveSheet()->getCell('B' .$i)->getCalculatedValue();
			    	$nombres = $objPHPExcel->getActiveSheet()->getCell('B' .$i)->getCalculatedValue();
			    	$clases_presente = $objPHPExcel->getActiveSheet()->getCell('C' .$i)->getCalculatedValue();
			    	$clases_registradas = $objPHPExcel->getActiveSheet()->getCell('D' .$i)->getCalculatedValue();
			    	$observaciones = $objPHPExcel->getActiveSheet()->getCell('E' .$i)->getCalculatedValue();
			    	$sigla_seccion = $objPHPExcel->getActiveSheet()->getCell('F' .$i)->getCalculatedValue();
			    	$ri = $objPHPExcel->getActiveSheet()->getCell('G' .$i)->getCalculatedValue();



			    $data = array('RUT' => $rut, 'COD_ASIGNATURA_HORARIO' => $cod_asignatura_horario,'NOMBRES' => $nombres,'CLASES_PRESENTE' => $clases_presente,'CLASES_REGISTRADAS' => $clases_registradas,'OBSERVACIONES' => $observaciones,'SIGLA_SECCION' => $sigla_seccion, 'RI' => $ri);

				/**** PRUEBA  comparacion  ****/
				$this->LoadModel("AlumnoAsignatura");
				$this->LoadModel("Alumno");
				$cod_alumno = $this->Alumno->getCodByRut($rut);
			   	$alumno_im = $this->RI_IM->getAlumnoPreRi($cod_asignatura_horario);
			   	$cod_secc_alumn = array();
				$cod_secc_alumn = $cod_alumno[0]['Alumno']['ID'];

				/*debug($cod_secc_alumn);
				#debug($rut);

			   	$cod_alumno2 = $alumno_im[$i-2]['Alumno']['COD_ALUMNO'];
			   	#debug($alumno_im);
				#$alumno1 = $alumno_im[$i-2]['RI_IM']['RUT'];*/

			   	$alumno_ej = $this->AlumnoAsignatura->getRut($cod_asignatura_horario,$cod_secc_alumn);
			   #	debug($alumno_ej);
			   	
			   /* if(isset($alumno_ej[0]['Alumno']['RUT'])){
			    	$alumno2 = $alumno_ej[0]['Alumno']['RUT'];
		    	   	debug($alumno2);
		    	   #debug($alumno1);
			    }else{
			    	echo "Este Rut no Existe";
			    	debug($rut);
			    }*/

			if(isset($alumno_ej[0]['Alumno']['RUT'])){
			    if($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'] === $sigla_seccion )  {
			    if (is_numeric($clases_presente)) {
			    	if(is_numeric($clases_registradas)){
			    		if (isset($alumno_im[$i-2]['RI_IM']['RUT'])) {
			    			if($alumno_im[$i-2]['RI_IM']['RUT'] == $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue() &&
			    			 $alumno_im[$i-2]['RI_IM']['SIGLA_SECCION'] == $sigla_seccion)//$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getCalculatedValue())
								{
									#debug($alumno_im[$i-2]['RI_IM']['RUT']);
			    					#debug($rut);
									$id = $alumno_im[$i-2]['RI_IM']['ID'];
			    					$ri_im->query("
									UPDATE REPROBADO_RI_IMPORT SET NOMBRES='".$nombres."', CLASES_PRESENTE='".$clases_presente."', CLASES_REGISTRADAS='".$clases_registradas."', OBSERVACIONES='".$observaciones."' WHERE ID='".$id."'");
			    				}else{
			    					#debug($alumno_im[$i-2]['RI_IM']['RUT']);
			    					#debug($rut);
						    		$this->RI_IM->save($data);
			    					}
			    		}
			    		else {
			    			#debug($alumno_im[$i-2]['RI_IM']['RUT']);
			    			#debug($rut);
			    			$this->RI_IM->save($data);
			    			}
					}else{
						$this->Session->setFlash('No se ha insertado el número de Clases Registradas <b>"'.$clases_registradas.'"<b> de la fila "'.$i.'" es inválido. Intente nuevamente.','mensaje-error');
									$this->redirect(array('controller' => 'Docentes','action' => 'reprobadoInacistenciaImport/'.$cod_asignatura_horario.'' ));
					}
				}else{
				$this->Session->setFlash('No se ha insertado el número de Clases Presentes <b>"'.$clases_presente.'"<b> de la fila "'.$i.'" es inválido. Intente nuevamente.','mensaje-error');
				$this->redirect(array('controller' => 'Docentes','action' => 'reprobadoInacistenciaImport/'.$cod_asignatura_horario.'' ));
			}
				}else{
				$this->Session->setFlash('Los datos del Excel están erroneos o son de otra Sección. Intente nuevamente.','mensaje-error');
					$this->redirect(array('controller' => 'Docentes','action' => 'reprobadoInacistencia/'.$cod_asignatura_horario.'' ));
			}
		}else{
				$this->Session->setFlash('Éste Rut no Pertenece a la Sección  <b>"'.$rut.'"<b> de la fila "'.$i.'" es inválido. Intente nuevamente.','mensaje-error');
				$this->redirect(array('controller' => 'Docentes','action' => 'reprobadoInacistenciaImport/'.$cod_asignatura_horario.'' ));
			}

		}

		}

		return $this->redirect(array('controller' => 'Docentes','action' => 'reprobadoInacistenciaImport/'.$cod_asignatura_horario.'' ));

		/*** Fin RFD01 ***/
	}

		public function reprobadoInacistenciaImport($cod_asignatura_horario=null)
		{
			$this->loadModel('AsignaturaHorario');
			$this->loadModel('Periodo');
			$this->loadModel('RI_IM');

			$alumno_im = $this->RI_IM->getAlumnoPreRi($cod_asignatura_horario);

			#debug($alumno_im);exit();
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
			if (empty($cod_asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('ProgramacionClase');
			$clases_regulares = $this->ProgramacionClase->countClasesRegulares($cod_asignatura_horario);
			$clases_suspendidas = $this->ProgramacionClase->countClasesSuspendidas($cod_asignatura_horario);
			#$this->AsignaturaHorario->actualizarAsignaturaHorario($cod_asignatura_horario);
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAlumnosSeccionForRI($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$indicadores_alumnos = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']);
			#debug($alumno_im);exit();

			$this->set(array(
				'alumno_im' => $alumno_im,
				'alumnos'=>	$alumnos,
				'asignatura_horario'=>$asignatura_horario,
				'clases_regulares'=>$clases_regulares,
				'clases_suspendidas'=>$clases_suspendidas,
				'indicadores_alumnos'=>$indicadores_alumnos,
			));
			if ((int)$asignatura_horario['AsignaturaHorario']['RI_ENABLE'] === 0) {
				$this->render('reprobado_inacistencia_import');
			}

}

		public function reprobadoInasistenciaExcel($cod_asignatura_horario=null)
		{
			$this->layout = 'excel';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
			if (empty($cod_asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('ProgramacionClase');
			$clases_regulares = $this->ProgramacionClase->countClasesRegulares($cod_asignatura_horario);
			$clases_suspendidas = $this->ProgramacionClase->countClasesSuspendidas($cod_asignatura_horario);
			#$this->AsignaturaHorario->actualizarAsignaturaHorario($cod_asignatura_horario);
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

		public function reprobadoInasistenciaPdf($cod_asignatura_horario=null)
		{
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
			if (empty($cod_asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('ProgramacionClase');
			$clases_regulares = $this->ProgramacionClase->countClasesRegulares($cod_asignatura_horario);
			$clases_suspendidas = $this->ProgramacionClase->countClasesSuspendidas($cod_asignatura_horario);
			#$this->AsignaturaHorario->actualizarAsignaturaHorario($cod_asignatura_horario);
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
			$this->layout = null;
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reprobados_inasistencia_'.$asignatura_horario['Asignatura']['NOMBRE'].'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('a');
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
		}

		public function verProgramacionClases($asignatura_horario_uuid=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			$programacion_clases = array();
			if (!empty($asignatura_horario)) {
				$this->loadModel('ProgramacionClase');
				$fecha_desde = $fecha_hasta = date('Y-m-d');
				if (!empty($this->data)) {
					if (isset($this->data['Filtro']['fecha_inicio']) && !empty($this->data['Filtro']['fecha_inicio'])) {
						$fecha_desde = date('Y-m-d',strtotime($this->data['Filtro']['fecha_inicio']));
					}
					if (isset($this->data['Filtro']['fecha_fin']) && !empty($this->data['Filtro']['fecha_fin'])) {
						$fecha_hasta = date('Y-m-d',strtotime($this->data['Filtro']['fecha_fin']));
					}
				}
				$programacion_clases = $this->ProgramacionClase
					->getProgramacionByAsignaturaHorario(
						$docente['Docente']['COD_DOCENTE'],
						$asignatura_horario['AsignaturaHorario']['COD_SEDE'],
						$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'],
						$fecha_desde,
						$fecha_hasta
				);
			}
		//	debug($programacion_clases);
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
			));
		}

		public function addBitacoraModal($cod_programacion=null,$desde_mantenedor=FALSE)
		{
			$this->layout = 'ajax';
			$this->loadModel('Bitacora');
			$this->loadModel('ProgramacionClase');
			$bitacoras = $this->Bitacora->getBitacoraClase($cod_programacion);
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			$this->set(array(
				'programacion_clase'=>$programacion_clase,
				'bitacoras'=>$bitacoras,
			));
			if ($desde_mantenedor) {
				$this->render('add_bitacora_modal_2');
			}
		}

		public function saveBitacora($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$docente = $this->Session->read('DocenteLogueado');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClase($cod_programacion);
			
			$response = array('status'=>'success','message'=>'Bitacora registrada con éxito. '.$this->data['Bitacora']['comentarios']);
			if (!empty($this->data) && !empty($cod_programacion)) {
				$new_bitacora = array(
					'COD'=>uniqid(),
					'COD_PROGRAMACION'=>$cod_programacion,
					'ASIGNATURA_HORARIO_COD'=>$programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO'],
					'COD_DOCENTE'=>$docente['Docente']['COD_DOCENTE'],
					'DESCRIPCION'=>$this->data['Bitacora']['comentarios'],
					'CREATED'=>date('Y-m-d H:i:s'),
					'MODIFIED'=>date('Y-m-d H:i:s'),
				);
				#print_r($new_bitacora);exit();
				$this->loadModel('Bitacora');
				$this->Bitacora->create();
				if(!$this->Bitacora->save($new_bitacora)){
					$response = array('status'=>'danger','message'=>'Error en el almacenamiento de los datos. Intente más tarde.');
				}else
				{
					$response = array('status'=>'success','message'=>'Bitacora registrada con éxito.');
			
				}
			}
			echo json_encode($response);
		}

		public function listadoAsistenciaAlumnos( $asignatura_horario_uuid=null, $cod_programacion=null )
		{
			$this->layout = 'ajax';

			$docente = $this->Session->read('DocenteLogueado');
			if(empty($docente)) {
				$this->redirect(array('controller'=>'login','action'=>'logoutDocente'));
			}

			$this->loadModel('AsignaturaHorario');
			$this->loadModel('ProgramacionClase');
			$this->loadModel('Periodo');

			$asignatura_horario=$programacion_clase=$alumnos=array();
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			
			if (!empty($asignatura_horario) && !empty($cod_programacion)) {
				$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
				#debug($programacion_clase);exit();

				$sigla_seccion = $programacion_clase['ProgramacionClase']['SIGLA_SECCION'];				
				$periodo = $this->Periodo->getPeriodo($asignatura_horario['AsignaturaHorario']['COD_PERIODO']);

				# INTEGRACION
				/*$this->Integracion->refreshListadoAsistenciaAlumnosSap($periodo['Periodo']['ANHO'], $periodo['Periodo']['SEMESTRE'], $asignatura_horario_uuid);*/
				

				$this->loadModel('AlumnoAsignatura');

				//Linea de codigo que saque $asignatura_horario['AsignaturaHorario']['COD_SEDE'],

				$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
				#debug($programacion_clase);exit();
				if (!empty($alumnos)) {
					$this->loadModel('Asistencia');
					foreach ($alumnos as $key => $alumno) {
						$asistencia = $this->Asistencia->getAsistenciaAlumnoEvento($alumno['Alumno']['ID'],$cod_programacion);
						$alumnos[$key]['Asistencia']['ID'] = isset($asistencia['Asistencia']['ID'])?$asistencia['Asistencia']['ID']:null;
						$alumnos[$key]['Asistencia']['ASISTENCIA'] = isset($asistencia['Asistencia']['ASISTENCIA'])?$asistencia['Asistencia']['ASISTENCIA']:null;
						$alumnos[$key]['Asistencia']['OBSERVACION'] = isset($asistencia['Asistencia']['OBSERVACION'])?$asistencia['Asistencia']['OBSERVACION']:null;
					}
				}
				$up_programacion = array(
					'ID'=>$programacion_clase['ProgramacionClase']['ID'],
					'FECHA_APERTURA_PROGRAMACION'=>date('d-m-Y H:i:s')
				);
				$this->ProgramacionClase->save($up_programacion);
			}
			#debug($alumnos);exit();
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clase'=>$programacion_clase,
				'alumnos'=>$alumnos
			));
		}

		public function saveAsistenciaAlumnos($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$docente = $this->Session->read('DocenteLogueado');
			$programacion_clase = $this->ProgramacionClase->find('first',array(
				'conditions'=>array(
					'ProgramacionClase.COD_PROGRAMACION'=>$cod_programacion,
				)
			));
			$response = array('message'=>'Ha ocurrido un error inesperado. Intente nuevamente.','status'=>'danger');
			if (!empty($this->data) && !empty($programacion_clase)) {
				#debug($this->data);exit();
				if (isset($this->data['Asistencia']) && is_array($this->data['Asistencia'])) {
					$this->loadModel('Alumno');
					$this->loadModel('Asistencia');
					$error = 0;
					foreach ($this->data['Asistencia'] as $cod_alumno => $value) {
						$alumno = $this->Alumno->find('first',array('conditions'=>array('ID'=>$cod_alumno)));
						if (!empty($alumno)) {
							if (!isset($value['ID'])) {
								$asistencia_programacion = $this->Asistencia->getAsistenciaAlumnoEvento($cod_alumno,$cod_programacion);
								if (empty($asistencia_programacion)) {
									#NUEVO_REGISTRO;
									$new_asistencia = array(
										'COD_PROGRAMACION'=>$cod_programacion,
										'ID_ALUMNO'=>$cod_alumno,
										'UUID'=>uniqid(),
										'SIGLA'=>$programacion_clase['ProgramacionClase']['SIGLA'],
										'COD_DOCENTE'=>$docente['Docente']['COD_DOCENTE'],
										'SIGLA_SECCION'=>$programacion_clase['ProgramacionClase']['SIGLA_SECCION'],
										'ASISTENCIA'=>$value['presente'],
										#'ASISTENCIA'=>isset($value['presente']) && $value['presente'] == 1 ? 1:0, #CHECKED DEL asistencia alumno
										'OBSERVACION'=>isset($value['observacion'])? $value['observacion']:null,
										'COD_ASIGNATURA_HORARIO'=>$programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO'],
										'CREATED'=>date('Y-m-d H:i:s'),
										'MODIFIED'=>date('Y-m-d H:i:s'),
									);
									$this->Asistencia->create(true);
									if(!$this->Asistencia->save($new_asistencia)){
										$error++;
									};
								}else{
									#ACTUALIZAR REGISTRO;
									$up_asistencia=array(
										'ID'=>$asistencia_programacion['Asistencia']['ID'],
										'ASISTENCIA'=>$value['presente'],
										#'ASISTENCIA'=>isset($value['presente']) && $value['presente'] == 1 ? 1:0,
										'OBSERVACION'=>isset($value['observacion'])? $value['observacion']:null,
									);
									if(!$this->Asistencia->save($up_asistencia)){
										#$error++;
									};
								}
							}else{
								#ACTUALIZAR REGISTRO;
								$up_asistencia=array(
									'ID'=>$value['ID'],
									'ASISTENCIA'=>$value['presente'],
									#'ASISTENCIA'=>isset($value['presente']) && $value['presente'] == 1 ? 1:0,
									'OBSERVACION'=>isset($value['observacion'])? $value['observacion']:null,
								);
								if(!$this->Asistencia->save($up_asistencia)){ 
									#$error++;
								};
							}
						}else{
							$error++;
						}
					}
					$up_programacion_clase = array(
						'ID'=>$programacion_clase['ProgramacionClase']['ID'],
						'FECHA_REGISTRO' => date('Y-m-d H:i'),
					);
					if ($programacion_clase['ProgramacionClase']['WF_ESTADO_ID'] == 2) {
						$up_programacion_clase['WF_ESTADO_ID']=3;
					}
					$this->ProgramacionClase->save($up_programacion_clase);
					if ($error>0) {
						$response['message']='La asistencia ha quedado con algunos errores.<br> Guarde nuevamente la asistencia para corregir.';
					}else{
						$this->actualizarDatosAsignaturaHorario($programacion_clase['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
						$response['message']='Asistencia guardada exitosamente.';
						$response['status']='success';
					}
				}
			}
			echo json_encode($response);
		}

		public function verHorarioDocente($cod_periodo=null, $flecha=null, $semana_id=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('Sede');
			$this->loadModel('Semana');
			$this->loadModel('Periodo');
			$this->loadModel('HorarioModulo');
			$this->loadModel('ProgramacionClase');
			$this->loadModel('AsignaturaHorario');

			$sedes='';
			$programacion_clases=$semana=array();

			# Obtener la información del docente.
			$docente = $this->Session->read('DocenteLogueado');

			# Obtener la información del periodo.
			if (!empty($cod_periodo))
			{
				
				$periodo = $this->Periodo->getPeriodo($cod_periodo);
			}else{
				exit();
			}
			#debug($periodo);exit();
			# Obtener el id de la sede.
			if (isset($this->data['Filtro']['SEDE']) && !empty($this->data['Filtro']['SEDE'])) {
				$sedes = $this->data['Filtro']['SEDE'];
			}

			$dibujar_atras=$dibujar_adelante=true;

			#debug($semana_id);
			#debug($flecha);

			if (!empty($semana_id) && !empty($flecha)) {
				$semana_bkp=$semana=$this->Semana->findById($semana_id);

				if ($flecha == 'next-week') {
					$nro_semana=$semana['Semana']['NUMERO_SEMANA']+1;
					$semana = $this->Semana->getSemanaByNumero($periodo['Periodo']['ANHO'], $periodo['Periodo']['SEMESTRE'], $nro_semana);
					if (empty($semana)){
						$dibujar_adelante = false;
					}
				}else{
					$nro_semana=$semana['Semana']['NUMERO_SEMANA']-1;
					$semana = $this->Semana->getSemanaByNumero($periodo['Periodo']['ANHO'], $periodo['Periodo']['SEMESTRE'], $nro_semana);
				}
				if (empty($semana)) {
					$semana = $semana_bkp;
				}
			}else{
				$semana = $this->Semana->getPrimeraSemanaPeriodo($periodo['Periodo']['ANHO'], $periodo['Periodo']['SEMESTRE']);
				if ( isset($this->data['Filtro']['SEMANAS']) && is_array($this->data['Filtro']['SEMANAS'] )) {
					if ( !in_array('ALL', $this->data['Filtro']['SEMANAS'])) {
						$semana = $this->Semana->findById(min($this->data['Filtro']['SEMANAS']));
					}
				}
			}

			if(isset($semana['Semana']) and $semana['Semana']['NUMERO_SEMANA'] == 1) {
				$dibujar_atras = false;
			}
			$fecha_desde = !empty($semana) ? $semana['Semana']['FECHA_INICIO'] : null;
			$fecha_fin = !empty($semana) ? $semana['Semana']['FECHA_FIN'] : null;

			if (!empty($fecha_desde) && !empty($fecha_fin)) {
				$programacion_clases = $this->ProgramacionClase->getCargaHorarioDocente($sedes, $docente['Docente']['COD_DOCENTE'], $fecha_desde, $fecha_fin);
			}
			$sede = $this->Sede->findByCodSede($sedes);
			$horarios_modulos = $this->HorarioModulo->getHorarios($sedes);
			$this->set(array(
				'horarios_modulos'		=> $horarios_modulos,
				'docente'				=> $docente,
				'semana'				=> $semana,
				'sede'					=> $sede,
				'periodo'				=> $periodo,
				'dibujar_atras'			=> $dibujar_atras,
				'dibujar_adelante'		=> $dibujar_adelante,
				'programacion_clases'	=> $programacion_clases,
				#se comento para la vista de vizualizar horario docente
				//'asignatura_clases'		=> $asignatura_clases,
			));
		}

		public function getEventos($periodo=null) 
		{


			// debug($periodo);exit();
			$horarios=$periodos=$periodo_bd=$sedes=$semanas=array();
			# -------------------------------------------------------------------
			# Cargar el docente de la sesión.
			$docente = $this->Session->read('DocenteLogueado');
			if(empty($docente)) {
				$this->redirect(array('controller'=>'login','action'=>'logoutDocente'));
			}
			# -------------------------------------------------------------------
			# Cargar los modelos involucrados.
			$this->loadModel('AsignaturaHorario');
			$this->loadModel('Periodo');
			$this->loadModel('Parametro');
			$this->loadModel('Docente');
			$this->loadModel('Semana');
			$this->loadModel('Sede');
			# -------------------------------------------------------------------
			# Si se tiene seleccionado un periodo.
			if ( !empty( $periodo ) ) {
				$periodo_bd = $this->Periodo->getPeriodo( $periodo );
				$docente_bd = $this->Docente->getDocente( $docente['Docente']['COD_DOCENTE'] );
				if( empty( $periodo_bd ) ) {
					$this->Session->setFlash('El periodo que usted intenta buscar no es valido.','mensaje-error');
					$this->redirect(array('action'=>'getEventos'));
				}
				#debug($periodo_bd);

				# OJO, HACER LA INTEGRACION DE EVENTOS. 

				//$this->Integracion->refreshEventos( $periodo_bd['Periodo']['ANHO'], $periodo_bd['Periodo']['SEMESTRE'], $docente_bd['Docente']['RUT'].strtoupper($docente_bd['Docente']['DV']) );
				

				$horarios = $this->AsignaturaHorario->getCargaHorario($docente['Docente']['COD_DOCENTE'], $periodo);
				$semanas = $this->Semana->getSemanasListByPeriodo($periodo_bd['Periodo']['ANHO'], $periodo_bd['Periodo']['SEMESTRE']);
			}

			# Obtiene los periodos para el listado select.
			$periodos 	= $this->Periodo->getPeriodos();
			$sedes_ids 	= array_keys( $docente['Sede'] );
			$sedes 		= $this->Sede->getSedesListFilterByDocente( $sedes_ids );

			# -------------------------------------------------------------------
			# Setear los valores recuperados.
			$this->set(array(
				'horarios'		=> $horarios,
				'periodos'		=> $periodos,
				'periodo_bd'	=> $periodo_bd,
				'sedes'			=> $sedes,
				'semanas'		=> $semanas,
				'periodo'		=> $periodo
			));
		}

		public function editarBitacoras($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				echo json_encode(array(
					'message'=>'Los datos enviados no coinciden. Intente nuevamente.',
					'status'=>'danger'
				));
			}else{
				$this->loadModel('Bitacora');
				if (!empty($this->data)) {
					if (isset($this->data['Bitacora']) && is_array($this->data['Bitacora'])) {
						foreach ($this->data['Bitacora'] as $key => $value) {
							if (isset($value['ID']) && is_numeric($value['ID']) && isset($value['DESCRIPCION'])) {
								$bitacora = $this->Bitacora->findById($value['ID']);
								if (!empty($bitacora) && strcmp($value['DESCRIPCION'],$bitacora['Bitacora']['DESCRIPCION']) !== 0 ) {
									$up_bitacora = array(
										'ID'=>$value['ID'],
										'DESCRIPCION'=>$value['DESCRIPCION'],
										'MODIFIED'=>date('Y-m-d H:i:s'),
									);
									$this->Bitacora->save($up_bitacora);
								}
							}
						}
						echo json_encode(array(
							'message'=>'La información se ha almacenado con éxito.',
							'status'=>'success'
						));
					}else{
						echo json_encode(array(
							'message'=>'Ha ocurrido un error al almacenar los datos.',
							'status'=>'danger'
						));
					}
				}else{
					echo json_encode(array(
						'message'=>'Ha ocurrido un error al almacenar los datos.',
						'status'=>'danger'
					));
				}
			}	
		}

		public function verBitacoraDetalle($cod_programacion=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('ProgramacionClase');
			$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
			if (empty($programacion_clase)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				echo "<script>location.reload(); </script>";
			}
			$this->loadModel('Bitacora');
			$bitacoras = $this->Bitacora->getBitacoraClase($cod_programacion);
			$this->set(array(
				'programacion_clase'=>$programacion_clase,
				'bitacoras'=>$bitacoras,
			));
		}

		public function bitacoraEvento($asignatura_horario_uuid=null)
		{
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAsignaturaHorarioFull($asignatura_horario_uuid);
			if (!empty($programacion_clases)) {
				$this->loadModel('Bitacora');
				foreach ($programacion_clases as $key => $value) {
					$contador_bitacoras = $this->Bitacora->countByProgramacionClase($value['ProgramacionClase']['COD_PROGRAMACION']);
					$programacion_clases[$key]['bitacora'] = $contador_bitacoras >0 ? TRUE:FALSE;
				}
			}
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
			));
		}

		public function iniciarClase($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$programacion = $this->ProgramacionClase->find('first',array('conditions'=>array('COD_PROGRAMACION'=>$cod_programacion)));
			#debug($programacion);exit();
			$response = array('status'=>'danger','mensaje'=>'No se ha iniciado la clase. Intente nuevamente.');
			if (!empty($programacion)) {
				$up_programacion = array(
					'ProgramacionClase'=>array(
						'FECHA_INICIO_PROGRAMACION'=>date('Y-m-d H:i:s'),
						'ID'=>$programacion['ProgramacionClase']['ID'],
						'WF_ESTADO_ID'=>1
					)
				);
				#debug($programacion);
				/*if ($programacion['ProgramacionClase']['REFORZAMIENTO']==1) {
					$up_programacion['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] = 1;
				}
				if ($programacion['ProgramacionClase']['ADELANTAR_CLASE']==1) {
					$up_programacion['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] = 1;
				}*/
				$up_programacion['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] = 1;
				if ($programacion['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'] == 5) {
					$up_programacion['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID'] = 6;
				}
				
				if($this->ProgramacionClase->save($up_programacion)){
					$response = array('status'=>'success','mensaje'=>'Clase iniciada con éxito');
					$this->actualizarDatosAsignaturaHorario($programacion['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
				};

			}
			echo json_encode($response);
		}

		public function finalizarClase($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$programacion = $this->ProgramacionClase->find('first',array('conditions'=>array('COD_PROGRAMACION'=>$cod_programacion)));
			$response = array('status'=>'danger','mensaje'=>'Ha ocurrido un error inesperado. Intente más tarde.');
			if (!empty($programacion)) {
				$up_programacion = array(
					'ProgramacionClase'=>array(
						'FECHA_FINALIZADA_PROGRAMACION'=>date('Y-m-d H:i:s'),
						'ID'=>$programacion['ProgramacionClase']['ID'],
						'WF_ESTADO_ID'=>4
					)
				);
				if($this->ProgramacionClase->save($up_programacion)){
					$this->actualizarDatosAsignaturaHorario($programacion['ProgramacionClase']['COD_ASIGNATURA_HORARIO']);
					$response = array('status'=>'success','mensaje'=>'Clase finalizada con éxito');
				};
			}
			echo json_encode($response);
		}

		public function saveReprobadoInasistenciaImport($cod_asignatura_horario=null)
		{

			$this->autoRender=false;
			$this->loadModel('AsignaturaHorario');

			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);

			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
			}else{
				#debug($this->data['Alumno']);exit();
				if (isset($this->data['Alumno']) && is_array($this->data['Alumno'])) {
					$this->loadModel('RI');
					$error=0;
					foreach ($this->data['Alumno'] as $key => $value) {
						$up_or_create_ri = array(
							'R_I'=>isset($value['RI']) && $value['RI']==1? 1:0,
							'OBSERVACIONES'=>isset($value['OBSERVACIONES']) && !empty($value['OBSERVACIONES'])? $value['OBSERVACIONES']:null,
							'MODIFIED'=>date('Y-m-d H:i:s'),
						);
						#DEBUG($value);
						$ri = $this->RI->getReprobadoInasistencia($value['ID_ALUMNO'],$cod_asignatura_horario);
						if (!empty($ri)) {
							$up_or_create_ri['ID']=$ri['RI']['ID'];
						}else{
							$up_or_create_ri['CREATED']=date('Y-m-d H:i:s');
							$up_or_create_ri['COD']=uniqid();
							$up_or_create_ri['ID_ALUMNO']=$value['ID_ALUMNO'];
							$up_or_create_ri['COD_ASIGNATURA_HORARIO']=$cod_asignatura_horario;
						}
						if (!$this->RI->save($up_or_create_ri)) {
							$error++;
						}
					}#exit();
					if ($error>0) {
						$this->Session->setFlash('Algunos datos han quedado erroneos, verifique la información y vuelva a guardar.','mensaje-info');
						$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
					}else{
						$up_asignatura_horario = array(
							'ID'=>$asignatura_horario['AsignaturaHorario']['ID'],
							'RI_ENABLE'=>0,
							'RI_IMPORT'=>1,
						);
						$this->AsignaturaHorario->save($up_asignatura_horario);
						$this->Session->setFlash('Los datos se han guardado exitosamente.','mensaje-exito');
						#$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
						$this->redirect(array('controller' => 'Docentes','action' => 'getEventos/',$asignatura_horario['AsignaturaHorario']['COD_PERIODO']));
					}
				}else{
					$this->Session->setFlash('Ha ocurrido un error inesperado. Intente más tarde.','mensaje-error');
					$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
				}
			}
		}
		public function saveReprobadoInasistencia($cod_asignatura_horario=null)
		{
			
			$this->autoRender=false;
			$this->loadModel('AsignaturaHorario');
		
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
			}else{
				#debug($this->data['Alumno']);exit();
				if (isset($this->data['Alumno']) && is_array($this->data['Alumno'])) {
					$this->loadModel('RI');
					$error=0;
					foreach ($this->data['Alumno'] as $key => $value) {
						$up_or_create_ri = array(
							'R_I'=>isset($value['RI']) && $value['RI']==1? 1:0,
							'OBSERVACIONES'=>isset($value['OBSERVACIONES']) && !empty($value['OBSERVACIONES'])? $value['OBSERVACIONES']:null,
							'MODIFIED'=>date('Y-m-d H:i:s'),
						);
						
						$ri = $this->RI->getReprobadoInasistencia($value['ID_ALUMNO'],$cod_asignatura_horario);
						if (!empty($ri)) {
							$up_or_create_ri['ID']=$ri['RI']['ID'];
						}else{
							$up_or_create_ri['CREATED']=date('Y-m-d H:i:s');
							$up_or_create_ri['COD']=uniqid();
							$up_or_create_ri['ID_ALUMNO']=$value['ID_ALUMNO'];
							$up_or_create_ri['COD_ASIGNATURA_HORARIO']=$cod_asignatura_horario;
						}
						if (!$this->RI->save($up_or_create_ri)) {
							$error++;
						}
					}
					if ($error>0) {
						$this->Session->setFlash('Algunos datos han quedado erroneos, verifique la información y vuelva a guardar.','mensaje-info');
						$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
					}else{
						$up_asignatura_horario = array(
							'ID'=>$asignatura_horario['AsignaturaHorario']['ID'],
							'RI_ENABLE'=>0,
						);
						$this->AsignaturaHorario->save($up_asignatura_horario);
						$this->Session->setFlash('Los datos se han guardado exitosamente.','mensaje-exito');
						$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
					}
				}else{
					$this->Session->setFlash('Ha ocurrido un error inesperado. Intente más tarde.','mensaje-error');
					$this->redirect(array('action'=>'reprobadoInacistencia',$cod_asignatura_horario));
				}
			}
		}

		public function actualizarDatosAsignaturaHorario($cod_asignatura_horario=null)
		{
			$this->autoRender = false;
			if (!empty($cod_asignatura_horario)) {
				$this->loadModel('AsignaturaHorario');
				$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($cod_asignatura_horario);
				if (!empty($asignatura_horario)) {
					if($this->AsignaturaHorario->actualizarAsignaturaHorario($cod_asignatura_horario) !== FALSE){
						$update_ultimo_registro = array(
							'ID'=>$asignatura_horario['AsignaturaHorario']['ID'],
							'ULTIMO_REGISTRO'=>date('Y-m-d H:i:s'),
						);
						$this->AsignaturaHorario->save($update_ultimo_registro); 
						#debug($this->AsignaturaHorario->getLastQuery());exit();
					}
				}
			}
		}

		public function registrarAsistencia($cod_programacion=null)
		{
			$this->autoRender = false;
			$this->loadModel('ProgramacionClase');
			$programacion = $this->ProgramacionClase->find('first',array('conditions'=>array('COD_PROGRAMACION'=>$cod_programacion)));
			$response = array('status'=>'error','mensaje'=>'');
			if (!empty($programacion)) {
				$up_programacion = array(
					'ProgramacionClase'=>array(
						'FECHA_REGISTRAR_ASISTENCIA'=>date('Y-m-d H:i:s'),
						'ID'=>$programacion['ProgramacionClase']['ID'],
						'WF_ESTADO_ID'=>2
					)
				);
				if($this->ProgramacionClase->save($up_programacion)){
					$response = array('status'=>'ok');
				};
			}
			echo json_encode($response);
		}

		public function registrarNuevaClase($asignatura_horario_uuid=null)
		{
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
			));
		}

		public function historicoAsistencia($asignatura_horario_uuid=null, $id_html=null)
		{
			$this->loadModel('AsignaturaHorario');
			$this->loadModel('AlumnoAsignatura');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst( $asignatura_horario_uuid );
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'alumnos'=>$alumnos
			));
		}

		public function historicoAsistenciaPDF($asignatura_horario_uuid=null,$cod_alumno=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAlumnoAsignatura($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'],$cod_alumno);
			$this->loadModel('Alumno');
			$alumno = $this->Alumno->find('first',array('conditions'=>array('ID'=>$cod_alumno)));
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
				'alumno'=>$alumno
			));
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('historico_asistencia_por_alumno.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('A');
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);	
		}

		public function historicoAsistenciaCursoPDF($asignatura_horario_uuid=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario_uuid);
			$this->loadModel('ProgramacionClase');
			$total_clases = $this->ProgramacionClase->find('count',array('conditions'=>array('COD_ASIGNATURA_HORARIO'=>$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])));
			$indicadores = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'alumnos'=>$alumnos,
				'indicadores'=>$indicadores,
				'total_clases'=>$total_clases,
			));
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('historico_asistencia_por_curso.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('A');
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);	
		}
public function historicoAsistenciaCursoExcel($asignatura_horario_uuid=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->loadModel('ProgramacionClase');
			$total_clases = $this->ProgramacionClase->find('count',array('conditions'=>array('COD_ASIGNATURA_HORARIO'=>$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])));
			$indicadores = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'alumnos'=>$alumnos,
				'indicadores'=>$indicadores,
				'total_clases'=>$total_clases
			));
		}	
		public function historicoAsistenciaTodoExcel($asignatura_horario_uuid=null)
		{
			$this->layout = 'excel';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('No se encontraron los datos de la asignatura','danger');
				$this->redirect(array('action'=>'historicoAsistencia',$asignatura_horario_uuid));
			}
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);

			// debug($alumnos);exit();
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAsignaturaHorarioFull($asignatura_horario_uuid);

			// debug($programacion_clases);exit();
			if (!empty($alumnos)) {
				$this->loadModel('Asistencia');
				foreach ($alumnos as $key => $alumno) {
					foreach ($programacion_clases as $value) {
						$asistencia = $this->Asistencia->getAsistenciaAlumnoEvento($alumno['Alumno']['ID'],$value['ProgramacionClase']['COD_PROGRAMACION']);
						$alumnos[$key]['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']] = isset($asistencia['Asistencia']['ASISTENCIA'])?$asistencia['Asistencia']['ASISTENCIA']:null;
					}
				}
			}
			$this->loadModel('ProgramacionClase');
			$indicadores = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$puntero_tabla_hitorico_todo = $this->ProgramacionClase->getIndicadoresAlumnoForHistorico($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
				'alumnos'=>$alumnos,
				'indicadores'=>$indicadores,
			));
		}

		public function historicoAsistenciaTodoPdf($asignatura_horario_uuid=null)
		{
			$this->layout = null;
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				echo '<script>notifyUser("Ha ocurrido un error inesperado. Intente más tarde.","danger"); </script>';
				exit();
			}
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAsignaturaHorarioFull($asignatura_horario_uuid);
			if (!empty($alumnos)) {
				$this->loadModel('Asistencia');
				foreach ($alumnos as $key => $alumno) {
					foreach ($programacion_clases as $value) {
						$asistencia = $this->Asistencia->getAsistenciaAlumnoEvento($alumno['Alumno']['ID'],$value['ProgramacionClase']['COD_PROGRAMACION']);
						$alumnos[$key]['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']] = isset($asistencia['Asistencia']['ASISTENCIA'])?$asistencia['Asistencia']['ASISTENCIA']:null;
					}
				}
			}
			$this->loadModel('ProgramacionClase');
			$indicadores = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$puntero_tabla_hitorico_todo = $this->ProgramacionClase->getIndicadoresAlumnoForHistorico($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
				'alumnos'=>$alumnos,
				'indicadores'=>$indicadores,
			));
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>5,'margin_right'=>5));
			$this->Mpdf->setFilename('historico_asistencia_por_curso.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('A');
			$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);	
		}

		

		public function historicoAsistenciaExcel($asignatura_horario_uuid=null,$cod_alumno=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
				$this->redirect(array('action'=>'getEventos'));
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAlumnoAsignatura($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'],$cod_alumno);

			// debug($programacion_clases);exit();
			$this->loadModel('Alumno');
			$alumno = $this->Alumno->find('first',array('conditions'=>array('ID'=>$cod_alumno)));
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
				'alumno'=>$alumno
			));
		}

		public function detalleAsistenciaTodo($asignatura_horario_uuid=null)
		{
			#debug($asignatura_horario_uuid);exit();
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				echo '<script>notifyUser("Ha ocurrido un error inesperado. Intente más tarde.","danger"); </script>';
				exit();
			}
			
			$this->loadModel('AlumnoAsignatura');
			$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario_uuid);
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAsignaturaHorarioFull($asignatura_horario_uuid);
			if (!empty($alumnos)) {
				$this->loadModel('Asistencia');
				foreach ($alumnos as $key => $alumno) {
					foreach ($programacion_clases as $value) {
						$asistencia = $this->Asistencia->getAsistenciaAlumnoEvento($alumno['Alumno']['ID'],$value['ProgramacionClase']['COD_PROGRAMACION']);
						$alumnos[$key]['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']] = isset($asistencia['Asistencia']['ASISTENCIA'])?$asistencia['Asistencia']['ASISTENCIA']:null;
					}
				}
			}
			$this->loadModel('ProgramacionClase');
			$indicadores = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario_uuid);
			$puntero_tabla_hitorico_todo = $this->ProgramacionClase->getIndicadoresAlumnoForHistorico($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
				'alumnos'=>$alumnos,
				'indicadores'=>$indicadores,
			));
		}

		public function detalleAsistenciaAlumno($asignatura_horario_uuid=null, $cod_alumno=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				echo '<script>notifyUser("Ha ocurrido un error inesperado. Intente más tarde.","danger"); </script>';
				exit();
			}
			$this->loadModel('ProgramacionClase');
			$programacion_clases = $this->ProgramacionClase->getProgramacionByAlumnoAsignatura($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'], $cod_alumno);
			$this->loadModel('Alumno');
			$alumno = $this->Alumno->find('first',array('conditions'=>array('ID'=>$cod_alumno)));
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'programacion_clases'=>$programacion_clases,
				'alumno'=>$alumno
			));
		}

		public function detalleAsistenciaCurso($asignatura_horario_uuid=null)
		{
			$this->layout = 'ajax';
			$this->loadModel('AsignaturaHorario');
			$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
			$docente = $this->Session->read('DocenteLogueado');
			if (empty($asignatura_horario)) {
				echo '<script>notifyUser("Ha ocurrido un error inesperado. Intente más tarde.","danger"); </script>';
				exit();
			}
			$this->loadModel('AlumnoAsignatura');
			//$a = $asignatura_horario['AsignaturaHorario']['COD_SEDE'];
			//debug($a);exit();

			$alumnos = $this->AlumnoAsignatura->getListadoAsistenciaReg($asignatura_horario['AsignaturaHorario']['COD_PERIODO'],$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			$this->loadModel('ProgramacionClase');
			$total_clases = $this->ProgramacionClase->find('count',array('conditions'=>array('COD_ASIGNATURA_HORARIO'=>$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])));
			$indicadores = $this->ProgramacionClase->getIndicadoresAlumno($asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
			#debug($indicadores);Exit();
			$this->set(array(
				'asignatura_horario'=>$asignatura_horario,
				'alumnos'=>$alumnos,
				'indicadores'=>$indicadores,
				'total_clases'=>$total_clases
			));
		}

		public function exportarBitacoraExcel($asignatura_horario_uuid=null)
		{
			$this->layout='excel';
			if (!empty($asignatura_horario_uuid)) {
				$this->loadModel('AsignaturaHorario');
				$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
				if (empty($asignatura_horario)) {
					$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
					$this->redirect(array('action'=>'getEventos'));
				}
				$this->loadModel('ProgramacionClase');
				$programacion_clases = $this->ProgramacionClase->getProgramacionByAsignaturaHorarioFull($asignatura_horario_uuid);
				if (!empty($programacion_clases)) {
					$this->loadModel('Bitacora');
					foreach ($programacion_clases as $key => $value) {
						$contador_bitacoras = $this->Bitacora->countByProgramacionClase($value['ProgramacionClase']['COD_PROGRAMACION']);
						$programacion_clases[$key]['bitacora'] = $contador_bitacoras >0 ? TRUE:FALSE;
					}
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'asignatura_horario'=>$asignatura_horario
				));
				// debug($asignatura_horario);
				// debug($programacion_clases); exit();
			}
		}

		public function exportarBitacoraExcelClase($cod_programacion=null)
		{
			$this->layout='excel';
			if (!empty($cod_programacion)) {
				$this->loadModel('ProgramacionClase');
				$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
				if (empty($programacion_clase)) {
					$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
					exit("<script>location.reload(); </script>");
				}
				$this->loadModel('Bitacora');
				$bitacoras = $this->Bitacora->getBitacoraClase($cod_programacion);

				if (!empty($bitacoras)) {
					$programacion_clase['ProgramacionClase']['bitacoras']=$bitacoras;
					$programacion_clase['ProgramacionClase']['count_bitacoras']=count($bitacoras);
				} else {
					$this->Session->setFlash('No se encontraron datos de bitacora para exportar a excel.','mensaje-info');
					echo ("<script>opener.location.reload();</script>");
					echo ("<script>window.close();</script>");
					exit();
					#exit("<script>location.reload();</script>");// Error, esto genera un bucle.
				}
				$this->set(array(
					'programacion_clase'=>$programacion_clase
				));
			} else {
				$this->redirect(array('action'=>'bitacoraEvento'));
			}
		}

		public function exportarBitacoraPdfClase($cod_programacion = null)
		{
			$this->layout = null;
			if (!empty($cod_programacion)) {
				$this->loadModel('ProgramacionClase');
				$programacion_clase = $this->ProgramacionClase->getProgramacionClaseFull($cod_programacion);
				if (empty($programacion_clase)) {
					$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
					$this->redirect(array('action'=>'getEventos'));
				}
				$this->loadModel('Bitacora');
				$bitacoras = $this->Bitacora->getBitacoraClase($cod_programacion);
				if (!empty($bitacoras)) {
					$programacion_clase['ProgramacionClase']['bitacoras']=$bitacoras;
					$programacion_clase['ProgramacionClase']['count_bitacoras']=count($bitacoras);
				}
				$this->set(array(
					'programacion_clase'=>$programacion_clase
				));
			}
			$this->Mpdf->init(array('format' => 'A4-L','margin_top' => 20,'margin_bottom'=>20));
			$this->Mpdf->setFilename('botacora_detalle.pdf');
			$this->Mpdf->SetHTMLFooter('<div align="right">Página {PAGENO} de {nb}</div>');
			$this->Mpdf->setOutput('A');
		}

		public function exportarBitacoraPdf($asignatura_horario_uuid=null)
		{
			if (!empty($asignatura_horario_uuid)) {
				$this->loadModel('AsignaturaHorario');
				$asignatura_horario = $this->AsignaturaHorario->getAsignaturaHorarioFirst($asignatura_horario_uuid);
				if (empty($asignatura_horario)) {
					$this->Session->setFlash('Los datos enviados no coinciden. Intente nuevamente.','mensaje-error');
					$this->redirect(array('action'=>'getEventos'));
				}
				$this->loadModel('ProgramacionClase');
				$programacion_clases = $this->ProgramacionClase->getProgramacionByAsignaturaHorarioFull($asignatura_horario_uuid);
				if (!empty($programacion_clases)) {
					$this->loadModel('Bitacora');
					foreach ($programacion_clases as $key => $value) {
						$contador_bitacoras = $this->Bitacora->countByProgramacionClase($value['ProgramacionClase']['COD_PROGRAMACION']);
						$programacion_clases[$key]['bitacora'] = $contador_bitacoras >0 ? TRUE:FALSE;
					}
				}
				$this->set(array(
					'programacion_clases'=>$programacion_clases,
					'asignatura_horario'=>$asignatura_horario
				));
				$this->layout = null;
				$this->Mpdf->init(array('margin_top' => 20,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
				$this->Mpdf->setFilename('Bitácora'.$asignatura_horario['Asignatura']['NOMBRE'].'.pdf');
				$this->Mpdf->addPage('L');
				$this->Mpdf->setOutput('a');
				$footer = '<div align="right">Página {PAGENO} de {nb}</div>';
				$this->Mpdf->SetHTMLFooter($footer);
			}
		}
	}