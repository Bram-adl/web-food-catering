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
    <div id="app" class="main-wrapper">
        <header class="main-header h-screen relative">
            <nav class="container mx-auto">
                <div class="text-gray-50 text-xs flex items-center justify-between py-4 px-4 xl:px-0">
                    <div>
                        <a href="https://wa.me/628980235444" class="whatsapp inline-block transform hover:-translate-y-0.5 transition duration-300 ease-out">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://www.instagram.com/senjanikitchen/" class="instagram ml-2 inline-block transform hover:-translate-y-0.5 transition duration-300 ease-out">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                    <!-- /.header-socmed -->

                    <div>
                        <p class="text-gray-50">CV. SENJANI TEKNO BOGA</p>
                    </div>
                    <!-- /.header-contact -->
                </div>
                <!-- /.top-nav -->

                <div class="bg-gray-50 text-black text-sm flex items-center justify-between py-2 px-4">
                    <div>
                        <a href="/">
                            <img src="/images/logo.jpg" alt="logo" class="w-20 h-20" />
                        </a>
                    </div>
                    <!-- /.header-logo -->

                    <div>
                        <ul class="nav-link flex items-center justify-center text-gray-800">
                            @auth
                            <li class="text-red-500 relative">
                                <a href="/profile/{{ Auth::id() }}/{{ (join("", explode(" ", Auth::user()->nama))) }}">
                                    <button class="focus:outline-none border border-red-500 py-2 px-8 hover:text-gray-50 hover:bg-red-500 transition ease-out duration-300">
                                        <i class="fas fa-user"></i>
                                        {{ Auth::user()->nama }}
                                    </button>
                                </a>
                            </li>
                            @else
                            <li class="text-red-500 relative">
                                <a href="/login">
                                <button class="focus:outline-none border border-red-500 py-2 px-8 hover:text-gray-50 hover:bg-red-500 transition ease-out duration-300">Login</button>
                                </a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                    <!-- /.header-links -->
                </div>
                <!-- /.bottom-nav -->
            </nav>
            <!-- /.nav -->

            <main class="main-content text-gray-50 text-center">
                <div>
                    <p class="text-sm md:text-md font-medium tracking-widest uppercase">Daily Catering atau Event Catering</p>
                </div>
                <div class="my-6 border-t border-b border-yellow-500 py-4 md:px-6 mx-6">
                    <h1 class="text-4xl md:text-6xl xl:text-8xl font-bold uppercase whitespace-nowrap">Senjani Kitchen</h1>
                </div>
                <div>
                    <p class="text-sm font-light">Solusi kebutuhan panganmu. Pesan berbagai menu untuk keperluan kantor hingga menu anak kos. Dapatkan paket untuk dapat membeli menu dengan porsi lebih. Tidak perlu khawatir, kebutuhan makanan kamu akan kami penuhi.</p>
                </div>
                <div class="mt-8">
                    <a href="#daftar-menu">
                        <button class="focus:outline-none border border-yellow-500 text-yellow-500 py-2 px-8 hover:text-gray-50 hover:bg-yellow-500 transition ease-out duration-300">Daftar Menu</button>
                    </a>
                </div>
            </main>
        </header>
        <!-- ./header -->

        <section class="text-gray-800 py-16 lg:py-36 px-10 xl:px-0">
            <div class="container mx-auto">
                <div class="section-title flex items-center justify-center">
                    <h2 class="text-xl md:text-2xl lg:text-4xl font-bold font-serif uppercase tracking-widest relative">Daily Catering</h2>
                </div>
                <!-- /.section-title -->
                
                <div class="mt-10 lg:mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12 justify-items-center">
                    <div class="flex flex-col items-center text-center">
                        <div class="border-2 rounded-full p-8 md:p-10">
                            <img src="/images/home/ongkir.png" class="w-10 md:w-20 h-10 md:h-20" alt="Gratis Ongkos Kirim">
                        </div>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Gratis Ongkos Kirim</h3>
                        <p class="text-sm font-light leading-tight px-8 md:px-0">Seluruh Kota Malang, sebagian Kabupaten Malang, dan sebagian Kota Batu.</p>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <div class="border-2 rounded-full p-8 md:p-10">
                            <img src="/images/home/menu.png" class="w-10 md:w-20 h-10 md:h-20" alt="Menu Variatif">
                        </div>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Menu Variatif</h3>
                        <p class="text-sm font-light leading-tight px-8 md:px-0">Tersedia lebih dari 400 pilihan menu. Enggak bakal ngebosenin deh.</p>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <div class="border-2 rounded-full p-8 md:p-10">
                            <img src="/images/home/jadwal.png" class="w-10 md:w-20 h-10 md:h-20" alt="Bebas Pilih Jadwal Pengiriman">
                        </div>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Bebas Pilih Jadwal Pengiriman</h3>
                        <p class="text-sm font-light leading-tight px-8 md:px-0">Tentukan jadwal katering, bisa skip, dan cancel dengan sangat mudah loh.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./daily-catering-section -->

        <section class="daily-catering-section text-gray-50 py-16 lg:py-36">
            <daily-catering id="daftar-menu"></daily-catering>
        </section>

        <section class="text-gray-800 py-16 lg:py-36 px-10 xl:px-0">
            <div class="container mx-auto">
                <div class="section-title flex items-center justify-center">
                    <h2 class="text-xl md:text-2xl lg:text-4xl font-bold font-serif uppercase tracking-widest relative">Event Catering</h2>
                </div>
                <!-- /.section-title -->
                
                <div class="mt-10 lg:mt-20 grid grid-cols-1 lg:grid-cols-3 gap-12 justify-items-center">
                    <div class="flex flex-col items-center text-center">
                        <div class="border-2 rounded-full p-8 md:p-10">
                            <img src="/images/home/ongkir.png" class="w-10 md:w-20 h-10 md:h-20" alt="Gratis Ongkos Kirim">
                        </div>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Gratis Ongkos Kirim</h3>
                        <p class="text-sm font-light leading-tight px-8 md:px-0">Seluruh Area Di Malang Raya.</p>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <div class="border-2 rounded-full p-8 md:p-10">
                            <img src="/images/home/konsul.png" class="w-10 md:w-20 h-10 md:h-20" alt="Konsultasi Menu">
                        </div>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Konsultasi Menu</h3>
                        <p class="text-sm font-light leading-tight px-8 md:px-0">Feel Free Konsultasi Atau Request Menu.</p>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <div class="border-2 rounded-full p-8 md:p-10">
                            <img src="/images/home/desain.png" class="w-10 md:w-20 h-10 md:h-20" alt="Bebas Pilih Jadwal Pengiriman">
                        </div>
                        <h3 class="text-xl font-semibold mt-4 mb-2">Bisa Desain Sendiri Kemasanmu</h3>
                        <p class="text-sm font-light leading-tight px-8 md:px-0">Bisa Jika Kami Desainkan Supaya Acara Kamu Makin Kece.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./event-catering-section -->

        <section class="event-catering-section text-gray-50 py-16 lg:py-36">
            <div class="container mx-auto">
                <div class="px-10 xl:px-0">
                    <h2 class="subtitle-text text-lg font-semibold tracking-widest inline-block">Kreasikan Pilihan Menu Sendiri Atau Konsultasikan Pilihan Menumu Bersama Kami.</h2>
                </div>
            </div>
        </section>

        <section class="container mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 py-16 px-10 xl:px-0">
            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-meal-box.jpg" class="relative z-10 w-full h-full object-cover" alt="Meal Box">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Meal Box</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->

            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-prasmanan-pelayanan.jpg" class="relative z-10 w-full h-full object-cover" alt="Prasmanan Dengan Pelayanan">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Prasmanan Dengan Pelayanan</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->

            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-prasmanan-tanpa.jpg" class="relative z-10 w-full h-full object-cover" alt="Prasmanan Tanpa Pelayanan">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Prasmanan Tanpa Pelayanan</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->

            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-.jpg" class="relative z-10 w-full h-full object-cover" alt="Aneka Macam Snack">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Aneka Macam Snack</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->

            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-kambing-guling.jpg" class="relative z-10 w-full h-full object-cover" alt="Kambing Guling">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Kambing Guling</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->

            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-tumpeng.jpg" class="relative z-10 w-full h-full object-cover" alt="Nasi Tumpeng">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Nasi Tumpeng</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->

            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-aqiqah.jpg" class="relative z-10 w-full h-full object-cover" alt="Aqiqah">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Aqiqah</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->

            <div class="event-card rounded-lg bg-white shadow-md overflow-hidden relative">
                <div class="w-full h-80 relative">
                    <div class="overlay"></div>
                    <img src="/images/foods/event-bento-box.jpg" class="relative z-10 w-full h-full object-cover" alt="Bento Box">
                </div>
                <div class="card-content absolute z-20 inset-x-0 inset-y-0 flex flex-col items-center justify-center">
                    <h2 class="text-lg text-center font-semibold uppercase text-white">Bento Box</h2>
                    <a href="https://wa.me/+628980235444" target="_blank" class="mt-4">
                        <button class="border border-yellow-500 rounded-md text-yellow-500 py-2 px-4 hover:bg-yellow-500 hover:text-gray-50 transition ease-out duration-300">Hubungi Kami</button>
                    </a>
                </div>
            </div>
            <!-- /.single-card -->
        </section>

        <footer class="main-footer py-16 px-10 xl:px-0 text-gray-50">
            <div class="container mx-auto text-center">
                <div class="text-center">
                    <a href="#">
                        <img src="/images/logo2.jpg" class="inline-block rounded-full w-20 lg:w-48 h-20 lg:h-48" alt="Footer Logo">
                    </a>
                </div>
                <div class="my-16">
                    <h2 class="text-yellow-500 mb-6">Layanan Kami</h2>
                    <ul class="text-sm grid gap-2">
                        <li>Daily Catering</li>
                        <li>Family Pack</li>
                        <li>Nasi Kotak</li>
                        <li>Nasi Tumpeng</li>
                        <li>Prasmanan</li>
                        <li>Aqiqah</li>
                        <li>Snack</li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-yellow-500 mb-6">Hubungi Kami</h2>
                    <ul class="text-sm grid gap-2">
                        <li>CV. SENJANI TEKNO BOGA</li>
                        <li><a href="https://g.page/senjanikitchen">De Cluster Nirwana Blok E-2, Kel. Pandanwangi, Kec. Blimbing, Kota Malang</a></li>
                        <li><a href="https://www.instagram.com/senjanikitchen/">Senjanikitchen</a></li>
                        <li><a href="https://wa.me/628980235444">08980235444</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <script>
        const foods = @json($foods);
        const user = @json($user);
        window.foods = foods;
    </script>
</body>
</html>