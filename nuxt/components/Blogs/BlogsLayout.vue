<template>
  <div class="blogs">
    <div class="row" v-for="(blogChunk, i) in blogChunks" :key="i">
      <div class="col-md-12 col-sm-12">
        <BlogItem1 :blog="blogChunk[0]" />
      </div>
      <div
        v-if="blogChunk.length > 1"
        class="outright-spacer mx-auto mb-5 mt-1"
      />
      <div class="col-md-6 col-sm-12" v-if="blogChunk.length > 1">
        <BlogItem2 :blog="blogChunk[1]" />
      </div>
      <div class="col-md-6 col-sm-12" v-if="blogChunk.length > 2">
        <BlogItem2 :blog="blogChunk[2]" />
      </div>
      <div class="outright-spacer mx-auto my-5" />
      <div class="col-md-4 col-sm-12">
        <BlogItem3 :blog="blogChunk[3]" v-if="blogChunk.length > 3" />
      </div>
      <div class="col-md-4 col-sm-12">
        <BlogItem3 :blog="blogChunk[4]" v-if="blogChunk.length > 4" />
      </div>
      <div class="col-md-4 col-sm-12">
        <BlogItem3 :blog="blogChunk[5]" v-if="blogChunk.length > 5" />
      </div>
      <div class="outright-spacer mx-auto my-5" v-if="blogChunk.length > 3" />
    </div>
  </div>
</template>


<script>
import BlogItem1 from "./BlogItem1";
import BlogItem2 from "./BlogItem2";
import BlogItem3 from "./BlogItem3";
export default {
  name: "blogsLayout",
  props: {
    blogs: {
      type: Array,
      required: true,
    },
  },
  data: () => ({
    blogChunks: null,
  }),
  methods: {
    chunkBlogs(chunk_size) {
      let index = 0;
      let arrayLength = this.blogs.length;
      let tempArray = [];
      for (index = 0; index < arrayLength; index += chunk_size) {
        let myChunk = this.blogs.slice(index, index + chunk_size);
        tempArray.push(myChunk);
      }
      this.blogChunks = tempArray;
    },
  },
  mounted() {
    this.chunkBlogs(6);
  },
  watch: {
    blogs() {
      this.chunkBlogs(6);
    },
  },
  components: {
    BlogItem1,
    BlogItem2,
    BlogItem3,
  },
};
</script>
