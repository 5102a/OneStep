<!DOCTYPE html>
<html lang="zh-cn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <title>自定义标题-个人开发网站、自定义测试网页</title>
  <!-- 网站说明 -->
  <meta name="description" content="个人开发热爱者-dir网站" />
  <meta name="keywords" content="网站初学者-动漫、二次元" />
  <link rel="shortcut icon" href="./favicon.ico" />
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/index.css">
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
  <!-- 快捷导航 -->
  <section class="shortcut">
    <div class="w">
      <div class="nav">
        <div class="logo">
          <h1>
            <a  title="这是logo" >logo网站名</a>
          </h1>
        </div>
        <div class="search">
          <input type="search" name="" id="" placeholder="输入搜索内容">
          <button></button>
        </div>
        <div class="loginbar">
          <ul>
            <li class="login"><a href="./login.php">登录</a></li>
            <li class="logon"><a href="./register.php">免费注册</a></li>
            <li>
             
              <button  class="user_head"><img src="./img/user_head.png" ></button>
            
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- 头部 -->
  <header class="header w">

  </header>
  <div class="tip">客官近来可好！</div>

  <!-- main -->
  <!-- 主页轮播图 -->
  <div class="hot">
    <ul>
      <li><img src="./img/homepage1.jpg"></li>
      <li><img src="./img/homepage2.jpg"></li>
      <li><img src="./img/homepage3.jpg"></li>
      <li><img src="./img/homepage4.jpg"></li>
    </ul>
    <a href="javascript:;" class="left_arrow"></a>
    <a href="javascript:;" class="right_arrow"></a>
    <!-- 圆点 -->
    <ol class="hot_nav">
      <!-- 动态生成 -->
    </ol>
  </div>




  <!-- 友情链接 -->
  <div class="guide">
    <div class="w">
      <div class="links">
        <ul>
          <li><a href="https://github.com/github">
              <img src="./img/github.png"></a>
          </li>
          <li><a href="https://www.microsoft.com/zh-cn/">
              <img src="./img/microsoft.png"></a></li>
          <li></li>
          <li></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- 底部 -->
  <footer class="footer">

    <div class="w">

      <div class="mod_service">
        <ul>
          <li><a href="https://github.com/github">
              <img src="./img/service.png"></a>
          </li>
          <li><a href="https://github.com/github">
              <img src="./img/service.png"></a>
          </li>
          <li><a href="https://github.com/github">
              <img src="./img/service.png"></a>
          </li>
          <li><a href="https://github.com/github">
              <img src="./img/service.png"></a>
          </li>
        </ul>
      </div>

      <div class="mod_help">

        <div class="buttom_logo">
          <a>
            <h2>&nbsp;5102IT</h2>
          </a>
        </div>

        <div class="support">
          <ul>
            <li><a href="https://www.baidu.com">脚本</a></li>
            <li><a href="https://www.baidu.com">关于</a></li>
            <li><a href="https://www.baidu.com">服务</a></li>
            <li><a href="https://www.baidu.com">价格</a></li>
            <li><a href="https://www.baidu.com">记录</a></li>
          </ul>
        </div>

        <div class="mod_copyright">
          <div class="contact">
            <ul>
              <li><a href="Mailto:1015355299@qq.com">1015355299@qq.com</a></li>
              <li>&copy; 2019 5102IT版权所有</li>
            </ul>
          </div>
        </div>

        <div class="beian">
          <img src="./img/beian.png">
          <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=35012802000155">
            <p>闽公网安备 35012802000155号</p>
          </a>
        </div>

      </div>

    </div>

  </footer>
</body>

</html>
<script src="./js/jquery-3.4.1.js"></script>
<script src="./js/animate.js"></script>
<script src="./js/index.js"></script>

<?php
require_once "./php/index_test.php";

?>