const menu = [{
  id: 12,
  path: null,
  name: '系统设置',
  icon: 'el-icon-setting',
  children: [{
    id: 952,
    path: '/index',
    name: '首页'
  }]
}, {
  id: 1,
  path: null,
  name: '用户管理',
  icon: 'el-icon-user',
  children: [{
    id: 101,
    path: '/users',
    name: '用户列表'
  }]
}, {
  id: 2,
  path: null,
  name: '权限管理',
  icon: 'el-icon-bank-card',
  children: [{
    id: 201,
    path: '/roles',
    name: '角色列表'
  }, {
    id: 202,
    path: '/rights',
    name: '权限列表'
  }]
}, {
  id: 3,
  path: null,
  name: '商品管理',
  icon: 'el-icon-goods',
  children: [{
    id: 301,
    path: '/goods',
    name: '用户列表'
  }]
}, {
  id: 4,
  path: null,
  name: '数据报表',
  icon: 'el-icon-data-line',
  children: [{
    id: 401,
    path: '/datas',
    name: '用户列表'
  }]
}, {
  id: 5,
  path: null,
  name: '订单管理',
  icon: 'el-icon-tickets',
  children: [{
    id: 501,
    path: '/orders',
    name: '用户列表'
  }]
}, {
  id: 6,
  path: null,
  name: '库存管理',
  icon: 'el-icon-truck',
  children: [{
    id: 601,
    path: '/has',
    name: '用户列表'
  }]
}, {
  id: 7,
  path: null,
  name: '日志管理',
  icon: 'el-icon-coin',
  children: [{
    id: 701,
    path: '/log',
    name: '登录日志'
  }]
}]

export default menu