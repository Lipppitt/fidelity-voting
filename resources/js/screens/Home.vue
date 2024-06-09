<script setup lang="ts">

import Layout from "@/layouts/Layout.vue";
import Panel from "@/components/global/Panel.vue";
import Container from "@/layouts/Container.vue";
import VotingForm from "@/components/voting/VotingForm.vue";
import RegisterForm from "@/components/auth/RegisterForm.vue";
import {useUserStore} from "@/stores/UserStore";
import {onMounted, ref} from "vue";
import axios from "axios";
import type {Poll} from "@/types";

const {getUser, isEmailVerified} = useUserStore();

const isLoading = ref(false);
const latestPoll = ref<Poll | null>(null);

onMounted(async () => {
  await fetchLatestPoll();
});

const fetchLatestPoll = async () => {
  try {
    isLoading.value = true;
    const response = await axios.get(`/api/latest-poll`);

    if (response.data?.poll) {
      const poll = response.data.poll;

      const pollOptions = poll.options.map((option: {label: string; id: number}) => {
        return {
            label: option.label,
            value: option.id
        }
      });

      latestPoll.value = {
        id: poll.id,
        title: poll.title,
        options: pollOptions
      }
    }
  } catch (err) {
    console.error(err);
  } finally {
    isLoading.value = false;
  }
}
</script>

<template>
    <Layout>
        <Container class="max-w-lg">
              <VotingForm v-if="getUser && isEmailVerified"
                          :poll="latestPoll"
              />
              <RegisterForm v-else/>
        </Container>
    </Layout>
</template>

<style scoped>

</style>
