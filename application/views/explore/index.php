<div id="main" class="span12">
  <a name="go_to_top"></a>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <div class="index-ques-list span12">
      <h5 class="modal-header"><i class="icon-list"></i>&nbsp&nbsp最新动态</h5>
      <?php foreach ($list_info as $value): {?>
        <div class="ques-list span12">
        	<div class="feed-list span11">
        		<a href="<?=base_url();?>index.php/usercenter/person_question/<?=$value['user_id']?>"><img src="<?=$value['user_img'];?>" class="user-img span1" /></a>
        		<div class="feed-content span11">
        			<p class="feed-content-name"><span><a href="<?=base_url()?>index.php/usercenter/person_question/<?=$value['user_id']?>"><?=$value['user_name'];?></a></span><span class="sns-time-list pull-right"><?=$value['post_time'];?></span><p>
        			<p><a href="<?=base_url().'index.php/question/index/'.$value['msgid'];?>"><?=$value['ques_title'];?></a></p>
                          <div class='index-content-list'><?=$value['ques_content']?></div>
        			<p class="sns-bar"><span>悬赏:<?=$value['ques_socore'];?></span>&nbsp&nbsp<span>浏览:<?=$value['browser']?></span>&nbsp&nbsp<span>分类:<?=$value['ques_cate']?></span><span class="pull-right"><a href="<?=base_url().'index.php/question/index/'.$value['msgid'];?>" >回答(<span><?=$value['anwser']?></span>)</a></span><p>
                          <div class="display-anwser span12">
                                    
                          </div>
                          <div class="slide-up pull-right">收起</div>
        		</div>

        	</div>
        	
        </div>
        <?php
       }
       endforeach
       ;?>
     </div>
       <div class="span11 btn show-more" page="explore" current-page="1">更多</div>
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
            <div class="">
              <h5>精选问题</h5>
            </div>
            <div class="">
              <h5>问题分类</h5>
            </div>
      </div>
    </div>
  </div>
</div>
<div class="">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>
