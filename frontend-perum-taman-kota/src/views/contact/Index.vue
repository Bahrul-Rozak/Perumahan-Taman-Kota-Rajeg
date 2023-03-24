<template>
  <div class="post-index">
    <!-- header -->
    <Header />
    <!-- end header -->

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'home' }" class="text-decoration-none"
            ><i class="fa fa-home"></i> Home
          </router-link>
        </li>
        <li class="breadcrumb-item">
          <router-link :to="{ name: 'contact' }" class="text-decoration-none"
            ><i class="fa fa-phone"></i> Kontak</router-link
          >
        </li>
      </ol>
    </nav>
    <!-- end breadcrumb -->

    <div class="container-fluid mt-5 mb-5">
      <div class="row">
        <div class="col-md-7">
          <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.4878845067!2d106.6894283352192!3d-6.229728025238589!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1594508000901!5m2!1sid!2sid"
                width="100%"
                height="400"
                frameborder="0"
                style="border: 0"
                allowfullscreen=""
                aria-hidden="false"
                tabindex="0"
              ></iframe>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
              <h3>KONTAK KAMI</h3>
              <hr />
              <p>
                <i class="fa fa-map-marker" aria-hidden="true"></i> Jl. Jendral
                Sudirman No.83, Daerah Khusus Ibukota Jakarta, Indonesia
              </p>
              <p><i class="fas fa-phone"></i> +62857-8585-2224</p>
              <p><i class="fas fa-envelope"></i> bahrulrozak@uhamka.ac.id</p>
            </div>
          </div>
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
//import component
import Header from "@/components/Header";
import Footer from "@/components/Footer";

export default {
  name: "ContactComponent",
  components: {
    Header,
    Footer,
  },
};
</script>