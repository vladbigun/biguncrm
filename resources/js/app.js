 require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
import router from './router';
import App from './components/App';
import Navbar from './components/parts/Navbar';
 Vue.component('navbar', Navbar);
 Vue.use(VueRouter);



const app = new Vue({
	el: '#app',
	render : h => h(App),
	router
});