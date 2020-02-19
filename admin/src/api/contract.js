import request from "@/utils/request"

export function fetchAll(params) {
  return request({
    url: "/contract",
    params,
    method: "get"
  })
}

export function fetch(id) {
  return request({
    url: "/contract/" + id,
    method: "get"
  })
}

export function fetchFile(id, params) {
  return request({
    url: "/contract/" + id,
    params,
    headers: {
      "Content-Type": "application/pdf"
    },
    responseType: "blob",
    method: "get"
  })
}

export function validate(id) {
  return request({
    url: "/contract/" + id,
    data: {
      validate: true
    },
    method: "PATCH"
  })
}