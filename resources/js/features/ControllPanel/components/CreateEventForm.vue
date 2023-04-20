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
          <input v-model="form.location" class="input" placeholder="plats" />
          <div> {{ form.errors.location }} </div>
        </div>

        <div>
          <input v-model="form.time" class="input" type="time" placeholder="tid" />
          <div> {{ form.errors.time }} </div>
        </div>

        <div>
          <input v-model="form.date" class="input" type="date" placeholder="datum" />
          <div> {{ form.errors.date }} </div>
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
  location: props.isEdit ? props.item.location : '',
  date: props.isEdit ? props.item.date : '',
  time: props.isEdit ? props.item.time : '',
})

const submit = () => {
  props.isEdit
    ? form.put(`/admin/events/${props.item.id}`)
    : form.post('/admin/events')
}

</script>

