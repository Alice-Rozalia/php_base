import request from '@/utils/request'

export const fetchRolesApi = (data => {
  return request({
    url: '/admin/role',
    method: 'get',
    params: data
  })
})

export const addRoleApi = (data => {
  return request({
    url: '/admin/role',
    method: 'post',
    data: data
  })
})

export const updateRoleApi = (data => {
  return request({
    url: `/admin/role/${data.id}`,
    method: 'put',
    data: data
  })
})