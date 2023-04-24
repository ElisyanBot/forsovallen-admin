<template>
   <section>
       <div class="card-container">
           <RoomCard v-for="room in rooms" :room="room"/>
       </div>
       <div class="pagination"></div>
   </section>


</template>

<script setup>
    import RoomCard from "./RoomCard.vue";

    defineProps({
        rooms: Array,
    });
</script>
