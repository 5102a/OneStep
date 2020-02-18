<?php




$state_arr = array(
  "change_head" => 200,
  "change_name" => 200,
  "change_gender" => 200,
  "change_password" => 200,
  "change_tel" => 200,
  "change_email" => 200,
  "check_date" => 200,
  "delete_account" => 200,
  "delete_file" => 200
);

$callback_data = array();

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
 * 
 * 400其他验证
 * *401手机验证
 * *402短信验证
 */



@$arry = require "./config.php";
include "./function.php";
@$link = connect(@$arry);
extract(@$_POST);


//有上传文件
if (@$_FILES['up_img']['name']) {
  //当前时间
  @$date = date('Y-m-d-H-i-s');
  //获取上传文件名（包括后缀）
  @$file_name = @$_FILES['up_img']['name'];
  //允许上传图片类型
  @$type = array("jfif", "pjpeg", "pjp", "jpeg", "jpg", "gif", 'png', 'bmp');
  //拆分获取图片名
  @$ext = explode(".", @$file_name);
  //取图片的后缀名
  @$ext = @$ext[count(@$ext) - 1];
  //判断上传文件类型是否符合
  if (in_array(@$ext, @$type)) {
    //文件要保存的dir
    @$path = '../userfiles/' . @$user_tel;
    //判断dir不存在
    if (!is_dir(@$path)) {
      //新建dir失败
      if (!@mkdir(@$path)) {
        //状态码101
        $state_arr["change_head"] = 101;
      }
    }
    //创建服务器保存文件名
    @$new_name = 'img-' . @$user_tel . '.' . @$ext;
    //保存文件具体路径
    @$path = '../userfiles/' . @$user_tel . '/' . @$new_name;
    //获取temp中文件名
    @$temp_file = @$_FILES['up_img']['tmp_name'];

    // include_once('connect.php'); //连接数据库
    // @$result = @$link->query('SELECT * FROM user_img WHERE tel ="'.@$user_tel.'"');

    //查找表user_img中对应tel的数据
    @$sql = 'SELECT * FROM user_img WHERE tel ="' . @$user_tel . '"';
    @$result = mysqli_query(@$link, @$sql);
    //存在数据
    if (mysqli_fetch_assoc(@$result)) {
      //更新保存日期
      @$sql = 'update user_img set date="' . @$date . '" where tel="' . @$user_tel . '"';
      @$result = mysqli_query(@$link, @$sql);
    } else {
      //不存在数据   插入日期和保存文件名
      @$sql = 'insert into user_img values(null,"' . @$user_tel . '","' . @$new_name . '","' . @$date . '")';
      @$result = mysqli_query(@$link, @$sql);
    }

    //数据库操作成功
    if (@$result) {
      //文件存在
      if (file_exists(@$path)) {
        //删除文件失败
        if (!@unlink(@$path)) {
          $state_arr["change_head"] = 102;
        }
      }
      // echo @$temp_file, @$path;
      //移动保存文件失败
      if (!move_uploaded_file(@$temp_file, @$path)) {
        $state_arr["change_head"] = 103;
      }
      //移动成功
      $state_arr["change_head"] = 100;
      // @$arr['detail']=[@$title,@$author,@$content,@$path];
    } else {
      //数据库操作失败
      $state_arr["change_head"] = 202;
    }
  } else {
    //类型错误
    $state_arr["change_head"] = 104;
  }
}


//修改昵称
if (@$user_tel && @$user_name) {
  //替换name
  @$sql = 'update user_info set name="' . @$user_name . '" where tel="' . @$user_tel . '"';
  @$result = mysqli_query(@$link, @$sql);
  //数据库操作成功
  if (@$result) {
    $state_arr["change_name"] = 200;
  } else {
    //数据库操作失败
    $state_arr["change_name"] = 202;
  }
}
// .attr("checked",true).siblings().attr("checked", false)

//修改性别
if (@$user_tel && @$user_gender) {
  //更新
  @$sql = 'update user_info set gender="' . @$user_gender . '" where tel="' . @$user_tel . '"';
  @$result = mysqli_query(@$link, @$sql);
  //数据库操作成功
  if (@$result) {
    $state_arr["change_gender"] = 200;
  } else {
    //数据库操作失败
    $state_arr["change_gender"] = 202;
  }
}


//修改登录密码
if (@$user_tel && @$user_newpassword) {
  //更新
  @$sql = 'update user_info set password="' . @$user_newpassword . '" where tel="' . @$user_tel . '"';
  @$result = mysqli_query(@$link, @$sql);
  //数据库操作成功
  if (@$result) {
    $state_arr["change_password"] = 200;
  } else {
    //数据库操作失败
    $state_arr["change_password"] = 202;
  }
}


//查看登录记录
if (@$user_tel && @$user_logintime) {
  //查看登录记录
  @$sql = 'select distinct logintimes from user_login_times where tel="' . @$user_tel . '" order by logintimes desc limit 5';
  @$res_sql = mysqli_query(@$link, @$sql);
  @$list = array();
  //取数据近5次登录
  while (@$result = mysqli_fetch_assoc(@$res_sql)) {
    @$list[count(@$list)] = @$result['logintimes'];
  }
  //数据库操作成功
  if (@$list) {
    $state_arr["check_date"] = 200;
    $callback_data["check_date"] = json_encode(@$list);
  } else {
    //数据库操作失败
    $state_arr["check_date"] = 202;
  }
}


//删除目录
function removeDir($dirName)
{
  //不是dir
  if (!is_dir($dirName)) {
    return false;
  }
  //创建流
  $handle = @opendir($dirName);
  while ($file = @readdir($dirName)) {
    //不是。/。。
    if ($file != "." && $file != "..") {
      $dir = $dirName . "/" . $file;
      //递归删除
      is_dir($dir) ? @removeDir($dir) : @unlink($dir);
    }
  }
  //关闭流
  closedir($handle);
  //返回删除结果

  return rmdir($dirName);
}



//注销账号
if (@$user_tel && @$state) {
  //删除数据库temp数据
  @$sql = 'delete from user_temp where tel="' . @$user_tel . '"';
  @$result = mysqli_query(@$link, @$sql);
  //删除登录记录
  @$sql = 'delete from user_login_times where tel="' . @$user_tel . '"';
  @$result = mysqli_query(@$link, @$sql);
  //删除img数据
  @$sql = 'delete from user_img where tel="' . @$user_tel . '"';
  @$result = mysqli_query(@$link, @$sql);

  //保存文件dir
  @$path = "../userfiles/" . @$user_tel;
  //删除成功
  if (removeDir(@$path)) {
    //更新数据库，注销账号state：注销
    $sql = 'update user_info set state="注销" where tel="' . @$user_tel . '"';
    if (@mysqli_query(@$link, @$sql)) {
      //数据库操作成功
      $state_arr["delete_account"] = 200;
    } else {
      //数据库注销账号失败
      $state_arr["delete_account"] = 202;
    }
  } else {
    //删除dir失败
    $state_arr["delete_account"] = 105;
    $sql = 'update user_info set state="2" where tel="' . @$user_tel . '"';
    if (@mysqli_query(@$link, @$sql)) {
      //数据库操作成功
      $state_arr["delete_account"] = 200;
    } else {
      //数据库注销账号失败
      $state_arr["delete_account"] = 202;
    }
  }
}








//返回数据
// var_dump($callback_data);
$res = array($state_arr, $callback_data);

echo json_encode($res);

// echo json_encode(@$arr);
exit;
