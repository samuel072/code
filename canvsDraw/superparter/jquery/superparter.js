
function click_cellnumber()
{
	if(document.getElementById("cell-number").value=="输入手机号")
		document.getElementById("cell-number").value="";
	confirm(document.getElementById("cell-number").value+";");
}