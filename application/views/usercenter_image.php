
<div id="main" class="span14">
<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span12">
  		<ul class="nav nav-tabs">
			<li class="">
			    <a href="<?=base_url();?>index.php/usercenter/profile">基本资料</a>
			</li>
			<li class="active"><a href="<?=base_url();?>index.php/usercenter/image">修改图像</a></li>
			<li class=""><a href="<?=base_url();?>index.php/usercenter/acount">帐号修改</a></li>
		</ul>
		<div class="usercnt-list span12 pull-left">


			<form name="form" id="theuploadforms" >
				<input  id="userfiles" name="userfile" size="50" type="file" />
			</form>

			<div class="jc-demo-box">

			</div>
		</div>
	</div>
	 <!-- <div class="usercnt-list span4 pull-right">
                   <?foreach ($person_info as $value) :{?>
                   <pre>
                        <img src='<?=$value['user_img']?>' />
                        <p><?=$value['user_name']?></p>
                        <p>积分：<?=$value['user_score']?></p>
                         <p><?=$value['user_motto']?></p>
                    </pre>
                   <?}endforeach?>           
             </div> -->
</div>
</div>
</div>
