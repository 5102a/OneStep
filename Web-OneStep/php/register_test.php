<?php

require_once __DIR__ . "./sms/index.php";

use Qcloud\Sms\SmsSingleSender;


header('Access-Control-Allow-Origin:*');
// header("refresh:3;url=http://localhost/index.html");
$arr = require "./config.php";
include "./function.php";
$link = connect($arr);
$res = @$_POST;

/*
**************注册验证***********
*/

// var_dump(@$res['tel']);
//手机号验证 查重
if (@$res['tel']) {
  $sql = "select tel from user_info";
  $res_sql = mysqli_query($link, $sql);
  // $list = array(mysqli_fetch_assoc($res_sql));
  while ($result = mysqli_fetch_assoc($res_sql)) {
    //数据库中存在手机号
    if ($res['tel'] == $result['tel']) {
      echo 'disable';
      exit;
    }
  }
  if (@$res["sms"]) {
    // echo 0;
    exit;
  }
} else {
  //没接收到tel
  echo 'disable';
  exit;
}


// $sql='select message,time from user_temp where tel=13290735717';
// $res_sql = mysqli_query($link, $sql);
// var_dump(mysqli_fetch_assoc($res_sql));
// exit;


//短信验证码,tel可用，检查验证码是否有效
if (@$res["check"]) {
  $sql = 'select message,time from user_temp where tel=' . $res['tel'];
  $res_sql = mysqli_query($link, $sql);
  while ($result = mysqli_fetch_assoc($res_sql)) {
    if ($result['message'] == $res["check"] && time() - $result['time'] < 300) {
      $sql = "insert into user_info values(null,null,default," . $res["tel"] . ",null,\"" . $res["password"] . "\",null)";
      // echo $sql;
      echo (mysqli_query($link, $sql) ? 'success' :     header("Location:http://localhost/login.php?mag_register=error"));
      exit;
    }
  }
  // echo 'error';
  header("Location:http://localhost/login.php?mag_register=error");
} else {
  // SDK AppID 以1400开头
  $appid = 1400307914;
  // 短信应用 SDK AppKey
  $appkey = "cf434ff8e9d8b7cb5fb9ec14399ac6a4";
  // 短信模板 ID，需要在短信控制台中申请
  $templateId = 528595;
  // NOTE: 签名参数使用的是`签名内容`，而不
  $smsSign = "5102it";
  // 需要发送短信的手机号码
  $phoneNumbers = [@$res["tel"]];
  try {
    // $ssender = new SmsSingleSender($appid, $appkey);
    //短信参数
    // $rand = random_int(100000, 999999);
    $rand = 111111;
    $params = [$rand, "5"];
    // $result_sms = $ssender->sendWithParam("86", $phoneNumbers[0], $templateId, $params, $smsSign, "", "");
    // $rsp = json_decode($result_sms);
    // $rsp->ext = time();
    // $result_sms = json_encode($rsp);
    $sql = "insert into user_temp values(null," . $res["tel"] . ",\"" . sha1($rand) . "\"," . time() . ")";
    // var_dump($sql);
    echo (mysqli_query($link, $sql) ? 'success' :  header("Location:http://localhost/login.php?mag_register=error")); //0成功 1失败
    // echo $result_sms;
    // echo $rand;

  } catch (\Exception $e) {
    // echo var_dump($e);
    // echo 'error';
    header("Location:http://localhost/login.php?mag_register=error");
  }

  // echo '{"result":0,"errmsg":"OK","ext":""}';
}
