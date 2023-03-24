<template>
  <div class="post-index">
    <!-- header -->
    <Header />
    <!-- end header -->

    <!-- main content -->

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }" class="text-decoration-none"
            ><i class="fa fa-home"></i> Home
          </router-link>
        </li>
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'post' }" class="text-decoration-none"
            ><i class="fa fa-book-open"></i> Berita</router-link
          >
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ post.title }}
        </li>
      </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container-fluid mt-5 mb-5">
      <div class="row">
        <div class="col-md-8">
          <div v-if="post.title">
            <div class="card border-0 shadow-sm rounded">
              <div class="card-body">
                <h3>{{ post.title }}</h3>
                <hr />
                <img :src="post.image" class="w-100 rounded" />

                <div class="mt-3" v-html="post.content"></div>
              </div>
            </div>
          </div>
          <div v-else>
            <div class="card border-0 shadow-sm rounded">
              <div class="card-body">
                <FacebookLoader />
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <!-- agenda section -->
          <div class="title mb-4">
            <h4>
              <i class="fa fa-calendar" aria-hidden="true"></i> AGENDA TERBARU
            </h4>
          </div>

          <div v-if="events.length > 0">
            <router-link
              :to="{ name: 'detail_event', params: { slug: event.slug } }"
              v-for="event in events"
              :key="event.id"
              class="text-decoration-none text-dark"
            >
              <div class="card mb-3 shadow-sm border-0">
                <div class="card-body">
                  <h6>{{ event.title }}</h6>
                  <hr />
                  <div>
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    {{ event.location }}
                  </div>
                  <div class="mt-2">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    {{ event.date }}
                  </div>
                </div>
              </div>
            </router-link>
          </div>

          <div v-else>
            <div class="row">
              <div v-for="loader in events_loader" :key="loader">
                <div class="card border-0 shadow-sm rounded-lg mb-3">
                  <div class="card-body pt-4">
                    <FacebookLoader />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end agenda section -->

          <!-- kategori section -->
          <div class="title mb-4 mt-5">
            <h4>
              <i class="fa fa-folder" aria-hidden="true"></i> KATEGORI BERITA
            </h4>
          </div>

          <div v-if="categories.length > 0">
            <div class="list-group">
              <router-link
                :to="{
                  name: 'detail_category',
                  params: { slug: category.slug },
                }"
                class="list-group-item list-group-item-action border-0 shadow-sm mb-2 rounded"
                v-for="category in categories"
                :key="category.id"
                ><i class="fa fa-folder-open" aria-hidden="true"></i>
                {{ category.name.toUpperCase() }}</router-link
              >
            </div>
          </div>

          <div v-else>
            <div class="row">
              <div v-for="loader in categories_loader" :key="loader">
                <div class="card border-0 shadow-sm rounded-lg mb-3">
                  <div class="card-body pt-4">
                    <BulletListLoader />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end kategori section -->
        </div>
      </div>
    </div>
    <!-- main content -->

    <!-- footer -->
    <Footer />
    <!-- end footer -->
  </div>
</template>

<script>
//import content loader
import { FacebookLoader, BulletListLoader } from "vue-content-loader";

//import axios
import axios from "axios";

//import hook onMounted from vue
import { ref, onMounted } from "vue";

//import hook useRoute
import { useRoute } from "vue-router";

//import component
import Header from "@/components/Header";
import Footer from "@/components/Footer";

export default {
  name: "PostDetailComponent",

  components: {
    //loader component
    FacebookLoader,
    BulletListLoader,
    //component app
    Header,
    Footer,
  },

  setup() {
    //define state
    const post = ref({});
    const events = ref([]);
    const categories = ref([]);
    const events_loader = ref(2);
    const categories_loader = ref(1);

    //define route
    const route = useRoute();

    //run hook onMounted
    onMounted(() => {
      //get post detail
      axios.get(`/api/post/${route.params.slug}`).then((response) => {
        post.value = response.data.data;
      });

      //get agenda
      axios.get(`/api/homepage/event`).then((response) => {
        events.value = response.data.data;
      });

      //get kategori
      axios.get(`/api/category`).then((response) => {
        categories.value = response.data.data.data;
      });
    });

    return {
      post,
      events,
      categories,
      events_loader,
      categories_loader,
    };
  },
};
</script>