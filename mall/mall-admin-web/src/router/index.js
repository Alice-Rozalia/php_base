import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [{
    path: '/',
    redirect: '/index',
    name: 'Layout',
    component: () => import('@/layout/index.vue'),
    children: [{
      path: '/index',
      name: '首页',
      component: () => import('@/views/Home.vue'),
      meta: {
        parent: '系统管理'
      }
    }, {
      path: '/users',
      name: '用户列表',
      component: () => import('@/views/user/Users.vue'),
      meta: {
        parent: '用户管理'
      }
    }, {
      path: '/roles',
      name: '角色列表',
      component: () => import('@/views/permission/Roles.vue'),
      meta: {
        parent: '权限管理'
      }
    }, {
      path: '/rights',
      name: '权限列表',
      component: () => import('@/views/permission/Rights.vue'),
      meta: {
        parent: '权限管理'
      }
    }]
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import('@/views/Login.vue')
  },
  {
    path: '/*',
    name: '/404',
    component: () => import('@/views/404.vue')
  }
]

const router = new VueRouter({
  routes
})

router.beforeEach((to, from, next) => {
  if (to.path === '/login') return next()
  const user = window.sessionStorage.getItem('user')
  if (!user) return next('/login')
  next()
})

export default router