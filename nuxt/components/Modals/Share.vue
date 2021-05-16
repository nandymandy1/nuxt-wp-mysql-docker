<template>
  <div class="share">
    <div class="d-flex">
      <p class="post-link">{{ link }}</p>
      <input type="hidden" :value="link" id="link-input" />
      <button
        @click="copyLink"
        class="btn btn-light"
        :style="{ height: '68px' }"
      >
        Copy
      </button>
    </div>
    <div class="d-flex justify-content-center align-items-center">
      <SocialButton 
        icon="twitter"
        social="twitter"
        :link="`http://www.twitter.com/share?url=${link}`" 
      />
      <SocialButton 
        icon="facebook" 
        social="facebook" 
        :link="`https://www.facebook.com/sharer/sharer.php?u=${link}`" 
      />
      <SocialButton 
        icon="linkedin-in" 
        social="linkedin" 
        :link="`https://www.linkedin.com/sharing/share-offsite/?url=${link}`" 
      />
    </div>
  </div>
</template>

<script>
import SocialButton from '../SocialIconLinks';
export default {
  name: "shareModal",
  components:{
    SocialButton
  },
  computed: {
    link() {
      return window.location.href;
    },
  },
  methods: {
    copyLink() {
      let copyText = document.getElementById("link-input");
      copyText.setAttribute("type", "text");
      copyText.select();
      document.execCommand("copy");
      copyText.setAttribute("type", "hidden");
    },
  },
};
</script>
