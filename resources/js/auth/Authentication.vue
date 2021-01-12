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
                    <p class="text-sm font-light text-center lg:my-6">
                        Sudah memiliki akun?
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

            <slot name="login-form"></slot>
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
                    <p class="text-sm font-light text-center lg:my-6">
                        Belum memiliki akun?
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

            <slot name="register-form"></slot>
        </div>
        <!-- /.register-form -->
    </div>
</template>

<script>
export default {
    name: "Authentication",

    data() {
        return {
            
        };
    },

    methods: {
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
