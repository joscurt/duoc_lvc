<?php 
	class TipoJustificacionLegal extends AppModel {
	
		public  $name = 'TipoJustificacionLegal';
		public  $useTable = 'TIPOS_JUSTIFICACION_LEGAL';
		public  $primaryKey = 'ID';
		public  $displayField = 'TIPO_JUSTIFICACION';

		public function getTiposJustificacionList()
		{
			return $this->find('list',array('conditions'=>array('ACTIVO'=>1),'order'=>'TIPO_JUSTIFICACION'));
		}
		public function getMotivosTiposJustificacionLegal()
		{
			return $this->find('all',array('order'=>'TIPO_JUSTIFICACION'));
		}
	}