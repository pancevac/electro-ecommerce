<template>
  <a href="#" @click="removeFromCart">
    <i class="fa fa-close" type="submit"></i>
  </a>
</template>

<script>
  export default {
    name: "CartRemove",

    props: {

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

      removeFromCart() {

        axios.delete(this.link, { locale: this.locale })
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

<style scoped>

</style>