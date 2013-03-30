<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span10">
      <h5 class="modal-header"><i class="icon-envelope"></i>&nbsp<span>私信纪录</span></h5>
     	<?foreach ($info as $key => $value): {?>
                            
                            <?foreach ($value as $key => $infos):{?>
                                <div class="span10">
                                    <div class="span10">
                                        <p>
                                            <a href="<?=base_url()?>index.php/person/question/<?=$infos['my_id']?>" class="pull-left inbox-to-name">
                                                <?=$infos['name']?>
                                            </a>:<?=$infos['inbox']?>
                                        </p>
                                        <span class="sns-time-list"><?=$infos['time']?></span>
                                        <span class="pull-right">
                                            <input type="button" class="btn post-inbox btn-small" value="回复" />
                                      </span>
                                    </div>
                                </div>
                            <?}endforeach?>
     	<?}endforeach?>
</div>
</div>
</div>
</div>
