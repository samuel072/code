 $(document).ready(function(){
	
	$(".round-content").delegate("p","click",function(){
		var value=$(this).attr("value");
		var sq=value.split('_');
		//$.post("search_question.php",{subject:sq[0],query:sq[1]},function(result){
		   	//location.href = "search_question.php?subject="+sq[0]+"&query="+sq[1];
		   	window.open("search_question.php?subject="+sq[0]+"&query="+sq[1]);
		//});
	});

	$(".top-set").bind("click", function(){
		//$.gtk.MaskWin.show();
		$(".filter-show").show(200);
	});
	$(".set-fliter-close a").bind("click", function(){
		$(".filter-show").hide(200);
		if($(this).hasClass("submit")){
			//页面显示筛�?
			var textStr="";
			var objs=$("#div_subitem p.selected");
			for (var i = 0; i <objs.length; i++) {
				var obj=objs[i];
				textStr+=" "+obj.innerText;
			};
			RefreshHotItem();
		}
	});
        $(".kg-refresh-all").bind("click", function(){
            //confirm("kg-refresh-all");
            filter_action();
        });
        $(".book-refresh-all").bind("click", function(){
            //confirm("book-refresh-all");
            filter_action();
        });
        
	$("#div_subitem").delegate("p","click",function(){
		var parentid=$(this).parent().attr("typeid");
		$("."+parentid+" p").removeClass("selected");
		$(this).addClass("selected");
		var value=$(this).attr("value");
		$.ajax({
			type: "POST",
			url: "class/browse_question_class.php",
			data: { 
				method:'SetFiltersSession',
				sessionKey:"ques_browse_filter",
				filterItem:parentid,
				filterValue:value
			},
			complete: function(){},
			success: function(filterItem){
				if(filterItem=="subject"){//学科时，清除教材和�?�本信息
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
    $(document).on("onresize",
    		function() {
        		confirm("resize");
			}
    );
    
    $("#tab_jiaocai").click(function(){
        $("#s_ctner_contents_jc").show();
        $("#s_ctner_contents_kg").hide();
        $("#s_ctner_contents_jb").hide();
        $(".filter-show").hide();

        $("#tab_jiaocai").removeClass("tab_jiaocai").addClass("tab_jiaocai_selected");
        $("#tab_kaogang").removeClass("tab_kaogang_selected").addClass("tab_kaogang");
        $("#tab_juanbang").removeClass("tab_juanbang_selected").addClass("tab_juanbang");

        $.gtk.Cookie.setCookie("f_show_tab","s_ctner_contents_jc");
	});
    $("#tab_kaogang").click(function(){
        $("#s_ctner_contents_jc").hide();
        $("#s_ctner_contents_kg").show();
        $("#s_ctner_contents_jb").hide();
        $(".filter-show").hide();
        $("#tab_jiaocai").removeClass("tab_jiaocai_selected").addClass("tab_jiaocai");
        $("#tab_kaogang").removeClass("tab_kaogang").addClass("tab_kaogang_selected");
        $("#tab_juanbang").removeClass("tab_juanbang_selected").addClass("tab_juanbang");
        $.gtk.Cookie.setCookie("f_show_tab","s_ctner_contents_kg");
	});
     $("#tab_juanbang").click(function(){
        $("#s_ctner_contents_jc").hide();
        $("#s_ctner_contents_kg").hide();
        $("#s_ctner_contents_jb").show();
        $(".filter-show").hide();
        $("#tab_jiaocai").removeClass("tab_jiaocai_selected").addClass("tab_jiaocai");
        $("#tab_kaogang").removeClass("tab_kaogang_selected").addClass("tab_kaogang");
        $("#tab_juanbang").removeClass("tab_juanbang").addClass("tab_juanbang_selected");
        $.gtk.Cookie.setCookie("f_show_tab","s_ctner_contents_jb");
	});
    /*$("#tab_jiaocai").hover(function(){
        $("#s_ctner_contents_jc").show();
        $("#s_ctner_contents_kg").hide();
        $("#s_ctner_contents_jb").hide();
        $(".filter-show").hide();
        $("#tab_jiaocai").removeClass("tab_jiaocai").addClass("tab_jiaocai_selected");
        $("#tab_kaogang").removeClass("tab_kaogang_selected").addClass("tab_kaogang");
        $("#tab_juanbang").removeClass("tab_juanbang_selected").addClass("tab_juanbang");
        $.gtk.Cookie.setCookie("f_show_tab","s_ctner_contents_jc");
        });
    $("#tab_kaogang").hover(function(){
        $("#s_ctner_contents_jc").hide();
        $("#s_ctner_contents_kg").show();
        $("#s_ctner_contents_jb").hide();
        $(".filter-show").hide();
        $("#tab_jiaocai").removeClass("tab_jiaocai_selected").addClass("tab_jiaocai");
        $("#tab_kaogang").removeClass("tab_kaogang").addClass("tab_kaogang_selected");
        $("#tab_juanbang").removeClass("tab_juanbang_selected").addClass("tab_juanbang");
        $.gtk.Cookie.setCookie("f_show_tab","s_ctner_contents_kg");
        });
     $("#tab_juanbang").hover(function(){
        $("#s_ctner_contents_jc").hide();
        $("#s_ctner_contents_kg").hide();
        $("#s_ctner_contents_jb").show();
        $(".filter-show").hide();
        $("#tab_jiaocai").removeClass("tab_jiaocai_selected").addClass("tab_jiaocai");
        $("#tab_kaogang").removeClass("tab_kaogang_selected").addClass("tab_kaogang");
        $("#tab_juanbang").removeClass("tab_juanbang").addClass("tab_juanbang_selected");
        $.gtk.Cookie.setCookie("f_show_tab","s_ctner_contents_jb");
        });
     */
     /*$(".book_selected").bind("click", function(){
                if($(".white_content").css('display')=="none")
                    $(".white_content").show();
                else
                    $(".white_content").hide();
        });

     $(".kg_selected").bind("click", function(){
                if($(".white_content").css('display')=="none")
                    $(".white_content").show();
                else
                    $(".white_content").hide();
        });*/
	/*$(".myTreeNode").delegate("xf","click",function(){
 		$.ajax({
                        type: "POST",
                        url: "/class/browse_question_class.php",
                        data: { 
                                method:'SetFiltersSession',
                                sessionKey:"browse_question_filter",
                                filterItem:$(this).attr("type"),
                                filterValue:$(this).attr("title")
                        },
                        complete: function(){},
                        success: function(data){
                                window.location.href="/search/browsequestion";
                                //window.open("/browse_question.php",'_blank');
                        }
                });
 	});*/
        /*
	$("#jb_nav a").hover(
		function(){
			 $("#jb_nav a").removeClass("selected");
		     $(this).addClass("selected");
			 var type=$(this).attr("type");
			 var arrayObj = new Array("junior_exam","senior_exam","junior_com","junior_good","senior_good");
			 for(var k=0;k<5;k++)
			 {
			    if(arrayObj[k]==type)
				{
			        $("#list_hot_"+arrayObj[k]).show();
					$("#list_new_"+arrayObj[k]).show();
			    }
				else
				{
				    $("#list_hot_"+arrayObj[k]).hide();
					$("#list_new_"+arrayObj[k]).hide();
				}
			 }
			 
		 }, 
		function(){}
	);*/

        $("#jb_nav a").bind("click",
                function(){
                         $("#jb_nav a").removeClass("selected");
                     $(this).addClass("selected");
                         var type=$(this).attr("type");
                         var arrayObj = new Array("junior_exam","senior_exam","junior_com","junior_good","senior_good");
                         for(var k=0;k<5;k++)
                         {
                            if(arrayObj[k]==type)
                                {
                                $("#list_hot_"+arrayObj[k]).show();
                                        $("#list_new_"+arrayObj[k]).show();
                            }
                                else
                                {
                                    $("#list_hot_"+arrayObj[k]).hide();
                                        $("#list_new_"+arrayObj[k]).hide();
                                }
                         }

                 }
        );

        $("#distict_selected_info").hover(
            function(){
                $("#district-show").slideDown();
            },
            function(){}
        );
        $("#district-show").hover(
            function(){},
            function(){
                $("#district-show").slideUp();
            }
        );
        $("#category").delegate("li","click", function(){
            $("#category li").removeClass("category_li_back_top_selected");
            $("#category li").removeClass("category_li_back_mid_selected");
            $("#category li").removeClass("category_li_back_bottom_selected");
            var index=$(this).children('span.cp_index_value').html();
            var lastindex=$("#category li").length;
            if(index==1)
            {
                $(this).addClass("category_li_back_top_selected");
            }
            else if(index<lastindex)
            {
                $(this).addClass("category_li_back_mid_selected");
            }
            else
            {
                $(this).addClass("category_li_back_bottom_selected");
            }
            
             
        });

        $("#knowledge li").bind("click", function(){
            $("#knowledge li").removeClass("knowledge_li_back_top_selected");
            $("#knowledge li").removeClass("knowledge_li_back_mid_selected");
            $("#knowledge li").removeClass("knowledge_li_back_bottom_selected");
            var index=$(this).children('span.kg_index_value').html();
            var lastindex=$("#knowledge li").length;
            //var lastindex=$("#knowledge li:last-child").children('span.cp_index_value').html();
            if(index==1)
                $(this).addClass("knowledge_li_back_top_selected");
            else if(index<lastindex)
                $(this).addClass("knowledge_li_back_mid_selected");
            else
                $(this).addClass("knowledge_li_back_bottom_selected");

        });
	/*$('').bind('mousewheel', function(event, delta) {
            	var dir = delta > 0 ? 'Up' : 'Down';
                //confirm(dir);
            	//$(this).text(dir + ' at a velocity of ' + vel);
            	return false;
        });*/

});
function cutstr(str,len)
{
   var str_length = 0;
   var str_len = 0;
      str_cut = new String();
      str_len = str.length;
      for(var i = 0;i<str_len;i++)
     {
        a = str.charAt(i);
        str_length++;
        if(escape(a).length > 4)
        {
         //中文字符的长度经编码之后大于4
         str_length++;
         }
         str_cut = str_cut.concat(a);
         if(str_length>=len)
         {
         //str_cut = str_cut.concat("...");
         return str_cut;
         }
    }
    //如果给定字符串小于指定长度，则返回源字符串；
    if(str_length<len){
     return  str;
    }
}
function httpGet(theUrl){
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false );
    xmlHttp.send( null );
	//confirm(theUrl);
    return xmlHttp.responseText;
}

function retry_bind()
{
    
    $(".myTreeNode").delegate("xf","click",function(){
	document.cookie=(escape("select_"+$(this).attr("type")) + '=' + escape($(this).attr("id")));
        window.location.href="/search/browsequestion?show_type="+$(this).attr("type")+"&query="+$(this).attr("title");
        /*
                $.ajax({
                        type: "GET",
                        url: "/class/browse_question_class.php",
                        data: {
                                method:'SetFiltersSession',
                                sessionKey:"browse_question_filter",
                                filterItem:$(this).attr("type"),
                                filterValue:$(this).attr("title")
                        },
                        complete: function(){},
                        success: function(data){
                                window.open("/search/browsequestion");
                        }
                });
        */});
}
function test_click(id)
{
    var res=httpGet("/data/tree?id="+id)
    $("#book_tree").html(res);
    retry_bind();
}

function knowledge_click(id)
{
    var subject=$.gtk.Cookie.getCookie("f_subject");
    var res=httpGet("/data/tree?action=knowledge_tree&id="+id+"&subject="+subject)
    $("#kg_right").html(res);
    retry_bind();
}
function fresh_book_list(id,subject)
{
   var res=httpGet("/data/tree?action=category_son&id="+id);
   $("#category").html(res);
   test_click(id);
   var res=httpGet("/data/tree?action=knowledge_son&id="+id+"&subject="+subject);
   $("#knowledge").html(res);
   knowledge_click(0);
   var f_tag=$.gtk.Cookie.getCookie("f_tag");
   
   $(".book_selected").html(cutstr(f_tag,14));
   $(".kg_selected").html(cutstr(f_tag,14));
}
function filter_action()
{
    document.getElementById("s_ctner_contents_jc").style.display="none";
    document.getElementById("s_ctner_contents_kg").style.display="none";
    document.getElementById("s_ctner_contents_jb").style.display="none";
    var f_show_tab=$.gtk.Cookie.getCookie("f_show_tab");
    
    if(f_show_tab!="s_ctner_contents_jc" && f_show_tab!="s_ctner_contents_kg" && f_show_tab!="s_ctner_contents_jb")
        f_show_tab="s_ctner_contents_jc";
    document.getElementById(f_show_tab).style.display="block";
    
    if(f_show_tab=="s_ctner_contents_jc")
        document.getElementById("tab_jiaocai").className="tab_item tab_jiaocai_selected";
    else if(f_show_tab=="s_ctner_contents_kg")
        document.getElementById("tab_kaogang").className="tab_item tab_kaogang_selected";
    else
        document.getElementById("tab_juanbang").className="tab_item tab_juanbang_selected";
    
        
    var subject=$.gtk.Cookie.getCookie("f_subject");
    var jiaocai=$.gtk.Cookie.getCookie("f_jiaocai");
    var xuece=$.gtk.Cookie.getCookie("f_xuece");
    if(subject==null || subject=="")
    {
        subject="math3";
        jiaocai="28263";
        xuece="28270";
        $.gtk.Cookie.setCookie("f_subject",subject);
        $.gtk.Cookie.setCookie("f_jiaocai",jiaocai);
        $.gtk.Cookie.setCookie("f_xuece",xuece);
        $.gtk.Cookie.setCookie("f_tag","数学 人教A版");
    }
    fresh_book_list(xuece,subject);
    district_callback();
}

function arr_count(o){
    var t = typeof o;
    if(t == 'string'){
        return o.length;
    }else if(t == 'object'){
        var n = 0;
        for(var i in o){n++;}
        return n;
    }
    return false;
}

function district_callback()
{
    var district_name=$.gtk.Cookie.getCookie("f_district");
    var district_id=$.gtk.Cookie.getCookie("f_district_id");
    if(district_name==null || district_name=="")
    {
        district_id=2;
        district_name="北京";
        $.gtk.Cookie.setCookie("f_district_id",district_id);
        $.gtk.Cookie.setCookie("f_district",district_name);
    }
    document.getElementById("distict_selected").innerHTML=district_name;
    var res=httpGet("/data/toppaper?district="+district_id);
    var dataObj=eval("("+res+")");
    var paper_logo=dataObj.paper_logo;
	
	var arrayObj = new Array("junior_exam","senior_exam","junior_com","junior_good","senior_good");
   
    var list_new_html="";
	//var i=0;
        //if(arr_count(dataObj.hot_paper[i])<=0)	
        //    return 0;
        //var tn="junior_exam";/
        //confirm(dataObj.hot_paper[tn]);
	for(var k=0;k<5;k++)
	{
               
		list_new_html="";
		for(var i=0;i<4;i++)
		{
                   if(i>=arr_count(dataObj.hot_paper[arrayObj[k]]))
                        continue;
                   //confirm(dataObj.hot_paper.junior_exam);
                   var o_name=dataObj.hot_paper[arrayObj[k]][i].name;
                   var id=dataObj.hot_paper[arrayObj[k]][i].id;
		   var paper_type=dataObj.hot_paper[arrayObj[k]][i].paper_type;
                   var update_time=dataObj.hot_paper[arrayObj[k]][i].update_time;
		   var s_name=cutstr(o_name,48);
                   if(s_name.length<o_name.length)
                       s_name=s_name.concat("...");
		  var logo=paper_logo[paper_type];
		
		   list_new_html+='<li style=" height: 42px;background: url(/imgs/'+logo+') no-repeat 24px 0px;padding-top: 10px;padding-right: 10px;padding-left: 89px;line-height: 25px;font-size:15px;color:#666666;"><a style="text-decoration:underline" title="'+o_name+'" target="_blank" href="/search/showpaper?'+id+'">'+s_name+'</a> <!--br><div style="font-size:12px;color:#777777;">更新时间:'+update_time+'</div--></li>';
		}
		document.getElementById("list_new_"+arrayObj[k]).innerHTML=list_new_html;

		list_new_html="";
		for(var i=0;i<4;i++)
		{
                   if(i>=arr_count(dataObj.hot_paper[arrayObj[k]]))
                        continue;
                   var o_name=dataObj.new_paper[arrayObj[k]][i].name;
                   var id=dataObj.new_paper[arrayObj[k]][i].id;
		   var s_name=cutstr(dataObj.new_paper[arrayObj[k]][i].name,48);
		   var paper_type=dataObj.new_paper[arrayObj[k]][i].paper_type;
                   var update_time=dataObj.new_paper[arrayObj[k]][i].update_time;
                   var s_name=cutstr(o_name,48);
                   if(s_name.length<dataObj.new_paper[arrayObj[k]][i].name.length)
                       s_name=s_name.concat("...");
		   var logo = paper_logo[paper_type];
		   list_new_html+='<li style=" height: 42px;background: url(/imgs/'+logo+') no-repeat 24px 0px;padding-top: 10px;padding-right: 10px;padding-left: 89px;line-height: 25px;font-size:15px;color:#666666;"><a style="text-decoration:underline" title="'+o_name+'" target="_blank" href="/search/showpaper?'+id+'">'+s_name+'</a> <!--br><div style="font-size:12px;color:#777777;">更新时间:'+update_time+'</div--></li>';
		}
		document.getElementById("list_hot_"+arrayObj[k]).innerHTML=list_new_html;
	}
}

/*function load_filter()
{
    var res=httpGet("/filter.php");
    $(".filter-show").html(res);
}*/
function fresh_jc_chapter()
{
    //$.gtk.Cookie.setCookie("f_subject","chinese");
    //$.gtk.Cookie.setCookie("f_jc",30368);
    //var f_xk=$.gtk.Cookie.getCookie("f_subjectisdw");
    //confirm(f_xk);
}
 function jcItemRefresh(){
	$.ajax({
		type: "POST",
		url: "class/browse_question_class.php",
		data: { 
			method:'jcItemRefresh'
		},
		complete: function(){},
		success: function(htmlStr)
		{
			$("#jiaocai").html(htmlStr);
			xcItemRefresh();
		}
	});
}
function xcItemRefresh(){
	$.ajax({
		type: "POST",
		url: "class/browse_question_class.php",
		data: { 
			method:'xcItemRefresh'
		},
		complete: function(){},
		success: function(htmlStr)
		{
			$("#xuece").html(htmlStr);
		}
	});
}

function RefreshHotItem(){
	$.ajax({
		type: "POST",
		url: "class/index_class.php",
		data: { 
			method:'GetHotCategoryList'
		},
		complete: function(){},
		success: function(htmlStr)
		{
			$("#zhangjie").html(htmlStr);
		}
	});

	$.ajax({
		type: "POST",
		url: "class/index_class.php",
		data: { 
			method:'GetHotTestPointList'
		},
		complete: function(){},
		success: function(htmlStr)
		{
			$("#kaodian").html(htmlStr);
		}
	});

function myTree_click(obj,node){
        var key="";
                if($($(".content-left-top p")[0]).hasClass("selected"))
                {
                        key="category";
                }
                else{
                        key="knowledge";
                }

                $.ajax({
                        type: "POST",
                        url: "class/browse_question_class.php",
                        data: { 
                                method:'SetFiltersSession',
                                sessionKey:"ques_browse_filter",
                                filterItem:key,
                                filterValue:node.name
                        },
                        complete: function(){},
                        success: function(data){
                                QueryGo();
                        }
                });
}
}

function after_filter()
{

}
