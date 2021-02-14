<template>
    <div class="bg-gray-50 rounded-md shadow-md py-4">
        <div class="row flex items-center justify-between  text-sm text-gray-800 px-6 mb-4">
            <div class="flex-1">
                <p class="text-lg font-medium">
                    Halo, {{ user.nama }} !
                </p>
            </div>
            <div>
                <button class="bg-green-500 hover:bg-green-600 rounded-md py-2 px-3 text-sm text-gray-50 focus:outline-none transition ease-out duration-300" @click="showModal">
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

        <!-- Modal -->
        <transition enter-active-class="animate__animated animate__fadeIn animate__faster" leave-active-class="animate__animated animate__fadeOut animate__faster">
            <modal 
                v-if="modal"
                title="Request Pengantaran"
                action="Buat Pengantaran"
                method="storePengantaran"
                @storePengantaran="storePengantaran"
                @closeModal="closeModal"
            >
                <div class="mt-2 mb-2">
                    <label for="id_paket" class="block text-sm font-medium text-gray-700">Pilih Paket</label>
                    <select id="id_paket" name="id_paket" autocomplete="id_paket" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="id_pembelian">
                        <option value="0" hidden disabled>-- Pilih Paket --</option>
                        <option :value="p.id_pembelian" v-for="p in paket" :key="p.id_pembelian">{{ p.id_pembelian }} - {{ p.paket }} (Sisa porsi: {{ p.porsi }})</option>
                    </select>
                    <p class="mt-1 text-sm text-red-400 italic" v-if="errors['alamat']">
                        {{ errors.alamat[0] }}
                    </p>
                </div>
            
                <div class="mt-2">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Pengantaran</label>
                    <input type="date" name="tanggal" id="tanggal" autocomplete="given-name" class="focus:outline-none flex-1 block w-full rounded-md sm:text-sm border border-gray-300 mt-1 px-3 py-2" placeholder="Tanggal Pengantaran" v-model="tanggal">
                    <p class="mt-1 text-sm text-red-400 italic" v-if="errors['tanggal']">
                        {{ errors.tanggal[0] }}
                    </p>
                </div>

                <div class="mt-2 mb-2">
                    <label for="waktu" class="block text-sm font-medium text-gray-700">Waktu Pengantaran</label>
                    <select id="waktu" name="waktu" autocomplete="waktu" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="waktu">
                        <option value="" selected hidden disabled>-- Pilih Waktu --</option>
                        <option value="Pagi">Pagi</option>
                        <option value="Siang">Siang</option>
                        <option value="Sore">Sore</option>
                    </select>
                    <p class="mt-1 text-sm text-red-400 italic" v-if="errors['waktu']">
                        {{ errors.waktu[0] }}
                    </p>
                </div>

                <div class="mt-2 mb-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Diantarkan Ke</label>
                    <select id="alamat" name="alamat" autocomplete="alamat" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @change="pilihAlamat" v-model="lokasi">
                        <option value="" selected hidden disabled>-- Pilih Alamat --</option>
                        <option value="Rumah">Rumah</option>
                        <option value="Kantor">Kantor</option>
                    </select>
                    <p class="mt-1 text-sm text-red-400 italic" v-if="errors['alamat']">
                        {{ errors.alamat[0] }}
                    </p>
                </div>

                <div class="mt-2 mb-2">
                    <textarea id="catatan" name="catatan" rows="3" class="focus:outline-none shadow-sm mt-1 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2" placeholder="(Alamat pengiriman berdasarkan data di profil kamu)" v-model="alamat"></textarea>
                </div>

                <div class="mt-2">
                    <label for="porsi" class="block text-sm font-medium text-gray-700">Porsi Pengantaran</label>
                    <input type="number" name="porsi" id="porsi" autocomplete="given-name" class="focus:outline-none flex-1 block w-full rounded-md sm:text-sm border border-gray-300 mt-1 px-3 py-2" placeholder="Porsi Pengantaran" v-model="porsi">
                    <p class="mt-1 text-sm text-red-400 italic" v-if="errors['porsi']">
                        {{ errors.porsi[0] }}
                    </p>
                </div>
            
                <div class="mt-2">
                    <label for="catatan" class="block text-sm font-medium text-gray-700">
                        Catatan
                    </label>
                    <div class="mt-1">
                        <textarea id="catatan" name="catatan" rows="3" class="focus:outline-none shadow-sm mt-1 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2" placeholder="Berikan catatan khusus untuk pengiriman" v-model="catatan"></textarea>
                    </div>
                    <p class="mt-1 text-sm text-red-400 italic" v-if="errors['catatan']">
                        {{ errors.catatan[0] }}
                    </p>
                </div>
            </modal>
        </transition>

        <!-- Loader -->
        <Loader :start="loader"/>
    </div>
</template>

<script>
import Modal from '../../components/Modal';
import Loader from '../../components/Loader';

export default {
    name: 'ProfileInfo',

    components: {
        Modal,
        Loader,
    },

    props: {
        user: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            modal: false,
            loader: false,

            paket: [],
            id_pembelian: '0',
            tanggal: null,
            waktu: '',
            lokasi: '',
            alamat: '',
            porsi: null,
            catatan: null,

            errors: [],

            defaultAlamat: 'Mohon tuliskan alamat lengkap.',
        }
    },

    mounted() {
        this.fetchPaket(this.user.id);
    },

    methods: {
        showModal() {
            this.modal = true;
        },

        closeModal() {
            this.modal = false;
        },

        fetchPaket() {
            axios.get('/pembelian/' + this.user.id + '/list')
                .then(({ data}) => {
                    if (data.success) {
                        this.paket = data.data;
                    }
                })
                .catch(({ response }) => {
                    console.log(response.error.message);
                })
        },

        pilihAlamat(e) {
            const alamat = e.target.value;

            if (alamat == 'Rumah') {
                const alamatUser = user.rumah_teks;
                this.alamat = alamatUser != null ? alamatUser : this.defaultAlamat;
            } else {
                const alamatUser = user.kantor_teks;
                this.alamat = alamatUser != null ? alamatUser : this.defaultAlamat;
            }
        },

        storePengantaran() {
            this.loader = true;

            if (this.alamat == this.defaultAlamat) {
                this.loader = false;
                
                return Toast.fire({
                    icon: "error",
                    title: "Mohon menuliskan alamat yang benar",
                });
            }

            axios.post('/profile/' + this.user.id + '/pengantaran/create', {
                id_pembelian: this.id_pembelian,
                tanggal_kirim: this.tanggal,
                porsi: this.porsi,
                waktu_kirim: this.waktu,
                lokasi: this.lokasi,
                alamat: this.alamat,
                catatan_pelanggan: this.catatan,
            })
            .then(({ data }) => {
                this.loader = false;

                if (data.success) {
                    Toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
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