<template>
  <div class="outright-blogs container">
    <bSkeletonWrapper :loading="category_loading">
      <template #loading>
        <CategoryLoader />
      </template>
      <Category
        v-if="!category_loading"
        :categories="categories"
        v-model="activeCategory"
      />
    </bSkeletonWrapper>
    <div class="my-5" v-if="posts.length">
      <BlogsLayout v-if="activeCategory === 'all'" :blogs="posts" />
      <BlogsCategoryLayout v-else :blogs="posts" />
    </div>
  </div>
</template>

<script>
import Category from "@/components/Category";
import BlogsLayout from "@/components/Blogs/BlogsLayout";
import CategoryLoader from "@/components/CategoryLoader";
import BlogsCategoryLayout from "@/components/Blogs/BlogsCategoryLayout";
export default {
  data: () => ({
    posts: [],
    categories: [],
    currentPage: 1,
    total_posts: 1,
    total_pages: null,
    activeCategory: "",
    posts_loading: false,
    category_loading: false,
  }),

  components: {
    Category,
    BlogsLayout,
    CategoryLoader,
    BlogsCategoryLayout,
  },

  methods: {
    async getCategories() {
      this.category_loading = true;
      let { data } = await this.$axios.get(`outright/v1/categories`);
      this.categories = [{ cat_ID: 0, slug: "all", name: "All" }, ...data];
      this.activeCategory = "all";
      this.category_loading = false;
    },

    async getPostsBycategory() {
      this.posts_loading = true;
      let { data } = await this.$axios.get(
        `outright/v1/category-posts/${this.activeCategory}?page=${this.currentPage}`
      );
      this.posts = data.posts.reverse();
      this.total_pages = data.pages;
      this.total_posts = data.total_posts;
      this.posts_loading = false;
    },
  },

  watch: {
    activeCategory() {
      this.currentPage = 1;
      this.getPostsBycategory();
    },
    currentPage() {
      if (this.currentPage !== 1) {
        this.getPostsBycategory();
      }
    },
  },

  async mounted() {
    await this.getCategories();
  },
};
</script>
