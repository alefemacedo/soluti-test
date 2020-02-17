import request from "@/utils/request"

export function fetchAll(params) {
  return request({
    url: "/contract",
    params,
    method: "get"
  })
}

export function fetch(params, id) {
  return request({
    url: "/contract/" + id,
    params,
    method: "get"
  })
}