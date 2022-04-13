<?php

    require_once "Config.php";

    spl_autoload_register(function($clase){
        require_once "$clase.php";
    });

    $db= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);
    
    $table=$db->read();

    $tinfo="";

    foreach($table as $item) {
        $tinfo.=
        "<tr>
            <td>".$item[1]."</td>
            <td>".$item[2]."</td>
            <td>".$item[3]."</td>
            <td>".$item[4]."</td>
            <td>".$item[5]."</td>
            <td><form id='modificar_".$item[0]."' action='cru.php' method='post'><input type='hidden' name='act' value='3:0,".$item[0]."' ><input type='button' value='modificar' onclick='modificar(".$item[0].")'></form></td>
            <td><form id='eliminar_".$item[0]."' action='cru.php' method='post'><input type='hidden' name='act' value='4:0,".$item[0]."' ><input type='button' value='Eliminar' onclick='eliminar(".$item[0].")'></form></td>
        </tr>";    
    }
    

?>
<html>

<h2>Lista de empleados</h2>
		<table border="1" id="reg">
			<tr>
				<td>Nombre</td>
				<td>Email</td>
				<td>Sexo</td>
				<td>Area</td>
				<td>Boletin</td>
				<td>Modificar</td>
				<td>Eliminar</td>
			</tr>
            <?php echo $tinfo; ?>
		</table>
</html>