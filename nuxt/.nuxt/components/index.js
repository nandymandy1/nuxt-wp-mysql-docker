export { default as AskExpert } from '../../components/AskExpert.vue'
export { default as Author } from '../../components/Author.vue'
export { default as Category } from '../../components/Category.vue'
export { default as CategoryLoader } from '../../components/CategoryLoader.vue'
export { default as Footer } from '../../components/Footer.vue'
export { default as Loader } from '../../components/Loader.vue'
export { default as Navbar } from '../../components/Navbar.vue'
export { default as PostHeader } from '../../components/PostHeader.vue'
export { default as Sidebar } from '../../components/Sidebar.vue'
export { default as BlogsBlogItem1 } from '../../components/Blogs/BlogItem1.vue'
export { default as BlogsBlogItem2 } from '../../components/Blogs/BlogItem2.vue'
export { default as BlogsBlogItem3 } from '../../components/Blogs/BlogItem3.vue'
export { default as BlogsCategoryLayout } from '../../components/Blogs/BlogsCategoryLayout.vue'
export { default as BlogsLayout } from '../../components/Blogs/BlogsLayout.vue'
export { default as CommentsCommentForm } from '../../components/Comments/CommentForm.vue'
export { default as CommentsCommentItem } from '../../components/Comments/CommentItem.vue'
export { default as Comments } from '../../components/Comments/Comments.vue'
export { default as ModalsNotification } from '../../components/Modals/Notification.vue'
export { default as ModalsShare } from '../../components/Modals/Share.vue'

export const LazyAskExpert = import('../../components/AskExpert.vue' /* webpackChunkName: "components/ask-expert" */).then(c => wrapFunctional(c.default || c))
export const LazyAuthor = import('../../components/Author.vue' /* webpackChunkName: "components/author" */).then(c => wrapFunctional(c.default || c))
export const LazyCategory = import('../../components/Category.vue' /* webpackChunkName: "components/category" */).then(c => wrapFunctional(c.default || c))
export const LazyCategoryLoader = import('../../components/CategoryLoader.vue' /* webpackChunkName: "components/category-loader" */).then(c => wrapFunctional(c.default || c))
export const LazyFooter = import('../../components/Footer.vue' /* webpackChunkName: "components/footer" */).then(c => wrapFunctional(c.default || c))
export const LazyLoader = import('../../components/Loader.vue' /* webpackChunkName: "components/loader" */).then(c => wrapFunctional(c.default || c))
export const LazyNavbar = import('../../components/Navbar.vue' /* webpackChunkName: "components/navbar" */).then(c => wrapFunctional(c.default || c))
export const LazyPostHeader = import('../../components/PostHeader.vue' /* webpackChunkName: "components/post-header" */).then(c => wrapFunctional(c.default || c))
export const LazySidebar = import('../../components/Sidebar.vue' /* webpackChunkName: "components/sidebar" */).then(c => wrapFunctional(c.default || c))
export const LazyBlogsBlogItem1 = import('../../components/Blogs/BlogItem1.vue' /* webpackChunkName: "components/blogs-blog-item1" */).then(c => wrapFunctional(c.default || c))
export const LazyBlogsBlogItem2 = import('../../components/Blogs/BlogItem2.vue' /* webpackChunkName: "components/blogs-blog-item2" */).then(c => wrapFunctional(c.default || c))
export const LazyBlogsBlogItem3 = import('../../components/Blogs/BlogItem3.vue' /* webpackChunkName: "components/blogs-blog-item3" */).then(c => wrapFunctional(c.default || c))
export const LazyBlogsCategoryLayout = import('../../components/Blogs/BlogsCategoryLayout.vue' /* webpackChunkName: "components/blogs-category-layout" */).then(c => wrapFunctional(c.default || c))
export const LazyBlogsLayout = import('../../components/Blogs/BlogsLayout.vue' /* webpackChunkName: "components/blogs-layout" */).then(c => wrapFunctional(c.default || c))
export const LazyCommentsCommentForm = import('../../components/Comments/CommentForm.vue' /* webpackChunkName: "components/comments-comment-form" */).then(c => wrapFunctional(c.default || c))
export const LazyCommentsCommentItem = import('../../components/Comments/CommentItem.vue' /* webpackChunkName: "components/comments-comment-item" */).then(c => wrapFunctional(c.default || c))
export const LazyComments = import('../../components/Comments/Comments.vue' /* webpackChunkName: "components/comments" */).then(c => wrapFunctional(c.default || c))
export const LazyModalsNotification = import('../../components/Modals/Notification.vue' /* webpackChunkName: "components/modals-notification" */).then(c => wrapFunctional(c.default || c))
export const LazyModalsShare = import('../../components/Modals/Share.vue' /* webpackChunkName: "components/modals-share" */).then(c => wrapFunctional(c.default || c))

// nuxt/nuxt.js#8607
export function wrapFunctional(options) {
  if (!options || !options.functional) {
    return options
  }

  const propKeys = Array.isArray(options.props) ? options.props : Object.keys(options.props || {})

  return {
    render(h) {
      const attrs = {}
      const props = {}

      for (const key in this.$attrs) {
        if (propKeys.includes(key)) {
          props[key] = this.$attrs[key]
        } else {
          attrs[key] = this.$attrs[key]
        }
      }

      return h(options, {
        on: this.$listeners,
        attrs,
        props,
        scopedSlots: this.$scopedSlots,
      }, this.$slots.default)
    }
  }
}
