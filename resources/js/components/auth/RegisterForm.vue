<script setup lang="ts">
import {ref} from "vue";
import axios from "axios";
import CustomLabel from "@/components/forms/CustomLabel.vue";
import CustomTextInput from "@/components/forms/CustomTextInput.vue";
import CustomButton from "@/components/forms/CustomButton.vue";
import {useUserStore} from "@/stores/UserStore";
import Panel from "@/components/global/Panel.vue";

const {setUser, getUser, isEmailVerified} = useUserStore();

const form = ref({
    email: '',
    password: ''
});

const isProcessing = ref(false);
const error = ref(null);
const emailVerificationResent = ref(false);

const handleSubmit = async () => {
  try {
    isProcessing.value = true;

    const response = await axios.post('/api/register', form.value);

    if (response.data?.user) {
        setUser(response.data?.user);
    }

    if (response.data?.token) {
        localStorage.setItem('authToken', response.data?.token);
    }

  } catch (err) {
    if (err.response.data.message) {
      error.value = err.response.data.message;
    } else {
      error.value = "An error occurred. Please try again."
    }
  } finally {
    isProcessing.value = false;
  }
}

const handleResendEmailVerification = async () => {
  try {
    isProcessing.value = true;
    await axios.post('/api/email/verify');
    emailVerificationResent.value = true;
  } catch (err) {
    if (err.response.data.message) {
      error.value = err.response.data.message;
    } else {
      error.value = "An error occurred. Please try again."
    }
  } finally {
    isProcessing.value = false;
  }
}

</script>

<template>
  <Panel>
    <div v-if="getUser && !isEmailVerified">
      <p class="mb-4">An email has been sent to your registered email address. To complete the registration, please click the verification link in the email.</p>
      <p class="mb-4">If you didn't receive the email, please check your spam folder. You can also request a new verification email <button type="button" class="underline" @click="handleResendEmailVerification">here.</button></p>
      <p v-if="emailVerificationResent" class="text-green-700">Verification email has been resent</p>
    </div>
    <form v-else @submit.prevent="handleSubmit">
      <h1 class="text-xl text-center mb-2">
        Register to vote
      </h1>
      <div v-if="error" class="bg-red-100 text-red-600 text-sm px-3 py-2 rounded-lg mb-4">
        {{error}}
      </div>

      <div class="mb-4">
        <CustomLabel for="email" class="block">
          Email Address
        </CustomLabel>
        <CustomTextInput name="email" :value="form.email" v-model="form.email" id="email"/>
      </div>

      <div class="mb-4">
        <CustomLabel for="password" class="block">
          Password
        </CustomLabel>
        <CustomTextInput type="password" name="password" :value="form.password" v-model="form.password" id="password"/>
      </div>

      <CustomButton type="submit" :disabled="isProcessing" :is-loading="isProcessing">
        Register
      </CustomButton>
    </form>
  </Panel>
</template>

<style scoped>

</style>
