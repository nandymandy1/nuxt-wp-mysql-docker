const api = axios.create({
  baseURL: window.location.origin,
});

const app = Vue.createApp({
  template: `
    <div class="container my-5">
      <div class="row">
        <div class="col-12">
          <h1>Welcome to the Codebook Inc. Doc Explorer.</h1>
          <p>Here, we can explore the docs and the api's provided with this Codebook Site Generator Plugin.</p>
        </div>
        <div class="col-md-6 col-sm-12">
          <CodebookPosts />
        </div>
        <div class="col-md-6 col-sm-12">
          <CodebookTeams />
        </div>
        <div class="col-md-6 col-sm-12">
          <CodebookTestimonials />
        </div>
        <div class="col-md-6 col-sm-12">
          <CodebookBanners />
        </div>
      </div>
    </div>
  `,
});

app.component("CodebookPosts", {
  template: `
  <div class="card" :style="{ borderRadius: '0px !important' }">
    <div class="card-body">
      <h3 class="card-title">Posts Module</h3>
      <p class="card-subtitle">In this module we will explore the Posts Module</p>
      <div class="accordion accordion-flush mt-5" id="postsAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" @click="clearResp('GET_POSTS')">
              To get all posts with pagination
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
            data-bs-parent="#postsAccordion">
            <div class="accordion-body">
              <p class="font-weight-bold text-primary">End Point: 
                <span class="text-success">/wp-json/codebook-posts/v1/posts</span>
              </p>
              <p class="font-weight-bold text-primary">URL Parameters: 
                <span class="text-success">
                  page, per_page
                </span>
              </p>
              <input type="text" class="form-control mb-2" v-model="page" placeholder="Page" />
              <input type="text" class="form-control mb-3" v-model="per_page" placeholder="Limit" />
              <p>
                <button class="btn btn-dark" @click="getPaginatedPost" :style="{ borderRadius: '0px !important' }">Try It Out</button>
              </p>
              <div class="mt-3" v-if="action === 'GET_POSTS'">
                <pre>{{ apiResp }}</pre>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" @click="clearResp('GET_POST')">
              To get a single post by URL Slug
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
            data-bs-parent="#postsAccordion">
            <div class="accordion-body">
              <p class="font-weight-bold text-primary">End Point: 
                <span class="text-success">/wp-json/codebook-posts/v1/posts/{{ slug }}</span>
              </p>
              <input type="text" class="form-control mb-3" v-model="slug" placeholder="URL Slug" />
              <p>
                <button class="btn btn-dark" @click="getPostBySlug" :style="{ borderRadius: '0px !important' }" :disabled="action === 'GET_POST' && !slug">Try It Out</button>
              </p>
              <div class="mt-3" v-if="action === 'GET_POST'">
                <pre>{{ apiResp }}</pre>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  `,
  data() {
    return {
      slug: "",
      page: "",
      per_page: "",
      apiResp: null,
      loading: true,
      action: "GET_POSTS",
    };
  },
  methods: {
    async getPaginatedPost() {
      this.loading = true;
      let { data } = await api.get(
        `/wp-json/outright-posts/v1/posts?page=${this.page}&per_page=${this.per_page}`
      );
      this.apiResp = data;
      this.loading = false;
    },

    async getPostBySlug() {
      this.loading = true;
      try {
        let { data } = await api.get(
          "/wp-json/codebook-posts/v1/posts/" + this.slug
        );
        this.apiResp = data;
      } catch (err) {
        this.apiResp = { ...err.response.data, status: err.response.status };
      }
      this.loading = false;
    },

    clearResp(type) {
      this.apiResp = null;
      this.action = type;
      this.per_page = "";
      this.page = "";
    },
  },
});

app.component("CodebookTeams", {
  template: `
  <div class="card" :style="{ borderRadius: '0px !important' }">
    <div class="card-body">
      <h3 class="card-title mb-3">Teams Module</h3>
      <p class="card-subtitle">In this module we will explore the Codebook's Team Members Module</p>
      <p class="font-weight-bold text-primary mt-2">End Point: 
        <span class="text-success">/wp-json/codebook-inc/v1/teams</span>
      </p>
      <p>
        <button class="btn btn-dark" :style="{ borderRadius: '0px !important' }" @click="getAllTeamMembers" :disabled="loading">Try It Out.</button>
        <button class="btn btn-light ml-2" :style="{ borderRadius: '0px !important' }" @click="teamMembers = null" v-if="teamMembers">Reset</button>
      </p>
      <div class="mt-3" v-if="teamMembers">
        <pre>{{teamMembers}}</pre>
      </div>
    </div>
  </div>
  `,
  data() {
    return {
      loading: false,
      teamMembers: null,
    };
  },
  methods: {
    async getAllTeamMembers() {
      this.loading = true;
      let { data } = await api.get("/wp-json/outright-rest/v1/teams");
      this.teamMembers = data;
      this.loading = false;
    },
  },
});

app.component("CodebookTestimonials", {
  template: `
  <div class="card" :style="{ borderRadius: '0px !important' }">
    <div class="card-body">
      <h3 class="card-title mb-3">Testimonials Module</h3>
      <p class="card-subtitle">In this module we will explore the Codebook's Testimonials Module</p>
      <p class="font-weight-bold text-primary mt-2">End Point: 
        <span class="text-success">/wp-json/codebook-inc/v1/testimonials</span>
      </p>
      <p>
        <button class="btn btn-dark" :style="{ borderRadius: '0px !important' }" @click="getAllTestimonials" :disabled="loading">Try It Out.</button>
        <button class="btn btn-light ml-2" :style="{ borderRadius: '0px !important' }" @click="testimonials = null" v-if="testimonials">Reset</button>
      </p>
      <div class="mt-3" v-if="testimonials">
        <pre>{{testimonials}}</pre>
      </div>
    </div>
  </div>
  `,
  data() {
    return {
      loading: false,
      testimonials: null,
    };
  },
  methods: {
    async getAllTestimonials() {
      this.loading = true;
      let { data } = await api.get("/wp-json/outright-rest/v1/testimonials");
      this.testimonials = data;
      this.loading = false;
    },
  },
});

app.component("CodebookBanners", {
  template: `
  <div class="card" :style="{ borderRadius: '0px !important' }">
    <div class="card-body">
      <h3 class="card-title mb-3">Banners Module</h3>
      <p class="card-subtitle">In this module we will explore the Codebook's Banners Module</p>
      <p class="font-weight-bold text-primary mt-2">End Point: 
        <span class="text-success">/wp-json/codebook-inc/v1/banners</span>
      </p>
      <p>
        <button class="btn btn-dark" :style="{ borderRadius: '0px !important' }" @click="getBanners" :disabled="loading">Try It Out.</button>
        <button class="btn btn-light ml-2" :style="{ borderRadius: '0px !important' }" @click="banners = null" v-if="banners">Reset</button>
      </p>
      <div class="mt-3" v-if="banners">
        <pre>{{banners}}</pre>
      </div>
    </div>
  </div>
  `,
  data() {
    return {
      loading: false,
      banners: null,
    };
  },
  methods: {
    async getBanners() {
      this.loading = true;
      let { data } = await api.get("/wp-json/outright-rest/v1/banners");
      this.banners = data;
      this.loading = false;
    },
  },
});

app.mount("#app");
