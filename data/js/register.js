(function() {
	var user_name,user_email,user_password;
	$(".register-btn").click(function() {
		user_name = $(".user-name").val();
		user_email = $(".user-email").val();
		user_password = $(".user-password").val();
		register(get_root_path()+"/wen/index.php/ajax/register",user_name,user_email,user_password);
	});

	function register(url,username,useremail,userpassword) {
		$.post(url,
			{username:username,useremail:useremail,userpassword:userpassword},
			function(result){
				if(result == 1) {
					alert("user is already exist!");
				} else {
					alert("register success");
				}
			}
		);
	}
	function get_root_path() {  
		var root = location.protocol + '//' + location.host;
		return root;
	}
})();