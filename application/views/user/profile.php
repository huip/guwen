<div id="main" class="span14">
<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span12">
  		<ul class="nav nav-tabs">
			<li class="active">
			    <a href="<?=base_url();?>index.php/user/profile">基本资料</a>
			</li>
			<li><a href="<?=base_url();?>index.php/user/image">修改图像</a></li>
			<li class=""><a href="<?=base_url();?>index.php/user/acount">帐号修改</a></li>
		</ul>
              <div class="usercnt-list span7 pull-left">
                <p class="help-blocks"></p>
                <form class="pull-left">
                  <fieldset>
                    <? foreach ($profile_info as $key => $value):{?>
                          <div class="control-group">
                            <label class="control-label" for="nickname">昵称</label>
                            <div class="controls">
                              <input type="text" class="input-xlarge" id="nickname" value="<?=$value['user_name']?>">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="profile">个人描述</label>
                            <div class="controls">
                              <textarea name="profile"  id="profile" class="input-xlarge"><?=$value['user_motto']?></textarea>
                            </div>
                          </div>
                    <?}endforeach?>

                    <input type="button" class="btn pull-right profile-alter" value="修改">
                  </fieldset>
                </form>
             </div>
              <div class="usercnt-list span4 pull-right">
                   <?foreach ($person_info as $value) :{?>
                   <pre>
                        <img src='<?=$value['user_img']?>' />
                        <p><?=$value['user_name']?></p>
                        <p>积分：<?=$value['user_score']?></p>
                         <p><?=$value['user_motto']?></p>
                    </pre>
                   <?}endforeach?>           
             </div>
  	</div>
  	</div>
</div>
</div>