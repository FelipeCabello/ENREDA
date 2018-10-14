<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	session_destroy();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>ENREDA - Felipe</title>
		<style type="text/css">
			body {
				background-color: gray;
				font-family: monospace;

			}
			#container {
				width: 400px;
				height: 350px;
				background: tomato;
				position: relative;
				top: 50%;
				left: 50%;
				margin-left: -203px;
    			margin-top: -178px;
    			border: 3px solid #9E9E9E;
			}
			#formulario {
				margin: 40px;
			}
			input {
				width: 100%;
				margin: 10px 0px;
			    height: 20px;
			}
			#boton {
			    background-color: #FF9800;
			    height: 40px;
			    border: 2px solid #fff;
			}

		</style>
	</head>
	<body>
		<div style="position: absolute; width: 100%; height: 100%">
			<div id="container">
				<div id="formulario">
					<form action="<?=base_url()?>login/registro" method="post">
						<h1>Regístrate</h1>
					    <p>Prueba con "usuario" en ambos campos.</p>
					    <hr>
						Usuario:<br>
						<input type="text" name="usuario" value="usuario">
						<br>
						Contraseña:<br>
						<input type="password" name="password" value="usuario">
						<br><br>
						<input type="submit" value="Log In" id="boton">
					</form> 
				</div>
			</div>
		</div>
	</body>
</html>