<template>
  <div class="notification"></div>
</template>

<script>
export default {
  name: "notificationModal",
  props: {
    message: {
      type: String,
      required: true,
    },
    success: {
      type: Boolean,
      required: true,
    },
  },
};
</script>
