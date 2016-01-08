$(document).ready(function(){
	$("#district-show").delegate("p","click",function(){
        $("#district-show p").removeClass("district-item-selected");
        $(this).addClass("district-item-selected");
	$(".district-show").hide();
        /*$("#fade").hide();*/
        $.gtk.Cookie.setCookie("f_district",$(this).text());
        $.gtk.Cookie.setCookie("f_district_id",$(this).attr("value"));
	district_callback();
	});
});
