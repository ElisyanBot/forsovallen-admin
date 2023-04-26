<template>
  <MainWidthLayout>
    <h3 class="admin-login__header"> admin | Login </h3>
    <form class="login-form" @submit.prevent="login">
      <div class="login-form__input-container">
        <label for="email" />
        <input id="email" v-model="form.email" type="email" placeholder="email" />
      </div>
      <div class="login-form__input-container">
        <label for="password" />
        <input id="password" v-model="form.password" type="password" placeholder="password" />
      </div>
      <div class="login-form__input-container checkbox-container">
        <input id="stayLoggedIn" v-model="form.stayLoggedIn" type="checkbox" />
        <label for="stayLoggedIn">Håll mig inloggad på den här enheten</label>
      </div>
      <div class="login-form__input-container">
        <button type="submit"> login </button>
      </div>
    </form>
  </MainWidthLayout>
  <FooterImgBanner />
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import MainWidthLayout from '../../layouts/MainWidthLayout.vue'
import FooterImgBanner from '../../components/FooterImgBanner.vue'

const form = useForm({
  email: '',
  password: '',
  stayLoggedIn: false,
})

const login = () => form.post('/admin/login')
</script>

<style scoped lang="scss">

.admin-login__header {
    font-size: 3.2rem;
    margin: 5rem 0;
    color: #c64533;
    text-transform: uppercase;
    margin-left: 15rem;
}
  .login-form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.25);
    height: 50rem;
    width: 100rem;
    margin: auto;
      position: relative;
      z-index: 2;

    .login-form__input-container{
      margin: 2rem 0;

      input[type="email"],
      input[type="password"],
      button {
        width: 50rem;
        height: 6rem;
      }

      input {
        border-radius: 0.5rem;
        padding: 1rem;
        font-size: 1.8rem;
      }

      input[type="checkbox"]{
        width: 2.5rem;
        height: 2.5rem;
      }

      button {
        background-color: #7D9A89;
        color: white;
        font-size: 2rem;
        font-weight: bold;
        text-transform: uppercase;
        border: none;
        filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
        &:hover {
          cursor: pointer;
        }
      }
    }

    .checkbox-container {
      display: flex;
      align-items: center;
      width: 50rem;
      height: 5rem;
      gap: 2rem;
      font-size: 1.8rem;
    }
  }

</style>
