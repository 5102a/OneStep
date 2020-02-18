$(function () {





  //手机号验证
  $('#tel').blur(function () {
    if (($('#tel').val() + '').length == 11) {
      var file_data = new FormData(document.querySelector("#form"));
      file_data.set('tel', 'register');
      $.ajax({
        type: "post",
        url: "http://localhost/php/login_test.php",
        data: file_data,
        processData: false,
        contentType: false,
        success: function (response) {
          response = JSON.parse(response);
          // console.dir(response);
          if (response.check_tel == 200) {
            $('#tel_t').removeClass('error').addClass('success').text('手机号可用');
          } else {
            $('#tel_t').removeClass('success').addClass('error').text('手机号已注册');
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



  //检测短信输入框
  // $('#check').blur(function () {
  //   if (!$('#check').hasClass('readonly') && ($('#check').val() + '').length != 0) {
  //     $('#submit').removeAttr('disabled');
  //   } else {
  //     $('#submit').attr('disabled', 'true');
  //   }
  // })


  //密码验证
  $('#password').blur(function () {
    if (($('#password').val() + '').length > 5 && ($('#password').val() + '').length < 16) {
      $('#password_t').removeClass('error').addClass('success').text('密码设置完成');
      if (($('#confirm').val() + '').length != 0) {
        $('#confirm').blur();
      }
    } else {
      $('#password_t').removeClass('success').addClass('error').text('密码不满足要求');
      if (($('#confirm').val() + '').length != 0) {
        $('#confirm').blur();
      }
    }
  })

  //重新输入密码
  $('#confirm').blur(function () {
    if (($('#password').val() + '').length > 5 && ($('#password').val() + '').length < 16 && ($('#confirm').val() + '').length != 0) {
      if ($('#password').val() == $('#confirm').val()) {
        $('#confirm_t').removeClass('error').addClass('success').text('密码验证完成');
      } else {
        $('#confirm_t').removeClass('success').addClass('error').text('2次密码不同');
      }
    } else {
      $('#confirm_t').removeClass('success').removeClass('error').text('重新输入设置密码');
    }
  })


  $('.reg_form ul li #submit').click(function (e) {
    e.preventDefault();
    if ($('#confirm_t').hasClass('success') && $('#password_t').hasClass('success') &&
      $('#tel_t').hasClass('success')&&($('#check').val()+'').length>0) {
      $('#check').attr('type', 'password');
      $('#check').val(hex_sha1($('#check').val()));
      $('#password').val(hex_sha1($('#password').val()));
      $('#confirm').val(hex_sha1($('#confirm').val()));

      var file_data = new FormData(document.querySelector("#form"));
      file_data.set('register', '1');
      // console.dir(file_data);
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
            window.location.href = "http://localhost/usermanage.php?mag_jump=register&" + response.res_data;
          } else {
            alert('注册失败');
          }
        }
      })
    } else {
      alert('请确认信息填写完整');
    }

  });


})