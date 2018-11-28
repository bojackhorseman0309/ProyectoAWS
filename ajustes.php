<?php
    // iniciar la sesion
    session_start();
    // Si aun no hay sesion significa que el usuario no ha hecho login, redireccionar a login
    if(!isset($_SESSION['id_usuario']) || empty($_SESSION['id_usuario'])){
      header("location: index.html");
      exit;
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Pizza HoTML</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="HTML, CSS, JavaScript">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

		<!-- bootstrap scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

		<!-- Google fonts -->
		<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet"> 

		<!-- nuestros estilos-->
		<link rel="stylesheet" type="text/css" href="css/estilosPerfil.css">

		<!-- font awesome library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>
        
		<!-- Navbar de la pagina -->
		<div id="navbar">
			<nav class="navbar navbar-expand-md navbar-light">
				<a class="navbar-brand" href="indexLogin.php"><img src="imagenes/logo.png" id="logo_img"></a>

				<!-- boton para colapsar navbar-->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#links">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- links del navbar -->
				<div class="collapse navbar-collapse" id="links">
					<ul class="navbar-nav">
						<li><a class="nav-link" href="indexLogin.php">Volver a inicio</a></li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li><button type="button" class="btn btn-link" onclick="cerrarSesion('cerrarSesion')">Salir</button></li>
					</ul>
				</div>
			</nav> 	
		</div>

        <!-- contenido principal --> 
		<div class="container">
            <div class="informacion">
				<div class="table-title" id="titulo">
                    <h2 class="centrado">Ajustes</h2>
                    <hr id="separacion"/>
                    <br/>
                    <div id="resultado"></div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <h4>Cambiar mi correo electrónico:</h4>
                            <p>Si desea cambiar su correo electrónico por favor llene el siguiente espacio</p>
                            <div class="form-group" id="emailDiv">
                                <input autocomplete="off" type="email" class="form-control" id="email" placeholder="Su correo nuevo electrónico" name="email">
                            </div>
                            <div id="errorEmail"></div>
                            <button type="button" class="btn btn-outline-warning pull-right" onclick="cambiarCorreo('cambioCorreo')">Cambiar correo</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <h4>Cambiar mi contraseña:</h4>
                            <p>Por favor llene el siguiente espacio con su nueva contraseña:</p>
                            <div class="form-group" id="pwdDiv">
                                <input autocomplete="off" type="password" class="form-control" id="pwd" placeholder="Su nueva contraseña" name="pwd">
                            </div>
                            <div id="errorPwd"></div>
                            <button type="button" class="btn btn-outline-warning pull-right" onclick="cambiarPwd('cambioPwd')">Cambiar contraseña</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <h4>Eliminar mi cuenta</h4>
                            <p>Al borrar su cuenta todos sus datos serán eliminados de nuestros servidores. Por favor esté seguro de si desea continuar</p>
                            <button type="button" class="btn btn-outline-danger pull-right" data-toggle="modal" data-target="#modalEliminar">
                            Eliminar cuenta
                            </button>
                        </div>
                    </div>
                </div>	
            </div>
        </div>

        <!-- pie de pagina -->
        <hr/>
		<footer>
			<p style="text-align: center">Diseño y desarrollo por AWS Proyecto &copy; 2018</p>
        </footer>
        

        <!-- Modal para eliminar cuenta -->
		<div class="modal fade bg-dark text-white" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminar" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-dark">¿Seguro que desea eliminar su cuenta?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
                        <p style="color: black;">Recuerde que sus datos serán totalmente borrados de nuestros servidores y tendrá que crear una nueva cuenta para pedir sus pizzas.</p>
                    </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-danger" onclick="eliminarCuenta('eliminarCuenta')">Eliminar cuenta</button>
					</div>
				</div>
			</div>
		</div>
        <!-- Fin de modal para eliminar cuenta -->

		<!-- javascript nuestro -->
		<script src="javascript/js.js"></script>
		
	</body>
</html>
