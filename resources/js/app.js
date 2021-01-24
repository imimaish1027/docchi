/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue'
import ThemeBookmark from './components/ThemeBookmark'

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
    el: '#app',
    components: {
        ThemeBookmark,
    }
});

// チェックボックスの複数選択不可
$(".checkbox").on("click", function(){
        $('.checkbox').prop('checked', false);
        $(this).prop('checked', true); 
});


// テキストエリアカウント
var $countUp = $('#js-count'),
    $countView = $('#js-count__view');

$countUp.on('keyup', function(e) {
  $countView.html($(this).val().length);
});