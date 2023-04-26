<template>
  <div class="handle-reservation">

    <!-- reservation item section -->

    <article class="reservation-item">
      <div class="reservation-item__status">
      </div>
      <div class="reservation-item__short-info" >
          <p> {{reservation.id}} </p>
          <p> {{reservation.email}} </p>
          <p> sängar: {{totalBeds}} </p>
          <p>pris: {{totalCost}} kr</p>
          <p> ohanterad </p>
      </div>
      <div class="reservation-item__btns">
        <Link :href="`reservations/${reservation.id}`" method="DELETE" as="button"> delete </Link>
        <button @click="displayForm = true"> edit </button>
      </div>
    </article>

    <!-- form section -->

    <form v-if="displayForm" class="reservation-form">
      <section class="reservation-form__info">
          <div class="reservation-form__header">
              <h3> bekräfta bokningen </h3>
          </div>
          <div class="reservation-form__customer-info" >
              <p class="customer-info"> <b> namn </b>  <span> {{ reservation.name }} </span></p>
              <p class="customer-info"> <b> email </b>  <span> {{ reservation.email }} </span></p>
              <p class="customer-info"> <b> mobilnumber </b>  <span> {{ reservation.phone }} </span></p>
              <p class="customer-info"> <b> period </b>  <span> {{ reservation.check_in }} - {{ reservation.check_out }} </span></p>
          </div>

          <div class="reservation-form__booking-info" >
              <p class="booking-info"> <b> vuxna </b>  <span> {{ reservation.adults }} </span></p>
              <p class="booking-info"> <b> barn </b>  <span> {{ reservation.children }} </span></p>
              <p class="booking-info"> <b> tältplatser </b>  <span> {{ reservation.tent_spots }} </span></p>
              <p class="booking-info"> <b> husvagnsplatser </b>  <span> {{ reservation.caravan_spots }} </span></p>
              <p class="booking-info"> <b> totalt pris  </b>  <span> {{ totalCost }} kr </span></p>
          </div>
      </section>
      <div class="reservation-form__divider" > </div>

      <section class="reservation-form__room-select">
        <div class="reservation-from__header" >
            <h4> välj rum </h4>
            <p> {{ 2 }} st valda </p>
        </div>
        <div class="reservation-form__room-select-list" >

        </div>
        <div class="reservation-form__cta-btns" >
            <button class="handle-reservation__deny-bnt" @mouseup="closeForm"> avböj </button>
            <button class="handle-reservation__accept-btn" @mouseup="closeForm" > acceptera </button>
        </div>
      </section>
    </form>
  </div>
</template>

<script setup>
    import {Link} from '@inertiajs/vue3'
    import { ref, computed} from 'vue';

    const props = defineProps({
      reservation: Object,
    })

    const displayForm = ref(false)
    const totalBeds = computed(() => props.reservation.adults + props.reservation.children)
    const totalCost = computed(() =>
        (props.reservation.adults * 270)
        + (props.reservation.children * 100)
        + (props.reservation.tent_spots * 195)
        + (props.reservation.caravan_spots * 250)
    );

    const showForm = () => {
        displayForm.value = true
    }
    const closeForm = () => {
        displayForm.value = false
    }

</script>

<style scoped lang="scss">
    .handle-reservation {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        .reservation-form__header {
            display: flex;
            justify-content: space-between;
            h3 {
                text-transform: uppercase;
                font-size: 2rem;
                margin-bottom: 5rem;
                color: #c64533;
            }

            h4 {
                text-transform: uppercase;
                font-size: 1.8rem;
            }
        }

        .reservation-item {
            position: relative;
            z-index: 2;
            background-color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            height: 9rem;
            filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));
            .reservation-item__status {
                width: 10rem;
                height: inherit;
                background-color: #c64533;
            }
            .reservation-item__short-info {
                width: 100%;
                display: flex;
                justify-content: space-evenly;
                align-items: center;

                p {
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-width: calc(100%/5);
                    text-transform: uppercase;
                    font-size: 1.6rem;
                }
            }
        }

        .reservation-form {
            width: 100%;
            height: inherit;
            background-color: #ffffff;
            padding: 3rem 5rem;
            display: flex;
            justify-content: center;


            .reservation-form__info {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                width: 50%;

                p {
                    text-transform: uppercase;
                    margin-bottom: 1rem;
                    display: flex;
                    justify-content: space-between;
                    span {
                        text-transform: none;
                    }
                }

                .reservation-form__customer-info {
                    margin-bottom: 2rem;
                }
                .reservation-form__booking-info {

                }
            }

            .reservation-form__divider {
                content: ' ';
                height: inherit;
                width: 2px;
                background-color: lightgray;
                margin: 0 5rem;
            }

            .reservation-form__room-select {
                width: 30%;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: center;

                .reservation-from__header {
                    width: 100%;
                    height: 5rem;
                }
                .reservation-form__room-select-list {
                    width: 100%;
                    height: 30rem;
                    background-color: #c64533;
                }
                .reservation-form__cta-btns {
                    width: 100%;
                    height: 5rem;
                    text-align: end;
                    margin-top: 3rem;

                    .handle-reservation__deny-bnt {
                        background-color: #ffffff;
                        color: #c64533;
                        border: none;
                        padding: 1rem 2rem;
                        font-size: 1.6rem;
                        text-transform: uppercase;
                        cursor: pointer;
                    }
                    .handle-reservation__accept-btn {
                        background-color: #7D9A89;
                        color: #ffffff;
                        border: none;
                        padding: 1rem 2rem;
                        font-size: 1.6rem;
                        font-weight: bold;
                        text-transform: uppercase;
                        cursor: pointer;
                    }
                }
            }
        }
    }
</style>
