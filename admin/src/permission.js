import router from "./router"
import store from "@/store"
import { getToken } from "@/utils/auth"

let isLoginRoute = function (route) {
  return new RegExp("^/login((/){0,}(.)+)?").test(route)
}

router.beforeEach((to, from, next) => {
  // Verifica se há um token no store
  if (getToken()) {
    if (isLoginRoute(to.path)) {
      next({ path: "/" })
    } else {
      if(!store.getters.userId) {
        store.dispatch("GetUserInfo")
          .then(() => {
            next({ ...to, replace: true })
          })
          .catch((err) => {
            if (err.response.status !== 401 || !getToken()) {
              store.dispatch("FedLogOut").then(() => {
                this.$toasted.error(err || "Falha na verificação, por favor logue novamente")
                next({ path: "/" })
              })
            } else {
              next({ ...to, replace: true })
            }
          })
      } else {
        next()
      }      
    }
  } else {
    /* não possui token */

    /** 
     * Verifica se a rota é a rota de login ou uma
     * de suas filhas
    */
    if (isLoginRoute(to.path)) {
      next()
    } else {
      /** 
       * Direciona para a pagina de login, para que após
       * realizar o login tente acessar o caminho pretendido
       */
      next(`/login?redirect=${to.path}`)
    }
  }
})
