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
                    <label for=""> order status</label>
                    <input class="" type="checkbox" placeholder="title" v-model="form.status"/>
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
