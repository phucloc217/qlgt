import './bootstrap';
import router from './router/router'
import {createApp} from 'vue'
import store from './store'
import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import * as icon from '@coreui/icons';
import { iconsSet as icons } from '@/assets/icons'
import 'vue3-toastify/dist/index.css';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import App from './App.vue'

const app = createApp(App).
use(router).
use(CIcon).
use(store).
use(CoreuiVue).
use(icon).
use(VueSweetalert2).
provide('icons', icons).
component('CIcon', CIcon)
app.config.globalProperties.API_URL='http://127.0.0.1:8000/api'
app.mount("#app")
