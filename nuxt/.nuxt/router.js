import Vue from 'vue'
import Router from 'vue-router'
import { normalizeURL, decode } from 'ufo'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _365fccad = () => interopDefault(import('../pages/blogs.vue' /* webpackChunkName: "pages/blogs" */))
const _74400850 = () => interopDefault(import('../pages/blogs/_id.vue' /* webpackChunkName: "pages/blogs/_id" */))
const _c347a0ba = () => interopDefault(import('../pages/page.vue' /* webpackChunkName: "pages/page" */))
const _4265f3ce = () => interopDefault(import('../pages/page/_id.vue' /* webpackChunkName: "pages/page/_id" */))
const _6a0d3024 = () => interopDefault(import('../pages/index.vue' /* webpackChunkName: "pages/index" */))

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
    component: _365fccad,
    name: "blogs",
    children: [{
      path: ":id?",
      component: _74400850,
      name: "blogs-id"
    }]
  }, {
    path: "/page",
    component: _c347a0ba,
    name: "page",
    children: [{
      path: ":id?",
      component: _4265f3ce,
      name: "page-id"
    }]
  }, {
    path: "/",
    component: _6a0d3024,
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
