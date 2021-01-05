<template>
    <div
        class="group cursor-pointer flex-1 text-center pb-4 border-b hover:border-red-500 transition duration-300 ease-out"
        :class="{ active: active === target }"
        @click="filterFood(target)"
    >
        <h4
            class="text-xl font-semibold group-hover:text-red-500 transition duration-300 ease-out"
        >
            {{ title }}
        </h4>
        <p class="text-sm font-light opacity-80">
            {{ description }}
        </p>
    </div>
</template>

<script>
export default {
    name: 'DailyCateringFilter',

    props: [
        'active', 'title', 'description', 'target',
    ],

    methods: {
        filterFood(target) {
            this.$emit('filterFood', target);
        }
    }
};
</script>

<style></style>
