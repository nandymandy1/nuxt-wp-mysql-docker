<template>
  <NuxtLink class="blog-item-link" :to="`/blogs/${blog.slug}`">
  <div class="row mt-5 mb-5">
    <div class="col-md-6 col-sm-12 pb-sm-3 pb-xs-2">
      <NuxtLink :to="`/blogs/${blog.slug}`">
        <img
          class="img-fluid"
          v-if="blog.featured_img"
          :src="blog.featured_img"
          :alt="`outright-${blog.title}`"
        />
      </NuxtLink>
    </div>
    <div class="col-md-6 col-sm-12">
      <div class="d-flex flex-column h-100">
        <div class="divider" />
        <h4 class="blog-date my-2">{{ blog.date }}</h4>
        <h2 class="blog-title my-3">{{ blog.title }}</h2>
        <h6 :class="`subcategory-name-${blog.categories[0]}`">{{ blog.categories[0] }}</h6>
        <p>{{ blog.excerpt ? `${blog.excerpt.substring(0, 200)}` : "" }}</p>
        <div>
          <NuxtLink :to="`/blogs/${blog.slug}`" class="blog-link">
            Read More
          </NuxtLink>
        </div>
      </div>
    </div>
  </div>
    </NuxtLink>
</template>

<script>
export default {
  name: "blogItem1",
  props: {
    blog: {
      type: Object,
      required: true,
    },
  },
};
</script>
