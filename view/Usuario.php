<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Admin - Bosque de las Flores</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body>
    <!-- Header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap">
                        <!-- Logo -->
                        <div class="site-logo">
                            <a href="index.php">
                                <img src="../assets/img/logo.png" alt="Logo">
                            </a>
                        </div>
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <ul>
                                <li><a href="../index.php">Inicio</a></li>
                                <li>
                                    <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=== "admin"): ?>
                                        <a href="../controller/mainFlorController.php">Gestionar Tienda</a>
                                    <?php else:?>
                                        <a href="../controller/mainFlorController.php">Tienda</a>
                                    <?php endif;?>
                                </li>
                                <li><a href="../view/about.php">Sobre Nosotros</a></li>
                                <li><a href="../view/contact.php">Contacto</a></li>
                                <li>
									<div class="header-icons">
										<a class="shopping-cart" href="../view/cart.php"><i class="fas fa-shopping-cart"></i></a>
										<?php if (!isset($_SESSION["id"])): ?>
                                            <a class="shopping-cart" href="../view/login.php"><i class="fas fa-user"></i></a>
                                        <?php else: ?>
                                            <a class="shopping-cart" href="../controller/logOutController.php"><img  width="15" src="../assets/img/cerrar-sesion.png" alt=""></a>
                                        <?php endif; ?>

									</div>
								</li>
                            </ul>
                        </nav>
                        <div class="mobile-menu"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!-- Breadcrumb Section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>El Bosque de las Flores</p>
                        <h1>Perfil Administrador</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb Section -->

    <!-- Admin Panel Section -->
    <div class="container mt-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
            <div class="list-group">
                    <a href="../controller/mainFlorController.php" class="list-group-item list-group-item-action ">FLORES</a>
                    <a href="../controller/mainCategoriaController.php" class="list-group-item list-group-item-action ">CATEGORÍAS</a>
                    <a href="../controller/mainEnvioController.php" class="list-group-item list-group-item-action ">ENVÍOS</a>
                    <a href="../controller/mainFacturasController.php" class="list-group-item list-group-item-action">FACTURAS</a>
                    <a href="../controller/mainPedidoController.php" class="list-group-item list-group-item-action">PEDIDOS</a>
                    <a href="../controller/mainPagoController.php" class="list-group-item list-group-item-action">PAGOS</a>
                    <a href="../controller/mainUsuarioController.php" class="list-group-item list-group-item-action active">USUARIOS</a>
                </div>
            </div>
            <!-- Main Content -->
            <div class="col-md-9">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Hash</th>
                            <th>Activo</th>
                            <th>Rol</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario["nombre"] ?></td>
                                <td><?php echo $usuario["apellido"] ?></td>
                                <td><?php echo $usuario["email"] ?></td>
                                <td><?php echo $usuario["hash"] ?></td>
                                <td><?php echo $usuario["activo"] ?></td>
                                <td><?php echo $usuario["rol"] ?></td>
                                <td><a href="../controller/obtenerUsuarioController.php?id_usuario=<?php echo $usuario['id_usuario'] ?>" class="btn btn-info"><i class="fas fa-edit"></i></a></td>
                                <td><a href="../controller/eliminarUsuarioController.php?id_usuario=<?php echo $usuario['id_usuario'] ?>" class="btn btn-danger" onclick="return confirm('¿Desea eliminar este Usuario?')"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End Admin Panel Section -->
    <br><br>
    <!-- Bootstrap JS -->
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- Fontawesome JS -->
    <script src="../assets/js/all.min.js"></script>


    <!-- footer -->
	<div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">Sobre nosotros</h2>
						<p>Tu boutique online donde encontrarás las flores más frescas y hermosas para cada ocasión. Inspiramos belleza y alegría en cada ramo.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Contacto</h2>
						<ul>
							<li>Dirección: Avenida de las Rosas 123, Ciudad Jardín, CP 45678</li>
							<li>Email: contacto@bosquedelaflores.com</li>
							<li>Teléfono: +34 912 345 678</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Menú</h2>
						<ul>
							 <li><a href="../index.php">Inicio</a></li>
                                <li>
                                    <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=== "admin"): ?>
                                        <a href="../controller/mainFlorController.php">Gestionar Tienda</a>
                                    <?php else:?>
                                        <a href="../controller/mainFlorController.php">Tienda</a>
                                    <?php endif;?>
                                </li>
                                <li><a href="../view/about.php">Sobre Nosotros</a></li>
                                <li><a href="../view/contact.php">Contacto</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribirse</h2>
						<p>Suscríbase a nuestra lista de correo para recibir las últimas actualizaciones.</p>
						<form action="../index.php">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights &copy; 2025 - Bosque de las Flores, All Rights Reserved.</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<div class="social-icons">
						<ul>
							<li><a href="https://www.facebook.com/share/1A7KmMnTgx/?mibextid=wwXIfr" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="https://x.com/?lang=es" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="https://es.linkedin.com/" target="_blank"><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="../assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="../assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="../assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="../assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="../assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="../assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="../assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="../assets/js/sticker.js"></script>
	<!-- form validation js -->
	<script src="../assets/js/form-validate.js"></script>
	<!-- main js -->
	<script src="../assets/js/main.js"></script>

</body>

</html>