import Vue from "vue"
import App from "./App.vue"
import router from "./router"
import store from "./store"
import BootstrapVue from "bootstrap-vue"
import Toasted from "vue-toasted"

// importa as configurações de acesso
// a rotas
import "./permission"

// Global CSS classes
import "@/styles/index.scss"

// Integra o Vue Toasted para alertas e erros
Vue.use(Toasted, {
  duration: 4000
})

Vue.use(BootstrapVue)

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router,
  store
}).$mount("#app")
