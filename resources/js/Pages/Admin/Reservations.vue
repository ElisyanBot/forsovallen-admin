<template>
    <main class="admin-main">
        <MainWidthLayout>
            <div v-if="user" class="admin__header">
                <h2> admin | {{ user.name }} </h2>
                <Link href="/admin/logout" method="DELETE" as="button"> logga ut </Link>
            </div>

            Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident hic vero sint ducimus recusandae tempore commodi id nobis aliquid.
            Deserunt provident commodi cupiditate architecto ratione libero quos numquam aliquam repudiandae.

       <!--     <p v-for="res in reservations"> {{res}} </p> -->
        </MainWidthLayout>
    </main>
    <footer>

    </footer>
</template>

<script setup>

    import { Link } from '@inertiajs/vue3'
    import MainWidthLayout from '../../layouts/MainWidthLayout.vue'


    const props = defineProps({
        reservations: Array,
    })

    console.log(props.reservations)
</script>

<style scoped lang="scss">
.admin-main {
    min-height: 100vh;
}

.admin__header {
    margin: 6.5rem 0 3.5rem 0;
    color: #c64533;
    text-transform: uppercase;
    font-size: 2.4rem;
    font-weight: bold;

    display: flex;
    justify-content: space-between;

    button {
        background: none;
        border:none;
        font-size: inherit;
        text-transform: inherit;

        &:hover {
            cursor: pointer;
        }
    }
}
</style>
