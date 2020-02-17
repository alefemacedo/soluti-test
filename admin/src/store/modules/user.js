import { login, getUserInfo, refreshToken } from "@/api/auth"
import {
  getToken,
  setToken,
  removeToken,
  getRefreshToken,
  setRefreshToken,
  removeRefreshToken
} from "@/utils/auth"

const user = {
  state: {
    token: getToken(),
    refreshToken: getRefreshToken(),
    userId: null,
    userName: "Usuário",
    isRefreshing: false,
  },

  mutations: {
    SET_TOKEN: (state, token) => {
      state.token = token
    },
    SET_REFRESH_TOKEN: (state, refreshToken) => {
      state.refreshToken = refreshToken
    },
    SET_USER_ID: (state, id) => {
      state.userId = id
    },
    SET_USER_NAME: (state, name) => {
      state.userName = name
    },
    START_TOKEN_REFRESH(state) {
      state.isRefreshing = true
    },
    FINISH_TOKEN_REFRESH(state) {
      state.isRefreshing = false
    }
  },

  actions: {
    /**
     * Realiza autenticação na API
     * 
     * @param {*} param0 
     * @param {Object} userData 
     */
    Login({ commit }, userData) {
      return new Promise((resolve, reject) => {
        login({ username: userData.email, password: userData.password })
          .then(response => {
            commit("SET_TOKEN", response.data.access_token)
            setToken(response.data.access_token)
            commit("SET_REFRESH_TOKEN", response.data.refresh_token)
            setRefreshToken(response.data.refresh_token)
            resolve()
          }).catch(error => {
            reject(error)
          })
      })
    },

    /**
     * Busca os dados do usuário logado de acordo com
     * o token
     * 
     * @param {*} param
     */
    GetUserInfo({ state, commit }) {
      return new Promise((resolve, reject) => {
        getUserInfo(state.token).then(response => {
          if (!response.data) {
            reject("error")
          }
          commit("SET_USER_ID", response.data.id)
          commit("SET_USER_NAME", response.data._embedded.person.name)
          resolve(response)
        }).catch(error => {
          reject(error)
        })
      })
    },

    /**
     * Realiza logout da API, removendo ambos Token e RefreshToken
     * do Store
     * 
     * @param {*} param0 
     */
    LogOut({ commit }) {
      return new Promise((resolve) => {
        commit("SET_TOKEN", "")
        commit("SET_REFRESH_TOKEN", "")
        commit("SET_USER_ID", null)
        removeToken()
        removeRefreshToken()
        resolve()
      })
    },
 
    /**
     * Atualiza o Token do usuário
     * 
     * @param {*} param0 
     */
    RefreshToken({ commit }) {
      return new Promise((resolve, reject) => {
        commit("START_TOKEN_REFRESH")
        refreshToken(getRefreshToken()).then(response => {
          commit("SET_TOKEN", response.data.access_token)
          setToken(response.data.access_token)
          commit("FINISH_TOKEN_REFRESH")
          resolve()
        }).catch(error => {
          reject(error)
        })
      })
    }
  }
}

export default user
