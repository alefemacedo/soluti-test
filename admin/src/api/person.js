import request from "@/utils/request"

export function fetchPerson(identifier) {
  return request({
    url: "/pessoa/" + identifier,
    method: "get"
  })
}