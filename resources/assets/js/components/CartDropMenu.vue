<template>
  <div class="dropdown" v-bind:class="{ open: visible }">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" @click="toggleMenu" ref="dropdownMenu">
      <i class="fa fa-shopping-cart"></i>
      <span>{{ $t('partials.header.shopping_cart') }}</span>
      <div class="qty">{{ getCartItemsCount }}</div>
    </a>
    <div class="cart-dropdown">
      <div class="cart-list">


        <div class="product-widget" v-if="getCartItemsCount" v-for="(item, index) in getCartItems">
          <div class="product-img">
            <img :src="item.model.smallImage" alt="">
          </div>
          <div class="product-body">
            <h3 class="product-name">
              <a :href="item.model.link">
                {{ item.model.name }}
              </a>
            </h3>
            <h4 class="product-price"><span class="qty">{{ item.qty }}x</span>{{ item.priceFormatted }}
            </h4>
          </div>
          <button class="delete"><i class="fa fa-close" type="submit" @click="removeItem(index)"></i></button>
        </div>

        <h5 v-else>{{ $t('partials.header.shopping_cart_empty') }}</h5>

      </div>

      <div class="cart-summary" v-if="getCartItemsCount">
        <small>
          {{ getCartItemsCount }}
          {{ $t('partials.header.item_selected') }}
        </small>
        <h5>{{ $t('partials.header.subtotal') }}: {{ getCartTotalPrice }}</h5>
      </div>

      <div class="cart-btns">
        <a :href="cartLink">{{ $t('partials.header.shopping_cart_view') }}</a>
        <a :href="checkoutLink">{{ $t('partials.header.checkout') }}
          <i class="fa fa-arrow-circle-right"></i></a>
      </div>

    </div>
  </div>
</template>

<script>
  export default {
    name: "CartDropMenu",

    props: {
      cartLink: {
        type: String,
      },
      checkoutLink: {
        type: String,
      },
    },

    data() {
      return {
        appUrl: window.app_url + '/',
        locale: document.documentElement.lang,
        visible: false,
      }
    },

    created () {
      document.addEventListener('click', this.documentClick)
    },
    destroyed () {
      // important to clean up!!
      document.removeEventListener('click', this.documentClick)
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

      /**
       * Retrieve cart items subtotal price
       */
      getCartTotalPrice() {
        return this.$store.getters['getTotalPrice'];
      },

    },

    methods: {

      toggleMenu() {
        this.visible = !this.visible;
      },

      documentClick(e){
        let el = this.$refs.dropdownMenu
        let target = e.target
        if ( (el !== target) && !el.contains(target)) {
          this.visible=false
        }
      },

      /**
       * Remove item from cart
       * @param index
       */
      removeItem(index) {

        axios.delete(this.appUrl + this.locale + '/cartAjax/' + index)
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
      },

    }
  }
</script>