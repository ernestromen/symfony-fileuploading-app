<template>
<h1>hello</h1>

</template>

<script>



export default {
  data: function () {
    return {
    //   posts: [],
    //   postTextArea: "",
    //   responseNetworkError: false,
    //   responseNetworkErrorMessage: "",
    };
  },
  methods: {
    // getAllPosts: function () {
    //   axios
    //     .get("http://localhost:8000/allposts")
    //     .then((response) => {
    //       this.posts = response.data;
    //     })
    //     .catch((error) => {
    //       this.errorHandler(error);
    //     });
    // },
    // addPost: function (e) {
    //   e.preventDefault();
    //   axios
    //     .post("http://localhost:8000/addpost", {
    //       data: this.postTextArea,
    //     })
    //     .then((response) => {
    //       let newPost = {
    //         id: response.data.lastAddedPostId,
    //         post: this.postTextArea,
    //         CreatedAt: { date: this.currentDateTime },
    //       };

    //       this.posts = [...this.posts, newPost];
    //     })
    //     .catch((error) => {
    //       this.errorHandler(error);
    //     });
    // },
    // deletePost: function (id) {
    //   axios
    //     .delete(`http://localhost:8000/delete/${id}`)
    //     .then((response) => {
    //       let fillteredPosts = this.posts.filter((e) => e.id !== id);
    //       this.posts = fillteredPosts;
    //     })
    //     .catch((error) => {
    //       this.errorHandler(error);
    //     });
    // },
    // showFailedApiMessage: function (error) {
    //   switch (error["response"]["status"]) {
    //     case 404:
    //       return "No posts exist, please add something!";
    //       break;
    //     default:
    //       return `${error["message"]} : ${error["name"]} `;
    //   }
    // },
    // errorHandler: function (error) {
    //   this.responseNetworkErrorMessage = this.showFailedApiMessage(error);
    //   this.responseNetworkError = true;

    //   setTimeout(() => {
    //     this.responseNetworkError = false;
    //     this.responseNetworkErrorMessage = "";
    //   }, 2500);
    // },
  },
  mounted() {
    // this.getAllPosts();
    // this.currentDateTime = moment().format("YYYY-MM-DD HH:mm:ss");
  },
};

</script>