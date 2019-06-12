<html>
<head>
  <style>
  #emailContainer{
    position: relative; width: 100%; height:100%; display: block;
    border:2px solid #fff; background-color: #222; color:#fff;
    text-align: center;
  }

  .message{
    width:70%; height:300px; display:block; position: absolute;
    top:20%; left:15%; background-color: #e3e3e3; color:#000;
    font-size: 17pt; overflow-y: scroll; text-align: center;
  }


  </style>
</head>

<body>
<div id="emailContainer">
  <center>
     <h3> From : <b>{{$name}}</b> </h3>
     <br/>
     @if($call!="")<a href="tel:{{$call}}">Call</a>@endif
     <br/>
     <a href="mailto:{{$email}}">Email</a>
    <div class="message">
      {{$content}}
    </div>
  </center>
</div>
</body>

</html>
