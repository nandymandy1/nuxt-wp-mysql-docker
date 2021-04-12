<template>
  <div
    class="d-flex flex-column justify-content-between"
    :style="{ height: '100vh' }"
  >
    <Navbar />
    <div class="flex-grow-1">
      <Nuxt />
    </div>
    <Footer />
  </div>
</template>

<script>
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
export default {
  name: "layout",
  components: {
    Navbar,
    Footer,
  },
};
</script>
