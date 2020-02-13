import axios from "axios"
import { getToken } from "@/utils/auth"
import store from "@/store"
import router from "../router/"

// cria uma instância axios para requisições
const service = axios.create({
  baseURL: process.env.VUE_APP_BASE_API, // 
  timeout: 5000 // request timeout
})

// interceptor para request
service.interceptors.request.use(
  config => {
    // Verifica se há um token no store, e caso
    // haja insere o token na requisição
    if (store.getters.token) {
      config.headers["Authorization"] = "Bearer " + getToken()
    }
    return config
  },
  error => {
    // Printa o error response para debug
    console.log(error)
    Promise.reject(error)
  }
)

// interceptor para responses
// response interceptor
service.interceptors.response.use(
  response => response,
  async error => {
    // Mostra o error response no console
    console.log("err" + error)
    if (!axios.isCancel(error)) {
      const originalRequest = error.config

      // Caso a requisição interceptada seja de refresh token,
      // redireciona para a tela de login
      if (originalRequest.url === process.env.VUE_APP_BASE_API + "/oauth"
        && error.response.error === "invalid_grant" && error.response.status === 400) {
        store.dispatch("LogOut").then(() => {
          this.$toasted.error("Falha na verificação, por favor logue novamente")
          router.push({ path: "/" })
        })
      }
      // verifica se o status é unauthorized e se há um token
      // no storage
      if (error.response.status === 401 && getToken()) {
        // verifica se o processo de atualizar o token já
        // está em progresso
        if (!store.getters.isRefreshing) {
          return await store.dispatch("RefreshToken").then(() => {
            originalRequest.headers["Authorization"] = "Bearer " + getToken()
            return axios(originalRequest)
          })
        } else {
          return new Promise((resolve) => {
            const interval = setInterval(() => {
              if (!store.getters.isRefreshing) {
                resolve()
                clearInterval(interval)
              }
            }, 1000)
          }).then(() => {
            // insere o novo token no header
            originalRequest.headers["Authorization"] = "Bearer " + getToken()
            return axios(originalRequest)
          })
        }
      }
    }
    return Promise.reject(error)
  }
)
export default service
