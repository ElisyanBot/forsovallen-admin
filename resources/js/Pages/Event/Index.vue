<template>
  <HeaderNav />
  <main>
    <h2 class="event__header"> Kommande händelser </h2>
    <section class="timeline">
      <TimelineEventCard
        v-for="( item, index ) in events"
        :key="index"
        :item="item"
        :reverse-card="index % 2 === 0 ? false : true"
      />
    </section>
  </main>
</template>
<script setup>
import HeaderNav from '../../features/HeaderNav/HeaderNav.vue'
import MainWidthLayout from '../../layouts/MainWidthLayout.vue'
import TimelineEventCard from '../../components/TimelineEventCard.vue'

defineProps({
  events: Array,
})
</script>

<style scoped lang="scss">
    main {
        min-height: 100vh;
        margin: auto;
        display: flex;
        flex-direction: column;

        width: 100%;
        max-width: 163rem;
    }
    .event__header {
        font-size: 4.2rem;
        text-transform: uppercase;
        color : #c64533;
        font-weight: 700;
        margin: 8rem auto;
        padding: 0;
    }
</style>
