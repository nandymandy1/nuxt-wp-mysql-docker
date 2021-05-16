<template>
  <div class="notification d-flex flex-column align-items-center justify-content-center py-5">
    <b-img 
      class="img-fluid mb-3"
      :style="{ height: `75px` }" 
      :src="success ? 
        require('@/assets/icons/check.png') : 
        require(`@/assets/icons/close.png`)
      "
    />
    <p class="lead text-center">{{message}}</p>
  </div>
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
