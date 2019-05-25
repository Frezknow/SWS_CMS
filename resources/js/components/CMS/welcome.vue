<template>
  <div id="welcomeComponent">
    <div id="BG-Images" v-if="user.email">
      <a class="HideBGImages" @click="ToggleDiv('#BG-Images')">Hide Images</a>
      <center><b>Double click the desired image to update your background-image</b></center><br/>
      <img v-for="(img,i) in BGImages" @dblclick="UpdateBGImage(img.id,i)" :src="'http://127.0.0.1:8000/'+img.images"/>
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
     <div id="addContent">
       <textarea class="newContent"></textarea>
       <input type="file" class="files"/>
       <button class="postButton" @click="Add()">Add</button>
       <br/>
     </div>
     <div id="welcomeContent">
       <input v-if="user.email" type='color' id="welcomeContentBG" v-on:change="changeBG('#welcomeContent')"/><br/>
     <div class="welcome" v-for="(w,index) in welcomes" :key="w.id" v-if="w.type==''" :index="index">
       <!-- Double click only for admin -->
        <div  v-if="user.email" class="content"  @dblclick="editWelcome(index)" v-html="w.content"></div>
       <div v-if="!user.email" class="content"  v-html="w.content"></div>
       <!-- Admin only -->
       <a v-if="user.email" class="aboutDelete" @click="deleteWelcome(index)">delete?</a>
        <!-- <br/>        @keyup.esc="cancelEdit" -->
     <img v-for="(img, index) in w.images.split('$!$')" v-if="img!=''" :src="'http://127.0.0.1:8000/'+img"/>
     <!-- Admin only -->
     <div style="display:none;"id="EditContainer" :class="'EditContainer'+index">
       <textarea  :id="'edit'+index" :class="'edit edit'+index" type="text"  v-html="w.content" @blur="doneEdit(index)" @keyup.enter="doneEdit(index)"  v-focus>
       </textarea>
       <!-- <button @click="cancelEdit(index)">Cancel</button> -->
       <button @click="doneEdit(index)">Save</button>
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
      welcomes:[
      ],
      welcome:{
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
      axios.get('/cms/Welcomes').then(response=>{
            console.log(response)
                self.welcomes = response.data
            _.forEach(response.data,function(item){
              if(item.type!="" && item.type!="slider"){
                $(item.type).css("background-color",item.content);
                if(item.selected==1){
                  var image = "http://127.0.0.1:8000/"+item.images;
                  $(item.type).css("background-image","url("+image+")");
                }
             }
            })
      }).catch(error=>{
        console.log(error)
      });
      var vm = this;
      axios.get('/cms/GetBackgroundImages?page=welcome')
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
    welcome(){
      this.editing = this.welcome.editing,
      this.content = this.welcome.content
    }
  },
  directives:{
   focus:{
    inserted:function(el){
      el.focus()
    }
   }
  },
  methods:{
    ToggleDiv(div){
      $(div).toggle();
    },
    changeBG(div){
      var color = $(event.target).val();
      axios.post('/cms/editBG_Color',{
        color:color,
        type:div,
        page:"welcome"
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
      axios.post('/cms/Welcomes/UpdateBGImage',formData,{
         headers:{
           'Content-Type':'multipart/form-data'
         }
      }).then(response=>{
        console.log(response.data);
        alert("Success");
        if(id==""){
          var image = "http://127.0.0.1:8000/"+ response.data.images;
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
      var newContent = $('.nicEdit-main').html();
      alert(newContent)
      formData.append('content',newContent);
    //  formData.append('files',files);
    //  formData.append('_token',token);
      var len= files.length;
         for(var f=0; f<len; f++){
             formData.append("imgs[]", files[f]);
         }
      //add data
      var self = this;
      axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
      axios.post('/cms/Welcomes',formData,
        {
          headers:{
            'Content-Type':'multipart/form-data'
          }
        }).then(response=>{
        console.log(response)
            self.welcomes.unshift(response.data);
            alert("Welcome page has been update.")
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
        page:0,
        layout:l
      }).then(response=>{
        console.log(response)
        alert("Page layout was updated.")
      }).catch(error=>{
        console.log(error)
      });
    }, editWelcome(i){
         this.beforeEditCache = this.welcomes[i].content
           $('.EditContainer'+i).show();
           $('.edit'+i).show();
         this.area1 = new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','removeformat','indent','outdent','hr','forecolor','bgcolor','link','fontSize','fontFamily','fontFormat','html']}).panelInstance('edit'+i,{hasPanel : true});
         $('.EditContainer'+i+' .nicEdit-panelContain').parent().width('100%');
         // nicEdit-main
         $('.EditContainer'+i+' .nicEdit-main').width('100%');
         $('.EditContainer'+i+' .nicEdit-main').parent().width('100%');
         var welcomeBGColor = $('#welcomeContent').css("background-color");
         $('.EditContainer'+i+' .nicEdit-main').css('background-color',welcomeBGColor)
     },
     doneEdit(i){
       if(this.welcomes[i].content.trim()==''){
         this.welcomes[i].content = this.beforeEditCache
       }
      // this.editing = false
       $('.EditContainer'+i).hide();
       this.welcomes[i].content = $('.EditContainer'+i+' .nicEdit-main').html();
       this.area1.removeInstance('edit'+i);
      axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
      axios.put('/cms/Welcomes/'+this.welcomes[i].id,{
        id:this.welcomes[i].id,
        content:this.welcomes[i].content,
      //  images:this.welcomes[i].images
      }).then(response=>{
        console.log(response)
        alert("Page was updated.")
      }).catch(error=>{
        console.log(error)
      });
     },
     cancelEdit(i){
       this.welcomes[i].content = this.beforeEditCache
       //this.editing = false
       //this.area1.removeInstance('edit'+i);
       $('.EditContainer'+i).html(this.beforeEditCache);
       $('.EditContainer'+i).hide();
     },
     deleteWelcome(i){
       var go = confirm("Are you sure you want to delete this content?");
      if(go === true){
       axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
       axios.delete('/cms/Welcomes/'+this.welcomes[i].id).then(response=>{
         console.log(response)
         alert("Page was updated.")
         this.welcomes.splice(i,1);
        }).catch(error=>{
         console.log(error)
         });
        }

      },
     }
}

</script>
