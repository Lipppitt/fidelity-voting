<script setup lang="ts">

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
    type: {
      type: String,
      default: 'text'
    },
});
</script>

<template>
    <input :id="props.id"
           :type="props.type"
           :name="props.name"
           :value="props.value"
           class="py-2 px-3 rounded-md w-full border border-slate-300"
           v-model="props.value"
    />
</template>

<style scoped>

</style>
