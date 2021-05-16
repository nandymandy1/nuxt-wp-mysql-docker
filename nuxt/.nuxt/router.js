import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _7f144dfc = () => interopDefault(import('../pages/blogs.vue' /* webpackChunkName: "pages/blogs" */))
const _02bdd5ad = () => interopDefault(import('../pages/blogs/_id.vue' /* webpackChunkName: "pages/blogs/_id" */))
const _784e76a4 = () => interopDefault(import('../pages/page.vue' /* webpackChunkName: "pages/page" */))
const _7e2b0b59 = () => interopDefault(import('../pages/page/_id.vue' /* webpackChunkName: "pages/page/_id" */))
const _550f7443 = () => interopDefault(import('../pages/index.vue' /* webpackChunkName: "pages/index" */))

const emptyFn = () => {}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: '/',
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/blogs",
    component: _7f144dfc,
    name: "blogs",
    children: [{
      path: ":id?",
      component: _02bdd5ad,
      name: "blogs-id"
    }]
  }, {
    path: "/page",
    component: _784e76a4,
    name: "page",
    children: [{
      path: ":id?",
      component: _7e2b0b59,
      name: "page-id"
    }]
  }, {
    path: "/",
    component: _550f7443,
    name: "index"
  }],

  fallback: false
}

export function createRouter (ssrContext, config) {
  const base = (config.app && config.app.basePath) || routerOptions.base
  const router = new Router({ ...routerOptions, base  })

  // TODO: remove in Nuxt 3
  const originalPush = router.push
  router.push = function push (location, onComplete = emptyFn, onAbort) {
    return originalPush.call(this, location, onComplete, onAbort)
  }

  const resolve = router.resolve.bind(router)
  router.resolve = (to, current, append) => {
    if (typeof to === 'string') {
      to = normalizeURL(to)
    }
    return resolve(to, current, append)
  }

  return router
}
