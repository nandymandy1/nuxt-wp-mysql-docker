<template>
  <div class="footer py-5 px-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 col-sm-12">
          <div class="d-flex flex-column">
            <p>About</p>
            <p class="mt-1">
              Outright features writing that puts focus on supporting customers
              better in a changing world. We do this with pieces that explore
              emerging trends and examine them against prevalent notions of
              customer service. All to help business leaders shape
              customer-centric visions and aspirations.
            </p>
            <p>Submissions</p>
            <p class="mt-1">
              We accept essays and op-eds on all topics relevant to those in
              customer leadership roles. To share your pitch, write to
              <a href="mailto:outright@freshworks.com" target="_blank">
                outright@freshworks.com
              </a>
            </p>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 d-flex">
          <div
            class="d-flex flex-column ml-5"
            :style="{ fontSize: '16px', alignItems: 'center' }"
          >
            <p :style="{ fontSize: '16px' }">Connect</p>
            <p class="d-flex align-items-center">
              <fa :icon="['fab', 'twitter']" />
              <a
                href="https://twitter.com/freshdesk"
                target="_blank"
                class="ml-2 social-links"
              >
                @freshdesk
              </a>
            </p>
            <p class="d-flex align-items-center">
              <fa :icon="['fab', 'linkedin-in']" />
              <a
                href="https://www.linkedin.com/showcase/freshdesk/"
                target="_blank"
                class="ml-2 social-links"
              >
                @freshdesk
              </a>
            </p>
          </div>
        </div>
        <div
          class="col-md-4 col-sm-12 d-flex justify-content-center flex-column"
        >
          <a
            class="footer-link mb-3"
            :style="{ fontSize: '16px' }"
            href="https://www.freshworks.com/privacy/"
          >
            Privacy
          </a>
          <form
            class="d-flex"
            @submit.prevent="signup"
            :style="{ width: '100%' }"
          >
            <div class="d-flex">
              <input
                type="email"
                v-model="email"
                placeholder="Your Email"
                class="form-control newsletter-input"
              />
              <button type="submit" class="btn btn-dark newsletter-btn">
                Submit
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "appFooter",
  data: () => ({
    email: "",
  }),
  methods: {
    async signup() {
      if (!this.email) {
        // set feed back message
        return;
      }
      let formData = new FormData();
      formData.append("your-email", this.email);
      let { data } = await this.$axios.post(
        `/contact-form-7/v1/contact-forms/5/feedback`,
        formData
      );
      console.log("DATA", data);
    },
  },
};
</script>
