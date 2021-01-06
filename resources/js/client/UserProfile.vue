<template>
    <div class="w-full h-full container mx-auto py-10 overflow-auto px-10 xl:px-0 text-gray-800">
        <Modal :data="data" @closeModal="closeModal"/>
        
        <div>
            <h2 class="text-lg font-medium">Dashboard</h2>
        </div>

        <div class="grid lg:grid-cols-2 lg:gap-16 mt-10 lg:my-10">
            <user-profile-card :pelanggan="pelanggan"></user-profile-card>

            <div class="bg-gray-50 rounded-sm text-sm shadow-md my-10 lg:my-0">
                <div class="p-6">
                    <div class="flex items-center flex-col flex-col-reverse sm:flex-row justify-between">
                        <h1 class="font-semibold text-xl w-full sm:w-auto mt-4 sm:mt-0">Halo, {{ pelanggan.nama }}!</h1>
                        <button class="focus:outline-none text-xs bg-green-500 text-gray-50 w-full sm:w-auto rounded-md py-3 px-4 hover:bg-green-600 transition duration-300 ease-out" @click="showModal">
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
            <!-- /.information-card -->
        </div>

        <div class="bg-gray-50 rounded-sm shadow-md text-sm p-6 overflow-auto">
            <user-profile-table></user-profile-table>
        </div>
    </div>
</template>

<script>
import UserProfileTable from './UserProfileTable'
import UserProfileCard from './UserProfileCard'
import Modal from '../components/Modal'

export default {
    name: 'UserProfile',

    components: {
        UserProfileTable,
        UserProfileCard,
        Modal,
    },

    data() {
        return {
            pelanggan: pelanggan,
            data: {
                state: false,
                form: 'pengantaran',
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
};
</script>

<style></style>
