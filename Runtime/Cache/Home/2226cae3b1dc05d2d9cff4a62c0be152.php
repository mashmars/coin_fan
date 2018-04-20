<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>手机登录</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<div class="main login">
			<h3 class="tc">登录</h3>
			<p class="tc loglo">
				<img src="<?php echo (PUB_IMG); ?>log.png" alt="">
			</p>
			
				<ul>
					<li>
						<input type="text"placeholder="手机号" id="phone">
					</li>
					<li>
						<input type="text"placeholder="验证码" id="sms">
						<span class="flex-1 code">获取验证码</span>
					</li>
				</ul>
				<p class="agreement"id="agree">
					<i class="active"></i>
					<span>注册表示您已阅读并同意</span>
					<a href="#">《矿产链用户注册协议》</a>
				</p>
				<p class="tc"><button class="lhbh mod-btn" id='login_phone'>登录</button></p>
			
			<p class="ovh lolink">
				<a href="<?php echo U('login/password');?>" class="fl">使用密码登录</a>
				<a href="<?php echo U('login/register');?>" class="fr">注册新账号</a>
			</p>
			
		</div>
	</body>
	<script src="<?php echo (PUB_JS); ?>set.js"></script>
	<script src="<?php echo (PUB_JS); ?>jquery-1.8.2.min.js"></script>
	<script src="<?php echo (PUB_LIB); ?>layer/layer.js"></script>
	<script>
		function hasClass(element, cls) {
			return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
		}
		var wait=120;//60s验证码
		var t;
		function time(o) {
			if (wait == 0) {
				o.removeAttribute("class", "");   
				o.innerText="获取验证码";
				wait = 120;
				} else {
					o.setAttribute("class", "disabled");
					o.innerText="重新发送(" + wait + "s)";
					wait--;
					t = setTimeout(function() {
						time(o)
					},
					1000)
			}
		}
		window.onload = function(){
			var agree = document.getElementById('agree'),
				agrI = agree.getElementsByTagName('i')[0];				
				agrI.onclick = function(){
					if(hasClass(agrI,'active')){
						this.className = '';
					}else{
						this.className = 'active';
					}
				}
			
				$('.hided').click(function(){
					var inval = $(this).siblings('input').val();
					if($(this).parent().hasClass('active')){
						$(this).siblings('input').detach();
						$(this).before('<input type="text"  value="'+ inval +'">');
						$(this).parent().removeClass('active');
					}else{
						$(this).parent().addClass('active');
						$(this).siblings('input').detach();
						$(this).before('<input type="password" value="'+ inval +'">');
					}
			});
		}
	</script>
	
<script>
$(function(){
	$('.code').click(function(){
		var phone = $('#phone').val();
		if(phone == ''){
			layer.msg('手机号不能为空',{time:2000,icon:5});
			return false;
		}
		time(this);
		var obj = $(this);
		$.post("<?php echo U('login/ajax_send_sms_login');?>",{phone:phone},function(data){
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
	
	$('#login_phone').click(function(){
		var obj = $(this);
		obj.prop('disabled',true);
		var phone = $('#phone').val();
		var sms = $('#sms').val();
		
		var agree = $('#agree i').hasClass('active');
		if(!agree){
			layer.msg('请阅读并同意协议',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
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
		
		
		$.post("<?php echo U('login/ajax_login_phone');?>",{phone:phone,sms:sms},function(data){
			if(data.info == 'success'){
				layer.msg(data.msg,{time:2000,icon:1},function(){
					var url = "<?php echo U('user/index');?>";
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