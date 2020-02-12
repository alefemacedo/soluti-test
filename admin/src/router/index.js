import Vue from "vue"
import Router from "vue-router"
import Layout from "@/views/layout"

Vue.use(Router)

export const constantRouterMap = [
  {
    path: "",
    component: Layout,
    redirect: "dashboard",
    children: [
      {
        path: "dashboard",
        component: () => import("@/views/dashboard/index"),
        name: "Dashboard",
        meta: { title: "dashboard", icon: "dashboard", noCache: true }
      }
    ]
  },
  {
    path: "/login",
    component: () => import("@/views/login/index"),
    redirect: "/login/form",
    name: "login",
    children: [
      {
        path: "/login/form",
        component: () => import("@/views/login/form"),
        name: "login.form",
        meta: { title: "login.form.title", icon: "dashboard", noCache: true }
      },
      {
        path: "/login/user-registry",
        component: () => import("@/views/login/user-registry"),
        name: "login.user.registry",
        meta: { title: "login.user.registry.title", icon: "dashboard", noCache: true }
      }
    ]
  },
  {
    path: "/login/:message",
    component: () => import("@/views/login/index"),
    hidden: true,
    props: true
  },
  // {
  //   path: '/new-password/:rememberToken',
  //   component: () => import('@/views/login/new-password'),
  //   hidden: true,
  //   props: true
  // },
  // {
  //   path: '/auth-redirect',
  //   component: () => import('@/views/login/authredirect'),
  //   hidden: true
  // },
  {
    path: "/404",
    component: () => import("@/views/errorPage/404"),
    hidden: true
  },
  {
    path: "/401",
    component: () => import("@/views/errorPage/401"),
    hidden: true
  },
  {
    path: "/user",
    component: Layout,
    redirect: "/user/index",
    name: "users",
    children: [
      {
        path: "/user/index",
        component: () => import("@/views/user/list"),
        name: "users.list",
        meta: { title: "users.list.title", icon: "dashboard", noCache: true }
      },
      {
        path: "/user/registry",
        component: () => import("@/views/user/registry"),
        name: "users.registry",
        meta: { title: "users.registry.title", icon: "dashboard", noCache: true }
      }
    ]
  }
]

export default new Router({
  mode: "history",
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRouterMap
})
