<?php 
	


	class LoginController extends AppController {
		public $name = 'Login';
		public $layout = 'login';
		public $uses = array('Parametro');
		public $components = array('Integracion');


		public function login() 
		{
			$data=array();
			$info=$this->LoginValidateData($_GET,$data);
			#Verifica que se haya encontrado usuario en el formulario o en la url
			if ( isset($info["status"]) and trim($info["status"])!='' ) 
			{	
				#Verifica que efectivamente el username y la clave esten asignados	
				if (!empty($data['User']['username']) && !empty($data['User']['password'])) 
				{
					#Verifica si los datos del usuario vienen por el formulario, osea POST, y aqui autentica LDAP									
					if($info["method"]=="POST"){
						// debug($data['User']['username']);exit();
						# INTEGRACION CON LA CLASE LDAP	
						$this->loadModel('LdapAcademico');
						$ldap_response = $this->LdapAcademico->connect(strtoupper($data['User']['username']),$data['User']['password']);
						#$ldap_response = Array('status'=>'success');
						#FIN LDAP
					}else{
						#Si entra por aqui, es porque los datos vienen de la URL, por lo tanto no autentica LDAP
						#Ya que previamente se valido que sea una url valida de acceso para federar
						$ldap_response = Array('status'=>'success');	
					}
					
					if ($ldap_response['status'] == 'success') {
						$this->loadModel('Docente');
						$docente = $this->Docente->getDocenteConSedesForLogin(strtoupper($data['User']['username']));
						if (empty($docente)) {
							$this->Session->setFlash('Sus credenciales no han sido cargadas a la plataforma LVC. Contactese con el administrador.','mensaje-error');
							$this->redirect('/');
						}else{
							$this->Session->write('DocenteLogueado', $docente);
							$this->redirect(array('controller'=>'docentes','action'=>'getEventos'));
						}
					}else{
						$this->Session->setFlash($ldap_response['mensaje'],'mensaje-error');
						$this->redirect('/');	
					}
				}
			}else{
				$perfilSesion = $this->Session->read();
				if ( isset($perfilSesion['CoordinadorLogueado']) ) {
					$this->logoutCoordinador();
				}
				if ( isset($perfilSesion['DocenteLogueado']) ) {
					$this->logoutDocente();
				}
				if ( isset($perfilSesion['DirectorLogueado']) ) {
					$this->logoutDirector();
				}
				if ( isset($perfilSesion['BackOfficeLogueado']) ) {
					$this->logoutBackOffice();
				}		

			}
		}


		public function LoginValidateData($get_data,&$data)
		{
			$retorno=array();
			if(!empty($get_data)){				
				if(isset($get_data["username"]) && isset($get_data["timestamp"]) && isset($get_data["auth"])){
					
					$libro_virtual_clases = "lvch6t5d8jhg4";					
					$SSOString = $get_data["timestamp"] . $get_data["username"];
					$mac_local_lvc = md5 ( $SSOString . $libro_virtual_clases );					

					if($get_data["auth"]==$mac_local_lvc){
						$data['User']['username']=$get_data["username"];
						$data['User']['password']="N/A";						
						$retorno["status"]=true;
						$retorno["method"]="GET";						
						return $retorno;
					}
				}
			}else{				
				if (!empty($this->data)){				
					$data = $this->data;
					$retorno["status"]=true;
					$retorno["method"]="POST";
					return $retorno;					
				}
			} 
			$retorno["status"]=false;	
			return $retorno;
		}


		public function loginCoordinador()
		{
			$this->layout = 'login-admin';
			if (!empty($this->data)) {
				$form_data = $this->data;
				#pr($form_data);exit();
				if (!empty($form_data['User']['username']) && !empty($form_data['User']['password'])) {
					
					#INTEGRACION CON LA CLASE LDAP
					$this->loadModel('LdapAdministrativo');
					$ldap_response = $this->LdapAdministrativo->connect(strtoupper($form_data['User']['username']), $form_data['User']['password']);
					#FIN LDAP

/*echo "<pre>";
print_r($this->data);
print_r($ldap_response);
echo "</pre>";
die('datos');*/
					#$ldap_response['status'] = 'success';
					if ($ldap_response['status'] == 'success') {
						$this->loadModel('CoordinadorDocente');
						$coordinador = $this->CoordinadorDocente->getCoordinadorConSedeForLogin(strtoupper($form_data['User']['username']));
						if (!empty($coordinador)) {
							$this->Session->write('CoordinadorLogueado',$coordinador);
							$this->redirect(array('controller'=>'Administradores','action'=>'index'));	
						}else{
							$this->Session->setFlash('Sus credenciales no han sido cargadas a la plataforma LVC. Contactese con el administrador.','mensaje-error');
						}
					}else{
						$this->Session->setFlash($ldap_response['mensaje'],'mensaje-error');
						$this->redirect('/');	
					}
				}
			}
			$this->redirect(array('action'=>'login'));
		}


		public function logoutCoordinador()
		{
			$this->Session->destroy();
			$this->Session->setFlash('Sesión finalizada.','mensaje-exito');
			$this->redirect('/admin');
		}


		public function logoutDocente()
		{
			$this->Session->destroy();
			$this->Session->setFlash('Sesión finalizada.','mensaje-exito');
			$this->redirect('/');
		}


		public function loginDirector()
		{
			$this->layout = 'login-directores';
			#debug($this->data);Exit();
			if (!empty($this->data)) {
				$form_data = $this->data;
				if (!empty($form_data['User']['username']) && !empty($form_data['User']['password'])) {
					#INTEGRACION CON LA CLASE LDAP
					$this->loadModel('LdapAdministrativo');
					$ldap_response = $this->LdapAdministrativo->connect(strtoupper($form_data['User']['username']),$form_data['User']['password']);
					#debug($ldap_response);exit();
					#$ldap_response = array('status'=>'ok');
					#FIN LDAP
					if ($ldap_response['status'] == 'success') {
						$this->loadModel('Director');
						$director = $this->Director->getDirectorConSedeForLogin(strtoupper($form_data['User']['username']));
						if (!empty($director)) {
							$this->Session->write('DirectorLogueado',$director);
							$this->redirect(array('controller'=>'Directores','action'=>'index'));	
						}else{
							$this->Session->setFlash('Sus credenciales no han sido cargadas a la plataforma LVC. Contactese con el administrador.','mensaje-error');
							$this->redirect('/');
						}
					}else{
						$this->Session->setFlash($ldap_response['mensaje'],'mensaje-error');
						$this->redirect('/');	
					}
				}
			}
			$this->redirect(array('action'=>'login'));
		}


		public function logoutDirector()
		{
			$this->Session->destroy();
			$this->Session->setFlash('Sesión finalizada.','mensaje-exito');
			$this->redirect('/directores');
		}


		public function loginBackOffice()
		{
			$this->layout = 'login-directores';
			#debug($this->data);Exit();
			if (!empty($this->data)) {
				$form_data = $this->data;
				#$form_data['User']['username'] = $form_data['User']['username'];
				#$form_data['User']['password'] = '12345';
				if (!empty($form_data['User']['username']) && !empty($form_data['User']['password'])) {
					$this->loadModel('LdapAdministrativo');
					$ldap_response = $this->LdapAdministrativo->connect(strtoupper($form_data['User']['username']),$form_data['User']['password']);
					#debug($ldap_response);exit();
					#$ldap_response = array('status'=>'ok');
					#FIN LDAP
					if ($ldap_response['status'] == 'success') {
						$this->loadModel('AccesoBackOffice');
						$acceso_backoffice = $this->AccesoBackOffice->getAccessFull(strtoupper($form_data['User']['username']));
						if (!empty($acceso_backoffice)) {
							$this->Session->write('BackOfficeLogueado',$acceso_backoffice);
							#debug($acceso_backoffice);exit();
							$this->redirect(array('controller'=>'BackOffice','action'=>'index'));
						}else{
							$this->Session->setFlash('Sus credenciales no han sido cargadas a la plataforma LVC. Contactese con el administrador.','mensaje-error');
							$this->redirect('/');
						}
					}else{
						$this->Session->setFlash($ldap_response['mensaje'],'mensaje-error');
						$this->redirect('/');	
					}
				}
			}
			$this->redirect(array('action'=>'login'));
		}


		public function logoutBackOffice()
		{
			$this->Session->destroy();
			$this->Session->setFlash('Sesión finalizada.','mensaje-exito');
			$this->redirect('/bo');
		}


		/*
		public function sincSap()
		{
			$Parametro = new Parametro();
			if($this->Integracion->refreshAnhosSap());
			if($this->Integracion->refreshPeriodos($Parametro->getValorParametro('ANHO_ACTUAL'),$Parametro->getValorParametro('CALENDARIO_ACTIVO')));
			return true;
		}
		*/
	}
