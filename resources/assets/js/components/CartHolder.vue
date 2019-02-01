<script>
  export default {
    name: "CartHolder",

    props: ['cartItemsProp', 'cartTotalPriceProp', 'cartTotalPriceProp'],

    data() {
      return {
        items: [],
      }
    },

    created() {

      this.$store.dispatch('changeCartItems', this.cartItemsProp);
      this.$store.dispatch('changeItemCount', this.cartCountProp);
      this.$store.dispatch('changeTotalPrice', this.cartTotalPriceProp);
      /*this.$store.dispatch('changeSubtotalPrice', this.cartSubtotalPriceProp);
      this.$store.dispatch('changeDiscount', this.cartTotalDiscountProp);*/

    },

    computed: {

      /**
       * Retrieve cart items from vuex store
       * That means on every change of vuex state, retrieve changes...
       */
      getCartItems() {
        return this.$store.getters['getCartItems'];
      },

      /**
       * Retrieve cart items count from vuex store
       */
      getCartItemsCount() {
        return this.$store.getters['getItemCount'];
      },
    },

    methods: {

      /**
       * Remove item from shopping cart
       */
      removeItem(index) {
        //
      },

      /**
       * Format price euro.
       *
       * @param value
       */
      formatPrice(value) {
        //
      },
    },

  }
</script>