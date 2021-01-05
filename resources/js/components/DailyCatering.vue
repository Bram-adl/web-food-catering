<template>
    <div class="container mx-auto px-10 xl:px-0">
        <div class="flex flex-col md:flex-row items-center justify-center filter-box">
            <daily-catering-filter
                :active="active"
                title="Bento Box"
                description="Kemasan Sekali Pakai - Lebih Higienis"
                target="bento"
                @filterFood="filterFoods"
            ></daily-catering-filter>
            <daily-catering-filter
                class="my-4 md:my-0"
                :active="active"
                title="Reusable Box"
                description="Lebih Ramah Lingkungan - Tanpa Sampah Kemasan"
                target="reusable"
                @filterFood="filterFoods"
            ></daily-catering-filter>
            <daily-catering-filter
                :active="active"
                title="Family Pack"
                description="2-4 Porsi Sekali Pengiriman - Cocok Untuk Keluarga"
                target="family"
                @filterFood="filterFoods"
            ></daily-catering-filter>
        </div>
        <!-- /.filter-box -->

        <div class="">
        <transition-group enter-active-class="animate__animated animate__fadeInUp" leave-active-class="animate__animated animate__fadeOut animate__faster" class="grid grid-cols-1 md:grid-cols-2 gap-12 mt-20">
                <daily-catering-food
                    v-for="food in filteredFoods"
                    :key="food.id"
                    :food="food"
                ></daily-catering-food>
        </transition-group>
        </div>
    </div>
</template>

<script>
import DailyCateringFilter from "./DailyCateringFilter";
import DailyCateringFood from "./DailyCateringFood";

export default {
    name: "DailyCatering",

    components: {
        DailyCateringFilter,
        DailyCateringFood
    },

    data() {
        return {
            active: "bento",
            foods: foods
        };
    },

    computed: {
        filteredFoods() {
            let id =
                this.active == "bento"
                    ? 1
                    : this.active == "reusable"
                    ? 2
                    : this.active == "family"
                    ? 3
                    : undefined;

            return this.foods.filter(food => food.id_kategori === id);
        }
    },

    methods: {
        filterFoods(target) {
            this.active = target;
        }
    }
};
</script>

<style></style>
