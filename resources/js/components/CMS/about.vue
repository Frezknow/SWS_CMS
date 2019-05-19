<template>
 <div id="aboutComponent">
   <div id="BG-Images" v-if="user.email">
     <a class="HideBGImages" @click="ToggleDiv('#BG-Images')">Hide Images</a>
     <center><b>Double click the desired image to update your background-image</b></center><br/>
     <img v-for="(img,i) in BGImages" @dblclick="UpdateBGImage(img.id,i)" :src="'http://127.0.0.1:8000/'+img.images"/>
   </div>
     <input v-if="user.email" class="UpdatedBGImage" type="file" @change="UpdateBGImage('','')"/>
     <input  v-if="user.email" type='color' id="body" v-on:change="changeBG('body')"/>
   <div class="CMSHeader" id="aboutHeader">
    <input  v-if="user.email" type='color' id="CMSHeader" v-on:change="changeBG('.CMSHeader')" />
     <select v-if="user.email" v-on:change="ToggleLayout()" style="top:2px; position:absolute; right:15px;">
       <option value="0">Select Layout</option>
       <option v-for="(l,index) in cssHREFS" v-bind:value="index">Layout {{index+1}}</option>
     </select>
     <center><h3>Your Business name here | CMS</h3></center>
     <a class="ShowBGImages" @click="ToggleDiv('#BG-Images')">Background Images</a>
   </div>
    <a class="CMS_Toggle_nav" @click="toggleMenu">Menu</a>
    <input  v-if="user.email" class="newSliderPics"  type="file" @change="AddSlides" multiple/>
    <div id="aboutSlider">
      <div class="slide">
        <a class="slideDelete" v-if="user.email" @click="DeleteSlider(currentImage)">X</a>
       <a class="left" @click="slide(-1,currentImage)">&lt;</a>
       <a class="right" @click="slide(1,currentImage)">&gt;</a>
       <img :src="'http://127.0.0.1:8000/'+this.slider[0].images" v-if="this.slider[0]!=null" />
     </div>
    </div>
    <a class="toggleAddContent aboutAddContent" v-if="user.email" @click="toggleAddContent">Add Content</a>
    <div id="addContent">
     <textarea id="newContent" class="newContent" v-focus></textarea><button @click="add()">Update about</button>
    </div>
    <br/>
    <div id="aboutContent">
       <input  v-if="user.email" type='color' id="welcomeContentBG" v-on:change="changeBG('#aboutContent')"/><br/>
      <div class="abouts" v-for="(about,index) in abouts" v-if="about.type==''">
        <!-- Admin Only -->
       <a class="aboutDelete" @click="deleteAbout(index)" v-if="user.email">delete?</a>
       <!-- Admin on double click -->
      <div class="about" @dblclick="edit(index)" v-html="about.content" v-if="user.email"></div>
      <div class="about"  v-html="about.content" v-if="!user.email"></div>
      <div :class="'AboutEditContainer AboutEditContainer'+index">
       <textarea :id="'aboutEdit'+index" :class="'aboutEdit aboutEdit'+index" v-model="about.content" @blur="doneEdit(index)" @keyup.enter="doneEdit(index)" @keyup.esc="cancelEdit(index)"/></textarea>
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
        cssHREFS:[
          'http://127.0.0.1:8000/css/CMS_Dynamic_Layout.css',
          'http://127.0.0.1:8000/css/CMS_Dynamic_Layout2.css'
        ],
        user:{},
        newContent:"",
        body:"",
        CMSHeader:"",
        BGImages:Array,
        abouts:[],
        beforeEditCache:"",
        slider:[],
        currentImage:0,
      }
    },
    directives:{
     focus:{
      inserted:function(el){
        el.focus()
        var newContent = new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','removeformat','indent','outdent','hr','forecolor','bgcolor','link','fontSize','fontFamily','fontFormat','html']}).panelInstance('newContent',{hasPanel : true});
      }
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
     axios.get('/cms/Abouts')
         .then(response=>{
           console.log(response)
           self.abouts = response.data;
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
           console.log(error);
         })
       var vm = this;
      axios.get('/cms/GetBackgroundImages?page=about')
         .then(response=>{
           vm.BGImages = response.data
         })
         .catch(e=>{
           alert(e);
         })
      axios.get('/cms/Abouts/Slider')
       .then(response=>{
         console.log(response);
         var slides =response.data;
         self.slider = slides;
       }).catch(error=>{
         console.log(error);
       })
    },
    props:['layout'],
    computed:{
      token:window.Laravel.csrfToken
    },
    methods:{
      ToggleDiv(div){
        $(div).toggle();
      },
      changeBG(div){
        var color = $(event.target).val();
        axios.post('/cms/editBG_Color_About',{
          color:color,
          type:div,
        })
        .then(r=>{
              $(div).css("background-color",color);
              $(div).css("background-image","");
        })
        .catch(e=>{
          //alert(e);
        });
      },
      DeleteSlider(i){
        var sm = this;
        var id = this.slider[i].id;
        var go = confirm("Are you sure you wanted to delete this about slider?");
        if(go===true){
        axios.delete('/cms/deleteSlider/'+id,)
        .then(r=>{
              //remove slider from slider array
              sm.slider.splice(i,1);
        })
        .catch(e=>{
          //alert(e);
        });}
      },
      toggleAddContent(){
         $('#addContent').toggle();
         $('#addContent .nicEdit-panelContain').parent().width('100%');
         // nicEdit-main
         $('#addContent .nicEdit-main').width('100%');
         $('#addContent .nicEdit-main').parent().width('100%');
      },
      slide(dir,i){
         this.currentImage = dir+i;
         var slides =this.slider.length -1;
         if(this.currentImage<0) this.currentImage=slides;
         if(this.currentImage>slides)this.currentImage=0;
         var src = "http://127.0.0.1:8000/"+this.slider[this.currentImage].images;
         $('.slide img').attr('src',src);
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
        axios.post('/cms/Abouts/UpdateBGImage',formData,{
           headers:{
             'Content-Type':'multipart/form-data'
           }
        }).then(response=>{
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
      AddSlides(){
         let formData = new FormData();
         var imgs = $('.newSliderPics').prop('files')
         for(var f=0; f<imgs.length; f++){
           formData.append('imgs[]',imgs[f]);
         }
           formData.append('type',"slider");
           formData.append('content',"slider");
         var self = this;
         axios.defaults.headers.common["Authorization"] = 'Token '+this.token;
         axios.post('/cms/Abouts/addSlide',formData,{
            headers:{
              'Content-Type':'multipart/form-data'
            }
         }).then(response=>{
           console.log(response);
           self.slider.unshift(response.data);
         }).catch(error=>{
           console.log(error);
         })
      },
      edit(i){
        this.beforeEditCache = this.abouts[i].content;
        $('.AboutEditContainer'+i).show();
        //$('.edit'+i).show();
        this.area1 = new nicEditor({fullPanel : true}).panelInstance('aboutEdit'+i,{hasPanel : true});
        $('.AboutEditContainer'+i+' .nicEdit-panelContain').parent().width('100%');
        // nicEdit-main
        $('.AboutEditContainer'+i+' .nicEdit-main').width('100%');
        $('.AboutEditContainer'+i+' .nicEdit-main').parent().width('100%');
        var aboutBGColor = $('#aboutContent').css("background-color");
        $('.AboutEditContainer'+i+' .nicEdit-main').css('background-color',aboutBGColor)
      },
      doneEdit(i){
        if(this.abouts[i].content.trim()==''){
          this.abouts[i].content = this.beforeEditCache;
        }
        $('.AboutEditContainer'+i).hide();
        this.abouts[i].content = $('.AboutEditContainer'+i+' .nicEdit-main').html();
        axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
        axios.put('/cms/Abouts/'+this.abouts[i].id,{
          id:this.abouts[i].id,
          content:this.abouts[i].content,
          owner:this.abouts[i].owner,
        }).then(response=>{
          console.log(response)
          alert("Page was updated.")
        }).catch(error=>{
          console.log(error)
        });
      },
      cancelEdit(i){
         this.abouts[i].content = this.beforeEditCache;
      },
      add(){
        var self = this;
        var newContent = $('.nicEdit-main').html();
        axios.post('/cms/Abouts',{
          content:newContent,
          _token:this.token,
          type:"",
          imgs:""
        }).then(response=>{
          self.abouts.unshift(response.data);
          console.log(response);
        }).catch(error=>{
          console.log(error);
        })
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
          page:1,
          layout:l
        }).then(response=>{
          console.log(response)
          alert("Page layout was updated.")
        }).catch(error=>{
          console.log(error)
        });
       },
       deleteAbout(i){
         var go = confirm("Are you sure you want to delete this content?");
         var sm = this;
        if(go === true){
         axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
         axios.delete('/cms/Abouts/'+sm.abouts[i].id).then(response=>{
           console.log(response)
           alert("Page was updated.")
           sm.abouts.splice(i,1);
          }).catch(error=>{
           console.log(error)
           });
          }

        },
    }
  }
</script>
