<template>
    <form class="admin__form" @submit.prevent="create">
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
            <button class="form--cta" type="submit"> skapa </button>
        </div>
    </form>
</template>

<script setup>
  import { useForm } from '@inertiajs/vue3';

  const form = useForm({
    name: '',
    desc:'',
    status:'0',
    price:'',
  });

  const create = () => {
    form.post('/admin/food-items');
  };
</script>=""

<style lang="scss">
    .admin__form {
        display: flex;
        flex-direction: column;
        background: #ffffff;
        padding: 6rem;
        width: 100%;
        height: 40rem;
        max-width: 130rem;
        filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));
    }

    .admin__form--edit {
        filter:none;
        padding: 0;
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
            height: 10rem;
        }
    }

    .admin__form__btn-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        width: 80%;
        height: 5rem;
        margin: auto;
    }

    .form--cta {
        background-color: #7d9a89;
        width: 15rem;
        color: #ffffff;
        font-weight: bold;
        text-transform: uppercase;
        padding: 1rem 0;
        border: none;
        cursor: pointer;
        justify-self: flex-end;
    }
</style>
