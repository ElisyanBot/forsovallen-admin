<template>
    <div class="selected-room-item">
        <input
            @change="$emit('selectedRoomValue', id)"
            type="checkbox"
            :id="id"
            :name="id"
            :value="id"
        />
        <label  :for="id">
            {{title}}: {{ beds }} sängar
        </label>
    </div>
</template>

<script setup>
    defineProps({
        id: Number,
        title: String,
        beds: Number,
    })

    defineEmits(['selectedRoomValue']);
</script>

<style scoped lang="scss">
.selected-room-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 3rem;

    &:hover {
        cursor: pointer;

        label {
            cursor: pointer;
        }
    }
    input {
        height: 2rem;
        width: 2rem;
    }

    label {
        width: 100%;
        text-align: end;
    }
}
</style>
