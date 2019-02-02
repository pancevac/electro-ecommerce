<template>
  <button class="add-to-wishlist" @click="addToWishList">
    <i class="fa fa-heart-o"></i>
    <span class="tooltipp">
      {{ $t('partials.product.add_to_wish_list') }}
    </span>
  </button>
</template>

<script>
  export default {
    name: "WishListAdd",

    props: {
      productCode: {
        type: String,
      },
      link: {
        type: String,
      },
    },

    data() {
      return {
        locale: document.documentElement.lang,
      }
    },

    methods: {

      addToWishList()
      {
        axios.post(this.link, {
          product_code: this.productCode,
          locale: this.locale
        })
          .then(response => {
            this.$toasted.global.toastSuccess({ message: response.data.message });
          })
          .catch(e => {
            this.$toasted.global.toastError({ message: e.response.data.message });
          })
      }

    }
  }
</script>