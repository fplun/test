var lastTime = new Date().getTime();
var currentTime = new Date().getTime();
var timeOut = 60 * 60 * 1000; //设置超时时间： 60分

$(function() {
  /* 鼠标移动事件 */
  $(document).mouseover(function() {
    lastTime = new Date().getTime(); //更新操作时间
  });
});

function testTime() {
  currentTime = new Date().getTime(); //更新当前时间
  if (currentTime - lastTime > timeOut) {
    //判断是否超时
    alert("由于您长时间未操作，重新登录");
    location.href = "/logout";
  }
}

/* 定时器  间隔1秒检测是否长时间未操作页面  */
window.setInterval(testTime, 1000);
