<?php 
/** JLMORANDE RFD01 */
	class RI_IM extends AppModel {

		public  $name = 'RI_IM';
		public  $useTable = 'REPROBADO_RI_IMPORT';



		public function getAlumnoPreRi($cod_asignatura_horario=null){
			$result = $this->find('all',array(
				'fields' => array(
					'DISTINCT RI_IM.id',
					'RI_IM.RUT',
					'RI_IM.COD_ASIGNATURA_HORARIO',
					'RI_IM.NOMBRES',
					'RI_IM.CLASES_PRESENTE',
					'RI_IM.CLASES_REGISTRADAS',
					'RI_IM.OBSERVACIONES',
					'RI_IM.SIGLA_SECCION',
					'RI_IM.RI',
					'RI_IM.MODALIDAD',
					'Alumno.Rut',
					'Alumno.ID',
					'Alumno.DV_RUT',
					'Alumno.COD_ALUMNO',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.APELLIDO_MAT',
					),
				'joins'=>array(
					array(
						'type'=>'inner',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
							'Alumno.RUT = RI_IM.RUT'
						)
					),
					),
					'conditions'=>array('COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario), 'order' => 'RI_IM.id ASC',
				));

			return $result;
		}
		public function getAlumnoByRi($cod_asignatura_horario=null)
		{
			$result = $this->find('all',array(
				'fields'=>array(
					'DISTINCT RI_IM.id',
					'RI_IM.RUT',
					'RI_IM.COD_ASIGNATURA_HORARIO',
					'RI_IM.NOMBRES',
					'RI_IM.CLASES_PRESENTE',
					'RI_IM.CLASES_REGISTRADAS',
					'RI_IM.OBSERVACIONES',
					'RI_IM.SIGLA_SECCION',
					'RI_IM.RI',
					'RI_IM.MODALIDAD',
					'Alumno.Rut',
					'Alumno.ID',
					'Alumno.DV_RUT',
					'Alumno.COD_ALUMNO',
					'Alumno.NOMBRES',
					'Alumno.APELLIDO_PAT',
					'Alumno.APELLIDO_MAT',
					'RI.ID',
					'RI.R_I',
					'RI.OBSERVACIONES',
					'RI.RI_DIRECTOR',
					'RI.BORRADOR',
				),
				'joins'=>array(
					array(
						'type'=>'LEFT',
						'table'=>'ALUMNOS',
						'alias'=>'Alumno',
						'conditions'=>array(
							'Alumno.RUT = RI_IM.RUT'
						)
					),
					array(
						'type'=>'LEFT',
						'table'=>'REPROBADO_INASISTENCIA',
						'alias'=>'RI',
						'conditions'=>array(
							'Alumno.ID = RI.ID_ALUMNO',
							'RI_IM.COD_ASIGNATURA_HORARIO = RI.COD_ASIGNATURA_HORARIO',
						)
					),
				),
				'conditions'=>array('COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario, 'RI.R_I' =>1), 'order' => 'RI_IM.id ASC',
			));
#debug($this->getLastQuery());
#debug($result);exit();
			return $result;
			#debug($cod_asignatura_horario);exit();
			/*return $this->find('all',array('conditions'=>array('COD_ASIGNATURA_HORARIO'=>$cod_asignatura_horario), 'order' => array('RI_IM.id ASC')));*/
		}
		public function comparaRut($cod_asignatura_horario){
			$result = $this->find('all',array(
				
				));
		}

		public function insertAlumnosRi($rut,$cod_asignatura_horario,$nombres,$clases_presente,$clases_registradas,$observaciones)
		{

			#debug($rut);exit();

			$sql = "INSERT INTO RI_IM (RUT, COD_ASIGNATURA_HORARIO, NOMBRES, CLASES_PRESENTE, CLASES_REGISTRADAS, OBSERVACIONES, SIGLA_SECCION, RI) VALUE('$rut','$cod_asignatura_horario','$nombres','$clases_presente','$clases_registradas','$observaciones')";
			
			debug($this->getLastQuery());
		} 
	}