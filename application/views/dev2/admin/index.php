<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> 故问后台管理</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/data/stylesheets/lib/bootstrap.min.css"  type="text/css" />
</head>
<body>
<nav class = "nav navbar-default" role = "navigation">
    <div class = "navbar-header">
        <button type = "button" class = "navbar-toggle" data-toggle = "collapse"data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Brand</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-exapmle-navbar-collapse-1">
        <ul class = "nav navbar-nav">
            <li class="active"><a href="#">后台</a></li>
            <li><a href="#">管理</a></li>
        </ul>
    </div>
</nav>
<script src="<?php echo base_url();?>data/javascripts/sea&#45;modules/seajs/seajs/2.1.1/sea.js"></script>
<!-- <script>
seajs.config({
    base: "<?php echo base_url();?>data/javascripts/sea-modules/",
    alias: {
        "$": "jquery/jquery/1.10.1/jquery.js"
    }
});
seajs.use("<?php echo base_url();?>data/javascripts/admin/admin");
</script> -->
</body>
</html>

