import request from "@/utils/request"

export function fetchPerson(identifier) {
  return request({
    url: "/pessoa/" + identifier,
    method: "get"
  })
}

export function fetchAll() {
  return request({
    url: "/pessoa",
    method: "get"
  })
}