<?php if( !empty($user_id)){?>
<div id="wrap">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="#">故问</a>
      <form class="navbar-search pull-left">
      <input type="text" class="search-query" placeholder="搜索问题...">
  </form>
  <input class="btn pull-left search-btn-poi" type="button" value="搜索" />
  <input class="btn pull-left search-btn-poi create-question" type="button" value="提问" />
      <ul class="nav nav-poi">
    <li class="active">
    <a href="<?=base_url();?>index.php/index">首页</a>
    </li>
    <li><a href="<?=base_url();?>index.php/topic">话题</a></li>
    <li><a href="#">发现</a></li>
    <li><a href="#">消息</a></li>
    <li class="user-center" uid="<?=$user_id?>">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="＃">
      <img class="user-img" height='20' width='20' src="<?=$user_img;?>" alt="user" />&nbsp&nbsp<span><?=$user_name;?></span></a>
       <ul class=" pull-right user-menu">
        <a href="<?=base_url();?>index.php/usercenter/index"><li><i class="icon-user"></i><span>个人主页</span></li></a>
        <a href=""><li><i class="icon-envelope"></i><span>私信</span></li></a>
        <a href="<?=base_url();?>index.php/usercenter/profile"><li><i class="icon-cog"></i><span>设置</span></li></a>
        <a href="<?=base_url();?>index.php/user/login_off" class="login_off"><li><i class="icon-off"></i><span>退出</span></li></a>
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
        <?foreach ($tag_list as $key => $value):{?>
          <option  value="<?=$value['id']?>"><?=$value['tag_name']?></option>
          <?} endforeach?>
    </select>
  </p>
    <!-- <ul class="question-cate">
      <li><input type="radio" class="cate" name="cate" value="1">&nbsp&nbsp<span>学习</span></li>
      <li><input type="radio" class="cate" name="cate" value="2">&nbsp&nbsp<span>生活</span></li>
    </ul> -->
    <div class="question-confirm">
      <p class="pull-left">悬赏积分<input type="text"  class="question-socore"/></p>
      <!-- <p class="pull-right question-anoy-full"><input type="checkbox" class="question-anoy">&nbsp&nbsp匿名发布</p> -->
    </div>
    
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">关闭</a>
    <a href="#" class="btn btn-primary " data-dismiss ="" id="formsubmit" >提交</a>
  </div>
</div>
</form>
<?php
} else {
?>
<div id="wrap">
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="#">故问</a>
      <form class="navbar-search pull-left">
      <input type="text" class="search-query" placeholder="搜索问题...">

  </form>
  <input class="btn pull-left search-btn-poi" type="button" value="搜索" />
  <input class="btn pull-left search-btn-poi no-login-ques" type="button" value="提问" />
      <ul class="nav nav-poi">
          <li class="active">
            <a href="<?=base_url();?>index.php/index">首页</a>
          </li>
          <li><a href="<?=base_url();?>index.php/topic">话题</a></li>
          <li><a href="#">发现</a></li>
          <li><a href="#">消息</a></li>
          <li class="user-center">
              <input class="btn login-btn-trans" type="button"  value="登陆" />
              <input class="btn register-btn-trans" type="button" value="注册" />
          </li>
       </ul>
    </div>
  </div>
</div>
<?php
}
?>

<div id="main" class="span14">
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span9">
      <h5 class="modal-header"><i class="icon-list"></i>&nbsp&nbsp最新动态</h5>
      <?php foreach ($list_info as $value): {?>
        <div class="ques-list span12">
        	<div class="feed-list span11">
        		<a href="<?=base_url();?>index.php/usercenter/person_question/<?=$value['user_id']?>"><img src="<?=$value['user_img'];?>" class="user-img span1" /></a>
        		<div class="feed-content span11">
        			<p class="feed-content-name"><span><a href="<?=base_url()?>index.php/usercenter/person_question/<?=$value['user_id']?>"><?=$value['user_name'];?></a></span><span class="sns-time-list pull-right"><?=$value['post_time'];?></span><p>
        			<p><a href="<?=base_url().'index.php/index/question/'.$value['msgid'];?>"><?=$value['ques_title'];?></a></p>
                          <div class='index-content-list'><?=$value['ques_content']?></div>
        			<p class="sns-bar"><span>悬赏:<?=$value['ques_socore'];?></span>&nbsp&nbsp<span>浏览:<?=$value['browser']?></span>&nbsp&nbsp<span>分类:<?=$value['ques_cate']?></span><span class="pull-right"><a class="get-index-anwser" qid ="<?=$value['msgid']?>">回答(<span><?=$value['anwser']?></span>)</a></span><p>
                          <div class="display-anwser span12">
                                    
                          </div>
                          <div class="slide-up pull-right">收起</div>
        		</div>

        	</div>
        	
        </div>
        <?php
       }
       endforeach
       ;?>
      </div>
    <div class="span3">
    	<div class="right-bar">
            <div class="">
               <h5>故问公告</h5>
               <div>
                 <p> 今天是第5周，星期六</p>
                  <p>周末! 去哪里玩儿呢？</p>
               </div>
            </div>
            <div class="">
              <h5>精选问题</h5>
            </div>
            <div class="">
              <h5>问题分类</h5>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
