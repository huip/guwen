<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>故问</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="学生地带，明知故问，中南民族大学，学生门户网站，学生资讯集团，比特工场，故问，学生工作通讯"/>
<meta  name="description" content="故问是由中南民族大学比特工场开发，以提升大学生活品质为核心定位的学生问答知识社区" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>data/stylesheets/style.css" type="text/css" />
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body>
  
</body>
<script type="text/javascript" src="<?php echo base_url();?>data/javascripts/sea.js"></script>
<script>
  // For development
  if (location.href.indexOf("?dev") > 0) {
    seajs.use("<?php echo base_url();?>data/javascripts/jquery-min");
    seajs.use("<?php echo base_url();?>data/javascripts/underscore-min");
    seajs.use("<?php echo base_url();?>data/javascripts/backbone-min");
    seajs.use("<?php echo base_url();?>data/javascripts/bootstrap-min");
    seajs.use("<?php echo base_url();?>data/javascripts/main");
  }
  // For production
  else {
    seajs.use("<?php echo base_url();?>data/javascripts/jquery-min");
    seajs.use("<?php echo base_url();?>data/javascripts/underscore-min");
    seajs.use("<?php echo base_url();?>data/javascripts/backbone-min");
    seajs.use("<?php echo base_url();?>data/javascripts/bootstrap-min");
    seajs.use("<?php echo base_url();?>data/javascripts/main");
  }
</script>
</html>
