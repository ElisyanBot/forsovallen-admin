<template>
  <div class="selected-room-item">
    <input
      :id="id"
      v-model="checkedStatus"
      type="checkbox"
      :name="id"
      :value="id"
      @change="$emit('selectedRoomValue', id)"
    />
    <label :for="id">
      {{ title }}: {{ beds }} sängar
    </label>
  </div>
</template>

<script setup>
import { ref } from 'vue'
const props = defineProps({
  id: Number,
  title: String,
  beds: Number,
  checked: Boolean,
})

defineEmits(['selectedRoomValue'])

const checkedStatus = ref(props.checked)
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
