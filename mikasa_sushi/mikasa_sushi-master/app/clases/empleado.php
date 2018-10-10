<?php

//*BD = Base de datos

require_once '../db_connection/connection.php'; //*Clase conexión BD

class Empleado extends connection{
    private $idEmpleado;
    private $idTipoEmpleado;
    private $password;
    private $idEstado;
    private $correo;
    private $nombre;
    private $apellidos;

    public function getIdEmpleado(){
		return $this->idEmpleado;
	}

	public function setIdEmpleado($idEmpleado){
		$this->idEmpleado = $idEmpleado;
	}

	public function getIdTipoEmpleado(){
		return $this->idTipoEmpleado;
	}

	public function setIdTipoEmpleado($idTipoEmpleado){
		$this->idTipoEmpleado = $idTipoEmpleado;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getIdEstado(){
		return $this->idEstado;
	}

	public function setIdEstado($idEstado){
		$this->idEstado = $idEstado;
	}

	public function getCorreo(){
		return $this->correo;
	}

	public function setCorreo($correo){
		$this->correo = $correo;
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $nombre;
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function setApellidos($apellidos){
		$this->apellidos = $apellidos;
    }
    
    public function login(){
        try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare("call loginEmpleado(?,
			@pass, @tipo)");
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('s', $this->getCorreo());
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtienen los resultado
			$stmt->bind_result($result, $tipoUser);
			//*Se comprueba la respuesta
			if($stmt->fetch()>0){
				if($result != 'error'){
					$passHash = $result;
					if(password_verify($this->getPassword(), $passHash)){
						return $tipoUser; //*Registro exitoso
					}else {
						return 'error'; //*Registro erróneo
					}
				}else{
					return 'error'; //*Registro erróneo
				}
			}
			//*Se libera la respuesta en BD
			$stmt->free_result();
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
    }
}