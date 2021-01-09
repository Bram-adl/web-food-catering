<template>
    <div>
        <div class="row my-8 grid grid-cols-2 gap-8">
            <div class="bg-white shadow-md rounded-md py-3 px-4">
                <div class="pt-2 pb-4 border-b">
                    <h2 class="text-center font-semibold text-xl uppercase tracking-wider">Invoice No {{ invoice }}</h2>
                </div>

                <div class="my-2 py-2">
                    <div class="my-2 flex items-center justify-between">
                        <div class="w-1/2 text-left">
                            {{ paket.paket }}
                        </div>
                        <div class="w-1/2 text-right">
                            Rp. {{ paket.harga | toRupiah }}
                        </div>
                    </div>
                    <div class="my-2 flex items-center justify-between">
                        <div class="w-1/2 text-left">
                            Biaya Kirim
                        </div>
                        <div class="w-1/2 text-right">
                            Rp. 0
                        </div>
                    </div>
                    <div class="my-2 flex items-center justify-between">
                        <div class="w-1/2 text-left">
                            Kode Unik*
                        </div>
                        <div class="w-1/2 text-right">
                            Rp. {{ pembelian.kode_unik }}
                        </div>
                    </div>
                    <div class="my-2 flex items-center justify-between">
                        <div class="w-1/2 text-left">
                            <div class="font-bold text-lg uppercase">Total</div>
                        </div>
                        <div class="w-1/2 text-right">
                            <div class="font-bold text-lg uppercase">Rp. {{ total | toRupiah }}</div>
                        </div>
                    </div>
                </div>

                <div class="py-4 border-t border-b">
                    <p class="text-sm text-gray-800 font-light">
                        * Kode unik merupakan angka acak antara 10-99  yang bertujuan untuk mempermudah  identifikasi pembayaran
                    </p>
                </div>

                <div class="pt-4 pb-2 text-gray-800 text-sm">
                    <label for="bukti_bayar">Jika sudah melakukan pembayaran, silahkan upload bukti pembayaran</label>
                    <input type="file" name="bukti_bayar" id="bukti_bayar" class="my-2" @change="uploadBuktiBayar">
                    <p>Kami akan melakukan verifikasi dalam 12 jam.</p>
                </div>
            </div>
            <div class="py-3 px-4 text-gray-800">
                <div>
                    <h2>Silahkan melakukan pembayaran melalui:</h2>
                </div>

                <div class="flex items-center justify-between border-b border-gray-300 py-4">
                    <div class="flex-1 h-10">
                        <img src="/images/pembayaran/bni.png" class="h-full object-contain">
                    </div>
                    <div class="flex-1 text-center">
                        <p>No. Rekening: 370354264</p>
                        <p>A.N Amira Ulvi Annisa</p>
                    </div>
                </div>

                <div class="flex items-center justify-between border-b border-gray-300 py-4">
                    <div class="flex-1 h-10">
                        <img src="/images/pembayaran/jenius.png" class="h-full object-contain">
                    </div>
                    <div class="flex-1 text-center">
                        <p>No. Rekening: 90020162929</p>
                        <p>Cashtag: $senjaniid</p>
                        <p>A.N Abdul Latif</p>
                    </div>
                </div>

                <div class="flex items-center justify-between py-4">
                    <div class="flex-1">
                        <img src="/images/pembayaran/qris.png" class="h-10">
                        <p class="my-4 text-sm">Scan/Upload QR Code di Aplikasi Berikut: </p>
                        <img src="/images/pembayaran/epay.png" class="h-10">
                    </div>
                    <div class="flex-1">
                        <a href="/images/pembayaran/qr.png" class="block" target="_blank">
                            <img src="/images/pembayaran/qr.png" class="h-40 mx-auto">
                            <p class="text-center text-sm font-light">Klik untuk memperbesar QR</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row flex items-center justify-end">
            <button class="py-2 px-3 block w-full rounded-md bg-green-400 text-gray-50 hover:bg-green-500 transition ease-out duration-300" @click="selesaikanPembayaran">
                <span class="text-sm">Submit</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PaymentPembayaran',

    data() {
        return {
            pembelian: {},
            bukti_bayar: null,

            user,
            paket,
        }
    },

    computed: {
        invoice() {
            let idLength = String(this.pembelian.id).length;
            let autofill = 5;
            let zeros = autofill - idLength;

            let invoice = '';
            for (let i = 0; i < zeros; i ++) {
                invoice += '0';
            }

            return `SK${invoice}${this.pembelian.id}`;
        },

        total() {
            let total = parseInt(this.paket.harga) + parseInt(this.pembelian.kode_unik);
            return total;
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

    mounted() {
        this.fetchPembelian();
    },

    methods: {
        fetchPembelian() {
            axios.get(`/pembelian/${paket.id}/user/${user.id}}`)
                .then(({data}) => {
                    this.pembelian = data.message;
                })
                .catch(error => {
                    console.log(error);
                })
        },

        uploadBuktiBayar(event) {
            const file = event.target.files[0];
            const fileReader = new FileReader();

            // validasi foto
            const type = file.type.split('/')[1];
            const size = file.size;
            const extensions = ['jpeg', 'jpg', 'png', 'svg'];

            if (extensions.indexOf(type) < 0) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Mohon upload foto dengan format jpeg, jpg, png, atau svg!',
                });
            }

            if (size > 2000000) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Ukuran gambar melebihi 2MB!',
                });
            }

            // ...validated
            fileReader.onloadend = (file) => {
                this.bukti_bayar = fileReader.result;
            }

            fileReader.readAsDataURL(file);
        },

        selesaikanPembayaran() {
            if (!this.bukti_bayar) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Mohon upload bukti bayar!',
                });
            }

            eventBus.$emit('selesaikanPembayaran', {
                bukti_bayar: this.bukti_bayar,
                status: 'Verifikasi',
            });
        },
    }
}
</script>

<style>

</style>