<template>
    <div class="bg-gray-50 rounded-sm text-sm shadow-md">
        <Modal 
            :data="data"
            @closeModal="closeModal"
        />
        
        <div class="p-6 pb-0 flex items-center justify-between">
            <h1 class="text-lg">{{ pelanggan.nama }}</h1>
            <button class="focus:outline-none text-xs bg-green-500 text-gray-50 rounded-md py-2 px-4 hover:bg-green-600 transition duration-300 ease-out" @click="showModal">
                <i class="fas fa-edit"></i>
                <span>Edit Profil</span>
            </button>
        </div>

        <div class="px-6 pt-0 pb-4 flex items-center text-gray-500">
            <span class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>    
            <span class="mx-2">Active</span>
        </div>

        <div class="p-6 pt-0 pb-4 grid grid-cols-2 divide-x text-gray-500">
            <div class="text-left">
                <i class="fas fa-envelope"></i>
                <span class="ml-2">{{ pelanggan.email }}</span>
            </div>

            <div class="text-right">
                <i class="fab fa-whatsapp"></i>
                <span class="ml-2">{{ pelanggan.wa || '(Belum menyimpan nomor whatsapp)' }}</span>
            </div>
        </div>

        <div class="border-t p-6 py-4 flex items-center justify-between text-gray-400">
            <div class="flex items-center">
                <span class="inline-block w-8 h-8 rounded-full border border-green-500 text-green-500 flex items-center justify-center">{{ pelanggan.porsi || '0' }}</span>
                <span class="ml-2">Porsi Makan</span>
            </div>

            <div>
                <span class="">Tidak terdapat alergi</span>
            </div>
        </div>

        <div class="border-t p-6 py-4 text-gray-400">
            <ul class="text-gray-500" v-if="pelanggan.rumah_teks">
                <li class="mt-0">
                    <p class="text-md">Alamat Rumah:</p>
                    <a class="hover:text-gray-800 text-xs flex items-center" :href="pelanggan.rumah_maps">
                        <span>{{ pelanggan.rumah_teks }}, {{ pelanggan.kelurahan }}, {{ pelanggan.kecamatan }}, {{ pelanggan.kota }}</span>
                        <i class="fas fa-external-link-alt text-sm ml-2"></i>
                    </a>
                </li>
            </ul>

            <ul v-else>
                <li>
                    <p>Belum mengisi data rumah</p>
                </li>
            </ul>

            <ul class="mt-4 text-gray-500" v-if="pelanggan.kantor_teks">
                <li class="mt-0">
                    <p>Alamat Kantor:</p>
                    <a class="hover:text-gray-800 flex items-center" :href="pelanggan.kantor_maps">
                        <span>{{ pelanggan.kantor_teks }}, {{ pelanggan.kelurahan }}, {{ pelanggan.kecamatan }}, {{ pelanggan.kota }}</span>
                        <i class="fas fa-external-link-alt text-sm ml-2"></i>
                    </a>
                </li>
            </ul>

            <ul class="mt-4" v-else>
                <li>
                    <p>Belum mengisi data kantor (Optional)</p>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.profile-card -->
</template>

<script>
import Modal from '../components/Modal'

export default {
    name: 'UserProfileCard',

    props: [
        'pelanggan',
    ],

    components: {
        Modal,
    },

    data() {
        return {
            data: {
                state: false,
                form: 'profile',
            },
        }
    },

    methods: {
        showModal() {
            this.data.state = true;
        },

        closeModal() {
            this.data.state = false;
        }
    }
}
</script>

<style>

</style>