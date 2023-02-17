import './bootstrap';
import router from './router/router'
import {createApp} from 'vue'
import store from './store'
import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import { iconsSet as icons } from '@/assets/icons'
import App from './App.vue'

createApp(App).use(CIcon).use(store).use(router).use(CoreuiVue).provide('icons', icons).component('CIcon', CIcon).mount("#app")