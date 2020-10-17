require("./bootstrap");

window.Vue = require("vue");

Vue.component("product-component",require("./components/ProductComponent.vue").default);
Vue.component('pagination', require('laravel-vue-pagination'));
const app = new Vue({
    el: "#app",
});
