<template>
  <div class="handle-reservation">
    <!-- reservation item section -->
    <artilce class="reservation-item">
      <div class="" />
      <div class="reservation-item__short-info" />
      <div class="reservation-item__btns">
        <Link :href="`/reservation/${reservation.id}`" method="DELETE" as="button"> delete </Link>
        <button @click="showForm = true"> edit </button>
      </div>
    </artilce>
    <!-- form section -->
    <form v-if="displayForm" class="reservation-form">
      <section class="reservation-form__info">
        <div class="reservation-form__customer-info" />
        <div class="reservation-form__booking-info" />
      </section>
      <div class="reservation-form__divider" />
      <section class="reservation-form__room-select">
        <div class="reservation-from__header" />
        <div class="reservation-form__room-select-list" />
        <div class="reservation-form__cta-btns" />
      </section>
    </form>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'

defineProps({
  reservation: Object,
})

const displayForm = ref(false)
</script>

<style scoped lang="scss">

</style>
