<template>
  <a
    :href="link"
    rel="noopener"
    target="_blank"
    :class="['social-links', social]"
  >
    <fa :icon="['fab', icon]" />
  </a>
</template>

<script>
export default {
  naem: "socialShareLinks",
  props: {
    icon: {
      type: String,
      required: true,
    },
    link: {
      type: String,
      required: true,
    },
    social: {
      type: String,
      required: true,
    },
  },
};
</script>
