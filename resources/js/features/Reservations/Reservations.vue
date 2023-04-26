<template >
    <main>
        <MainWidthLayout>
            <div class="reservation__header">
                <h2> Reserveringar </h2>
                <Filter />
            </div>
           <HandleReservationItem v-for="res in reservations" :key="res.id" :reservation="res" />
        </MainWidthLayout>
    </main>
</template>

<script setup>
    import MainWidthLayout from "../../layouts/MainWidthLayout.vue";
    import HandleReservationItem from "./components/HandleReservationItem.vue";
    import Filter from "./components/Filter.vue";

    defineProps({
        reservations: Array,
    })
</script>

<style scoped lang="scss">
    .reservation__header {
        margin: 10rem 0 5rem 0;
        display: flex;
        width: 100%;
        justify-content: space-between;

        h2 {
            font-size: 3.2rem;
            color: #c64533;
            text-transform: uppercase;
        }
    }
</style>
