<template>
    <div class="">
        <!-- Navbar sent here -->
        <slot name="navbar"></slot>

        <!-- Main Content goes here -->
        <main>
            <div class="container mx-auto py-3 px-4 text-gray-800">
                <div class="row my-10">
                    <h1 class="text-xl font-semibold uppercase">Dashboard</h1>
                </div>

                <div class="row my-10 grid md:grid-cols-2 gap-10">
                    <profile-user
                        :user="user"
                        :kota="kota"
                        :kecamatan="kecamatan"
                        :kelurahan="kelurahan"
                    ></profile-user>

                    <profile-info
                        :user="user"
                    >

                    </profile-info>
                </div>

                <div class="row my-10">
                    <h2 class="text-xl font-semibold uppercase">Tabel Pengantaran</h2>
                </div>

                <div class="row my-10">
                    <profile-table></profile-table>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
import ProfileUser from './ProfileUser';
import ProfileInfo from './ProfileInfo';
import ProfileTable from './ProfileTable';

export default {
    name: 'Profile',

    components: {
        ProfileUser,
        ProfileInfo,
        ProfileTable
    },

    data() {
        return {
            user,
            kota,
            kecamatan,
            kelurahan,
        }
    },
}
</script>