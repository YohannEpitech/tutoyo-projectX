import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import MyProfile from '../views/MyProfile.vue'

import Login from '../views/Login.vue'
import Logout from '../components/Logout.vue'
import Welcome from '../views/Welcome.vue'

import Register from '../views/Register.vue'
import CreateTuto from '../views/CreateTuto.vue'
import EditTuto from '../views/EditTuto.vue'
import ReadTuto from '../views/ReadTuto.vue'

import adminTutos from '../views/AdminTutos.vue'
import adminUsers from '../views/AdminUsers.vue'
import adminLangages from '../views/langages/AdminLangages.vue'

Vue.use(VueRouter)

  const routes = [
  {
    path: '/',
    name: 'Welcome',
    component: Welcome
  },
  {
    path: '/home',
    name: 'Home',
    component: Home
  },
  {
    path: '/myprofile',
    name: 'myprofile',
    component: MyProfile
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
  },
  {
    path: '/logout',
    name: 'logout',
    component: Logout

  },
  {
    path: '/register',
    name: 'register',
    component: Register,
  },
  {
    path: '/createTuto',
    name: 'createtuto',
    component: CreateTuto,
  },
  {
    path: '/tutos/:id/read',
    name: 'readtuto',
    component: ReadTuto,
  },
  {
    path: '/tutos/:id',
    name: 'edittuto',
    component: EditTuto,
  },

  {
    path: '/adminUsers',
    name: 'adminusers',
    component: adminUsers,
  },
  {
    path: '/adminTutos',
    name: 'admintutos',
    component: adminTutos,
  },
  {
    path: '/adminLangages',
    name: 'adminlangages',
    component: adminLangages,
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
