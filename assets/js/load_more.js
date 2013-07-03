
$('.more').live("click",function() 
{

var ID = $(this).attr("id");

$.ajax({
type: "POST",
url: "moreupdates.php",
data: "last_msg_id="+ ID, 
cache: false,
beforeSend: function(){ $("#more"+ID).html('<img src="ajax-loader.gif" />'); },
success: function(html){
$("#more"+ID).remove();
$("div#content").append(html);

}
});
return false;
});
