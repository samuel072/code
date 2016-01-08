 $(document).ready(function(){
	$(".right-top-set").bind("click", function(){
		//$.gtk.MaskWin.show();
		$(".filter-show").show();
                $("#fade").show();
	});
	$(".set-fliter-close a").bind("click", function(){
		$(".filter-show").hide();
                $("#fade").hide();
		if($(this).hasClass("filter-save")){
			
			var isSetCookie = (getCookie("f_subject") != 'undefined');
			if(!isSetCookie){
                setCookie("f_subject_name","数学");
				setCookie("f_subject","math2");
	            setCookie("f_jiaocai",0);
	            setCookie("f_xuece",0);
			}
            
			//页面显示筛选
			var textStr="";
                        var indexstr="";
			var objs=$("#div_subitem p.selected");
			for (var i = 0; i <objs.length; i++) {
				var obj=objs[i];
                var parentid=$(obj).parent().attr("typeid");
                var value=$(obj).attr("value");
                setCookie("f_"+parentid,value);
				textStr+=" "+obj.innerText;
                if(indexstr.length+obj.innerText.length<10)
                     indexstr+=" "+obj.innerText;
			};
			$("#jiaocao").html(textStr);
            $(".book_selected").html(indexstr);
            $(".kg_selected").html(indexstr);
            setCookie("f_tag",indexstr);
			//左边树刷新
			//loadTree();
			if(window.filter_action)
				filter_action();
			after_filter();    
		}
	});

	$("#div_subitem").delegate("p","click",function(){
		var parentid=$(this).parent().attr("id");
                var hideid="f_xc_more";
                if(parentid=="f_jc_more")
                {
                    parentid="jiaocai";
                    hideid="f_jc_more";
                }
                if(parentid=="f_xc_more")
                {
                    parentid="xuece";
                    hideid="f_xc_more";
                }
                    
                
		$("."+parentid+" p").removeClass("selected");
                $("."+hideid+" p").removeClass("selected");

		$(this).addClass("selected");
		var value=$(this).attr("value");
		//questypeRefresh(value);
		$.ajax({
			type: "POST",
			url: "/class/browse_question_class.php",
			data: { 
				method:'SetFiltersSession',
				sessionKey:"ques_browse_filter",
				filterItem:parentid,
				filterValue:value
			},
			complete: function(){},
			success: function(filterItem){
				if(filterItem=="subject"){//学科时，清除教材和课本信息
					$("#jiaocai").html("");
					$("#xuece").html("");
					jcItemRefresh();

				}else if(filterItem=="jiaocai"){//教材时，清除课本信息
					$("#xuece p").html("");
					xcItemRefresh();
				}
			}
		});
	});

});

// [Cookie] Sets value in a cookie
function setCookie(cookieName, cookieValue) {
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)+"; path=/";
}

// [Cookie] Gets a value from a cookie
function getCookie(cookieName) {

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

function httpGet(theUrl){
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
        //confirm(theUrl);
    return xmlHttp.responseText;
        //    }
}
function load_filter()
{
    if(window.filter_action)
    	filter_action();
    var res=httpGet("/data/filter");
    $(".filter-show").html(res);
}
