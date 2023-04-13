<template>
    <MainWidthLayout>
          <h3 class="admin__header--divider"> skapa </h3>

          <div class="admin__form-tabs">
            <button
                :class="{ 'admin__form-tab': true, 'admin__form-tab--selected': currentForm === 'foodItem'}"
                @click="showFoodItemForm"
            >
                meny
            </button>
              <button
                  :class="{ 'admin__form-tab': true, 'admin__form-tab--selected': currentForm === 'eventItem'}"
                  @click="showFoodItemForm"
              >
                  händelser
              </button>
              <button
                  :class="{ 'admin__form-tab': true, 'admin__form-tab--selected': currentForm === 'roomItem'}"
                  @click="showFoodItemForm"
              >
                  vandrarhem
              </button>
          </div>

          <section>
            <CreateFoodItemForm v-if="currentForm === 'foodItem'" />
          </section>

          <h3 class="admin__header--divider"> Skapade </h3>

          <section class="admin__list-items">
            <section v-if="currentForm === 'foodItem'" v-for="item in foodItems">
              <ListItemLayout
                :delete-path="`admin/food-items/${item.id}`"
                :item-id="item.id"
              >
                  <p>{{ item.id }}</p>
                  <p>{{ item.name }}</p>
                  <p>{{ item.desc }}</p>
                  <p>{{ item.status }}</p>
                  <p>{{ item.price }}</p>

                <template v-slot:edit>
                  <EditFoodItemsForm v-if="currentForm === 'foodItem'" :item="item"/>
                </template>
              </ListItemLayout>
            </section>
          </section>
    </MainWidthLayout>
</template>

<script setup>
  import { ref } from 'vue';
  import CreateFoodItemForm from './components/CreateFoodItemForm.vue';
import ListItemLayout from './layout/ListItemLayout.vue';
import EditFoodItemsForm from './components/EditFoodItemsForm.vue';
  import MainWidthLayout from "../../layouts/MainWidthLayout.vue";

  const currentForm = ref('foodItem');
  defineProps({
    foodItems: Array,
  })


  const showFoodItemForm = () => {
    currentForm.value = 'foodItem'
  }
</script>

<style scoped lang="scss">
    .admin__list-items {
        display: flex;
        flex-direction: column;
        gap: 2rem;
        width: 100%;
    }

    .admin__header--divider {
        margin: 6.5rem 0 3.5rem 0;
        color: #c64533;
        text-transform: uppercase;
        font-size: 3.2rem;
        font-weight: bold;
    }
    .admin__form-tabs {
        display: flex;
        gap: 1rem;

        .admin__form-tab {
            background: #c64533;
            color: #ffffff;
            padding: 2rem;
            min-width: 15rem;
            border: 0;
            text-transform: uppercase;
            font-size: 1.8rem;
            font-weight: bold;
            cursor: pointer;
        }

        .admin__form-tab--selected {
            position: relative;
            z-index: 2;
            background: #ffffff;
            color: black;
        }
    }
</style>
