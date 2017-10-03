<?php 
	class Alumno extends AppModel {
	
		public  $name = 'Alumno';
		public  $useTable = 'ALUMNOS';

		
		public function getAlumnoById(){
			
			$a = $this->find('all',array(
			'fields' => array('ID.*','ID.*'),
			'joins' => array(
        array(
            'table' => 'LVC_ALUMNOS_EVENTO',
            'alias' => 'UserJoin',
            'type' => 'INNER',
            'conditions' => array(
                'UserJoin.ID = 3578'
            )
        )
    )));
			
			return $a;
		}
		public function getCodByRut($rut=null){
			$result = array();
			$result = $this->find('all',array(
				'fields' => array('DISTINCT Alumno.ID',
					),
				'conditions'=> array(
					'Alumno.RUT' => $rut,
					),
				));
			return $result;
		}
		public function getAlumnoByCod_($cod_alumno=null)
		{
			return $this->find('first',array('conditions'=>array('COD_ALUMNO'=>$cod_alumno)));
		}
		public function autocompletarByRut($term='')
		{
			$rut_alumno = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$rut_alumno = $this->find('all',array(
					'fields'=>array(
						'DISTINCT Alumno.rut',
						'Alumno.dv_rut',
						'Alumno.cod_alumno',
						'Alumno.NOMBRES',
						'Alumno.APELLIDO_MAT',
						'Alumno.APELLIDO_PAT',
					),
					'conditions'=>array(
						"Alumno.rut ||'-'||Alumno.dv_rut LIKE '%".$term."%' "
					),
					'order'=>'Alumno.rut'
				));
			}
			return $rut_alumno;
		}
		public function autocompletarByNombre($term='')
		{
			$rut_alumno = array();
			if (!empty($term)) {
				$term = strtoupper($term);
				$rut_alumno = $this->find('all',array(
					'fields'=>array(
						'Alumno.rut',
						'Alumno.dv_rut',
						'Alumno.cod_alumno',
						'Alumno.NOMBRES',
						'Alumno.APELLIDO_MAT',
						'Alumno.APELLIDO_PAT',
					),
					'conditions'=>array(
						"Alumno.NOMBRES ||' '||Alumno.APELLIDO_PAT ||' '||Alumno.APELLIDO_MAT LIKE '%".$term."%' "
					),
					'order'=>'Alumno.NOMBRES'
				));
			}
			return $rut_alumno;
		}

	}