<!DOCTYPE html>
<html lang="zh-cn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>登录</title>
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="stylesheet" href="css/base.css">
  <link rel="stylesheet" href="css/login.css">
  <style>
    .tip {
      display: none;
      z-index: 5;
      left: 50%;
      top: 4%;
      position: fixed;
      width: 200px;
      height: 40px;
      margin-left: -100px;
      border-radius: 5px;
      text-align: center;
      line-height: 40px;
      font-size: 18px;
      color: white;
    }
  </style>
</head>

<body>
  <div class="w">

    <!-- 头部 -->
    <header>
      <div class="logo">
        <a href="./index.php"><img src="logo5102IT.png"></a>
      </div>
    </header>

    <div class="tip">
      发送成功
    </div>

    <!-- main -->
    <div class="registerarea">
      <h3>老用户登录
        <div class="login">我没账号去<a href="./register.php">注册</a></div>
      </h3>
      <form id="form" action="http://localhost/php/login_test.php" method="POST">
        <div class="login_form">
          <ul>
            <li><label for="tel">手机号：</label><input type="number" id="tel" name="user_tel" value="13290735717">
              <span class="tap" id="tel_t">请输入11位手机号</span>
            </li>

            <li class="mag_login"><label for="check">短信验证码：</label><input type="number" id="check" name="check" readonly>
              <span id="check_t"><button type="button" class="button">发送验证</button></span>
            </li>

            <li class="pwd_login"><label for="password">登录密码：</label><input type="password" id="password" name="user_password">
              <span class="tap" id="password_t">请输入6-15位密码</span>
            </li>

            <li>
              <a href="javascript:;" id="pwd_login">使用短信登录</a>
            </li>
            
            <input style="display: none;" id="login_meth" name="login_meth" value="0">
            <li><input type="submit" value="登录" id="submit"></li>

          </ul>
        </div>
      </form>


    </div>


    <!-- foot -->
    <footer>
      <div class="footer">
        <div class="mod_copyright">
          <div class="contact">
            <ul>
              <li><a href="Mailto:1015355299@qq.com">1015355299@qq.com</a></li>
              <li>&copy; 2019 5102IT版权所有</li>
            </ul>
          </div>
        </div>

        <div class="beian">
          <img src="img/beian.png">
          <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=35012802000155">
            <p>闽公网安备 35012802000155号</p>
          </a>
        </div>
      </div>
    </footer>

  </div>

</body>
<script src="./js/jquery-3.4.1.js"></script>
<script src="./js/sha1.js"></script>
<!-- <script src="./js/jquery.form.js"></script> -->
<script src="./js/login.js"></script>

</html>

