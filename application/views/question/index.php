<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
        <h5 class="modal-header"><i class="icon-list"></i>&nbsp&nbsp问题详情</h5>
      <div class="list_info span10">
        
        <?php foreach ($question as $key => $value): {?>
        <h4 class="ques-title" ques-uid ="<?=$value['user_id']?>"><?=$value['ques_title'];?></h4>
        <p><?=nl2br($value['ques_content']);?></p>
        <p class="sns-bar question_info reply-color" qid="<?=$value['msgid'];?>" >
          <span>提问者:<a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>" class="reply-color"><?=$value['user_name'];?></a></span>
          <span>悬赏积分：<span class="ques-score"><?=$value['ques_socore'];?></span></span>
          <span>分类：<?=$value['ques_cate'];?></span>
          <span class="sns-time-list"><?=$value['post_time'];?></span>
        <p>
        <?php } endforeach;?>
      </div>
      <div class="addcoment span11">
        <h5>回答问题</h5>
        <textarea class="comment-input"></textarea><br />
        <input type="button" class="btn pull-right comment-btn btn-primary" value="发布" />
      </div>
      <div class="comment-list span10">

                        <?php 
                            if($value['user_id'] == $user_id && $value['is_best'] != "1"){
                            foreach ($comment as $key => $value): {?>
                            
                        <div class=" comment-lists span12" cid ="<?=$value['id']?>">
                                    <a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><img src="<?=$value['user_img'];?>" class="span1" /></a>
                                    <div class="comment-intro span10" uid="<?=$value['comment_uid']?>">
                                        <p><a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><?= $value['user_name'];?></a>
                                                <span class="pull-right btn btn-small btn-danger best-answer">最佳答案</span>
                                        </p>
                                        <p class=""><?= nl2br($value['comment_content']);?></p>
                                        
                                       <p>
                                                <span class="sns-time-list pull-left"><?=$value['comment_time'];?></span>
                                                <span class="pull-right sns-ques-bar"><span class="sns-favour">
                                                <i class="icon-thumbs-up"></i>赞同(<span><?=$value['comment_favour']?></span>)</span>
                                                &nbsp&nbsp<span class=" cmt-reply "  clicked="false" >
                                                <i class="icon-comment"></i>回复(<span class="cmt-num"><?=$value['reply_num']?></span>)
                                            </span></span>
                                        </p>
                                       <div class="comment-reply">
                                            <div class="reply-list span12" is-cmt-reply = "false">
                                                <? foreach ( $value['reply'] as $key => $value):{?>
                                                    <div class='comment-lists span11'>
                                                        <a href=''>
                                                            <img src='<?=$value['user_img']?>' class='span1'>
                                                        </a>
                                                        <a href='' class='span2'><?=$value['user_name']?></a>
                                                        <div class='span11 pull-right'><?=$value['reply_content'];?></div>
                                                        <p class='span10  reply-time-list sns-time-list'><?=$value['time']?></p>
                                                    </div>
                                                <?}endforeach?>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    <?} endforeach;} else{?>

                    <? foreach ($comment as $key => $value): {?>

                        <div class="comment-lists span12" cid ="<?=$value['id']?>">

                                    <a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><img src="<?=$value['user_img'];?>" class="span1" /></a>
                                    <div class="comment-intro  span11" uid="<?=$value['comment_uid']?>">
                                        <p><a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>"><?= $value['user_name'];?></a>
                                            <?if($value['best_uid'] == $value['user_id'] ){?>
                                                <span class="is_best-answer pull-right">最佳答案</span>
                                            <?}?>
                                        </p>
                                        <p class=""><?= nl2br($value['comment_content']);?></p>
                                        
                                        <p><span class="sns-time-list pull-left">
                                                <?=$value['comment_time'];?></span>
                                                <span class="pull-right"><span class=" sns-favour">
                                                <i class="icon-thumbs-up"></i>赞同(<span><?=$value['comment_favour']?></span>)</span>
                                                &nbsp&nbsp<span class=" cmt-reply"  clicked="false" >
                                                <i class="icon-comment"></i>回复(<span class="cmt-num"><?=$value['reply_num']?></span>)
                                                </span></span>
                                        </p>
                                        <div class="comment-reply">
                                            <div class="reply-list span12" is-cmt-reply = "false">
                                                <? foreach ( $value['reply'] as $key => $value):{?>
                                                    <div class='comment-lists span11'>
                                                        <a href=''>
                                                            <img src='<?=$value['user_img']?>' class='span1'>
                                                        </a>
                                                        <a href='' class='span2'><?=$value['user_name']?></a>
                                                        <div class='span11 pull-right'><?=$value['reply_content'];?></div>
                                                        <p class='span10  reply-time-list sns-time-list'><?=$value['time']?></p>
                                                    </div>
                                                <?}endforeach?>
                                            </div>
                                            <div id="addreply"> 
                                                <textarea class="reply-input"></textarea><br />
                                                <input type="button" class="btn pull-right  reply-btn  btn-primary" value="发布" />
                                            </div>
                                        </div>
                            </div>
                        </div>
                    <?} endforeach;}?>
      </div>
      
      </div>
    <div class="span3 relative-ques-bar">
        <p class="modal-header relative-ques">相关问题</p>
        <?
                foreach ($relative_question as $key => $value):{
                    foreach ($value as $key => $values): {?>
                        
                        <div class="">
                            <div class="span12 relative-ques-list">
                                <p><a href="<?=$values['msgid']?>"><?=$values['ques_title']?></a></p>
                                <p class=" ques-sns-list reply-color"><span><?=$values['ques_cate']?></span>&nbsp&nbsp<span>回答:<?=$values['anwser']?></span></p>
                            </div>
                        </div>
                    <?}endforeach;
              } endforeach?>
</div>
  </div>
</div>
<div class="to-top">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>