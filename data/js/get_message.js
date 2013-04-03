$(function(){
var user_id = $(".user-center").attr('uid');
function get_new_inbox() {
  var url = get_root_path()+"/index.php/ajax/get_new_inbox";
  $.post(url,
    {user_id:user_id},
    function(result){
      result = $.parseJSON(result);
      if( result[0].inboxnum > "0") {
        $(".bubble").css("visibility","visible").html(result[0].inboxnum);
      }else{
        $(".bubble").css("visibility","hidden");
      }

    }
  );
}
if ( user_id != undefined ) {
  get_new_inbox();
  setInterval(get_new_inbox,12000);
}
function get_root_path() {  
  var root = location.protocol + '//' + location.host+'/wen';
  return root;
}
});
