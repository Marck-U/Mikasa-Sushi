insert INTO empleado VALUES ((select COUNT(idEmpleado)+1 from empleado as id), _idTipoEmpleado, _password,idEstado,_correo, _nombre, _apellidos);

BEGIN
	IF EXISTS (select idEmpleado from empleado where correo = _correo) THEN
	BEGIN
    	set result = 1;
        select result as result;
        END;
    ELSE
    BEGIN
    	insert INTO infocontacto VALUES ((select MAX(idContacto)+1 from infocontacto as id), _descripcionContacto, _idTipoContacto);
        set result = 2;
        SELECT result as result;
        END;
    END IF;
    END