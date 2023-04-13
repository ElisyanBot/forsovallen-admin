<template>
  <header>
    header
  </header>
  <main>
    <ControlPanel :food-items="foodItems" :events="events" :rooms="rooms"/>
  </main>
  <footer>

  </footer>
</template>

<script setup>
  import ControlPanel from '../../features/ControllPanel/ControlPanel.vue';
  defineProps({
    foodItems: Array,
    rooms: Array,
    events: Array,
  })  
</script>

<style scoped lang="scss">

</style>