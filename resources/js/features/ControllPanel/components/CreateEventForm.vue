<template>
    <form :class="{'admin__form':true, 'admin__form--edit': isEdit}" @submit.prevent="submit">
      <div class="admin__form-inputs">
          <div class="form__first-col">
              <div>
                <input class="input" placeholder="name" v-model="form.title"/>
              </div>
              <div>
                  <textarea class="input input--textarea" placeholder="beskrivning" v-model="form.desc"></textarea>
              </div>
          </div>
          <div class="form__second-col">
              <div>
                  <input class="input" placeholder="plats" v-model="form.location"/>
              </div>

              <div>
                 <input class="input" type="time" placeholder="tid" v-model="form.location" />
              </div>

              <div>
                <input class="input" type="date" placeholder="datum" v-model="form.date"/>
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
    desc: isEdit ? item.title : '',
    location: isEdit ? item.title : '',
    date: isEdit ? item.title : '',
    time: isEdit ? item.title : '',
  });

  const submit = () => {
    isEdit
        ? form.put(`/admin/events/${item.id}`)
        : form.post('/admin/events');
  };

</script>

