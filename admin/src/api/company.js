import request from "@/utils/request"

export function create(requestFormData) {
  return request({
    url: "/company/0",
    data: requestFormData,
    method: "post"
  })
}