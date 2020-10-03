/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

global.bootstrap_select = require('./plugins/bootstrap-select/bootstrap-select.min.js');
global.bootstrap_select_i81 = require('./plugins/bootstrap-select/i18n/defaults-ru_RU.js');
global.owl = require('./plugins/owl-carousel/owl.carousel.min.js');
global.mask = require('./plugins/jquery.maskedinput-master/src/jquery.maskedinput.js');

window.Vue = require('vue');

require('./scripts/user_city.js');
require('./scripts/city_dropdown.js');

import Vuelidate from 'vuelidate';
import SimpleMDE from 'simplemde';
Vue.use(Vuelidate);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('products-list', require('./components/Cart/ProductsList.vue').default);
Vue.component('cart-dropdown', require('./components/Cart/Cart.vue').default);
Vue.component('cart-page', require('./components/Cart/CartPage.vue').default);
Vue.component('cart-modal-order', require('./components/Cart/ModalOrder.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use('vuex');

import store from './store.js';

const app = new Vue({
    el: '#app',
    store: new Vuex.Store(store)
});


//Тестовое админка
jQuery(document).ready(function($) {
	let simplemde = new SimpleMDE({ element: document.getElementById("productMDE") });

	$('.app .navigation .navigation-left--header').click(function () {
		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			$('.app .navigation .navigation-nav').removeClass('active');
		} else {
			$(this).addClass('active');
			$('.app .navigation .navigation-nav').addClass('active');
		}
	});

	$("input[type='tel']").mask("+7(999)-999-99-99");
	//Удаление пользователя
	$('a[href="#modalAdminDeleteUser"]').click(function(event) {
		var idUser,
			nameUser;

		idUser = $(this).closest('tr').find('td:first-of-type').text();
		nameUser = $(this).closest('tr').find('td:nth-child(3)').text();

		console.log(idUser, nameUser);

		$('#modalAdminDeleteUser .nameUser').text('"'+nameUser+'"');
		$('#modalAdminDeleteUser form').attr('action', '/admin/users/'+idUser);
	});

	//Удаление фирмы
	$('a[href="#modalAdminDeleteFirm"]').click(function(event) {
		var idFirm,
			nameFirm;

		idFirm = $(this).closest('tr').find('td:first-of-type').text();
		nameFirm = $(this).closest('tr').find('td:nth-child(2)').text();

		console.log(idFirm, nameFirm);

		$('#modalAdminDeleteFirm .nameFirm').text('"'+nameFirm+'"');
		$('#modalAdminDeleteFirm form').attr('action', '/admin/firms/'+idFirm);
	});

	//Удаление города
	$('a[href="#modalAdminDeleteCity"]').click(function(event) {
		var idCity,
			nameCity;

		idCity = $(this).closest('tr').find('td:first-of-type').text();
		nameCity = $(this).closest('tr').find('td:nth-child(2)').text();

		console.log(idCity, nameCity);

		$('#modalAdminDeleteCity .nameCity').text('"'+nameCity+'"');
		$('#modalAdminDeleteCity form').attr('action', '/admin/cities/'+idCity);
	});

	//Удаление города
	$('a[href="#modalAdminDeleteProduct"]').click(function(event) {
		var idProduct,
			nameProduct;

		idProduct = $(this).closest('tr').find('td:first-of-type').text();
		nameProduct = $(this).closest('tr').find('td:nth-child(2)').text();

		console.log(idProduct, nameProduct);

		$('#modalAdminDeleteProduct .nameProduct').text('"'+nameProduct+'"');
		$('#modalAdminDeleteProduct form').attr('action', '/admin/cities/'+idProduct);
	});

	if(window.location.pathname == '/admin/firms') {
		document.querySelector('.custom-file-input').addEventListener('change',function(e){
			var fileName = document.getElementById("logoInputFirm").files[0].name;
			var nextSibling = e.target.nextElementSibling
			nextSibling.innerText = fileName
		});
	}

	if(window.location.pathname == '/admin/products') {
		document.querySelector('.custom-file-input').addEventListener('change',function(e){
			var fileName = document.getElementById("logoInputProduct").files[0].name;
			var nextSibling = e.target.nextElementSibling
			nextSibling.innerText = fileName
		});
	}

	$("#searchAdmin").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$(this).closest('.card-body').find('table tr').filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});

	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:0,
	    nav:false,
	    dots:false,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	});

	var mh = 0;
	$(".product").each(function () {
		var h_block = parseInt($(this).find('.product__title').height());
		if(h_block > mh) {
			mh = h_block;
		};
	});

	$(".product .product__title").height(mh);

	$('.dropdown-item-cart').on('click', function (event) {
	    event.stopPropagation();
	});

	$('.products-nav .btn-primary:not(select)').click(function (e) {
		e.preventDefault();

		let liter = $(this).attr('data-liter');
		let firm_id = $(this).attr('data-firm');

		if(typeof liter !== typeof undefined && liter !== false) {
			$('input[name="liter"]').val(liter);
		}
		if(typeof firm_id !== typeof undefined && firm_id !== false) {
			$('input[name="firm_id"]').val(firm_id);
		}

		$(this).closest('.row').find('.active').removeClass('active');

		$(this).addClass('active');

		return false;
	});

	$('.products-nav select.btn-primary').click(function (e) {
		e.preventDefault();

		let liter = $(this).find('option:selected').attr('data-liter');
		let firm_id = $(this).find('option:selected').attr('data-firm');

		if(typeof liter !== typeof undefined && liter !== false) {
			$('input[name="liter"]').val(liter);
		}
		if(typeof firm_id !== typeof undefined && firm_id !== false) {
			$('input[name="firm_id"]').val(firm_id);
		}

		$(this).closest('.row').find('.active').removeClass('active');

		$(this).addClass('active');

		return false;
	});

	$(document).on('click', '.product-minus', function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);

        $(this).parent('.product-foot').find('.btn-cart').attr('data-count', $input.val());

        $input.change();
        return false;
    });

    $(document).on('click', '.product-plus', function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);

        $(this).parent('.product-foot').find('.btn-cart').attr('data-count', $input.val());

        $input.change();
        return false;
    });

    $(document).on('keyup', '.product-input', function () {
    	var count = parseInt($(this).val());
    	count = count < 1 ? 1 : count;

    	$(this).parent('.product-foot').find('.btn-cart').attr('data-count', $(this).val());
    });

    if(window.location.pathname === "/pages/contacts") {
		ymaps.ready(init);
	}
});

function init() {
    var myMap = new ymaps.Map("map", {
            center: [46.760702, 54.921726],
            zoom: 4,
            controls: ['zoomControl']
        }, {
            searchControlProvider: 'yandex#search'
        });

    myMap.behaviors.disable('scrollZoom');

    myMap.geoObjects
        .add(new ymaps.Placemark([59.975179, 30.305626], {
            balloonContent: '<strong>MYHIM.RU</strong><br>Санкт-Петербург</b><br><strong>Телефон:</strong>+7 (922) 051-71-82'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }))
        .add(new ymaps.Placemark([45.035470, 38.975313], {
            balloonContent: '<strong>MYHIM.RU</strong><br>Краснодар</b><br><strong>Телефон:</strong>+7 (922) 051-71-82'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }))
        .add(new ymaps.Placemark([45.043330, 41.969101], {
            balloonContent: '<strong>MYHIM.RU</strong><br>Ставрополь</b><br><strong>Телефон:</strong>+7 (962) 455-00-00'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }))
        .add(new ymaps.Placemark([44.228374, 42.048270], {
            balloonContent: '<strong>MYHIM.RU</strong><br>Черкесск</b><br><strong>Телефон:</strong>+7 (922) 051-71-82'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }))
        .add(new ymaps.Placemark([43.735426, 44.653887], {
            balloonContent: '<strong>MYHIM.RU</strong><br>Моздок</b><br><strong>Телефон:</strong>+7 (928) 074-08-88'
        }, {
            preset: 'islands#icon',
            iconColor: '#0095b6'
        }));
}
