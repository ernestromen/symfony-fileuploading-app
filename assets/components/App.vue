<template>
  <h1 class="text-center mt-3">Videos</h1>
  <body>
    <div class="container">
      <div class="row">
        <div class="text-center col-xl-11 col-12">
          <iframe
            :src="videoUrl"
            width="560"
            height="315"
            frameborder="0"
            allowfullscreen
            class="mt-5"
          ></iframe>
        </div>
        <button @click="toggleMenu" id="hamburger-button">&#9776;</button>
        <div id="menu-container" class="col-xl-1 col-12">
          <ul id="nav">
            <li><a class="text-light">Categories</a></li>
            <li v-for="(post, index) in posts" :key="index">
              <a href="#">{{ post.categoryName }}</a>
              <ul>
                <li v-for="(video, index) in post.videos">
                  <a
                    @click="setvideoFilePath()"
                    :data-url="encodeFilePath(video.videoFilePath)"
                    href="#"
                    >{{ video.videoName }}</a
                  >
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
import axios from "axios";

export default {
  data: function () {
    return {
      posts: [],
      videoFilePath: "",
      videoUrl: null,
      mainPath: "tobedeleted/public/uploads/videos/",
    };
  },
  methods: {
    getAllCategories() {
      axios
        .get("http://localhost/tobedeleted/public/fetchvideolist")
        .then((response) => {
          console.log(response.data);
          this.videoFilePath = this.mainPath + response.data[0].videos[0].videoFilePath;
          console.log(this.videoFilePath, "first");
          this.posts = response.data;
        })
        .catch((error) => {
        console.log(error);
        });
    },
    setvideoFilePath() {
      let fileName = event.target.getAttribute("data-url");
      console.log(fileName, "filename!!!");
      this.videoFilePath = this.mainPath + fileName;
      console.log(this.videoFilePath, "videofilepath");
    },
    encodeFilePath(filePath) {
      return encodeURIComponent(filePath);
    },
    toggleMenu() {
      const menuContainer = document.getElementById("menu-container");
      if (menuContainer.style.display === "block") {
        menuContainer.style.display = "none";
      } else {
        menuContainer.style.display = "block";
      }
    },
  },
  mounted() {
    this.getAllCategories();
  },
  computed: {
    videoUrl() {
      return `${window.location.origin}/${this.videoFilePath}`;
    },
  },
};
</script>
