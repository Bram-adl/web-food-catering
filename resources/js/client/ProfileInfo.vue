<template>
    <div class="bg-gray-50 rounded-md shadow-md py-4">
        <div class="row flex items-center justify-between  text-sm text-gray-800 px-6 mb-4">
            <div class="flex-1">
                <p class="text-lg font-medium">
                    Halo, {{ user.nama }} !
                </p>
            </div>
            <div>
                <button class="bg-green-500 hover:bg-green-600 rounded-md py-2 px-3 text-sm text-gray-50 focus:outline-none transition ease-out duration-300">
                    <i class="fas fa-plus"></i>
                    <span>Request Pengantaran</span>
                </button>
            </div>
        </div>

        <div class="row text-gray-800 text-sm font-light px-6">
            <p class="my-2">
                Pemberitahuan untuk kamu nih!
            </p>

            <p class="my-2">
                Request pengantaran maksimal dilakukan <strong>satu hari sebelumnya</strong> paling lambat <strong>pukul 19.00</strong> untuk pengantaran
                <strong>Pagi dan Siang.</strong>
            </p>

            <p class="my-2">
                Sementara untuk pengantaran pada <strong>Sore</strong>, maksimal <strong>di hari tersebut</strong> paling lambat <strong>pukul 12.00</strong>
                ya!
            </p>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProfileInfo',

    props: {
        user: {
            type: Object,
            required: true,
        },
    }
}
</script>

<style>

</style>