<?php

class infoContacto {
    private $idContacto;
    private $descripcionContacto;
    private $idTipoContacto;
    function getIdContacto() {
        return $this->idContacto;
    }

    function getDescripcionContacto() {
        return $this->descripcionContacto;
    }

    function getIdTipoContacto() {
        return $this->idTipoContacto;
    }

    function setIdContacto($idContacto) {
        $this->idContacto = $idContacto;
    }

    function setDescripcionContacto($descripcionContacto) {
        $this->descripcionContacto = $descripcionContacto;
    }

    function setIdTipoContacto($idTipoContacto) {
        $this->idTipoContacto = $idTipoContacto;
    }
    
    public function  IngresaInfoContacto(){
		//*Método para la reaización del registro de datos de usuario en el sistema y BD
		try{
			//*Se establece la conexión con la BD
			$db = connection::getInstance();
			$conn = $db->getConnection();
			//*Se encripta la contraseña para ser almacenada en la BD
			//*Se prepara la consulta
			$stmt=$conn->prepare("call insertaInfoContacto  (
				?,
				?,@out_value)");//*Representa el valor output
				
			//*Se pasan los parámetros a la consulta
			$stmt->bind_param('si', $this->getDescripcionContacto(), $this->getIdTipoContacto());
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


	public function cargaTablaInfoContacto(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call listarInfoContacto()');
			//*Se pasan los parámetros a la consulta
			// $stmt->bind_param('s', $this->getCorreo());
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idContacto, $descripcionContacto,$descripcionTipoC);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"idContacto"=>$idContacto,
						"descripcionContacto"=>$descripcionContacto,
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

	public function cargaModalInfoContacto($id){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call  CargaModalInfoContacto(?)');
			//*Se pasan los parámetros a la consulta
			 $stmt->bind_param('i', $id);
			//*Se ejecuta la consulta en BD
			$stmt->execute();
			//*Se obtiene el resultado
			$stmt->bind_result($idContacto, $descripcionContacto,$descripcionTipoC);
			$datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
						"idContacto"=>$idContacto,
						"descripcionContacto"=>$descripcionContacto,
						"descripcionTipoC"=>$descripcionTipoC,
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

	public function eliminarInfoContacto($id){
		$db = connection::getInstance();
		$conn = $db->getConnection();		
		$stmt=$conn->prepare("call eliminarInfoContacto(
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

	public function ActualizaInfoContacto(){
		try{
			$db = connection::getInstance();
			$conn = $db->getConnection();
			$stmt=$conn->prepare('call actualizaContacto2(
				?, ?, ?, @out_value)');
			$stmt->bind_param('isi',$this->getIdContacto(), $this->getDescripcionContacto(), $this->getIdTipoContacto());
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
