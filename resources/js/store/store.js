import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
export const store = new Vuex.Store({
  state:{
    id:111,
    cssHREFS:[
      'css/CMS_Dynamic_Layout.css',
      'css/CMS_Dynamic_Layout2.css'
    ],
    layouts:[

    ],
    page:null
  },
  //What is the fucking difference between mutations and getters?
  mutations:{

  },
  getters:{

  },
  actions:{

  }
})
