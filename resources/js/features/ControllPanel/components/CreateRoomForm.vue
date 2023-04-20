<template>
    <form :class="{'admin__form':true, 'admin__form--edit': isEdit}" @submit.prevent="submit">
      <div class="admin__form-inputs">
          <div class="form__first-col">
              <div>
                <input class="input" placeholder="rubrik" v-model="form.title"/>
                <div> {{ form.errors.title }} </div>
              </div>
              <div>
                  <textarea class="input input--textarea" placeholder="beskrivning" v-model="form.desc"></textarea>
                <div> {{ form.errors.desc }} </div>
              </div>
          </div>
          <div class="form__second-col">
              <div>
                <label for=""> finns inte i lager</label>
                <input class="" type="checkbox" placeholder="title" v-model="form.status"/>
              </div>
          </div>
      </div>
        <div class="admin__form__btn-container">
            <button class="form--cta" type="submit"> {{ isEdit ? 'ändra' : 'skapa'}} </button>
        </div>
    </form>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';

   const {isEdit, item} = defineProps({
        item: Array,
        isEdit: {
            type: Boolean,
            default: false,
        },
    })

  const form = useForm({
    title: isEdit ? item.title : '',
    desc: isEdit ? item.desc : '',
    status: isEdit ? item.status : '',
  });

  const submit = () => {
    isEdit
        ? form.put(`/admin/rooms/${item.id}`)
        : form.post('/admin/rooms');
  };

</script>

