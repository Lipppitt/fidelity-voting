<script setup lang="ts">

import {computed} from "vue";

const emit = defineEmits(['update:selected']);

const props = defineProps({
    id: {
        type: String,
        default: ""
    },
    name: {
        type: String,
        default: ""
    },
    value: {
        type: [Number, String],
        default: ""
    },
    selected: {
      type: Boolean,
      required: false
    },
});

const selected = computed({
  get() {
    return props.selected;
  },

  set(val) {
    emit('update:selected', val);
  },
});
</script>

<template>
    <input :id="props.id"
           type="radio"
           :name="props.name"
           :value="props.value"
           v-model="selected"
    />
</template>

<style scoped>

</style>
