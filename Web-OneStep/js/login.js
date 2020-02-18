$(function () {

  var obj = new Object();
  var flag = 1;
  $('#pwd_login').click(function () {
    flag = (flag + 1) % 2;
    if (flag == 1) {
      $('.mag_login').hide();
      $('.pwd_login').show();
      $('#pwd_login').text('使用短信登录');
      $('#login_meth').val('0');
    } else {
      $('.pwd_login').hide();
      $('.mag_login').show();
      $('#pwd_login').text('使用密码登录');
      $('#login_meth').val('1');
    }
  })

  //手机号验证
  $('#tel').blur(function () {
    if (($('#tel').val() + '').length == 11) {
      var file_data = new FormData(document.querySelector("#form"));
      file_data.set('tel', 'login');
      $.ajax({
        type: "post",
        url: "http://localhost/php/login_test.php",
        data: file_data,
        processData: false,
        contentType: false,
        success: function (response) {
          console.dir(response);
          response = JSON.parse(response);
          if (response.check_tel == 302) {
            $('#tel_t').removeClass('success').addClass('error').text('手机号未注册');
          } else if (response.check_tel == 309) {
            $('#tel_t').removeClass('success').addClass('error').text('手机号已注销');
          } else {
            $('#tel_t').removeClass('error').addClass('success').text('手机号正确');
          }
        }
      })

    } else {
      $('#tel_t').removeClass('success').addClass('error').text('您输入的手机号位数不对');

    }
  })


  //短信倒计时
  $('#check_t .button').click(function () {
    var time = 5;
    var that = $('#check_t .button');
    if ($('#tel_t').hasClass('success')) {
      $('#check').removeAttr('readonly');
      that.attr('disabled', true);
      var timer = setInterval(function () {
        if (time == 0) {
          clearInterval(timer);
          that.removeAttr('disabled');
          that.text('发送验证');
          time = 5;
        } else {
          that.text('还剩下' + time + '秒');
          time--;
        }
      }, 1000);
      var file_data = new FormData(document.querySelector("#form"));
      $.ajax({
        type: "post",
        url: "http://localhost/php/login_test.php",
        data: file_data,
        processData: false,
        contentType: false,
        success: function (response) {
          response = JSON.parse(response);
          // console.dir(response.check_sms);
          if (response.check_sms == 200) {
            $('.tip').text('发送成功');
            $('.tip').show();
            setTimeout(function () {
              $('.tip').hide();
            }, 1000)
          } else {
            $('.tip').text('发送失败');
            $('.tip').show();
            setTimeout(function () {
              $('.tip').hide();
            }, 500)
          }
        }
      });
    } else if (!$('#check').hasClass('readonly')) {
      $('#check').attr('readonly', 'true');
    }
  })


  // //短信框验证
  // $('#check').blur(function () {
  //   // testAll();
  // })

  //密码验证
  $('#password').blur(function () {
    if (($('#password').val() + '').length > 5 && ($('#password').val() + '').length < 16) {
      $('#password_t').removeClass('error').addClass('success').text('密码输入完成');
    } else {
      $('#password_t').removeClass('success').addClass('error').text('密码不满足要求');
    }
  })



  $('#submit').click(function (e) {
    e.preventDefault();
    if ($('#tel_t').hasClass('success')) {
      if ($('.mag_login').css('display') == 'none') {
        $('#password').val(hex_sha1($('#password').val()));
      } else {
        $('#check').attr('type', 'password');
        $('#check').val(hex_sha1($('#check').val()));
      }
      var file_data = new FormData(document.querySelector("#form"));
      file_data.set('login','1');
      $.ajax({
        type: "post",
        url: "http://localhost/php/login_test.php",
        data: file_data,
        processData: false,
        contentType: false,
        success: function (response) {
          response = JSON.parse(response);
          // console.dir(response);
          if (response.check_tel == 200 && response.check_sms == 200 && response.check_pwd == 200) {
            window.location.href = "http://localhost/usermanage.php?mag_jump=login&" + response.res_data;
          } else {
            alert('登录失败');
          }
        }
      })
    }else{
      alert('请确认填写信息！');
    }
  });

  // var res=JSON.parse('.$res.');
  // var res=JSON.parse('.$res.')



})