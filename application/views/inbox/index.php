<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span10">
      <h5 class="modal-header"><i class="icon-envelope"></i>&nbsp<span>我的私信</span><span class="btn pull-right btn-small btn-primary post-inbox">写私信</span></h5>
        <div class="inbox-list span12 pull-left">
        <?foreach ($inbox as $key =>  $value) :{
            ?>
                  <div class="comment-lists span10">
                    <p>
                      <a href="<?=base_url();?>index.php/person/question/<?=$value['my_id']?>" class="pull-left">
                        <? foreach ($value['user_info'] as $key => $values):{?>
                              <span><a href="<?=base_url();?>index.php/person/question/<?=$values['user_id']?>"><?=$values['user_name']?></a>:</span>
                        <?}endforeach?>
                        </a>
                      <?foreach ($value['inbox_info'] as $key => $inbox) :{?>
                          <?= nl2br($inbox['inbox']);?>
                           </p>
                          <p class="span9"><span class=" inbox-time-list sns-time-list"><?=$inbox['time']?></span><span class="pull-right "><a href="<?=base_url();?>index.php/inbox/info/<?=$value['id']?>" class="reply-color">共<?=$inbox['inboxnum']?>条对话</a></span></p>
                        <?}endforeach?>
                 </div>
          <?}endforeach?>
      </div>
    </div>
    </div>
</div>
<div class="to-top">
  <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>