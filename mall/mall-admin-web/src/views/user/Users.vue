<template>
  <div>
    <el-card>
      <!-- 顶部搜索、按钮 -->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-input placeholder="输入用户名搜索..." v-model="listQuery.key" @clear="getUserList" clearable size="small"
            prefix-icon="el-icon-search">
            <el-button @click="getUserList" slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </el-col>
        <el-col :span="8">
          <el-button type="primary" size="small" @click="showAddUserDialog">添加用户</el-button>
          <el-button type="success" size="small">导出Excel</el-button>
          <el-button type="danger" size="small" @click="bulkDelete" :disabled="multipleSelection.length===0">批量删除
          </el-button>
        </el-col>
      </el-row>

      <!-- 表格区域 -->
      <el-table :data="users" @selection-change="selectionChange" stripe border highlight-current-row
        v-loading="listLoading">
        <el-table-column type="selection" width="50" align="center" :selectable="canSelectable" />
        <el-table-column type="index" label="序号" width="50" align="center" />
        <el-table-column prop="username" label="用户名" align="center" width="70" />
        <el-table-column prop="phone" label="手机号" align="center" width="100" />
        <el-table-column prop="email" label="邮箱" align="center" />
        <el-table-column prop="gender" label="性别" width="60" align="center" />
        <el-table-column prop="role.name" label="角色" width="80" align="center" />
        <el-table-column prop="last_ip" label="登录ip" align="center" />
        <el-table-column prop="created_at" label="创建时间" align="center" width="150" />
        <el-table-column label="状态" align="center" width="80">
          <template slot-scope="{row}">
            <el-tag type="success" size="small" v-if="row.deleted_at === null">启用</el-tag>
            <el-tag type="danger" size="small" v-else>禁用</el-tag>
          </template>
        </el-table-column>
        <el-table-column label="操作" align="center" width="180">
          <template slot-scope="{row}">
            <el-button size="mini" @click="showEditDialog(row)" icon="el-icon-edit" type="primary" />
            <!-- 删除按钮 -->
            <el-button v-if="row.deleted_at === null && row.id !== user.id" size="mini" @click="deleteUser(row)"
              type="danger" icon="el-icon-delete" />
            <el-tooltip effect="dark" content="还原用户" placement="top" :enterable="false">
              <el-button @click="restore(row.id)" size="mini" v-if="row.deleted_at !== null" icon="el-icon-refresh"
                type="info" />
            </el-tooltip>
            <el-tooltip effect="dark" content="分配角色" placement="top" :enterable="false">
              <el-button @click="setRole(row)" size="mini" icon="el-icon-setting" type="warning" />
            </el-tooltip>
          </template>
        </el-table-column>
      </el-table>

      <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit"
        @pagination="getUserList" />
    </el-card>

    <!-- 添加用户对话框 -->
    <el-dialog title="添加用户" :visible.sync="addDialogVisible" width="50%" @close="addDialogClosed">
      <el-form ref="addForm" :model="addForm" :rules="addRules" auto-complete="off" label-width="70px">
        <el-form-item prop="username" label="用户名">
          <el-input size="small" v-model="addForm.username" placeholder="用户名" name="username" type="text" tabindex="1"
            auto-complete="off" />
        </el-form-item>

        <el-form-item prop="password" label="密码">
          <el-input size="small" v-model="addForm.password" type="password" placeholder="密码" name="password"
            show-password tabindex="2" auto-complete="off" />
        </el-form-item>

        <el-form-item prop="email" label="邮箱">
          <el-input size="small" v-model="addForm.email" type="text" placeholder="邮箱" name="email" tabindex="3"
            auto-complete="off" />
        </el-form-item>

        <el-form-item prop="phone" label="手机号">
          <el-input size="small" v-model="addForm.phone" type="text" placeholder="手机号码" name="phone" tabindex="4"
            auto-complete="off" />
        </el-form-item>

        <el-form-item label="角色">
          <el-select v-model="addForm.role_id" placeholder="请选择角色" size="small">
            <el-option v-for="item in roles" :key="item.id" :label="item.name" :value="item.id" />
          </el-select>
        </el-form-item>

        <el-form-item prop="gender" label="性别">
          <el-radio-group v-model="addForm.gender">
            <el-radio label="男"></el-radio>
            <el-radio label="女"></el-radio>
          </el-radio-group>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button size="small" @click="addDialogVisible = false">取 消</el-button>
        <el-button size="small" type="primary" @click="handleAddUser">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 修改用户对话框 -->
    <el-dialog title="修改用户" :visible.sync="editDialogVisible" width="50%">
      <el-form ref="editForm" :model="editForm" :rules="editRules" auto-complete="off" label-width="70px">
        <el-form-item label="用户名">
          <el-input size="small" disabled v-model="editForm.username" placeholder="用户名" name="username" type="text"
            tabindex="1" auto-complete="off" />
        </el-form-item>

        <el-form-item prop="originalPassword" label="原密码">
          <el-input size="small" v-model="editForm.originalPassword" type="password" placeholder="原密码"
            name="originalPassword" show-password tabindex="2" auto-complete="off" />
        </el-form-item>

        <el-form-item label="密码">
          <el-input size="small" v-model="editForm.password" type="password" placeholder="密码" name="password"
            show-password tabindex="3" auto-complete="off" />
        </el-form-item>

        <el-form-item prop="email" label="邮箱">
          <el-input size="small" v-model="editForm.email" type="text" placeholder="邮箱" name="email" tabindex="4"
            auto-complete="off" />
        </el-form-item>

        <el-form-item prop="phone" label="手机号">
          <el-input size="small" v-model="editForm.phone" type="text" placeholder="手机号码" name="phone" tabindex="5"
            auto-complete="off" />
        </el-form-item>

        <el-form-item prop="gender" label="性别">
          <el-radio-group v-model="editForm.gender">
            <el-radio label="男"></el-radio>
            <el-radio label="女"></el-radio>
          </el-radio-group>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button size="small" @click="editDialogVisible = false">取 消</el-button>
        <el-button size="small" type="primary" @click="editUserInfo">确 定</el-button>
      </span>
    </el-dialog>

    <!-- 分配角色对话框 -->
    <el-dialog title="分配角色" @close="setRoleDialogClosed" :visible.sync="setRoleDialog" width="35%" class="set-role">
      <div>
        <el-tag effect="plain">当前的用户:</el-tag>{{userInfo.username}}
      </div>
      <div style="margin:7px 0">
        <el-tag effect="plain" type="success">当前的角色:</el-tag>{{userInfo.role ? userInfo.role.name : ''}}
      </div>
      <div>
        <el-tag effect="plain" type="warning">分配新角色:</el-tag>
        <el-select v-model="selectedRoleId" placeholder="请选择角色" size="small">
          <el-option v-for="item in roles" :key="item.id" :label="item.name" :value="item.id" />
        </el-select>
      </div>
      <span slot="footer" class="dialog-footer">
        <el-button @click="setRoleDialog = false" size="small">取 消</el-button>
        <el-button type="primary" @click="saveRoleInfo" size="small">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
  import {
    fetchUsersApi,
    addUserApi,
    deleteUserApi,
    restoreUserApi,
    deleteManyUserApi,
    updateUserApi,
    allotRoleApi
  } from '@/api/user'
  import {
    fetchRolesApi
  } from '@/api/role'
  import Pagination from '@/components/Pagination.vue'
  import addRules from '@/utils/addUserRules'
  export default {
    components: {
      Pagination
    },
    data() {
      return {
        listLoading: true,
        users: [],
        total: 0,
        listQuery: {
          page: 1,
          limit: 10,
          key: ''
        },
        addDialogVisible: false,
        // 添加用户的表单数据
        addForm: {
          username: '',
          password: '',
          email: '',
          phone: '',
          gender: '',
          role_id: 2
        },
        addRules: addRules,
        // 复选框选中项
        multipleSelection: [],
        // 当前登录用户
        user: JSON.parse(window.sessionStorage.getItem('user')),
        editDialogVisible: false,
        editForm: {
          username: '',
          password: '',
          email: '',
          phone: '',
          gender: '',
          originalPassword: ''
        },
        editRules: addRules,
        setRoleDialog: false,
        userInfo: {},
        roles: [],
        selectedRoleId: ''
      }
    },
    created() {
      this.getUserList()
    },
    methods: {
      getUserList() {
        this.listLoading = true
        fetchUsersApi(this.listQuery).then(res => {
          if (res.data.success) {
            this.users = res.data.data.users
            this.total = res.data.data.total
            setTimeout(() => {
              this.listLoading = false
            }, 0.5 * 1000)
          }
        })
      },
      // 添加用户对话框关闭事件
      addDialogClosed() {
        this.$refs.addForm.resetFields()
      },
      showAddUserDialog() {
        fetchRolesApi({
          page: 1,
          limit: 100
        }).then(res => {
          if (res.data.success) {
            this.roles = res.data.data.data
            this.addDialogVisible = true
          }
        })
      },
      // 添加用户
      handleAddUser() {
        this.$refs.addForm.validate(valid => {
          if (!valid) return
          addUserApi(this.addForm).then(res => {
            if (res.data.success) {
              this.$message.success(res.data.message)
              this.addDialogVisible = false
              this.getUserList()
            }
          })
        })
      },
      // 删除用户（软删除）
      async deleteUser(user) {
        const result = await this.$confirm('此操作将删除【' + user.username + '】用户, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning',
        }).catch(err => err)

        if (result !== 'confirm') return this.$message.info('删除操作已取消！')

        deleteUserApi(user.id).then(res => {
          if (res.data.success) {
            this.$message.success(res.data.message)
            this.getUserList()
          }
        })
      },
      // 恢复角色
      restore(id) {
        restoreUserApi(id).then(res => {
          if (res.data.success) {
            this.$message.success(res.data.message)
            this.getUserList()
          }
        })
      },
      selectionChange(val) {
        this.multipleSelection = val
      },
      // 复选框是否可选
      canSelectable(row) {
        if (row.deleted_at !== null || this.user.id === row.id) {
          return false
        } else {
          return true
        }
      },
      // 批量删除
      async bulkDelete() {
        const result = await this.$confirm('此操作将删除【' + this.multipleSelection.length + '】个用户, 是否继续?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning',
        }).catch(err => err)

        if (result !== 'confirm') return this.$message.info('删除操作已取消！')

        let ids = []
        this.multipleSelection.forEach(item => {
          ids.push(item.id)
        })
        if (ids.length > 0) {
          deleteManyUserApi(ids).then(res => {
            if (res.data.success) {
              this.$message.success(res.data.message)
              this.getUserList()
            }
          })
        }
      },
      // 显示修改用户对话框
      showEditDialog(user) {
        this.editDialogVisible = true
        Object.assign(this.editForm, user)
      },
      // 修改用户信息
      editUserInfo() {
        this.$refs.editForm.validate(valid => {
          if (!valid) return
          updateUserApi(this.editForm).then(res => {
            if (res.data.success) {
              this.$message.success(res.data.message)
              this.editDialogVisible = false
              this.getUserList()
            }
          })
        })
      },
      setRole(userInfo) {
        this.userInfo = userInfo
        // 获取角色列表
        fetchRolesApi({
          page: 1,
          limit: 100
        }).then(res => {
          if (res.data.success) {
            this.roles = res.data.data.data
            this.setRoleDialog = true
          }
        })
      },
      saveRoleInfo() {
        if (!this.selectedRoleId) return this.$message.error('请选择要分配的角色！')
        this.userInfo.role_id = this.selectedRoleId
        allotRoleApi(this.userInfo).then(res => {
          if (res.data.success) {
            this.$message.success(res.data.message)
            this.setRoleDialog = false
            this.selectedRoleId = ''
          }
        })
      },
      setRoleDialogClosed() {
        this.userInfo = {}
        this.selectedRoleId = ''
      }
    }
  }
</script>

<style lang="less" scoped>
  .set-role {
    .el-tag {
      margin-right: 15px;
    }
  }
</style>