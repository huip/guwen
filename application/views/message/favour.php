<a name="go_to_top"></a>
<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      	<ul class="nav nav-tabs">
		<li class="">
		    <a href="<?=base_url()?>index.php/message/index">回答</a>
		</li>
		<li class=""><a href="<?=base_url()?>index.php/message/reply">回复</a></li>
		<li class="active"><a href="<?=base_url()?>index.php/message/favour">赞同</a></li>
		<li class=""><a href="<?=base_url()?>index.php/message/best">最佳回答</a></li>
	</ul>
	<div class="my-favour">
		<div class="my-reply">
			<?foreach ($favour as $key => $value): {?>
				<div class="comment-list-info span12">
					<p><a href="<?=base_url()?>index.php/person/question/<?=$value['user_id']?>"><?=$value['user_name']?></a>：在问题<a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>"><?=$value['ques_title']?></a></p>
					<p>中赞了你的回答:<?=$value['comment_content']?></p>
					<p><?=$value["favour_time"]?></p>
					<p><a href="<?=base_url()?>index.php/question/index/<?=$value['msgid']?>">快去看看吧</a></p>
				</div>
			<?}endforeach?>
		</div>
		<?if(count($favour) > 0){
			if( $favour[0]['num'] > 1){
		?>
		<div class="span12 btn message-show-more" page="favour" current-page="1">更多</div> 
		<?}}?>
	</div>
  </div>
</div>
</div>
<div class="">
 <a href="#go_to_top"><span class="to-top btn"><i class="icon-arrow-up" ></i></span></a>
</div>
</div>