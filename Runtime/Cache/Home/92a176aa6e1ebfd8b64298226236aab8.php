<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no"/>
	<title>注册</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>common.css">
	<link rel="stylesheet" href="<?php echo (PUB_CSS); ?>use.css">
	</head>
	<body>
		<header>
	<h3 class="tc lhbg">
		<i class="go"></i>
		会员注册
	</h3>
</header>
		<div class="main register">
			
				<ul>
					<li><i class="icphone"></i><input type="text"placeholder="请输入手机号" id="phone"></li>
					<li class="flex-box">
						<i class="icodetxt"></i>
						<input type="text"placeholder="验证码" id='sms'>
						<span class="flex-1 code">获取验证码</span>
					</li>
					<li><i class="icname"></i><input type="text"placeholder="姓名" id='realname'></li>
					<li class="active">
						<i class="icpay"></i><input type="password" placeholder="登录密码" id='password'>
						<!--<i class="hided"></i>-->
					</li>
					<li><i class="icpwd1"></i><input type="password"placeholder="支付密码" id='paypassword'></li>
					<li><i class="icrec"></i><input type="number" placeholder="推荐人手机号码(选填)" id='refer'></li>
				</ul>
				<div class="reg-box">
					<p class="tc"id="area">
						<span class="active" data-id='1'><i></i>一区</span>
						<span  data-id='2'><i></i>二区</span>
					</p>
					<p class="agreement"id="agree">
						<i class="active"></i>
						<span>注册表示您已阅读并同意</span>
						<a href="#">《矿产链用户注册协议》</a>
					</p>
					<p class="tc reg-btn"><button class="lhbg mod-btn" id='register'>注册</button></p>
					<p class="tr logbtn"><a href="<?php echo U('login/password');?>">已有账号去登录</a></p>
				</div>
			
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
				agrI = agree.getElementsByTagName('i')[0],
				area = document.getElementById('area'),
				arSp = area.getElementsByTagName('span');
				agrI.onclick = function(){
					if(hasClass(agrI,'active')){
						this.className = '';
					}else{
						this.className = 'active';
					}
				}
				for(var i=0;i<arSp.length;i++){
					arSp[i].index = i;
					arSp[i].onclick = function(){
						for(var i=0;i<arSp.length;i++){
							arSp[i].className = '';
						}
						this.className = 'active';
					}
				};
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
		$.post("<?php echo U('login/ajax_send_sms');?>",{phone:phone},function(data){
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
	
	$('#register').click(function(){
		var obj = $(this);
		obj.prop('disabled',true);
		var phone = $('#phone').val();
		var sms = $('#sms').val();
		var realname = $('#realname').val();
		var password = $('#password').val();
		var paypassword = $('#paypassword').val();
		var refer = $('#refer').val();
		var zone = $('#area .active').data('id');
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
		if(password == ''){
			layer.msg('登录密码不能为空',{time:2000,icon:5});
			return false;
		}
		if(paypassword == ''){
			layer.msg('支付密码不能为空',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		if(password == paypassword){
			layer.msg('登录密码和交易密码不能一样',{time:2000,icon:5});
			obj.prop('disabled',false);
			return false;
		}
		
		$.post("<?php echo U('login/ajax_register');?>",{phone:phone,sms:sms,realname:realname,password:password,paypassword:paypassword,refer:refer,zone:zone},function(data){
			if(data.info == 'success'){
				layer.msg(data.msg,{time:2000,icon:1},function(){
					var url = "<?php echo U('login/login');?>";
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