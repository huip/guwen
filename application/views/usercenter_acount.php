<div id="main" class="span14">
<div class="container-fluid">
  <div class="row-fluid">
  	<div class="span12">
  		<ul class="nav nav-tabs">
			<li class="">
			    <a href="<?=base_url();?>index.php/usercenter/profile">基本资料</a>
			</li>
			<li><a href="<?=base_url();?>index.php/usercenter/image">修改图像</a></li>
			<li class="active"><a href="<?=base_url();?>index.php/usercenter/acount">帐号修改</a></li>
		</ul>
		<div class="usercnt-list span7 pull-left">
               <p class="success-callback"></p>
                <form class="pull-left">
                  <fieldset>
                          <div class="control-group">
                            <label class="control-label" for="email">邮箱</label>
                            <div class="controls">
                              <?foreach ($acount_info as $value): {?>
                              <input type="text" class="input-xlarge" id="email" value="<?=$value['user_email']?>">
                              <p class="help-blocks"></p>
                              <?} endforeach?>
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label" for="oldpassword">旧密码</label>
                            <div class="controls">
                              <input name="oldpassword" type="password"  id="oldpassword" class="input-xlarge" />
                              <p class="help-blocks"></p>
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label" for="newpassword">新密码</label>
                            <div class="controls">
                              <input name="newpassword" type="password"  id="newpassword" class="input-xlarge" />
                              <p class="help-blocks"></p>
                            </div>
                          </div>

                          <div class="control-group">
                            <label class="control-label" for="confirmpassword">确认密码</label>
                            <div class="controls">
                              <input name="newpassword"  type="password" id="confirmpassword" class="input-xlarge" />
                              <p class="help-blocks"></p>
                            </div>
                          </div>


                    <input type="button" class="btn pull-right acount-alter" value="修改">
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