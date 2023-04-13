<template>
  <div> 
    <button  @click="showFoodItemForm"> Cafe </button>
  </div>
  
  <section>
    <CreateFoodItemForm v-if="currentForm === 'foodItem'" />
  </section>

  <section>
    <div v-if="currentForm === 'foodItem'" v-for="item in foodItems">
      <ListItemLayout 
        :delete-path="`admin/food-items/${item.id}`"
        :item-id="item.id"
      >
        <p>{{ item.name }}</p>
        <p>{{ item.desc }}</p>
        <p>{{ item.status }}</p>
        <p>{{ item.price }}</p>

        <template v-slot:edit>
          <EditFoodItemsForm :item="item"/>
        </template>
      </ListItemLayout>
    </div>
  </section>
</template>

<script setup>
  import { ref } from 'vue';
  import CreateFoodItemForm from './components/CreateFoodItemForm.vue';
import ListItemLayout from './layout/ListItemLayout.vue';
import EditFoodItemsForm from './components/EditFoodItemsForm.vue';
  
  const currentForm = ref('foodItem');
  defineProps({
    foodItems: Array,
  })


  const showFoodItemForm = () => {
    currentForm.value = 'foodItem'
  }
</script>