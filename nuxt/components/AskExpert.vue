<template>
  <div class="ask-expert">
    <h2 class="text-center">Ask an expert</h2>
    <p class="text-center">
      Have a question related to this story? Or a thought you’d like an expert
      to weigh in on? Write to us.
    </p>
    <div class="row mt-5">
      <div class="col-12">
        <textarea
          placeholder="submit a question..."
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
          class="form-control py-4 flex-grow-1"
        />
        <button class="ml-3 btn btn-secondary-outline btn-block flex-grow-1">
          Submit
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "askExpert",
};
</script>
