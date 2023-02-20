import './bootstrap';
import router from './router/router'
import {createApp} from 'vue'
import store from './store'
import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import * as icon from '@coreui/icons';
import { iconsSet as icons } from '@/assets/icons'
import App from './App.vue'

createApp(App).
use(router).
use(CIcon).
use(store).
use(CoreuiVue).
use(icon).
provide('icons', icons).
component('CIcon', CIcon).mount("#app")