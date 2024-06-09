declare global {
    interface Window {
        axios:any;
    }
}

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.axios.interceptors.request.use(config => {
    const authToken = localStorage.getItem('authToken');

    if (authToken) {
        config.headers.Authorization = `Bearer ${authToken}`;
    }

    return config;
});
