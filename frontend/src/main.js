import { createApp, ref, provide } from 'vue';
import App from './App.vue';
import VueCookies  from 'vue3-cookies';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import './assets/scss/styles.scss';
import * as bootstrap from 'bootstrap';
import router from './router';
import store from './store';
import userMixins from './mixins/user';
import assetMixins from './mixins/asset';

const app = createApp(App);

app.config.globalProperties.appName = import.meta.env.VITE_APP_NAME;
app.config.globalProperties.baseURL = import.meta.env.BASE_URL;

app.use(VueCookies);
app.use(VueSweetalert2);
app.use(router);
app.use(store);
app.mixin(userMixins);
app.mixin(assetMixins);

const showPassword = ref(false);
app.provide('showPassword', showPassword);

store.dispatch('logged', Boolean(app.config.globalProperties.$cookies.get('authorized')));

app.mount('#app');