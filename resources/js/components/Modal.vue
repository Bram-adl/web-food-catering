<template>
    <div class="modal opacity-100 pointer-events-all fixed w-full h-full top-0 left-0 flex items-center justify-center" style="z-index: 100">
        <div class="modal-overlay absolute left-0 top-0 w-full h-full bg-gray-900 opacity-50" style="z-index: 100"></div>
        
        <div class="modal-container bg-white w-11/12 md:max-w-2xl h-3/4 mx-auto rounded shadow-lg overflow-y-auto absolute" style="z-index: 100;">
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">{{ title }}</p>
                    <div class="modal-close cursor-pointer z-50" @click="closeModal">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <slot></slot>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="px-4 bg-transparent py-3 rounded-lg text-green-500 hover:bg-gray-100 hover:text-green-400 mr-2" @click="closeModal">Tutup</button>
                    <button class="modal-close px-4 bg-green-500 py-3 rounded-lg text-gray-50 hover:bg-green-400" @click="submitAction">{{ action }}</button>
                </div>
            
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Modal',

    props: {
        title: {
            type: String,
            required: true,
        },

        action: {
            type: String,
            required: true,
        },

        method: {
            type: String,
            required: true,
        }
    },

    methods: {
        closeModal() {
            this.$emit('closeModal')
        },

        submitAction() {
            if (this.method == 'updateProfile') {
                this.$emit('updateProfile')
            }
        }
    }
}
</script>

<style>

</style>