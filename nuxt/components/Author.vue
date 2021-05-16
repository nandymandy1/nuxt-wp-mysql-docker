<template>
  <div class="d-flex flex-column">
    <div
      class="d-flex justify-content-center align-items-center flex-column"
    >
      <bAvatar variant="info" :src="author.avatar" size="6rem" class="mb-2" />
      <p class="lead text-muted p-0 m-0">{{ author.name }}</p>
    </div>
    <p class="text-center mt-0" :style="{ fontSize: '14px' }">
      {{ author.bio }}
    </p>
  </div>
</template>

<script>
export default {
  name: "Author",
  props: {
    author: {
      type: Object,
      required: true,
    },
  },
};
</script>
