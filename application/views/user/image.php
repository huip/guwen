<div id="main" class="span12">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<ul class="nav nav-tabs">
					<li><a href="<?=base_url();?>index.php/user/profile">基本资料</a></li>
					<li class="active"><a href="<?=base_url();?>index.php/user/image">修改图像</a></li>
					<li class=""><a href="<?=base_url();?>index.php/user/acount">帐号修改</a></li>
				</ul>
				<div class="usercnt-list span12 pull-left">
					<form name="form" id="theuploadforms"  class="form-horizontal">
						<span>请选择上传图片，文件不得大于300k</span>
						<input  id="userfiles" name="userfile" size="50" type="file" />
						<div class="jc-demo-box">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
