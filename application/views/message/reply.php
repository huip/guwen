<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      	<ul class="nav nav-tabs">
		<li class="">
		    <a href="<?=base_url()?>index.php/message/index">回答</a>
		</li>
		<li class="active"><a href="<?=base_url()?>index.php/message/reply">回复</a></li>
		<li class=""><a href="<?=base_url()?>index.php/message/favour">赞同</a></li>
		<li class=""><a href="<?=base_url()?>index.php/message/best">最佳回答</a></li>
	</ul>
	<div class="my-answer">
		<div class="my-reply">
			<?foreach ($reply as $key => $value): {?>
				<div>
					<a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>"><?=$value['user_name']?>:</a>
					在问题&nbsp<a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>"><?=$value['ques_title']?></a>
					<p>中回复了你的回答:<?=$value['comment_content']?></p>
					<p><?=$value['time']?>
					<p><a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>">快去看看吧</a></p>
				</div>
			<?};endforeach?>
		</div>
	</div>
  </div>
</div>
</div>
</div>