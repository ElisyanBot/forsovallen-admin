<template>
  <header>
    header
  </header>
  <main>
    <ControlPanel :foodCategories="foodCategories" :food-items="foodItems" :events="events" :rooms="rooms"/>
  </main>
  <footer>

  </footer>
</template>

<script setup>
  import ControlPanel from '../../features/ControllPanel/ControlPanel.vue';
  defineProps({
      foodCategories: Array,
      foodItems: Array,
      rooms: Array,
      events: Array,
  })
</script>

<style scoped lang="scss">

</style>
