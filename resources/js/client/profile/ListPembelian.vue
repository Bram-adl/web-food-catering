<template>
    <div class="min-h-screen">
        <!-- Navbar sent here -->
        <slot name="navbar"></slot>

        <!-- Main Content goes here -->
        <main>
            <div class="container mx-auto my-16 p-10 bg-white shadow-md">
                <table class="border-collapse w-full relative" style="z-index: 0" id="table">
                    <thead>
                        <tr>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">#</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">ID Pembelian</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Paket Pembelian</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Porsi Pembelian</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Tanggal Mulai</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Status Pembelian</th>
                            <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr 
                            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0"
                            v-for="(p, index) in pembelian"
                            :key="p.id"
                        >
                            <td class="w-full lg:w-auto py-8 px-4 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">#</span>
                                {{ index + 1}}
                            </td>
                            <td class="w-full lg:w-auto py-8 px-4 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">ID Pembelian</span>
                                <template v-if="p.status == 'Belum bayar'">
                                    <a 
                                        :href="`/paket/${paket[index].id}/pembayaran?client_id=${user.id}&payment_id=${p.id}`" 
                                        target="_blank" 
                                        class="text-blue-600 hover:text-blue-700 transition ease-out duration-300">
                                        {{ invoice(index) }}
                                    </a>
                                </template>
                                <template v-else>
                                    <span>{{ invoice(index) }}</span>
                                </template>
                            </td>
                            <td class="w-full lg:w-auto py-8 px-4 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Paket Pembelian</span>
                                {{ paket[index].paket }}
                            </td>
                            <td class="w-full lg:w-auto py-8 px-4 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Porsi Pembelian</span>
                                {{ p.porsi }} / {{ paket[index].porsi }} Porsi
                            </td>
                            <td class="w-full lg:w-auto py-8 px-4 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Tanggal Mulai</span>
                                {{ p.tanggal_mulai | filterDate }}
                            </td>
                            <td class="w-full lg:w-auto py-8 px-4 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Status Pembelian</span>
                                <span 
                                    class="py-2 px-3 rounded-md text-gray-50"
                                    :class="{ 
                                        'bg-green-400': p.status == 'Aktif',
                                        'bg-red-400': p.status == 'Belum bayar',
                                        'bg-yellow-400': p.status == 'Proses verifikasi',
                                        'bg-blue-400': p.status == 'Selesai',
                                        'bg-gray-400': p.status == 'Batal'
                                     }"
                                >
                                    {{ p.status }}
                                </span>
                            </td>
                            <td class="w-full lg:w-auto py-8 px-4 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                <a href="#" class="text-blue-400 hover:text-blue-600 underline" v-if="p.status == 'Batal' || p.status == 'Selesai'" @click="hapusPembelian(p.id)">Hapus</a>
                                <a href="#" class="text-blue-400 hover:text-blue-600 underline" v-else-if="p.status == 'Aktif'" @click="berhentiPembelian(p.id)">Berhenti</a>
                                <a href="#" class="text-blue-400 hover:text-blue-600 underline" v-else @click="batalkanPembelian(p.id)">Batalkan</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>

        <Loader :start="loader"/>
    </div>
</template>

<script>
import Loader from '../../components/Loader';

export default {
    name: 'ProfilePembelian',

    components: {
        Loader,
    },

    data() {
        return {
            user,
            pembelian,
            paket,
            loader: false,
        }
    },

    filters: {
        filterDate(date) {
            return moment(date).format('D MMM YYYY');
        }
    },

    methods: {
        invoice(index) {
            let zerofill = 5;
            let polyfill = String(this.pembelian[index].id).length;
            let zeros = zerofill - polyfill;
            
            let invoice = '';
            for (let i = 0; i < zeros; i++) {
                invoice += '0';
            }

            return `SK${invoice}${this.pembelian[index].id}`;
        },

        hapusPembelian(id) {
            Swal.fire({
                title: 'Hapus data pembelian?',
                text: "Kamu masih dapat melakukan pembelian kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Tutup',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loader = true;
                    axios.delete('/pembelian/' + id + '/hapus')
                        .then(({ data }) => {
                            this.loader = false;
                            if (data.success) {
                                Swal.fire(
                                    'Berhasil!',
                                    data.message,
                                    'success'
                                )
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            }
                        })
                        .catch(({ response }) => {
                            this.loader = false;
                            Swal.fire(
                                'Error!',
                                response.data.message,
                                'error'
                            );
                        })
                }
            })
        },

        berhentiPembelian(id) {
            Swal.fire({
                title: 'Berhentikan pembelian?',
                text: "Kamu masih dapat melakukan pembelian kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Berhenti!',
                cancelButtonText: 'Tutup',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loader = true;
                    axios.put('/pembelian/' + id + '/berhenti')
                        .then(({ data }) => {
                            this.loader = false;
                            if (data.success) {
                                Swal.fire(
                                    'Berhasil!',
                                    data.message,
                                    'success'
                                )
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            }
                        })
                        .catch(({ response }) => {
                            this.loader = false;
                            Swal.fire(
                                'Error!',
                                response.data.message,
                                'error'
                            );
                        })
                }
            })
        },

        batalkanPembelian(id) {
            Swal.fire({
                title: 'Batalkan pembelian?',
                text: "Kamu masih dapat melakukan pembelian kembali",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Batalkan!',
                cancelButtonText: 'Tutup',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.loader = true;
                    axios.put('/pembelian/' + id + '/batalkan')
                        .then(({ data }) => {
                            this.loader = false;
                            if (data.success) {
                                Swal.fire(
                                    'Berhasil!',
                                    data.message,
                                    'success'
                                )
                                setTimeout(() => {
                                    location.reload();
                                }, 1000)
                            }
                        })
                        .catch(({ response }) => {
                            this.loader = false;
                            Swal.fire(
                                'Error!',
                                response.data.message,
                                'error'
                            );
                        })
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
</style>