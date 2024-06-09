<script setup lang="ts">
import CustomButton from "@/components/forms/CustomButton.vue";
import VotingOption from "@/components/voting/VotingOption.vue";
import {computed, ref} from "vue";
import axios from "axios";
import type {Poll} from "@/types";
import {useUserStore} from "@/stores/UserStore";
import Panel from "@/components/global/Panel.vue";

const props = defineProps<{
  poll: Poll
}>();

const {getUser} = useUserStore();

const selectedOption = ref<null | VotingOption>(null);
const isProcessingVote = ref(false);
const error = ref(null);

const getUsersVote = computed(() => {
  if (props.poll?.id && getUser.value.votes) {
    const vote = getUser.value.votes.find(userVote => userVote.poll_id === props.poll.id);

    if (vote) {
      const option = props.poll.options.find(o => o.value === vote.option_id);

      if (option) {
        return option.label;
      }
    }
  }
  return '';
});

const handleSubmit = async () => {
  const vote = selectedOption.value;

  try {
    isProcessingVote.value = true;
    const response = await axios.post(`/api/${props.poll.id}/vote`, {vote_id: vote.value});
    console.log(response);
  } catch (err) {
    console.error(err);
  } finally {
    isProcessingVote.value = false;
  }
}
</script>

<template>
  <Panel v-if="poll">
    <form @submit.prevent="handleSubmit">
      <h1 v-if="poll?.title" class="text-xl text-center">
        {{poll.title}}
      </h1>

      <div v-if="error">
        {{error}}
      </div>

      <p v-if="getUsersVote.length > 0" class="text-center text-green-500 font-bold mt-4 text-lg">
        You voted: {{getUsersVote}}
      </p>
      <template v-else>
        <div v-if="poll?.options">
          <VotingOption v-for="option in poll.options"
                        :option="option"
                        v-model:voteSelected="selectedOption"
          />
        </div>

        <CustomButton  type="submit" :disabled="isProcessingVote" :is-loading="isProcessingVote">
          Submit Vote
        </CustomButton>
      </template>
    </form>
  </Panel>
</template>

<style scoped>

</style>
