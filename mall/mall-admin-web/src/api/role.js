import request from '@/utils/request'
import qs from 'qs'

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

// 根据角色id获取该角色拥有的权限
export const fetchNodesByRoleIdApi = (id => {
  return request({
    url: `/admin/role/node/${id}`,
    method: 'get'
  })
})

// 分配权限
export const modifyNodesByIdApi = ((ids, role) => {
  return request({
    url: `/admin/role/node/${role}`,
    method: 'post',
    params: {
      ids: ids
    },
    paramsSerializer: params => {
      return qs.stringify(params, { indices: true })
    }
  })
})