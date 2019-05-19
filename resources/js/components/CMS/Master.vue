<template>
    <div id="cmsComponent">
      <link href="" rel="stylesheet">
      <div class="CMSHeader">
        <center><h2>Your Business name here | CMS</h2></center>
      </div>
       <a class="CMS_Toggle_nav" @click="toggleMenu">Menu</a>
       <div class="CMSEdit" @click="ToggleLayout(page)">Toggle</div>
       <ul id="CMSnav">
        <li @click="changeLayout(layouts[0])"><router-link to="/">Welcome</router-link></li>
        <li @click="changeLayout(layouts[1])"><router-link to="/About">About</router-link></li>
        <li @click="changeLayout(layouts[2])"><router-link to="/Contact">Contact us</router-link></li>
      </ul>
      <div id="app">
        <router-view id="CMS_Content"></router-view>
      </div>
    </div>
</template>
<script>
 export default{
   created:function(){
    this.$store.state.layouts = this.layouts
   },
   props:['layoutArray'],
   data(){
     return{

     }
   },
   computed:{
      layouts:function(){
        return this.layoutArray.split(',')
      },

   },
   methods:{
     toggleMenu(){
       $('#CMSnav').toggle('slideDown');
     },
     //The below function changes the layout based on the page being referenced
     changeLayout(y){
             var y = this.$store.state.cssHREFS[y];
             $('link').attr('href',y);
         },
     ToggleLayout(page){
       var b;
       var l = this.$store.state.layouts[page]
       if(l==0) b=1;
       if(l==1) b=0;
        this.$store.state.layouts[page] =b
        var y = this.$store.state.cssHREFS[b];
        $('link').attr('href',y);
       axios.put('/CMS/updateLayouts',{
         layouts:this.layouts.join(","),
       }).then(response=>{
         console.log(response)
       }).catch(error=>{
         console.log(error)
       });
      }
     }
 }
</script>
<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  font-size:18px;
}
</style>
