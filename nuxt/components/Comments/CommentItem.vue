<template>
  <div class="comments-item py-4">
    {{ comment.comment }}
    <div class="blockquote-footer mt-2">
      by <cite :title="comment.name">{{ comment.name }}</cite> on
      {{ comment.date }}
    </div>
  </div>
</template>

<script>
export default {
  name: "CommentItem",
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },
};
</script>