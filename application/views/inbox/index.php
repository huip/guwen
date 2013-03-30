<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <h5 class="modal-header"><i class="icon-envelope"></i>&nbsp<span>我的私信</span><span class="btn pull-right btn-small btn-primary post-inbox">写私信</span></h5>
    <?foreach ($inbox as $key =>  $value) :{
        ?>
      <div class="inbox-list span9 pull-left">
          <div class="">
              <div class="">
                <p>
                  <a href="<?=base_url();?>index.php/person/question/<?=$value['my_id']?>" class="pull-left">
                    <? foreach ($value['user_info'] as $key => $values):{?>
                          <span><a href="<?=base_url();?>index.php/person/question/<?=$values['user_id']?>"><?=$values['user_name']?></a>:</span>
                    <?}endforeach?>
                    </a>
                  <?foreach ($value['inbox_info'] as $key => $inbox) :{?>
                      <?=$inbox['inbox'];?>
                       </p>
                      <p class="span9"><span class="sns-time-list"><?=$inbox['time']?></span><span class="pull-right"><span><a href="<?=base_url();?>index.php/inbox/info/<?=$value['id']?>">共<?=$inbox['inboxnum']?>对话</a></span></p>
                    <?}endforeach?>
                </div>

          </div>
      </div>
      <?}endforeach?>
    </div>
    <div class="usercnt-list span3 pull-right">
   </div>
    </div>
</div>
</div>
</div>