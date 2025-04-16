<?php 
session_start();
if (!isset($_SESSION["id"])){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Responsive Bootstrap4 Shop Template, Created by Imran Hossain from https://imransdesign.com/">

	<!-- title -->
	<title>Finalizar compra</title>

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
										<a href="controller/mainFlorController.php">Gestionar Tienda</a>
									<?php else: ?>
										<a href="controller/mainFlorController.php">Tienda</a>
									<?php endif; ?>
								</li>
								<li><a href="../view/about.php">Sobre nosotros</a></li>
								<li><a href="../view/contact.php">Contacto</a></li>
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
						<p>Bosque de las Flores</p>
						<h1>Finalizar Compra</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- check out section -->
	<div class="checkout-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="checkout-accordion-wrap">
						<div class="accordion" id="accordionExample">
                            <div class="alert alert-danger" id="error-messages" style="display:none;"></div>
							<div class="card single-accordion">
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Dirección de facturación
										</button>
									</h5>
								</div>

								<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body">
										<div class="billing-address-form">
											<form action="../index.php">                                                
												<p><input type="text" name="nombre" placeholder="Nombre" required></p>
												<p><input type="email" name="email"  placeholder="Email" required></p>
												<p><input type="text" name="direccion" placeholder="Dirección" required></p>
												<p><input type="tel" name="telefono" placeholder="Teléfono" required></p>
												<p><textarea name="comentarios" id="bill" cols="30" rows="10" placeholder="Comentarios"></textarea></p>
											</form>
										</div>
									</div>
								</div>
								<br><br>
								<div class="card-header" id="headingOne">
									<h5 class="mb-0">
										<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
											Datos Bancarios
										</button>
									</h5>
								</div>

								<div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body">
										<div class="billing-address-form">
											<form action="../index.php">
												<p><input type="text" name="nombre" placeholder="Barbara Perez Santiago" required></p>
												<p><input type="text" name="tarjeta" placeholder="0000 0000 0000 0000" required maxlength="19" minlength="19"></p>
												<p><input type="text" name="caducidad" placeholder="01/2025" required maxlength="7" minlength="7"></p>
												<p><input type="text" name="cvv" placeholder="CVV" required maxlength="3" minlength="3"></p>
											</form>
										</div>
									</div>
								</div>
							</div>
							<a href="finalizarCompra.php" class="boxed-btn">Realizar pedido</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<!-- end check out section -->

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
		document.addEventListener("DOMContentLoaded",function(){
			document.querySelector(".boxed-btn").addEventListener("click",function(event){
				event.preventDefault();
				var errorDiv = document.getElementById("error-messages");
                errorDiv.innerHTML="";
                var errores= [];
                //Obtener los campos
                var nombre= document.querySelector("input[placeholder= 'Nombre']").value.trim();
                var email= document.querySelector("input[placeholder= 'Email']").value.trim();
                var direccion= document.querySelector("input[placeholder= 'Dirección']").value.trim();
                var telefono= document.querySelector("input[placeholder= 'Teléfono']").value.trim();
                //Datos Bancarios
                var titular= document.querySelector("input[placeholder= 'Barbara Perez Santiago']").value.trim();
                var tarjeta= document.querySelector("input[placeholder= '0000 0000 0000 0000']").value.trim();
                var fecha_exp= document.querySelector("input[placeholder= '01/2025']").value.trim();
                var cvv= document.querySelector("input[placeholder= 'CVV']").value.trim();

                //Expresiones regulares para validación
                var expresion_nombre= /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
                var expresion_email= /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var expresion_direccion = /^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s,.-]+$/;
                var expresion_telefono = /^[0-9]{9,15}$/;
                var expresion_tarjeta= /^[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}$/;
                var expresion_fecha_exp= /^(0[1-9]|1[02])\/\d{4}$/;
                var expresion_cvv= /^[0-9]{3}$/;

                if(!expresion_nombre.test(nombre)|| nombre=="") errores.push("El nombre contiene caracteres no permitidos o está vacío.");
                if(!expresion_email.test(email)|| email=="") errores.push("Email no válido o está vacío.");
                if(!expresion_direccion.test(direccion)|| direccion=="") errores.push("La dirección contiene caracteres no permitidos o está vacía.");
                if(!expresion_telefono.test(telefono)|| telefono=="") errores.push("El teléfono debe contener entre 9-15 dígitos o está vacío");
                if(!expresion_nombre.test(titular)|| titular=="") errores.push("El nombre del titular contiene caracteres no permitidos o está vacío.");
                if(!expresion_tarjeta.test(tarjeta)|| tarjeta=="") errores.push("El número de tarjeta es incorrecto (0000 0000 0000 0000) o está vacío.");
                
                if(!expresion_cvv.test(cvv)|| cvv=="") errores.push("El CVV no válido o está vacío.");
                if(!expresion_fecha_exp.test(fecha_exp)|| fecha_exp==""){
                     errores.push("La fecha de expiración es incorrecta (01/2025) o está vacía.");
                }else{
                    let partes= fecha_exp.split("/");
                    let mes= parseInt(partes[0],10);
                    let anio= parseInt(partes[1],10);

                    let hoy= new Date();
                    let mes_actual= hoy.getMonth()+1;
                    let anio_actual= hoy.getFullYear();
                    if(anio<anio_actual || (anio==anio_actual && mes<mes_actual)){
                        errores.push("La tarjeta ha expirado.");
                    }
                }
                if(errores.length>0){
                    errorDiv.style.display="";
                    errorDiv.innerHTML=errores.join("<br>");
                    window.scrollTo({top:0, behavior:"smooth"});
                }else{
                    window.location.href= "finalizarCompra.php";
                }


			});
		});
	</script>

</body>

</html>