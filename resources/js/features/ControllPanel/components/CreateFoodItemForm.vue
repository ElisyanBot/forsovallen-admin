<template>
    <form @submit.prevent="create"> 
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
      <button type="submit"> skapa </button>
    </form>
</template>

<script setup>
  import { useForm } from '@inertiajs/vue3';
  
  const form = useForm({
    name: '',
    desc:'',
    status:'',
    price:'',
  });
  
  const create = () => {
    form.post('/admin/food-items');
  };
</script>=""