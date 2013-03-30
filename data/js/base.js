(function(){
$(".user-center").hover(function() {
  $(".user-menu").css("display","block");
  $(this).addClass("active");
},function(){
  $(".user-menu").css("display","none");
  $(this).removeClass("active");
});

$(".nav-poi li").click(function(){
  $(this).addClass("active").siblings().removeClass("active");
});

$(".create-question").click(function(){

  $('#myModal').modal('toggle');
});

$(".no-login-ques").click(function(){

  window.location.href = get_root_path()+"/wen/index.php/index/login";
});
$(".login-btn-trans").click(function(){
  window.location.href = get_root_path()+"/wen/index.php/index/login";
});
$(".register-btn-trans").click(function(){
  window.location.href = get_root_path() + "/wen/index.php/index/register";
});

// upload img to server
$("#userfiles").change(function () {

            var iframe = $('<iframe name="postiframe" id="postiframe" style="display: none" />');

            $("body").append(iframe);
            var form = $('#theuploadforms');
            form.attr("action", get_root_path()+"/wen/index.php/ajax/auto_upload_file");
            form.attr("method", "post");
            form.attr("enctype", "multipart/form-data");
            form.attr("encoding", "multipart/form-data");
            form.attr("target", "postiframe");
            form.attr("file", $('#userfiles').val());
            form.submit();
            $("#postiframe").load(function () {
                iframeContents = $("#postiframe")[0].contentWindow.document.body.innerHTML;
                $.post(get_root_path()+"/wen/index.php/user/upimage",
    {imgpath:iframeContents},
    function(result){
      $(".jc-demo-box").html(result);

    });

            });

            return false;

        });

// publish question
$("#formsubmit").click(function() {
  var $question_title = $(".question-title").val();
  var $question_content = $(".question-content").val();
  var $cate = $(".question-cate option:selected").val();
  var $question_socore = $(".question-socore").val();
  var $question_anoy = $(".question-anoy").attr("checked")?1:0;
  var url = get_root_path()+"/wen/index.php/ajax/post_message";
  var  urls = get_root_path()+"/wen/index.php/ajax/scwc_api";
  $.post(url,
    {question_title:$question_title,question_content:$question_content,cate:$cate,question_socore:$question_socore,question_anoy:$question_anoy},
    function(result){
      $result = $.parseJSON(result);
      if( $result.status == "1"){
        $(".modal-backdrop").css("display","none");
        $("#myModal").css("display","none");
        $.post(urls,
          {question_title:$question_title,question_content:$question_content,cate:$cate,ques_id:$result.msgid},
          function(result){
            window.location.href="";
          }
        );
      } else {
        alert("发送失败请重新发布！");
      }
    }
  );
});

// public comment
$(".comment-btn").click(function() {
  var $comment = $(".comment-input").val();
  var $qid = $(".question_info").attr("qid");
  var url = get_root_path()+"/wen/index.php/ajax/add_comment";
  $.post(url,
    {comment_content:$comment,ques_id:$qid},
    function(result){
      if( result.length == "5"){
        alert(result);
        window.location.href=get_root_path()+"/wen/index.php/index/login";
      } else {
        window.location.href =  ""; 
      } 
    }
  );

});

// add favour

$(".sns-favour").click(function() {
  var $current_favour = $(this).find("span");
  var $comment_id = $(this).parent().parent().parent().parent().attr("cid");
  var $qid = $(".question_info").attr("qid");
  var $comment_uid = $(this).parent().parent().parent().attr("uid");

  var url = get_root_path()+"/wen/index.php/ajax/add_favour";
  $.post(url,
    {comment_id:$comment_id,quesid:$qid,comment_uid:$comment_uid},
    function(result){
      
      if( result.length == "5")
      {
        alert($.trim(result));
        window.location.href = get_root_path()+"/wen/index.php/index/login";
      } else {
        $current_favour.html($.trim(result));
      } 

    }
  );


});

$(".get-index-anwser").live("click",function() {
  var $qid = $(this).attr("qid");
  var $display_anwser = $(this).parent().parent().next().next();
  var $slide_up = $(this).parent().parent().next().next().next();
  var url = get_root_path()+"/wen/index.php/ajax/get_index_anwser";
  $.post(url,
    {quesid:$qid},
    function(result){
      var $list_anwser;
      result = $.parseJSON(result);
      $display_anwser.html("");

      for( var i = 0 ; i < result.length ; i++)
      {
        $list_anwser= $("<div class='comment-list-info span10'><a href='"+get_root_path()+"/wen/index.php/person/question/"+result[i].user_id+"'><img src='"+result[i].user_img+"' class='span1'></a><a href='"+get_root_path()+"/wen/index.php/person/question/"+result[i].user_id+"' class='span1'>"+result[i].user_name+"</a><span class=' span10 pull-right'>"+result[i].comment_content+"</span><hr /></div>");
        $display_anwser.append($list_anwser);
      }

      $display_anwser.slideDown("slow",function(){
        $slide_up.css({"display":"block"});
      });
    }
  );
  
});

$(".slide-up").click(function(){
  $(this).prev().slideUp("slow");
  $(this).css("display","none");

});

$(".cmt-reply").click(function() {
  var $comment_id = $(this).parent().parent().parent().parent().attr("cid");
  var $reply_list = $(this).parent().parent().next().children(".reply-list");
  var url = get_root_path()+"/wen/index.php/ajax/get_reply_list";
  if ( $reply_list.attr("is-cmt-reply") == "false" ) {

    $.post(url,
      {comment_id:$comment_id},
      function(result){
        result = $.parseJSON(result);     
        for(var i = 0; i < result.length; i++)
        {
          $reply= $("<div class='comment-list-info span12'><a href='"+get_root_path()+"/wen/index.php/person/question/"+result[i].user_id+"'><img src='"+result[i].user_img+"' class='span1'></a><a href='"+get_root_path()+"/wen/index.php/person/question/"+result[i].user_id+"' class='span1'>"+result[i].user_name+"</a><div class=' span9 pull-right'>"+result[i].reply_content+"</div><p class='span10 pull-left sns-time-list'>"+result[i].time+"<p></div>");
          $reply_list.append($reply);
          $reply_list.attr("is-cmt-reply","true");
        }
      }
    );
  }
  $reply = $(this).parent().parent().next();
  if( $(this).attr("clicked") == "false" ){
    $reply.slideDown("slow");
    $(this).attr("clicked","true");
  }else{
    $reply.slideUp("slow");
    $(this).attr("clicked","false");
  }
});

$(".reply-btn").click(function() {
  var $reply_content = $(this).prev().prev().val();
  var $reply_num = $(this).parent().parent().prev().find("span .cmt-num");
  if( $reply_content != ""){
    $reply_list = $(this).parent().prev();
    $comment_id = $(this).parent().parent().parent().parent().attr("cid");
    var url = get_root_path()+"/wen/index.php/ajax/add_reply";
    $.post(url,
      {reply_content:$reply_content,comment_id:$comment_id},
      function(result){
        
        if(result.length == "5")
        {
          alert($.trim(result));
          window.location.href=get_root_path()+"/wen/index.php/index/login";

        } else {

          result = $.parseJSON(result);

          $reply= $("<div class='comment-list-info span12'><a href='"+get_root_path()+"/wen/index.php/person/question/"+result.user_id+"'><img src='"+result.user_img+"' class='span1'></a><a href='"+get_root_path()+"/wen/index.php/person/question/"+result.user_id+"' class='span1'>"+result.user_name+"</a><div class=' span9 pull-right'>"+$reply_content+"</div><p class='span10 pull-left sns-time-list'>"+result.time+"<p></div>");
          $reply_list.append($reply);
          $reply_num.html(parseInt($reply_num.html())+1);
          $(".reply-input").val(" ");
        }

      }
    );
  } else {

    alert("内容不能为空！");
  }

});

$(".nav-tabs li").click(function(){
  $(this).addClass("active").siblings().removeClass("active");
});

$(".profile-alter").click(function(){
  var $nickname = $("#nickname").val();
  var $profile = $("#profile").val();
  var $help_block = $(".help-blocks");
  var url = get_root_path()+"/wen/index.php/ajax/profile_alter";
  $.post(url,
    {nickname:$nickname,profile:$profile},
    function(result){

      $help_block.css({"visibility":"block","color":"red"});
      $help_block.html($.trim(result));
    }
  );
});

$("#oldpassword").change(function() {
  var $oldpassword = $(this).val();
  var $help_block = $(this).next();
  var url = get_root_path()+"/wen/index.php/ajax/is_true_password";
  $.post(url,
    {oldpassword:$oldpassword},
    function(result){
      $help_block.css({"visibility":"block","color":"red"});
      $help_block.html(result);
      //console.log(result);
      
    }
  );
});
$(".acount-alter").click(function(){
  var $email = $("#email").val();
  var url = get_root_path()+"/wen/index.php/ajax/acount_alter";
  var $newpassword = $("#newpassword").val();
  var $confirmpassword = $("#confirmpassword").val();
  var $help_block = $(".success-callback");
  if($newpassword != $confirmpassword){
    alert("你两次填写的密码不相同！");
    return false;
  } else {
    
    $.post(url,
      {email:$email,password:$newpassword},
      function(result){

        $help_block.html(result).css({"visibility":"block","color":"red"});
      }
    );
  }
});
$(".crop-image").live("click",function() {
  var x = $("#x").val();
  var y = $("#y").val();
  var w = $("#w").val();
  var h = $("#h").val();
  var img_path = $(".upload-img").attr("src");
  var url = get_root_path()+"/wen/index.php/ajax/crop_image";
  $.post(url,
    {x:x,y:y,w:w,h:h,imgpath:img_path},
    function(result){

      if( $.trim(result) == "true" )
      {
        window.location.href = get_root_path()+"/wen/index.php/user/profile";
      }
    }
  );
});

$(".best-answer").click(function() {
  var $comment_uid = $(this).parent().parent().attr("uid");
  var $score = $(".ques-score").html();
  var $msgid = $(".question_info").attr("qid");
  var $comment_id = $(this).parent().parent().parent().attr("cid");
  var url = get_root_path()+"/wen/index.php/ajax/set_best_answer";
  $.post(url,
    {comment_uid:$comment_uid,score:$score,msgid:$msgid,cid:$comment_id},
    function(result){
      if( $.trim(result) == "true" )
      {
        $(".best-answer").css("display","none");
      }
    }
  );
});

$(".question-socore").change(function(){

  var $score = $(this).val();
  var $uid = $(".user-center").attr("uid");
  var url = get_root_path()+"/wen/index.php/ajax/check_score";
  $.post(url,
    {uid:$uid,score:$score},
    function(result){
      result = $.trim(result);
      if(result !== ""){
        alert(result);
      }
    }
  );
});

$(".post-inbox").click(function(){

  $('#inbox').modal('toggle');
  var $user_name = $(".person-info-bar").html();
  var $inbox_to_name = $(this).parent().parent().parent().children().find(".inbox-to-name").html();
  if( $user_name != null ){
    $(".inbox-to").val($user_name);
  }else{
    $(".inbox-to").val("");
  }

   if( $inbox_to_name != null ){

    $("#typeahead").val($.trim($inbox_to_name));
    
  } 
});

$(".add-inbox").click(function(){
  var url = get_root_path()+"/wen/index.php/ajax/post_inbox";
  var user_name = $(".inbox-to").val();
  var $inbox_content = $(".inbox-content").val();
  $.post(url,
    {user_name:user_name,inbox:$inbox_content},
    function(result){
      result = $.parseJSON(result);
      if( result.status = 'ok' ){
        $(".modal-backdrop").css("display","none");
        $("#inbox").css("display","none");
        $(".inbox-content").val("");
      }

    }
  );
});

var subjects = [];
var is_repeat = [];
$("#typeahead").keyup(function(){
  var url = get_root_path()+"/wen/index.php/ajax/get_user_infos";
  var user_name = $(this).val();
  
  $.post(url,
    {user_name:user_name},
    function(result){
      result = $.parseJSON(result);
      if(result.length > 0)
      {
        for(var i = 0; i < result.length; i++)
        {
          if(is_repeat.indexOf( result[i].user_id ) == -1){
            subjects.push(result[i].user_name);
            is_repeat.push(result[i].user_id);
          }
        }

      }

    }
  );
});
$('#typeahead').typeahead({source:subjects});
 $("#message-menu").popover({
      placement : 'bottom',
      title : '<div style="text-align:center; color:red; text-decoration:underline; font-size:14px;">消息</div>', 
      html: 'true', //needed to show html of course
      content : '<div id="popOverBox"></div>' 
});

 $(".search-btn").click(function(){
  var $keywords = $(".search-query").val();
  var url = get_root_path()+"/wen/index.php/search/index/"+$keywords;
  if($keywords != ""){
  
    window.location.href = url;
  } else {

    return false;
  }

 });
$(".show-more").click(function() {

  var current_page = parseInt($(this).attr("current-page"));
  var page = $(this).attr("page");
  switch(page)
  {
      case "index":
          var url = page+"/get_new_pages";
          show_more(url,current_page,page);
          break;

      case "topic":
          var url = page+"/get_new_pages";
          show_more(url,current_page,page);

      case "explore":
          var url = page+"/get_new_pages";
          show_more(url,current_page,page);

      case "info":
          var url = "topic/get_info_pages";
          show_more(url,current_page,page);

  }

});

function show_more(url,current_page,page){
   var url = get_root_path()+"/wen/index.php/"+url;
   var pages = current_page+1;
   var nulls = true;
  $.post(url,
    {current_page:pages},
    function(result){
      $result = $.parseJSON(result);
      if($result.data != 'null') {
            switch(page){
                case "index":
                    for(var i = 0; i < $result.length; i++) {
                      $new_ques =$("<div class='ques-list span'><div class='feed-list span11'><a href='person/question/"+$result[i].user_id+"'><img src='"+$result[i].user_img+"' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a></span><span class='sns-time-list pull-right'>"+$result[i].post_time+"</span></p><p><a href='question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a></p><div class='index-content-list'>"+$result[i].ques_content+"</div><p class='sns-bar'><span>悬赏:</span>&nbsp&nbsp"+$result[i].ques_socore+"<span>浏览:</span>&nbsp&nbsp"+$result[i].browser+"<span>分类:"+$result[i].ques_cate+"</span><span class='pull-right'><a href='question/index/"+$result[i].msgid+"' class='get-index-anwser'>回答(<span>"+$result[i].anwser+"</span>)</a></span><p><div class='display-anwser span1'></div> <div class='slide-up pull-right'>收起</div></div></div></div>");
                      $(".index-ques-list").append($new_ques);
                      $(".show-more").attr("current-page",pages);
                    }
                break;

                case "topic":
                    for(var i = 0; i < $result.length; i++) {
                      $new_topic = $("<div class='ques-list span12'><div class='feed-list span11'><a href='topic/info/"+result[i].id+" '><img src=' "+$result[i].tag_img+" ' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='topic/info/"+$result[i].id+" '>"+$result[i].tag_name+"</a></span></p></div></div></div>");
                      for(var j = 0; j < $result[i].ques.length; j++){
                          $new_ques = $("<p><a href='question/index/"+$result[i].ques[j].msgid+"'>"+$result[i].ques[j].ques_title+"</a><span class='sns-time-list'>"+$result[i].ques[j].post_time+"</span></p>");
                         $new_topic.children().find(".feed-content").append($new_ques);
                        }
                      $(".index-ques-list").append($new_topic);
                      $(".show-more").attr("current-page",pages);
                    }
                break;

                case "explore":
                     for(var i = 0; i < $result.length; i++) {
                          $new_message =$("<div class='ques-list span'><div class='feed-list span11'><a href='person/question/"+$result[i].user_id+"'><img src='"+$result[i].user_img+"' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a></span><p class='sns-time-list pull-right'>"+$result[i].post_time+"</p></p><p><a href='question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a></p><div class='index-content-list'>"+$result[i].ques_content+"</div><p class='sns-bar'><span>悬赏:</span>&nbsp&nbsp"+$result[i].ques_socore+"<span>浏览:</span>&nbsp&nbsp"+$result[i].browser+"<span>分类:"+$result[i].ques_cate+"</span><span class='pull-right'><a href='question/index/"+$result[i].msgid+"' class='get-index-anwser'>回答(<span>"+$result[i].anwser+"</span>)</a></span><p><div class='display-anwser span1'></div> <div class='slide-up pull-right'>收起</div></div></div></div>");
                          $(".index-ques-list").append($new_message);
                          $(".show-more").attr("current-page",pages);
                     }
                break;

                 case "info":
                    for(var i = 0; i < $result.length; i++) {
                      $new_ques =$("<div class='ques-list span'><div class='feed-list span11'><a href='person/question/"+$result[i].user_id+"'><img src='"+$result[i].user_img+"' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a></span><span class='sns-time-list pull-right'>"+$result[i].post_time+"</span></p><p><a href='question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a></p><div class='index-content-list'>"+$result[i].ques_content+"</div><p class='sns-bar'><span>悬赏:</span>&nbsp&nbsp"+$result[i].ques_socore+"<span>浏览:</span>&nbsp&nbsp"+$result[i].browser+"<span>分类:"+$result[i].ques_cate+"</span><span class='pull-right'><a href='question/index/"+$result[i].msgid+"' class='get-index-anwser'>回答(<span>"+$result[i].anwser+"</span>)</a></span><p><div class='display-anwser span1'></div> <div class='slide-up pull-right'>收起</div></div></div></div>");
                      $(".index-ques-list").append($new_ques);
                      $(".show-more").attr("current-page",pages);
                    }
                break;
            }
      } else {
        $(".show-more").css("display","none");
      }
    }); 
}
function get_root_path() {  
  var root = location.protocol + '//' + location.host;
  return root;
}

})();


