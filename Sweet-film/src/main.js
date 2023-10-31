import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import { Quasar } from 'quasar'
import quasarUserOptions from './quasar-user-options'
import '@quasar/extras/material-icons/material-icons.css'  // 'quasar' plugin

//fontawesome
import { library } from '@fortawesome/fontawesome-svg-core'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* import specific icons */
import { faUserSecret } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret)

const app = createApp(App)
.component('font-awesome-icon', FontAwesomeIcon)
.use(Quasar, quasarUserOptions)
.use(router)
.mount('#app')

