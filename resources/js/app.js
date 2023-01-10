import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import App from '~/components/App'

import VModal from 'vue-js-modal'

import '~/plugins'
import '~/components'

Vue.config.productionTip = false

Vue.use(VModal)

/* eslint-disable no-new */
new Vue({
  store,
  router,
  ...App
})
