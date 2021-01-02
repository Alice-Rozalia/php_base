/**
 * 验证密码格式
 * @param {string} password
 * @returns {Boolean}
 */
export function validPassword(password) {
  const reg = /^[a-zA-Z0-9_-]{6,20}$/
  return reg.test(password)
}