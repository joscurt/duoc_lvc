<?php 
	App::uses('CakeEmail', 'Network/Email');
	App::import('Vendor', 'Classes/PHPExcel');
	class ReportesController extends AppController {

		public  $name= 'Reportes';
		public  $layout = 'ajax';
		public  $components = array('Mpdf','Integracion');

		#REPORTE 1 COORDINADOR DOCENTE;
		public function reporteNominaClasesRecuperarAdelantar()
		{	
		}
		public function grillaNominaClasesRecuperarAdelantar() 
		{
			$datos_filtro = $registros = array();
			$ordenar = '';
			$sed = $this->Session->read('CoordinadorLogueado');

			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				#$cod_sede = '79';
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesRecuperarAdelantar($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
				
				#debug($registros);exit();
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelNominaClasesRecuperarAdelantar() 
		{
			$datos_filtro = $registros = array();
			$ordenar = '';
			$sed = $this->Session->read("CoordinadorLogueado");

			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesRecuperarAdelantar($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function imprimirNominaClasesRecuperarAdelantar() 
		{
			$this->layout = 'imprimir';
			$datos_filtro = $registros = array();
			$ordenar = '';
			$sed = $this->Session->read('CoordinadorLogueado');
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesRecuperarAdelantar($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function pdfNominaClasesRecuperarAdelantar() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				#$cod_sede = $session_data['Sede']['COD_SEDE'];
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesRecuperarAdelantar($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$this->set(array(
				'registros'=>$registros,
			));
			#debug($registros);exit();
		}

		#REPORTE 2 COORDINADOR DOCENTE;
		public function reporteNominaClasesProgramadas()
		{	
		}
		public function grillaNominaClasesProgramadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}

				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesProgramadas($fecha_desde,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
				// debug($this->ProgramacionClase->getLastQuery());
				// exit();
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelNominaClasesProgramadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesProgramadas($fecha_desde,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function imprimirNominaClasesProgramadas() 
		{
			$this->layout = 'imprimir';
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesProgramadas($fecha_desde,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function pdfNominaClasesProgramadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getNominaClasesProgramadas($fecha_desde,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$this->set(array(
				'registros'=>$registros,
			));
		}

		#REPORTE 3 COORDINADOR DOCENTE;
		public function reportePeriodicoClasesProgramadas()
		{	
		}
		public function grillaPeriodicoClasesProgramadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesProgramadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
				#debug($this->ProgramacionClase->getLastQuery());
				#exit();
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelPeriodicoClasesProgramadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesProgramadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function imprimirPeriodicoClasesProgramadas() 
		{
			$this->layout = 'imprimir';
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta =  '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesProgramadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function pdfPeriodicoClasesProgramadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesProgramadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$this->set(array(
				'registros'=>$registros,
			));
		}

		#REPORTE 4 COORDINADOR DOCENTE 
		public function reportePeriodicoClasesAdelantadasRecuperadas()
		{	
		}
		public function grillaPeriodicoClasesAdelantadasRecuperadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesAdelantadasRecuperadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
				#debug($this->ProgramacionClase->getLastQuery());
				#exit();
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelPeriodicoClasesAdelantadasRecuperadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesAdelantadasRecuperadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function imprimirPeriodicoClasesAdelantadasRecuperadas() 
		{
			$this->layout = 'imprimir';
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesAdelantadasRecuperadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function pdfPeriodicoClasesAdelantadasRecuperadas() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['Filtro']['nombre_asignatura']) && !empty($datos_filtro['Filtro']['nombre_asignatura'])) {
					$nombre_asignatura = $datos_filtro['Filtro']['nombre_asignatura'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPeriodicoClasesAdelantadasRecuperadas($fecha_desde,$fecha_hasta,$cod_docente,$nombre_asignatura,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$this->set(array(
				'registros'=>$registros,
			));
		}

		#REPORTE 5 COORDINADOR DOCENTE 
		public function reportePresenciaDocente()
		{
			$this->loadModel('HorarioModulo');
			$session_data = $this->Session->read('CoordinadorLogueado');
			$this->set(array(
				'horarios_modulos'=>$this->HorarioModulo->getSimpleHorarioBySede($session_data['Sede']['COD_SEDE']),
			));
		}
		public function grillaPresenciaDocente() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = $hora_inicio = $hora_fin = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['horario_inicio']) && !empty($datos_filtro['Filtro']['horario_inicio'])) {
					$hora_inicio = $datos_filtro['Filtro']['horario_inicio'];
				}
				if (isset($datos_filtro['Filtro']['horario_termino']) && !empty($datos_filtro['Filtro']['horario_termino'])) {
					$hora_fin = $datos_filtro['Filtro']['horario_termino'];
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				#debug($this->data);#exit();
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPresenciaDocente($fecha_desde,$fecha_hasta,$hora_inicio,$hora_fin,$cod_docente,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			#debug($registros);
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelPresenciaDocente() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = $hora_inicio = $hora_fin = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['horario_inicio']) && !empty($datos_filtro['Filtro']['horario_inicio'])) {
					$hora_inicio = $datos_filtro['Filtro']['horario_inicio'];
				}
				if (isset($datos_filtro['Filtro']['horario_termino']) && !empty($datos_filtro['Filtro']['horario_termino'])) {
					$hora_fin = $datos_filtro['Filtro']['horario_termino'];
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPresenciaDocente($fecha_desde,$fecha_hasta,$hora_inicio,$hora_fin,$cod_docente,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function imprimirPresenciaDocente() 
		{
			$this->layout = 'imprimir';
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = $hora_inicio = $hora_fin = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['horario_inicio']) && !empty($datos_filtro['Filtro']['horario_inicio'])) {
					$hora_inicio = $datos_filtro['Filtro']['horario_inicio'];
				}
				if (isset($datos_filtro['Filtro']['horario_termino']) && !empty($datos_filtro['Filtro']['horario_termino'])) {
					$hora_fin = $datos_filtro['Filtro']['horario_termino'];
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPresenciaDocente($fecha_desde,$fecha_hasta,$hora_inicio,$hora_fin,$cod_docente,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->set(array(
				'registros'=>$registros,
			));
		}
		public function pdfPresenciaDocente() 
		{
			$datos_filtro = $registros = array();
			$sed = $this->Session->read('CoordinadorLogueado');
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				$cod_docente = $nombre_asignatura = $fecha_desde = $fecha_hasta = $hora_inicio = $hora_fin = '';
				if (isset($datos_filtro['Filtro']['fecha_inicio']) && !empty($datos_filtro['Filtro']['fecha_inicio'])) {
					$fecha_desde = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_inicio']));
				}
				if (isset($datos_filtro['Filtro']['fecha_fin']) && !empty($datos_filtro['Filtro']['fecha_fin'])) {
					$fecha_hasta = date('Y-m-d',strtotime($datos_filtro['Filtro']['fecha_fin']));
				}
				if (isset($datos_filtro['Filtro']['horario_inicio']) && !empty($datos_filtro['Filtro']['horario_inicio'])) {
					$hora_inicio = $datos_filtro['Filtro']['horario_inicio'];
				}
				if (isset($datos_filtro['Filtro']['horario_termino']) && !empty($datos_filtro['Filtro']['horario_termino'])) {
					$hora_fin = $datos_filtro['Filtro']['horario_termino'];
				}
				if (isset($datos_filtro['Filtro']['nombre_docente']) && !empty($datos_filtro['Filtro']['nombre_docente'])) {
					$cod_docente = $datos_filtro['Filtro']['valor_docente'];
				}
				if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
					$ordenar = $datos_filtro['ordenar'];
				}
				$this->loadModel('ProgramacionClase');
				$registros = $this->ProgramacionClase->getPresenciaDocente($fecha_desde,$fecha_hasta,$hora_inicio,$hora_fin,$cod_docente,$ordenar,$sed['Sede']['COD_SEDE']);
			}
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$this->set(array(
				'registros'=>$registros,
			));
		}

		#REPORTE 1 DIRECTOR;
		public function reporteTasaAsistencia() 
		{
			$this->loadModel('Periodo');
			$this->loadModel('Parametro');
			$periodos = $this->Periodo->getPeriodosByAnho($this->Parametro->getValorParametro('ANHO_ACTUAL'));
			$this->set('periodos',$periodos);
		}
		public function reporteTasaAsistenciaSolo() 
		{
			$this->loadModel('Periodo');
			$this->loadModel('Parametro');
			$periodos = $this->Periodo->getPeriodosByAnho($this->Parametro->getValorParametro('ANHO_ACTUAL'));
			$this->set('periodos',$periodos);
		}
		public function reporteTasaAsistenciaRi() 
		{
			$this->loadModel('Periodo');
			$this->loadModel('Parametro');
			$periodos = $this->Periodo->getPeriodosByAnho($this->Parametro->getValorParametro('ANHO_ACTUAL'));
			$this->set('periodos',$periodos);
		}
		public function grillaTasaAsistenciaRi() 
		{
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';

			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						#debug($registros);exit();
						$siglas_secciones = array();

						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
							
						}

						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);
								$this->loadModel('AsignaturaHorario');
								$asignatura_horario[$value] = $this->AsignaturaHorario->getAsignaturaHorario($value);
								
							}	
						}
												
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function grillaTasaAsistenciaSolo() 
		{
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';

			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						#debug($registros);exit();
						$siglas_secciones = array();

						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
							
						}

						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);
								$this->loadModel('AsignaturaHorario');
								$asignatura_horario[$value] = $this->AsignaturaHorario->getAsignaturaHorario($value);
								
							}	
						}
												
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function grillaTasaAsistencia() 
		{
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';

			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						#debug($registros);exit();
						$siglas_secciones = array();

						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
							
						}

						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);
								$this->loadModel('AsignaturaHorario');
								$asignatura_horario[$value] = $this->AsignaturaHorario->getAsignaturaHorario($value);
								
							}	
						}
												
					}
				}
			}
			#debug($indicadores_alumnos);exit();
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelTasaAsistencia()
		{
			
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelTasaAsistenciaSolo()
		{
			
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelTasaAsistenciaRi()
		{
			
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function pdfTasaAsistencia() 
		{

			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function pdfTasaAsistenciaRi() 
		{

			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function pdfTasaAsistenciaSolo() 
		{

			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						#debug($sigla_seccion);exit();
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);

						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function imprimirTasaAsistencia()
		{
			$this->layout = 'imprimir';
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}


		public function imprimirTasaAsistenciaSolo()
		{
			$this->layout = 'imprimir';
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function imprimirTasaAsistenciaRi()
		{
			$this->layout = 'imprimir';
			$indicadores_alumnos = $datos_filtro = $registros = array();
			$ordenar = '';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_alumno = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['alumno_rut']) && !empty($datos_filtro['Filtro']['alumno_rut']) || (isset($datos_filtro['Filtro']['alumno_nombre']) && !empty($datos_filtro['Filtro']['alumno_nombre']))) {
							$cod_alumno = $datos_filtro['Filtro']['valor_alumno'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AlumnoAsignatura');
						$registros = $this->AlumnoAsignatura->getTasaAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_alumno,$sigla_seccion,$ordenar);
						$siglas_secciones = array();
						foreach ($registros as $key => $value) {
							$siglas_secciones[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']] = $value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA'];
						}
						if (!empty($siglas_secciones)) {
							$this->loadModel('ProgramacionClase');
							foreach ($siglas_secciones as $value) {
								$indicadores_alumnos[$value] = $this->ProgramacionClase->getIndicadoresAlumno($value);	
							}	
						}
						#debug($registros);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_alumnos'=>$indicadores_alumnos,
				'datos_filtro'=>$datos_filtro,
			));
		}
		#REPORTE 1 DIRECTOR;
		public function reporteCumplimientoAsistencia() 
		{
			$this->loadModel('Periodo');
			$this->loadModel('Parametro');
			$periodos = $this->Periodo->getPeriodosByAnho($this->Parametro->getValorParametro('ANHO_ACTUAL'));
			$this->set('periodos',$periodos);
		}
		public function grillaCumplimientoAsistencia() 
		{
			$indicadores_sigla_seccion = $datos_filtro = $registros = array();
			$ordenar = 'Asignatura.NOMBRE';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_docente = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['docente_rut']) && !empty($datos_filtro['Filtro']['docente_rut']) || (isset($datos_filtro['Filtro']['docente_nombre']) && !empty($datos_filtro['Filtro']['docente_nombre']))) {
							$cod_docente = $datos_filtro['Filtro']['valor_docente'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AsignaturaHorario');
						$registros = $this->AsignaturaHorario->getCumplimientoAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_docente,$sigla_seccion,$ordenar);
						if (!empty($registros)) {
							$this->loadModel('ProgramacionClase');
							foreach ($registros as $key => $value) {
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_SUSPENDIDAS'] = $this->ProgramacionClase->countClasesSuspendidas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGULARES'] = $this->ProgramacionClase->countClasesRegulares($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGISTRADAS'] = $this->ProgramacionClase->countClasesRegistradas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
							}
						}
						#debug($registros);
						#debug($indicadores_sigla_seccion);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_sigla_seccion'=>$indicadores_sigla_seccion,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function excelCumplimientoAsistencia()
		{
			$this->layout = null;
			$indicadores_sigla_seccion = $datos_filtro = $registros = array();
			$session = $this->Session->read('DirectorLogueado');
			#debug($session);exit();
			$ordenar = 'Asignatura.NOMBRE';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_docente = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['docente_rut']) && !empty($datos_filtro['Filtro']['docente_rut']) || (isset($datos_filtro['Filtro']['docente_nombre']) && !empty($datos_filtro['Filtro']['docente_nombre']))) {
							$cod_docente = $datos_filtro['Filtro']['valor_docente'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}

						// debug($datos_filtro);exit();


						$this->loadModel('AsignaturaHorario');
						$registros = $this->AsignaturaHorario->getCumplimientoAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_docente,$sigla_seccion,$ordenar);
						if (!empty($registros)) {
							$this->loadModel('ProgramacionClase');
							foreach ($registros as $key => $value) {
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_SUSPENDIDAS'] = $this->ProgramacionClase->countClasesSuspendidas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGULARES'] = $this->ProgramacionClase->countClasesRegulares($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGISTRADAS'] = $this->ProgramacionClase->countClasesRegistradas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
							}
						}
						#debug($registros);
						#debug($indicadores_sigla_seccion);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_sigla_seccion'=>$indicadores_sigla_seccion,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function pdfCumplimientoAsistencia() 
		{
			
			$this->Mpdf->init(array('margin_top' => 10,'margin_bottom'=>20,'margin_left'=>10,'margin_right'=>10));
			$this->Mpdf->setFilename('reporte_'.date('dmY_Hi').'.pdf');
			$this->Mpdf->addPage('L');
			$this->Mpdf->setOutput('D');
			$footer = '<div align="right">P&aacute;gina {PAGENO} de {nb}</div>';
			$this->Mpdf->SetHTMLFooter($footer);
			$this->layout = null;
			$indicadores_sigla_seccion = $datos_filtro = $registros = array();
			$ordenar = 'Asignatura.NOMBRE';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_docente = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['docente_rut']) && !empty($datos_filtro['Filtro']['docente_rut']) || (isset($datos_filtro['Filtro']['docente_nombre']) && !empty($datos_filtro['Filtro']['docente_nombre']))) {
							$cod_docente = $datos_filtro['Filtro']['valor_docente'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AsignaturaHorario');
						$registros = $this->AsignaturaHorario->getCumplimientoAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_docente,$sigla_seccion,$ordenar);
						if (!empty($registros)) {
							$this->loadModel('ProgramacionClase');
							foreach ($registros as $key => $value) {
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_SUSPENDIDAS'] = $this->ProgramacionClase->countClasesSuspendidas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGULARES'] = $this->ProgramacionClase->countClasesRegulares($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGISTRADAS'] = $this->ProgramacionClase->countClasesRegistradas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
							}
						}
						#debug($registros);
						#debug($indicadores_sigla_seccion);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_sigla_seccion'=>$indicadores_sigla_seccion,
				'datos_filtro'=>$datos_filtro,
			));
		}
		public function imprimirCumplimientoAsistencia()
		{
			$this->layout = 'imprimir';
			$indicadores_sigla_seccion = $datos_filtro = $registros = array();
			$ordenar = 'Asignatura.NOMBRE';
			if (!empty($this->data)) {
				$datos_filtro = $this->data;
				#debug($datos_filtro);#exit();
				if (isset($datos_filtro['Filtro']['periodo']) && !empty($datos_filtro['Filtro']['periodo'])) {
					$this->loadModel('Periodo');
					$periodo = $this->Periodo->getPeriodo($datos_filtro['Filtro']['periodo']);
					if (!empty($periodo)) {
						$ordenar = $cod_docente = $sigla_seccion='';
						if (isset($datos_filtro['Filtro']['docente_rut']) && !empty($datos_filtro['Filtro']['docente_rut']) || (isset($datos_filtro['Filtro']['docente_nombre']) && !empty($datos_filtro['Filtro']['docente_nombre']))) {
							$cod_docente = $datos_filtro['Filtro']['valor_docente'];
						}
						if (isset($datos_filtro['Filtro']['sigla_seccion']) && !empty($datos_filtro['Filtro']['sigla_seccion'])) {
							$sigla_seccion = $datos_filtro['Filtro']['sigla_seccion'];
						}
						if (isset($datos_filtro['ordenar']) && !empty($datos_filtro['ordenar'])) {
							$ordenar = $datos_filtro['ordenar'];
						}
						$this->loadModel('AsignaturaHorario');
						$registros = $this->AsignaturaHorario->getCumplimientoAsistencia($periodo['Periodo']['COD_PERIODO'],$cod_docente,$sigla_seccion,$ordenar);
						if (!empty($registros)) {
							$this->loadModel('ProgramacionClase');
							foreach ($registros as $key => $value) {
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_SUSPENDIDAS'] = $this->ProgramacionClase->countClasesSuspendidas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGULARES'] = $this->ProgramacionClase->countClasesRegulares($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
								$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]['CLASES_REGISTRADAS'] = $this->ProgramacionClase->countClasesRegistradas($value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']);
							}
						}
						#debug($registros);
						#debug($indicadores_sigla_seccion);
						#exit();
					}
				}
			}
			$this->set(array(
				'registros'=>$registros,
				'ordenar'=>$ordenar,
				'indicadores_sigla_seccion'=>$indicadores_sigla_seccion,
				'datos_filtro'=>$datos_filtro,
			));
		}
	}