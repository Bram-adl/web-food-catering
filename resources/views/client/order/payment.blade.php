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
    <div id="app">
        <order-payment>
            <template #navbar>
                <navbar>
                    <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout').submit()">
                        <i class="fas fa-power-off text-white md:text-red-500"></i>
                        <span class="hidden md:inline-block ml-2">Logout</span>
                    </a>
                    <form action="{{ action('AuthController@logout') }}" method="post" id="logout">@csrf</form>
                </navbar>
            </template>
        </order-payment>
    </div>

    <script>
        var user = @json($user);
        var paket = @json($paket);
        var pembelian = @json($pembelian);
    </script>
</body>
</html>