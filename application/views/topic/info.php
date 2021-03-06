<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <div class="index-ques-list">
      <h5 class="modal-header"><?foreach ($topic_info as $key => $value): {?>
        <i class="icon-th-list" /></i>&nbsp&nbsp<span class="tag-id" tid = "<?=$value['id']?>"><?=$value['tag_name']?></span>
        <?}endforeach?>
      </h5>
      <?php foreach ($mess_info as $value): {?>
        <div class="ques-list span12">
          <div class="feed-list span11">
            <a href="<?=base_url();?>index.php/person/question/<?=$value['user_id']?>">
            <img src="<?=$value['user_img'];?>" alt="user_logo" class="user-img span1" /></a>
            <div class="feed-content span11">
              <p class="feed-content-name"><span><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>">
                <?=$value['user_name'];?></a></span><span class="sns-time-list pull-right"><?=$value['post_time'];?></span><p>
              <p><a href="<?=base_url().'index.php/question/index/'.$value['msgid'];?>" class="title-a"><?=$value['ques_title'];?></a></p>
              <!-- <div class='index-content-list'><?=$value['ques_content']?></div> -->
              <p class="sns-bar reply-color"><span>悬赏:<?=$value['ques_socore'];?></span>&nbsp&nbsp<span>浏览:<?=$value['browser']?>
              </span>&nbsp&nbsp<span>分类:<?=$value['ques_cate']?></span><span class="pull-right"><a  href="<?=base_url();?>index.php/question/index/<?=$value['msgid']?>" class="reply-color">回答(<span><?=$value['anwser']?></span>)</a></span><p>
            </div>
          </div>
        </div>
        <?php
       }
       endforeach
       ;?>
     </div>
     <?
        if(count($mess_info) > 0){
        if($mess_info[0]['num'] > 1){?>
       <div class="span11 btn show-more" page="info" current-page="1">更多</div>
       <?}
     }?>
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
                              <span class="pull-left"><a href="<?=base_url()?>index.php/topic/info/<?=$value['id']?>"><img height="40" width="40" alt="tag_logo" src="<?=$value['tag_img']?>" /></a></span>
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
                              <span class="pull-left"><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>"><img height="40" width="40" alt="user_logo" src="<?=$value['user_img']?>" /></a></span>
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
</div>
<div class="">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>

