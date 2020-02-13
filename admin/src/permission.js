import router from "./router"
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
      next()
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
