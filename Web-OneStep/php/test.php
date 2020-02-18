<?php
require_once __DIR__ . "./sms/index.php";
use Qcloud\Sms\SmsSingleSender;



header('Access-Control-Allow-Origin:*');
$arr = require "./config.php";
include "./function.php";
$link = connect($arr);
// $sql="insert into user_info values(null,'天天sama',default,'13290735717',null)";


// echo '<pre>';
// var_dump(mysqli_query($link,$sql));

// 验证手机号
$flag=0;
$res = @$_POST;
// if (@$res['tel']) {
//   $sql = "select tel from user_info";
//   $res_sql = mysqli_query($link, $sql);
//   $list = array(mysqli_fetch_assoc($res_sql));
//   while ($result = mysqli_fetch_assoc($res_sql)) {
//     if ($res == $result['tel']) {
//       $flag=1;
//       echo 1;
//       return;
//     }
//   }
//   $flag=0;
//   echo 0;
// }




if (@$res["sms"]&&@$res["tel"]&&$flag==0) {
  // // SDK AppID 以1400开头
  // $appid = 1400307914; 
  // // 短信应用 SDK AppKey
  // $appkey = "cf434ff8e9d8b7cb5fb9ec14399ac6a4";
  // // 短信模板 ID，需要在短信控制台中申请
  // $templateId = 528595;  
  // // NOTE: 签名参数使用的是`签名内容`，而不
  // $smsSign = "5102it"; 
  // // 需要发送短信的手机号码
  // $phoneNumbers = [$res["tel"]];
  // try {
  //   $ssender = new SmsSingleSender($appid, $appkey);
  //   //短信参数
  //   $rand=random_int(100000,999999);
  //   $params = [$rand, "5"];
  //   $result_sms = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId, $params, $smsSign, "", "");
  //   $rsp = json_decode($result_sms);
  //   $rsp->result=time();
  //   $result_sms=json_encode($rsp);
  //   echo $result_sms;
  // } catch (\Exception $e) {
  //   echo var_dump($e);
  // }
  
  echo '{"result":0,"errmsg":"OK","ext":""}';
}





// if (@$res['password']) {
//   $sql = "select tel from user_info";
//   $res_sql = mysqli_query($link, $sql);
//   $list = array(mysqli_fetch_assoc($res_sql));
//   while ($result = mysqli_fetch_assoc($res_sql)) {
//     if ($res == $result['tel']) {
//       echo 1;
//       return;
//     }
//   }
//   echo 0;
// }






// var_dump(mysqli_fetch_assoc($res_sql));
// echo $result;
