<template>
  <div class="comments">
    <CommentForm :postID="postID" />
    <h5 class="comments-heading">Comments ({{ comments.length }})</h5>
    <CommentItem
      v-for="comment in currentComment"
      :comment="comment"
      :key="comment.id"
    />
    <div class="row mt-3" v-if="comments.length && comments.length > 4">
      <div class="col-sm-12 col-md-6">
        <button
          @click="commentsAction"
          class="btn btn-secondary-outline"
          v-if="currentComment.length < comments.length"
        >
          Read More Comments
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import CommentForm from "./CommentForm";
import CommentItem from "./CommentItem";
export default {
  name: "Comments",
  components: {
    CommentForm,
    CommentItem,
  },
  props: {
    comments: {
      type: Array,
      required: true,
    },
    postID: {
      type: Number,
      required: true,
    },
  },
  data: () => ({
    commentIndex: 0,
    currentComment: [],
  }),
  methods: {
    commentsAction() {
      this.commentIndex = this.commentIndex + 4;
      this.currentComment = this.comments.slice(0, this.commentIndex);
    },
  },
  created() {
    this.commentsAction();
  },
};
</script>
