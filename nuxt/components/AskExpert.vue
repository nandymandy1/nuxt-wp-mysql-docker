<template>
  <div class="ask-expert">
    <h2 class="text-center">Ask an expert</h2>
    <p class="text-center">
      Have a question related to this story? Or a thought you’d like an expert
      to weigh in on? Write to us.
    </p>
    <form @submit.prevent="submitQuery" class="row mt-5">
      <div class="col-12">
        <textarea
          placeholder="submit a question..."
          v-model="questionThing.question"
          class="form-control py-2"
          name="question"
          id="question"
          cols="30"
          rows="5"
        ></textarea>
      </div>
      <div class="col-8 mx-auto d-flex mt-4">
        <input
          type="text"
          name="email"
          :style="{ height: '55px' }"
          placeholder="Your Email..."
          v-model="questionThing.email"
          class="form-control py-4 flex-grow-1"
        />
        <button class="ml-3 btn btn-secondary-outline btn-block flex-grow-1">
          Submit
        </button>
      </div>
    </form>
    <b-modal v-model="modalOpen" centered hide-header hide-footer>
      <Notification  :success="success" :message="message" />
    </b-modal>
  </div>
</template>

<script>
import Notification from "@/components/Modals/Notification";
export default {
  name: "askExpert",
  data: () => ({
    questionThing: {
      question: "",
      email: "",
    },
    message: "",
    success: false,
    modalOpen: false,
  }),
  components: {
    Notification,
  },
  methods: {
    async submitQuery() {
      try {
        let { question, email } = this.questionThing;
        let formData = new FormData();
        if (!question.length || !email.length) {
          this.setModalStates(`Your query and email is required.`, false)
          return;
        }
        formData.append("your-question", question);
        formData.append("your-email", email);
        let { data } = await this.$axios.post(
          "/contact-form-7/v1/contact-forms/203/feedback",
          formData
        );
        console.log("DATA", data);
        this.setModalStates(`Your query is submitted successfully.`, true)
        this.questionThing = {
          question: "",
          email: "",
        };
      } catch (err) {
        console.log("ERR", err.response.data);
        this.setModalStates(`Unable to submit your query.`, false)
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
