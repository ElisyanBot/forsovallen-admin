<template>
  <form :class="{'admin__form':true, 'admin__form--edit': isEdit}" @submit.prevent="submit">
    <div class="admin__form-inputs">
      <div class="form__first-col">
        <div>
          <input v-model="form.title" class="input" placeholder="rubrik" />
          <div> {{ form.errors.title }} </div>
        </div>
        <div>
          <textarea v-model="form.desc" class="input input--textarea" placeholder="beskrivning" />
          <div> {{ form.errors.desc }} </div>
        </div>
      </div>
      <div class="form__second-col">
        <div>
          <label for=""> finns inte i lager</label>
          <input v-model="form.status" class="" type="checkbox" placeholder="title" />
        </div>
      </div>
    </div>
    <div class="admin__form__btn-container">
      <button class="form--cta" type="submit"> {{ isEdit ? 'ändra' : 'skapa' }} </button>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  item: Array,
  isEdit: {
    type: Boolean,
    default: false,
  },
})

const form = useForm({
  title: props.isEdit ? props.item.title : '',
  desc: props.isEdit ? props.item.desc : '',
  status: props.isEdit ? props.item.status : '',
})

const submit = () => {
  props.isEdit
    ? form.put(`/admin/rooms/${props.item.id}`)
    : form.post('/admin/rooms')
}

</script>

