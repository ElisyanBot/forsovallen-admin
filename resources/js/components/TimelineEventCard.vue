<template>
    <div class="event-card">
        <article>
            <div class="header">
                <h3> {{ item.title }} </h3>
            </div>
            <div class="content">
                <p>
                    {{ item.desc}}
                </p>
            </div>
            <div class="footer">
                <b>
                  PLATS | <span> {{ item.location }} </span>
                </b>
                <b>
                    KL | <span> {{ item.time }} </span>
                </b>
            </div>
        </article>
        <div class="">
            <div class="date-section">
                <span> {{ item.date }} </span>
            </div>
            <div class="line"> </div>
        </div>
    </div>
</template>
<script setup>
    defineProps({
        item: Object,
    })
</script>

