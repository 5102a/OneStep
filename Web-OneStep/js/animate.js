function animate(obj, target, callback) {
  clearInterval(obj.timer);
  var torf=(target-obj.offsetLeft)>0?true:false;
  obj.timer = setInterval(function () {
     var step = (target - obj.offsetLeft) / 10;
     step = step > 0 ? Math.ceil(step) : Math.floor(step);
    if ((obj.offsetLeft <=target && !torf)||
    (obj.offsetLeft >= target && torf)) {
      clearInterval(obj.timer);
      obj.timer=null;
      if (callback) {
        callback();
      }
    }
    obj.style.left = obj.offsetLeft + step + 'px';
    
  }, 15);
}