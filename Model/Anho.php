<?php 
	class Anho extends AppModel {
	
		public  $name = 'Anho';
		public  $useTable = 'ANHOS';

		public function deleteAll()
		{
			$sql = "DELETE FROM ANHOS";
			return is_array($this->query($sql));
		}
	}