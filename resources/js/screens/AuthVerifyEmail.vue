<script setup lang="ts">
import Layout from "@/layouts/Layout.vue";
import Panel from "@/components/global/Panel.vue";
import Container from "@/layouts/Container.vue";
import {onMounted, ref} from "vue";
import axios from "axios";
import {useRoute, useRouter} from "vue-router";
import {useUserStore} from "@/stores/UserStore";

const verified = ref(false);
const verificationError = ref(null);

const userStore = useUserStore();

onMounted(async () => {
  try {
    const route = useRoute();
    const router = useRouter();
    const { id, hash } = route.params;
    const response = await axios.get(`/api/email/verify/${id}/${hash}`);

    if (response.data?.verified) {
        verified.value = true;

        // Get fresh user and update global user store
        await userStore.fetchUser();

        // Redirect back to home screen
        await router.replace('/');
    }
  } catch (err) {
      console.error(err);
  }
});
</script>

<template>
    <Layout>
        <Container class="max-w-lg">
            <Panel>
                <h1>Email Verification</h1>
                <p v-if="verified">Your email has been verified!</p>
                <p v-else-if="verificationError">There was an error verifying your email.</p>
                <p v-else>Verifying...</p>
            </Panel>
        </Container>
    </Layout>
</template>

<style scoped>

</style>
