<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-12">
          <Loader v-if="loading" />
          <div
            v-if="!loading && post"
            class="d-flex justify-content-center flex-column"
          >
            <b-img
              v-if="post.featured_img"
              :src="post.featured_img"
              :alt="`outright-${post.slug}`"
            />
            <p class="blog-date mt-3">{{ post.date }}</p>
            <h6 class="subcategory-name">
              {{ post.categories[0] }}
            </h6>
            <PostHeader :post="post" @post-liked="postLiked" />
            <div class="post-subtitle mt-3 mb-1" v-if="post.subtitle">
              <p class="text-muted">{{ post.subtitle }}</p>
            </div>
            <div class="my-1" v-else />
            <div class="blog-content" v-html="post.content" />
          </div>
        </div>
        <div class="col-md-4 col-sm-12 pl-md-5">
          <Author v-if="post" :author="post.author" />
          <Sidebar :recentPosts="recentPosts" />
        </div>
      </div>
      <div class="row" v-if="post">
        <div class="col-sm-12 col-md-8">
          <Comments :comments="post.comments" :postID="post.id" />
        </div>
      </div>
    </div>
    <section class="bg-expert py-5 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <AskExpert />
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Loader from "@/components/Loader";
import Author from "@/components/Author";
import Sidebar from "@/components/Sidebar";
import AskExpert from "@/components/AskExpert";
import PostHeader from "@/components/PostHeader";
import Comments from "@/components/Comments/Comments";

export default {
  components: {
    Loader,
    Author,
    Sidebar,
    Comments,
    AskExpert,
    PostHeader,
  },
  data: () => ({
    // post: null,
    // loading: false,
    recentPosts: [],
  }),
  head() {
    return {
      title: this.post ? `${this.post.meta.title} | Outright` : "Outright",
      meta: this.post?.meta
        ? [
            {
              hid: "description",
              name: "description",
              content: this.post.meta?.metadesc,
            },
            {
              hid: "twitter:title",
              name: "twitter:title",
              content: this.post.meta?.twitter_title,
            },
            {
              hid: "twitter:image",
              name: "twitter:image",
              content: this.post.meta?.twitter_image,
            },
            {
              hid: "twitter:description",
              name: "twitter:description",
              content: this.post.meta?.twitter_description,
            },
            {
              hid: "og:title",
              property: "og:title",
              content: this.post.meta?.fb_title,
            },
            {
              hid: "og:description",
              property: "og:description",
              content: this.post.meta?.fb_description,
            },
            {
              hid: "og:image",
              property: "og:image",
              content: this.post.meta?.fb_image,
            },
            {
              hid: "twitter:card",
              property: "twitter:card",
              content: "summary_large_image",
            },
          ]
        : [],
    };
  },

  async asyncData({ $axios, params }) {
    try {
      let { data } = await $axios.get(`/outright/v1/posts/${params.id}`);
      let post = data;
      let loading = false;

      let res = await $axios.get("/outright/v1/posts-recent");
      data = res.data.filter((post) => post.slug !== params.id);
      let recentPosts = data;
      return {
        post,
        loading,
        recentPosts,
      };
    } catch (err) {
      // console.log("DATA", err);
    }
  },

  methods: {
    async getRecentPosts() {
      let { data } = await this.$axios.get("/outright/v1/posts-recent");
      data = data.filter((post) => post.slug !== this.$route.params.id);
      this.recentPosts = data;
    },
    postLiked() {
      let likedPosts = JSON.parse(localStorage.getItem("likedPosts")) || [];
      if (likedPosts.includes(this.post.id)) {
        return;
      }
      likedPosts.push(this.post.id);
      this.post.likes = this.post.likes + 1;
      localStorage.setItem("likedPosts", JSON.stringify(likedPosts));
    },
  },
  mounted() {
    if (process.client) {
      this.getRecentPosts();
    }
  },
};
</script>
