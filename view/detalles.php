<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Detalles</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="../assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="../assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="../assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="../assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="../assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="../assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="../assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="../assets/css/responsive.css">

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
								<img src="../assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="index.php">Inicio</a></li>
								<li>
									<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin"): ?>
										<a href="controller/mainFlorController.php">Gestionar Tienda</a>
									<?php else: ?>
										<a href="controller/mainFlorController.php">Tienda</a>
									<?php endif; ?>
								</li>
								<li><a href="../view/about.php">Sobre nosotros</a></li>
								<li><a href="view/contact.php">Contacto</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="../view/cart.php"><i class="fas fa-shopping-cart"></i></a>
										<?php if (!isset($_SESSION["id"])): ?>
											<a class="shopping-cart" href="../view/login.php"><i class="fas fa-user"></i></a>
										<?php else: ?>
											<a class="shopping-cart" href="../controller/logOutController.php"><img width="15" src="../assets/img/cerrar-sesion.png" alt=""></a>
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
						<p>BOSQUE DE LAS FLORES</p>
						<h1>Detalles</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<img src="<?php echo $flor['url_imagen'] ?>" alt="">
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3><?php echo $flor['nombre'] ?></h3>
						<p class="single-product-pricing"><span><?php echo $flor['precio'] ?>€</span></p>
						<p><?php echo $flor['descripcion'] ?></p>
						<div class="single-product-form">
							<form action="../controller/carritoController.php?action=add" method="POST">
								<input type="hidden" name="producto_id" value="<?= $flor["id_flor"] ?>">
								<input type="hidden" name="nombre" value="<?= $flor["nombre"] ?>">
								<input type="hidden" name="precio" value="<?= $flor["precio"] ?>€">
								<input type="hidden" name="cantidad" value="1">
								<input type="hidden" name="url_imagen" value="<?= $flor['url_imagen'] ?>">
								<button type="submit" class="cart-btn boton-carrito "><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
							</form>
							<p><strong>Categoria: </strong><?php echo $flor['nombre_categoria'] ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
                            <a href="https://www.pinterest.com/search/pins/?q=arreglos%20florales" target="_blank">
                                <img src="../assets/img/company-logos/1.png" alt="Inspiración en Pinterest">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://floresnala.es/el-impacto-de-las-flores-en-el-animo-y-la-salud-mental-estudios-y-experiencias/" target="_blank">
                                <img src="../assets/img/company-logos/2.png" alt="Beneficios de las flores en la salud y emociones">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://www.cancer.gov/espanol/cancer/tratamiento/mca/paciente/aromaterapia-pdq" target="_blank">
                                <img src="../assets/img/company-logos/3.png" alt="Terapia floral y aromaterapia">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://www.kew.org/" target="_blank">
                                <img src="../assets/img/company-logos/4.png" alt="Real Jardín Botánico de Kew">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://onetreeplanted.org/" target="_blank">
                                <img src="../assets/img/company-logos/5.png" alt="Proyecto de reforestación">
                            </a>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->

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