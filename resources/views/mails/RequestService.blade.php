<html>
<head>
  <style>
  #emailContainer{
    position: relative; width: 100%; height:100%; display: block;
    border:2px solid #fff; background-color: #222;  color:#fff;
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
    <h3>{{$subject}} service request from:<b>{{$name}}</b></h3>
    <div class="message">
      {{$content}}
    </div>
   </center>
  </div>
</body>
</html>
