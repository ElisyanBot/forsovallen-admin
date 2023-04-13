<template>
  <div>
    <slot />
  </div> 
  <div>
    <button @click="showForm = true"> edit </button>
    <Link :href="deletePath" method="DELETE" as="button"> delete </Link>
  </div>
  <div v-if="showForm">
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
