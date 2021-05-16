<template>
  <!-- <div class="footer py-5 px-5">
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
  </div> -->
  <!-- <div class="footer">
    <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-6 col-sm-12 mx-auto">
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
  </div> -->
  <div class="footer-dark">
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-md-4 item">
                        <h3>Connect</h3>
                        <ul>
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
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-4 item text">
                        <h3>About</h3>
                        <p>
                          Outright is a place for perspective-rich writing on supporting customers better in a changing world. We do this by dismantling set notions and reasoning from first principles. 
                        </p>
                    </div>
                    <div class="col-md-4 item text">
                        <h3>Submissions</h3>
                       <p>We accept essays and op-eds on all topics relevant to those in
                        customer leadership roles. To share your pitch, write to
                        <a href="mailto:outright@freshworks.com" target="_blank">
                          outright@freshworks.com
                        </a></p>
                    </div>
                    <div class="col-md-6 col-sm-12 item social d-flex justify-content-center align-items-center mx-auto">
                      <form
                        class="d-flex"
                        @submit.prevent="signup"
                      >
                        <div class="d-flex">
                          <input
                            type="email"
                            v-model="email"
                            placeholder="Your Email"
                            class="form-control newsletter-input felx-grow-1"
                          />
                          <button type="submit" class="btn btn-dark newsletter-btn">
                            Submit
                          </button>
                        </div>
                      </form>
                    </div>
                </div>
                <div class="copyright d-flex justify-content-center align-items-center">
                  <p>
                    Freshworks &copy; {{ new Date().getFullYear() }} | <a href="https://www.freshworks.com/privacy/" target="_blank">Privacy</a>
                  </p>
                </div>
            </div>
        </footer>
        <b-modal v-model="modalOpen" centered hide-header hide-footer>
          <Notification  :success="success" :message="message" />
        </b-modal>
    </div>
</template>

<script>
import Notification from './Modals/Notification';
export default {
  name: "appFooter",
  data: () => ({
    email: "",
    message: "",
    success: false,
    modalOpen: false,
  }),
  components:{
    Notification
  },
  methods: {
    async signup() {
      try{
        if (!this.email) {
        // set feed back message
        this.setModalStates('Email is required.', false);
        return;
        }
        let formData = new FormData();
        formData.append("your-email", this.email);
        let { data } = await this.$axios.post(
          `/contact-form-7/v1/contact-forms/5/feedback`,
          formData
        );
        console.log("DATA", data);
        this.setModalStates('You have successfully signed up for the newletter.', true);
      } catch (err) {
        this.setModalStates('Unable to sign you up for the newsletter.', false);
      } finally {
        this.closeModal();
      }
    },
    setModalStates(message, success) {
      this.message = message;
      this.success = success;
      this.modalOpen = true;
    },
    closeModal() {
      setTimeout(() => {
        this.modalOpen = false;
        this.message = "";
        this.success = false;
      }, 5000);
    },
  },
};
</script>
