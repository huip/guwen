<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      	<ul class="nav nav-tabs">
		<li class="active">
                  <span class="answer-bubble"></span>
		    <a href="<?=base_url()?>index.php/message/index">回答</a>
		</li>
		<li class="">
                  <span class="reply-bubble"></span>
                  <a href="<?=base_url()?>index.php/message/reply">回复</a>
                </li>
		<li class="">
                  <span class="favour-bubble"></span>
                  <a href="<?=base_url()?>index.php/message/favour">赞同</a>
                </li>
		<li class="">
                  <span class="best-bubble"></span>
                  <a href="<?=base_url()?>index.php/message/best">最佳回答</a>
              </li>
	</ul>
	<div class="my-answer">
		<div class="my-reply">
			<?foreach ($answer as $key => $value):{?>
				<div class="comment-list-info  span11">
                                <p>
    					   <span><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>"><?=$value['user_name']?>:</a>回答了你的问题:</span>
    					   <span><a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>"><?=$value['ques_title']?></a></span>
                                </p>
                                  <p class="ft15"><?=nl2br($value['comment_content'])?></p>
					<p class="sns-time-list"><?=$value['comment_time']?></p>
				</div>
			<?}endforeach?>
		</div>
		<?if(count($answer) > 0){
			if( $answer[0]['num'] > 1){
		?>
	       <div class="span11 btn message-show-more" page="answer" current-page="1">更多</div> 
		<?}}?>
	</div>
  </div>
  <div class="span3">
        <div class="right-bar">
              <div class="tips">
                 <h5>故问公告</h5>
                 <div>
                   <p> 欢迎使用故问！</p>
                   <p>现在是故问的公测时间，大家有什么意见反馈可以直接发故问反馈</p>
                   <p>期待安卓版版本的发布</p>
                 </div>
              </div>
              <div class="hot-ques">
                <h5>热门问题</h5>
                <?foreach ($hot_ques as $key => $value): {?>
                  <div class="hot-ques-list">
                      <p><a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>"><?=$value['ques_title']?></a></p>
                      <p class="reply-color"><span>浏览:<?=$value['browser']?></span><span> 分类:<?=$value['ques_cate']?></span>
                              <span>回答:<?=$value['anwser']?></span>
                    </p>
                  </div>
                <?}endforeach?>
              </div>
              <div class="hot-cate">
                <h5>热门分类</h5>
                  <?foreach ($hot_cate as $key => $value): {?>
                      <div class="hot-cate-list">
                          <p>
                              <span class="pull-left"><a href="<?=base_url()?>index.php/topic/info/<?=$value['id']?>"><img height="40" width="40" src="<?=$value['tag_img']?>" alt="tag_logo" /></a></span>
                              <p>
                                  <a href="<?=base_url()?>index.php/topic/info/<?=$value['id']?>" class="hot-ques-title"><?=$value['tag_name']?></a>
                                  <p class="hot-ques-num">共<?=$value['num']?>个问题</p>
                              </p>
                          </p>
                      </div>
                  <?}endforeach?>
              </div>
              <div class="hot-person">
                  <h5>活跃用户</h5>
                  <?foreach ($hot_person as $key => $value): {?>
                      <div class="hot-cate-list">
                          <p>
                              <span class="pull-left"><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>"><img height="40" width="40" src="<?=$value['user_img']?>" alt="tag_logo" /></a></span>
                              <p>
                                  <a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>" class="hot-ques-title"><?=$value['user_name']?></a>
                                  <p class="hot-ques-num"><?=$value['rank']?></p>
                              </p>
                          </p>
                      </div>
                  <?}endforeach?>
              </div>
        </div>
    </div>
</div>
</div>
<div class="to-top">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>