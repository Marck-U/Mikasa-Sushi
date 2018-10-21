<?php

require_once '../db_connection/connection.php';
class tipoEmpleado extends connection{
    private $idEstado;
    private $estado;

    public function getIdTipoEmp(){
		return $this->idEstado;
	}

	public function setIdTipoEmp($idTipoEmp){
		$this->idTipoEmp = $idTipoEmp;
	}

	public function getTipoEmpleado(){
		return $this->TipoEmpleado;
	}

	public function setTipoEmpleado($TipoEmpleado){
		$this->TipoEmpleado = $TipoEmpleado;
    }

    public function comboboxTipoEmpleado(){
        try{
            $db = connection::getInstance();
            $conn = $db->getConnection();
            //*Se prepara el procedimiento almacenado
            $stmt=$conn->prepare('select * from tipoempleado');
            //* Se ejecuta
            $stmt->execute();
            //* Resultados obtenidos de la consulta
            $stmt->bind_result($idTipoEmp, $TipoEmpleado);
            $datos = array();
			// if($stmt->fetch()>0){
				while($stmt->fetch()){
					$datos[]=array(
                        "idTipoEmp"=>$idTipoEmp,
                        "TipoEmpleado"=>$TipoEmpleado
					);
				}
                return json_encode($datos, JSON_UNESCAPED_UNICODE);
                $stmt->free_result();
        }catch(Exception $error){
            echo 'Ha ocurrido una excepción: ', $error->getMessage(), "\n";
        }
    }
}