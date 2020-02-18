<?php





// function do_post(@$url, @$params, @$headers)
// {

//   @$ch = curl_init();

//   curl_setopt(@$ch, CURLOPT_URL, @$url);

//   curl_setopt(@$ch, CURLOPT_RETURNTRANSFER, 1);

//   curl_setopt(@$ch, CURLOPT_CUSTOMREQUEST, 'POST');

//   curl_setopt(@$ch, CURLOPT_POSTFIELDS, @$params);

//   curl_setopt(@$ch, CURLOPT_HTTPHEADER, @$headers);

//   curl_setopt(@$ch, CURLOPT_TIMEOUT, 60);
//   @$result = curl_exec(@$ch);

//   curl_close(@$ch);
//   return @$result;
// }

//  @$url = "http://localhost/index.php";

//  @$params = '{"tel":"' . @$res["tel"] . '","password":"' . @$res["password"] . '","check":"' . @$check . '"}';

//  @$headers = array(
//    "Content-Type:application/json;charset=utf-8",
//    "Accept:application/json;charset=utf-8"
//  );    //json序列化
//  // @$params = json_encode(@$params);
//  @$result = do_post(@$url, @$params, @$headers);
//  echo json_encode(@$result);


/**
 * 需获取的信息
 * 1、tel
 * 2、name
 * 3、password
 * 4、email
 * 5、gender
 * 6、lastlogintime
 * 7、headimg
 * 8、check
 */




//短信api
require_once __DIR__ . "./sms/index.php";

use Qcloud\Sms\SmsSingleSender;



header('Access-Control-Allow-Origin:*');
@$arr = require "./config.php";
include "./function.php";
@$link = connect(@$arr);
extract(@$_POST);


@$state_code = array(
  "check_tel" => 200,
  "check_sms" => 200,
  "check_pwd" => 200,
  "res_data" => 200
);

/**错误码
 * 100系列文件操作
 * *100成功操作
 * *101新建dir失败
 * *102删除文件失败
 * *103移动文件失败
 * *104文件类型错误
 * *105删除dir失败
 * 
 * 200系列数据库操作
 * *200数据库操作成功
 * *201数据库写入失败
 * *202数据库未知失败
 * *203数据库查看失败
 * 
 * 
 * 300系列短信手机密码验证
 * *301手机注册验证失败，已注册
 * *302手机登录验证失败，未注册
 * *303未获取到手机号
 * *304未知短信验证成功
 * *305短信验证码无效
 * *306未发送验证码
 * *307密码验证失败
 * *308未知短信验证失败
 * *309手机号已注销
 * 
 * 400其他验证
 * *401手机验证
 * *402短信验证
 */







// var_dump(@$_POST);
// exit;




if (!@$refresh) {
  @$date = date('Y-m-d-H-i-s');
  //手机号验证 查重 非修改手机
  if (!@$user_newtel && (@$tel == 'register' || @$tel == 'login')) {
    //存在手机号
    if (@$user_tel) {

      @$sql = 'select * from user_info where tel="' . @$user_tel . '"';
      @$res_sql = mysqli_query(@$link, @$sql);
      //存在账号
      if (@$result = mysqli_fetch_assoc(@$res_sql)) {
        //登录验证通过
        if (@$tel == 'login') {
          if (@$result['state'] == "注销") {
            @$state_code["check_tel"] = 309;
          } else {
            @$state_code["check_tel"] = 200;
          }
        } else if (@$tel == 'register') {
          //注册验证失败
          @$state_code["check_tel"] = 301;
        } else if (@$login) {
          //登录手机号验证
          if (@$result['state'] == "注销") {
            @$state_code["check_tel"] = 309;
          } else {
            @$state_code["check_tel"] = 200;
          }
        } else {
          //其他手机号验证
          @$state_code["check_tel"] = 401;
        }
      } else {
        //不存在账号
        if (@$tel == 'login') {
          @$state_code["check_tel"] = 302;
        } else if (@$tel == 'register') {
          @$state_code["check_tel"] = 200;
        } else {
          //其他手机号验证
          @$state_code["check_tel"] = 401;
        }
      }
    } else {
      //未获取到user_tel
      @$state_code["check_tel"] = 303;
    }
  }


  //判断是否为更换手机号
  @$user_tel = @$user_newtel ? @$user_newtel : @$user_tel;

  //验证码 验证（非密码验证）
  if (@$login_meth != "0") {
    //验证短信验证码
    if (@$check) {
      //查看对应手机号上次发送的验证码及时间
      @$sql = 'select message,time from user_temp where tel="' . @$user_tel . '"';
      @$res_sql = mysqli_query(@$link, @$sql);
      //标志
      @$flag = 0;
      //获取临时验证码集
      while (@$result = mysqli_fetch_assoc(@$res_sql)) {
        //匹配验证码及生效期5min
        if (@$result['message'] == @$check && time() - @$result['time'] < 300) {
          //短信登录成功
          if (@$login_meth == "1" && @$login) {
            //跳转到主页面 附带用户数据
            @$sql = 'insert into user_login_times values(null,"' . @$user_tel . '","' . @$date . '")';
            @$state_code["check_sms"] = @mysqli_query(@$link, @$sql) ? 200 : 201;
            @$sql = 'update user_info set logintime="' . @$date . '" where tel="' . @$user_tel . '"';
            @$state_code["check_sms"] = @mysqli_query(@$link, @$sql) ? 200 : 201;
            // header("Location:http://localhost/index.php?" . @$resp);
            @$flag = 2;
          } else if (@$user_password && @$register) {
            //短信注册验证成功
            //id,name,gender,tel,email,password,logintime,state
            @$sql = 'insert into user_info values(null,null,default,"' . @$user_tel . '",null,"'
              . @$user_password . '","' . @$date . '",default)';
            //用户注册数据插入数据库成功
            if (mysqli_query(@$link, @$sql)) {
              //首次注册跳转到用户信息管理界面
              @$sql = 'insert into user_login_times values(null,"' . @$user_tel . '","' . @$date . '")';
              @$state_code["check_sms"] = @mysqli_query(@$link, @$sql) ? 200 : 201;
              // @$sql = 'update user_info set logintime="' . @$date . '" where tel="' . @$user_tel . '"';
              // @$state_code["check_sms"] = @mysqli_query(@$link, @$sql) ? 200 : 201;
              // header("Location:http://localhost/usermanage.php?" . @$resp);
              @$flag = 3;
            } else {
              //用户注册数据插入失败
              @$state_code["check_sms"] = 201;
            }
          } else if (@$user_newtel) {
            //修改手机号（换绑验证成功）@$_POST['user_tel']=>原手机号
            @$sql = 'update user_info set tel="' . @$user_tel . '" where tel="' . @$_POST['user_tel'] . '"';
            if (mysqli_query(@$link, @$sql)) {
              //数据库更新手机号成功
              //用户管理界面不跳转
              @$flag = 4;
            } else {
              //数据库更新手机号失败
              @$state_code["check_sms"] = 201;
            }
          } else {
            //未知短信验证成功
            @$state_code["check_sms"] = 304;
          }
        }
      }
      //无验证码
      //flag==0无验证码集未发送过验证码
      if (@$flag == 0 && @$state_code["check_sms"] == 200) {
        if (@$login_meth == "1") {
          //短信登录失败不跳转
          @$state_code["check_sms"] = 305;
        } else {
          //其他短信验证失败 不跳转
          @$state_code["check_sms"] = 308;
        }
      }
      // else if (@$flag==1 && @$state_code["check_sms"] = 200) {
      //   //验证码过期或错误  有遍历且未匹配到验证码
      //   @$state_code["check_sms"] = 305;
      // }
    } else if (@$login_meth == "1" || !@$check) {
      //发送短信验证码（登录或表单有短信验证按钮且没内容）

      // SDK AppID 以1400开头
      @$appid = 1400307914;
      // 短信应用 SDK AppKey
      @$appkey = "cf434ff8e9d8b7cb5fb9ec14399ac6a4";
      // 短信模板 ID，需要在短信控制台中申请
      @$templateId = 528595;
      // NOTE: 签名参数使用的是`签名内容`，而不
      @$smsSign = "5102it";
      // 需要发送短信的手机号码
      @$phoneNumbers = [@$user_tel];

      //短信参数
      // @$rand = random_int(100000, 999999);
      @$rand = 111111; //验证码随机数
      @$params = [@$rand, "5"]; //短信模板参数
      //调用api发送短信
      // @$result_sms = @$ssender->sendWithParam("86", @$phoneNumbers[0], @$templateId, @$params, @$smsSign, "", "");
      // @$rsp = json_decode(@$result_sms);
      // @$rsp->ext = time();
      // @$result_sms = json_encode(@$rsp);
      //插入temp临时短信验证码表id,tel,message,time=>10位时间戳
      @$sql = 'insert into user_temp values(null,"' . @$user_tel . '","' . sha1(@$rand) . '","' . time() . '")';
      if (mysqli_query(@$link, @$sql)) {
        //数据库插入发送的验证码成功
      } else {
        //数据库插入发送的验证码失败
        @$state_code["check_sms"] = 201;
      }
      // echo '{"result":0,"errmsg":"OK","ext":""}';
    } else {
      //非短信验证或短信发送
      @$state_code["check_sms"] = 402;
    }
  } else if (@$login_meth == "0" && @$login) {
    //密码验证（登录）
    @$sql = 'select password from user_info where tel=' . @$user_tel;
    @$res_sql = mysqli_query(@$link, @$sql);
    @$result = mysqli_fetch_assoc(@$res_sql);
    //数据库查看登录密码操作成功
    if (@$result) {
      //密码正确成功登录
      if (@$user_password == @$result["password"]) {
        //主页跳转
        @$sql = 'insert into user_login_times values(null,"' . @$user_tel . '","' . @$date . '")';
        @$state_code["check_sms"] = @mysqli_query(@$link, @$sql) ? 200 : 201;
        @$sql = 'update user_info set logintime="' . @$date . '" where tel="' . @$user_tel . '"';
        @$state_code["check_sms"] = @mysqli_query(@$link, @$sql) ? 200 : 201;
        // header("Location:http://localhost/index.php?" . @$resp);
      } else {
        //登录密码错误
        @$state_code["check_pwd"] = 307;
      }
    } else {
      //数据库查看登录密码操作失败
      @$state_code["check_pwd"] = 203;
    }
  }
}

//返回用户数据，纯文本
$gender = array("男" => 0, "女" => 1, "保密" => 2);
@$sql = 'select * from user_info where tel="' . @$user_tel . '"';
@$res_sql = mysqli_query(@$link, @$sql);
//存在账号
if (@$result = mysqli_fetch_assoc(@$res_sql)) {
  @$user_name = @$result["name"];
  @$user_gender = $gender[@$result["gender"]];
  @$user_tel = @$result["tel"];
  @$user_email = @$result["email"];
  @$user_password = @$result["password"];
  @$state = @$result["state"];
  @$user_logintime = @$result["logintime"];
}

if (@$refresh) {
  @$resp = [
    "user_name" => $user_name, "user_tel" => $user_tel, "user_gender" => $user_gender, "user_email" => $user_email, "user_password" => $user_password, "user_logintime" => $user_logintime, "state" => $state
  ];
  @$resp = json_encode(@$resp);
} else {
  @$resp = "user_name=" . @$user_name . "&user_tel=" . @$user_tel . "&user_gender=" . @$user_gender .
    "&user_email=" . @$user_email . "&user_password=" . @$user_password . "&user_logintime=" . @$date
    . "&state=" . @$state;
}


@$state_code['res_data'] = @$resp;
//返回数据

echo json_encode(@$state_code);
