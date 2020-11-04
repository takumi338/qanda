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
    el: '#app',
});


import marked from "marked";

$(function (e) {


    $('#markdown_editor_textarea').keyup(function () {
        var html = marked($(this).val());
        $('#markdown_preview').html(html);
	});

	var target = $('.post_content')
    var html = marked(target.html());
	$('.post_content').html(html);

	// // var t = $('[id^=comment-]')
	// var t = $('p[id^=comment]')
	// // var a = $('#comment1')
    // var h = marked(t.html());
	// $('p[id^=comment]').html(h);


	'use strict';

    // フラッシュメッセージのfadeout
    $(function(){
        $('.flash_message').fadeOut(2000);
    });
});

// function loaded(){
//     document.getElementById("loading").classList.remove("active");
//     console.log("aaaa");
// }

// window.addEventListener("load", function(){
//     setTimeout(loaded, 500);
// })

// setTimeout(loaded, 5000);