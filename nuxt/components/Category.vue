<template>
  <div class="row">
    <div class="col-12 d-flex flex-wrap justify-content-between">
      <div
        :key="category.cat_ID"
        v-for="category in categories"
        :class="[
          'category-tab mt-2 d-flex justify-content-center align-items-center',
          value == category.slug ? 'category-tab-active' : '',
        ]"
        @click="switchCategory(category.slug)"
      >
        <div v-html="category.name" />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Category",
  props: {
    categories: {
      type: Array,
      required: true,
    },
    value: {
      type: String,
      required: true,
    },
  },
  methods: {
    switchCategory(category) {
      this.$emit("input", category);
    },
  },
};
</script>