<template>
  <div>
    <el-card>
      <!-- 顶部菜单 -->
      <el-row :gutter="20">
        <el-col :span="8">
          <el-input placeholder="输入想要搜索的权限名称" clearable size="small" prefix-icon="el-icon-search">
            <el-button slot="append" icon="el-icon-search"></el-button>
          </el-input>
        </el-col>
        <el-col :span="4">
          <el-button type="primary" size="small" @click="showAddDialog">添加节点</el-button>
        </el-col>
      </el-row>

      <!-- 表格区域 -->
      <el-table :data="roles" stripe border highlight-current-row v-loading="listLoading">
        <el-table-column type="index" label="序号" width="50" align="center" />
        <el-table-column prop="name" label="节点名称" width="150">
          <template slot-scope="{row}">
            {{row.html + ' ' + row.name}}
          </template>
        </el-table-column>
        <el-table-column label="请求路径" align="center">
          <template slot-scope="{row}">
            {{row.path === "" ? "根节点" : row.path}}
          </template>
        </el-table-column>
        <el-table-column label="是否菜单" align="center">
          <template slot-scope="{row}">
            <el-tag v-if="row.is_menu==='1'" size="small">是</el-tag>
            <el-tag v-else size="small" type="info">否</el-tag>
          </template>
        </el-table-column>
        <el-table-column prop="level" label="权限等级" align="center">
          <template slot-scope="{row}">
            <el-tag v-if="row.level===1" type="success">一级</el-tag>
            <el-tag v-if="row.level===2" type="warning">二级</el-tag>
          </template>
        </el-table-column>
        <el-table-column prop="created_at" label="创建时间" align="center" width="150" />
        <el-table-column label="操作" align="center">
          <template slot-scope="{row}">
            <el-button size="mini" type="primary">修改
            </el-button>
            <el-button size="mini" type="danger">
              删除
            </el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-card>

    <!-- 添加权限 -->
    <el-dialog title="添加权限" :visible.sync="addDialogVisible" width="50%">
      <el-form ref="addForm" :model="addForm" :rules="addRules" auto-complete="off" label-width="90px">
        <el-form-item prop="name" label="节点名称">
          <el-input size="small" v-model="addForm.name" placeholder="节点名称" name="name" type="text" tabindex="1"
            auto-complete="off" />
        </el-form-item>

        <el-form-item label="请求路径">
          <el-input size="small" v-model="addForm.path" type="text" placeholder="请求路径" name="path" tabindex="2"
            auto-complete="off" />
        </el-form-item>

        <el-form-item label="图标">
          <el-input size="small" v-model="addForm.icon" type="text" placeholder="根菜单的图标" name="icon" tabindex="3"
            auto-complete="off" />
        </el-form-item>

        <el-form-item prop="pid" label="是否顶级">
          <el-select v-model="addForm.pid" placeholder="不选则是根节点" size="small">
            <el-option v-for="item in rootNode" :key="item.id" :label="item.name" :value="item.id" />
          </el-select>
        </el-form-item>

        <el-form-item prop="is_menu" label="是否菜单">
          <el-radio-group v-model="addForm.is_menu">
            <el-radio label="1">是</el-radio>
            <el-radio label="0">否</el-radio>
          </el-radio-group>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button size="small" @click="addDialogVisible = false">取 消</el-button>
        <el-button size="small" type="primary" @click="addNode">确 定</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
  import {
    fetchRootNodesApi,
    addNodeApi,
    fetchNodesApi
  } from '@/api/right'

  export default {
    data() {
      return {
        listLoading: false,
        addDialogVisible: false,
        addForm: {
          name: '',
          path: '',
          pid: null,
          // 是否是菜单，1是，0不是
          is_menu: '1',
          icon: ''
        },
        addRules: {
          name: [{
            required: true,
            message: '请输入节点名称',
            trigger: 'blur'
          }],
          is_menu: [{
            required: true,
            message: '请选择节点类型',
            trigger: 'blur'
          }]
        },
        rootNode: [],
        roles: []
      }
    },
    created() {
      this.getRoleList()
    },
    methods: {
      async getRoleList() {
        const {
          data
        } = await fetchNodesApi()
        if (data.success) {
          console.log(data);
          this.roles = data.data
        }
      },
      showAddDialog() {
        this.addDialogVisible = true
        this.getRootNodes()
      },
      async getRootNodes() {
        const {
          data
        } = await fetchRootNodesApi()
        if (data.success) {
          this.rootNode = data.data
        }
      },
      async addNode() {
        if (this.addForm.pid === null) {
          this.addForm.pid = 0
        }
        const {
          data
        } = await addNodeApi(this.addForm)
        if (data.success) {
          this.$message.success(data.message)
          this.addDialogVisible = false
          this.getRoleList()
          this.addForm.name = ''
          this.addForm.path = ''
          this.addForm.pid = null
        }
      }
    }
  }
</script>

<style lang="less" scoped>

</style>