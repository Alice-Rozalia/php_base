import {
  validPassword,
  validEmail,
  validPhone
} from '@/utils/validate'

const validatePassword = (rule, value, callback) => {
  if (!validPassword(value)) {
    callback(new Error('密码由6-20位数字、字母、下划线、横杠组成'))
  } else {
    callback()
  }
}

const validateEmail = (rule, value, callback) => {
  if (!validEmail(value)) {
    callback(new Error('邮箱格式不合法！'))
  } else {
    callback()
  }
}

const validatePhone = (rule, value, callback) => {
  if (!validPhone(value)) {
    callback(new Error('手机号码不合法！'))
  } else {
    callback()
  }
}

const addRules = {
  username: [{
      required: true,
      message: '请输入用户名',
      trigger: 'blur'
    },
    {
      min: 2,
      max: 15,
      message: '用户名长度在2~15个字符之间',
      trigger: 'blur'
    }
  ],
  password: [{
      required: true,
      message: '请输入密码',
      trigger: 'blur'
    },
    {
      required: true,
      trigger: 'blur',
      validator: validatePassword
    }
  ],
  email: [{
      required: true,
      message: '请输入邮箱',
      trigger: 'blur'
    },
    {
      required: true,
      trigger: 'blur',
      validator: validateEmail
    }
  ],
  phone: [{
      required: true,
      message: '请输入手机号',
      trigger: 'blur'
    },
    {
      required: true,
      trigger: 'blur',
      validator: validatePhone
    }
  ],
  gender: [{
    required: true,
    message: '请选择性别',
    trigger: 'blur'
  }],
  originalPassword: [{
      required: true,
      message: '请输入原密码',
      trigger: 'blur'
    },
    {
      required: true,
      trigger: 'blur',
      validator: validatePassword
    }
  ],
}

export default addRules