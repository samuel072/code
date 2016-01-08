(function ($) {
	$.gtk = {
 		// 遮罩窗口API
        MaskWin: {
            _maskWin: null,
            create: function () {
                var win = "<div id='mask_loading' class='mask_loading' style='z-index:9999;display:block'><div class='mask_loading_msg' style='display: block; left: 50%; margin-left: -67.5px;'>正在处理，请稍候 &nbsp; &nbsp;</div></div>";
                $(document.body).append(win);
                this._maskWin = $("#mask_loading");
            },
            show: function () {
                if (!this._maskWin) this.create();
                this._maskWin.show();
            },
            hide: function () {
                if (this._maskWin) {
                    this._maskWin.remove();
                    this._maskWin = null;
                }
            }
        },


        // Cookie op
        Cookie : {

            // [Cookie] Sets value in a cookie
            setCookie : function(cookieName, cookieValue, expires, path, domain, secure) {

                var str = escape(cookieName) + '=' + escape(cookieValue) ;
                str += "; path=/";//path标记必须加上(之前漏写就出现了问题)

                document.cookie = str;
		     /*
                    + (expires ? '; expires=' + expires.toGMTString() : '')

                    + (path ? '; path=' + path : '')

                    + (domain ? '; domain=' + domain : '')

                    + (secure ? '; secure='+secure : ''); */
            },

            // [Cookie] Gets a value from a cookie
            getCookie : function(cookieName) {

                var cookieValue = '';

                var posName = document.cookie.indexOf(escape(cookieName) + '=');

                if (posName != -1) {

                    var posValue = posName + (escape(cookieName) + '=').length;

                    var endPos = document.cookie.indexOf(';', posValue);

                    if (endPos != -1) cookieValue = unescape(document.cookie.substring(posValue, endPos));

                    else cookieValue = unescape(document.cookie.substring(posValue));

                }

                return (cookieValue);

            }
        }

	};
})(jQuery);

//动态 加载 js css 文件方法
function loadjscssfile(fileUrl,filetype){

    if(filetype == "js"){
        var fileref = document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src",fileUrl);
    }else if(filetype == "css"){
    
        var fileref = document.createElement('link');
        fileref.setAttribute("rel","stylesheet");
        fileref.setAttribute("type","text/css");
        fileref.setAttribute("href",fileUrl);
    }
   if(typeof fileref != "undefined"){
        document.getElementsByTagName("head")[0].appendChild(fileref);
    }
    
}



