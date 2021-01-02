import request from '@/utils/request'

export const loginApi = (data => {
  return request({
    url: '/admin/login',
    method: 'post',
    data: data
  })
})

export const logoutApi = (() => {
  return request({
    url: '/admin/logout',
    method: 'get'
  })
})