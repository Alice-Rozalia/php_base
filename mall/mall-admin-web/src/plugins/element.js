import Vue from 'vue'
import {
  Button,
  Input,
  Form,
  FormItem,
  Message,
  Container,
  Aside,
  Main,
  Header,
  MessageBox,
  Dropdown,
  DropdownItem,
  DropdownMenu,
  Menu,
  Submenu,
  MenuItem,
  Notification
} from 'element-ui'

Vue.use(Submenu)
Vue.use(MenuItem)
Vue.use(Menu)
Vue.use(Dropdown)
Vue.use(DropdownItem)
Vue.use(DropdownMenu)
Vue.use(Header)
Vue.use(Main)
Vue.use(Aside)
Vue.use(Container)
Vue.use(Form)
Vue.use(FormItem)
Vue.use(Input)
Vue.use(Button)

Vue.prototype.$message = Message
Vue.prototype.$confirm = MessageBox.confirm
Vue.prototype.$notify = Notification
