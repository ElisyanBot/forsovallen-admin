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
          <input v-model.number="form.beds" class="input" type="number" placeholder="antalet sängar" />
        </div>
        <div>
          <input type="file" name="image" @input="handleFile" />
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
  beds: props.isEdit ? props.item.beds : '',
  image: props.isEdit ? props.item.image : null,
})

const submit = () => {
  props.isEdit
    ? form.put(`/admin/rooms/${props.item.id}`)
    : form.post('/admin/rooms')
}

const handleFile = (e) => {
  form.image = e.target.files[0]
}

</script>

