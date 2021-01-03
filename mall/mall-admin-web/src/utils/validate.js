/**
 * 验证密码格式
 * @param {string} password
 * @returns {Boolean}
 */
export function validPassword(password) {
  const reg = /^[a-zA-Z0-9_-]{6,20}$/
  return reg.test(password)
}

/**
 * 验证邮箱格式
 * @param {string} email
 * @returns {Boolean}
 */
export function validEmail(email) {
  const reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
  return reg.test(email)
}

/**
 * 验证手机号格式
 * @param {string} phone
 * @returns {Boolean}
 */
export function validPhone(phone) {
  const reg = /^(0|86|17951)?(13[0-9]|15[012356789]|17[3678]|18[0-9]|14[57]|19[1289])[0-9]{8}$/
  return reg.test(phone)
}