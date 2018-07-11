<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>websocket_TEST</title>
</head>
<body>
<textarea class="log" style="width: 100%; height: 500px;">
=======在线客服======
</textarea>
<input type="button" value="连线客服" onClick="link()">
<input type="button" value="挂断" onClick="dis()">
<input type="text" id="text">
<input type="button" value="发送" onClick="send()">
<script type="text/javascript" src="http://test-wap.dawennet.com/platform/platform_js/jquery-1.9.1.min.js?t=2017062202112266"></script>
<script>
function link(){
  var url='ws://xx.xxx.xxx:8000';
  socket=new WebSocket(url);
  socket.onopen=function(){log('连接客服成功')}
  socket.onmessage=function(msg){log('获得消息:'+msg.data);console.log(msg);}
  socket.onclose=function(){log('断开连接')}
}
function dis(){
  D('disdis');
  socket.close();
  socket=null;
}
function log(var1){
  $('.log').append(var1+"\r\n");
}
function send(){
  if($('#text').val().length>0)
  {
    socket.send($('#text').val());
  }
  $('#text').val('');
}
function send2(){
  var json = JSON.stringify({'type':'php','msg':$('#text2').attr('value')})
  socket.send(json);
}
</script>
</body>
</html>