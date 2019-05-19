
//require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
//import {store} from './store/store'
//window.eventBus = new Vue()
Vue.config.productionTip = false
Vue.use(VueRouter)

 import cmsComponent from './components/CMS/Master'
new Vue({
   el:'#cmsComponent',
   components:{cmsComponent},
   router:router,
   //store:store,
   template:'<cms-Component/>'

 })
