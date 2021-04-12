<template>
  <div class="d-flex flex-column flex-wrap">
    <h2 class="post-title mb-0">
      {{ post.title }}
    </h2>
    <div class="blockquote-footer mt-1">
      by <cite :title="post.author.name">{{ post.author.name }}</cite>
    </div>
    <div class="d-flex mt-2">
      <button
        @click="likePost"
        :disabled="alreadyLiked"
        class="btn btn-light d-flex justify-content-center align-items-center"
      >
        <p class="m-0 p-0">
          <b-img
            class="mr-2 align-self-center"
            src="@/assets/icons/likes.png"
          />
          {{ post.likes }} Likes
        </p>
      </button>
      <button
        @click="modalShow = !modalShow"
        class="btn btn-light d-flex justify-content-center align-items-center ml-3"
      >
        <p class="m-0 p-0">
          <b-img
            class="mr-2 align-self-center"
            src="@/assets/icons/share.png"
          />
          Share
        </p>
      </button>
      <b-modal v-model="modalShow" centered>
        <template #modal-header>
          <div class="d-flex">
            <b-img
              class="mr-2 align-self-center"
              src="@/assets/icons/share.png"
            />
            <h4 class="mt-1">Share</h4>
          </div>
        </template>
        <ShareModal :link="post.slug" />
        <template #modal-footer="{ ok }">
          <b-button size="md" variant="dark" @click="ok()"> OK </b-button>
        </template>
      </b-modal>
    </div>
  </div>
</template>

<script>
import ShareModal from "./Modals/Share";
export default {
  name: "postHeader",
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    modalShow: false,
    alreadyLiked: false,
  }),
  components: {
    ShareModal,
  },
  methods: {
    async likePost() {
      this.checkDisabled();
      let { data } = await this.$axios.post(
        `/outright/v1/like-post/${this.post.slug}`
      );
      this.$emit("post-liked");
      this.alreadyLiked = true;
    },
    checkDisabled() {
      let likedPosts = JSON.parse(localStorage.getItem("likedPosts")) || [];
      if (likedPosts.includes(this.post.id)) {
        this.alreadyLiked = true;
      }
    },
  },
  mounted() {
    if (process.client) {
      this.checkDisabled();
    }
  },
};
</script>
