<template>
  <!-- 侧边栏 -->
  <el-aside :width="$store.state.isCollapse ? '64px' : '200px'">
    <!-- 侧边栏菜单区域 -->
    <el-menu background-color="#304156" text-color="#fff" active-text-color="#00a4ff" unique-opened
      :collapse="$store.state.isCollapse" :collapse-transition="false" router :default-active="activePath">
      <el-submenu :index="item.id + ''" v-for="item in menulist" :key="item.id">
        <!-- 一级菜单的模板区域 -->
        <template slot="title">
          <!-- 图标 -->
          <i :class="item.icon"></i>
          <!-- 文本 -->
          <span>{{item.name}}</span>
        </template>

        <!-- 二级菜单 -->
        <el-menu-item :index="subitem.path" v-for="subitem in item.children" :key="subitem.id"
          @click="saveNavState(subitem.path)">
          <template slot="title">
            <!-- 图标 -->
            <i class="el-icon-menu"></i>
            <!-- 文本 -->
            <span>{{subitem.name}}</span>
          </template>
        </el-menu-item>
      </el-submenu>
    </el-menu>
  </el-aside>
</template>

<script>
  import menu from '@/utils/menu'

  export default {
    data() {
      return {
        // 是否折叠菜单
        isCollapse: false,
        // 被激活的链接地址
        activePath: 'index',
        menulist: menu,
      }
    },
    methods: {
      // 保存链接的激活状态
      saveNavState(activePath) {
        window.sessionStorage.setItem('activePath', activePath)
        this.activePath = activePath
      },
      // 获取链接激活状态
      getActive() {
        this.activePath = window.sessionStorage.getItem('activePath')
        if (this.activePath === null) {
          this.activePath = 'index'
        }
      }
    }
  }
</script>

<style lang="less" scoped>
  .el-aside {
    background: #304156;
  }

  .el-menu {
    border-right: none;
  }
</style>