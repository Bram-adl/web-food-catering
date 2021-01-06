<template>
    <div class="w-full h-full container mx-auto py-10 text-gray-800">
        <div class="">
            <h2 class="text-lg font-medium">Dashboard</h2>
        </div>

        <div class="grid grid-cols-2 gap-16 my-10">
            <div class="bg-gray-50 rounded-sm text-sm shadow-md">
                <div class="p-6 pb-0 flex items-center justify-between">
                    <h1 class="text-lg">{{ pelanggan.nama }}</h1>
                    <button class="focus:outline-none text-xs bg-green-500 text-gray-50 rounded-md py-2 px-4 hover:bg-green-600 transition duration-300 ease-out">
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
                        <span class="inline-block w-8 h-8 rounded-full border border-gray-400 flex items-center justify-center">{{ pelanggan.porsi || '0' }}</span>
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

                    <ul class="mt-4 text-gray-500" v-if="pelanggan.kantor_teks">
                        <li class="mt-0">
                            <p>Alamat Kantor:</p>
                            <a class="hover:text-gray-800 flex items-center" :href="pelanggan.kantor_maps">
                                <span>{{ pelanggan.kantor_teks }}, {{ pelanggan.kelurahan }}, {{ pelanggan.kecamatan }}, {{ pelanggan.kota }}</span>
                                <i class="fas fa-external-link-alt text-sm ml-2"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /.profile-card -->

            <div class="bg-gray-50 rounded-sm text-sm shadow-md">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <h1 class="font-semibold text-xl">Halo, {{ pelanggan.nama }}!</h1>
                        <button class="focus:outline-none text-xs bg-green-500 text-gray-50 rounded-md py-2 px-4 hover:bg-green-600 transition duration-300 ease-out">
                            <i class="fas fa-plus"></i>
                            <span>Request Pengantaran</span>
                        </button>
                    </div>
                    <div>
                        <p class="text-sm font-light py-2 leading-relaxed">Pemberitahuan untuk kamu nih!</p>
                        <p class="text-sm font-light py-2 leading-relaxed">Request pengantaran maksimal dilakukan <strong>satu hari sebelumnya</strong> paling lambat <strong>pukul 19.00</strong> untuk pengantaran <strong>Pagi dan Siang</strong></p>
                        <p class="text-sm font-light py-2 leading-relaxed">Sementara untuk pengantaran pada <strong>Sore</strong>, maksimal <strong>di hari tersebut</strong> paling lambat <strong>pukul 12.00</strong> ya!</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 rounded-sm shadow-md text-sm p-6">
            <table class="table-fixed border border-collapse w-full">
                <thead>
                    <tr>
                        <th class="border w-1/12">#</th>
                        <th class="border w-4/12">Tanggal</th>
                        <th class="border w-2/12">Waktu</th>
                        <th class="border w-2/12">Porsi</th>
                        <th class="border w-2/12">Alamat</th>
                        <th class="border w-4/12">Catatan Pelanggan</th>
                        <th class="border w-4/12">Catatan Kurir</th>
                        <th class="border w-2/12">Opsi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: 'UserProfile',

    data() {
        return {
            pelanggan: pelanggan[0],
        }
    },

    mounted() {
        console.log(this.pelanggan);
    }
};
</script>

<style></style>
