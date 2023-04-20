<template>
    <HeaderNav />
    <main>
        <MainWidthLayout>
            <h2 class="event__header"> Kommande händelser </h2>

            <section class="timeline">
                <TimelineEventCard v-for="item in events" :item="item" />
            </section>
        </MainWidthLayout>
    </main>
</template>
<script setup>
import HeaderNav from "../../features/HeaderNav/HeaderNav.vue";
import MainWidthLayout from "../../layouts/MainWidthLayout.vue";
import TimelineEventCard from "../../components/TimelineEventCard.vue";

defineProps({
    events: Array,
});
</script>
