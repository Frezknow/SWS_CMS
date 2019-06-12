/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueResource from "vue-resource"
Vue.use(VueResource);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//cms
import welcomeComponent from './components/CMS/welcome'
import aboutComponent from './components/CMS/about'
import contactComponent from './components/CMS/contact'
import servicesComponent from './components/CMS/services'

// Below are all registered components for the cms system

const welcome = new Vue({
   el:'#welcomeComponent',
   components:{welcomeComponent},
   props:[
     'layout',
   ],

 })
 const about = new Vue({
    el:'#aboutComponent',
    components:{aboutComponent},
    props:[
      'layout',
    ],

  })

 const contact = new Vue({
   el:'#contactComponent',
   components:{contactComponent},
   props:[
     'layout',
   ]
 })
 const services = new Vue({
  el:'#servicesComponent',
  components:{servicesComponent},
  props:[
    'layout',
  ]
})
