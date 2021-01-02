import axios from 'axios'
import store from '@/store'
import NProgress from 'nprogress'
import { Message } from 'element-ui'

const request = axios.create({
  baseURL: process.env.VUE_APP_BASEURL,
  timeout: 5000,
  headers: {
    Accept: 'application/json, text/plain, */*',
    'Content-Type': 'application/json',
    'X-Requested-With': 'XMLHttpRequest'
  }
})


request.interceptors.request.use(config => {
  NProgress.start()
  if (store.state.token) {
    config.headers.Authorization = store.state.token
  } else if (window.sessionStorage.getItem('token')) {
    config.headers.Authorization = window.sessionStorage.getItem('token')
  }
  return config
}, error => {
  return Promise.reject(error)
})

request.interceptors.response.use(config => {
  if (!config.data.success) {
    Message({
      message: config.data.message || '服务器端异常！',
      type: 'error',
      duration: 3 * 1000
    })
  }
  NProgress.done()
  return config
}, error => {
  if (error.response.status == 504 || error.response.status == 404) {
    Message.error('服务器被吃了( ╯□╰ )！')
  } else if (error.response.status == 403) {
    Message.error('权限不足！')
  } else {
    if (error.response.data.message) {
      Message.error(error.response.data.message)
    } else {
      Message.error('未知错误！')
    }
  }
  return Promise.reject(error.response.data)
})

export default request