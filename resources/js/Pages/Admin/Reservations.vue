<template>
  <main class="admin-main">
    <MainWidthLayout>
      <div v-if="user" class="admin__header">
        <h2> admin | {{ user.name }} </h2>
        <Link href="/admin/logout" method="DELETE" as="button"> logga ut </Link>
      </div>

      Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident hic vero sint ducimus recusandae tempore commodi id nobis aliquid.
      Deserunt provident commodi cupiditate architecto ratione libero quos numquam aliquam repudiandae.

      <Reservations :reservations="reservations" />
    </MainWidthLayout>
  </main>
  <FooterImgBanner />
  <footer />
</template>

<script setup>

import {Link, usePage} from '@inertiajs/vue3'
import MainWidthLayout from '../../layouts/MainWidthLayout.vue'
import Reservations from '../../features/Reservations/Reservations.vue'
import {computed} from 'vue'
import FooterImgBanner from '../../components/FooterImgBanner.vue'


const props = defineProps({
  reservations: Array,
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
