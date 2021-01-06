<template>
    <div class="h-screen overflow-hidden flex flex-col lg:flex-row bg-red">
        <div class="flex-1 overflow-hidden relative group">
            <div
                class="overlay-form absolute left-0 top-full w-full h-full p-16 text-gray-50"
                ref="login"
                style="background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(/images/hero-banner.jpeg) center center/cover fixed"
            >
                <div class="flex flex-col items-center justify-between lg:justify-center h-full">
                    <h2 class="text-2xl font-bold text-center">
                        Selamat Datang!
                    </h2>
                    <p class="text-md font-light text-center lg:my-6">
                        Silahkan daftar untuk membuat akun kemudian lanjutkan
                        pemesanan ya!
                    </p>
                    <div class="text-center">
                        <button
                            class="focus:outline-none border border-gray-50 rounded-md py-2 px-4"
                            @click="showLogin"
                        >
                            Login Akun
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.overlay -->

            <form
                method="post"
                @submit.prevent="loginUser"
                class="flex flex-col items-center justify-center w-full h-full"
            >
                <div>
                    <img src="/images/logo.jpg" class="w-20 h-20" alt="Logo" />
                </div>

                <div>
                    <span class="text-xs text-red-500">{{ login.errorMessage != null ? login.errorMessage : '' }}</span>
                </div>

                <div class="my-4 w-full px-16">
                    <input
                        type="email"
                        class="focus:outline-none bg-transparent w-full border-b rounded-md block px-4 py-2 text-md text-gray-800"
                        :class="login.errors.email != null ? 'border-red-500' : 'border-yellow-500'"
                        v-model="login.email"
                        placeholder="Email Address"
                        ref="loginEmail"
                    />
                    <span class="text-red-500 text-xs">{{ login.errors.email != null ? login.errors.email[0] : '' }}</span>
                </div>

                <div class="my-4 w-full px-16">
                    <input
                        type="password"
                        class="focus:outline-none bg-transparent w-full border-b rounded-md block px-4 py-2 text-md text-gray-800"
                        :class="login.errors.password != null ? 'border-red-500' : 'border-yellow-500'"
                        v-model="login.password"
                        placeholder="Password"
                    />
                    <span class="text-red-500 text-xs">{{ login.errors.password != null ? login.errors.password[0] : '' }}</span>
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
        </div>
        <!-- /.login-form -->
        
        <div class="flex-1 overflow-hidden relative group">
            <div
                class="overlay-form absolute left-0 top-0 w-full h-full p-16 text-gray-50"
                ref="register"
                style="background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)), url(/images/hero-banner.jpeg) center center/cover fixed"
            >
                <div class="flex flex-col items-center justify-between lg:justify-center h-full">
                    <h2 class="text-2xl font-bold text-center">Halo Kawan!</h2>
                    <p class="text-md font-light text-center lg:my-6">
                        Silahkan login terlebih dahulu untuk segera melakukan
                        pemesanan kamu!
                    </p>
                    <div class="text-center">
                        <button
                            class="focus:outline-none border border-gray-50 rounded-md py-2 px-4"
                            @click="showRegister"
                        >
                            Daftar Akun
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.overlay -->

            <form
                method="post"
                @submit.prevent="registerUser"
                class="flex flex-col items-center justify-center w-full h-full"
            >
                <div>
                    <span class="text-xs text-red-500">{{ register.errorMessage != null ? register.errorMessage : '' }}</span>
                </div>
            
                <div class="my-4 w-full px-16">
                    <input
                        type="text"
                        class="focus:outline-none bg-transparent w-full border-b rounded-md px-4 py-2 text-md text-gray-800"
                        :class="register.errors.nama != null ? 'border-red-500' : 'border-yellow-500'"
                        v-model="register.nama"
                        placeholder="Nama Lengkap"
                        ref="registerNama"
                    />
                    <span class="text-xs text-red-500">{{ register.errors.nama != null ? register.errors.nama[0] : '' }}</span>
                </div>

                <div class="my-4 w-full px-16">
                    <input
                        type="email"
                        class="focus:outline-none bg-transparent w-full border-b rounded-md px-4 py-2 text-md text-gray-800"
                        :class="register.errors.email != null ? 'border-red-500' : 'border-yellow-500'"
                        v-model="register.email"
                        placeholder="Email Address"
                    />
                    <span class="text-xs text-red-500">{{ register.errors.email != null ? register.errors.email[0] : '' }}</span>
                </div>

                <div class="my-4 w-full px-16">
                    <input
                        type="password"
                        class="focus:outline-none bg-transparent w-full border-b rounded-md px-4 py-2 text-md text-gray-800"
                        :class="register.errors.password != null ? 'border-red-500' : 'border-yellow-500'"
                        v-model="register.password"
                        placeholder="Password"
                    />
                    <span class="text-xs text-red-500">{{ register.errors.password != null ? register.errors.password[0] : '' }}</span>
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
        </div>
        <!-- /.register-form -->
    </div>
</template>

<script>
export default {
    name: "Authentication",

    data() {
        return {
            redirectTo,
            login: {
                email: "",
                password: "",
                errors: {
                    email: null,
                    password: null,
                },
                errorMessage: null,
            },
            register: {
                nama: "",
                email: "",
                password: "",
                errors: {
                    nama: null,
                    email: null,
                    password: null,
                },
                errorMessage: null,
            }
        };
    },

    methods: {
        loginUser() {
            axios
                .post("/login", {
                    email: this.login.email,
                    password: this.login.password,
                })
                .then(response => {
                    if (response.data.success) {
                        location.href = this.redirectTo != null ? `paket/${this.redirectTo}` : '/profile';
                    } else {
                        // set the errorMessage
                        this.login.errorMessage = response.data.message;

                        // reset the form data
                        this.login.email = '';
                        this.login.password = '';
                        this.login.errors = {
                            email: null,
                            password: null,
                        };

                        // focus the email input
                        this.$refs.loginEmail.focus();
                    }
                })
                .catch(error => {
                    // show the errors
                    this.login.errors = error.response.data.errors;

                    // clear the errorMessage
                    this.login.errorMessage = null;
                });
        },

        registerUser() {
            axios
                .post("/register", {
                    nama: this.register.nama,
                    email: this.register.email,
                    password: this.register.password,
                })
                .then(response => {
                    if (response.data.success) {
                        // redirect to index page
                        location.href = `/`;
                    } else {
                        // set the errorMessage
                        this.register.errorMessage = response.data.message;

                        // reset the form data
                        this.register.nama = '';
                        this.register.email = '';
                        this.register.password = '';
                        this.register.errors = {
                            nama: null,
                            email: null,
                            password: null,
                        };

                        // focus the nama input
                        this.$refs.registerNama.focus();
                    }
                })
                .catch(error => {
                    // show the errors
                    this.register.errors = error.response.data.errors;

                    // clear the errorMessage
                    this.register.errorMessage = null;
                })
        },

        showLogin() {
            this.$refs.login.classList.remove("top-0");
            this.$refs.login.classList.add("top-full");

            this.$refs.register.classList.remove("-top-full");
            this.$refs.register.classList.add("top-0");
        },

        showRegister() {
            this.$refs.login.classList.remove("top-full");
            this.$refs.login.classList.add("top-0");

            this.$refs.register.classList.remove("top-0");
            this.$refs.register.classList.add("-top-full");
        }
    }
};
</script>

<style></style>
