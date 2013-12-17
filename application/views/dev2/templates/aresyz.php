<script type="text/template" id="login_template">
<div id="main" class="col-md-12">
<div class="container-fluid">
<div class="row-fluid">
  <div class="col-md-10">
  <div class="login">
    <form class="form-horizontal" action="" id="login_form">
      <div class="form-group">
          <label for="inputEmail3" class="col-sm-4 control-label">邮箱</label>
          <div class="col-sm-5">
            <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="邮箱">
          </div>
          <span class="col-sm-3" name="email_status"></span>
      </div>
      <div class="form-group">
          <label for="inputPassword3" class="col-sm-4 control-label">密码</label>
          <div class="col-sm-5">
              <input type="password" class="form-control" name="pwd" id="inputPassword3" placeholder="密码">
          </div>
        <span class="col-sm-3" name="pwd_status"></span>
      </div>
      <div class="form-group col-md-12">
        <div class="controls col-md-3 col-md-offset-4">
          <div class="error-tip"></div>
          <button type="button" id="login-btn" class="btn login-btn btn-primary">登录</button>
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</div>
</div>
</script>
