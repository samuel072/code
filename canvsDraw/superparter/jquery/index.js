/**
 * Created by admin on 2015/12/8.
 */
/*登录注册自适应大小*/

var p2back=document.getElementById('telphone');
p2back.style.fontSize=(document.body.clientWidth*0.04)+"px";
p2back.style.top=(document.body.clientWidth*0.84)+"px";

var p3back=document.getElementById('code');
p3back.style.fontSize=(document.body.clientWidth*0.04)+"px";
p3back.style.top=(document.body.clientWidth*0.84)+"px";

var p1=document.getElementById('info');
 p1.style.fontSize=(document.body.clientWidth*0.5)+"px";

var p2=document.getElementById('failInfo');
p1.style.fontSize=(document.body.clientWidth*0.5)+"px";

var p01=document.getElementById('name');
p1.style.fontSize=(document.body.clientWidth*0.5)+"px";

var p02=document.getElementById('address');
p1.style.fontSize=(document.body.clientWidth*0.5)+"px";


/*判断手机横屏*/
if(window.orientation!=0){
    var obj=document.getElementById('orientation');
    alert('横屏内容太少啦，请使用竖屏观看！');
    obj.style.display='block';
}

window.onorientationchange=function(){
    var obj=document.getElementById('orientation');

    if(window.orientation==0){
        obj.style.display='none';
    }else
    {
        alert('横屏内容太少啦，请使用竖屏观看！');
        obj.style.display='block';
    }
};

/*刮刮卡*/
