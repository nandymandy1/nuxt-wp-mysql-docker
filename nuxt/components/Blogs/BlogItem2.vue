<template>
  <NuxtLink class="blog-item-link" :to="`/blogs/${blog.slug}`">
  <div class="blog-item-2 d-flex flex-column">
    <NuxtLink :to="`/blogs/${blog.slug}`">
      <b-img
        class="img-fluid mb-2"
        v-if="blog.featured_img"
        :src="blog.featured_img"
        :alt="`outright-${blog.title}`"
      />
    </NuxtLink>
    <h4 class="blog-date my-3">{{ blog.date }}</h4>
    <h6 :class="`subcategory-name-${blog.categories[0]}`">{{ blog.categories[0] }}</h6>
    <h3 class="blog-title mb-3">{{ blog.title }}</h3>
    <p>{{ blog.excerpt ? `${blog.excerpt.substring(0, 200)}` : "" }}</p>
    <div>
      <NuxtLink :to="`/blogs/${blog.slug}`" class="blog-link">
        Read More
      </NuxtLink>
    </div>
  </div>
  </NuxtLink>
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
