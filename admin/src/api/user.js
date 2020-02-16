import request from "@/utils/request"

export function fetchAll(params) {
  return request({
    url: "/user",
    params,
    method: "get"
  })
}

export function create(requestParams) {
  return request({
    url: "/user/0",
    data: requestParams,
    method: "post"
  })
}