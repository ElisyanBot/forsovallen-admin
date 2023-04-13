<template>
    <div class="admin__list-item__body">
        <div class="list-item__img">

        </div>
      <div class="list-items">
          <slot />
      </div>
      <div class="admin__list-item__btn-container">
          <button @click="showForm = true"> edit </button>
          <Link :href="deletePath" method="DELETE" as="button"> delete </Link>
      </div>
    </div>
    <div class="admin__list-item__edit-form admin__form" v-if="showForm">
        <slot name="edit" />
        <button @click="showForm = false"> close </button>
    </div>
</template>

<script setup>
  import { Link } from '@inertiajs/vue3';
  import { ref } from 'vue';

  defineProps({
    itemId: Number,
    deletePath: String,
  })

  const showForm = ref(false);
</script>

<style lang="scss">
    .admin__list-item__body {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
        width: 100%;
        max-width: 130rem;
        height: 8.6rem;
        padding: 0rem 1rem;
        filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));

        .list-items {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: row;
            gap: 5rem;
        }
       .admin__list-item__btn-container {
           display: flex;
           flex-direction: column;
           width: 5rem;
           height: 5rem;
       }
    }

    .admin__list-item__edit-form {
        height: 30rem;
    }
</style>
