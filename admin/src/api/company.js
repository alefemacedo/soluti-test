import request from "@/utils/request"

export function create(requestFormData) {
  return request({
    url: "/company/0",
    data: requestFormData,
    method: "post"
  })
}

export function update(requestParams, id) {
  return request({
    url: "/company/" + id,
    data: requestParams,
    method: "PATCH"
  })
}

export function fetchAll(params) {
  return request({
    url: "/company",
    params,
    method: "get"
  })
}

export function fetch(id) {
  return request({
    url: "/company/" + id,
    method: "get"
  })
}