<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>故问</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="学生地带，明知故问，中南民族大学，学生门户网站，学生资讯集团，比特工场，故问，学生工作通讯"/>
<meta  name="description" content="故问是由中南民族大学比特工场开发，以提升大学生活品质为核心定位的学生问答知识社区" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/lib/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/huip.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/aresyz.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/tibic.css" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body>
  <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header collapse navbar-collapse">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">故问</a>
    </div>
    <!-- navigation form start -->
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">搜索</button>
      <button type="submit" class="btn btn-default">提问</button>
    </form>
    <!-- navigation start -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">首页</a></li>
        <li><a href="#topic">分类</a></li>
        <li><a href="#unanswerd">未回答</a></li>
        <li><a href="#hotest">热门</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#login">登录</a></li>
        <li><a href="#register">注册</a></li>
      </ul>
    </div><!-- end -->
  </nav> 
  <div id="content" class="col-md-12">
    <div class="col-md-1">
    </div>
    <div class="left-content col-md-7">
    </div>
    <div class="right-content col-md-3">
    </div>
    <div class="col-md-1">
    </div>
  </div>
  <div id="footer" class="navbar navbar-fixed-bottom">
    <hr />
    <div class="bit-link pull-left">
      <a href="http://www.bitworkshop.net/" target = "_blank">比特工场</a>
      <a href="http://www.stuzone.com/" target = "_blank">学生地带</a>
      <a href="http://market.stuzone.com/" target = "_blank">学生市场</a>
      <a href="http://upan.us/" target = "_blank">云优盘</a>
    </div>
    <div class="guwen-help pull-right">
      <a href="<?=base_url()?>index.php/index/help" target = "_blank">故问指南</a>
      <span>|</span>
      <a href="<?=base_url()?>index.php/question/index/274" target = "_blank">意见反馈</a>
      <span>|</span>
      <span>&copy<a href="http://www.huip.org/" target = "_blank">huip</a></span>
    </div>
  </div>
</body>
<script src="<?php echo base_url();?>data/javascripts/sea-modules/seajs/seajs/2.1.1/sea.js"></script>
<script>
  // Set configuration
  seajs.config({
    base: "<?php echo base_url();?>data/javascripts/sea-modules/",
    alias: {
      "$": "jquery/jquery/1.10.1/jquery.js",
      "underscore": "gallery/underscore/1.4.4/underscore.js",
      "backbone": "gallery/backbone/1.0.0/backbone.js"
    }
 });

  if (location.href.indexOf("?dev") > 0) {
   }
  // For production
  else {
    seajs.use("<?php echo base_url();?>data/javascripts/main");
  }
</script>

