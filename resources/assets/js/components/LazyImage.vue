<template>
  <v-lazy-image
          class="img-fluid"
          :src="src"
          :src-placeholder="placeholder"
          alt="alt"
  ></v-lazy-image>
</template>

<script>
  import vLazyImage from "v-lazy-image";

  export default {
    name: "LazyImage",
    props: ['src', 'placeholder', 'alt'],
    components: {vLazyImage},
    mounted() {
      this.test();
    },
    methods: {
      test() {
        /*let element = document.getElementsByClassName('lazy-images');
        console.log(element);*/
      }
    }
  }
</script>

<style scoped>
  .v-lazy-image {
    opacity: 0;
    transition: opacity 0.7s;
    position: absolute;
    top: 50%;
    left: 50%;
    height: 100%;
    width: auto;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
  }

  .v-lazy-image-loaded {
    opacity: 1;
  }

  .img-fluid {
    max-width: 100%;
    height: auto;
  }
</style>