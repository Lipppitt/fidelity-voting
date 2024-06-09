import { createWebHistory, createRouter } from 'vue-router'
import routes from "@/router/routes";
import {useUserStore} from "@/stores/UserStore";

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach(async (to, from, next) => {
    const userStore = useUserStore();
    // Check if the user is authenticated
    if (!userStore.user) {
        try {
            await userStore.fetchUser();
            next();
        } catch (error) {
            next('/');
        }
    } else {
        next();
    }
});
export default router;
