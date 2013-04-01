<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span12">
  		<ul class="nav nav-tabs">
			<li class="">
			    <a href="<?=base_url();?>index.php/user/index">我的提问</a>
			</li>
			<li class="active"><a href="<?=base_url();?>index.php/user/answer">我的回答</a></li>
		</ul>
		 <div class="person-list span8 pull-left">
                <div class="person-info-list">
                <?php foreach ($answer_info as $key => $value):{?>
                      <div class="comment-list-info">
                          <p><a href="<?=base_url();?>/index.php/question/index/<?=$value['msgid'];?>"><?=$value['ques_title']?></a><p>
                          <p><?=$value['myanswer']?></p>
                          <p class="reply-color"><span><?=$value['answer']?>个答案<span>&nbsp&nbsp<span>浏览<?=$value['browser']?></span>&nbsp&nbsp<span class="sns-time-list"><?=$value['post_time']?></span></p>
                      </div>
               <?php } endforeach;?>              
             </div>
              <?
                  if( count($answer_info) > 0){
                    if( $answer_info[0]['num'] > 1 ){?>
                        <div class="span12 btn person-show-more" page="my-answer" current-page="1">更多</div> 
                    <?}
                }?>                     
             </div>
              <div class="usercnt-list span4 pull-right">
                   <?foreach ($person_info as $value) :{?>
                   <pre>
                        <img src='<?=$value['user_img']?>' />
                        <p  uid="<?=$value['user_id']?>" class="person-info-bar"><?=$value['user_name']?></p>
                        <p>积分：<?=$value['user_score']?></p>
                        <p>等级:<?=$value['rank']?></p>
                        <p>升级还差:<?=$value['gap']?>积分</p>
                         <p><?=$value['user_motto']?></p>
                    </pre>
                   <?}endforeach?>           
             </div>
  	</div>
    </div>
</div>
<div class="to-top">
  <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>