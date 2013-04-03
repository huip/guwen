<div id="main" class="span12">
<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span12">
  		<ul class="nav nav-tabs">
			<li><a href="<?=base_url();?>index.php/user/profile">基本资料</a></li>
			<li><a href="<?=base_url();?>index.php/user/image">修改图像</a></li>
			<li class="active"><a href="<?=base_url();?>index.php/user/acount">帐号修改</a></li>
		</ul>

		<div class="usercnt-list span7 pull-left">
                <form class="pull-left form-horizontal">
                  <fieldset>

                          <div class="control-group">
                            <label class="control-label" for="email">邮箱</label>
                            <div class="controls">
                              <?foreach ($acount_info as $value): {?>
                              <input type="text"  id="email" value="<?=$value['user_email']?>">
                              <?} endforeach?>
                              <span class="help-inline"></span>
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label" for="oldpassword">旧密码</label>
                            <div class="controls">
                              <input name="oldpassword" type="password"  id="oldpassword" class="" />
                              <span class="help-inline"></span>
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label" for="newpassword">新密码</label>
                            <div class="controls">
                              <input name="newpassword" type="password"  id="newpassword" class="" />
                              <span class="help-inline"></span>
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label" for="confirmpassword">确认密码</label>
                            <div class="controls">
                              <input name="newpassword"  type="password" id="confirmpassword" class="" />
                              <span class="help-inline"></span>
                            </div>
                          </div>
                          <div class="control-group">
                            <div class="controls">
                                <div class=" help-blocks"></div>
                                <button type="button" class="btn acount-alter">修改</button>
                            </div>
                          </div>
                  </fieldset>
                  
                </form>
             </div>
  	</div>
    </div>
</div>
</div>