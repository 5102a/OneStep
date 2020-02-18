window.addEventListener('load', function () {
  //获取轮播图左右按钮
  var arrow_l = document.querySelector('.left_arrow');
  var arrow_r = document.querySelector('.right_arrow');
  //获取轮播图最外层div
  var hot = document.querySelector('.hot');
  //轮播图最外层div添加鼠标进入事件
  hot.addEventListener('mouseenter', function () {
    //显示左右按钮
    arrow_l.style.display = 'block';
    arrow_r.style.display = 'block';
    //停止轮播图自动播放
    clearInterval(timer);
    timer = null;
  });
  //轮播图最外层div添加鼠标离开事件
  hot.addEventListener('mouseleave', function () {
    //隐藏左右按钮
    arrow_l.style.display = 'none';
    arrow_r.style.display = 'none';
    //重新设置轮播图自动播放定时器
    timer = setInterval(function () {
      arrow_r.click();
    }, 2000);
  });
  //获取轮播图下的4个展示图ul和ol
  var ul = hot.querySelector('ul');
  var ol = hot.querySelector('ol');
  //获取轮播图宽度
  var hotWidth = hot.offsetWidth;
  //图
  var num = 0;
  //圆点
  var circle = 0;
  //动态创建小园点并且当鼠标点击时切换对应圆点的图和小圆点颜色
  for (var i = 0; i < ul.children.length; i++) {
    //创建小圆点li
    var li = document.createElement('li');
    //设置小圆点的index为i
    li.setAttribute('index', i);
    //添加各圆点ol
    ol.appendChild(li);
    //添加鼠标经过小手
    li.style.cursor = 'pointer';
    //添加鼠标点击小圆点显示当前颜色
    li.addEventListener('click', function () {
      circleChange(this);
      //获取当前图的index
      var index = this.getAttribute('index');
      //对应小圆点赋值
      num = index;
      circle = index;
      //动画变换轮播图
      animate(ul, -index * hotWidth);
    })
  };
  //没点击之前初始化选择第一个图的小圆点颜色
  ol.children[0].className = 'selected';
  //复制第一张图
  var first = ul.children[0].cloneNode(true);
  //添加第一张图到最后现在5张图
  ul.appendChild(first);
  //左右按钮添加鼠标点击事件
  arrow_r.addEventListener('click', function () {
    //如果当前是最后一张图且点击已响应
    if (num == ul.children.length - 1) {
      //跳回第一张
      ul.style.left = 0;
      num = 0;
    }
    //正常自动下一张
    num++;
    //动画过渡
    animate(ul, -num * hotWidth);
    //小圆点计数
    circle++;
    //当前小圆点最后一个且点击已响应
    if (circle == ol.children.length) {
      //跳到第一张
      circle = 0;
    }
    //排他，显示当前小圆点颜色
    circleChange();
  });
  arrow_l.addEventListener('click', function () {
    //如果当前是第一张图且点击已响应
    if (num == 0) {
      //跳到最后一张-1
      num = ul.children.length - 1;
      //最后一张-1图定位
      ul.style.left = -num * hotWidth + 'px';
    }
    num--;
    //动画
    animate(ul, -num * hotWidth);
    //小圆点计数
    circle--;
    //如果现在是第一个小圆点且已点击左按钮，向最后一张切换
    if (circle < 0) {
      //小圆点跳最后一张
      circle = ol.children.length - 1;
    }
    //排他，显示当前小圆点颜色
    circleChange();
  });
  //排他，显示当前小圆点颜色
  function circleChange(obj) {
    for (var i = 0; i < ol.children.length; i++) {
      ol.children[i].className = '';
    }
    obj ? obj.className = 'selected' : ol.children[circle].className = 'selected';
  };
  //自动切换
  var timer = setInterval(function () {
    //自动调用右按钮点击函数
    arrow_r.click();
  }, 2000);






  // jQuery
  (function ($) {
    $.getUrlParam = function (name) {
      var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
      var r = window.location.search.substr(1).match(reg);
      if (r != null) return unescape(r[2]);
      return null;
    }
  })(jQuery);

  $('.loginbar .user_head img').click(function () {
    window.location.href = "http://localhost/usermanage.php?user_tel=" + $.getUrlParam('user_tel');
  })

































})