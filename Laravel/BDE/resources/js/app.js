
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

/**
 * Set burger menu onclick.
 */
var burgerMenu = document.getElementById('burger_menu');
var subMenuBurger = document.getElementById('submenu_burger');
burgerMenu.onclick = function(){
    subMenuBurger.style = "display: inline-block; position: absolute; top: 60%; right: 0; width: 250px; padding: 0;z-index:10000;";
}

/**
 * Open modal onclick
 */
var modal = document.getElementById('modal');
var modalCross = document.getElementById('closeCross');
modalCross.onclick = function(){
    modal.style.display = "none";
}

/**
 * Remove Burger menu and modal;
 */
window.onclick = function(event){
    if(event.target == modal){
        modal.style.display = "none";
    }
    if(event.target == subMenuBurger){
        subMenuBurger.style.display = "none";
    }
}