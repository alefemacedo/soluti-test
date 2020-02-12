import request from "@/utils/request"

export function fetchAll(params) {
  return request({
    url: "/usuario",
    params,
    method: "get"
  })
}

export function create(requestParams) {
  return request({
    url: "/usuario",
    data: requestParams,
    method: "post"
  })
}