import request from "@/utils/request"

export function login(userData) {
  return request({
    url: "/oauth",
    data: {
      client_id: "testclient",
      grant_type: "password",
      ...userData
    },
    method: "post"
  })
}

export function refreshToken(refreshToken) {
  return request({
    url: "/oauth",
    data: {
      client_id: "testclient",
      grant_type: "refresh_token",
      refresh_token: refreshToken
    },
    method: "post"
  })
}

export function getUserInfo(token) {
  return request({
    url: "/usuario/me",
    params: {
      token
    },
    method: "get"
  })
}
