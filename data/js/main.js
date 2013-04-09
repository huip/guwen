$(function(){
      var $ques_error_tip = $(".ques-error-tip");
      var create_questitle_bok = false;
      var create_quescate_bok = true;
      var create_quescore_bok = false;
      var subjects = [];
      var is_repeat = [];
      var acount_nickname_bok = true;
      var acount_email_bok = true;
      var acount_oldpass_bok = false;
      var acount_newpass_bok = false;
      var register_email = $("#registerEmail");
      var register_password = $("#registerPassword");
      var re_password = $("#rePassword");
      var register_nick = $("#registerNick");
      var email = $("#inputEmail");
      var password = $("#inputPassword");
      var emailbok = false;
      var passbok = false;
      var emaibok = false;
      var nickbok = false;
      var user_id = $(".user-center").attr('uid');
      var is_favour = 1;

// upload img to server
$("#userfiles").change(function () {

            var iframe = $('<iframe name="postiframe" id="postiframe" style="display: none" />');
            $("body").append(iframe);
            var form = $('#theuploadforms');
            form.attr("action", get_root_path()+"/ajax/auto_upload_file");
            form.attr("method", "post");
            form.attr("enctype", "multipart/form-data");
            form.attr("encoding", "multipart/form-data");
            form.attr("target", "postiframe");
            form.attr("file", $('#userfiles').val());
            form.submit();
            $("#postiframe").load(function () {
                iframeContents = $("#postiframe")[0].contentWindow.document.body.innerHTML;
                $.post(get_root_path()+"/user/upimage",
                  {imgpath:iframeContents},
                  function(result){
                    $(".jc-demo-box").html(result);
                  });

            });

            return false;

        });

// public comment

$(".comment-input").keyup(function(event) {

      if(event.keyCode == 13 ) {
           input_auto($(this),"height",200);
      }
  });
$(".comment-btn").click(function() {
  var $comment = $(".comment-input").val();
  var $qid = $(".question_info").attr("qid");
  var url = get_root_path()+"/ajax/add_comment";
  if($comment != ""){
        $.post(url,
          {comment_content:$comment,ques_id:$qid},
          function(result){
            
            if( result.length == "5"){
              
             var url = get_root_path()+"/index/login";
              alert_msg(result,url);
            } else {
              window.location.href =  get_root_path()+"/question/index/"+$qid; 
            } 
          }
        );
} else {

    var url = window.location.href;
    alert_msg("请填写回答内容！","");
    return false;
}

});

// add favour

$(".sns-favour").click(function() {
  
      var $current_favour = $(this).find("span");
      var $comment_id = $(this).parent().parent().parent().parent().attr("cid");
      var $qid = $(".question_info").attr("qid");
      var $comment_uid = $(this).parent().parent().parent().attr("uid");
       if($(this).hasClass("is_favour")) {

          return false;
        }
        if(is_favour > 2) {
            alert_msg("你已经操作过了！","");
            $(this).addClass("is_favour");
            is_favour = 1;
            return false ;
         }
        
      var url = get_root_path()+"/ajax/add_favour";
      $.ajax({
          async: false, 
          type: "POST",
          url: url,
          data: {comment_id:$comment_id,quesid:$qid,comment_uid:$comment_uid}
          }).done(function(result) {
              $result = $.parseJSON(result);
                if( $result.status == "fail")
                {
                  
                    var url  = get_root_path()+"/index/login";
                    alert_msg("登陆后才能赞，",url);
                } else {
                  $current_favour.html($.trim($result.status));
                  is_favour++
                } 
        });



});

// $(".get-index-anwser").live("click",function() {
//   var $qid = $(this).attr("qid");
//   var $display_anwser = $(this).parent().parent().next().next();
//   var $slide_up = $(this).parent().parent().next().next().next();
//   var url = get_root_path()+"/ajax/get_index_anwser";
//   $.post(url,
//     {quesid:$qid},
//     function(result){
//       var $list_anwser;
//       result = $.parseJSON(result);
//       $display_anwser.html("");

//       for( var i = 0 ; i < result.length ; i++)
//       {
//         $list_anwser= $("<div class='comment-list-info span12'><a href='"+get_root_path()+"/person/question/"+result[i].user_id+"'><img src='"+result[i].user_img+"' class='span1'></a><a href='"+get_root_path()+"/person/question/"+result[i].user_id+"' class='span1'>"+result[i].user_name+"</a><div class='span12 pulll-right'>"+result[i].comment_content+"</div><hr /></div>");
//         $display_anwser.append($list_anwser);
//       }

//       $display_anwser.slideDown("slow",function(){
//         $slide_up.css({"display":"block"});
//       });
//     }
//   );
  
// });

$(".slide-up").click(function(){
  $(this).prev().slideUp("slow");
  $(this).css("display","none");

});

$(".reply-input").keyup(function(event) {
        if(event.keyCode == 13) {

              input_auto($(this),"height",200);
      }
})

$(".cmt-reply").click(function() {
  var $comment_id = $(this).parent().parent().parent().parent().attr("cid");
  var $reply_list = $(this).parent().parent().next().children(".reply-list");
  var url = get_root_path()+"/ajax/get_reply_list";
  if ( $reply_list.attr("is-cmt-reply") == "false" ) {

    $.post(url,
      {comment_id:$comment_id},
      function(result){
        result = $.parseJSON(result); 
        $reply_list.html(" ");    
        for(var i = 0; i < result.length; i++)
        {
          $reply= $("<div class='comment-lists span12'><a href='"+get_root_path()+"/person/question/"+result[i].user_id+"'><img src='"+result[i].user_img+"' class='span1'></a><a href='"+get_root_path()+"/person/question/"+result[i].user_id+"' class='span2'>"+result[i].user_name+"</a><div class='span11 pull-right'>"+result[i].reply_content+"</div><p class='span10  reply-time-list sns-time-list'>"+result[i].time+"</p></div>");
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
    var url = get_root_path()+"/ajax/add_reply";
    $.post(url,
      {reply_content:$reply_content,comment_id:$comment_id},
      function(result){
        
        if(result.length == "5")
        {
           
           var url =get_root_path()+"/index/login";
           alert_msg($.trim(result),url);

        } else {

          result = $.parseJSON(result);

          $reply= $("<div class='comment-lists span12'><a href='"+get_root_path()+"/person/question/"+result.user_id+"'><img src='"+result.user_img+"' class='span1'></a><a href='"+get_root_path()+"/person/question/"+result.user_id+"' class='span2'>"+result.user_name+"</a><div class=' span11 pull-right'>"+$reply_content+"</div><p class='span10 reply-time-list pull-left sns-time-list'>"+result.time+"</p></div>");
          $reply_list.append($reply);
          $reply_num.html(parseInt($reply_num.html())+1);
          $(".reply-input").val(" ");
        }

      }
    );
  } else {

    alert_msg("请填写评论！","");
    return false;
  }

});

$(".nav-tabs li").click(function(){
  $(this).addClass("active").siblings().removeClass("active");
});

$("#nickname").change(function() {
        if($(this).val() == "")
        {
          $(this).parent().parent().addClass("warning");
          $(this).siblings().html("请填写昵称！");
          acount_nickname_bok = false;
        } else  if( !check_is_register($(this).val(),'user_name')) 
        {
              $(this).parent().parent().addClass("warning");
               $(this).siblings().html("昵称已经被存在了！");
               acount_nickname_bok = false;
        }
        else
        {
           $(this).parent().parent().removeClass("warning");
           $(this).siblings().html("");
           acount_nickname_bok = true;
        }
});

$(".profile-alter").click(function(){
    var $nickname = $("#nickname").val();
    var $profile = $("#profile").val();
    var $help_block = $(".help-blocks");
    var url = get_root_path()+"/ajax/profile_alter";
    if( acount_nickname_bok ) {
        $.post(url,
          {nickname:$nickname,profile:$profile},
          function(result){
            $help_block.css({"visibility":"block","color":"red"});
            $help_block.html($.trim(result));
          }
        );
    }else{

        return false;
    }
});
$("#email").change(function() {

        if($(this).val() ==""){
            
            if($(this).parent().parent().hasClass("error")) {

                  $(this).parent().parent().removeClass("error");
            }
            $(this).parent().parent().addClass("warning");
            $(this).siblings().html("请填写邮箱！");
            acount_email_bok = false;

        } else if( is_valid_mail($(this).val()) == false ) {
            if($(this).parent().parent().hasClass("warning")) {

                  $(this).parent().parent().removeClass("warning");
            }
            $(this).parent().parent().addClass("error");
            $(this).siblings().html("邮箱地址错误！");

        } else {

               if($(this).parent().parent().hasClass("warning")) {

                  $(this).parent().parent().removeClass("warning");
             }
            if($(this).parent().parent().hasClass("error")) {

                  $(this).parent().parent().removeClass("error");
            }
            $(this).siblings().html("");
            acount_email_bok = true;
        }

});
$("#oldpassword").blur(function() {
  var $oldpassword = $(this).val();
  var $help_block = $(this);
  var url = get_root_path()+"/ajax/is_true_password";
  var erro;
  $.ajax({
      async: false, 
      type: "POST",
      url: url,
      data: {oldpassword:$oldpassword}
      }).done(function(result) {
          error = $.parseJSON(result);
    });

      if( error.status != "ok") {

        $(this).parent().parent().addClass("error");
        $(this).siblings().html("旧密码错误！");
        acount_oldpass_bok = false;
      }else{

            if($(this).parent().parent().hasClass("error")) {

                  $(this).parent().parent().removeClass("error");
             }

             $(this).siblings().html("");
             acount_oldpass_bok = true;
      }

});
$("#newpassword").blur(function() {

    if($(this).val() == ""){

      if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
      }
      if($(this).parent().parent().hasClass("success")){
          $(this).parent().parent().removeClass("success");
      }
      $(this).next().html("请填写密码！").parent().parent().addClass("warning");
      acount_newpass_bok = false;

    }else if($(this).val().length < 6 ){
        if($(this).parent().parent().hasClass("success")){
          
          $(this).parent().parent().removeClass("success");
        }
        if($(this).parent().parent().hasClass("warning")){
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("密码不能小于6位！").parent().parent().addClass("error");
        acount_newpass_bok = false;
    } else {

      if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
        }
        if($(this).parent().parent().hasClass("warning")){
          
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("");
        acount_newpass_bok = true;
    }

  });

  $("#confirmpassword").blur(function(){

    if($(this).val() != $("#newpassword").val() ) {
      if($(this).parent().parent().hasClass("success")){
          
        $(this).parent().parent().removeClass("success");
      }
      $(this).next().html("两次输入的密码不同！").parent().parent().addClass("warning");
      acount_newpass_bok = false;
    } else {

        if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
        }
        if($(this).parent().parent().hasClass("warning")){
          
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("");
        acount_newpass_bok = true;
    }
  });
$(".acount-alter").click(function(){
      var $email = $("#email").val();
      var url = get_root_path()+"/ajax/acount_alter";
      var $newpassword = $("#newpassword").val();
      var $confirmpassword = $("#confirmpassword").val();
      var $help_block = $(".help-blocks");    
      if( acount_email_bok && acount_newpass_bok && acount_oldpass_bok) {

        $.post(url,
          {email:$email,password:$newpassword},
          function(result){
              $result = $.parseJSON(result);
              if($result.status == "ok") {

                $help_block.html("修改成功！").css("color","red");
              } else {

                    $help_block.html("修改失败！").css("color","");
              }
          });
      } else {

        return false;
    }
});
$(".crop-image").live("click",function() {
  var x = $("#x").val();
  var y = $("#y").val();
  var w = $("#w").val();
  var h = $("#h").val();
  var img_path = $(".upload-img").attr("src");
  var url = get_root_path()+"/ajax/crop_image";
  $.post(url,
    {x:x,y:y,w:w,h:h,imgpath:img_path},
    function(result){
      if( $.trim(result) == "true" )
      {
        window.location.href = get_root_path()+"/user/profile";
      }
    }
  );
});

$(".best-answer").click(function() {
  var $comment_uid = $(this).parent().parent().attr("uid");
  var $score = $(".ques-score").html();
  var $msgid = $(".question_info").attr("qid");
  var $comment_id = $(this).parent().parent().parent().attr("cid");
  var url = get_root_path()+"/ajax/set_best_answer";
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


$(".post-inbox").live("click",function(){
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
  var url = get_root_path()+"/ajax/post_inbox";
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

$("#typeahead").keyup(function(){
  var url = get_root_path()+"/ajax/get_user_infos";
  var user_name = $(this).val();
  $.post(url,
    {user_name:user_name},
    function(result){
      result = $.parseJSON(result);
      if(result.length > 0)
      {
        for(var i = 0; i < result.length; i++)
        {
          if( is_repeat.indexOf( result[i].user_id ) == -1){
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
      content : '<div id="popOverBox span12"></div>' 
});

 $(".search-btn").click(function(){
  var $keywords = $(".search-query").val();
  var url = get_root_path()+"/search/index/"+$keywords;
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
   var url = get_root_path()+"/"+url;
   var pages = current_page+1;
   var tag_id = $(".tag-id").attr("tid");
    if(tag_id != undefined)
    {
      tag_id =tag_id;
    }
    else
    {
      tag_id = "null";
    }
   $.post(url,
    {current_page:pages,tag_id:tag_id},
    function(result){
      $result = $.parseJSON(result);
      if($result.data != 'null') {
            switch(page){
                case "index":
                    for(var i = 0; i < $result.length; i++) {
                      $new_ques =$("<div class='ques-list span'><div class='feed-list span11'><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'><img src='"+$result[i].user_img+"' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a></span><span class='sns-time-list pull-right'>"+$result[i].post_time+"</span></p><p><a href=' "+get_root_path()+"/question/index/"+$result[i].msgid+" '  class='title-a'>"+$result[i].ques_title+"</a></p><p class='sns-bar reply-color'><span>悬赏:</span>&nbsp&nbsp"+$result[i].ques_socore+"<span>浏览:</span>&nbsp&nbsp"+$result[i].browser+"<span>分类:"+$result[i].ques_cate+"</span><span class='pull-right'><a href=' "+get_root_path()+"/question/index/"+$result[i].msgid+"' class='reply-color'>回答(<span>"+$result[i].anwser+"</span>)</a></span></p></div>");
                      $(".index-ques-list").append($new_ques);
                      $(".show-more").attr("current-page",pages);
                    }
                break;

                case "topic":
                    for(var i = 0; i < $result.length; i++) {
                      $new_topic = $("<div class='ques-list span12'><div class='feed-list span11'><a href='"+get_root_path()+"/topic/info/"+result[i].id+" '><img src=' "+$result[i].tag_img+" ' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='"+get_root_path()+"/topic/info/"+$result[i].id+" '>"+$result[i].tag_name+"</a></span></p></div></div></div>");
                      for(var j = 0; j < $result[i].ques.length; j++){
                          $new_ques = $("<p><a href='index.php/question/index/"+$result[i].ques[j].msgid+"'>"+$result[i].ques[j].ques_title+"</a><span class='sns-time-list'>"+$result[i].ques[j].post_time+"</span></p>");
                         $new_topic.children().find(".feed-content").append($new_ques);
                        }
                      $(".index-ques-list").append($new_topic);
                      $(".show-more").attr("current-page",pages);
                    }
                break;

                case "explore":
                     for(var i = 0; i < $result.length; i++) {
                          $new_message =$("<div class='ques-list span'><div class='feed-list span11'><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'><img src='"+$result[i].user_img+"' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a></span><p class='sns-time-list pull-right'>"+$result[i].post_time+"</p></p><p><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"' class='title-a'>"+$result[i].ques_title+"</a></p><p class='sns-bar reply-color'><span>悬赏:</span>&nbsp&nbsp"+$result[i].ques_socore+"<span>浏览:</span>&nbsp&nbsp"+$result[i].browser+"<span>分类:"+$result[i].ques_cate+"</span><span class='pull-right'><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"' class='get-index-anwser reply-color'>回答(<span>"+$result[i].anwser+"</span>)</a></span></p></div>");
                          $(".index-ques-list").append($new_message);
                          $(".show-more").attr("current-page",pages);
                     }
                break;

                 case "info":
                    for(var i = 0; i < $result.length; i++) {
                      $new_ques =$("<div class='ques-list span'><div class='feed-list span11'><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'><img src='"+$result[i].user_img+"' class='user-img span1' /></a><div class='feed-content span11'><p class='feed-content-name'><span><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a></span><span class='sns-time-list pull-right'>"+$result[i].post_time+"</span></p><p><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a></p><p class='sns-bar reply-color'><span>悬赏:</span>&nbsp&nbsp"+$result[i].ques_socore+"<span>浏览:</span>&nbsp&nbsp"+$result[i].browser+"<span>分类:"+$result[i].ques_cate+"</span><span class='pull-right'><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"' class='get-index-anwser reply-color'>回答(<span>"+$result[i].anwser+"</span>)</a></span></p></div>");
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

$(".person-show-more").click(function(){
          var current_page = parseInt($(this).attr("current-page"));
          var page = $(this).attr("page");
          switch(page)
          {
            case "other-question":
               var url = "person/get_new_pages";
               var index = page;
               person_show_more(current_page,url,page,index);
            break;
             case "other-answer":
               var url = "person/get_new_pages";
               var index = page;
               person_show_more(current_page,url,page,index);
            break;

            case "my-question":
                var url = "user/get_new_pages";
                var index = page;
                person_show_more(current_page,url,page,index);
            break;

            case "my-answer":
                var url = "user/get_new_pages";
                var index = page;
                person_show_more(current_page,url,page,index);
            break;
         }

});
function person_show_more(current_page,url,page,index) {
      var url = get_root_path()+"/"+url;
      var pages = current_page+1;
      var uid = $(".person-info-bar").attr("uid");
      $.post(url,
      {current_page:pages,uid:uid,index:index},
          function(result){
          $result = $.parseJSON(result);
          if($result.data != 'null') {
            switch(page){
              case "other-question":
              for(var i = 0 ; i < $result.length; i++){
                $new_ques = $("<div class='comment-list-info'><p><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"' class='title-a'>"+$result[i].ques_title+"</a><p><p class='reply-color'><span>"+$result[i].answer+"个答案</span>&nbsp&nbsp<span>浏览"+$result[i].browser+"</span>&nbsp&nbsp<span class='sns-time-list'>"+$result[i].post_time+"</span></p></div>");
                $(".person-info-list").append($new_ques);
                $(".person-show-more").attr("current-page",pages);
              }
              break;

              case "other-answer":
              for(var i = 0 ; i < $result.length; i++){
                $new_ques = $("<div class='comment-list-info'><p><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"' class='title-a'>"+$result[i].ques_title+"</a><p><p class='reply-color'><span>"+$result[i].answer+"个答案</span>&nbsp&nbsp<span>浏览"+$result[i].browser+"</span>&nbsp&nbsp<span class='sns-time-list'>"+$result[i].post_time+"</span></p></div>");
                $(".person-info-list").append($new_ques);
                $(".person-show-more").attr("current-page",pages);
              }
              break;

              case "my-question":
              for(var i = 0 ; i < $result.length; i++){
                $new_ques = $("<div class='comment-list-info'><p><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"' class='title-a'>"+$result[i].ques_title+"</a><p><p class='reply-color'><span>"+$result[i].answer+"个答案</span>&nbsp&nbsp<span>浏览"+$result[i].browser+"</span>&nbsp&nbsp<span class='sns-time-list'>"+$result[i].post_time+"</span></p></div>");
                $(".person-info-list").append($new_ques);
                $(".person-show-more").attr("current-page",pages);
              }
              break;

              case "my-answer":
              for(var i = 0 ; i < $result.length; i++){
                $new_ques = $("<div class='comment-list-info'><p><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"' class='title-a'>"+$result[i].ques_title+"</a><p><p class='reply-color'><span>"+$result[i].answer+"个答案</span>&nbsp&nbsp<span>浏览"+$result[i].browser+"</span>&nbsp&nbsp<span class='sns-time-list'>"+$result[i].post_time+"</span></p></div>");
                $(".person-info-list").append($new_ques);
                $(".person-show-more").attr("current-page",pages);
              }
              break;

            }
          }
            else
            {
              $(".person-show-more").css("display","none");
            }
    });
}

$(".inbox-show-more").click(function(){
      var current_page = parseInt($(this).attr("current-page"));
      var page = $(this).attr("page");
      switch(page)
      {
            case "inbox-info":
                    var url = "inbox/get_new_pages";
                    inbox_show_more(current_page,url,page)
            break;
      }
});

function inbox_show_more(current_page,url,index) {
      var url = get_root_path()+"/"+url;
      var pages = current_page+1;
      var page_id = $(".comment-list-info").attr("page-id");
      $.post(url,
      {current_page:pages,page_id:page_id},
          function(result){
          $result = $.parseJSON(result);
          $user_info = $result.user_info;
          
          if($user_info != "") {
                for(var i = 0; i < $user_info.length; i++) {

                  var $new_inbox = $("<div class='span10 comment-lists' page-id='"+$user_info[i].page_id+"'><p><a href='"+get_root_path()+"/person/question/"+$user_info[i].my_id+"' class='pull-left inbox-to-name'>"+$user_info[i].name+"</a>:"+$user_info[i].inbox+"</p><span class='sns-time-list'>"+$user_info[i].time+"</span><span class='pull-right'><input type='button' class='btn post-inbox btn-small' value='回复' /></span></div>");
                  $(".inbox-info-list").append($new_inbox);
                  $(".inbox-show-more").attr("current-page",pages);
              }
          }else{

                $(".inbox-show-more").css("display","none");
            }
      });
}

$(".message-show-more").click(function() {
      var current_page = parseInt($(this).attr("current-page"));
      var page = $(this).attr("page");
      var url = "message/get_new_pages";
      message_show_more(current_page,url,page)
});

function message_show_more(current_page,url,page) {
      var url = get_root_path()+"/"+url;
      var pages = current_page+1;
      var uid = $(".user-center").attr("uid");
      $.post(url,
      {current_page:pages,index:page,uid:uid},
          function(result){
          $result = $.parseJSON(result);
           
          if($result.data != 'null') {

                switch(page) {

                    case "answer":
                          for(var i = 0; i < $result.length; i++) {
                              $new_answer = $("<div class='comment-list-info span11'><p><span><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a>回答了你的问题:</span><span><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a></span></p><p>"+$result[i].comment_content+"</p><p class='sns-time-list'>"+$result[i].comment_time+"</p></div>");
                              $(".my-reply").append($new_answer);
                              $(".message-show-more").attr("current-page",pages);
                          }
                    break;

                    case "reply":
                          for(var i = 0; i < $result.length; i++) {
                              $new_reply = $("<div class='comment-list-info span11'><p><span><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a>在问题&nbsp</span><span><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a>中回复了你的回答:"+$result[i].comment_content+"</span></p><p>"+$result[i].reply_content+"</p><p class='sns-time-list'>"+$result[i].time+"</p></div>");
                              $(".my-reply").append($new_reply);
                              $(".message-show-more").attr("current-page",pages);
                          }
                    break;

                    case "favour":
                          for(var i = 0; i < $result.length; i++) {
                              $new_favour = $("<div class='comment-list-info span11'><span><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a>在问题&nbsp</span><span><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a>中回赞了你的回答:"+$result[i].comment_content+"</span><p class='sns-time-list'>"+$result[i].favour_time+"</p></div>");
                              $(".my-reply").append($new_favour);
                              $(".message-show-more").attr("current-page",pages);
                          }
                    break;

                    case "best":
                          for(var i = 0; i < $result.length; i++) {
                              $new_best = $("<div class='comment-list-info span12'><span><a href='"+get_root_path()+"/person/question/"+$result[i].user_id+"'>"+$result[i].user_name+"</a>在问题&nbsp</span><span><a href='"+get_root_path()+"/question/index/"+$result[i].msgid+"'>"+$result[i].ques_title+"</a></p>中把你的回答:"+$result[i].comment_content+"设为最佳答案</span><p class='sns-time-list'>"+$result[i].time+"</p><p><a href='"+get_root_path+"index.php/question/index/"+$result[i].msgid+"'>快去看看吧</a></p></div>");
                              $(".my-reply").append($new_best);
                              $(".message-show-more").attr("current-page",pages);
                          }
                    break;
                }

          }else{

                $(".message-show-more").css("display","none");
            }
      });
}
$(window).scroll(function() {

      if( $(window).scrollTop() > $(window).height() ){
            
            $(".to-top").css("display","block");
      }else {
            $(".to-top").css("display","none");
      }
});

// question public 
$(".question-content").keyup(function(event) {

      if(event.keyCode == 13) {

              input_auto($(this),"height",200);
      }
})
$("#formsubmit").click(function() {
      if( create_questitle_bok&&create_quescore_bok&&create_quescate_bok ){
              var $question_title = $(".question-title").val();
              var $question_content = $(".question-content").val();
              var $cate = $(".question-cate option:selected").val();
              var $question_socore = parseInt($(".question-socore").val());
              var $question_anoy = $(".question-anoy").attr("checked")?1:0;
              var url = get_root_path()+"/ajax/post_message";
              var  urls = get_root_path()+"/ajax/scwc_api";
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
                        });

                 } else {
                  alert("发送失败请重新发布！");
                 }
              });
        } else {

          if(!create_questitle_bok) {

            return ques_error_tip("请填写标题！","error");
          } else if( !create_quescore_bok ) {

              return ques_error_tip("填写悬赏积分！","error");
          
          } else if( !create_quescate_bok ) {

            return ques_error_tip("请创建分类！","error");
        }
          
        }
});

$(".create").click(function() {
      $(this).css("display","none");
      $(".create-cate").css("display","block");
      create_quescate_bok = false;
})

$(".create-cate span").click(function() {
      var $cate_name = $(this).siblings().val();
      var url = get_root_path()+"/ajax/create_cate";
      var bok = false;
      if($cate_name == "") {
          $(this).parent().css("display","none");
           create_quescate_bok = true;
      }else {
          $(".ques-error-tip").html("").css("color","");
          bok = true;
          create_quescate_bok = true;
      }

      if( bok == true) {
          $.ajax({
              async: false, 
              type: "POST",
              url: url,
              data: { cate_name:$cate_name}
              }).done(function(result) {
                     var $option;
                     $result = $.parseJSON(result);
                      for(var i = 0 ; i < $result.length ; i++) {

                        $option += "<option  selected value="+$result[i].id+">"+$result[i].tag_name+"</option>";

                      }
                      $(".question-cate").html($option);
                      $(".create-cate").css("display","none");
              }); 
      }
});

$(".question-title").blur(function() {
        var msg;
        if($(this).val() == "") {
            msg = "请填写标题!";
            create_questitle_bok = ques_error_tip(msg,"error");
        }
        else if($(this).val().length < 4) {

            msg = "标题不得小于4个字符!";
            create_questitle_bok = ques_error_tip(msg,"short");
        } else {

           create_questitle_bok = ques_error_tip("","success")
        }
});


$(".question-socore").change(function(){

  var $score = $(this).val();
  var $uid = $(".user-center").attr("uid");
  var url = get_root_path()+"/ajax/check_score";
  if( $score.substr(0,1) > 0) {
      if($score >= 0){
          $.post(url,
            {uid:$uid,score:parseInt($score)},
            function(result){
              result = $.trim(result);
              if(result != ""){
                  create_quescore_bok = ques_error_tip(result,"error");
              } else
              {
                 create_quescore_bok = ques_error_tip("","success");
              }

          });
        } else {

           create_quescore_bok  = ques_error_tip("请填写悬赏分数！","error");

        }
} else {

        create_quescore_bok  = ques_error_tip("请输入正确的分数！","error");
}

});

 // user register and login form invalid
register_email.keyup(function() {
    $(".error-tip").html("");
    if($(this).val() == ""){

      if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
      }
      if($(this).parent().parent().hasClass("success")){
          $(this).parent().parent().removeClass("success");
      }
      $(this).next().html("请填写邮箱！").parent().parent().addClass("warning");
      emailbok = false;

    }else if( is_valid_mail($(this).val()) == false ){
        if($(this).parent().parent().hasClass("success")){
          
          $(this).parent().parent().removeClass("success");
        }
        if($(this).parent().parent().hasClass("warning")){
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("邮箱错误！").parent().parent().addClass("error");
        emailbok = false;
    } else {

      if(check_is_register($(this).val(),'user_email')){

        if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
        }
        if($(this).parent().parent().hasClass("warning")){
          
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("邮箱可以注册！").parent().parent().addClass("success");
        emailbok = true;
      }
      else
      {
        if($(this).parent().parent().hasClass("warning")){
          $(this).parent().parent().removeClass("warning");
        }
        if($(this).parent().parent().hasClass("success")){
          $(this).parent().parent().removeClass("success");
        }
        $(this).next().html("邮箱名已经被注册！").parent().parent().addClass("error");
        emailbok = false;
      }

      
    }
  });

  register_nick.keyup(function() {
    $(".error-tip").html("");
    if($(this).val() == ""){

      if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
      }
      if($(this).parent().parent().hasClass("success")){
          $(this).parent().parent().removeClass("success");
      }
      $(this).next().html("请填写昵称！").parent().parent().addClass("warning");
      nickbok = false;

    }else if($(this).val().length < 2 ){
        if($(this).parent().parent().hasClass("success")){
          
          $(this).parent().parent().removeClass("success");
        }
        if($(this).parent().parent().hasClass("warning")){
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("昵称太短！").parent().parent().addClass("error");
        nickbok = false;
    } else if( $(this).val().length > 8 ) {

            if($(this).parent().parent().hasClass("success")){
          
            $(this).parent().parent().removeClass("success");
        }
        if($(this).parent().parent().hasClass("warning")){

          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("昵称不能超过8位！").parent().parent().addClass("error");
        nickbok = false;

    } else {

      if(check_is_register($(this).val(),'user_name')){

        if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
        }
        if($(this).parent().parent().hasClass("warning")){
          
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("昵称可以注册！").parent().parent().addClass("success");
        nickbok = true;
      }
      else
      {
        if($(this).parent().parent().hasClass("warning")){
          $(this).parent().parent().removeClass("warning");
        }
        if($(this).parent().parent().hasClass("success")){
          $(this).parent().parent().removeClass("success");
        }
        $(this).next().html("昵称已经被注册！").parent().parent().addClass("error");
        nickbok = false;
      }

      
    }
  });
  
  register_password.keyup(function() {

    $(".error-tip").html("");
    if($(this).val() == ""){

      if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
      }
      if($(this).parent().parent().hasClass("success")){
          $(this).parent().parent().removeClass("success");
      }
      $(this).next().html("请填写密码！").parent().parent().addClass("warning");
      passbok= false;

    }else if($(this).val().length < 6 ){
        if($(this).parent().parent().hasClass("success")){
          
          $(this).parent().parent().removeClass("success");
        }
        if($(this).parent().parent().hasClass("warning")){
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("密码不能小于6位！").parent().parent().addClass("error");
        passbok = false;
    } else {

      if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
        }
        if($(this).parent().parent().hasClass("warning")){
          
          $(this).parent().parent().removeClass("warning");
        }
        $(this).next().html("").parent().parent().addClass("success");
        passbok = true;
    }

  });

  re_password.keyup(function(){

    if($(this).val() != register_password.val() ) {
      if($(this).parent().parent().hasClass("success")){
          
        $(this).parent().parent().removeClass("success");
      }
      $(this).next().html("两次输入的密码不同！").parent().parent().addClass("warning");
      passbok = false;
    } else {

      $(this).next().html("").parent().parent().addClass("success");
      passbok = true;
    }
  });
  $(".register-btn").click(function() {

    if( emailbok&&passbok&&nickbok) {

      user_name =register_nick.val();
      user_email = register_email.val();
      user_password = register_password.val();
      register(get_root_path()+"/ajax/register",user_name,user_email,user_password);
    }
  });

  function register(url,username,useremail,userpassword) {
    $.post(url,
      {username:username,useremail:useremail,userpassword:userpassword},
      function(result){
        $result = $.parseJSON(result);
        if($result.status == "ok") {
          window.location.href = get_root_path()+"/index";
        } else {
          $(".error-tip").html("注册失败！").css("color","#b94a48");
        }
      }
    );
  }

email.keyup(function() {
          $(".error-tip").html("");
          if($(this).val() == ""){

              if($(this).parent().parent().hasClass("error")){
                $(this).parent().parent().removeClass("error");
              }
              $(this).next().html("请填写邮箱！").parent().parent().addClass("warning");
              emailbok = false;

              }else if( is_valid_mail(email.val()) == false ){
                if($(this).parent().parent().hasClass("warning")){
                      $(this).parent().parent().removeClass("warning");
                }
              $(this).next().html("邮箱错误！").parent().parent().addClass("error");
                      emailbok = false;
              } else {

              if($(this).parent().parent().hasClass("error")){

                 $(this).parent().parent().removeClass("error");

              }
              if($(this).parent().parent().hasClass("warning")){

                  $(this).parent().parent().removeClass("warning");

              }
              $(this).next().html("");
          emailbok = true;
          }
  });

  password.keyup(function() {
    $(".error-tip").html("");
    if($(this).val() == ""){

      if($(this).parent().parent().hasClass("error")){
          $(this).parent().parent().removeClass("error");
      }
      $(this).next().html("请填写密码！").parent().parent().addClass("warning");
      passbok = false;

    } else if( $(this).val().length < 6){

      $(this).next().html("密码太短了！").parent().parent().addClass("warning");
      passbok = false;
    } else {

      if($(this).parent().parent().hasClass("warning")){
        
        $(this).parent().parent().removeClass("warning");
      }
      $(this).next().html("");
      passbok = true;
    }
  });
  $(".login-btn").click(function() {
    if( emailbok == true && passbok == true ){
      user_email = email.val();
      user_password = password.val();
      login(get_root_path()+"/ajax/login",user_email,user_password);
    }
    else{

      return false;
    }
  });

  function login(url,useremail,userpassword) {

    $.post(url,
      {useremail:useremail,userpassword:userpassword},
      function(result){
        $result = $.parseJSON(result);
      if($result.status == "1"){

        window.location.href = get_root_path()+"/index/index";

      } else {

        $(".error-tip").html("用户名或密码错误！").css("color","#b94a48");
      }
    });
  }


$(".question-alter").click(function() {
      
})
  function alter_quesition() {

  }
  function check_is_register(data,cate) {
    var url = get_root_path()+"/ajax/check_is_register";
    var bok = false;
    $.ajax({
      async: false, 
      type: "POST",
      url: url,
      data: { data: data, cate:cate }
      }).done(function(result) {
        $result = $.parseJSON(result);
        if($result.status == "0")
        {
          bok = true;
        }
    });
    return bok;
  }


function ques_error_tip(msg,type) {
    var bok = false;
    if(type =="error") {

      $ques_error_tip.html(msg).css("color","#b94a48");

    } else if( type == "short"){

      $ques_error_tip.html(msg).css("color","#b94a48");
    }
    else
    {
        $ques_error_tip.html(msg).css("color","");
        bok = true;
    }

    return bok;

}

// nav effect 
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
              
           var url = get_root_path()+"/index/login";
            alert_msg("亲，只有登录后才能发布问题",url);

      });
      $(".erro-confirm").click(function(){


          if( $(this).attr("data-target") != "") {
              window.location.href= $(this).attr("data-target");
            }else {

                $(".erro-confirm").attr("data-dismiss","modal");
            }

      });
      $(".login-btn-trans").click(function(){
            window.location.href = get_root_path()+"/index/login";
      });
      $(".register-btn-trans").click(function(){
            window.location.href = get_root_path() + "/index/register";
      });


function alert_msg(msg,url){
      $("#erro_tip").modal('toggle');
      $(".ero-msg-body").html(msg);
      $(".erro-confirm").attr("data-target",url);
    

}
function input_auto(element,arg,speed) {
      var func,sprite;
      if( arg == "height") {

          func = element.height();
          sprite = element.scrollTop();
          element.animate({"height":parseInt(func+sprite)},speed);

      } else {
          func = element.width();
          sprite = element.scrollLeft();
          element.animate({"width":parseInt(func+sprite)},speed);
      }

}
function get_new_inbox() {
  var url = get_root_path()+"/ajax/get_new_inbox";
  $.post(url,
    {user_id:user_id},
    function(result){
      result = $.parseJSON(result);
      if( result[0].inboxnum > "0") {
        show_message("","您有"+result[0].inboxnum+"条新的私信息请注意查收");
        $(".bubble").css("visibility","visible").html(result[0].inboxnum);
        
      }else{
        $(".bubble").css("visibility","hidden");
      }
    });
}

function init() {  
            if (window.webkitNotifications) {  
                window.webkitNotifications.requestPermission();  
      }  
}  
function show_message(title,body) {
    if(window.webkitNotifications) {

      if (window.webkitNotifications.checkPermission() >= 0) {  
           window.webkitNotifications.requestPermission(show_message);
      } else {

             
             window.webkitNotifications.createNotification(get_root_path()+"/data/upimage/thumbnail/defualtlogo.png",title,body); 
      }

    }
}


function get_new_message() {
    var url = get_root_path()+"/message/get_message_num";
    $.post(url,
    {user_id:user_id},
    function(result){
        result = $.parseJSON(result);
        var answer = parseInt(result.answer);
        var reply = parseInt(result.reply);
        var favour = parseInt(result.favour);
        var best = parseInt(result.best);
        var num  = answer + reply+favour+best;
        if( num > 0 ) {
          show_message("","您有"+num+"条新的消息请注意查收");
          $(".message-bubble").css("visibility","visible").html(num);
      }else{
         $(".message-bubble").css("visibility","hidden");
      }

      if( answer > 0 ) {
          $(".answer-bubble").css("visibility","visible").html(answer);
      }else{
         $(".answer-bubble").css("visibility","hidden");
      }

      if( reply > 0) {

          $(".reply-bubble").css("visibility","visible").html(reply);
      }else{
          $(".reply-bubble").css("visibility","hidden");
      }

      if( favour> 0) {

          $(".favour-bubble").css("visibility","visible").html(favour);
      }else{
          $(".favour-bubble").css("visibility","hidden");
      }

      if( best > 0) {

          $(".best-bubble").css("visibility","visible").html(best);
      }else{
          $(".best-bubble").css("visibility","hidden");
      }
    });
}


// to judge user is login and  push the inbox 
if ( user_id != undefined ) {
      get_new_inbox();
      get_new_message();
      setInterval(get_new_inbox,15000);
      setInterval(get_new_message,15000);
}

// return current web app's full dir
function get_root_path() {  
  var root = location.protocol + '//' + location.host+'/index.php';
  return root;
}

// add indexOf array function to compatible ie8 and ie9
if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length >>> 0;

    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;

    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}

// valid email is true
function is_valid_mail(sText) {
    var reMail = /^(?:[a-z\d]+[_\-\+\.]?)*[a-z\d]+@(?:([a-z\d]+\-?)*[a-z\d]+\.)+([a-z]{2,})+$/i;
    return reMail.test(sText);
}

});
