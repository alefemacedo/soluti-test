import Vue from "vue"
import Router from "vue-router"
import Layout from "@/views/layout"

Vue.use(Router)

/**
 * Rotas da aplicação
 */
export const constantRouterMap = [
  {
    path: "",
    component: Layout,
    redirect: "dashboard",
    children: [
      {
        path: "dashboard",
        component: () => import("@/views/dashboard/index"),
        name: "dashboard"
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
        name: "login.form"
      },
      {
        path: "/login/user-registry",
        component: () => import("@/views/login/user-registry"),
        name: "login.user.registry"
      }
    ]
  },
  { 
    path: "*",
    redirect: "/404",
    hidden: true 
  },
  {
    path: "/404",
    component: () => import("@/views/errorPage/404"),
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
        name: "users.list"
      },
      {
        path: "/user/registry",
        component: () => import("@/views/user/registry"),
        name: "users.registry"
      },
      {
        path: "/user/profile",
        component: () => import("@/views/user/profile"),
        name: "users.profile"
      }
    ]
  },
  {
    path: "/company",
    component: Layout,
    redirect: "/company/index",
    name: "companies",
    children: [
      {
        path: "/company/index",
        component: () => import("@/views/company/list"),
        name: "companies.list"
      },
      {
        path: "/company/create",
        component: () => import("@/views/company/form"),
        name: "companies.create"
      },
      {
        path: "/company/edit/:companyId",
        props: true,
        component: () => import("@/views/company/form"),
        name: "companies.edit"
      }
    ]
  },
  {
    path: "/contract",
    component: Layout,
    redirect: "/contract/index",
    name: "contracts",
    children: [
      {
        path: "/contract/index",
        component: () => import("@/views/contract/list"),
        name: "contracts.list"
      },
      {
        path: "/contract/create",
        component: () => import("@/views/contract/create"),
        name: "contracts.create"
      },
      {
        path: "/contract/show/:contractId",
        props: true,
        component: () => import("@/views/contract/show"),
        name: "contracts.show"
      }
    ]
  }
]

export default new Router({
  mode: "history",
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRouterMap
})
