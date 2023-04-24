<template>
  <section id="book-room">
    <UpperDivider />
    <BookCta />
    <DisplayRooms :rooms="rooms" />
    <BottomDivider />
  </section>
</template>

<script setup>
import BookCta from './components/BookCta.vue'
import BottomDivider from './components/BottomDivider.vue'
import UpperDivider from './components/UpperDivider.vue'
import DisplayRooms from './components/RoomCards/DisplayRooms.vue'

defineProps({
  rooms: Array,
})
</script>

<style scoped lang="scss">
    section#book-room {
        background-color: #d9d9d9;
        width: 100%;
        min-height: 100vh;
    }

</style>
