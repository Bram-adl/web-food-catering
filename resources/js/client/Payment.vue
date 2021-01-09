<template>
    <div class="container mx-auto py-8">
        <div class="row text-center">
            <div class="bg-white shadow-sm rounded-md grid grid-cols-2 divide-x py-3 px-4 text-gray-500">
                <div class="transition ease-out duration-300" :class="{ 'text-green-400': panel == 'payment' }">
                    <div><i class="fas fa-shopping-cart text-2xl"></i></div>
                    <div><p class="text-lg mt-2">Pengiriman</p></div>
                </div>
                <div class="transition ease-out duration-300" :class="{ 'text-green-400': panel == 'order' }">
                    <div><i class="fas fa-credit-card text-2xl"></i></div>
                    <div><p class="text-lg mt-2">Pembayaran</p></div>
                </div>
            </div>
        </div>

        <loader :start="start"></loader>
        <router-view></router-view>
    </div>
</template>

<script>
import Loader from '../components/Loader.vue';

export default {
    name: 'payment',

    components: { Loader },

    data() {
        return {
            panel: null,
            
            user,
            paket,

            start: false,

            form: {
                id_pelanggan: user.id,
                id_paket: paket.id,
                bukti_bayar: null,
                status: 'Belum bayar',
                lokasi: null,
                alamat: null,
                waktu_pengiriman: null,
                tanggal_mulai: null,
            }
        }
    },

    mounted() {
        this.panel = this.$route.path.slice(1);
        eventBus.$on('lanjutkanPembayaran', (data) => this.lanjutkanPembayaran(data));
        eventBus.$on('selesaikanPembayaran', (data) => this.selesaikanPembayaran(data));
    },

    methods: {
        lanjutkanPembayaran(data) {
            this.panel = 'pembayaran';

            this.form.lokasi = data.lokasi;
            this.form.alamat = data.alamat;
            this.form.waktu_pengiriman = data.waktu_pengiriman;
            this.form.tanggal_mulai = data.tanggal_mulai;

            this.start = true;

            axios.post('/pembelian/store', {
                id_pelanggan: this.form.id_pelanggan,
                id_paket: this.form.id_paket,
                bukti_bayar: this.form.bukti_bayar,
                status: this.form.status,
                lokasi: this.form.lokasi,
                alamat: this.form.alamat,
                waktu_pengiriman: this.form.waktu_pengiriman,
                tanggal_mulai: this.form.tanggal_mulai,
            })
            .then(response => {
                this.start = false;
                const nextRoute = this.$route.fullPath.replace('payment', 'order');
                this.$router.push(nextRoute);
            })
            .catch(error => {
                this.start = false;
                Toast.fire({
                    icon: 'error',
                    title: 'Mohon masukkan tanggal setelah hari ini!',
                });
            })
        },

        selesaikanPembayaran(data) {
            this.form.bukti_bayar = data.bukti_bayar;
            this.form.status = data.status;

            this.start = true;

            axios.put(`/pembelian/${this.paket.id}/user/${this.user.id}`, {
                bukti_bayar: this.form.bukti_bayar,
                status: 'Proses verifikasi'
            })
                .then(({data}) => {
                    this.start = false;
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Pembelian berhasil dilakukan!',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                    })
                    .then(result => {
                        if (result.isConfirmed) {
                            location.href = '/profile/' + this.user.id + '/' + this.user.nama.split(' ').join('');
                        }
                    });
                })
        }
    }
};
</script>
