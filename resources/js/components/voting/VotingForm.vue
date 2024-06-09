<script setup lang="ts">
import CustomButton from "@/components/forms/CustomButton.vue";
import VotingOption from "@/components/voting/VotingOption.vue";
import {ref} from "vue";
import axios from "axios";

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
const isProcessingVote = ref(false);
const error = ref(null);

const handleSubmit = async () => {
  const vote = selectedOption.value;

  try {
    isProcessingVote.value = true;
    const response = await axios.post('/api/vote', {vote: vote.value});
    console.log(response);
  } catch (err) {
    console.error(err);
  } finally {
    isProcessingVote.value = false;
  }
}
</script>

<template>
    <form @submit.prevent="handleSubmit">
        <h1 v-if="votingOptions?.title" class="text-xl text-center">
          {{votingOptions.title}}
        </h1>

        <p v-if="selectedOption">
            You have selected: {{selectedOption}}
        </p>

        <div v-if="error">
            {{error}}
        </div>

        <div v-if="votingOptions?.options">
            <VotingOption v-for="option in votingOptions.options"
                          :option="option"
                          v-model:voteSelected="selectedOption"
            />
        </div>
        <CustomButton type="submit" :disabled="isProcessingVote" :is-loading="isProcessingVote">
            Submit Vote
        </CustomButton>
    </form>
</template>

<style scoped>

</style>
