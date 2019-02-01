import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({

  state: {

    cartItems: null,
    itemCount: null,
    subtotalPrice: null,
    totalPrice: null,
    discount: null,

  },

  getters: {

    getCartItems: state => {
      return state.cartItems;
    },

    getItemCount: state => {
      return state.itemCount;
    },

    getSubtotalPrice: state => {
      return state.subtotalPrice;
    },

    getTotalPrice: state => {
      return state.totalPrice;
    },

    getDiscount: state => {
      return state.discount;
    },

  },

  mutations: {

    setCartItems: (state, callback) => {
      state.cartItems = callback;
    },

    setItemCount: (state, callback) => {
      state.itemCount = callback;
    },

    setSubtotalPrice: (state, callback) => {
      state.subtotalPrice = callback;
    },

    setTotalPrice: (state, callback) => {
      state.totalPrice = callback;
    },

    setDiscount: (state, callback) => {
      state.discount = callback;
    },

  },

  actions: {

    changeCartItems: (context, callback) => {
      context.commit('setCartItems', callback);
    },

    changeItemCount: (context, callback) => {
      context.commit('setItemCount', callback);
    },

    changeSubtotalPrice: (context, callback) => {
      context.commit('setSubtotalPrice', callback);
    },

    changeTotalPrice: (context, callback) => {
      context.commit('setTotalPrice', callback);
    },

    changeDiscount: (context, callback) => {
      context.commit('setDiscount', callback);
    },

  },

});
