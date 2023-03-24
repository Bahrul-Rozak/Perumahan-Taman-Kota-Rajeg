<template>
  <div class="video">
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
          <router-link :to="{ name: 'video' }" class="text-decoration-none"
            ><i class="fa fa-video"></i> Video</router-link
          >
        </li>
      </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container-fluid mt-5 mb-5">
      <div class="row">
        <div v-if="videos.length > 0" class="row">
          <div class="col-md-6 mb-4" v-for="video in videos" :key="video.id">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <iframe
                  style="
                    width: 100%;
                    height: 300px;
                    border-top-left-radius: 0.3rem;
                    border-top-right-radius: 0.3rem;
                  "
                  :src="video.embed"
                  frameborder="0"
                  allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen
                ></iframe>
              </div>
              <div class="card-body text-center">
                <h6>{{ video.title }}</h6>
              </div>
            </div>
          </div>
        </div>

        <div v-else>
          <div class="row">
            <div
              class="col-md-6 mb-3"
              v-for="loader in videos_loader"
              :key="loader"
            >
              <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-body">
                  <ContentLoader />
                </div>
              </div>
            </div>
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
//import content loader
import { ContentLoader } from "vue-content-loader";

//import axios
import axios from "axios";

//import hook onMounted from vue
import { ref, onMounted } from "vue";

//import component
import Header from "@/components/Header";
import Footer from "@/components/Footer";

export default {
  name: "VideoCOmponent",

  components: {
    //loader component
    ContentLoader,
    // component app
    Header,
    Footer,
  },

  setup() {
    //define state
    const videos = ref([]);
    const videos_loader = ref(4);
    let moreExists = ref(false);
    let nextPage = ref(0);

    //define method fetchDataVideos
    const fetchDataVideos = () => {
      axios.get("/api/video").then((response) => {
        //aassign data to state videos
        videos.value = response.data.data.data;

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
      axios.get(`/api/video?page=${nextPage.value}`).then((response) => {
        if (response.data.data.current_page < response.data.data.last_page) {
          //set state moreExists to true
          moreExists.value = true;

          //set state nextPage to next page
          nextPage.value = response.data.data.current_page + 1;
        } else {
          //set state moreExists to false
          moreExists.value = false;
        }

        //push data to state videos
        response.data.data.data.forEach((data) => {
          videos.value.push(data);
        });
      });
    };

    //run hook onMounted
    onMounted(() => {
      //run method fetchDataVideos
      fetchDataVideos();
    });

    return {
      videos,
      videos_loader,
      moreExists,
      loadMore,
    };
  },
};
</script>