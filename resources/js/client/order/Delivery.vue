<template>
    <div class="min-h-screen relative">
        <!-- Navbar sent here -->
        <slot name="navbar"></slot>

        <!-- Main Content goes here -->
        <main>
            <div class="container mx-auto py-10 px-10 xl:px-0">
                <div class="card bg-white rounded-md shadow-md py-4 mx-auto text-gray-500">
                    <div class="row grid grid-cols-2 text-center divide-x">
                        <div>
                            <i class="fas fa-truck text-lg md:text-xl text-green-500"></i>
                            <h1 class="font-semibold text-md md:text-lg tracking-wide text-green-500">
                                Pengiriman
                            </h1>
                        </div>
                        <div>
                            <i class="fas fa-credit-card text-lg md:text-xl"></i>
                            <h1 class="font-semibold text-md md:text-lg tracking-wide">
                                Pembayaran
                            </h1>
                        </div>
                    </div>
                </div>

                <div class="card bg-white rounded-md shadow-md mx-auto mt-10 text-gray-800">
                    <div class="row text-center py-4">
                        <h1 class="font-semibold text-lg tracking-wide uppercase">Waktu Pengiriman</h1>
                    </div>
                
                    <div class="row grid grid-cols-3 text-center divide-x border-t border-b">
                        <div class="py-4 px-2 text-center">
                            <h2 class="font-medium text-base">Pagi</h2>
                            <p class="font-light text-sm mt-1">05.00 - 07.00</p>
                        </div>
                        <div class="py-4 px-2 text-center">
                            <h2 class="font-medium text-base">Siang</h2>
                            <p class="font-light text-sm mt-1">05.00 - 07.00</p>
                        </div>
                        <div class="py-4 px-2 text-center">
                            <h2 class="font-medium text-base">Sore</h2>
                            <p class="font-light text-sm mt-1">05.00 - 07.00</p>
                        </div>
                    </div>

                    <div class="row py-4 px-4 text-sm font-light">
                        <p>Dikirim melalui rute dari tempat terdekat ke tempat terjauh. Kurir akan mengabari sebelum mengantarkan katering ke lokasimu.</p>
                        <p>Untuk <strong>hari minggu</strong> dan <strong>tanggal merah</strong> lainnya libur. Pastikan kamu tidak memulai pada tanggal merah sesuai kalendar.</p>
                    </div>
                </div>

                <div class="card mx-auto mt-10 text-gray-800">
                    <div class="row grid xl:grid-cols-3 gap-10">
                        <div class="item bg-white rounded-md shadow-md py-4 px-4">
                            <div class="row">
                                <h1 class="font-medium text-lg">Lokasi Pengiriman</h1>
                            </div>

                            <div class="row mt-2 mb-4">
                                <div class="flex items-center justify-start">
                                    <input type="radio" name="lokasi" id="rumah" value="rumah" class="mr-2" v-model="lokasi" @click="pilihLokasi">
                                    <label for="rumah" class="text-sm">Rumah</label>
                                </div>
                                <div class="flex items-center justify-start">
                                    <input type="radio" name="lokasi" id="kantor" value="kantor" class="mr-2" v-model="lokasi" @click="pilihLokasi">
                                    <label for="kantor" class="text-sm">Kantor</label>
                                </div>
                            </div>

                            <div class="row">
                                <textarea name="alamat" id="alamat" class="bg-gray-50 shadow-md rounded-md py-3 px-4 w-full focus:outline-none text-sm" placeholder="(Alamat disesuaikan secara otomatis berdasarkan profile pelanggan.)" v-model="alamat"></textarea>
                                <span class="text-xs text-red-500 italic mt-1" v-if="errors['alamat']">
                                    {{ errors.alamat[0] }}
                                </span>
                            </div>
                        </div>

                        <div class="item bg-white rounded-md shadow-md py-4 px-4">
                            <div class="row">
                                <h1 class="font-medium text-lg">Waktu Pengiriman</h1>
                            </div>

                            <div class="row mt-2 mb-4">
                                <select name="waktu_pengiriman" id="waktu_pengiriman" class="focus:outline-none bg-gray-50 shadow-md rounded-md py-3 px-4 w-full focus:outline-none text-sm" v-model="waktu_pengiriman">
                                    <option value="" selected hidden disabled>-- Pilih Hari --</option>
                                    <option value="custom">Pilih Hari Sendiri</option>
                                    <option value="hari:senin-sabtu|waktu:pagi,siang,sore">Senin - Sabtu: Pagi, Siang, Sore</option>
                                    <option value="hari:senin-sabtu|waktu:pagi,siang">Senin - Sabtu: Pagi dan Siang</option>
                                    <option value="hari:senin-sabtu|waktu:pagi,sore">Senin - Sabtu: Pagi dan Sore</option>
                                    <option value="hari:senin-sabtu|waktu:siang,sore">Senin - Sabtu: Siang dan Sore</option>
                                    <option value="hari:senin-sabtu|waktu:pagi">Senin - Sabtu: Pagi Saja</option>
                                    <option value="hari:senin-sabtu|waktu:siang">Senin - Sabtu: Siang Saja</option>
                                    <option value="hari:senin-sabtu|waktu:sore">Senin - Sabtu: Sore Saja</option>
                                    <option value="hari:senin-jumat|waktu:pagi,siang,sore">Senin - Jumat: Pagi, Siang, Sore</option>
                                    <option value="hari:senin-jumat|waktu:pagi,siang">Senin - Jumat: Pagi dan Siang</option>
                                    <option value="hari:senin-jumat|waktu:pagi,sore">Senin - Jumat: Pagi dan Sore</option>
                                    <option value="hari:senin-jumat|waktu:siang,sore">Senin - Jumat: Siang dan Sore</option>
                                    <option value="hari:senin-jumat|waktu:pagi">Senin - Jumat: Pagi Saja</option>
                                    <option value="hari:senin-jumat|waktu:siang">Senin - Jumat: Siang Saja</option>
                                    <option value="hari:senin-jumat|waktu:sore">Senin - Jumat: Sore Saja</option>
                                </select>
                                <span class="text-xs text-red-500 italic mt-1" v-if="errors['waktu_pengiriman']">
                                    {{ errors.waktu_pengiriman[0] }}
                                </span>
                            </div>

                            <div class="row mt-2" v-if="waktu_pengiriman == 'custom'">
                                <div class="flex items-center justify-between text-xs">
                                    <div class="-mx-1">
                                        <input type="checkbox" id="senin" value="senin" class="hidden" v-model="hari">                
                                        <label 
                                            for="senin" 
                                            class="cursor-pointer border hover:border-green-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="hari.indexOf('senin') != -1 ? 'bg-green-400 text-gray-50 hover:bg-green-400' : 'bg-transparent text-gray-400 hover:text-green-400 border-gray-400'"
                                        >Senin</label>
                                        <input type="checkbox" id="selasa" value="selasa" class="hidden" v-model="hari">                    
                                        <label 
                                            for="selasa" 
                                            class="cursor-pointer border hover:border-green-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="hari.indexOf('selasa') != -1 ? 'bg-green-400 text-gray-50 hover:bg-green-400' : 'bg-transparent text-gray-400 hover:text-green-400 border-gray-400'"
                                        >Selasa</label>
                                        <input type="checkbox" id="rabu" value="rabu" class="hidden" v-model="hari">                    
                                        <label 
                                            for="rabu" 
                                            class="cursor-pointer border hover:border-green-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="hari.indexOf('rabu') != -1 ? 'bg-green-400 text-gray-50 hover:bg-green-400' : 'bg-transparent text-gray-400 hover:text-green-400 border-gray-400'"
                                        >Rabu</label>
                                        <input type="checkbox" id="kamis" value="kamis" class="hidden" v-model="hari">                    
                                        <label 
                                            for="kamis" 
                                            class="cursor-pointer border hover:border-green-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="hari.indexOf('kamis') != -1 ? 'bg-green-400 text-gray-50 hover:bg-green-400' : 'bg-transparent text-gray-400 hover:text-green-400 border-gray-400'"
                                        >Kamis</label>
                                        <input type="checkbox" id="jumat" value="jumat" class="hidden" v-model="hari">                    
                                        <label 
                                            for="jumat" 
                                            class="cursor-pointer border hover:border-green-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="hari.indexOf('jumat') != -1 ? 'bg-green-400 text-gray-50 hover:bg-green-400' : 'bg-transparent text-gray-400 hover:text-green-400 border-gray-400'"
                                        >Jumat</label>
                                        <input type="checkbox" id="sabtu" value="sabtu" class="hidden" v-model="hari">                    
                                        <label 
                                            for="sabtu" 
                                            class="cursor-pointer border hover:border-green-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="hari.indexOf('sabtu') != -1 ? 'bg-green-400 text-gray-50 hover:bg-green-400' : 'bg-transparent text-gray-400 hover:text-green-400 border-gray-400'"
                                        >Sabtu</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2" v-if="waktu_pengiriman == 'custom'">
                                <div class="flex items-center justify-between text-xs">
                                    <div class="-mx-1">
                                        <input type="checkbox" id="pagi" value="pagi" class="hidden" v-model="waktu">
                                        <label 
                                            for="pagi" 
                                            class="cursor-pointer border hover:border-blue-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="waktu.indexOf('pagi') != -1 ? 'bg-blue-400 text-gray-50' : 'border-gray-400 hover:border-blue-400 text-gray-400 hover:text-blue-400'"
                                        >Pagi</label>
                                        <input type="checkbox" id="siang" value="siang" class="hidden" v-model="waktu">
                                        <label 
                                            for="siang" 
                                            class="cursor-pointer border hover:border-blue-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="waktu.indexOf('siang') != -1 ? 'bg-blue-400 text-gray-50' : 'border-gray-400 hover:border-blue-400 text-gray-400 hover:text-blue-400'"
                                        >Siang</label>
                                        <input type="checkbox" id="sore" value="sore" class="hidden" v-model="waktu">
                                        <label 
                                            for="sore" 
                                            class="cursor-pointer border hover:border-blue-400 py-1 px-2 rounded-md transition ease-out duration-300 mx-1 my-1 inline-block"
                                            :class="waktu.indexOf('sore') != -1 ? 'bg-blue-400 text-gray-50' : 'border-gray-400 hover:border-blue-400 text-gray-400 hover:text-blue-400'"
                                        >Sore</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item bg-white rounded-md shadow-md py-4 px-4">
                            <div class="row">
                                <h1 class="font-medium text-lg">Tanggal Pengiriman</h1>
                            </div>

                            <div class="row mt-2 mb-4">
                                <div class="flex items-center justify-between">
                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="focus:outline-none bg-gray-50 text-sm rounded-md shadow-md py-3 px-4 w-full" v-model="tanggal_mulai">
                                </div>
                                <span class="text-xs text-red-500 italic mt-1" v-if="errors['tanggal_mulai']">
                                    {{ errors.tanggal_mulai[0] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-10">
                    <div class="row flex items-center justify-end flex-col md:flex-row">
                        <a href="/" class="w-full md:w-auto mb-4 md:mb-0">
                            <button class="bg-transparent w-full hover:bg-gray-50 transition duration-300 ease-out text-gray-800 text-md py-3 px-4 rounded-md shadow-md">Batalkan Pembelian</button>
                        </a>
                        <a :href="`/paket/${paket.id}/pembayaran?client_id=${user.id}`" class="w-full md:w-auto md:ml-4" @click.prevent="storePembelian">
                            <button class="bg-green-400 w-full hover:bg-green-500 transition duration-300 ease-out text-gray-50 text-md py-3 px-4 rounded-md shadow-md">Lanjutkan Pembayaran</button>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <Loader :start="loader"></Loader>
    </div>
</template>

<script>
import Loader from '../../components/Loader';

export default {
    name: 'Delivery',

    components: {
        Loader,
    },

    data() {
        return {
            user,
            paket,

            loader: false,

            lokasi: 'rumah',
            alamat: '',
            waktu_pengiriman: '',
            hari: [],
            waktu: [],
            tanggal_mulai: '',
            
            defaultAlamat: 'Tuliskan alamat lengkap.',
            errors: [],
        }
    },

    mounted() {
        this.setLokasi();
    },

    methods: {
        setLokasi() {
            if (this.lokasi === 'rumah') {
            this.alamat = this.user.rumah_teks ? this.user.rumah_teks : this.defaultAlamat;
            } else {
                this.alamat = this.user.kantor_teks ? this.user.kantor_teks : this.defaultAlamat;
            }
        },
        
        pilihLokasi(e) {
            this.lokasi = e.target.value;
            this.setLokasi();
        },

        storePembelian() {
            // validasi
            if (this.waktu_pengiriman == 'custom') {
                if (this.waktu.length == 0 || this.hari.length == 0) {
                    return Toast.fire({
                        icon: "error",
                        title: "Pastikan sudah memilih hari dan waktu!",
                    });
                }
                
                let waktu_pengiriman = `hari:${this.hari.join(',')}|waktu:${this.waktu.join(',')}`;
                this.waktu_pengiriman = waktu_pengiriman;
            }

            if (this.alamat == this.defaultAlamat) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Mohon tuliskan alamat yang benar!',
                });
            }

            this.loader = true;
            
            axios.post(`/pembelian/create`, {
                id_pelanggan: this.user.id,
                id_paket: this.paket.id,
                lokasi: this.lokasi,
                alamat: this.alamat,
                waktu_pengiriman: this.waktu_pengiriman,
                tanggal_mulai: this.tanggal_mulai,
            })
            .then(({ data }) => {
                this.loader = false;
                
                if (data.success) {
                    location.href = `/paket/${this.paket.id}/pembayaran?client_id=${this.user.id}&payment_id=${data.data.id}`;
                }
            })
            .catch(({ response }) => {
                this.loader = false;

                if (response.status == 422) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Mohon periksa kembali formnya!',
                    });

                    this.errors = response.data.errors;
                }
            })
        }
    }
}
</script>

<style>

</style>