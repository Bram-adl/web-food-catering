<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Web Title -->
    <title>Senjani Kitchen - Login Page</title>

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
        <authentication>
            <template #login-form>
                <form
                    action="{{ action('AuthController@authenticate', ['query' => $redirect_to]) }}"
                    method="post"
                    class="flex flex-col items-center justify-center w-full h-full"
                >
                    @csrf
                    <div>
                        <img src="/images/logo.jpg" class="w-20 h-20" alt="Logo" />
                    </div>

                    <div class="my-4 w-full px-16">
                        <input
                            type="email"
                            class="focus:outline-none bg-transparent w-full border-b rounded-md block px-4 py-2 text-md text-gray-800 @error('email') border-red-500 @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Email Address"
                            ref="loginEmail"
                        />
                        @error('email')
                            <div class="span text-sm text-red-500 italic mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-4 w-full px-16">
                        <input
                            type="password"
                            class="focus:outline-none bg-transparent w-full border-b rounded-md block px-4 py-2 text-md text-gray-800 @error('password') border-red-500 @enderror"
                            name="password"
                            value="{{ old('password') }}"
                            placeholder="Password"
                        />
                        @error('password')
                            <div class="span text-sm text-red-500 italic mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="my-4 w-full px-16 text-center">
                        <button
                            type="submit"
                            class="focus:outline-none px-8 py-2 text-yellow-500 border border-yellow-500 rounded-lg hover:text-gray-50 hover:bg-yellow-500 transition ease-out duration-300"
                        >
                            Login
                        </button>
                    </div>
                </form>
            </template>

            <template #register-form>
                <form
                    action="{{ action('AuthController@register') }}"
                    method="post"
                    class="flex flex-col items-center justify-center w-full h-full"
                >
                    <div class="my-4 w-full px-16">
                        <input
                            type="text"
                            class="focus:outline-none bg-transparent w-full border-b rounded-md px-4 py-2 text-md text-gray-800"
                            placeholder="Nama Lengkap"
                            ref="registerNama"
                        />
                    </div>

                    <div class="my-4 w-full px-16">
                        <input
                            type="email"
                            class="focus:outline-none bg-transparent w-full border-b rounded-md px-4 py-2 text-md text-gray-800"
                            placeholder="Email Address"
                        />
                    </div>

                    <div class="my-4 w-full px-16">
                        <input
                            type="password"
                            class="focus:outline-none bg-transparent w-full border-b rounded-md px-4 py-2 text-md text-gray-800"
                            placeholder="Password"
                        />
                    </div>

                    <div class="my-4 w-full px-16 text-center">
                        <button
                            type="submit"
                            class="focus:outline-none px-8 py-2 text-yellow-500 border rounded-lg hover:text-gray-50 hover:bg-yellow-500 transition ease-out duration-300"
                        >
                            Daftar
                        </button>
                    </div>
                </form>
            </template>
        </authentication>
    </div>

    <!-- SweetAlert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Page Script -->
    @if(session('status'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            })

            Toast.fire({
                icon: 'error',
                title: @json(session('status')),
            })
        </script>
    @endif
</body>
</html>