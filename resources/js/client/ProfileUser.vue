<template>
    <div class="bg-gray-50 rounded-md shadow-md py-4">
        <div class="row flex items-center justify-between text-sm text-gray-800 px-6 mb-4">
            <div class="flex-1">
                <div class="text-lg font-medium">
                    {{ user.nama }}
                </div>
                <div class="flex items-center">
                    <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                    <div class="ml-2 text-sm">Active</div>
                </div>
            </div>
            <div>
                <button class="bg-green-500 hover:bg-green-600 rounded-md py-2 px-3 text-gray-50 focus:outline-none transition ease-out duration-300" @click="showModal">
                    <i class="fas fa-edit"></i>
                    <span>Edit Profile</span>
                </button>
            </div>
        </div>

        <div class="row flex items-start lg:items-center justify-between flex-col lg:flex-row text-sm px-6 mb-4 text-gray-500">
            <div class="flex items-center justify-center">
                <i class="fas fa-envelope"></i>
                <div class="ml-2">
                    <a :href="`mailto:${user.email}`">{{ user.email }}</a>
                </div>
            </div>
            <div class="flex items-center justify-center">
                <i class="fab fa-whatsapp"></i>
                <div class="ml-2">
                    <a :href="`https://wa.me/+62${ user.wa.slice(1) }`">{{ user.wa }}</a>
                </div>
            </div>
        </div>

        <div class="row flex items-center justify-between text-sm px-6 border-t border-b py-4 mb-4">
            <div>
                <label class="font-medium block">Catatan Pelanggan:</label>
                <span class="text-gray-500">{{ user.keterangan ? user.keterangan : 'Tidak ada catatan.' }}</span>
            </div>
        </div>

        <div class="row flex items-center justify-between text-sm px-6 mb-4">
            <div>
                <label class="font-medium block">Alamat Rumah:</label>
                <span v-html="alamatRumah"></span>
            </div>
        </div>

        <div class="row flex items-center justify-between text-sm px-6">
            <div>
                <label class="font-medium block">Alamat Kantor:</label>
                <span v-html="alamatKantor"></span>
            </div>
        </div>

        <!-- Modal -->
        <transition enter-active-class="animate__animated animate__fadeIn animate__faster" leave-active-class="animate__animated animate__fadeOut animate__faster">
            <modal 
                v-if="modal"
                title="Edit Profil"
                action="Simpan Perubahan"
                method="updateProfile"
                @updateProfile="updateProfile"
                @closeModal="closeModal"
            >
                <div class="mt-2">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" autocomplete="given-name" class="focus:outline-none flex-1 block w-full rounded-md sm:text-sm border border-gray-300 mt-1 px-3 py-2" placeholder="Nama Lengkap" v-model="nama">
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>

                <div class="mt-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" autocomplete="email" class="focus:outline-none flex-1 block w-full rounded-md sm:text-sm border border-gray-300 mt-1 px-3 py-2" placeholder="Email" v-model="email">
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>

                <div class="mt-2">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" autocomplete="family-name" class="focus:outline-none flex-1 block w-full rounded-md sm:text-sm border border-gray-300 mt-1 px-3 py-2" placeholder="Kosongkan jika tidak merubah" v-model="password">
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>

                <div class="mt-2">
                    <label for="wa" class="block text-sm font-medium text-gray-700">Nomor WA</label>
                    <input type="number" name="wa" id="wa" autocomplete="family-name" class="focus:outline-none flex-1 block w-full rounded-md sm:text-sm border border-gray-300 mt-1 px-3 py-2" placeholder="Nomor WA" v-model="wa">
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>
            
                <div class="mt-2">
                    <label for="rumah_teks" class="block text-sm font-medium text-gray-700">
                        Alamat Rumah (Teks)
                    </label>
                    <div class="mt-1">
                        <textarea id="rumah_teks" name="rumah_teks" rows="3" class="focus:outline-none shadow-sm mt-1 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2" placeholder="Tuliskan alamat rumah lengkap" v-model="rumah_teks"></textarea>
                    </div>
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>

                <div class="mt-2">
                    <div>
                        <label for="rumah_maps" class="block text-sm font-medium text-gray-700">
                            Alamat Rumah (Gmaps)
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm focus:outline-none w-full sm:text-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm px-3 py-2">
                                http://
                            </span>
                            <input type="text" name="rumah_maps" id="rumah_maps" class="focus:outline-none flex-1 block w-full rounded-none rounded-r-md sm:text-sm border border-gray-300 px-3 py-2" placeholder="www.example.com" v-model="rumah_maps">
                        </div>
                    </div>
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>
                
                <div class="mt-2 mb-2">
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label for="rumah_kota" class="block text-sm font-medium text-gray-700">Kota (Rumah)</label>
                            <select id="rumah_kota" name="rumah_kota" autocomplete="rumah_kota" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="rumah_kota">
                                <option v-for="k in kota" :key="k.id" :value="k.id">{{ k.kota }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan (Rumah)</label>
                            <select id="kecamatan" name="kecamatan" autocomplete="kecamatan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="rumah_kecamatan">
                                <option v-for="k in kecamatan" :key="k.id" :value="k.id">{{ k.kecamatan }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan (Rumah)</label>
                            <select id="kelurahan" name="kelurahan" autocomplete="kelurahan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="rumah_kelurahan">
                                <option v-for="k in kelurahan" :key="k.id" :value="k.id">{{ k.kelurahan }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error
                    </p> -->
                </div>

                <div class="mt-2">
                    <label for="kantor_teks" class="block text-sm font-medium text-gray-700">
                        Alamat Kantor (Teks)
                    </label>
                    <div class="mt-1">
                        <textarea id="kantor_teks" name="kantor_teks" rows="3" class="focus:outline-none shadow-sm mt-1 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2" placeholder="Tuliskan alamat kantor lengkap" v-model="kantor_teks"></textarea>
                    </div>
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>

                <div class="mt-2">
                    <div>
                        <label for="kantor_maps" class="block text-sm font-medium text-gray-700">
                            Alamat kantor (Gmaps)
                        </label>
                        <div class="mt-1 flex rounded-md shadow-sm focus:outline-none w-full sm:text-sm">
                            <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm px-3 py-2">
                                http://
                            </span>
                            <input type="text" name="kantor_maps" id="kantor_maps" class="focus:outline-none flex-1 block w-full rounded-none rounded-r-md sm:text-sm border border-gray-300 px-3 py-2" placeholder="www.example.com" v-model="kantor_maps">
                        </div>
                    </div>
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>
                
                <div class="mt-2 mb-2">
                    <div class="grid grid-cols-3 gap-3">
                        <div>
                            <label for="kantor_kota" class="block text-sm font-medium text-gray-700">Kota (kantor)</label>
                            <select id="kantor_kota" name="kantor_kota" autocomplete="kantor_kota" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="kantor_kota">
                                <option v-for="k in kota" :key="k.id" :value="k.id">{{ k.kota }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="kecamatan" class="block text-sm font-medium text-gray-700">Kecamatan (kantor)</label>
                            <select id="kecamatan" name="kecamatan" autocomplete="kecamatan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="kantor_kecamatan">
                                <option v-for="k in kecamatan" :key="k.id" :value="k.id">{{ k.kecamatan }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="kelurahan" class="block text-sm font-medium text-gray-700">Kelurahan (kantor)</label>
                            <select id="kelurahan" name="kelurahan" autocomplete="kelurahan" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="kantor_kelurahan">
                                <option v-for="k in kelurahan" :key="k.id" :value="k.id">{{ k.kelurahan }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error
                    </p> -->
                </div>

                <div class="mt-2">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700">
                        Catatan Pelanggan
                    </label>
                    <div class="mt-1">
                        <textarea id="keterangan" name="keterangan" rows="3" class="focus:outline-none shadow-sm mt-1 block w-full sm:text-sm border border-gray-300 rounded-md px-3 py-2" placeholder="Tuliskan keterangan seperti alergi dan lainnya." v-model="keterangan"></textarea>
                    </div>
                    <!-- <p class="mt-1 text-sm text-red-400 italic">
                        Error feedback
                    </p> -->
                </div>
            </modal>
        </transition>

        <!-- Loader -->
        <Loader :start="loader"/>
    </div>
</template>

<script>
import Modal from '../components/Modal';
import Loader from '../components/Loader';

export default {
    name: 'ProfileUser',

    components: {
        Modal,
        Loader,
    },

    props: {
        user: {
            type: Object,
            required: true,
        },

        kota: {
            type: Array,
            required: true,
        },

        kecamatan: {
            type: Array,
            required: true,
        },

        kelurahan: {
            type: Array,
            required: true,
        },
    },

    data() {
        return {
            modal: false,
            loader: false,
            
            nama: this.user.nama,
            email: this.user.email,
            password: null,
            wa: this.user.wa,
            rumah_teks: this.user.rumah_teks,
            rumah_maps: this.user.rumah_maps,
            rumah_kota: this.user.rumah_kota,
            rumah_kecamatan: this.user.rumah_kecamatan,
            rumah_kelurahan: this.user.rumah_kelurahan,
            kantor_teks: this.user.kantor_teks,
            kantor_maps: this.user.kantor_maps,
            kantor_kota: this.user.kantor_kota,
            kantor_kecamatan: this.user.kantor_kecamatan,
            kantor_kelurahan: this.user.kantor_kelurahan,
            keterangan: this.user.keterangan,
        }
    },

    computed: {
        alamatRumah() {
            if (this.user.rumah_teks && this.user.rumah_maps) {
                // jika alamat rumah terisi dan maps terisi
                return `
                    <a class="text-gray-500 flex items-center" href="${this.user.rumah_maps}">
                        <span>${this.user.rumah_teks}, ${this.user.rumah_kelurahan}, ${this.user.rumah_kecamatan}, ${this.user.rumah_kota}</span>
                        <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                `;
            } else if (this.user.rumah_teks && !this.user.rumah_maps) {
                // jika alamat rumah terisi dan maps tidak terisi
                return `
                    <a class="text-gray-500 flex items-center" href="#">
                        <span>${this.user.rumah_teks}, ${this.user.rumah_kelurahan}, ${this.user.rumah_kecamatan}, ${this.user.rumah_kota}</span>
                        <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                `;
            } else {
                // jika alamat rumah tidak terisi meskipun maps terisi
                return `<a class="text-gray-500" href="#">Belum menuliskan alamat rumah.</a>`;
            }
        },

        alamatKantor() {
            if (this.user.kantor_teks && this.user.kantor_maps) {
                // jika alamat kantor terisi dan maps terisi
                return `
                    <a class="text-gray-500 flex items-center" href="${this.user.kantor_maps}">
                        <span>${this.user.kantor_teks}, ${this.user.kantor_kelurahan}, ${this.user.kantor_kecamatan}, ${this.user.kantor_kota}</span>
                        <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                `;
            } else if (this.user.kantor_teks && !this.user.kantor_maps) {
                // jika alamat kantor terisi dan maps tidak terisi
                return `
                    <a class="text-gray-500 flex items-center" href="#">
                        <span>${this.user.kantor_teks}, ${this.user.kantor_kelurahan}, ${this.user.kantor_kecamatan}, ${this.user.kantor_kota}</span>
                        <i class="fas fa-external-link-alt ml-2"></i>
                    </a>
                `;
            } else {
                // jika alamat kantor tidak terisi meskipun maps terisi
                return `<a class="text-gray-500" href="#">Belum menuliskan alamat kantor.</a>`;
            }
        }
    },

    methods: {
        showModal() {
            this.modal = true;
        },

        closeModal() {
            this.modal = false;
        },

        updateProfile() {
            this.loader = true;
            
            if (this.password != null) {
                if (this.password.length == 0) this.password = null;
            }

            axios.put('/pelanggan/update/' + this.user.id, {
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
                .then(({ data }) => {
                    this.loader = false;
                    
                    if (data.success) {
                        Toast.fire({
                            icon: "success",
                            title: data.message,
                        });

                        setTimeout(() => {
                            location.reload();
                        }, 1000)
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>

<style>

</style>