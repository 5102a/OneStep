<!DOCTYPE html>
<html lang="zh-cn">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" href="./favicon.ico" />
  <link rel="stylesheet" href="./css/base.css">
  <link rel="stylesheet" href="./css/common.css">
  <link rel="stylesheet" href="./css/usermanage.css">
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
  <title>账号管理</title>

</head>

<body>
  <div class="tip">
    发送成功
  </div>
  <!-- 快捷导航 -->
  <section class="shortcut">

    <div class="w">
      <div class="nav">
        <div class="logo">
          <h1>
            <a href="./index.php" title="这是logo">logo网站名</a>
          </h1>
        </div>
        <div class="search">
          <input type="search" name="" id="" placeholder="输入搜索内容">
          <button></button>
        </div>
        <div class="loginbar">
          <ul>
            <li><button class="user_head"><img src="./img/user_head.png"></button></li>
          </ul>
        </div>
      </div>
    </div>
  </section>



  <div class="info">
    <!-- 左侧菜单 -->
    <div class="menu">
      <div class="menu_list_top">
        <div class="head"><img src="./img/user_head.png">
          <p>个人中心</p>
        </div>
      </div>
      <div class="menu_list_center">
        <ul>

          <li class="li_list">
            <div>
              <div class="li_left">账号信息</div>
              <div class="li_right">未完善<img src="./img/next.png"></div>
            </div>
          </li>

          <li class="li_list">
            <div>
              <div class="li_left">登录密码</div>
              <div class="li_right">已设置<img src="./img/next.png"></div>
            </div>
          </li>

          <li class="li_list">
            <div>
              <div class="li_left">绑定手机</div>
              <div class="li_right">已绑定<img src="./img/next.png"></div>
            </div>
          </li>

          <li class="li_list">
            <div>
              <div class="li_left">绑定邮箱</div>
              <div class="li_right">未绑定<img src="./img/next.png"></div>
            </div>
          </li>

        </ul>
      </div>
      <div class="menu_list_foot">
        <ul>
          <li class="li_list">
            <div>
              <div class="li_left">账号注销</div>
              <div class="li_right"><img src="./img/next.png"></div>
            </div>
          </li>
          <li class="li_list">
            <div>
              <div class="li_left">登录记录</div>
              <div class="li_right"><img src="./img/next.png"></div>
            </div>
          </li>
        </ul>
      </div>

    </div>



    <!-- 详情界面 -->
    <div class="main">
      <div class="main_body">

        <div class="main_page ">
          <div class="page_content">
            <div class="user_info">

              <form id="form1" action="http://localhost/php/files.php" method="POST" enctype="multipart/form-data">
                <div id="head_change"><img src="./img/user_head.png">
                  <div>上传头像</div>
                  <input type="hidden" name="MAX_FILE_SIZE" value="20000">
                  <input id="up_img" name="up_img" type="file" accept="image/png,image/gif,image/jpeg" disabled>
                </div>

                <ul class="user_info_m">
                  <li class="left">
                    <div>昵称：</div>
                  </li>
                  <li class="right"><input type="text" name="user_name" value="天天sama" readonly></li>
                  <li class="left">
                    <div>性别：</div>
                  </li>
                  <li class="right" id="radio">
                    <div><input type="radio" name="user_gender" value="1" disabled>男</div>
                    <div><input type="radio" name="user_gender" value="2" disabled>女</div>
                    <div><input type="radio" name="user_gender" value="3" checked disabled>
                      <p>保密</p>
                    </div>
                  </li>
                  <li class="left">
                    <div>登录密码：</div>
                  </li>
                  <li class="right"><input type="password" name="user_password" value="" readonly></li>
                  <li class="left">
                    <div>手机号：</div>
                  </li>
                  <li class="right"><input type="text" name="user_tel" value="" readonly></li>
                  <li class="left">
                    <div>邮箱：</div>
                  </li>
                  <li class="right"><input type="text" name="user_email" value="" readonly></li>
                  <li class="left">
                    <div>上次登录时间：</div>
                  </li>
                  <li class="right">
                    <input id="time" name="user_logintime" value="" readonly>
                  </li>
                  <li><input class="change" type="submit" value="修改资料"></li>
                </ul>
              </form>

            </div>

          </div>
        </div>

        <div class="main_page hide">
          <div class="page_content">
            <div class="user_info">
              <div class="user_info_body">
                <form id="form2" action="http://localhost/php/files.php" method="POST">
                  <ul>
                    <li>
                      <div>用户账号</div><input name="user_tel" value="" readonly>
                    </li>
                    <li>
                      <div>设置新密码</div><input class="can_change" type="password" name="user_newpassword" value="">
                    </li>
                    <li><button>确认修改</button></li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="main_page hide">
          <div class="page_content">
            <div class="user_info">
              <div class="user_info_body">
                <form id="form3" action="http://localhost/php/login_test.php" method="POST">
                  <ul>
                    <li>
                      <div>绑定手机号</div><input type="text" name="user_tel" value="" readonly>
                    </li>
                    <li>
                      <div>修改新手机号</div><input id="user_newtel" class="can_change" name="user_newtel" type="tel" value="">
                      <input class="send_check" type="button" value="发送验证">
                    </li>
                    <li>
                      <div>验证码</div><input id="newtel_check" class="can_change" name="check" type="text" value="">
                    </li>
                    <li><button>确认修改</button></li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="main_page hide">
          <div class="page_content">
            <div class="user_info">
              <div class="user_info_body">
                <form id="form4" action="http://localhost/php/files.php" method="POST">
                  <ul>
                    <li>
                      <input type="text" name="user_tel" value="" style="display: none">
                      <div>绑定邮箱</div><input type="text" name="user_email" value="" readonly>
                    </li>
                    <li>
                      <div>修改绑定邮箱</div><input class="can_change" type="text" value="">
                      <input class="send_check" type="button" value="发送验证">
                    </li>
                    <li>
                      <div>验证码</div><input class="can_change" type="text" value="">
                    </li>
                    <li><button>确认修改</button></li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="main_page hide">
          <div class="page_content">
            <div class="user_info">
              <div class="user_info_body">
                <form id="form5" action="http://localhost/php/files.php" method="POST">
                  <ul>
                    <li>
                      <div>用户账号</div><input type="text" name="user_name" value="" readonly>
                    </li>
                    <li>
                      <div>绑定手机</div><input type="tel" name="user_tel" value="" readonly>
                    </li>
                    <li>
                      <div>绑定邮箱</div><input type="email" name="user_email" value="" readonly>
                    </li>
                    <li>
                      <input type="text" name="state" value="1" style="display: none">
                      <button>确认注销</button>
                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="main_page hide">
          <div class="page_content">
            <div class="user_info">
              <div class="user_info_body">
                <form id="form6" action="http://localhost/php/files.php" method="POST">
                  <ul>
                    <li>
                      <div>用户账号</div><input type="text" name="user_tel" value="" readonly>

                    </li>
                    <li>
                      <input name="user_logintime" value="date" style="display: none">
                      登录记录<div id="parent"></div>

                    </li>
                  </ul>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>


  </div>


</body>

</html>

<script src="./js/jquery-3.4.1.js"></script>
<script src="./js/sha1.js"></script>

<script src="./js/usermanage.js"></script>

<?php

require_once "./php/index_test.php";

?>