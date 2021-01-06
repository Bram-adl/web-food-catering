<template>
    <div class="fixed z-10 inset-0 overflow-y-auto" v-if="data.state">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom w-64 bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog"
                aria-modal="true"
                aria-labelledby="modal-headline"
            >
                <div v-if="data.form == 'profile'">
                    <div class="bg-gray-50 px-4 py-2 sm:px-6 sm:py-4">
                        <h2 class="font-semibold text-gray-800 text-xl">Form Biodata</h2>
                    </div>
                    <div class="px-4 py-2">
                        <div class="sm:grid grid-cols-2 gap-4 my-4">
                            <div>
                                <input type="text" placeholder="Nama lengkap" class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none">
                                <!-- <span class="text-xs text-red-500">hm</span> -->
                            </div>
                            <div>
                                <input type="email" placeholder="Email address" class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none">
                                <!-- <span class="text-xs text-red-500">hm</span> -->
                            </div>
                        </div>
                        <div class="my-4">
                            <input type="password" placeholder="Password (kosongkan jika tidak diubah)" class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none">
                            <!-- <span class="text-xs text-red-500">hm</span> -->
                        </div>
                        <div class="my-4">
                            <input type="text" placeholder="Nomor Whatsapp" class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none">
                            <!-- <span class="text-xs text-red-500">hm</span> -->
                        </div>
                        <div class="my-4">
                            <input type="text" placeholder="Alamat Rumah (Opsional)" class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none">
                            <!-- <span class="text-xs text-red-500">hm</span> -->
                        </div>
                        <div class="sm:grid grid-cols-3 gap-2 my-4">
                            <div class="relative">
                                <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                    <option value="" selected disabled hidden>Kota Rumah</option>
                                    <option>Kab. Malang</option>
                                    <option>Kab. Batu</option>
                                </select>
                                <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                    <option value="" selected disabled hidden>Kec. Rumah</option>
                                    <option>Kab. Malang</option>
                                    <option>Kab. Batu</option>
                                </select>
                                <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                    <option value="" selected disabled hidden>Kel. Rumah</option>
                                    <option>Kab. Malang</option>
                                    <option>Kab. Batu</option>
                                </select>
                                <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <input type="text" placeholder="Alamat Kantor (Opsional)" class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none">
                            <!-- <span class="text-xs text-red-500">hm</span> -->
                        </div>
                        <div class="sm:grid grid-cols-3 gap-2 my-4">
                            <div class="relative">
                                <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                    <option value="" selected disabled hidden>Kota Kantor</option>
                                    <option>Kab. Malang</option>
                                    <option>Kab. Batu</option>
                                </select>
                                <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                    <option value="" selected disabled hidden>Kec. Kantor</option>
                                    <option>Kab. Malang</option>
                                    <option>Kab. Batu</option>
                                </select>
                                <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                    <option value="" selected disabled hidden>Kel. Kantor</option>
                                    <option>Kab. Malang</option>
                                    <option>Kab. Batu</option>
                                </select>
                                <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <textarea class="bg-gray-50 px-4 py-3 w-full focus:outline-none" placeholder="Keterangan (Alergi)"></textarea>
                            <!-- <span class="text-xs text-red-500">hm</span> -->
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-2 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button
                            type="button"
                            class="w-full justify-center rounded-md shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 transition duration-300 ease-out focus:outline-none sm:ml-3 sm:w-auto sm:text-sm"
                        >
                            Simpan Perubahan
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
                <div v-else>
                    <div class="bg-gray-50 px-4 py-2 sm:px-6 sm:py-4">
                        <h2 class="font-semibold text-gray-800 text-xl">Form Request</h2>
                    </div>
                    <div class="px-4 py-2">
                        <div class="sm:grid grid-cols-2 gap-4 my-4">
                            <div>
                                <label for="tanggal" class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800">Tanggal Pengiriman</label>
                                <input type="date" id="tanggal" class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none">
                                <!-- <span class="text-xs text-red-500">hm</span> -->
                            </div>
                            <div>
                                <label for="waktu" class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800">Waktu Pengiriman</label>
                                <div class="relative">
                                    <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                        <option>Pagi</option>
                                        <option>Siang</option>
                                        <option>Malam</option>
                                    </select>
                                    <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-4">
                            <label for="porsi" class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800">Porsi pengiriman</label>
                            <input type="number" id="porsi" class="bg-gray-50 text-gray-800 shadow-sm rounded-md py-3 px-4 w-full focus:outline-none" placeholder="0" min="0">
                        </div>
                        <div class="my-4">
                            <label for="alamat" class="block uppercase tracking-wide text-xs font-bold mb-2 text-gray-800">Alamat pengiriman</label>
                            <div class="relative">
                                <select class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md">
                                    <option>Alamat Rumah</option>
                                    <option>Alamat Kantor</option>
                                </select>
                                <div class="pointer-events-none absolute right-0 inset-y-1/2 flex items-center px-2 text-grey-darker">
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Modal",

    props: ["data"],

    methods: {
        closeModal() {
            this.$emit("closeModal");
        }
    }
};
</script>

<style></style>
