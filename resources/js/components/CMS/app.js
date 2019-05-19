/**

* First we will load all of this project's JavaScript dependencies which

* includes Vue and other libraries. It is a great starting point when

* building robust, powerful web applications using Vue and Laravel.

*/

require('./bootstrap');

/**

* Next, we will create a fresh Vue application instance and attach it to

* the page. Then, you may begin adding components to this application

* or customize the JavaScript scaffolding to fit your unique needs.

*/
import Vue from 'vue';

import VueResource from "vue-resource"

import Echo from "laravel-echo"

//import Pusher from "pusher-js"

//import VueRouter from 'vue-router'
// import routes from './routes'
// import {store} from './store/store'
Vue.use(VueResource);
Vue.config.devtools = false;
Vue.config.productionTip = false;
// export const EventBus = new Vue();
// const router = new VueRouter({
//    routes
// })

//Below is for blogs

import welcomeComponent from './components/CMS/welcome'
import aboutComponent from './components/CMS/about'
import contactComponent from './components/CMS/contact'

//  const app =new Vue({
//    el:"#app",
//    data:{
//     blogs:[],
//     message:'Hello'
//   },
//   mounted:function(){
//     var self = this;
//   },
//   components:{
//     blogscomponent,
//   },
//   props:['myName','myEmail'],
//   store:store,
//
// });


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
     'layout'.
   ]
 })
