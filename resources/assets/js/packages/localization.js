import Vue from 'vue';
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

Vue.use(VueInternationalization);

const lang = document.documentElement.lang;

export const i18n = new VueInternationalization({
  locale: lang, // // set locale
  messages: Locale // set locale messages
});