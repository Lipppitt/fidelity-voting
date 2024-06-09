import type { RouteRecordRaw } from 'vue-router';
import {useUserStore} from "@/stores/UserStore";

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/screens/Home.vue')
    },
    {
        path: '/email/verify/:id/:hash',
        name: 'Verify Email',
        component: () => import('@/screens/AuthVerifyEmail.vue'),
        beforeEnter: (to, from, next) => {
            const {isEmailVerified}= useUserStore();

            if (isEmailVerified) {
                console.log('Email verified');
                next('/');
            } else {
                next();
            }
        },
    },
];

export default routes;
