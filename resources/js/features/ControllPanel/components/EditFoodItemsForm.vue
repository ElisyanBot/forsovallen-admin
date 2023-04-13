<template>
    <form class="admin__form admin__form--edit" @submit.prevent="edit">
        <div class="admin__form-inputs">
            <div class="form__first-col">
                <div>
                    <input class="input" placeholder="name" v-model="form.name"/>
                </div>
                <div>
                    <textarea class="input input--textarea" placeholder="beskrivning" v-model="form.desc"></textarea>
                </div>
            </div>
            <div class="form__second-col">
                <div>
                    <input class="input" placeholder="price" v-model="form.price"/>
                </div>
                <div>
                    <select class="input" v-model="form.by_category_id">
                        <option v-for="category in foodCategories" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <div>
                    <label for=""> order status</label>
                    <input class="" type="checkbox" placeholder="title"  v-model="form.status"/>
                </div>
            </div>
        </div>
        <div class="admin__form__btn-container">
            <button class="form--cta" type="submit"> updatera </button>
        </div>
    </form>
</template>

<script setup>
  import { useForm } from '@inertiajs/vue3';

  const { item } = defineProps({
      item: Object,
      foodCategories: Array,
  })

  const form = useForm({
    name: item.name,
    desc: item.desc,
    status: item.status ? true : false,
    price: item.price,
    by_category_id: item.by_category_id,
  });

  const edit = () => {
    form.put(`/admin/food-items/${item.id}`);
  };

</script>
