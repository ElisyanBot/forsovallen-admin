<template>
  <div class="filter__section">
    <button> filter </button>
    <div class="filter__dropdown" />
  </div>
</template>

<style scoped lang="scss">
    .filter__section {
        button {
            background: none;
            border: none;
            padding: 1rem 2rem;
            font-size: 1.8rem;
            text-transform: uppercase;
            cursor: pointer;
            color: #c64533;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease-in-out;

            &:hover {
                border-bottom: 2px solid #c64533;
            }
        }}
</style>
