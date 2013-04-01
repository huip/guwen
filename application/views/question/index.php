<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
        <h5 class="modal-header"><i class="icon-list"></i>&nbsp&nbsp问题详情</h5>
      <div class="list_info span10">
        
        <?php foreach ($question as $key => $value): {?>
        <h4 class="ques-title" ques-uid ="<?=$value['user_id']?>"><?=$value['ques_title'];?></h4>
        <p><?=$value['ques_content'];?></p>
        <p class="sns-bar question_info" qid="<?=$value['msgid'];?>" >
          <span>提问者:<a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><?=$value['user_name'];?></a></span>
          <span>悬赏积分：<span class="ques-score"><?=$value['ques_socore'];?></span></span>
          <span>分类：<?=$value['ques_cate'];?></span>
          <span class="sns-time-list"><?=$value['post_time'];?></span>
        <p>
        <?php } endforeach;?>
      </div>
      <div class="comment-list span10">
                        <?php 
                            if($value['user_id'] == $user_id && $value['is_best'] != "1"){
                            foreach ($comment as $key => $value): {?>
                            
                        <div class="comment-list-info span12" cid ="<?=$value['id']?>">
                                    <a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><img src="<?=$value['user_img'];?>" class="span1" /></a>
                                    <div class="comment-intro span10" uid="<?=$value['comment_uid']?>">
                                        <p><a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><?= $value['user_name'];?></a>
                                                <span class="pull-right btn btn-small btn-danger best-answer">最佳答案</span>
                                        </p>
                                        <p class=""><?= $value['comment_content'];?></p>
                                        
                                       <p><span class="sns-time-list pull-left"><?=$value['comment_time'];?></span><span class="pull-right"><span class="btn sns-favour btn-small"><i class="icon-thumbs-up"></i>赞同(<span><?=$value['comment_favour']?></span>)</span>&nbsp&nbsp<span class="btn cmt-reply btn-small"  clicked="false" ><i class="icon-comment"></i>回复(<span class="cmt-num"><?=$value['reply_num']?></span>)</span></span></p>
                                        <div class="comment-reply">
                                            <div class="reply-list span10" is-cmt-reply = "false">
                                            </div>
                                            <div class="addreply span10">
                                                <textarea class="reply-input"></textarea><br />
                                                <input type="button" class="btn pull-right  reply-btn btn-primary" value="提交" />
                                            </div>
                                        </div>
                            </div>
                        </div>
                    <?} endforeach;} else{?>

                    <? foreach ($comment as $key => $value): {?>
                        <div class="comment-list-info span12" cid ="<?=$value['id']?>">
                                    <a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><img src="<?=$value['user_img'];?>" class="span1" /></a>
                                    <div class="comment-intro span11" uid="<?=$value['comment_uid']?>">
                                        <p><a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><?= $value['user_name'];?></a>
                                        <p>
                                        <p class=""><?= $value['comment_content'];?></p>
                                        
                                        <p><span class="sns-time-list pull-left"><?=$value['comment_time'];?></span><span class="pull-right"><span class="btn sns-favour btn-small"><i class="icon-thumbs-up"></i>赞同(<span><?=$value['comment_favour']?></span>)</span>&nbsp&nbsp<span class="btn cmt-reply btn-small"  clicked="false" ><i class="icon-comment"></i>回复(<span class="cmt-num"><?=$value['reply_num']?></span>)</span></span></p>
                                        <div class="comment-reply">
                                            <div class="reply-list span12" is-cmt-reply = "false">
                                            </div>
                                            <div class="addreply span11">
                                                <textarea class="reply-input"></textarea><br />
                                                <input type="button" class="btn pull-right  reply-btn  btn-primary" value="提交" />
                                            </div>
                                        </div>
                            </div>
                        </div>
                    <?} endforeach;}?>
      </div>
      <div class="addcoment span11">
        <h5>回答问题</h5>
        <textarea class="comment-input"></textarea><br />
        <input type="button" class="btn pull-right comment-btn btn-primary" value="提交" />
      </div>
      </div>
    <div class="span3">
        <p class="modal-header relative-ques">相关问题</p>
        <?
                foreach ($relative_question as $key => $value):{
                    foreach ($value as $key => $values): {?>
                        
                        <div class="">
                            <p class="span12">
                                <a  class="pull-left" href="<?=$values['msgid']?>"><?=$values['ques_title']?></a>
                                <span class="pull-right"><span><?=$values['ques_cate']?></span>&nbsp&nbsp<span>回答:<?=$values['anwser']?></span></span>
                            </p>
                        </div>
                    <?}endforeach;
              } endforeach?>

    
</div>
  </div>
</div>
</div>