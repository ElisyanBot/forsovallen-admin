<template>
  <div class="book-room-form__focus">
    <form class="book-room-form" @submit.prevent="reserve">
      <div class="book-room-form__header">
        <h2> boka boende </h2>
        <button @click="$emit('closeBookForm')"> x </button>
      </div>
      <div class="text-info">
        <p>
          Tack för att du vill boka boende hos försövallen, skicka gärna ett mail eller hör av er på telefon vid bokning av
          boende. Vårat kontor har öppet: <b> 05:00 - 16:00 </b> varje vardag.
        </p>
        <h3 class="book-room-form__second-header"> Kontaktuppgifter </h3>

        <p class="book-room-form__info-text"><b> Mailadress: </b> <a href="mailto:info@frosovallen.se"> info@frosovallen.se</a></p>
        <p class="book-room-form__info-text"><b> telefon: </b> <a> 070-0000000  </a> </p>
      </div>

      <!-- <div class="room-info">
        <h3 class="book-room-form__second-header"> rum information </h3>
        <div class="important-info">
          <p class="info-divider">
            Tänk på att ni inte behöver boka antalet personer som kommer att sova på en tält eller
            husvagnsplats.
          </p>
        </div>
        <div class="two-input-container">
          <input v-model.number="form.adults" class="input" type="number" placeholder="antal vuxna" />
          <input v-model.number="form.children" class="input" type="number" placeholder="antal barn" />
        </div>
        <div class="two-input-container">
          <input v-model.number="form.caravan_spots" class="input" type="number" placeholder="antal husvangsplatser" />
          <input v-model.number="form.tent_spots" class="input" type="number" placeholder="antal tältplatser" />
        </div>
      </div>

      <div class="period-info">
        <h3 class="book-room-form__second-header"> period information </h3>
        <div class="two-input-container">
          <div class="input__date-container">
            <label for="start-date"> Från </label>
            <input id="start-date" v-model="form.check_in" class="input" type="date" />
          </div>
          <div class="input__date-container">
            <label for="end-date"> Till </label>
            <input id="end-date" v-model="form.check_out" class="input" type="date" placeholder="till" />
          </div>
        </div>
      </div>
      <div class="contact-info">
        <h3 class="book-room-form__second-header"> konakt infomation </h3>
        <div class="two-input-container">
          <input v-model="form.name" class="input" type="text" placeholder="namn" />
          <input v-model="form.phone" class="input" type="text" placeholder="mobilnummer" />
        </div>
        <input v-model="form.email" class="input" type="email" placeholder="email" />
      </div>

      <div class="book-room-form__btn-container">
        <div class="important-info">
          <h4> OBS! </h4>
          <p>
            Vi skickar ut ett svar när rummet är bokat,
            vi tar ej in mer uppgifter ifrån dig och all
            betalning sker på plats.
          </p>
        </div>
        <button class="book-room-form__button"> boka </button>
      </div> -->
    </form>
  </div>
</template>
<script setup>
import { useForm } from '@inertiajs/vue3'

const emits =  defineEmits(['closeBookForm, closeBookFormSuccess'])

const form = useForm({
  name: '',
  email: '',
  phone: '',
  check_in: '',
  check_out: '',
  adults: null,
  children: null,
  tent_spots: null,
  caravan_spots: null,
})

const reserve = () => {
  form.post('/reserve-room', {
    onSuccess() {
      emits('closeBookFormSuccess')
    },
  })
}

</script>

<style scoped lang="scss">
    .input {
        width: 100%;
        height: 5rem;
        border-radius: 0.5rem;
        padding: 1rem;
        margin-bottom: 1rem;
        font-size: 1.6rem;
        font-weight: bold;
        color: #464535;
        background-color: white;
        border: 1px solid black;

        &::placeholder {
            text-transform: capitalize;
        }
    }

    .two-input-container {
        display: flex;
        gap: 2rem;
    }

    .input__date-container {
        width: 50%;
        label {
            margin-bottom: 1rem;
        }
    }

    .important-info {
        h4 {
            color: #c64533;
            margin-bottom: 0.5rem;
        }
        p {
            width: 80%;
            font-weight: bold;
            font-size: 1.4rem;
        }

        p.info-divider {
            width: 100%;
            margin: 0 0 2rem 0;
            color: #2d3748;
        }
    }

    .book-room-form__focus {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100000;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 4rem;

        .book-room-form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            width: 75rem;
            background-color: #f2f2f2;
            padding: 4rem;
            border-radius: 0.5rem;

            .book-room-form__header {
                text-transform: uppercase;
                width: 100%;
                font-size: 2.8rem;
                font-weight: bold;
                color: #1C4E46;
                display: flex;
                justify-content: space-between;

                button {
                    background-color: #f2f2f2;
                    width: 4.8rem;
                    height: 4.8rem;
                    border: none;
                    border-radius: 0.5rem;
                    padding: 1rem;
                    filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));
                    color: #1C4E46;
                    font-size: 2.8rem;
                }
            }
            .book-room-form__second-header {
                text-transform: capitalize;
                margin: 2rem 0;
                font-size: 2.2rem;
            }

            .book-room-form__btn-container {
                display: flex;
                justify-content: space-between;
                align-items: center;


                button {
                    color: white;
                    background-color: #7D9A89;
                    text-transform: uppercase;
                    font-size: 2rem;
                    font-weight: bold;

                    border: none;
                    width: 15rem;
                    height: 5rem;
                }
            }
        }
    }
  
  .book-room-form__info-text {
    margin: 2rem;
    color: #141918a3;
    a {
      text-decoration: none;
      color: rgb(74, 150, 173);
      font-weight: bold;
    } 

    b {
      font-size:  1.8rem;
    }
  }
  @media screen and (max-width: 800px) {
      .book-room-form__focus {
        .book-room-form {
            padding: 2rem;
            .book-room-form__header {
                font-size: 2rem;

                button {
                    width: 2.8rem;
                    height: 2.8rem;
                    border: none;
                    border-radius: 0.5rem;
                    padding: 0;
                    font-size: 1.8rem;
                }
            }
        }
    }
  }
</style>
