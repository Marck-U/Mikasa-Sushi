<?php

//*Bd = Base de datos

require_once "../db_connection/connection.php"; //*Se requiere a la clase conexión

class Cliente extends connection{ //*Se hereda la clase de conexión
	private $idCliente;
    private $nombre;
    private $apellidos;
    private $idEstado;
    private $idSexo;
    private $correo;
    private $password;
	private $telefono;
	private $codRecuperacion;

    // public function __construct(){
    //     // $this->connect();
    // }

    public function getIdCliente(){
		return $this->idCliente;
	}

	public function setIdCliente($idCliente){
		$this->idCliente = $idCliente;
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

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	public function getTelefono(){
		return $this->telefono;
	}

	public function setTelefono($telefono){
		$this->telefono = $telefono;
    }
	
	public function getCodRecuperacion(){
		return $this->codRecuperacion;
	}

	public function setCodRecuperacion($codigo){
		$this->codRecuperacion = $codigo;
	}

	public function randomCode(){
		$caracteres = 'abcdefghijklmnopqrstuvwxyz0123456789'; //* Caracteres posibles
		$code = '';
		$max = strlen($caracteres) - 1;
		for ($i = 0; $i < 7; $i++) {
			 $code .= $caracteres[mt_rand(0, $max)];
			}
		return $code;
	}

    public function registro(){
		//*Método para la reaización del registro de datos de usuario en el sistema y BD
		try{
			//*Se establece la conexión con la BD
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$codRestauracionHash = $this->randomCode();
			$estado = 1; //* El estado es 1 por defecto
			// !Falta generar el cod de restauracion
			//*Se encripta la contraseña para ser almacenada en la BD
			$password_hash = password_hash($this->getPassword(), PASSWORD_DEFAULT, ['cost'=>12]);
			//*Se prepara la consulta
			$stmt=$conn->prepare("call registroCliente (
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				@out_value)");//*Representa el valor output
				
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('ssissss', $this->getNombre(), $this->getApellidos(), $estado, $this->getCorreo(), $password_hash, $this->getTelefono(), $codRestauracionHash);
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
	
	public function login(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare("call loginCliente(?,
			@out_value)");
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('s', $this->getCorreo());
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($result);
			//*Se comprueba la respuesta
			if($stmt->fetch()>0){
				if($result != 'error'){
					$passHash = $result;
					if(password_verify($this->getPassword(), $passHash)){
						return 1; //*Login exitoso
					}else {
						return 2; //*Login erróneo
					}
				}else{
					return 2; //*Login erróneo
				}
			}
			//*Se libera la respuesta en BD
			$stmt->free_result();
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}
	public function cargarDatosPerfil(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call obtenerDatosEditarPerfil(?,
			@out_value)');
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('s', $this->getCorreo());
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($name, $apellidos, $correo, $telefono);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"Nombre"=>$name,
						"Apellidos"=>$apellidos,
						"Correo"=>$correo,
						"Telefono"=>$telefono
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

	public function actualizarDatosPerfil(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call actualizarPerfil (?, ?, ?, ?, @out_value)');
			$stmt->bind_param('ssss', $this->getNombre(), $this->getApellidos(),  $this->getCorreo(), $this->getTelefono());
			$stmt->execute();
			$stmt->bind_result($result);
			if($stmt->fetch()>0){
				echo $result;
			}else{
				echo '2';
			}
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}

	public function confirmarPass(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call loginCliente (?, @out_value)');
			//*Se reutiliza el procedimiento para obtener la password
			$stmt->bind_param('s', $this->getCorreo());
			$stmt->execute();
			$stmt->bind_result($result);
			if($stmt->fetch()>0){
				if ($result == 'error') {
					echo '1';
				}else{
					$passHash = $result;
					if(password_verify($this->getPassword(), $passHash)){
						echo '1'; //*Si coincide
					}else {
						echo '2';
					}
				}
			}else{
				echo '2';
			}
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}

	public function cambiarPass(){
		try{
			$password_ = password_hash($this->getPassword(), PASSWORD_DEFAULT, ['cost'=>12]);
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call actualizarPassCliente (?, ?, @out_value)');
			$stmt->bind_param('ss', $password_, $this->getCorreo());
			$stmt->execute();
			$stmt->bind_result($result);
			if($stmt->fetch()>0){
				echo $result;
			}else{
				echo '2';
			}
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}

	public function cargarTabla(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call listarClientes2()');
			//*Se pasan los parámetros a la consulta
			// $stmt->bind_param('s', $this->getCorreo());
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idCliente, $nombre, $apellidos, $correo, $telefono, $estado);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"idCliente"=>$idCliente,
						"Nombre"=>$nombre,
						"Apellidos"=>$apellidos,
						"Correo"=>$correo,
						"Telefono"=>$telefono,
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

	public function IngresaCliente(){
		try{
			//*Se establece la conexión con la BD
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$codRestauracionHash = $this->randomCode();
			$estado = 1; //* El estado es 1 por defecto
			// !Falta generar el cod de restauracion
			$telefono = 'NULL';
			//*Se encripta la contraseña para ser almacenada en la BD
			$password_hash = password_hash($this->getPassword(), PASSWORD_DEFAULT, ['cost'=>12]);
			//*Se prepara la consulta
			$stmt=$conn->prepare("call registroCliente (
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				@out_value)");//*Representa el valor output
				
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('ssissss', $this->getNombre(), $this->getApellidos(), $estado, $this->getCorreo(), $password_hash, $telefono, $codRestauracionHash);
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

	public function cargaCliente($id){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call  CargaModal(?)');
			//*Se pasan los parámetros a la consulta
			 $stmt->bind_param('i', $id);
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idCliente, $nombre, $apellidos, $correo, $idEstado ,$telefono);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"id"=>$idCliente,
						"Nombre"=>$nombre,
						"Apellidos"=>$apellidos,
						"Correo"=>$correo,
						"idEstado"=>$idEstado,
						"Telefono"=>$telefono
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

	public function eliminaCliente($id){
		$db = connection::getInstance();
		$conn = $db->getConnection();		
		$stmt=$conn->prepare("call eliminarCliente(
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

	public function ActualizarCliente(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call actualizaCliente(
				?, ?, ?, ?, ?, ?, @out_value)');
			$stmt->bind_param('issssi', $this->getIdCliente(), $this->getNombre(), $this->getApellidos(),  $this->getCorreo(), $this->getTelefono(), $this->getIdEstado());
			$stmt->execute();
			$stmt->bind_result($result);
			if($stmt->fetch()>=0){
				echo $result;
			}else{
				// echo $result;
				echo "<script>alert($result);</script>";
			}
		}catch(Exception $error){
			echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
		}
	}



}