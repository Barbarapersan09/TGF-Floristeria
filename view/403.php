<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Error 403</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="http://floristeria.kesug.com/assets/css/responsive.css">

</head>

<body>

	<!--PreLoader-->
	<div class="loader">
		<div class="loader-inner">
			<div class="circle"></div>
		</div>
	</div>
	<!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img src="http://floristeria.kesug.com/assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="http://floristeria.kesug.com/index.php">Inicio</a></li>
								<li>
									<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin"): ?>
										<a href="http://floristeria.kesug.com/controller/mainFlorController.php">Gestionar Tienda</a>
									<?php else: ?>
										<a href="http://floristeria.kesug.com/controller/mainFlorController.php">Tienda</a>
									<?php endif; ?>
								</li>
								<li><a href="http://floristeria.kesug.com/view/about.php">Sobre nosotros</a></li>
								<li><a href="http://floristeria.kesug.com/view/contact.php">Contacto</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="http://floristeria.kesug.com/view/cart.php"><i class="fas fa-shopping-cart"></i></a>
										<?php if (!isset($_SESSION["id"])): ?>
											<a class="shopping-cart" href="http://floristeria.kesug.com/view/login.php"><i class="fas fa-user"></i></a>
										<?php else: ?>
											<a class="shopping-cart" href="http://floristeria.kesug.com/controller/logOutController.php"><img width="15" src="http://floristeria.kesug.com/assets/img/cerrar-sesion.png" alt=""></a>
										<?php endif; ?>

									</div>
								</li>
							</ul>
						</nav>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->


    <div class="mt-150 mb-150 d-flex align-items-center justify-content-center" >
		<div class="container d-flex align-items-center justify-content-center">
			<div class="row d-flex align-items-center justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="text-center">
						<h1> Error 403 - Página no encontrada </h1>
                        <p> No tienes permiso para acceder a esta página. </p>
                        <a class="btn btn-warning btn-lg btn-block" href="http://floristeria.kesug.com/"> Volver al Inicio </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->


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
							 <li><a href="http://floristeria.kesug.com/index.php">Inicio</a></li>
                                <li>
                                    <?php if(isset($_SESSION["rol"]) && $_SESSION["rol"]=== "admin"): ?>
                                        <a href="http://floristeria.kesug.com/controller/mainFlorController.php">Gestionar Tienda</a>
                                    <?php else:?>
                                        <a href="http://floristeria.kesug.com/controller/mainFlorController.php">Tienda</a>
                                    <?php endif;?>
                                </li>
                                <li><a href="http://floristeria.kesug.com/view/about.php">Sobre Nosotros</a></li>
                                <li><a href="http://floristeria.kesug.com/view/contact.php">Contacto</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribirse</h2>
						<p>Suscríbase a nuestra lista de correo para recibir las últimas actualizaciones.</p>
						<form action="http://floristeria.kesug.com/index.php">
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
	<script src="http://floristeria.kesug.com/assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="http://floristeria.kesug.com/assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="http://floristeria.kesug.com/assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="http://floristeria.kesug.com/assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="http://floristeria.kesug.com/assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="http://floristeria.kesug.com/assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="http://floristeria.kesug.com/assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="http://floristeria.kesug.com/assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="http://floristeria.kesug.com/assets/js/sticker.js"></script>
	<!-- form validation js -->
	<script src="http://floristeria.kesug.com/assets/js/form-validate.js"></script>
	<!-- main js -->
	<script src="http://floristeria.kesug.com/assets/js/main.js"></script>

</body>

</html>