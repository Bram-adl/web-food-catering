<template>
    <div>
        <div class="bg-gray-50 px-4 py-2 sm:px-6 sm:py-4">
            <h2 class="font-semibold text-gray-800 text-xl">Form Request</h2>
        </div>
        <div class="px-4 py-2">
            <div class="sm:grid grid-cols-2 gap-4 my-4">
                <div>
                    <label
                        for="tanggal"
                        class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800"
                        >Tanggal Pengiriman</label
                    >
                    <input
                        type="date"
                        id="tanggal"
                        class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                    />
                    <!-- <span class="text-xs text-red-500">hm</span> -->
                </div>
                <div>
                    <label
                        for="waktu"
                        class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800"
                        >Waktu Pengiriman</label
                    >
                    <div class="relative">
                        <select
                            class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md"
                        >
                            <option>Pagi</option>
                            <option>Siang</option>
                            <option>Malam</option>
                        </select>
                        <div
                            class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker"
                        >
                            <svg
                                class="h-4 w-4"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-4">
                <label
                    for="porsi"
                    class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800"
                    >Porsi pengiriman</label
                >
                <input
                    type="number"
                    id="porsi"
                    class="bg-gray-50 text-gray-800 shadow-sm rounded-md py-3 px-4 w-full focus:outline-none"
                    placeholder="0"
                    min="0"
                />
            </div>
            <div class="my-4">
                <label
                    for="alamat"
                    class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800"
                    >Alamat pengiriman</label
                >
                <div class="relative">
                    <select
                        class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md"
                    >
                        <option value="" disabled hidden selected v-if="!pelanggan.rumah_teks && !pelanggan.kantor_teks">Tidak terdapat alamat</option>
                        <option :disabled="!pelanggan.rumah_teks">Alamat Rumah</option>
                        <option :disabled="!pelanggan.kantor_teks">Alamat Kantor</option>
                    </select>
                    <div
                        class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker"
                    >
                        <svg
                            class="h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-2 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                type="button"
                class="w-full justify-center rounded-md shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 transition duration-300 ease-out focus:outline-none sm:ml-3 sm:w-auto sm:text-sm"
            >
                Buat Request
            </button>
            <button
                type="button"
                class="mt-2 w-full rounded-md shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-800 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                @click="closeModal"
            >
                Cancel
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "RequestModal",

    props: [
        "pelanggan",
    ],

    methods: {
        closeModal() {
            this.$emit("closeModal");
        }
    }
};
</script>

<style></style>
