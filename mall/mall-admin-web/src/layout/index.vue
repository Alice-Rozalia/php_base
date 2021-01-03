<template>
  <el-container class="admin-container">
    <Aside />

    <el-container>
      <!-- 右侧头部 -->
      <el-header>
        <i class="zhedie" :class="$store.state.collapseIcon" @click="$store.dispatch('setCollapse')"></i>
        <div class="title">
          <span>商城后台管理系统</span>
        </div>
        <div class="user">
          <span class="username">{{user.username}}</span>
          <el-dropdown>
            <div class="person-photo">
              <img :src="user.avatar" class="user-avatar">
            </div>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>
                <router-link to="/index">前台首页</router-link>
              </el-dropdown-item>
              <el-dropdown-item>个人中心</el-dropdown-item>
              <el-dropdown-item @click.native="logout">退出登录</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </div>
      </el-header>

      <!-- 主体区域 -->
      <el-main>
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item :to="{ path: '/index' }">首页</el-breadcrumb-item>
          <el-breadcrumb-item>{{$route.meta.parent}}</el-breadcrumb-item>
          <el-breadcrumb-item>{{$route.name}}</el-breadcrumb-item>
        </el-breadcrumb>
        <router-view />
      </el-main>
    </el-container>
  </el-container>
</template>

<script>
  import Aside from '@/components/layout/Aside.vue'
  import { logoutApi } from '@/api/user'
  export default {
    components: {
      Aside
    },
    data() {
      return {
        user: []
      }
    },
    created() {
      this.user = JSON.parse(window.sessionStorage.getItem('user'))
    },
    methods: {
      async logout() {
        const { data } = await logoutApi()
        if (data.success) {
          this.$message.success(data.message)
          window.sessionStorage.clear()
          this.$router.push('/login')
        }
      }
    }
  }
</script>

<style lang="less" scoped>
  .admin-container {
    height: 100%;
  }

  .el-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #009cff;

    .user {
      display: flex;
      align-items: center;

      .username {
        color: #fff;
        font-size: 14px;
        margin-right: 15px;
      }

      .person-photo {
        width: 38px;
        height: 38px;
        border: 2px solid #ccc;
        border-radius: 50%;

        .user-avatar {
          width: 100%;
          height: 100%;
          border-radius: 50%;
          cursor: pointer;
        }
      }
    }

    .title {
      color: #fff;
      font-size: 20px;
      text-align: center;
    }

    .zhedie {
      color: #fff;
      cursor: pointer;
    }
  }

  .el-main {
    background: #eaedf1;
  }

  .el-breadcrumb {
    margin-bottom: 15px;
  }
</style>