<template>
  <div class="blog-item-3 d-flex flex-column">
    <NuxtLink class="blog-link-3" :to="`/blogs/${blog.slug}`">
      <div class="divider" />
      <h4 class="blog-date my-3">{{ blog.date }}</h4>
      <h6 :class="`subcategory-name-${blog.categories[0]}`">{{ blog.categories[0] }}</h6>
      <h4 class="blog-title mb-3">{{ blog.title }}</h4>
      <p>{{ blog.excerpt ? `${blog.excerpt.substring(0, 200)}` : "" }}</p>
      <div>
        <NuxtLink :to="`/blogs/${blog.slug}`" class="blog-link">
          Read More
        </NuxtLink>
      </div>
    </NuxtLink>
  </div>
</template>

<script>
export default {
  name: "blogItem2",
  props: {
    blog: {
      type: Object,
      required: true,
    },
  },
};
</script>
