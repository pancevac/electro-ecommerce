<template>
  <ul class="product-btns" v-if="asLink">
    <li>
      <a href="#" @click.prevent="addToWishList">
        <i class="fa fa-heart-o"></i> {{ $t('partials.product.add_to_wish_list') }}
      </a>
    </li>
  </ul>
  <button class="add-to-wishlist" @click="addToWishList" v-else>
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
      asLink: {
        type: Boolean,
        default: false,
      }
    },

    data() {
      return {
        locale: document.documentElement.lang,
      }
    },

    computed: {

      hasSlotData() {
        return this.$slots.default;
      },

    },

    methods: {

      addToWishList() {
        axios.post(this.link, {
          product_code: this.productCode,
          locale: this.locale
        })
          .then(response => {
            this.$toasted.global.toastSuccess({message: response.data.message});
          })
          .catch(e => {
            this.$toasted.global.toastError({message: e.response.data.message});
          })
      }

    }
  }
</script>