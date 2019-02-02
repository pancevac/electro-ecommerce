<template>
  <div>

  </div>
</template>
<script>
  export default {
    name: "CartLoader",

    props: ['cartItems', 'cartTotalPrice', 'cartCount'],

    mounted() {

      this.$store.dispatch('changeCartItems', this.cartItems);
      this.$store.dispatch('changeItemCount', this.cartCount);
      this.$store.dispatch('changeTotalPrice', this.cartTotalPrice);
      /*this.$store.dispatch('changeSubtotalPrice', this.cartSubtotalPriceProp);
      this.$store.dispatch('changeDiscount', this.cartTotalDiscountProp);*/

    },

  }
</script>