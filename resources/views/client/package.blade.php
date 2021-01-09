<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="X-UA-Compatible" content="ie=edge">

    <!-- SEO Related Meta Tags -->
    <meta name="keywords" content="Catering Website, Website Catering, Online Catering, Catering Web, Web Catering">
    <meta name="description" content="Solusi kebutuhan panganmu. Pesan berbagai menu untuk keperluan kantor hingga menu anak kos. Dapatkan paket untuk dapat membeli menu dengan porsi lebih. Tidak perlu khawatir, kebutuhan makanan kamu akan kami penuhi.">
    <meta name="author" content="Senjani Kitchen">

    <!-- Web Title -->
    <title>Senjani Kitchen - Online Food Catering</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/solid.css" integrity="sha384-yo370P8tRI3EbMVcDU+ziwsS/s62yNv3tgdMqDSsRSILohhnOrDNl142Df8wuHA+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/regular.css" integrity="sha384-APzfePYec2VC7jyJSpgbPrqGZ365g49SgeW+7abV1GaUnDwW7dQIYFc+EuAuIx0c" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/brands.css" integrity="sha384-/feuykTegPRR7MxelAQ+2VUMibQwKyO6okSsWiblZAJhUSTF9QAVR0QLk6YwNURa" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/fontawesome.css" integrity="sha384-ijEtygNrZDKunAWYDdV3wAZWvTHSrGhdUfImfngIba35nhQ03lSNgfTJAKaGFjk2" crossorigin="anonymous">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Main Script -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
    <div id="app" class="main-wrapper h-screen overflow-hidden bg-gray-200 flex flex-col">
        <nav class="bg-gray-50 shadow-sm">
            <div class="container mx-auto flex items-center justify-between py-4 px-10 xl:px-0">
                <div class="flex-1">
                    <img src="/images/logo.jpg" alt="Logo" class="w-10 h-10 sm:w-16 sm:h-16 rounded-full">
                </div>

                <div class="text-gray-800 text-sm">
                    <ul class="text-sm inline-block">
                        <li class="flex items-center justify-center sm:grid grid-cols-2 gap-4">
                            <a class="opacity-50 hover:opacity-100 transition ease-out duration-300" href="/">Home</a>
                            <a class="opacity-50 hover:opacity-100 transition ease-out duration-300" href="/#daftar-menu">Daftar Menu</a>
                        </li>
                    </ul>
                    
                    <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout').submit()" class="ml-5 sm:ml-10">
                        <button class="group">
                            <i class="fas fa-power-off text-red-500"></i>
                            <span class="group-hover:text-red-500 transition ease-out duration-300 ml-1 sm:ml-2">Logout</span>
                        </button>
                    </a>

                    <form action="/logout" method="post" id="logout" class="hidden">@csrf</form>
                </div>
            </div>
        </nav>
        <!-- /.nav -->

        <main class="flex-1 overflow-auto">
            <payment></payment>
        </main>
        <!-- /.main -->
    </div>

    <script>
        const user = @json(Auth::user());
        const paket = @json($paket);
        const kategori = @json($paket->kategori);
        window.user = user;
        window.paket = paket;
        window.kategori = kategori;
    </script>
</body>
</html>