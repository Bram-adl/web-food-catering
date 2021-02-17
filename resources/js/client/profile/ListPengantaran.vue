<template>
    <div class="bg-gray-50 rounded-md shadow-md px-6 py-4">
        <paginate
            name="pengantaran"
            :list="pengantaran"
            :per="10"
        >
            <table class="border-collapse w-full relative" style="z-index: 0">
                <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">#</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Tanggal</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Waktu</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Porsi</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Alamat</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Catatan Pelanggan</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Catatan Kurir</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0" v-for="(p, index) in paginated('pengantaran')" :key="p.id">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">#</span>
                            {{ index + 1 }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Tangal</span>
                            {{ p.tanggal_kirim }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Waktu</span>
                            {{ p.waktu_kirim }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Porsi</span>
                            {{ p.porsi }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Alamat</span>
                            {{ p.lokasi }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Catatn Pelanggan</span>
                            {{ p.catatan_pelanggan || '-' }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Catatan Kurir</span>
                            {{ p.catatan_kurir || '-' }}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-3 text-xs font-bold uppercase">Status</span>
                            <span class="rounded py-2 px-3 text-gray-50 text-xs font-bold" :class="{ 'bg-yellow-400': p.status == 'pending', 'bg-green-400': p.status == 'terkirim' }">{{ p.status }}</span>
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                            <a href="#" @click.prevent="edit(p)" class="text-blue-400 hover:text-blue-600 underline mr-2" v-if="p.status == 'pending'">Edit</a>
                            <a href="#" @click.prevent="remove(p)" class="text-blue-400 hover:text-blue-600 underline">Remove</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </paginate>
        <paginate-links for="pengantaran" :show-step-links="true"></paginate-links>

        <!-- Modal -->
        <transition enter-active-class="animate__animated animate__fadeIn animate__faster" leave-active-class="animate__animated animate__fadeOut animate__faster">
            <modal 
                v-if="modal"
                title="Edit Pengantaran"
                action="Simpan Perubahan"
                method="editPengantaran"
                @editPengantaran="editPengantaran"
                @closeModal="closeModal"
            >
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
                        <option v-for="(waktu, index) in waktu_pengiriman" :key="index" :value="waktu">
                            {{ waktu }}
                        </option>
                    </select>
                    <p class="mt-1 text-sm text-red-400 italic" v-if="errors['waktu']">
                        {{ errors.waktu[0] }}
                    </p>
                </div>

                <div class="mt-2 mb-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Diantarkan Ke</label>
                    <select id="alamat" name="alamat" autocomplete="alamat" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @change="pilihAlamat" v-model="lokasi">
                        <option value="" selected hidden disabled>-- Pilih Alamat --</option>
                        <option value="rumah">Rumah</option>
                        <option value="kantor">Kantor</option>
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

        <Loader :start="loader" />
    </div>
</template>

<script>
import Modal from '../../components/Modal';
import Loader from '../../components/Loader';
import VuePaginate from 'vue-paginate';

export default {
    name: 'ProfileTable',

    props: {
        user: {
            type: Object,
            required: true,
        },
    },

    components: {
        Modal,
        Loader,
        VuePaginate,
    },

    data() {
        return {
            pengantaran: [],
            paginate: ['pengantaran'],

            modal: false,
            loader: false,

            tanggal: null,
            waktu: '',
            lokasi: '',
            alamat: '',
            porsi: null,
            catatan: null,

            waktu_pengiriman: [],
            id_pengantaran: null,

            errors: [],

            defaultAlamat: 'Mohon tuliskan alamat lengkap.',
        }
    },

    mounted() {
        this.fetchPengantaran();
    },

    methods: {
        clearEntities() {
            this.tanggal = null;
            this.waktu = '';
            this.lokasi = '';
            this.alamat = '';
            this.porsi = null;
            this.catatan = null;
            this.waktu_pengiriman = [];
            this.id_pengantaran = null,
            this.errors = [];
        },
        
        fetchPengantaran() {
            axios.get('/profile/' + this.user.id + '/pengantaran/list')
                .then(({ data }) => {
                    this.pengantaran = data;
                })
                .catch(({ response }) => {
                    console.log(response);
                })
        },

        edit(pesanan) {
            this.loader = true;
            this.id_pengantaran = pesanan.id;

            axios.get('/profile/' + pesanan.id)
                .then(({data}) => {
                    this.loader = false;
                    this.modal = true;

                    this.waktu_pengiriman = data[0].waktu_pengiriman.split('|')[1].split(':')[1].split(',');
                    
                    this.tanggal = data[0].tanggal_kirim;
                    this.waktu = data[0].waktu_kirim;
                    this.lokasi = data[0].lokasi;
                    this.alamat = data[0].alamat;
                    this.porsi = data[0].porsi;
                    this.catatan = data[0].catatan_pelanggan;
                })
                .catch(({response}) => {
                    this.modal = false;
                    Toast.fire(({
                        icon: "error",
                        title: "Mohon maaf telah terjadi kesalahan.",
                    }));
                })
        },

        pilihAlamat(e) {
            const alamat = e.target.value;

            if (alamat == 'rumah') {
                const alamatUser = user.rumah_teks;
                this.alamat = alamatUser != null ? alamatUser : this.defaultAlamat;
            } else {
                const alamatUser = user.kantor_teks;
                this.alamat = alamatUser != null ? alamatUser : this.defaultAlamat;
            }
        },
        
        editPengantaran() {
            this.loader = true;

            axios.put('/profile/' + this.id_pengantaran + '/update/pengantaran', {
                tanggal_kirim: this.tanggal,
                waktu_kirim: this.waktu,
                lokasi: this.lokasi,
                alamat: this.alamat,
                porsi: this.porsi,
                catatan_pelanggan: this.catatan,
            })
            .then(({data}) => {                
                this.loader = false;
                this.modal = false;

                if (data.success) {
                        Toast.fire({
                            icon: "success",
                            title: data.message,
                        });
                        this.fetchPengantaran();
                }

                this.clearEntities();
            })
        },

        closeModal() {
            this.modal = false;
            this.clearEntities();
        },
        
        remove(pesanan) {
            axios.delete('/profile/' + pesanan.id + '/remove/pesanan')
                .then(({ data }) => {                    
                    if (data.success) {
                        Toast.fire({
                            icon: "success",
                            title: data.message,
                        });
                        this.fetchPengantaran();
                    }
                })
        }
    }
}
</script>

<style>
@media (min-width: 640px) {
    table {
        display: inline-table !important;
    }

    thead tr:not(:first-child) {
        display: none;
    }
  }

td:not(:last-child) {
    border-bottom: 0;
}

th:not(:last-child) {
    border-bottom: 2px solid rgba(0, 0, 0, .1);
}

ul.paginate-links {
    margin-top: 1rem;
    display: flex;
    justify-content: flex-end;
    color: #666;
}

ul.paginate-links > li > a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
}

ul.paginate-links > li.active > a {
    background: #61c598;
    color: #fff;
}

ul.paginate-links > li.left-arrow > a,
ul.paginate-links > li.right-arrow > a {
    color: #61c598;
}

ul.paginate-links > li.disabled > a {
    color: #999;
}
</style>