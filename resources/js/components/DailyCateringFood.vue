<template>
    <div class="flex">
        <div class="overflow-hidden w-36 h-36 rounded-lg">
            <img
                :src="'/images/foods/' + food.foto"
                class="w-full h-full object-cover"
                alt="Bento 1 - Nasi Putih 6x Makan"
            />
        </div>
        <div class="ml-10 flex flex-col w-full flex-1">
            <h4 class="text-2xl font-semibold">{{ food.paket }}</h4>
            <p class="flex-1">
                <span class="text-xl text-yellow-500"
                    >Rp. {{ food.harga | toRupiah }}</span
                >
            </p>
            <div>
                <a
                    :href="`/paket/${food.id}`"
                    class="purchase-button transition ease-out duration-300"
                >
                    <button class="focus:outline-none">
                        Beli Paket
                    </button>
                </a>
            </div>
        </div>
    </div>
    <!-- /.single-card -->
</template>

<script>
export default {
    name: "DailyCateringFood",

    props: ["food"],

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
    }
};
</script>

<style></style>
