<?php
require_once "../db_connection/connection.php"; // clase conexion
require_once "../clases/cliente.php"; // clase cliente para validar la sesion
class tipoContacto extends connection {
    private $idTipoContacto;
	private $descripcionTipoC; // descripcion tipo contacto
	 

    function getIdTipoContacto() {
        return $this->idTipoContacto;
    }

    function getDescripcionTipoC() {
        return $this->descripcionTipoC;
    }

    function setIdTipoContacto($idTipoContacto) {
        $this->idTipoContacto = $idTipoContacto;
    }

    function setDescripcionTipoC($descripcionTipoC) {
        $this->descripcionTipoC = $descripcionTipoC;
	}
	
	// tipoC = tipo Contacto
    public function RegistroTipoC(){
		
		//*Método para la reaización del registro de datos de usuario en el sistema y BD
		try{
			//*Se establece la conexión con la BD
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$correo = "vi@vi.co";
			//*Se prepara la consulta
			$stmt=$conn->prepare("call insertaTipoContacto (?, ?,
				@out_value)");//*Representa el valor output
				
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('ss', $this->getDescripcionTipoC(), $correo);
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

	// funcion de cargar las tablas para el mantenedor Tipo contacto
	public function cargarTablaTipoC(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call listarTipoContacto()');
			//*Se pasan los parámetros a la consulta
			// $stmt->bind_param('s', $this->getCorreo());
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idTipoContacto, $descripcionTipoC);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"idTipoC"=>$idTipoContacto, // TipoC abreviatura de tipo Contacto
						"descripcionTipoC"=>$descripcionTipoC,
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

	public function eliminarTipoContacto($id){
		$db = connection::getInstance();
		$conn = $db->getConnection();		
		$stmt=$conn->prepare("call eliminarTipoContacto (?,
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

	public function cargaTipoC($id){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call  CargaModalTipoC(?)');
			//*Se pasan los parámetros a la consulta
			 $stmt->bind_param('i', $id);
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idTipoContacto, $descripcionTipoContacto);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"id"=>$idTipoContacto,
						"descripcionTipoC"=>$descripcionTipoContacto,
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

	public function ActualizarTipoC(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call actualizaTipoContacto(
				?, ?, @out_value)');
			$stmt->bind_param('is', $this->getIdTipoContacto(), $this->getDescripcionTipoC());
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
	// carga el combo box tipo contacto
	public function cargaComboTipoContacto(){
		try{
            $db = connection::getInstance();
            $conn = $db->getConnection();
            //*Se prepara el procedimiento almacenado
            $stmt=$conn->prepare('select * from tipocontacto');
            //* Se ejecuta
            $stmt->execute();
            //* Resultados obtenidos de la consulta
            $stmt->bind_result($idTipoContacto, $descripcionTipoContacto);
            $datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
                        "idTipoContacto"=>$idTipoContacto,
                        "descripcionTipoC"=>$descripcionTipoContacto
					);
				}
				
                return json_encode($datos, JSON_UNESCAPED_UNICODE);
                $stmt->free_result();
        }catch(Exception $error){
            echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
        }
    }
}