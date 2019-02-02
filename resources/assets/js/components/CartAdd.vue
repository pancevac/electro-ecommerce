<template>
  <div class="add-to-cart">
    <button class="add-to-cart-btn" @click="addToShoppingCart">
      <i class="fa fa-shopping-cart"></i>
      {{ $t("partials.product.add_to_cart") }}
    </button>
  </div>
</template>

<script>
  export default {
    name: "CartAdd",

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

      /**
       * Method for adding product to shopping cart
       */
      addToShoppingCart() {

        axios.post(this.link, { product_code: this.productCode, locale: this.locale })
          .then(response => {
            this.$toasted.global.toastSuccess({ message: response.data.message });

            // Sync shopping cart state
            this.$store.dispatch('changeCartItems', response.data.cartItems);
            this.$store.dispatch('changeItemCount', response.data.cartItemsCount);
            //this.$store.dispatch('changeSubtotalPrice', response.data.subtotalPrice);
            this.$store.dispatch('changeTotalPrice', response.data.totalPrice);
            //this.$store.dispatch('changeDiscount', response.data.discount);

          })
          .catch(e => {
            this.$toasted.global.toastError({ message: e.response.data.message });
          })
      }

    }

  }
</script>