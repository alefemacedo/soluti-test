import request from "@/utils/request"

export function fetchPerson(identifier) {
  return request({
    url: "/person/" + identifier,
    method: "get"
  })
}

export function fetchAll() {
  return request({
    url: "/person",
    method: "get"
  })
}