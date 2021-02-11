/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Inputmask from "inputmask";

(() => {
	const categoryContainerNode = document.querySelector('#sidebar section .category-container');
	if(!categoryContainerNode)
		return;
	categoryContainerNode.addEventListener('click', (event) => {
		event = event || window.event
		var clickedElem = event.target || event.srcElement
		const hasClass = function (elem, className) {
			return new RegExp("(^|\\s)"+className+"(\\s|$)").test(elem.className)
		}

		if (!hasClass(clickedElem, 'expand')) {
			return // клик не там
		}

		// Node, на который кликнули
		var node = clickedElem.parentNode
		if (hasClass(node, 'expand-leaf')) {
			return // клик на листе
		}

		// определить новый класс для узла
		var newClass = hasClass(node, 'expand-open') ? 'expand-closed' : 'expand-open'
		// заменить текущий класс на newClass
		// регексп находит отдельно стоящий open|close и меняет на newClass
		var re =  /(^|\s)(expand-open|expand-closed)(\s|$)/
		setTimeout(() => node.className = node.className.replace(re, '$1'+newClass+'$3'), 200)
	})
})();

(() => {
	const mobilePhoneNodes = document.querySelectorAll('.mobile-phone-masked');
	if(!mobilePhoneNodes.length)
		return;
	mobilePhoneNodes.forEach(node => Inputmask({"mask": "+7(999)999-9999"}).mask(node))

})();

(() => {
	const pricesFilterForm = document.forms.prices_filter_form;
	if(!pricesFilterForm)
		return;
	pricesFilterForm.querySelectorAll('input').forEach(input => {
		const inputValue = (new URL(location.href)).searchParams.get(input.name);
		input.value = inputValue ? inputValue : '';
	});

	pricesFilterForm.addEventListener('submit', (e) => {
		e.preventDefault();
		const url = new URL(location.href);
		pricesFilterForm.querySelectorAll('input').forEach(input => {
			if(input.value != '')
				url.searchParams.set(input.name, input.value);
			else
				url.searchParams.delete(input.name);
		});
		location.href = url.href;
	});
})();

(() => {
    const fulltextFilterForm = document.forms.fulltext_form;
    if(!fulltextFilterForm)
        return;
    const input = fulltextFilterForm.querySelector('input[name="fts"]');
    const inputValue = (new URL(location.href)).searchParams.get(input.name);
    input.value = inputValue ? inputValue : '';

    fulltextFilterForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const url = new URL(location.href);
        if(input.value != '')
            url.searchParams.set(input.name, input.value);
        else
            url.searchParams.delete(input.name);
        location.href = url.href;
    });
})();

// window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
