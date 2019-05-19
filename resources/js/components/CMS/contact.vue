<template>
  <div id="welcomeComponent">
    <div id="BG-Images" v-if="user.email">
      <a class="HideBGImages" @click="ToggleDiv('#BG-Images')">Hide Images</a>
      <center><b>Double click the desired image to update your background-image</b></center><br/>
      <img v-for="(img,i) in BGImages" @dblclick="UpdateBGImage(img.id,i)" :src="'http://127.0.0.1:8000/'+img.images"/>
    </div>
    <input class="UpdatedBGImage" type="file" @change="UpdateBGImage('','')" v-if="user.email"/>
    <input type='color' id="body" v-on:change="changeBG('body')" v-if="user.email"/>
      <div class="CMSHeader" id="contactHeader">
        <a class="ShowBGImages" @click="ToggleDiv('#BG-Images')">Background Images</a>
        <input type='color' id="CMSHeader" v-on:change="changeBG('.CMSHeader')"  v-if="user.email"/>
        <select v-on:change="ToggleLayout()" v-if="user.email">
          <option>Select Layout</option>
          <option v-for="(l,index) in cssHREFS" v-bind:value="index">Layout {{index+1}}</option>
        </select>
        <center><h2>Your Business name here | CMS</h2></center>
      </div>
       <a class="CMS_Toggle_nav" @click="toggleMenu">Menu</a>
       <div class="contactContent">
         <input type='color' id="body" v-on:change="changeBG('.contactContent')" v-if="user.email"/>
        <div class="contact" v-for="(contact,index) in contacts" v-if="contact.type==''">
          <p @dblclick="editContact(index)" v-html="contact.content" v-if="user.email"></p>
          <p  v-html="contact.content" v-if="!user.email"></p>
          <div style="display:none;"id="EditContainer" :class="'EditContainer'+index">
            <textarea  :id="'edit'+index" :class="'edit edit'+index" type="text"  v-html="contact.content" @blur="doneEdit(index)" @keyup.enter="doneEdit(index)" @keyup.esc="cancelEdit" v-focus>
            </textarea>
            <!-- <button @click="cancelEdit(index)">Cancel</button> -->
            <button @click="doneEdit(index)">Save</button>
          </div>
        </div>
        <div class="email">
          <center>
            <h3 v-if="FormVerbage.content==''">Email us below</h3>
            <h3 v-if="FormVerbage.content!=''">{{FormVerbage.content}}</h3>
            <a @click="ToggleDiv('.editFormVerbage')" v-if="user.email">Edit</a><br/>
            <div class="editFormVerbage" style="display:none;">
             <input type="text" v-model="FormVerbage.content"/>
             <a @click="ToggleDiv('.editFormVerbage'); updateFormVerbage();">Save</a>
            </div>
          </center>
          <form id="emailForm" v-on:submit.prevent>
            <input name="name" type="text" placeholder="Name" required/>
             <br/>
            <input name="email" type="text" placeholder="Email" required/>
             <br/>
            <input name="phone" type="text" placeholder="Phone"/>
             <br/>
            <textarea name="content" class="emailTextArea"></textarea>
            <input type="submit" @click="sendEmail()" value="Send email"/>
          </form>
        </div>
       </div>
  </div>
</template>
<script>
export default{
  data(){
    return{
      user:{},
      beforeEditCache:'',
      body:"",
      BGImages:Array,
      contactBGColor:"",
      CMSHeader:"",
      FormVerbage:"",
      cssHREFS:[
        'http://127.0.0.1:8000/css/CMS_Dynamic_Layout.css',
        'http://127.0.0.1:8000/css/CMS_Dynamic_Layout2.css'
      ],
      contacts:[]
    }
  },
  created:function(){
    var vm = this
    axios.get('/cms/user')
    .then(response=>{
      vm.user = response.data;
    })
    .catch(error=>{
      console.log(error);
    });
    axios.get('/cms/Contacts')
     .then(response=>{
        vm.contacts = response.data
        _.forEach(response.data,function(item){
          if(item.type!="" && item.type!="slider"){
            $(item.type).css("background-color",item.content);
            // if(item.type=="body"){
            //   var image = "http://127.0.0.1:8000/"+item.images;
            //   $(item.type).css("background-image","url("+image+")");
            // }
            if(item.type=="#ContactFormVerbage"){
              vm.FormVerbage = item
            }
            if(item.type==".contactContent"){
              vm.contactBGColor = item.content
            }
            if(item.selected ==1){
                var image = "http://127.0.0.1:8000/"+item.images
                $('body').css('background-image',"url("+image+")");
            }
         }
        })
        console.log(response.data);
     })
     .catch(error=>{
       console.log(error);
     });
     var vm = this;
     axios.get('/cms/GetBackgroundImages?page=contact')
     .then(response=>{
       vm.BGImages = response.data
       // var image = "http://127.0.0.1:8000/"+vm.BGImages[vm.BGImages.length-1].images;
       // $('body').css('background-image',"url("+image+")");
     })
     .catch(e=>{
       alert(e);
     })
     $('#emailForm .nicEdit-panelContain').parent().width('100%');
     // nicEdit-main
     $('#emailForm .nicEdit-main').width('100%');
     $('#emailForm .nicEdit-main').parent().width('100%');
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
          var vm = this;
          var color = $(event.target).val();
          axios.post('/cms/editBG_Color_Contact',{
            color:color,
            type:div,
          })
          .then(r=>{
                $(div).css("background-color",color);
                vm.contactBGColor =color;
                $(div).css("background-image","");
          })
          .catch(e=>{
            //alert(e);
          });
        },
        UpdateBGImage(id,i){
          let formData = new FormData();
          if(id==""){
          var imgs = $('.UpdatedBGImage').prop('files')
          for(var f=0; f<imgs.length; f++){
            formData.append('imgs[]',imgs[f]);
          }}
            formData.append('id',id);
            formData.append('type',"body");
          var self = this;
          axios.defaults.headers.common["Authorization"] = 'Token '+this.token;
          axios.post('/cms/Contacts/UpdateBGImage',formData,{
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
            if(id!=""){
              $('body').css('background-image','url(http://127.0.0.1:8000/'+self.BGImages[i].images+')')
            }
          }).catch(error=>{
            console.log(error);
          })
        },
    updateFormVerbage(){
          var vm = this;
          axios.put('/cms/updateFormVerbage/'+vm.FormVerbage.id,{
            FormVerbage:vm.FormVerbage.content
          })
          .then(r=>{
             alert("Saved");
          })
          .catch(e=>{
            alert(e);
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
        page:2,
        layout:l
      }).then(response=>{
        console.log(response)
        alert("Page layout was updated.")
      }).catch(error=>{
        console.log(error)
      });
    },
    editContact(i){
         this.beforeEditCache = this.contacts[i].content
           $('.EditContainer'+i).show();
           $('.edit'+i).show();
         this.area1 = new nicEditor({buttonList : ['bold','italic','underline','left','center','right','justify','removeformat','indent','outdent','hr','forecolor','bgcolor','link','fontSize','fontFamily','fontFormat','html']}).panelInstance('edit'+i,{hasPanel : true});
         $('.EditContainer'+i+' .nicEdit-panelContain').parent().width('100%');
         // nicEdit-main
         $('.EditContainer'+i+' .nicEdit-main').width('100%');
         $('.EditContainer'+i+' .nicEdit-main').parent().width('100%');
         //this.contactBGColor = String($('.contactContent').css("background-color"));
         $('.EditContainer'+i+' .nicEdit-main').css('background-color',this.contactBGColor);
     },
     doneEdit(i){
       if(this.contacts[i].content.trim()==''){
         this.contacts[i].content = this.beforeEditCache
       }
      // this.editing = false
       $('.EditContainer'+i).hide();
       this.contacts[i].content = $('.EditContainer'+i+' .nicEdit-main').html();
       this.area1.removeInstance('edit'+i);
      axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
      axios.put('/cms/Contacts/'+this.contacts[i].id,{
        id:this.contacts[i].id,
        content:this.contacts[i].content
      }).then(response=>{
        console.log(response)
        alert("Page was updated.")
      }).catch(error=>{
        console.log(error)
      });
     },
     cancelEdit(i){
       this.contacts[i].content = this.beforeEditCache
       $('.EditContainer'+i).html(this.beforeEditCache);
       $('.EditContainer'+i).hide();
       this.area1.removeInstance('edit'+i);
     },
     sendEmail(){
        let form = document.getElementById('emailForm');
        let formData = new FormData(form);
        axios.defaults.headers.common["Authorization"] = 'Token ' + this.token
       axios.post('/cms/Contacts/Email',formData,
         {
           headers:{
            'Content-Type': 'text/plain;charset=utf-8',
           }
         })
       .then(response=>{
         alert("Your email was sent. We will be in contact.");
       })
       .catch(error=>{
         alert("Error occurred please try again.");
         console.log(error);
       })
     }
    }
  }

</script>
