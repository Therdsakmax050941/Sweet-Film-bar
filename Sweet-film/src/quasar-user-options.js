
import 'quasar/dist/quasar.css'
import iconSet from 'quasar/icon-set/fontawesome-v5.js'
import '@quasar/extras/fontawesome-v5/fontawesome-v5.css'

// To be used on app.use(Quasar, { ... })
export default {
  config: {},
  plugins: {
  },
  extras: [
    'material-icons'
  ],
  framework: {
    iconSet: 'mdi-v7'
  }
}