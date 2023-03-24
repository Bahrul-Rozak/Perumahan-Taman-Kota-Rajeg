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
          <router-link :to="{ name: 'event' }" class="text-decoration-none"
            ><i class="fa fa-bell"></i> Agenda
          </router-link>
        </li>
      </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container-fluid mt-5 mb-5">
      <div class="row">
        <div v-if="events.length > 0" class="row">
          <div class="col-md-6 mb-3" v-for="event in events" :key="event.id">
            <router-link
              :to="{ name: 'detail_event', params: { slug: event.slug } }"
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
        </div>

        <div v-else>
          <div class="row">
            <div
              class="col-md-6 mb-3"
              v-for="loader in events_loader"
              :key="loader"
            >
              <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-body">
                  <FacebookLoader />
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
import { FacebookLoader } from "vue-content-loader";

//import axios
import axios from "axios";

//import hook onMounted from vue
import { ref, onMounted } from "vue";

//import component
import Header from "@/components/Header";
import Footer from "@/components/Footer";

export default {
  name: "EventComponent",

  components: {
    FacebookLoader,
    Header,
    Footer,
  },

  setup() {
    //define state
    const events = ref([]);
    const events_loader = ref(4);

    //define state moreExists
    let moreExists = ref(false);
    let nextPage = ref(0);

    //define method fetchDataEvents
    const fetchDataEvents = () => {
      axios.get("/api/event").then((response) => {
        //assign response to state events
        events.value = response.data.data.data;

        //check if response has next page
        if (response.data.data.current_page < response.data.data.last_page) {
          //set state moreExists to true
          moreExists.value = true;

          //increment nextPage
          nextPage.value = response.data.data.current_page + 1;
        } else {
          //set state moreExists to false
          moreExists.value = false;
        }
      });
    };

    //define method loadMore
    const loadMore = () => {
      axios.get(`/api/event?page=${nextPage.value}`).then((response) => {
        if (response.data.data.current_page < response.data.data.last_page) {
          //set state moreExists to true
          moreExists.value = true;

          //increment nextPage
          nextPage.value = response.data.data.current_page + 1;
        } else {
          //set state moreExists to false
          moreExists.value = false;
        }

        //assign response to state posts
        response.data.data.data.forEach((data) => {
          events.value.push(data);
        });
      });
    };

    //run hook onMounted
    onMounted(() => {
      //fetch data events
      fetchDataEvents();
    });

    //return data
    return {
      events,
      events_loader,
      moreExists,
      nextPage,
      loadMore,
    };
  },
};
</script>