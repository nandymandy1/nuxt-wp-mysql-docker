<template>
  <div class="share">
    <div class="d-flex">
      <p class="post-link">{{ link }}</p>
      <input type="hidden" :value="link" id="link-input" />
      <button
        :style="{ height: '68px' }"
        class="btn btn-light"
        @click="copyLink"
      >
        Copy
      </button>
    </div>
    <div class="d-flex justify-content-center">
      <a
        class="btn btn-primary"
        target="_blank"
        :href="`http://www.twitter.com/share?url=${link}`"
        >Tweet
      </a>
      <a
        class="btn btn-primary"
        :href="`https://www.facebook.com/sharer/sharer.php?u=${link}`"
        target="_blank"
        rel="noopener"
      >
        Fb Share
      </a>
      <a
        class="btn btn-primary"
        :href="`https://www.linkedin.com/sharing/share-offsite/?url=${link}`"
        target="_blank"
        rel="noopener"
      >
        Linked In
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "shareModal",
  computed: {
    link() {
      return window.location.href;
    },
  },
  methods: {
    copyLink() {
      let copyText = document.getElementById("link-input");
      console.log("VALUE", copyText.value);
      copyText.setAttribute("type", "text");
      copyText.select();
      document.execCommand("copy");
      copyText.setAttribute("type", "hidden");
    },
  },
};
</script>
