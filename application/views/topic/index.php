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
                  <a href="<?=base_url();?>index.php/topic/info/<?=$value['id']?>" target="_blank"><img src="<?=$value['tag_img'];?>" target="_blank"s class="user-img span1" /></a>
                  <div class="feed-content span11">
                    <p class="feed-content-name"><span><a href="<?=base_url();?>index.php/topic/info/<?=$value['id']?>" target="_blank"><?=$value['tag_name']?></a></span></p>
                    <?foreach ($value['ques'] as $key => $values): {?>
                          <p><a href="<?=base_url();?>index.php/question/index/<?=$values['msgid']?>" target = "_blank" class="title-a"><?=$values['ques_title']?></a><p class='sns-time-list'><?=$values['post_time']?></p></p>
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
              <div class="tips">
                 <h5>故问公告</h5>
                 <div>
                   <p> 欢迎使用故问！</p>
                 </div>
              </div>
              <div class="hot-ques">
                <h5>热门问题</h5>
                <?foreach ($hot_ques as $key => $value): {?>
                  <div class="hot-ques-list">
                      <p><a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>" target="_blank"><?=$value['ques_title']?></a></p>
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
                              <span class="pull-left"><a href="<?=base_url()?>index.php/topic/info/<?=$value['id']?>" target="_blank"><img height="40" width="40" src="<?=$value['tag_img']?>" /></a></span>
                              <p>
                                  <a href="<?=base_url()?>index.php/topic/info/<?=$value['id']?>"  target="_blank" class="hot-ques-title"><?=$value['tag_name']?></a>
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
                              <span class="pull-left"><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>" target="_blank"><img height="40" width="40" src="<?=$value['user_img']?>" /></a></span>
                              <p>
                                  <a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>" class="hot-ques-title" target="_blank"><?=$value['user_name']?></a>
                                  <p class="hot-ques-num"><?=$value['rank']?></p>
                              </p>
                          </p>
                      </div>
                  <?}endforeach?>
              </div>
        </div>
      </div>
</div>
<div class="">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>
</div>
