<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span10">
      <h5 class="modal-header"><i class="icon-envelope"></i>&nbsp<span>私信纪录</span></h5>
      <div class="inbox-info-list span12">
     	<?foreach ($info as $key => $value): {?>        
            <?foreach ($value as $key => $infos):{?>
                    <div class="span10 comment-list-info" page-id="<?=$infos['page_id']?>">
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
              
            <?}endforeach?>
     	<?}endforeach?>
     </div>
     <?
          if( count($info) > 0 ) {
            if( $info['user_info'][0]['num'] > 1) { ?>
          <div class="span11 btn inbox-show-more" page="inbox-info"  current-page="1">更多</div>
        <?}
      }?>
</div>
</div>
</div>
<div class="">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>
