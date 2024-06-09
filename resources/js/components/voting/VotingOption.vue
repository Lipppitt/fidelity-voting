<script setup lang="ts">
import CustomLabel from "@/components/forms/CustomLabel.vue";
import CustomRadio from "@/components/forms/CustomRadio.vue";
import type {PollOption} from "@/types";

const emit = defineEmits(['update:voteSelected']);

defineProps({
    option: {
        type: Object as () => PollOption,
        default: () => Object
    }
});

const handleSelectedVote = (vote: PollOption) => {
    emit('update:voteSelected', vote);
};

</script>

<template>
    <div>
      <CustomRadio
          :id="option.value.toString()"
          :value="option.value"
          name="vote"
          v-model="option.value"
          @change="handleSelectedVote(option)"
      />
      <CustomLabel :for="option.value.toString()">
          {{option.label}}
      </CustomLabel>
    </div>
</template>

<style scoped>

</style>
