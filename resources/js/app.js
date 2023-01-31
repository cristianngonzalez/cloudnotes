import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

import '@popperjs/core';

import { createApp } from 'vue';


const app = createApp({});

import HomeComponent from './components/HomeComponent.vue'; app.component('home-component', HomeComponent);



app.mount('#app');
