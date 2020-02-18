$(function () {

  //左侧菜单对应page
  $('.menu_list_center li').click(function () {
    $('.main_body .main_page').eq($(this).index()).attr("class", 'main_page')
      .siblings().attr("class", 'main_page hide');
  })

  //查看登录记录页
  $('.menu_list_foot li').click(function () {
    $('.main_body .main_page').eq($(this).index() + 4).attr("class", 'main_page')
      .siblings().attr("class", 'main_page hide');
    if ($(this).is(":nth-child(2)")) {
      var file_data = new FormData(document.querySelector("#form6"));
      $.ajax({
        type: "POST",
        url: "http://localhost/php/files.php",
        data: file_data,
        processData: false,
        contentType: false,
        success: function (response) {
          // console.dir(response);
          response = JSON.parse(response);
          response[1] = JSON.parse(response[1].check_date);
          $('#parent').children().remove();
          if (response[0]['check_date']) {
            $.each(response[1], function (indexInArray, valueOfElement) {
              $('#parent').append('<div id="time" style="margin-top:20px">' + valueOfElement + '</div>');
            });
          }
        }
      });
    }

  })


  //主页修改按钮
  $('#form1 .change').click(function (e) {
    e.preventDefault();
    if ($(this).val() == '修改资料') {
      $(this).val('提交修改');
      $('#form1 input[name="up_img"],[type="radio"]').removeAttr('disabled');
      $('#form1 input[name="user_name"]').removeAttr('readonly');
      $('#form1 input[name="user_name"]').css('background-color', 'rgb(189,247,233)');
    } else {
      var file_data = new FormData(document.querySelector("#form1"));
      if ($('#up_img')[0].files.length > 0) {
        if ($('#up_img')[0].files[0].size > 20480) {
          alert("头像大小不得超过20KB");
          return false;
        }
        file_data.set('up_img', $('#up_img')[0].files[0]);
      }
      file_data.set('user_gender', $('#form1 input[type="radio"]:checked').val());
      $.ajax({
        type: "POST",
        url: "http://localhost/php/files.php",
        data: file_data,
        processData: false,
        contentType: false,
        success: function (response) {
          response = JSON.parse(response)
          var res = '修改成功';
          for (const key in response[0]) {
            if (response[0][key] != 200) {
              res = '修改失败';
            }
          }
          alert(res);
          if (res == '修改成功') {
            $('#form1 .change').val('修改资料');
            $('#form1 input[name="up_img"],[type="radio"]').attr('disabled', true);
            $('#form1 input[name="user_name"]').attr('readonly', true);
            $('#form1 input[name="user_name"]').css('background-color', 'rgb(139,197,183)');
          }
          // console.dir(response);
        }
      });
    }
  })


  //修改密码
  $('.user_info_body #form2 ul li button').click(function (e) {
    e.preventDefault();
    var file_data = new FormData(document.querySelector("#form2"));
    file_data.set('user_newpassword', hex_sha1($('#form2 .can_change').val()) + '')
    $.ajax({
      type: "POST",
      url: "http://localhost/php/files.php",
      data: file_data,
      processData: false,
      contentType: false,
      success: function (response) {
        // console.dir(response);
        response = JSON.parse(response)
        var res = '修改成功';
        for (const key in response[0]) {
          if (response[0][key] != 200) {
            res = '修改失败';
          }
        }
        alert(res);
        console.dir(response);
      }
    });

  })






  //修改绑定手机
  $('.user_info_body #form3 .send_check').click(function () {
    var time = 5;
    var that = $('.user_info_body #form3 .send_check');
    $(this).attr('disabled', true);
    var timer = setInterval(function () {
      if (time == 0) {
        clearInterval(timer);
        that.removeAttr("disabled");
        that.val('发送验证');
        time = 5;
      } else {
        that.val('还剩下' + time + '秒');
        time--;
      }
    }, 1000);
    var file_data = new FormData(document.querySelector("#form3"));

    $.ajax({
      type: "post",
      url: "http://localhost/php/login_test.php",
      data: file_data,
      processData: false,
      contentType: false,
      success: function (response) {
        console.dir(response);
      }
    });
  })

  //绑定邮箱
  // $('.user_info_body #form3 ul li button').click(function (e) {
  //   var file_data = new FormData(document.querySelector("#form3"));
  //   // console.log();
  //   file_data.set('user_newtel', $('#form3 #user_newtel').val());
  //   $('#form3 #newtel_check').attr('type', 'password');
  //   file_data.set('check', $('#form3 #newtel_check').val(hex_sha1($('#form3 #newtel_check').val())));
  //   $.ajax({
  //     type: "POST",
  //     url: "http://localhost/php/login_test.php",
  //     data: file_data,
  //     // dataType: "json",
  //     processData: false, // 不处理数据
  //     contentType: false,
  //     success: function (response) {
  //       console.dir(response);
  //     }
  //   });

  // })





  //注销账号
  $('.user_info_body #form5 ul li button').click(function (e) {
    e.preventDefault();
    if (confirm("确认注销账号，将无法再次注册？")) {
      var file_data = new FormData(document.querySelector("#form5"));
      // console.log();
      $.ajax({
        type: "POST",
        url: "http://localhost/php/files.php",
        data: file_data,
        // dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
          console.dir(response);
          response = JSON.parse(response)
          if (response[0]['delete_account'] != 200) {
            alert('注销失败！');
          } else {
            alert('注销成功！');
            window.location.href = "http://localhost/index.php";
          }
        }
      });
    }
  })





























})