<?php

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
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
	<title>Tienda</title>

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
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f9f9f9;
			margin: 0;
			padding: 0;
		}

		.filtro-contenedor {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 20px;
			/* Espaciado entre los filtros */
			padding: 20px;
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
			margin: 20px auto;
			max-width: 1000px;
		}

		.product-filters {
			display: flex;
			flex-direction: column;
			/* Etiqueta y select en columna */
			align-items: center;
		}

		.product-filters label {
			font-weight: bold;
			color: #FF7A00;
			/* Naranja */
			margin-bottom: 5px;
			text-transform: uppercase;
		}

		.product-filters select {
			border: 1px solid #FF7A00;
			border-radius: 5px;
			padding: 8px 10px;
			font-size: 14px;
			font-weight: bold;
			color: #000;
			background-color: #fff;
			cursor: pointer;
			outline: none;
			width: 150px;
			/* Ancho consistente */
		}

		.product-filters select:focus {
			border-color: #FF7A00;
			box-shadow: 0 0 5px rgba(255, 122, 0, 0.5);
		}

		@media (max-width: 768px) {
			.filtro-contenedor {
				flex-wrap: wrap;
				/* Los filtros se apilan en pantallas pequeñas */
				gap: 15px;
			}

			.product-filters {
				align-items: flex-start;
				/* Alinear a la izquierda en pantallas pequeñas */
			}

			.product-filters select {
				width: 100%;
			}
		}

		.boton-carrito {
			background-color: #F58220;
			/* Naranja */
			color: #FFFFFF;
			/* Texto blanco */
			border: none;
			border-radius: 25px;
			/* Bordes redondeados */
			padding: 10px 20px;
			font-size: 16px;
			font-family: Arial, sans-serif;
			display: inline-flex;
			/* Para alinear ícono y texto */
			align-items: center;
			text-decoration: none;
			cursor: pointer;
		}

		.boton-carrito:hover {
			background-color: #e37217;
			/* Naranja más oscuro */
		}

		.boton-carrito i {
			margin-right: 8px;
			/* Espacio entre ícono y texto */
		}

		.product-lists {
			display: flex;
			flex-wrap: wrap;
			gap: 20px;
			justify-content: center;

		}

		.single-product-item {
			flex: 1 1 calc(33.33%-20px);
			max-height: calc(33.33%-20px);
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
							<a href="../index.php">
								<img src="../assets/img/logo.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="../index.php">Inicio</a></li>
								<li>
									<?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] === "admin"): ?>
										<a href="<?= RUTA_BASE ?>/controller/mainFlorController.php">Gestionar Tienda</a>
									<?php else: ?>
										<a href="<?= RUTA_BASE ?>/controller/mainFlorController.php">Tienda</a>
									<?php endif; ?>
								</li>
								<li><a href="../view/about.php">Sobre nosotros</a></li>
								<li><a href="../view/contact.php">Contacto</a></li>
								<li>
									<div class="header-icons">
										<a class="shopping-cart" href="../controller/carritoController.php?action=view"><i class="fas fa-shopping-cart"></i></a>
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
						<h1>Tienda</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->

	<div class="filtro-contenedor">
		<div class="product-filters">
			<label for="color-filter">Color:</label>
			<select class="form-control" name="color" id="color-filter">
				<option value="todos">Todos</option>
				<option value="blanco">Blanco</option>
				<option value="rojo">Rojo</option>
				<option value="amarillo">Amarillo</option>
				<option value="morado">Morado</option>
				<option value="rosa">Rosa</option>
				<option value="azul">Azul</option>
				<option value="naranja">Naranja</option>
			</select>
		</div>
		<div class="product-filters">
			<label for="ocasion-filter">Ocasión:</label>
			<select class="form-control" name="ocasion" id="ocasion-filter">
				<option value="todos">Todos</option>
				<option value="Amor">Amor</option>
				<option value="Boda">Boda</option>
				<option value="Primavera">Primavera</option>
				<option value="Gracias">Gracias</option>
				<option value="Lujo">Lujo</option>
				<option value="Amistad">Amistad</option>
				<option value="Paz">Paz</option>
			</select>
		</div>
		<div class="product-filters">
			<label for="categoria-filter">Categoría:</label>
			<select class="form-control" name="categoria" id="categoria-filter">
				<option value="todos">Todos</option>
				<option value="Rosas">Rosas</option>
				<option value="Lirios">Lirios</option>
				<option value="Girasoles">Girasoles</option>
				<option value="Tulipanes">Tulipanes</option>
				<option value="Orquídeas">Orquídeas</option>
			</select>
		</div>
	</div>

	<div class="container">
		<div class="row product-lists">
			<?php foreach ($flores as $flor): ?>
				<div id="tabla-flores" class="col-lg-4 col-md-6 text-center strawberry" data-color="<?= $flor['color'] ?>" data-ocasion="<?= $flor['ocasion'] ?>" data-categoria="<?= $flor['id_categoria'] ?>">
					<div class="single-product-item">
						<div class="product-image">
							<a href="obtenerFlorController.php?action=mostrar&id=<?= $flor["id_flor"] ?>"><img src="<?= $flor['url_imagen'] ?>" alt=""></a>
						</div>
						<h3><?= $flor["nombre"] ?></h3>
						<p class="product-price"><span><?= $flor["precio"] ?></span></p>
						<form action="../controller/carritoController.php?action=add" method="POST">
							<input type="hidden" name="producto_id" value="<?= $flor["id_flor"] ?>">
							<input type="hidden" name="nombre" value="<?= $flor["nombre"] ?>">
							<input type="hidden" name="precio" value="<?= $flor["precio"] ?>€">
							<input type="hidden" name="cantidad" value="1">
							<input type="hidden" name="url_imagen" value="<?= $flor['url_imagen'] ?>">
							<button type="submit" class="cart-btn boton-carrito "><i class="fas fa-shopping-cart"></i> Añadir al carrito</button>
						</form>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 text-center">
			<div class="pagination-wrap">
				<ul>
					<?php if ($pagActual > 1): ?>
						<li><a href="?pagina=<?= $pagActual - 1 ?>">Prev</a></li>
					<?php endif; ?>
					<?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
						<li><a href="?pagina=<?= $i ?>" class="<?= $i === $pagActual ? 'active' : '' ?>"><?= $i ?></a></li>
					<?php endfor; ?>
					<?php if ($pagActual < $totalPaginas): ?>
						<li><a href="?pagina=<?= $pagActual + 1 ?>">Next</a></li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
	</div>
	</div>
	<!-- end products -->

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

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const productLists = document.querySelector(".product-lists");
			const iso = new Isotope(productLists, {
				itemSelector: ".col-lg-4",
				layoutMode: "fitRows"
			});
			const colorFilter = document.getElementById("color-filter");
			colorFilter.addEventListener("change", function() {
				const filterValue = this.value === "todos" ? "*" : `[data-color="${this.value}"]`;
				iso.arrange({
					filter: filterValue
				})
			});
		});

		document.addEventListener("DOMContentLoaded", function() {
			const productLists = document.querySelector(".product-lists");
			const iso = new Isotope(productLists, {
				itemSelector: ".col-lg-4",
				layoutMode: "fitRows"
			});
			const ocasionFilter = document.getElementById("ocasion-filter");
			ocasionFilter.addEventListener("change", function() {
				const filterValue = this.value === "todos" ? "*" : `[data-ocasion="${this.value}"]`;
				iso.arrange({
					filter: filterValue
				})
			});
		});

		document.addEventListener("DOMContentLoaded", function() {
			const categorias = {
				1: "Rosas",
				2: "Lirios",
				3: "Girasoles",
				4: "Tulipanes",
				5: "Orquídeas"
			};
			const productLists = document.querySelector(".product-lists");
			const iso = new Isotope(productLists, {
				itemSelector: ".col-lg-4",
				layoutMode: "fitRows"
			});
			const categoriaFilter = document.getElementById("categoria-filter");
			categoriaFilter.addEventListener("change", function() {
				const categoriaSelected = this.value;
				const filterValue = this.value === "todos" ? "*" : `[data-categoria="${Object.keys(categorias).find(key=>categorias[key]=== categoriaSelected)}"]`;
				iso.arrange({
					filter: filterValue
				})
			});
		});
	</script>

</body>

</html>