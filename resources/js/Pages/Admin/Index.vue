<template>
  <header>
    <div v-if="usePage().props.flash.success">
      {{ usePage().props.flash.success }}
    </div>
  </header>
  <main class="admin-main">
    <MainWidthLayout>
      <div v-if="user" class="admin__header">
        <h2> admin | {{ user.name }} </h2>
        <Link href="/admin/logout" method="DELETE" as="button"> logga ut </Link>
      </div>
      
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident hic vero sint ducimus recusandae tempore commodi id nobis aliquid. 
      Deserunt provident commodi cupiditate architecto ratione libero quos numquam aliquam repudiandae.
    </MainWidthLayout>
    <ControlPanel :food-categories="foodCategories" :food-items="foodItems" :events="events" :rooms="rooms" />
  </main>
  <footer />
</template>

<script setup>
import ControlPanel from '../../features/ControllPanel/ControlPanel.vue'
import { usePage, Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import MainWidthLayout from '../../layouts/MainWidthLayout.vue'

defineProps({
  foodCategories: Array,
  foodItems: Array,
  rooms: Array,
  events: Array,
})

const user = computed(() => usePage().props.user )

</script>

<style scoped lang="scss">
  .admin-main {
    min-height: 100vh;
  }

  .admin__header {
        margin: 6.5rem 0 3.5rem 0;
        color: #c64533;
        text-transform: uppercase;
        font-size: 2.4rem;
        font-weight: bold;

        display: flex;
        justify-content: space-between;

        button {
          background: none;
          border:none;
          font-size: inherit;
          text-transform: inherit;

          &:hover {
            cursor: pointer;
          }
        }
  }
</style>
