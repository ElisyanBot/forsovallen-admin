<template>
  <div class="handle-reservation">
    <!-- reservation item section -->

    <article class="reservation-item">
      <div class="reservation-item__status" />
      <div class="reservation-item__short-info">
        <p> {{ reservation.data.id }} </p>
        <p> {{ reservation.data.email }} </p>
        <p> sängar: {{ totalBeds }} </p>
        <p>pris: {{ totalCost }} kr</p>
        <p> ohanterad </p>
      </div>
      <div class="reservation-item__btns">
        <button @click="handleDeleteItem"> delete </button>
        <button @click="openForm"> edit </button>
      </div>
    </article>

    <!-- form section -->

    <section v-if="displayForm" class="reservation-form">
      <section class="reservation-form__info">
        <div class="reservation-form__header">
          <h3> bekräfta bokningen </h3>
        </div>
        <div class="reservation-form__customer-info">
          <p class="customer-info"> <b> namn </b>  <span> {{ reservation.data.name }} </span></p>
          <p class="customer-info"> <b> email </b>  <span> {{ reservation.data.email }} </span></p>
          <p class="customer-info"> <b> mobilnumber </b>  <span> {{ reservation.data.phone }} </span></p>
          <p class="customer-info">
            <b> period </b>
            <span>{{ reservation.data.check_in }} - {{ reservation.data.check_out }}</span>
          </p>
        </div>

        <div class="reservation-form__booking-info">
          <p class="booking-info"> <b> vuxna </b>  <span> {{ reservation.data.adults }} </span></p>
          <p class="booking-info"> <b> barn </b>  <span> {{ reservation.data.children }} </span></p>
          <p class="booking-info"> <b> tältplatser </b>  <span> {{ reservation.data.tent_spots }} </span></p>
          <p class="booking-info"> <b> husvagnsplatser </b>  <span> {{ reservation.data.caravan_spots }} </span></p>
          <p class="booking-info"> <b> totalt pris  </b>  <span> {{ totalCost }} kr </span></p>
        </div>
      </section>
      <div class="reservation-form__divider" />

      <form
        class="reservation-form__room-select"
        @submit.prevent="createBooking"
      >
        <div class="reservation-from__header">
          <div>
            <h4> välj rum </h4>
            <p> {{ selectedRooms.length }} st valda </p>
          </div>
          <div class="select-room__tabs">
            <button @click.prevent="handleAddAvailableRoomsTab"> lägg till </button>
            <button @click.prevent="handleEditRoomsTab"> ändra </button>
          </div>
        </div>
        <div class="reservation-form__room-select-list">
          <SelectRoomItem
            v-for="room in availableRooms"
            v-if="showAvailableRooms"
            :id="room.id"
            :key="room.id"
            :title="room.title"
            :beds="room.beds"
            @selected-room-value=" (id) => {
              addSelectedRoom(selectedRooms, id)
            }"
          />

          <SelectRoomItem
            v-for="room in bookedRooms"
            v-if="!showAvailableRooms"
            :id="room.id"
            :key="room.id"
            :title="room.title"
            :beds="room.beds"
            :checked="true"
            @selected-room-value=" (id) => {
              addSelectedRoom(selectedRooms, id)
            }"
          />
        </div>
        <div class="reservation-form__cta-btns">
          <button class="handle-reservation__deny-bnt" @mouseup="closeForm"> stäng </button>
          <button type="submit" class="handle-reservation__accept-btn"> acceptera </button>
        </div>
      </form>
    </section>
  </div>
</template>

<script setup>
import {router, useForm} from '@inertiajs/vue3'
import { ref, computed} from 'vue'
import SelectRoomItem from './SelectRoomItem.vue'

const props = defineProps({
  reservation: Object,
})


const displayForm = ref(false)
const availableRooms = ref(null)
const bookedRooms = ref(null)
const selectedRooms = ref([])
const showAvailableRooms = ref(true)

const totalBeds = computed(() => props.reservation.data.adults + props.reservation.data.children)
const totalCost = computed(() =>
  (props.reservation.data.adults * 270)
        + (props.reservation.data.children * 100)
        + (props.reservation.data.tent_spots * 195)
        + (props.reservation.data.caravan_spots * 250),
)

const openForm = async () => {
  availableRooms.value = await fetchAvailableRooms()
  displayForm.value = true
}
const closeForm = () => {
  displayForm.value = false
  selectedRooms.value = []
}


const addSelectedRoom = (array, roomId) => {
  const arr = array

  if(arr.find(i => i === roomId)) {
    arr.splice(arr.indexOf(roomId), 1)
    return arr
  }
  console.log(arr)
  return arr.push(roomId)
}

const handleEditRoomsTab = async () => {
  if(!showAvailableRooms.value) return

  selectedRooms.value = []
  showAvailableRooms.value = false
  bookedRooms.value = await fetchRoomsById().then()
}

const handleAddAvailableRoomsTab =  async () =>{
  if(showAvailableRooms.value) return

  selectedRooms.value = []
  showAvailableRooms.value = true
  availableRooms.value = await fetchAvailableRooms()
}


//todo: make this to a better solution
const handleDeleteItem = () => {
  router.delete(`/admin/reserve-rooms/${props.reservation.data.id}`, {
    onSuccess: () => {
      router.delete(`/admin/reservations/${props.reservation.notice_id}`)
    },
  })
}

const createBooking = () => {
  const form = useForm({
    bookings: [],
    email: props.reservation.data.email,
  })

  selectedRooms.value.forEach((roomId) => {
    form.bookings.push({
      room_id: roomId,
      reserve_room_id: props.reservation.data.id,
      start_date: props.reservation.data.check_in,
      end_date: props.reservation.data.check_out,
    })
  })

  form.post('/admin/book-room', {
    onSuccess: () => {
    },
    onError: () => {
      alert('bokningen misslyckades')
    },
  })
}

const removeBookedRoom = () => {
  const form = useForm({
    rooms: [],
  })

  selectedRooms.value.forEach((roomId) => {
    form.rooms.push({
      room_id: roomId,
    })
  })

  form.post('/admin/book-room', {
    onSuccess() {
    },
    onError: () => {
      alert('form error')
    },
  })
}

const fetchRoomsById = async () => {
  const rooms = await fetch(`/api/rooms/${props.reservation.data.id}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
  })
  return await rooms.json()
}

const fetchAvailableRooms = async () => {
  //todo: change endpoint to correct REST endpoint
  const rooms = await fetch(`/api/rooms/${props.reservation.data.id}/available`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
    },
  })
  return await rooms.json()
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
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-end;
                    margin-bottom: 2rem;

                    div > h4 {
                        text-transform: uppercase;
                        font-size: 1.8rem;
                        margin-bottom: 0.5rem;
                    }

                    .select-room__tabs {
                        display: flex;
                        gap: 1rem;

                        button {
                            border: none;
                            background: none;
                            font-size: 1.4rem;
                            text-transform: uppercase;
                            cursor: pointer;
                            border-bottom: 2px solid transparent;
                            padding-bottom: 0.5rem;
                            &:hover {
                                border-bottom: 2px solid #c64533;
                            }
                        }

                    }
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
                        margin-right: 1rem;
                        color: #c64533;
                        border: none;
                        padding: 1rem 2rem;
                        font-size: 1.6rem;
                        text-transform: uppercase;
                        cursor: pointer;
                        background: none;
                        border-bottom: 2px solid transparent;
                        transition: all 0.3s ease-in-out;

                        &:hover {
                            border-bottom: 2px solid #c64533;
                        }
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
