<script setup lang="ts">

import Layout from "@/layouts/Layout.vue";
import Panel from "@/components/global/Panel.vue";
import Container from "@/layouts/Container.vue";
import VotingForm from "@/components/voting/VotingForm.vue";
</script>

<template>
    <Layout>
        <Container class="max-w-lg">
            <Panel>
                <VotingForm/>
            </Panel>
        </Container>
    </Layout>
</template>

<style scoped>

</style>
