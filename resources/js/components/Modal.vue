<template>
    <div class="fixed z-10 inset-0 overflow-y-auto" v-if="data.state">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog"
                aria-modal="true"
                aria-labelledby="modal-headline"
            >
                <div v-if="data.form == 'profile'">
                    <profile-form @closeModal="closeModal" :pelanggan="pelanggan"></profile-form>
                </div>
                <div v-else>
                    <request-form @closeModal="closeModal" :pelanggan="pelanggan"></request-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileForm from './ProfileForm'
import RequestForm from './RequestForm'

export default {
    name: "Modal",

    props: ["data", "pelanggan"],

    components: {
        ProfileForm,
        RequestForm,
    },

    methods: {
        closeModal() {
            this.$emit("closeModal");
        }
    }
};
</script>

<style></style>
