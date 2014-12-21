function charge_msg(id)
{
        var js_effets=document.createElement("script");
        js_effets.setAttribute("type", "text/javascript");
        js_effets.setAttribute("src", "http://services.supportduweb.com/sondage/msg-"+id+".js");
        document.getElementsByTagName("head")[0].appendChild(js_effets);
}
function aff_msgs(id)
{
        var js_effets=document.createElement("script");
        js_effets.setAttribute("type", "text/javascript");
        js_effets.setAttribute("src", "http://services.supportduweb.com/sondage/msgs-"+id+".js");
        document.getElementsByTagName("head")[0].appendChild(js_effets);
}
function sendmsg(id)
{
	eval("var radio = document.frm.rep_sond_"+id+";");
	for(i=0;radio[i];i++)
	{
		if(radio[i].checked)
		{
			var id2 = radio[i].value;
		}
	}
        var js_effets=document.createElement("script");
        js_effets.setAttribute("type", "text/javascript");
        js_effets.setAttribute("src", "http://services.supportduweb.com/sondage/sendmsg-"+id+"-"+id2+".js");
        document.getElementsByTagName("head")[0].appendChild(js_effets);
	return false;
}
var sondage_index = "<style type=\"text/css\">"
+".sondage_1_contenu"
+"{"
+"	color:#000000;"
+"	padding:3px;"
+"	width:300px;"
+"	margin:auto;"
+"	background-color:#2275ff;"
+"	background-image:url('http://services.supportduweb.com/images/degrade_bas.png');"
+"	background-position:bottom;"
+"	background-repeat:repeat-x;"
+"}"
+".sondage_1_c2"
+"{"
+"	background-image:url('http://services.supportduweb.com/images/degrade_haut.png');"
+"	background-position:top;"
+"	background-repeat:repeat-x;"
+"	padding:3px;"
+"}"
+".sondage_1_rep"
+"{"
+"	font-size:16px;"
+"	margin-left:10px;"
+"	margin-bottom:2px;"
+"}"
+".sondage_1_question"
+"{"
+"	font-size:1.5em;"
+"	text-align:center;"
+"}"
+".sondage_1_submit"
+"{"
+"	text-align:center;"
+"	margin-top:3px;"
+"}"
+"</style>"
+"	<div class=\"sondage_1_contenu\"><div class=\"sondage_1_c2\">"
+"		<div id=\"sondage_infos_1\"></div>"
+"		<div class=\"sondage_1_message_ls\" id=\"sondage_p_aff_1\"></div>"
+"		<script type=\"text/javascript\">"
+"			charge_msg(1);"
+"		</script>"
+"	</div></div>"
+"";
document.write(sondage_index);