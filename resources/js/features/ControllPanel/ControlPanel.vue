<template>
  <MainWidthLayout>
    <h3 class="admin__header--divider"> skapa </h3>

    <div class="admin__form-tabs">
      <button
        :class="{ 'admin__form-tab': true, 'admin__form-tab--selected': currentForm === 'foodItems'}"
        @click="() => {
            currentForm = 'foodItems';
            resetPagination();
        }"
      >
        meny
      </button>
      <button
        :class="{ 'admin__form-tab': true, 'admin__form-tab--selected': currentForm === 'events'}"
        @click="() => {
            currentForm = 'events';
            resetPagination();
        }"
      >
        händelser
      </button>
      <button
        :class="{ 'admin__form-tab': true, 'admin__form-tab--selected': currentForm === 'rooms'}"
        @click="() => {
            currentForm = 'rooms';
            resetPagination();
        }"
      >
        vandrarhem
      </button>
    </div>

    <section>
      <CreateFoodItemForm v-if="currentForm === 'foodItems'" :food-categories="foodCategories" />
      <CreateEventForm v-else-if="currentForm === 'events'" />
      <CreateRoomForm v-else-if="currentForm === 'rooms'" />
    </section>

    <h3 class="admin__header--divider"> Skapade </h3>

    <section v-if="currentForm === 'foodItems'" class="admin__list-items">
      <div v-for="item in pagination(foodItems, startIndex, endIndex)">
        <ListItemLayout
          :delete-path="`admin/food-items/${item.id}`"
          :item-id="item.id"
          :img-src="item.image.src"
        >
          <p class="list-item__id">{{ item.id }}</p>
          <p class="list-item__title">{{ item.name }}</p>
          <p class="list-item__desc">{{ item.desc }}</p>
          <p class="list-item__status">{{ item.status ? 'slutsåld' : 'i lager' }}</p>
          <p class="list-item__price">{{ item.price }}</p>

          <template #edit>
            <CreateFoodItemForm :is-edit="true" :food-categories="foodCategories" :item="item" />
          </template>
        </ListItemLayout>
      </div>
    </section>

    <section v-if="currentForm === 'events'" class="admin__list-items">
      <div v-for="item in pagination(events, startIndex, endIndex)">
        <ListItemLayout
          :delete-path="`admin/events/${item.id}`"
          :item-id="item.id"
        >
          <p class="list-item__id">{{ item.id }}</p>
          <p class="list-item__title">{{ item.title }}</p>
          <p class="list-item__desc">{{ item.desc }}</p>
          <p class="list-item__date">{{ item.date }}</p>
          <p class="list-item__location">{{ item.location }}</p>
          <p class="list-item__time">{{ item.time }}</p>

          <template #edit>
            <CreateEventForm :item="item" :is-edit="true" />
          </template>
        </ListItemLayout>
      </div>
    </section>

    <section v-if="currentForm === 'rooms'" class="admin__list-items">
      <div v-for="item in pagination(rooms, startIndex, endIndex)">
        <ListItemLayout
          :delete-path="`admin/rooms/${item.id}`"
          :item-id="item.id"
        >
          <p class="list-item__id">{{ item.id }}</p>
          <p class="list-item__title">{{ item.title }}</p>
          <p class="list-item__desc">{{ item.desc }}</p>
          <p class="list-item__status">{{ item.status }}</p>

          <template #edit>
            <CreateRoomForm :item="item" :is-edit="true" />
          </template>
        </ListItemLayout>
      </div>
    </section>
    <div class="pagination" v-if="pages > 1">
        <span
            :class="{'pagination__dot': true, 'pagination__dot--selected': index === selectedPage }"
            v-for="(num, index) in pages"
            @click="() => {
                changePage(index);
                selectedPage = index;
            }"
        >
        </span>
    </div>
  </MainWidthLayout>

</template>

<script setup>
import {computed, ref, watchEffect} from 'vue'
import CreateFoodItemForm from './components/CreateFoodItemForm.vue'
import CreateEventForm from './components/CreateEventForm.vue'
import CreateRoomForm from './components/CreateRoomForm.vue'
import ListItemLayout from './layout/ListItemLayout.vue'
import MainWidthLayout from '../../layouts/MainWidthLayout.vue'

const props = defineProps({
  foodCategories: Array,
  foodItems: Array,
  events: Array,
  rooms: Array,
})

const currentForm = ref('foodItems');
const itemsPerPage = ref(5);
const startIndex = ref(0);
const endIndex = ref(5);
const selectedPage = ref(0);

const changePage = (index) => {
    if(index === 0 ) {
        startIndex.value = 0;
        endIndex.value = itemsPerPage.value;
        return;
    }

    startIndex.value = index * itemsPerPage.value;
    endIndex.value = startIndex.value + itemsPerPage.value;
}

const resetPagination = () => {
    startIndex.value = 0;
    endIndex.value = itemsPerPage.value;
    selectedPage.value = 0;
}

const pages = computed( () => {
    return Math.ceil(props[currentForm.value].length/itemsPerPage.value);
})

const pagination = (array, start, end) => {
    if(start < 0 || start > array.length || end < start) return;

    return array.slice(start, end);
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

    .pagination {
        margin: 2rem 0 2rem auto;
        width: 50%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 1rem;

        .pagination__dot {
            content: '';
            width: 2rem;
            height: 2rem;
            border: 1px solid black;
            border-radius: 50%;

            &:hover {
                cursor: pointer;
            }
        }

        .pagination__dot--selected {
            background: #c64533;
            border: 1px solid #c64533
        }
    }
</style>
