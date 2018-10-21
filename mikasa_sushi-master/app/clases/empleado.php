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
	
	public function IngresaEmpleado(){
		try{
			//*Se establece la conexión con la BD
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$estado = 1; //* El estado es 1 por defecto
			$email = $this->getCorreo();
			//*Se encripta la contraseña para ser almacenada en la BD
			$password_hash = password_hash($this->getPassword(), PASSWORD_DEFAULT, ['cost'=>12]);
			//*Se prepara la consulta
			$stmt=$conn->prepare("call registroEmpleado (?,
				?,
				?,
				?,
				?,
				?,
				?,
				@out_value)");//*Representa el valor output
				
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('isissss',$this->getIdTipoEmpleado(), $password_hash, $estado, $this->getCorreo(), $this->getNombre(), $this->getApellidos(), $email);
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($result);

			//*Se comprueba la respuesta
				if($stmt->fetch()>0){
					return $result;
				}else{
					return 'Ha ocurrido un error';
				}
			
			//*Se libera la respuesta en BD
			$stmt->free_result();

		}catch (Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}
	
	public function cargarTablaEmpleados(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			// $email = $this->getCorreo();
			$stmt=$conn->prepare('call listarEmpleado()');
			//*Se pasan los parámetros a la consulta
			// $stmt->bind_param('s', $this->getCorreo());
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idEmpleado, $nombre, $apellidos, $correo, $idTipoEmpleado, $estado);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"idEmpleado"=>$idEmpleado,
						"Nombre"=>$nombre,
						"Apellidos"=>$apellidos,
						"Correo"=>$correo,
						"TipoEmpleado"=>$idTipoEmpleado,
						"Estado"=> $estado
					);
				}
				return json_encode($datos);
			// }else{
				// return 'error';
			// }
			$stmt->free_result();
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}

	// esta funcion obtiene el id de la tabla para luego actualizar el estado del  empleado
	public function eliminaEmpleado($id){
		$db = connection::getInstance();
		$conn = $db->getConnection();		
		$stmt=$conn->prepare("call eliminarEmpleado(
			?,
			@out_value)");//*Representa el valor output
			
		//*Se pasan los parámetros a la consulta
		$stmt->bind_param('i', $id);
		//*Se ejecuta la consulta en BD
		$stmt->execute();
		//*Se obtiene el resultado
		$stmt->bind_result($result);
		//*Se comprueba la respuesta
			if($stmt->fetch()>0){
				return $result;
			}else{
				return 'Ha ocurrido un error';
			}
		
		//*Se libera la respuesta en BD
		$stmt->free_result();
	}

	public function cargaCliente($id){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			// el procedimiento nos devuelve los datos del cliente para luego cargarlos al modal
			$stmt=$conn->prepare('call  CargaModalEmpleado(?)');
			//*Se pasan los parámetros a la consulta
			 $stmt->bind_param('i', $id);
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idEmpleado, $nombre, $apellidos, $correo, $idEstado ,$idTipoEmpleado);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"id"=>$idEmpleado,
						"Nombre"=>$nombre,
						"Apellidos"=>$apellidos,
						"Correo"=>$correo,
						"idEstado"=>$idEstado,
						"idTipoEmpleado"=>$idTipoEmpleado
					);
					return json_encode($datos);
				}
			// }else{
				// return 'error';
			// }
			$stmt->free_result();
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}
	public function ActualizaEmpleado(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call actualizaEmpleado(
				?, ?, ?, ?, ?, ?, @out_value)');
			$stmt->bind_param('isssii', $this->getIdEmpleado(), $this->getNombre(), $this->getApellidos(),  $this->getCorreo(), $this->getIdEstado(), $this->getIdTipoEmpleado());
			$stmt->execute();
			$stmt->bind_result($result);
			if($stmt->fetch()>=0){
				echo $result;
			}else{
				// echo $result;
				// echo "<script>alert($result);</script>";
			}
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}

	
}