import './bootstrap';
import Alpine from 'alpinejs';
import { createApp } from 'vue'
import Counter from './components/Counter.vue'
// import { CognifitSdk } from '@cognifit/launcher-js-sdk';
// import { CognifitSdkConfig } from '@cognifit/launcher-js-sdk/lib/lib/cognifit.sdk.config';
import { Axios } from 'axios';
const app = createApp()

window.Alpine = Alpine;
window.Axios = Axios;

Alpine.start();

app.component('counter', Counter)
app.mount('#app')