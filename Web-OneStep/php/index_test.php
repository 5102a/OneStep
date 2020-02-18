<?php

// echo $_SERVER['HTTP_REFERER'];

extract(@$_GET);




echo
  '<script>
  if(document.querySelector("form")){
        setInterval(function(){
          var resp=null;
          var file_data = new FormData(document.querySelector("form"));
          file_data.set("refresh","1");
          file_data.set("user_tel",' . @$user_tel . ');
          $.ajax({
            type: "post",
            url: "http://localhost/php/login_test.php",
            data: file_data,
            processData: false,
            contentType: false,
            success: function (response) {
              response = JSON.parse(response);
              resp=response.res_data;
              resp = JSON.parse(resp);
              // console.dir(resp);
              $(".logo a").attr("href","./index.php?user_tel=' . @$user_tel . '");
              $.each(resp, function (indexInArray, valueOfElement) { 
                
                  if(indexInArray=="user_gender"){
                    $("input[name="+indexInArray+"]").eq(valueOfElement).attr("checked",true).siblings().attr("checked", false);
                  }else{
                    $("input[name="+indexInArray+"]").val(valueOfElement);
                  }
              
              
              });
            }
          })

        }(),500);
}else if('.@$user_tel.'){
  setInterval(function(){
    var resp=null;
    var file_data = new FormData();
    file_data.set("img","1");
    file_data.set("refresh","1");
    file_data.set("user_tel","' . @$user_tel . '");
    $.ajax({
      type: "post",
      url: "http://localhost/php/login_test.php",
      data: file_data,
      processData: false,
      contentType: false,
      success: function (response) {
        response = JSON.parse(response);
        resp=response.res_data;
        resp = JSON.parse(resp);
        // console.dir(resp);
        $(".loginbar .login").hide();
        $(".loginbar .logon").hide();
        $(".loginbar .user_head").show();
      }
    })

    
  }(),1000);

}
</script>';

// $(".tip").html("' . $str . '").show();
// setTimeout(function () {
//   $(".tip").hide();
// }, 2000)


// function outTohtml($str)
// { 
// //      $.each(' . json_encode($_GET) . ', function (indexInArray, valueOfElement) { 
// //   if(indexInArray=="user_gender"){
// //     $("input[name="+indexInArray+"]").eq(valueOfElement).attr("checked",true).siblings().attr("checked", false);
// //   }else{
// //     $("input[name="+indexInArray+"]").val(valueOfElement);
// //   }

// // });

//   echo


//   exit;
// }



// switch (@$_GET['mag_jump']) {
//   case 'register':
//     outTohtml("恭喜客官，首次登门！");
//     break;
//   case 'login':
//     outTohtml("客官，您才来呀！");
//     break;
//     // case 'login':
//     //   outTohtml("客官，您才来呀！");
//     //   break;
//     // case 'login':
//     //   outTohtml("客官，您才来呀！");
//     //   break;
//   default:

//     break;
// }

// switch (@$_GET['mag_change']) {
//   case 'error':
//     outTohtml("修改失败，请检查完成后再提交！");
//     break;
//   case 'success':
//     outTohtml("恭喜客官，修改成功！");
//     break;
//   default:

//     break;
// }



// $arr = require "./php/config.php";
// include "./php/function.php";
// $link = connect($arr);
// $paths='../userfiles/'.$tel;

























// function getFile($path)
// {
//   $handle = @opendir($path);
//   $file=null;
//   while ($file = @readdir($path)) {
//     if ($file != '.' && $file != '..') {
//       $ext = explode(".", $file);
//       if($ext[0]=="img-".$tel){
//         $dir = $path . '/' . $file;
//         $file=readfile($dir);
//       }
//     }
//   }
//   closedir($handle);
//   return $file;
// }

// echo getFile($path);














// $content = file_get_contents('php://input');
// $post    = json_decode($content, true);
// echo 111;
// var_dump($post);
