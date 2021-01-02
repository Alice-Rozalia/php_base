export const setUser = (state, data) => {
  state.user = data
  window.sessionStorage.setItem('user', JSON.stringify(data))
}

export const setToken = (state, token) => {
  state.token = token
  sessionStorage.token = token
}

export const setCollapse = (state) => {
  if (state.isCollapse) {
    state.isCollapse = false
    state.collapseIcon = 'el-icon-s-fold'
  } else {
    state.isCollapse = true
    state.collapseIcon = 'el-icon-s-unfold'
  }
}