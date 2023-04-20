<template>
  <form :class="{'admin__form': !isEdit, 'admin__form--edit': isEdit }" @submit.prevent="create">
    <div class="admin__form-inputs">
      <div class="form__first-col">
        <div>
          <input v-model="form.name" class="input" placeholder="rubrik" />
          <div> {{ form.errors.name }} </div>
        </div>
        <div>
          <textarea v-model="form.desc" class="input input--textarea" placeholder="beskrivning" />
          <div> {{ form.errors.desc }} </div>
        </div>
      </div>
      <div class="form__second-col">
        <div>
          <input v-model="form.price" class="input" placeholder="pris" />
          <div> {{ form.errors.price }} </div>
        </div>

        <div>
          <select v-model="form.by_category_id" class="input">
            <option value="" disabled selected> kategori </option>
            <option v-for="category in foodCategories" :value="category.id">{{ category.name }}</option>
          </select>
        </div>
        <div>
          <input type="file" name="image" @input="handleFile" />
        </div>

        <div>
          <label for=""> finns inte i lager</label>
          <input v-model="form.status" class="" type="checkbox" placeholder="title" />
        </div>
      </div>
    </div>
    <div class="admin__form__btn-container">
      <button v-if="isEdit" @click.prevent="$emit('closeEdit')"> stäng </button>
      <button class="form--cta" type="submit"> {{ isEdit ? 'ändra' : 'skapa' }}</button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  foodCategories: Array,
  item: Object,
  isEdit: {
    type: Boolean,
    default: false,
  },
})

defineEmits([ 'closeEdit' ])

const form = useForm({
  name: props.isEdit ? props.item.name : '',
  desc: props.isEdit ? props.item.desc : '',
  status: props.isEdit ? (props.item.status ? true : false) : '0',
  price: props.isEdit ? props.item.price : '',
  by_category_id: props.isEdit ? props.item.by_category_id : '',
  image: null,
})

const create = () => {
  props.isEdit
    ? form.put(`/admin/food-items/${props.item.id}`)
    : form.post('/admin/food-items')
}

const handleFile = (e) => {
  form.image = e.target.files[0]
}

</script>

<style lang="scss">
    .admin__form {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        padding: 6rem 0 3rem 0;
        width: 100%;
        height: 40rem;
        max-width: 130rem;
        filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));
    }

    .admin__form--edit {
        filter: none;
        padding: 0rem;
        height: fit-content;
    }

    .admin__form-inputs {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        width: 100%;
        gap: 2rem;

        .form__first-col {
            display: flex;
            align-self: flex-start;
            flex-direction: column;
            gap: 2rem;
            width: 55%;
            height: inherit;
        }

        .form__second-col {
            display: flex;
            align-self: flex-start;
            flex-direction: column;
            gap: 2rem;
            width: 25%;
            height: inherit;
        }

        .input {
            display: flex;
            align-items: center;
            border: 1px solid #000;
            padding: 1rem;
            height: 5rem;
            border-radius: 0.5rem;
            width: 100%;
        }

        .input--textarea {
            height: 12rem;
        }
    }

    .admin__form__btn-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 80%;
        height: 5rem;
        margin: 3rem auto;
    }

    .form--cta {
        background-color: #7d9a89;
        width: 15rem;
        height: 4rem;
        color: #ffffff;
        font-size: 1.8rem;
        font-weight: bold;
        text-transform: uppercase;
        padding: 1rem 0;
        border: none;
        cursor: pointer;
        justify-self: flex-end;
    }
</style>
