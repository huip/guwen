<div id="main" class="span14">
<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span12">
  		<ul class="nav nav-tabs">
			<li class="">
			    <a href="<?=base_url();?>index.php/usercenter/index">我的提问</a>
			</li>
			<li><a href="<?=base_url();?>index.php/usercenter/answer">我的回答</a></li>
			<li class="active"><a href="<?=base_url();?>index.php/usercenter/message">我的消息</a></li>
		</ul>
		<div class="usercnt-list span7 pull-left">
                <?php foreach ($message_info as $key => $value):{?>

                    
                          <div><? foreach ($value['user_name'] as $key => $values): {?>
                                 <a href="<?=$values['user_id']?>"><?=$values['user_name']?></a>&nbsp&nbsp
                          <?} endforeach;?></a>回答了你的提问<a href="<?=base_url();?>index.php/index/question/<?=$value['msgid']?>"><?=$value['ques_title'];?></a></div>
                      
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
