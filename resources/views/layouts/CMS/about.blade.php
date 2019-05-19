<html>
<head>
  <style>
 .img{
   position: relative; display:inline-block; width:40px; height:40px; border-radius:2px;
 }
  body{
      background-size:100% 100%; background-repeat: no-repeat;
  }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
     <script>
         window.Laravel = <?php echo json_encode([
             'csrfToken' => csrf_token(),
         ]); ?>
     </script>
  <title>Sanford WS | CMS</title>
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> -->
  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  <link  href="{{asset('viewerjs/dist/viewer.css')}}" rel="stylesheet">
  <script src="{{ asset('js/jquery.js')}}"></script>
  <script src="{{ asset('js/menu.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <script src="{{asset('viewerjs/dist/viewer.js')}}">
   import Viewer from 'viewerjs';
  </script>
  <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
  <script type="text/javascript">
       bkLib.onDomLoaded(function() { nicEditors.allTextAreas({buttonList : ['bold','italic','underline','left','center','right','justify','removeformat','indent','outdent','hr','forecolor','bgcolor','link','fontSize','fontFamily','fontFormat','html']}) });
  </script>
  <style>
   body{
    background-size:cover;
    background-repeat:no-repeat;
   }
  </style>
  <?php
  $layouts = array(
    'css/CMS_Dynamic_Layout.css',
    'css/CMS_Dynamic_Layout2.css'
  );

  ?>
  <link href="{{asset($layouts[$layout])}}" rel="stylesheet">
</head>
<body>
<div  id="container">
  <div class="CMS">
    <div id="aboutComponent">
      @include('layouts.CMS.menu')
      <about-component layout="{{$layout}}"></about-component>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.21/dist/vue.js"></script>
<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
