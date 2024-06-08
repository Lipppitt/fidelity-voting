<script setup lang="ts">
import CustomButton from "@/components/forms/CustomButton.vue";
import VotingOption from "@/components/voting/VotingOption.vue";
import {ref} from "vue";

const votingOptions = {
  title: 'What is your favorite season of the year?',
  options: [
    {
      label: 'Spring',
      value: 1
    },
    {
      label: 'Summer',
      value: 2
    },
    {
      label: 'Autumn',
      value: 3
    },
    {
      label: 'Winter',
      value: 4
    }
  ]
};

const selectedOption = ref<null | VotingOption>(null);

</script>

<template>
    <form>
        <h1 v-if="votingOptions?.title" class="text-xl text-center">
          {{votingOptions.title}}
        </h1>

        <p v-if="selectedOption">
            You have selected: {{selectedOption}}
        </p>

        <div v-if="votingOptions?.options">
            <VotingOption v-for="option in votingOptions.options"
                          :option="option"
                          v-model:voteSelected="selectedOption"
            />
        </div>
        <CustomButton type="submit">
            Submit Vote
        </CustomButton>
    </form>
</template>

<style scoped>

</style>
