<?php
//esto es un cambio para un cambio de git.
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
require_once "config/config.php";

header("Content-Type: text/html; charset=utf-8");
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Bosque de las Flores</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- Font Awesome (CDN Oficial) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">

	<style>
		.gallery-container {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 20px;
			padding: 20px;
			max-width: 1200px;
			width: 100%;
		}

		.gallery-container img {
			width: 100%;
			height: auto;
			border-radius: 10px;
			box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		}

		.gallery-item {
			flex: 1;
			/* Permite que las imágenes crezcan proporcionalmente */
			max-width: 33%;
		}

		@media (max-width: 768px) {
			.gallery-container {
				flex-wrap: wrap;
				gap: 15px;
			}

			.gallery-item {
				max-width: 100%;
				/* Las imágenes ocupan todo el ancho en pantallas pequeñas */
			}
		}
	</style>
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
								<img src="assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="index.php">Inicio</a></li>
								<li>
									<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin"): ?>
										<a href="<?= RUTA_BASE ?>/controller/mainFlorController.php">Gestionar Tienda</a>
									<?php else: ?>
										<a href="<?= RUTA_BASE ?>/controller/mainFlorController.php">Tienda</a>
									<?php endif; ?>
								</li>
								<li><a href="view/about.php">Sobre nosotros</a></li>
								<li><a href="view/contact.php">Contacto</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="controller/carritoController.php?action=view"><i class="fas fa-shopping-cart"></i></a>
										<?php if (!isset($_SESSION["id"])): ?>
											<a class="shopping-cart" href="view/login.php"><i class="fas fa-user"></i></a>
										<?php else: ?>
											<a class="shopping-cart" href="controller/logOutController.php"><img width="15" src="assets/img/cerrar-sesion.png" alt=""></a>
										<?php endif; ?>

									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->
	<!-- hero area -->
	<div class="hero-area hero-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 offset-lg-2 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Boutique de Flores</p>
							<h1>Donde cada flor es una obra de arte</h1>
							<div class="hero-btns">
								<a href="controller/mainFlorController.php" class="boxed-btn">Tienda</a>
								<a href="view/contact.php" class="bordered-btn">Contáctanos</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end hero area -->

	<!-- features list section -->
	<div class="list-section pt-80 pb-80">
		<div class="container">

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-shipping-fast"></i>
						</div>
						<div class="content">
							<h3>Envío gratuito</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
					<div class="list-box d-flex align-items-center">
						<div class="list-icon">
							<i class="fas fa-phone-volume"></i>
						</div>
						<div class="content">
							<h3>Asistencia 24/7</h3>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="list-box d-flex justify-content-start align-items-center">
						<div class="list-icon">
							<i class="fas fa-sync"></i>
						</div>
						<div class="content">
							<h3>Reembolso</h3>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end features list section -->

	<!-- product section -->
	<div class="product-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3><span class="orange-text">Nuestras</span> Flores</h3>
						<p>Arreglos florales únicos y elegantes, ideales para regalar o decorar tu hogar.</p>
					</div>
					<div class="gallery-container">
						<div class="gallery-item">
							<img src="assets/img/flor1.jpeg" alt="Ramo de flores coloridas">
						</div>
						<div class="gallery-item">
							<img src="assets/img/flor2.jpeg" alt="Mercado de flores">
						</div>
						<div class="gallery-item">
							<img src="assets/img/flor3.jpeg" alt="Ramo de tulipanes blancos">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- end product section -->

	<!-- cart banner section -->
	<section class="cart-banner pt-100 pb-100">
		<div class="container">
			<div class="row clearfix">
				<!--Image Column-->
				<div class="image-column col-lg-6">
					<div class="image">
						<div class="price-box">
							<div class="inner-price">
								<span class="price">
									*Hasta fin de<br> existencias.
								</span>
							</div>
						</div>
						<img src="assets/img/a.jpg" alt="">
					</div>
				</div>
				<!--Content Column-->
				<div class="content-column col-lg-6">
					<h3><span class="orange-text">Deal</span> of the month</h3>
					<h4>Ramo de Alegría</h4>
					<div class="text">Este hermoso ramo de flores silvestres en tonos amarillos y naranjas, cuidadosamente arreglado en un elegante jarrón blanco, es perfecto para iluminar cualquier espacio. Ideal para regalar o decorar tu hogar, este arreglo aporta frescura y calidez, evocando los colores del sol y la naturaleza en su máxima expresión. ¡Añade un toque de alegría y belleza a tu día con nuestro Ramo de Alegría!</div>
					<br />
					<!--Countdown Timer-->
					<div class="time-counter">
						<div class="time-countdown clearfix" data-countdown="2024/8/01">
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Days</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Hours</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Mins</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Secs</div>
							</div>
						</div>
					</div>
					<a href="cart.html" class="cart-btn mt-3"><i class="fas fa-shopping-cart"></i> Añadir al Carrito</a>
				</div>
			</div>
		</div>
	</section>
	<!-- end cart banner section -->

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar1.png" alt="">
							</div>
							<div class="client-meta">
								<h3>María González Pérez</h3>
								<p class="testimonial-body">
									"Los ramos de Bosque de las Flores siempre son espectaculares. La atención al detalle es increíble y las flores siempre llegan frescas y hermosas. ¡Recomiendo 100%!"</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar2.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Carlos López Martínez</h3>
								<p class="testimonial-body">
									"Compré un arreglo para el aniversario de mis padres y quedaron encantados. El servicio es excelente y la calidad de las flores inmejorable. Definitivamente volveré a comprar aquí."</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar3.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Javier Ramírez Torres</h3>
								<p class="testimonial-body">
									"Pedí un ramo para el cumpleaños de mi esposa y no podría estar más satisfecho. Las flores eran hermosas y el servicio al cliente fue excepcional. Definitivamente, mi nueva floristería de confianza."</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->



	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
                            <a href="https://www.pinterest.com/search/pins/?q=arreglos%20florales" target="_blank">
                                <img src="assets/img/company-logos/1.png" alt="Inspiración en Pinterest">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://floresnala.es/el-impacto-de-las-flores-en-el-animo-y-la-salud-mental-estudios-y-experiencias/" target="_blank">
                                <img src="assets/img/company-logos/2.png" alt="Beneficios de las flores en la salud y emociones">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://www.cancer.gov/espanol/cancer/tratamiento/mca/paciente/aromaterapia-pdq" target="_blank">
                                <img src="assets/img/company-logos/3.png" alt="Terapia floral y aromaterapia">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://www.kew.org/" target="_blank">
                                <img src="assets/img/company-logos/4.png" alt="Real Jardín Botánico de Kew">
                            </a>
                        </div>
                        <div class="single-logo-item">
                            <a href="https://onetreeplanted.org/" target="_blank">
                                <img src="assets/img/company-logos/5.png" alt="Proyecto de reforestación">
                            </a>
                        </div>
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
							<li><a href="index.php">Inicio</a></li>
                            <li>
								<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin"): ?>
										<a href="<?= RUTA_BASE ?>/controller/mainFlorController.php">Gestionar Tienda</a>
								<?php else: ?>
										<a href="<?= RUTA_BASE ?>/controller/mainFlorController.php">Tienda</a>
								<?php endif; ?>
							</li>
							<li><a href="view/about.php">Sobre nosotros</a></li>
							<li><a href="view/contact.php">Contacto</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribirse</h2>
						<p>Suscríbase a nuestra lista de correo para recibir las últimas actualizaciones.</p>
						<form id="suscripcionForm" action="controller/suscripcionController.php" method="POST">
							<input type="email" placeholder="Email" name="email">
							<button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
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

    <!-- MODAL MENSAJE SUSCRIPCION -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-warning text-white">
					<h5 class="modal-title">Gracias por la suscripción.</h5>
					<button type="button"id="borrar" class="btn-close border border-warning bg-warning " data-bs-dismiss="modal" aria-label="cerrar"><i class="fa-solid fa-xmark"></i></button>
				</div>
                <div class="modal-body">
                    <p>Le mantendremos informado.</p>
                </div>
			</div>
		</div>
	</div>

	<script>
		document.getElementById("suscripcionForm").addEventListener("submit",function(event){
            event.preventDefault();
            var modal= document.getElementById("alertModal");
			var alertModal = new bootstrap.Modal(modal,{keyboard:true,backdrop:true});
			alertModal.show();
            document.getElementById("borrar").addEventListener("click",function(event){
                document.getElementById("suscripcionForm").submit();
            },{once:true})
		})
	</script>
    <!-- FIN MODAL MENSAJE SUSCRIPCION -->

	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

</body>

</html>