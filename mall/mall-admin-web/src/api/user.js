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

export const fetchUsersApi = (data => {
  return request({
    url: '/admin/user/list',
    method: 'get',
    params: data
  })
})

export const addUserApi = (data => {
  return request({
    url: '/admin/user/add',
    method: 'post',
    data: data
  })
})

export const deleteUserApi = (id => {
  return request({
    url: `/admin/user/delete/${id}`,
    method: 'delete'
  })
})

// 还原用户
export const restoreUserApi = (id => {
  return request({
    url: `/admin/user/restore/${id}`,
    method: 'put'
  })
})

// 批量删除
export const deleteManyUserApi = (ids => {
  return request({
    url: '/admin/user/bulk_delete',
    method: 'delete',
    data: { ids }
  })
})

// 修改用户信息
export const updateUserApi = (user => {
  return request({
    url: `/admin/user/edit/${user.id}`,
    method: 'put',
    data: user
  })
})
