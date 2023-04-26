<template>
  <section id="book-room">
    <BookRoomForm v-if="showBookForm" @close-book-form="closeBookForm" />
    <UpperDivider />
    <BookCta @book-room-action="openBookForm" />
    <DisplayRooms :rooms="rooms" />
    <BottomDivider />
  </section>
</template>

<script setup>
import BookCta from './components/BookCta.vue'
import BottomDivider from './components/BottomDivider.vue'
import UpperDivider from './components/UpperDivider.vue'
import DisplayRooms from './components/RoomCards/DisplayRooms.vue'
import BookRoomForm from './components/BookRoomForm.vue'
import {ref } from 'vue'

defineProps({
  rooms: Array,
})

const showBookForm = ref(false)

const openBookForm = () => {
  showBookForm.value = true
}
const closeBookForm = () => {
  showBookForm.value = false
}
</script>

<style scoped lang="scss">
    section#book-room {
        background-color: #d9d9d9;
        width: 100%;
        min-height: 100vh;
    }

</style>
