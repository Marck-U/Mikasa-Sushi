<?php

class  Input {
    static $errors = true;
    private $state;

	//*Valida que los campos no estén vacíos
	static function check($arr, $on = false) {
		if ($on === false) {
			$on = $_REQUEST;
		}
		foreach ($arr as $value) {	
			if (empty($on[$value])) {
                self::throwError('Data is missing', 900);
                return false;
                break;
			}else{
                return true;
            }
        }
	}

	//*Valida que el dato obtenido sea del tipo numérico y el valor máximo y mínimo
	static function int($val, $max, $min) {
		$val = filter_var($val, FILTER_VALIDATE_INT);
		if ($val === false || $val >= $max || $val <= $min) {
			self::throwError('Invalid Integer', 901);
		}
		return $val;
	}

	//*Valida que el dato obtenido sea de tipo string y cantidad de parámetros
	static function str($val, $maxLength, $minLength) {
		if (!is_string($val) || strlen(trim($val)) > $maxLength || strlen(trim($val)) < $minLength) {
			self::throwError('Invalid String', 902);
		}
		$val = trim(htmlspecialchars($val));
		return $val;
	}

	//*Valida campos bolean
	static function bool($val) {
		$val = filter_var($val, FILTER_VALIDATE_BOOLEAN);
		return $val;
	}

	//*Valida que el campo tenga formato de correo
	static function email($val) {
		$val = filter_var($val, FILTER_VALIDATE_EMAIL);
		if ($val === false) {
			self::throwError('Invalid Email', 903);
		}
		return $val;
	}

	//*Valida el campo password y su longitud
	static function pass($val, $maxLength, $minLength) {
		// $val = filter_var($val, FILTER_VALIDATE_STRING);
		if ($val === false || strlen(trim($val)) > $maxLength || strlen(trim($val)) < $minLength) {
			self::throwError('Invalid Password', 904);
		}
		return $val;
	}

	static function url($val) {
		$val = filter_var($val, FILTER_VALIDATE_URL);
		if ($val === false) {
			self::throwError('Invalid URL', 905);
		}
		return $val;
	}

	//*Obtiene el error arrojado y lo imprime en consola
	static function throwError($error = 'Error In Processing', $errorCode = 0) {
		if (self::$errors === true) {
			throw new Exception($error, $errorCode);
		}
	}
}