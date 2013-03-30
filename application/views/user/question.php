<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span12">
  		<ul class="nav nav-tabs">
			<li class="active">
			    <a href="<?=base_url();?>index.php/user/index">我的提问</a>
			</li>
			<li><a href="<?=base_url();?>index.php/user/answer">我的回答</a></li>
		</ul>
		<div class="usercnt-list span7 pull-left">
                <?php foreach ($question_info as $key => $value):{?>
                      <div class="usercnt">
                          <p><a href="<?=base_url();?>index.php/question/index/<?=$value['msgid'];?>"><?=$value['ques_title']?></a><p>
                          <p><span><?=$value['answer']?>个答案<span>&nbsp&nbsp<span>浏览<?=$value['browser']?></span>&nbsp&nbsp<span class="sns-time-list"><?=$value['post_time']?></span></p>
                      </div>
               <?php } endforeach;?>
             </div>
              <div class="usercnt-list span4 pull-right">
                   <?foreach ($person_info as $value) :{?>
                   <pre>
                        <img src='<?=$value['user_img']?>' />
                        <p><?=$value['user_name']?></p>
                        <p>积分：<?=$value['user_score']?></p>
                        <p><?=$value['user_motto']?></p>
                    </pre>
                   <?}endforeach?>           
             </div>
  	</div>
  </div>
</div>
</div>
