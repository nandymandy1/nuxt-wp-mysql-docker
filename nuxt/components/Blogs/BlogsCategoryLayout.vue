<template>
  <div class="blog-category-layout">
    <BlogItem1 v-for="blog in blogs" :key="blog.id" :blog="blog" />
  </div>
</template>

<script>
import BlogItem1 from "./BlogItem1";
export default {
  name: "BlogCategoryLayout",
  props: {
    blogs: {
      type: Array,
      required: true,
    },
  },
  components: {
    BlogItem1,
  },
};
</script>
