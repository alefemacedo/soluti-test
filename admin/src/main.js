import Vue from "vue"
import App from "./App.vue"
import router from "./router"
import BootstrapVue from "bootstrap-vue"

// Global CSS classes
import "@/styles/index.scss"

Vue.use(BootstrapVue)

Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  router
}).$mount("#app")
