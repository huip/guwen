<div id="main" class="span12">
<a name="go_to_top"></a>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <div class="index-ques-list span12">
      <h5 class="modal-header"><i class="icon-list"></i>&nbsp&nbsp话题动态</h5>
       
              <?foreach ($topic_list as $key => $value):{?>
              <div class="ques-list span12">
              <div class="feed-list span11">
                  <a href="<?=base_url();?>index.php/topic/info/<?=$value['id']?>"><img src="<?=$value['tag_img'];?>" class="user-img span1" /></a>
                  <div class="feed-content span11">
                    <p class="feed-content-name"><span><a href="<?=base_url();?>index.php/topic/info/<?=$value['id']?>"><?=$value['tag_name']?></a></span></p>
                    <?foreach ($value['ques'] as $key => $values): {?>
                          <p><a href="<?=base_url();?>index.php/question/index/<?=$values['msgid']?>" class="title-a"><?=$values['ques_title']?></a><p class='sns-time-list'><?=$values['post_time']?></p></p>
                   <? } endforeach;?>
                  </div>
              </div>

             </div>
             <? }endforeach?>
           
          </div>
          <?if($topic_list[0]['num'] > 1){?>
              <div class="span11 btn show-more" page="topic" current-page="1">更多</div>
            <?}?>
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
