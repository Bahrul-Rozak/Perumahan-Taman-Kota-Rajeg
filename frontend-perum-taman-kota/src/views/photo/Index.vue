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
          <router-link :to="{ name: 'photo' }" class="text-decoration-none"
            ><i class="fa fa-image"></i> Galeri Foto</router-link
          >
        </li>
      </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container-fluid mt-5 mb-5">
      <div class="row">
        <div v-if="photos.length > 0" class="row">
          <div class="col-md-4 mb-4" v-for="photo in photos" :key="photo.id">
            <div class="card h-100 shadow-sm border-0 rounded-lg">
              <div class="card-img">
                <img
                  :src="photo.image"
                  class="w-100"
                  style="
                    height: 300px;
                    object-fit: cover;
                    border-top-left-radius: 0.3rem;
                    border-top-right-radius: 0.3rem;
                  "
                />
              </div>
              <div class="card-body text-center">
                <h6>{{ photo.caption }}</h6>
              </div>
            </div>
          </div>
        </div>

        <div v-else>
          <div class="row">
            <div
              class="col-md-4 mb-3"
              v-for="loader in photos_loader"
              :key="loader"
            >
              <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-body p-2">
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
  name: "PhotoComponent",

  components: {
    //loader component
    ContentLoader,
    // component app
    Header,
    Footer,
  },

  setup() {
    //define state
    const photos = ref([]);
    const photos_loader = ref(6);
    let moreExists = ref(false);
    let nextPage = ref(0);

    //define method fetchDataPhotos
    const fetchDataPhotos = () => {
      axios.get("/api/photo").then((response) => {
        //assign response to state photos
        photos.value = response.data.data.data;
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
      axios.get(`/api/photo?page=${nextPage.value}`).then((response) => {
        if (response.data.data.current_page < response.data.data.last_page) {
          //set state moreExists to true
          moreExists.value = true;

          //set state nextPage to next page
          nextPage.value = response.data.data.current_page + 1;
        } else {
          //set state moreExists to false
          moreExists.value = false;
        }

        //push data to state photos
        response.data.data.data.forEach((data) => {
          photos.value.push(data);
        });
      });
    };

    //run hook onMounted
    onMounted(() => {
      //fetch data photos
      fetchDataPhotos();
    });

    return {
      photos,
      photos_loader,
      moreExists,
      nextPage,
      loadMore,
    };
  },
};
</script>