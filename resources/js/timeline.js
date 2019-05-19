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

import VueResource from "vue-resource"

import Echo from "laravel-echo"

import Pusher from "pusher-js"


Vue.use(VueResource);


window.Echo = new Echo({

   broadcaster: 'pusher',

   key: '47127678734a1b976f0d' //Add your pusher key here

});
import TimelineComponent from 'components/timeline.vue';

  export default {
    data() {
      return {
        timeline: []
      }
    },
    methods: {
      read() {
        window.axios.get('/api/cruds').then(({ data }) => {
     // console.log(data)
      });
      create() {
        // To do
      },
      read() {
        // To do
      },
      update(id, color) {
        // To do
      },
      del(id) {
        // To do
      }
    },
    components: {
      TimelineComponent
    }
  }
