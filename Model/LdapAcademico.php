<?php
App::uses('AppModel', 'Model');
class LdapAcademico {

	var $name = 'LdapAcademico';
	var $direccion = '10.10.100.130';
	var $puerto = 389;
	var $ds = null;

	function connect($user=null,$pass=null){
		
	/*	$ldap_response = array(
			'tipo' => null, #docente o alumno
			'rut' => null, #null o rut sin digito verificador
			'status' => '', #success o error
			'mensaje' => '' #ok o mensaje de error
		);
		try{
			$this->ds = ldap_connect($this->direccion,$this->puerto);
			#debug(ldap_error($this->ds));
			if($r=@ldap_bind($this->ds,"uid=".$user.", ou=Alumnos,cn=Users,dc=duoc, dc=cl",$pass)){
		       	$sradm=ldap_search($this->ds,"ou=Alumnos,cn=Users,dc=duoc, dc=cl", "uid=".$user);
		       	$info = ldap_get_entries($this->ds, $sradm);
		       	if($r){
		       		for ($i=0; $i<$info["count"]; $i++){
						$rutcon=$info[0]["rut"][0];
						$rut=substr($rutcon,0,strpos ($rutcon, '-'));
						ldap_close($this->ds);
						$ldap_response = array(
							'tipo' => 'alumno', #docente o alumno
							'rut' => $rut,#rut sin digito verificador
							'status' => 'success', #success o error
							'mensaje' => 'ok' #ok o mensaje de error
						);
		           }
		       	}
			}else{
				#docente
				// debug(ldap_error($this->ds));exit();
			// 	ldap_set_option($this->ds, LDAP_OPT_PROTOCOL_VERSION, 3);
			// ldap_set_option($this->ds, LDAP_OPT_REFERRALS, 0);
				if($r=@ldap_bind($this->ds,"uid=".$user.", ou=Profesores,cn=Users,dc=duoc, dc=cl",$pass)){
			       	$sradm=ldap_search($this->ds,"ou=Profesores,cn=Users,dc=duoc, dc=cl", "uid=".$user);
			       	$info = ldap_get_entries($this->ds, $sradm);
			       	if($r){
			       		for ($i=0; $i<$info["count"]; $i++){
							$rutcon=$info[0]["rut"][0];
							$rut=substr($rutcon,0,strpos ($rutcon, '-'));
							ldap_close($this->ds);
							$ldap_response = array(
								'tipo' => 'docente', #docente o alumno
								'rut' => $rut,#rut sin digito verificador
								'status' => 'success', #success o error
								'mensaje' => 'ok' #ok o mensaje de error
							);
			           }
			       	}
				}else{
					#error final
					$ldap_response = array(
						'tipo' => null, #docente o alumno
						'rut' => null,#rut sin digito verificador
						'status' => 'error', #success o error
						'mensaje' => 'Usuario o contraseña incorrectos' #ok o mensaje de error
					);	
				}
			}
		}catch(Exception $e){
			$ldap_response = array(
				'tipo' => null, #docente o alumno
				'rut' => null,#rut sin digito verificador
				'status' => 'error', #success o error
				'mensaje' => 'Hubo un error en la conexión, favor intente más tarde' #ok o mensaje de error
			);
		}
	return $ldap_response;*/
	
	
	$ldap_response = array(
			'username' => $user,
			'status' => 'success',
			'mensaje' => 'ok'
		);
	    return $ldap_response;
	}
}
?>


<?php
/*
if ($_POST['boton'] == "Conectar")
{
    $user=$_POST['usuario'];
    $pass=$_POST['clave'];
    $ds=ldap_connect("santiago.duoc.cl",389);
    if ($ds)
    {
       	
       	if ($pass==""){
       		$r="0";
        	ldap_close($ds);
       }
       if($r)
       {
           	
       }
       else
       {
                               $msg="Nombre de usuario o clave erronea";
       }
    }
    else
    {
                           $msg="No Existe una Conexión Valida";
    }
}
*/
?>