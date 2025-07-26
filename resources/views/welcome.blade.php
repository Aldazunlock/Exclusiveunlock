<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ExclusiveUnlock - Professional Device Unlocking Services</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.cdn.tailwindcss.com">
    </script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* Burbuja flotante */
        .chat-bubble {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            z-index: 9999;
        }

        .chat-bubble:hover {
            background-color: #0056b3;
        }

        /* Ventana del chat */
        .chat-window {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 320px;
            max-height: 500px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 9998;
        }

        .chat-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chat-messages {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
            font-size: 14px;
            background: #f9f9f9;
        }

        .chat-input {
            border-top: 1px solid #ddd;
            display: flex;
            padding: 10px;
        }

        .chat-input input {
            flex: 1;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 8px 12px;
        }

        .chat-input button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 8px 12px;
            margin-left: 8px;
            border-radius: 20px;
            cursor: pointer;
        }

        .close-chat {
            cursor: pointer;
        }

        .msg.user {
            text-align: right;
            color: #007bff;
            margin-bottom: 8px;
        }

        .msg.bot {
            text-align: left;
            color: #333;
            margin-bottom: 8px;
        }

        @keyframes glowing {
            0% {
                box-shadow: 0 0 8px #008a8c, 0 0 16px #008a8c, 0 0 24px #008a8c, 0 0 32px #008a8c;
            }

            50% {
                box-shadow: 0 0 6px #008a8c, 0 0 12px #008a8c, 0 0 18px #008a8c, 0 0 24px #008a8c;
            }

            100% {
                box-shadow: 0 0 8px #008a8c, 0 0 16px #008a8c, 0 0 24px #008a8c, 0 0 32px #008a8c;
            }
        }

        .styleDistribuidor,
        .styleNoticias,
        .style2,
        .style3 {
            border: 2px solid #008a8c;
            animation: glowing 1.5s infinite alternate;
        }

        .styleDistribuidor {
            color: #fff;
            background: linear-gradient(90deg, rgba(0, 255, 0, 1) 0%, rgba(0, 129, 24, 1) 100%);
            line-height: 20px;
            padding: 5px;
            font-weight: bold;
        }

        .styleNoticias {
            color: #000000;
            background: linear-gradient(90deg, rgba(34, 139, 34, 1) 0%, rgba(107, 142, 35, 1) 50%, rgba(173, 255, 47, 1) 100%);
            line-height: 20px;
            padding: 5px;
            font-weight: bold;
        }

        .style2 {
            color: #232323;
            background: linear-gradient(90deg, rgba(224, 255, 0, 1) 0%, rgba(0, 255, 0, 1) 100%);
            line-height: 20px;
            padding: 5px;
            font-weight: bold;
        }

        .style3 {
            color: #000000;
            background: linear-gradient(90deg, rgba(34, 165, 0, 1) 0%, rgba(224, 255, 0, 1) 100%);
            line-height: 20px;
            padding: 5px;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            background-color: #1e40af;
            color: #fff;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn:hover {
            background-color: #1e3a8a;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.4);
        }

        .telegram-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .telegram-float {
            background: linear-gradient(135deg, #0088cc, #0077bb);
            color: white;
            padding: 16px 18px;
            border-radius: 50%;
            font-size: 24px;
            box-shadow: 0 6px 20px rgba(0, 136, 204, 0.4);
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 56px;
            height: 56px;
        }


        .telegram-float:hover {
            transform: scale(1.1) translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 136, 204, 0.5);
        }

        .telegram-tooltip {
            background: linear-gradient(135deg, #374151, #1f2937);
            color: #fff;
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 12px;
            font-size: 14px;
            max-width: 220px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            animation: fadeInTooltip 1.5s ease-out both;
            user-select: none;
        }

        @keyframes fadeInTooltip {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }



        /* Burbuja chat flotante */
        #chatBubble {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        #chatBubble:hover {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>

<body>
    <!-- Mensajes tipo Marquee -->
    <marquee class="styleDistribuidor" direction="right" scrollamount="4">
        ✅⚡️Informes del panel de control - Reserva de reparación móvil con todos los parámetros básicos de inspección⚡️✅
    </marquee>
    <marquee class="style3" direction="right" scrollamount="4" behavior="alternate"
        onclick="window.open('https://t.me/ServerTeamSaul', '_blank'); return false;">
        Gestión de múltiples tiendas - Inicio de sesión de múltiples usuarios - Gestión de clientes
    </marquee>
    <marquee class="style2" direction="right" scrollamount="4" behavior="alternate"
        onclick="window.open('https://t.me/ServerTeamSaul', '_blank'); return false;">
        💜✨★ Facturas con impresora térmica - Facturas de impresora de arrendamiento - Sin limitaciones ★✨💜
    </marquee>
    <header>
        <div class="bg-gray-800 text-white py-2 hidden lg:block">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between">
                    <div class="flex space-x-4">
                        <span class="flex items-center text-gray-300"><i class="fas fa-phone mr-2"></i>
                            9999999999</span>
                        <span class="flex items-center text-gray-300"><i class="fas fa-envelope mr-2"></i>
                            contactus@yoursite.com</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="relative group">
                            <button class="flex items-center">
                                <span>$</span>
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </button>
                            <div
                                class="hidden group-hover:block absolute right-0 mt-2 w-32 bg-white rounded-md shadow-lg z-10">
                                <a href="#" onclick="setCurrencyTo(1)"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">$</a>
                                <a href="#" onclick="setCurrencyTo(2)"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">RM</a>
                                <a href="#" onclick="setCurrencyTo(3)"
                                    class="block px-4 py-2 text-gray-800 hover:bg-gray-100">FG</a>
                            </div>
                        </div>
                        <div class="relative group">
                            <button class="flex items-center">
                                <span class="flag flag-gb mr-1"></span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <div
                                class="hidden group-hover:block absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 overflow-y-auto max-h-96">
                                <a href="?selectlanguage=Chinese&lcode=CN"
                                    class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100"><span
                                        class="flag flag-cn mr-3"></span> Chinese</a>
                                <a href="?selectlanguage=French&lcode=FR"
                                    class="flex items-center px-4 py-2 text-gray-800 hover:bg-gray-100"><span
                                        class="flag flag-fr mr-3"></span> French</a>
                                <!-- More language options here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main header -->
        <div class="py-4 relative">
            <div class="container mx-auto px-4">
                <nav class="flex items-center justify-between">
                    <div class="lg:hidden">
                        <button class="navbar-toggler p-2" type="button" data-toggle="modal"
                            data-target="#navbarToggler1">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>

                    <a href="#" class="navbar-brand text-2xl font-bold text-gray-800">ExclusiveRepair</a>

                    <div class="hidden lg:flex items-center space-x-6">
                        <a href="./index" class="nav-link hover:text-blue-600">Home</a>

                        <div class="relative group">
                            <a href="./productsandservices/imei" class="nav-link hover:text-blue-600 flex items-center">
                                <i class="fas fa-chevron-down ml-1 text-xs"></i>
                            </a>

                        </div>

                        <a href="./admin/login" class="nav-link hover:text-blue-600">Registration</a>


                        <a href="/admin/login"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center">
                            <i class="fas fa-lock mr-2"></i> Login</a>

                    </div>

                    <div class="flex items-center lg:hidden">
                        <button class="p-2">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!-- Carrusel de imágenes Bootstrap -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="public/image/3.jpg" class="d-block w-100" alt="Imagem 1">

            </div>
            <div class="carousel-item">
                <img src="image/2.jpg" class="d-block w-100" alt="Imagen 2">
            </div>
            <div class="carousel-item">
                <img src="image/3.jpg" class="d-block w-100" alt="Imagen 3">
            </div>
        </div>

        <!-- Botón anterior -->
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"
                style="background-color: rgba(0,0,0,0.5); border-radius: 50%;"></span>
            <span class="sr-only">Anterior</span>
        </a>

        <!-- Botón siguiente -->
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"
                style="background-color: rgba(0,0,0,0.5); border-radius: 50%;"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>

    <!-- Scripts necesarios -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Script personalizado para cambio automático -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-item');
            let slideIndex = 0;

            function showSlide(n) {
                slides.forEach(slide => slide.classList.remove('active'));
                slides[n].classList.add('active');
            }

            function nextSlide() {
                slideIndex = (slideIndex + 1) % slides.length;
                showSlide(slideIndex);
            }

            function prevSlide() {
                slideIndex = (slideIndex - 1 + slides.length) % slides.length;
                showSlide(slideIndex);
            }

            document.querySelector('.carousel-control-prev').addEventListener('click', e => {
                e.preventDefault();
                prevSlide();
            });

            document.querySelector('.carousel-control-next').addEventListener('click', e => {
                e.preventDefault();
                nextSlide();
            });

            setInterval(nextSlide, 3000);
        });
    </script>


    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__bounceIn">
                    <div class="text-center">
                        <i class="fas fa-tools text-5xl text-blue-600 mb-4"></i>
                        <h2 class="text-2xl font-semibold mb-3">Gestión de Reparaciones</h2>
                        <p class="text-gray-600">Organiza y controla todas las órdenes de servicio. Registra fallas,
                            repuestos utilizados y tiempos de entrega fácilmente.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div
                    class="bg-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__bounceIn">
                    <div class="text-center">
                        <i class="fas fa-print text-5xl mb-4"></i>
                        <h2 class="text-2xl font-semibold mb-3">Impresión Térmica</h2>
                        <p>Imprime tickets de ingreso, comprobantes y facturas en segundos con impresoras térmicas
                            compatibles con tu taller.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__bounceIn">
                    <div class="text-center">
                        <i class="fas fa-user-friends text-5xl text-blue-600 mb-4"></i>
                        <h2 class="text-2xl font-semibold mb-3">Control de Clientes</h2>
                        <p class="text-gray-600">Lleva un historial detallado de tus clientes y sus dispositivos, con
                            notificaciones automáticas por WhatsApp o correo.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <!-- Feature 4 -->
                <div
                    class="bg-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__bounceIn">
                    <div class="text-center">
                        <i class="fas fa-shield-alt text-5xl mb-4"></i>
                        <h2 class="text-2xl font-semibold mb-3">Seguridad en la Información</h2>
                        <p>Todos tus datos están protegidos y respaldados. Accede al sistema con usuarios con roles y
                            permisos personalizados.</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div
                    class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__bounceIn">
                    <div class="text-center">
                        <i class="fas fa-chart-line text-5xl text-blue-600 mb-4"></i>
                        <h2 class="text-2xl font-semibold mb-3">Reportes en Tiempo Real</h2>
                        <p class="text-gray-600">Consulta reportes de ventas, ingresos por técnico, repuestos más
                            utilizados y estadísticas diarias o mensuales.</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div
                    class="bg-blue-600 text-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 animate__animated animate__bounceIn">
                    <div class="text-center">
                        <i class="fas fa-bolt text-5xl mb-4"></i>
                        <h2 class="text-2xl font-semibold mb-3">Flujo Rápido y Eficiente</h2>
                        <p>Desde el ingreso del equipo hasta la entrega final, cada proceso está optimizado para que tu
                            atención sea ágil y profesional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Beneficios POS Taller -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-bold mb-6 text-center">
                    <span>Administra tu taller fácilmente con nuestro sistema POS</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Cliente -->
                    <div class="flex items-start">
                        <div class="bg-green-100 p-3 rounded-full mr-4">
                            <i class="fas fa-user-cog text-green-600 text-2xl"></i>
                        </div>
                        <div class="border-l-2 border-green-200 pl-4">
                            <h5 class="text-lg font-semibold text-green-600 mb-2">Gestión de clientes</h5>
                            <p class="text-gray-600">Registra y gestiona clientes con historial de reparaciones, datos
                                de contacto y seguimiento detallado.</p>
                        </div>
                    </div>

                    <!-- Inventario -->
                    <div class="flex items-start">
                        <div class="bg-yellow-100 p-3 rounded-full mr-4">
                            <i class="fas fa-boxes text-yellow-600 text-2xl"></i>
                        </div>
                        <div class="border-l-2 border-yellow-200 pl-4">
                            <h5 class="text-lg font-semibold text-yellow-600 mb-2">Control de inventario</h5>
                            <p class="text-gray-600">Lleva un control preciso del stock, repuestos y productos vendidos
                                o utilizados en reparaciones.</p>
                        </div>
                    </div>

                    <!-- Tickets -->
                    <div class="flex items-start">
                        <div class="bg-blue-100 p-3 rounded-full mr-4">
                            <i class="fas fa-receipt text-blue-600 text-2xl"></i>
                        </div>
                        <div class="border-l-2 border-blue-200 pl-4">
                            <h5 class="text-lg font-semibold text-blue-600 mb-2">Impresión de tickets</h5>
                            <p class="text-gray-600">Emite tickets con impresoras térmicas para cada orden de servicio,
                                venta o reparación.</p>
                        </div>
                    </div>

                    <!-- Reportes -->
                    <div class="flex items-start">
                        <div class="bg-purple-100 p-3 rounded-full mr-4">
                            <i class="fas fa-chart-line text-purple-600 text-2xl"></i>
                        </div>
                        <div class="border-l-2 border-purple-200 pl-4">
                            <h5 class="text-lg font-semibold text-purple-600 mb-2">Reportes detallados</h5>
                            <p class="text-gray-600">Obtén reportes de ingresos, reparaciones, técnicos, servicios más
                                utilizados y más.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div>
                    <h4 class="text-xl font-bold uppercase mb-4">ExclusiveRepair</h4>
                    <div class="flex space-x-4 mb-4">
                        <a href="https://www.facebook.com/" target="_blank" class="text-gray-300 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" class="text-gray-300 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="viewrss" target="_blank" class="text-gray-300 hover:text-white">
                            <i class="fas fa-rss"></i>
                        </a>
                    </div>
                </div>

                <!-- Useful Links -->
                <div>
                    <h5 class="text-lg font-semibold mb-4">Useful Links</h5>
                    <ul class="space-y-2">
                        <li><a href="./contactus" class="text-gray-300 hover:text-white">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h5 class="text-lg font-semibold mb-4">Subscribe</h5>
                    <p class="text-gray-300 mb-4">Don't miss our future updates! Get Subscribed now!</p>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center"
                        data-toggle="modal" data-target="#newsletters">
                        <i class="fas fa-envelope-open-text mr-2"></i> Newsletter
                    </button>
                </div>

                <!-- Contact Info -->
                <div>
                    <h5 class="text-lg font-semibold mb-4">Connect With Us</h5>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-phone mr-2"></i> 9999999999
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-envelope mr-2"></i> contactus@yoursite.com
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <small>&copy; 2025 ExclusiveUnlock. All rights reserved</small>
                </div>
                <div>
                    <img src="templates/default/images/payment_logo.png" alt="Payment Methods" class="h-8">
                </div>
            </div>
        </div>
    </footer>

    <!-- Cookie Consent -->
    <<a href="https://mail.hostinger.com/?clearSession=true&_user=ssh@dashingapp.finance&_gl=..." target="_blank"
        rel="noopener noreferrer" class="position-fixed bottom-0 end-0 m-4 btn btn-success shadow">
        <i class="fas fa-envelope"></i> Correo
        </a>



        <!-- Telegram container -->
        <div class="telegram-container">
            <div class="telegram-tooltip">
                ¡Contáctanos por Telegram para soporte inmediato!
            </div>
            <a href="#" class="telegram-float">
                <i class="fab fa-telegram-plane"></i>
            </a>
        </div>

        <!-- Login Modal -->
        <div id="login" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">Login to Your Account</h3>
                    <button onclick="document.getElementById('login').classList.add('hidden')"
                        class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="login_forms17" class="space-y-4">
                    <div class="alert alert-login hidden mb-4 p-3 rounded bg-red-100 text-red-700"></div>

                    <div class="form-group">
                        <div class="flex items-center border rounded overflow-hidden">
                            <span class="bg-gray-100 px-3 py-2"><i class="fas fa-user"></i></span>
                            <input type="text" name="username" placeholder="Username"
                                class="flex-1 px-3 py-2 outline-none">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="flex items-center border rounded overflow-hidden">
                            <span class="bg-gray-100 px-3 py-2"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" placeholder="Password"
                                class="flex-1 px-3 py-2 outline-none">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <a href="./resetpassword/?standalone=true" class="text-sm text-blue-600 hover:underline">Forgot
                            Password?</a>
                    </div>

                    <button type="button"
                        onclick="SubmitFormJSON('#btn-login','./widget/save/register/actions/login','#login_forms17','.alert-login','true','#loader');"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-md" id="btn-login">
                        Login
                    </button>

                    <div class="text-center text-sm">
                        Don't have an account? <a href="./register" class="text-blue-600 hover:underline">Register</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Newsletter Modal -->
        <div id="newsletters" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold">Newsletter</h3>
                    <button onclick="document.getElementById('newsletters').classList.add('hidden')"
                        class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>


                <!-- Newsletter -->
                <div>
                    <h5 class="text-md font-semibold mb-4">Subscribe</h5>
                    <p class="text-gray-300 mb-4">Don't miss our future updates! Get Subscribed now!</p>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center"
                        data-toggle="modal" data-target="#newsletters">
                        <i class="fas fa-envelope-open-text mr-2"></i> Newsletter
                    </button>
                </div>

                <!-- Contact Info -->
                <div>
                    <h5 class="text-lg font-semibold mb-4">Connect With Us</h5>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-phone mr-2"></i> 9999999999
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-envelope mr-2"></i> contactus@yoursite.com
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <small>&copy; 2025 ExclusiveUnlock. All rights reserved</small>
                </div>
                <div>
                    <img src="templates/default/images/payment_logo.png" alt="Payment Methods" class="h-8">
                </div>
            </div>
        </div>
        </footer>

        <!-- Cookie Banner -->
        <div id="cookieBanner" class="fixed bottom-0 left-0 right-0 bg-black text-white p-4 z-50 shadow-md">
            <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                <div class="mb-2 md:mb-0 md:mr-4 text-sm">
                    Esta web utiliza cookies para garantizar la mejor experiencia.
                    <a href="javascript:void(0)" onclick="openSettings()" class="text-orange-400 underline ml-1">Cambiar
                        configuración</a>
                </div>
                <div class="flex items-center gap-2">
                    <button onclick="acceptCookies()"
                        class="bg-green-600 hover:bg-green-700 px-4 py-1 rounded text-white text-sm">Aceptar</button>
                    <button onclick="closeCookie()"
                        class="text-white hover:text-red-400 text-xl font-bold leading-none">×</button>
                </div>
            </div>
        </div>

        <!-- Modal Configuración de Cookies -->
        <div id="COOKIESETT" class="hidden fixed inset-0 bg-black bg-opacity-95 text-white p-6 z-50 overflow-auto">
            <div class="max-w-lg mx-auto bg-gray-800 rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">Configuración de cookies</h2>
                <p class="text-sm mb-4">Puedes seleccionar qué tipo de cookies quieres permitir.</p>

                <label class="flex items-center mb-2">
                    <input type="checkbox" checked disabled class="mr-2"> Cookies necesarias (obligatorias)
                </label>
                <label class="flex items-center mb-2">
                    <input type="checkbox" id="analytics" class="mr-2"> Cookies de análisis
                </label>
                <label class="flex items-center mb-4">
                    <input type="checkbox" id="marketing" class="mr-2"> Cookies de marketing
                </label>

                <div class="flex justify-end gap-3">
                    <button onclick="saveSettings()"
                        class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-sm">Guardar</button>
                    <button onclick="closeSettings()" class="text-white hover:text-red-400 text-sm">Cancelar</button>
                </div>
            </div>
        </div>




        </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                if (!localStorage.getItem("cookiesAccepted")) {
                    document.getElementById("cookieBanner").style.display = "block";
                }
            });

            function acceptCookies() {
                localStorage.setItem("cookiesAccepted", "true");
                document.getElementById("cookieBanner").style.display = "none";
            }

            function closeCookie() {
                document.getElementById("cookieBanner").style.display = "none";
            }

            function openSettings() {
                document.getElementById("COOKIESETT").classList.remove("hidden");
                document.getElementById("cookieBanner").classList.add("hidden");
            }

            function closeSettings() {
                document.getElementById("COOKIESETT").classList.add("hidden");
                document.getElementById("cookieBanner").classList.remove("hidden");
            }

            function saveSettings() {
                const analytics = document.getElementById("analytics").checked;
                const marketing = document.getElementById("marketing").checked;

                localStorage.setItem("cookieSettings", JSON.stringify({
                    analytics,
                    marketing,
                    accepted: true
                }));

                document.getElementById("COOKIESETT").classList.add("hidden");
        </script>
        <!-- Incluir Bootstrap JS e dependências -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const carousel = document.querySelector('.carousel-inner');
                const slides = document.querySelectorAll('.carousel-item');
                const totalSlides = slides.length;
                let slideIndex = 0;

                function showSlide(n) {
                    slides.forEach((slide) => {
                        slide.classList.remove('active');
                    });
                    slides[n].classList.add('active');
                }

                function nextSlide() {
                    slideIndex = (slideIndex + 1) % totalSlides;
                    showSlide(slideIndex);
                }

                function prevSlide() {
                    slideIndex = (slideIndex - 1 + totalSlides) % totalSlides;
                    showSlide(slideIndex);
                }

                document.querySelector('.carousel-control-prev').addEventListener('click', () => {
                    prevSlide();
                });

                document.querySelector('.carousel-control-next').addEventListener('click', () => {
                    nextSlide();
                });

                setInterval(nextSlide, 3000); // Intervalo de 3 segundos para trocar automaticamente os slides
            });
        </script>
        <!-- ✅ Botón flotante de asistencia -->
        <style>
            #chatToggle {
                position: fixed;
                bottom: 25px;
                right: 25px;
                background-color: #e63946;
                color: white;
                border: none;
                border-radius: 50%;
                width: 60px;
                height: 60px;
                font-size: 28px;
                cursor: pointer;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
                z-index: 1000;
            }

            #chatBox {
                position: fixed;
                bottom: 100px;
                right: 25px;
                width: 300px;
                background: #fff;
                border: 1px solid #ccc;
                border-radius: 12px;
                padding: 15px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
                display: none;
                z-index: 1001;
                font-family: 'Segoe UI', sans-serif;
            }

            #chatBox h4 {
                margin-bottom: 10px;
                color: #e63946;
            }

            .chat-btn {
                display: block;
                background-color: #f1f1f1;
                border: none;
                margin: 8px 0;
                padding: 10px;
                border-radius: 8px;
                text-align: left;
                cursor: pointer;
                transition: background 0.3s ease;
            }

            .chat-btn:hover {
                background-color: #ddd;
            }

            .chat-response {
                margin-top: 10px;
                background: #fafafa;
                padding: 10px;
                border-left: 3px solid #e63946;
                border-radius: 8px;
                display: none;
            }

            .email-contact {
                margin-top: 12px;
                font-size: 14px;
                color: #333;
            }

            .email-contact a {
                color: #e63946;
                font-weight: bold;
                text-decoration: none;
            }

            .email-contact a:hover {
                text-decoration: underline;
            }
        </style>

        <button id="chatToggle">💬</button>

        <div id="chatBox">
            <h4>¿Necesitas ayuda?</h4>
            <button class="chat-btn" onclick="showResponse('costo')">💸 ¿Cuánto cuesta?</button>
            <button class="chat-btn" onclick="showResponse('problema')">⚠️ Tengo un problema</button>

            <div id="costo" class="chat-response">
                El costo del servicio es de <strong>450 MXN</strong> o <strong>23 USDT</strong> por año.
                <div class="email-contact">
                    Contacto: <a href="mailto:ssh@dashingapp.finance">ssh@dashingapp.finance</a>
                </div>
            </div>

            <div id="problema" class="chat-response">
                Por favor cuéntanos cuál es tu problema y te ayudaremos lo antes posible.
                <div class="email-contact">
                    Escríbenos a: <a href="mailto:ssh@dashingapp.finance">ssh@dashingapp.finance</a>
                </div>
            </div>
        </div>

        <script>
            const toggleBtn = document.getElementById('chatToggle');
            const chatBox = document.getElementById('chatBox');

            toggleBtn.addEventListener('click', () => {
                chatBox.style.display = chatBox.style.display === 'block' ? 'none' : 'block';
            });

            function showResponse(id) {
                document.querySelectorAll('.chat-response').forEach(el => el.style.display = 'none');
                document.getElementById(id).style.display = 'block';
            }
        </script>

</body>

</html>