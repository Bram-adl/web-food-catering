<template>
    <nav class="bg-white shadow-md">
        <div class="container flex items-center justify-between mx-auto py-3 px-4 text-gray-800 text-sm md:text-base">
            <div class="">
                <img src="/images/logo.jpg" alt="logo" class="w-14 h-14 md:w-20 md:h-20">
            </div>
            <div class="flex-1 flex items-center justify-end md:mx-10">
                <a class="mx-2 opacity-50 hover:opacity-100 transition ease-out duration-300" href="/">Home</a>
                <a class="mx-2 opacity-50 hover:opacity-100 transition ease-out duration-300" href="/#daftar-menu">Daftar Menu</a>
                <a class="mx-2 opacity-50 hover:opacity-100 transition ease-out duration-300" href="/profile/id/pembelian">Daftar Pembelian</a>
            </div>
            <div class="fixed right-4 bottom-4 md:static flex items-center justify-center bg-red-500 md:bg-transparent w-10 md:w-auto h-10 md:h-auto rounded-full opacity-50 hover:opacity-100 transition ease-out duration-300">
                <slot></slot>
            </div>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'ProfileNavbar',
}
</script>