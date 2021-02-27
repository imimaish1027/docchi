/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap'
import Vue from 'vue'
import ThemeBookmark from './components/ThemeBookmark'
import ThemeTagsInput from './components/ThemeTagsInput'
import PieChart from "./components/PieChart"
import PagePie from "./views/PagePie"

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
    el: "#app",
    components: {
        ThemeBookmark,
        ThemeTagsInput,
        PieChart,
        PagePie
    },
    data: {
        imageDataA: "",
        imageDataB: "",
        pic_a: "",
        pic_b: "",
        styleA: true,
        styleB: false,
        styleC: true,
        styleD: false
    },
    methods: {
        onFileChangeA(e) {
            const files = e.target.files;

            if (files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                reader.onload = e => {
                    this.imageDataA = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        onFileChangeB(e) {
            const files = e.target.files;

            if (files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                reader.onload = e => {
                    this.imageDataB = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        uploadFileA(e) {
            this.styleA = true;
            this.styleB = false;

            const files = e.target.files
                ? e.target.files
                : e.dataTransfer.files;

            if (files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                reader.onload = e => {
                    this.imageDataA = e.target.result;
                };
                reader.readAsDataURL(file);
                this.pic_a = files[0].pic_a;
                document.getElementById("uploadImageA").files = files;
            }
        },
        uploadFileB(e) {
            this.styleC = true;
            this.styleD = false;

            const files = e.target.files
                ? e.target.files
                : e.dataTransfer.files;

            if (files.length > 0) {
                const file = files[0];
                const reader = new FileReader();

                reader.onload = e => {
                    this.imageDataB = e.target.result;
                };
                reader.readAsDataURL(file);
                this.pic_b = files[0].pic_b;
                document.getElementById("uploadImageB").files = files;
            }
        },
        changeStyleA(e, flag) {
            if (flag == "ok") {
                this.styleA = false;
                this.styleB = true;
            } else {
                this.styleA = true;
                this.styleB = false;
            }
        },
        changeStyleB(e, flag) {
            if (flag == "ok") {
                this.styleC = false;
                this.styleD = true;
            } else {
                this.styleC = true;
                this.styleD = false;
            }
        }
    }
});

// SPメニュー
$('#js-toggle-sp-menu').on('click',function () {
    $(this).toggleClass('active');
    $('#js-toggle-sp-menu-target').toggleClass('active');
});

// チェックボックスの複数選択不可
$(".checkbox").on('click', function(){
    $('.checkbox').prop('checked', false);
    $(this).prop('checked', true); 
});


// テキストエリアカウント
var $countUp = $('#js-count'),
    $countView = $('#js-count__view');

$countUp.on('keyup', function(e) {
  $countView.html($(this).val().length);
});

// ソートのセレクトボックス
var select = document.getElementById('sort');
select.addEventListener('change', function () {
    this.form.submit();
}, false);

// フラッシュメッセージ
(function() {
    'use strict';
    $(function(){
        $('.flash_message').fadeOut(8000);
    });
})();
