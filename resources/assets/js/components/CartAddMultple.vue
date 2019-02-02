<template>
  <div class="add-to-cart">
    <div class="qty-label">
      {{ $t('pages.product.quantity') }}

      <div class="input-number">
        <input type="number" name="qty" v-model="quantity">
        <span class="qty-up" @click="qtyUp">+</span>
        <span class="qty-down" @click="qtyDown">-</span>
      </div>

    </div>
    <button class="add-to-cart-btn" @click="addToShoppingCart">
      <i class="fa fa-shopping-cart" type="submit"></i>
      {{ $t("partials.product.add_to_cart") }}
    </button>
  </div>
</template>

<script>
  export default {
    name: "CartAddMultple",

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
        quantity: 1,
      }
    },

    methods: {

      qtyUp() {
        this.quantity++;
      },

      qtyDown() {
        this.quantity--;
      },

      /**
       * Method for adding product to shopping cart
       */
      addToShoppingCart() {

        axios.post(this.link, {
          product_code: this.productCode,
          locale: this.locale,
          quantity: this.quantity,
        })
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