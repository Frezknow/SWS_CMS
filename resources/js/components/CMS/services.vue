<template>
  <div id="welcomeComponent">
    <div id="BG-Images" v-if="user.email">
      <a class="HideBGImages" @click="ToggleDiv('#BG-Images')">Hide Images</a>
      <center><b>Double click the desired image to update your background-image</b></center><br/>
      <img v-for="(img,i) in BGImages" @dblclick="UpdateBGImage(img.id,i)" v-if="img.image!=''" :src="'http://127.0.0.1:8000/'+img.image"/>
    </div>
      <input v-if="user.email" class="UpdatedBGImage" type="file" @change="UpdateBGImage('','')"/>
      <input v-if="user.email" type='color' id ="body" v-on:change="changeBG('body')"/>

    <div class="CMSHeader">
      <select v-if="user.email" v-on:change="ToggleLayout()">
        <option value="0">Select Layout</option>
        <option v-for="(l,index) in cssHREFS" v-bind:value="index">Layout {{index+1}}</option>
      </select>
      <input v-if="user.email" type='color' v-on:change="changeBG('.CMSHeader')" />
      <a class="ShowBGImages" @click="ToggleDiv('#BG-Images')">Background Images</a>
      <center><h2>Your Business name here | CMS</h2></center>
      <br/>
    </div>
      <a v-if="user.email" class="toggleAddContent welcomeAddContent" @click="toggleAddContent">Add Content</a>
     <a class="CMS_Toggle_nav" @click="toggleMenu">Menu</a>
     <div id="addContent" style="position:absolute; color:#000; top:20%; overflow-y:scroll;">
       <a class="absoluteRight" @click="toggleAddContent">Hide</a><br/>
       <input type="text" class="title" placeholder="Title"/>
       <textarea class="newContent description" placeholder="Description"></textarea>
       <input type="file" class="files"/>
       <button class="postButton" @click="Add()">Add</button>
       <br/>
     </div>
     <div id="serviceContent">
      <input v-if="user.email" type='color' id="serviceContentBG" v-on:change="changeBG('#serviceContent')"/>
      <i class="dbclickReminder">Double click a service to see more!</i><br/>
      <div :style="'background-image:url(http://127.0.0.1:8000/'+s.image+')'" class="service" v-for="(s,index) in services" :key="s.id" v-if="s.type==''" :index="index"  @dblclick="ToggleDiv('.ServiceDetails'+index)">
        <!-- Admin only -->
        <a v-if="user.email" class="absoluteRight" @click="deleteService(index)">delete?</a>
        <!-- Double click only for admin -->
        <div  v-if="user.email" class="content"  @dblclick="editWelcome(index)" v-html="s.title"></div>
        <div v-if="!user.email" class="content"  v-html="s.title"></div>
     <!-- Admin only -->
      <div style="display:none;"id="EditContainer" :class="'EditContainer'+index">
       <textarea  :id="'edit'+index" :class="'edit edit'+index" type="text"  v-html="s.title" @blur="doneEdit(index)" @keyup.enter="doneEdit(index)"  v-focus>
       </textarea>
       <!-- <button @click="cancelEdit(index)">Cancel</button> -->
       <button @click="doneEdit(index)">Save</button>
      </div>
      <div :style="'background-image:url(http://127.0.0.1:8000/'+s.image+')'" id="ServiceDetails" :class="'ServiceDetails'+index">
         <a style="width:100px;" class="absoluteRight" @click="ToggleDiv('.ServiceDetails'+index)">Hide Details</a><br/>
         <b>{{s.title}}</b><br/>
         <p>{{s.description}}</p>
         <div v-if="user.email">
           <input type="text" v-model="s.title"/>
           <br/>
           <textarea v-model="s.description"></textarea>
           <br/>
           <input type="button" value="Save Service?" class="btn btn-primary" @click="UpdateService(index)"/>
         </div>
         <div class="serviceRequest">
            <h3>Request service and or more details below </h3>
           <form action="#" class="" v-on:submit.prevent="requestService(index)">
             <input type="text" v-model="requestName" placeholder="Name"/>
             <input type="email" v-model="requestEmail" name="email" id="" placeholder="Email"><br/>
             <textarea name="message" v-model="requestMessage" id="" cols="30" rows="10" placeholder="Message here.."></textarea>
             <br/><input type="submit" value="Send message?">
           </form>
         </div>
      </div>
     </div>
     </div>
  </div>

</template>
<script>
export default{
  data(){
    return{
      area1:Object,
      area2:Object,
      user:Object,
      BGImages:Array,
      cssHREFS:[
        'http://127.0.0.1:8000/css/CMS_Dynamic_Layout.css',
        'http://127.0.0.1:8000/css/CMS_Dynamic_Layout2.css'
      ],
      requestEmail:'',
      requestMessage:'',
      requestName:'',
      services:[
      ],
      service:{
       editing:Boolean,
       content:String,
       owner:String
     },
      beforeEditCache:"",
    }
  },
  created:function(){
     var self = this;
     axios.get('/cms/user')
     .then(response=>{
       self.user = response.data;
     })
     .catch(error=>{
       console.log(error);
     });
      axios.get('/cms/Services').then(response=>{
            console.log(response)
                self.services = response.data
            _.forEach(response.data,function(item){
              if(item.type!=""){
                $(item.type).css("background-color",item.description);
                if(item.selected==1){
                  var image = "http://127.0.0.1:8000/"+item.image;
                  $(item.type).css("background-image","url("+image+")");
                }
             }
            })
      }).catch(error=>{
        console.log(error)
      });
      var vm = this;
      axios.get('/cms/GetBackgroundImages?page=services')
      .then(response=>{
        vm.BGImages = response.data
      })
      .catch(e=>{
        alert(e);
      })
  },
  props:['layout'],
  computed:{
    token:window.Laravel.csrfToken
  },
  watch:{
    Service(){
      this.editing = this.service.editing,
      this.content = this.service.content
    },
  },
  directives:{
   focus:{
    inserted:function(el){
      el.focus()
    }
   }
  },
  methods:{
    requestService(i){
      var title = this.services[i].title;
      var self = this;
      var img = this.services[i].image;
      var token = window.Laravel.csrfToken;
      var formData = new FormData();
      formData.append('title',title);
      formData.append('name',this.requestName);
      formData.append('email',this.requestEmail);
      formData.append('img',img);
      formData.append('message',this.requestMessage);
      formData.append('_token',token);
      //axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
      this.$http.post('/Services/Request',formData,
        {
          headers:{
            'Content-Type':'multipart/form-data'
          }
        })
      .then(r=>{
        alert("Message was sent regarding services, we will be in contact as soon as possible.")
        console.log(r);
      })
      .catch(e=>{
        console.log(e);
      })
    },
    ToggleDiv(div){
      $(div).toggle();
    },
    changeBG(div){
      var color = $(event.target).val();
      axios.post('/cms/editBG_Color_Services',{
        color:color,
        type:div,
        page:"services"
      })
      .then(r=>{
            $(div).css("background-color",color);
            $(div).css("background-image","");
      })
      .catch(e=>{
        //alert(e);
      });
    },
    toggleAddContent(){
       $('#addContent').toggle();
       $('#addContent .nicEdit-panelContain').parent().width('100%');
       // nicEdit-main
       $('#addContent .nicEdit-main').width('100%');
       $('#addContent .nicEdit-main').parent().width('100%');
    },
    UpdateBGImage(id,i){
      let formData = new FormData();
      if(id==''){
         var imgs = $('.UpdatedBGImage').prop('files')
        for(var f=0; f<imgs.length; f++){
          formData.append('imgs[]',imgs[f]);
        }
       }
        formData.append('id',id);
        formData.append('type',"body");
      var self = this;
      axios.defaults.headers.common["Authorization"] = 'Token '+this.token;
      axios.post('/cms/Services/UpdateBGImage',formData,{
         headers:{
           'Content-Type':'multipart/form-data'
         }
      }).then(response=>{
        console.log(response.data);
        alert("Success");
        if(id==""){
          var image = "http://127.0.0.1:8000/"+ response.data.image;
          $('body').css('background-image','url('+image+')');
          self.BGImages.push(response.data);
        }
        if(id!="")$('body').css('background-image','url(http://127.0.0.1:8000/'+self.BGImages[i].images+')')
      }).catch(error=>{
        console.log(error);
      })
    },
    Add(){
      //get data
      let formData = new FormData();
      var files =  $('.files').prop('files');
      var title = $('.title').val();
      var description = $('.description').val();
      formData.append('title',title);
      formData.append('description',description);
      var len= files.length;
         for(var f=0; f<len; f++){
             formData.append("imgs[]", files[f]);
         }
      //add data
      var self = this;
      axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
      axios.post('/cms/Services',formData,
        {
          headers:{
            'Content-Type':'multipart/form-data'
          }
        }).then(response=>{
        console.log(response)
            self.services.unshift(response.data);
            alert("Service page has been updated.")
      }).catch(error=>{
        console.log(error)
      });
    },
    toggleMenu(){
      $('#CMSnav').toggle('slideDown');
    },
    ToggleLayout(){
       var l = $('select').val();
       this.layout =l
       var y = this.cssHREFS[l];
       $('link').attr('href',y);
      axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
      axios.put('/cms/updateLayouts',{
        page:3,
        layout:l
      }).then(response=>{
        console.log(response)
        alert("Page layout was updated.")
      }).catch(error=>{
        console.log(error)
      });
    },
    UpdateService(i){
         //this.beforeEditCache = this.welcomes[i].content
         var title = this.services[i].title;
         var description = this.services[i].description;
         axios.put('/cms/Services/'+this.services[i].id,{
             title:title,
             description:description
         })
         .then(response=>{
           alert("Service was updated.")
         })
         .catch(error=>{
           alert(error)
         });
     },
     // cancelEdit(i){
     //   this.welcomes[i].content = this.beforeEditCache
     //   //this.editing = false
     //   //this.area1.removeInstance('edit'+i);
     //   $('.EditContainer'+i).html(this.beforeEditCache);
     //   $('.EditContainer'+i).hide();
     // },
     deleteService(i){
       var go = confirm("Are you sure you want to delete this service?");
      if(go === true){
       axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
       axios.delete('/cms/Services/'+this.services[i].id).then(response=>{
         console.log(response)
         alert("Page was updated.")
         this.services.splice(i,1);
        }).catch(error=>{
         console.log(error)
         });
        }

      },
     }
}

</script>
