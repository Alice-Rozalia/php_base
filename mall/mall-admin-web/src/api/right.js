import request from '@/utils/request'

export const fetchNodesApi = (() => {
  return request({
    url: '/admin/node',
    method: 'get'
  })
})

// 获取所有根节点
export const fetchRootNodesApi = (() => {
  return request({
    url: '/admin/node/create',
    method: 'get'
  })
})

export const addNodeApi = (data => {
  return request({
    url: '/admin/node',
    method: 'post',
    data: data
  })
})