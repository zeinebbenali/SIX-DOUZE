function vote(nbreponse , url_v){
    var idvote = 0;
    for ($i = 1; $i<nbreponse; $i++) {
        if (document.getElementById('reponse' + $i).checked == true) 
            idvote = document.getElementById('reponse' + $i).value;
    }
    if (idvote == 0) 
        alert('Choisissez une reponse')
    else {
        $.ajax({
            type: "POST",
            url: url_v,
            data: "idvote=" + idvote,
            success: function(data){
                $("#sondage_result").html(data);
				setTimeout('updateprogressbar()', 1000);
            },
            beforeSend: function(){
                $("#sondage_result").html("<img src='/images/ajax-loader.gif' alt='Shems loader' />");
            }
        });

    }
}
function progressbar(valeur,k){
    var reponse = document.getElementById('reponse'+k).value ; 
    $("#action"+k).html(reponse+'<div id="progressbar'+k+'"></div>');
    //$("#progressbar"+k).progressbar({value: Math.ceil(valeur) });
    $("#progressbar"+k).addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all") ;
	$("#progressbar"+k).attr({role : "progressbar" , "aria-valuemin" : "0" , "aria-valuemax" : "100" , "aria-valuenow" : Math.ceil(valeur)}) ;
	$("#progressbar"+k).html('<div class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: '+Math.ceil(valeur)+'%;"></div>');
	$("#action"+k).append(Math.ceil(valeur)+'%');	
}
function updatePorcentage(valeur,k){
	var reponse = document.getElementById('reponse'+k).value ; 
    $("#action"+k).html(reponse+'<div id="progressbar'+k+'"></div>');
    //$("#progressbar"+k).progressbar({value: Math.ceil(valeur) });
    $("#progressbar"+k).addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all") ;
	$("#progressbar"+k).attr({role : "progressbar" , "aria-valuemin" : "0" , "aria-valuemax" : "100" , "aria-valuenow" : Math.ceil(valeur)}) ;
	$("#progressbar"+k).html('<div class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: '+Math.ceil(valeur)+'%;"></div>');
	$("#action"+k).append(valeur+'%');		
}

function updateprogressbar()
{
  var totalvote = parseInt(document.getElementById('totalvote').value);
  var nbrep = parseInt(document.getElementById('nbrep').value);
  var total = 0;
  var nbreponse = nbrep-1 ; 

  for($k=1;$k<nbrep;$k++)
  { 
    var $j= 0 ;
    
    if($k!=nbreponse)
    {
      var nbvote = (parseInt(document.getElementById('nbvote'+$k).value)* 100)/totalvote;
      var total = total + nbvote ; 
      for($i=0;$i<=Math.ceil(nbvote);$i++)
      { 
        var duree = $j * 50 ;
      
        setTimeout('progressbar('+$i+','+$k+');',duree);
        $j++;
      }
    }
    else
    {
      var nbvote  = 100 - total ; 
      for($i=0;$i<=Math.ceil(nbvote);$i++)
      { 
        var duree = $j * 50 ;      
        setTimeout('progressbar('+$i+','+$k+');',duree);
        $j++;
      }
    }
	var duree = $j * 50 ;
	setTimeout('updatePorcentage('+nbvote.toFixed(2)+','+$k+')',duree);
  }
}
function showResult(url_link){
    $.ajax({
            type: "POST",
            url: url_link,
            data: "idvote=0",
            success: function(data){
                $("#sondage_result").html(data);
    setTimeout('updateprogressbar()', 1000);
            },
            beforeSend: function(){
                $("#sondage_result").html("<img src='/images/ajax-loader.gif' alt='Shems loader' />");
            }
        });
}

function showPlayer(id)
		{
		  var nbitem = document.getElementById('nbitemplaylist').value ; 
		  for($i=1;$i<nbitem;$i++) {
		    $(".panel"+$i).hide("slow");
			$("#btn-slide"+$i).show();
		    //$(".btn-slide"+id).toggleClass("active"); 
		  }	
		  $(".panel"+id).show("slow");
		  $("#btn-slide"+id).hide();
		  return false;
		}
$(document).ready(function(){

});
	function sendMessage(url_link) {
	    var nom = $("#send_message_name").val() ;
		var email = $("#send_message_email").val() ;
		var message = $("#send_message_message").val() ;
		var captcha = $("#send_message_captcha").val() ; 
		jQuery.ajax({
			type: "POST",
			url: url_link,
		   	data: "send_message[name]="+nom+"&send_message[email]="+email+"&send_message[message]="+message+"&send_message[captcha]="+captcha,
		   	success: function(data){
		    	 $("#inline_example1").html(data);
				 $("#inline_example1").colorbox.resize();
		   	},
			beforeSend : function(){
				$("#inline_example1").html("<img src='/images/ajax-loader.gif' alt='Loader ShemsFm' />");
			}
		});
	}
function showPlayer(id)
	{
	 	var nbitem = document.getElementById('nbitemplaylist').value ; 
		for($i=1;$i<nbitem;$i++) {
		    $(".panel"+$i).hide("slow");
			$("#btn-slide"+$i).show();
		    //$(".btn-slide"+id).toggleClass("active"); 
		}	
		$(".panel"+id).show("slow");
		$("#btn-slide"+id).hide();
		return false;
	}