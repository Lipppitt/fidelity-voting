<script setup lang="ts">

import Layout from "@/layouts/Layout.vue";
import Panel from "@/components/global/Panel.vue";
import Container from "@/layouts/Container.vue";
import VotingForm from "@/components/voting/VotingForm.vue";
import RegisterForm from "@/components/auth/RegisterForm.vue";
import {useUserStore} from "@/stores/UserStore";

const {getUser, isEmailVerified} = useUserStore();

</script>

<template>
    <Layout>
        <Container class="max-w-lg">
            <Panel>
              <template v-if="getUser && isEmailVerified">
                <VotingForm/>
                <p class="text-center mt-4">
                    Voting as: {{getUser.email}}
                </p>
              </template>
              <RegisterForm v-else/>
            </Panel>
        </Container>
    </Layout>
</template>

<style scoped>

</style>
