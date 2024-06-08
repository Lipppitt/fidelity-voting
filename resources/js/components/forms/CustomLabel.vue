<script setup lang="ts">

const props = defineProps({
  for: {
    type: String,
    default: ""
  },
});
</script>

<template>
  <label :for="props.for">
      <slot></slot>
  </label>
</template>

<style scoped>

</style>
