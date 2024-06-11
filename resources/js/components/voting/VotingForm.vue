<script setup lang="ts">
import CustomButton from "@/components/forms/CustomButton.vue";
import VotingOption from "@/components/voting/VotingOption.vue";
import {computed, ref} from "vue";
import axios from "axios";
import type {Poll, PollOption, UserVote} from "@/types";
import {useUserStore} from "@/stores/UserStore";
import Panel from "@/components/global/Panel.vue";

const props = defineProps<{
    poll: Poll,
    userHasPendingVote: boolean
}>();

const {getUser} = useUserStore();

const selectedOption = ref<null | typeof VotingOption>(null);
const processingVote = ref(false);
const success = ref(false);
const error = ref<null | string>(null);

const getUsersVote = computed(() => {
    if (props.poll?.id && getUser.value && getUser.value.votes) {
        const vote : UserVote | undefined = getUser.value.votes.find((userVote: UserVote) => userVote.poll_id === props.poll.id);
        if (vote) {
            const option = props.poll.options.find((o: PollOption) => o.value === vote.option_id);
            if (option) {
                return option.label;
            }
        }
    }
    return '';
});

const handleSubmit = async () => {
    const vote = selectedOption.value;
    if (!vote) return;

    try {
        processingVote.value = true;

        const response = await axios.post(`/api/${props.poll.id}/vote`, {vote_id: vote.value});

        if (response.data.success) {
            success.value = true;
        }

    } catch (err: any) {
        if (err.response.data.message) {
            error.value = err.response.data.message;
        } else {
            error.value = "An error occurred. Please try again."
        }
    } finally {
        processingVote.value = false;
    }
}
</script>

<template>
    <Panel v-if="poll">
        <form @submit.prevent="handleSubmit">
            <h1 v-if="poll?.title" class="text-xl text-center">
                {{ poll.title }}
            </h1>

            <div v-if="error" class="bg-red-100 text-red-600 text-sm px-3 py-2 rounded-lg mb-4">
                {{ error }}
            </div>

            <p v-if="getUsersVote.length > 0" class="text-center text-green-500 font-bold mt-4 text-lg">
                You voted: {{ getUsersVote }}
            </p>
            <p v-else-if="success || userHasPendingVote" class="text-center mt-4">
                Thank you. Your vote is being processed.<br>Please refresh the page to simulate Web socket / long poll.
            </p>
            <template v-else>
                <div v-if="poll?.options">
                    <VotingOption v-for="option in poll.options"
                                  :key="option.value"
                                  :option="option"
                                  v-model:voteSelected="selectedOption"
                    />
                </div>

                <CustomButton type="submit" :disabled="processingVote" :is-loading="processingVote">
                    Submit Vote
                </CustomButton>
            </template>
        </form>
    </Panel>
</template>

<style scoped>

</style>
