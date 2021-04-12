<template>
  <div class="sidebar pt-md-5">
    <h4 class="sidebar-heading mb-5">Read this next</h4>
    <NuxtLink
      :to="`/blogs/${post.slug}`"
      v-for="(post, i) in recentPosts"
      class="recent-posts post-link d-flex mt-1 align-items-center justify-content-start"
      :key="post.id"
    >
      <h2 class="recent-heading align-self-center">
        {{ i > 10 ? "" : "0" }}{{ i + 1 }}
      </h2>
      <p class="ml-3 recent-title align-self-center">
        {{ post.title }}
      </p>
    </NuxtLink>
  </div>
</template>

<script>
export default {
  name: "sidebar",
  props: {
    recentPosts: {
      type: Array,
      required: true,
    },
  },
};
</script>
