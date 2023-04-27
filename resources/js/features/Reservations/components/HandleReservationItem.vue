<template>
  <div class="handle-reservation">

    <!-- reservation item section -->

    <article class="reservation-item">
      <div class="reservation-item__status">
      </div>
      <div class="reservation-item__short-info" >
          <p> {{reservation.data.id}} </p>
          <p> {{reservation.data.email}} </p>
          <p> sängar: {{totalBeds}} </p>
          <p>pris: {{totalCost}} kr</p>
          <p> ohanterad </p>
      </div>
      <div class="reservation-item__btns">
        <button @click="handleDeleteItem"> delete </button>
        <button @click="handleReservation"> edit </button>
      </div>
    </article>

    <!-- form section -->

    <section v-if="displayForm" class="reservation-form">
      <section class="reservation-form__info">
          <div class="reservation-form__header">
              <h3> bekräfta bokningen </h3>
          </div>
          <div class="reservation-form__customer-info" >
              <p class="customer-info"> <b> namn </b>  <span> {{ reservation.data.name }} </span></p>
              <p class="customer-info"> <b> email </b>  <span> {{ reservation.data.email }} </span></p>
              <p class="customer-info"> <b> mobilnumber </b>  <span> {{ reservation.data.phone }} </span></p>
              <p class="customer-info"> <b> period </b>  <span> {{ reservation.data.check_in }} - {{ reservation.data.check_out }} </span></p>
          </div>

          <div class="reservation-form__booking-info" >
              <p class="booking-info"> <b> vuxna </b>  <span> {{ reservation.data.adults }} </span></p>
              <p class="booking-info"> <b> barn </b>  <span> {{ reservation.data.children }} </span></p>
              <p class="booking-info"> <b> tältplatser </b>  <span> {{ reservation.data.tent_spots }} </span></p>
              <p class="booking-info"> <b> husvagnsplatser </b>  <span> {{ reservation.data.caravan_spots }} </span></p>
              <p class="booking-info"> <b> totalt pris  </b>  <span> {{ totalCost }} kr </span></p>
          </div>
      </section>
      <div class="reservation-form__divider" > </div>

      <form @submit.prevent="submit" class="reservation-form__room-select">
        <div class="reservation-from__header" >
            <h4> välj rum </h4>
            <p> {{ selecetedRooms.length }} st valda </p>
        </div>
        <div class="reservation-form__room-select-list" >
            <SelectRoomItem
                @selected-room-value=" (id) => addSelectedRoom(id)"
                v-for="room in rooms"
                :key="room.id"
                :id="room.id"
                :title="room.title"
                :beds="room.beds"/>
        </div>
        <div class="reservation-form__cta-btns" >
            <button class="handle-reservation__deny-bnt" @mouseup="closeForm"> avböj </button>
            <button type="submit" class="handle-reservation__accept-btn" > acceptera </button>
        </div>
      </form>
    </section>
  </div>
</template>

<script setup>
    import {router, useForm} from '@inertiajs/vue3'
    import { ref, computed} from 'vue';
    import SelectRoomItem from "./SelectRoomItem.vue";

    const props = defineProps({
      reservation: Object,
    })


    const displayForm = ref(false)
    const rooms = ref(null);
    const selecetedRooms = ref([]);

    const totalBeds = computed(() => props.reservation.data.adults + props.reservation.data.children)
    const totalCost = computed(() =>
        (props.reservation.data.adults * 270)
        + (props.reservation.data.children * 100)
        + (props.reservation.data.tent_spots * 195)
        + (props.reservation.data.caravan_spots * 250)
    );

    const showForm = () => {
        displayForm.value = true
    }
    const closeForm = () => {
        displayForm.value = false
    }


    const fetchRooms = async () => {
        const rooms = await fetch(`/api/rooms/${props.reservation.data.id}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        });
        return await rooms.json();
    }
    const handleReservation = async () => {
        rooms.value = await fetchRooms();

        if (rooms.value) {
            showForm();
        }
    }
    const addSelectedRoom = (roomId) => {
        const exists = selecetedRooms.value.find(i => i === roomId);
        if(!exists) {
            selecetedRooms.value.push(roomId);
            return;
        }

        selecetedRooms.value.splice(selecetedRooms.value.indexOf(roomId), 1);
    }

    const handleDeleteItem = () => {
        router.delete(`/admin/reserve-rooms/${props.reservation.data.id}`);
        router.delete(`/admin/reservations/${props.reservation.notice_id}`);
    }

    const submit = () => {
        const form = useForm({
            bookings: [],
        });
        selecetedRooms.value.forEach((roomId) => {
            form.bookings.push({
                room_id: roomId,
                reserve_room_id: props.reservation.data.id,
                start_date: props.reservation.data.check_in,
                end_date: props.reservation.data.check_out,
            });
        })

        form.post(`/admin/book-room`, {
            onSuccess: () => {
                closeForm();
            }
        });
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
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    gap: 1rem;
                    padding: 1rem;
                    width: 100%;
                    height: 30rem;
                    border: 1px solid black;
                    border-radius: 0.5rem;
                    overflow-y: scroll;
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
