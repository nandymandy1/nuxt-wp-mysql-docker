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
    <b-modal v-model="modalOpen" centered hide-header hide-footer>
          <Notification  :success="success" :message="message" />
    </b-modal>
  </div>
</template>

<script>
import Notification from '../Modals/Notification';
export default {
  name: "CommentForm",
  data: () => ({
    req: {
      name: "",
      email: "",
      comment: "",
    },
    postingComment: false,
    message: "",
    success: false,
    modalOpen: false,
  }),
  props: {
    postID: {
      type: Number,
      required: true,
    },
  },
  components:{
    Notification
  },
  methods: {
    async postComment() {
      this.postingComment = true;
      try {
        let {name, email, comment} = this.req;
        if(!name.length || !email.length || !comment.length){
          this.setModalStates('Your name, your email and your comment is required.', false);
          return;
        }
        let { data } = await this.$axios.post(
          `/outright/v1/comment/${this.postID}`,
          this.req
        );
        this.req = {
          name: "",
          email: "",
          comment: "",
        };
        this.setModalStates('Your comment posted successfully.', true);
      } catch (err) {
        this.setModalStates('Unable to post your comment.', false);
      } finally {
        this.closeModal();
        this.postingComment = false;
      }
    },
    setModalStates(message, success) {
      this.message = message;
      this.success = success;
      this.modalOpen = true;
    },
    closeModal() {
      setTimeout(() => {
        this.modalOpen = false;
        this.message = "";
        this.success = false;
      }, 5000);
    },
  },
};
</script>
