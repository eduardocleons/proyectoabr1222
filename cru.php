<?php

	require_once "Config.php";

	spl_autoload_register(function($clase){
		require_once "$clase.php";
	});

    $data    = $_REQUEST['act'];
    

    $datar = explode(":", $data);

    $rol   = explode(",", $datar[1]);

	$db= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);


    switch ($datar[0]) {
        case 1:

            $func    = $_REQUEST['act'];
            $nombre  = $_REQUEST['nombre'];
            $correo  = $_REQUEST['email'];
            $sexo    = $_REQUEST['sexo'];
            $area    = $_REQUEST['area'];
            $desc    = $_REQUEST['textarea'];
            $boletin = $_REQUEST['checkbol'];

            $validarUsuario= $db->validarDatos("email","empleados",$correo);
            if($validarUsuario>0){
                echo "Usuario ya registrado, ingrese otros datos. <a href='index.html'>Regresar</a>";
            }else{

                $db->preparar("INSERT INTO empleados (nombre, email, sexo, area_id, boletin, descripcion) VALUES ('$nombre','$correo', '$sexo','$area', '$boletin','$desc');");
                    
                $db->ejecutar();

                $db->liberar();

                $z=sizeof($rol);
                $z=$z-1;

                for ($i = 1; $i <= $z; $i++) {
                    $db->preparar("INSERT INTO empleado_rol VALUES ((SELECT max(id) FROM empleados),'$rol[$i]')");
                    
                    $db->ejecutar();

                    $db->liberar();
                }

                header("Location:index.php?popms=1");

            }

            break;
        case 2:
            $idemp   = isset($_REQUEST['empid']) ? $_REQUEST['empid'] : "";
            $func    = isset($_REQUEST['act']) ? $_REQUEST['act'] : "";
            $nombre  = isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : "";
            $correo  = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
            $sexo    = isset($_REQUEST['sexo']) ? $_REQUEST['sexo'] : "";
            $area    = isset($_REQUEST['area']) ? $_REQUEST['area'] : "";
            $desc    = isset($_REQUEST['textarea']) ? $_REQUEST['textarea'] : "";
            $boletin = isset($_REQUEST['checkbol']) ? $_REQUEST['checkbol'] : "null";

            $db->preparar("DELETE FROM empleado_rol WHERE empleado_id='$idemp';");        
            $db->ejecutar();
            $db->liberar();

            $db->preparar("UPDATE empleados
            SET nombre  = '$nombre',
            email       = '$correo',
            sexo        = '$sexo',
            area_id     = $area,
            boletin     = $boletin,
            descripcion = '$desc'
            WHERE id    = $idemp;");
                    
            $db->ejecutar();

            $db->liberar();

            $z=sizeof($rol);
            $z=$z-1;

            for ($i = 1; $i <= $z; $i++) {
                $db->preparar("INSERT INTO empleado_rol VALUES ((SELECT max(id) FROM empleados),'$rol[$i]')");
                    
                $db->ejecutar();

                $db->liberar();
            }

            header("Location:index.php?popms=2");

            break;    
        case 3:
            //echo $rol[1];
            header("Location:index.php?search=".$rol[1]);
            break;
        case 4:
            $db->preparar("DELETE FROM empleados WHERE id='$rol[1]';");        
            $db->ejecutar();
            $db->liberar();
            $db->preparar("DELETE FROM empleado_rol WHERE empleado_id='$rol[1]';");        
            $db->ejecutar();
            $db->liberar();
            
            header("Location:index.php?popms=4");
            break;    
    }

    $db->cerrar();

?>
