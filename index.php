<?php

	$sel="<select name='area' id='area' required>
	<option value=''>-</option> 
	<option value='1'>Administracion</option> 
	<option value='2'>Sistemas</option> 
	<option value='3'>Gerencia</option> 
	</select>";

	$radio="<input type='radio' name='sexo' id='sexo' value='M' required />Masculino<br/>
	<input type='radio' name='sexo' id='sexo' value='F'/>Femenino";
	
	$cha="";
	$chb="";
	$chc="";

  	if(isset($_REQUEST['search'])){

		$idem=$_REQUEST['search'];

		require_once "Config.php";

		spl_autoload_register(function($clase){
			require_once "$clase.php";
		});

		$db= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

		$table=$db->data_modify($idem);

		switch ($table[0][0][3]) {
			case 'F':
				$radio="<input type='radio' name='sexo' id='sexo' value='M' required />Masculino<br/>
				<input type='radio' name='sexo' id='sexo' value='F' checked />Femenino";
				break;
			case 'M':
				$radio="<input type='radio' name='sexo' id='sexo' value='M' checked required />Masculino<br/>
				<input type='radio' name='sexo' id='sexo' value='F'/>Femenino";
				break;
		}	

		switch ($table[0][0][4]) {
			case 1:
				$sel="<select name='area' id='area' required>
							<option value=''>-</option> 
							<option value='1' selected>Administracion</option> 
							<option value='2'>Sistemas</option> 
							<option value='3'>Gerencia</option> 
						</select>";
				break;
			case 2:
				$sel="<select name='area' id='area' required>
							<option value=''>-</option> 
							<option value='1'>Administracion</option> 
							<option value='2' selected>Sistemas</option> 
							<option value='3'>Gerencia</option> 
						</select>";
				break;
			case 3:
				$sel="<select name='area' id='area' required>
							<option value=''>-</option> 
							<option value='1'>Administracion</option> 
							<option value='2'>Sistemas</option> 
							<option value='3' selected>Gerencia</option> 
						</select>";
				break;
		}		
		
		$idrol="";

		if(isset($table[1][0][0])){
			$idrol=$table[1][0][0];
			switch ($idrol) {
				case 1:
					$cha="checked";
					break;
				case 2:
					$chb="checked";
					break;
				case 3:
					$chc="checked";
					break;
			}	
		}

		if(isset($table[1][1][0])){
			$idrol=$table[1][1][0];
			switch ($idrol) {
				case 1:
					$cha="checked";
					break;
				case 2:
					$chb="checked";
					break;
				case 3:
					$chc="checked";
					break;
			}
		}

		if(isset($table[1][2][0])){
			$idrol=$table[1][2][0];
			switch ($idrol) {
				case 1:
					$cha="checked";
					break;
				case 2:
					$chb="checked";
					break;
				case 3:
					$chc="checked";
					break;
			}
		}
  	}

	  $chkrol="<input type='checkbox' name='check' id='check' value='1' $cha />Profesional de proyectos - Desarrollador<br/>
	  <input type='checkbox' name='check' id='check' value='2' $chb /> Gerente estrat&eacute;gico<br/>
	  <input type='checkbox' name='check' id='check' value='3' $chc />Auxiliar administrativo<br/>";  

	if(isset($_REQUEST['popms'])){
	  
	  switch ($_REQUEST['popms']) {
		case 1:
				echo '<script language="javascript">';
                echo 'alert("Empleado Registrado.")';
                echo '</script>';
			break;
		case 2:
				echo '<script language="javascript">';
				echo 'alert("Registro Actualizado.")';
				echo '</script>';
			break;
		case 4:
				echo '<script language="javascript">';
				echo 'alert("Se elimino registro correctamente.")';
				echo '</script>';
			break;
	    }
	  
	}

?>
<html>
	<head>
		<title>Formulario</title> 
		<link rel="stylesheet" href="style.css">
	</head>
	<body onload="setTimeout(hidebox, 3000,'box')">
		<h1>Crear empleado</h1>
		<br>
		<div id="box" class="box">
			<b id="box_title">Los campos con asterisco (*) son obligatorios </b>
		</div>
		<br/>
		<form id="registro" action="cru.php" method="post">
		
			<table id="formulario">
				<tr>
					<td id="table_title"><b>Nombre completo *</b></td>
					<td><input value="<?php if(isset($idem)) echo $table[0][0][1]; ?>" type="text" name="nombre" id="nombre" placeholder="Nombre completo del empleado" required /></td>
				</tr>
				<tr>
					<td id="table_title"><b>Correo electronico *</b></td>
					<td><input value="<?php if(isset($idem)) echo $table[0][0][2]; ?>" type="email" name="email" id="email" placeholder="Correo electronico" required /></div></td>
				</tr>
				<tr>
					<td id="table_title"><b>Sexo *</b></td>
					<td>
						<?php echo $radio; ?>
					</td>
				</tr>
				<tr>
					<td id="table_title">
						<b>Area *</b>
					</td>
					<td>
						<?php echo $sel; ?>
					</td>
				</tr>
				<tr>
					<td id="table_title">
						<b>Descripcion*</b>
					</td>
					<td>
						<textarea name="textarea" id="textarea" rows="7" cols="80" required ><?php if(isset($idem)) echo $table[0][0][6]; ?></textarea>
					</td>
				</tr>
				<tr>
					<td id="table_title">
					</td>
					<td>
						<?php  
							if(isset($idem)){
								if($table[0][0][5]==1){
									echo "<input type='checkbox' name='checkbol' id='checkbol' value='1' checked />Deseo recibir boletin informativo<br/>		";
								}

							}else{
								echo "<input type='checkbox' name='checkbol' id='checkbol' value='1'/>Deseo recibir boletin informativo<br/>		";
							}
						?>
					</td>
				</tr>
				<tr>
					<td id="table_title">
						<b>Roles *</b>
					</td>
					<td>
						<?php  
							echo $chkrol;
						?>	
					</td>
				</tr>
				<tr></tr>
				<tr></tr>
				<tr></tr>
				<tr>
					<td></td>
					<td>
						<?php
							if(isset($idem)){
								echo "<input type='hidden' name='empid' value=".$idem."><input type='button' value='Guardar' onclick='validar(2)'> ";
							}else{
								echo "<input type='button' value='Guardar' onclick='validar()'> ";
							}
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td> 
						<input type="reset"  value="Borrar todo">
					</td>
				</tr>
			</table>
			<input type="hidden" name="act" id="data">
		</form>
		<br><br><br>
		<div>
			<?php include('crud.php') ?>
		</div>
		<script src="script.js"></script>
	</body>
</html>