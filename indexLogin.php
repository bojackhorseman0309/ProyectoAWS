<?php

	require_once 'php/config_bd.php';
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

		<!-- Datatables info -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">

		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js "></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/rowreorder/1.2.5/js/dataTables.rowReorder.min.js"></script>

		<!-- nuestros estilos-->
		<link rel="stylesheet" type="text/css" href="css/estilosLogin.css">

		<!-- font awesome library -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>

	<body>

		<!-- Navbar de la pagina -->
		<div id="navbar">
			<nav class="navbar navbar-expand-md navbar-light">
				<a class="navbar-brand" href="#"><img src="imagenes/logo.png" id="logo_img"></a>

				<!-- boton para colapsar navbar-->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#links">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- links del navbar -->
				<div class="collapse navbar-collapse" id="links">
					<ul class="navbar-nav">
						<li><a class="nav-link" href="#nosotros">Nosotros</a></li>
						<li><a class="nav-link" href="#contacto">Contáctenos</a></li>
					</ul>
					<ul class="navbar-nav ml-auto">
						<li><a class="nav-link" href="ajustes.php">Ajustes</a></li>
						<li><button type="button" class="btn btn-link" onclick="cerrarSesion('cerrarSesion')">Salir</button></li>
					</ul>
				</div>
			</nav> 	
		</div>

		<div class="container-fluid">

			<!-- ordenar -->
			<div id="ordenar"></div>
			<div class="informacion">
				<div class="table-title" id="titulo">
					<div class="row">
						<div class="col-xs-8 col-sm-8">
							<h2 class="pull-left">Hola, <?php echo $_SESSION['nombre'] ?> </h2>
						</div>
						<div class="col-xs-4 col-sm-4">
							<button type="submit" class="btn btn-outline-success pull-right" id="OrdenarPizza" data-toggle="modal" data-target="#OrdenarPizzaModal">Ordenar pizza</button>
						</div>
					</div>
				</div>				
				<div>
					<table class="table table-hover dt-responsive nowrap" style="width:100%" id="tabla_pedidos">
						<thead>
							<th>Factura #</th>
							<th>Fecha y hora de compra</th>
							<th>Descripcion</th>
							<th>Total</th>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>


			<!-- nosotros -->
			<div id="nosotros"></div>
			<div class="informacion">
				<h3>&#x1F1E8;&#x1F1F7; Nuestra historia &#x1F1E8;&#x1F1F7;</h3>
				<p>
					Somos una pizzería 100% costarricense que empezó en las aulas de la Universidad Fidélitas. <br />
					4 estudiantes decidieron emprender en una pizzería después de graduarse como administradores de negocios e ingenieros industriales, creando Pizza HoTML.
					Siempre con los vegetales más frescos, la mejor carne del mercado, la salsa natural y el clásico pan de pizza artesanal hecho a mano por nuestros artesanos le
					darán a usted la mejor pizza que haya probado.
				</p>
			</div>
			
			<!-- contactenos -->
			<div id="contacto"></div>
			<div class="informacion">
				<h3>¡Contáctenos!</h3>
				<p>Escribanos al correo electronico pizza@hotml.com o llámenos al 2345-6789.</p>
				<hr id="separacion"/>
				<h5>Síganos en nuestras redes</h5>
				<div id="redes_sociales" style="text-align: center; font-size: 20px">
					<a href="#" class="fa fa-facebook"></a>
					<a href="#" class="fa fa-google-plus"></a>
					<a href="#" class="fa fa-instagram"></a>
					<a href="#" class="fa fa-snapchat"></a>
					<a href="#" class="fa fa-twitter"></a>
					<a href="#" class="fa fa-pinterest"></a>
				</div>
			</div>
		</div>

		<hr/>

		<!-- pie de pagina -->
		<footer>
			<p style="text-align: center">Diseño y desarrollo por AWS Proyecto &copy; 2018</p>
		</footer>

		<!-- Modal para prdenar pizza -->
		<div class="modal fade bg-dark" id="OrdenarPizzaModal" tabindex="-1" role="dialog" aria-labelledby="OrdenarPizzaModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title text-dark">Ordenar Pizza</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div id="resultados"></div>
						<div class="form-group">
                   			<label for="carne">Carnes: </label>
                  		  	<select class="form-control" id="carne" name="carne" required>
                      	  		<?php
	                            	$datos = mysqli_query($conn, "SELECT tipo_carne FROM tipo_carnes;");
	                                while($fila = mysqli_fetch_array($datos)){
	                        			echo "<option>" . $fila['tipo_carne']. "</option>";
                           			}
                    	    	?>
                  		  	</select>
						</div>
						<div class="form-group">
                   			<label for="masa">Masa: </label>
                  		  	<select class="form-control" id="masa" name="masa" required>
                      	  		<?php
	                            	$datos = mysqli_query($conn, "SELECT tipo_masa FROM tipo_masas;");
	                                while($fila = mysqli_fetch_array($datos)){
	                               		echo "<option>" . $fila['tipo_masa']. "</option>";
                           			}
                    	    	?>
                  		  	</select>
						</div>
						<div class="form-group">
                   			<label for="vegetal">Vegetales:</label>
                  		  	<select class="form-control" id="vegetal" name="vegetal" required>
                      	  		<?php
	                            	$datos = mysqli_query($conn, "SELECT tipo_vegetales FROM tipos_vegetales;");
	                                while($fila = mysqli_fetch_array($datos)){
	                               		echo "<option>" . $fila['tipo_vegetales']. "</option>";
                           			}
                    	    	?>
                  		  	</select>
						</div>
						<div class="form-group">
                   			<label for="tamanho">Tamaño de la Pizza:</label>
                  		  	<select class="form-control" id="tamanho" name="tamanho" required>
                      	  		<?php
	                            	$datos = mysqli_query($conn, "SELECT tamanho FROM tamanho_pizza;");
	                                while($fila = mysqli_fetch_array($datos)){
	                               		echo "<option>" . $fila['tamanho']. "</option>";
                           			}
                    	    	?>
                  		  	</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
						<button type="button" class="btn btn-success" onclick="ordenarPizza('ordenarPizza')">Ordenar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal para informacion -->
		<div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="modalSuccess" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-dark">¡Pizza ordenada satisfactoriamente!</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<b>¡Gracias por su compra!</b>
					</div>
				</div>
			</div>
		</div>

		<!-- javascript nuestro -->
		<script src="javascript/js.js"></script>
		
	</body>
</html>
