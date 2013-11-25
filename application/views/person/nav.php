<?php if( !empty($user_id)){?>
<div id="wrap">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
    	<a class="brand" href="<?=base_url()?>index.php/index">故问</a>
    	<p class="navbar-search pull-left">
  		<input type="text" class="search-query" placeholder="搜索问题...">

	</p>
	<input class="btn pull-left search-btn-poi" type="button" value="搜索" />
	<input class="btn pull-left search-btn-poi create-question" type="button" value="提问" />
    	<ul class="nav nav-poi">
		<li><a href="<?=base_url();?>index.php/index">首页</a></li>
		<li><a href="<?=base_url();?>index.php/topic">分类</a></li>
		<li><a href="<?=base_url();?>index.php/explore">发现</a></li>
		<li>
                    <span class="message-bubble"></span>
                    <a href="<?=base_url();?>index.php/message">消息</a>
              </li>
		<li class="user-center" uid="<?=$user_id?>">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="<?=base_url();?>index.php/user/index">
			 <img class="user-img" height='20' width='20' src="<?=$user_img;?>" alt="user" /><span class="bubble"></span>&nbsp&nbsp<span><?=$user_name;?></span>
                  </a>
			 <ul class=" pull-right user-menu">
				<a href="<?=base_url();?>index.php/user/index"><li><i class="icon-user"></i><span>个人主页</span></li></a>
				<a href="<?=base_url();?>index.php/inbox"><li><i class="icon-envelope"></i><span>私信</span><span class="bubble"></span></li></a>
				<a href="<?=base_url();?>index.php/user/profile"><li><i class="icon-cog"></i><span>设置</span></li></a>
				<a href="<?=base_url();?>index.php/ajax/login_off" class="login_off"><li><i class="icon-off"></i><span>退出</span></li></a>
	    		</ul>
	    	</li>
      </ul>
    </div>
  </div>
</div>
<div class="modal create-question-modal" id="myModal">
  <form name="form" id="theuploadform" >
  <div class="modal-header ">
    <a class="close" data-dismiss="modal">×</a>
    <h4>提问</h4>
  </div>
  <div class="modal-body">
    <p>问题标题</p>
    <input type="text" class="question-title" value="" />
    <p>问题内容</p>
    <textarea class="question-content"></textarea>
    <!-- <p>添加图片</p> -->
    <!-- <input id="userfile" name="userfile" size="50" type="file" />
    <input class="upload-img" type="hidden" /> -->
    <p>问题分类
      <select class="question-cate">
        <?foreach ($tag_list as $key => $value) :{?>
            <option  value="<?=$value['id']?>"><?=$value['tag_name']?></option>
        <?}endforeach?>
    </select>
    <span class="btn create">创建</span>
      <span class="create-cate pull-right"><input type="text" value=""  name="cate" /><span class="btn">创建</span></span>
  </p>
    <!-- <ul class="question-cate">
      <li><input type="radio" class="cate" name="cate" value="1">&nbsp&nbsp<span>学习</span></li>
      <li><input type="radio" class="cate" name="cate" value="2">&nbsp&nbsp<span>生活</span></li>
    </ul> -->
    <div class="question-confirm">
      <p class="pull-left">悬赏积分<input type="text" value="0" class="question-socore"/></p>
      <!-- <p class="pull-right question-anoy-full"><input type="checkbox" class="question-anoy">&nbsp&nbsp匿名发布</p> -->
    </div>
   
  </div>
   <div class="ques-error-tip"></div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <a href="#" class="btn btn-primary " data-dismiss ="" id="formsubmit" >提交</a>
  </div>
</form>
</div>

<div class="modal create-question-modal" id="inbox">
    <div class="modal-header ">
        <a class="close" data-dismiss="modal">×</a>
        <h4>发送私信</h4>
      </div>
      <div class="modal-body">
        <p>发送给</p>
        <input type="text" class="inbox-to question-title" value="" />
        <p> 私信内容</p>
        <textarea class="inbox-content question-content"></textarea>
      </div>
      <div class="modal-footer">
          <a href="#" class="btn" data-dismiss="modal">关闭</a>
          <a href="#" class="btn btn-primary add-inbox " data-dismiss ="" >提交</a>
      </div>
    </div>
    
</div>
<?php
} else {
?>
<div id="wrap">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?=base_url()?>index.php/index">故问</a>
      <form class="navbar-search pull-left">
      <input type="text" class="search-query" placeholder="搜索问题...">

  </form>
  <input class="btn pull-left search-btn-poi search-btn" type="button" value="搜索" />
  <input class="btn pull-left search-btn-poi no-login-ques" type="button" value="提问" />
      <ul class="nav nav-poi">
          <li><a href="<?=base_url();?>index.php/index">首页</a></li>
          <li><a href="<?=base_url();?>index.php/topic">分类</a></li>
          <li><a href="<?=base_url();?>index.php/explore">发现</a></li>
          <li class="user-center" uid="">
              <input class="btn login-btn-trans" type="button"  value="登陆" />
              <input class="btn register-btn-trans" type="button" value="注册" />
          </li>
       </ul>
    </div>
  </div>
</div>
<div class="modal create-question-modal" id="erro_tip">
    <div class="modal-header ">
        <a class="close" data-dismiss="modal">×</a>
        <h4>信息</h4>
      </div>
      <div class="modal-body ero-msg-body">
        <p></p>
      </div>
      <div class="modal-footer">
          <a href="#" class="btn" data-dismiss="modal">关闭</a>
          <a href="#" class="btn btn-primary erro-confirm " data-dismiss ="" >确定</a>
      </div>
    </div>
<?php
}
?>