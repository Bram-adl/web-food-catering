<template>
    <div>
        <!-- Navbar sent here -->
        <slot name="navbar"></slot>

        <!-- Main Content goes here -->
        <main>
            <div class="container mx-auto py-10 px-10 xl:px-0">
                <div class="row">
                    <div class="card bg-white rounded-md shadow-md py-4 mx-auto text-gray-500">
                        <div class="row grid grid-cols-2 text-center divide-x">
                            <div>
                                <i class="fas fa-truck text-lg md:text-xl"></i>
                                <h1 class="font-semibold text-md md:text-lg tracking-wide">
                                    Pengiriman
                                </h1>
                            </div>
                            <div>
                                <i class="fas fa-credit-card text-lg md:text-xl text-green-500"></i>
                                <h1 class="font-semibold text-md md:text-lg tracking-wide text-green-500">
                                    Pembayaran
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row grid lg:grid-cols-2 gap-10 mt-10">
                    <div class="card bg-white rounded-md shadow-md py-4 px-6 text-gray-800">
                        <div class="row">
                            <h2 class="font-semibold text-xl text-center">Invoice No {{ invoice }}</h2>
                        </div>
                        <div class="row mt-10">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    {{ paket.paket }}
                                </div>
                                <div class="flex-1 text-right">
                                    Rp {{ paket.harga | toRupiah }}
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-2">
                                <div class="flex-1">
                                    Biaya Kirim
                                </div>
                                <div class="flex-1 text-right">
                                    Rp 0
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-2">
                                <div class="flex-1">
                                    Kode Unik
                                </div>
                                <div class="flex-1 text-right">
                                    Rp {{ pembelian.kode_unik | toRupiah }}
                                </div>
                            </div>

                            <div class="flex items-center justify-between mt-2 mb-5 font-semibold text-lg">
                                <div class="flex-1">
                                    Total
                                </div>
                                <div class="flex-1 text-right">
                                    Rp {{ total | toRupiah }}
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5 pb-5 border-t border-b">
                            <p class="font-light text-sm italic">
                                Kode unik adalah angka yang bertujuan untuk mempermudah verifikasi pembayaran.
                            </p>
                        </div>
                        <div class="row mt-2">
                            <p class="text-sm">
                                Mohon upload bukti bayar setelah melakukan pembayaran
                            </p>
                            <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" class="text-sm my-1" @change="uploadBuktiBayar">
                            <p class="text-sm">
                                Verifikasi akan dilakukan dalam 12 jam
                            </p>
                        </div>
                    </div>

                    <div class="card bg-white rounded-md shadow-md py-4 px-6 text-gray-800">
                        <div class="row">
                            <h2 class="font-semibold text-xl text-center">Metode Pembayaran</h2>
                        </div>

                        <div class="row mt-10">
                            <div class="md:flex items-center justify-between">
                                <div class="flex-1">
                                    <img src="/images/pembayaran/bni.png" class="w-36">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">
                                        370354264 A.N Amira Ulvi Annisa
                                    </p>
                                </div>
                            </div>

                            <div class="md:flex items-center justify-between my-2">
                                <div class="flex-1">
                                    <div>
                                        <img src="/images/pembayaran/qris.png" class="w-20">
                                    </div>
                                    <div>
                                        <p class="my-2">Scan/Upload QR Code di Aplikasi berikut:</p>
                                        <div>
                                            <img src="/images/pembayaran/epay.png" class="w-36">
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div>
                                        <a href="/images/pembayaran/qr.png" target="_blank">
                                            <img src="/images/pembayaran/qr.png" class="w-36 h-36 object-cover">
                                        </a>
                                    </div>
                                    <p class="font-light text-sm italic">*Klik untuk memperbesar</p>
                                </div>
                            </div>

                            <div class="md:flex items-center justify-between">
                                <div class="flex-1">
                                    <img src="/images/pembayaran/jenius.png" class="w-36">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm">
                                        90020162929 A.N Abdul Latif <br>
                                        Atau Cashtag: $senjaniid
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row grid md:grid-cols-2 gap-4 lg:gap-10 mt-10">
                    <div class="text-right">
                        <a href="#" class="block" @click.prevent="batalkanPembelian">
                            <button class="w-full lg:w-auto bg-red-400 hover:bg-red-500 transition ease-out duration-300 text-gray-50 rounded-md shadow-md py-3 px-4">
                                Batalkan Pembelian
                            </button>
                        </a>
                    </div>
                    <div>
                        <a href="#" class="block" @click.prevent="selesaikanPembelian">
                            <button class="w-full lg:w-auto bg-green-400 hover:bg-green-500 transition ease-out duration-300 text-gray-50 rounded-md shadow-md py-3 px-4">
                                Selesaikan Pembayaran
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <Loader :start="loader"/>
    </div>
</template>

<script>
import Loader from '../../components/Loader';

export default {
    name: 'Payment',

    components: {
        Loader,
    },

    data() {
        return {
            loader: false,
            
            user,
            paket,
            pembelian,

            bukti_bayar: null,
        }
    },

    computed: {
        invoice() {
            let zerofill = 5;
            let polyfill = String(this.pembelian.id).length;
            let zeros = zerofill - polyfill;
            
            let invoice = '';
            for (let i = 0; i < zeros; i++) {
                invoice += '0';
            }

            return `SK${invoice}${this.pembelian.id}`;
        },

        total() {
            return parseInt(this.paket.harga) + parseInt(this.pembelian.kode_unik);
        }
    },

    filters: {
        toRupiah(number) {
            // source: https://jagowebdev.com/format-rupiah-dengan-javascript/
            let reversedNumber = number
                .toString()
                .split("")
                .reverse()
                .join("");
            let rupiah = reversedNumber
                .match(/\d{1,3}/g)
                .join(".")
                .split("")
                .reverse()
                .join("");
            return rupiah;
        }
    },

    methods: {
        uploadBuktiBayar(e) {
            const file = e.target.files[0];
            const fileReader = new FileReader;

            // validasi frontend
            const fileSize = file.size;
            const fileType = file.type.split('/')[file.type.split('/').length - 1];
            const extensions = ['jpeg', 'jpg', 'png'];

            if (fileSize > 2000000) {
                return Toast.fire({
                    icon: "error",
                    title: "Mohon pastikan ukuran gambar tidak lebih dari 2mb!",
                });
            }

            if (extensions.indexOf(fileType) == -1) {
                return Toast.fire({
                    icon: "error",
                    title: "Mohon pastikan format gambar hanya jpeg, jpg, atau png!",
                });
            }

            fileReader.onloadend = (file) => {
                this.bukti_bayar = fileReader.result;
            };

            fileReader.readAsDataURL(file);
        },
        
        batalkanPembelian() {
            Swal.fire({
                title: 'Apa kamu yakin ingin membatalkan pembelian?',
                text: "Kamu masih dapat membuat pembelian lagi setelahnya.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Batalkan pembelian!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loader = true;
                    axios.delete(`/pembelian/${this.pembelian.id}`)
                        .then(({ data }) => {
                            if (data.success) {
                                this.loader = false;
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Kamu telah membatalkan pembelian.', 
                                })
                                setTimeout(() => {
                                    location.href = '/';
                                }, 1000)
                            }
                        })
                        .catch(({ response }) => {
                            console.log(response);
                        })
                }
            })
        },

        selesaikanPembelian() {
            if (this.bukti_bayar == null) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Mohon mengupload bukti bayar!',
                });
            }

            this.loader = true;
            axios.put(`/pembelian/${this.pembelian.id}/edit`, {
                bukti_bayar: this.bukti_bayar,
            })
            .then(({ data }) => {
                this.loader = false;
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil melakukan pembayaran!',
                    text: 'Kamu dapat melihat status pembelian di dashboard.',
                });
                setTimeout(() => {
                    location.href= `/profile/${this.user.nama.split(' ').join('')}/pembelian`;
                }, 1000)
            })
        },
    }
}
</script>

<style>

</style>