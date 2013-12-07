<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>故问</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="学生地带，明知故问，中南民族大学，学生门户网站，学生资讯集团，比特工场，故问，学生工作通讯"/>
<meta  name="description" content="故问是由中南民族大学比特工场开发，以提升大学生活品质为核心定位的学生问答知识社区" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/lib/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/style.css" type="text/css" />
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
        <li><a href="#">分类</a></li>
        <li><a href="#">发现</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">登录</a></li>
        <li><a href="#">注册</a></li>
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
<script type="text/template" id="widgets_template">
  <div class="hot-ques">
    <p>热门问题</p>
    <%_.each(data.hot_ques,function(ques) {%>
    <li><a href="#q/<%=ques.msgid%>"><%=ques.ques_title%></a></li>
    <%})%>
  </div>
  <div class="hot-cate">
    <p>热门分类</p>
    <%_.each(data.hot_cate,function(cate) {%>
    <li><img src="<%=cate.tag_img%>" class="img-responsive img-rounded"><a href="<%=cate.id%>"><%=cate.tag_name%></a></li>
    <%})%>
  </div>
  <div class="hot-person">
    <p>热门分类</p>
    <%_.each(data.hot_person,function(person) {%>
      <li><img src="<%=person.user_img%>" alt="<%=person.user_name%>" class="img-rounded img-responsive" /><a href="<%=person.user_id%>"><%=person.user_name%></a></li>
    <%})%>
  </div>
</script>
<script type="text/template" id="question_template">
    <%_.each(data,function(question) {%>
      <li><a href="#q/<%=question.msgid%>"><%=question.ques_title%></a></li>
    <%})%>
</script>
<script type="text/template" id="qinfo_template">
    <%_.each(data.info,function(info) {%>
      <h2><%=info.ques_title%></h2>
      <p><%=info.ques_content%></p>
      <p><a href="#u/<%=info.user_id%>"><%=info.user_name%></a></p>
      <p><%=info.ques_score%></p>
      <p><%=info.post_time%></p>
    <%})%>
    <%_.each(data.comments,function(comment) {%>
      <p><a href="#u/<%=comment.user_id%>"><%=comment.user_name%></a></p>
      <p><%=comment.comment_content%></p>
      <p><%=comment.comment_time%></p>
      <%_.each(comment.reply,function(reply) {%>
        <div style="text-indent:40px">
          <p><a href="#u/<%=reply.user_id%>"><%=reply.user_name%></a></p>
          <p><%=reply.reply_content%></p>
          <p><%=reply.time%></p>
        </div>
      <%})%>
      <hr />
    <%})%>
</script>
<script type="text/template" id="relative_template">
    <%_.each(data,function(info) {%>
      <li><a href="#q/<%=info[0].msgid%>"><%=info[0].ques_title%></a></li>
    <%})%>
</script>
<script type="text/template" id="uinfo_template">
  <p><%=data[0].user_name%></p>
  <p><%=data[0].user_motto%></p>
  <img src="<%=data[0].user_img%>" alt="<%=data[0].user_name%>" />
  <p><%=data[0].user_score%></p>
  <p><%=data[0].rank%></p>
  <p><%=data[0].gap%></p>
</script>
</html>
