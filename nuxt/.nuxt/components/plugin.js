import Vue from 'vue'
import { wrapFunctional } from './index'

const components = {
  AskExpert: () => import('../../components/AskExpert.vue' /* webpackChunkName: "components/ask-expert" */).then(c => wrapFunctional(c.default || c)),
  Author: () => import('../../components/Author.vue' /* webpackChunkName: "components/author" */).then(c => wrapFunctional(c.default || c)),
  Category: () => import('../../components/Category.vue' /* webpackChunkName: "components/category" */).then(c => wrapFunctional(c.default || c)),
  CategoryLoader: () => import('../../components/CategoryLoader.vue' /* webpackChunkName: "components/category-loader" */).then(c => wrapFunctional(c.default || c)),
  Footer: () => import('../../components/Footer.vue' /* webpackChunkName: "components/footer" */).then(c => wrapFunctional(c.default || c)),
  Loader: () => import('../../components/Loader.vue' /* webpackChunkName: "components/loader" */).then(c => wrapFunctional(c.default || c)),
  Navbar: () => import('../../components/Navbar.vue' /* webpackChunkName: "components/navbar" */).then(c => wrapFunctional(c.default || c)),
  PostHeader: () => import('../../components/PostHeader.vue' /* webpackChunkName: "components/post-header" */).then(c => wrapFunctional(c.default || c)),
  Sidebar: () => import('../../components/Sidebar.vue' /* webpackChunkName: "components/sidebar" */).then(c => wrapFunctional(c.default || c)),
  SocialIconLinks: () => import('../../components/SocialIconLinks.vue' /* webpackChunkName: "components/social-icon-links" */).then(c => wrapFunctional(c.default || c)),
  BlogsBlogItem1: () => import('../../components/Blogs/BlogItem1.vue' /* webpackChunkName: "components/blogs-blog-item1" */).then(c => wrapFunctional(c.default || c)),
  BlogsBlogItem2: () => import('../../components/Blogs/BlogItem2.vue' /* webpackChunkName: "components/blogs-blog-item2" */).then(c => wrapFunctional(c.default || c)),
  BlogsBlogItem3: () => import('../../components/Blogs/BlogItem3.vue' /* webpackChunkName: "components/blogs-blog-item3" */).then(c => wrapFunctional(c.default || c)),
  BlogsCategoryLayout: () => import('../../components/Blogs/BlogsCategoryLayout.vue' /* webpackChunkName: "components/blogs-category-layout" */).then(c => wrapFunctional(c.default || c)),
  BlogsLayout: () => import('../../components/Blogs/BlogsLayout.vue' /* webpackChunkName: "components/blogs-layout" */).then(c => wrapFunctional(c.default || c)),
  CommentsCommentForm: () => import('../../components/Comments/CommentForm.vue' /* webpackChunkName: "components/comments-comment-form" */).then(c => wrapFunctional(c.default || c)),
  CommentsCommentItem: () => import('../../components/Comments/CommentItem.vue' /* webpackChunkName: "components/comments-comment-item" */).then(c => wrapFunctional(c.default || c)),
  Comments: () => import('../../components/Comments/Comments.vue' /* webpackChunkName: "components/comments" */).then(c => wrapFunctional(c.default || c)),
  ModalsNotification: () => import('../../components/Modals/Notification.vue' /* webpackChunkName: "components/modals-notification" */).then(c => wrapFunctional(c.default || c)),
  ModalsShare: () => import('../../components/Modals/Share.vue' /* webpackChunkName: "components/modals-share" */).then(c => wrapFunctional(c.default || c))
}

for (const name in components) {
  Vue.component(name, components[name])
  Vue.component('Lazy' + name, components[name])
}
