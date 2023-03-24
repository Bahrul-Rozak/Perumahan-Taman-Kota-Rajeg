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
            ><i class="fa fa-home"></i> Home</router-link
          >
        </li>
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'post' }" class="text-decoration-none"
            ><i class="fa fa-book-open"></i> Berita</router-link
          >
        </li>
      </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container-fluid mt-5 mb-5">
      <div class="row">
        <div v-if="posts.length > 0" class="row">
          <div class="col-md-4 mb-4" v-for="post in posts" :key="post.id">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img
                  :src="post.image"
                  class="w-100"
                  style="
                    height: 200px;
                    object-fit: cover;
                    border-top-left-radius: 0.3rem;
                    border-top-right-radius: 0.3rem;
                  "
                />
              </div>
              <div class="card-body">
                <router-link
                  :to="{ name: 'detail_post', params: { slug: post.slug } }"
                  class="text-dark text-decoration-none"
                >
                  <h6>{{ post.title }}</h6>
                </router-link>
              </div>
              <div class="card-footer bg-white">
                <i class="fa fa-calendar" aria-hidden="true"></i>
                {{ post.created_at }}
              </div>
            </div>
          </div>
        </div>

        <div v-else>
          <div class="alert alert-danger">
            DATA BERITA TERBARU BELUM TERSEDIA !
          </div>
        </div>

        <div class="text-center" v-show="moreExists">
          <button
            type="button"
            class="btn btn-primary btn-md"
            v-on:click="loadMore"
          >
            <span class="fa fa-arrow-down"></span> LIHAT LEBIH BANYAK
          </button>
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
//import axios
import axios from "axios";

//import hook watch from vue
import { ref, onMounted, watch } from "vue";

//import hook useRoute
import { useRoute } from "vue-router";

//import component
import Header from "@/components/Header";
import Footer from "@/components/Footer";

export default {
  name: "TagComponent",

  components: {
    Header,
    Footer,
  },

  setup() {
    //define state
    const posts = ref([]);
    const tagInfo = ref({});
    let moreExists = ref(false);
    let nextPage = ref(0);

    //define route
    const route = useRoute();

    //define method fetchDataPostsByTag
    const fetchDataPostsByTag = () => {
      axios.get(`/api/tag/${route.params.slug}`).then((response) => {
        //assign data to state tagInfo
        tagInfo.value = response.data.response;

        //assign data to state posts
        posts.value = response.data.data.data;

        if (response.data.data.current_page < response.data.data.last_page) {
          //set state moreExists to true
          moreExists.value = true;

          //set state nextPage to next page
          nextPage.value = response.data.data.current_page + 1;
        } else {
          //set state moreExists to false
          moreExists.value = false;
        }
      });
    };

    //define method loadMore
    const loadMore = () => {
      axios
        .get(`/api/tag/${route.params.slug}?page=${nextPage.value}`)
        .then((response) => {
          if (response.data.data.current_page < response.data.data.last_page) {
            //set state moreExists to true
            moreExists.value = true;

            //set state nextPage to next page
            nextPage.value = response.data.data.current_page + 1;
          } else {
            //set state moreExists to false
            moreExists.value = false;
          }

          //push data to state posts
          response.data.data.data.forEach((data) => {
            posts.value.push(data);
          });
        });
    };

    //run hook onMounted
    onMounted(() => {
      //run method fetchDataPostsByTag
      fetchDataPostsByTag();
    });

    //watch route
    watch(
      () => route.params.slug,
      () => {
        //fetchDataPostsByTag
        fetchDataPostsByTag();
      }
    );

    return {
      posts,
      tagInfo,
      moreExists,
      loadMore,
    };
  },
};
</script>