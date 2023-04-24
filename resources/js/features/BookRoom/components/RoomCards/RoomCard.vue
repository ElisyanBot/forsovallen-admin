<template>
    <article class="room-card">
        <picture>
            <img v-if="room.image" :src="room.image.src" alt="room image">
        </picture>
        <div>
            <h3> {{ room.title}} </h3>
            <p> {{ room.beds }} </p>
        </div>
    </article>
</template>

<script setup>
    defineProps({
        room: Object,
    });
</script>
