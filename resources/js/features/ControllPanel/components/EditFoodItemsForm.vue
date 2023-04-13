<template>
    <form @submit.prevent="edit"> 
      <div class="control-panel_form__inputs">
          <div>
            <input placeholder="name" v-model="form.name"/> 
          </div>
          <div>
            <input placeholder="beskrivning" v-model="form.desc"/> 
          </div>
          <div>
            <label for=""> order status</label>
            <input type="checkbox" placeholder="title" v-model="form.status"/> 
          </div>
          <div>
            <input placeholder="price" v-model="form.price"/> 
          </div>
      </div>
      <button type="submit"> updatera </button>
    </form>
</template>

<script setup>
  import { useForm } from '@inertiajs/vue3';
  
  const { item } = defineProps({
    item: Object,
  })

  const form = useForm({
    name: item.name,
    desc: item.desc,
    status: item.status,
    price: item.price,
  });
  
  const edit = () => {
    form.put(`/admin/food-items/${item.id}`);
  };
  
</script>