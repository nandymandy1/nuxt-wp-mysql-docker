<template>
  <div class="comment-form my-5">
    <h2 class="post-title">Comment</h2>
    <form
      class="comment-form-container mt-4 py-3 px-3"
      @submit.prevent="postComment"
    >
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="form-group">
            <label for="name" class="label-bold">Name</label>
            <input
              id="name"
              type="text"
              name="name"
              v-model="req.name"
              class="form-control"
              placeholder="Your Name"
            />
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="form-group">
            <label for="email" class="label-bold">Email</label>
            <input
              id="email"
              type="email"
              name="email"
              v-model="req.email"
              class="form-control"
              placeholder="Your Email"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="form-group">
            <label for="comment" class="label-bold">Comment</label>
            <textarea
              placeholder="Your Comment"
              class="form-control"
              name="comment"
              id="comment"
              cols="30"
              rows="5"
              v-model="req.comment"
            ></textarea>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-6 ml-auto">
          <button
            class="btn btn-dark btn-block comment-btn"
            :disabled="postingComment"
          >
            Submit a comment
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "CommentForm",
  data: () => ({
    req: {
      name: "",
      email: "",
      comment: "",
    },
    postingComment: false,
  }),
  props: {
    postID: {
      type: Number,
      required: true,
    },
  },
  methods: {
    async postComment() {
      this.postingComment = true;
      try {
        console.log("DATA", this.req);
        let { data } = await this.$axios.post(
          `/outright/v1/comment/${this.postID}`,
          this.req
        );
        this.req = {
          name: "",
          email: "",
          comment: "",
        };
      } catch (err) {}
      this.postingComment = false;
    },
  },
};
</script>
