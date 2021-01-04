<template>
  <div>
    <el-card>
      <!-- 添加角色 -->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-input placeholder="输入角色名搜索..." v-model="listQuery.key" @clear="getRoleList" clearable size="small"
            prefix-icon="el-icon-search">
            <el-button @click="getRoleList" slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </el-col>
        <el-col :span="8">
          <el-input v-model="addRoleForm.name" prefix-icon="el-icon-plus" placeholder="请输入角色名..." size="small" />
        </el-col>
        <el-col :span="4">
          <el-button @click="addRole" icon="el-icon-plus" type="primary" size="small">添加角色</el-button>
        </el-col>
      </el-row>

      <!-- 角色列表 -->
      <el-table :data="roleList" stripe border highlight-current-row v-loading="listLoading">
        <el-table-column type="expand">
          <template slot-scope="{row}">
            <el-row :class="['bdbottom', i1 === 0 ? 'bdtop' : '', 'vcenter']" v-for="(item1,i1) in row.child"
              :key="item1.name">
              <!-- 渲染一级权限 -->
              <el-col :span="5">
                <el-tag>{{item1.name}}</el-tag>
                <i class="el-icon-caret-right"></i>
              </el-col>
              <!-- 渲染二级和三级权限 -->
              <el-col :span="19">
                <!-- 渲染二级权限 -->
                <el-row :class="[i2 === 0 ? '' : 'bdtop', 'vcenter']" v-for="(item2, i2) in item1.sub"
                  :key="item2.name">
                  <el-col :span="6">
                    <el-tag type="success">{{item2.name}}</el-tag>
                    <i class="el-icon-caret-right"></i>
                  </el-col>
                  <el-col :span="18">
                    <el-tag type="warning" v-for="(item3, i3) in item2.sub" :key="item3.name">
                      {{item3.name}}
                    </el-tag>
                  </el-col>
                </el-row>
              </el-col>
            </el-row>
          </template>
        </el-table-column>
        <el-table-column type="index" label="序号" width="60" align="center" />
        <el-table-column label="角色名称" align="center">
          <template slot-scope="{row}">
            <template v-if="row.edit">
              <el-input v-model="row.name" class="edit-input" size="mini" />
              <el-button class="cancel-btn" size="mini" icon="el-icon-refresh" type="warning" @click="cancelEdit(row)">
                取消
              </el-button>
            </template>
            <span v-else>{{row.name}}</span>
          </template>
        </el-table-column>
        <el-table-column prop="created_at" label="创建时间" align="center" width="180" />
        <el-table-column label="操作" align="center">
          <template slot-scope="{row}">
            <el-button v-if="row.edit" type="success" size="mini" icon="el-icon-circle-check-outline"
              @click="confirmEdit(row)">
              确认
            </el-button>
            <el-button v-else type="primary" size="mini" icon="el-icon-edit" @click="row.edit=!row.edit">
              修改
            </el-button>
            <el-button icon="el-icon-delete" size="mini" type="danger">
              删除
            </el-button>
            <el-button @click="showSetRightDialog(row.id)" icon="el-icon-setting" size="mini" type="warning">分配角色
            </el-button>
          </template>
        </el-table-column>
      </el-table>

      <pagination v-show="total>0" :total="total" :page.sync="listQuery.page" :limit.sync="listQuery.limit"
        @pagination="getRoleList" />
    </el-card>

    <!-- 分配权限对话框 -->
    <el-dialog title="分配权限" :visible.sync="setRightDialog" width="50%">
      <!-- 树形控件 -->
      <el-tree :data="rightsList" :props="treeProps" :default-checked-keys="defKeys" show-checkbox default-expand-all
        node-key="id" />
      <span slot="footer" class="dialog-footer">
        <el-button @click="setRightDialog = false">取 消</el-button>
        <el-button type="primary" @click="setRightDialog = false">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
  import {
    fetchRolesApi,
    addRoleApi,
    updateRoleApi,
    fetchNodesByRoleIdApi
  } from '@/api/role'
  import Pagination from '@/components/Pagination.vue'

  export default {
    components: {
      Pagination
    },
    data() {
      return {
        roleList: [],
        listLoading: false,
        listQuery: {
          page: 1,
          limit: 10,
          key: ''
        },
        total: 0,
        addRoleForm: {
          name: ''
        },
        setRightDialog: false,
        rightsList: [],
        // 树形控件的树形绑定对象
        treeProps: {
          label: 'name',
          children: 'sub'
        },
        defKeys: []
      }
    },
    created() {
      this.getRoleList()
    },
    methods: {
      getRoleList() {
        this.listLoading = true
        fetchRolesApi(this.listQuery).then(res => {
          if (res.data.success) {
            const list = res.data.data.data
            this.total = res.data.data.total
            this.roleList = list.map(v => {
              this.$set(v, 'edit', false)
              v.originalTitle = v.name
              return v
            })
            setTimeout(() => {
              this.listLoading = false
            }, 0.5 * 1000)
          }
        })
      },
      addRole() {
        if (this.addRoleForm.name.trim() === '') return this.$message.warning('角色名不能为空！')
        addRoleApi(this.addRoleForm).then(res => {
          if (res.data.success) {
            this.$message.success(res.data.message)
            this.getRoleList()
          }
        })
      },
      cancelEdit(row) {
        row.name = row.originalTitle
        row.edit = false
        this.$message.warning('数据已还原！')
      },
      confirmEdit(row) {
        row.edit = false
        updateRoleApi(row).then(res => {
          if (res.data.success) {
            this.$message.success(res.data.message)
            this.getRoleList()
          }
        })
      },
      showSetRightDialog(id) {
        fetchNodesByRoleIdApi(id).then(res => {
          if (res.data.success) {
            this.defKeys = res.data.data.nodes
            this.rightsList = res.data.data.allNode
          }
        })
        this.setRightDialog = true
      }
    }
  }
</script>

<style lang="less" scoped>
  .edit-input {
    padding-right: 100px;
  }

  .cancel-btn {
    position: absolute;
    right: 15px;
    top: 10px;
  }

  .el-tag {
    margin: 7px;
  }

  .bdtop {
    border-top: 1px solid #eee;
  }

  .bdbottom {
    border-bottom: 1px solid #eee;
  }

  .vcenter {
    display: flex;
    align-items: center;
  }
</style>