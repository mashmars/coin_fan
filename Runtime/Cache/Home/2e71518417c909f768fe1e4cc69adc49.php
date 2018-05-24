<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>找回密码</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		修改资料
	</h3>
</header>
		<div class="main retrievePassword">
			<form action="">
				<ul>
					<li>
						<input type="text"placeholder="请输入手机号" id="phone">
					</li>
					<li>
						<input type="text"placeholder="验证码" id="sms">
						<span id="code">获取验证码</span>
					</li>
					<li>
						<input type="password"placeholder="新密码" id="newpassword">
					</li>
					<li>
						<input type="password"placeholder="确认新密码" id="newpassword2">
						<!--<i class="hided"></i>-->
					</li>
				</ul>
				<p class="tc"><button class="lhbg mod-btn" id="find_password">完成</button></p>
			</form>
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script src="<?php echo (PUB_JS); ?>global.js"></script>
	<script>
		var wait=60;//60s验证码
		var t;
		function time(o) {
			if (wait == 0) {
				o.removeAttribute("class", "");   
				o.innerText="获取验证码";
				wait = 60;
				} else {
					o.setAttribute("class", "disabled");
					o.innerText="重新发送(" + wait + "s)";
					wait--;
					t=setTimeout(function() {
						time(o)
					},
					1000)
			}
		}
		
	</script>
		
<script>
$(function(){
	$('#code').click(function(){
		var phone = $('#phone').val();
		if(phone == ''){
			layer.msg('手机号不能为空',{time:2000,icon:5});
			return false;
		}
		time(this);
		var obj = $(this);
		$.post("<?php echo U('login/ajax_send_sms_find');?>",{phone:phone},function(data){
			if(data.info == 'success'){				
				layer.msg(data.msg,{time:2000,icon:1})
			}else{			
				clearTimeout(t);
				obj.text('获取验证码');
				obj.removeClass('disabled');	
				layer.msg(data.msg,{time:2000,icon:5});
							
			}
		},'json')
		
	})
	
	$('#find_password').click(function(){
		var obj = $(this);
		obj.prop('disabled',true);
		var phone = $('#phone').val();
		var sms = $('#sms').val();
		var newpassword = $('#newpassword').val();
		var newpassword2 = $('#newpassword2').val();
		
		
		if(phone == ''){
			layer.msg('手机号不能为空',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		if(sms == ''){
			layer.msg('手机验证码不能为空',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		if(newpassword == '' || newpassword2 == ''){
			layer.msg('新密码和确认密码不能为空',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		if(newpassword != newpassword2){
			layer.msg('新密码和确认密码不一致',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		
		$.post("<?php echo U('login/ajax_find_password');?>",{phone:phone,sms:sms,newpassword:newpassword,newpassword2:newpassword2},function(data){
			if(data.info == 'success'){
				layer.msg(data.msg,{time:2000,icon:1},function(){
					var url = "<?php echo U('login/password');?>";
					location.href = url;
				})
			}else{
				layer.msg(data.msg,{time:2000,icon:5});
				obj.prop('disabled',false);
			}
		},'json')
	})
})
</script>
</html>