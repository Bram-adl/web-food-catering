<template>
    <div>
        <div class="bg-gray-50 px-4 py-6 sm:px-6 sm:py-4">
            <h2 class="font-semibold text-gray-800 text-xl">Form Biodata</h2>
        </div>
        <div class="px-4 py-2">
            <div class="sm:grid grid-cols-2 gap-4 my-4">
                <div class="mb-4 sm:mb-0">
                    <input
                        type="text"
                        placeholder="Nama lengkap"
                        class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                        v-model="nama"
                    />
                    <!-- <span class="text-xs text-red-500">hm</span> -->
                </div>
                <div>
                    <input
                        type="email"
                        placeholder="Email address"
                        class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                        v-model="email"
                    />
                    <!-- <span class="text-xs text-red-500">hm</span> -->
                </div>
            </div>
            <div class="my-4">
                <input
                    type="password"
                    placeholder="Password (kosongkan jika tidak diubah)"
                    class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                    v-model="password"
                />
                <!-- <span class="text-xs text-red-500">hm</span> -->
            </div>
            <div class="my-4">
                <input
                    type="text"
                    placeholder="Nomor Whatsapp (08**********)"
                    class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                    v-model="wa"
                />
                <!-- <span class="text-xs text-red-500">hm</span> -->
            </div>
            <div class="my-4">
                <input
                    type="text"
                    placeholder="Alamat Rumah (Opsional)"
                    class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                    v-model="rumah_teks"
                />
                <!-- <span class="text-xs text-red-500">hm</span> -->
            </div>
            <div class="my-4">
                <input
                    type="text"
                    placeholder="Alamat Rumah (Google Maps)"
                    class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                    v-model="rumah_maps"
                />
                <!-- <span class="text-xs text-red-500">hm</span> -->
            </div>
            <div class="sm:grid grid-cols-3 gap-2 my-4">
                <div>
                    <label for="" class="font-bold text-xs tracking-wider mb-2">Kota Rumah</label>
                    <div class="relative mb-4 sm:mb-0">    
                        <select
                            class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md focus:outline-none"
                            v-model="rumah_kota"
                        >
                            <option v-for="k in kota" :key="k.id" :value="k.id">{{ k.kota }}</option>
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
                <div>
                    <label for="" class="font-bold text-xs tracking-wider mb-2">Kec. Rumah</label>
                    <div class="relative mb-4 sm:mb-0">    
                        <select
                            class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md focus:outline-none"
                            v-model="rumah_kecamatan"
                        >
                            <option v-for="k in kecamatan" :key="k.id" :value="k.id">{{ k.kecamatan }}</option>
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
                <div>
                    <label for="" class="font-bold text-xs tracking-wider mb-2">Kel. Rumah</label>
                    <div class="relative mb-4 sm:mb-0">    
                        <select
                            class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md focus:outline-none"
                            v-model="rumah_kelurahan"
                        >
                            <option v-for="k in kelurahan" :key="k.id" :value="k.id">{{ k.kelurahan }}</option>
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
                <input
                    type="text"
                    placeholder="Alamat Kantor (Opsional)"
                    class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                    :value="kantor_teks"
                />
                <!-- <span class="text-xs text-red-500">hm</span> -->
            </div>
            <div class="my-4">
                <input
                    type="text"
                    placeholder="Alamat Kantor (Google Maps)"
                    class="bg-gray-50 shadow-sm text-gray-800 rounded-md py-3 px-4 w-full focus:outline-none"
                    :value="kantor_maps"
                />
                <!-- <span class="text-xs text-red-500">hm</span> -->
            </div>
            <div class="sm:grid grid-cols-3 gap-2 my-4">
                <div>
                    <label for="" class="font-bold text-xs tracking-wider mb-2">Kota Kantor</label>
                    <div class="relative mb-4 sm:mb-0">    
                        <select
                            class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md focus:outline-none"
                            v-model="kantor_kota"
                        >
                            <option v-for="k in kota" :key="k.id" :value="k.id">{{ k.kota }}</option>
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
                <div>
                    <label for="" class="font-bold text-xs tracking-wider mb-2">Kec. Kantor</label>
                    <div class="relative mb-4 sm:mb-0">    
                        <select
                            class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md focus:outline-none"
                            v-model="kantor_kecamatan"
                        >
                            <option v-for="k in kecamatan" :key="k.id" :value="k.id">{{ k.kecamatan }}</option>
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
                <div>
                    <label for="" class="font-bold text-xs tracking-wider mb-2">Kel. Kantor</label>
                    <div class="relative mb-4 sm:mb-0">    
                        <select
                            class="appearance-none w-full bg-gray-50 text-gray-800 py-3 px-4 pr-8 rounded-md focus:outline-none"
                            v-model="kantor_kelurahan"
                        >
                            <option v-for="k in kelurahan" :key="k.id" :value="k.id">{{ k.kelurahan }}</option>
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
                <textarea
                    class="bg-gray-50 px-4 py-3 w-full focus:outline-none"
                    placeholder="Keterangan (Alergi)"
                    v-model="keterangan"
                ></textarea>
                <!-- <span class="text-xs text-red-500">hm</span> -->
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-2 sm:px-6 sm:flex sm:flex-row-reverse">
            <button
                type="button"
                class="w-full justify-center rounded-md shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 transition duration-300 ease-out focus:outline-none sm:ml-3 sm:w-auto sm:text-sm"
                @click="updateProfile"
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
</template>

<script>
export default {
    name: 'ProfileForm',

    props: ['pelanggan'],

    data() {
        return {
            kota: null,
            kecamatan: null,
            kelurahan: null,

            nama: this.pelanggan.nama,
            email: this.pelanggan.email,
            password: this.pelanggan.password,
            wa: this.pelanggan.wa,
            rumah_teks: this.pelanggan.rumah_teks,
            rumah_maps: this.pelanggan.rumah_maps,
            rumah_kota: this.pelanggan.rumah_kota,
            rumah_kecamatan: this.pelanggan.rumah_kecamatan,
            rumah_kelurahan: this.pelanggan.rumah_kelurahan,
            kantor_teks: this.pelanggan.kantor_teks,
            kantor_maps: this.pelanggan.kantor_maps,
            kantor_kota: this.pelanggan.kantor_kota,
            kantor_kecamatan: this.pelanggan.kantor_kecamatan,
            kantor_kelurahan: this.pelanggan.kantor_kelurahan,
            keterangan: this.pelanggan.keterangan,
        }
    },

    mounted() {
        this.fetchResource('/kota', 'kota');
        this.fetchResource('/kecamatan', 'kecamatan');
        this.fetchResource('/kelurahan', 'kelurahan');
    },

    methods: {
        fetchResource(url, target) {
            axios.get(url)
                .then(({data}) => {
                    this[target] = data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        
        updateProfile() {
            axios.put(`/pelanggan/${this.pelanggan.id}`, {
                nama: this.nama,
                email: this.email,
                password: this.password,
                wa: this.wa,
                rumah_teks: this.rumah_teks,
                rumah_maps: this.rumah_maps,
                rumah_kota: this.rumah_kota,
                rumah_kecamatan: this.rumah_kecamatan,
                rumah_kelurahan: this.rumah_kelurahan,
                kantor_teks: this.kantor_teks,
                kantor_maps: this.kantor_maps,
                kantor_kota: this.kantor_kota,
                kantor_kecamatan: this.kantor_kecamatan,
                kantor_kelurahan: this.kantor_kelurahan,
                keterangan: this.keterangan,
            })
                .then(response => {
                    if(response.data.success) {
                        location.reload(true);
                    }
                })
                .catch(error => {
                    console.log(error)
                })
        },
        
        closeModal() {
            this.$emit('closeModal');
        }
    }
};
</script>

<style></style>
