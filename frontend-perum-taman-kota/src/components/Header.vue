<template>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#"
        ><i class="fa fa-home" aria-hidden="true"></i> Perumahan Taman Kota
        Rajeg</a
      >
      <button
        class="navbar-toggler collapsed"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <router-link :to="{ name: 'post' }" class="nav-link"
              ><i class="fa fa-book-open" aria-hidden="true"></i>
              BERITA</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'event' }" class="nav-link"
              ><i class="fa fa-calendar" aria-hidden="true"></i>
              AGENDA</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'photo' }" class="nav-link"
              ><i class="fa fa-image" aria-hidden="true"></i>
              GALERI</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'video' }" class="nav-link"
              ><i class="fa fa-video" aria-hidden="true"></i> VIDEO</router-link
            >
          </li>
          <li class="nav-item">
            <router-link :to="{ name: 'contact' }" class="nav-link"
              ><i class="fa fa-phone" aria-hidden="true"></i>
              KONTAK</router-link
            >
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "HeaderComponent",
};
</script>