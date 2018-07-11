<?php
include 'websocket.class.php';

$config=array(
  'address'=>'xxx.xx.xx.xx',
  'port'=>'8000',
  'event'=>'WSevent',//回调函数的函数名
  'log'=>true,
);
$websocket = new websocket($config);
$websocket->run();
function WSevent($type,$event){
  global $websocket;
    if('in'==$type){
      $websocket->log('客户进入id:'.$event['k']);
    }elseif('out'==$type){
      $websocket->log('客户退出id:'.$event['k']);
    }elseif('msg'==$type){
      $websocket->log($event['k'].'消息:'.$event['msg']);
      roboot($event['sign'],$event['msg']);
    }
}

function roboot($sign,$t){
  global $websocket;
  switch ($t)
  {
    case 'hello':
      $show='欢迎来到客服系统';
      break;
    case 'name':
      $show='我是小文啊';
      break;
    case 'time':
      $show='当前时间:'.date('Y-m-d H:i:s');
      break;
    case '再见':
      $show='( ^_^ )/~~拜拜';
      $websocket->write($sign,'客服:'.$show);
      $websocket->close($sign);
      return;
      break;
    default:
      $show='你可以尝试提问 发货，物流，库存等问题';
  }
  $websocket->write($sign,'客服:'.$show);
}
