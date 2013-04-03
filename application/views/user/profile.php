<div id="main" class="span12">
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
                <form class="pull-left form-horizontal">
                  <fieldset>
                    <? foreach ($profile_info as $key => $value):{?>
                          <div class="control-group span12">
                            <label class="control-label" for="nickname">昵称</label>
                            <div class="controls">
                                <input type="text" class="" id="nickname" value="<?=$value['user_name']?>">
                                <span class="help-inline"></span>
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="profile">个人描述</label>
                            <div class="controls">
                              <textarea name="profile"  id="profile" class=""><?=$value['user_motto']?></textarea>
                            </div>
                          </div>
                          <div class="control-group">
                            <div class="controls">
                                <div class="help-blocks"></div>
                                <button type="button" class="btn profile-alter">修改</button>
                            </div>
                          </div>
                    <?}endforeach?>
                  </fieldset>
                </form>
             </div>
  	</div>
  	</div>
</div>
</div>