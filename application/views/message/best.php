<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      	<ul class="nav nav-tabs">
		<li><a href="<?=base_url()?>index.php/message/index">回答</a></li>
		<li class=""><a href="<?=base_url()?>index.php/message/reply">回复</a></li>
		<li class=""><a href="<?=base_url()?>index.php/message/favour">赞同</a></li>
		<li class="active"><a href="<?=base_url()?>index.php/message/best">最佳回答</a></li>
	</ul>
	<div class="my-best">
		<div class="my-reply">
			<?foreach ($best as $key => $value): {?>
				<div class="comment-list-info span12">
					<p><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>"><?=$value['user_name']?></a>：在问题<a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>"><?=$value['ques_title']?></a></p>
					<p>中把你的回答:<?=$value['comment_content']?>设为最佳答案</p>
					<p><?=$value["time"]?></p>
					<p><a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>">快去看看吧</a></p>
				</div>
			<?}endforeach?>
		</div>
		<?if(count($best) > 0){
			if( $best[0]['num'] > 1){
		?>
		<div class="span12 btn message-show-more" page="best" current-page="1">更多</div> 
		<?}}?>
	</div>
  </div>
  <div class="span3">
    	<div class="right-bar">
            <div class="">
               <h5>故问公告</h5>
               <div>
                 <p> 今天是第5周，星期六</p>
                  <p>周末! 去哪里玩儿呢？</p>
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
                        <p><a href="<?=base_url()?>/index.php/topic/info/<?=$value['id']?>"><img height="40" width="40" src="<?=$value['tag_img']?>" /><?=$value['tag_name']?></a></p>
                    </div>
                <?}endforeach?>
            </div>
      </div>
    </div>
</div>
</div>
<div class="">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>