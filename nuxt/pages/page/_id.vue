<template>
  <div class="page-layout pb-5 container">
    <Loader v-if="loading" />
    <div class="row" v-else>
      <div class="col-12 mx-auto">
        <div
          :style="{ width: '450px' }"
          class="d-flex flex-column justify-content-start mb-5"
        >
          <h1 class="page-title">{{ pageData.title }}</h1>
          <div class="title-underline" />
        </div>
        <div class="page-content px-5" v-html="pageData.content" />
      </div>
    </div>
  </div>
</template>

<script>
import Loader from "@/components/Loader";
export default {
  components: {
    Loader,
  },
  head() {
    return {
      title: this.pageData
        ? `Outright | ${this.pageData.meta.title}`
        : "Outright",
      meta: this.pageData?.meta
        ? [
            {
              hid: "description",
              name: "description",
              content: this.pageData.meta?.metadesc,
            },
            {
              hid: "twitter:title",
              name: "twitter:title",
              content: this.pageData.meta?.twitter_title,
            },
            {
              hid: "twitter:image",
              name: "twitter:image",
              content: this.pageData.meta?.twitter_image,
            },
            {
              hid: "twitter:description",
              name: "twitter:description",
              content: this.pageData.meta?.twitter_description,
            },
            {
              hid: "og:title",
              property: "og:title",
              content: this.pageData.meta?.fb_title,
            },
            {
              hid: "og:description",
              property: "og:description",
              content: this.pageData.meta?.fb_description,
            },
            {
              hid: "og:image",
              property: "og:image",
              content: this.pageData.meta?.fb_image,
            },
            {
              hid: "twitter:card",
              property: "twitter:card",
              content: "summary_large_image",
            },
          ]
        : [],
    };
  },

  async asyncData({ $axios, params }) {
    try {
      let { data } = await $axios.get(`/outright/v1/page/${params.id}`);
      let pageData = data;
      let loading = false;
      // console.log("DATA", data);
      return {
        loading,
        pageData,
      };
    } catch {
      console.log(err);
    }
  },
};
</script>
