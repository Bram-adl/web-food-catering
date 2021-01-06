<template>
    <div
        class="w-full h-full container mx-auto py-10 overflow-auto px-10 xl:px-0 text-gray-800"
    >
        <Modal
            :data="data"
            :pelanggan="pelanggan"
            @closeModal="closeModal"
        />

        <div>
            <h2 class="text-lg font-medium">Dashboard</h2>
        </div>

        <div class="grid lg:grid-cols-2 lg:gap-16 mt-10 lg:my-10">
            <div class="bg-gray-50 rounded-sm text-sm shadow-md">
                <div class="p-6 pb-0 flex items-center justify-between">
                    <h1 class="text-lg">{{ pelanggan.nama }}</h1>
                    <button
                        class="focus:outline-none text-xs bg-green-500 text-gray-50 rounded-md py-3 px-4 hover:bg-green-600 transition duration-300 ease-out"
                        @click="showProfileForm"
                    >
                        <i class="fas fa-edit"></i>
                        <span>Edit Profil</span>
                    </button>
                </div>

                <div class="px-6 pt-0 pb-4 flex items-center text-gray-500">
                    <span
                        class="inline-block w-2 h-2 bg-green-500 rounded-full"
                    ></span>
                    <span class="mx-2">Active</span>
                </div>

                <div
                    class="p-6 pt-0 pb-4 grid sm:grid-cols-2 sm:divide-x text-gray-500"
                >
                    <div class="text-left">
                        <i class="fas fa-envelope"></i>
                        <span class="ml-2">{{ pelanggan.email }}</span>
                    </div>

                    <div class="sm:text-right">
                        <i class="fab fa-whatsapp"></i>
                        <span class="ml-2">{{
                            pelanggan.wa || "(Belum menyimpan nomor whatsapp)"
                        }}</span>
                    </div>
                </div>

                <div
                    class="border-t p-6 py-4 flex items-center justify-between text-gray-400"
                >
                    <div class="flex items-center">
                        <span
                            class="inline-block w-8 h-8 rounded-full border border-green-500 text-green-500 flex items-center justify-center"
                            >{{ pelanggan.porsi || "0" }}</span
                        >
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
                            <a
                                class="hover:text-gray-800 text-xs flex items-center"
                                target="_blank"
                                :href="pelanggan.rumah_maps"
                            >
                                <span>{{ pelanggan.rumah_teks }}, {{ pelanggan.kelurahan }}, {{ pelanggan.kecamatan }}, {{ pelanggan.kota }}</span>
                                <i
                                    class="fas fa-external-link-alt text-sm ml-2"
                                ></i>
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
                            <a
                                class="hover:text-gray-800 flex items-center"
                                :href="pelanggan.kantor_maps"
                            >
                                <span
                                    >{{ pelanggan.kantor_teks }},
                                    {{ pelanggan.kelurahan }},
                                    {{ pelanggan.kecamatan }},
                                    {{ pelanggan.kota }}</span
                                >
                                <i
                                    class="fas fa-external-link-alt text-sm ml-2"
                                ></i>
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

            <div class="bg-gray-50 rounded-sm text-sm shadow-md my-10 lg:my-0">
                <div class="p-6">
                    <div
                        class="flex items-center flex-col flex-col-reverse sm:flex-row justify-between"
                    >
                        <h1
                            class="font-semibold text-xl w-full sm:w-auto mt-4 sm:mt-0"
                        >
                            Halo, {{ pelanggan.nama }}!
                        </h1>
                        <button
                            class="focus:outline-none text-xs bg-green-500 text-gray-50 w-full sm:w-auto rounded-md py-3 px-4 hover:bg-green-600 transition duration-300 ease-out"
                            @click="showRequestForm"
                        >
                            <i class="fas fa-plus"></i>
                            <span>Request Pengantaran</span>
                        </button>
                    </div>
                    <div>
                        <p class="text-sm font-light py-2 leading-relaxed">
                            Pemberitahuan untuk kamu nih!
                        </p>
                        <p class="text-sm font-light py-2 leading-relaxed">
                            Request pengantaran maksimal dilakukan
                            <strong>satu hari sebelumnya</strong> paling lambat
                            <strong>pukul 19.00</strong> untuk pengantaran
                            <strong>Pagi dan Siang</strong>
                        </p>
                        <p class="text-sm font-light py-2 leading-relaxed">
                            Sementara untuk pengantaran pada
                            <strong>Sore</strong>, maksimal
                            <strong>di hari tersebut</strong> paling lambat
                            <strong>pukul 12.00</strong> ya!
                        </p>
                    </div>
                </div>
            </div>
            <!-- /.information-card -->
        </div>

        <div class="bg-gray-50 rounded-sm shadow-md text-sm p-6 overflow-auto">
            <user-profile-table></user-profile-table>
        </div>
    </div>
</template>

<script>
import UserProfileTable from "./UserProfileTable";
import Modal from "../components/Modal";

export default {
    name: "UserProfile",

    components: {
        UserProfileTable,
        Modal
    },

    data() {
        return {
            pelanggan: pelanggan[0],
            data: {
                state: false,
                form: null
            }
        };
    },

    methods: {
        showProfileForm() {
            this.data = {
                state: true,
                form: 'profile',
            };
        },

        showRequestForm() {
            this.data = {
                state: true,
                form: 'request',
            };
        },

        closeModal() {
            this.data = {
                state: false,
                form: null,
            };
        }
    }
};
</script>

<style></style>
