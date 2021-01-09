<template>
    <div>
        <div class="row my-8 bg-white shadow-sm rounded-md">
            <div class="py-3 px-4">
                <h2 class="font-semibold text-lg text-center tracking-wider uppercase">Waktu Pengiriman</h2>
            </div>
            <div class="grid grid-cols-3 divide-x text-center border-t border-b text-gray-800">
                <div class="py-2">
                    <div class="text-md font-semibold">Pagi</div>
                    <div>05.00 - 07.00</div>
                </div>
                <div class="py-2">
                    <div class="text-md font-semibold">Siang</div>
                    <div>10.00 - 12.00</div>
                </div>
                <div class="py-2">
                    <div class="text-md font-semibold">Sore</div>
                    <div>16.00 - 18.00</div>
                </div>
            </div>
            <div class="py-3 px-4">
                <p class="font-light text-sm text-left tracking-wide text-gray-600">
                    Dikirim melalui rute dari tempat terdekat ke tempat terjauh. Kurir akan mengabari ketika akan mengantar paket ke lokasimu. <br>
                    Untuk hari <strong>minggu</strong> dan <strong>tanggal merah</strong> libur. Pastikan kamu tidak memulai pada tanggal merah.
                </p>
            </div>
        </div>

        <div class="row grid grid-cols-2 gap-10">
            <div class="bg-white shadow-sm rounded-md py-3 px-4">
                <div class="font-medium capitalize text-lg">Lokasi pengiriman</div>
                <div class="my-4">
                    <div class="flex items-center my-1">
                        <input type="radio" name="alamat_radio" value="rumah" v-model="lokasi" id="rumah">
                        <label class="text-sm ml-2" for="rumah">Rumah</label>
                    </div>
                    <div class="flex items-center my-1">
                        <input type="radio" name="alamat_radio" value="kantor" v-model="lokasi" id="kantor">
                        <label class="text-sm ml-2" for="kantor">Kantor</label>
                    </div>
                </div>
                <div>
                    <textarea name="alamat" id="alamat" class="bg-gray-200 text-gray-600 text-sm py-3 px-4 w-full h-full rounded-md" v-model="alamat"></textarea>
                </div>
            </div>
            <div class="bg-white shadow-sm rounded-md py-3 px-4">
                <div class="font-medium capitalize text-lg">Waktu pengiriman</div>
                <div class="my-4">
                    <select class="bg-gray-200 text-gray-600 text-sm py-3 px-4 w-full rounded-md" @change="pilihWaktuPengiriman">
                        <option value="" selected disabled hidden>-- Pilih Waktu --</option>
                        <option value="hari: senin-sabtu | waktu: pagi, siang, sore">Senin - Sabtu : Pagi, Siang, Sore</option>
                        <option value="hari: senin-sabtu | waktu: pagi, siang">Senin - Sabtu : Pagi dan Siang</option>
                        <option value="hari: senin-sabtu | waktu: pagi, sore">Senin - Sabtu : Pagi dan Sore</option>
                        <option value="hari: senin-sabtu | waktu: siang, sore">Senin - Sabtu : Siang dan Sore</option>
                        <option value="hari: senin-sabtu | waktu: pagi">Senin - Sabtu : Pagi Saja</option>
                        <option value="hari: senin-sabtu | waktu: siang">Senin - Sabtu : Siang Saja</option>
                        <option value="hari: senin-sabtu | waktu: sore">Senin - Sabtu : Sore Saja</option>
                        <option value="hari: senin-jumat | waktu: pagi, siang, sore">Senin - Jumat : Pagi, Siang, Sore</option>
                        <option value="hari: senin-jumat | waktu: pagi, siang">Senin - Jumat : Pagi dan Siang</option>
                        <option value="hari: senin-jumat | waktu: pagi, sore">Senin - Jumat : Pagi dan Sore</option>
                        <option value="hari: senin-jumat | waktu: siang, sore">Senin - Jumat : Siang dan Sore</option>
                        <option value="hari: senin-jumat | waktu: pagi">Senin - Jumat : Pagi Saja</option>
                        <option value="hari: senin-jumat | waktu: siang">Senin - Jumat : Siang Saja</option>
                        <option value="hari: senin-jumat | waktu: sore">Senin - Jumat : Sore Saja</option>
                        <option value="default">Pilih Hari Sendiri</option>
                    </select>
                </div>
                <div>
                    <div v-if="waktuPengiriman == 'default'">
                        <div class="flex items-center justify-between mb-4">
                            <label class="text-sm font-semibold tracking-wider w-1/3">Pilih hari</label>
                            <div class="flex items-center justify-between -mx-1">
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-green-400 transition ease-out duration-300 cursor-pointer" :class="[hari.indexOf('senin') != -1 ? 'bg-green-400 text-gray-50' : 'text-gray-400 hover:text-green-400' ]" for="senin">Senin</label>
                                    <input type="checkbox" id="senin" hidden value="senin" v-model="hari">
                                </div>
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-green-400 transition ease-out duration-300 cursor-pointer" :class="[hari.indexOf('selasa') != -1 ? 'bg-green-400 text-gray-50' : 'text-gray-400 hover:text-green-400' ]" for="selasa">Selasa</label>
                                    <input type="checkbox" id="selasa" hidden value="selasa" v-model="hari">
                                </div>
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-green-400 transition ease-out duration-300 cursor-pointer" :class="[hari.indexOf('rabu') != -1 ? 'bg-green-400 text-gray-50' : 'text-gray-400 hover:text-green-400' ]" for="rabu">Rabu</label>
                                    <input type="checkbox" id="rabu" hidden value="rabu" v-model="hari">
                                </div>
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-green-400 transition ease-out duration-300 cursor-pointer" :class="[hari.indexOf('kamis') != -1 ? 'bg-green-400 text-gray-50' : 'text-gray-400 hover:text-green-400' ]" for="kamis">Kamis</label>
                                    <input type="checkbox" id="kamis" hidden value="kamis" v-model="hari">
                                </div>
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-green-400 transition ease-out duration-300 cursor-pointer" :class="[hari.indexOf('jumat') != -1 ? 'bg-green-400 text-gray-50' : 'text-gray-400 hover:text-green-400' ]" for="jumat">Jum'at</label>
                                    <input type="checkbox" id="jumat" hidden value="jumat" v-model="hari">
                                </div>
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-green-400 transition ease-out duration-300 cursor-pointer" :class="[hari.indexOf('sabtu') != -1 ? 'bg-green-400 text-gray-50' : 'text-gray-400 hover:text-green-400' ]" for="sabtu">Sabtu</label>
                                    <input type="checkbox" id="sabtu" hidden value="sabtu" v-model="hari">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <label class="text-sm font-semibold tracking-wider w-1/3">Pilih waktu</label>
                            <div class="flex items-center justify-between -mx-1">
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-blue-400 transition ease-out duration-300 cursor-pointer" :class="[waktu.indexOf('pagi') != -1 ? 'bg-blue-400 text-gray-50' : 'text-gray-400 hover:text-blue-400' ]" for="pagi">Pagi</label>
                                    <input type="checkbox" id="pagi" hidden value="pagi" v-model="waktu">
                                </div>
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-blue-400 transition ease-out duration-300 cursor-pointer" :class="[waktu.indexOf('siang') != -1 ? 'bg-blue-400 text-gray-50' : 'text-gray-400 hover:text-blue-400' ]" for="siang">Siang</label>
                                    <input type="checkbox" id="siang" hidden value="siang" v-model="waktu">
                                </div>
                                <div class="mx-1">
                                    <label class="border rounded-md py-1 px-2 text-xs hover:border-blue-400 transition ease-out duration-300 cursor-pointer" :class="[waktu.indexOf('sore') != -1 ? 'bg-blue-400 text-gray-50' : 'text-gray-400 hover:text-blue-400' ]" for="sore">Sore</label>
                                    <input type="checkbox" id="sore" hidden value="sore" v-model="waktu">
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <label for="tanggal" class="text-sm font-semibold tracking-wider w-1/3">Pilih tanggal</label>
                            <input type="date" v-model="tanggalMulai" id="tanggal" class="bg-gray-200 text-gray-600 text-sm py-3 px-4 w-full rounded-md w-2/3">
                        </div>
                    </div>
                    <div class="flex items-center justify-between" v-if="waktuPengiriman != 'default' && waktuPengiriman">
                        <label for="tanggal" class="text-sm font-semibold tracking-wider w-1/3">Mulai tanggal</label>
                        <input type="date" v-model="tanggalMulai" id="tanggal" class="bg-gray-200 text-gray-600 text-sm py-3 px-4 w-full rounded-md w-2/3">
                    </div>
                </div>
            </div> 
        </div>

        <div class="row flex items-center justify-end mt-8">
            <button class="py-2 px-3 rounded-md bg-red-400 text-gray-50 hover:bg-red-500 transition ease-out duration-300">
                <a href="/" class="text-sm">Batalkan Pembelian</a>
            </button>
            <button class="py-2 px-3 rounded-md bg-green-400 text-gray-50 hover:bg-green-500 transition ease-out duration-300 ml-2" @click="lanjutkanPembayaran">
                <span class="text-sm">Lanjut Pembayaran</span>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PaymentPengiriman',

    data: function () {
        return {
            user,
            paket,

            hari: [],
            waktu: [],
            
            lokasi: 'rumah',
            alamat: null,
            defaultLokasi: '(Tuliskan alamat lengkap)',
            waktuPengiriman: null,
            tanggalMulai: null,
        }
    },

    mounted() {
        this.alamat = this.user.rumah_teks ? this.user.rumah_teks : this.defaultLokasi;
    },

    watch: {
        lokasi() {
            if (this.lokasi == 'rumah') {
                this.alamat = this.user.rumah_teks ? this.user.rumah_teks : this.defaultLokasi;
            } else {
                this.alamat = this.user.kantor_teks ? this.user.kantor_teks : this.defaultLokasi;
            }
        }
    },

    methods: {
        pilihWaktuPengiriman(e) {
            const pilihan = e.target.value;
            this.waktuPengiriman = pilihan;
        },

        lanjutkanPembayaran() {
            // validation
            if (this.alamat == this.defaultLokasi) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Mohon tuliskan alamat yang benar!',
                });
            }

            if (!this.waktuPengiriman) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Mohon pilih waktu pengiriman!',
                });
            }

            if (this.waktuPengiriman == 'default') {
                if (this.hari.length == 0) {
                    return Toast.fire({
                        icon: 'error',
                        title: 'Mohon pilih hari pengiriman!',
                    });
                }

                if (this.waktu.length == 0) {
                    return Toast.fire({
                        icon: 'error',
                        title: 'Mohon pilih waktu pengiriman!',
                    });
                }
            }

            if (!this.tanggalMulai) {
                return Toast.fire({
                    icon: 'error',
                    title: 'Mohon pilih tanggal mulai!',
                });
            }

            // ...validated
            // proses hari menjadi hari: a, b, ...n | waktu: a, b, ...n
            let hari = this.hari.join(', ');
            let waktu = this.waktu.join(',');
            let waktu_pengiriman = `hari: ${hari} | waktu: ${waktu}`;
            
            eventBus.$emit('lanjutkanPembayaran', {
                lokasi: this.lokasi,
                alamat: this.alamat,
                waktu_pengiriman: this.waktuPengiriman == 'default' ? waktu_pengiriman : this.waktuPengiriman,
                tanggal_mulai: this.tanggalMulai,
            });
        },
    }
}
</script>

<style>

</style>