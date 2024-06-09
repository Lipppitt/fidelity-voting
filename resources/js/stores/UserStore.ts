import {defineStore} from "pinia";
import {computed, ref} from "vue";
import axios from "axios";

type User = {
    id: number;
    email: string;
    email_verified_at?: string;
    votes: [];
}

export const useUserStore = defineStore('user', () => {
    const user= ref<User | null>(null);
    const isLoading = ref(false);

    function setUser(userData: User) {
        user.value = {
            id: userData.id,
            email: userData.email,
            email_verified_at: userData.email_verified_at,
            votes: userData.votes
        };
    }

    async function fetchUser() {
        try {
            const user = await axios.get('/api/user');
            if (user.data?.id) {
                setUser(user.data);
            }
        } catch (err) {
            console.error(err);
        } finally {
            isLoading.value = false;
        }
    }

    const isEmailVerified = computed(() => {
        return !!user.value && !!user.value.email_verified_at;
    });

    const getUser = computed(() => user);

    return { user, fetchUser, getUser, setUser, isEmailVerified }
});
