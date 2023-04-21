<template>
  <div class="admin__list-item__body">
    <picture class="list-item__img">
      <img v-if="imgSrc" :src="imgSrc" alt="item image" />
    </picture>
    <div class="list-items">
      <slot />
    </div>
    <div class="admin__list-item__btn-container">
      <button @click="showForm = true"> edit </button>
      <Link :href="deletePath" method="DELETE" as="button"> delete </Link>
    </div>
  </div>
  <div v-if="showForm" class="admin__list-item__edit-form admin__form">
    <slot name="edit" />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'

defineProps({
  itemId: Number,
  deletePath: String,
  imgSrc: String,
})

const showForm = ref(false)
</script>

<style lang="scss">
    .admin__list-item__body {
        overflow: hidden;
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
        width: 100%;
        max-width: 130rem;
        height: 10rem;
        padding: 0rem 1rem 0 0;
        filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));

        .list-items {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 3rem;
            width: 110rem;
        }
       .admin__list-item__btn-container {
           display: flex;
           flex-direction: column;
           width: 5rem;
           height: 5rem;
       }

        .list-item__img {
            width: 10rem;
            height: inherit;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }
        }

        .list-item__id {
            width: 100%;
            max-width: 10rem;
            text-overflow: ellipsis;
        }

        .list-item__title,
        .list-item__location,
        .list-item__date,
        .list-item__status {
            width: 100%;
            max-width: 15rem;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: -webkit-box !important;
            overflow: hidden;
        }

        .list-item__desc {
            overflow: hidden;
            width: 100%;
            max-width: 40rem;
            text-overflow:ellipsis;
            // Addition lines for 2 line or multiline ellipsis
            display: -webkit-box !important;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            white-space: normal;

            margin: auto 0;
            display: flex;
            align-items: center;
        }
    }

    .admin__list-item__edit-form {
        height: fit-content;
    }

    .close-btn {
        background: none;
        width: 15rem;
        height: 4rem;
        border: 1px solid #c64533;
        border-radius: 0.5rem;
        color: #c64533;
        font-size: 1.8rem;
        font-weight: bold;
    }
</style>
