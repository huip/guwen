$(document).ready(function(){
	var user_name,user_password;
	$(".login-btn").click(function() {
		user_email = $(".user-email").val();
		user_password = $(".user-password").val();
		login(get_root_path()+"/wen/index.php/ajax/login",user_email,user_password);

	});

	function login(url,useremail,userpassword) {

		$.post(url,
			{useremail:useremail,userpassword:userpassword},
			function(result){

				if(result == 1){

					window.location.href = get_root_path()+"/wen/index.php/index/index";

				} else {

					alert("fail");
				}
			}
		);
	}
});

