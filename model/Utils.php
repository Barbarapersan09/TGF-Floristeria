<?php

namespace model;

use \PDO;
use \PDOException;

// require_once '../vendor/PHPMailer/PHPMailer/src/Exception.php';
// require_once '../vendor/PHPMailer/PHPMailer/src/PHPMailer.php';
// require_once '../vendor/PHPMailer/PHPMailer/src/SMTP.php';
require_once '../vendor/autoload.php'; // Asegúrate de que apunta al archivo autoload de Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!class_exists('model\Utils')) {


   class Utils
   {

      /**
       * Funcion que se conecta a la BD y nos devuelve una conexion PDO activa
       */
      public static function conectar()
      {

         $conPDO = null;
         try {
            require "global.php";
            $conPDO = new PDO("mysql:host=" . $DB_SERVER . ";dbname=" . $DB_SCHEMA, $DB_USER, $DB_PASSWD);
            return $conPDO;
         } catch (PDOException $e) {
            print "¡Error al conectar!: " . $e->getMessage() . "<br/>";
            return $conPDO;
            die();
         }
      }

      /**
       * Limpiamos el contenido de las variables
       */
      public static function limpiar_datos($data)
      {
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
      }


      /**
       * Funcion que genera una cadena aleatoria
       */
      public static function generar_salt($tam, bool $numerica = false)
      {

         //Definimos un array de caracteres
         $letras = "abcdefghijklmnopqrstuvwxyz1234567890*-.,";

         $salt = "";
         //Vamos añadiendo $tam caracteres aleatorios a la salt
         for ($i = 0; $i < $tam; $i++) {
            if ($numerica == true) {
               $salt .= rand(1, 9);
            } else {

               $salt .= $letras[rand(0, strlen($letras) - 1)];
            }
         }

         //devolvemos la salt
         return $salt;
      }

      //La funcion genera un codigo número de 4 digitos aleatorio
      public static function generar_codigo_activacion()
      {
         return rand(1111, 9999);
      }

      public static function enviarCorreo($usuario)
      {
         $mail = new PHPMailer(true);

         try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bpersan834@g.educaand.es'; // Tu correo
            $mail->Password   = 'zjci zcra wdhc qjlr';      // Tu contraseña o App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Configuración del correo
            $mail->setFrom('bpersan834@g.educaand.es', 'Floristeria'); // Correo del remitente
            $mail->addAddress($usuario['email'], $usuario['nombre']); // Correo del destinatario

            $mail->isHTML(true);
            $mail->Subject = 'Confirma tu Cuenta';
            $mail->addEmbeddedImage('../assets/img/logo.png', 'logo_cid'); // Ruta física al logo
            $mail->Body = '<div style="text-align: center;">
                 <img src="cid:logo_cid" alt="Floristeria Logo" style="max-width: 250px; margin-bottom: 10px;">
               </div>
               <h1>¡Bienvenido, ' . htmlspecialchars($usuario['nombre']) . '!</h1>

                              <p style="color: #444; text-align: center;">Gracias por registrarte. Para activar tu cuenta, usa el siguiente código:</p>
                              <div style="background-color: #ffe0b2; padding: 15px; font-size: 20px; text-align: center; border-radius: 5px; margin-top: 10px;">
                                  <strong>' . htmlspecialchars($usuario['hash']) . '</strong>
                              </div>
                              <p style="color: #555; text-align: center; margin-top: 20px;">Si tienes alguna duda, no dudes en <a href="mailto:bpersan834@g.educaand.es" style="color: #ff9800; text-decoration: none;">contactarnos</a>.</p>
                            </div>';

            // Enviar correo
            $mail->send();
            return true;
         } catch (Exception $e) {
            echo '<div style="background-color: #f44336; color: white; padding: 20px; border-radius: 5px; text-align: center; font-size: 18px;">
                  <img src="https://via.placeholder.com/50x50?text=LOGO" alt="Floristería Logo" style="vertical-align: middle; margin-right: 10px;">
                  <strong>Error al enviar el correo:</strong> ' . htmlspecialchars($mail->ErrorInfo) . '
                </div>';
         }
      }




      public static function correo_cambiarPassword($email)
      {
         $mail = new PHPMailer(true);

         try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bpersan834@g.educaand.es'; // Tu correo
            $mail->Password   = 'zjci zcra wdhc qjlr';      // Tu contraseña o App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Configuración del correo 
            $mail->setFrom('bpersan834@g.educaand.es', 'Floristeria'); // Correo del remitente
            $mail->addAddress($email); // Correo del destinatario

            $mail->isHTML(true);
            $mail->Subject = 'Contraseña actualizada';
            $mail->addEmbeddedImage('../assets/img/logo.png', 'logo_cid'); // Ruta física al logo
            $mail->Body = '
               <div style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; border-radius: 8px; text-align: center;">
                  <div style="padding: 10px; border-radius: 8px 8px 0 0;">
                        <img src="cid:logo_cid" alt="Floristeria Logo" style="max-width: 250px; margin-bottom: 10px;">
                  </div>
                  <h2 style="color: #333;">Estimado cliente,</h2>
                  <p style="color: #555; font-size: 16px;">Tu contraseña ha sido actualizada con éxito puede comprobarlo entrando a la web.</p>
                  <p style="color: #555; font-size: 14px; margin-top: 20px;">Si tienes alguna pregunta, no dudes en 
                        <a href="mailto:bpersan834@g.educaand.es" style="color: #ff9800; text-decoration: none;">contactarnos</a>.
                  </p>
               </div>
            ';

            // Enviar correo
            $mail->send();
            return true;
         } catch (Exception $e) {
            echo '<div style="background-color: #f44336; color: white; padding: 20px; border-radius: 5px; text-align: center; font-size: 18px;">
             <img src="https://via.placeholder.com/50x50?text=LOGO" alt="Floristería Logo" style="vertical-align: middle; margin-right: 10px;">
             <strong>Error al enviar el correo:</strong> ' . htmlspecialchars($mail->ErrorInfo) . '
          </div>';
         }
      }

      public static function correoFinalizarCompra($usuario, $productos, $datos)
      {
         $mail = new PHPMailer(true);

         try {
              // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bpersan834@g.educaand.es'; // Tu correo
            $mail->Password   = 'zjci zcra wdhc qjlr';      // Tu contraseña o App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Configuración del correo 
            $mail->setFrom('bpersan834@g.educaand.es', 'Floristeria'); // Correo del remitente
            $mail->addAddress($usuario['email'], $usuario['nombre']); // Correo del destinatario

            $mail->isHTML(true);
            $mail->Subject = 'Pedido realizado';
            $mail->addEmbeddedImage('../assets/img/logo.png', 'logo_cid'); // Ruta física al logo
            $mail->Body = '
                <div style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; border-radius: 8px; text-align: center;">
                    <div style="padding: 10px; border-radius: 8px 8px 0 0;">
                        <img src="cid:logo_cid" alt="Floristeria Logo" style="max-width: 250px; margin-bottom: 10px;">
                    </div>
                    <h2 style="color: #333;">¡Gracias por tu pedido, ' . htmlspecialchars($usuario['nombre']) . '!</h2>
                    <p style="color: #555; font-size: 16px;">Tu compra ha sido procesada con éxito. Nos pondremos en contacto contigo cuando tu pedido esté en camino.</p>
                    <p style="color: #555; font-size: 14px; margin-top: 20px;">Si tienes alguna pregunta, no dudes en 
                        <a href="mailto:bpersan834@g.educaand.es" style="color: #ff9800; text-decoration: none;">contactarnos</a>.
                    </p>
                </div>
            ';

            $rutaPDF = Utils::facturaPDF(Utils::generarFacturaHtml($usuario, $productos, $datos));
            if($rutaPDF){
                $mail-> addAttachment($rutaPDF);
            }
            // Enviar correo
            $mail->send();
            return true;
         } catch (Exception $e) {
            echo '<div style="background-color: #f44336; color: white; padding: 20px; border-radius: 5px; text-align: center; font-size: 18px;">
             <img src="https://via.placeholder.com/50x50?text=LOGO" alt="Floristería Logo" style="vertical-align: middle; margin-right: 10px;">
             <strong>Error al enviar el correo:</strong> ' . htmlspecialchars($mail->ErrorInfo) . '
          </div>';
         }
      }
      //En este metodo vamos a generar la factura con html.
      public static function generarFacturaHtml($usuario, $productos, $datos){
          $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
            <style>
                body{font-family: Arial, Helvetica, sans-serif;}
                table{width: 100%;border-collapse: collapse;}
                th,td{border: 1px solid black;padding: 8px;text-align: left;}
                th{background-color: #F28123;}
                .logo{
                    max-height: 80px;
                    margin-bottom: 20px;
                }
                
                .total-cel{
                    text-align: right;
                    padding: 10px;
                }
            </style>
            </head>
            <body>
                <!--<img src="http://floristeria.kesug.com/assets/img/logo.png" alt="Floristeria Logo" style="max-width: 250px; margin-bottom: 10px;">-->
                <h2>Número Factura  ##'.$datos['id_pedido'].'</h2>
                <p>Cliente: '.$usuario['nombre'].'</p>
                <p>Email: '.$usuario['email'].'</p>
                <p>Fecha: ' . date("d/m/Y").'</p> 
                <h3>Productos</h3>
                <table>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>';
                    foreach($productos as $producto){
                        $nombre= $producto['nombre'];
                        $cantidad = intval($producto['cantidad']);
                        $precio = floatval($producto['precio']);
                        $subtotal = $precio * $cantidad;
                        $html .= ' 
                        <tr>
                            <td>'.$nombre.'</td>
                            <td>'.$cantidad.'</td>
                            <td>'.number_format($precio, 2).'</td>
                            <td>'.number_format($subtotal, 2).'</td>
                        </tr>';
                    }
                   
                $html .='
                    <tr class="total">
                        <td colspan="3">Total:</td>
                        <td class="total-cel"> '.number_format($datos['monto'], 2).'€</td>
                    </tr>
                </table>';
            $html.='
           
            </body>
            </html>
            ';
          return $html;
      }
      //Funcion para generar el PDF de la factura.
      public static function facturaPDF($html){
          $apikey = "7qsFEfY6LvqnC3NykiNZe30Pbwcx5T89jeCcvt0n5MiB8g43ohoWWNZn7aYHoS0b";
          $url = "https://api.html2pdf.app/v1/generate";
          $data = [
              'html'=> $html,
              'apiKey'=> $apikey
          ];
          $option = [
              'http'=> [
                  'header'=> "Content-type: application/json",
                  'method'=> 'POST',
                  'content'=> json_encode($data),
                  'ignore_errors'=> true
              ]
          ];
          $context = stream_context_create($option);
          $response = file_get_contents($url,false,$context);
          if(strpos($response,"%PDF")!==0){
            file_put_contents('../facturas/debug.txt',$response);
            return false;
          }

          $nombrePDF = 'factura_'.uniqid().'.pdf';
          $ruta = '../facturas/' .$nombrePDF;
          file_put_contents($ruta, $response);
          return $ruta;
      }

      public static function crearPedido($montoTotal)
      {
         if (session_status() === PHP_SESSION_NONE) {
            session_start();
         }
         
         require_once 'Pedido.php';

         // Crea una instancia de la clase Pedido para gestionar las operaciones relacionadas con la base de datos.
         $gestorPedidos = new Pedido();
         $id_usuario = $_SESSION["usuario"]["id_usuario"];
         $estado = "Pendiente";
         $metodo = "Tarjeta";
         $usuario = [
            "email" => "barbarapersan09@gmail.com",
            "nombre" => "Barbara"
        ];
         // Intenta agregar la nueva Pedido a la base de datos utilizando el método `addPedido`.
         $id_pedido = $gestorPedidos->createPedido($id_usuario, $montoTotal, $estado, $metodo);
         if ($id_pedido) {
            /* if (Utils::correoFinalizarCompra($usuario)) {
               
            } else {
                die("Error al enviar el correo");
            }*/
            return $id_pedido;
         } else {
            // Si ocurre un error al añadir la Pedido, define un mensaje de error.
            $mensaje = "Error al añadir el pedido";
            // Incluye la vista `Pedidoes.php` para informar del fallo.
            return $mensaje;
         }
      }
      public static function correo_suscripcion($email)
      {
         $mail = new PHPMailer(true);

         try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bpersan834@g.educaand.es'; // Tu correo
            $mail->Password   = 'zjci zcra wdhc qjlr';      // Tu contraseña o App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Configuración del correo 
            $mail->setFrom('bpersan834@g.educaand.es', 'Floristeria'); // Correo del remitente
            $mail->addAddress($email); // Correo del destinatario

            $mail->isHTML(true);
            $mail->Subject = 'Nueva Suscripción';
            $mail->addEmbeddedImage('../assets/img/logo.png', 'logo_cid'); // Ruta física al logo
            $mail->Body = '
               <div style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; border-radius: 8px; text-align: center;">
                  <div style="padding: 10px; border-radius: 8px 8px 0 0;">
                        <img src="cid:logo_cid" alt="Floristeria Logo" style="max-width: 250px; margin-bottom: 10px;">
                  </div>
                  <p style="color: #555; font-size: 16px;">Gracias por suscribirte a nuestra lista de correo para recibir las últimas actualizaciones.</p>
                  <p style="color: #555; font-size: 14px; margin-top: 20px;">Si tienes alguna pregunta, no dudes en 
                        <a href="mailto:bpersan834@g.educaand.es" style="color: #ff9800; text-decoration: none;">contactarnos</a>.
                  </p>
               </div>
            ';

            // Enviar correo
            $mail->send();
            return true;
         } catch (Exception $e) {
            echo '<div style="background-color: #f44336; color: white; padding: 20px; border-radius: 5px; text-align: center; font-size: 18px;">
             <img src="https://via.placeholder.com/50x50?text=LOGO" alt="Floristería Logo" style="vertical-align: middle; margin-right: 10px;">
             <strong>Error al enviar el correo:</strong> ' . htmlspecialchars($mail->ErrorInfo) . '
          </div>';
         }
      }
      //-----------------------------------------------------------------------------------------------------------------------------------------

       public static function correo_contacto($email)
      {
         $mail = new PHPMailer(true);

         try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'bpersan834@g.educaand.es'; // Tu correo
            $mail->Password   = 'zjci zcra wdhc qjlr';      // Tu contraseña o App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Configuración del correo 
            $mail->setFrom('bpersan834@g.educaand.es', 'Floristeria'); // Correo del remitente
            $mail->addAddress($email); // Correo del destinatario

            $mail->isHTML(true);
            $mail->Subject = 'Contacto';
            $mail->addEmbeddedImage('../assets/img/logo.png', 'logo_cid'); // Ruta física al logo
            $mail->Body = '
               <div style="max-width: 600px; margin: auto; font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; border-radius: 8px; text-align: center;">
                  <div style="padding: 10px; border-radius: 8px 8px 0 0;">
                        <img src="cid:logo_cid" alt="Floristeria Logo" style="max-width: 250px; margin-bottom: 10px;">
                  </div>
                  <p style="color: #555; font-size: 16px;">Hola, pronto uno de nuestros asesores se pondra en contacto con usted.</p>
                  <p style="color: #555; font-size: 14px; margin-top: 20px;">Si tienes alguna pregunta, no dudes en 
                        <a href="mailto:bpersan834@g.educaand.es" style="color: #ff9800; text-decoration: none;">contactarnos</a>.
                  </p>
               </div>
            ';

            // Enviar correo
            $mail->send();
            return true;
         } catch (Exception $e) {
            echo '<div style="background-color: #f44336; color: white; padding: 20px; border-radius: 5px; text-align: center; font-size: 18px;">
             <img src="https://via.placeholder.com/50x50?text=LOGO" alt="Floristería Logo" style="vertical-align: middle; margin-right: 10px;">
             <strong>Error al enviar el correo:</strong> ' . htmlspecialchars($mail->ErrorInfo) . '
          </div>';
         }
      }
   }
}
//echo Utils::generar_salt(16) . hash("sha256",1234);

// Utils::correo_registro(["email" => "thejokerjune@gmail.com", "nombre" => "Barbara"]);

//$util = new Utils();

//var_dump($util->conectar());

//echo Utils::generar_salt(16, false);
