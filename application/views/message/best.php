<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      	<ul class="nav nav-tabs">
		<li class="">
		    <a href="<?=base_url()?>index.php/message/index">回答</a>
		</li>
		<li class=""><a href="<?=base_url()?>index.php/message/reply">回复</a></li>
		<li class=""><a href="<?=base_url()?>index.php/message/favour">赞同</a></li>
		<li class="active"><a href="<?=base_url()?>index.php/message/best">最佳回答</a></li>
	</ul>
	<div class="my-favour">
		<?foreach ($best as $key => $value): {?>
			<p><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>"><?=$value['user_name']?></a>：在问题<a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>"><?=$value['ques_title']?></a></p>
			<p>中把你的回答:<?=$value['comment_content']?>设为最佳答案</p>
			<p><?=$value["time"]?></p>
			<p><a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>">快去看看吧</a></p>
		<?}endforeach?>
	</div>
  </div>
</div>
</div>
</div>