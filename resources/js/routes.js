//File isn't in use
import welcomePage from './components/CMS/welcomePage'
import aboutPage from "./components/CMS/aboutPage"
import contactUsPage from "./components/CMS/contactUsPage"
const routes =[
   {
     path:'/',
     name:'welcome',
     component:welcomePage,
     props:{
      page:0
     }
   },
   {
     path:'/About',
     name:'about',
     component:aboutPage,
      props:{
        page:1
      }
   },
   {
     path:'/Contact',
     name:'contactUs',
     component:contactUsPage,
     props:{
       page:2
     }
   },
]

export default routes
