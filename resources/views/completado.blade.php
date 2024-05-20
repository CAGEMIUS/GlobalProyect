<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Meta datos -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icono de la página -->
    <link rel="icon" href="../img/icono.png">
    <title>{{ __('Purchase completed') }}</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Estilo de las fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://db.onlinewebfonts.com/c/2def107af3e4eeb88b5ca50c3320ae0a?family=TCCC-UnityHeadline+Regular" rel="stylesheet">
    <!-- Iconos del pie de página -->
    <script src="https://kit.fontawesome.com/6868c404bc.js" crossorigin="anonymous"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=AWVLBZm0nF-UYOE-37i7zMGYL-YEdbr9Ey8ErkuK1DEQMEIdcr7zyyFiUso3igVWgtzoga0_5hRqjEd-&currency=MXN"></script>
</head>
<body>
<div id="app">
    @include('partials.navbar')
    @if(Session::has('success_message'))
    <div style="margin-top: 150px; font-size: 18px; text-align: center;">
        {{ Session::get('success_message') }}
    </div>
    @endif 
    <!-- Comprobación del pago en la base de datos -->
    @php
        // Verificar si se han recibido parámetros GET
        if(isset($_GET['payment_id'], $_GET['status'], $_GET['payment_type'], $_GET['merchant_order_id'])){
            // Procesar los parámetros GET recibidos
            $paymentId = $_GET['payment_id'];
            $payerId = $payer_id;
            $status = $_GET['status'];
            $paymentType = $_GET['payment_type'];
            $merchantOrderId = $_GET['merchant_order_id'];

            // Verificar si todos los parámetros recibidos tienen valores
            if ($paymentId && $payerId && $status && $paymentType && $merchantOrderId ) {
                // Conexión a la base de datos
                $conexion = mysqli_connect("localhost:3305", "root", "", "global_db");

                // Verificar si la conexión tuvo éxito
                if (!$conexion) {
                    die("Error al conectar a la base de datos: " . mysqli_connect_error());
                }

                // Preparar la consulta SQL
                $consulta = "INSERT INTO mercadopago (payment_id, payer_id, status, payment_type, merchant_order_id, created_at, updated_at) VALUES ('$paymentId', '$payer_id', '$status', '$paymentType', '$merchantOrderId', NOW(), NOW())";

                // Ejecutar la consulta
                if (mysqli_query($conexion, $consulta)) {
                    echo "Datos del pago guardados correctamente.";

                    // Limpieza del carrito
                    $cleanCart = \Cart::clear();

                    // Después de procesar los datos, redirigir al usuario a la misma página pero sin los parámetros GET
                    header("Location: http://127.0.0.1:8000/completado");
                    exit(); // Finalizar el script después de redirigir
                } else {
                    echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
                }

                // Cerrar la conexión
                mysqli_close($conexion);
            } else {
                echo "Error: Uno o más parámetros GET son nulos.";
            }
        }
    @endphp
    <h3 style="margin-top: 155px; font-size: 30px; text-align: center;">{{ __('Thank you very much for choosing us 😊, we will keep you informed of any updates.') }}</h3>
    <a href="{{ route('checkcompra') }}" style="display: block; margin-top: 60px; margin-bottom: 100px; font-size: 30px; text-align: center; color: #F0314C; padding: 10px;">{{ __('Click here to see all your purchased products') }}</a>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<footer>
    @include('partials.footer')
</footer>
<x-language-selector />
</body>
</html>
