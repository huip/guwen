<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <h5 class="modal-header"><i class=" icon-search"></i>&nbsp<span>搜索结果</span></h5>
      <?foreach ($search as $key => $value): {?>
      	<div class="search-list">
      		<p><a href="<?=base_url();?>index.php/question/index/<?=$value['msgid']?>"><?=$value['ques_title']?></a></p>
      		<p class="reply-color"><span>共<?=$value['answer']?>个回答</span><span>&nbsp&nbsp浏览<?=$value['browser']?></span><span class="sns-time-list pull-right"><?=$value['post_time']?></span></p>
      	</div>
      <?}endforeach?>
    </div>
</div>
</div>
</div>